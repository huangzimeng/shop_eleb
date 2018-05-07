@extends('layout.default')

@section('title','抽奖活动')

    @section('content')
        <h2 style="text-align: center">抽奖活动列表</h2>
        <table class="table table-responsive table-hover">
            <tr>
                <td>ID</td>
                <td>标题</td>
                <td>开始报名时间</td>
                <td>结束报名时间</td>
                <td>开奖时间</td>
                <td>报名人数限制</td>
                <td>是否开奖</td>
                <td>操作</td>
            </tr>
            @foreach($enents as $enent)
                <tr data-id="{{$enent->id}}">
                    <td>{{$enent->id}}</td>
                    <td>{{$enent->title}}</td>
                    {{--<td>{{$enent->contents}}</td>--}}
                    <td>{{$enent->signup_start}}</td>
                    <td>{{$enent->signup_end}}</td>
                    <td>{{$enent->prize_date}}</td>
                    <td>{{$enent->signup_num}}</td>
                    <td>{{$enent->is_prize==0?"×":"√"}}</td>
                    <td>
                        {{--@if($enent->is_prize)--}}
                            {{--<a href="{{route('show_members',['enent'=>$enent->id])}}" class="btn btn-sm btn-success">查看中奖名单</a>--}}
                        {{--@else--}}
                            {{--<a href="{{route('signup',['enent'=>$enent->id])}}" class="btn btn-sm btn-primary">立即报名</a>--}}
                        {{--@endif--}}
                        <a href="{{route('show',['enent'=>$enent->id])}}" class="btn btn-sm btn-primary">查看详情</a>
                    </td>
                </tr>
            @endforeach
        </table>
        @stop