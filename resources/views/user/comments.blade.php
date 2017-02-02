@extends('layouts.app')
@section('title')留言管理@endsection
@section('style')
    <link rel="stylesheet" href="{{ url('css/my.css') }}">
@endsection
@section('content')
        <div class="container" id="main">
            <div class="row" id="row_edit_comment">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">修改内容</div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="POST" action="" id="commentUpdateForm">
                                {{ csrf_field() }}
                                <input type="text" name="id" id="edit_id" hidden>
                                <textarea id="edit_text" name="text" class="form-control col-md-6" rows="5" ></textarea>

                                <div class="form-group">
                                    <div class="col-md-10">
                                        <br>
                                        <button type="button" class="btn btn-primary btn_commentUpdate">
                                            更新
                                        </button>
                                        <button type="button" class="btn btn-warning canal">
                                            取消
                                        </button>
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
                        <div class="panel-heading">留言管理</div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="POST" action="">
                                {{ csrf_field() }}
                                <div class="table-responsive">
                                    <table class="table table-bordered tb-bg ">
                                        <thead>
                                        <tr class="text-center">
                                            <td>ID</td>
                                            <td>作者</td>
                                            <td>内容</td>
                                            <td>赞数</td>
                                            <td>IP</td>
                                            <td>时间</td>
                                            <td>操作</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $k=>$v)
                                            <tr class="text-center" id="comment_tr_{{ $v['id'] }}">
                                                <td>{{ $v['id'] }}
                                                    <img class="bq" src="{{ \App\Http\Controllers\UtilsController::avatar($v['userInfo']['user_avatar'],$v['userInfo']['user_email'],$v['userInfo']['user_qq']) }}" alt="{{ $v['userInfo']['user_name'] }}">
                                                    <span class="fa {{ \App\Http\Controllers\UtilsController::genderIdent($v['userInfo']['user_gender']) }}"></span></td>
                                                <td>{{ $v['userInfo']['user_name'] }}</td>
                                                <td id="comment_text_{{ $v['id'] }}">{{ mb_substr($v['text'],0,30) }}</td>
                                                <td>{{ $v['support'] }}</td>
                                                <td>{{ $v['ip'] }}</td>
                                                <td>{{ $v['updated_at'] }}</td>
                                                <td class="text-center">
                                                    <a href="javascript:void(0)" id="comment_edit_{{ $v['id'] }}" class="label label-info"><i class="fa fa-edit"></i>编辑</a>
                                                    <a href="javascript:void(0)" id="comment_delete_{{ $v['id'] }}" class="label label-danger"><i class="fa fa-trash"></i>删除</a>
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
    <script type="text/javascript" src="{{ url("js/admin/comment.js") }}"></script>
@endsection
