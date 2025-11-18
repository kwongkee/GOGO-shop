@extends('layouts.user_layout')

{{--header_css--}}
@section('header_css')
    <link rel="stylesheet" href="/css/user.css?v=20181020"/>
@stop

{{--header_js--}}
@section('header_js')

@stop

@section('content')

    <header class="header-top-nav">
        <div class="header">
            <div class="header-left">
                <a class="sb-back" href="javascript:history.back(-1);" title="返回">
                    <i class="iconfont"></i>
                </a>
            </div>
            <div class="header-middle">退货换货</div>
            <div class="header-right">

                <aside class="show-menu-btn">
                    <div class="show-menu" id="show_more">
                        <a href="javascript:void(0);">
                            <i class="iconfont"></i>
                        </a>
                    </div>
                </aside>

            </div>
        </div>
    </header>
    <div class="back-info-content">
        <!-- 提交仅退款申请后的页面 _start -->
        <div class="content-status">
            <dl class="user-status-imfor ub">
                <dt class="imfor-icon">
                    <img src="/images/warning.png">
                </dt>
                <dd class="imfor-title ub-f1">
                    <h3>等待卖家处理退款申请</h3>
                </dd>
            </dl>
            <ul class="user-status-prompt">
                <li>
                    <span>如果卖家同意：</span>
                    申请将达成并退款
                </li>
                <li>
                    <span>如果卖家拒绝：</span>
                    可与卖家协商修改退款申请，若协商不成可申请平台方介入
                </li>
                <li>
                    <span>如果卖家未处理：</span>
                    超过
                    <strong class="color" id="counter_confirm"></strong>
                    退款申请将自动达成
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $("#counter_confirm").countdown({
                                time: "595206000",
                                leadingZero: true,
                                onComplete: function(event) {
                                    $(this).html("已超时！");

                                    // 超时事件，预留
                                    $.ajax({
                                        type: 'GET',
                                        url: '/user/back/confirm-sys',
                                        data: {
                                            back_id: '18'
                                        },
                                        dataType: 'json',
                                        success: function(data) {
                                            if (data.code == 0) {
                                                window.location.reload();
                                            }
                                        }
                                    });
                                }
                            });
                        });
                    </script>

                </li>
            </ul>
            <div class="user-status-operate ub">
                <a href="javascript:_edit(18,1)" class="return-apply ub-f1">修改退款申请</a>
                <a href="javascript:_cancel(18,1)" class="return-apply ub-f1">撤销退款申请</a>
            </div>
        </div>
        <!-- 提交仅退款申请后的页面 _end -->


        <!-- 买家撤销退款之后 _start -->
        <!-- 买家撤销退款之后 _end -->



        <!-- 退款失效之后 _start -->
        <!-- 退款失效之后 _end -->



        <!-- 卖家拒绝退款申请 _start -->
        <!-- 卖家拒绝退款申请 _end -->


        <!-- 卖家已同意退款退货申请，等待买家寄回货物 _start -->
        <!-- 卖家已同意退款退货申请，等待买家寄回货物 _end -->


        <!-- 买家寄回货物已发出 _start -->
        <!-- 买家寄回货物已发出 _end -->


        <!-- 卖家已同意退款申请，等待平台方退款 _start -->
        <!-- 卖家已同意退款申请，等待平台方退款 _end -->


        <!-- 退款成功 _start -->
        <!-- 退款成功 _end -->

        <a class="consult-record-title" href="javascript:void(0)">
            <h3>协商记录</h3>
        </a>
        <div class="consult-record-message" style="display: none;">
            <ul>

                <li class="bdr-bottom">
                    <div class="message-hd">
                        <div class="head">
                            <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/user/5/headimg/15332680617303.png">
                        </div>
                        <div class="user-info">
                            <span class="name">666 - 买家</span>
                            <span class="time">2018-11-10 11:35:10</span>
                        </div>
                        <div class="msg">买家发起了仅退款申请，退款原因：商品错发/漏发
                            ，退款金额：327.00元，退款方式：退回账户余额，退款说明：aaaa。</div>
                    </div>

                    <div class="message-bd">

                    </div>

                </li>

            </ul>
        </div>

        <div class="blank-div"></div>
        <div class="content-imfor">
            <div class="imfor-title">
                <h3>退款申请</h3>
            </div>
            </ul>
            <ul class="back-info-ul">
                <li>
                    <div class="imfor-dt">店铺名称：</div>
                    <div class="imfor-dd">楠丹木业</div>
                </li>
                <li>
                    <div class="imfor-dt">退款类型：</div>
                    <div class="imfor-dd">仅退款</div>
                </li>
                <li>
                    <div class="imfor-dt">退款金额：</div>
                    <div class="imfor-dd">￥327.00</div>
                </li>
                <li>
                    <div class="imfor-dt">退款原因：</div>
                    <div class="imfor-dd">商品错发/漏发
                    </div>
                </li>
                <li class="hide">
                    <div class="imfor-dt">退款方式：</div>
                    <div class="imfor-dd">退回账户余额</div>
                </li>
                <li class="hide">
                    <div class="imfor-dt">退款编号：</div>
                    <div class="imfor-dd">2018111048822</div>
                </li>
                <li class="hide">
                    <div class="imfor-dt">申请时间：</div>
                    <div class="imfor-dd">2018-11-10 11:35:09</div>
                </li>
                <li class="hide">
                    <div class="imfor-dt">退款说明：</div>
                    <div class="imfor-dd">
                        aaaa 				</div>
                </li>
                <li>
                    <a href="javascript:;" class="get-more-info">
                        <span>更多</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <script>
        $('.consult-record-title').click(function(){
            $('.consult-record-message').slideToggle();
        })
        $('.get-more-info').click(function() {
            $('.back-info-ul li').each(function() {
                if ($(this).hasClass('hide')) {
                    $(this).removeClass('hide');
                }
                $('.get-more-info').parent('li').addClass('hide');
            });
        });
    </script>
    <script type="text/javascript">
        function _edit(back_id, send_id) {

            $.loading.start();
            $.get('/user/back/edit', {
                id: back_id,
                send_id: send_id
            }, function(result) {
                $.msg(result.message);
                if (result.code == 0) {
                    if (send_id == 2) {
                        window.location.href = "/user/back/edit-order?id=" + back_id + "&type=shipping";
                    } else {
                        window.location.href = "/user/back/edit?id=" + back_id;
                    }
                } else {
                    window.location.reload();
                }
            }, 'json');
        }

        function _cancel(back_id, send_id) {
            $.loading.start();
            $.post('/user/back/cancel', {
                id: back_id,
                send_id: send_id
            }, function(result) {
                $.msg(result.message);
                if (result.code == 0) {
                    window.location.href = "/user/back/info?id=" + back_id;
                } else {
                    window.location.reload();
                }
            }, 'json');
        }
    </script>
    <script type="text/javascript">
        $().ready(function() {


        })
    </script>
    <script src="/js/jquery.fly.min.js?v=20180027"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js?v=20180027"></script>

    <div class="show-menu-info" id="menu">
        <ul>
            <li><a href="/"><span class="index-menu"></span><i>商城首页</i></a></li>
            <li><a href="/category.html"><span class="category-menu"></span><i>分类</i></a></li>
            <li><a href="/cart.html"><span class="cart-menu"></span><i>购物车</i></a></li>
            <li style=" border:0;"><a href="/user.html"><span class="user-menu"></span><i>我的</i></a></li>
        </ul>
    </div>
    <!-- 第三方流量统计 -->
    <div style="display: none;"></div>
    <!-- 底部 _end-->

@stop