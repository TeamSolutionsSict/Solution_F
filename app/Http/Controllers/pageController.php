<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Datetime;
use Hash;
use Auth;
use Validator;
use Session;
//use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\File;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManagerStatic;
use App\User;
use App\KeywordModel;
use App\PostkeyModel;
use App\PostModel;
use App\CommentModel;
use App\VotePostModel;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Helper;

class pageController extends Controller
{
    public function getHome(){
        $post=PostModel::select('tb_post.*','tb_post.id as idpost','tb_user.*')
           ->join('tb_user', 'tb_user.username', '=', 'tb_post.username')
           ->where('tb_post.status',1)
           ->orderBy('timepost','desc') ->get()->toArray();
        foreach ($post as $key=>$value) {

            $now = new DateTime(date('Y-m-d H:i:s'));
            $ref = new DateTime($value['timepost']);
            $diff = $now->diff($ref);
            // printf('%d days, %d hours, %d minutes', $diff->d, $diff->h, $diff->i);
            $post[$key]['timepost'] = $diff->d . " days, " . $diff->h . " hours " . $diff->i . " minutes ago";
            $allKey = PostkeyModel::select('*')->where('id_post', $value['id'])->get()->toArray();
            $post[$key]['keyWordName'] = array();
            $post[$key]['stt'] = pageController::getstatus($value['id']);
            foreach ($allKey as $val) {
                $keyname = KeywordModel::find($val['id_keyword']);
                $post[$key]['keyWordName'][] = $keyname->keyword;
            }
        }
       // dd($post);

           $now = new DateTime(date('Y-m-d H:i:s'));
           $ref = new DateTime($value['timepost']);
           $diff = $now->diff($ref);
           // printf('%d days, %d hours, %d minutes', $diff->d, $diff->h, $diff->i);
           $post[$key]['timepost']=$diff->d." days, ".$diff->h." hours ".$diff->i." minutes ago";
           $allKey=PostkeyModel::select('*')->where('id_post',$value['id'])->get()->toArray();
           $post[$key]['keyWordName']= array();
            $post[$key]['stt']=pageController::getstatus($value['id']);
           foreach ($allKey as $val) {
               $keyname=KeywordModel::find($val['id_keyword']);
               $post[$key]['keyWordName'][]=$keyname->keyword;
           }

           $now = new DateTime(date('Y-m-d H:i:s'));
           $ref = new DateTime($value['timepost']);
           $diff = $now->diff($ref);
           // printf('%d days, %d hours, %d minutes', $diff->d, $diff->h, $diff->i);
           $post[$key]['timepost']=$diff->d." days, ".$diff->h." hours ".$diff->i." minutes ago";
           $allKey=PostkeyModel::select('*')->where('id_post',$value['id'])->get()->toArray();
           $post[$key]['keyWordName']= array();
            $post[$key]['stt']=pageController::getstatus($value['idpost']);
           foreach ($allKey as $val) {
               $keyname=KeywordModel::find($val['id_keyword']);
               $post[$key]['keyWordName'][]=$keyname->keyword;
           }

           //another funtion
          //  $last_cmt=CommentModel::select('id_post','time_cmt')
          //  ->groupBy('id_post')->orderBy('time_cmt')->distinct('id_post')->limit(6)->get()->toArray();
          // $frequent= array();
        // foreach ($last_cmt as $key=>$value) {
        //     $tmp=PostModel::select('tb_post.*','avatar','name')
        //    ->join('tb_user', 'tb_user.username', '=', 'tb_post.username')
        //    ->where('tb_post.id',$value)->get()->toArray();
        //     $now = new DateTime(date('Y-m-d H:i:s'));
        //    $ref = new DateTime($tmp[0]['timepost']);
        //    $diff = $now->diff($ref);
        //    // printf('%d days, %d hours, %d minutes', $diff->d, $diff->h, $diff->i);
        //    $tmp[0]['timepost']=$diff->d." days, ".$diff->h." hours ".$diff->i." minutes ago";
        //    $allKey=PostkeyModel::select('*')->where('id_post',$value)->get()->toArray();
        //    $tmp[0]['keyWordName']= array();
        //    $tmp[0]['stt']=pageController::getstatus($value);
        //    foreach ($allKey as $vl) {
        //        $keyname=KeywordModel::find($vl['id_keyword']);
        //        $tmp[0]['keyWordName'][]=$keyname->keyword;
        //    }
        //     $frequent[$key]=$tmp[0];
        // }
        $frequent=PostModel::select('tb_post.*','tb_post.id as idpost','tb_user.*')
           ->join('tb_user', 'tb_user.username', '=', 'tb_post.username')
           ->where('tb_post.status',1)
           ->orderBy('last_cmt_time','desc')->get()->toArray();
        foreach ($frequent as $key=>$value) {
           $now = new DateTime(date('Y-m-d H:i:s'));
           $ref = new DateTime($value['timepost']);
           $diff = $now->diff($ref);
           // printf('%d days, %d hours, %d minutes', $diff->d, $diff->h, $diff->i);
           $frequent[$key]['timepost']=$diff->d." days, ".$diff->h." hours ".$diff->i." minutes ago";
           $allKey=PostkeyModel::select('*')->where('id_post',$value['idpost'])->get()->toArray();
           $frequent[$key]['keyWordName']= array();
            $frequent[$key]['stt']=pageController::getstatus($value['idpost']);
           foreach ($allKey as $val) {
               $keyname=KeywordModel::find($val['id_keyword']);
               $frequent[$key]['keyWordName'][]=$keyname->keyword;
           }
         }

        $unanswered=PostModel::select('tb_post.*','tb_post.id as idpost','tb_user.*')
                    ->join('tb_user', 'tb_user.username', '=', 'tb_post.username')
                    ->where('comment',0)
                    ->get()->toArray();
        foreach ($unanswered as $key=>$value) {
            $now = new DateTime(date('Y-m-d H:i:s'));
           $ref = new DateTime($value['timepost']);
           $diff = $now->diff($ref);
           // printf('%d days, %d hours, %d minutes', $diff->d, $diff->h, $diff->i);
           $unanswered[$key]['timepost']=$diff->d." days, ".$diff->h." hours ".$diff->i." minutes ago";
           $allKey=PostkeyModel::select('*')->where('id_post',$value['idpost'])->get()->toArray();
           $unanswered[$key]['keyWordName']= array();
            $unanswered[$key]['stt']=pageController::getstatus($value['id']);
           foreach ($allKey as $val) {
               $keyname=KeywordModel::find($val['id_keyword']);
               $unanswered[$key]['keyWordName'][]=$keyname->keyword;
           }
         }
        // dd($unanswered);
        // dd($frequent);
        //     $post=PostModel::select('tb_post.*','avatar')
        //    ->join('tb_user', 'tb_user.username', '=', 'tb_post.username')
        //    ->where('tb_post.status',1)
        //    ->orderBy('timepost','desc') ->get()->toArray();
        // foreach ($post as $key=>$value) {
        //     $now = new DateTime(date('Y-m-d H:i:s'));
        //    $ref = new DateTime($value['timepost']);
        //    $diff = $now->diff($ref);
        //    // printf('%d days, %d hours, %d minutes', $diff->d, $diff->h, $diff->i);
        //    $post[$key]['timepost']=$diff->d." days, ".$diff->h." hours ".$diff->i." minutes ago";
        //    $allKey=PostkeyModel::select('*')->where('id_post',$value['id'])->get()->toArray();
        //    $post[$key]['keyWordName']= array();
        //    foreach ($allKey as $val) {
        //        $keyname=KeywordModel::find($val['id_keyword']);
        //        $post[$key]['keyWordName'][]=$keyname->keyword;
        //    }


           // $comment=CommentModel::select('tb_comment.*','tb_user.avatar')
           //     ->join('tb_user', 'tb_user.username', '=', 'tb_comment.username')
           //     ->where('tb_comment.id_post',$id)
           //     ->get()
           //     ->toArray();
           // foreach ($comment as $key=>$value) {
           //     //    $now = new DateTime(date('Y-m-d H:i:s'));
           //     $ref = new DateTime($value['time_cmt']);
           //     $diff = $now->diff($ref);
           //     $comment[$key]['time_cmt']=$diff->d." days, ".$diff->h." hours ".$diff->i." minutes ago";
           // }  
        return view('page.index', compact('post','frequent','unanswered'));
    }

