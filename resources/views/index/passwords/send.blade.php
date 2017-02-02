<html>
<head></head>
<body>
    <div id="qm_con_body">
        <div id="mailContentContainer" class="qmbox qm_con_body_content qqmail_webmail_only">
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse">
                <tbody>
                <tr>
                    <td>
                        <table width="600" cellpadding="0" cellspacing="0" border="0" align="center" style="border-collapse:collapse">
                            <tbody>
                            <tr>
                                <td>
                                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                        <tbody>
                                        <tr>
                                            <td width="73" align="left" valign="top" style="border-top:1px solid #d9d9d9;border-left:1px solid #d9d9d9;border-radius:5px 0 0 0"></td>
                                            <td valign="top" style="border-top:1px solid #d9d9d9">
                                                <div style="font-size:14px;line-height:10px">
                                                    <br />
                                                    <br />
                                                    <br />
                                                    <br />
                                                </div>
                                                <div style="font-size:18px;line-height:18px;color:#444;font-family:Microsoft Yahei">
                                                    {{ $data['name'] }}，您好
                                                    <br />
                                                    <br />
                                                    <br />
                                                </div>
                                                <div style="font-size:14px;line-height:22px;color:#444;font-weight:bold;font-family:Microsoft Yahei">
                                                    你于{{ $data['time'] }}申请了密码重置，请点击下方的按钮进行重置密码，若不是本人操作请尽快修改密码保证账户安全。
                                                </div>
                                                <div style="font-size:14px;line-height:10px">
                                                    <br />
                                                </div>
                                                <div style="text-align:center">
                                                    <a href="{{ url('/password/reset/'.$data['token']) }}" target="_blank" style="text-decoration:none;color:#fff;display:inline-block;line-height:44px;font-size:18px;background-color:#61B3E6;border-radius:3px;font-family:Microsoft Yahei">&nbsp; &nbsp;&nbsp; &nbsp;点此重置密码&nbsp; &nbsp;&nbsp; &nbsp;</a>
                                                    <br />
                                                    <br />
                                                </div></td>
                                            <td width="65" align="left" valign="top" style="border-top:1px solid #d9d9d9;border-right:1px solid #d9d9d9;border-radius:0 5px 0 0"></td>
                                        </tr>
                                        <tr>
                                            <td style="border-left:1px solid #d9d9d9">&nbsp;</td>
                                            <td align="left" valign="top" style="color:#999">
                                                <div style="min-height:1px;font-size:1px;line-height:1px;background-color:#e0e0e0">
                                                    &nbsp;
                                                </div>
                                                <div style="font-size:12px;line-height:20px;width:425px;font-family:Microsoft Yahei">
                                                    <a href="" target="_blank" style="text-decoration:underline;color:#61B3E6;font-family:Microsoft Yahei"></a>
                                                    <br />此邮件由LiRecord留言系统自动发出，请勿回复！
                                                </div></td>
                                            <td style="border-right:1px solid #d9d9d9">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" style="border-bottom:1px solid #d9d9d9;border-right:1px solid #d9d9d9;border-left:1px solid #d9d9d9;border-radius:0 0 5px 5px">
                                                <div style="min-height:42px;font-size:42px;line-height:42px">
                                                    &nbsp;
                                                </div></td>
                                        </tr>
                                        </tbody>
                                    </table></td>
                            </tr>
                            <tr>
                                <td>
                                    <div style="min-height:42px;font-size:42px;line-height:42px">
                                        &nbsp;
                                    </div></td>
                            </tr>
                            </tbody>
                        </table></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>