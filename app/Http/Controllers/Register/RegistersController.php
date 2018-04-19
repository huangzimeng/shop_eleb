<?php

namespace App\Http\Controllers\Register;

use App\ShopUser;
use App\StoreInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RegistersController extends Controller
{
    //注册
    public function create(){
        return view('registers.create');
    }
    //验证数据
    public function store(Request $request){
        //验证数据
        $this->validate($request,
            [
                'phone'=>'required|numeric',
                'password'=>'required|confirmed|min:10',
            ],
            [
                'phone.required'=>'电话不能为空!',
                'phone.numeric'=>'电话必须为数字!',
                'password.required'=>'密码不能为空!',
                'password.confirmed'=>'两次密码必须一致!',
                'password.min'=>'密码不能少于10位!'
            ]);
        //保存数据
        DB::beginTransaction();//开启事务
        try{
            ShopUser::create([
                'phone'=>$request->phone,
                'password'=>bcrypt($request->password),
            ]);
            StoreInfo::create([
                'shop_name'=>$request->phone,
            ]);
        }catch (\Exception $e) {
            DB::rollBack();
            session()->flash('danger','发生未知错误,注册失败!');
            return redirect()->route('register');
        }
        DB::commit();
        session()->flash('success','注册成功!');
        return redirect()->route('login');
    }

}
