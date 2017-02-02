@extends('layouts.app')
@section('title')站点设置@endsection
@section('style')
    <link rel="stylesheet" href="{{ url('css/my.css') }}">
@endsection
@section('content')
    <div id="main" class="container">

        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">SEO设置</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="" id="siteSeoForm">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="site_title" class="col-md-2 control-label">标题</label>
                                <div class="col-md-10">
                                    <input id="site_title" type="text" name="site_title" class="form-control" value="{{ \App\Http\Controllers\User\SiteController::site()->title }}" required>
                                    <span class="help-block">
                                        <small>站点Title：一般不超过80个字符。</small>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="site_keywords" class="col-md-2 control-label">关键字</label>
                                <div class="col-md-10">
                                    <input id="site_keywords" type="text" name="site_keywords" class="form-control" value="{{ \App\Http\Controllers\User\SiteController::site()->keywords }}" required>
                                    <span class="help-block">
                                        <small>站点关键字：多个关键词之间请使用“,”进行分隔，一般不超过100个字符。</small>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="site_describe" class="col-md-2 control-label">描述</label>

                                <div class="col-md-10">
                                    <input id="site_describe" type="text" name="site_describe" class="form-control" value="{{ \App\Http\Controllers\User\SiteController::site()->describe }}" required>
                                    <span class="help-block">
                                        <small>网站的描述信息：一般不超过200个字符。</small>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-10 col-md-offset-2">
                                    <button type="button" class="btn btn-primary btn_seo">
                                        更新
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">基本设置</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="" id="siteUrlForm">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="logo_url" class="col-md-2 control-label">LOGO</label>

                                <div class="col-md-10">
                                    <input id="logo_url" type="text" name="logo_url"  class="form-control" value="{{ \App\Http\Controllers\User\SiteController::site()->logo }}" required>
                                    <span class="help-block">
                                        <small>logo的url地址，可使用绝对或相对路径</small>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="ico_url" class="col-md-2 control-label">ICO</label>

                                <div class="col-md-10">
                                    <input id="ico_url" type="text" name="ico_url" value="{{ \App\Http\Controllers\User\SiteController::site()->ico }}" class="form-control" required>
                                    <span class="help-block">
                                        <small>ico的url地址，可使用绝对或相对路径</small>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-10 col-md-offset-2">
                                    <button type="button" class="btn btn-primary btn_url">
                                        更新
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
                    <div class="panel-heading">底部设置</div>
                    <div class=" alert-success">
                        <span>底部设置可以插入HTML与JavaScript代码，其JavaScript请尽量少使用！</span>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="" id="siteFooterForm">
                            {{ csrf_field() }}
                            <textarea class="form-control col-md-6" name="text" rows="5" >{!! \App\Http\Controllers\User\SiteController::site()->footer !!}</textarea>

                            <div class="form-group">
                                <div class="col-md-10">
                                    <br>
                                    <button type="button" class="btn btn-primary btn_footer">
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
    <script type="text/javascript" src="{{ url("js/admin/site.js") }}"></script>
@endsection
