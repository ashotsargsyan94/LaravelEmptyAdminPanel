<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OtherPagesController extends BaseController
{
    //
    public  function cabinet(){
        if (Auth::guard('customer')->check()){
            $current_page=null;
            return view('site.pages.cabinet',compact('current_page'));
        }
    }
}
