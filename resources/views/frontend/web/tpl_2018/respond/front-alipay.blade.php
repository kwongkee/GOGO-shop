@extends('layouts.buy_layout')

@section('header_css')
    <link rel="stylesheet" href="/css/flow.css?v=20180702"/>
@stop

@section('content')


    <!-- 引入上方导航条文件 -->
    <div class="header">
        <div class="w990">
            <div class="logo-info">
                <a href="/" class="logo">
                    <img src="{{ get_image_url(sysconf('mall_logo')) }}" />
                </a>
            </div>
            <div class="cart-progress ">
                <ul>


                    @foreach($steps as $step)
                    <li class="finish @if($step['selected']){{ 'finish-0'.$step['step'] }}@endif">
                        <i>{{ $step['step'] }}</i>
                        <span>
						<a href="{{ $step['url'] ?? '' }}">{{ $step['name'] }}</a>
					</span>
                        <b></b>
                    </li>
                    @endforeach


                </ul>
            </div>
        </div>
    </div>

    <div class="content-bg">
        <div class="content-main w990"><div class="payment-success">
                <div class="payment-success-con">
                    <i></i>
                    <div class="payment-success-msg">
                        <h3 class="color">

                            感谢您，购买成功！

                        </h3>

                        <p>
                            共计支付
                            <a href="" class="color">￥{{ $order['money_paid'] ?? '' }}</a>
                        </p>

                    </div>
                </div>
                <div class="payment-success-order">
                    <p>购买商品已在处理中，我们将尽快为您发货！</p>
                    <p class="warn">
                        <span class="color">重要提醒：</span>
                        该商城不会以订单异常、系统升级等为由，要求您点击任何链接进行退款、重新付款、额外付款操作。请认准该网站唯一官方电话 {{ $mall_phone }} 。
                    </p>
                    <div class="success-order-list">
                        <ul>

                            <li class="first">
					<span class="transaction">
						购买单号：
						<font class="color">
							<a href="/user/order/info.html?id=3507" target="_blank" title="点击查看订单" class="color">{{ $order['order_sn'] ?? '' }}</a>
						</font>
					</span>


                                <span class="payable">
						应付金额：
						<font class="color">￥{{ $order['order_amount'] ?? '' }}</font>
					</span>


                                <span class="delivery">
						由
						<font>
							<a href="/shop/{{ $order['shop_id'] ?? '' }}.html" target="_blank" title="点击进入店铺" class="color">小木乃伊到我家</a>
						</font>
						发货
					</span>

                                <span class="pay-btn">
						<a href="/user/order/info.html?id=3507" class="color">查看详情</a>
					</span>
                            </li>

                        </ul>
                    </div>
                    <div class="go-shop">

                        <a href="/" class="go-shop-btn bg-color">继续购物</a>

                    </div>
                </div>
            </div>
            <!-- 订单返现信息弹框 -->
            <div class=""></div>

            <div class="order-cashback" >
                <div class="content-info">
                    <i class="iconfont close">&#xe6f8;</i>
                    <div style="padding-top: 38px;">
                        <p class="warning">
				<span>
					恭喜您获得
					<em>0</em>
					元返现
				</span>
                        </p>
                        <div class="prompt">

                            <p class="order-info">
                                <span>{{ $order['order_sn'] ?? '' }}</span>
                                <span>小木乃伊到我家，</span>
                                <span>
						返现：
						<em>0</em>
						元
					</span>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
            <script src="/assets/d2eace91/js/szy.cart.js?v=201902541"></script>
        </div>
    </div>

    <!-- 付款信息弹框 -->
    <div class="bomb-box payment-box">
        <div class="box-title">请付款</div>
        <div class="content-info">
            <p class="warning">
                <i></i>
                <span>请您在新打开的页面上完成付款。</span>
            </p>
            <p class="prompt">付款完成前请不要关闭此窗口</p>
            <p class="prompt">完成付款后请根据您的情况点击下面的按钮</p>
            <p class="btns">

                <a href="/checkout/result.html?key=" class="pay_result">已完成付款</a>
                <a href="/checkout/result.html?key=" class="m-l-10 pay_result">付款遇到问题</a>

            </p>
            <!-- <p class="back">
                <a href="/user/result/pay.html" title="返回选择其他的支付方式" class="color">&gt;&gt; 返回选择其他的支付方式</a>
            </p> -->
        </div>
    </div>

@stop


@section('outside_body_script')
    <script type="text/javascript" src="https://webapi.amap.com/maps?v=1.3&key={{ sysconf('amap_js_key') }}&&plugin=AMap.Scale,AMap.PolyEditor,AMap.Geocoder"></script>
    <script src="/js/checkout.js?v=20180919"></script>
    <script src="/js/common.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/szy.cart.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/jquery.region.js?v=20180919"></script>
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180919"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180919"></script>
    <!-- 鼠标滚轮 -->
    <script src="/assets/d2eace91/js/scrollBar/jquery.mousewheel.min.js?v=20180919"></script>
    <script type="text/javascript" src="https://webapi.amap.com/maps?v=1.3&key={{ sysconf('amap_js_key') }}&&plugin=AMap.Scale,AMap.PolyEditor,AMap.Geocoder,AMap.Autocomplete,AMap.PlaceSearch,AMap.InfoWindow,AMap.ToolBar"></script>
@stop