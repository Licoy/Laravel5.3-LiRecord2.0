<?php
/**
 * Created by Licoy.
 * Date: 2017/1/15 0015
 * Time: 12:25
 */

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Notice;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Queue\RedisQueue;

class NoticeController extends Controller
{
    public static function notice()
    {
        return Notice::orderBy('id','desc')->first();
    }

    public function get($id)
    {
        $notice = Notice::where('id',$id)->first();
        if($notice!=null){
            return view('index.notice',[
                'data'=>$notice
            ]);
        }else{
            return view('errors.404');
        }
    }

    public function add(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'text'=>'required',
        ],[
            'required' => ':attribute为必填项',
        ],[
            'title'=>'公告标题',
            'text'=>'公告内容'
        ]);

        $n = new Notice();
        $n->title = $request->get('title');
        $n->text = $request->get('text');
        if($n->save())
        {
            $ns = Notice::orderBy('id','desc')->first();
            return response()->json([
                'code'=>200,
                'msg'=>'发布成功，即将转至公告详情页',
                'id'=>$ns->id
            ]);
        }else{
            return response()->json([
                'code'=>422,
                'msg'=>'发布失败！'
            ]);
        }

    }
}