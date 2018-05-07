@extends('layout.default')

@section('title','订单商品详情')

    @section('content')
        <a href="{{route('order')}}" class="btn btn-success">返回</a>
        <table class="table table-responsive">
            <tr>
                <td>ID</td>
                <td>商品名称</td>
                <td>商品数量</td>
                <td>商品单价</td>
                <td>商品图片</td>
            </tr>
            @foreach($goods as $good)
            <tr>
                <td>{{$good->id}}</td>
                <td>{{$good->goods_name}}</td>
                <td><img src="{{$good->goods_img}}" alt="" width="80px"></td>
                <td>{{$good->amount}}</td>
                <td>{{$good->goods_price}}</td>
            </tr>
            @endforeach
        </table>
        @stop