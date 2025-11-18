
<!DOCTYPE html>
<!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]1-->
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>商家中心</title>
    <!-- 禁止搜索引擎收录 -->
    <meta name="robots" content="noarchive">
    <meta name="baidspider" content="noarchive">
    <meta name="googlebot" content="noarchive">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <meta name="renderer" content="webkit" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link rel="stylesheet" href="/assets/d2eace91/fonts/css/font-awesome.min.css?v=1.2"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/scrollBar/jquery.mCustomScrollbar.css?v=1.2"/>
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/css/bootstrap.min.css?v=1.2"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/animate.css?v=1.2"/>
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/switch/css/bootstrap-switch.min.css?v=1.2"/>
    <link rel="stylesheet" href="/assets/d2eace91/js/chosen/chosen.css?v=1.2"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/common.css?v=1.2"/>
    <link rel="stylesheet" href="/css/seller.css?v=1.2"/>
    <!-- -->
    <link rel="stylesheet" href="/css/mj-style.css?v=1.2"/>
    <!-- ================== END BASE CSS STYLE ================== -->
    <!--[if lt IE 9]>
    <script src="/assets/d2eace91/js/html5shiv.min.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/respond.min.js?v=1.2"></script>
    <![endif]-->
    <!-- ================== BEGIN BASE JS ================== -->
    <script src="/assets/d2eace91/js/jquery.js?v=1.2"></script>
    <!-- 加载Layer插件 -->
    <script src="/assets/d2eace91/js/layer/layer.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=1.2"></script>
    <!-- -->
    <script src="/assets/d2eace91/bootstrap/js/bootstrap.min.js?v=1.2"></script>
    <script src="/assets/d2eace91/bootstrap/switch/js/bootstrap-switch.min.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/scrollBar/jquery.mousewheel.min.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/scrollBar/jquery.mCustomScrollbar.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/chosen/jquery.chosen.js?v=1.3"></script>
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/common.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/jquery.cookie.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/clipboard.min.js?v=1.2"></script>
    <!-- 加载Chosen插件 END-->
    <script src="/js/common.js?v=1.2"></script>
    {{--todo 暂时注释--}}
    <script src="/assets/d2eace91/js/lodop/LodopFuncs.js?v=1.3"></script>
    <script type="text/javascript">
        // 返回顶部js
        $(window).scroll(function() {
            var position = $(window).scrollTop();
            if (position >0) {
                $('.totop').removeClass('bounceOut').addClass('animated bounceIn');
            } else {
                $('.totop').removeClass('bounceIn').addClass('animated bounceOut');
            }
        });

    </script>
    <!-- ================== END BASE JS ================== -->
    <script type="text/javascript">
        $().ready(function() {

            /*弹出消息*/
                    @if(!empty(session('layerMsg')))
            var status = '{{ session()->get('layerMsg.status') }}';
            var msg = '{{ session()->get('layerMsg.msg') }}';
            switch (status) {
                case 'success':
                    $.msg(msg);
                    break;
                case 'error':
                    $.msg(msg, function () {
                        // 关闭后的操作
                    });
                    break;
                case 'info':
                    $.msg(msg)
                    break;
                case 'warning':
                    $.msg(msg, function () {
                        // 关闭后的操作
                    });
                    break;
            }
            // $.msg('设置成功');
            @endif

            $(".totop").click(function() {
                $("html, body").animate({
                    scrollTop: 0
                }, 600);
                return false;
            });
        });
    </script>

    {{--BASE HEADER JS INCLUDE--}}
    @section('header_js')@show

    @section('header_style')@show

</head>
<body>
    @section('style')@show

    @yield('content')
</body>

<script type="text/javascript">
    function toFirst(target){
        var url = $(target).parents("li").find(".left-menu").find("li:first").find("a").attr("href");
        $.go(url);
    }
    function to(url, target){

    }


    function clearCache(){
        // 缓载
        $.loading.start();
        $.post("/site/clear-cache", {}, function(result){
            if(result.code == 0){
                $.msg(result.message);
            }else{
                $.msg(result.message, {
                    time: 5000
                });
            }
        }).always(function(){
            $.loading.stop();
        });
    }
    // 登录成功关闭弹出框
    $.login.success = function(){
        // 关闭并销毁登录窗口
        $.login.close(true);
    }
