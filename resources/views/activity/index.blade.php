
@extends('layout.default')
@section('title','活动列表')
@section('content')
    <h3>活动列表</h3>
    <table class="table table-responsive table-hover">
        <tr>
            <td>ID</td>
            <td>名称</td>
            <td>开始时间</td>
            <td>结束时间</td>
            <td>操作</td>
        </tr>
        @foreach($activitys as  $activity)

            <tr data-id="{{$activity->id}}">
                <td>{{$activity->id}}</td>
                <td>{{$activity->name}}</td>
                <td>{{$activity->start}}</td>
                <td>{{$activity->end}}</td>
                <td>
                    <a href="{{route('activity.show',['activity'=>$activity])}}" class="btn btn-success btn-sm">查看活动内容</a>
                </td>
            </tr>
        @endforeach
    </table>
@stop