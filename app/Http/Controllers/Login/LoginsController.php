<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginsController extends Controller
{
    //登录表单页
    public function create(){
        return view('Logins.create');
    }
    //验证数据
    public function store(Request $request){
        //验证是否填写密码
        $this->validate($request,
            [
                'name'=>'required',
                'password'=>'required',
                'captcha'=>'required|captcha',
            ],
            [
                'name.required'=>'请填写名称!',
                'password.required'=>'请填写密码!',
                'captcha.required'=>'请填写验证码!',
                'captcha.captcha'=>'验证码错误!'
            ]);
        //验证密码
        if (Auth::attempt(['name'=>$request->name,'password'=>$request->password,'status'=>1],$request->has('rememberMe'))){
            //成功
            session()->flash('success','登录成功!');
            return redirect()->route('home.index');
        }else{
            //失败
            session()->flash('danger','登录失败!名称或者密码错误!');
            return redirect()->route('login');
        }
    }
    //注销
    public function destroy(){
        Auth::logout();
        session()->flash('success','您已安全退出!');
        return redirect()->route('login');
    }
}
