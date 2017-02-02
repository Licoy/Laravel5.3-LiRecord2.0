<?php
/**
 * Created by Licoy.
 * Date: 2017/1/13 0013
 * Time: 16:04
 */

namespace App\Http\Controllers\Index;


use App\Http\Controllers\Controller;
use App\Http\Controllers\UtilsController;
use App\Users;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request,[
           'user_name'=>'required|alpha_num|between:6,16',
            'user_email'=>'required|max:50|email',
            'user_qq'=>'required|numeric|digits_between:5,10',
            'user_gender'=>'required|numeric|in:1,2',
            'user_password'=>'required|regex:[^[a-zA-Z0-9]+$]|between:6,16|confirmed:user_password_confirmation',
            'ValidateCode'=>'required'
        ],[
            'required' => ':attribute为必填项',
            'min' => ':attribute最小长度为:min',
            'max' => ':attribute最大长度为:max',
            'alpha_num' => ':attribute应该为英文|数字|汉字',
            'alpha_dash' => '',
            'email' => ':attribute不符合规范',
            'numeric'=>':attribute必须为数值',
            'digits_between'=>':attribute长度为:min到:max之间',
            'between'=>':attribute长度为:min到:max之间',
            'in'=>':attribute值有误',
            'confirmed'=>':attribute两次输入不一致',
            'regex'=>':attribute应该为英文|数字组成',
        ],[
            'user_name'=>'用户名',
            'user_email'=>'邮箱',
            'user_qq'=>'QQ',
            'user_gender'=>'性别',
            'user_password'=>'密码',
            'ValidateCode'=>'验证码'
        ]);

        if(!UtilsController::checkValidateCode($request->get('ValidateCode'))){
            return redirect()->back()->withErrors([
                'tips' => '验证码错误'
            ])->withInput();
        }

        $user = Users::where('user_name',$request->get('user_name'))->first();
        if(!$user){
            $user = Users::where('user_email',$request->get('user_email'))->first();
            if(!$user){
                $user = new Users();
                $user->user_name = $request->get('user_name');
                $user->user_email = $request->get('user_email');
                $user->user_qq = $request->get('user_qq');
                $user->user_gender = $request->get('user_gender');
                $user->user_password = md5($request->get('user_password'));
                if($user->save()){
                    return redirect()->back()->withErrors([
                        'success'=>'注册成功！请返回登录'
                    ]);
                }else{
                    return redirect()->back()->withErrors([
                        'tips'=>'注册失败！'
                    ])->withInput();
                }
            }else{
                //已经有同邮箱用户
                return redirect()->back()->withErrors([
                   'tips'=>'已经存在同邮箱用户，换个邮箱试试~'
                ])->withInput();
            }
        }else{
            //已经有同用户名用户
            return redirect()->back()->withErrors([
                'tips'=>'已经存在同用户名用户，换个用户名试试吧~'
            ])->withInput();
        }
        /*$data = $request->all();
        */
    }

    public function get()
    {
        if (UtilsController::isLogin()){
            return redirect('/');
        }
        return view('index.register');
    }
}