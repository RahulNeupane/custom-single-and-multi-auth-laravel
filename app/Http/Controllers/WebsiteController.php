<?php

namespace App\Http\Controllers;

use App\Mail\Websitemail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class WebsiteController extends Controller
{
    public function index(){
        return view('home');
    }
    public function dashboard(){
        return view('dashboard');
    }
    public function login(){
        return view('login');
    }
    public function registration(){
        return view('registration');
    }
    public function registration_submit(Request $request){
        $token = hash('sha256', time());
       
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->status = 'Pending';
        $user->token = $token;

        $user->save();

        $verification_link = url('registration/verify/' . $token . '/' . $request->email);
        $subject = 'Registration Confirmation';
        $message = 'Please click on this link to verify: <br><a href="'.$verification_link.'">Click here</a> ';
        

        Mail::to($request->email)->send(new Websitemail($subject, $message));
        echo 'verify the email to continue';
    }

    public function registration_verify(){
        
    }
    public function forgetPassword(){
        return view('forget_password');
    }
}
