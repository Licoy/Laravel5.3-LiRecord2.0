<?php
/**
 * Created by Licoy.
 * Date: 2017/1/14 0014
 * Time: 17:46
 */

namespace App\Http\Middleware;


use App\Http\Controllers\User\UserController;
use Closure;

class Admin
{
    public function handle($request, Closure $next)
    {
        if(UserController::user()->user_id!=1){
            return redirect('error');
        }
        return $next($request);
    }

}