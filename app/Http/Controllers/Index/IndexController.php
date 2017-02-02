<?php
/**
 * Created by Licoy.
 * Date: 2017/1/13 0013
 * Time: 15:37
 */

namespace App\Http\Controllers\Index;


use App\Comments;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User\CommentController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\UtilsController;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function get($page=1)
    {
        $data['ex'] = UtilsController::expression();
        $data['page'] = $page;
        return view('index.index',[
            'data'=>$data
        ]);
    }


}