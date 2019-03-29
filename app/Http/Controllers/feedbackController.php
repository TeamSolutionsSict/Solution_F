<?php

namespace App\Http\Controllers;
use App\feedbackModel;
use Illuminate\Http\Request;

class feedbackController extends Controller
{
    public function getContact(){
        return view('page.contact_us');
    }
    public function postContact(Request $Request){
        $feedback = new feedbackModel();
        $feedback->username = $Request->fullname;
        $feedback->email = $Request->email;
        $feedback->feedback = $Request->message;
        $feedback->status=1;
        $feedback->save();
        return redirect()->route('get.Home')-> with(['flash_level'=>'success','flash_message'=>'Gửi Feedback Thành Công']);
    }
}
