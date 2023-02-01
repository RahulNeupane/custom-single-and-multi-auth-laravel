<?php

namespace App\Http\Controllers;

use App\Mail\Websitemail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class WebsiteController extends Controller
{
    public function index()
    {
        return view('home');
    }
    public function dashboard()
    {
        return view('dashboard');
    }
    public function login()
    {
        return view('login');
    }
    public function login_submit(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'status' => 'verified'
        ];

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        } else
            return redirect()->route('login');
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('login');
    }

    public function registration()
    {
        return view('registration');
    }
    public function registration_submit(Request $request)
    {
        $token = hash('sha256', time());

        if ($request->password != $request->retype_password) {
            dd('password not matched');
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->status = 'Pending';
        $user->token = $token;

        $user->save();

        $verification_link = url('registration/verify/' . $token . '/' . $request->email);
        $subject = 'Registration Confirmation';
        $message = 'Please click on this link to verify: <br><a href="' . $verification_link . '">Click here</a> ';


        Mail::to($request->email)->send(new Websitemail($subject, $message));
        echo 'verify the email to continue';
    }

    public function registration_verify($token, $email)
    {
        $user = User::where('token', $token)->where('email', $email)->first();

        if (!$user) {
            return redirect()->route('login');
        }
        $user->status = 'verified';
        $user->token = '';
        $user->update();
        echo 'Registered succesfully ! <br> <a href="{{route("login")}}">Goto Login</a> ';
    }
    public function forgetPassword()
    {
        return view('forget_password');
    }

    public function forgetPassword_submit(Request $request)
    {
        $token = hash('sha256', time());
        $user = User::where('email', $request->email)->first();
        if (!$user)
            dd('email not found');

        $user->token = $token;
        $user->update();

        $reset_link = url('reset-password/' . $token . '/' . $request->email);
        $subject = 'Reset Password';
        $message = 'Click on the link to reset password : <br> <a href="' . $reset_link . '">Click here</a>';
        Mail::to($request->email)->send(new Websitemail($subject, $message));

        echo 'kindly check your email for reset link';
    }

    public function resetPassword($token, $email)
    {
        $user = User::where('email', $email)->where('token', $token)->first();
        if (!$user) return redirect()->route('login');

        return view('reset_password', compact('token', 'email'));
    }

    public function resetPasswordSubmit(Request $request)
    {
        $user = User::where('email', $request->email)->where('token', $request->token)->first();
        if (!$user)
            return redirect()->route('login');
        if ($request->new_password != $request->retype_password)
            echo 'password not matched';
        else {
            $user->token = '';
            $user->password = Hash::make($request->new_password);
            $user->update();
            echo 'Password changed succesfully ! <br> <a href="{{route("login")}}">Goto Login</a> ';
        }
    }
}
