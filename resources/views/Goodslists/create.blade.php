@extends('layout.default')

@section('title','添加菜品')

    @section('content')
        <form method="post" action="{{route('goods_list.store')}}" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleInputEmail1">菜品名称</label>
                <input type="text" name="goods_name" value="{{old('goods_name')}}" class="form-control" id="exampleInputEmail1">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">菜品价格</label>
                <input type="text" name="goods_price" value="{{old('goods_price')}}" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">菜品描述</label>
                <textarea name="description" style="width: 1140px;height: 70px">{{old('description')}}</textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">菜品提示</label>
                <input type="text" name="tips" value="{{old('tips')}}" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">菜品图片</label>
                <input type="file" name="goods_img">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">菜品分类</label>
                <select name="goods_category_id">
                    @foreach($goods_category as $value)
                    <option value="{{$value->id}}">{{$value->name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">提交</button>
            {{csrf_field()}}
        </form>
        @stop