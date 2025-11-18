@extends('layouts.base')

@section('header_js')
    <script src="/assets/d2eace91/js/jquery.cookie.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=20180528"></script>
@stop

{{--follow_box 注意此效果只在首页面展示--}}
@section('follow_box')

@stop

@section('style_js')
    <!--页面css/js-->
    <script src="/js/index.js?v=20180528"></script>
    <script src="/js/tabs.js?v=20180528"></script>
    <script src="/js/bubbleup.js?v=20180528"></script>
    <script src="/js/jquery.hiSlider.js?v=20180528"></script>
    <script src="/js/index_tab.js?v=20180528"></script>
    <script src="/js/jump.js?v=20180528"></script>
    <script src="/js/nav.js?v=20180528"></script>
@stop



@section('content')
    <!-- 内容 -->
    <!-- css -->
    <link rel="stylesheet" href="/css/goods.css?v=20180428"/>
    <!-- 地区选择器 -->
    <script src="/assets/d2eace91/js/jquery.region.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=<?php echo time();?>"></script>
    <script src="/assets/d2eace91/js/jquery.history.js?v=20180528"></script>
    <!-- 放大镜 _start -->
    <script type="text/javascript" src="/js/magiczoom.js"></script>
    <!-- 放大镜 _end -->

    <link rel="stylesheet" href="/assets/d2eace91/layui/css/layui.css?v=23121"/>
    <link rel="stylesheet" href="/assets/d2eace91/js/layer/theme/default/layer.css?v=3.1.0" id="layuicss-layer">
    <script type="text/javascript" src="/assets/d2eace91/layui/layui.js"></script>

    <div class="w1210">

        <!--当前位置，面包屑-->
        @include('frontend.web.modules.library.url_here')

        <div class="goods-info">
            <!-- 商品详细信息 -->

            <span class="SZY-GOODS-NAME-BASE" style="display: none;">{{ $goods['goods_name'] }}</span>
            <!-- 商品图片以及相册 _star-->
            <div id="preview" class="preview">
                <!-- 商品相册容器 -->
                <div class="goodsgallery"></div>
                <script id="SZY_SKU_IMAGES" type="text">
                    {!! json_encode($sku['sku_images']) !!}
                </script>
                <script type="text/javascript">
                    // 图片相册
                    $(".goodsgallery").goodsgallery({
                        images: $.parseJSON($("#SZY_SKU_IMAGES").html()),
                        video: "{{ get_video_url($goods['goods_video']) }}"
                    });
                </script>
                <!--相册 END-->

                <div class="goods-gallery-bottom">
                    <a href="javascript:void(0);" class="goods-compare compare-btn fr add-compare" data-goods-id="{{ $goods['goods_id'] }}" data-sku-id="{{ $sku['sku_id'] }}" data-image-url="{{ get_image_url($goods['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320">
                        <i class="iconfont">&#xe715;</i>
                        对比
                    </a>

                    <a href="javascript:void(0);" class="goods-col fr @if($goods['is_collect']) curr @endif collect-goods" data-goods-id="{{ $goods['goods_id'] }}">
                        @if($goods['is_collect'])
                            {{--已收藏--}}
                            <i class="iconfont">&#xe6b1;</i>
                            <span>取消收藏({{ $goods['collect_num'] }}人气)</span>
                        @else
                            {{--未收藏--}}
                            <i class="iconfont">&#xe6b3;</i>
                            <span>收藏商品</span>
                        @endif
                    </a>

                    <div class="bdsharebuttonbox fr">
                        <a class="bds_more" href="#" data-cmd="more" style="background: none; color: #999; line-height: 25px; height: 25px; margin: 0px 10px; padding-left: 20px; display: block;">
                            <i class="iconfont">&#xe6ac;</i>
                            分享
                        </a>
                    </div>
                </div>

                <script type="text/javascript">
                    window._bd_share_config = {
                        "common": {
                            "bdSnsKey": {},
                            "bdText": "我在@" + "{{ sysconf('site_name') }}" + " 发现了一个非常不错的商品：" + $(".SZY-GOODS-NAME-BASE").text() + "。感觉不错，分享一下~",
                            "bdMini": "2",
                            "bdMiniList": false,
                            "bdPic": "{{ get_image_url($goods['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320",
                            "bdStyle": "0",
                            "bdSize": "16"
                        },
                        "share": {}
                    };
                    // with (document) {
                    //     0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = '//bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~(-new Date() / 36e5)];
                    // }
                </script>
            </div>
            <!-- 商品图片以及相册 _end-->
            <!-- 商品详细信息 _star-->
            <div class="detail-info">
                <form action="" method="post" name="" id="">
                    <!-- 商品名称 -->
                    <h1 class="goods-name SZY-GOODS-NAME">{{ $sku['sku_name'] }}</h1>
                    <!-- 限时折扣 -->
                {{--todo 判断 限时折扣显示 后期再做促销功能--}}
                {{--<p class="end-time bg-color">
                    <font id="limit_discount_label">
                        <span class="activity-label">标签</span>
                        <em class="discount"> 减5元 </em>
                        <span class="fr small-text">
                            <strong id="limit_discount_countdown">00 天 00 小时 00 分 00 秒</strong>
                            后结束，请尽快购买！
                        </span>
                    </font>
                </p>--}}



                <!-- 预售 -->


                    <!-- 商品简单描述 -->
                    <p class="goods-brief second-color">{{ $goods['goods_subname'] }}</p>
                    <!-- 商品团购倒计时 -->
                    <!--当团购商品未开始时-->

                    {{--todo 判断 限时团购显示 后期再做促销功能--}}
                    {{--<div class="activity-banner bg-color">
                        <div class="activity-type">
                            <i class="icon iconfont">&#xe6aa;</i>
                            <strong>限时团购</strong>
                        </div>
                        <div class="activity-message">
                            距离结束
                            <div id="groupbuy_countdown" class="fr">
                                <span>00</span>
                                :
                                <span>00</span>
                                :
                                <span>00</span>
                            </div>
                        </div>
                    </div>--}}


                    <div class="goods-price">

                        <!-- 商品不同的价格 -->
                        <div class="show-price" style="display: none;">
                            <span class="price">市场价</span>
                            <font class="market-price SZY-MARKET-PRICE">￥{{ $goods['market_price'] }}</font>
                        </div>
                        <!-- 商品市场价 _end -->
                        <!-- 销量及评价 _start -->
                        <div class="goods-info-other" style="display: none;">
                            <div class="item sale">
                                <p>累计销量</p>
                                <em class="second-color">{{ $goods['sale_num'] }}</em>
                            </div>

                            <div class="item evaluate">
                                <p>用户评价</p>
                                <a id="evaluate_num" href="#goods_evaluate" class="second-color">{{ $goods['comment_num'] }}</a>
                            </div>
                        </div>
                        <style>
                            .disf{display:flex;align-items:center;}
                            .goods-price .realy-price .price{width:fit-content;}
                            .goods-price .start-batch{width:100%;}
                            .goods-price .realy-price .now-prices{position:relative;}
                            .goods-price .realy-price .now-prices, .goods-price .realy-price .rank-prices, .goods-price .realy-price .depreciate{display: flex;align-items: center;float:unset;}
                            .goods-price .realy-price{height:fit-content;}
                            .font20{font-size:20px;}
                            .font15{font-size:15px;}
                            .low_price{width:150px;justify-content: space-between;}
                            .gantan{width:25px;cursor:pointer;}
                            .showDIV{background:#fff;padding: 10px 30px;border-radius: 5px;box-shadow: 0px 1px 5px 0px #666;}
                            .interval_table thead th{min-width: 100px;}
                            .site-footer{z-index:8;}
                        </style>
                        <!-- 销量及评价 _end -->
                    @if($goods['have_specs']==1)
                        <!--有规格-->
                            <div class="realy-price">
                                <div class="now-prices">
                                    <span class="price">价&nbsp;&nbsp;&nbsp;格</span>
                                    <div class="low_price disf">
                                        <span class="font20 color">{{$goods['currency']}}&nbsp;{{$goods['goods_price']}}</span>
                                        <img src="/images/gantanhao.png" class="price_info gantan">
                                    </div>
                                    <div class="interval_div showDIV" style="display: none;">

                                        <table class="interval_table layui-table">
                                            <thead>
                                            <tr>
                                                <th>起批量</th>
                                                <th>价格</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($sku['sku_prices']['start_num'] as $k=>$v)
                                                <tr>
                                                    <td>
                                                        <div class="disf" style="justify-content: left;">
                                                            <div class="start_num font15">{{$v}}</div>
                                                            @if($sku['sku_prices']['select_end'][$k]==1)
                                                                -
                                                                <div class="end_num font15">{{$sku['sku_prices']['end_num'][$k]}}</div>
                                                                <div class="unit font15">{{$sku['sku_prices']['unit'][$k]}}</div>
                                                            @else
                                                                <div class="end_num font15">{{$sku['sku_prices']['unit'][$k]}}&nbsp;以上</div>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="disf" style="justify-content: left;">
                                                            <div class="font15">{{$sku['sku_prices']['currency'][$k]}}</div>
                                                            <div class="font15 color">{{$sku['sku_prices']['price'][$k]}}</div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                    @elseif($goods['have_specs']==2)
                        <!--无规格-->
                            <div class="realy-price">
                                <div class="now-prices">
                                    <span class="price">价&nbsp;&nbsp;&nbsp;格</span>
                                    <div class="low_price disf">
                                        <span class="font20 color">{{$goods['currency']}}&nbsp;{{$goods['goods_price']}}</span>
                                        <img src="/images/gantanhao.png" class="price_info gantan">
                                    </div>
                                    <div class="interval_div showDIV" style="display: none;">

                                        <table class="interval_table layui-table">
                                            <thead>
                                            <tr>
                                                <th>起批量</th>
                                                <th>价格</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($goods['nospecs']['start_num'] as $k=>$v)
                                                <tr>
                                                    <td>
                                                        <div class="disf" style="justify-content: left;">
                                                            <div class="start_num font15">{{$v}}</div>
                                                            @if($goods['nospecs']['select_end'][$k]==1)
                                                                -
                                                                <div class="end_num font15">{{$goods['nospecs']['end_num'][$k]}}</div>
                                                                <div class="unit font15">{{$goods['nospecs']['unit'][$k]}}</div>
                                                            @else
                                                                <div class="end_num font15">{{$goods['nospecs']['unit'][$k]}}&nbsp;以上</div>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="disf" style="justify-content: left;">
                                                            <div class="font15">{{$goods['nospecs']['currency'][$k]}}</div>
                                                            <div class="font15 color">{{$goods['nospecs']['price'][$k]}}</div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="realy-price" style="display: none;">
                            <div class="now-prices">
                                <span class="price">售&nbsp;&nbsp;&nbsp;价</span>
                                <strong class="p-price second-color SZY-GOODS-PRICE">￥{{ $goods['goods_price'] }}</strong>
                            </div>
                            <!--
                                    <div class="depreciate">
                                        <a href="" title="">（降价通知）</a>
                                    </div>
                                     -->
                        </div>

                        <!-- 促销 -->
                        <div class="shop-prom SZY-ACTIVITY" style="display:none;">
                            <div class="shop-prom-title">
                                <dl>
                                    <dt class="dt">促&nbsp;&nbsp;&nbsp;销</dt>
                                    <div class="shop-prom-box">
                                        <!--会员价 _start-->

                                        <!-- 会员价 _end -->
                                        <!-- 领红包 _start -->

                                        {{--todo 判断 有红包时显示--}}
                                        @if(!empty($bonus_list))
                                            <dd>
                                                <div>
                                                    <span class="pro-type">红包</span>
                                                    <div class="pro-info">
                                            <span class="shop-coupon">
                                                <span class="bonus">点击此处领取并查看红包详情</span>
                                                <!-- 优惠券弹框 -->
                                                <div class="coupon-popup">
                                                    <i class="close"></i>
                                                    <div class="popup-content">
                                                        <div class="coupon-list">
                                                            <ul>
                                                                @foreach($bonus_list as $bonus)
                                                                    <li class="coupon">
                                                                        <div class="coupon-amount">
                                                                            <div class="coupon-price">
                                                                                {{ $bonus['bonus_amount_format'] }}
                                                                                <i></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="coupon-detail">
                                                                            <div class="coupon-info">
                                                                                <p class="coupon-title" title="">{{ $bonus['bonus_name'] }}</p>
                                                                                <p class="coupon-time">{{ $bonus['start_time_format'] }}&nbsp;-&nbsp;{{ $bonus['end_time_format'] }}</p>
                                                                            </div>
                                                                        </div>

                                                                        @if($bonus['is_receive'])
                                                                            <!-- 已领取的红包 _start -->
                                                                                <span class="bonus-received">已领取</span>
                                                                                <!-- 已领取的红包 _end -->
                                                                        @else
                                                                            <!-- 未领取的红包 _start -->
                                                                                <a href="javascript:void(0);" title="点击领取红包" data-bonus-id="{{ $bonus['bonus_id'] }}" class="bonus-receive color">领取</a>
                                                                                <!-- 未领取的红包 _end -->
                                                                            @endif


                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                        <span class="popup-arrow"></span>
                                                    </div>
                                                </div>
                                            </span>
                                                    </div>
                                                </div>
                                            </dd>
                                    @endif
                                    <!-- 领红包 _end -->
                                        <!-- 赠品 _start -->

                                    {{--todo 判断 有赠品时显示 后期再做促销功能--}}
                                    {{--<dd>
                                        <div class="prom-gift SZY-GIFT-LIST">
                                            <span class="pro-type SZY-GIFT-LABEL">赠品</span>
                                            <span class="pro-info">
                                                <div class="prom-gift">

                                                    <div class="prom-gift-list SZY-GIFT m-l-5">
                                                        <a href="/1112.html" title="彩椒  C之王" target="_blank">
                                                            <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/shop/1/gallery/2019/01/15/15475140324781.png?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" width="25" height="25" class="gift-img" />
                                                        </a>
                                                        <em class="gift-number color">× 1</em>
                                                    </div>

                                                    <div class="prom-gift-list SZY-GIFT m-l-5">
                                                        <a href="/1127.html" title="彩椒 123 1" target="_blank">
                                                            <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/shop/1/gallery/2019/01/11/15472021222241.jpg?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" width="25" height="25" class="gift-img" />
                                                        </a>
                                                        <em class="gift-number color">× 1</em>
                                                    </div>

                                                </div>
                                            </span>
                                        </div>
                                    </dd>--}}
                                    <!--赠品 _end-->
                                        <!-- 满减、满折 _start -->

                                    {{--todo 判断 有满减、满折时显示 后期再做促销功能--}}
                                    {{--<dd class="discount">
                                        <div class="pro-item">

                                            <span class="pro-type">满减</span>


                                            <span class="pro-type">包邮</span>


                                            <div class="pro-info">
                                                <div class="pro-info-list">
                                                    <p title="满5元，减3元、包邮；">满5元，减3元、包邮；</p>
                                                </div>

                                                <div class="list-bomb-box">
                                                    <i></i>
                                                    <ul>

                                                        <li>满5元，减3元、包邮；</li>

                                                        <li>满10元，减5元；</li>

                                                    </ul>
                                                </div>

                                            </div>
                                            <!-- 当条件大于1个时，此标签显示 _start -->

                                            <i class="more"></i>

                                            <!-- 当条件大于1个时，此标签显示 _end -->
                                        </div>
                                    </dd>--}}

                                    <!-- 满减送_end -->
                                        <!-- 当促销方式多于2个时，此模块显示----显示的是所有活动前面的标签 _start -->
                                        <div class="pro-type-group">
                                            <span class="pro-info-down">
                                                展开促销
                                                <i class="more"></i>
                                            </span>
                                        </div>
                                        <!-- <dd class="pro-type-group">
                                        <div class="pro-item">
                                            <span class="pro-type">红包</span>
                                            <span class="pro-type">赠品</span>
                                            <span class="pro-type">限购</span>
                                            <span class="pro-type">满减</span>
                                            <span class="pro-type">包邮</span>
                                            <span class="pro-type">赠</span>
                                            <span class="pro-type">加价购</span>
                                            <span class="pro-info-down">
                                                展开促销
                                                <i class="more"></i>
                                            </span>
                                        </div>
                                    </dd> -->
                                        <!-- 当促销方式多于2个时，此模块显示 _end -->
                                    </div>
                                </dl>
                            </div>
                        </div>

                        @if($goods['goods_moq'] > 0)
                            <div class="start-batch">
                                <span>起订量</span>
                                <font class="start-batch-num">≥&nbsp;{{ $goods['goods_moq'] }}&nbsp;{{$sku_info[0]['sku_prices']['unit'][0]}}</font>
                            </div>
                        @endif


                    </div>
                    <!-- 在售的商品 _start -->
                    <!-- 虚拟商品判断 -->

                    {{--todo 判断 是否显示--}}
                    @if(sysconf('goods_info_freight') == 0)
                        {{--goods_info_freight=0 显示具体运费--}}
                    <!-- 运费 -->
                        <div class="freight" style="display: none;">
                            <div class="dt">配送至</div>
                            <div class="dd">
                                <div class="post-age">
                                    <div class="region-chooser-container" style="z-index: 3"></div>
                                    <div class="post-age-info">
                                        <span class="freight-info"></span>
                                        <div class="service-tips freight-free-info" style="display: none;">
                                            <i class="sprite-question"></i>
                                            <div class="tips">
                                                <div class="sprite-arrow"></div>
                                                <div class="tips-bg"></div>
                                                <div class="content">
                                                    <p></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif


                <!-- 服务 -->
                    <div class="freight">
                        <div class="dt">服&nbsp;&nbsp;&nbsp;务</div>
                        <div class="dd">
                            <div class="post-age">
                                由
                                @if($goods['shop_id']>0)
                                    <a href="{{ route('pc_shop_home', ['shop_id'=>$shop_info['shop']['shop_id']]) }}" target="_blank" class="color">{{ $shop_info['shop']['shop_name'] }}</a>
                                @else

                                @endif
                                负责发货，并提供售后服务。
                            </div>
                        </div>
                    </div>


                    @if(sysconf('goods_info_pickup'))
                    <!-- 自提点 -->
                        <div class="pickup" style="display: none;">
                            <div class="dt">自提点</div>
                            <div class="dd">
                                <div class="pickup-info">
                                    <a href="javascript:void(0);" id="self_pickup">
                                        <i class="iconfont color">&#xe6a7;</i>
                                        <span>上门自提</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif


                    <div class="choose SZY-GOODS-SPEC-ITEMS">
                        <!-- 商品规格 -->

                    @if(!empty($goods['spec_list']))
                        @foreach($goods['spec_list'] as $k=>$v)
                            @if(isset($v['attr_name']))
                                <!-- 如果规格下没有库存，红色提示背景给dl标签追加class值"no-stock-bg" -->
                                    <dl class="attr">
                                        <dt class="dt">{{ $v['attr_name'] }}</dt>
                                        <dd class="dd">
                                            <ul data-attr-id="{{ $v['attr_id'] }}">

                                            @foreach($v['attr_values'] as $kk=>$vv)
                                                <!-- 属性值被选中的状态 -->
                                                    <!-- 如果规格下没有库存，虚线格式给li标签追加class值“no-stock” -->
                                                    <li class="goods-spec-item @if(in_array($vv['attr_vid'], $sku['spec_vids'])) selected @endif"
                                                        data-spec-id="{{ $v['attr_id'] }}" data-attr-id="{{ $vv['attr_vid'] }}" data-is-default="{{ $v['is_default'] }}" data-points-goods="0">
                                                        <a href="javascript:void(0);" title="{{ $vv['attr_value'] }}">
                                                            @if($v['is_default'] && !empty($vv['spec_image']))
                                                                <img src="{{ get_image_url($vv['spec_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" width="34" height="34" alt="">
                                                            @endif
                                                            <span class="value-label">{{ $vv['attr_value'] }}</span>
                                                        </a>
                                                        <i></i>
                                                    </li>
                                                @endforeach

                                            </ul>
                                        </dd>
                                    </dl>
                            @endif
                        @endforeach
                    @endif

                    <!-- 购买数量 -->
                        <dl class="amount amount_num">
                            <dt class="dt">数量</dt>
                            <dd class="dd">
                                <span class="amount-widget">
                                    <input type="text" class="amount-input" value="1"
                                           data-sales_model="{{ $goods['sales_model'] }}"
                                           data-goods_id="{{ $goods['goods_id'] }}"
                                           data-sku_id="{{ $sku['sku_id'] }}"
                                           data-amount-min="1"
                                           data-amount-max="{{ $sku['goods_number'] }}"
                                           maxlength="8" title="请输入购买量">
                                    <span class="amount-btn">
                                        <span class="amount-plus">
                                            <i>+</i>
                                        </span>
                                        <span class="amount-minus">
                                            <i>-</i>
                                        </span>
                                    </span>
                                    <span class="amount-unit">{{$sku_info[0]['sku_prices']['unit'][0]}}</span>
                                </span>
                                <em class="stock SZY-GOODS-NUMBER">
                                    库存{{ $sku['goods_number'] }}{{$sku_info[0]['sku_prices']['unit'][0]}}
                                </em>
                            </dd>
                        </dl>
                        <dl class="amount">
                            <dt class="dt" style="height:1px;"></dt>
                            <dd class="dd">
                                <div class="layui-btn layui-btn-md layui-btn-success" style="background:#ff0000;" onclick="join_list()">加入清单</div>
                            </dd>
                        </dl>

                        <!-- 限购提示语 -->
                        {{--todo 判断 有限购数量时显示--}}
                        @if($sku['purchase_num'] > 0)
                            <div class="purchase-msg">
                                <div class="msg-con">
                                    每人限购{{ $sku['purchase_num'] }}件
                                    <i class="msg-icon"></i>
                                </div>
                            </div>
                        @endif

                    <!--购物清单-->
                        <style>
                            .buy_list{position:relative;}
                            .buy_list .glist_form{background:#fff;padding:15px;box-sizing: border-box;position:absolute;top:45px;left:0px;border: 1px solid #ededed;z-index: 10;box-shadow: 0px 0px 10px 1px #999;width: 100%;}
                            .yixuan_div{width: 100%;height: 40px;background: #f2f2f2;padding: 10px 20px;box-sizing: border-box;}
                            .yixuan_div .yixuan,.yixuan_div .yixuan2{cursor: pointer;position:relative;width:fit-content;font-size:15px;}
                            .yixuan_div .yixuan:after{content:'';position:absolute;width:8px;height:8px;border-top:1px solid #666;border-right:1px solid #666;right:-17px;bottom:7px;transform: rotate(135deg);}
                            .yixuan_div .yixuan2:after{content:'';position:absolute;width:8px;height:8px;border-top:1px solid #666;border-right:1px solid #666;right:-17px;bottom:3px;transform: rotate(-45deg);}
                            /**清单里的+ -**/
                            .buy_list .amount-input {color: #666;font-size: 12px;margin: 0;margin-top: 1px;padding: 3px;display: inline-block;height: 24px;border: 1px solid #a7a6ac;width: 36px;line-height: 24px;vertical-align: middle;}
                            .buy_list .amount-btn {display: inline-block;vertical-align: middle;margin-left: -0.8px;margin-top: 1px;}
                            .buy_list .amount-btn i {width: 16px;height: 14px;font-size: 12px;color: #666;display: inline-block;}
                            .buy_list  .amount-plus {width: 16px;height: 15px;overflow: hidden;cursor: pointer;border: 1px solid #a7a6ab;border-left: none;display: block;line-height: 14px;text-align: center;background: #f1f1f1;}
                            .buy_list .amount-minus {width: 16px;height: 14px;overflow: hidden;cursor: pointer;border: 1px solid #a7a6ab;border-left: none;border-top: none;display: block;line-height: 14px;text-align: center;background: #f1f1f1;}
                            .buy_list .amount-unit {vertical-align: middle;margin-left: 5px;}

                            /**商品计费详情**/
                            .buy_info{padding:10px 0;box-sizing:border-box;}
                            .buy_info .gi_label{font-size:15px;font-weight:600;width:70px;}
                            .buy_info .gi_otherfee_price,.buy_info .gi_otherfee_price2{position:relative;cursor:pointer;}
                            .buy_info .gi_otherfee_price:after{content:'';position: absolute;width:8px;height:8px;border-top:1px solid #666;border-right:1px solid #666;right:-20px;top:5px ;transform:rotate(135deg);}
                            .buy_info .gi_otherfee_price2:after{content:'';position: absolute;width:8px;height:8px;border-top:1px solid #666;border-right:1px solid #666;right:-20px;top:6px ;transform:rotate(-45deg);}
                            .buy_info .otherfee_div{padding: 20px;box-sizing: border-box;box-shadow: 0px 0px 10px 1px #999;position: absolute;top: 20px;left: 0px;background: #fff;z-index: 11;min-width:600px;}

                            /**购物优惠**/
                            .buy_info .preferential_div,.buy_info .see_prefe,.buy_info .see_prefe2{position:relative;cursor:pointer;}
                            .buy_info .see_prefe:after{content:'';position: absolute;width:8px;height:8px;border-top:1px solid #666;border-right:1px solid #666;right:-20px;top:5px ;transform:rotate(135deg);}
                            .buy_info .see_prefe2:after{content:'';position: absolute;width:8px;height:8px;border-top:1px solid #666;border-right:1px solid #666;right:-20px;top:6px ;transform:rotate(-45deg);}
                            .buy_info .prefe_info{padding: 20px;box-sizing: border-box;box-shadow: 0px 0px 10px 1px #999;position: absolute;top: 20px;left: 0px;background: #fff;z-index: 11;min-width: 700px;}
                            .buy_info .offer-title{padding-top:0;}
                            .buy_info .gift_common{display: block;border: 1px solid #666;padding: 5px 10px;}
                            .buy_info .gift_common .points_divName,.buy_info .gift_common .coupon_divName{margin-right:8px;}

                            /**订单随赠**/
                            .buy_info .prefeProduct_div,.buy_info .see_prefeProduct,.buy_info .see_prefeProduct2{position:relative;cursor:pointer;}
                            .buy_info .see_prefeProduct:after{content:'';position: absolute;width:8px;height:8px;border-top:1px solid #666;border-right:1px solid #666;right:-20px;top:5px ;transform:rotate(135deg);}
                            .buy_info .see_prefeProduct2:after{content:'';position: absolute;width:8px;height:8px;border-top:1px solid #666;border-right:1px solid #666;right:-20px;top:6px ;transform:rotate(-45deg);}
                            .buy_info .prefeProduct_info{padding: 20px;box-sizing: border-box;box-shadow: 0px 0px 10px 1px #999;position: absolute;top: 20px;left: 0px;background: #fff;z-index: 11;min-width: 400px;}

                            .layui-form input[type=checkbox], .layui-form input[type=radio], .layui-form select{display:block;}
                        </style>

                        <div class="buy_list" style="display:none;">
                            <div class="glist_form" style="display: none;">
                                <div style="position:relative;"><form action="/sada"></form></div>
                                <form class="layui-form" action="" method="post" lay-filter="glist-element">
                                    @csrf
                                    <div class="buy_table">

                                    </div>
                                    <div class="buy_info">
                                        <div class="goods_info">
                                            <div class="gi_num disf gi_border">
                                                <div class="gi_label">商品数量</div>
                                                <div class="gi_info disf">
                                                    <div class="gi_number"></div>
                                                    <div class="gi_unit">{{$sku_info[0]['sku_prices']['unit'][0]}}</div>
                                                </div>
                                            </div>
                                            <div class="gi_prices disf gi_border">
                                                <div class="gi_label">商品总价</div>
                                                <div class="gi_info disf">
                                                    <div class="gi_currency">{{$sku_info[0]['sku_prices']['currency'][0]}}</div>
                                                    <div class="gi_price">0</div>
                                                </div>
                                            </div>
                                            @if($goods['shop_id']>0)
                                                <div class="gi_otherfee disf gi_border">
                                                    <div class="gi_label">其他费用</div>
                                                    <div class="gi_info disf">
                                                        <div class="gi_otherfee_currency">{{$goods['otherfee_currency']}}</div>
                                                        <div class="gi_otherfee_price">
                                                            <div class="otherfee_price">{{$goods['otherfee_total']}}</div>
                                                            <div class="otherfee_div" style="display: none;">
                                                                <table class="layui-table">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>费用名称</th>
                                                                        <th>费用说明</th>
                                                                        <th>计费标准</th>
                                                                        <th>计费价格</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="gi_preferential disf gi_border">
                                                    <div class="gi_label">购物优惠</div>
                                                    <div class="gi_info disf">
                                                        <div class="preferential_div">
                                                            <div class="see_prefe">查看优惠</div>
                                                            <div class="prefe_info" style="display: none;">
                                                                <div class="offer-title"><div class="offer-title-icon"></div><div class="offer-title-content">减免优惠</div></div>
                                                                <table class="layui-table reduction_table">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>优惠类别</th>
                                                                        <th>减免项目</th>
                                                                        <th>减免金额</th>
                                                                        <th>减免限制</th>
                                                                        <th>操作</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                    </tbody>
                                                                </table>

                                                                <div class="offer-title" style="padding-top:15px;"><div class="offer-title-icon"></div><div class="offer-title-content">随赠优惠</div></div>
                                                                <table class="layui-table gift_table">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>优惠类别</th>
                                                                        <th>随赠项目</th>
                                                                        <th>随赠内容</th>
                                                                        <th>随赠限制</th>
                                                                        <th>操作</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="reduction_prices disf gi_border">
                                                    <div class="gi_label">优惠减免</div>
                                                    <div class="gi_info disf">
                                                        <div class="gi_currency">-&nbsp;{{$goods['reduction_content']['currency1'][0]}}</div>
                                                        <div class="reduction_price">0</div>
                                                    </div>
                                                </div>
                                                <div class="gift_prices disf gi_border" style="display: none;">
                                                    <div class="gi_label">抵扣费用</div>
                                                    <div class="gi_info disf">
                                                        <div class="gift_content">
                                                            <div class="disf">
                                                                <div class="points_divs gift_common" style="display: none;">
                                                                    <div class="disf">
                                                                        <div class="points_divName">积分</div>
                                                                        <div class="points_divCurrency"></div>
                                                                        <div class="points_divMoney"></div>
                                                                    </div>
                                                                </div>

                                                                <div class="coupon_divs gift_common" style="display: none;">
                                                                    <div class="disf">
                                                                        <div class="coupon_divName">卡券</div>
                                                                        <div class="coupon_divCurrency"></div>
                                                                        <div class="coupon_divMoney"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product_prices disf gi_border" style="display:none;">
                                                    <div class="gi_label">订单随赠</div>
                                                    <div class="gi_info disf">
                                                        <div class="prefeProduct_div">
                                                            <div class="see_prefeProduct">查看随赠</div>
                                                            <div class="prefeProduct_info" style="display: none;">
                                                                <table class="layui-table prefeProduct_table">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>类别</th>
                                                                        <th>内容</th>
                                                                        <th>数量</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="gi_pay disf gi_border">
                                                <div class="gi_label">实付费用</div>
                                                <div class="gipay_info disf">
                                                    <div class="gipay_currency">{{$sku_info[0]['sku_prices']['currency'][0]}}</div>
                                                    <div class="gipay_price">0</div>
                                                </div>
                                            </div>
                                            @if(isset($goods['platform_valueInfo']['perform_type']))
                                                <div class="gi_attention disf gi_border" style="margin-top:10px;">
                                                    <div class="gi_label" style="text-align: right;padding-right: 11px;box-sizing: border-box;">注意</div>
                                                    <div class="giattention_info disf" style="width: 80%;">
                                                        {{--                                                        <img src="/images/gantanhao.png" class="attention_info gantan">--}}
                                                        {{$goods['platform_valueInfo']['msg']}}
                                                    </div>
                                                </div>
                                                @if($goods['platform_valueInfo']['perform_type']==1)
                                                    <div class="gi_file_div" style="display:none;background:#fff;">
                                                        <div class="layui-btn layui-btn-normal" style="background:#d3d3d3;position:absolute;right:0;top:0;font-size: 25px;padding: 0 15px;" onclick="cancel_buy()">×</div>
                                                        <div class="gi_file disf gi_border" style="margin-top:10px;">
                                                            <div class="gi_label">文件上传</div>
                                                            <div class="gifile_info disf" style="width: 80%;">
                                                                <div class="layui-upload" style="text-align:left;width: 100%;">
                                                                    <button type="button" class="layui-btn" id="supervise_file-upload">上传文件</button>
                                                                    <blockquote class="layui-elem-quote layui-quote-nm yulan" style="margin-top: 10px;">
                                                                        预览图：
                                                                        <div class="layui-upload-list" id="supervise_file-upload-list"></div>
                                                                    </blockquote>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="upload_file_footer">
                                                            <button class="layui-btn layui-btn-normal" lay-submit lay-filter="glist-element2" style="background:#ff0000;margin-left:70px;">立即购买</button>
                                                        </div>
                                                    </div>
                                                @elseif($goods['platform_valueInfo']['perform_type']==2 && $goods['platform_valueInfo']['drug']['value']['value']>=4)
                                                <!--在线申请-->

                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div class="buy_footer disf">
                                        @if(!isset($goods['platform_valueInfo']['perform_type']))
                                            <button class="layui-btn layui-btn-normal" lay-submit lay-filter="glist-element2" style="background:#ff0000;">立即购买</button>
                                        @else
                                            @if($goods['platform_valueInfo']['perform_type']==1)
                                                <div class="layui-btn layui-btn-normal" style="background:#ff0000;" onclick="goto_buy()">上传文件</div>
                                            @elseif($goods['platform_valueInfo']['perform_type']==2 && $goods['platform_valueInfo']['drug']['value']['value']>=4)
                                            <!--在线申请-->
                                                <button class="layui-btn layui-btn-normal" lay-submit lay-filter="apply-element" style="background:#ff0000;">在线申请</button>
                                            @endif
                                            <div class="layui-btn layui-btn-normal" style="background:#d3d3d3;" onclick="giveup_buy()">放弃购买</div>
                                        @endif
                                    </div>
                                </form>
                            </div>
                            <div class="yixuan_div">
                                <div class="yixuan" onclick="show_glist(this)">已选清单</div>
                            </div>
                        </div>


                        <!-- 加入购物车按钮、手机购买 -->
                        <div class="action" style="display: none;">

                            <div class="btn-buy">
                                <a href="javascript:void(0);" class="buy-goods color ">
                                    <span class="buy-goods-bg bg-color"></span>
                                    <span class="buy-goods-border"></span>
                                    立即购买					</a>
                            </div>
                            <!-- 判断不能加入购物车的商品 -->

                            <div class="btn-buy">
                                <a href="javascript:void(0);" class="add-cart bg-color ">
                                    <i class="iconfont">&#xe6a8;</i>
                                    加入购物车
                                </a>
                            </div>

                            <div class="btn-phone">
                                <a href="javascript:void(0);" class="go-phone">
                                    <span>手机购买</span>
                                    <i class="iconfont">&#xe6bc;</i>
                                    <div id="phone-tan">
                                        <span class="arr"></span>
                                        <div class="m-qrcode-wrap">
                                            <img src="/goods/qrcode.html?id={{ $goods['goods_id'] }}" width="100" height="100" />
                                        </div>
                                    </div>
                                </a>
                            </div>


                        </div>

                        <!-- 服务承诺 -->
                        {{--保障服务 如果无保障服务 不显示--}}
                        @if(!empty($goods['contract_list']))
                            <dl class="service">
                                <dt class="dt">服务承诺</dt>
                                <dd class="dd">
                                    <ul class="contract-list">

                                        @foreach($goods['contract_list'] as $v)
                                            <li>
                                                <a href="javascript:void(0);" title="{{ $v['contract_desc'] }}">
                                                    <img src="{{ get_image_url($v['contract_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_16,w_16" />
                                                    <span>{{ $v['contract_name'] }}</span>
                                                </a>
                                            </li>
                                        @endforeach

                                    </ul>
                                </dd>
                            </dl>
                        @endif

                    </div>

                    <!-- 在售的商品 _end -->

                </form>
            </div>
            <script id="SZY_SKU_LIST" type="text">
                {{--sku list--}}
                {!! json_encode($goods['sku_list']) !!}
            </script>
            <script type="text/javascript">
                var sku_ids = [];
                var local_region_code = "{{ $region_code }}";
                var sku_freights = [];
                var change_sku_images = false;

                //购物清单---start
                //加入购物清单
                function join_list(){
                    var $ = layui.$
                        , form = layui.form
                        , layer = layui.layer;
                    if("{{session('user.user_id')}}" ==''){
                        $.login.show();
                        return false;
                    }
                    if("{{$goods['have_specs']}}"==1){
                        //有规格
                        let attr = $('.SZY-GOODS-SPEC-ITEMS').find('.attr');
                        let attr_arr = [];
                        let spec_ids = '';
                        let attr_ids = '';
                        for(let i=0;i<attr.length;i++){
                            //获取规格信息
                            let spec_name = $('.SZY-GOODS-SPEC-ITEMS').find('.attr').eq(i).find('.dt').text();
                            let spec_id = $('.SZY-GOODS-SPEC-ITEMS').find('.attr').eq(i).find('ul .selected').data('spec-id');
                            let attr_id = $('.SZY-GOODS-SPEC-ITEMS').find('.attr').eq(i).find('ul .selected').data('attr-id');
                            let attr_name = $('.SZY-GOODS-SPEC-ITEMS').find('.attr').eq(i).find('ul .selected a span').text();
                            attr_arr.unshift([spec_name,spec_id,attr_id,attr_name]);

                            //整理规格类别和值
                            spec_ids += spec_id+'_';
                            attr_ids += attr_id+'_';
                            // console.log(spec_name+' '+spec_id+' , '+attr_id+' '+attr_name);
                        }
                        //整理规格类别和值，去除最后一位符号
                        spec_ids = spec_ids.slice(0, -1);
                        attr_ids = attr_ids.slice(0, -1);

                        //整理成规格名称
                        let attr_name = '';
                        for(let i=0;i<attr_arr.length;i++){
                            attr_name += attr_arr[i][0]+'：'+attr_arr[i][3]+'，';
                        }
                        attr_name = attr_name.slice(0, -1);
                        // console.log(attr_name);

                        //获取数量
                        let amount_num = $('.amount_num').find('.amount-input').val();
                        $('.amount_num').find('.amount-input').val(1);
                        let amount_nummax = $('.amount_num').find('.amount-input').attr('data-amount-max');

                        if($('.buy_list .buy_table').children().length == 0){
                            let html = '                       <table class="layui-table">\n' +
                                '                                    <thead>\n' +
                                '                                        <tr>\n' +
                                '                                            <th>规格名称</th>\n' +
                                '                                            <th>购买数量</th>\n' +
                                '                                            <th>商品总额</th>\n' +
                                '                                            <th>操作</th>\n' +
                                '                                        </tr>\n' +
                                '                                    </thead>\n' +
                                '                                    <tbody>\n' +
                                '                                        <tr class="spec_'+attr_ids+'">\n' +
                                '                                            <td title="'+attr_name+'">\n' +
                                '                                                '+attr_name+'\n' +
                                '                                                <input type="text" name="attr_name[]" value="'+attr_name+'" class="attr_name" style="display: none;">\n'+
                                '                                                <input type="text" name="spec_ids[]" value="'+spec_ids+'" class="spec_ids" style="display: none;">\n'+
                                '                                                <input type="text" name="attr_ids[]" value="'+attr_ids+'" class="attr_ids" style="display: none;">\n'+
                                '                                            </td>\n' +
                                '                                            <td>' +
                                '                                                <span class="amount-widget" style="display:flex;">\n' +
                                '                                                  <input type="text" name="buynum[]" class="amount-input buynum" value="'+amount_num+'"\n' +
                                '                                                    data-amount-min="1"\n' +
                                '                                                    data-amount-max="'+amount_nummax+'"\n' +
                                '                                                    maxlength="8" title="请输入购买量" onchange="buynum(this)">\n' +
                                '                                                  <span class="amount-btn">\n' +
                                '                                                     <span class="amount-plus" onclick="add_num(this,'+amount_nummax+')">\n' +
                                '                                                        <i>+</i>\n' +
                                '                                                     </span>\n' +
                                '                                                    <span class="amount-minus" onclick="reduction_num(this)">\n' +
                                '                                                        <i>-</i>\n' +
                                '                                                    </span>\n' +
                                '                                                  </span>\n' +
                                '                                                <span class="amount-unit" style="display:none;">{{$sku_info[0]['sku_prices']['unit'][0]}}</span>\n' +
                                '                                                  <span class="amount-unit" style="margin-left:10px;"></span>\n' +
                                '                                                </span>\n'+
                                '                                            </td>\n' +
                                '                                            <td>{{$sku_info[0]['sku_prices']['currency'][0]}}<span class="now_gprice"></span><input type="text" name="now_gprice[]" value="" class="now_gpriceinput" style="display: none;"></td>\n'+
                                '                                            <td><div class="layui-btn layui-btn-danger layui-btn-md" onclick="del_glist(this)">×</td>\n' +
                                '                                        </tr>\n' +
                                '                                    </tbody>\n' +
                                '                                </table>';

                            $('.buy_table').html(html);
                            form.render(null,'glist-element');
                            $('.buy_list').show();
                            calc_method(attr_ids,amount_num);
                        }
                        else{
                            //已有内容，判断是否已添加过此规格
                            if($('.glist_form').find('.spec_'+attr_ids).length==0){
                                let html = '                                   <tr class="spec_'+attr_ids+'">\n' +
                                    '                                            <td title="'+attr_name+'">\n' +
                                    '                                                '+attr_name+'\n' +
                                    '                                                <input type="text" name="attr_name[]" value="'+attr_name+'" class="attr_name" style="display: none;">\n'+
                                    '                                                <input type="text" name="spec_ids[]" value="'+spec_ids+'" class="spec_ids" style="display: none;">\n'+
                                    '                                                <input type="text" name="attr_ids[]" value="'+attr_ids+'" class="attr_ids" style="display: none;">\n'+
                                    '                                            </td>\n' +
                                    '                                            <td>' +
                                    '                                                <span class="amount-widget" style="display:flex;">\n' +
                                    '                                                  <input type="text" name="buynum[]" class="amount-input buynum" value="'+amount_num+'"\n' +
                                    '                                                    data-amount-min="1"\n' +
                                    '                                                    data-amount-max="'+amount_nummax+'"\n' +
                                    '                                                    maxlength="8" title="请输入购买量" onchange="buynum(this)">\n' +
                                    '                                                  <span class="amount-btn">\n' +
                                    '                                                     <span class="amount-plus" onclick="add_num(this,'+amount_nummax+')">\n' +
                                    '                                                        <i>+</i>\n' +
                                    '                                                     </span>\n' +
                                    '                                                    <span class="amount-minus" onclick="reduction_num(this)">\n' +
                                    '                                                        <i>-</i>\n' +
                                    '                                                    </span>\n' +
                                    '                                                  </span>\n' +
                                    '                                                <span class="amount-unit" style="display:none;">{{$sku_info[0]['sku_prices']['unit'][0]}}</span>\n' +
                                    '                                                  <span class="amount-unit" style="margin-left:10px;"></span>\n' +
                                    '                                                </span>\n'+
                                    '                                            </td>\n' +
                                    '                                            <td>{{$sku_info[0]['sku_prices']['currency'][0]}}<span class="now_gprice"></span><input type="text" name="now_gprice[]" value="" class="now_gpriceinput" style="display: none;"></td>\n'+
                                    '                                            <td><div class="layui-btn layui-btn-danger layui-btn-md" onclick="del_glist(this)">×</td>\n' +
                                    '                                        </tr>\n';
                                $('.buy_table tbody').append(html);
                                form.render(null,'glist-element');
                                calc_method(attr_ids,amount_num);
                            }
                            else{
                                let max_num = $('.spec_'+attr_ids).find('.amount-input').attr('data-amount-max');
                                let ori_val =  $('.spec_'+attr_ids).find('.amount-input').val();
                                ori_val = parseInt(ori_val) + parseInt(amount_num);
                                if(ori_val>max_num){
                                    //超出最大库存
                                    $('.spec_'+attr_ids).find('.amount-input').val(max_num);
                                    calc_method(attr_ids,max_num);
                                }else{
                                    //低于最大库存
                                    $('.spec_'+attr_ids).find('.amount-input').val(ori_val);
                                    calc_method(attr_ids,ori_val);
                                }
                            }
                        }
                    }
                    else if("{{$goods['have_specs']}}"==2){
                        //无规格

                        //1、获取数量
                        let amount_num = $('.amount_num').find('.amount-input').val();
                        $('.amount_num').find('.amount-input').val(1);
                        let amount_nummax = $('.amount_num').find('.amount-input').attr('data-amount-max');
                        let attr_ids = 0;

                        if($('.buy_list .buy_table').children().length == 0){
                            let html = '                       <table class="layui-table">\n' +
                                '                                    <thead>\n' +
                                '                                        <tr>\n' +
                                '                                            <th>购买数量</th>\n' +
                                '                                            <th>商品总额</th>\n' +
                                '                                            <th>操作</th>\n' +
                                '                                        </tr>\n' +
                                '                                    </thead>\n' +
                                '                                    <tbody>\n' +
                                '                                        <tr class="spec_'+attr_ids+'">\n' +
                                '                                            <td>' +
                                '                                                <span class="amount-widget" style="display:flex;">\n' +
                                '                                                  <input type="text" name="buynum[]" class="amount-input buynum" value="'+amount_num+'"\n' +
                                '                                                    data-amount-min="1"\n' +
                                '                                                    data-amount-max="'+amount_nummax+'"\n' +
                                '                                                    maxlength="8" title="请输入购买量" onchange="buynum(this)">\n' +
                                '                                                  <span class="amount-btn">\n' +
                                '                                                     <span class="amount-plus" onclick="add_num(this,'+amount_nummax+')">\n' +
                                '                                                        <i>+</i>\n' +
                                '                                                     </span>\n' +
                                '                                                    <span class="amount-minus" onclick="reduction_num(this)">\n' +
                                '                                                        <i>-</i>\n' +
                                '                                                    </span>\n' +
                                '                                                  </span>\n' +
                                '                                                <span class="amount-unit" style="display:none;">{{$sku_info[0]['sku_prices']['unit'][0]}}</span>\n' +
                                '                                                  <span class="amount-unit" style="margin-left:10px;"></span>\n' +
                                '                                                </span>\n'+
                                '                                            </td>\n' +
                                '                                            <td>{{$sku_info[0]['sku_prices']['currency'][0]}}<span class="now_gprice"></span><input type="text" name="now_gprice[]" value="" class="now_gpriceinput" style="display: none;"></td>\n'+
                                '                                            <td><div class="layui-btn layui-btn-danger layui-btn-md" onclick="del_glist(this)">×</td>\n' +
                                '                                        </tr>\n' +
                                '                                    </tbody>\n' +
                                '                                </table>';

                            $('.buy_table').html(html);
                            form.render(null,'glist-element');
                            $('.buy_list').show();
                            calc_method(attr_ids,amount_num);
                        }
                        else{
                            //已有内容，判断是否已添加过此规格
                            let max_num = $('.spec_'+attr_ids).find('.amount-input').attr('data-amount-max');
                            let ori_val =  $('.spec_'+attr_ids).find('.amount-input').val();
                            ori_val = parseInt(ori_val) + parseInt(amount_num);
                            if(ori_val>max_num){
                                //超出最大库存
                                $('.spec_'+attr_ids).find('.amount-input').val(max_num);
                                calc_method(attr_ids,max_num);
                            }else{
                                //低于最大库存
                                $('.spec_'+attr_ids).find('.amount-input').val(ori_val);
                                calc_method(attr_ids,ori_val);
                            }
                        }
                    }
                }

                //其他费用
                $(function(){
                    //其他费用
                    $('.gi_otherfee_price').click(function(){
                        if($('.otherfee_div').css('display')=='none'){
                            $('.otherfee_div').show();
                            $('.gi_otherfee_price').removeClass('gi_otherfee_price').addClass('gi_otherfee_price2');
                        }else{
                            $('.otherfee_div').hide();
                            $('.gi_otherfee_price2').removeClass('gi_otherfee_price2').addClass('gi_otherfee_price');
                        }
                    });

                    //其他优惠
                    $('.see_prefe').click(function(){
                        if($('.prefe_info').css('display')=='none'){
                            $('.prefe_info').show();
                            $('.see_prefe').removeClass('see_prefe').addClass('see_prefe2');
                        }else{
                            $('.prefe_info').hide();
                            $('.see_prefe2').removeClass('see_prefe2').addClass('see_prefe');
                        }
                    });

                    //订单随赠
                    $('.see_prefeProduct').click(function(){
                        if($('.prefeProduct_info').css('display')=='none'){
                            $('.prefeProduct_info').show();
                            $('.see_prefeProduct').removeClass('see_prefeProduct').addClass('see_prefeProduct2');
                        }else{
                            $('.prefeProduct_info').hide();
                            $('.see_prefeProduct2').removeClass('see_prefeProduct2').addClass('see_prefeProduct');
                        }
                    });
                });

                //删除当前清单信息
                function del_glist(t){
                    var $ = layui.$
                        , form = layui.form
                        , layer = layui.layer;

                    let del_num = $(t).parents(":eq(1)").find('td').eq(1).find('.amount-input').val();
                    let gi_number = parseInt($('.gi_number').text()) - parseInt(del_num);
                    $('.gi_number').text(gi_number);

                    $(t).parents(":eq(1)").remove();
                    calc_method();
                }

                //显示购物清单
                function show_glist(t){
                    if($(t).hasClass('yixuan')){
                        $(t).removeClass('yixuan').addClass('yixuan2');
                        $('.glist_form').show();
                    }else{
                        $(t).removeClass('yixuan2').addClass('yixuan');
                        $('.glist_form').hide();
                    }
                }

                //添加清单下的数量
                function add_num(t,max_num){
                    var $ = layui.$
                        , form = layui.form
                        , layer = layui.layer;

                    let val = $(t).parents(':eq(2)').find('.amount-input').val();
                    val = parseInt(val)+1;
                    if(val<=parseInt(max_num)){
                        $(t).parents(':eq(2)').find('.amount-input').val(val);
                        let attr_ids = '0';
                        @if($goods['have_specs']==1)
                            attr_ids = $(t).parents(":eq(3)").find('td').eq(0).find('.attr_ids').val();
                        @endif
                        calc_method(attr_ids,val);
                    }
                }

                //减少清单下的数量
                function reduction_num(t){
                    var $ = layui.$
                        , form = layui.form
                        , layer = layui.layer;
                    let val = $(t).parents(':eq(2)').find('.amount-input').val();
                    val = parseInt(val)-1;
                    if(val>0){
                        $(t).parents(':eq(2)').find('.amount-input').val(val);
                        let attr_ids = '0';
                        @if($goods['have_specs']==1)
                            attr_ids = $(t).parents(":eq(3)").find('td').eq(0).find('.attr_ids').val();
                        @endif
                        calc_method(attr_ids,val);
                    }
                }

                //数量框变化(可能有错)
                function buynum(t){
                    var $ = layui.$
                        , form = layui.form
                        , layer = layui.layer;

                    calc_method();
                }

                //统计数量等信息
                function calc_method(attr_ids='0',buy_num=0){
                    var layer = layui.layer
                        ,$ = layui.jquery;

                    layer.load();
                    //统计数量+
                    let pre_tr = $('.buy_table tbody').find('tr');
                    let total = 0;
                    for(let i=0;i<pre_tr.length;i++){
                        let val = 0;
                        if(attr_ids==0){
                            val = $('.buy_table tbody').find('tr').eq(i).find('td').eq(0).find('.amount-input').val();
                        }else{
                            val = $('.buy_table tbody').find('tr').eq(i).find('td').eq(1).find('.amount-input').val();
                        }
                        total = total + parseInt(val);
                    }
                    $('.gi_number').text(total);
                    //统计金额
                    var total_price = 0;
                    for(let i=0;i<pre_tr.length;i++) {
                        if(i==0){
                            total_price = 0;
                        }
                        let attr_ids2 = '';
                        let buy_num = 0;
                        if(attr_ids==0){
                            attr_ids2 = '';
                            buy_num = $('.buy_table tbody').find('tr').eq(i).find('td').eq(0).find('.amount-input').val();
                        }else{
                            attr_ids2 = $('.buy_table tbody').find('tr').eq(i).find('td').eq(0).find('.attr_ids').val();
                            buy_num = $('.buy_table tbody').find('tr').eq(i).find('td').eq(1).find('.amount-input').val();
                        }
                        $.getJSON("/calc", {
                            'attr_ids': attr_ids2,
                            'buy_num': buy_num,
                            'gid': "{{$goods['goods_id']}}"
                        }, function (res) {
                            let eq = 2;
                            if(attr_ids==0){
                                eq = 1;
                            }
                            $('.buy_table tbody').find('tr').eq(i).find('td').eq(eq).find('.now_gprice').text(res.data.price);
                            $('.buy_table tbody').find('tr').eq(i).find('td').eq(eq).find('.now_gpriceinput').val(res.data.price);
                            total_price = parseFloat(total_price) + parseFloat(res.data.price);
                            $('.gi_price').text(total_price);
                        });

                        if(i+1==pre_tr.length){
                            setTimeout(function(){
                                //计算其他费用+优惠减免
                                $.getJSON("/calc_otherfee", {
                                    'total_price': $('.gi_price').text(),
                                    'total': total,
                                    'gid': "{{$goods['goods_id']}}"
                                }, function (res) {
                                    //其他费用
                                    let html = '';
                                    if(res.data.otherfee_content.name[0]!=''){
                                        for(let i=0;i<res.data.otherfee_content.name.length;i++){
                                            html += '<tr>' +
                                                '        <td>'+res.data.otherfee_content.name[i]+'</td>\n'+
                                                '        <td>'+res.data.otherfee_content.desc[i]+'</td>\n'+
                                                '        <td>'+res.data.otherfee_content.otherfee_standard_name[i]+'</td>\n'+
                                                '        <td>'+res.data.otherfee_currency+' '+res.data.otherfee_content.price[i]+'</td>\n'+
                                                '    </tr>';
                                        }
                                        if($('.otherfee_div tbody tr').length==0){
                                            $('.otherfee_div tbody').append(html);
                                        }else{
                                            $('.otherfee_div tbody').html(html);
                                        }
                                        $('.gi_otherfee_price .otherfee_price').text(res.data.otherfee_total);
                                    }

                                    //优惠减免
                                    let html2 = '';
                                    if(res.data.reduction.length>0){
                                        for(let i=0;i<res.data.reduction.length;i++){
                                            html2 += '<tr>' +
                                                '        <td>'+res.data.reduction[i]['preferential_blong_name']+'</td>\n'+
                                                '        <td>'+res.data.reduction[i]['project_name']+'（'+res.data.reduction[i]['content'][0]+res.data.reduction[i]['price1']+res.data.reduction[i]['content'][2]+res.data.reduction[i]['price2']+'）</td>\n'+
                                                '        <td>-&nbsp;'+res.data.reduction[i]['currency1'][0]+res.data.reduction[i]['price2']+'</td>\n'+
                                                '        <td>'+res.data.reduction[i]['strict_name']+'</td>\n'+
                                                '        <td><input type="checkbox" name="reduction[]" value="'+i+'" class="prefe_reduction reduction_'+res.data.reduction[i]['strict']+'" title="" lay-skin="primary" data-strict="'+res.data.reduction[i]['strict']+'" data-type="'+res.data.reduction[i]['type']+'" data-reduction_currency="'+res.data.reduction[i]['currency1']+'" data-reduction_price="'+res.data.reduction[i]['price2']+'" onclick="select_reduction(this,'+i+')">\n'+
                                                '    </tr>';
                                        }

                                        if($('.reduction_table tbody tr').length==0){
                                            $('.reduction_table tbody').append(html2);
                                        }else{
                                            $('.reduction_table tbody').html(html2);
                                        }
                                    }

                                    //优惠随赠
                                    let html3 = '';
                                    if(res.data.gift.length>0){
                                        for(let i=0;i<res.data.gift.length;i++){
                                            if(res.data.gift[i]['type']==1){
                                                //积分
                                                html3 += '<tr>' +
                                                    '        <td>'+res.data.gift[i]['preferential_blong_name']+'</td>\n'+
                                                    '        <td>'+res.data.gift[i]['type_name']+'</td>\n'+
                                                    '        <td>'+res.data.gift[i]['points_typeName']+res.data.gift[i]['points_send']+'分</td>\n'+
                                                    '        <td>'+res.data.gift[i]['strict_name']+'</td>\n'+
                                                    '        <td><input type="checkbox" name="gift[]" value="'+i+'" class="prefe_gift reduction_'+res.data.gift[i]['strict']+'" title="" lay-skin="primary" data-strict="'+res.data.gift[i]['strict']+'" data-points_send="'+res.data.gift[i]['points_send']+'" data-operaer="'+res.data.gift[i]['operaer']+'" data-points_type="'+res.data.gift[i]['points_type']+'" data-points_currency="'+res.data.gift[i]['points_currency']+'" data-points_money="'+res.data.gift[i]['points_money']+'" data-type="'+res.data.gift[i]['type']+'" onclick="select_gift(this,'+i+','+res.data.gift[i]['type']+')"></td>\n'+
                                                    '    </tr>';
                                            }else if(res.data.gift[i]['type']==2){
                                                //卡券
                                                html3 += '<tr>' +
                                                    '        <td>'+res.data.gift[i]['preferential_blong_name']+'</td>\n'+
                                                    '        <td>'+res.data.gift[i]['type_name']+'</td>\n'+
                                                    '        <td>价值'+res.data.gift[i]['coupon_currency']+res.data.gift[i]['coupon_money']+'×'+res.data.gift[i]['coupon_num']+'张</td>\n'+
                                                    '        <td>'+res.data.gift[i]['strict_name']+'</td>\n'+
                                                    '        <td><input type="checkbox" name="gift[]" value="'+i+'" class="prefe_gift reduction_'+res.data.gift[i]['strict']+'" title="" lay-skin="primary" data-strict="'+res.data.gift[i]['strict']+'" data-operaer="'+res.data.gift[i]['operaer']+'" data-coupon_currency="'+res.data.gift[i]['coupon_currency']+'" data-coupon_money="'+res.data.gift[i]['coupon_money']+'" data-coupon_num="'+res.data.gift[i]['coupon_num']+'" data-type="'+res.data.gift[i]['type']+'" onclick="select_gift(this,'+i+','+res.data.gift[i]['type']+')"></td>\n'+
                                                    '    </tr>';
                                            }else if(res.data.gift[i]['type']==3){
                                                //随赠
                                                html3 += '<tr>' +
                                                    '        <td>'+res.data.gift[i]['preferential_blong_name']+'</td>\n'+
                                                    '        <td>'+res.data.gift[i]['type_name']+'（'+res.data.gift[i]['accgift_typeName']+'）</td>\n'+
                                                    '        <td>'+res.data.gift[i]['accgift_content']+'*'+res.data.gift[i]['accgift_num']+'</td>\n'+
                                                    '        <td>'+res.data.gift[i]['strict_name']+'</td>\n'+
                                                    '        <td><input type="checkbox" name="gift[]" value="'+i+'" class="prefe_gift reduction_'+res.data.gift[i]['strict']+'" title="" lay-skin="primary" data-strict="'+res.data.gift[i]['strict']+'" data-accgift_content="'+res.data.gift[i]['accgift_content']+'" data-accgift_num="'+res.data.gift[i]['accgift_num']+'" data-accgift_type="'+res.data.gift[i]['accgift_type']+'" data-accgift_typeName="'+res.data.gift[i]['accgift_typeName']+'" data-type="'+res.data.gift[i]['type']+'" onclick="select_gift(this,'+i+','+res.data.gift[i]['type']+')"></td>\n'+
                                                    '    </tr>';
                                            }

                                            if($('.gift_table tbody tr').length==0){
                                                $('.gift_table tbody').append(html3);
                                            }else{
                                                $('.gift_table tbody').html(html3);
                                            }
                                        }
                                    }

                                    //统计实付金额
                                    calc_totalmoney(0);
                                });

                                layer.closeAll('loading');
                            },2000);
                        }
                    }

                    //重新选择时，隐藏并清空已选优惠
                    hide_preferential();
                }

                //统计实付金额
                function calc_totalmoney(timer=0){
                    setTimeout(function(){
                        let gi_price = $('.gi_price').text();
                        let otherfee_price = $('.otherfee_price').text();
                        let reduction_price = $('.reduction_price').text();
                        if(reduction_price==''){reduction_price=0;}
                        let points_divMoney = $('.points_divMoney').text();//积分金额
                        if(points_divMoney==''){points_divMoney=0;}
                        let coupon_divMoney = $('.coupon_divMoney').text();//优惠券金额
                        if(coupon_divMoney==''){coupon_divMoney=0;}
                        let totalprice = parseFloat(gi_price) + parseFloat(otherfee_price) - parseFloat(reduction_price) - parseFloat(points_divMoney) - parseFloat(coupon_divMoney);
                        $('.gipay_price').text(totalprice);
                    },timer);
                }

                //隐藏所有优惠
                function hide_preferential(){
                    $('.coupon_divCurrency').text('');
                    $('.coupon_divCurrency').text('');
                    $('.coupon_divs').hide();
                    $('.points_divCurrency').text('');
                    $('.points_divMoney').text('');
                    $('.points_divs').hide();
                    $('.reduction_price').text(0);

                    $('.coupon_divs').hide();
                    $('.gift_prices').hide();
                    $('.product_prices').hide();
                }

                //选择随赠优惠
                function select_gift(t,idx,typ){
                    let strict = $(t).attr('data-strict');
                    let gift_tr = $('.gift_table tbody tr');
                    if(typ==1){
                        //积分
                        let points_divCurrency = $(t).attr('data-points_currency');
                        let points_send = $(t).attr('data-points_send');
                        $('.points_divCurrency').text(points_divCurrency);
                        $('.points_divMoney').text(points_send);
                        $('.gift_prices .points_divs').css('display','block');
                        $('.gift_prices').css('display','flex');

                        if(strict==1){
                            $('.coupon_divCurrency').text('');
                            $('.coupon_divMoney').text('');
                            $('.coupon_divs').hide();
                            $('.product_prices').hide();

                            for(let i=0;i<gift_tr.length;i++){
                                if(i!=idx){
                                    $('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').prop('checked',false);
                                    if(typ!=$('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').attr('data-type')){
                                        hide_preferential2($('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').attr('data-type'));
                                    }
                                }else{
                                    if($('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').is(":checked")==false){
                                        hide_preferential2($('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').attr('data-type'));
                                    }
                                }
                            }
                        }else if(strict==2){
                            for(let i=0;i<gift_tr.length;i++){
                                if(i!=idx){
                                    if($('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').attr('data-strict')==1 && $('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').is(":checked")==true){
                                        $('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').prop('checked',false);
                                        if($('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').attr('data-type')!=typ) {
                                            hide_preferential2($('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').attr('data-type'));
                                        }
                                    }
                                }else{
                                    if($('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').is(":checked")==false){
                                        hide_preferential2($('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').attr('data-type'));
                                    }
                                }
                            }
                        }
                    }
                    else if(typ==2){
                        //卡券
                        let coupon_divCurrency = $(t).attr('data-coupon_currency');
                        let coupon_divMoney = $(t).attr('data-coupon_money');
                        let coupon_num = $(t).attr('data-coupon_num');
                        $('.coupon_divCurrency').text(coupon_divCurrency);
                        $('.coupon_divMoney').text(coupon_divMoney*coupon_num);
                        $('.gift_prices .coupon_divs').css('display','block');
                        $('.gift_prices').css('display','flex');
                        if(strict==1){
                            $('.points_divCurrency').text('');
                            $('.points_divMoney').text('');
                            $('.points_divs').hide();
                            $('.product_prices').hide();
                            for(let i=0;i<gift_tr.length;i++){
                                if(i!=idx){
                                    $('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').prop('checked',false);
                                    if(typ!=$('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').attr('data-type')){
                                        hide_preferential2($('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').attr('data-type'));
                                    }
                                }else{
                                    if($('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').is(":checked")==false){
                                        hide_preferential2($('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').attr('data-type'));
                                    }
                                }
                            }
                        }else if(strict==2){
                            for(let i=0;i<gift_tr.length;i++){
                                if(i!=idx){
                                    if($('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').attr('data-strict')==1 && $('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').is(":checked")==true){
                                        $('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').prop('checked',false);
                                        if($('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').attr('data-type')!=typ){
                                            hide_preferential2($('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').attr('data-type'));
                                        }
                                    }
                                }else{
                                    if($('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').is(":checked")==false){
                                        hide_preferential2($('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').attr('data-type'));
                                    }
                                }
                            }
                        }
                    }
                    else if(typ==3){
                        //随赠
                        let accgift_typename = $(t).attr('data-accgift_typename');
                        let accgift_content = $(t).attr('data-accgift_content');
                        let accgift_num = $(t).attr('data-accgift_num');

                        let html = '<tr class="tr_'+accgift_content+'">\n'+
                            '              <td>'+accgift_typename+'</td>\n'+
                            '              <td>'+accgift_content+'</td>\n'+
                            '              <td>'+accgift_num+'</td>\n'+
                            '           </tr>';
                        let prefe_table_tr = $('.prefeProduct_table tbody').find('tr');
                        if(prefe_table_tr.length==0){
                            $('.prefeProduct_table tbody').html(html);
                        }else{
                            if($('.prefeProduct_table tbody').find('.tr_'+accgift_content).length==0){
                                //没出现
                                $('.prefeProduct_table tbody').append(html);
                            }else{
                                $('.prefeProduct_table tbody').find('.tr_'+accgift_content).remove();
                            }
                        }

                        if(strict==1){
                            $('.points_divCurrency').text('');
                            $('.points_divMoney').text('');
                            $('.points_divs').hide();
                            $('.coupon_divCurrency').text('');
                            $('.coupon_divMoney').text('');
                            $('.coupon_divs').hide();
                            $('.gift_prices').hide();
                            $('.product_prices').show();
                            for(let i=0;i<gift_tr.length;i++){
                                if(i!=idx){
                                    $('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').prop('checked',false);
                                    hide_preferential2($('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').attr('data-type'));
                                }
                            }
                        }else if(strict==2){
                            for(let i=0;i<gift_tr.length;i++){
                                if(i!=idx){
                                    if($('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').attr('data-strict')==1 && $('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').is(":checked")==true){
                                        $('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').prop('checked',false);
                                        hide_preferential2($('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').attr('data-type'));
                                    }
                                }
                                // else{
                                //     if($('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').is(":checked")==false){
                                //         hide_preferential2($('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').attr('data-type'));
                                //     }
                                // }
                            }
                        }
                        $('.product_prices').show();
                    }

                    //统计实付金额
                    calc_totalmoney(1800);
                }

                //遇到单独的随赠奖励就隐藏前端样式
                function hide_preferential2(typ=0){
                    if(typ==1){
                        $('.points_divCurrency').text('');
                        $('.points_divMoney').text('');
                        $('.points_divs').hide();
                    }else if(typ==2){
                        $('.coupon_divCurrency').text('');
                        $('.coupon_divMoney').text('');
                        $('.coupon_divs').hide();
                    }else if(typ==3){
                        $('.product_prices').hide();
                        $('.product_prices').find('.prefeProduct_table tbody').html("");
                    }
                }

                //选择减免优惠
                function select_reduction(t,idx){
                    let strict = $(t).attr('data-strict');
                    let price = $(t).attr('data-reduction_price');
                    let reduction_tr = $('.reduction_table tbody tr');
                    let reduction_price = 0;
                    if(strict==1){
                        //单独
                        for(let i=0;i<reduction_tr.length;i++){
                            if(i!=idx){
                                $('.reduction_table tbody tr').eq(i).find('td').eq(4).find('input').prop('checked',false);
                                reduction_price = parseFloat(price);
                            }else{
                                if(reduction_tr.length==1){
                                    //只有一个优惠的情况
                                    reduction_price = parseFloat(price);
                                }else if($('.reduction_table tbody tr').eq(i).find('td').eq(4).find('input').is(":checked") == false){
                                    //取消时，价格为0
                                    reduction_price = 0;
                                }
                            }
                        }
                    }else if(strict==2){
                        //叠加
                        for(let i=0;i<reduction_tr.length;i++) {
                            $('.reduction_table tbody tr').eq(i).find('td').eq(4).find('.reduction_1').prop('checked', false);
                            if($('.reduction_table tbody tr').eq(i).find('td').eq(4).find('.reduction_2').prop('checked')==true){
                                reduction_price = parseFloat(reduction_price) + parseFloat($('.reduction_table tbody tr').eq(i).find('td').eq(4).find('.reduction_2').attr('data-reduction_price'));
                            }
                        }
                    }

                    $('.reduction_price').text(reduction_price);

                    //统计实付金额
                    calc_totalmoney(1800);
                }

                //放弃购买
                function giveup_buy(){
                    $('.yixuan2').removeClass('yixuan2').addClass('yixuan');
                    $('.glist_form').hide();
                }

                //上传文件
                function goto_buy(){
                    var layer = layui.layer
                        ,$ = layui.jquery;

                    $('.gi_file_div').show();
                    $('.buy_footer ').hide();
                    // layer.open({
                    //     type: 1,
                    //     title: '上传文件并提交',
                    //     area: ['500px', '500px'],
                    //     // zIndex:999999999,
                    //     content: $('.gi_file_div')
                    // });
                    // $('.layui-layer-shade').css('z-index',9);
                    $('.gi_file_div').css({'padding':'20px','box-sizing':'border-box','border': '2px solid #d3d3d3','position':'absolute','bottom':0,'left':0,'width':'100%'});

                }

                //取消上传
                function cancel_buy(){
                    var layer = layui.layer
                        ,$ = layui.jquery;
                    $('.gi_file_div').hide();
                    $('.buy_footer').show();
                }
                //购物清单---end

                function getSkuId() {
                    var spec_ids = [];
                    $(".choose").find(".attr").each(function() {
                        var spec_id = $(this).find(".selected").data("spec-id");
                        spec_ids.push(spec_id);
                    });

                    var sku_id = $.cart.getSkuId(spec_ids, sku_ids);

                    if (sku_id == null) {
                        return false;
                    }

                    return sku_id;
                }

                function changeLocation(region_code) {
                    if (region_code == undefined || region_code == null || region_code.length == 0) {
                        return;
                    }

                    var sku_id = getSkuId();

                    return $.get("/goods/change-location.html", {
                        "sku_id": sku_id,
                        "region_code": region_code
                    }, function(result) {
                        if (result.code == 0) {
                            local_region_code = region_code;
                            sku_freights[region_code] = result.data;

                            if (result.data.is_last == 0) {
                                // return;
                            }

                            $(".freight-info").html(result.data.freight_info);
                            $(".freight-free-info").find(".content").html("");

                            if ($.isArray(result.data.free_list) && result.data.free_list.length > 0) {

                                for (var i = 0; i < result.data.free_list.length; i++) {
                                    $(".freight-free-info").find(".content").append("<p>" + result.data.free_list[i] + "</p>");
                                }

                                // 显示包邮条件
                                $(".freight-free-info").show();
                            } else {
                                // 隐藏包邮条件
                                $(".freight-free-info").hide();
                            }

                            if ($(document).data("SZY-SKU-" + sku_id)) {
                                var sku = $(document).data("SZY-SKU-" + sku_id);
                                setSkuInfo(sku);
                            } else {

                                // 库存
                                if (result.data.goods_number > 0) {
                                    if ("1" == 1) {
                                        $(".SZY-GOODS-NUMBER").html("库存" + result.data.goods_number + "件");
                                    } else {
                                        $(".SZY-GOODS-NUMBER").html("");
                                    }
                                } else {
                                    $(".SZY-GOODS-NUMBER").html("库存不足");
                                }
                                // 购买
                                if (result.data.goods_number == 0) {
                                    $(".add-cart").addClass("disabled");
                                    $(".buy-goods").addClass("disabled");
                                } else {
                                    $(".buy-goods").removeClass("disabled");
                                    $(".add-cart").removeClass("disabled");
                                }
                            }
                        }
                    }, "json");
                }

                function getSkuInfo(sku_id,attr_id, callback) {
                    //修改了bug
                    // if ($(document).data("SZY-SKU-" + sku_id)) {
                    //     console.log(199);
                    //     var sku = $(document).data("SZY-SKU-" + sku_id);
                    //     // 回调
                    //     if ($.isFunction(callback)) {
                    //         callback.call({}, sku);
                    //     }
                    // } else {
                    //     console.log(299);
                    $.get('/goods/sku', {
                        sku_id: sku_id,
                        attr_id: attr_id,
                        is_lib_goods: ""
                    }, function(result) {
                        if (result.code == 0) {
                            var sku = result.data;
                            // console.log(callback);//setSkuInfo
                            $(document).data("SZY-SKU-" + sku_id, sku);
                            // 回调
                            if ($.isFunction(callback)) {
                                callback.call({}, sku);
                            }
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }, "json");
                    // }
                }

                // 设置SKU信息
                function setSkuInfo(sku) {

                    var is_lib_goods = "";
                    if (is_lib_goods == true) {
                        return false;
                    }

                    if (sku == undefined || sku == null || sku == false) {
                        $(".add-cart").addClass("disabled");
                        $(".buy-goods").addClass("disabled");
                        $(".SZY-GOODS-NUMBER").html("库存不足");
                        return;
                    }

                    //修改bug
                    if(sku.sku_images.length>0){
                        change_sku_images = true;
                    }

                    // 点击默认规格才会切换相册
                    if (change_sku_images == true) {
                        // 相册
                        $(".goodsgallery").goodsgallery({
                            images: sku.sku_images,
                            video: ""
                        });
                        change_sku_images = false;
                    }

                    var goods_number = sku.goods_number;

                    if (goods_number > 0) {
                        if (sku_freights[local_region_code]) {
                            if (sku_freights[local_region_code].limit_sale == 1) {
                                // 区域限售商品
                            }
                        } else {

                            // changeLocation(local_region_code).always(function(result) {
                            //     if (result.code == 0 && result.data.limit_sale == 1) {
                            //         setSkuInfo(sku);
                            //     }
                            // });
                            // return;
                        }
                    }
                    // console.log(sku,'',1231);

                    // 商品名称
                    $(".SZY-GOODS-NAME").html(sku.sku_name);
                    //设置价格为最低
                    $('.low_price').find('.font20').text(sku.low_price);
                    //商品规格区间 2024/01/19添加
                    let interval_html = '<table class="interval_table layui-table">\n' +
                        '                            <thead>\n' +
                        '                            <tr>\n' +
                        '                            <th>起批量</th>\n' +
                        '                            <th>价格</th>\n' +
                        '                            </tr>\n' +
                        '                            </thead>\n' +
                        '                            <tbody>';

                    for(let i=0;i<sku.sku_prices.start_num.length;i++){
                        interval_html += '<tr>\n'+
                            '                     <td>' +
                            '                         <div class="disf" style="justify-content: left;">\n'+
                            '                         <div class="start_num font15">'+sku.sku_prices.start_num[i]+'</div>\n';
                        if(sku.sku_prices.select_end[i]==1){
                            interval_html += '     -\n'+
                                '                          <div class="end_num font15">'+sku.sku_prices.end_num[i]+'</div><div class="unit font15">'+sku.sku_prices.unit[i]+'</div>\n';
                        }else if(sku.sku_prices.select_end[i]==2){
                            interval_html += '     <div class="end_num font15">'+sku.sku_prices.unit[i]+'&nbsp;以上</div>\n';
                        }

                        interval_html += '         </div>\n'+
                            '                     </td>\n'+
                            '                     <td>' +
                            '                         <div class="disf" style="justify-content: left;">\n'+
                            '                             <div class="font15">'+sku.sku_prices.currency[i]+'</div>\n'+
                            '                             <div class="font15 color">'+sku.sku_prices.price[i]+'</div>\n'+
                            '                         </div>\n'+
                            '                     </td>\n'+
                            '                 </td>';
                    }

                    interval_html += '</tbody>\n' +
                        '       </table>';
                    $('.interval_div').html(interval_html);

                    // 售价
                    $(".SZY-GOODS-PRICE").html(sku.goods_price_format);
                    // 市场价
                    //搭配套餐 显示原价
                    if (sku.activity && sku.activity.act_type == '11' && sku.activity.act_status == 1) {
                        $(".SZY-MARKET-PRICE").html(sku.original_price_format);
                    } else {
                        $(".SZY-MARKET-PRICE").html(sku.market_price_format);
                    }

                    if (parseFloat(sku.market_price) == 0) {
                        $(".SZY-MARKET-PRICE").parents(".show-price").hide();
                    } else {
                        $(".SZY-MARKET-PRICE").parents(".show-price").show();
                    }
                    // 预售定金显示
                    if (parseFloat(sku.earnest_money) > 0 && $('.SZY-EARNST-MONEY').length > 0) {
                        $('.SZY-EARNST-MONEY').html(sku.earnest_money_format);
                        $('.SZY-TAIL-MONEY').html(sku.tail_money_format);
                    }

                    // 库存
                    if (goods_number > 0) {
                        if ("1" == 1) {
                            $('.amount_num').find('.amount-input').attr('data-amount-max',goods_number);
                            $(".SZY-GOODS-NUMBER").html("库存" + goods_number + "件");
                        } else {
                            $(".SZY-GOODS-NUMBER").html("");
                        }
                    } else {
                        $(".SZY-GOODS-NUMBER").html("库存不足");
                    }

                    if (goods_number == 0) {
                        $(".add-cart").addClass("disabled");
                        $(".buy-goods").addClass("disabled");
                    } else {
                        $(".buy-goods").removeClass("disabled");
                        $(".add-cart").removeClass("disabled");
                    }

                    $(".amount-input").data("amount-min", 1);
                    $(".amount-input").data("amount-max", goods_number);

                    if (goods_number > 0 && $(".amount-input").val() == 0) {
                        $(".amount-input").val(1);
                    } else if (goods_number == 0 && $(".amount-input").val() != 0) {
                        $(".amount-input").val(0);
                    }

                    var goods_number_input = parseInt($(".amount-input").val());

                    if (goods_number_input > goods_number) {
                        $(".amount-input").val(goods_number);
                    }

                    // 判断促销模块是否显示
                    var show_activity = false;

                    //
                    show_activity = true;
                    //

                    // 会员价格
                    if (sku.rank_prices != undefined && sku.rank_prices != null) {
                        $(".SZY-RANK-LIST").find("p").remove();
                        var html = "";
                        for (var i = 0; i < sku.rank_prices.length; i++) {
                            var item = sku.rank_prices[i];
                            html += "<p>" + item.rank_name + ":" + item.rank_price_format + "</p>";
                        }
                        $(".SZY-RANK-LIST").append(html);
                        $(".SZY-RANK-PRICES").show();
                        // 展示促销
                        show_activity = true;
                    } else {
                        $(".SZY-RANK-PRICES").hide();
                    }

                    if (sku.member_price_message) {
                        $(".SZY-RANK-PRICES").show();
                        $(".SZY-RANK-MESSAGE").html(sku.member_price_message);
                        // 展示促销
                        show_activity = true;
                    } else {
                        $(".SZY-RANK-PRICES").hide();
                    }

                    // 处理赠品
                    if (sku.gift_list && sku.gift_list.length > 0) {

                        $(".SZY-GIFT-LIST").show();
                        $(".SZY-GIFT-LIST").find(".prom-gift").children().remove();

                        for (var i = 0; i < sku.gift_list.length; i++) {
                            var gift = sku.gift_list[i];
                            var template = $("#SZY_GIFT_TEMPLATE").html();
                            var element = $($.parseHTML(template));
                            $(element).find("img").attr("src", gift.goods_image_thumb);
                            $(element).find("a").attr("href", "/" + gift.gift_sku_id + ".html");
                            $(element).find("a").attr("title", "/" + gift.sku_name);
                            $(element).find(".gift-number").html("× " + gift.gift_number);
                            $(".SZY-GIFT-LIST").find(".prom-gift").append(element);
                        }

                        // 展示促销
                        show_activity = true;
                    } else {
                        $(".SZY-GIFT-LIST").hide();
                        $(".SZY-GIFT-LABEL").nextAll().remove();
                    }
                    //订单返现
                    if(typeof(sku.cash_back)!='undefined'){
                        if (sku.cash_back.message) {
                            show_activity = true;
                        }
                    }

                    if ($(".SZY-ACTIVITY").find(".discount").size() > 0) {
                        // 展示促销
                        show_activity = true;
                        $(".SZY-MARKET-PRICE").html(sku.original_price_format);
                    }

                    if (show_activity) {

                        $(".SZY-ACTIVITY").hide();
                    } else {
                        $(".SZY-ACTIVITY").hide();
                    }
                }

                $().ready(function() {
                    //==== 自定义触发 2024-01-26 START ====
                    //价格区间弹出
                    $('.price_info').hover(function(){
                        $(this).parents(":eq(1)").find('.interval_div').show();
                        $(this).parents(":eq(1)").find('.interval_div').css({'position':'absolute','top':'25px','left':'185px'});
                    },function(){
                        $(this).parents(":eq(1)").find('.interval_div').hide();
                    });
                    //==== 自定义触发 2024-01-26 END ====

                    // 获取SKU列表
                    sku_ids = $.parseJSON($("#SZY_SKU_LIST").html());
                    // 检查SKU组合
                    $.cart.checkSkus($(".SZY-GOODS-SPEC-ITEMS > .attr"), sku_ids);
                    // 绑定规格事件
                    $.cart.checkSpecs($(".SZY-GOODS-SPEC-ITEMS > .attr"), sku_ids, $(".SZY-GOODS-SPEC-ITEMS > .attr").find("li"), function(sku) {
                        // var attr_id = $(this).data('attr-id');//当前属性id
                        var attr_id = '';
                        //获取所有已选规格
                        $('.SZY-GOODS-SPEC-ITEMS .attr').find('.selected').each(function(){
                            attr_id += $(this).data('attr-id')+'|';
                        });
                        attr_id = attr_id.split('|').reverse().join('|');

                        // 是否为默认规格
                        var is_default = $(this).data("is-default");

                        if (is_default) {
                            // 如果是默认规格则标识将切换SKU的图片相册
                            change_sku_images = true;
                        }

                        // SKU存在
                        getSkuInfo(sku.sku_id,attr_id, function(sku) {
                            setSkuInfo(sku);
                            $("title").html(sku.sku_name);
                        });
                    }, function() {

                        // 是否为默认规格
                        var is_default = $(this).data("is-default");

                        if (is_default) {
                            // 如果是默认规格则标识将切换SKU的图片相册
                            change_sku_images = true;
                        }

                        // SKU不存在
                        $(".add-cart").addClass("disabled");
                        $(".buy-goods").addClass("disabled");
                        $(".SZY-GOODS-NUMBER").html("库存不足3");

                        $("title").html($(".SZY-GOODS-NAME-BASE").text());
                    });

                    // 步进器
                    var goods_number_amount = $(".amount-input").amount({
                        value: 1,
                        min: 1,
                        max: "97",
                        change: function(element, value) {
                            var sku_id = element.data('sku_id');
                            if (value == this.max) {

                            }
                        },
                        max_callback: function() {
                            $.msg("最多只能购买" + this.max + "件");
                        },
                        min_callback: function() {
                            $.msg("商品数量必须大于" + (this.min - 1));
                        }
                    });

                    // 添加购物车
                    $(".add-cart").click(function(event) {

                        var is_lib_goods = "";
                        if (is_lib_goods == true) {
                            return false;
                        }

                        if ($(this).hasClass("disabled")) {
                            return false;
                        }

                        var image_url = $(".goodsgallery").find(".gg-handler li:first img").attr("src");
                        var sku_id = getSkuId();
                        $.cart.add(sku_id, $(".amount-input").val(), {
                            is_sku: true,
                            image_url: image_url,
                            event: event,
                            info_callback: function() {

                            }
                        });
                        return false;
                    });

                    // 立即购买
                    $(".buy-goods").click(function() {
                        var act_type = "11";
                        var purchase = "15";
                        var pre_sale = "2";
                        var virtual = "0";
                        var is_lib_goods = "";
                        if (is_lib_goods == true) {
                            return;
                        }

                        if ($(this).hasClass("disabled")) {
                            return;
                        }
                        var sku_id = getSkuId();
                        var number = $(".amount-input").val();
                        var data = {};
                        if (act_type == purchase || act_type == pre_sale) {
                            data.act_type = act_type;
                        }
                        if (virtual > 0) {
                            data.virtual = virtual;
                        }
                        $.cart.quickBuy(sku_id, number, data);

                    });

                    // 立即兑换
                    $(".exchange-goods").click(function() {

                        if ($(this).hasClass("disabled")) {
                            var goods_number = "";
                            if (goods_number == 0) {
                                $.msg('库存不足');
                            } else {
                                $.msg('积分不足');
                            }
                            return;
                        }
                        var sku_id = getSkuId();
                        var number = $(".amount-input").val();
                        var data = {};
                        data.exchange = true;
                        $.cart.quickBuy(sku_id, number, data);
                    });

                    //身份验证弹框
                    //        $(".buy-goods").click(function() {
                    //			layer.open({
                    //				type: 1,
                    //                title: '身份验证',
                    //                area: ['700px', '330px'],
                    //				content: $('#status-verify').html()
                    //			});
                    //        });
                });
            </script>
            <!-- 商品详细信息 _end-->
        </div>

        <!-- 搭配套餐 -->

        <!-- 内容 -->
        <style>
            .store-service .store-service-group .service-list{padding-left:80px;}
            .tree li span{height:20px;}
            .goto{text-decoration: underline;}
        </style>
        <div class="clearfix">
            <!-- 左半部分内容 -->
            <div class="fl">
                <!-- 客服组 -->
                <div class="store-service storeName" style="border-top:1px solid #f2f2f2;margin-bottom:0;">
                    <div class="store-service-group left-content" style="margin-bottom:0;">
                        <div class="store-service-type first" style="padding-bottom:0;">
                            @if($goods['shop_id']>0)
                                <h3 class="left-title" title="{{ $shop_info['shop']['shop_name'] }}">{{ $shop_info['shop']['shop_name'] }}</h3>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="store-service">
                    <div class="store-logo">
                        <img src="/images/service.png" width="" height="" />
                    </div>
                    <div class="store-service-group left-content">
                        <div class="store-service-type first" style="padding-top:10px;text-align: center;">
                            <div class="layui-btn layui-btn-sm layui-btn-primary" onclick="onchat()"><i class="iconfont">&#xe6ad;</i>在线咨询</div>
                            <div class="layui-btn layui-btn-sm layui-btn-primary" onclick="advice()"><img src="/images/advice.png" style="width: 15px;">在线反馈</div>
                        </div>
                    </div>
                </div>

                <!-- 信息管理 -->
                <div class="store-service" style="border-top:1px solid #f2f2f2;">
                    <div class="store-service-group left-content">
                        <div class="store-service-type first">
                            <h3 class="left-title">信息管理</h3>
                            <div class="service-list">
                                <em>订单管理</em>
                                <a target="_blank" href="https://www.gogo198.net/?s=index/tradeflow_buyer&gogo_id={{session('user.gogo_id')}}" class="service-btn goto">
                                    <span>点击跳转</span>
                                </a>
                            </div>

                            <div class="service-list">
                                <em>账单管理</em>
                                <a target="_blank" href="/bill_list" class="service-btn goto">
                                    <span>点击跳转</span>
                                </a>
                            </div>
                        </div>
                        <div class="store-service-type" style="display: none;">
                            <h4>工作时间</h4>
                            <div class="service-time">
                                <p>12345</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 平台服务 -->
                <div class="store-category">
                    <h3 class="left-title">平台服务</h3>
                    <div class="left-content tree">
                        <ul>
                            <li>
                                <span>
                                    <i class="icon-plus-sign"></i>
                                </span>
                                <a href="" target="_self" title="" class="tree-first">购购网</a>
                                <ul>
                                    <li style="display: none;">
                                        <span>
                                            <i class="arrow"></i>
                                        </span>
                                        <a href="https://www.gogo198.net/" target="_self" title="">购购网首页</a>
                                    </li>
                                    <li style="display: none;">
                                        <span>
                                            <i class="arrow"></i>
                                        </span>
                                        <a href="https://www.gogo198.net/?s=index/detail&id=2" target="_self" title="">关于购购</a>
                                    </li>
                                    <li style="display: none;">
                                        <span>
                                            <i class="arrow"></i>
                                        </span>
                                        <a href="https://www.gogo198.net/?s=index/detail&id=7" target="_self" title="">购购跨境</a>
                                    </li>
                                    <li style="display: none;">
                                        <span>
                                            <i class="arrow"></i>
                                        </span>
                                        <a href="https://www.gogo198.net/?s=index/detail&id=41" target="_self" title="">购购资讯</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <span>
                                    <i class="icon-plus-sign"></i>
                                </span>
                                <a href="" target="_self" title="" class="tree-first">直邮易</a>
                                <ul>
                                    <li style="display: none;">
                                        <span>
                                            <i class="arrow"></i>
                                        </span>
                                        <a href="https://www.gogo198.com/" target="_self" title="">直邮易首页</a>
                                    </li>
                                    <li style="display: none;">
                                        <span>
                                            <i class="arrow"></i>
                                        </span>
                                        <a href="https://www.gogo198.com/?s=gather/package_forecast&process1=16&process2=17&process3=17" target="_self" title="">我要集运</a>
                                    </li>
                                    <li style="display: none;">
                                        <span>
                                            <i class="arrow"></i>
                                        </span>
                                        <a href="https://www.gogo198.com/?s=gather/balance" target="_self" title="">服务中心</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <span>
                                    <i class="icon-plus-sign"></i>
                                </span>
                                <a href="" target="_self" title="" class="tree-first">卖全球</a>
                                <ul>
                                    <li style="display: none;">
                                        <span>
                                            <i class="arrow"></i>
                                        </span>
                                        <a href="http://global.gogo198.cn/" target="_self" title="">卖全球首页</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- 联系平台 -->
                <div class="store-service" style="border-top:1px solid #f2f2f2;">
                    <div class="store-service-group left-content">
                        <div class="store-service-type first">
                            <h3 class="left-title">联系平台</h3>
                            <div class="service-list">
                                <em>打电话</em>
                                <a target="_blank" href="tel:+86 18028192198" class="service-btn">
                                    <span>+86 18028192198</span>
                                </a>
                            </div>

                            <div class="service-list">
                                <em>发电邮</em>
                                <a target="_blank" href="mailto:198@gogo198.net" class="service-btn">
                                    <span>198@gogo198.net</span>
                                </a>
                            </div>

                            <div class="service-list">
                                <em>加微信</em>
                                <a target="_blank" href="https://www.gogo198.net/?s=index/contact_detail&id=1" class="service-btn goto">
                                    <span>跳转添加</span>
                                </a>
                            </div>
                        </div>
                        <div class="store-service-type" style="display: none;">
                            <h4>工作时间</h4>
                            <div class="service-time">
                                <p>12345</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- 右半部分内容 -->
            <style>
                .wrapper .goods-detail .tab li a{padding:0 30px;}
                .right-con{margin-top:0;}
                .goodsDetail .layui-tab-title .layui-this{color:#ff0000;}
                .goodsDetail .layui-tab-card>.layui-tab-title .layui-this:after{border-top:1px solid #ff2222;}
                .goodsDetail .layui-tab-content{padding:0;}
                .goodsDetail .layui-tab-item .tab_topnav{display: flex;flex-direction: row;justify-content: flex-start;align-items: center;height: 44px;background-color: #f6f6f6;padding-left: 36px;padding-right: 36px;}
                .goodsDetail .layui-tab-item .tab_topnav .tab-nav{font-size: 14px;  color: #666;  margin-right: 30px;  cursor: pointer;}
                .goodsDetail .gdetail_content{padding:10px;box-sizing: border-box;}
                .goodsDetail .gdetail_content .goods-detail-content{margin:0 20px;}

                .offer-title{display: flex;align-items: center;margin: 0 20px;padding: 15px 0 0;}
                .offer-title .offer-title-icon{width: 4px;height: 13px;background: #E31939;border-radius: 1px;}
                .offer-title .offer-title-content{margin-left: 6px;font-weight: 700;color: #333;font-size:17px;}
                .goods-spec{padding-top:0px;}
                .wrapper #goods_introduce .detail-content{padding:10px 15px;}
                .goods-detail-content img{max-width:100%;}
                .tab_padding{padding: 8px 20px 15px 20px;margin: 0 auto;}
                .border_line{border-bottom:1px solid #e5e5e5;}

                /**流程start**/
                .cont1-bg {box-sizing: content-box;background:#fff;width: 100%;border:1px solid #f2f2f2;}
                .cont1 {padding-top: 30px;margin: 0 auto;width: 90%;box-sizing: content-box;}
                .cont1 .intro{color: #000;line-height: 52px;text-align: center;padding-bottom: 30px;font-weight:800;}
                .cont1 .control_process{display: flex;align-items: baseline;justify-content:center;background: #e5e1e1;border-radius: 30px;border:2px solid #ff2222;}
                .cont1 .control_process .switch_process{width: 140px;text-align: center;padding: 10px 10px;box-sizing: border-box;cursor:pointer;font-weight:800;}
                .cont1 .control_process .hover{background:#ff2222;border-radius: 30px;color:#fff;}
                .cont1 .process_container{padding:30px 0;box-sizing: border-box;overflow-x: auto;}
                .cont1 .process_container .disf{justify-content: center;}
                .cont1 .process_container .process_arrow_box{height:120px;line-height: 120px;padding-top:20px;}
                .cont1 .process_container .process_child:last-child .process_arrow_box{display: none;}
                .cont1 .process_container .process_arrow{width: 40px;height:40px;}
                .cont1 .process_container .process_child{width: 140px;text-align: center;}
                .cont1 .process_container .process_img{width:80px;height:80px;border-radius: 80px;border:3px solid #ff2222;}
                .cont1 .process_container .process_text{margin-top: 15px;font-weight:800;}
                /**流程end**/

                .goodsDetail_fixed{position:fixed;top:0;left:50%;transform: translate(-39%,0);z-index: 9;}
                .tab_topnav_fixed{position: fixed;top:0%;left:50%;transform: translate(-39%,95%);box-sizing:border-box;z-index: 9;}
                .storeName_fixed{position: fixed;top:0%;left:50%;transform: translate(-288%,0);z-index: 9;}
            </style>


            <!--新的商品详情样式-->
            <div class="layui-tab layui-tab-card right right-con goodsDetail" id="goodsDetail" style="display: block;">
                @if($goods['shop_id']>0)
                    <ul class="layui-tab-title">
                        <li class="layui-this">商品分类</li>
                        <li>商品信息</li>
                        <li>商品描述</li>
                        <li id="evaluate_count">销售评价</li>
                        <li>买家须知</li>
                    </ul>
                    <div class="layui-tab-content" style="min-height: 400px;">
                        <div class="layui-tab-item layui-show">
                            <div class="tab_topnav">
                                <span class="tab-nav"><a href="javascript:0;" id="sale_navDiv">商城销售分类</a></span>
                                <span class="tab-nav"><a href="javascript:0;" id="logi_navDiv">跨境物流分类</a></span>
                            </div>

                            <div class="tab_content">
                                <div class="offer-title" id="sale_div"><div class="offer-title-icon"></div><div class="offer-title-content">商城销售分类</div></div>
                                <ul class="goods-spec">
                                    <li>
                                        分类名称：<span title="b" class="goods-attr-value">{{$goods['cat_name']}}</span>
                                    </li>
                                    @foreach($goods['other_attrs']['value_name'.$goods['cat_id']] as $k=>$v)
                                        <li>
                                            {{$v}}：<span title="b" class="goods-attr-value">{{$goods['other_attrs']['value_desc'.$goods['cat_id']][$k]}}</span>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="offer-title" id="logi_div"><div class="offer-title-icon"></div><div class="offer-title-content">跨境物流分类</div></div>
                                <ul class="goods-spec">
                                    <li>
                                        分类名称：<span title="b" class="goods-attr-value">{{$goods['logi_name']}}</span>
                                    </li>
                                    @foreach($goods['other_attrs']['value_name'.$goods['logi_id']] as $k=>$v)
                                        <li>
                                            {{$v}}：<span title="b" class="goods-attr-value">{{$goods['other_attrs']['value_desc'.$goods['logi_id']][$k]}}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="layui-tab-item">
                            <div class="tab_topnav">
                                <span class="tab-nav"><a href="javascript:0;" id="price_navDiv">价格说明</a></span>
                                <span class="tab-nav"><a href="javascript:0;" id="cross_navDiv">跨境说明</a></span>
                                <span class="tab-nav"><a href="javascript:0;" id="transport_navDiv">物流说明</a></span>
                            </div>
                            <div class="tab_content tab_padding">
                                <div class="offer-title" id="price_div"><div class="offer-title-icon"></div><div class="offer-title-content">价格说明</div></div>
                                <div class="border_line">
                                    <table class="layui-table">
                                        <thead>
                                        <tr>
                                            @if($goods['have_specs']==1)
                                                <th>规格名称</th>
                                            @endif
                                            <th>起批量</th>
                                            <th>价格</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($sku_info as $k=>$v)
                                            @foreach($v['sku_prices']['start_num'] as $k2=>$v2)
                                                <tr>
                                                    @if($goods['have_specs']==1)
                                                        <td>{{$v['spec_names']}}</td>
                                                    @endif
                                                    <td>
                                                        <div class="disf" style="justify-content: left;">
                                                            <div class="start_num font15">{{$v2}}</div>
                                                            @if($v['sku_prices']['select_end'][$k2]==1)
                                                                -
                                                                <div class="end_num font15">{{$v['sku_prices']['end_num'][$k2]}}</div>
                                                                <div class="unit font15">{{$v['sku_prices']['unit'][$k2]}}</div>
                                                            @else
                                                                <div class="end_num font15">{{$v['sku_prices']['unit'][$k2]}}&nbsp;以上</div>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="disf" style="justify-content: left;">
                                                            <div class="font15">{{$v['sku_prices']['currency'][$k2]}}</div>
                                                            <div class="font15 color">{{$v['sku_prices']['price'][$k2]}}</div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                @if(!empty($goods['reduction_content']['preferential_blong']))
                                    <div class="offer-title"><div class="offer-title-icon"></div><div class="offer-title-content">销售优惠【减免】</div></div>
                                    <div class="border_line">
                                        <table class="layui-table">
                                            <thead>
                                            <tr>
                                                <th>优惠权属</th>
                                                <th>规则</th>
                                                <th>限制</th>
                                                <th>金额</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($goods['reduction_content']['preferential_blong'] as $k=>$v)
                                                <tr>
                                                    <td>
                                                        @if($v==1)卖家优惠@elseif($v==2)平台优惠@elseif($v==3)他方优惠@endif
                                                    </td>
                                                    <td>{{$goods['reduction_content']['type_name'][$k]}}</td>
                                                    <td>@if($goods['reduction_content']['strict'][$k]==1)单独@elseif($goods['reduction_content']['strict'][$k]==2)叠加@endif</td>
                                                    <td>
                                                        <div class="disf">
                                                            {{$goods['reduction_content']['content'][$k][0]}}&nbsp;{{$goods['reduction_content']['currency1'][$k]}} <span class="color">{{$goods['reduction_content']['price1'][$k][0]}}</span>&nbsp;{{$goods['reduction_content']['content'][$k][2]}}&nbsp;{{$goods['reduction_content']['currency2'][$k]}} <span class="color">{{$goods['reduction_content']['price2'][$k][0]}}</span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif

                                @if(!empty($goods['gift_content']['preferential_blong']))
                                    <div class="offer-title"><div class="offer-title-icon"></div><div class="offer-title-content">销售优惠【随赠】</div></div>
                                    <div class="border_line">
                                        <table class="layui-table">
                                            <thead>
                                            <tr>
                                                <th>优惠权属</th>
                                                <th>项目</th>
                                                <th>限制</th>
                                                <th>金额</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($goods['gift_content']['preferential_blong'] as $k=>$v)
                                                <tr>
                                                    <td>
                                                        @if($v==1)卖家优惠@elseif($v==2)平台优惠@elseif($v==3)他方优惠@endif
                                                    </td>
                                                    <td>
                                                        @if($goods['gift_content']['type'][$k]==1)积分
                                                        @elseif($goods['gift_content']['type'][$k]==2)卡劵
                                                        @elseif($goods['gift_content']['type'][$k]==3)
                                                            @if($goods['gift_content']['accgift_type'][$k]==1)虚拟
                                                            @elseif($goods['gift_content']['accgift_type'][$k]==2)服务
                                                            @elseif($goods['gift_content']['accgift_type'][$k]==3)实物
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td>@if($goods['gift_content']['strict'][$k]==1)单独@elseif($goods['gift_content']['strict'][$k]==2)叠加@endif</td>
                                                    <td>
                                                        <div class="disf">
                                                            @if($goods['gift_content']['type'][$k]==1)
                                                                按每
                                                                @if($goods['gift_content']['points_type'][$k]==1)
                                                                    订单/次
                                                                @elseif($goods['gift_content']['points_type'][$k]==2)
                                                                    {{$goods['gift_content']['points_currency'][$k]}}&nbsp;{{$goods['gift_content']['points_money'][$k]}}
                                                                @endif
                                                                送<span class="color">{{$goods['gift_content']['points_send'][$k]}}</span>分
                                                            @elseif($goods['gift_content']['type'][$k]==2)
                                                                {{$goods['gift_content']['coupon_currency'][$k]}}&nbsp;{{$goods['gift_content']['coupon_money'][$k]}}&nbsp;=&nbsp;<span class="color">{{$goods['gift_content']['coupon_num'][$k]}}</span>张
                                                            @elseif($goods['gift_content']['type'][$k]==3)
                                                                {{$goods['gift_content']['accgift_content'][$k]}}&nbsp;=&nbsp;<span class="color">{{$goods['gift_content']['accgift_num'][$k]}}</span>（个）
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif

                                @if(!empty($goods['noinclude_content']['name'][0]))
                                    <div class="offer-title"><div class="offer-title-icon"></div><div class="offer-title-content">价格未含</div></div>
                                    <div class="border_line">
                                        <table class="layui-table">
                                            <thead>
                                            <tr>
                                                <th>费用名称</th>
                                                <th>摘要描述</th>
                                                <th>金额</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($goods['noinclude_content']['name'] as $k=>$v)
                                                <tr>
                                                    <td>{{$v}}</td>
                                                    <td>{{$goods['noinclude_content']['desc'][$k]}}</td>
                                                    <td>
                                                        {{$goods['noinclude_content']['currency'][$k]}} <span class="color">{{$goods['noinclude_content']['price'][$k]}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif

                                @if(!empty($goods['potential_content']['name'][0]))
                                    <div class="offer-title"><div class="offer-title-icon"></div><div class="offer-title-content">潜在收费</div></div>
                                    <div class="border_line">
                                        <table class="layui-table">
                                            <thead>
                                            <tr>
                                                <th>收款单位</th>
                                                <th>费用名称</th>
                                                <th>摘要描述</th>
                                                <th>金额</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($goods['potential_content']['name'] as $k=>$v)
                                                <tr>
                                                    <td>{{$goods['potential_content']['currency'][$k]}}</td>
                                                    <td>{{$v}}</td>
                                                    <td>{{$goods['potential_content']['desc'][$k]}}</td>
                                                    <td>
                                                        {{$goods['potential_content']['currency2'][$k]}} <span class="color">{{$goods['potential_content']['price'][$k]}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif

                                @if(!empty($goods['userprice_intro']))
                                    <div class="offer-title"><div class="offer-title-icon"></div><div class="offer-title-content">卖家说明</div></div>
                                    <div class="goods-spec" style="padding:0;">
                                        <div class="layui-collapse" lay-accordion="now" style="margin:10px 0;width: 100%;">
                                            @foreach($goods['userprice_intro'] as $key=>$vo)
                                                <div class="layui-colla-item">
                                                    <h2 class="layui-colla-title">{{$vo['parag_num']}}&nbsp;{{$vo['title']}}</h2>
                                                    <div class="layui-colla-content">
                                                        <p>{{$vo['content']}}</p>
                                                        @if(!empty($vo['children']))
                                                            <div class="layui-collapse" lay-accordion="now">
                                                                @foreach($vo['children'] as $key2=>$vo2)
                                                                    <div class="layui-colla-item">
                                                                        <h2 class="layui-colla-title">{{$vo2['parag_num']}}&nbsp;{{$vo2['title']}}</h2>
                                                                        <div class="layui-colla-content">
                                                                            <p>{{$vo2['content']}}</p>
                                                                            @if(!empty($vo2['children']))
                                                                                <div class="layui-collapse" lay-accordion="now" lay-filter="now">
                                                                                    @foreach($vo2['children'] as $key3=>$vo3)
                                                                                        <div class="layui-colla-item">
                                                                                            <h2 class="layui-colla-title" data-parag_num="{{$vo3['parag_num']}}">{{$vo3['parag_num']}}&nbsp;{{$vo3['title']}}</h2>
                                                                                            <div class="layui-colla-content">
                                                                                                <p>{{$vo3['content']}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                @if(!empty($goods['platform_intro']['content']))
                                    <div class="offer-title"><div class="offer-title-icon"></div><div class="offer-title-content">平台条款</div></div>
                                    <div class="goods-spec" style="padding:0;">
                                        <div class="layui-collapse" lay-accordion="now" style="margin:10px 0;width: 100%;">
                                            @foreach($goods['platform_intro']['content'] as $key=>$vo)
                                                <div class="layui-colla-item">
                                                    <h2 class="layui-colla-title">{{$vo['parag_num']}}&nbsp;{{$vo['title']}}</h2>
                                                    <div class="layui-colla-content">
                                                        <p>{{$vo['content']}}</p>
                                                        @if(!empty($vo['children']))
                                                            <div class="layui-collapse" lay-accordion="now">
                                                                @foreach($vo['children'] as $key2=>$vo2)
                                                                    <div class="layui-colla-item">
                                                                        <h2 class="layui-colla-title">{{$vo2['parag_num']}}&nbsp;{{$vo2['title']}}</h2>
                                                                        <div class="layui-colla-content">
                                                                            <p>{{$vo2['content']}}</p>
                                                                            @if(!empty($vo2['children']))
                                                                                <div class="layui-collapse" lay-accordion="now" lay-filter="now">
                                                                                    @foreach($vo2['children'] as $key3=>$vo3)
                                                                                        <div class="layui-colla-item">
                                                                                            <h2 class="layui-colla-title" data-parag_num="{{$vo3['parag_num']}}">{{$vo3['parag_num']}}&nbsp;{{$vo3['title']}}</h2>
                                                                                            <div class="layui-colla-content">
                                                                                                <p>{{$vo3['content']}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <div class="offer-title" id="cross_div"><div class="offer-title-icon"></div><div class="offer-title-content">跨境说明</div></div>
                                <ul class="goods-spec">
                                    <li>
                                        是否可以出口：
                                        <span id="crossborder-restrict" title="" class="goods-attr-value">@if($goods['crossborder_restrict']['is_export']==1)是@else否@endif</span>
                                    </li>
                                    <li>
                                        支持进口国家：
                                        <span id="crossborder-restrict" title="@foreach($goods['crossborder_restrict']['export_country'] as $k=>$v){{$v['param2']}}&nbsp;@endforeach" class="goods-attr-value">@if($goods['crossborder_restrict']['is_export']==1)
                                                @foreach($goods['crossborder_restrict']['export_country'] as $k=>$v){{$v['param2']}}&nbsp;@endforeach
                                            @else无@endif</span>
                                    </li>
                                    <li>
                                        支持跨境集运：
                                        <span id="crossborder-restrict" title="" class="goods-attr-value">@if($goods['crossborder_restrict']['is_gather']==1)@else不@endif支持</span>
                                    </li>
                                    <li>
                                        支持外币结算：
                                        <span id="crossborder-restrict" title="@if($goods['crossborder_restrict']['is_outcurrency']==1)支持本币聚合支付、外币聚合支付@else支持本币聚合支付@endif" class="goods-attr-value">@if($goods['crossborder_restrict']['is_outcurrency']==1)支持本币聚合支付、外币聚合支付@else支持本币聚合支付@endif</span>
                                    </li>
                                </ul>

                                <div class="offer-title" id="transport_div"><div class="offer-title-icon"></div><div class="offer-title-content">物流说明</div></div>
                                <ul class="goods-spec">
                                    <li>
                                        发货国地：
                                        <span id="crossborder-intro" title="{{$goods['delivery_location']}} {{$goods['delivery_area1']}} {{$goods['delivery_area2']}}" class="goods-attr-value">{{$goods['delivery_location']}} {{$goods['delivery_area1']}} {{$goods['delivery_area2']}}</span>
                                    </li>
                                    <li>
                                        服务支持：
                                        <span id="crossborder-intro" title="@if($goods['service_type']==1)境内配送@elseif($goods['service_type']==2)跨境集运@endif" class="goods-attr-value">@if($goods['service_type']==1)境内配送@elseif($goods['service_type']==2)跨境集运@endif</span>
                                    </li>
                                @if($goods['service_type']==1)
                                    <!--境内-->
                                        <li>
                                            支持包邮：
                                            <span id="crossborder-intro" title="@if($goods['domestic_type']==1)支持@elseif($goods['domestic_type']==2)不支持@endif" class="goods-attr-value">
                                                @if($goods['domestic_type']==1)支持@elseif($goods['domestic_type']==2)不支持@endif
                                            </span>
                                        </li>
                                @elseif($goods['service_type']==2)
                                    <!--境外-->
                                        @if($goods['cross_logi']==1)
                                            <li>
                                                境内集货：
                                                <span id="crossborder-intro" title="@if($goods['cross_logi_baoyou']==1)@elseif($goods['cross_logi_baoyou']==2)不@endif包邮到仓" class="goods-attr-value">
                                                    @if($goods['cross_logi_baoyou']==1)@elseif($goods['cross_logi_baoyou']==2)不@endif包邮到仓
                                                </span>
                                            </li>
                                            <li>
                                                进出清关：
                                                <span id="crossborder-intro" title="@if($goods['cross_logi_clean']==1)双清@elseif($goods['cross_logi_clean']==2)单请@elseif($goods['cross_logi_clean']==3)不包@endif" class="goods-attr-value">
                                                    @if($goods['cross_logi_clean']==1)双清@elseif($goods['cross_logi_clean']==2)单请@elseif($goods['cross_logi_clean']==3)不包@endif
                                                </span>
                                            </li>
                                            <li>
                                                跨境运费：
                                                <span id="crossborder-intro" title="@if($goods['cross_logi_freightfee']==1)包含@elseif($goods['cross_logi_freightfee']==2)不含@endif" class="goods-attr-value">
                                                    @if($goods['cross_logi_freightfee']==1)包含@elseif($goods['cross_logi_freightfee']==2)不含@endif
                                                </span>
                                            </li>
                                            <li>
                                                海关税费：
                                                <span id="crossborder-intro" title="@if($goods['cross_logi_taxfee']==1)包含税费@elseif($goods['cross_logi_taxfee']==2)税费实付@endif" class="goods-attr-value">
                                                    @if($goods['cross_logi_taxfee']==1)包含税费@elseif($goods['cross_logi_taxfee']==2)税费实付@endif
                                                </span>
                                            </li>
                                            <li>
                                                当地配送：
                                                <span id="crossborder-intro" title="@if($goods['cross_logi_peisong']==1)配送到门-@if($goods['cross_logi_daomen']==1)私人地址@elseif($goods['cross_logi_daomen']==2)商业地址@elseif($goods['cross_logi_daomen']==3)偏远地址@endif
                                                @elseif($goods['cross_logi_peisong']==2)配送到仓-@if($goods['cross_logi_daocang']==1)仓库自提@elseif($goods['cross_logi_daocang']==2)定点自提@endif
                                                @elseif($goods['cross_logi_peisong']==3)海关自提@endif" class="goods-attr-value">
                                                    @if($goods['cross_logi_peisong']==1)配送到门-@if($goods['cross_logi_daomen']==1)私人地址@elseif($goods['cross_logi_daomen']==2)商业地址@elseif($goods['cross_logi_daomen']==3)偏远地址@endif
                                                    @elseif($goods['cross_logi_peisong']==2)配送到仓-@if($goods['cross_logi_daocang']==1)仓库自提@elseif($goods['cross_logi_daocang']==2)定点自提@endif
                                                    @elseif($goods['cross_logi_peisong']==3)海关自提@endif
                                                </span>
                                            </li>
                                            <li>
                                                中国境外转运：
                                                <span id="crossborder-intro" title="@if($goods['zhuanyun']==1)支持@elseif($goods['zhuanyun']==2)不支持@endif" class="goods-attr-value">
                                                    @if($goods['zhuanyun']==1)支持@elseif($goods['zhuanyun']==2)不支持@endif
                                                </span>
                                            </li>
                                        @endif
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="layui-tab-item">
                            <div class="gdetail_content">
                                <div class="offer-title"><div class="offer-title-icon"></div><div class="offer-title-content">商品详情</div></div>
                                <!-- 商品后台上传的商品描述 -->
                                <div class="detail-content goods-detail-content">
                                    <div class="ajax-loading">
                                        <img src="/images/loading.gif" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="layui-tab-item">
                            <div class="gdetail_content">
                                <div id="goods_evaluate" class="goods-detail-con goods-detail-tabs"></div>
                            </div>
                        </div>
                        <div class="layui-tab-item">
                            <div class="tab_topnav">
                                <span class="tab-nav"><a href="javascript:0;" id="platform_navDiv">平台商品属性</a></span>
                                <span class="tab-nav"><a href="javascript:0;" id="transaction_navDiv">交易流程</a></span>
                                <span class="tab-nav"><a href="javascript:0;" id="baozhang_navDiv">保障说明</a></span>
                                <span class="tab-nav"><a href="javascript:0;" id="content_navDiv">内容声明</a></span>
                                {{--                            <span class="tab-nav">卖家说明</span>--}}
                            </div>
                            <div class="tab_content tab_padding">
                                <div class="offer-title" id="platform_div"><div class="offer-title-icon"></div><div class="offer-title-content">商品属性</div></div>
                                <div class="border_line">
                                    <ul class="goods-spec" style="border-bottom:0;">
                                        <li>
                                            销售分类名称：
                                            <span id="crossborder-intro" title="{{$goods['cat_name']}}" class="goods-attr-value">{{$goods['cat_name']}}</span>
                                        </li>
                                        <li>
                                            物流分类名称：
                                            <span id="crossborder-intro" title="{{$goods['logi_name']}}" class="goods-attr-value">{{$goods['logi_name']}}</span>
                                        </li>
                                        @if(isset($goods['platform_valueInfo']['id']))
                                            <li>
                                                行政监管对象：
                                                <span id="crossborder-intro" title="@if($goods['platform_valueInfo']['supervision_object']==1)买家@else@if($goods['platform_valueInfo']['supervision_object']==2)卖家@endif" class="goods-attr-value">@if($goods['platform_valueInfo']['supervision_object']==1)买家@else@if($goods['platform_valueInfo']['supervision_object']==2)卖家@endif</span>
                                            </li>
                                            <li>
                                                监管履行方式：
                                                <span id="crossborder-intro" title="@if($goods['platform_valueInfo']['perform_type']==1)文件上传@elseif($goods['platform_valueInfo']['perform_type']==2)在线申请@endif" class="goods-attr-value">@if($goods['platform_valueInfo']['perform_type']==1)文件上传@elseif($goods['platform_valueInfo']['perform_type']==2)在线申请@endif</span>
                                            </li>
                                            <li>
                                                平台监管知悉：
                                                <span id="crossborder-intro" title="打开平台监管" class="goods-attr-value"><span id="crossborder-intro" title="平台监管" class="goods-attr-value"><a href="{{$goods['platform_valueInfo']['platform_supervision']}}" target="_blank" style="text-decoration: underline;">打开平台监管</a></span></span>
                                            </li>
                                        @endif
                                    </ul>
                                    @if(!empty($goods['platform_valueInfo']['content']))
                                        <div class="layui-collapse" lay-accordion="now" style="margin:10px 0;width: 100%;">
                                            @foreach($goods['platform_valueInfo']['content'] as $key=>$vo)
                                                <div class="layui-colla-item">
                                                    <h2 class="layui-colla-title">{{$vo['parag_num']}}&nbsp;{{$vo['title']}}</h2>
                                                    <div class="layui-colla-content">
                                                        <p>{{$vo['content']}}</p>
                                                        @if(!empty($vo['children']))
                                                            <div class="layui-collapse" lay-accordion="now">
                                                                @foreach($vo['children'] as $key2=>$vo2)
                                                                    <div class="layui-colla-item">
                                                                        <h2 class="layui-colla-title">{{$vo2['parag_num']}}&nbsp;{{$vo2['title']}}</h2>
                                                                        <div class="layui-colla-content">
                                                                            <p>{{$vo2['content']}}</p>
                                                                            @if(!empty($vo2['children']))
                                                                                <div class="layui-collapse" lay-accordion="now" lay-filter="now">
                                                                                    @foreach($vo2['children'] as $key3=>$vo3)
                                                                                        <div class="layui-colla-item">
                                                                                            <h2 class="layui-colla-title" data-parag_num="{{$vo3['parag_num']}}">{{$vo3['parag_num']}}&nbsp;{{$vo3['title']}}</h2>
                                                                                            <div class="layui-colla-content">
                                                                                                <p>{{$vo3['content']}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                                <div class="offer-title" id="transaction_div"><div class="offer-title-icon"></div><div class="offer-title-content">交易流程</div></div>
                                <div class="layui-tab">
                                    <ul class="layui-tab-title">
                                        <li class="layui-this">跨境集运</li>
                                        <li>国内配送</li>
                                    </ul>
                                    <div class="layui-tab-content">
                                        <div class="layui-tab-item layui-show">
                                            <div class="cont1-bg">
                                                <div class="cont1">
                                                    {{--                                                <p class="intro f26"></p>--}}
                                                    <div class="cont1-items">
                                                        <div class="control_process">
                                                            @foreach($goods['cross_process'] as $k=>$v)
                                                                <div class="switch_process_{{$k}} @if($k==0)
                                                                        hover
@endif switch_process" onclick="switch_process({{$k}},this)">{{$v['step']}}：{{$vo['content']}}</div>
                                                            @endforeach
                                                        </div>
                                                        <div class="process_container">
                                                            @foreach($goods['cross_process'] as $k=>$v)
                                                                <div class="process_num_{{$k}}" @if($k!=0)
                                                                style="display:none;"
                                                                        @endif>
                                                                    <div class="disf">
                                                                        @foreach($v['children'] as $key=>$vo2)
                                                                            @if(!empty($vo2['link']))
                                                                                <a href="{{$vo2['link']}}" target="_blank" class="f18 process_child" style="position: relative;">
                                                                                    @else
                                                                                        <a href="javascript:void(0);" target="_blank" class="f18 process_child" style="position: relative;">
                                                                                            @endif
                                                                                            <img src="https://shop.gogo198.cn/{{$vo2['icon']}}" alt="" class="process_img">
                                                                                            <div class="f15 process_text">{{$vo2['content']}}</div>
                                                                                            <div class="process_arrow_box" style="position: absolute;top: 0;right: -25px;">
                                                                                                <img src="https://www.gogo198.com/img/arrow.png" alt="" class="process_arrow">
                                                                                            </div>
                                                                                        </a>
                                                                                @endforeach
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="layui-tab-item">
                                            <div class="cont1-bg">
                                                <div class="cont1">
                                                    {{--                                                <p class="intro f26"></p>--}}
                                                    <div class="cont1-items">
                                                        <div class="control_process">
                                                            @foreach($goods['domestic_process'] as $k=>$v)
                                                                <div class="switch_process_{{$k}} @if($k==0)
                                                                        hover
                                                                @endif switch_process" onclick="switch_process({{$k}},this)">{{$v['step']}}：{{$vo['content']}}</div>
                                                            @endforeach
                                                        </div>
                                                        <div class="process_container">
                                                            @foreach($goods['domestic_process'] as $k=>$v)
                                                                <div class="process_num_{{$k}}" @if($k!=0)
                                                                style="display:none;"
                                                                        @endif>
                                                                    <div class="disf">
                                                                        @foreach($v['children'] as $key=>$vo2)
                                                                            @if(!empty($vo2['link']))
                                                                                <a href="{{$vo2['link']}}" target="_blank" class="f18 process_child" style="position: relative;">
                                                                                    @else
                                                                                        <a href="javascript:void(0);" target="_blank" class="f18 process_child" style="position: relative;">
                                                                                            @endif
                                                                                            <img src="https://shop.gogo198.cn/{{$vo2['icon']}}" alt="" class="process_img">
                                                                                            <div class="f15 process_text">{{$vo2['content']}}</div>
                                                                                            <div class="process_arrow_box" style="position: absolute;top: 0;right: -25px;">
                                                                                                <img src="https://www.gogo198.com/img/arrow.png" alt="" class="process_arrow">
                                                                                            </div>
                                                                                        </a>
                                                                                @endforeach
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="offer-title" id="baozhang_div"><div class="offer-title-icon"></div><div class="offer-title-content">保障说明</div></div>
                                <ul class="goods-spec">
                                    <li>
                                        保障说明：
                                        <span id="crossborder-intro" title="保障说明" class="goods-attr-value"><a href="{{$goods['intro_info']['baozhang_link']}}" target="_blank" style="text-decoration: underline;">打开保障说明</a></span>
                                    </li>
                                </ul>

                                <div class="offer-title" id="content_div"><div class="offer-title-icon"></div><div class="offer-title-content">内容声明</div></div>
                                <ul class="goods-spec">
                                    <li>
                                        内容声明：
                                        <span id="crossborder-intro" title="内容声明" class="goods-attr-value"><a href="{{$goods['intro_info']['neirong_link']}}" target="_blank" style="text-decoration: underline;">打开内容声明</a></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @else

                @endif
            </div>
        </div>
    </div>

    <!--在线咨询-->
    <div class="chaton" style="display: none;">
        <div class="layui-fluid">
            <div class="layui-row layui-col-space15">
                <div class="layui-tab">
                    <ul class="layui-tab-title">
                        <li class="layui-this">聊天</li>
                        <li>记录</li>
                    </ul>
                    <div class="layui-tab-content">
                        <div class="layui-tab-item layui-show">
                            <form class="layui-form" action="" method="post" lay-filter="component-form-element3">
                                <input type="text" name="goodid" value="{{$goods['goods_id']}}" style="display: none;">
                                <input type="text" name="shopid" value="{{$goods['shop_id']}}" style="display: none;">
                                <div class="layui-col-md12">
                                    <div class="layui-card">
                                        <div class="layui-card-body">
                                            <div class="layui-form-item">
                                                <div class="layui-form-label">内容</div>
                                                <div class="layui-input-block disf">
                                                    <textarea name="content" class="layui-textarea" lay-verify="required" placeholder="请输入内容"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="layui-form-item" style="margin-top: 25px;text-align: center;">
                                    <div>
                                        <button class="layui-btn layui-btn-normal" lay-submit lay-filter="component-form-element4">立即提交</button>
                                        {{--                            <button type="reset" class="layui-btn layui-btn-primary">重置</button>--}}
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="layui-tab-item">
                            <!--记录-->
                            <style>
                                /*.reply_content{position:absolute;background:#fff;padding:15px;box-sizing:border-box;box-shadow: 0px 0px 0px 10px #999;}*/
                            </style>
                            <table class="layui-table">
                                <thead>
                                <tr>
                                    <th>咨询内容</th>
                                    <th>咨询时间</th>
                                    <th>查看回复</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($chat_log as $k=>$v)
                                    <tr>
                                        <td>{{$v['content']}}</td>
                                        <td>{{$v['createtime']}}</td>
                                        <td class="reply_div" style="position:relative;">
                                            <div class="layui-btn layui-btn-primary layui-btn-md" onclick="view_reply({{$v['id']}},this)">查看回复</div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--在线反馈-->
    <div class="feeback" style="display: none;">
        <div class="layui-fluid">
            <div class="layui-row layui-col-space15">
                <form class="layui-form" action="" method="post" lay-filter="component-form-element">
                    <div class="layui-col-md12">
                        <div class="layui-card">
                            <div class="layui-card-body">
                                <div class="layui-form-item">
                                    <div class="layui-form-label">选择类别</div>
                                    <div class="layui-input-block disf">
                                        <select name="type" id="type" lay-filter="type">
                                            <option value="1">建议</option>
                                            <option value="2">投诉</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <div class="layui-form-label">内容</div>
                                    <div class="layui-input-block disf">
                                        <textarea name="content" class="layui-textarea" placeholder="请输入内容(必填)" lay-verify="required"></textarea>
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <div class="layui-form-label">文件上传(选填)</div>
                                    <div class="layui-input-block disf" style="width:85%;">
                                        <div class="layui-upload" style="text-align:left;width: 100%;">
                                            <button type="button" class="layui-btn" id="advice_file-upload">上传文件</button>
                                            <blockquote class="layui-elem-quote layui-quote-nm yulan" style="margin-top: 10px;width: 100%;">
                                                预览图：
                                                <div class="layui-upload-list" id="advice_file-upload-list"></div>
                                            </blockquote>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item" style="margin-top: 25px;text-align: center;">
                        <div>
                            <button class="layui-btn layui-btn-normal" lay-submit lay-filter="component-form-element2">立即提交</button>
                            {{--                            <button type="reset" class="layui-btn layui-btn-primary">重置</button>--}}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if(sysconf('goods_info_pickup'))
        <!-- 自提点弹框 _start-->
        <!-- 自提点 _start -->
        <div id="goods_pickup" class="goods-pickup">
            <div class="box-title">自提点列表</div>
            <div class="box-oprate" data-shop_id='1'></div>
            <div class="content-info">
                <form method="post" onSubmit="return false;">
                    <div class="logistics-search-box">
                        <input class="logistics-search-input" placeholder="请输入自提点名称或自提点所在地" type="text" name="logistics-search" data-shop_id='1' onkeydown='logistics(event);' />
                        <a class="btn btn-primary" data-shop_id='1'>搜索</a>
                    </div>
                    <ul class="logistics-store-list">


                        {{--引入自提点--}}
                        {{--                    include('goods.partials._self_pickup_list')--}}


                    </ul>

                </form>
            </div>
        </div>
        <script type="text/javascript">
            layui.use(['layer','element','upload','form'],function() {
                var $ = layui.$
                    , layer = layui.layer
                    , element = layui.element
                    , form = layui.form
                    , upload = layui.upload;

                element.render('collapse');

                form.render(null,'component-form-element');
                form.render(null,'component-form-element3');
                form.render(null,'glist-element');

                //立即购买
                form.on('submit(glist-element2)', function(data){
                    layer.load();
                    //整理数组
                    var buy_attr = []; // 存放结果的数组
                    if("{{$goods['have_specs']}}"==1){
                        //有规格

                        //整理商品信息
                        $('.attr_ids').each(function(index,element) {
                            var value = $(this).val();
                            var spec_id = $('.spec_ids').eq(index).val();
                            var attr_name = $('.attr_name').eq(index).val();
                            var buy_num = $('.buynum').eq(index).val();
                            var now_gprice = $('.now_gpriceinput').eq(index).val();
                            buy_attr.push({'attr_id':value,'spec_id':spec_id,'attr_name':attr_name,'buy_num':buy_num,'now_gprice':now_gprice});
                        });
                        // console.log(buy_attr,data.field);return false;
                    }else if("{{$goods['have_specs']}}"==2){
                        //无规格
                        $('.buynum').each(function(index,element) {
                            var buy_num = $('.buynum').eq(index).val();
                            var now_gprice = $('.now_gpriceinput').eq(index).val();
                            buy_attr.push({'buy_num':buy_num,'now_gprice':now_gprice});
                        });
                    }

                    //整理减免优惠信息
                    var prefe_reduction = [];
                    $('.prefe_reduction').each(function(index,element){
                        //判断有无选中
                        if($(this).is(':checked')==true){
                            prefe_reduction.push({'strict':$(this).attr('data-strict'),'type':$(this).attr('data-type'),'reduction_currency':$(this).attr('data-reduction_currency'),'reduction_price':$(this).attr('data-reduction_price')});
                        }
                    });

                    //整理随赠优惠信息
                    var prefe_gift = [];
                    $('.prefe_gift').each(function(index,element){
                        //判断有无选中
                        if($(this).is(':checked')==true){
                            if($(this).attr('data-type')==1){
                                //积分
                                prefe_gift.push({'strict':$(this).attr('data-strict'),'type':$(this).attr('data-type'),'operaer':$(this).attr('data-operaer'),'points_type':$(this).attr('data-points_type'),'points_currency':$(this).attr('data-points_currency'),'points_money':$(this).attr('data-points_money'),'points_send':$(this).attr('data-points_send')});
                            }else if($(this).attr('data-type')==2){
                                //卡券
                                prefe_gift.push({'strict':$(this).attr('data-strict'),'type':$(this).attr('data-type'),'operaer':$(this).attr('data-operaer'),'coupon_num':$(this).attr('data-coupon_num'),'coupon_currency':$(this).attr('data-coupon_currency'),'coupon_money':$(this).attr('data-coupon_money')});
                            }else if($(this).attr('data-type')==3){
                                //随赠
                                prefe_gift.push({'strict':$(this).attr('data-strict'),'type':$(this).attr('data-type'),'accgift_type':$(this).attr('data-accgift_type'),'accgift_content':$(this).attr('data-accgift_content'),'accgift_num':$(this).attr('data-accgift_num')});
                            }
                        }
                    });

                    $.ajax({
                        url: "/buy_goods",
                        method: 'post',
                        data: {'data': data.field,'prefe_reduction':prefe_reduction,'prefe_gift':prefe_gift,'buy_attr':buy_attr,'good_id':"{{$goods['goods_id']}}",'shop_id':"{{$goods['shop_id']}}",'isapply':0},
                        dataType: 'JSON',
                        success: function (res) {
                            layer.closeAll('loading');
                            layer.msg(res.msg,{time:2000}, function () {
                                if (res.code == 0) {
                                    if(res.data.pay_method==1){
                                        layer.open({
                                            type: 1,
                                            title: '请打开微信扫码进入支付',
                                            area: ['300px', '300px'],
                                            content: '<div style="padding:20px;box-sizing: border-box;text-align:center;"><img src="'+res.data.code_url+'?v=<?php echo time();?>" style="width:150px;height:150px;"><p>请打开微信扫码进入支付</p></div>'
                                        });
                                    }
                                    // window.location.reload();
                                }
                            });
                        }
                    });
                    return false;
                });

                //建议/反馈
                form.on('submit(component-form-element2)', function(data){
                    // console.log(data.field);
                    $.ajax({
                        url: "/advice",
                        method: 'post',
                        data: {'data': data.field,'_token':"{{csrf_token()}}"},
                        dataType: 'JSON',
                        success: function (res) {
                            layer.msg(res.msg,{time:2000}, function () {
                                if (res.code == 0) {
                                    window.location.reload();
                                }
                            });
                        }
                    });
                    return false;
                    {{--$.getJSON("/advice",{'data': data.field,'_token':"{{csrf_token()}}"},function(res){--}}
                    {{--    layer.msg(res.msg,{time:2000}, function () {--}}
                    {{--        if (res.code == 0) {--}}
                    {{--            window.location.reload();--}}
                    {{--        }--}}
                    {{--    });--}}
                    {{--});--}}
                    {{--return false;--}}
                });
                //聊天
                form.on('submit(component-form-element4)', function(data){
                    $.getJSON("/chaton",{'data': data.field},function(res){
                        layer.msg(res.msg,{time:2000}, function () {
                            if (res.code == 0) {
                                window.location.reload();
                            }
                        });
                    });
                    return false;
                });

                //在线申请
                form.on('submit(apply-element)',function(data){
                    layer.load();
                    //整理数组
                    var buy_attr = []; // 存放结果的数组
                    if("{{$goods['have_specs']}}"==1){
                        //有规格

                        //整理商品信息
                        $('.attr_ids').each(function(index,element) {
                            var value = $(this).val();
                            var spec_id = $('.spec_ids').eq(index).val();
                            var attr_name = $('.attr_name').eq(index).val();
                            var buy_num = $('.buynum').eq(index).val();
                            var now_gprice = $('.now_gpriceinput').eq(index).val();
                            buy_attr.push({'attr_id':value,'spec_id':spec_id,'attr_name':attr_name,'buy_num':buy_num,'now_gprice':now_gprice});
                        });
                        // console.log(buy_attr,data.field);return false;
                    }else if("{{$goods['have_specs']}}"==2){
                        //无规格
                        $('.buynum').each(function(index,element) {
                            var buy_num = $('.buynum').eq(index).val();
                            var now_gprice = $('.now_gpriceinput').eq(index).val();
                            buy_attr.push({'buy_num':buy_num,'now_gprice':now_gprice});
                        });
                    }

                    //整理减免优惠信息
                    var prefe_reduction = [];
                    $('.prefe_reduction').each(function(index,element){
                        //判断有无选中
                        if($(this).is(':checked')==true){
                            prefe_reduction.push({'strict':$(this).attr('data-strict'),'type':$(this).attr('data-type'),'reduction_currency':$(this).attr('data-reduction_currency'),'reduction_price':$(this).attr('data-reduction_price')});
                        }
                    });

                    //整理随赠优惠信息
                    var prefe_gift = [];
                    $('.prefe_gift').each(function(index,element){
                        //判断有无选中
                        if($(this).is(':checked')==true){
                            if($(this).attr('data-type')==1){
                                //积分
                                prefe_gift.push({'strict':$(this).attr('data-strict'),'type':$(this).attr('data-type'),'operaer':$(this).attr('data-operaer'),'points_type':$(this).attr('data-points_type'),'points_currency':$(this).attr('data-points_currency'),'points_money':$(this).attr('data-points_money'),'points_send':$(this).attr('data-points_send')});
                            }else if($(this).attr('data-type')==2){
                                //卡券
                                prefe_gift.push({'strict':$(this).attr('data-strict'),'type':$(this).attr('data-type'),'operaer':$(this).attr('data-operaer'),'coupon_num':$(this).attr('data-coupon_num'),'coupon_currency':$(this).attr('data-coupon_currency'),'coupon_money':$(this).attr('data-coupon_money')});
                            }else if($(this).attr('data-type')==3){
                                //随赠
                                prefe_gift.push({'strict':$(this).attr('data-strict'),'type':$(this).attr('data-type'),'accgift_type':$(this).attr('data-accgift_type'),'accgift_content':$(this).attr('data-accgift_content'),'accgift_num':$(this).attr('data-accgift_num')});
                            }
                        }
                    });

                    $.ajax({
                        url: "/buy_goods",
                        method: 'post',
                        data: {'data': data.field,'prefe_reduction':prefe_reduction,'prefe_gift':prefe_gift,'buy_attr':buy_attr,'good_id':"{{$goods['goods_id']}}",'shop_id':"{{$goods['shop_id']}}",'isapply':1},
                        dataType: 'JSON',
                        success: function (res) {
                            layer.closeAll('loading');
                            layer.msg(res.msg,{time:2000}, function () {
                                if (res.code == 0) {
                                    @if($goods['shop_id']>0)
                                        window.location.href="{{$goods['platform_valueInfo']['apply_link']}}?oid="+res.data.order_id;
                                    @endif
                                }
                            });
                        }
                    });
                    return false;
                });

                // 轮播图内页文件
                // $('#advice_file-upload').click(function(){
                //     $.getJSON("http://apiadmin.gogo198.cn/collect_website/public/?s=api/uploadfile/index",{'folder': 'shopping', 'type': 'advice'},function(res){
                //         console.log(res);
                //     });
                // });

                upload.render({
                    elem: '#supervise_file-upload'
                    ,url: '/upload_file'
                    ,accept: 'file'
                    ,data: { folder: 'shopping', type: 'supervise','_token':"{{csrf_token()}}"}
                    ,multiple: false
                    ,number:9
                    ,before: function(obj){
                        // layer.load(); //上传loading
                    }
                    ,done: function(res){
                        // layer.closeAll('loading'); //关闭loading
                        if(res.code == 1)
                        {
                            $('#supervise_file-upload-list').append('<div style="display: inline-block;"><img onclick="seePic(this);" src="https://shop.gogo198.cn/'+ res.file_path +'" class="layui-upload-img" style="width:80px;height:80px;"><button type="button" onclick="delPic(this);" class="layui-btn layui-btn-xs layui-btn-danger" style="position: relative;left: -45px;top: -39px;">删除</button><input type="text" name="supervise_file[]" value="'+res.file_path+'" style="display: none;"></div>');
                        }
                    }
                });

                upload.render({
                    elem: '#advice_file-upload'
                    ,url: '/upload_file'
                    ,accept: 'file'
                    ,data: { folder: 'shopping', type: 'advice','_token':"{{csrf_token()}}"}
                    ,multiple: false
                    ,number:9
                    ,before: function(obj){
                        // layer.load(); //上传loading
                    }
                    ,done: function(res){
                        // layer.closeAll('loading'); //关闭loading
                        if(res.code == 1)
                        {
                            $('#advice_file-upload-list').append('<div style="display: inline-block;"><img onclick="seePic(this);" src="https://shop.gogo198.cn/'+ res.file_path +'" class="layui-upload-img" style="width:80px;height:80px;"><button type="button" onclick="delPic(this);" class="layui-btn layui-btn-xs layui-btn-danger" style="position: relative;left: -45px;top: -39px;">删除</button><input type="text" name="fb_file[]" value="'+res.file_path+'" style="display: none;"></div>');
                        }
                    }
                });

                //商品信息滚动-start
                var myDiv = document.getElementById('goodsDetail');
                window.addEventListener('scroll', function() {
                    // 获取页面滚动位置
                    var scrollTop = window.pageYOffset || document.documentElement.scrollTop;

                    // 获取目标div元素的位置信息
                    var divTop = myDiv.offsetTop;
                    var divHeight = myDiv.offsetHeight;
                    var divWidth = myDiv.offsetWidth;

                    // 判断滚动位置是否超过目标div元素
                    if (scrollTop > divTop && scrollTop < divTop + divHeight) {
                        // 大于
                        $('#goodsDetail').find('.layui-tab-title').eq(0).addClass('goodsDetail_fixed');
                        $('#goodsDetail').find('.tab_topnav').addClass('tab_topnav_fixed');
                        $('.storeName').addClass('storeName_fixed');
                        $('.goodsDetail_fixed').css({'width':divWidth+'px'});
                        $('.tab_topnav_fixed').css({'width':divWidth+'px'});
                        $('#goodsDetail').find('.tab_content').css({'margin-top':'160px'});
                    }else{
                        //小于
                        $('#goodsDetail').find('.layui-tab-title').eq(0).removeClass('goodsDetail_fixed');
                        $('#goodsDetail').find('.tab_topnav').removeClass('tab_topnav_fixed');
                        $('.storeName').removeClass('storeName_fixed');
                        $('#goodsDetail').find('.tab_content').css({'margin-top':'0px'});
                    }
                });

                document.getElementById("sale_navDiv").addEventListener("click", function(event) {
                    event.preventDefault(); // 阻止默认的链接行为
                    scro("sale_div");
                });
                document.getElementById("logi_navDiv").addEventListener("click", function(event) {
                    event.preventDefault(); // 阻止默认的链接行为
                    scro("logi_div");
                });
                document.getElementById("price_navDiv").addEventListener("click", function(event) {
                    event.preventDefault(); // 阻止默认的链接行为
                    scro("price_div");
                });
                document.getElementById("cross_navDiv").addEventListener("click", function(event) {
                    event.preventDefault(); // 阻止默认的链接行为
                    scro("cross_div");
                });
                document.getElementById("transport_navDiv").addEventListener("click", function(event) {
                    event.preventDefault(); // 阻止默认的链接行为
                    scro("transport_div");
                });
                document.getElementById("platform_navDiv").addEventListener("click", function(event) {
                    event.preventDefault(); // 阻止默认的链接行为
                    scro("platform_div");
                });
                document.getElementById("transaction_navDiv").addEventListener("click", function(event) {
                    event.preventDefault(); // 阻止默认的链接行为
                    scro("transaction_div");
                });
                document.getElementById("baozhang_navDiv").addEventListener("click", function(event) {
                    event.preventDefault(); // 阻止默认的链接行为
                    scro("baozhang_div");
                });
                document.getElementById("content_navDiv").addEventListener("click", function(event) {
                    event.preventDefault(); // 阻止默认的链接行为
                    scro("content_div");
                });
                //商品信息滚动-end
            });

            function view_reply(id,t){
                var layer = layui.layer,$ = layui.$;

                var text = '';
                $.getJSON("/get_reply",{'id':id},function(res){
                    if(res.data==null){
                        layer.msg('暂无回复');
                    }else{
                        text = res.data.content;
                        // $(t).parent().find('.reply_content').text();
                        setTimeout(function(){
                            layer.open({
                                type:1,
                                title:'查看回复',
                                area:['600px','500px'],
                                content:'<div class="reply_content" style="padding:10px;box-sizing:border-box;">'+text+'</div>'
                            });
                            // $(t).parent().find('.reply_content').show();
                        },1000);
                    }
                });
            }

            function scro(elem){
                var targetElement = document.getElementById(elem); // 获取目标元素
                targetElement.scrollIntoView({ behavior: "smooth" }); // 平滑滚动到目标元素位置
            }

            function delPic(obj)
            {
                var layer = layui.layer,$ = layui.$;
                layer.confirm('确认要删除该附件？', {
                    btn: ['删除','取消']
                }, function(){
                    $(obj).parent().remove();
                    layer.closeAll();
                }, function(){

                });
            }

            function seePic(thi){
                var layer = layui.layer
                    ,$ = layui.jquery;

                layer.open({
                    type:1,
                    title:'查看图片',
                    area:['100%','100%'],
                    content:'<img src="'+$(thi).attr('data-img')+'" class="layui-upload-img" onerror=src="https://shop.gogo198.cn/attachment/images/default_file.png" style="width:100%;height:100%;">'
                });
            }

            function IsPhone() {
                var info = navigator.userAgent;
                var isPhone = /Mobi|Android|iPhone/i.test(info);
                return isPhone;
            }

            //在线咨询&在线反馈-start
            function onchat(){
                var $ = layui.$
                    , layer = layui.layer;
                if("{{session('user.user_id')}}" != ''){
                    let area = ['800px','500px'];
                    if(IsPhone()){
                        area = ['100%','100%'];
                    }

                    layer.open({
                        type: 1,
                        title:'在线咨询',
                        area: area,
                        // offset: ['25%', '30%'],
                        content: $('.chaton')
                    });
                }else{
                    $.login.show();
                }
            }

            function advice(){
                var $ = layui.$
                    , layer = layui.layer;
                if("{{session('user.user_id')}}" != ''){
                    let area = ['800px','500px'];
                    if(IsPhone()){
                        area = ['100%','100%'];
                    }

                    layer.open({
                        type: 1,
                        title:'在线反馈',
                        area: area,
                        // offset: ['25%', '30%'],
                        content: $('.feeback')
                    });
                }else{
                    $.login.show();
                }
            }
            //在线反馈-end

            //交易流程-start
            function switch_process(key,t){
                $(t).parents(":eq(1)").find('.switch_process_' + key).addClass('hover');
                $(t).parents(":eq(1)").find('.switch_process_' + key).siblings().removeClass('hover');
                $(t).parents(":eq(1)").find('.process_num_' + key).siblings().hide();
                $(t).parents(":eq(1)").find('.process_num_' + key).show();
                if(IsPhone()){
                    //手机版滑动
                    if(key==2){
                        $(t).parents(":eq(1)").find('.control_process').animate({ scrollLeft: 0 }, 500);
                    }
                    else if(key==3){
                        $(t).parents(":eq(1)").find('.control_process').animate({ scrollLeft: 130 }, 500);
                    }else if(key==4){
                        $(t).parents(":eq(1)").find('.control_process').animate({ scrollLeft: 250 }, 500);
                    }
                }
            }
            //交易流程-end

            // 添加对比
            $(".btn-primary").click(function() {
                var keyword = $(".logistics-search-input").val();
                var shop_id = $(this).data('shop_id');
                $.post("/goods/search-pickup.html", {
                    "keyword": keyword,
                    "shop_id": shop_id
                }, function(result) {
                    if (result.code == 0) {
                        $(".logistics-store-list").html(result.data);

                    }
                }, "json");
            });
            function logistics(e) {
                if (e.keyCode == 13) {
                    var keyword = $(".logistics-search-input").val();
                    var shop_id = $('.logistics-search-input').data('shop_id');
                    $.post("/goods/search-pickup.html", {
                        "keyword": keyword,
                        "shop_id": shop_id
                    }, function(result) {
                        if (result.code == 0) {
                            $(".logistics-store-list").html(result.data);

                        }
                    }, "json");
                }
            }
        </script>
        <!-- 自提点 _end -->
        <!-- 自提点弹框 _end-->
    @endif

    <!-- 头部右侧鼠标经过图片放大效果 _start -->
    <script type="text/javascript" src="/js/bubbleup.js"></script>
    <!-- 头部右侧鼠标经过图片放大效果 _end -->
    <!-- 套餐、店内排行等左右切换效果 _start-->
    <script type="text/javascript" src="/js/tabs.js"></script>
    <!-- 套餐、店内排行等左右切换效果 _end -->
    <!-- 右侧商品信息等定位切换效果 _start -->
    {{--    <script type="text/javascript" src="/js/tabs_totop.js"></script>--}}
    <!-- 右侧商品信息等定位切换效果 _end -->
    <!-- 控制图片经过放大 -->
    <script type="text/javascript" src="/js/goods.js"></script>
    <!-- 地址选择 _start -->
    <script type="text/javascript" src="/js/select_region.js"></script>
    <!-- 地址选择 _end -->
    <script id="SZY_GIFT_TEMPLATE" type="text">
        <div class="prom-gift-list">
            <a href="" title="" target="_blank">
                <img src="" width="25" height="25" class="gift-img" />
            </a>
            <em class="gift-number color">×</em>
        </div>
    </script>
    @if(!empty($user_info))
        <!-- 分享 -->
        <script type="text/javascript">
            var url =  location.href;
            if (url.indexOf("user_id=") == -1 && window.history && history.pushState){
                if(url.indexOf("?") == -1){
                    url += "?user_id=" + "{{ $user_info['user_id'] }}";
                }else{
                    url += "&user_id=" + "{{ $user_info['user_id'] }}";
                }
                history.replaceState(null, document.title, url);
            }
        </script>
    @endif
    {{--    <script type="text/javascript" src="http://webapi.amap.com/maps?v=1.3&key={{ sysconf('amap_js_key') }}&&plugin=AMap.Geocoder,AMap.Geolocation,AMap.Autocomplete"></script>--}}
    <!-- 获取当前地址 -->
    <script type="text/javascript">
        var deferred = $.Deferred();

        var local_region_code = "{{ $region_code }}";

        $().ready(function() {

            //
            if (local_region_code && local_region_code.length > 0) {
                changeLocation(local_region_code);
            }
            //

            //变更配送地址
            var region_chooser = $(".region-chooser-container").regionchooser({
                value: local_region_code,
                change: function(value, names, is_last) {
                    if (!is_last) {
                        return;
                    }
                    // 记录当前地址选择
                    local_region_code = value;
                    changeLocation(value);
                }
            });

            //在线客服
            /* 	$(".service-online").click(function() {
                    var goods_id = 249;
                    $.openim({
                        goods_id:goods_id
                    });
                }) */


            // 添加对比
            $(".add-compare").click(function(event) {
                var target = $(this);
                var goods_id = $(this).data("goods-id");
                var sku_id = $(this).add("sku-id");
                var image_url = $(this).data("image-url");
                $.compare.toggle(goods_id, image_url, event, function(result) {
                    if (result.data == 1) {
                        $(target).addClass("curr");
                        $(target).find('i').html('&#xe6ae;');
                    } else {
                        $(target).removeClass("curr");
                        $(target).find('i').html('&#xe715;');
                    }
                });
            });

            // 添加收藏
            $(".collect-goods").click(function(event) {
                var target = $(this);
                var goods_id = $(this).data("goods-id");

                var sku_id = getSkuId();

                $.collect.toggleGoods(goods_id, sku_id, function(result) {
                    if (result.code != 0) {
                        return;
                    }

                    var desc = "";

                    //
                    if(result.collect_count > 0){
                        desc = "(" + result.collect_count + "人气)";
                    }
                    //
                    if (result.data == 1) {
                        $(target).addClass("curr");
                        $(target).find('i').html('&#xe6b1;');
                        $(target).find("span").html("取消收藏" + desc);
                    } else {
                        $(target).removeClass("curr");
                        $(target).find('i').html('&#xe6b3;');
                        $(target).find("span").html("收藏商品" + desc);
                    }
                }, true);
            });
            // 添加收藏
            $(".collect-shop").click(function(event) {
                var target = $(this);
                var shop_id = "1";
                $.collect.toggleShop(shop_id, function(result) {
                    if (result.data == 1) {
                        $(target).find("span").html("取消关注");
                        $(target).find('i').html('&#xe6b1;');
                    } else {
                        $(target).find("span").html("关注本店");
                        $(target).find('i').html('&#xe6b3;');
                    }
                });
            });

            // 领取红包
            $("body").on("click", ".bonus-receive", function() {
                var bonus_id = $(this).data("bonus-id");
                var target = $(this);
                $.bonus.receive(bonus_id, function(result) {
                    if (result.code == 0) {
                        // 0-已领取 1-还可以继续领取
                        if (result.data == 0) {
                            $(target).html("已领取").removeClass("color").removeClass("bonus-receive").addClass("bonus-received");
                        }
                        $.msg(result.message);
                        return;
                    } else if (result.code == 130) {
                        $(target).html("已领取").removeClass("color").removeClass("bonus-receive").addClass("bonus-received");
                    } else if (result.code == 131) {
                        $(target).html("已抢光").removeClass("color").removeClass("bonus-receive").addClass("bonus-received");
                    } else {

                    }
                    $.msg(result.message, {
                        time: 5000
                    });
                });
            });
        });
    </script>
    <script type="text/javascript">
        //固定滚动条位置
        $.fixedScorll.read("SZY_GOODS_SCORLL");

        $().ready(function() {

            // 申请代理
            $("body").on("click", ".no-auth", function() {
                // 商品ID
                var id = $(this).data("goods_id");

                $.ajax({
                    type:"POST",
                    url:'/goods/shop-type-by-goods',
                    data: {
                        goods_id: id
                    },
                    dataType: "json",
                    success:function(result){
                        if(result.code==0){
                            $.open({
                                title: "申请代理	",
                                //type:2,
                                ajax: {
                                    url: '/compare/agent',
                                    data: {
                                        goods_id: id
                                        //	single: single
                                    }
                                },
                                width: "900px",
                                btn: ['确定', '取消'],
                                yes: function(index, container) {
                                    if (!validator.form()) {
                                        return;
                                    }

                                    var data = $(container).serializeJson();
                                    $.loading.start();
                                    $.post('/compare/agent', data, function(result) {
                                        $.loading.stop();
                                        if (result.code == 0) {
                                            //tablelist.load();
                                            $.msg(result.message);
                                            $.closeDialog(index);
                                        } else {
                                            $.msg(result.message, {
                                                time: 5000
                                            })
                                        }
                                    }, "json");
                                }
                            });
                        }
                    }
                });
            });

            var desc_container = $(".goods-detail-content");
            var evaluate_container = $("#goods_evaluate");

            function load() {

                // 加载商品详情
                if (!$("body").data("loading-goods-desc")) {
                    // 计算高度
                    if ($(document).scrollTop() >= $(desc_container).offset().top - $(window).height()) {
                        $("body").data("loading-goods-desc", true);
                        $.get("/goods/desc.html", {
                            sku_id: "{{ $goods['sku_id'] }}",
                            is_lib_goods: ""
                        }, function(result) {
                            $(desc_container).html(result.pc_desc);
                        }, "json");
                    }
                }
                // 评论
                if (!$("body").data("loading-goods-comment") && $(evaluate_container).size() > 0) {
                    // 计算高度
                    if ($(document).scrollTop() >= $(evaluate_container).offset().top - $(window).height()) {
                        $("body").data("loading-goods-comment", true);
                        $.get('/goods/comment.html', {
                            sku_id: "{{ $goods['goods_id'] }}",
                            output: 1
                        }, function(result) {
                            if (result.code == 0) {
                                $(evaluate_container).html(result.data);
                                // $(evaluate_container).html('');
                            }
                        }, "json");
                    }
                }
            }

            load();

            // 加载商品详情和评论
            $(window).scroll(function() {
                load();
            });
        });
        //计算阶梯价格
        function getFinalPrice(sku_id, number) {
            var data = {
                sku_id: sku_id,
                number: number
            };
            $.get('/goods/get-final-price.html', data, function(result) {

                $('.SZY-GOODS-PRICE').html(result.data.goods_price_format);

            }, 'json');
        }
    </script>

    {{--todo 判断 限时团购倒计时显示--}}
    <!-- 倒计时 -->
    <script type="text/javascript">
        $().ready(function() {
            // <font id="groupbuy_countdown">此商品正在参加团购活动 3天19时28秒后结束</font>
            $("#groupbuy_countdown").countdown({
                time: "596522000",

                htmlTemplate: '<span>%{d}</span>:<span>%{h}</span>:<span>%{m}</span>:<span>%{s}</span>',

                leadingZero: true,
                onComplete: function(event) {
                    $(this).parent().html("团购活动已结束！");
                    $.go("{{ route('pc_show_goods',['goods_id'=>$goods['goods_id']]) }}");
                }
            });
        });
    </script>

    {{--todo 判断 限时折扣倒计时显示--}}
    <!-- 倒计时 -->
    <script type="text/javascript">
        $().ready(function() {
            // <font id="groupbuy_countdown">此商品正在参加团购活动 3天19时28秒后结束</font>
            $("#limit_discount_countdown").countdown({
                time: "594235000",
                leadingZero: true,
                onComplete: function(event) {
                    //$(this).parent().html("活动已结束！");
                    $.go("{{ route('pc_show_goods',['goods_id'=>$goods['goods_id']]) }}");
                }
            });
        });
    </script>


    <!-- 预售倒计时 -->
    <link rel="stylesheet" href="/css/online.css?v=20190130"/>
    <div class="yikf-form site_yikf_form" id="yikf-kefu" style='display:none;'>
        <i class="yikf-icon"></i>

        <form class="yikf-item " action="https://kf.mall.laravelvip.com/index/index/home?business_id=eb5bf6642a5a445221241a51842b901c&groupid=0&shop_id=1&goods_id=249" method="post" target="_blank">
            <input type="hidden" name="visiter_id" value=''>
            <input type="hidden" name="visiter_name" value=''>
            <input type="hidden" name="avatar" value=''>
            <input type="hidden" name="domain" value=''>

            <input type="hidden" name="product" value='{"pid":249,"title":"\u6c5f\u534e-\u6d4b\u8bd5H1","img":"http:\/\/68yun.oss-cn-beijing.aliyuncs.com\/images\/15164\/shop\/1\/gallery\/2018\/05\/17\/15265253513800.jpg","info":"\u6d4b\u8bd5H1","price":"95.00","goods_type":null,"url":"http:\/\/www.b2b2c.yunmall.68mall.com\/goods-249.html"}'>

            <input type="submit" value='在线咨询'>
        </form>

        <form class="yikf-item " action="https://kf.yunmall.68mall.com/index/index/home?business_id=eb5bf6642a5afe7621241a51842b901c&groupid=151&shop_id=1&goods_id=249" method="post" target="_blank">
            <input type="hidden" name="visiter_id" value=''>
            <input type="hidden" name="visiter_name" value=''>
            <input type="hidden" name="avatar" value=''>
            <input type="hidden" name="domain" value=''>

            <input type="hidden" name="product" value='{"pid":249,"title":"\u6c5f\u534e-\u6d4b\u8bd5H1","img":"http:\/\/68yun.oss-cn-beijing.aliyuncs.com\/images\/15164\/shop\/1\/gallery\/2018\/05\/17\/15265253513800.jpg","info":"\u6d4b\u8bd5H1","price":"95.00","goods_type":null,"url":"http:\/\/www.b2b2c.yunmall.68mall.com\/goods-249.html"}'>

            <input type="submit" value='售前客服'>
        </form>

    </div>
    <script type="text/javascript">

    </script>
@stop