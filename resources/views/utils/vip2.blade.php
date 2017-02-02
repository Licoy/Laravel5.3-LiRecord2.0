@if($v2['count']<10)
    <div class="vip float-left vip_1"><span>活跃达人.Lv1</span></div>
@elseif($v2['count']>=10 && $v2['count']<30)
    <div class="vip float-left vip_2"><span>活跃达人.Lv2</span></div>
@elseif($v2['count']>=30 && $v2['count']<50)
    <div class="vip float-left vip_3"><span>活跃达人.Lv3</span></div>
@elseif($v2['count']>=50 && $v2['count']<70)
    <div class="vip float-left vip_4"><span>活跃达人.Lv4</span></div>
@elseif($v2['count']>=70 && $v2['count']<90)
    <div class="vip float-left vip_5"><span>活跃达人.Lv5</span></div>
@elseif($v2['count']>=90 && $v2['count']<110)
    <div class="vip float-left vip_6"><span>活跃达人.Lv6</span></div>
@elseif($v2['count']>=110 && $v2['count']<130)
    <div class="vip float-left vip_7"><span>活跃达人.Lv7</span></div>
@elseif($v2['count']>=130)
    <div class="vip float-left vip_8"><span>活跃达人.Lv8</span></div>
@endif
