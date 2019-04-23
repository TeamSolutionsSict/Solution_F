<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Mail;
use Datetime;
use Illuminate\Support\Str;
class PasswordController extends Controller
{
    public function postEmailResetPass(Request $Request){
//        dd($Request);
       $user= User::select('id as uid','remember_token','username')
           ->orwhere('email','=', $Request->email)
           ->orWhere('username',$Request->username)
           ->first();
//        dd($user->uid);
        $user=User::find($user->uid);

        $date = new Datetime();
        $ran = $Request->username.$date->format('d-m-Y').Str::random(8);
        $cc=Hash::make($ran);
        $token = str_replace('$','',str_replace('/','',$cc));
        $user->remember_token=$token;
        $user->save();
        $data = [
            'email'=> $Request->email,
            'username' =>  $Request->username,
            'link'=> url('get-resest-password')."/".$token,
        ];

//        return str_replace('$','',str_replace('/','',$token));
        Mail::send('page.email_reset_pass',$data,function ($message) use ($data){
            $message->from('phucnguyennbo@gmail.com','Solutions');
            $message->to($data['email'])->subject('Reset Password');
        });
        return redirect()->route('get.Home')-> with(['flash_level'=>'success','flash_message'=>'Trả lời thành công']);
    }
    public function getResetPassword($token){
        $nn = User::select('remember_token')
        ->where('remember_token','=',$token)
            ->first();
        if ($nn == null){
            return redirect()->route('get.Home');
        }
        else{
            return view('page.reset_password',compact('token'));
        }
//        $user = User::select('id as uid')
//            ->where('remember_token','=', $token)
//            ->first();
//        $user=User::find($user->uid);
//        $user->remember_token='';
//        $user -> password = Hash::make($Request->password);
//        $user->save();
//        dd($cc);
    }
    public function postResetPassword(Request $Request){
        $user = User::select('id as uid')
            ->where('remember_token','=',$Request->cc)
            ->first();
        $user=User::find($user->uid);
        $user->remember_token='';
        $user -> password = Hash::make($Request->password);
        $user->save();
        return redirect()->route('get.Home');
    }
}
