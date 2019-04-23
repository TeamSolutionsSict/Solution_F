<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\KeywordModel;
use App\PostkeyModel;
use App\PostModel;
use App\CommentModel;
use App\ReportPostModel;
use Datetime;
use Hash;
use Auth;
use Validator;
use Session;
use Helper;

class PostController extends Controller
{
    public function getTerms(){
      if(Auth::check())
          return view('page.terms');
        else 
          return redirect()->route('get.Home');
    }

    public function getAddQuestion(){
        if(Auth::check())
          return view('page.add_question');
        else 
          return redirect()->route('get.Home');
    }
    function checkLogin(){
        if(!Auth::check())
          return "NOT_LOGIN";
    }

    //    Question Details
   public function getQuestionDetails($id){
        $post=PostModel::find($id);
        $post->view=$post->view+1;
        $post->save();
       $post=PostModel::select('tb_post.*','tb_post.id as idpost','tb_user.*')
           ->join('tb_user', 'tb_user.username', '=', 'tb_post.username')
           ->where('tb_post.id',$id)->get()->toArray();
       $now = new DateTime(date('Y-m-d H:i:s'));
       $ref = new DateTime($post[0]['timepost']);
       $diff = $now->diff($ref);
       // printf('%d days, %d hours, %d minutes', $diff->d, $diff->h, $diff->i);
       $post[0]['timepost']=$diff->d." days, ".$diff->h." hours ".$diff->i." minutes ago";
       $allKey=PostkeyModel::select('*')->where('id_post',$id)->get()->toArray();
       $post[0]['keyWordName']= array();
         $post[0]['keyWordID']= array();
       foreach ($allKey as $val) {
           $keyname=KeywordModel::find($val['id_keyword']);
           $post[0]['keyWordName'][]=$keyname->keyword;
            $post[0]['keyWordID'][]=$keyname->id;
       }
       $post[0]['stt']=PostController::getStatusStats($post[0]['idpost']);
       $comment=CommentModel::select('tb_comment.*','tb_comment.id as idpost','tb_user.avatar')
           ->join('tb_user', 'tb_user.username', '=', 'tb_comment.username')
           ->where('tb_comment.id_post',$id)
           ->orderBy('votes','desc')
           ->get()
           ->toArray();
       foreach ($comment as $key=>$value) {
           // $now = new DateTime(date('Y-m-d H:i:s'));
           $ref = new DateTime($value['time_cmt']);
           $diff = $now->diff($ref);
           $comment[$key]['time_cmt']=$diff->d." days, ".$diff->h." hours ".$diff->i." minutes ago";
       }
       if (Auth::check()) {
          $self = (Auth::user()->username===$post[0]['username']) ? true : false;
       }else {
         $self=false;
       }

       return view('page.question_details', compact('post','comment','self'));
   }
   function setBest($id){
      $comment= CommentModel::find($id);
      $author= User::select('username')->where('username',$comment->username)->first();
      if (!Auth::user()->username==$author->username) {
        return "YOU DON'T HAVE PERMISSION TO DO THIS ACTION!";
      }
      else {
        $comment->best=1;
        $comment->save();
        return redirect()->back();
      }
   }
   //Add Question
    public function postAddQuestion(Request $request){
        //Lấy thời gian hiện tại
        $date = new Datetime();
        //Lấy username
        $username = Auth::user()->username;
        $helper = new Helper();
        $idPost = $helper->hashID($username, $request->title);
        //Validator form nhập vào
        $rules = [
            'title' => 'required',
            'content' => 'required',
        ];
        $validator = $request->validate($rules);
        $keyArr = explode(',',$request->question_tags);
        foreach ($keyArr as $key => $value) {
            $keyword = KeywordModel::where('keyword','=',strtoupper($value))->get()->toArray();
            if(count($keyword) == 0){
                $keyword = new KeywordModel();
                $keyword->keyword = strtoupper($value);
                $keyword->status = 1;
                $keyword->save();

                $keypost = new PostkeyModel();
                $keypost->id_post = $idPost;
                $keypost->id_keyword = $keyword->id;
                $keypost->save();
            }else{
                $keypost = new PostkeyModel();
                $keypost->id_post = $idPost;
                // dd($keyword[0]['id']);
                $keypost->id_keyword = $keyword[0]['id'];
                $keypost->save();
            }
        }
        $post = new PostModel();
        $post->id = $idPost;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->username = $username;
        $post->timepost = $date;
        $post->status = 1;
        $post->votes=0;
        $post->comment=0;
        $post->view=0;
        $post->save();
        return redirect()->back();
    }

