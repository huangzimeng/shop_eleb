<?php

namespace App\Http\Controllers\Main;

use App\Goodscategory;
use App\Goodslist;
use App\Handlers\ImageUploadHandler;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

//菜品列表
class GoodslistsController extends Controller
{
    //添加
    public function create(){
        //获取当前店铺的分类
        $goods_category = Goodscategory::all()->where('store_id','=',Auth::user()->shop_store_id);
        return view('goodslists.create',compact('goods_category'));
    }
    //保存
    public function store(Request $request,ImageUploadHandler $uploader){
        $this->validate($request,
            [
                'goods_name'=>'required',
                'goods_price'=>'required|numeric',
                'description'=>'required',
                'tips'=>'required',
                'goods_img'=>'required'
            ],
            [
                'goods_name.required'=>'请填写名称!',
                'goods_price.required'=>'请填写价格!',
                'description.required'=>'请填写描述!',
                'tips.required'=>'请填写提示!',
                'goods_img.required'=>'请上传图片!',
            ]);
        //保存图片路径
        $upload = $uploader->save($request->goods_img,'goods_img',0);
        $filename=$upload['path'];
        //判断名称在当前分类下不能同名
        $rs = DB::table('goodslists')->where('shop_id','=',Auth::user()->shop_store_id)->where('goods_category_id',$request->goods_category_id)->where('goods_name','=',$request->goods_name)->get();
        if ($rs->first()!=null){//查询到数据,表示名称已经存在
            session()->flash('danger','名称已经存在!');
            return redirect()->back()->withInput();
        }
        //保存
        Goodslist::create([
            'goods_name'=>$request->goods_name,
            'goods_price'=>$request->goods_price,
            'description'=>$request->description,
            'tips'=>$request->tips,
            'goods_img'=>$filename,
            'goods_category_id'=>$request->goods_category_id,
            'shop_id'=>Auth::user()->shop_store_id,
        ]);
        session()->flash('success','添加成功!');
        return redirect()->route('goods_list.index');
    }
    //列表
    public function index(){
        $goodslists = Goodslist::all()->where('shop_id','=',Auth::user()->shop_store_id);
        return view('goodslists.index',compact('goodslists'));
    }
    //编辑-回显
    public function edit(Request $request,Goodslist $goods_list){
        $goodscategory = Goodscategory::all();
        return view('goodslists.edit',compact('goods_list','goodscategory'));
    }
    //编辑-保存
    public function update(Request $request,Goodslist $goods_list,ImageUploadHandler $uploader){
        $this->validate($request,
            [
                'goods_name'=>'required',
                'goods_price'=>'required|numeric',
                'description'=>'required',
                'tips'=>'required',
            ],
            [
                'goods_name.required'=>'请填写名称!',
                'goods_price.required'=>'请填写价格!',
                'description.required'=>'请填写描述!',
                'tips.required'=>'请填写提示!',
            ]);
        //判断是否上传图片
        if ($request->goods_img == null){
            $filename = $goods_list->goods_img;
        }else{
            $a = $uploader->save($request->goods_img,'goods_img','0');
            $filename = $a['path'];
        }
        $goods_category_id = $goods_list->goods_category_id;
        //判断名称在当前分类下不能同名
        $rs = DB::table('goodslists')->where('shop_id','=',Auth::user()->shop_store_id)->where('goods_category_id',$goods_category_id)->where('goods_name','=',$request->goods_name)->where('id','<>',$goods_list->id)->get();
        if ($rs->first()!=null){//查询到数据,表示名称已经存在
            session()->flash('danger','名称已经存在!');
            return redirect()->back()->withInput();
        }
        //保存
        $goods_list->update([
            'goods_name'=>$request->goods_name,
            'goods_price'=>$request->goods_price,
            'description'=>$request->description,
            'tips'=>$request->tips,
            'goods_img'=>$filename,
            'goods_category_id'=>$request->goods_category_id,
            'shop_id'=>Auth::user()->shop_store_id,
        ]);
        session()->flash('success','修改成功!');
        return redirect()->route('goods_list.index');
    }
    //删除
    public function destroy(Goodslist $goods_list){
        $goods_list->delete();
        echo "success";
    }
}
