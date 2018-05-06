<?php

namespace App\Http\Controllers\Main;

use App\Handlers\ImageUploadHandler;
use App\ShopUser;
use App\StoreInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

//完善店铺信息控制器
class GoinfoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',[
            'except'=>[]//排除不需要验证的功能
        ]);
    }
    //查看
    public function show(Request $request,StoreInfo $goinfo){
        return view('goinfo.show',compact('goinfo'));
    }
    //修改-回显
    public function edit(Request $request,StoreInfo $goinfo){
        $category = DB::select('select * from categories');
        return view('goinfo.edit',compact('goinfo','category'));
    }
    //修改-保存
    public function update(Request $request,ImageUploadHandler $uploader,StoreInfo $goinfo){
        //验证
        $this->validate($request,
            [
                'shop_name' => 'required|min:4',
                'start_send' => 'required|numeric',
                'send_cost' => 'required|numeric',
                'notice' => 'required',
                'discount' => 'required',
                'brand' => 'required',
                'on_time' => 'required',
                'fengniao' => 'required',
                'bao' => 'required',
                'piao' => 'required',
                'zhun' => 'required',
                'address'=>'required',
                'email'=>'required',
                'category_id'=>'required'
            ],
            [
                'shop_name.required' => '店铺名称不能为空!',
                'email.required' => '邮箱不能为空!',
                'shop_name.min' => '店铺名称不能少于4个字符!',
                'start_send.required' => '起送金额不能为空!',
                'start_send.numeric' => '起送金额必须为数字!',
                'send_cost.required' => '配送费不能为空!',
                'send_cost.numeric' => '配送费必须为数字!',
                'notice.required' => '公共不能为空!',
                'discount.required' => '优惠活动不能为空!',
                'brand.required' => '请选择品牌!',
                'on_time.required' => '请选择是否准时达!',
                'fengniao.required' => '请选择是否是蜂鸟配送!',
                'bao.required' => '请选择是否保标记!',
                'piao.required' => '请选择是否票标记!',
                'zhun.required' => '请选择是否准标记!',
                'address.required'=>'请填写地址',
                'required.required'=>'请选择分类'
            ]);
        if ($request->shop_img == null){//不修改头像
            $filename = $goinfo->shop_img;
        }else{
            $filename = $request->shop_img;
        }
        //保存数据
        $goinfo->update([
            'shop_name'=>$request->shop_name,
            'start_send'=>$request->start_send,
            'send_cost'=>$request->send_cost,
            'notice'=>$request->notice,
            'discount'=>$request->discount,
            'brand'=>$request->brand,
            'on_time'=>$request->on_time,
            'fengniao'=>$request->fengniao,
            'bao'=>$request->bao,
            'piao'=>$request->piao,
            'zhun'=>$request->zhun,
            'address'=>$request->address,
            'category_id'=>$request->category_id,
            'email'=>$request->email,
            'shop_img'=>$filename,
        ]);
        session()->flash('success','修改成功!');
        return redirect()->route('home.index');
    }
}
