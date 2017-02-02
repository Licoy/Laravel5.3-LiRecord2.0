@extends('layouts.app')
@section('title')发布公告@endsection
@section('style')
    <link rel="stylesheet" href="{{ url('css/my.css') }}">
@endsection
@section('content')
        <div class="container" id="main">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">发布公告</div>

                        <div class="alert alert-success">
                            <span>公告发布可以插入HTML与JavaScript代码，其JavaScript请尽量少使用！</span>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="POST" action="" id="NoticeForm">
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="title" class="col-md-1 control-label">标题</label>

                                    <div class="col-md-11">
                                        <input id="title" type="text" value="" class="form-control" name="title" required>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="noticeText" class="col-md-1 control-label">内容</label>

                                    <div class="col-md-11">
                                        <textarea id="noticeText" name="text" class="form-control col-md-6" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-11 col-md-offset-1">
                                        <br>
                                        <button type="button" class="btn btn-primary btn_send">发布</button>
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
    <script type="text/javascript" src="{{ url("js/admin/notice.js") }}"></script>
@endsection