   function getVotePost($id)
    {
     if(!Auth::check())
          return "NOT_LOGIN";
      $list=PostModel::find($id);
      if (!$list->votelist) {
        $newJson=array();
        $data='{
          "username": "Aragorn",
          "status": "Human"
        }';
        $data=json_decode($data);

        $data->username=Auth::user()->username;
        $data->status="UP";
         $newJson[]=$data;
      $list->votelist=json_encode($newJson);
      $list->save();
      return 1;
      }
      else {
      $list_json=json_decode($list->votelist);
      $newJson=array();
      $flag=false;
      // dd($list_json);
      foreach ($list_json as $value) {
        // dd($value);
        if($value->username==Auth::user()->username && $value->status=="UP"){ 
          return 'NOPE';
        }
        else if ($value->username==Auth::user()->username) {
          $value->status="UP";
          $flag=true;
        } 
        $newJson[]=$value;
      }
      // dd($flag);
      if ($flag==false) {
          $data='{
          "username": "Aragorn",
          "status": "Human"
        }';
        $data=json_decode($data);
        $data->username=Auth::user()->username;
        $data->status="DOWN";
         $newJson[]=$data;
      }
      $list->votelist=json_encode($newJson);
      $list->save();
     return  PostController::getCheckVoteCount($id);
    }
  }
  function getCheckVoteCount($id)
    {

       $list=PostModel::find($id);
        if (!$list->votelist) {
          return 0;
        }
      $dcm=json_decode($list->votelist);
      $count=0;
      foreach ($dcm as $value) {
        if ($value->status=="UP") {
          $count++;
        }
        else if ($value->status=="DOWN"){
          $count--;
        }
      }
      $list->votes=$count;

      $list->save();
      return $count;
    }
    function getDownVotePost($id)
    {
      // cuongdeptrai
      if(!Auth::check())
          return "NOT_LOGIN";
      $list=PostModel::find($id);
       if (!$list->votelist) {
        $newJson=array();
        $data='{
          "username": "Aragorn",
          "status": "Human"
        }';
        $data=json_decode($data);
        $data->username=Auth::user()->username;
        $data->status="DOWN";
         $newJson[]=$data;
      $list->votelist=json_encode($newJson);
      $list->save();
      return "SUCCESS";
      }
      else {
      $list_json=json_decode($list->votelist);
      $newJson;
      $flag=false;
      foreach ($list_json as $value) {
        if($value->username==Auth::user()->username && $value->status=="DOWN"){ 
          return 'NOPE';
        }
        else if ($value->username==Auth::user()->username) {
          $value->status="DOWN";
          $flag=true; 
        }
        $newJson[]=$value;
        // return  pageController::getCheckVoteCount($id);
      }
      if ($flag==false) {
        $data='{
          "username": "Aragorn",
          "status": "Human"
        }';
        $data=json_decode($data);
        $data->username=Auth::user()->username;
        $data->status="DOWN";
         $newJson[]=$data;
      }
      $list->votelist=json_encode($newJson);
      $list->save();
     return  PostController::getCheckVoteCount($id);
    }
  }
    
    function getCheckVotePost($id)
    {
      if(!Auth::check())
          return "NOT_LOGIN";
      $list=PostModel::find($id);
      $list_json=json_decode($list->votelist);
      foreach ($list_json as $value) {
         if ($value->username==Auth::user()->username) {
           return $value->status; 
        }
    }
  }
// Mớ hỗn lộn của comment

    function getVoteComment($id)
    {
      if(!Auth::check())
          return "NOT_LOGIN";
      $list=CommentModel::find($id);
      if (!$list->votelist) {
        $newJson=array();
        $data='{
          "username": "Aragorn",
          "status": "Human"
        }';
        $data=json_decode($data);
        $data->username=Auth::user()->username;
        $data->status="UP";
         $newJson[]=$data;
      $list->votelist=json_encode($newJson);
      $list->save();
      return 1;
      }
      else {
      $list_json=json_decode($list->votelist);
      $newJson=array();
      $flag=false;
      // dd($list_json);
      foreach ($list_json as $value) {
        // dd($value);
        if($value->username==Auth::user()->username && $value->status=="UP"){ 
          return 'NOPE';
        }
        else if ($value->username==Auth::user()->username) {
          $value->status="UP";
          $flag=true;
        } 
        $newJson[]=$value;
      }
      // dd($flag);
      if ($flag==false) {
          $data='{
          "username": "Aragorn",
          "status": "Human"
        }';
        $data=json_decode($data);
        $data->username=Auth::user()->username;
        $data->status="DOWN";
         $newJson[]=$data;
      }
      $list->votelist=json_encode($newJson);
      $list->save();
     return  PostController::getCheckVoteCountComment($id);
    }
  }
  function getCheckVoteCountComment($id)
    {

       $list=CommentModel::find($id);
        if (!$list->votelist) {
          return 0;
        }
      $dcm=json_decode($list->votelist);
      $count=0;
      foreach ($dcm as $value) {
        if ($value->status=="UP") {
          $count++;
        }
        else if ($value->status=="DOWN"){
          $count--;
        }
      }
      $list->votes=$count;

      $list->save();
      return $count;
    }
    function getDownVoteComment($id)
    {
      // cuongdeptrai
      if(!Auth::check())
          return "NOT_LOGIN";
      $list=CommentModel::find($id);
       if (!$list->votelist) {
        $newJson=array();
        $data='{
          "username": "Aragorn",
          "status": "Human"
        }';
        $data=json_decode($data);
        $data->username=Auth::user()->username;
        $data->status="DOWN";
         $newJson[]=$data;
      $list->votelist=json_encode($newJson);
      $list->save();
      return "SUCCESS";
      }
      else {
      $list_json=json_decode($list->votelist);
      $newJson;
      $flag=false;
      foreach ($list_json as $value) {
        if($value->username==Auth::user()->username && $value->status=="DOWN"){ 
          return 'NOPE';
        }
        else if ($value->username==Auth::user()->username) {
          $value->status="DOWN";
          $flag=true; 
        }
        $newJson[]=$value;
        // return  pageController::getCheckVoteCount($id);
      }
      if ($flag==false) {
        $data='{
          "username": "Aragorn",
          "status": "Human"
        }';
        $data=json_decode($data);
        $data->username=Auth::user()->username;
        $data->status="DOWN";
         $newJson[]=$data;
      }
      $list->votelist=json_encode($newJson);
      $list->save();
     return PostController::getCheckVoteCountComment($id);
    }
  }
    
    function getCheckVoteComment($id)
    {
      $list=CommentModel::find($id);
      $list_json=json_decode($list->votelist);
      foreach ($list_json as $value) {
         if ($value->username==Auth::user()->username) {
           return $value->status; 
        }
    }
  }
    function getStatusStats($id)
    {
      $report=ReportPostModel::where('id',$id)->count();
      if ($report>3) {
        return 0;
      }
      else{
        $comment= CommentModel::where('id_post',$id)->count();
        if ($comment==0) {
          return 1;
        }
        else {
          $comment=CommentModel::select('tb_comment.*','tb_user.avatar')
           ->join('tb_user', 'tb_user.username', '=', 'tb_comment.username')
           ->where('tb_comment.id_post',$id)
           ->get()
           ->toArray();
           foreach ($comment as $value) {
               if($value['best']) return 2;
           }
          return 3;
        }

      }
  }
}
