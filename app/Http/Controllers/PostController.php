<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\KeywordModel;
use App\PostkeyModel;
use App\PostModel;
use App\CommentModel;
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
       foreach ($allKey as $val) {
           $keyname=KeywordModel::find($val['id_keyword']);
           $post[0]['keyWordName'][]=$keyname->keyword;
       }
       $comment=CommentModel::select('tb_comment.*','tb_user.avatar')
           ->join('tb_user', 'tb_user.username', '=', 'tb_comment.username')
           ->where('tb_comment.id_post',$id)
           ->get()
           ->toArray();
       foreach ($comment as $key=>$value) {
           // $now = new DateTime(date('Y-m-d H:i:s'));
           $ref = new DateTime($value['time_cmt']);
           $diff = $now->diff($ref);
           $comment[$key]['time_cmt']=$diff->d." days, ".$diff->h." hours ".$diff->i." minutes ago";
       }
       return view('page.question_details', compact('post','comment'));
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
            $keyword = KeywordModel::where('keyword','=',$value)->get()->toArray();
            //dd($keyword[0]['id']);
            if(count($keyword) == 0){
                $keyword = new KeywordModel();
                $keyword->keyword = $value;
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
        $post->save();
        return redirect()->back();

    }

    public function getVotePost($id)
    {
      $list=PostModel::find($id);
      if (!$list->votelist) {
        $newJson=array();
        $data='{
		  "username": "Aragorn",
		  "status": "Human"
		}';
		$data=json_decode($data);
        $data->username = Auth::user()->username;
        $data->status = "UP";
         $newJson[] = $data;
      $list->votelist = json_encode($newJson);
      $list->save();
      return "SUCCESS";
      }
      else {
      
      $list_json=json_decode($list->votelist);
      $newJson;
      // dd($list_json);
      foreach ($list_json as $value) {
        // dd($value);
        if($value->username == Auth::user()->username && $value->status=="UP"){ 
          return 'NOPE';
        }
        else if ($value->username == Auth::user()->username) {
          $value->status="UP";
        } 
        $newJson[]=$value;
         $list->votelist=json_encode($newJson);
      	$list->save();
        return  "SUCCESS";
      }
      $newJson[]='{
                          "username": ".Auth::user()->username.",
                           "status": "UP"
                          }';
      $list->votelist=json_encode($newJson);
      $list->save();
      return "SUCCESS";
    }
  }
    public function getDownVotePost($id)
    {
      //Nhớ vứt Auth vào
      $list=PostModel::find($id);
      $list_json=json_decode($list->votelist);
      $newJson;
      foreach ($list_json as $value) {
        if($value->username == Auth::user()->username && $value->status == "DOWN"){ 
          return 'NOPE';
        }
        else if ($value->username == Auth::user()->username) {
          $value->status="DOWN"; 
          $newJson[]=$value;
	    $list->votelist=json_encode($newJson);
       $list->save();
        }
	    $newJson[]=$value;
	    $list->votelist=json_encode($newJson);
       $list->save();
        return  "SUCCESS";
      }
      $newJson[]='{
	                  "username": ".Auth::user()->username.",
	                   "status": "DOWN"
	                  }';
	                  dd($newJson);	
      $list->votelist=json_encode($newJson);
      $list->save();
      return "SUCCESS";
    }
    
    public function getCheckVotePost($id)
    {
      $list=PostModel::find($id);
      $list_json=json_decode($list->votelist);
      foreach ($list_json as $value) {
         if ($value->username == Auth::user()->username) {
           return $value->status; 
        }
    }
  }
}
