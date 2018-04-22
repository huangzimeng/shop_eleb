<?php

namespace App\Http\Controllers\Main;

use App\Goodscategory;
use App\Goodslist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

//菜品分类控制器
class GoodscategoryController extends Controller
{
    //添加分类
    public function create(){
        return view('Goodscategory.create');
    }
    //保存
    public function store(Request $request){
        $this->validate($request,
            [
                'name'=>'required|unique:goodscategories',
                'description'=>'required',
            ],
            [
                'name.required'=>'名称不能为空!',
                'description.required'=>'描述不能为空'
            ]);
        $store_id = Auth::user()->shop_store_id;   //当前店铺id
        if ($request->is_select){
            $isselect=1;
        }else{
            $isselect=0;
        }
        //保存
        $goodscategory = Goodscategory::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'is_select'=>$isselect,
            'store_id'=>$store_id,
        ]);
        if ($request->is_select){
            DB::table('goodscategories')->where('id','<>',$goodscategory->id)->where('store_id','=',$store_id)->update(['is_select'=>0]);
        }

        session()->flash('success','添加成功!');
        return redirect()->route('goods_category.index');
    }
    //列表
    public function index(){
        $goodscategorys = Goodscategory::all()->where('store_id',Auth::user()->shop_store_id);
        //如果只有一条数据,将其修改为选中
        $rs = DB::table('goodscategories')->where('store_id',Auth::user()->shop_store_id)->count();
        if ($rs == 1) {
            DB::table('goodscategories')->update(['is_select'=>1]);
        }
        return view('Goodscategory.index',compact('goodscategorys'));
    }
    //编辑-回显
    public function edit(Request$request,Goodscategory $goods_category){
        return view('Goodscategory.edit',compact('goods_category'));
    }
    //编辑-保存
    public function update(Request $request,Goodscategory $goods_category){
        $this->validate($request,
            [
                'name'=>[
                    'required',
                    Rule::unique('goodscategories')->ignore($goods_category->id),
                    ],
                'description'=>'required',
            ],
            [
                'name.required'=>'名称不能为空!',
                'description.required'=>'描述不能为空',
                'name.unique'=>'分类名称已经存在',
            ]);

        if ($request->is_select){
            $isselect=1;
        }else{
            $isselect=0;
        }
        //更新
        $goods_category->update([
            'name'=>$request->name,
            'description'=>$request->description,
            'store_id'=>Auth::user()->shop_store_id,
            'is_select'=>$isselect,
        ]);
        //如果让当前分类选中,其他分类is_select更改为0
        if ($request->is_select){
            DB::table('goodscategories')->where('store_id','=',Auth::user()->shop_store_id)->where('id','<>',$goods_category->id)->update(['is_select'=>0]);
        }
        session()->flash('success','修改成功!');
        return redirect()->route('goods_category.index');
    }
    //删除
    public function destroy(Goodscategory $goods_category){
//        $rs = DB::table('goodscategories')->where('goods_category_id',$goods_category->id)->where('shop_id',Auth::user()->shop_store_id);
//        if ($rs->first()!=null){
//            echo 'danger';
//        }else{
            $goods_category->delete();
            echo "success";

    }
}
