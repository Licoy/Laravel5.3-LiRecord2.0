<?php
/**
 * Created by Licoy.
 * Date: 2017/1/16 0016
 * Time: 11:38
 */

namespace App\Http\Controllers\Index;


use App\Http\Controllers\Controller;
use App\Http\Controllers\User\CommentController;
use App\Http\Controllers\User\UserController;

class Controllers extends Controller
{
    //用户中心
    public function index()
    {
        return view('user.index');
    }

    //个人设置
    public function mySetting()
    {
        return view('user.mySetting');
    }

    //留言管理
    public function comments()
    {
        $comments = (new CommentController())->comments_admin();
        foreach ($comments as $v){
            $v['userInfo'] = (new UserController())->findUser($v['user']);
        }
        return view('user.comments',[
            'data'=>$comments
        ]);
    }

    //用户管理
    public function users()
    {
        $user = (new UserController())->getAllUser();
        foreach ($user as $v){
            $v['commentCount'] = (new CommentController())->getUserCommentCount($v['user_id']);
        }
        return view('user.users',[
        'data'=>$user
        ]);
    }

    //发布公告
    public function notice()
    {
        return view('user.notice');
    }

    //站点设置
    public function siteSetting()
    {
        return view('user.siteSetting');
    }
}