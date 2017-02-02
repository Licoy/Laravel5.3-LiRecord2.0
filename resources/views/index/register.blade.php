@extends('layouts.app')
@section('title')注册@endsection
@section('content')
<div class="container" id="main">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">注册</div>
                @if($errors->has('tips'))
                    <div class="alert alert-danger text-center">
                        {{ $errors->first('tips') }}
                    </div>
                @endif
                @if($errors->has('success'))
                    <div class="alert alert-success text-center">
                        {{ $errors->first('success') }}
                    </div>
                @endif
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('user_name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">用户名</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="user_name" value="{{ old('user_name') }}" required>

                                @if ($errors->has('user_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('user_email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">邮箱</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="user_email" value="{{ old('user_email') }}" required>

                                @if ($errors->has('user_email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user_email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('user_qq') ? ' has-error' : '' }}">
                            <label for="qq" class="col-md-4 control-label">QQ</label>

                            <div class="col-md-6">
                                <input id="qq" type="number" class="form-control" name="user_qq" value="{{ old('user_qq') }}" required>

                                @if ($errors->has('user_qq'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user_qq') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('user_gender') ? ' has-error' : '' }}">
                            <label  class="col-md-4 control-label">性别</label>
                            <div class="col-md-6">
                                <label class="radio-inline">
                                    <input type="radio"  value="1" name="user_gender" {{ old('user_gender')==1?'checked':'' }}  required checked>男
                                </label>
                                <label class="radio-inline">
                                    <input type="radio"  value="2" name="user_gender" {{ old('user_gender')==2?'checked':'' }} required>女
                                </label>
                                @if ($errors->has('user_gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user_gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('user_password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">密码</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" value="{{ old('user_password') }}" name="user_password" required>

                                @if ($errors->has('user_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="user_password_confirmation" class="col-md-4 control-label">确认密码</label>

                            <div class="col-md-6">
                                <input id="user_password_confirmation" type="password" value="{{ old('user_password_confirmation') }}" class="form-control" name="user_password_confirmation" required>
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
                                <button type="submit" class="btn btn-primary">
                                    注册
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
    <script type="text/javascript" src="{{ url('js/reglogin.js') }}"></script>
@endsection
