<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;

class LoginController extends Controller
{
    public function postLogin(Request $request) {
    	$credentials = $request->only('username', 'password');
    	if(Auth::attempt($credentials)) {
    		if(Auth::user()->level == 1){
    			echo "Tao là admin";
    		} elseif(Auth::user()->level == 2)
                return redirect()->route('get.Home');
    	} else {
    		return redirect()->back()->with(['flag'=>'error','message'=>'Sai tài khoản hoặc mật khẩu']);
    	}
    }

    public function getLogout(){
        Auth::logout();
        return redirect('home');
    }
}
