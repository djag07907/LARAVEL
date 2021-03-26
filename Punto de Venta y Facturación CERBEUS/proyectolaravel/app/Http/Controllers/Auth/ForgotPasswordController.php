<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
// ToBeSure
use Auth;
use Password;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */
    // public function showLinkRequestForm(){
    //     return view('auth.passwords.email',[
    //         'title' => 'Password reseteada',
    //         'passwordEmailRoute' => 'password.email'
    //     ]);
    // }


    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    public function showLinkRequestForm(){
        return view('auth.passwords.email',[
            'title' => 'Admin Password reset',
            'passwordEmailRoute' => 'admin.password.email'
        ]);
    }

    // pw broker para admin guard
    public function broker(){
        return Pasword::broker('admins');
    }

    // guard durante auth
    public function guard(){
        return Auth::guard('admin');
    }
}
