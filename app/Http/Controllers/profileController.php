<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class profileController extends Controller
{
    public function getProfile($id){
        $user = User::selectRaw('tb_user.*, count(tb_post.id) as num_post, count(tb_post.id) as num_comment, count(tb_post.comment) as post_answered')
                    ->where('tb_user.id', '=', $id)
                    ->leftjoin('tb_post','tb_user.username','tb_post.username')
                    ->leftjoin('tb_comment','tb_comment.username','tb_user.username')
                    ->groupBy('tb_user.username','tb_user.phone', 'tb_user.id', 'tb_user.email', 'tb_user.avatar', 'tb_user.status', 'tb_user.level', 'tb_user.bio_profile','tb_user.remember_token','tb_user.firstname','tb_user.lastname','tb_user.password')
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
}
