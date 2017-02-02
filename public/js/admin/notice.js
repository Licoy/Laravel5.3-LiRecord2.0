/**
 * Created by Administrator on 2017/1/17 0017.
 */
$(function () {
   $(".btn_send").click(function () {
       x0p({
           title: '确认发布？',
           text: '发布公告前请检查一下呃~',
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
               $.post("/admin/ajax/notice",$("#NoticeForm").serialize(),function (data) {
                   if(data.code == 200){
                       x0p(data.msg, null, 'ok', false);
                       setTimeout(function () {
                           location = "/notice/"+data.id;
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