@extends('layout.default')

@section('title','查看抽奖活动详情')

    @section('content')
        <a href="{{route('show_prize')}}" class="btn btn-sm btn-primary">返回</a>
        <hr>
        <p>活动标题: {{$show->title}}</p>
        <p>活动内容: {!! $show->contents !!}</p>
        <p>开始报名时间: {{$show->signup_start}}</p>
        <p>结束报名时间: {{$show->signup_end}}</p>
        <p>开奖时间: {{$show->prize_date}}</p>
        <p>报名限制人数: {{$show->signup_num}}</p>
        <p>已报名人数: {{$num->num}}</p>
        <p>是否开奖: {{$show->is_prize==0?'×':'√'}}</p>
        @if($show->is_prize)
        <a href="{{route('show_members',['enent'=>$show])}}" class="btn btn-sm btn-success">查看中奖名单</a>
        @else
        <a href="{{route('signup',['enent'=>$show])}}" class="btn btn-sm btn-primary">立即报名</a>
        @endif
@stop