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
//        $activitys = DB::table('activities')->get();
//        dump($activitys);
//        foreach ($activitys as $a1){
//            dump($a1);
//        }
//        dd($activitys2);
//        foreach ($activitys2 as $a2){
//            dump($a2);
//        }
//        dd(1);
        return view('activity.index',compact('activitys'));
    }
    //查看活动详情
    public function show(Request $request,Activity $activity){
        return view('activity.show',compact('activity'));
    }
}
