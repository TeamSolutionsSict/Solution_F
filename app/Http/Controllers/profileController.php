<?php

namespace App\Http\Controllers;

use App\PostModel;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class profileController extends Controller
{
    public function getProfile($id){
        $username_auth = Auth::user()->username;

        $user = User::selectRaw('tb_user.*')
            ->where('tb_user.id', '=', $id)
            ->get()->toArray();

        $num_post = PostModel::selectRaw('tb_post.*')
            ->where('tb_post.username', '=', $username_auth)
            ->get();

        $post_answered = PostModel::selectRaw('tb_post.*')
            ->where('tb_post.comment','>',0)
            ->where('tb_post.username', '=', $username_auth)
            ->get()
            ->toArray();

        $post_unanswered = PostModel::selectRaw('tb_post.*')
            ->where('tb_post.comment','=',0)
            ->where('tb_post.username', '=', $username_auth)
            ->get()
            ->toArray();

        return view('page.profile',compact('user', 'post_answered', 'num_post', 'post_unanswered'));

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
}
