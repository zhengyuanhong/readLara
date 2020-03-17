<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserInfoController extends Controller
{
    public function userInfo(){
        return view('users.info',['type'=>'info']);
    }

    public function message(){
        $type = 'message';
        return view('users.message',compact('type'));
    }

    public function set(){
        $type = 'set';
        return view('users.set',compact('type'));
    }

    public function home(){
        $type = 'user';
        return view('users.user',compact('type'));
    }
}
