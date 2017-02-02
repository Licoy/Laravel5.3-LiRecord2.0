<?php
/**
 * Created by Licoy.
 * Date: 2017/1/15 0015
 * Time: 11:48
 */

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Site;
use Illuminate\Http\Request;

class SiteController extends Controller
{

    public static function site()
    {
        return Site::first();
    }

    public function seo(Request $request)
    {
        $this->validate($request,[
            'site_title'=>'required',
            'site_keywords'=>'required',
            'site_describe'=>'required',
        ],[
            'required' => ':attribute为必填项',
        ],[
            'site_title'=>'站点标题',
            'site_keywords'=>'站点关键字',
            'site_describe'=>'站点描述',
        ]);

        $site = Site::first();

        if($site){
            $site->title = $request->get('site_title');
            $site->keywords = $request->get('site_keywords');
            $site->describe = $request->get('site_describe');

            if($site->save()){
                return response()->json([
                    'code'=>200,
                    'msg'=>'更新成功！'
                ]);
            }else{
                return response()->json([
                    'code'=>422,
                    'msg'=>'更新失败'
                ]);
            }

        }else{
            return response()->json([
                'code'=>422,
                'msg'=>'站点信息异常，无法继续'
            ]);
        }

    }

    public function url(Request $request)
    {
        $this->validate($request,[
            'logo_url'=>'required',
            'ico_url'=>'required',
        ],[
            'required' => ':attribute为必填项',
        ],[
            'logo_url'=>'LOGO的链接',
            'ico_url'=>'ICO的链接',
        ]);

        $site = Site::first();

        if($site){
            $site->logo = $request->get('logo_url');
            $site->ico = $request->get('ico_url');

            if($site->save()){
                return response()->json([
                    'code'=>200,
                    'msg'=>'更新成功！'
                ]);
            }else{
                return response()->json([
                    'code'=>422,
                    'msg'=>'更新失败'
                ]);
            }

        }else{
            return response()->json([
                'code'=>422,
                'msg'=>'站点信息异常，无法继续'
            ]);
        }

    }

    public function footer(Request $request)
    {
        $this->validate($request,[
            'text'=>'required',
        ],[
            'required' => ':attribute为必填项',
        ],[
            'text'=>'底部内容',
        ]);

        $site = Site::first();

        if($site){
            $site->footer = $request->get('text');
            if($site->save()){
                return response()->json([
                    'code'=>200,
                    'msg'=>'更新成功！'
                ]);
            }else{
                return response()->json([
                    'code'=>422,
                    'msg'=>'更新失败'
                ]);
            }

        }else{
            return response()->json([
                'code'=>422,
                'msg'=>'站点信息异常，无法继续'
            ]);
        }

    }

}