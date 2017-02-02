/**
 * Created by Administrator on 2017/1/17 0017.
 */
$(function () {
    var _token = $("meta[name=csrf-token]").prop("content");
   $("[id*=user_delete_]").click(function () {
       var obj = $(this);
       x0p({
           title: '确认删除？',
           text: '此操作为不可逆操作，请三思而后行~',
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
       }, function (button) {
           if (button == 'info') {
               var id = obj.prop("id").split("_")[2];
               $.post("/admin/ajax/user/delete",{id:id,_token:_token},function (data) {
                   if (data.code == 200) {
                       x0p(data.msg, null, 'ok', false);
                       $("#user_tr_"+id).hide(300);
                   } else if (data.code == 422) {
                       x0p(data.msg, null, 'error', false);
                   } else {
                       x0p('出了点小意外，操作失败~', null, 'error', false);
                   }
               },"json").error(function (xhr) {
                   if (xhr.status == 422) {
                       var data = eval('(' + xhr.responseText + ')');
                       var i = 1;
                       var s = "";
                       $.each(data, function (n, value) {
                           s += (i + "." + value + "\n");
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

   $("[id*=user_edit_]").click(function () {
       var id = $(this).prop("id").split("_")[2];
        $.post("/admin/ajax/user/getUser/"+id,{_token:_token},function (data) {
            if(data.code==200){
                $("#user_id").val(data.data.user_id);
                $("#user_name").val(data.data.user_name);
                $("#user_email").val(data.data.user_email);
                $("#user_qq").val(data.data.user_qq);
                if(data.data.user_gender==1){
                    $("#user_gender_1").prop("checked","checked");
                }else{
                    $("#user_gender_2").prop("checked","checked");
                }
                $("#row_edit_user").show(200);
            }
        },"json").error(function (xhr) {
            if (xhr.status == 422) {
                var data = eval('(' + xhr.responseText + ')');
                var i = 1;
                var s = "";
                $.each(data, function (n, value) {
                    s += (i + "." + value + "\n");
                    i++;
                });
                x0p('不满足以下要求', s);
            } else {
                x0p('提示', '出了点小意外，可能未能提交成功。');
            }
        });
   });

   $(".btn_user_update").click(function () {
       x0p({
           title: '确认更新？',
           text: '更新前请确认其内容正确无误~',
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
       }, function (button) {
           if (button == 'info') {
               $.post("/admin/ajax/user/update",$("#userUpdateForm").serialize(),function (data) {
                   if (data.code == 200) {
                       x0p(data.msg, null, 'ok', false);
                       setTimeout(function () {
                           location = location;
                       },1200)
                   } else if (data.code == 422) {
                       x0p(data.msg, null, 'error', false);
                   } else {
                       x0p('出了点小意外，操作失败~', null, 'error', false);
                   }
               },"json").error(function (xhr) {
                   if (xhr.status == 422) {
                       var data = eval('(' + xhr.responseText + ')');
                       var i = 1;
                       var s = "";
                       $.each(data, function (n, value) {
                           s += (i + "." + value + "\n");
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

    $("[id*=user_gag_]").click(function () {
        var obj = $(this);
        x0p({
            title: '确认操作？',
            text: '',
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
        }, function (button) {
            if (button == 'info') {
                var user_id = obj.prop("id").split("_")[3];
                var gag_id = obj.prop("id").split("_")[2]=="off" ? 0 : 1;
                $.post("/admin/ajax/user/gag",{user_id:user_id,gag_id:gag_id,_token:_token},function (data) {
                    if (data.code == 200) {
                        x0p(data.msg, null, 'ok', false);
                        if(gag_id==0){
                            obj.prop("id","user_gag_on_"+user_id);
                            obj.children("span").html("解禁");
                            obj.prop("class","label label-warning");
                        }else{
                            obj.prop("id","user_gag_off_"+user_id);
                            obj.children("span").html("禁言");
                            obj.prop("class","label label-default");
                        }
                    } else if (data.code == 422) {
                        x0p(data.msg, null, 'error', false);
                    } else {
                        x0p('出了点小意外，操作失败~', null, 'error', false);
                    }
                },"json").error(function (xhr) {
                    if (xhr.status == 422) {
                        var data = eval('(' + xhr.responseText + ')');
                        var i = 1;
                        var s = "";
                        $.each(data, function (n, value) {
                            s += (i + "." + value + "\n");
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