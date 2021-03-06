<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Nexmo\Response;
use App\PostModel;

class userController extends Controller
{

    public function getListUser(){
        $user = User::selectRaw('tb_user.username,tb_user.firstname, tb_user.lastname ,tb_user.phone, tb_user.id, tb_user.email, tb_user.avatar, tb_user.status, tb_user.level, count(tb_post.id) as num_post, count(tb_comment.id) as num_comment')
            ->where('tb_user.level', '=', 2)
            ->leftjoin('tb_post','tb_user.username','tb_post.username')
            ->leftjoin('tb_comment','tb_comment.username','tb_user.username')
            ->groupBy('tb_user.username','tb_user.phone', 'tb_user.id', 'tb_user.email', 'tb_user.avatar', 'tb_user.status', 'tb_user.level','tb_user.firstname', 'tb_user.lastname')
            ->orderBy('num_post', 'desc')
            ->get()->toArray();
        return view('page.user_list', compact('user'));
    }
    //search
    public function getSearchUser(Request $request){
        $search = $request->search;
        if ($request->ajax()){
            $output = "";
            $user= User::selectRaw('tb_user.username,tb_user.firstname, tb_user.lastname ,tb_user.phone, tb_user.id, tb_user.email, tb_user.avatar, tb_user.status, tb_user.level, count(tb_post.id) as num_post, count(tb_comment.id) as num_comment')
                ->leftjoin('tb_post','tb_user.username','tb_post.username')
                ->leftjoin('tb_comment','tb_comment.username','tb_user.username')
                ->groupBy('tb_user.username','tb_user.phone', 'tb_user.id', 'tb_user.email', 'tb_user.avatar', 'tb_user.status', 'tb_user.level','tb_user.firstname', 'tb_user.lastname')
                ->where('tb_user.username','LIKE','%'.$search.'%')
//                ->orWhere('email','LIKE','%'.$request->search.'%')
//                ->orWhere('phone','LIKE','%'.$request->search.'%')
//                ->orWhere('name','LIKE','%'.$request->search.'%')
                ->where('tb_user.level', '=', 2)
                ->orderBy('num_post', 'desc')
                ->get();
            if ($user){
                foreach ($user as $key => $value){
                    $output .= '
                        <div class="user_detail col-lg-3">
                            <div class="avatar col-4">
                                <a href="'.route('get.UserDetail',$value['id']).'"><img src="https://cdn0.iconfinder.com/data/icons/profession-vol-1/32/programmer_coder_developer_encoder_engineer_computer_coding-512.png" alt="Avatar"></a>
                            </div>
                            <div class="content col-8">
                                <ul>
                                    <li><a href="'.route('get.UserDetail',$value['id']).'"><span><b>'.str_limit($value['username'], 14).'</b></span></a></li>
                                    <li>Posts: <span><b>'.$value->num_post.'</b></span></li>
                                </ul>
                            </div><hr>
                        </div>';
                }
                return Response($output);
            }
        }
    }

    //User (xem trang cá nhân cửa người khác)
    public function getUser(Request $request){
        $user_detail = User::selectRaw('tb_user.*')
            ->where('tb_user.username', $request->username)
            ->get()->toArray();

        $num_post = PostModel::selectRaw('tb_post.*')
            ->where('tb_post.username', '=', $request->username)
            ->get();

        $post_answered = PostModel::selectRaw('tb_post.*')
            ->where('tb_post.comment','>',0)
            ->where('tb_post.username', '=', $request->username)
            ->get()
            ->toArray();

        $post_unanswered = PostModel::selectRaw('tb_post.*')
            ->where('tb_post.comment','=',0)
            ->where('tb_post.username', '=', $request->username)
            ->get()
            ->toArray();

        return view('page.user_detail', compact('user_detail', 'post_answered', 'num_post', 'post_unanswered'));
    }

}
