@extends('layout.default')

@section('title','订单统计')

    @section('content')
        <h3>订单量统计</h3>
        <form method="get" action="" class="form-inline">
            <div class="form-group">
                <label for="exampleInputEmail1">开始日期</label>
                <input type="date" name="start_time" value="{{old('start_time')}}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">结束日期</label>
                <input type="date" name="end_time" value="{{old('end_time')}}">
            </div>
            <button type="submit" class="btn btn-default">查询</button>
        </form>
        <p>总订单量:{{$count[0]->num == 0?'暂无数据':$count[0]->num}}</p>
        <div class="row">
            <div class="col-sm-4"><table class="table table-bordered">
                    <tr>
                        <td>今天</td>
                        <td>{{$day[0]->num}}</td>
                    </tr>
                    <tr>
                        <td>当月</td>
                        <td>{{$month[0]->num}}</td>
                    </tr>
                    <tr>
                        <td>累计</td>
                        <td>{{$all[0]->num}}</td>
                    </tr>
                </table></div>
        </div>
        @stop