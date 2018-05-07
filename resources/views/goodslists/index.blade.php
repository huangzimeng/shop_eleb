@extends('layout.default')

@section('title','菜品列表')

    @section('content')
        <a href="{{route('goods_list.create')}}">添加</a>
        <table class="table table-responsive table-hover">
            <tr>
                <td>ID</td>
                <td>名称</td>
                <td>价格</td>
                <td>描述</td>
                <td>提示</td>
                <td>图片</td>
                <td>分类</td>
                <td>操作</td>
            </tr>
            @foreach($goodslists as $goodslist)
            <tr data-id="{{$goodslist->id}}">
                <td>{{$goodslist->id}}</td>
                <td>{{$goodslist->goods_name}}</td>
                <td>{{$goodslist->goods_price}}</td>
                <td>{{$goodslist->description}}</td>
                <td>{{$goodslist->tips}}</td>
                <td><img src="{{$goodslist->goods_img}}" style="width: 80px"></td>
                <td>{{$goodslist->goodscategory->name}}</td>
                <td>
                    <a href="{{route('goods_list.edit',['goodslist'=>$goodslist])}}">编辑</a>
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
                //发送ajax请求
                if (confirm('确认删除?')){
                    var tr = $(this).closest('tr');
                    var id = tr.data('id');
                    $.ajax({
                        type: "DELETE",
                        url: 'goods_list/'+id,
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