@extends('layouts.user_layout')

{{--header_css--}}
@section('header_css')
    <link rel="stylesheet" href="/css/user.css?v=20190215"/>

@stop

{{--header_js--}}
@section('header_js')

@stop

@section('content')


    <header class="header-top-nav">
        <div class="header">
            <div class="header-left">
                <a class="sb-back" href="javascript:history.back(-1);" title="返回">
                    <i class="iconfont">&#xe606;</i>
                </a>
            </div>
            <div class="header-middle">订单列表</div>
            <div class="header-right">

                <i class="search-btn iconfont">&#xe600;</i>

            </div>
        </div>
    </header>
    <div class="order-box" id="order-box">
        <ul class="order-list-top clearfix tabmenu-new">
            <li>
                <a href="javascript:void(0)" id='order_all' class="tabs- on">
                    全部
                    <!-- (0) -->
                </a>
            </li>
            <li>
                <a href="javascript:void(0)" id='order_unpayed' class="tabs- ">
                    待付款
                    <!-- (0) -->
                </a>
            </li>
            <li>
                <a href="javascript:void(0)" id='order_unshipped' class="tabs- ">
                    待发货
                    <!-- (0) -->
                </a>
            </li>
            <li>
                <a href="javascript:void(0)" id='order_shipped' class="tabs- ">
                    待收货
                    <!-- (0) -->
                </a>
            </li>
            <li>
                <a href="javascript:void(0)" id='order_unevaluate' class="tabs- ">
                    待评价
                    <!-- (0) -->
                </a>
            </li>
        </ul>

        <div class="order-center-content" id="table_list">

            <div class="no-data-div">
                <div class="no-data-img">
                    <img src="/images/bg_empty_data.png" />
                </div>
                <dl>
                    <dt>一个订单都没有哦</dt>
                </dl>
                <a href="/" class="no-data-btn">去购物</a>
            </div>

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
        </script></div>

    <!--底部菜单 start-->
    <div id="batch_btn" class="hide">
        <div class="detail-dowm order-handle">
            <label class="input-label">
                <input class="checkBox checkbox-all" type="checkbox" />
                全选
            </label>
            <div class="operate">
                <a href="javascript:void(0)" class="btn" onclick="order_deletes(1)">批量删除订单</a>
            </div>
            <div class="operate" id="merge_pay_btn" style="display: none">
                <a href="javascript:void(0)" class="btn" onClick="order_merge_pay(1)">合并付款</a>
            </div>
        </div>
    </div>
    <!--点击取消按钮弹出框-->
    <div class="mask-div" style="display: none;"></div>
    <div class="f-block-box" id="affirm_info" style="height: 0; overflow: hidden;">加载中...</div>
    <div id="search-orderList">
        <div class="user-search-header ub">
            <div class="search-left">
                <a href="javascript:void(0)" class="sb-back" title="返回"></a>
            </div>
            <div class="order-search ub-f1">
                <form id="searchForm" name="searchForm" action="/user/order/list.html" method="GET">
                    <input id='name' type="search" name="name" value="" placeholder='输入商品标题或订单号'>

                    <input id='order_status' type='hidden' value='' name='order_status'>

                    <input id='evaluate_status' type='hidden' value='' name='evaluate_status'>

                    <span class="num-clear hide">
				<i class="iconfont">&#xe621;</i>
			</span>

                </form>		</div>
            <div class="search-right">
                <a href="javascript:void(0)" class="clear_input submit" id="searchFormSubmit" style="display: block;">搜索</a>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        // 滚动加载数据
        $(window).on('scroll', function() {
            if ($(document).scrollTop() + $(window).height() > $(document).height() - 100) {
                if($.isFunction($.pagemore)){
                    $.pagemore({
                        callback: function(result) {
                            $('.checkbox-all').prop("checked", false).attr("checked", false);;
                        }
                    });
                }
            }
        });
    </script>
    <!-- 再次购买弹出层_start -->
    <!--订单再次购买无货弹出框-->
    <div id="again_buy_container" class="layer-order-soldout">
        <div class="order-soldou-mask"></div>
        <div class="order-soldout-con">
            <p class="title">以下商品库存不足，先将其他有货的商品加入购物车</p>
            <ul>
                <!-- <li>
                    <div class="good-pic"><img src="" /></div>
                    <div class="good-info"><div class="good-name">【闪电发货服务】虚拟服务 非实物 勿拍 红色【闪电发货服务】虚拟服务 非实物 勿拍 红色</div></div>
                </li> -->
            </ul>
            <div class="order-soldout-bottom ub bdr-top">
                <a class="btn cancel">取消</a>
                <a class="btn bg-color again-buy" data-order_id="" data-sku_ids="">加入购物车</a>
            </div>
        </div>
    </div><!-- 再次购买弹出层_end -->
    <script type="text/javascript">
        var scrollheight = 0;
        function close_choose() {
            $(".mask-div").hide();
            $('#affirm_info').hide();
            $('.pop-up-content').hide();
            $('.pop-up-content').removeAttr('style');
            $("body").css("top","auto");
            $("body").removeClass("visibly");
            $(window).scrollTop(scrollheight);
        }
    </script>
    <script type="text/javascript">
        $().ready(function() {
            $("body").on("click", ".edit-order", function() {
                var type = $(this).data("type");
                var id = $(this).data("id");
                $.loading.start();

                $.get('/user/order/edit-order?from=list',{
                    type: type,
                    id: id
                },function(result){
                    $.loading.stop();
                    if(result.code == 0){
                        $("#affirm_info").html(result.data);
                        $("#affirm_info").show();
                        $(".mask-div").show();
                        $('.pop-up-content').show();
                        scrollheight = $(document).scrollTop();
                        var yScroll = $(document).scrollTop()-103;
                        $("body").css("top", "-" + scrollheight + "px");
                        $('.pop-up-content').css('margin-top',yScroll);
                        $("body").css("top","-" + scrollheight+"px");
                        $("body").addClass("visibly");
                    }else{
                        $.msg(result.message,{
                            time: 3000
                        });
                    }
                },'json');

            });

            $("body").on("click", ".to-pay", function() {
                var order_id = $(this).data("id");
                $.loading.start();
                $.post('/user/order/to-pay.html',{
                    order_id: order_id
                },function(result){
                    $.loading.stop();
                    if (result.code == 0){
                        $.go(result.url);
                    }else{
                        $.msg(result.message,{
                            time: 3000
                        })
                    }
                },'json');
            });
            // 点击再次购买
            $('body').on('click','.again-buy',function(){
                if($(this).hasClass('disable')){
                    return false;
                }
                var order_id = $(this).data('order_id');
                var sku_ids =  $(this).data('sku_ids');
                $.loading.start();
                $.post('/user/order/again-buy.html',{
                    order_id : order_id,
                    sku_ids : sku_ids
                },function(result){
                    $.loading.stop();
                    if(result.code == 0){
                        if(result.message){
                            $.msg(result.message, {
                                time: 2000,
                                icon_type: 1
                            }, function() {
                                $.go('/cart.html');
                            });
                        }else{
                            $.go('/cart.html');
                        }

                    }else{
                        if(result.message){
                            $.msg(result.message,{
                                time: 3000
                            });
                        }
                        if(result.invalid_list != undefined && result.invalid_list.length > 0){
                            $('#again_buy_container ul').html('');
                            $('#again_buy_container .title').html(result.title);
                            $.each(result.invalid_list,function(i,v){
                                $('#again_buy_container ul').append('<li data-sku_id='+v.sku_id+'><div class="good-pic"><img src="'+v.goods_image+'" /></div><div class="good-info"><div class="good-name">'+v.sku_name+'</div></div></li>');
                            });
                            $('#again_buy_container').find('.again-buy').attr('data-order_id',order_id);
                            $('#again_buy_container').find('.again-buy').attr('data-sku_ids',result.sku_ids);
                            if(result.sku_list == null){
                                $('#again_buy_container').find('.again-buy').addClass('disable');
                            }else{
                                $('#again_buy_container').find('.again-buy').removeClass('disable');
                            }
                            $('#again_buy_container').addClass('show');
                        }
                    }
                },'JSON');
            });
            // 再次购买取消
            $('#again_buy_container').find('.cancel').click(function(){
                $('#again_buy_container').removeClass('show');
            });
            // 再次购买商品链接跳转
            $('#again_buy_container ul').on('click', 'li', function(){
                $.go('/'+$(this).data('sku_id'));
            });

            $(".pickup-address").click(function(){
                var id = $(this).data("id");
                $.get('/user/order/get-pickup-address',{
                    id:id
                },function(result){
                    if(result.data.address_lng && result.data.address_lat){
                        var url = '/index/information/amap?dest=' + result.data.address_lng + ',' + result.data.address_lat + '&title=' + result.data.pickup_name;
                        $.go(url);
                    }
                },'json');
            });

        });
        //滑动触发
        try {
            document.createEvent("TouchEvent");
            document.getElementById("maskdiv").addEventListener('touchmove', function(event) {
                close_choose();
            }, false);

            $('.mask-div').click(function(){
                close_choose();
            });
        } catch (e) {
            $('.mask-div').click(function(){
                close_choose();
            });
        }

    </script>

    <script type="text/javascript">
        var tablelist = null;
        $().ready(function() {
            tablelist = $("#table_list").tablelist({
                params: $("#searchForm").serializeJson(),
            });
        });

        $("#searchFormSubmit").click(function() {
            $("#searchForm").submit();
        });

        $("a[class^='tabs-']").click(function() {
            $.loading.start();
            $("a[class^='tabs-']").removeClass('on');
            $(".user-statu").removeClass('active');
            $(this).addClass('on');
            $(this).parent(".user-statu").addClass('active');

            if ($(this).attr("id") == "order_all") {
                $("#order_status").val("all");
                $("#evaluate_status").val("all");
            } else if ($(this).attr("id") == "order_unevaluate") {
                $("#evaluate_status").val($(this).attr("id").substr(6));
                $("#order_status").val("all");
            } else {
                $("#order_status").val($(this).attr("id").substr(6));
                $("#evaluate_status").val("all");
            }

            if($(this).attr("id") == 'order_all' ||  $(this).attr("id") == 'order_unpayed'){
                $('#merge_pay_btn').show();
            }else{
                $('#merge_pay_btn').hide();
            }

            var params = $("#searchForm").serializeJson();
            var params_str = '';
            $.each(params, function(i, v) {
                params_str = params_str + '&' + i + '=' + v;
            });
            var url = location.href;
            url = url.split('?')[0];
            if (url.indexOf("?") == -1) {
                params_str = params_str.replace(/&/, "?");
            }
            url = url + params_str;

            params.page = {
                cur_page: 1,
            };
            params.go = 1;
            tablelist.load(params,function(res){
                $('html,body').scrollTop(0);
                if(res.count == 0){
                    $('#batch_btn').hide();
                }else{
                    $('#batch_btn').show();
                }
                history.replaceState({}, '', url);
            });
        });
        function order_delete(order_id, type)
        {
            var text = "";
            var url = "/user/order/list.html";
            if (type == 2)
            {
                text = "您确定要彻底删除该订单吗？";
                url += "?is_delete=1";
            }
            else if (type == 1)
            {
                text = "您确定要删除该订单吗？";
            }
            else
            {
                text = "您确定要还原该订单吗？";
                url += "?is_delete=1";
            }

            $.confirm(text, function() {
                $.loading.start();
                $.ajax({
                    type: 'POST',
                    url: '/user/order/delete.html',
                    data: {
                        order_id: order_id,
                        type: type,
                    },
                    dataType: 'json',
                    success: function(data) {
                        tablelist.load();
                        $.msg(data.message);
                        /**
                         if (data.code == 0)
                         {
						$('#order_list_'+order_id).remove();
						if($('#table_list').find('.order-list').length == 0){
							window.location.reload();
						}
    				}
                         **/
                    }
                }).always(function(){
                    $.loading.stop();
                });
            },function(index){
                layer.close(index);
            });
        }


        function order_deletes(type) {
            var order_ids = document.getElementsByName("order_delete");
            var order_id = new Array();

            for (var i = 0; i < order_ids.length; i++) {
                if (order_ids[i].checked == true) {
                    order_id[i] = order_ids[i].value;
                }
            }

            if (order_id.length <= 0) {
                $.msg("请勾选待删除订单！");
                return false;
            }

            $.loading.start();
            $.ajax({
                type: 'POST',
                url: '/user/order/delete.html',
                data: {
                    order_id: order_id,
                    type: 3,
                },
                dataType: 'json',
                success: function(data) {
                    var text = "";
                    var url = "/user/order/list.html";
                    if (type == 2)
                    {
                        text = "您确定要批量彻底删除这些订单吗？";
                        url += "&is_delete=1";
                    }
                    else if (type == 1)
                    {
                        text = data.message;
                    }
                    else
                    {
                        text = "您确定要批量还原这些订单吗？";
                        url += "&is_delete=1";
                    }

                    $.confirm(text, {
                        skin: 'layer-ext-moon',
                    },function(index){
                        if (data.code == 0)
                        {
                            $.loading.start();
                            $.ajax({
                                type: 'POST',
                                url: '/user/order/delete.html',
                                data: {
                                    order_id: order_id,
                                    type: type,
                                },
                                dataType: 'json',
                                success: function(data) {
                                    if (data.code == 0)
                                    {
                                        tablelist.load();
                                        $.msg(data.message);
                                    }else{
                                        $.msg(data.message);
                                    }
                                }
                            }).always(function(){
                                $.loading.stop();
                            });
                        }
                        else{
                            layer.close(index);
                        }
                    },function(index){
                        layer.close(index);
                    });
                }
            }).always(function(){
                $.loading.stop();
            });
        }

        // 
    </script>

    <script type="text/javascript">

        if($('.table-list-checkbox').size() == $(".table-list-checkbox:checked").size()){

            $('.checkbox-all').prop("checked", true).attr("checked", true);
        }else{
            $('.checkbox-all').prop("checked", false).attr("checked", false);
        }

        $('.table-list-checkbox').click(function(){
            if($(this).is(":checked")){
                $(this).attr("checked", true);
            }else{
                $(this).attr("checked", false);
            }

            if($('.table-list-checkbox').size() == $(".table-list-checkbox:checked").size()){

                $('.checkbox-all').prop("checked", true).attr("checked", true);
            }else{
                $('.checkbox-all').prop("checked", false).attr("checked", false);
            }
        });

        $('.checkbox-all').click(function(){
            if($(this).is(":checked")){
                $(this).attr("checked", true);
                $('.table-list-checkbox').prop("checked", true);
            }else{
                $(this).attr("checked", false);
                $('.table-list-checkbox').prop("checked", false);
            }
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