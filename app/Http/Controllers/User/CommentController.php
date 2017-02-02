<?php
/**
 * Created by Licoy.
 * Date: 2017/1/15 0015
 * Time: 18:39
 */

namespace App\Http\Controllers\User;


use App\Comments;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{
    //获取评论总数
    public function commentCount()
    {
        return Comments::count('id');
    }

    //前台分页查询评论集
    public function comments()
    {
        return Comments::where('parent',0)
            ->orderBy('id','desc')
            ->paginate(6);
    }

    //获取当前评论子评论集
    public function comments_children($id)
    {
        $re = Comments::where('parent',$id)
            ->orderBy('id','desc')
            ->get();
        if($re==null){
            return null;
        }
        return $re;
    }

    //获取指定用户评论总数
    public function getUserCommentCount($id)
    {
        return Comments::where('user',$id)->count('id');
    }

    //获取指定用户评论总数（静态）
    public static function getUserCommentsCount($id)
    {
        return Comments::where('user',$id)->count('id');
    }

    //获取前台评论数据
    public function getData(Request $request)
    {
        $user = new UserController();
        $data['commentCount'] = $this->commentCount();
        $data['comments'] = $this->comments();
        $data['pageNumber'] = $request->get('page',1);
        for($i=0;$i<count($data['comments']);$i++){
            if($re = $this->comments_children($data['comments'][$i]['id'])){
                $data['comments'][$i]['children'] = $re;
                for($j=0;$j<count($data['comments'][$i]['children']);$j++) {
                    $data['comments'][$i]['children'][$j]['userInfo'] = $user->findUser($data['comments'][$i]['children'][$j]['user']);
                    $data['comments'][$i]['children'][$j]['count'] = $this->getUserCommentCount($data['comments'][$i]['children'][$j]['user']);
                }
            }
            $data['comments'][$i]['userInfo'] = $user->findUser($data['comments'][$i]['user']);
            $data['comments'][$i]['count'] = $this->getUserCommentCount($data['comments'][$i]['user']);
        }

        return view('index.comment',[
            'data'=>$data
        ]);
    }

    //创建新的评论
    public function create(Request $request)
    {
        $this->validate($request,[
            'text'=>'required|between:1,255',
            'parent'=>'numeric',
        ],[
            'between'=>':attribute长度应为:min到:max之间',
            'required' => ':attribute为必填项',
            'numeric' => ':attribute应为数值',
        ],[
            'text'=>'内容',
            'parent'=>'父级元素'
        ]);

        if(UserController::user()->user_gag==1){
            return response()->json([
                'code'=>422,
                'msg'=>'你已经被禁言了！'
            ]);
        }

        $comment = new Comments();
        $comment->user = Session::get('user_id');
        $comment->text = htmlspecialchars($request->get('text'));
        $comment->ip = $request->getClientIp();
        $comment->agent = $request->header('user-agent');
        $comment->parent = $request->get('parent');
        if($comment->save()){
            return response()->json([
                'code'=>200,
                'msg'=>'留言成功'
            ]);
        }else{
            return response()->json([
                'code'=>422,
                'msg'=>'留言失败'
            ]);
        }
    }

    //后台分页查询评论集
    public function comments_admin()
    {
        return Comments::orderBy('id','desc')
            ->paginate(10);
    }

    //删除评论
    public function delete(Request $request)
    {
        $this->validate($request,[
            'id'=>'required|numeric'
        ],[
            'required' => ':attribute为必填项',
            'numeric'=>':attribute必须为数值',
        ],[
            'id'=>'评论标识符'
        ]);

        $comment = Comments::find($request->get('id'));
        if($comment){
            if($comment->delete()){
                $res = Comments::where('parent',$request->get('id'))->get(['id']);
                foreach($res as $v){
                    $v->delete();
                }
                return response()->json([
                    'code'=>200,
                    'msg'=>'删除成功！'
                ]);
            }else{
                return response()->json([
                    'code'=>422,
                    'msg'=>'删除失败！'
                ]);
            }
        }else{
            return response()->json([
                'code'=>422,
                'msg'=>'目标评论不存在！'
            ]);
        }
    }

    //获取指定的评论的数据
    public function getCommentById($id)
    {
         return response()->json([
             "code"=>200,
             "data"=>Comments::find($id)
         ]);
    }

    //更新指定的评论
    public function update(Request $request)
    {
        $this->validate($request,[
            'id'=>'required|numeric',
            'text'=>'required|between:1,255'
        ],[
            'required' => ':attribute为必填项',
            'numeric'=>':attribute必须为数值',
            'between'=>':attribute长度应为:min到:max之间',
        ],[
            'id'=>'评论标识符',
            'text'=>'评论内容'
        ]);

        $comment = Comments::find($request->get('id'));
        if($comment){
            $comment->text = $request->get('text');
            if($comment->save()){
                return response()->json([
                    'code'=>200,
                    'msg'=>'更新成功！'
                ]);
            }else{
                return response()->json([
                    'code'=>422,
                    'msg'=>'更新失败！'
                ]);
            }
        }else{
            return response()->json([
                'code'=>422,
                'msg'=>'目标评论不存在'
            ]);
        }


    }
}