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
                'name'=>'required|min:2',
                'email'=>'required|email',
                'password'=>'required|confirmed|min:10',
                'captcha'=>'required|captcha',
            ],
            [
                'name.required'=>'店铺名称不能为空!',
                'name.min'=>'店铺名称不能少于2个字符!',
                'email.required'=>'邮箱不能为空!',
                'email.email'=>'邮箱格式不正确!',
                'password.required'=>'密码不能为空!',
                'password.confirmed'=>'两次密码必须一致!',
                'password.min'=>'密码不能少于10位!',
                'captcha.required'=>'验证码不能为空!',
                'captcha.captcha'=>'验证码不正确',
            ]);
        //保存数据

        DB::beginTransaction();//开启事务
        try{
            $storeinfo = StoreInfo::create([
                'shop_name'=>$request->name,
            ]);
            $id = $storeinfo->id;
            ShopUser::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>bcrypt($request->password),
                'status'=>0,
                'shop_store_id'=>$id,
            ]);
        }catch (\Exception $e) {
            DB::rollBack();
            session()->flash('danger','发生未知错误,注册失败!');
            return redirect()->route('register');
        }
       DB::commit();
        session()->flash('success','注册成功!请等待审核通过!');
        return redirect()->route('login');
    }
}
