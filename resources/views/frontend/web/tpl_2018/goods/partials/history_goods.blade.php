<style>
    #user_like .p-img img{width:100% !important;}
    .browse-history-inner{height:266px;}
    .browse-history-inner ul{height:258px;}
    .browse-history-inner li{border:1px solid #eee;padding-right:0;margin-right:20px;}
    .browse-history-inner .p-name{padding:0 10px;box-sizing: border-box;}
    .browse-history-inner .p-comm{padding:10px 10px 0 10px;box-sizing: border-box;}
</style>
<ul id="history_list" class="history-panel none">

    @if(empty($goods_history))
        <div class="tip-box">
            <img src="/images/noresult.png" class="tip-icon">
            <div class="tip-text">暂无历史足迹</div>
        </div>
    @else
        @foreach($goods_history as $k=>$v)
        <!---->
            <li @if($k == 5) class="li-special" @endif>
                <div class="p-img">
                    <a target="_blank" title="{{ $v->goods_name }}" href="{{ route('pc_show_goods', ['goods_id'=>$v->goods_id]) }}">
                        <img alt="{{ $v->goods_name }}" src="{{ get_image_url($v->goods_image) }}?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220">
                    </a>
                </div>
                <div class="p-name">
                    <a target="_blank" title="{{ $v->goods_name }}" href="{{ route('pc_show_goods', ['goods_id'=>$v->goods_id]) }}">{{ $v->goods_name }}</a>
                </div>
                <div class="p-comm">
                    <span class="p-price color">￥{{ $v->goods_price }}</span>
                <!-- <a class="p-comm-num" href="{{ route('pc_show_goods', ['goods_id'=>$v->goods_id]) }}#goods_evaluate" target="_blank">评论：</a> -->
                </div>
            </li>
        @endforeach
    @endif
</ul>