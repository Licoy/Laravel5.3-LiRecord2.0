@extends('layouts.app')
@section('title')关于@endsection
@section('style')
    <style>
        .bd-reward-stl {
            font-family: "microsoft yahei";
            text-align: center;
            background: #f1f1f1;
            padding: 10px 0;
            color: #666;
            margin: 20px auto;
            width: 90%;
        }
        #bdRewardBtn span {
            display: inline-block;
            width: 50px;
            height: 50px;
            border-radius: 100%;
            line-height: 58px;
            color: #fff;
            font: 400 25px/50px 'microsoft yahei';
            background: #FEC22C;
        }
        #bdRewardBtn {
            border: 0;
            outline: 0;
            border-radius: 100%;
            padding: 0;
            margin: 0;
        }
    </style>
@endsection
@section('content')
    <div id="main" class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><i class="fa fa-bookmark-o"></i>&nbsp;关于</div>
                    <div class="panel-body">
                        <div style="font-size: 18px;text-indent: 2em;font-weight: 100">
                            <h3>关于项目</h3>
                            <p>LiRecord留言板系统由 <a href="https://www.licoy.cn" target="_blank" title="憧憬点滴记忆">憧憬Licoy</a> 开发并发布，此项目受 <a href="https://github.com/Licoy/laravel5.3-LiRecord2.0/blob/master/LICENSE" target="_blank" title="GPL V3">GPL V3</a> 协议保护，请自觉遵守协议规则。</p>
                            <h3>开源地址</h3>
                            <p>GitHub: <a href="https://github.com/Licoy/laravel5.3-LiRecord2.0" target="_blank" title="GitHub">laravel5.3-LiRecord2.0</a></p>
                            <p>OsGit: <a href="https://git.oschina.net/licoy/LiRecord" target="_blank" title="OsGit">LiRecord</a> </p>
                            <h3>关于作者</h3>
                            <p>个人博客： <a href="https://www.licoy.cn" target="_blank" title="憧憬点滴记忆">憧憬点滴记忆</a> </p>
                            <p>邮箱： licoy520@qq.com </p>
                            <p>后语： 感谢您对本项目的支持与使用，如果本项目有什么不足或者可改进的地方你可以到开发者BLOG反馈建议或者给我发送Email，我将会在第一时间回复你。如果本项目对你有帮助，可以打赏给开发者一杯咖啡。最后再次感谢你对本项目的支持！ </p>

                            <div class="bd-reward-stl" ><button id="bdRewardBtn" onclick="PaymentUtils.show();"><span>赏</span></button></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="{{ url('/js/shang.js') }}"></script>
@endsection