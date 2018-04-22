@extends('layout.default')

@section('title','编辑菜品分类')

    @section('content')
        <form method="post" action="{{route('goods_category.update',['goods_category'=>$goods_category])}}">
            <div class="form-group">
                <label for="exampleInputEmail1">分类名称</label>
                <input type="text" name="name" value="{{$goods_category->name}}" class="form-control" id="exampleInputEmail1">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">分类描述</label>
                <textarea name="description" style="width: 1140px;height: 60px">{{$goods_category->description}}</textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">是否选中</label>
                <input type="checkbox" name="is_select" value="1" @if($goods_category->is_select) checked @endif>
            </div>
            <button type="submit" class="btn btn-primary">提交</button>
            {{csrf_field()}}
            {{method_field('PUT')}}
        </form>
        @stop
