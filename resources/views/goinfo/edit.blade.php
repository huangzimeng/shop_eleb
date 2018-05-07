@extends('layout.default')

@section('title','完善店铺信息')

@section('content')
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
    <form method="post" action="{{route('goinfo.update',['storeInfo'=>$goinfo])}}">
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
                <label for="exampleInputEmail1">邮箱</label>
                <input type="text" name="email" value="{{$goinfo->email}}" class="form-control" id="exampleInputEmail1">
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
                <input type="hidden" name="shop_img" value="" id="myinput">
            </div>
            <div class="form-group">
                <img src="" width="80px" id="myimg" alt="">
            </div>
            <div class="form-group">
                <div id="uploader-demo">
                    <!--用来存放item-->
                    <div id="fileList" class="uploader-list"></div>
                    <div id="filePicker">选择图片</div>
                </div>
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

@section('js')
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
    <script>
        var uploader = WebUploader.create({
            // 选完文件后，是否自动上传。
            auto: true,
            // swf文件路径
            swf: '/webuploader/Uploader.swf',
            // 文件接收服务端。
            server: '/upload',

            formData:{'_token':"{{csrf_token()}}"},
            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',
            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            }
        });

        // 文件上传成功，给item添加成功class, 用样式标记上传成功。
        uploader.on( 'uploadSuccess', function( file,response ) {
            //回显到页面
            var url = response.url;
            $('#myimg').attr('src',url);
            //将地址写到页面表单
            $('#myinput').val(url);
        });
    </script>
    @stop