</script>

<script type="text/javascript">
    // setInterval("auto_print()",10000);
    function auto_print(order_id)
    {
        $.ajax({
            type: "GET",
            url: "/site/auto-print",
            dataType: "json",
            data: {
                order_id: order_id
            },
            success: function(result) {
                if(result.code == 0)
                {
                    lodop_print_html(result.print_title, result.data,result.printer);
                }
            }
        });
    }
</script>

<!-- 加载消息监听js-->
<script src="/assets/d2eace91/js/message/message.js?v=20180710"></script>
<script src="/assets/d2eace91/js/message/messageWS.js?v=20180710"></script>
<script type="text/javascript">

    /*todo 暂时注释*/
    {{--WS_AddUser({--}}
    {{--'user_id': 'shop_2',--}}
    {{--'url': "ws://{{ env('PUSH_DOMAIN') }}:7272",--}}
    {{--'type': "add_user"--}}
    {{--});--}}
    //右下角消息提醒弹窗js
    function open_message_box(data) {
        if (!data) {
            data = {};
        }

        var src = window.location.href;

        // 如果当前框架中的链接地址和弹框的链接地址一致则不弹框
        if(data.auto_refresh == 1 && data.link && src.indexOf(data.link) != -1){

            var contentWindow = window;

            if(contentWindow.tablelist){
                contentWindow.tablelist.load({
                    page: {
                        cur_page: 1
                    }
                });
            }else{
                contentWindow.location.reload();
            }

            return;
        }

        $('.message-pop-box').find('#message-pop-text').html(data.content);

        if(data.link){
            $('.message-pop-box').find('.message-btn').attr('href', data.link).show();
        }else{
            $('.message-pop-box').find('.message-btn').hide();
        }

        if(data.content || data.link){
            $('.message-pop-box').removeClass('down').addClass('up');
        }

        try {
            if(refresh_order && typeof(refresh_order) == "function") {
                refresh_order();
            }
        } catch(e) {}
    }
    $('.message-pop-box .close').click(function() {
        $('.message-pop-box').removeClass('up').addClass('down');
    });
    $('.message-btn').click(function() {
        $('.message-pop-box').removeClass('up').addClass('down');
    });
    //用户信息
    $(".admin").mouseenter(function() {
        window.focus();
        $("#admin-panel").show();
    }).mouseleave(function() {
        $("#admin-panel").hide();
    });
</script>
<script type="text/javascript">
    var clipboard = new Clipboard('.btn-copy');
    clipboard.on('success', function(e) {
        $.msg('复制成功');
    });
    clipboard.on('error', function(e) {
        $.msg('复制失败');
    });
    // 更新后台主框架消息弹窗
    function update_message() {
        // 是否重新获取数据
        if ($("#message-panel").html().length > 0) {
            // if (parseInt($("#counts_all").val()) != 0) {
            var time_step = 5; // 最小刷新间隔，单位：秒
            var this_time = new Date();
            if ((parseInt($("#counts_time").val()) + parseInt(time_step)) > parseInt(this_time.getTime() / 1000)) {
                return true;
            }
            // }
        }
        $.ajax({
            type: 'GET',
            url: '/site/update-message.html',
            data: {},
            dataType: 'json',
            success: function(result) {
                if (result.code == 0) {
                    $("#message-panel").html(result.data);
                } else if (result.code == 1) {
                } else {
                    $.msg(result.message);
                }
            }
        });
    }
    // 消息通知
    $("#message-box .notice-nav-message").click(function() {
        update_message();
        window.focus();
        $(".noticePanel").show();
    });
    $("#notice-close").click(function() {
        $(".noticePanel").hide();
    });
</script>

</html>

