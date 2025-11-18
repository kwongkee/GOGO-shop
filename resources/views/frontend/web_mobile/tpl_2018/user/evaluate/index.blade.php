@extends('layouts.user_layout')

{{--header_css--}}
@section('header_css')
    <link rel="stylesheet" href="/css/user.css?v=20181020"/>
@stop

{{--header_js--}}
@section('header_js')

@stop

@section('content')

    <!-- -->
    <script src="/js/klass.min.js?v=20180027"></script>
    <link rel="stylesheet" href="/css/photoswipe.css?v=20181020"/>
    <header class="header-top-nav">
        <div class="header">
            <div class="header-left">
                <a class="sb-back" href="javascript:history.back(-1);" title="返回">
                    <i class="iconfont"></i>
                </a>
            </div>
            <div class="header-middle">我的评价</div>
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
    <!--评价头部-->
    <form id="searchForm" class="screen-term" method="GET">
        <input type="hidden" name="comment_content" value="0">
        <input type="hidden" name="comment_level" value="0">
    </form>
    <div class="user-comment-type">
        <ul class="tabmenu-new">
            <li class="selected">
                <!-- <em>100</em> -->
                <a href="javascript:void(0)" class="comment-level" data-value="0">全部</a>
            </li>
            <li>
                <a href="javascript:void(0)" class="comment-level" data-value="1">好评</a>
            </li>
            <li>
                <a href="javascript:void(0)" class="comment-level" data-value="2">中评</a>
            </li>
            <li>
                <a href="javascript:void(0)" class="comment-level" data-value="3">差评</a>
            </li>
            <!--
             <li>
                <a href="">晒图</a>
            </li>
             -->
        </ul>
    </div>
    <!---->
    <!--有评价信息时-->
    <div class="user-comment-content" id="table_list">
        <!---->
        <!--我的评价列表-->
        <div class="tablelist-append">
            <!---->
            <div class="user-comment-list">
                <div class="user-comment-title">
				<span class="rank-name">
					好评
				</span>
                    <div class="rank-stars">
                        <!-- 从一星到五星'star-icon1'到'star-icon5'-->
                        <span class="star-icon star-icon4"></span>
                    </div>
                    <div class="comment-time">购买时间：2018-11-07 10:45:31</div>
                </div>
                <div class="user-comment-item">
                    <div class="user-comment-pic">
                        <a href="/goods-108.html">
                            <img src="http://images.68mall.com/system/config/default_image/default_goods_image_0.gif?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" />
                        </a>
                    </div>
                    <dl class="user-comment-info">
                        <dt class="comment-goods-name">硝苯地平</dt>
                        <!---->
                        <dd class="comment-content">aaaaaaaa</dd>
                        <!--晒图-->
                        <dd class="comment-pic-list">
                            <ul id="gallery">


                                <li>
                                    <a href="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/user/5/images/2018/11/10/15418301604770.jpeg" class="img-gallery">
                                        <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/user/5/images/2018/11/10/15418301604770.jpeg?x-oss-process=image/resize,m_pad,limit_0,h_180,w_180">
                                    </a>
                                </li>

                                <!-- -->

                                <li>
                                    <a href="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/user/5/images/2018/11/10/15418301659116.jpeg" class="img-gallery">
                                        <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/user/5/images/2018/11/10/15418301659116.jpeg?x-oss-process=image/resize,m_pad,limit_0,h_180,w_180">
                                    </a>
                                </li>

                                <!---->
                            </ul>
                        </dd>
                        <dd class="goods-comment-time">2018-11-10 14:09:39</dd>
                        <!---->
                        <!-- -->

                        <!-- -->
                    </dl>
                </div>
            </div>
            <!---->
            <div class="user-comment-list">
                <div class="user-comment-title">
				<span class="rank-name">
					差评
				</span>
                    <div class="rank-stars">
                        <!-- 从一星到五星'star-icon1'到'star-icon5'-->
                        <span class="star-icon star-icon2"></span>
                    </div>
                    <div class="comment-time">购买时间：2018-04-23 17:21:22</div>
                </div>
                <div class="user-comment-item">
                    <div class="user-comment-pic">
                        <a href="/goods-9.html">
                            <img src="http://68dsw.oss-cn-beijing.aliyuncs.com/demo/shop/1/gallery/2017/08/25/15036309036310.jpg?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" />
                        </a>
                    </div>
                    <dl class="user-comment-info">
                        <dt class="comment-goods-name">大力柠檬 </dt>
                        <!---->
                        <dd class="comment-content">啊啊啊</dd>
                        <!--晒图-->
                        <dd class="comment-pic-list">
                            <ul id="gallery">
                                <!-- -->
                            </ul>
                        </dd>
                        <dd class="goods-comment-time">2018-11-10 11:27:34</dd>
                        <!---->
                        <!-- -->

                        <!-- -->
                    </dl>
                </div>
            </div>
            <!---->
            <div class="user-comment-list">
                <div class="user-comment-title">
				<span class="rank-name">
					好评
				</span>
                    <div class="rank-stars">
                        <!-- 从一星到五星'star-icon1'到'star-icon5'-->
                        <span class="star-icon star-icon5"></span>
                    </div>
                    <div class="comment-time">购买时间：2018-04-23 17:21:22</div>
                </div>
                <div class="user-comment-item">
                    <div class="user-comment-pic">
                        <a href="/goods-11.html">
                            <img src="http://68dsw.oss-cn-beijing.aliyuncs.com/demo/shop/1/gallery/2017/08/25/15036308618249.jpg?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" />
                        </a>
                    </div>
                    <dl class="user-comment-info">
                        <dt class="comment-goods-name">高山红富士苹果新鲜脆甜多汁水果批发</dt>
                        <!---->
                        <dd class="comment-content">啊啊啊啊</dd>
                        <!--晒图-->
                        <dd class="comment-pic-list">
                            <ul id="gallery">


                                <li>
                                    <a href="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/user/5/images/2018/11/10/15418203945566.jpg" class="img-gallery">
                                        <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/user/5/images/2018/11/10/15418203945566.jpg?x-oss-process=image/resize,m_pad,limit_0,h_180,w_180">
                                    </a>
                                </li>

                                <!---->
                            </ul>
                        </dd>
                        <dd class="goods-comment-time">2018-11-10 11:26:36</dd>
                        <!---->
                        <!-- -->

                        <!-- -->
                    </dl>
                </div>
            </div>
            <!---->
            <div class="user-comment-list">
                <div class="user-comment-title">
				<span class="rank-name">
					好评
				</span>
                    <div class="rank-stars">
                        <!-- 从一星到五星'star-icon1'到'star-icon5'-->
                        <span class="star-icon star-icon5"></span>
                    </div>
                    <div class="comment-time">购买时间：2018-10-15 16:13:46</div>
                </div>
                <div class="user-comment-item">
                    <div class="user-comment-pic">
                        <a href="/goods-16.html">
                            <img src="http://68dsw.oss-cn-beijing.aliyuncs.com/demo/shop/1/gallery/2017/08/25/15036307529844.jpg?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" />
                        </a>
                    </div>
                    <dl class="user-comment-info">
                        <dt class="comment-goods-name">陕西白鹿原大樱桃 车厘子大红灯 新鲜水果4斤航空包邮 甜的很</dt>
                        <!---->
                        <dd class="comment-content">初次评价</dd>
                        <!--晒图-->
                        <dd class="comment-pic-list">
                            <ul id="gallery">


                                <li>
                                    <a href="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/user/5/images/2018/11/10/15418202077462.jpg" class="img-gallery">
                                        <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/user/5/images/2018/11/10/15418202077462.jpg?x-oss-process=image/resize,m_pad,limit_0,h_180,w_180">
                                    </a>
                                </li>

                                <!---->
                            </ul>
                        </dd>
                        <dd class="goods-comment-time">2018-11-10 11:23:32</dd>
                        <!---->
                        <dd class="goods-comment-other">
                            <div class="text">
                                <em class="type">【追加评价】：</em>
                                追加
                            </div>
                        </dd>
                        <!--晒图-->
                        <dd class="comment-pic-list">
                            <ul id="gallery">

                                <!---->
                                <li>
                                    <a href="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/user/5/images/2018/11/10/15418202793932.jpg">
                                        <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/user/5/images/2018/11/10/15418202793932.jpg?x-oss-process=image/resize,m_pad,limit_0,h_180,w_180">
                                    </a>
                                </li>

                                <!---->
                            </ul>
                        </dd>
                        <dd class="goods-comment-time">2018-11-10 11:24:43</dd>
                        <!---->
                        <!-- -->

                        <!-- -->
                    </dl>
                </div>
            </div>
            <!---->
            <div class="user-comment-list">
                <div class="user-comment-title">
				<span class="rank-name">
					好评
				</span>
                    <div class="rank-stars">
                        <!-- 从一星到五星'star-icon1'到'star-icon5'-->
                        <span class="star-icon star-icon5"></span>
                    </div>
                    <div class="comment-time">购买时间：2018-10-15 16:13:46</div>
                </div>
                <div class="user-comment-item">
                    <div class="user-comment-pic">
                        <a href="/goods-205.html">
                            <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/shop/1/gallery/2018/09/28/15381362582058.jpg?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" />
                        </a>
                    </div>
                    <dl class="user-comment-info">
                        <dt class="comment-goods-name">创建红茶</dt>
                        <!---->
                        <dd class="comment-content">初次评价</dd>
                        <!--晒图-->
                        <dd class="comment-pic-list">
                            <ul id="gallery">


                                <li>
                                    <a href="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/user/5/images/2018/11/10/15418200797051.jpg" class="img-gallery">
                                        <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/user/5/images/2018/11/10/15418200797051.jpg?x-oss-process=image/resize,m_pad,limit_0,h_180,w_180">
                                    </a>
                                </li>

                                <!-- -->

                                <li>
                                    <a href="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/user/5/images/2018/11/10/15418200831749.jpg" class="img-gallery">
                                        <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/user/5/images/2018/11/10/15418200831749.jpg?x-oss-process=image/resize,m_pad,limit_0,h_180,w_180">
                                    </a>
                                </li>

                                <!---->
                            </ul>
                        </dd>
                        <dd class="goods-comment-time">2018-11-10 11:23:12</dd>
                        <!---->
                        <dd class="goods-comment-other">
                            <div class="text">
                                <em class="type">【追加评价】：</em>
                                追加
                            </div>
                        </dd>
                        <!--晒图-->
                        <dd class="comment-pic-list">
                            <ul id="gallery">

                                <!---->
                                <li>
                                    <a href="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/user/5/images/2018/11/10/15418202650789.jpg">
                                        <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/user/5/images/2018/11/10/15418202650789.jpg?x-oss-process=image/resize,m_pad,limit_0,h_180,w_180">
                                    </a>
                                </li>

                                <!---->
                            </ul>
                        </dd>
                        <dd class="goods-comment-time">2018-11-10 11:24:28</dd>
                        <!---->
                        <!-- -->

                        <!-- -->
                    </dl>
                </div>
            </div>
            <!---->
            <div class="user-comment-list">
                <div class="user-comment-title">
				<span class="rank-name">
					好评
				</span>
                    <div class="rank-stars">
                        <!-- 从一星到五星'star-icon1'到'star-icon5'-->
                        <span class="star-icon star-icon5"></span>
                    </div>
                    <div class="comment-time">购买时间：2018-08-11 18:01:15</div>
                </div>
                <div class="user-comment-item">
                    <div class="user-comment-pic">
                        <a href="/goods-8.html">
                            <img src="http://68dsw.oss-cn-beijing.aliyuncs.com/demo/shop/1/gallery/2017/08/25/15036309245013.jpg?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" />
                        </a>
                    </div>
                    <dl class="user-comment-info">
                        <dt class="comment-goods-name">大力农家西红柿500g自然不催熟大番茄 新鲜蔬菜</dt>
                        <!---->
                        <dd class="comment-content">非常好</dd>
                        <!--晒图-->
                        <dd class="comment-pic-list">
                            <ul id="gallery">


                                <li>
                                    <a href="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/user/5/images/2018/11/10/15418197152580.jpg" class="img-gallery">
                                        <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/user/5/images/2018/11/10/15418197152580.jpg?x-oss-process=image/resize,m_pad,limit_0,h_180,w_180">
                                    </a>
                                </li>

                                <!-- -->

                                <li>
                                    <a href="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/user/5/images/2018/11/10/15418197224080.jpg" class="img-gallery">
                                        <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/user/5/images/2018/11/10/15418197224080.jpg?x-oss-process=image/resize,m_pad,limit_0,h_180,w_180">
                                    </a>
                                </li>

                                <!---->
                            </ul>
                        </dd>
                        <dd class="goods-comment-time">2018-11-10 11:16:02</dd>
                        <!---->
                        <dd class="goods-comment-other">
                            <div class="text">
                                <em class="type">【追加评价】：</em>
                                追加来评价
                            </div>
                        </dd>
                        <!--晒图-->
                        <dd class="comment-pic-list">
                            <ul id="gallery">

                                <!---->
                                <li>
                                    <a href="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/user/5/images/2018/11/10/15418199013684.jpg">
                                        <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/user/5/images/2018/11/10/15418199013684.jpg?x-oss-process=image/resize,m_pad,limit_0,h_180,w_180">
                                    </a>
                                </li>

                                <!-- -->
                                <!---->
                                <li>
                                    <a href="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/user/5/images/2018/11/10/15418199065237.jpg">
                                        <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/user/5/images/2018/11/10/15418199065237.jpg?x-oss-process=image/resize,m_pad,limit_0,h_180,w_180">
                                    </a>
                                </li>

                                <!---->
                            </ul>
                        </dd>
                        <dd class="goods-comment-time">2018-11-10 11:18:41</dd>
                        <!---->
                        <!-- -->

                        <!-- -->
                    </dl>
                </div>
            </div>
            <!---->
            <div class="user-comment-list">
                <div class="user-comment-title">
				<span class="rank-name">
					好评
				</span>
                    <div class="rank-stars">
                        <!-- 从一星到五星'star-icon1'到'star-icon5'-->
                        <span class="star-icon star-icon5"></span>
                    </div>
                    <div class="comment-time">购买时间：2018-07-27 08:55:13</div>
                </div>
                <div class="user-comment-item">
                    <div class="user-comment-pic">
                        <a href="/goods-63.html">
                            <img src="http://68products.oss-cn-beijing.aliyuncs.com/taobao-yun-images/36494372594/TB18E84OpXXXXXTapXXXXXXXXXX_!!0-item_pic.jpg?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" />
                        </a>
                    </div>
                    <dl class="user-comment-info">
                        <dt class="comment-goods-name">法国原瓶进口红酒浪漫之花干红葡萄酒单支750ml/瓶</dt>
                        <!---->
                        <dd class="comment-content">人认为热(ˉ▽￣～) 切~~4 24 1</dd>
                        <!--晒图-->
                        <dd class="comment-pic-list">
                            <ul id="gallery">


                                <li>
                                    <a href="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/user/5/images/2018/08/09/15338033731397.png" class="img-gallery">
                                        <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/user/5/images/2018/08/09/15338033731397.png?x-oss-process=image/resize,m_pad,limit_0,h_180,w_180">
                                    </a>
                                </li>

                                <!---->
                            </ul>
                        </dd>
                        <dd class="goods-comment-time">2018-08-09 16:29:38</dd>
                        <!---->
                        <dd class="goods-comment-other">
                            <div class="text">
                                <em class="type">【追加评价】：</em>

                            </div>
                        </dd>
                        <!--晒图-->
                        <dd class="comment-pic-list">
                            <ul id="gallery">

                                <!---->
                                <li>
                                    <a href="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/user/5/images/2018/08/09/15338037159055.png">
                                        <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/user/5/images/2018/08/09/15338037159055.png?x-oss-process=image/resize,m_pad,limit_0,h_180,w_180">
                                    </a>
                                </li>

                                <!---->
                            </ul>
                        </dd>
                        <dd class="goods-comment-time">2018-08-09 16:35:17</dd>
                        <!---->
                        <!-- -->

                        <!-- -->
                    </dl>
                </div>
            </div>
            <!---->
            <div class="user-comment-list">
                <div class="user-comment-title">
				<span class="rank-name">
					好评
				</span>
                    <div class="rank-stars">
                        <!-- 从一星到五星'star-icon1'到'star-icon5'-->
                        <span class="star-icon star-icon5"></span>
                    </div>
                    <div class="comment-time">购买时间：2018-05-04 15:00:59</div>
                </div>
                <div class="user-comment-item">
                    <div class="user-comment-pic">
                        <a href="/goods-70.html">
                            <img src="http://images.68mall.com/system/config/default_image/default_goods_image_0.gif?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" />
                        </a>
                    </div>
                    <dl class="user-comment-info">
                        <dt class="comment-goods-name">我是haohaizi</dt>
                        <!---->
                        <dd class="comment-content">你觉得极为破解名称</dd>
                        <!--晒图-->
                        <dd class="comment-pic-list">
                            <ul id="gallery">
                                <!-- -->
                            </ul>
                        </dd>
                        <dd class="goods-comment-time">2018-06-01 13:39:25</dd>
                        <!---->
                        <dd class="goods-comment-other">
                            <div class="text">
                                <em class="type">【追加评价】：</em>
                                可回答vhyidoh
                            </div>
                        </dd>
                        <!--晒图-->
                        <dd class="comment-pic-list">
                            <ul id="gallery">
                                <!-- -->
                            </ul>
                        </dd>
                        <dd class="goods-comment-time">2018-06-01 13:39:58</dd>
                        <!---->
                        <!-- -->

                        <!-- -->
                    </dl>
                </div>
            </div>
            <!---->
            <div class="user-comment-list">
                <div class="user-comment-title">
				<span class="rank-name">
					好评
				</span>
                    <div class="rank-stars">
                        <!-- 从一星到五星'star-icon1'到'star-icon5'-->
                        <span class="star-icon star-icon4"></span>
                    </div>
                    <div class="comment-time">购买时间：2018-04-23 17:00:07</div>
                </div>
                <div class="user-comment-item">
                    <div class="user-comment-pic">
                        <a href="/goods-11.html">
                            <img src="http://68dsw.oss-cn-beijing.aliyuncs.com/demo/shop/1/gallery/2017/08/25/15036308618249.jpg?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" />
                        </a>
                    </div>
                    <dl class="user-comment-info">
                        <dt class="comment-goods-name">高山红富士苹果新鲜脆甜多汁水果批发</dt>
                        <!---->
                        <dd class="comment-content">很好吃</dd>
                        <!--晒图-->
                        <dd class="comment-pic-list">
                            <ul id="gallery">


                                <li>
                                    <a href="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/user/5/images/2018/04/24/15245564029694.jpg" class="img-gallery">
                                        <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/user/5/images/2018/04/24/15245564029694.jpg?x-oss-process=image/resize,m_pad,limit_0,h_180,w_180">
                                    </a>
                                </li>

                                <!---->
                            </ul>
                        </dd>
                        <dd class="goods-comment-time">2018-04-24 15:53:32</dd>
                        <!---->
                        <dd class="goods-comment-other">
                            <div class="text">
                                <em class="type">【追加评价】：</em>
                                666
                            </div>
                        </dd>
                        <!--晒图-->
                        <dd class="comment-pic-list">
                            <ul id="gallery">

                                <!---->
                                <li>
                                    <a href="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/user/5/images/2018/04/24/15245567697856.png">
                                        <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/user/5/images/2018/04/24/15245567697856.png?x-oss-process=image/resize,m_pad,limit_0,h_180,w_180">
                                    </a>
                                </li>

                                <!---->
                            </ul>
                        </dd>
                        <dd class="goods-comment-time">2018-04-24 15:59:31</dd>
                        <!---->
                        <!-- -->

                        <!-- -->
                    </dl>
                </div>
            </div>
            <!---->
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
    <!---->
    <!--  滚动加载 -->
    <!-- 底部菜单 -->


    <script src="/assets/d2eace91/js/szy.page.more.js?v=20180027"></script>
    <script type="text/javascript">
        // 滚动加载数据
        $(window).on('scroll', function() {
            if ($(document).scrollTop() + $(window).height() > $(document).height() - 10) {
                $.pagemore({
                    callback: function(result) {
                        // 图片预览
                        if ($("#gallery a").length > 0) {
                            var options = {};
                            $("#gallery a").photoSwipe(options);
                        }
                    }
                });
            }
        });
    </script>
    <script type="text/javascript">
        var tablelist = null;
        $().ready(function() {
            tablelist = $("#table_list").tablelist({
                params: $("#searchForm").serializeJson()
            });
            $("#searchForm").submit(function() {
                // 序列化表单为JSON对象
                var data = $(this).serializeJson();
                // Ajax加载数据
                tablelist.load(data);
                // 阻止表单提交
                return false;
            });

            $('.comment-level').click(function() {
                $(this).parents('ul').find('li').removeClass('selected');
                $(this).parent('li').addClass('selected');
                $('#searchForm').find("input[name='comment_level']").val($(this).data('value'));
                tablelist = $("#table_list").tablelist({
                    params: $("#searchForm").serializeJson()
                });
                tablelist.load({}, function() {
                    if ($("#gallery a").length > 0) {
                        var options = {};
                        $("#gallery a").photoSwipe(options);
                    }
                    $('html,body').scrollTop(0);
                });

            });

        });
    </script>
    <script src="/js/photoswipe.js?v=20180027"></script>
    <script>
        if ($("#gallery a").length > 0) {
            var options = {};
            $("#gallery a").photoSwipe(options);
        }
    </script>
    <!---->
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