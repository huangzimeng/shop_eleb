@extends('layout.default')

@section('title','添加菜品分类')

    @section('content')
        <form method="post" action="{{route('goods_category.store')}}">
            <div class="form-group">
                <label for="exampleInputEmail1">分类名称</label>
                <input type="text" name="name" value="{{old('name')}}" class="form-control" id="exampleInputEmail1">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">分类描述</label>
                <textarea name="description" style="width: 1140px;height: 60px">{{old('description')}}</textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">是否选中</label>
                <input type="checkbox" name="is_select" value="1">
            </div>
            <button type="submit" class="btn btn-primary">提交</button>
            {{csrf_field()}}
        </form>
        @stop