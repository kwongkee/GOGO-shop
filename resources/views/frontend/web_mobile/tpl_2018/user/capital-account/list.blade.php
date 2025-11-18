@extends('layouts.user_layout')

{{--header_css--}}
@section('header_css')
    <link rel="stylesheet" href="/css/user.css?v=20181020"/>

@stop

{{--header_js--}}
@section('header_js')

@stop

@section('content')

    <div id="user-account">
        <header class="header-top-nav">
            <div class="header">
                <div class="header-left">
                    <a class="sb-back" href="javascript:history.back(-1);" title="返回">
                        <i class="iconfont">&#xe606;</i>
                    </a>
                </div>
                <div class="header-middle">资金账户</div>
                <div class="header-right">

                    <aside class="show-menu-btn">
                        <div class="show-menu" id="show_more">
                            <a href="javascript:void(0);">
                                <i class="iconfont">&#xe6d0;</i>
                            </a>
                        </div>
                    </aside>

                </div>
            </div>
        </header>
        <div class="capital-top">

            <h5 class="new-money-info-title">线上账户资金</h5>
            <ul class="capital-money-info new-money-info">
                <li>
                    <span>可提现资金(元)</span>
                    <em>397.06</em>
                </li>
                <li>
                    <span>不可提现资金(元)</span>
                    <em>0.00</em>
                </li>
                <li>
                    <span>冻结资金(元)</span>
                    <em>1000.00</em>
                </li>
            </ul>
            <h5 class="new-money-info-title">线下账户资金</h5>
            <div class="offline-funds">
                <span>账户资金(元)</span>
                <em id="balance">0.00</em>
                <a href="javascript:void(0)" class="see-btn">商家明细></a>
            </div>

            <div class="waves">
                <div class="wave wave1">
                    <img src="/images/user/wave1.png">
                </div>
                <div class="wave wave2">
                    <img src="/images/user/wave2.png">
                </div>
            </div>
        </div>
        <div class="capital-top-nav bdr-bottom">
            <ul class="capital-nav-li">

                <li>
                    <a href="/user/recharge/online-recharge.html" class="nav-li-bdr"> 资金充值 </a>
                </li>


                <li>
                    <a href="/user/deposit/add.html"> 资金提现 </a>
                </li>

            </ul>
        </div>
        <div class="capital-middle">
            <a href="javascript:void(0)" class="capital-nav-li capital_detail bdr-bottom"> 账户明细 </a>

            <a href="/user/deposit.html" class="capital-nav-li bdr-bottom"> 提现记录 </a>

            <a href="/user/recharge.html" class="capital-nav-li bdr-bottom"> 充值记录 </a>

            <a href="/user/deposit-account.html" class="capital-nav-li bdr-bottom"> 我的提现账户 </a>

        </div>
    </div>
    <div id="capital-account">
        <div class="account-content">
            <div class="capital-info">
                <div class="fixed-header">
                    <header class="header-top-nav">
                        <div class="header">
                            <div class="header-left">
                                <a class="sb-back" href="javascript:history.back(-1);" title="返回">
                                    <i class="iconfont">&#xe606;</i>
                                </a>
                            </div>
                            <div class="header-middle">账户明细</div>
                            <div class="header-right">

                                <aside class="show-menu-btn">
                                    <div class="show-menu" id="show_more">
                                        <a href="javascript:void(0);">
                                            <i class="iconfont">&#xe6d0;</i>
                                        </a>
                                    </div>
                                </aside>

                            </div>
                        </div>
                    </header>
                    <ul class="capital-detail-nav">
                        <li class="selected">
                            <a id='trans-detail' class="tabs-">全部</a>
                        </li>
                        <li>
                            <a id='income' class="tabs-">收入</a>
                        </li>
                        <li>
                            <a id='expend' class="tabs-">支出</a>
                        </li>
                    </ul>
                </div>

                {{--引入列表--}}
                @include('user.capital-account.partials._list')

            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('.capital_detail').click(function() {
            $('#capital-account').show();
            var timer = setTimeout(function() {
                $('#capital-account').addClass("show");
            }, 300);
            $('body').height("100%").css("overflow", "hidden");
        });
        $('.back-user-account').click(function() {

            $('#capital-account').removeClass("show");
            var timer = setTimeout(function() {
                $('#capital-account').hide();
            }, 300);
            $('body').height("auto").css("overflow", "visible");
        });
    </script>
    <script type="text/javascript">
        var tablelist = null;
        $().ready(function() {
            tablelist = $("#table_list").tablelist();
        });

        $("a[class^='tabs-']").click(function() {
            $("a[class^='tabs-']").parent('li').removeClass('selected');
            $(this).parent("li").addClass('selected');
            var trade_type = $(this).attr("id");
            tablelist.load({
                trade_type: trade_type,
                page: {
                    cur_page: 1
                },
                go: 1
            });
        });
    </script>
    <!-- more.js -->
    <script src="/assets/d2eace91/js/szy.page.more.js?v=20190221"></script>

    <script type="text/javascript">
        // 滚动加载数据
        $(".account-content").on('scroll', function() {
            if ($('.account-content')[0].scrollTop + $('.account-content').height() + 50 > $('.account-content')[0].scrollHeight) {
                if ($.isFunction($.pagemore)) {
                    $.pagemore();
                }
            }
        });
    </script>
    <script type="text/javascript">
        $().ready(function() {

            $("body").on("click", ".see-btn", function() {
                $.loading.start();
                $.open({
                    title: "查看各商家账户资金",
                    ajax: {
                        url: "/user/capital-account/view",
                        data: {}
                    },
                    width: "300px",
                    btn: ['关闭'],
                    end: function(index, object) {
                    }
                });
            });

            $.ajax({
                url: '/user/capital-account/get-data',
                dataType: 'json',
                success: function(data) {
                    $("#balance").html(data.balance);
                }
            });
        });
    </script>

    <script src="/js/jquery.fly.min.js?v=20190221"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js?v=20190221"></script>

    <div class="show-menu-info" id="menu">
        <ul>
            <li><a href="http://m.test.68mall.com"><span class="index-menu"></span><i>商城首页</i></a></li>
            <li><a href="http://m.test.68mall.com/category.html"><span class="category-menu"></span><i>分类</i></a></li>
            <li><a href="http://m.test.68mall.com/cart.html"><span class="cart-menu"></span><i>购物车</i></a></li>
            <li style=" border:0;"><a href="http://m.test.68mall.com/user.html"><span class="user-menu"></span><i>我的</i></a></li>
        </ul>
    </div>	<!-- 第三方流量统计 -->
    <div style="display: none;"></div>
    <!-- 底部 _end-->

@stop