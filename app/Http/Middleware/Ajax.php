<?php
/**
 * Created by Licoy.
 * Date: 2017/1/15 0015
 * Time: 18:44
 */
namespace App\Http\Middleware;
use Closure;
class Ajax
{
    public function handle($request, Closure $next)
    {
        if(!$request->ajax()){
            return response()->json([
                'text'=>'非法请求'
            ])->header('status',422);
        }
        return $next($request);
    }
}