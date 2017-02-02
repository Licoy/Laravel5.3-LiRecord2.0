/**
 * Created by Administrator on 2017/1/17 0017.
 */
$(function () {
    $(".btn-saveMe").click(function () {
        x0p({
            title: '是否确认更新？',
            text: '此操作为不可逆操作，一旦更新不可找回数据。',
            icon: 'info',
            animationType: 'fadeIn',
            buttons: [
                {
                    type: 'info',
                    text: '确认',
                    showLoading: true

                },
                {
                    type: 'cancel',
                    text: '取消'
                }
            ]
        }, function(button) {
            if(button == 'info') {
                $.post('/ajax/user/update',$("#MyInfoForm").serialize(),function (data) {
                    if(data.code == 200){
                        x0p(data.msg, null, 'ok', false);
                    }else if (data.code == 422) {
                        x0p(data.msg, null, 'error', false);
                    } else {
                        x0p('出了点小意外，操作失败~', null, 'error', false);
                    }
                },"json").error(function (xhr) {
                    if (xhr.status == 422) {
                        var data = eval('(' + xhr.responseText + ')');
                        var i = 1;
                        var s = "";
                        $.each(data,function (n, value) {
                            s += (i+"."+value+"\n");
                            i++;
                        });
                        x0p('不满足以下要求', s);
                    } else {
                        x0p('提示', '出了点小意外，可能未能提交成功。');
                    }
                });
            }
        });
    });


    $(".update_password").click(function () {
        x0p({
            title: '是否确认更改？',
            text: '此操作为不可逆操作，一旦更改不可找回数据。',
            icon: 'info',
            animationType: 'fadeIn',
            buttons: [
                {
                    type: 'info',
                    text: '确认',
                    showLoading: true

                },
                {
                    type: 'cancel',
                    text: '取消'
                }
            ]
        }, function(button) {
            if (button == 'info') {
                $.post("/ajax/user/password",$("#updatePswdForm").serialize(),function (data) {
                    if(data.code == 200){
                        x0p(data.msg, null, 'ok', false);
                        setTimeout(function () {
                            location = "/login";
                        },1200);
                    }else if (data.code == 422) {
                        x0p(data.msg, null, 'error', false);
                    } else {
                        x0p('出了点小意外，操作失败~', null, 'error', false);
                    }
                },"json").error(function (xhr) {
                    if (xhr.status == 422) {
                        var data = eval('(' + xhr.responseText + ')');
                        var i = 1;
                        var s = "";
                        $.each(data,function (n, value) {
                            s += (i+"."+value+"\n");
                            i++;
                        });
                        x0p('不满足以下要求', s);
                    } else {
                        x0p('提示', '出了点小意外，可能未能提交成功。');
                    }
                });
            }
        });
    });

});