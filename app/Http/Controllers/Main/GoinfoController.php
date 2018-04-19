<?php

namespace App\Http\Controllers\Main;

use App\Handlers\ImageUploadHandler;
use App\StoreInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

//完善店铺信息控制器
class GoinfoController extends Controller
{
    //添加
    public function create(){
        return view('goinfo.create');
    }
    //保存信息
    public function store(Request $request,ImageUploadHandler $uploader)
    {
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
            ],
            [
                'shop_name.required' => '店铺名称不能为空!',
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
            ]);
        $file = $uploader->save($request->shop_img, 'shop_img', 2);
        $filename = $file['path'];
    }

}