    function getstatus($id){
       //   $post=PostModel::select('tb_post.*','avatar')
       //     ->join('tb_user', 'tb_user.username', '=', 'tb_post.username')
       //     ->where('tb_post.id',$id)->get()->toArray();
       // $now = new DateTime(date('Y-m-d H:i:s'));
       // $ref = new DateTime($post[0]['timepost']);
       // $diff = $now->diff($ref);
       // // printf('%d days, %d hours, %d minutes', $diff->d, $diff->h, $diff->i);
       // $post[0]['timepost']=$diff->d." days, ".$diff->h." hours ".$diff->i." minutes ago";

       // $allKey=PostkeyModel::select('*')->where('id_post',$id)->get()->toArray();
       // $post[0]['keyWordName']= array();
       // foreach ($allKey as $val) {
       //     $keyname=KeywordModel::find($val['id_keyword']);
       //     $post[0]['keyWordName'][]=$keyname->keyword;
       // }
       $comment=CommentModel::select('tb_comment.*','tb_user.avatar')
           ->join('tb_user', 'tb_user.username', '=', 'tb_comment.username')
           ->where('tb_comment.id_post',$id)
           ->get()
           ->toArray();
           foreach ($comment as $value) {
               if($value['best']) return 0;
           }
       if(count($comment)>0) return 1;
       else return 3;
    }
    

//    Profile
    public function getProfile($id){
        $user = User::where('tb_user.id', '=', $id)
                    ->get()->toArray();
        return view('page.profile',compact('user'));
    }

