<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class UploaderController extends Controller
{
    //文件上传
    public function upload(Request $request){
        $file = $request->file('file')->store('public');
        $filename = "https://shop-eleb.oss-cn-beijing.aliyuncs.com/".$file;//保存到数据库的路径
        $path = storage_path("app/".$file);
        try{
            $client = App::make('aliyun-oss');
            $client->uploadFile(getenv('OSS_BUCKET'),$file,$path);
        } catch(\OSS\Core\OssException $e) {
            $message = printf($e->getMessage() . "\n");
            session()->flash('danger',$message);
            return redirect()->back()->withInput();
        }
        return ['url'=>$filename];
    }
}
