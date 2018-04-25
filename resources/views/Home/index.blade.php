@extends('layout.default')
@section('title','首页')
    @section('content')
        <div class="container">
            <div class="row">
                <div class="col-sm-10"></div>
                <div class="col-sm-2">
                    <div>
                        <p><a href="{{route('goinfo.show',['storeinfo'=>$storeinfo])}}">查看我的店铺信息</a></p>
                        <p><a href="{{route('goinfo.edit',['storeinfo'=>$storeinfo])}}">修改我的店铺信息</a></p>
                        <p><a href="{{route('goods_category.index')}}">查看我的菜品分类</a></p>
                        <p><a href="{{route('goods_list.index')}}">查看我的菜品列表</a></p>
                        <p><a href="{{route('activity.index')}}">查看活动列表</a></p>
                    </div>
                </div>
            </div>
        </div>
        @stop