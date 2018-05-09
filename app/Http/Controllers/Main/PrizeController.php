<?php

namespace App\Http\Controllers\Main;

use App\enent;
use Hamcrest\Core\SampleBaseClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PrizeController extends Controller
{
    //查看抽奖
    public function show_prize(){
        $enents = DB::table('enents')->get();
        return view('prize.index',compact('enents'));
    }
    //查看详情
    public function show(enent $show){
        $num = DB::table('event_members')
            ->select(DB::raw('count(*) as num'))
            ->where('events_id',$show->id)
            ->first();
        return view('prize.showw',compact('show','num'));
    }
    //查看中奖名单
    public function show_members(enent $show_members){
        //活动标题
        $title = $show_members->title;
        //查询中奖人及奖品名单
        $data = DB::table('event_prizes')
            ->where([
                ['events_id','=',$show_members->id],
                ['member_id','<>',0],
            ])
            ->get();
        foreach ($data as $value){
            $b = DB::table('store_infos')->where('id',$value->member_id)->first();
            $value->member_id = $b->shop_name;
        }
        return view('prize.show',compact('title','data'));
    }
    //立即报名
    public function signup(enent $signup){
//        $redis = new \Redis();
//        //将活动人数限制,保存到redis(添加活动时) 'signup_num_'.$event->id = 10
//        //报名
//        //获取当前活动的人数限制
//        $limit = $redis->get('signup_num_'.$signup->id);
//        //从redis去判断报名人数
//        /*$num = $redis->get('num_'.$event->id);
//        if($num >= $limit){
//            echo '报名人数已满';exit;
//        }
//        $redis->incr('num_'.$event->id);*/
//
//        $num = $redis->incr('num_'.$signup->id);
//        if($num > $limit){
//            $redis->decr('num_'.$signup->id);
//            echo '报名人数已满';exit;
//        }
//        //保存报名信息[ 1 ,6 ,8 ]
//        //$redis->hSet('');
//        $redis->sAdd('members_'.$signup->id,Auth::user()->id);
        //同步回数据库(第二条凌晨3:00)

        //dd($signup->id);//活动id
        //判断报名人数是否超出限制
        $a = DB::select("SELECT count(*) as num FROM event_members where events_id='{$signup->id}'");//已经报名的人数
        //人数满 不能再报名
        if ( $a[0]->num >= $signup->signup_num){
            session()->flash('danger','报名失败,人数已满!');
            return redirect()->route('show_prize');
        }
        //已经开奖不能报名
        if ($signup->is_prize){
            session()->flash('danger','报名失败,已经开奖,不能报名!!');
            return redirect()->route('show_prize');
        }

        $ad = DB::table('shop_users')->where('id',Auth::user()->id)->select('shop_store_id')->first();
        //同一活动,不能重复报名
        $rse = DB::select("SELECT COUNT(*) as num FROM event_members where member_id='{$ad->shop_store_id}' AND events_id='{$signup->id}'");
        if ($rse[0]->num > 0){
            session()->flash('danger','报名失败,您已经报名,不能再报名!!');
            return redirect()->route('show_prize');
        }
        //报名
        DB::table('event_members')->insert(
            ['member_id' => $ad->shop_store_id,
                'events_id' => $signup->id,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
                ]
        );
        session()->flash('success','报名成功!!');
        return redirect()->route('show_prize');
    }
}
