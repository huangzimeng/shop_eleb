@extends('layout.default')

@section('title','订单列表')

    @section('content')
        <table class="table table-responsive table-hover">
            <tr>
                <td>订单ID</td>
                <td>订单编号</td>
                <td>订单时间</td>
                <td>订单状态</td>
                <td>下单人</td>
                <td>电话</td>
                <td>地址</td>
                <td>总价格</td>

                <td>操作</td>
            </tr>
            @foreach($orders as $order)
            <tr data-id="{{$order->id}}">
                <td>{{$order->id}}</td>
                <td>{{$order->order_code}}</td>
                <td>{{$order->order_birth_time}}</td>
                <td>
                    @if($order->order_status == -1) 已取消
                    @elseif($order->order_status == 0) 待支付
                    @elseif($order->order_status == 1) 待发货
                    @elseif($order->order_status == 2) 待确认
                    @elseif($order->order_status == 3) 完成
                    @endif
                </td>
                <td>{{$order->name}}</td>
                <td>{{$order->tel}}</td>
                <td>{{$order->address}}</td>
                <td>{{$order->order_price}}</td>
                <td>
                    <a href="{{route('order.show',['order'=>$order->id])}}">查看</a>

                    @if($order->order_status == 2) 已发货
                    @elseif($order->order_status == -1)
                    @else
                    <a href="{{route('orders.deal',['deal'=>$order->id])}}">发货</a>
                    @endif

                    @if($order->order_status == -1) 已取消
                    @else
                    <a href="{{route('orders.cancel',['cancel'=>$order->id])}}">取消</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
        @stop
