<?php
/**
 * Created by Licoy.
 * Date: 2017/1/13 0013
 * Time: 14:58
 */

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
include app_path('Http/ValidateCode.php');

class UtilsController extends Controller
{
    //表情输出
    public static function expression()
    {
        $path = public_path('img/b');
        $re = scandir($path);
        return $re;
    }

    //是否登录
    public static function isLogin()
    {
        if(Session::get('user_id')){
            return true;
        }else{
            return false;
        }
    }

    //获取验证码
    public function validateCode(Request $request)
    {
        $v = new ValidateCode();
        $v->doimg();
        $request->session()->put('validateCode',$v->getCode());
    }

    //验证验证码
    public static function checkValidateCode($value)
    {
        if(Session::has('validateCode')){
            if(Session::get('validateCode')==strtolower($value)){
                return true;
            }
        }
        return false;
    }

    //输出性别
    public static function gender($n)
    {
        if($n==1){
            return "男";
        }else if($n==2){
            return "女";
        }else{
            return "阴阳人";
        }
    }

    //输出表情代码
    public static function textExpressionMatch($text)
    {
        $b = array(
            '[:1.png:]'=>url('/img/b/1.png'),
            '[:2.png:]'=>url('/img/b/2.png'),
            '[:3.png:]'=>url('/img/b/3.png'),
            '[:4.png:]'=>url('/img/b/4.png'),
            '[:5.png:]'=>url('/img/b/5.png'),
            '[:6.png:]'=>url('/img/b/6.png'),
            '[:7.png:]'=>url('/img/b/7.png'),
            '[:8.png:]'=>url('/img/b/8.png'),
            '[:9.png:]'=>url('/img/b/9.png'),
            '[:10.png:]'=>url('/img/b/10.png'),
            '[:11.png:]'=>url('/img/b/11.png'),
            '[:12.png:]'=>url('/img/b/12.png'),
            '[:13.png:]'=>url('/img/b/13.png'),
            '[:14.png:]'=>url('/img/b/14.png'),
            '[:15.png:]'=>url('/img/b/15.png'),
            '[:16.png:]'=>url('/img/b/16.png'),
            '[:17.png:]'=>url('/img/b/17.png'),
            '[:18.png:]'=>url('/img/b/18.png'),
            '[:19.png:]'=>url('/img/b/19.png'),
            '[:20.png:]'=>url('/img/b/20.png'),
            '[:21.png:]'=>url('/img/b/21.png'),
            '[:22.png:]'=>url('/img/b/22.png'),
            '[:23.png:]'=>url('/img/b/23.png'),
            '[:24.png:]'=>url('/img/b/24.png'),
            '[:25.png:]'=>url('/img/b/25.png'),
            '[:26.png:]'=>url('/img/b/26.png'),
            '[:27.png:]'=>url('/img/b/27.png'),
            '[:28.png:]'=>url('/img/b/28.png'),
            '[:29.png:]'=>url('/img/b/29.png'),
            '[:30.png:]'=>url('/img/b/30.png'),
            '[:31.png:]'=>url('/img/b/31.png'),
            '[:32.png:]'=>url('/img/b/32.png'),
            '[:33.png:]'=>url('/img/b/33.png'),
            '[:34.png:]'=>url('/img/b/34.png'),
            '[:35.png:]'=>url('/img/b/35.png'),
            '[:36.png:]'=>url('/img/b/36.png'),
            '[:37.png:]'=>url('/img/b/37.png'),
            '[:38.png:]'=>url('/img/b/38.png'),
            '[:39.png:]'=>url('/img/b/39.png'),
            '[:40.png:]'=>url('/img/b/40.png'),
            '[:41.png:]'=>url('/img/b/41.png'),
            '[:42.png:]'=>url('/img/b/42.png'),
        );
        foreach($b as $k=>$v){
            $text = str_replace($k,'<img class="ex_b" src="'.$v.'">',$text);
        }
        return $text;
    }

    //输出头像
    public static function avatar($id,$email,$qq)
    {
        if($id==2){
            if($qq==""){
                return "//q.qlogo.cn/headimg_dl?bs=qq&dst_uin=0&spec=100";
            }else{
                return "//q.qlogo.cn/headimg_dl?bs=qq&dst_uin={$qq}&spec=100";
            }

        }
        return "//secure.gravatar.com/avatar/".md5($email);
    }

    //输出头像标识
    public static function genderIdent($gender)
    {
        if($gender==1){
            return " fa-mars";
        }else if($gender==2){
            return " fa-venus";
        }else{
            return " fa-venus-mars";
        }
    }


}