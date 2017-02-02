<?php
/**
 * Created by Licoy.
 * Date: 2017/1/13 0013
 * Time: 20:33
 */

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    //获取用户信息（静态）
    public static function user()
    {
        $user = Users::find(Session::get('user_id'));
        return $user;
    }

    //查找指定用户
    public function findUser($id)
    {
        $user = Users::find($id);
        return $user;
    }

    //更新用户
    public function update(Request $request)
    {
        $this->validate($request,[
            'user_email'=>'required|max:50|email',
            'user_qq'=>'required|numeric|digits_between:5,10',
            'user_gender'=>'required|numeric|in:1,2',
            'user_avatar'=>'required|numeric|in:1,2',
        ],[
            'required' => ':attribute为必填项',
            'max' => ':attribute最大长度为:max',
            'email' => ':attribute不符合规范',
            'numeric'=>':attribute必须为数值',
            'in'=>':attribute值有误',
            'digits_between'=>':attribute长度为:min到:max之间',
        ],[
            'user_email'=>'邮箱',
            'user_qq'=>'QQ',
            'user_gender'=>'性别',
            'user_avatar'=>'头像方案',
        ]);

        $user = Users::find(Session::get('user_id'));
        if($user){

            if($user->user_email!=$request->get("user_email")){
                $userFind = Users::where('user_email',$request->get('user_email'));
                if($userFind){
                    return response()->json([
                        'code'=>422,
                        'msg'=>'该邮箱已经被注册了，请换个试试~'
                    ]);
                }
            }
            $user->user_email = $request->get("user_email");
            $user->user_qq = $request->get("user_qq");
            $user->user_gender = $request->get("user_gender");
            $user->user_avatar = $request->get("user_avatar");
            if($user->save()){
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
                'msg'=>'身份异常，无法继续操作！'
            ]);
        }
    }

    //更新密码
    public function password(Request $request)
    {
        $this->validate($request,[
            'user_password_old'=>'required|between:6,16',
            'user_password'=>'required|regex:[^[a-zA-Z0-9]+$]|between:6,16|confirmed:user_password_confirmation'
        ],[
            'required' => ':attribute为必填项',
            'between'=>':attribute长度为:min到:max之间',
            'confirmed'=>':attribute两次输入不一致',
            'regex'=>':attribute应该为英文|数字组成',
        ],[
            'user_password'=>'新密码',
            'user_password_old'=>'旧密码'
        ]);

        $user = Users::find(Session::get('user_id'));

        if($user){
            if(md5($request->get('user_password_old'))==$user->user_password){
                $user->user_password = md5($request->get('user_password'));
                $user->remember_token = "";
                if($user->save()){
                    Cookie::queue('remember_token', null , -1);

                    $request->session()->flush();

                    $request->session()->regenerate();
                    return response()->json([
                        'code'=>200,
                        'msg'=>'修改成功，请重新登录~'
                    ]);
                }else{
                    return response()->json([
                        'code'=>422,
                        'msg'=>'修改失败！'
                    ]);
                }
            }else{
                return response()->json([
                    'code'=>422,
                    'msg'=>'旧密码不匹配！'
                ]);
            }
        }else{
            return response()->json([
                'code'=>422,
                'msg'=>'身份异常，无法继续操作！'
            ]);
        }
    }

    //分页获取用户（用户管理）
    public function getAllUser()
    {
        return Users::orderBy('user_id','desc')
                    ->paginate(10);
    }

    //删除指定用户
    public function delete(Request $request)
    {
        $this->validate($request,[
            'id'=>'required|numeric'
        ],[
            'required' => ':attribute为必填项',
            'numeric'=>':attribute必须为数值',
        ],[
            'id'=>'用户标识符'
        ]);

        if($request->get('id')==1){
            return response()->json([
                'code'=>422,
                'msg'=>'管理员账户不可以删除！'
            ]);
        }

        $user = Users::select(['user_id'])->find($request->get('id'));

        if($user){
            if($user->delete()){
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
                'msg'=>'目标用户不存在！'
            ]);
        }

    }

    //查找指定用户并JSON打印
    public function getUser($id)
    {
        $user = Users::find($id);
        if($user){
            return response()->json([
                'code'=>200,
                'msg'=>'查询成功！',
                'data'=>$user
            ]);
        }else{
            return response()->json([
                'code'=>422,
                'msg'=>'目标用户不存在！'
            ]);
        }
    }

    //更改用户
    public function edit_user(Request $request)
    {
        $this->validate($request,[
            'user_id'=>'required|numeric',
            'user_email'=>'required|max:50|email',
            'user_qq'=>'required|numeric|digits_between:5,10',
            'user_gender'=>'required|numeric|in:1,2',
            'user_password'=>'regex:[^[a-zA-Z0-9]+$]|between:6,16',
        ],[
            'required' => ':attribute为必填项',
            'max' => ':attribute最大长度为:max',
            'email' => ':attribute不符合规范',
            'numeric'=>':attribute必须为数值',
            'in'=>':attribute值有误',
            'digits_between'=>':attribute长度为:min到:max之间',
            'regex'=>':attribute应该为英文|数字组成',
            'between'=>':attribute长度为:min到:max之间',
        ],[
            'user_email'=>'邮箱',
            'user_qq'=>'QQ',
            'user_gender'=>'性别',
            'user_id'=>'用户标识',
            'user_password'=>'密码',
        ]);

        $user = Users::find($request->get("user_id"));

        if($user){
            if($user->user_name!=$request->get('user_name')){
                $find_user = Users::where('user_name',$request->get('user_name'));
                if($find_user){
                    return response()->json([
                        'code'=>422,
                        'msg'=>'目标用户名已经被别人使用了！'
                    ]);
                }else{
                    $user->user_name = $request->get('user_name');
                }
            }
            if($user->user_email!=$request->get("user_email")){
                $find_user = Users::where('user_email',$request->get('user_email'));
                if($find_user){
                    return response()->json([
                        'code'=>422,
                        'msg'=>'目标邮箱已经被别人使用了！'
                    ]);
                }else{
                    $user->user_email = $request->get('user_email');
                }
            }

            if($request->has("user_password")){
                $user->user_password = md5($request->get('user_password'));
                $user->remember_token = "";
            }

            $user->user_qq = $request->get("user_qq");
            $user->user_gender = $request->get("user_gender");
            if($user->save()){
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
                'msg'=>'目标用户不存在！'
            ]);
        }

    }

    //禁言\解禁用户
    public function gag(Request $request)
    {
        $this->validate($request,[
            'user_id'=>'required|numeric',
            'gag_id'=>'required|in:0,1|numeric',
        ],[
            'required' => ':attribute为必填项',
            'numeric'=>':attribute必须为数值',
            'in'=>':attribute值有误',
        ],[
            'user_id'=>'用户标识',
            'gag_id'=>'禁言标识',
        ]);

        $user = Users::select(['user_id','user_gag'])->find($request->get('user_id'));

        if($user){
            $gag = 0;
            $user->user_gag = $request->get('gag_id')==0 ? 1 : 0;
            if($user->save()){
                return response()->json([
                    'code'=>200,
                    'msg'=>'更新成功！',
                    'gag'=>$gag
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
                'msg'=>'不存在目标用户！'
            ]);
        }

    }
}