<?php

namespace App\Http\Controllers\Main;

use App\Activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{
    //活动列表展示
    public function index(){
        $activitys = Activity::all();
        return view('activity.index',compact('activitys'));
    }
    //查看活动详情
    public function show(Request $request,Activity $activity){
        return view('activity.show',compact('activity'));
    }
}
