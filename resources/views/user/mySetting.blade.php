@extends('layouts.app')
@section('title')个人设置@endsection
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
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">个人设置</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="" id="MyInfoForm">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="id" class="col-md-4 control-label">ID</label>
                                <div class="col-md-6">
                                    <input id="id" type="text" name="user_id" class="form-control" value="{{ \App\Http\Controllers\User\UserController::user()->user_id }}" disabled required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">用户名</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" name="user_name" class="form-control" value="{{ \App\Http\Controllers\User\UserController::user()->user_name }}" disabled required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">邮箱</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="user_email" value="{{ \App\Http\Controllers\User\UserController::user()->user_email }}" required>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="qq" class="col-md-4 control-label">QQ</label>

                                <div class="col-md-6">
                                    <input id="qq" type="number" class="form-control" name="user_qq" value="{{ \App\Http\Controllers\User\UserController::user()->user_qq }}" required>

                                </div>
                            </div>

                            <div class="form-group ">
                                <label  class="col-md-4 control-label">性别</label>
                                <div class="col-md-6">
                                    <label class="radio-inline">
                                        <input type="radio"  value="1" name="user_gender" @if(\App\Http\Controllers\User\UserController::user()->user_gender==1)
                                        checked
                                                @endif
                                        required>男
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio"  value="2" name="user_gender" @if(\App\Http\Controllers\User\UserController::user()->user_gender==2)
                                        checked
                                               @endif required>女
                                    </label>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label  class="col-md-4 control-label">头像方式</label>
                                <div class="col-md-6">
                                    <label class="radio-inline">
                                        <input type="radio"  value="1" name="user_avatar" @if(\App\Http\Controllers\User\UserController::user()->user_avatar==1)
                                        checked
                                               @endif  required>Gravatar
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio"  value="2" name="user_avatar" @if(\App\Http\Controllers\User\UserController::user()->user_avatar==2)
                                        checked
                                               @endif required>QQ
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="button" class="btn btn-primary btn-saveMe">更新</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">密码修改</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="" id="updatePswdForm">

                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="password_old" class="col-md-4 control-label">旧密码</label>

                                <div class="col-md-6">
                                    <input id="password_old" type="password" class="form-control" value="" name="user_password_old" required>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="col-md-4 control-label">新密码</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" value="" name="user_password" required>
                                    <span class="help-block">
                                        <small>密码由英文、数字组成的6-16位字符</small>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="user_password_confirmation" class="col-md-4 control-label">确认密码</label>

                                <div class="col-md-6">
                                    <input id="user_password_confirmation" type="password" value="" class="form-control" name="user_password_confirmation" required>

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="button" class="btn btn-primary update_password">
                                        更新
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="{{ url('/js/user/update.js') }}"></script>
@endsection
