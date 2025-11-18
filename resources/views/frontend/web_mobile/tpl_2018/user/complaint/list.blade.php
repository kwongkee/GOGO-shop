@extends('layouts.user_layout')

{{--header_css--}}
@section('header_css')
    <link rel="stylesheet" href="/css/user.css?v=20181020"/>
@stop

{{--header_js--}}
@section('header_js')

@stop

@section('content')


    <header>
        <div class="tab_nav">
            <div class="header">
                <div class="header-left">
                    <a class="sb-back" href="javascript:history.back(-1)" title="返回">
                        <i class="iconfont"></i>
                    </a>
                </div>
                <div class="header-middle">退款/售后</div>

                <div class="header-right">
                    <i class="search-btn iconfont"></i>
                </div>
            </div>
        </div>
    </header>
    <ul class="bonus-nav back-nav">
        <li class="tab_type">
            <a href="/user/back.html">退款退货</a>
        </li>
        <li class="tab_type">
            <a href="/user/back.html?type=1">换货维修</a>
        </li>
        <li class="selected tab_type">
            <a href="javascript:void(0)">我的投诉</a>
        </li>
    </ul>
    <div id="search-orderList">
        <div class="user-search-header ub">
            <div class="search-left">
                <a href="javascript:void(0)" class="sb-back" title="返回"></a>
            </div>
            <div class="order-search ub-f1">
                <form id="searchForm" name="searchForm" action="/user/complaint.html" method="GET">
                    <input id="order_id" type="search" name="order_id" placeholder="输入订单编号">
                    <span class="num-clear hide">
				<i class="iconfont"></i>
			</span>
                </form>		</div>
            <div class="search-right">
                <a href="javascript:void(0)" class="clear_input submit" id="searchFormSubmit" style="display: block;" type="submit">搜索</a>
            </div>


            <a href="javascript:void(0);" class="back-to-top gotop hide"><img src="/images/topup.png"></a>
            <script type="text/javascript">
                $().ready(function(){
                    //首先将#back-to-top隐藏
                    //$("#back-to-top").addClass('hide');
                    //当滚动条的位置处于距顶部1000像素以下时，跳转链接出现，否则消失
                    $(function ()
                    {
                        $(window).scroll(function()
                        {
                            if ($(window).scrollTop()>600)
                            {
                                $('body').find(".back-to-top").removeClass('hide');
                            }
                            else
                            {
                                $('body').find(".back-to-top").addClass('hide');
                            }
                        });
                        //当点击跳转链接后，回到页面顶部位置
                        $(".back-to-top").click(function()
                        {
                            $('body,html').animate(
                                {
                                    scrollTop:0
                                }
                                ,600);
                            return false;
                        });
                    });
                });
            </script>	</div>
    </div>
    <div class="order-box">

        <div class="order-center-content" id="table_list">

            <div class="tablelist-append">

                <div class="order-list">
                    <h2>
                        <a href="/shop/38.html">
                            <i class="shop-icon"></i>
                            <span>小不点</span>
                        </a>
                        <strong class="color">投诉已撤销</strong>
                    </h2>
                    <div class="complaint-other">
                        <p>
                            投诉编号：
                            <span>2018111006351656642</span>
                        </p>
                        <p>
                            订单编号：
                            <a href="/user/order/info?id=268.html">20181029091710347650</a>
                        </p>
                        <p>
                            投诉卖家：
                            <span>SZY189PKLP9004</span>
                        </p>
                        <p>
                            投诉原因：
                            <span>承诺的没做到
</span>
                        </p>
                        <p>
                            申请时间：
                            <span>2018-11-10 14:35:16</span>
                        </p>
                    </div>
                    <div class="order-bottom-con">
                        <div class="order-bottom-btn">
                            <a href="/user/complaint/view?complaint_id=12.html" class="color">查看详情</a>
                        </div>
                    </div>
                </div>

                <div class="order-list">
                    <h2>
                        <a href="/shop/1.html">
                            <i class="shop-icon"></i>
                            <span>楠丹木业</span>
                        </a>
                        <strong class="color">申请平台方介入</strong>
                    </h2>
                    <div class="complaint-other">
                        <p>
                            投诉编号：
                            <span>2018111002580558635</span>
                        </p>
                        <p>
                            订单编号：
                            <a href="/user/order/info?id=262.html">20181015081346333410</a>
                        </p>
                        <p>
                            投诉卖家：
                            <span>测试店铺</span>
                        </p>
                        <p>
                            投诉原因：
                            <span>未按成交价格进行交易
