<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ \App\Http\Controllers\User\SiteController::site()->title }}</title>
    <meta name="description" content="{{ \App\Http\Controllers\User\SiteController::site()->describe }}" />
    <meta name="keywords" content="{{ \App\Http\Controllers\User\SiteController::site()->keywords }}" />
    <link rel="shortcut icon" href="{{ \App\Http\Controllers\User\SiteController::site()->ico }}">
    <!-- Styles -->
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/x0popup.min.css') }}" rel="stylesheet">
    @yield('style')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ \App\Http\Controllers\User\SiteController::site()->logo }}" alt="logo" id="logo">
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (!\App\Http\Controllers\UtilsController::isLogin())
                            <li><a href="{{ url('/login') }}"><i class="fa fa-user"></i>&nbsp;登录</a></li>
                            <li><a href="{{ url('/register') }}"><i class="fa fa-user-plus"></i>&nbsp;注册</a></li>
                        @else
                            {{--菜单--}}
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <i class="fa fa-bicycle"></i>&nbsp;用户导航 <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/u') }}"><i class="fa fa-user-o"></i>&nbsp;用户中心</a></li>
                                    <li><a href="{{ url('/u/mySetting') }}"><i class="fa fa-cog"></i>&nbsp;个人设置</a></li>
                                    @if(\App\Http\Controllers\User\UserController::user()->user_id==1)
                                        <li><a href="{{ url('/admin/comments') }}"><i class="fa fa-comments-o"></i>&nbsp;留言管理</a></li>
                                        <li><a href="{{ url('/admin/users') }}"><i class="fa fa-users"></i>&nbsp;用户管理</a></li>
                                        <li><a href="{{ url('/admin/notice') }}"><i class="fa fa-volume-up"></i>&nbsp;发布公告</a></li>
                                        <li><a href="{{ url('/admin/siteSetting') }}"><i class="fa fa-road"></i>&nbsp;站点设置</a></li>
                                    @endif
                                </ul>
                            </li>
                            {{--个人--}}
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                   <i class="fa fa-user-o"></i>
                                    {{ \App\Http\Controllers\User\UserController::user()->user_name }} <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li class="user-li-head"><span>
                                    <img class="img-circle nav-user-img-xiala center-block" src="{{ \App\Http\Controllers\UtilsController::avatar(\App\Http\Controllers\User\UserController::user()->user_avatar,\App\Http\Controllers\User\UserController::user()->user_email,\App\Http\Controllers\User\UserController::user()->user_qq) }}" /></span>
                                        <p></p>
                                        <p class="text-center"><span>id ：{{ \App\Http\Controllers\User\UserController::user()->user_id }} <span class="fa {{ \App\Http\Controllers\UtilsController::genderIdent(\App\Http\Controllers\User\UserController::user()->user_gender) }}"></span></span></p>
                                        <p class="text-center"><span>{{ \App\Http\Controllers\User\UserController::user()->user_email }}</span> </p>
                                    </li>
                                    <li style="padding: 10px 20px; padding-bottom: 20px">

                                        <div class="pull-left">
                                            <a href="{{ url('/u') }}" class="btn btn-sm btn-success">资料</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="{{ url('/logout') }}" class="btn btn-sm btn-danger">注销</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script type="text/javascript" src="{{ url('/js/app.js') }}"></script>
    <script type="text/javascript" src="{{ url('/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('/js/x0popup.min.js') }}"></script>
    @yield('script')
<footer>
    <div class="container">
        {!! \App\Http\Controllers\User\SiteController::site()->footer !!}
    </div>
</footer>
</body>
</html>
