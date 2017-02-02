<?php
/**
 * Created by Licoy.
 * Date: 2017/1/22 0022
 * Time: 09:42
 */

namespace App\Http\Controllers\Index;


use App\Http\Controllers\Controller;
use App\Http\Controllers\User\SiteController;
use App\Site;
use App\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ResetPasswordController extends Controller
{
    //访问
    public function get()
    {
        return view('index.passwords.email');
    }

    //提交验证请求
    public function post(Request $request)
    {
        $this->validate($request,[
            'email'=>'required|email'
        ],[
            'required'=>':attribute为必填项',
            'email'=>':attribute必须为电子邮箱格式'
        ],[
            'email'=>'邮箱'
        ]);

        $user  = Users::where('user_email',$request->get('email'))->first(['user_id','user_name']);


        if($user){
            $token = md5(Crypt::encrypt($request->get('email').time().uniqid()));
            $reset = DB::table('password_resets')->where('email',$request->get('email'))->first();
            if($reset){
                DB::table('password_resets')->where('email',$request->get('email'))->update([
                    'token'=>$token,
                    'created_at'=>date("Y-m-d H:i:s",time())
                ]);
            }else{
                DB::table('password_resets')->insert([
                    'email'=>$request->get('email'),
                    'token'=>$token,
                    'created_at'=>date("Y-m-d H:i:s",time())
                ]);
            }
            //发送邮件
                $email = $request->get('email');
                $data['name'] = $user->user_name;
                $data['token'] = $token;
                $data['time'] = date('Y-m-d H:i:s',time());
                $flag = Mail::send('index.passwords.send',['data'=>$data],function($message) use($email){
                    $message->from('licoycn@163.com',SiteController::site()->title)
                            ->subject('请重置您的密码 - '.SiteController::site()->title)
                            ->to($email);
                });

            return redirect()->back()->withErrors([
                'success' => '邮件已经发送，请注意查收~'
            ]);

        }else{
            return redirect()->back()->withErrors([
                'tips' => '目标邮箱用户不存在'
            ]);
        }

    }

    //重置密码访问验证
    public function reset_get($token)
    {
        $email = DB::table('password_resets')->where('token',$token)->first(['email']);
        if($email){
            return view('index.passwords.reset',['token'=>$token]);
        }else{
            return view('index.passwords.reset',['error'=>'不存在指定的重置密钥','token'=>$token]);
        }
    }

    //重置密码提交验证
    public function reset_post(Request $request)
    {
        $this->validate($request,[
            'token'=>'required',
            'email'=>'required|email',
            'password'=>'required|regex:[^[a-zA-Z0-9]+$]|between:6,16|confirmed:password_confirmation',
        ],[
            'required' => ':attribute为必填项',
            'email' => ':attribute必须为电子邮箱格式',
            'between'=>':attribute长度为:min到:max之间',
            'confirmed'=>':attribute两次输入不一致',
            'regex'=>':attribute应该为英文|数字组成',
        ],[
            'email'=>'邮箱',
            'password'=>'密码'
        ]);

        $token = DB::table('password_resets')->where('token',$request->get('token'))->first(['email']);

        if($token){
            if($token->email!=$request->get('email')){
                return redirect()->back()->withErrors([
                    'tips'=>'密钥与邮箱不匹配！'
                ])->withInput();
            }

            $user = Users::where('user_email',$request->get('email'))->first();

            if($user){
                $user->user_password = md5($request->get('password'));
                if($user->save()){

                    DB::table('password_resets')->where('token',$request->get('token'))->delete();

                    return redirect()->back()->withErrors([
                        'success'=>'重置成功！请返回登录~'
                    ]);
                }else{
                    return redirect()->back()->withErrors([
                        'tips'=>'重置密码失败！请联系管理员！'
                    ])->withInput();
                }
            }else{
                return redirect()->back()->withErrors([
                    'tips'=>'不存在目标用户'
                ])->withInput();
            }
        }else{
            return redirect()->back()->withErrors([
                'tips'=>'不存在传递的密钥！'
            ])->withInput();
        }

    }
}