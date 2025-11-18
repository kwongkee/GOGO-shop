@extends('layouts.inner_header')

@section('header_js')
    <script src="/assets/d2eace91/js/jquery.cookie.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=20180528"></script>
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

<link rel="stylesheet" href="/assets/d2eace91/iconfont/iconfont.css?v=1.1"/>
<link rel="stylesheet" href="/css/common.css?v=1.1"/>

<!--整站改色 _start-->
@if(sysconf('custom_style_enable') == 1)
    <link rel="stylesheet" href="/css/custom/site-color-style-0.css?v=1.6" id="site_style"/>
@else
    <link rel="stylesheet" href="/css/color-style.css?v=1.6" id="site_style"/>
@endif
<!--整站改色 _end-->

{{--header_css--}}
@section('header_css')@show

<script src="/assets/d2eace91/js/jquery.js?v=1.1"></script>

<script src="/js/common.js?v=1.1"></script>
<!-- 图片缓载js -->
<script src="/assets/d2eace91/js/jquery.lazyload.js?v=1.1"></script>
{{--header_js--}}
@section('header_js')@show
{{--第三方登录验证代码--}}
{!! sysconf('website_login_code') !!}

{{--页面css/js--}}
@section('style_js')@show

@section('content')

    <!-- 内容 -->
    <!-- css -->
    <link rel="stylesheet" href="/css/goods.css?v=20180428"/>
    <!-- 地区选择器 -->
    <script src="/assets/d2eace91/js/jquery.region.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=<?php echo time();?>"></script>
    <script src="/assets/d2eace91/js/jquery.history.js?v=20180528"></script>
    <!-- 地区选择器 -->
    <!-- 放大镜 _start -->
    <script type="text/javascript" src="/js/magiczoom.js"></script>
    <!-- 放大镜 _end -->
    <link rel="stylesheet" href="/assets/d2eace91/layui/css/layui.css?v=23121"/>
    <link rel="stylesheet" href="/assets/d2eace91/js/layer/theme/default/layer.css?v=3.1.0" id="layuicss-layer">
    <script type="text/javascript" src="/assets/d2eace91/layui/layui.js"></script>

    <div class="w1210">
        <span class="SZY-GOODS-NAME-BASE" style="display: none;">{{ $detail['data']['goodsName'] }}</span>
        <style>
            body{background:#f5f5f5;}
            .store-service .store-service-group .service-list{padding-left:80px;}
            .tree li span{height:20px;}
            .goto{text-decoration: underline;}

            /**添加地址**/
            .sort_div,.addr{display: grid;grid-template-columns: repeat(2,1fr);-moz-column-gap: 0px;column-gap: 0px;row-gap: 0px;}
            .postal_temp{border:1px solid #000;width: 48px;height: 38px;text-align: center;line-height: 38px;margin-right:2px;}
            .postal_code{margin-right:2px;}
            .addr{width:100%;}
            .hide2{display: none;}

            .goods-info,.fl,.goodsDetail{background:#fff;}
            .goods-info{padding: 20px;box-sizing: border-box;}
            .goods-gallery-bottom a.goods-compare i{height: 18px;}

            .store-info_container{width:160px;margin-left:10px;background:#fff;margin-top: 10px;}
            .store-info_container .buy-shopBox {padding: 20px 18px 18px;position: relative;}
            .store-info_container .buy-shopBox .shopBox-header {align-items: center;color: #373737;display: flex;font-size: 14px;justify-content: space-between;line-height: 16px;margin-bottom: 14px;overflow: hidden;position: relative;text-overflow: ellipsis;white-space: nowrap;}
            .store-info_container .buy-shopBox .shopBox-header p {font-size: 18px;font-weight: 700;line-height: 18px;}
            .store-info_container .buy-shopBox .shopBox-header button {background: #333;border: none;border-radius: 50px;color: #fff;cursor: pointer;font-size: 12px;padding: 2px 10px;transition: all .3s linear;}
            .store-info_container .buy-shopBox .shop-title {border-bottom: 1px solid #eee;margin-bottom: 14px;overflow: hidden;padding-bottom: 14px;text-overflow: ellipsis;white-space: nowrap;}
            .store-info_container .buy-shopBox .shopBox-body {background: #fff;box-sizing: border-box;color: #999;text-align: center;}
            .store-info_container .buy-shopBox .shopBox-body>span {align-items: flex-end;color: #333;display: flex;font-size: 12px;}
            .store-info_container .buy-shopBox .shopBox-body>span em {color: #E31939;font-size: 30px;font-weight: 100;line-height: 30px;margin-right: 10px;}
            .store-info_container .buy-shopBox .shopBox-body .shop-score {border-bottom: 1px solid #eee;margin-top: 20px;padding-bottom: 15px;}
            .store-info_container .buy-shopBox .shopBox-body .shop-score li {display: flex;margin-bottom: 14px;}
            .store-info_container .buy-shopBox .shopBox-body .shop-score li span {color: #999;font-size: 12px;line-height: 12px;margin-right: 10px;}
            .store-info_container .buy-shopBox .shopBox-body i {margin-left: 1px;vertical-align: 2px;}

            .footer ul.social-network li{height:24px !important;}
            @media (max-width: 992px){
                .sort_div, .addr{grid-template-columns: repeat(1,1fr);}
            }
        </style>
        <div class="disf" style="align-items: normal;">
            <div class="goods-info" style="margin-top:10px;">
                <!-- 商品图片以及相册 _star-->
                <div id="preview" class="preview">
                    <!-- 商品相册容器 -->
                    <div class="goodsgallery"></div>
                    <script id="SZY_SKU_IMAGES" type="text">
                        {!! json_encode($arr['img']) !!}
                    </script>
                    <script type="text/javascript">
                        // 图片相册
                        $(".goodsgallery").goodsgallery({
                            images: $.parseJSON($("#SZY_SKU_IMAGES").html()),
                            video: ""
                        });
                    </script>
                    <!--相册 END-->
                    <div class="goods-gallery-bottom">


                        <a href="javascript:void(0);" class="goods-compare compare-btn fr add-compare" data-goods-id="" data-sku-id="" data-image-url="?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320">
                            <i class="iconfont icon-yanjing" style="background: url(/assets/d2eace91/images/newhome/grey_eyes.png) 0 5px no-repeat;    background-size: 100%;"></i>
                            7
                        </a>



                        <a href="javascript:void(0);" class="goods-col fr collect-goods" data-goods-id="">

                            {{--已收藏--}}
                            {{--                                <i class="iconfont">&#xe6b1;</i>--}}
                            {{--                                <span>取消收藏(人气)</span>--}}

                            {{--未收藏--}}
                            <i class="iconfont">&#xe6b3;</i>
                            <span>收藏商品</span>

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
                                "bdPic": "?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320",
                                "bdStyle": "0",
                                "bdSize": "16"
                            },
                            "share": {}
                        };
                        with (document) {
                            // 0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = '//bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~(-new Date() / 36e5)];
                        }
                    </script>
                </div>
                <!-- 商品图片以及相册 _end-->

                <!-- 商品详细信息 _star-->
                <div class="detail-info">
                    <form action="" method="post" name="" id="">
                        <!--代购须知-->
                        <style>
                            .goods-info{width:fit-content;}
                            .helpBox{box-sizing: content-box;margin-bottom: 10px;}
                            .helpBox .help_cont1 {background: #f1d4d9;border-radius: 10px;color: #E31939;cursor: help;font-size: 12px;height: 12px;line-height: 12px;padding: 4px 30px 4px 10px;position: relative;vertical-align: 5px;width: auto;}
                            .helpBox .help_cont1:after {background: url(/assets/d2eace91/images/newhome/question-1.png) no-repeat;background-size: contain;content: "";display: inline-block;height: 25px;margin-left: 8px;position: absolute;right: 4px;top: -2px;vertical-align: top;width: 25px;}
                            .helpBox .before-u-buy {color: #333;cursor: pointer;display: inline-block;font-size: 12px;height: 20px;line-height: 20px;margin-left: 10px;vertical-align: top;}
                            .goods-url{font-size:15px;color:#E31939;}
                            .goods-url:hover{text-decoration: underline;color:#E31939;}
                            .goods-price{background:unset;padding:0;}
                            .goods-price .realy-price .now-prices .p-price{font-size:20px;}
                            .choose dl.attr dt{margin-top:5px;}
                            .choose dl.attr dt,.choose dl.amount dt{font-weight:800;color:#000;font-size: 12px;}
                        </style>
                        <div class="helpBox disf">
                            <div class="help_cont1">
                                <span>代购商品</span>
                            </div>
                            <div class="before-u-buy">代购前需要知道的三件事 &gt;</div>
                        </div>
                        <!-- 商品名称 -->
                        <h1 class="goods-name SZY-GOODS-NAME">{{ $detail['data']['goodsName'] }}</h1>

                        <!-- 商品简单描述 -->
                        <p class="goods-brief second-color">
                            <a href="{{$detail['data']['goodsLink']}}" target="_blank" class="goods-url">直达链接&gt;</a>
                        </p>
                        <!-- 商品团购倒计时 -->
                        <!--当团购商品未开始时-->

                        <div class="goods-price">
                            <div class="realy-price">
                                <div class="now-prices">
                                    {{--                                <span class="price">售&nbsp;&nbsp;&nbsp;价</span>--}}
                                    <strong class="p-price second-color SZY-GOODS-PRICE">RMB￥ {{ $detail['data']['proPrice']['price'] }}</strong>
                                </div>
                            </div>
                            <div class="reson-tips">
                                <p>09:00~18:00(北京时间)付款，预计6个小时内订购或响应</p>
                            </div>

                            <style>
                                .purchase_process *{box-sizing: border-box;}
                                dl, dt, li, ol, ul {list-style-type: none;}
                                .purchase_process .goods-options-freight {background: #f9f9f9;margin-top: 10px;padding: 12px 15px;}
                                .purchase_process dd,.purchase_process div{font-size: 14px;font-style: normal;margin: 0;padding: 0;}
                                .purchase_process .new-goods-options-content>.label {align-items: center;display: flex;flex-wrap: wrap;margin-bottom: 15px;padding-left: 25px;position: relative;}
                                .purchase_process .new-goods-options-content>.label.label-one:before {background: #E31939;border-radius: 50%;bottom: 0;color: #fff;content: "1";font-size: 12px;height: 16px;left: 0;line-height: 16px;margin: auto;position: absolute;text-align: center;top: 0;width: 16px;}
                                .purchase_process .goods-freight {border: 1px solid #eee;color: #999;height: 26px;line-height: 29px;text-indent: 40px;transition: all .3s linear;vertical-align: top;width: 80px;}
                                .new-goods-options-content .label-title {color: #666;font-size: 12px;}
                                .new-goods-options-content>.label .arrow {color: #2896ff;font-size: 20px;line-height: 22px;margin: 0px 5px;}
                                .new-goods-options-content .label-title {color: #666;font-size: 12px;}
                                .new-goods-options-content>.label .label-description {font-size: 12px;}
                                .new-goods-options-content>.label .label-description em {color: #333;font-weight: 700;margin-left: 8px;}
                                .new-goods-options-content>.label .label-freight {align-items: center;display: flex;margin-left: auto;}
                                .new-goods-options-content>.label .label-freight label {align-items: center;display: flex;font-size: 12px;}
                                .new-goods-options-content>.label .label-input {align-items: center;display: flex;margin: 0 0 0 10px;}
                                .purchase_process .new-goods-options-content.cn .label-input .goods-freight-rmb {line-height: 27px !important;position: absolute;}
                                .new-goods-options-content>.label .label-input em, .new-goods-options-content>.label .label-input input{font-size: 12px;}
                                .new-goods-options-content>.label.label-one:after {background: #ddd;content: "";height: 14px;left: 7px;margin: 6px 0;position: absolute;top: 22px;width: 2px;}
                                .new-goods-options-content>.label.label-tow {margin-bottom: 12px;}
                                .goods-info_container .country-select {font-size: 12px;padding-left: 26px;}
                                .new-goods-options-content>.label {align-items: center;display: flex;flex-wrap: wrap;margin-bottom: 15px;padding-left: 25px;position: relative;}
                                .new-goods-options-content>.label.label-tow:before {background: #E31939;border-radius: 50%;color: #fff;content: "2";font-size: 12px;height: 16px;left: 0;line-height: 16px;margin: auto;position: absolute;text-align: center;width: 16px;z-index: 1;}
                                .goods-info_container .country-select>span:first-child {margin-right: 8px;}
                                .new-goods-options-content>.label .arrow {color: #E31939;font-size: 22px;line-height: 22px;margin: 0px 5px;}
                                .new-goods-options-content>.label.label-tow .label-title {margin-right: 10px;}
                                .goods-info_container .country-select .country-select-search {height: 30px;margin-right: 8px;width: 150px;}
                                .new-goods-options-content>.label .label-freight {align-items: center;display: flex;margin-left: auto;}
                                .new-goods-options-content>.label .label-freight>span {font-size: 12px;}
                                .new-goods-options-content>.label .label-freight .label-icon {display: flex;}
                                .purchase_process .goods-options-freight a {color: #0083ef;}
                                .new-goods-options-content>.label .label-freight .label-icon li span {color: #333;cursor: pointer;font-size: 20px;font-weight: 700;line-height: 24px;margin-left: 8px;transition: all .3s linear;user-select: none;}

                            </style>
                            <div class="purchase_process">
                                <dl class="goods-options-row goods-options-freight">
                                    <dd class="cn new-goods-options-content">
                                        <div class="label label-one">
                                            <span class="label-title">国内</span>
                                            <span class="font-icon arrow">&gt;</span>
                                            <span class="label-title">购购网仓库</span>
                                            <span class="label-description">
                                            <em>华南仓</em>
                                            <i></i>
                                        </span>
                                            <div class="label-freight" style="display: none;">
                                                <label for="goods-freight">
                                                    <span>国内运费</span>
                                                    <span class="label-input">
                                                    <em class="goods-freight-rmb">RMB￥</em>
                                                    <input id="goods-freight" class="goods-freight cn" maxlength="8" type="text" value="0">
                                                </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="label label-tow country-select">
                                            <span>购购网仓库</span>
                                            <span class="font-icon arrow">&gt;</span>
                                            <span class="label-title">你的地址</span>
                                            <div class="country-select-search ant-select ant-select-enabled">
                                                <div class="ant-select-selection ant-select-selection--single" tabindex="0">
                                                    <div class="disf">
                                                        <select name="address_id" id="address_id" style="border: 1px solid #000;padding: 0px 10px;width: 220px;">
                                                            <option value="">————请选择————</option>
                                                            @foreach($address as $k=>$v)
                                                                <option value="{{$v['id']}}">{{$v['user_name']}}，{{$v['mobile']}}，{{$v['true_addr']}}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="add_address" onclick="add_addr()" style="margin-left: 15px;border: 1px solid #000;padding: 0 10px;background: #e5e5e5;color: #000;">+ 新增地址</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="label-freight" style="display: none;">
                                                <span>国际运费</span>
                                                <ul class="label-icon">
                                                    <li>
                                                        <a target="_blank" href="/cn/page/query/freight/#areaId%3D79%26area%3DChina%20%E4%B8%AD%E5%9B%BD"><span class="font-icon"></span></a>
                                                    </li>
                                                    <li>
                                                        <a target="_blank" href="/cn/page/account/consult/before-sale?link=https%3A%2F%2Fitem.taobao.com%2Fitem.htm%3Fid%3D774159739572"><span class="font-icon"></span></a>
                                                    </li>
                                                    <li>
                                                        <a target="_blank" href="/cn/page/query/freight/#areaId%3D79%26area%3DChina%20%E4%B8%AD%E5%9B%BD%26goodsName%3D%E8%BF%9E%E8%A1%A3%E8%A3%99%26tabIndex%3D1%26page%3D1"><span class="font-icon"></span></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                        <!-- 在售的商品 _start -->
                        <div class="choose SZY-GOODS-SPEC-ITEMS">
                            <!-- 商品规格 -->
                            @if(!empty($arr['sku']))
                                @foreach($arr['sku'] as $k=>$v)
                                    <dl class="attr">
                                        <dt class="dt">{{$v['propName']}}</dt>
                                        <dd class="dd">
                                            <ul data-attr-id="{{ $v['propId'] }}">
                                                @foreach($v['children'] as $kk=>$vv)
                                                    <li class="goods-spec-item" data-spec-id="{{ $v['propId'] }}" data-attr-id="{{ $vv['valueId'] }}" data-is-default="0" data-points-goods="0">
                                                        <a href="javascript:void(0);" title="{{$vv['valueName']}}">
                                                            {{--                                                    <img src="" width="34" height="34" alt="">--}}
                                                            <span class="value-label">{{ $vv['valueName'] }}</span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </dd>
                                    </dl>
                            @endforeach
                        @endif
                        <!-- 购买数量 -->
                            <dl class="amount">
                                <dt class="dt">数量</dt>
                                <dd class="dd">
                                    <span class="amount-widget">
                                        <input type="text" class="amount-input" value="1"
                                               data-sales_model=""
                                               data-goods_id=""
                                               data-sku_id=""
                                               data-amount-min="1"
                                               data-amount-max="{{ $detail['data']['repositoryInfo']['quantity'] }}"
                                               maxlength="8" title="请输入购买量">
                                        <span class="amount-btn">
                                            <span class="amount-plus">
                                                <i>+</i>
                                            </span>
                                            <span class="amount-minus">
                                                <i>-</i>
                                            </span>
                                        </span>
                                        <span class="amount-unit">件</span>
                                    </span>

                                    <em class="stock SZY-GOODS-NUMBER">
                                        {{ $detail['data']['repositoryInfo']['quantityText'] }}
                                    </em>
                                </dd>
                            </dl>
                            <!-- 支付支持 -->
                            <style>

                                .support-pay-list dl {display: flex;margin: 12px 0;}
                                .support-pay-list .goods-options-label {    width: 49px;margin-right: 5px;padding-left: 15px;font-weight: 800;color: #000;font-size: 12px;}
                                .support-pay-list dl .pay-icon.paypal {flex: 0 0 100px;}
                                .support-pay-list dl .pay-icon.paypal {background-image: url(https://cdn.superbuy.com/starit-superbuy/dist/img/buy/payList/paypal.png);background-repeat: no-repeat;}
                                .support-pay-list dl .pay-icon.visa {flex: 0 0 50px;}
                                .support-pay-list dl .pay-icon.visa {background-image: url(https://cdn.superbuy.com/starit-superbuy/dist/img/buy/payList/visa.png);background-repeat: no-repeat;}
                                .support-pay-list dl .pay-icon.wechatPay {background-image: url(https://cdn.superbuy.com/starit-superbuy/dist/img/buy/payList/wechatPay.png);background-repeat: no-repeat;}
                                .support-pay-list dl .pay-icon {flex: 0 0 40px;}
                                .support-pay-list dl .pay-icon.aliPay {background-image: url(https://cdn.superbuy.com/starit-superbuy/dist/img/buy/payList/aliPay.png);background-repeat: no-repeat;}
                                .support-pay-list dl .pay-icon {flex: 0 0 40px;}
                            </style>
                            <div class="support-pay-list">
                                <dl>
                                    <dt class="goods-options-label goods-mark">支付支持</dt>
                                    <dd title="paypal" class="pay-icon paypal"></dd>
                                    <dd title="visa" class="pay-icon visa"></dd>
                                    <dd title="wechatPay" class="pay-icon wechatPay"></dd>
                                    <dd title="aliPay" class="pay-icon aliPay"></dd>
                                </dl>
                            </div>
                            <!-- 加入购物车按钮、手机购买 -->
                            <div class="action">
                                <div class="btn-buy">
                                    <a href="javascript:void(0);" class="buy-goods color ">
                                        <span class="buy-goods-bg bg-color"></span>
                                        <span class="buy-goods-border"></span>
                                        立即订购
                                    </a>
                                </div>
                            </div>

                        </div>
                        <!-- 在售的商品 _end -->

                    </form>

                    <!--选择收货地址start-->
                    <div class="address_div" style="display: none;padding:15px;box-sizing: border-box;">
                        <form class="layui-form" action="" method="post" lay-filter="address-element">
                            <div class="layui-card">
                                <div class="layui-card-body">
                                    <div class="sort_div">
                                        <div class="layui-form-item">
                                            <div class="layui-form-label">国家</div>
                                            <div class="layui-input-block">
                                                <div id="xmselect_country" class="xm-select-demo" style="width:100%;"></div>
                                            </div>
                                        </div>
                                        <div class="layui-form-item">
                                            <div class="layui-form-label">收货人名称</div>
                                            <div class="layui-input-block">
                                                <input type="text" class="layui-input" lay-verify="required" name="user_name" id="user_name" value="" placeholder="请输入收货人名称">
                                            </div>
                                        </div>
                                        <div class="layui-form-item">
                                            <label class="layui-form-label">联系电话</label>
                                            <div class="layui-input-block disf">
                                                <input type="text" name="area_mobile" id="area_mobile" lay-verify="required" placeholder="区号" autocomplete="off" class="layui-input" value="" style="width:50px;">
                                                <input type="text" name="mobile" lay-verify="required" placeholder="请输入联系电话" autocomplete="off" class="layui-input" value="">
                                            </div>
                                        </div>
                                        <div class="layui-form-item" style="display: none;">
                                            <div class="layui-form-label">邮编</div>
                                            <div class="layui-input-block">

                                            </div>
                                            <div class="layui-input-block postal_div hide2">
                                                <div class="disf">
                                                    <div>例子：</div>
                                                    <div class="postal_rule disf"></div>
                                                </div>
                                                <div class="disf">
                                                    <div>填写：</div>
                                                    <div class="postal_rule2 disf" style="width: 200px;"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="layui-form-item">
                                            <div class="layui-form-label">电子邮箱</div>
                                            <div class="layui-input-block">
                                                <input type="text" class="layui-input" lay-verify="" name="email" id="email" value="" placeholder="请输入电子邮箱">
                                            </div>
                                        </div>

                                        <input type="hidden" id="address_num" value="1">

                                        <div class="layui-form-item">
                                            <div class="layui-form-label">地址</div>
                                            <div class="layui-input-block disf">
                                                <input type="text" class="layui-input" lay-verify="required" name="address1" value="" placeholder="请输入地址">
                                                {{--                                            <div class="layui-btn layui-btn-success add" onclick="add_address()">+</div>--}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="addr">

                                    </div>
                                    <div style="text-align: center;">
                                        <button class="layui-btn" lay-submit="" lay-filter="address-element2">立即提交</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--选择收货地址end-->
                </div>
            </div>
            <div class="store-info_container buy-aside">
                <div class="buy-shopBox">
                    <div class="shopBox-header">
                        <p>SHOP</p>
                        <button data-key="shop-modal" class="go-shop" onclick="javascript:window.open('https://shop{{$detail['data']['shop']['shopId']}}.taobao.com/#/');">进入店铺</button>
                    </div>
                    <p class="shop-title" title="{{$detail['data']['shop']['shopName']}}">{{$detail['data']['shop']['shopName']}}</p>
                    <div class="shopBox-body">
                        <span><em class="">4.9</em>综合指标</span>
                        <ul class="shop-score">
                            <li>
                                <span>描述</span><span class="">4.9 <i class="none"></i></span>
                            </li>
                            <li>
                                <span>服务</span><span class="">4.9 <i class="none"></i></span>
                            </li>
                            <li>
                                <span>物流 </span><span class="">4.9 <i class="none"></i></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix">
            <!-- 左半部分内容 -->
            <div class="fl">
                <!-- 客服组 -->
                <div class="store-service storeName" style="border-top:1px solid #f2f2f2;margin-bottom:0;">
                    <div class="store-service-group left-content" style="margin-bottom:0;">
                        <div class="store-service-type first" style="padding-bottom:0;">
                            <h3 class="left-title" title="购购网">购购网</h3>
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

                .detail_bottom{padding:10px;box-sizing: border-box;}
                .detail_bottom img{width:80%;}

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
            <!--新的商品详情样式-->
            <div class="layui-tab layui-tab-card right right-con goodsDetail" id="goodsDetail" style="display: block;">
                <ul class="layui-tab-title">
                    <li class="layui-this">商品描述</li>
                </ul>
                <div class="layui-tab-content" style="min-height: 400px;">
                    <div class="layui-tab-item layui-show">
                        <div class="detail_bottom" style="text-align:center;/**height:633px;overflow-y:scroll;**/">
                            {!! $detail['data']['goodsDetailHtml'] !!}
                        </div>
                    </div>
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
                                    <input type="text" name="goodid" value="{{$detail['data']['goodsId']}}" style="display: none;">
                                    <input type="text" name="shopid" value="32" style="display: none;">
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

        <script id="SZY_SKU_LIST" type="text">
            {{--sku list1--}}
            {!! json_encode($detail['data']['skuList']) !!}
        </script>
        <script src="/assets/d2eace91/layui/xm-select3.js?v=20180418"></script>
        <script type="text/javascript">
            var sku_ids = [];
            var local_region_code = "";
            var sku_freights = [];
            var change_sku_images = false;

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

            function getSkuInfo(sku_id, callback) {

                $.get('/goods/sku', {
                    sku_id: sku_id,
                    is_lib_goods: ""
                }, function(result) {
                    if (result.code == 0) {
                        var sku = result.data;
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
                        changeLocation(local_region_code).always(function(result) {
                            if (result.code == 0 && result.data.limit_sale == 1) {
                                setSkuInfo(sku);
                            }
                        });
                        return;
                    }
                }

                // 商品名称
                $(".SZY-GOODS-NAME").html(sku.sku_name);
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

                if (show_activity) {

                    $(".SZY-ACTIVITY").show();
                } else {
                    $(".SZY-ACTIVITY").hide();
                }
            }

            $().ready(function() {

                // 获取SKU列表
                sku_ids = $.parseJSON($("#SZY_SKU_LIST").html());
                // 检查SKU组合
                $.cart.checkSkus($(".SZY-GOODS-SPEC-ITEMS > .attr"), sku_ids);
                // 绑定规格事件
                $.cart.checkSpecs($(".SZY-GOODS-SPEC-ITEMS > .attr"), sku_ids, $(".SZY-GOODS-SPEC-ITEMS > .attr").find("li"), function(sku) {
                    // 是否为默认规格
                    var is_default = $(this).data("is-default");

                    if (is_default) {
                        // 如果是默认规格则标识将切换SKU的图片相册
                        change_sku_images = true;
                    }

                    // SKU存在
                    getSkuInfo(sku.sku_id, function(sku) {
                        setSkuInfo(sku);
                    });
                }, function() {
                    //走这里的方法20240306
                    // 是否为默认规格
                    var is_default = $(this).data("is-default");

                    if (is_default) {
                        // 如果是默认规格则标识将切换SKU的图片相册
                        change_sku_images = true;
                    }

                    // SKU不存在
                    // $(".add-cart").addClass("disabled");
                    // $(".buy-goods").addClass("disabled");
                    // $(".SZY-GOODS-NUMBER").html("库存不足");
                    //
                    // $("title").html($(".SZY-GOODS-NAME-BASE").text());
                    let attr_len = $('.SZY-GOODS-SPEC-ITEMS').find('.attr').length;
                    let attr_ids = '';
                    for(let i=0;i<attr_len;i++){
                        let attr_id = $('.SZY-GOODS-SPEC-ITEMS').find('.attr').eq(i).find('.selected').attr('data-attr-id');
                        attr_ids += attr_id+',';
                    }
                    if(attr_ids.indexOf('undefined')==-1){
                        $.ajax({
                            url: "/taozg_getprice",
                            method: 'post',
                            data: {'id':"{{$id}}",'attr_ids':attr_ids,'_token':"{{csrf_token()}}"},
                            dataType: 'JSON',
                            success: function (res) {
                                $('.SZY-GOODS-PRICE').text('￥ '+res.price);
                            }
                        });
                    }

                    // getSkuInfo('', function(sku) {
                    //     setSkuInfo(sku);
                    // });

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

                //立即购买
                $(".buy-goods").click(function() {
                    var $ = layui.$
                        , layer = layui.layer;

                    if("{{session('user.user_id')}}" != ''){
                        if($('#address_id').val()==''){
                            layer.msg('请选择收货地址');return false;
                        }
                        var number = $(".amount-input").val();
                        let attr_len = $('.SZY-GOODS-SPEC-ITEMS').find('.attr').length;
                        let attr_ids = '';
                        for(let i=0;i<attr_len;i++){
                            let attr_id = $('.SZY-GOODS-SPEC-ITEMS').find('.attr').eq(i).find('.selected').attr('data-attr-id');
                            if(attr_id=='' || typeof(attr_id)=='undefined' || attr_id=='null'){
                                layer.msg('请选择规格型号');return false;
                            }
                            attr_ids += attr_id+',';
                        }
                        layer.load();
                        var data = {'number':number,'attr_ids':attr_ids,'id':"{{$id}}",'address_id':$('#address_id').val()};
                        $.ajax({
                            url: "/taozg_createorder",
                            method: 'post',
                            data: {'data':data,'_token':"{{csrf_token()}}"},
                            dataType: 'JSON',
                            success: function (res) {
                                layer.closeAll('loading');
                                layer.msg(res.msg,{time:2000}, function () {
                                    if (res.code == 0) {
                                        //已生产订单后，跳转到账单中心
                                        window.location.href="/bill_list";
                                    }
                                });
                            }
                        });
                    }else{
                        show_login();
                    }
                });
            });

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
                //商品信息滚动-end

                //获取国家地区
                let nowElement='';
                let vaguaSearch=0;
                $.getJSON("/gettableinfo",{'id':1,'_token':"{{csrf_token()}}"}, function(res) {
                    var xmselect2_country = xmSelect.render({
                        el: "#xmselect_country",
                        name:'country',
                        autoRow: true, //自动换行
                        filterable: true, //可搜索
                        searchTips: '请选择',
                        radio: true,
                        direction:'down',
                        model: {
                            icon: 'hidden',//是否展示复选框或者单选框图标 show, hidden:变换背景色  ！！这句话是重点，不然会变成父节点也有单选框！！
                        },
                        tree: {
                            show: true, //用树显示
                            showFolderIcon: true, //是否显示节点前的三角图标
                            expandedKeys: false, //默认全部展开
                            showLine: true, //显示渐近线
                            indent: 20, //间距
                            strict: false, //重点！！设置成非严格父子模式，这样父节点被禁用，子节点依然可以点击
                            clickCheck: true,
                            vaguaSearch:vaguaSearch,
                            nowElement:nowElement,
                        },
                        toolbar: {
                            show: false, //显示工具条
                            list: ['ALL', 'REVERSE', 'CLEAR']
                        },
                        height: '300px', //最大下拉框高度
                        data: $.parseJSON(res.list),
                        layVerify: '',
                        on:function(data){
                            if(data.isAdd == true){
                                $.getJSON('/getphonenum',{'id':data.arr[0].id},function(res2){
                                    $('#area_mobile').val(res2.phone);
                                    form.render(null,'address-element');
                                });
                            }
                            xmselect2_country.closed();
                        }
                    });
                });

                //地址提交
                form.on('submit(address-element2)',function(data){
                    $.ajax({
                        url: "/save_address",
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
                });
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
                    show_login();
                }
            }

            function show_login(){
                var $ = layui.$
                    , layer = layui.layer;
                layer.load();
                setTimeout(function(){
                    $.login.show();
                },1500);
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
                    show_login();
                }
            }
            //在线反馈-end

            function add_addr(){
                var $ = layui.$
                    , layer = layui.layer;
                if("{{session('user.user_id')}}" != ''){
                    let area = ['800px','500px'];
                    if(IsPhone()){
                        area = ['100%','100%'];
                    }

                    layer.open({
                        type: 1,
                        title:'添加地址',
                        area: area,
                        content: $('.address_div')
                    });
                }else{
                    show_login();
                }
            }

            function add_address(){
                var $ = layui.$
                    , layer = layui.layer
                    , form = layui.form;
                let address_num = $('#address_num').val();
                address_num = parseInt(address_num) + 1;
                $('#address_num').val(address_num);
                let html = '<div class="layui-form-item">\n' +
                    '                    <div class="layui-form-label">地址'+address_num+'</div>\n' +
                    '                    <div class="layui-input-block disf">\n' +
                    '                        <input type="text" class="layui-input" lay-verify="required" name="address2[]" value="" placeholder="请输入地址">\n' +
                    '                        <div class="layui-btn layui-btn-success add" onclick="add_address()">+</div>\n' +
                    '                        <div class="layui-btn layui-btn-danger del" onclick="del_address(this)">-</div>\n' +
                    '                    </div>\n' +
                    '                </div>';

                $('.addr').append(html);
                form.render(null, 'component-form-group');
            }

            function del_address(t){
                var $ = layui.$
                    , layer = layui.layer
                    , form = layui.form;
                let adr_idx = layer.confirm('确认要删除该地址吗？',function(index){
                    let address_num = $('#address_num').val();
                    address_num = parseInt(address_num) - 1;
                    $('#address_num').val(address_num);
                    $(t).parent().parent().remove();
                    form.render(null, 'component-form-group');
                    layer.close(adr_idx);
                });
            }
        </script>
        <!-- 商品详细信息 _end-->
    </div>

    <script type="text/javascript" src="/js/bubbleup.js"></script>
    <script type="text/javascript" src="/js/tabs.js"></script>
{{--    <script type="text/javascript" src="/js/tabs_totop.js"></script>--}}
    <script type="text/javascript" src="/js/goods.js"></script>
@stop

<!-- JS -->
<script src="/assets/d2eace91/js/jquery.cookie.js?v=1.1"></script>
<script src="/assets/d2eace91/js/layer/layer.js?v=1.1"></script>
<script src="/assets/d2eace91/js/jquery.method.js?v=1.1"></script>
<script src="/js/jquery.fly.min.js?v=1.1"></script>
<script src="/assets/d2eace91/js/szy.cart.js?v=1.1"></script>

{{--底部js--}}
@section('footer_js')@show

<!--[if lte IE 9]>
<script src="/js/requestAnimationFrame.js?v=1.1"></script>
<![endif]-->
<script type="text/javascript">
    // 缓载图片
    $().ready(function(){
        $.imgloading.loading();
        //图片预加载
        document.onreadystatechange = function() {
            if (document.readyState == "complete") {
                $.imgloading.setting({
                    threshold: 1000
                });
                $.imgloading.loading();
            }
        }
    });
</script>

<script>
    /* TODO 设置 Ajax LARAVEL 419 POST error */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>