<!--提示-->
<div class="tips">
    <span><i class="fa fa-leaf"></i>&nbsp;一共有<b class="comment-count">{{ $data['commentCount'] }}</b>条留言，当前为第<b class="page-now-number">{{ $data['pageNumber'] }}</b>页</span>
</div>
<!--列表-->
<div class="comments-list">
    @foreach($data['comments'] as $k=>$v)
        <div id="comments-{{ $v['id'] }}">
            <div class="avatar float-left">
                <img class="img-circle" src="{{ \App\Http\Controllers\UtilsController::avatar($v['userInfo']['user_avatar'],$v['userInfo']['user_email'],$v['userInfo']['user_qq']) }}" title="admin" alt="admin">
            </div>
            <div class="username float-left">{{ $v['userInfo']['user_name'] }}</div>
            <div class="issue-time float-right"><i class="fa fa-clock-o"></i>&nbsp;<span>{{ $v['created_at'] }}</span></div>
            @if($v['user']==1)
                <div class="administrator float-left"><span>管理员</span></div>
            @endif
            <div class="gender float-left"><span class="fa {{ \App\Http\Controllers\UtilsController::genderIdent($v['userInfo']['user_gender']) }}"></span></div>
            @include('utils.vip')
            <div class="clear"></div>
            <p class="comments-text">{!! \App\Http\Controllers\UtilsController::textExpressionMatch($v['text']) !!}</p>
            <div class="info text-right">
                <a class="reply cursor-pointer hover-default reply_tips_off" href="javascript:void(0)"><i class="fa fa-comments-o"></i>&nbsp;<span>回复</span></a>
                <a class="super cursor-pointer hover-default @if(\App\Http\Controllers\User\SupportController::is(\Illuminate\Support\Facades\Session::get('user_id'),$v['id'])) is @endif" id="support_{{ $v['id'] }}"><i class="fa fa-thumbs-o-up"></i>&nbsp;<span>{{ $v['support'] }}</span></a>
            </div>
            <div class="edit_div"></div>
            @foreach($v['children'] as $k2=>$v2)
                <div id="comments-{{ $v2['id'] }}" class="comments-child">
                    <div class="avatar float-left">
                        <img class="img-circle" src="{{ \App\Http\Controllers\UtilsController::avatar($v2['userInfo']['user_avatar'],$v2['userInfo']['user_email'],$v2['userInfo']['user_qq']) }}" title="admin" alt="admin">
                    </div>
                    <div class="username float-left">{{ $v2['userInfo']['user_name'] }}</div>
                    <div class="issue-time float-right"><i class="fa fa-clock-o"></i>&nbsp;<span>{{ $v2['created_at'] }}</span></div>
                    @if($v2['user']==1)
                        <div class="administrator float-left"><span>管理员</span></div>
                    @endif
                    <div class="gender float-left"><span class="fa {{ \App\Http\Controllers\UtilsController::genderIdent($v2['userInfo']['user_gender']) }}"></span></div>
                    @include('utils.vip2')
                    <div class="clear"></div>
                    <p class="comments-text">{!! \App\Http\Controllers\UtilsController::textExpressionMatch($v2['text']) !!}</p>
                    <div class="info text-right">
                        <a class="super cursor-pointer hover-default @if(\App\Http\Controllers\User\SupportController::is(\Illuminate\Support\Facades\Session::get('user_id'),$v2['id'])) is @endif" id="support_{{ $v2['id'] }}"><i class="fa fa-thumbs-o-up"></i>&nbsp;<span >{{ $v2['support'] }}</span></a>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
</div>
<!--分页-->
<div class="page-split text-right">
    <ul class="pagination">
        {{ $data['comments']->links() }}
    </ul>
