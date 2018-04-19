<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginsController extends Controller
{
    //登录表单页
    public function create(){
        return view('Logins.create');
    }
    //验证数据
    public function store(){

    }
    //注销
    public function destory(){

    }
}