</span>
                        </p>
                        <p>
                            申请时间：
                            <span>2018-11-10 10:58:05</span>
                        </p>
                    </div>
                    <div class="order-bottom-con">
                        <div class="order-bottom-btn">
                            <a href="/user/complaint/view?complaint_id=10.html" class="color">查看详情</a>
                        </div>
                    </div>
                </div>

                <div class="order-list">
                    <h2>
                        <a href="/shop/1.html">
                            <i class="shop-icon"></i>
                            <span>楠丹木业</span>
                        </a>
                        <strong class="color">申请平台方介入</strong>
                    </h2>
                    <div class="complaint-other">
                        <p>
                            投诉编号：
                            <span>2018072509280369634</span>
                        </p>
                        <p>
                            订单编号：
                            <a href="/user/order/info?id=146.html">20180717090728262310</a>
                        </p>
                        <p>
                            投诉卖家：
                            <span>测试店铺</span>
                        </p>
                        <p>
                            投诉原因：
                            <span>承诺的没做到
</span>
                        </p>
                        <p>
                            申请时间：
                            <span>2018-07-25 17:28:03</span>
                        </p>
                    </div>
                    <div class="order-bottom-con">
                        <div class="order-bottom-btn">
                            <a href="/user/complaint/view?complaint_id=9.html" class="color">查看详情</a>
                        </div>
                    </div>
                </div>

                <div class="order-list">
                    <h2>
                        <a href="/shop/1.html">
                            <i class="shop-icon"></i>
                            <span>楠丹木业</span>
                        </a>
                        <strong class="color">申请平台方介入</strong>
                    </h2>
                    <div class="complaint-other">
                        <p>
                            投诉编号：
                            <span>2018041808173598787</span>
                        </p>
                        <p>
                            订单编号：
                            <a href="/user/order/info?id=40.html">20180418064209286610</a>
                        </p>
                        <p>
                            投诉卖家：
                            <span>测试店铺</span>
                        </p>
                        <p>
                            投诉原因：
                            <span>承诺的没做到
</span>
                        </p>
                        <p>
                            申请时间：
                            <span>2018-04-18 16:17:35</span>
                        </p>
                    </div>
                    <div class="order-bottom-con">
                        <div class="order-bottom-btn">
                            <a href="/user/complaint/view?complaint_id=1.html" class="color">查看详情</a>
                        </div>
                    </div>
                </div>

            </div>
            <!-- 分页 -->
            <!-- 分页 -->
            <div id="pagination" class="page">
                <div class="more-loader-spinner">

                    <div class="is-loaded">
                        <div class="loaded-bg">我是有底线的</div>
                    </div>

                </div>
                <script data-page-json="true" type="text" id="page_json">
	{"page_key":"page","page_id":"pagination","default_page_size":10,"cur_page":1,"page_size":10,"page_size_list":[10,50,500,1000],"record_count":4,"page_count":1,"offset":0,"url":null,"sql":null}
	</script>
            </div>

        </div>
    </div>


    <script type="text/javascript">
        // 滚动加载数据
        $(window).on('scroll', function() {
            if ($(document).scrollTop() + $(window).height() > $(document).height() - 10) {
                $.pagemore();
            }
        });
    </script>
    <script type="text/javascript">
        var tablelist = null;
        $().ready(function() {
            var tablelist = $("#table_list").tablelist({
                params: $("#searchForm").serializeJson()
            });

        });

        $("#searchFormSubmit").click(function() {
            $("#searchForm").submit();
        });

        $('.search-btn').click(function() {
            $('#search-orderList').addClass("show");
            $('#order-box').hide();
            $("input[name='keyword']").focus();
        });
        $('.sb-back').click(function() {
            $('#search-orderList').removeClass('show');
            $('#order-box').show();
            $("input[name='keyword']").blur();
        });
        $('.colse-search-btn').click(function() {
            $('#search-orderList').removeClass('show');
            $('#order-box').show();
            $("input[name='keyword']").blur();
        });
    </script>
    <script type="text/javascript">
        $().ready(function() {

            $.msg('撤销投诉成功');

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