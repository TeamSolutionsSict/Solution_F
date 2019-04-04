<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Nexmo\Response;

class userController extends Controller
{

    public function getListUser(){
        $user = User::selectRaw('tb_user.username,tb_user.firstname, tb_user.lastname ,tb_user.phone, tb_user.id, tb_user.email, tb_user.avatar, tb_user.status, tb_user.level, count(tb_post.id) as num_post, count(tb_comment.id) as num_comment')
            ->where('tb_user.level', '=', 1)
            ->leftjoin('tb_post','tb_user.username','tb_post.username')
            ->leftjoin('tb_comment','tb_comment.username','tb_user.username')
            ->groupBy('tb_user.username','tb_user.phone', 'tb_user.id', 'tb_user.email', 'tb_user.avatar', 'tb_user.status', 'tb_user.level','tb_user.firstname', 'tb_user.lastname')
            ->orderBy('num_post', 'desc')
            ->get()->toArray();
        return view('page.user_list', compact('user'));
    }
    //search
    public function getSearchUser(Request $request){
        if ($request->ajax()){
            $output = "";
            $user= User::selectRaw('tb_user.username,tb_user.firstname, tb_user.lastname ,tb_user.phone, tb_user.id, tb_user.email, tb_user.avatar, tb_user.status, tb_user.level, count(tb_post.id) as num_post, count(tb_comment.id) as num_comment')
                ->leftjoin('tb_post','tb_user.username','tb_post.username')
                ->leftjoin('tb_comment','tb_comment.username','tb_user.username')
                ->groupBy('tb_user.username','tb_user.phone', 'tb_user.id', 'tb_user.email', 'tb_user.avatar', 'tb_user.status', 'tb_user.level','tb_user.firstname', 'tb_user.lastname')
                ->where('tb_user.username','LIKE','%'.$request->search.'%')
//                ->orWhere('email','LIKE','%'.$request->search.'%')
//                ->orWhere('phone','LIKE','%'.$request->search.'%')
//                ->orWhere('name','LIKE','%'.$request->search.'%')
                ->where('tb_user.level', '=', 1)
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
    public function search(){
        return view('page.search');
    }
}