    public function postEditProfile(Request $request, $id) {
        $user = User::where('id', '=', $id)->first();

        $user->firstname = isset($request->firstname) ? $request->firstname : $user->firstname;
        $user->lastname = isset($request->lastname) ? $request->lastname : $user->lastname;
        $user->phone = isset($request->phone) ? $request->phone : $user->phone;
        $user->password = isset($request->password) ? Hash::make($request->phone) : $user->phone;

        if($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatar->move(public_path('/page/images/avatar'), $avatar->getClientOriginalName());
            $link = 'page/images/avatar/' . $avatar->getClientOriginalName();
            $user->avatar = $link;
        }
        $user->save();

        return redirect()->back();
    }

    //User (xem trang cá nhân cửa người khá - theo Username)
    //Danh sách user
    public function getUserList(){
        return view('page.user_list');
    }
//    contact_us
    //Register
    public function postRegister(RegisterRequest $request) {
        $register = new User();
        $hh = new Make();
//        dd($request->hasFile('avatar'));
        if($request->hasFile('fileavatar')){
            $file = $request->file('fileavatar');
            $extension = $file->getClientOriginalExtension();
            $fileName  = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $location = public_path('\\page\\images\\avatar\\'.$request ->username.".".$extension);
            Image::make($file)->resize(300, 300)->save($location);
            $avatar_link=('page/images/avatar/'.$request ->username.".".$extension);
        }
        else{
            $avatar_link=('page/images/avatar/boy-512.png');
        }
        $date = new Datetime();
        $register -> username = $request ->username;
        $register -> avatar = $avatar_link;
        $username = $register->username;
        //id_user = username + ngày giờ hiện tại + random 8 ký tự
        $ran = $username.$date->format('d-m-Y').Str::random(8);
        $register -> id = $hh->hashID($username);
        $register -> email = $request ->email;
        $register -> phone = $request ->phone;
        $register -> password = Hash::make($request->password);
        $register -> firstname = $request ->firstname;
        $register -> lastname = $request ->lastname;
        $register -> level = 2;
        $register -> status = 1;
        $register->save();

        return redirect()->route('get.Home');
    }
     public function addComment(Request $req,$id)
    {
       $post=PostModel::find($id);
        $post->comment=$post->comment+1;
        $post->last_cmt_time= new DateTime(date('Y-m-d H:i:s'));
        $post->save();
         $date = new Datetime();
       // Lấy username
       $username = 'cuongdeptrai';
       // $id_post = username + ngày giờ hiện tại + random 8 ký tự
       $ahihi = $username.$date->format('d-m-Y').Str::random(8);
        $comment= new CommentModel;
        $comment->id = Hash::make($ahihi);
        $comment->time_cmt=date('Y-m-d H:i:s');
        $comment->username="user";
        $comment->id_post=$id;
        $comment->content=$req->content;
        $comment->status=1;
        $comment->save();
        return Redirect::to(URL::previous() . "#last");    
      }

