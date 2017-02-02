<?php
/**
 * Created by Licoy.
 * Date: 2017/1/13 0013
 * Time: 17:56
 */

namespace App\Http\Controllers\Index;


use App\Http\Controllers\Controller;
use App\Http\Controllers\UtilsController;
use App\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    public function get(Request $request)
    {
        if (UtilsController::isLogin()){
            return redirect('/');
        }else if(Cookie::has('remember_token')){
            $bool = $this->autoLogin(Cookie::get('remember_token'),$request);
            if($bool){
                return redirect('/');
            }
        }
        return view('index.login');
    }

    public function login(Request $request)
    {
        $this->validate($request,[
            'user_email'=>'required|email',
            'user_password'=>'required',
            'ValidateCode'=>'required',
        ],[
            'required' => ':attribute为必填项',
            'email' => ':attribute不符合规范',
        ],[
            'user_email'=>'邮箱',
            'user_password'=>'密码',
            'ValidateCode'=>'验证码'
        ]);

        if(!UtilsController::checkValidateCode($request->get('ValidateCode'))){
            return redirect()->back()->withErrors([
                'tips' => '验证码错误'
            ])->withInput();
        }

        $remember = $request->has('remember') ? true : false;
        if($user = $this->validateUser($remember,$request)){
            if($remember){
                $remember_token = bcrypt(md5($request->get('user_name').time().uniqid()));
                $cookie = Cookie::make('remember_token',$remember_token,(60*24*31),'/');
                $user->remember_token = $remember_token;
                $user->save();
                return redirect('/')->withCookie($cookie);
            }
            return redirect('/');
        }
        return redirect()->back()->withErrors([
            'tips' => '用户名或密码错误'
        ])->withInput();
    }

    protected function validateUser($remember,Request $request){
        $user = Users::where('user_email',$request->get('user_email'))->first();
        if($user){
            if($user->user_password == md5($request->get('user_password'))){
                $request->session()->put('user_id',$user->user_id);
                return $user;
            }
        }
        return false;

    }

    public function logout(Request $request)
    {
        Cookie::queue('remember_token', null , -1); // 销毁

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/login');
    }

    protected function autoLogin($token,Request $request)
    {
        if(trim($token)==""){
            return false;
        }
        $user = Users::where('remember_token',$token)->first();
        if($user){
            $request->session()->put('user_id',$user->user_id);
            return true;
        }else{
            return false;
        }
    }
}