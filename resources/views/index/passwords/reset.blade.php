@extends('layouts.app')
@section('title')重置密码@endsection
@section('content')
<div class="container" id="main">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">重置密码</div>
                @if($errors->has('tips'))
                    <div class="alert alert-danger text-center">
                        {{ $errors->first('tips') }}
                    </div>
                @endif
                <div class="panel-body">
                    @if ($errors->has('success'))
                        <div class="alert alert-success text-center">
                            {{ $errors->first('success') }}
                        </div>
                    @elseif(isset($error))
                        <div class="alert alert-danger text-center">
                            {{ $error }}
                        </div>
                    @else

                    <form class="form-horizontal" role="form" method="POST" action="">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">邮箱</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">密码</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
                                <span class="help-block">
                                    <small>密码是由英文、数字组成的6-16位字符</small>
                                </span>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">确认密码</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    确认重置密码
                                </button>
                            </div>
                        </div>
                    </form>

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