</div>
<script type="text/javascript" src="{{ url('js/jquery.pjax.js') }}"></script>
<script type="text/javascript">
    var NowReplyObject = null;
    $(function () {

        $("[class*=reply_tips_]").click(function () {
            @if(\App\Http\Controllers\UtilsController::isLogin())
            var parent_obj = $(this).parents('[id*=comments-]');
            if($(this).prop("class").split('_')[2]=='on'){
                $("#text").val("");
                $("#edit").append(parent_obj.find(".edit"));
                $(this).prop("class","reply_tips_off");
                $(this).children("span").html("回复");
            }else if($(this).prop("class").split('_')[2]=='off'){
                if(NowReplyObject!=null){
                    var o = $("#"+NowReplyObject).find(".reply_tips_on");
                    o.children("span").html("回复");
                    o.prop("class","reply_tips_off");
                }
                var edit_obj = $(".edit");
                $("#text").val("");
                parent_obj.children(".edit_div").append(edit_obj);
                $(this).children("span").html("取消回复");
                $(this).prop("class","reply_tips_on");
                NowReplyObject = parent_obj.prop("id");
            }
            @else
                x0p('亲爱的，你忘记了你还没有登录呢~', null, 'info', false);
            @endif
        });

        $(".pagination li a").click(function () {
            if(NowReplyObject!=null){
                var obj = $("#"+NowReplyObject);
                var o = obj.find(".reply_tips_on");
                o.children("span").html("回复");
                o.prop("class","reply_tips_off");
                var e = $("#edit");
                if($.trim(e.html())==""){
                    e.append(obj.find(".edit"));
                    $("#text").val("");
                }
            }
            var href = $(this).prop("href");
            location.href="#comments";
            var s = "<div class=\"circle-loader\">\n" +
                "        <div class=\"circle-line\">\n" +
                "            <div class=\"circle circle-blue\"></div>\n" +
                "            <div class=\"circle circle-blue\"></div>\n" +
                "            <div class=\"circle circle-blue\"></div>\n" +
                "        </div>\n" +
                "        <div class=\"circle-line\">\n" +
                "            <div class=\"circle circle-yellow\"></div>\n" +
                "            <div class=\"circle circle-yellow\"></div>\n" +
                "            <div class=\"circle circle-yellow\"></div>\n" +
                "        </div>\n" +
                "        <div class=\"circle-line\">\n" +
                "            <div class=\"circle circle-red\"></div>\n" +
                "            <div class=\"circle circle-red\"></div>\n" +
                "            <div class=\"circle circle-red\"></div>\n" +
                "        </div>\n" +
                "        <div class=\"circle-line\">\n" +
                "            <div class=\"circle circle-green\"></div>\n" +
                "            <div class=\"circle circle-green\"></div>\n" +
                "            <div class=\"circle circle-green\"></div>\n" +
                "        </div>\n" +
                "    </div>";
            $("#comments").html(s);
            $.post(href,{_token:_token},function (data) {
                $("#comments").html(data);
            });
            return false;
        });

        $("[id*=support_]").click(function () {
            @if(\App\Http\Controllers\UtilsController::isLogin())
            var id = $(this).prop("id").split("_")[1];
            var obj = $(this);
            $.post('/ajax/comment/support',{id:id,_token:_token},function (data) {
                if (data.code == 200) {
                    obj.children("span").html(parseInt(obj.children("span").html())+1);
                    obj.prop("class",obj.prop("class")+" is");
                }else if(data.code == 422){
                    x0p(data.msg, null, 'info', false);
                }else{
                    x0p('出了点小意外，赞失败了~', null, 'error', false);
                }
            },"json").error(function (xhr) {
                if (xhr.status == 422) {
                    var data = eval('(' + xhr.responseText + ')');
                    x0p('提示', data.text);
                } else {
                    x0p('提示', '出了点小意外，可能未能提交成功，刷新看看是否存在你的留言吧~');
                }
            });
            @else
                x0p('亲爱的，你忘记了你还没有登录呢~', null, 'info', false);
            @endif

        });

        var _token = $('meta[name=csrf-token]').prop("content");
        $(document).pjax('.pagination li a', '#comments',{
        });
    })
</script>