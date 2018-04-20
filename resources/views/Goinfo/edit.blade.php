@extends('layout.default')

@section('title','完善店铺信息')

@section('content')
    <form method="post" action="{{route('goinfo.update',['storeInfo'=>$goinfo])}}" enctype="multipart/form-data">
        <div class="">
            <div class="form-group">
                <label for="exampleInputEmail1">店铺名称</label>
                <input type="text" name="shop_name" value="{{$goinfo->shop_name}}" class="form-control" id="exampleInputEmail1">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">起送金额</label>
                <input type="text" name="start_send" value="{{$goinfo->start_send}}" class="form-control" id="exampleInputEmail1">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">配送费</label>
                <input type="text" name="send_cost" value="{{$goinfo->send_cost}}" class="form-control" id="exampleInputEmail1">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">店铺公告</label>
                <input type="text" name="notice" value="{{$goinfo->notice}}" class="form-control" id="exampleInputEmail1">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">优惠信息</label>
                <input type="text" name="discount" value="{{$goinfo->discount}}" class="form-control" id="exampleInputEmail1">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">店铺地址</label>
                <input type="text" name="address" value="{{$goinfo->address}}" class="form-control" id="exampleInputEmail1">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">店铺图片</label>
                <input type="file" name="shop_img">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">当前图片</label>
                <img src="{{$goinfo->shop_img}}" width="80px">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">类型</label>
                <select name="category_id">
                    @foreach($category as $value)
                        <option value="{{$value->id}}">{{$value->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                是否是品牌: &emsp;
                <label>是<input type="radio" name="brand" value="1" @if($goinfo->brand) checked @endif></label>
                <label>不是<input type="radio" name="brand" value="0" @if(!$goinfo->brand) checked @endif></label>
            </div>
            <div class="form-group">
                是否准时达: &emsp;
                <label>是<input type="radio" name="on_time" value="1" @if($goinfo->on_time) checked @endif></label>
                <label>不是<input type="radio" name="on_time" value="0" @if(!$goinfo->on_time) checked @endif></label>
            </div>
            <div class="form-group">
                是否是蜂鸟配送: &emsp;
                <label>是<input type="radio" name="fengniao" value="1" @if($goinfo->fengniao) checked @endif></label>
                <label>不是<input type="radio" name="fengniao" value="0" @if(!$goinfo->fengniao) checked @endif></label>
            </div>
            <div class="form-group">
                是否保标记: &emsp;
                <label>是<input type="radio" name="bao" value="1" @if($goinfo->bao) checked @endif></label>
                <label>不是<input type="radio" name="bao" value="0" @if(!$goinfo->bao) checked @endif></label>
            </div>
            <div class="form-group">
                是否票标记: &emsp;
                <label>是<input type="radio" name="piao" value="1" @if($goinfo->piao) checked @endif></label>
                <label>不是<input type="radio" name="piao" value="0" @if(!$goinfo->piao) checked @endif></label>
            </div>
            <div class="form-group">
                是否准标记: &emsp;
                <label>是<input type="radio" name="zhun" value="1" @if($goinfo->zhun) checked @endif></label>
                <label>不是<input type="radio" name="zhun" value="0" @if(!$goinfo->zhun) checked @endif></label>
            </div>
            <input type="submit" value="提交">
        </div>
        {{method_field('PUT')}}
        {{csrf_field()}}
    </form>
@stop