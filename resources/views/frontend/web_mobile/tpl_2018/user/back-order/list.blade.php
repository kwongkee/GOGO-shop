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
            <div class="header-middle">退款/售后</div>
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
    <ul class="bonus-nav back-nav">
        <li class="selected tab_type">
            <a href="javascript:void(0)">退款退货</a>
        </li>
        <li class="tab_type">
            <a href="/user/back.html?type=1">换货维修</a>
        </li>
        <li class="tab_type">
            <a href="/user/complaint.html">我的投诉</a>
        </li>
    </ul>
    <div class="order-box">

        <div class="order-center-content" id="table_list">

            <div class="tablelist-append">

                <div class="order-list">
                    <h2>
                        <a href="/shop/1" title="楠丹木业">
                            <i class="shop-icon"></i>
                            <span>楠丹木业</span>
                        </a>
                        <strong class="color">买家申请退款，等待卖家确认</strong>
                    </h2>
                    <ul class="order-list-goods">
                        <li>
                            <a href="/user/back/info?id=18">
                                <div class="goods-pic">
                                    <img src="http://68dsw.oss-cn-beijing.aliyuncs.com/demo/shop/1/gallery/2017/08/25/15036307529844.jpg?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" />
                                </div>
                                <dl class="goods-info">
                                    <!--此处商品名称需要控制显示字数-->
                                    <dt class="goods-name">陕西白鹿原大樱桃 车厘子大红灯 新鲜水果4斤航空包邮 甜的很</dt>
                                    <dd class="goods-attr">
                                        <span></span>
                                    </dd>
                                    <dd class="back-order-money">
                                        <span class="back-money">退款金额：￥327.00</span>
                                    </dd>
                                </dl>
                            </a>
                        </li>
                    </ul>
                    <div class="order-bottom-con">
                        <div class="order-bottom-btn">
                            <a href="/user/back/info?id=18">查看详情</a>
                        </div>
                    </div>
                </div>


                <div class="order-list">
                    <h2>
                        <a href="/shop/1" title="楠丹木业">
                            <i class="shop-icon"></i>
                            <span>楠丹木业</span>
                        </a>
                        <strong class="color">买家申请退款退货，等待卖家确认</strong>
                    </h2>
                    <ul class="order-list-goods">
                        <li>
                            <a href="/user/back/info?id=17">
                                <div class="goods-pic">
                                    <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/shop/1/gallery/2018/09/28/15381362582058.jpg?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" />
                                </div>
                                <dl class="goods-info">
                                    <!--此处商品名称需要控制显示字数-->
                                    <dt class="goods-name">创建红茶 均色 S</dt>
                                    <dd class="goods-attr">
                                        <span></span>
                                    </dd>
                                    <dd class="back-order-money">
                                        <span class="back-money">退款金额：￥6.00</span>
                                    </dd>
                                </dl>
                            </a>
                        </li>
                    </ul>
                    <div class="order-bottom-con">
                        <div class="order-bottom-btn">
                            <a href="/user/back/info?id=17">查看详情</a>
                        </div>
                    </div>
                </div>


                <div class="order-list">
                    <h2>
                        <a href="/shop/1" title="楠丹木业">
                            <i class="shop-icon"></i>
                            <span>楠丹木业</span>
                        </a>
                        <strong class="color">买家申请退款，等待卖家确认</strong>
                    </h2>
                    <ul class="order-list-goods">
                        <li>
                            <a href="/user/back/info?id=16">
                                <div class="goods-pic">
                                    <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/taobao-yun-images/43565178652/TB144JQHpXXXXbOXVXXXXXXXXXX_!!0-item_pic.jpg?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" />
                                </div>
                                <dl class="goods-info">
                                    <!--此处商品名称需要控制显示字数-->
                                    <dt class="goods-name">荷美尔Hormel 经典一口香热狗肠 250g 金色 8G</dt>
                                    <dd class="goods-attr">
                                        <span></span>
                                    </dd>
                                    <dd class="back-order-money">
                                        <span class="back-money">退款金额：￥2.00</span>
                                    </dd>
                                </dl>
                            </a>
                        </li>
                    </ul>
                    <div class="order-bottom-con">
                        <div class="order-bottom-btn">
                            <a href="/user/back/info?id=16">查看详情</a>
                        </div>
                    </div>
                </div>


                <div class="order-list">
                    <h2>
                        <a href="/shop/1" title="楠丹木业">
                            <i class="shop-icon"></i>
                            <span>楠丹木业</span>
                        </a>
                        <strong class="color">买家申请退款，等待卖家确认</strong>
                    </h2>
                    <ul class="order-list-goods">
                        <li>
                            <a href="/user/back/info?id=15">
                                <div class="goods-pic">
                                    <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/shop/1/gallery/2018/09/28/15381362582058.jpg?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" />
                                </div>
                                <dl class="goods-info">
                                    <!--此处商品名称需要控制显示字数-->
                                    <dt class="goods-name">创建红茶 均色 XS</dt>
                                    <dd class="goods-attr">
                                        <span></span>
                                    </dd>
                                    <dd class="back-order-money">
                                        <span class="back-money">退款金额：￥6.00</span>
                                    </dd>
                                </dl>
                            </a>
                        </li>
                    </ul>
                    <div class="order-bottom-con">
                        <div class="order-bottom-btn">
                            <a href="/user/back/info?id=15">查看详情</a>
                        </div>
                    </div>
                </div>


                <div class="order-list">
                    <h2>
                        <a href="/shop/1" title="楠丹木业">
                            <i class="shop-icon"></i>
                            <span>楠丹木业</span>
                        </a>
                        <strong class="color">退款关闭</strong>
                    </h2>
                    <ul class="order-list-goods">
                        <li>
                            <a href="/user/back/info?id=9">
                                <div class="goods-pic">
                                    <img src="http://images.68mall.com/system/config/default_image/default_goods_image_0.gif?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" />
                                </div>
                                <dl class="goods-info">
                                    <!--此处商品名称需要控制显示字数-->
                                    <dt class="goods-name">大海参1 S</dt>
                                    <dd class="goods-attr">
                                        <span></span>
                                    </dd>
                                    <dd class="back-order-money">
                                        <span class="back-money">退款金额：￥1.00</span>
                                    </dd>
                                </dl>
                            </a>
                        </li>
                    </ul>
                    <div class="order-bottom-con">
                        <div class="order-bottom-btn">
                            <a href="/user/back/info?id=9">查看详情</a>
                        </div>
                    </div>
                </div>


                <div class="order-list">
                    <h2>
                        <a href="/shop/1" title="楠丹木业">
                            <i class="shop-icon"></i>
                            <span>楠丹木业</span>
                        </a>
                        <strong class="color">退款成功</strong>
                    </h2>
                    <ul class="order-list-goods">
                        <li>
                            <a href="/user/back/info?id=7">
                                <div class="goods-pic">
                                    <img src="/assets/d2eace91/images/default/goods.gif" />
                                </div>
                                <dl class="goods-info">
                                    <!--此处商品名称需要控制显示字数-->
                                    <dt class="goods-name">大海参1</dt>
                                    <dd class="goods-attr">
                                        <span></span>
                                    </dd>
                                    <dd class="back-order-money">
                                        <span class="back-money">退款金额：￥0.01</span>
                                    </dd>
                                </dl>
                            </a>
                        </li>
                    </ul>
                    <div class="order-bottom-con">
                        <div class="order-bottom-btn">
                            <a href="/user/back/info?id=7">查看详情</a>
                        </div>
                    </div>
                </div>


                <div class="order-list">
                    <h2>
                        <a href="/shop/1" title="楠丹木业">
                            <i class="shop-icon"></i>
                            <span>楠丹木业</span>
                        </a>
                        <strong class="color">退款成功</strong>
                    </h2>
                    <ul class="order-list-goods">
                        <li>
                            <a href="/user/back/info?id=3">
                                <div class="goods-pic">
                                    <img src="http://68dsw.oss-cn-beijing.aliyuncs.com/demo/shop/1/gallery/2017/08/25/15036308618249.jpg?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" />
                                </div>
                                <dl class="goods-info">
                                    <!--此处商品名称需要控制显示字数-->
                                    <dt class="goods-name">高山红富士苹果新鲜脆甜多汁水果批发</dt>
                                    <dd class="goods-attr">
                                        <span></span>
                                    </dd>
                                    <dd class="back-order-money">
                                        <span class="back-money">退款金额：￥1.00</span>
                                    </dd>
                                </dl>
                            </a>
                        </li>
                    </ul>
                    <div class="order-bottom-con">
                        <div class="order-bottom-btn">
                            <a href="/user/back/info?id=3">查看详情</a>
                        </div>
                    </div>
                </div>


                <div class="order-list">
                    <h2>
                        <a href="/shop/1" title="楠丹木业">
                            <i class="shop-icon"></i>
                            <span>楠丹木业</span>
                        </a>
                        <strong class="color">退款成功</strong>
                    </h2>
                    <ul class="order-list-goods">
                        <li>
                            <a href="/user/back/info?id=2">
                                <div class="goods-pic">
                                    <img src="http://68dsw.oss-cn-beijing.aliyuncs.com/demo/shop/1/gallery/2017/08/25/15036308618249.jpg?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" />
                                </div>
                                <dl class="goods-info">
                                    <!--此处商品名称需要控制显示字数-->
                                    <dt class="goods-name">高山红富士苹果新鲜脆甜多汁水果批发</dt>
                                    <dd class="goods-attr">
                                        <span></span>
                                    </dd>
                                    <dd class="back-order-money">
                                        <span class="back-money">退款金额：￥1.00</span>
                                    </dd>
                                </dl>
                            </a>
                        </li>
                    </ul>
                    <div class="order-bottom-con">
                        <div class="order-bottom-btn">
                            <a href="/user/back/info?id=2">查看详情</a>
                        </div>
                    </div>
                </div>


                <div class="order-list">
                    <h2>
                        <a href="/shop/1" title="楠丹木业">
                            <i class="shop-icon"></i>
                            <span>楠丹木业</span>
                        </a>
                        <strong class="color">退款关闭</strong>
                    </h2>
                    <ul class="order-list-goods">
                        <li>
                            <a href="/user/back/info?id=1">
                                <div class="goods-pic">
                                    <img src="http://68dsw.oss-cn-beijing.aliyuncs.com/demo/shop/1/gallery/2017/08/25/15036308618249.jpg?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" />
                                </div>
                                <dl class="goods-info">
                                    <!--此处商品名称需要控制显示字数-->
                                    <dt class="goods-name">高山红富士苹果新鲜脆甜多汁水果批发</dt>
                                    <dd class="goods-attr">
                                        <span></span>
                                    </dd>
                                    <dd class="back-order-money">
                                        <span class="back-money">退款金额：￥1.00</span>
                                    </dd>
                                </dl>
                            </a>
                        </li>
                    </ul>
                    <div class="order-bottom-con">
                        <div class="order-bottom-btn">
                            <a href="/user/back/info?id=1">查看详情</a>
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
	{"page_key":"page","page_id":"pagination","default_page_size":10,"cur_page":1,"page_size":10,"page_size_list":[10,50,500,1000],"record_count":9,"page_count":1,"offset":0,"url":null,"sql":null}
	</script>
            </div>

        </div>

    </div>
    <!--底部菜单 start-->
    <!--底部菜单 start-->
    <script src="http://m.b2b2c.yunmall.68mall.com/js/custom_js.js?v=20180027"></script> <link rel="stylesheet" href="http://m.b2b2c.yunmall.68mall.com/css/custom_css.css?v=20181020"/>
    <div style="height: 48px; line-height: 48px; clear: both;"></div>
    <div class="footer-nav">









        <ul>


            <li class="">






                <!---->
                <a href="/index.html">
                    <i class=""  style="background-image: url(http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/backend/gallery/2018/11/08/15416664528574.jpg);background-size: contain;background-repeat: no-repeat;">

                    </i>
                    <span>首页</span>
                </a>
                <!---->
            </li>



            <li class="">






                <!---->
                <a href="/category.html">
                    <i class=""  style="background-image: url(http://m.b2b2c.yunmall.68mall.com/images/tab_category_normal.png);background-size: contain;background-repeat: no-repeat;">

                    </i>
                    <span>分类列表</span>
                </a>
                <!---->
            </li>



            <li class="">






                <!---->
                <a href="/cart.html">
                    <i class="cartbox"  style="background-image: url(http://m.b2b2c.yunmall.68mall.com/images/tab_bought_list_normal.png);background-size: contain;background-repeat: no-repeat;">

                        <em class="cart-num SZY-CART-COUNT">0</em>

                    </i>
                    <span>购物车</span>
                </a>
                <!---->
            </li>



            <li class="">






                <!---->
                <a href="/user.html">
                    <i class=""  style="background-image: url(http://m.b2b2c.yunmall.68mall.com/images/tab_cart_normal.png);background-size: contain;background-repeat: no-repeat;">

                    </i>
                    <span>我的</span>
                </a>
                <!---->
            </li>


        </ul>

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
            // 加载时加入即时查询搜索条件
            tablelist = $("#table_list").tablelist({
                params: $("#searchForm").serializeJson()
            });
            // 搜索
            $("#searchForm").submit(function() {
                // 序列化表单为JSON对象
                var data = $(this).serializeJson();
                // Ajax加载数据
                tablelist.load(data);
                // 阻止表单提交
                return false;
            });
        });
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