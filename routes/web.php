<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/',[
    'as'=>'index',
    'uses'=>'Index\IndexController@get'
]);

Route::group(['middleware'=>['userCenter'],'prefix'=>'u'],function (){
    Route::get('/','Index\Controllers@index');
    Route::get('/mySetting','Index\Controllers@mySetting');
});

Route::group(['middleware'=>['userCenter','admin'],'prefix'=>'admin'],function (){
    //访问
    Route::get('/comments','Index\Controllers@comments');
    Route::get('/users','Index\Controllers@users');
    Route::get('/notice','Index\Controllers@notice');
    Route::get('/siteSetting','Index\Controllers@siteSetting');
    //公告
    Route::post('/ajax/notice','User\NoticeController@add');
    //站点
    Route::post('/ajax/site/seo','User\SiteController@seo');
    Route::post('/ajax/site/url','User\SiteController@url');
    Route::post('/ajax/site/footer','User\SiteController@footer');
    //评论
    Route::post('/ajax/comment/delete','User\CommentController@delete');
    Route::post('/ajax/comment/get/{id}','User\CommentController@getCommentById');
    Route::post('/ajax/comment/update','User\CommentController@update');
    //用户
    Route::post('/ajax/user/delete','User\UserController@delete');
    Route::post('/ajax/user/getUser/{id}','User\UserController@getUser');
    Route::post('/ajax/user/update','User\UserController@edit_user');
    Route::post('/ajax/user/gag','User\UserController@gag');
});

Route::group(['middleware'=>['ajax','userCenter'],'prefix'=>'ajax'],function (){
    Route::post('/comment/create','User\CommentController@create');
    Route::post('/comment/support','User\SupportController@add');
    Route::post('/user/update','User\UserController@update');
    Route::post('/user/password','User\UserController@password');
});

Route::group(['middleware'=>'ajax','prefix'=>'get'],function (){
    Route::any('/comments','User\CommentController@getData');
});

//登录
Route::get('/login', 'Index\LoginController@get' );
Route::post('/login', 'Index\LoginController@login');
Route::get('/logout', 'Index\LoginController@logout');
//注册
Route::get('/register', 'Index\RegisterController@get');
Route::post('/register', 'Index\RegisterController@register');

//忘记密码
Route::get('/password/email','Index\ResetPasswordController@get');
Route::post('/password/email','Index\ResetPasswordController@post');

//重置密码
Route::get('/password/reset/{token}', 'Index\ResetPasswordController@reset_get');
Route::post('/password/reset/{token}', 'Index\ResetPasswordController@reset_post');

//验证码
Route::get('/validateCode','UtilsController@validateCode');

//公告
Route::get('/notice/{id}','User\NoticeController@get')->where('id','[0-9]+');
