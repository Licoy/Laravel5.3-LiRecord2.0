@extends('layouts.app')
@section('title')登录@endsection
@section('content')
<div class="container" id="main">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">登录</div>
                @if($errors->has('tips'))
                    <div class="alert alert-danger text-center">
                        {{ $errors->first('tips') }}
                    </div>
                @endif
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('user_email') ? ' has-error' : '' }}">
                            <label for="user_email" class="col-md-4 control-label">邮箱</label>

                            <div class="col-md-6">
                                <input id="user_email" type="email" class="form-control" name="user_email" value="{{ old('user_email') }}" required autofocus>

                                @if ($errors->has('user_email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user_email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('user_password') ? ' has-error' : '' }}">
                            <label for="user_password" class="col-md-4 control-label">密码</label>

                            <div class="col-md-6">
                                <input id="user_password" type="password" class="form-control" name="user_password" value="{{ old('user_password') }}" required>

                                @if ($errors->has('user_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ValidateCode" class="col-md-4 control-label"></label>
                            <div class="col-md-6">
                                <div id="checkCode" class="cursor-pointer">
                                    <img src="{{ url('validateCode') }}" alt="验证码" title="点击更换验证码">
                                    <small>看不清？点击图片更换一张</small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('ValidateCode') ? ' has-error' : '' }}">

                            <label for="ValidateCode" class="col-md-4 control-label">验证码</label>

                            <div class="col-md-6">

                                <input id="ValidateCode" type="text" class="form-control" name="ValidateCode" value="{{ old('ValidateCode') }}" required>

                                @if ($errors->has('ValidateCode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ValidateCode') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> 记住我
                                    </label>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    登录
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/email') }}">
                                    忘记密码？
                                </a>
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
<script type="text/javascript" src="{{ url('js/reglogin.js') }}"></script>
@endsection