    //User (xem trang cá nhân cửa người khác)
    public function getUser(Request $request){
        $user_detail = User::selectRaw('tb_user.*, count(tb_post.id) as num_post, count(tb_comment.id) as num_comment, count(tb_post.comment) as post_answered')
                            ->where('tb_user.id', $request->id)
                            ->leftjoin('tb_post','tb_user.username','tb_post.username')
                            ->leftjoin('tb_comment','tb_comment.username','tb_user.username')
                            ->groupBy('tb_user.username','tb_user.phone', 'tb_user.id', 'tb_user.email', 'tb_user.avatar', 'tb_user.status', 'tb_user.level', 'tb_user.bio_profile')
                            ->get()->toArray();
        return view('page.user_detail', compact('user_detail'));
    }

//    public function posttest() {
//            // Lấy thông tin username và email
//            $username = isset($_POST['username']) ? $_POST['username'] : false;
//            $email = isset($_POST['email']) ? $_POST['email'] : false;
//            $phone = isset(($_POST['phone']))?$_POST['phone'] : false; 
//    // Nếu cả hai thông tin username và email đều không có thì dừng, thông báo lỗi
//    if (!$username && !$email && !$phone){
//            die ('{error:"bad_request"}');
//    }
//     
//    // Kết nối database
//    $conn = mysqli_connect('localhost', 'root', 'vertrigo', 'test') or die ('{error:"bad_request"}');
//     
//     
//    // Khai báo biến lưu lỗi
//    $error = array(
//        'error' => 'success',
//        'username' => '',
//        'email' => ''
//    );
//    if (Input::has('username'))
//    {
//        if ($username){
//
//        }
//    } 
//    // Kiểm tra tên đăng nhập
//    if ($username)
//    {
//            $query = mysqli_query($conn, 'select count(*) as count from member where username = ''.  addslashes($username).''');
//     
//        if ($query){
//            $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
//            if ((int)$row['count'] > 0){
//                $error['username'] = 'Tên đăng nhập đã tồn tại';
//            }
//        }
//        else{
//                die ('{error:"bad_request"}');
//            }
//    }
//     
//    // Kiểm tra tên email
//    if ($email)
//    {
//            $query = mysqli_query($conn, 'select count(*) as count from member where email = ''.  addslashes($email).''');
//     
//        if ($query){
//            $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
//            if ((int)$row['count'] > 0){
//                $error['email'] = 'Email đã tồn tại';
//            }
//        }
//        else{
//                die ('{error:"bad_request"}');
//            }
//    }
//     
//     
//    // Tiến hành lưu vào CSDL
//    $query = mysqli_query($conn, "insert into member(username, email) value ('$username','$email')");
//         
//     
//    // Trả kết quả về cho client
//    die (json_encode($error));
//        }
    public function getLoadMoreHome($mode,$offset)
    {
      if ($mode=="newest") {
         $post=PostModel::select('tb_post.*','tb_post.id as idpost','tb_user.*')
           ->join('tb_user', 'tb_user.username', '=', 'tb_post.username')
           ->where('tb_post.status',1)
           ->orderBy('timepost','desc') ->get()->toArray();
        foreach ($post as $key=>$value) {
           $now = new DateTime(date('Y-m-d H:i:s'));
           $ref = new DateTime($value['timepost']);
           $diff = $now->diff($ref);
           // printf('%d days, %d hours, %d minutes', $diff->d, $diff->h, $diff->i);
           $post[$key]['timepost']=$diff->d." days, ".$diff->h." hours ".$diff->i." minutes ago";
           $allKey=PostkeyModel::select('*')->where('id_post',$value['id'])->get()->toArray();
           $post[$key]['keyWordName']= array();
            $post[$key]['stt']=pageController::getstatus($value['idpost']);
           foreach ($allKey as $val) {
               $keyname=KeywordModel::find($val['id_keyword']);
               $post[$key]['keyWordName'][]=$keyname->keyword;
           }
      }
      return json_encode($post);
    }
    else {
       echo "hmm";
    }
   
    }

}


