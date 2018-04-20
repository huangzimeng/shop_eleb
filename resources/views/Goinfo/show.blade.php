@extends('layout.default')

@section('title','查看我的店铺信息')

    @section('content')
        <a href="{{route('home.index')}}" class=" btn btn-sm btn-info">返回</a>
        <div style="height: 20px"></div>
        <table class="table table-hover">
            <tr>
                <td>店铺名称:&emsp;</td>
                <td>{{$goinfo->shop_name}}</td>
            </tr>
            <tr>
                <td>图片:&emsp;</td>
                <td><img src="{{$goinfo->shop_img}}" width="80px"></td>
            </tr>
            <tr>
                <td>店铺地址:&emsp;</td>
                <td>{{$goinfo->address}}</td>
            </tr>
            <tr>
                <td>是否是品牌:&emsp;</td>
                <td>@if($goinfo->band) √ @else × @endif </td>
            </tr>
            <tr>
                <td>是否准时达:&emsp;</td>
                <td>@if($goinfo->on_time) √ @else × @endif</td>
            </tr>
            <tr>
                <td>是否蜂鸟配送:&emsp;</td>
                <td>@if($goinfo->fengniao) √ @else × @endif</td>
            </tr>
            <tr>
                <td>是否保标记:&emsp;</td>
                <td>@if($goinfo->bao) √ @else × @endif</td>
            </tr>
            <tr>
                <td>是否票标记:&emsp;</td>
                <td>@if($goinfo->piao) √ @else × @endif</td>
            </tr>
            <tr>
                <td>是否准标记:&emsp;</td>
                <td>@if($goinfo->zhun) √ @else × @endif</td>
            </tr>
            <tr>
                <td>起送金额:&emsp;</td>
                <td>{{$goinfo->start_send}}</td>
            </tr>
            <tr>
                <td>配送费:&emsp;</td>
                <td>{{$goinfo->send_cost}}</td>
            </tr>
            <tr>
                <td>店铺公告:&emsp;</td>
                <td>{{$goinfo->notice}}</td>
            </tr>
            <tr>
                <td>优惠信息:&emsp;</td>
                <td>{{$goinfo->discount}}</td>
            </tr>
        </table>
        @stop