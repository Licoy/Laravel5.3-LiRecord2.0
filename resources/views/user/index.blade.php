@extends('layouts.app')
@section('title')用户中心@endsection
@section('style')
    <link rel="stylesheet" href="{{ url('css/my.css') }}">
@endsection
@section('content')
    <div id="main" class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info" role="alert">
                    <i class="fa fa-volume-up"></i>
                    <span><a target="_blank" href="{{ url('/notice/'.\App\Http\Controllers\User\NoticeController::notice()->id) }}">{{ \App\Http\Controllers\User\NoticeController::notice()->title }}</a></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ \App\Http\Controllers\User\UserController::user()->user_name }}</div>
                    <div class="panel-body index_my">
                        <div class="avatar text-center">
                            <img src="{{ \App\Http\Controllers\UtilsController::avatar(\App\Http\Controllers\User\UserController::user()->user_avatar,\App\Http\Controllers\User\UserController::user()->user_email,\App\Http\Controllers\User\UserController::user()->user_qq) }}">
                        </div>
                        <hr>
                        <div class="text-center">
                            <span>ID：{{ \App\Http\Controllers\User\UserController::user()->user_id }}</span>
                        </div>
                        <hr>
                        <div class="text-center">
                            <span>用户名：{{ \App\Http\Controllers\User\UserController::user()->user_name }}</span>
                        </div>
                        <hr>
                        <div class="text-center">
                            <span>邮箱：{{ \App\Http\Controllers\User\UserController::user()->user_email }}</span>
                        </div>
                        <hr>
                        <div class="text-center">
                            <span>QQ：{{ \App\Http\Controllers\User\UserController::user()->user_qq }}</span>
                        </div>
                        <hr>
                        <div class="text-center">
                            <span>性别：{{ \App\Http\Controllers\UtilsController::gender(\App\Http\Controllers\User\UserController::user()->user_gender) }}</span>
                        </div>
                        <hr>
                        <div class="text-center">
                            <span>共计留言数量：{{ \App\Http\Controllers\User\CommentController::getUserCommentsCount(\App\Http\Controllers\User\UserController::user()->user_id) }}</span>
                        </div>
                        <hr>
                        <div class="text-center">
                            <span>注册时间：{{ \App\Http\Controllers\User\UserController::user()->created_at }}</span>
                        </div>
                        <hr>
                        <div class="text-center">
                            <span>上次修改时间：{{ \App\Http\Controllers\User\UserController::user()->updated_at }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection