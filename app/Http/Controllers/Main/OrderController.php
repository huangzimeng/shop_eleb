<?php

namespace App\Http\Controllers\Main;

use App\Order;
use App\Sms;
use App\Smssend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',[
            'except'=>[]//排除不需要验证的功能
        ]);
    }
    //订单 列表
    public function index(){
        //根据当前登录人查询对应的店铺id
        $shop_id = DB::table('shop_users')->where('id',Auth::user()->id)->select('shop_store_id')->first();
        $orders = DB::table('orders')->where('shop_id',$shop_id->shop_store_id)->get();
        foreach ($orders as $order){
            $detail_address = $order->provence.$order->city.$order->area.$order->detail_address;
            $order->address = $detail_address;
        }
        return view('order.index',compact('orders'));
    }
    //查看 详情
    public function show(Order $order){
        //商品id  $order->id
        $goods = DB::table('order_goods')->where('order_id',$order->id)->get();
        return view('order.show',compact('goods'));
    }
    //确认 发货
    public function deal(Order $deal){
        //订单id $deal->id
        $status = DB::table('orders')->where('id',$deal->id)->select('order_status')->first();
        if ($status->order_status == 0){
            session()->flash('danger','商品未付款,不能发货!');
            return redirect()->route('order');
        }elseif ($status->order_status == -1){
            session()->flash('danger','商品已取消,不能发货!');
            return redirect()->route('order');
        }else{
            //发货
            $a = Smssend::Smssend($deal->tel,$deal->name);
            if ($a->Message == "OK"){
                DB::table('orders')->where('id',$deal->id)->update(['order_status'=>2]);
                session()->flash('success','已发货,已发送短信通知对方!');
                //发送短信提醒
                return redirect()->route('order');
            }
        }
    }
    //取消 发货
    public function cancel(Order $cancel){
        DB::table('orders')->where('id',$cancel->id)->update(['order_status'=>-1]);
        session()->flash('success','已取消!');
        return redirect()->route('order');
    }
    //统计 表单
    public function count(Request $request){
        $shop_id = Auth::user()->shop_store_id;
        if ($request->start_time == null && $request->end_time == null){
            $count = DB::select("select count(*) as num from orders where shop_id='{$shop_id}'");
            //查询当天的数量
            $day1 = date('Y-m-d').' 00:00:00';
            $day2 = date('Y-m-d').' 23:59:59';
            $day = DB::select("select count(*) as num from orders where shop_id='{$shop_id}' AND order_birth_time BETWEEN '{$day1}' AND '{$day2}'");
            //查询当月的
            $month1 = date('Y-m')."-01 00:00:00";//第一天
            $month2 = date('Y-m-t')." 23:59:59";//最后一天
            $month = DB::select("select count(*) as num from orders where shop_id='{$shop_id}' AND order_birth_time BETWEEN '{$month1}' AND '{$month2}'");
            $all = DB::select("select count(*) as num from orders where shop_id='{$shop_id}'");
            return view('count.ordercount',compact('count','day','month','all'));
        }else{
            //判断可以允许查询每天的数据
            if ($request->start_time == $request->end_time){
                $request->end_time = $request->end_time." 23:59:59";
            }
            //查询数据
            $start = $request->start_time;
            $end = $request->end_time;
            $count = DB::select("select COUNT(*) as num from orders where shop_id='{$shop_id}' AND order_birth_time BETWEEN '{$start}' AND '{$end}'");

            //查询当天的数量
            $day1 = date('Y-m-d').' 00:00:00';
            $day2 = date('Y-m-d').' 23:59:59';
            $day = DB::select("select count(*) as num from orders where shop_id='{$shop_id}' AND order_birth_time BETWEEN '{$day1}' AND '{$day2}'");
            //查询当月的
            $month1 = date('Y-m')."-01 00:00:00";//第一天
            $month2 = date('Y-m-t')." 23:59:59";//最后一天
            $month = DB::select("select count(*) as num from orders where shop_id='{$shop_id}' AND order_birth_time BETWEEN '{$month1}' AND '{$month2}'");
            $all = DB::select("select count(*) as num from orders where shop_id='{$shop_id}'");

            return view('count.ordercount',compact('count','day','month','all'));
        }
    }
}
