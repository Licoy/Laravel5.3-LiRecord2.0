@extends('layouts.app')
@section('title')用户管理@endsection
@section('style')
    <link rel="stylesheet" href="{{ url('css/my.css') }}">
@endsection
@section('content')
        <div class="container" id="main">
            <div class="row" id="row_edit_user">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">修改用户</div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="POST" action="" id="userUpdateForm">
                                {{ csrf_field() }}

                                <input id="user_id" type="text" name="user_id" required hidden>


                                <div class="form-group">
                                    <label for="user_name" class="col-md-2 control-label">用户名</label>
                                    <div class="col-md-8">
                                        <input id="user_name" type="text" class="form-control" name="user_name" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="user_email" class="col-md-2 control-label">邮箱</label>
                                    <div class="col-md-8">
                                        <input id="user_email" type="text" class="form-control" name="user_email">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="user_qq" class="col-md-2 control-label">QQ</label>
                                    <div class="col-md-8">
                                        <input id="user_qq" type="text" class="form-control" name="user_qq">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label  class="col-md-2 control-label">性别</label>
                                    <div class="col-md-8">
                                        <label class="radio-inline">
                                            <input type="radio" id="user_gender_1"  value="1" name="user_gender"  required>男
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" id="user_gender_2" value="2" name="user_gender" required>女
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="user_password" class="col-md-2 control-label">密码</label>
                                    <div class="col-md-8">
                                        <input id="user_password" type="password" class="form-control" name="user_password" placeholder="不重置密码请留空，切勿填任何字符">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-2">
                                        <button type="button" class="btn btn-primary btn_user_update">更新</button>
                                        <button type="button" class="btn btn-danger canal">取消</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">用户管理</div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="POST" action="">
                                {{ csrf_field() }}
                                <div class="table-responsive">
                                    <table class="table table-bordered tb-bg">
                                        <thead>
                                        <tr class="text-center">
                                            <td>ID</td>
                                            <td>用户名</td>
                                            <td>邮箱</td>
                                            <td>QQ</td>
                                            <td>性别</td>
                                            <td>留言总数</td>
                                            <td>创建时间</td>
                                            <td>修改时间</td>
                                            <td>操作</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $v)
                                            <tr  class="text-center" id="user_tr_{{ $v['user_id'] }}">
                                                <td>{{ $v['user_id'] }}&nbsp;<img class="bq" src="{{ \App\Http\Controllers\UtilsController::avatar($v['user_avatar'],$v['user_email'],$v['user_qq']) }}" alt="{{ $v['user_name'] }}">
                                                    </td>
                                                <td>{{ $v['user_name'] }}</td>
                                                <td>{{ $v['user_email'] }}</td>
                                                <td>{{ $v['user_qq'] or "空" }}</td>
                                                <td>{{ \App\Http\Controllers\UtilsController::gender($v['user_gender']) }}
                                                    <span class="fa {{ \App\Http\Controllers\UtilsController::genderIdent($v['user_gender']) }}"></span></td>
                                                <td>{{ $v['commentCount'] }}</td>
                                                <td>{{ $v['created_at'] or "未检索到" }}</td>
                                                <td>{{ $v['updated_at'] or "未检索到" }}</td>
                                                <td>
                                                    <a href="javascript:void(0)" class="label label-info" id="user_edit_{{ $v['user_id'] }}"><i class="fa fa-edit"></i>编辑</a>
                                                    @if($v['user_gag']==0)
                                                        <a href="javascript:void(0)" class="label label-default" id="user_gag_off_{{ $v['user_id'] }}"><i class="fa fa-power-off"></i><span>禁言</span></a>
                                                    @else
                                                        <a href="javascript:void(0)" class="label label-warning" id="user_gag_on_{{ $v['user_id'] }}"><i class="fa fa-power-off"></i><span>解禁</span></a>
                                                    @endif
                                                    <a href="javascript:void(0)" class="label label-danger" id="user_delete_{{ $v['user_id'] }}"><i class="fa fa-trash"></i>删除</a>
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>

                                <div class="text-right">
                                    {{ $data->links() }}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
@endsection
@section('script')
    <script type="text/javascript" src="{{ url("js/public.js") }}"></script>
    <script type="text/javascript" src="{{ url("js/admin/users.js") }}"></script>
@endsection
