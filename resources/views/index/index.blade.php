@extends('layouts.app')
@section('title')首页@endsection
@section('content')
    <div class="container" id="main">
        <div class="notice">
            <i class="fa fa-volume-up"></i>
            <a target="_blank" href="{{ url('/notice/'.\App\Http\Controllers\User\NoticeController::notice()->id) }}">{{ \App\Http\Controllers\User\NoticeController::notice()->title }}</a>
        </div>
        <!--留言区域-->
        <div id="edit">
            <div class="edit">
                <form action="" class="form" method="post" id="SendForm">
                    {{ csrf_field() }}
                    <div class="form-group">
                        @if(\App\Http\Controllers\UtilsController::isLogin())
                            @if(\App\Http\Controllers\User\UserController::user()->user_gag==1)
                            <label for="text"><i class="fa fa-bolt"></i>
                                <span class="display-inline cursor-pointer font-weight-400">你已经被禁言了，若需发言请联系管理员进行解禁操作</span>
                            </label>
                            <textarea class="form-control" disabled name="text" id="text" rows="5"></textarea>
                            @else
                                <label for="text"><i class="fa fa-bolt"></i>
                                <span class="display-inline cursor-pointer font-weight-400">请在下方输入你想要说的话，你还可以输入<span class="remaining_number">255</span>个字符</span>
                            </label>
                            <textarea class="form-control" name="text" id="text" rows="5"></textarea>
                            @endif
                        @else
                            <label for="text"><i class="fa fa-bolt"></i>
                                <span class="display-inline cursor-pointer font-weight-400">请点击右上方的登录进行会话</span>
                            </label>
                            <textarea class="form-control" disabled name="text" id="text" rows="5"></textarea>
                        @endif
                    </div>
                    <div class="b cursor-pointer">
                        @include('utils.expression')
                    </div>
                    <div class="utils float-left">
                        @if(\App\Http\Controllers\UtilsController::isLogin())
                            <a href="javascript:LiRecord.Utils.e()" class="label-info">表情</a>
                            <a href="javascript:LiRecord.Utils.sing()" class="label-danger">签到</a>
                        @endif
                    </div>
                    <div class="form-group text-right float-right">
                        @if(\App\Http\Controllers\UtilsController::isLogin())
                            @if(\App\Http\Controllers\User\UserController::user()->user_gag==1)
                                <input type="button" class="btn btn-info" disabled value="禁言中...">
                            @else
                                <input type="button" class="btn btn-info seed_comment" value="提交留言">
                            @endif

                        @else
                            <input type="button" disabled class="btn btn-info" value="登录后发言">
                        @endif
                    </div>
                    <div class="clear"></div>
                </form>
            </div>
        </div>
        <!--留言列表-->
        <div id="comments">
            <div class="circle-loader">
                <div class="circle-line">
                    <div class="circle circle-blue"></div>
                    <div class="circle circle-blue"></div>
                    <div class="circle circle-blue"></div>
                </div>
                <div class="circle-line">
                    <div class="circle circle-yellow"></div>
                    <div class="circle circle-yellow"></div>
                    <div class="circle circle-yellow"></div>
                </div>
                <div class="circle-line">
                    <div class="circle circle-red"></div>
                    <div class="circle circle-red"></div>
                    <div class="circle circle-red"></div>
                </div>
                <div class="circle-line">
                    <div class="circle circle-green"></div>
                    <div class="circle circle-green"></div>
                    <div class="circle circle-green"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="{{ url('/js/index.js') }}"></script>
@endsection