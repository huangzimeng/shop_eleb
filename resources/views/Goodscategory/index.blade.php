@extends('layout.default')

@section('title','分类列表')

    @section('content')
        <a href="{{route('goods_category.create')}}">添加</a>
        <table class="table table-responsive table-hover">
            <tr>
                <td>ID</td>
                <td>分类名称</td>
                <td>分类描述</td>
                <td>是否选中</td>
                <td>操作</td>
            </tr>
            @foreach($goodscategorys as $goods_category)
            <tr data-id="{{$goods_category->id}}">
                <td>{{$goods_category->id}}</td>
                <td>{{$goods_category->name}}</td>
                <td>{{$goods_category->description}}</td>
                <td>{{$goods_category->is_select == 1 ?'√':'×'}}</td>
                <td>
                    <a href="{{route('goods_category.edit',['goods_category'=>$goods_category])}}">编辑</a>
                    <a href="" name="mydelete">删除</a>
                </td>
            </tr>
            @endforeach
        </table>
        @stop

@section('js')
    <script type="text/javascript">
        $(function () {
            $('a[name=mydelete]').click(function () {
                alert('请确保该分类下没有菜品!!!');
                //发送ajax请求
                if (confirm('确认删除?')){
                    var tr = $(this).closest('tr');
                    var id = tr.data('id');
                    $.ajax({
                        type: "DELETE",
                        url: 'goods_category/'+id,
                        data: '_token={{ csrf_token() }}',
                        success: function(msg){
                            tr.fadeOut();
                        }
                    });
                }

            });
        });
    </script>
    @stop