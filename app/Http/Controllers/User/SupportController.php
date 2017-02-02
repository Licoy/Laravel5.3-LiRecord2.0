<?php
/**
 * Created by Licoy.
 * Date: 2017/1/16 0016
 * Time: 19:12
 */

namespace App\Http\Controllers\User;


use App\Comments;
use App\Http\Controllers\Controller;
use App\Support;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SupportController extends Controller
{
    public function add(Request $request)
    {
        $this->validate($request,[
            'id'=>'required|numeric',
        ],[
            'required' => ':attribute为必填项',
            'numeric' => ':attribute应为数值',
        ],[
            'id'=>'评论ID'
        ]);

        if(!self::is(Session::get('user_id'),$request->get('id'))){
            $support = new Support();
            $support->user_id = Session::get('user_id');
            $support->comment_id = $request->get('id');
            if($support->save()){
                $comment = Comments::find($request->get('id'));
                $comment->support = $comment->support+1;
                if($comment->save()){
                    return response()->json([
                        'code'=>200,
                        'msg'=>'赞成功'
                    ]);
                }else{
                    return response()->json([
                        'code'=>422,
                        'msg'=>'赞没有成功~'
                    ]);
                }
            }else{
                return response()->json([
                    'code'=>422,
                    'msg'=>'赞没有成功~'
                ]);
            }

        }else{
            return response()->json([
                'code'=>422,
                'msg'=>'你已经点过赞了~'
            ]);
        }

    }

    public static function is($user_id,$comment_id)
    {
        $re = Support::where(['user_id'=>$user_id,'comment_id'=>$comment_id])->first();
        if($re){
            return true;
        }else{
            return false;
        }
    }
}