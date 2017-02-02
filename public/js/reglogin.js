/**
 * Created by Administrator on 2017/1/11 0011.
 */
$(function () {
    $("#checkCode").click(function () {
        $(this).children("img").prop('src',$(this).children("img").prop('src')+"?"+new Date().getTime());
    });
});
