@extends('layout.default')

@section('title','添加菜品')

@section('content')
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
    <form method="post" action="{{route('goods_list.update',['goodslist'=>$goods_list])}}">
        <div class="form-group">
            <label for="exampleInputEmail1">菜品名称</label>
            <input type="text" name="goods_name" value="{{$goods_list->goods_name}}" class="form-control" id="exampleInputEmail1">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">菜品价格</label>
            <input type="text" name="goods_price" value="{{$goods_list->goods_price}}" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">菜品描述</label>
            <textarea name="description" style="width: 1140px;height: 70px">{{$goods_list->description}}</textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">菜品提示</label>
            <input type="text" name="tips" value="{{$goods_list->tips}}" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">菜品图片</label>
            <img src="{{$goods_list->goods_img}}" width="80px">
        </div>

        <div class="form-group">
            <img src="" alt="" id="myimg" width="80px">
        </div>
        <div id="uploader-demo">
            <!--用来存放item-->
            <div id="fileList" class="uploader-list"></div>
            <div id="filePicker">选择图片</div>
        </div>
        <input type="hidden" name="goods_img" id="myinput">

        <div class="form-group">
            <label for="exampleInputPassword1">菜品分类</label>
            <select name="goods_category_id">
                @foreach($goodscategory as $value)
                    <option value="{{$value->id}}" @if($value->id == $goods_list->goods_category_id) selected @endif >{{$value->name}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">提交</button>
        {{csrf_field()}}
        {{method_field('PUT')}}
    </form>
@stop

@section('js')
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
    <script>
        // 初始化Web Uploader
        var uploader = WebUploader.create({
            // 选完文件后，是否自动上传。
            auto: true,
            // swf文件路径
            swf:  '/webuploader/Uploader.swf',
            // 文件接收服务端。
            server: '/upload',

            formData : {"_token":"{{csrf_token()}}"},
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
            var url = response.url;
            $("#myimg").attr('src',url);
            $("#myinput").val(url);
        });
    </script>
@stop