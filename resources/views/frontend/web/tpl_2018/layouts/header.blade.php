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
        .disf{display:flex;align-items:center;}

        .navbar-brand .logo_title{color:{{$website['color_word']}};text-transform: none;text-shadow: -1px 0px 0px {{$website['color']}}, 0px 1px 0px {{$website['color']}}, 1px 0px 0px {{$website['color']}}, 0px -1px 0px {{$website['color']}};}
        header .navbar-collapse ul.navbar-nav{margin-top:0px;}
        .navbar-default .navbar-toggle{margin-top:25px;margin-bottom:0px;}
        .open2>.dropdown-menu{display:block !important;}
        /**头部和头部字体start**/
        .navbar-static-top .container{width:100%;padding:0;background:{{$website['color']}};}
        .topbar{background:{{$website['color']}};}
        .home-page header .navbar-default{box-shadow: unset;background:#fff !important;box-shadow: 0px 0px 10px 5px #666;}
        .navbar .nav > .active > a, .navbar .nav > .active > a:hover{font-weight: 800 !important;}
        /*.navbar-default .navbar-nav>.open>a, .navbar-default .navbar-nav>.open>a:hover, .navbar-default .navbar-nav>.open>a:focus{color:#fff !important;}*/
        .navbar-default .navbar-nav>.open>a, .navbar-default .navbar-nav>.open>a:hover, .navbar-default .navbar-nav>.open>a:focus{background:transparent;}
        header .nav .caret {border-bottom-color: {{$website['color_word']}};border-top-color: {{$website['color_word']}};}
        .navbar .nav > li > a{color:{{$website['color_word']}};font-weight: 800;/*text-shadow: -1px 0px 0px {{$website['color']}}, 0px 1px 0px {{$website['color']}}, 1px 0px 0px {{$website['color']}}, 0px -1px 0px {{$website['color']}};*/}
        .navbar-default .navbar-nav>.active>a, .navbar-default .navbar-nav>.active>a:hover, .navbar-default .navbar-nav>.active>a:focus{color:#fff;}
        .dropdown-menu li a:hover{background:#000000 !important;}
        /*.navbar-default .navbar-nav>.open>a, .navbar-default .navbar-nav>.open>a:hover, .navbar-default .navbar-nav>.open>a:focus{color:#d17107;}*/
        .dropdown-menu>li>a{color:#000000;}
        header .container .containerDiv{width:1210px;margin:0 auto;display:flex;align-items: center;justify-content: space-between;padding:7px 0;box-sizing: border-box;}
        /*更多应用*/
        .appsBox{width: 155px;margin-right:10px;}
        .appsDiv{background: #fff;padding:15px;position:absolute;top:40px;left:0;box-sizing: border-box;border-radius: 7px;width: 280px;box-shadow: 0px 0px 10px 3px #6c6b6b;z-index: 9;}
        .appsDiv .appsContent{display: grid;grid-template-columns: repeat(2,1fr);-moz-column-gap: 20px;column-gap: 20px;row-gap: 20px;}
        .appsDiv .logoImg{width:25px;}
        .appsDiv .logoTitle{color:#000;margin-left:10px;}
        .appsDiv .appsContent .platformDiv:hover .logoTitle{color:{{$website['color']}};}
        .web_translate{margin-top:10px;}
        /***头部和头部字体end*/

        #content{background:unset;}
        /**多语言字体**/
        .hkex_lang {padding: 0px 10px;}
        .navbar{background:none !important;position: fixed;}
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
        /*手机版菜单*/
        .navbar-collapse2{display: none;}

        @media (max-width: 992px) {
            header{position:fixed;top: 0;left: 0;width: 100%;z-index: 9;}
            #banner{margin-top:83px;}
            .dropdown-menu{top:40px;left:20px;}
            .navbar-collapse{margin-bottom: 20px;}
            section.section-padding.gray-bg{padding:30px;}
            .cross-border .row .cross-content{margin-top:24px;}
            .foot-menu .col-md-4{padding-left:0;}
            .cross-border .section-title p{margin-bottom:0 !important;}
            .cross-gather .section-title p{margin-bottom:24px !important;}
            /*手机版三扛start*/
            .navbar-default .navbar-toggle{margin-top:20px;}
            .navbar-toggle{padding:5px;}
            .navbar-toggle .icon-bar{width:20px;}
            /*手机版三扛end*/

            /**头部样式**/
            .home-page header .navbar-default{background:{{$website['color']}} !important;border-bottom:1px solid #fff;}
            .navbar-default .navbar-toggle{border-color: {{$website['color_word']}};}
            .navbar-default .navbar-toggle .icon-bar{background-color:{{$website['color_word']}};}
            .navbar-default .navbar-collapse{background:{{$website['color']}};margin-top:20px;border-color:{{$website['color_word']}};box-shadow: 0px 0px 10px 1px #000;}
            .navbar-static-top .container{width:100%;}
            header .nav .caret{border-bottom-color: {{$website['color_word']}};border-top-color: {{$website['color_word']}};}
            .navbar-default .navbar-nav .open .dropdown-menu>li>a{color:{{$website['color_word']}};}
            .appsDiv{left:15px;}
            header .container .containerDiv{width: 100%;}
            header .container .containerDiv .navbar-header{width: 100%;}
            /**多语言字体**/
            .hkex_lang{text-align:left;padding-bottom:15px;}
            .hkex_lang select{width: 100%;}
            .hkex_lang span{color:#000000;}
            .hkex_lang a {border-right: 1px solid #000000;padding-right: 15px;}
            .mobile_hr{display:block;}
            .navbar .hkex_lang{display:block;}

            /**内页头部图片**/
            .detail_topimg,.non_topimg{margin-top:63px;}

            /**友情链接**/
            #content .container .title2{margin-right:30px !important;}

            /*手机版菜单*/
            .pc_menu{display:none;}
            .navbar-collapse2{width: 100%;position: absolute;top: 85%;padding: 20px;}
            .navbar-collapse2 .searchBox{width: 100%;margin:15px 0;}
            header ul.nav li{border-bottom:1px solid #dbdada;}
            .navbar-default .navbar-nav .open .dropdown-menu>li>a{padding:10px 15px 10px 25px;}
            .navbar-collapse{max-height: 600px;}

            .slogan{top: 75px !important;left: 15px !important;display: none;}

            .foot-menu{margin-top:22px;}
            .copyright{margin-top:40px;}
            .copyright2{margin-top:20px;}
        }
        hr{border-top:1px solid #000000;}

        footer .other_website a,footer .copyright a{font-size:16px;}

        #translate{position:relative !important;left:unset !important;bottom:unset !important;}
        .contact_contain .box{border-bottom: 0;}

        /*所有按钮移入边框变颜色*/
        .nav_item:hover,
        .viewGoods:hover,
        .swiper-button-prev:hover,
        .swiper-button-next:hover,
        .storeDiv .hsBox:hover,
        .storeDiv .hsBox .hsDiv .hsContent .moreBtn .detailDiv a:hover,
        .cont6-bg .serviceBox .leftBox:hover,
        .cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv:hover,
        .cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv .serviceTxt .moreBtn a:hover,
        .cont6-bg .serviceBox .leftBox .cont6 .serviceContent .serviceDiv .serviceIn:hover,
        .cont4-bg .hs2:hover,
        .cont4-bg .hsDiv .hsContent .moreBtn a:hover,
        .next-btn-helper:hover,
        .next-btn:hover,
        .view_btn:hover,
        .buy_goods:hover{border-color:#c60001 !important;}

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
<body style="background:{{$website['color']}};">
<div id="wrapper" class="home-page">
    <!-- 菜单栏开始 -->
    <header style="z-index:999;">
        <!--头部第一层-->
        <div class="navbar navbar-default navbar-static-top">
            <style>
                /*PC版：*/
                /*菜单三条杠*/
                .selectMenu{position:relative;margin-right:10px;}
                .selectMenu .menuIcon{border:2px solid #fff;padding:5px;cursor:pointer;}
                .selectMenu .menuIconDiv{width:13px;height:2px;background: #fff;margin-bottom:2px;}
                /*口号*/
                .sloganDiv{height: 20px;overflow: hidden;}
                .sloganDiv p{line-height: 19px;color:#fff;font-size:15px;font-weight: 800;}
                /*最新讯息*/
                .newsContainer{max-width:350px;justify-content: center;transition:all 0.3s ease;padding-right:5px;}
                .newsContainer .leftTxt{color:#fff;display: inline-block;font-weight:800;width: fit-content;height:28px;text-shadow: -1px 0 4px #0e2e68, 0 1px 4px #0e2e68, 1px 0 #0e2e68, 0 -1px #0e2e68;}
                .newsContainer .rightTxt{width: 100%;}
                .newsContainer .news{height: 20px;overflow: hidden;width: 100%;}
                .newsContainer .news .swiper-slide{text-overflow: ellipsis;white-space: nowrap;}
                .newsContainer .news a{color:{{$website['color_word']}};font-weight:800;}
                .newsContainer .news a p{color:#fff;font-weight:800;line-height: 20px;width:100%;white-space: nowrap;text-overflow:unset;overflow: unset;}
                /*时间*/
                .news_box{background:#c60001;width: 100%;margin:0 auto;padding:1px 0px;box-sizing: border-box;border-radius:0px;border:1px solid #000;transition: all 0.3s ease;}
                .news_box .time, .news_box .mtime{margin:0px 0px 0;color:#000;font-size:15px;}
                .news_box .time span, .news_box .mtime span{font-size: 15px;white-space: nowrap;font-weight: 800;color:#fff;}
                .news_box .time .chosen-container span, .news_box .mtime .chosen-container span{color:#000;}
                .news_box .time #selectCity, .news_box .mtime #selectCity{width: 90px;font-size: 15px;border: 0;background: #fff;text-align: center;color:#000;}
                .news_box .time .chosen-container, .news_box .mtime .chosen-container{width: 120px;margin-right:3px;}
                /*汇率*/
                .news_box .rate{margin-top:0px;padding-left: 0px;justify-content: center;}
                .news_box .rate .leftTxt{color:#fff;display: inline-block;font-weight:800;width: fit-content;white-space:nowrap;font-size:15px;}
                .news_box .rate .rightTxt{display: inline-block;width: fit-content;font-size:15px;font-weight: 800;}
                .news_box .rate .rate_swiper,.news_box .rate .mrate_swiper{height: 18px;overflow: hidden;width: 100%;}
                .news_box .rate_swiper .swiper-slide,.news_box .mrate_swiper .swiper-slide{text-overflow: ellipsis;white-space: nowrap;}
                .news_box .rate_swiper a,.news_box .mrate_swiper a{color:#fff;font-weight:100;}
                .news_box .rate_swiper a p,.news_box .mrate_swiper a p{color:#fff;font-weight:800;line-height: 20px;width:100%;white-space: nowrap;text-overflow:ellipsis;overflow: hidden;font-size:15px;}
                /*浏览量*/
                .news_box .readNum,.news_box .mreadNum{height: 18px;overflow: hidden;margin-top:0px;font-size:15px;}
                .news_box .readNum p,.news_box .mreadNum p{font-size:15px;color:#fff;line-height:19px;white-space: nowrap;font-weight:800;}

                /*手机版：口号+时间+汇率+浏览量+新闻*/
                .mobile_news_box{display:none;/*position: absolute;top: -2px;*/width: 100%;z-index: 9;}
                .mobile_news_box .news_box{text-align: center;width: calc(100% + 10px);padding: 0px;box-sizing: border-box;box-shadow: 0px 0px 15px 4px #555353;border-radius: unset !important;}
                #mobileNewsBox-container{overflow:hidden;height: 35px;width: 100%;}
                /*新闻*/
                #mobileNewsBox-container .newsContainer{max-width:100%;}
                #mobileNewsBox-container .newsContainer .news{height:100%;}
                #mobileNewsBox-container .news a {color: {{$website['color']}};font-weight: 800;}
                #mobileNewsBox-container .news a p{color: {{$website['color']}};font-weight: 800;line-height: 35px;}
                /*汇率*/
                #mobileNewsBox-container .rate{margin-top:2px;}
                .mobile_news_box .news_box .rate{margin: 0px 0;margin-top:0;}
                /*时间*/
                #mobileNewsBox-container .mtime{margin-top:5px;}
                /*阅读量+口号*/
                #mobileNewsBox-container .readNumBox,#mobileNewsBox-container .slogan_div{margin-top:7px;}
                #mobileNewsBox-container .scrollable-div-child{height:30px;}
            </style>
            @if(!isset($is_inner))
                <!--PC版头部-->
                <div class="news_box pc_news_box">
                    <div class="disf" style="justify-content: space-around;">
                        <!--口号-->
                        <div class="disf">
                            <div class="selectMenu">
                                <!--三条杠-->
                                <div class="menuIcon" onclick="open_apps()">
                                    <div class="menuIconDiv"></div>
                                    <div class="menuIconDiv"></div>
                                    <div class="menuIconDiv" style="margin-bottom:0;"></div>
                                </div>
                                <!--更多网站-->
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
                            <div class="sloganDiv">
                                <div class="swiper-container slogan_swiper">
                                    <div class="swiper-wrapper">
                                        @foreach($data['slogan'] as $k=>$v)
                                            <div class="swiper-slide">
                                                <p>{{$v['text']}}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--新闻-->
                        <div class="newsContainer">
                            <div class="rightTxt">
                                <div class="swiper-container news">
                                    <div class="swiper-wrapper">
                                        @foreach($news as $k=>$vo)
                                            <div class="swiper-slide">
                                                <a href="{{$vo['link']}}" target="_blank"><p class="f15">{{$vo['title']}}</p></a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--时间-->
                        <div class="time">
                            <div class="drop-down beijing-time disf">
                                <select id="selectCity" onchange="selectCity(this)" class="chosen-select city-select">
                                    @foreach($citys as $k=>$v)
                                        <optgroup label="{{$k}}">
                                            @foreach($v as $k2=>$v2)
                                                <option value="{{$v2['city_en']}}"><?php echo strtoupper($v2['cityEn']);?></option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                                <span class="beijing_date"><?php echo date('Y/m/d');?></span>&nbsp;<span class="beijing_sec" style="width:60px;"></span>
                            </div>
                        </div>
                        <!--汇率-->
                        <div class="rate disf">
                            <div class="leftTxt">实时汇率：</div>
                            <div class="rightTxt">
                                <div class="swiper-container rate_swiper">
                                    <div class="swiper-wrapper">
                                        @foreach($data['rate'] as $k=>$v)
                                            <div class="swiper-slide">
                                                <a href="/rate_detail?id={{$v['id']}}" target="_blank"><p>1CNY&nbsp;≈&nbsp;<?php echo number_format(1*$v['rate'], 3);?>{{$v['symbol']}}</p></a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--浏览量-->
                        <div class="readNumBox">
                            <div class="swiper-container readNum">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <p>昨天已有 ［{{$data['yesterday']}}］ 人次访问</p>
                                    </div>
                                    <div class="swiper-slide">
                                        <p>本月累计 ［{{$data['this_month']}}］ 人次访问</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Mob版头部-->
                <div class="mobile_news_box">
                    <div class="news_box">
                        <div class="swiper-container" id="mobileNewsBox-container">
                            <!--轮播内容-->
                            <div class="swiper-wrapper">
                                <!--汇率-->
                                <div class="swiper-slide">
                                    <div class="scrollable-div-child rate disf" style="justify-content: center;">
                                        <div class="leftTxt">实时汇率：</div>
                                        <div class="rightTxt" style="text-align: left;">
                                            <div class="swiper-container mrate_swiper">
                                                <div class="swiper-wrapper">
                                                    @foreach($data['rate'] as $k=>$v)
                                                        <div class="swiper-slide">
                                                            <a href="/rate_detail?id={{$v['id']}}" target="_blank"><p>1人民币&nbsp;≈&nbsp;<?php echo number_format(1*$v['rate'], 3);?>{{$v['name']}}</p></a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--时间-->
                                <div class="swiper-slide">
                                    <div class="scrollable-div-child mtime">
                                        <div class="drop-down beijing-time disf" style="justify-content: center;">
                                            <span>
                                                <select id="selectCity" onchange="selectCity(this)" class="chosen-select city-select">
                                                    @foreach($citys as $k=>$v)
                                                        <optgroup label="{{$k}}">
                                                            @foreach($v as $k2=>$v2)
                                                                <option value="{{$v2['city_en']}}"><span>{{$v2['contryCn']}}</span>{{$v2['cityCn']}}</option>
                                                            @endforeach
                                                        </optgroup>
                                                    @endforeach
                                                </select>
                                            </span>&nbsp;
                                            <span class="beijing_date"><?php echo date('Y/m/d');?></span>&nbsp;<span class="beijing_sec" style="width:60px;"></span>
                                        </div>
                                    </div>
                                </div>
                                <!--浏览量-->
                                <div class="swiper-slide">
                                    <div class="scrollable-div-child readNumBox">
                                        <div class="swiper-container mreadNum">
                                            <div class="swiper-wrapper">
                                                <div class="swiper-slide">
                                                    <p>昨天已有 ［{{$data['yesterday']}}］ 人次访问</p>
                                                </div>
                                                <div class="swiper-slide">
                                                    <p>本月累计 ［{{$data['this_month']}}］ 人次访问</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--新闻-->
                                <div class="swiper-slide">
                                    <div class="newsContainer">
                                        <div class="rightTxt">
                                            <div class="swiper-container news">
                                                <div class="swiper-wrapper">
                                                    @foreach($news as $k=>$vo)
                                                        <div class="swiper-slide">
                                                            <a href="{{$vo['link']}}" target="_blank"><p class="f15">{{$vo['title']}}</p></a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--口号-->
                                @if(!empty($data['slogan']))
                                    <div class="swiper-slide">
                                        <div class="scrollable-div-child slogan_div" style="overflow: hidden;">
                                            <div class="swiper-container mslogan_swiper">
                                                <div class="swiper-wrapper">
                                                    @foreach($data['slogan'] as $k=>$v)
                                                        <div class="swiper-slide">
                                                            <p style="color:{{$website['color']}};">{{$v['text']}}</p>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="container" style="font-size:20px;background: {{$website['color']}};height:78px;">
                <div class="containerDiv">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse2">
                            <div class="open">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </div>
                            <div class="close" style="display:none;">
                                ×
                            </div>
                        </button>
                        <div class="navbar-brand" style="margin-top:0px;position: relative;cursor: pointer;height:100%;">
                            <img src="//shop.gogo198.cn/{{$website['search']['img']}}" class="appsBox" onclick="open_apps()">
                        </div>
                    </div>

                    <!--PC版：-->
                    <!--菜单-->
                    <div class="navbar-collapse collapse pc_menu" >
                        <ul class="nav navbar-nav">
                            @foreach($website['menu'] as $k=>$vo)
                                @if(!empty($vo['childMenu']))
                                    <li class="dropdown dd_parent" onclick="javascript:removeclass(this);">
                                        <a href="#" data-toggle="dropdown" class="dropdown-toggle f20">{{$vo['name']}} <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            @foreach($vo['childMenu'] as $ke=>$vo2)
                                                @if($vo2['go_other']==1)
                                                    <li><a href="{{$vo2['other_link']}}" target="_blank" class="f18">&nbsp;&nbsp;{{$vo2['name']}}</a></li>
                                                @elseif($vo2['go_other']==2)
                                                    <li><a href="?s=index/detail&id={{$vo2['other_navbar']}}" target="_blank" class="f18">&nbsp;&nbsp;{{$vo2['name']}}</a></li>
                                                @else
                                                    <li><a href="@if($vo2['type']==5)
                                                                javascript:connect_aikefu();
@else
                                                                /?s=main/guide_page&page_id={{$vo2['id']}}
                                                        @endif" class="f18">&nbsp;&nbsp;{{$vo2['name']}}</a></li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    @if($vo['go_other']==1)
                                        <li><a href="{{$vo['other_link']}}" target="_blank" class="f20">&nbsp;&nbsp;{{$vo['name']}}</a></li>
                                    @elseif($vo['go_other']==2)
                                        <li><a href="?s=index/detail&id={{$vo['other_navbar']}}" target="_blank" class="f20">&nbsp;&nbsp;{{$vo['name']}}</a></li>
                                    @else
                                        <li><a href="/?s=main/guide_page&page_id={{$vo2['id']}}" class="f20">&nbsp;&nbsp;{{$vo['name']}}</a></li>
                                    @endif
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <!--搜索框-->
                    <div class="searchBox pc_menu">
                        <form action="">
                            <div class="searchContent disf">
                                <div class="inputBox disf">
                                    <div class="nameBox">
                                        <input type="text" name="name" placeholder="{{$website['search']['search_title']}}" class="f15" id="searchInput">
                                    </div>
                                    <div class="btnBox" onclick="search_info(this)">
                                        <img src="/assets/d2eace91/images/newhome/search_icon.png">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--客服&我的-->
                    <div class="navbar-collapse collapse pc_menu" >
                        <ul class="nav navbar-nav">
                            <li>
                                <a href="javascript:connect_kefu();" class="f20" style="margin-right:20px;">
                                    在线客服
                                    {{--                                    <img src="/images/kefu.png" style="width:30px;height:30px;">--}}
                                </a>
                            </li>
                            @if(!empty(session('user')))
                                <style>
                                    .haccount_info{padding: 3px 12px;border-bottom: 1px solid #000;}
                                    .haccount_info p{font-size:15px;margin-bottom:5px;}
                                </style>
                                <li class="dropdown dd_parent" onclick="javascript:removeclass(this);">
                                    <a href="#" data-toggle="dropdown" class="dropdown-toggle f20" style="text-transform:unset;">
                                        {{--                                        <img src="/images/member.png" style="width:30px;height:30px;">--}}
                                        GoFriend
                                        <b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu" style="min-width: 200px;">
                                        <li><a href="//boss.gogo198.cn/?s=index/member_login&shop_uid=<?php echo base64_encode(session('user.user_id'));?>" target="_blank" class="f15" style="@if($_SERVER['REQUEST_URI']=='/?s=index/account_manage')
                                                    background:#000;color:#fff;
                                            @endif">&gt;个人中心</a></li>
                                        <li><a href="/site/logout.html?shop_uid=<?php echo base64_encode(session('user.user_id'));?>" class="f15">&gt;切换账号</a></li>
                                    </ul>
                                </li>
                            @else
                                <li class="dropdown dd_parent" onclick="javascript:removeclass(this);">
                                    <a href="/login.html" data-toggle2="dropdown" class="dropdown-toggle f20" style="text-transform:unset;">
                                        {{--                                        <img src="/images/member.png" style="width:25px;height:25px;"> --}}
                                        注册/登录
                                        <b class="caret"></b>
                                    </a>
                                    {{--                                    <ul class="dropdown-menu">--}}
                                    {{--                                        <li><a href="/login.html" class="f18">&nbsp;&nbsp;登录/注册</a></li>--}}
                                    {{--                                    </ul>--}}
                                </li>
                            @endif
                        </ul>
                    </div>

                    <!--Mob版：-->
                    <div class="navbar-collapses collapse navbar-collapse2">
                        <ul class="nav navbar-nav">
                            <li>
                                <div class="hkex_lang">
                                    <div id="333" class="mobile_translate"></div>
                                </div>
                            </li>
                            <li>
                                <div class="searchBox">
                                    <form action="">
                                        <div class="searchContent disf">
                                            <div class="inputBox disf">
                                                <div class="nameBox">
                                                    <input type="text" name="name" placeholder="{{$website['search']['search_title']}}" class="f15" id="searchInput">
                                                </div>
                                                <div class="btnBox" onclick="search_info(this)">
                                                    <img src="/assets/d2eace91/images/newhome/search_icon.png">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </li>

                            @foreach($website['menu'] as $k=>$vo)
                                @if(!empty($vo['childMenu']))
                                    <li class="dropdown dd_parent" onclick="javascript:removeclass(this);">
                                        <a href="#" data-toggle="dropdown" class="dropdown-toggle f20">{{$vo['name']}} <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            @foreach($vo['childMenu'] as $ke=>$vo2)
                                                @if($vo2['go_other']==1)
                                                    <li><a href="{{$vo2['other_link']}}" target="_blank" class="f18">&nbsp;&nbsp;{{$vo2['name']}}</a></li>
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
                                        <li><a href="{{$vo['other_link']}}" target="_blank" class="f20">{{$vo['name']}}</a></li>
                                    @elseif($vo['go_other']==2)
                                        <li><a href="?s=index/detail&id={{$vo['other_navbar']}}" target="_blank" class="f20">{{$vo['name']}}</a></li>
                                    @else
                                        <li><a href="/?s=main/guide_page&page_id={{$vo2['id']}}" class="f20">{{$vo['name']}}</a></li>
                                    @endif
                                @endif
                            @endforeach

                            <li>
                                <a href="javascript:connect_kefu();" class="f20" style="margin-right:20px;">在线客服</a>
                            </li>
                            <li>
                                @if(!empty(session('user')))
                                    <style>
                                        .haccount_info{padding: 3px 12px;border-bottom: 1px solid #000;}
                                        .haccount_info p{font-size:15px;margin-bottom:5px;}
                                    </style>
                                    <li class="dropdown dd_parent" onclick="javascript:removeclass(this);">
                                        <a href="#" data-toggle="dropdown" class="dropdown-toggle f20" style="text-transform:unset;">
                                            GoFriend
                                            <b class="caret"></b>
                                        </a>
                                        <ul class="dropdown-menu" style="min-width: 200px;">
                                            <li><a href="//boss.gogo198.cn/?s=index/member_login&shop_uid=<?php echo base64_encode(session('user.user_id'));?>" target="_blank" class="f15" style="@if($_SERVER['REQUEST_URI']=='/?s=index/account_manage')
                                                        background:#000;color:#fff;
                                                @endif">&gt;个人中心</a></li>
                                            <li><a href="/site/logout.html?shop_uid=<?php echo base64_encode(session('user.user_id'));?>" class="f15">&gt;切换账号</a></li>
                                        </ul>
                                    </li>
                                @else
                                    <li class="dropdown dd_parent" onclick="javascript:removeclass(this);">
                                        <a href="/login.html" data-toggle2="dropdown" class="dropdown-toggle f20" style="text-transform:unset;">
                                            注册/登录
                                            <b class="caret"></b>
                                        </a>
                                    </li>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- 菜单栏结束 -->