@extends('layouts.app')
@section('title')找回密码@endsection
<!-- Main Content -->
@section('content')
<div class="container" id="main">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">找回密码</div>
                @if($errors->has('tips'))
                    <div class="alert alert-danger text-center">
                        {{ $errors->first('tips') }}
                    </div>
                @elseif($errors->has('success'))
                    <div class="alert alert-success text-center">
                        {{ $errors->first('success') }}
                    </div>
                @endif
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">邮箱</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    发送邮件找回密码
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
