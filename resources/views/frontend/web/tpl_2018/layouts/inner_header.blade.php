<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]-->
<html xmlns="http://www.w3.org/1999/xhtml">
<html lang="zh-CN">
<head>
    <title>{{ $website['name'] }}</title>
    <!-- 头部元数据 -->
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="Keywords" content="{{ $website['keywords'] }}" />
    <meta name="Description" content="{{ $website['desc'] }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <meta name="format-detection" content="telephone=no">
    <meta name="is_frontend" content="yes" />
    <!-- 网站头像 -->
    {{--    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />--}}
    {{--    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />--}}
    <link rel="icon" type="image/x-icon" href="//shop.gogo198.cn/{{ $website['slogo'] }}" />
    <link rel="shortcut icon" type="image/x-icon" href="//shop.gogo198.cn/{{ $website['slogo'] }}" />
    <!-- #is_wabp_start -->
    <meta name="is_webp" content="no" />

    <style>
        body{overflow-x:hidden;}
        *{font-family: "Microsoft JhengHei", 微軟正黑體, "Arial", sans-serif !important;padding:0;margin:0;}
        a{text-decoration: none;}
        li, ul {padding: 0;margin: 0;list-style: none;}
        .w1200{width: 1200px;margin:0 auto;}
        .f18 {font-size: 18px !important;}
        .f16 {font-size: 16px !important;}
        .f12 {font-size: 12px !important;}
        .disf{display:flex;align-items: center;}

        /**登录弹窗**/
        .layui-layer-page,.layui-layer-loading{top:50% !important;left:50% !important;transform:translate(-50%,-50%);}
    </style>
</head>
<body class="pace-done">
    @include('layouts.header')

    @yield('content')

    <!--右侧滑动-->
{{--    @include('layouts.right_slide')--}}

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
    </script>
</body>
</html>