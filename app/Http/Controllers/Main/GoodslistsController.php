<?php

namespace App\Http\Controllers\Main;

use App\Goodscategory;
use App\Goodslist;
use App\Handlers\ImageUploadHandler;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

//菜品列表
class GoodslistsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',[
            'except'=>[]//排除不需要验证的功能
        ]);
    }
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
                'goods_name'=>[
                    'required',
                    Rule::unique('goodslists')->where(function ($query) use($request) {
                        $query->where([
                            ['shop_id','=',Auth::user()->shop_store_id],
                            ['goods_category_id','=',$request->goods_category_id]
                            ]);
                    })
                ],
                'goods_price'=>'required|numeric',
                'description'=>'required',
                'tips'=>'required',
                'goods_img'=>'required'
            ],
            [
                'goods_name.required'=>'请填写名称!',
                'goods_name.unique'=>'名称已经存在!',
                'goods_price.required'=>'请填写价格!',
                'description.required'=>'请填写描述!',
                'tips.required'=>'请填写提示!',
                'goods_img.required'=>'请上传图片!',
            ]);
        //保存
        Goodslist::create([
            'goods_name'=>$request->goods_name,
            'goods_price'=>$request->goods_price,
            'description'=>$request->description,
            'tips'=>$request->tips,
            'goods_img'=>$request->goods_img,
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
    public function edit(Goodslist $goods_list){
        $goodscategory = Goodscategory::all();
        return view('goodslists.edit',compact('goods_list','goodscategory'));
    }
    //编辑-保存
    public function update(Request $request,Goodslist $goods_list){
        $this->validate($request,
            [
                'goods_name'=>[
                    'required',
                    Rule::unique('goodslists')->ignore($goods_list->id)->where(function ($query) use($request) {
                        $query->where([
                            ['shop_id','=',Auth::user()->shop_store_id],
                            ['goods_category_id','=',$request->goods_category_id]
                        ]);
                    })
                ],
                'goods_price'=>'required|numeric',
                'description'=>'required',
                'tips'=>'required',
            ],
            [
                'goods_name.required'=>'请填写名称!',
                'goods_name.unique'=>'名称已经存在!',
                'goods_price.required'=>'请填写价格!',
                'description.required'=>'请填写描述!',
                'tips.required'=>'请填写提示!',
            ]);
        //判断是否上传图片
        if ($request->goods_img == null){
            $filename = $goods_list->goods_img;
        }else{
            $filename = $request->goods_img;
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
    //菜品销量统计
    public function count(Request $request){
        //查询当天的统计
        $shop_id = Auth::user()->shop_store_id;//店铺id
        $day1 = date('Y-m-d')." 00:00:00";
        $day2 = date('Y-m-d')." 23:59:59";
        $day = DB::select("SELECT SUM(amount) as num,order_goods.goods_name
FROM orders
JOIN order_goods ON orders.id=order_goods.order_id
WHERE orders.shop_id='{$shop_id}' AND orders.created_at>'{$day1}' AND orders.created_at<'{$day2}'
GROUP BY order_goods.goods_name
ORDER BY num DESC");

        $day_total = DB::select("SELECT SUM(amount) as num
FROM orders
JOIN order_goods ON orders.id=order_goods.order_id
WHERE orders.shop_id='{$shop_id}' AND orders.created_at>'{$day1}' AND orders.created_at<'{$day2}'");//当天总计

        //查询当月的统计
        $month1 = date('Y-m')."-01 00:00:00";//第一天
        $month2 = date('Y-m-t')." 23:59:59";//最后一天
        $month = DB::select("SELECT SUM(amount) as num,order_goods.goods_name
FROM orders
JOIN order_goods ON orders.id=order_goods.order_id
WHERE orders.shop_id='{$shop_id}' AND orders.created_at>'{$month1}' AND orders.created_at<'{$month2}'
GROUP BY order_goods.goods_name
ORDER BY num DESC");//当月总计
        $month_total = DB::select("SELECT SUM(amount) as num
FROM orders
JOIN order_goods ON orders.id=order_goods.order_id
WHERE orders.shop_id='{$shop_id}' AND orders.created_at>'{$month1}' AND orders.created_at<'{$month2}'");

        //查询累计的统计
        $all = DB::select("SELECT SUM(amount) as num,order_goods.goods_name
FROM orders
JOIN order_goods ON orders.id=order_goods.order_id
WHERE orders.shop_id='{$shop_id}'
GROUP BY order_goods.goods_name
ORDER BY num DESC");
        $all_total = DB::select("SELECT SUM(amount) as num
FROM orders
JOIN order_goods ON orders.id=order_goods.order_id
WHERE orders.shop_id='{$shop_id}'");

        //按动态条件查询
        $start = $request->start_time??$day1;//开始时间
        $end = $request->end_time??$day2;//结束时间
        if ($start && $end){
            if ($start == $end){
                $end = $end." 23:59:59";
            }
            $counts = DB::select("SELECT SUM(amount) as num,order_goods.goods_name
FROM orders
JOIN order_goods ON orders.id=order_goods.order_id
WHERE orders.shop_id='{$shop_id}' AND orders.created_at>'{$start}' AND orders.created_at<'{$end}'
GROUP BY order_goods.goods_name
ORDER BY num DESC");

            $counts_total = DB::select("SELECT SUM(amount) as num
FROM orders
JOIN order_goods ON orders.id=order_goods.order_id
WHERE orders.shop_id='{$shop_id}' AND orders.created_at>'{$start}' AND orders.created_at<'{$end}'");//当天总计
        }

        return view("count.goodscount",compact('day','month','all','counts','day_total','month_total','all_total','counts_total'));
    }
}
