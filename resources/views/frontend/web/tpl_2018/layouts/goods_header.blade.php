<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="icon" href="//shop.gogo198.cn/{{$website['slogo']}}" type="image/x-icon" />
    <title>{{$website['name']}}</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0" />-->
    <meta name="description" content="{{$website['desc']}}" />
    <meta name="keywords" content="{{$website['keywords']}}" />
    <!-- 头部元数据 -->
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- css -->
    <link href="/assets/d2eace91/home_css/bootstrap.min.css" rel="stylesheet" />
    <link href="/assets/d2eace91/home_css/fancybox/jquery.fancybox.css" rel="stylesheet">
    <link href="/assets/d2eace91/home_css/flexslider.css" rel="stylesheet" />
    <link href="/assets/d2eace91/home_css/style.css?v=333" rel="stylesheet" />
    <link href="/assets/d2eace91/css/swiper.min.css?v=2" rel="stylesheet">
    <script src="/assets/d2eace91/js/swiper.min.js?v=2"></script>
    <style>
        div,p,span,a,li{font-family:"Microsoft JhengHei", 微軟正黑體, "Arial", sans-serif !important;}
        a{color:#fff;text-decoration:unset;}
        a:hover{color:#fff;text-decoration:unset;}
        .about-logo{color:#fff;}
        /*.navbar-brand img{width:150px;}*/
        .navbar-brand .logo_title{color:{{$website['color_word']}};text-transform: none;text-shadow: -1px 0px 0px {{$website['color']}}, 0px 1px 0px {{$website['color']}}, 1px 0px 0px {{$website['color']}}, 0px -1px 0px {{$website['color']}};}
        header{z-index:999;min-height:100px;background:{{$website['color']}};position: fixed;top:0;width: 100%;box-shadow: 0px 0px 8px 1px #525252;}
        header .navbar{min-height:fit-content;width: 100%;}
        header .navbar-collapse ul.navbar-nav{margin-top:5px;}
        .navbar-default .navbar-toggle{margin-top:25px;margin-bottom:0px;}
        .open2>.dropdown-menu{display:block !important;}
        .disf{display:flex;align-items:center;}
        /**头部和头部字体start**/
        .navbar-static-top .container{width:1210px;}
        .topbar{background:{{$website['color']}};}
        .home-page header .navbar-default{box-shadow: unset;}
        .navbar .nav > .active > a, .navbar .nav > .active > a:hover{font-weight: 800 !important;}
        .navbar-default .navbar-nav>.open>a, .navbar-default .navbar-nav>.open>a:hover, .navbar-default .navbar-nav>.open>a:focus{color:{{$website['color_word']}} !important;}
        .navbar-default .navbar-nav>.open>a, .navbar-default .navbar-nav>.open>a:hover, .navbar-default .navbar-nav>.open>a:focus{background:transparent;}
        header .nav .caret {border-bottom-color: {{$website['color_word']}};border-top-color: {{$website['color_word']}};}
        .navbar .nav > li > a{color:{{$website['color_word']}};font-weight: 800;/*text-shadow: -1px 0px 0px {{$website['color']}}, 0px 1px 0px {{$website['color']}}, 1px 0px 0px {{$website['color']}}, 0px -1px 0px {{$website['color']}};*/}
        /*.navbar .nav > li > a:hover{color:#fff !important;}*/
        /*.navbar-default .navbar-nav>li>a:hover, .navbar-default .navbar-nav>li>a:focus{color:#fff !important;}*/
        /*.navbar-default .navbar-nav>.active>a, .navbar-default .navbar-nav>.active>a:hover, .navbar-default .navbar-nav>.active>a:focus{color:#fff;}*/
        .dropdown-menu li a:hover{background:#000000 !important;}
        .navbar-default .navbar-nav>.open>a, .navbar-default .navbar-nav>.open>a:hover, .navbar-default .navbar-nav>.open>a:focus{color:#d17107;}
        .dropdown-menu>li>a{color:#000000;}
        /*头部二级导航*/
        .navbar_more_content{background: #fff;height: 30px;position: absolute;width: 100%;top: 70px;border-top: 2px solid {{$website['color_word']}};}
        .navbar_more_content .navbar_txt a{color:{{$website['color_word']}};font-weight: 800;font-size: 18px;}
        .navbar_more_content .navbarCon{width:850px;margin:0 auto;justify-content: space-evenly;height:100%;}
        /*更多应用*/
        .appsBox{width: 125px;margin-right:0px;}
        .appsDiv{background: #fff;padding:15px;position:absolute;top:60px;left:0;box-sizing: border-box;border-radius: 7px;width: 280px;box-shadow: 0px 0px 10px 3px #6c6b6b;}
        .appsDiv .appsContent{display: grid;grid-template-columns: repeat(2,1fr);-moz-column-gap: 20px;column-gap: 20px;row-gap: 20px;}
        .appsDiv .logoImg{width:25px;}
        .appsDiv .logoTitle{color:#000;margin-left:10px;}
        .appsDiv .appsContent .platformDiv:hover .logoTitle{color:{{$website['color']}};}
        .web_translate{margin-top:10px;}
        /***头部和头部字体end*/

        #content{background:unset;}
        /**多语言字体**/
        .hkex_lang {padding: 0px 10px;}
        .navbar{background:none !important;}
        .navbar .hkex_lang{display:none;}
        .hkex_lang a {border-right: 1px solid #fff;padding-right: 15px;display: inline-block;padding-left: 15px;color: inherit;text-decoration: none;}
        .hkex_lang a:last-child{border-right:0;}
        .hkex_lang span{color:#fff;}
        .mobile_hr{display:none;}
        .lang_active{font-weight:unset;}
        h2, .h2{font-size:26px;}
        footer ul.link-list li a{font-size:18px;}
        footer a {font-size: 18px;}
        .copyright2{margin-top:20px;}
        /*头部navbar*/
        .wapNavbar{display:none;}

        @media (max-width: 992px) {
            header{position:fixed;top: 0;left: 0;width: 100%;z-index: 9;min-height: 110px;}
            .w1210{margin:130px 0 0;}
            #banner{margin-top:83px;}
            .dropdown-menu{top:40px;left:20px;}
            .navbar-collapse{margin-bottom: 20px;}
            section.section-padding.gray-bg{padding:30px;}
            .cross-border .row .cross-content{margin-top:24px;}
            .foot-menu .col-md-4{padding-left:0;}
            .cross-border .section-title p{margin-bottom:0 !important;}
            .cross-gather .section-title p{margin-bottom:24px !important;}
            .navbar-logo{padding: 15px 0 0 20px;display: block;}
            .navbar-default .navbar-toggle{margin-top:27px;}
            .navbar-toggle{padding:5px;}
            .navbar-toggle .icon-bar{width:20px;}
            /*头部navbar*/
            .wapNavbar{display:block;}
            .pcNavbar{display:none;}
            .wapNavbar .scroller-container {width: 100%;height: 100%;overflow: hidden;}
            .wapNavbar .scroller {display: flex;animation: scroll linear infinite;}
            .wapNavbar .item {flex: none;padding: 0 10px;white-space: nowrap;line-height: 38px;}

            /**头部样式**/
            .home-page header .navbar-default{background:{{$website['color']}} !important;border-bottom:1px solid #fff;}
            .navbar-default .navbar-toggle{border-color: {{$website['color_word']}};}
            .navbar-default .navbar-toggle .icon-bar{background-color:{{$website['color_word']}};}
            .navbar-default .navbar-collapse{background:{{$website['color']}};margin-top:20px;border-color:{{$website['color_word']}};}
            .navbar-static-top .container{width:100%;}
            header .nav .caret{border-bottom-color: {{$website['color_word']}};border-top-color: {{$website['color_word']}};}
            header ul.nav li{border-bottom:1px solid {{$website['color_word']}};}
            .navbar-default .navbar-nav .open .dropdown-menu>li>a{color:{{$website['color_word']}};}
            /*头部二级导航*/
            .navbar_more_content{width: 100%;height:40px;line-height: 40px;}
            .navbar_more_content .navbar_txt a{font-size: 15px !important;}
            .navbar_more_content .navbarCon{width: 100%;}
            /*更多应用*/
            .appsDiv{left:15px;}
            /**多语言字体**/
            .hkex_lang{text-align:right;padding-top:15px;}
            .hkex_lang span{color:#000000;}
            .hkex_lang a {border-right: 1px solid #000000;padding-right: 15px;}
            .mobile_hr{display:block;background:{{$website['color_word']}};}
            .navbar .hkex_lang{display:block;}

            /**内页头部图片**/
            .detail_topimg,.non_topimg{margin-top:63px;}

            /**友情链接**/
            #content .container .title2{margin-right:30px !important;}

            .slogan{top: 75px !important;left: 15px !important;display: none;}

            .foot-menu{margin-top:22px;}
            .copyright{margin-top:40px;}
            .copyright2{margin-top:20px;}
            /*.navbar-default .navbar-brand{display: none;}*/
        }
        hr{border-top:1px solid #000000;}

        footer .other_website a,footer .copyright a{font-size:16px;}

        #translate{position:relative !important;left:unset !important;bottom:unset !important;}
        .contact_contain .box{border-bottom: 0;}

        @keyframes scroll {
            from { transform: translateX(100%); }
            to { transform: translateX(-100%); }
        }

        /**翻译时更改字体**/
        .f32{font-size: 32px !important;}
        .f26{font-size:26px !important;}
        .f22{font-size:22px !important;}
        .f20{font-size:20px !important;}
        .f18{font-size:18px !important;}
        .f16{font-size:16px !important;}
        .f15{font-size:15px !important;}
        .f13{font-size:13px !important;}
        .fweight{font-weight: 800;}
    </style>
</head>
<script src="/assets/d2eace91/js/jquery.js"></script>
<script src="/assets/d2eace91/bootstrap/js/bootstrap.min.js?v=5"></script>

<script type="text/javascript" charset="utf-8">
    var head= document.getElementsByTagName('head')[0]; var script= document.createElement('script'); script.type= 'text/javascript'; script.src= '//www.gogo198.cn/assets/d2eace91/js/res.zvo.cn_translate_inspector_v2.js?v=12<?php echo time();?>'; head.appendChild(script);
</script>
<body class="pace-done">
    <header>
        <div class="navbar navbar-default navbar-static-top">
            <div class="container" style="font-size:20px;">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <div class="open">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </div>
                        <div class="close" style="display:none;">
                            ×
                        </div>
                    </button>
                    <div class="navbar-brand" style="margin-top:10px;position: relative;cursor: pointer;">
                        <img src="//shop.gogo198.cn/{{$website['search']['img']}}" class="appsBox" onclick="open_apps()">
                        <div class="appsDiv" style="display: none;">
                            <div class="appsContent">
                                @foreach($website['apps'] as $k=>$vo)
                                    <div class="platformDiv disf">
                                        <a href="{{$vo['link']}}" target="_blank">
                                            <img class="logoImg" src="//shop.gogo198.cn/{{$vo['thumb']}}" alt="">
                                            <span class="logoTitle f15">{{$vo['name']}}</span>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                            <div id="111" class="web_translate"></div>
                        </div>
                    </div>
                </div>
                <div class="navbar-collapse collapse">
                    <div class="hkex_lang">
                        <div id="333" class="mobile_translate"></div>
                    </div>
                    <hr class="mobile_hr" style="margin:15px 0 0;"/>
                    <ul class="nav navbar-nav">
                        @foreach($website['menu'] as $k=>$vo)
                            @if(!empty($vo['childMenu']))
                                <li class="dropdown dd_parent" onclick="javascript:removeclass(this);">
                                    <a href="#" data-toggle="dropdown" class="dropdown-toggle f20">{{$vo['name']}} <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        @foreach($vo['childMenu'] as $ke=>$vo2)
                                            @if($vo2['go_other']==1)
                                                <li><a href="{{$vo2['other_link']}}" target="_blank" class="f18">{{$vo2['name']}}</a></li>
                                            @elseif($vo2['go_other']==2)
                                                <li><a href="?s=index/detail&id={{$vo2['other_navbar']}}" target="_blank" class="f18">{{$vo2['name']}}</a></li>
                                            @else
                                                <li><a href="@if($vo2['type']==5)
                                                            javascript:connect_aikefu();
    @else
                                                            /?s=main/guide_page&page_id={{$vo2['id']}}
                                                    @endif" class="f18">{{$vo2['name']}}</a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                @if($vo['go_other']==1)
                                    <li><a href="{{$vo['other_link']}}" target="_blank" class="f22">{{$vo['name']}}</a></li>
                                @elseif($vo['go_other']==2)
                                    <li><a href="?s=index/detail&id={{$vo['other_navbar']}}" target="_blank" class="f22">{{$vo['name']}}</a></li>
                                @else
                                    <li><a href="/?s=main/guide_page&page_id={{$vo2['id']}}" class="f22">{{$vo['name']}}</a></li>
                                @endif
                            @endif
                        @endforeach

                        @if(!empty(session('user')))
                            <style>
                                .haccount_info{padding: 3px 12px;border-bottom: 1px solid #000;}
                                .haccount_info p{font-size:15px;margin-bottom:5px;}
                            </style>
                            <li class="dropdown dd_parent" onclick="javascript:removeclass(this);">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle f20" style="text-transform:unset;">GoFriend <b class="caret"></b></a>
                                <ul class="dropdown-menu" style="min-width: 200px;">
                                    <li><a href="//boss.gogo198.cn/?s=index/member_login&shop_uid=<?php echo base64_encode(session('user.user_id'));?>" class="f15" style="@if($_SERVER['REQUEST_URI']=='/?s=index/account_manage')
                                                background:#000;color:#fff;
                                        @endif">&gt;个人中心</a></li>
                                    <li><a href="/site/logout.html" class="f15">&gt;切换账号</a></li>
                                </ul>
                            </li>
                        @else
                            <li class="dropdown dd_parent" onclick="javascript:removeclass(this);">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle f20" style="text-transform:unset;">淘中国 <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="/login.html" class="f18">&nbsp;&nbsp;登录/注册</a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="navbar_more_content">
            <div class="navbarCon pcNavbar">
                <div class="disf" style="justify-content: space-between;">
                    @foreach($website['search_list'] as $k=>$v)
                        @if($v['type']==0)
                            <div class="navbar_txt"><a href="javascript:showWindows2(21,{{$v['id']}},2,this);">{{$v['name']}}</a></div>
                        @elseif($v['type']==1)
                            <div class="navbar_txt"><a href="/guide_page?id={{$v['guide_id']}}" target="_blank">{{$v['name']}}</a></div>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="navbarCon wapNavbar">
                <div class="scroller-container">
                    <div class="scroller">
                        @foreach($website['search_list'] as $k=>$v)
                            @if($v['type']==0)
                                <div class="navbar_txt item"><a href="javascript:showWindows2(21,{{$v['id']}},2,this);">{{$v['name']}}</a></div>
                            @elseif($v['type']==1)
                                <div class="navbar_txt item"><a href="/guide_page?id={{$v['guide_id']}}" target="_blank">{{$v['name']}}</a></div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </header>

    @yield('content')

    @extends('layouts.right_slide')

    @section('common_footer')
        @include('layouts.footer')
    @show

    <script>
        $(document).ready(function() {
            //占满屏判断
            function setFullScreenSectionHeight() {
                // var windowHeight = $(window).height();
                var windowHeight = document.body.clientHeight;
                // console.log(windowHeight);
                $('.fullscreen-section').height(windowHeight-86);
                $('.fullscreen-section2').height(windowHeight+150);
                $('.fullscreen-section3').height(windowHeight);
            }

            setFullScreenSectionHeight();

            // $(window).resize(function() {
            //     setFullScreenSectionHeight();
            // });
        });

        //头部滚动======================start
        let intervalId;
        let speed = 1000;
        let count = 3;
        $(function(){
            startScrolling();//开始滚动
            $('.scroller').css('animation-duration', `10000ms`);
            const itemWidth = $('.scroller .item').outerWidth(true);
            $('.scroller').css('width', `200px`);
        })


        function startScrolling() {
            stopScrolling(); // Stop any existing scrolling first
            intervalId = setInterval(function() {
                // $('.scroller').append($('.scroller .item').first().clone());
                // $('.scroller .item').first().remove();
            }, speed);
        }

        function stopScrolling() {
            clearInterval(intervalId);
        }
        //头部滚动======================end
    </script>
</body>
</html>