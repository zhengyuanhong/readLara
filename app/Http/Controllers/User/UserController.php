<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function goToLogin(){
        return view('users.login');
    }

    public function login(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');

        $validator =  Validator::make($request->all(),[
            'password'=>'required',
            'email' =>'required'
        ]);

        if($validator->fails()){
            return redirect('/login')
                ->withErrors($validator);
        }

        if (!Auth::attempt(['email' => $email, 'password' => $password])) {
            return redirect('/login')->with('msg','账号或密码错误');
        }

        return redirect('/');
    }

    public function goToReg(){
        return view('users.reg');
    }

    public function reg(Request $request){
        $data = $request->all();
        $validator =  Validator::make($data,[
            'password'=>'required',
            'repassword'=>'required',
            'name' =>'required',
            'email' =>'required'
        ]);

        if($validator->fails()){
            return redirect('/reg')->with('msg','缺少信息');
        }

        if(strlen($data['password']) < 8 ){
            return redirect('/reg')->with('msg','密码太短，不得少于8位');
        }

        if($data['repassword'] != $data['password']){
            return redirect('/reg')->with('msg','密码不一致');
        }

        $user = User::where('email',$data['email'])->first();
        if(!empty($user)){
            return redirect('/reg')->with('msg','该邮箱已注册');
        }

        $user = User::where('name',$data['name'])->first();
        if(!empty($user)){
            return redirect('/reg')->with('msg','该昵称已存在');
        }

        //TODO 注册 发送邮箱

        /** @var User $user */
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->jifen = 10;
        $user->save();

        return redirect('/login')->with('msg','注册成功');
    }

    public function  logout(){
        /** @var User $user */
        $user = User::find(Auth::id());
        $user->last_login = date('Y-m-d H:i:s');
        $user->save();

        Auth::logout();
        return redirect('/');
    }
}
