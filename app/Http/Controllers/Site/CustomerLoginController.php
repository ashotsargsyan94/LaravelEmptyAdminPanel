<?php

namespace App\Http\Controllers\Site;

use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CustomerLoginController extends Controller
{


    use AuthenticatesUsers;


    protected $redirectTo = '/cabinet';



    protected function guard()
    {
        return Auth::guard('customer');
    }
//    public function logout(Request $request)
//    {
//        if(Auth::guard('customer')->check())
//        {
//            Auth::logout();
//            Session::flush();
//        }
//        return  redirect('/');
//    }



}
