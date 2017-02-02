/**
 * Created by Administrator on 2017/1/11 0011.
 */
$(function () {

    var _token = $('meta[name=csrf-token]').prop("content");
    $.post('/get/comments',{_token:_token},function (data) {
        $("#comments").html(data);
    });

    (function($){
        $.fn.textFocus=function(v){
            var range,len,v=v===undefined?0:parseInt(v);
            this.each(function(){
                if($.browser.msie){
                    range=this.createTextRange();
                    v===0?range.collapse(false):range.move("character",v);
                    range.select();
                }else{
                    len=this.value.length;
                    v===0?this.setSelectionRange(len,len):this.setSelectionRange(v,v);
                }
                this.focus();
            });
            return this;
        }
    })(jQuery);

    Date.prototype.Format = function (fmt) { //author: meizz
        var o = {
            "M+": this.getMonth() + 1, //月份
            "d+": this.getDate(), //日
            "h+": this.getHours(), //小时
            "m+": this.getMinutes(), //分
            "s+": this.getSeconds(), //秒
            "q+": Math.floor((this.getMonth() + 3) / 3), //季度
            "S": this.getMilliseconds() //毫秒
        };
        if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
        for (var k in o)
            if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
        return fmt;
    };
    function addEditor(v) {
        var o = $("#text");
        var value = o.val()+v;
        o.val(value);
    }
    var h = {
        e:function () {
            $(".b").toggle(300);
        },
        b:function () {
            x0p('请输入插入文字',null,'input',
                function(button, text) {
                    if(button == 'info') {
                        text = $.trim(text);
                        if(text!=""){
                            addEditor('<b>'+text+'</b>')
                        }else{
                            x0p('提示',
                                '内容不能为空,已取消输入!');
                        }
                    }
                }
            );
        },
        a:function () {
            x0p('请输入链接地址',null,'input',
                function(button, text) {
                    if(button == 'info') {
                        text1 = $.trim(text);
                        if(text1!=""){
                            x0p('请输入链接内容',null,'input',
                                function(button, text) {
                                    if(button == 'info') {
                                        text2 = $.trim(text);
                                        if(text2!=""){
                                            addEditor('<a href="' + text1 + '" target="_blank" rel="nofollow">' + text2 + '</a>');
                                        }else{
                                            x0p('提示',
                                                '链接内容不能为空,已取消输入!');
                                        }
                                    }
                                }
                            );
                        }else{
                            x0p('提示',
                                '链接地址不能为空,已取消输入!');
                        }
                    }
                }
            );
        },
        img:function () {
            x0p('请输入图片地址',null,'input',
                function(button, text) {
                    if(button == 'info') {
                        text = $.trim(text);
                        if(text!=""){
                            addEditor('<img src="'+text+'" rel="nofollow"></img>')
                        }else{
                            x0p('提示',
                                '图片地址不能为空,已取消输入!');
                        }
                    }
                }
            );
        },
        p:function () {
            x0p('请输入插入文字',null,'input',
                function(button, text) {
                    if(button == 'info') {
                        text = $.trim(text);
                        if(text!=""){
                            addEditor('<blockquote>'+text+'</blockquote><br>')
                        }else{
                            x0p('提示',
                                '内容不能为空,已取消输入!');
                        }
                    }
                }
            );
        },
        sing:function () {
            var date = new Date().Format("yyyy-MM-dd hh:mm:ss");
            addEditor('每日签到~'+date);

        }
    };
    window['LiRecord']={};
    window['LiRecord']['Utils'] = h;

    $(".ex").click(function () {
        var val =  $(this).children('img').prop("class");
        addEditor("[:"+val.split('_')[1]+":] ");
    });

    $("#text").keyup(function(){
        var len = $(this).val().length;
        if(len > 255){
            $(this).val($(this).val().substring(0,255));
        }
        var num = 255 - len;
        $(".remaining_number").text(num);
    });

    function sendComment(id) {
        var data = $("#text").val();
        data = $.trim(data);
        var token = $('input[name=_token]').val();
        if (data == "") {
            x0p('提示', '提交内容不能为空');
        } else if (data.length > 255) {
            x0p('提示', '内容长度不能大于255个字符');
        } else {
            $.post("/ajax/comment/create", {text: data, _token: token, parent: id}, function (data) {
                if (data.code == 200) {
                    $("#text").val("");
                    var nowPageNumber = $(".page-now-number").html();
                    if(NowReplyObject!=null){
                        var obj = $("#"+NowReplyObject);
                        var o = obj.find(".reply_tips_on");
                        o.children("span").html("回复");
                        o.prop("class","reply_tips_off");
                        var e = $("#edit");
                        if($.trim(e.html())==""){
                            e.append(obj.find(".edit"));

                        }
                    }
                    if(id==0){
                        location.href="#comments";
                        $.post('/get/comments',{_token:_token},function (data) {
                            $("#comments").html(data);
                        });
                    }else{
                        location.href="#comments-"+id;
                        $.post('/get/comments/?page='+nowPageNumber,{_token:_token},function (data) {
                            $("#comments").html(data);
                        });
                    }
                } else if (data.code == 422) {
                    x0p(data.msg, null, 'error', false);
                } else {
                    x0p('出了点小意外，留言失败~', null, 'error', false);
                }
            }, "json").error(function (xhr) {
                if (xhr.status == 422) {
                    var data = eval('(' + xhr.responseText + ')');
                    x0p('提示', data.text);
                } else {
                    x0p('提示', '出了点小意外，可能未能提交成功，刷新看看是否存在你的留言吧~');
                }
            });
        }
    }



    $(".seed_comment").click(function () {
        var parent = $(this).parents("[id*=comments-]");
        if(parent.length>0){
            sendComment(parent.prop("id").split("-")[1]);
        }else{
            sendComment(0);
        }
    });



});