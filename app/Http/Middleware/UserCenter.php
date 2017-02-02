<?php
/**
 * Created by Licoy.
 * Date: 2017/1/14 0014
 * Time: 11:23
 */

namespace App\Http\Middleware;

use App\Http\Controllers\UtilsController;
use Closure;

class UserCenter
{
    public function handle($request, Closure $next)
    {
        if(!UtilsController::isLogin()){
            return redirect('/login');
        }
        return $next($request);
    }

}