@extends('layout.default')

@section('title','完善店铺信息')

    @section('content')
        <form method="post" action="{{route('goinfo.store')}}" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">店铺名称</label>
                        <input type="text" name="shop_name" value="{{old('shop_name')}}" class="form-control" id="exampleInputEmail1">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">店铺图片</label>
                        <input type="file" name="shop_img">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">起送金额</label>
                        <input type="text" name="start_send" value="{{old('start_send')}}" class="form-control" id="exampleInputEmail1">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">配送费</label>
                        <input type="text" name="send_cost" value="{{old('send_cost')}}" class="form-control" id="exampleInputEmail1">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">店铺公告</label>
                        <input type="text" name="notice" value="{{old('notice')}}" class="form-control" id="exampleInputEmail1">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">优惠信息</label>
                        <input type="text" name="discount" value="{{old('discount')}}" class="form-control" id="exampleInputEmail1">
                    </div>
                </div>
                <div class="col-sm-6">
                    <p></p>
                    <div class="form-group">
                        是否是品牌: &emsp;
                        <label>是<input type="radio" name="brand" value="1" @if(old('brand')) checked @endif></label>
                        <label>不是<input type="radio" name="brand" value="0" @if(old('brand')) checked @endif></label>
                    </div>
                    <div class="form-group">
                        是否准时达: &emsp;
                        <label>是<input type="radio" name="on_time" value="1"></label>
                        <label>不是<input type="radio" name="on_time" value="0"></label>
                    </div>
                    <div class="form-group">
                        是否是蜂鸟配送: &emsp;
                        <label>是<input type="radio" name="fengniao" value="1"></label>
                        <label>不是<input type="radio" name="fengniao" value="0"></label>
                    </div>
                    <div class="form-group">
                        是否保标记: &emsp;
                        <label>是<input type="radio" name="bao" value="1"></label>
                        <label>不是<input type="radio" name="bao" value="0"></label>
                    </div>
                    <div class="form-group">
                        是否票标记: &emsp;
                        <label>是<input type="radio" name="piao" value="1"></label>
                        <label>不是<input type="radio" name="piao" value="0"></label>
                    </div>
                    <div class="form-group">
                        是否准标记: &emsp;
                        <label>是<input type="radio" name="zhun" value="1"></label>
                        <label>不是<input type="radio" name="zhun" value="0"></label>
                    </div>
                </div>
            </div>
            <div>
                <input type="submit" value="提交">
            </div>
            {{csrf_field()}}
        </form>
        @stop