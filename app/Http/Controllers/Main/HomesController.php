<?php

namespace App\Http\Controllers\Main;

use App\StoreInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class HomesController extends Controller
{
    //
    public function index(){
        $a = DB::table('store_infos')->where('id',7)->get();
        $storeinfo = $a[0];
        return view('Home.index',compact('storeinfo'));
    }
}
