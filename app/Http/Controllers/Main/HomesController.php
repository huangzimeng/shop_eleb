<?php

namespace App\Http\Controllers\Main;

use App\ShopUser;
use App\StoreInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',[
            'except'=>[]//排除不需要验证的功能
        ]);
    }
    //首页
    public function index(){
        $id=Auth::user()->shop_store_id;
        $storeinfo=StoreInfo::find($id);
        return view('Home.index',compact('storeinfo'));
    }
    //修改密码-表单展示
    public function modify(Request $request){
        if ($request->isMethod('post')){//验证
            $this->validate($request,
                [
                    'oldpwd'=>'required',
                    'password'=>'required|min:10',
                    're_password'=>'required|min:10',
                ],
                [
                    'oldpwd.required'=>'请输入旧密码!',
                    'password.required'=>'请输入新密码!',
                    'password.min'=>'新密码不能少于10位!',
                    're_password.required'=>'请输入确认密码!',
                    're_password.min'=>'确认密码不能少于10位!'
                ]);
            $id = Auth::user()->id;
            //获取旧密码和新密码
            $oldpassword = $request->input('oldpwd');
            $newpassword = $request->input('re_password');
            if(!Hash::check($oldpassword, Auth::user()->password)){
                session()->flash('danger','旧密码输入错误!');
                return redirect()->route('modify');
                exit;//原密码不对
            }
            if ($request->password != $request->re_password){
                session()->flash('danger','新密码和确认密码不一致!');
                return redirect()->route('modify');
            }else{
                //修改密码
                DB::table('shop_users')->where('id',$id)->update(['password'  =>bcrypt($newpassword),]);
                session()->flash('success','密码修改成功!请从新登陆!');
                Auth::logout();
                return redirect()->route('login');
            }
        }
        //展示修改密码表单
        return view('home.modify');
    }
}
