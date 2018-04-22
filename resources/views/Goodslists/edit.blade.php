@extends('layout.default')

@section('title','添加菜品')

@section('content')
    <form method="post" action="{{route('goods_list.update',['goodslist'=>$goods_list])}}" enctype="multipart/form-data">
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
            <label for="exampleInputPassword1">修改图片</label>
            <input type="file" name="goods_img">
        </div>
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