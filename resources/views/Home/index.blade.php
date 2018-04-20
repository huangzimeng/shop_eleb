@extends('layout.default')
@section('title','首页')
    @section('content')
        <div>
            <p style="text-align: right"><a href="{{route('goinfo.show',['storeinfo'=>$storeinfo])}}">查看我的店铺信息</a></p>
            <p style="text-align: right"><a href="{{route('goinfo.edit',['storeinfo'=>$storeinfo])}}">修改我的店铺信息</a></p>
        </div>
        @stop