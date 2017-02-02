/**
 * Created by Administrator on 2017/1/17 0017.
 */
$(function () {
    var _token = $("meta[name=csrf-token]").prop("content");
   $("[id*=comment_delete_]").click(function () {
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
               $.post("/admin/ajax/comment/delete",{id:id,_token:_token},function (data) {
                   if (data.code == 200) {
                       x0p(data.msg, null, 'ok', false);
                       $("#comment_tr_"+id).hide(300);
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

   $("[id*=comment_edit_]").click(function () {
       var id = $(this).prop("id").split("_")[2];
        $.post("/admin/ajax/comment/get/"+id,{_token:_token},function (data) {
            if(data.code==200){
                $("#edit_text").val(data.data.text);
                $("#edit_id").val(data.data.id);
                $("#row_edit_comment").show(200);
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

   $(".btn_commentUpdate").click(function () {
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
               $.post("/admin/ajax/comment/update",$("#commentUpdateForm").serialize(),function (data) {
                   if (data.code == 200) {
                       x0p(data.msg, null, 'ok', false);
                       $("#row_edit_comment").hide(200);
                       var text_data = $("#edit_text").val();
                       var comment_id = $("#edit_id").val();
                       if(text_data.length>30){
                           text_data = text_data.substring(0,30)+"...";
                       }
                       $("#comment_text_"+comment_id).html(text_data);
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