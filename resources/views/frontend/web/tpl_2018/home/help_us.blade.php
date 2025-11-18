@extends('layouts.inner_header')

@section('content')
    <link rel="stylesheet" href="/assets/d2eace91/layui/css/layui.css?v=23121"/>
    <script type="text/javascript" src="/assets/d2eace91/layui/layui.js"></script>
    <link rel="stylesheet" href="/assets/d2eace91/js/layer/theme/default/layer.css?v=3.1.0" id="layuicss-layer">
    <script src="/assets/d2eace91/js/layer/layer.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/jquery.js?v=1.1"></script>

    <style type="text/css" media="all">
        .fa{font-family:FontAwesome !important;}
        .header{border-bottom:3px solid #fff;}
        .footer{border-top:3px solid #fff;}

        .non_topimg{background:{{$website['background']}};}
        .title{font-size:25px;color:{{$website['fontcolor']}};text-align:center;margin-bottom:18px;}

        #content{padding:20px 0;}
        #content .container .content{border: 1px solid {{$website['fontcolor']}};background:{{$website['content']['content']}};padding:30px 20px 60px;box-sizing:border-box;position:relative;margin-top:10px;height:650px;box-shadow: 0px 0px 8px 1px #dfdede;overflow-y:scroll;}
        #content .container .content .in_mask{background-color: #000;opacity: 0;position: absolute;left: 0;top: 0;height: 100%;width: 100%;z-index: 1;}
        #content .container .content .contents{z-index:2;position:relative;color:{{$website['fontcolor']}};font-size: 20px;}
        #content .container{padding-bottom:0px;}
        #content .color_word{font-size:15px;padding: 15px 10px;box-sizing:border-box;}

        .contents img{width:100%;}
        .content{position: relative;}

        @media (min-width: 993px) {
            .contents img{width:500px;}
        }
        @media (min-width: 1000px){
            #content .container{padding-top:30px;}
            #content{padding-top:0;margin:0;}
            .main_img,.color_word{width:400px;height:280px;text-align:center;margin:20px auto;}
        }
        @media (max-width: 992px){
            .main_img,.color_word{width:100%;height:250px;text-align:center;margin:20px auto;}
            .color_word{padding:30px;box-sizing:border-box;}
            .detail_topimg, .non_topimg{margin-top:85px;}
            .title{line-height: 30px;}
        }
        .need_service,.need_share,.need_advice{padding:7px 10px;box-sizing:border-box;font-size:15px;font-weight:800;box-shadow:1px 1px 10px #333;text-align:center;/* margin-top:15px; */border:1px solid #D2A778;color:#ffffff;background:#0B2074;white-space:nowrap;}

        .detail_container .row .about-logo *{background:#666666 !important;font-size:16px;}
        .detail_container .row .about-logo img{box-shadow:1px 1px 15px #000;}

        /*.box_content a:nth-of-type(1){display:none;}*/
        .box_content a:nth-of-type(2){display:none;}
        a{color:{{$website['fontcolor']}};}
        .navbar_menu{color:{{$website['fontcolor']}};font-size:16px;}
        .navbar_menu a{color:{{$website['fontcolor']}};}
        .navbar_menu a:last-child{color:#D2A778;font-weight:700;}
        .page_box{padding:10px 0;box-sizing: border-box;justify-content: space-between;color:{{$website['fontcolor']}};padding-bottom:0;}
        .page_box a{color:{{$website['fontcolor']}};}

        .footer ul.social-network li{height:24px !important;}
    </style>

    <section id="content" class="non_topimg">
        <div class="w1200">
            <div class="container detail_container">
                <p class="navbar_menu"><i class="fa fa-sign-in" style="margin-right:5px;display:none;"></i><a href="/">HOME</a>&nbsp;<span style="color:{{$website['fontcolor']}};">\</span>&nbsp;帮助中心</p>
                {{--                <hr style="border-top:1px solid #fff;">--}}
            </div>
            <div class="container" style="padding-top:0;">
                <div class="title">帮助中心</div>
                <div class="content" >
                    {{--                    <div class="in_mask"></div>--}}
                    <div class="contents">{!! $website['content']['help'] !!}</div>
                </div>
            </div>
        </div>
    </section>
@stop