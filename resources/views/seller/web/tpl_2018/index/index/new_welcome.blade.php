{{--模板继承--}}
@extends('layouts.new_seller_layout')

{{--css style page元素同级上面1--}}
@section('style')
    <!-- 卖家中心首页样式 -->
    <link rel="stylesheet" href="/css/index.css?v=4.0"/>
    <!-- 图表 -->
    <script src="/js/chart.js?v=20190110"></script>
    <script src="/js/chart-data.js?v=20190110"></script>
@stop

{{--content--}}
@section('content')
    <style>
        .page{padding:0;height:100%;}
        body{overflow:hidden;}
        .f14{font-size: 14px;}
        .f15{font-size: 15px;}
        .f16{font-size: 16px;}
        .page{width:100%;}
        .left{background:#cdc4c4;height: 100%;position:absolute;border-right:1px solid #847f7f;}
        .left .logo{padding:40px 10px 10px 10px;box-sizing:border-box;}
        .left .logo img{width:100%;}
        .left .fold{position:absolute;top:7px;right:15px;}
        .left .fold img{width:20px;height:20px;cursor:pointer;}
        .left .menu{border-top: 1px solid #847f7f;height:90%;}
        .left1{display:block;width:200px;}
        .left2{display:none;width:45px;}
        .menu ul{list-style:none;margin:0px;padding:0px;}
        .menu .menu_li{margin-left:10px;position:relative;font-size:14px;}
        .menu ul li{margin-left:35px;position:relative;}
        .menu_ul2:before{content: '';width: 1px;height: 90%;background: #847f7f;position: absolute;left: 7px;top: 23px;}
        .menu_ul2 li:before{content:'';width:1px;height:30px;background:#847f7f;position:absolute;left:-10px;}
        .menu_ul2 li:after{content:'';width:8px;height:1px;background:#847f7f;position:absolute;left:-10px;top:15px;}
        .menu_ul .menu_li:before{content: '';width: 1px;height: 15px;background: #847f7f;position: absolute;left: 7px;top: 23px;}
        .menu_ul .menu_li:nth-of-type(5):before{content: '';width: 1px;height: 0px;background: #847f7f;position: absolute;left: 7px;top: 23px;}
        .menu ul li a{display:block;height:30px;width:80px;line-height:30px;text-decoration:none;padding-left:0;white-space: nowrap;}
        .menu .no{display:none;}
        .menu .yes{display:block;}
        /*.page{background:url("../img/page.png") no-repeat left center;}*/
        .menu .plus{background:url("https://gather.gogo198.cn/centralize_manager/plus.png") no-repeat left center;background-size:15px;padding-left:20px;}
        .menu .minus{background:url("https://gather.gogo198.cn/centralize_manager/minus.png") no-repeat left center;background-size:15px;padding-left:20px;}

        .right{width:calc(100% - 201px);position:absolute;left:201px;height:100%;text-align:left;}
        .menu_label{border:1px solid #847f7f;border-left:0;height:30px;background:#cdc4c4;
            /**-ms-overflow-style: none;overflow: -moz-scrollbars-none;**/display: flex;align-items: center;padding:0 10px;box-sizing:border-box;}
        .left_label{width:97%;display: flex;align-items: center;overflow:auto;white-space:nowrap;padding-top:5px;box-sizing:border-box;}
        .right_label{width:3%;font-size:20px;font-weight:600;cursor:pointer;text-align:center;}
        /*.menu_label::-webkit-scrollbar { width: 0!important; }*/
        .menu_label .label_box{border:1px solid #797676;width:fit-content;height:100%;display:inline-block;padding: 0 12px;box-sizing:border-box;cursor:pointer;border-top-left-radius: 30px;border-top-right-radius: 7px;}
        .menu_label .menu_label_active{background:#fff;font-weight:600;border-bottom:1px solid #fff;}
        .menu_body{width:100%;height:calc(100% - 32px);}
        .menu_body .child_box{display:none;width:100%;height:100%;}
        .menu_body .child-show{display:block;}

        /*账户信息*/
        .accountDiv{position:relative;}
        .accountDiv .dropdown-toggle{margin-left:5px;display: block;}
        .accountDiv .dropdown-toggle .caret{border-bottom-color: #000000;border-top-color: #000000;display: inline-block;width: 0;height: 0;margin-left: 2px;vertical-align: middle;border-top: 4px solid;border-right: 4px solid transparent;border-left: 4px solid transparent;}
        .accountDiv .account_info{display: none;background:#fff;padding:10px 0;box-sizing: border-box;margin-top:5px;}
        .accountDiv .account_info p{margin-bottom:5px;}
        .accountDiv .account_info li{padding: 3px 12px;border-bottom: 1px solid #000;}
        .accountDiv .account_info .account_opera{cursor:pointer;}

        @media screen and (max-width:768px) {
            .left1{width:120px;}
            .left2{width:45px;}
            .right{width:calc(100% - 121px);left:121px;}
            .left_label{width:90%;}
            .right_label{width:10%;}
        }
        .layui-card-body{background:#e0d7d7 !important;}
    </style>
    <script src="/assets/d2eace91/js/jquery.min.js"></script>
    <script src="/assets/d2eace91/layui/layui.js"></script>
    <script>
        layui.config({
            base: '/layuiadmin/' //静态资源所在路径
        }).extend({
            index: 'lib/index' //主入口模块
        }).use(['index'], function(){
            var $ = layui.$
                ,admin = layui.admin
                , layer = layui.layer;
        });

        $(function(){
            //账户信息点击
            $('.dropdown').click(function(){
                if($(this).parent().find('.account_info').css('display')=='block'){
                    $(this).parent().find('.account_info').hide();
                }else{
                    $(this).parent().find('.account_info').show();
                }
            });

            $(".menu_li").each(function(){
                if($(this).children("ul").length>0)//判断li下是否有ul列表
                {
                    //如果有隐藏ul，添加样式
                    $(this).children("ul").eq(0).css("display","none");
                    $(this).children("a").first().addClass("plus");
                    //点击一级列表
                    $(this).find(".menu_a").click(function(){
                        //判断ul是否隐藏
                        if($(this).parent().children("ul").first().css("display")=="none")
                        {
                            $(this).parent().children("ul").first().css("display","block");
                            $(this).removeClass();
                            $(this).addClass("minus");
                        }
                        else{
                            $(this).parent().children("ul").first().css("display","none");
                            $(this).removeClass();
                            $(this).addClass("plus");
                        }
                    });
                }
            });

            //左侧菜单点击添加
            // var menu_index=1;
            $('.menu_li2').click(function(){
                let text = $(this).text();
                text = text.replace(">","");
                let href = $(this).attr('data-href');
                let menu_index = $(this).attr('data-idx');

                let all_text = $('.menu_label').find('.left_label').find('.label_box').text();

                if(all_text.indexOf(text)!=-1){
                    $('.menu_label'+menu_index).siblings().removeClass('menu_label_active');
                    $('.menu_label'+menu_index).removeClass('menu_label_active');
                    $('.menu_label'+menu_index).addClass('menu_label_active');
                    // $('.menu_body').find('.child_box').hide();
                    $('.menu_body').find('.child_body'+menu_index).siblings().hide();
                    $('.menu_body').find('.child_body'+menu_index).show();
                }else{
                    if(href.includes('https://') || href.includes('http://')){
                        //如有https的链接则另窗打开，并附带商户
                        if(href.includes('?')){
                            href += '&uid=<?php echo base64_encode(Session('shopping_user.user_id'));?>';
                        }else{
                            href += '?uid=<?php echo base64_encode(Session('shopping_user.user_id'));?>';
                        }
                        // const windowFeatures = 'menubar=no,toolbar=no,location=no,status=no,resizable=yes,scrollbars=yes,width=800,height=600';
                        // window.open(href, '_blank', windowFeatures);
                        window.open(href,'_blank');
                        return false;
                    }
                    let html = '<div class="label_box menu_label'+menu_index+' menu_label_active" data-index="'+menu_index+'" onclick="change_menu(this,'+menu_index+')">'+text+'</div>';
                    $('.menu_label').find('.left_label').find('.label_box').removeClass('menu_label_active');
                    $('.menu_label').find('.left_label').append(html);
                    $('.menu_body').find('.child_box').hide();
                    let mb = '<div class="child_box child_body'+menu_index+' child-show">\n'+
                        '<iframe src="'+href+'" width="100%" height="100%">\n'+
                        '</iframe>\n'+
                        '</div>';
                    $('.menu_body').find('.child_box').removeClass('child-show');
                    $('.menu_body').append(mb);
                    //   menu_index = parseInt(menu_index) + 1;
                }
            });

            $('.right_label').click(function(){
                let idx = $('.menu_label_active').attr('data-index');
                let before_idx = $('.menu_label_active').prev().attr('data-index');

                if(typeof(before_idx)=='undefined'){
                    before_idx = $('.menu_label_active').next().attr('data-index');
                }
                $('.menu_label'+before_idx).addClass('menu_label_active');
                $('.child_body'+before_idx).show();
                $('.menu_label'+idx).remove();
                $('.child_body'+idx).remove();

            });
        });

        //更换菜单显示
        function change_menu(t,idx){
            $(t).siblings().removeClass('menu_label_active');
            $(t).removeClass('menu_label_active');
            $(t).addClass('menu_label_active');
            $('.menu_body').find('.child_body'+idx).siblings().hide();
            $('.menu_body').find('.child_body'+idx).show();
        }

        //折叠菜单操作
        function fold(sta){
            // let sta = $(this).attr('data-status');
            var mobile = isMobile();
            if(sta==1){
                $('.left2').show();
                $('.left1').hide();

                if( mobile == true )
                {
                    $('.right').css({'width':'calc(100% - 46px)','left':'46px'});
                }else{
                    $('.right').css({'width':'calc(100% - 46px)','left':'46px'});
                }

                // $('.right').animate({'left':'61px'},'normal').css('width','calc(100% - 61px)');
            }else if(sta==2){
                $('.left2').hide();
                $('.left1').show();
                if( mobile == true )
                {
                    $('.right').css({'width':'calc(100% - 121px)','left':'121px'});
                }else{
                    $('.right').css({'width':'calc(100% - 201px)','left':'201px'});
                }
                // $('.right').animate({'left':'201px'},'normal').css('width','calc(100% - 201px)');
            }

        }

        function isMobile() {
            var userAgentInfo = navigator.userAgent;
            var mobileAgents = [ "Android", "iPhone", "SymbianOS", "Windows Phone", "iPad","iPod"];
            var mobile_flag = false;
            //根据userAgent判断是否是手机
            for (var v = 0; v < mobileAgents.length; v++) {
                if (userAgentInfo.indexOf(mobileAgents[v]) > 0) {
                    mobile_flag = true;
                    break;
                }
            }
            var screen_width = window.screen.width;
            var screen_height = window.screen.height;
            //根据屏幕分辨率判断是否是手机
            if(screen_width < 500 && screen_height < 800){
                mobile_flag = true;
            }
            return mobile_flag;
        }
    </script>
    <div class="page">
        <div class="left left1">
            <div class="logo">
                <div class="fold" data-status="1" onclick="fold(1)"><img src="https://b.gogo198.cn/centralize_manager/pick_off.png" class="fold_operation"></div>
                <div><img src="https://b.gogo198.cn/operation/images/logo.png"></div>
            </div>
            <div class="menu">
                <ul class="menu_ul" style="overflow-y:scroll;">
                    @foreach($menu as $k=>$v)
                        <!--普通成员-->
{{--                        if(strstr($level['authList'],strval($v['id']))) <!--当前商户存在这个功能列表才显示这个-->--}}
                            <li class="menu_li">
                                <a href="javascript:void(0);" class="menu_a">{{$v['title']}}</a>
                                <ul class="menu_ul2">
                                    @foreach($v['children'] as $k2=>$v2)
{{--                                        if(strstr($level['authList'],strval($v2['id']))) <!--当前商户存在这个功能列表才显示这个-->--}}
                                            <li><a href="javascript:;" data-href="{{$v2['url']}}" data-idx="{{$v2['id']}}" class="menu_li2">{{$v2['title']}}</a></li>
{{--                                        endif--}}
                                    @endforeach
                                </ul>
                            </li>
{{--                        endif--}}
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="left left2">
            <div class="logo">
                <div class="fold" data-status="2" onclick="fold(2)"><img src="https://b.gogo198.cn/centralize_manager/pick_up.png" class="fold_operation"></div>
            </div>
        </div>
        <div class="right">
            <div class="menu_label">
                <div class="left_label"></div>
                <div class="right_label" title="删除当前标签页">×</div>
            </div>
            <div class="menu_body">

            </div>
        </div>
    </div>
@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block--}}
@section('extra_html')

@stop


{{--helper_tool--}}
@section('helper_tool')

@stop

{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <div class="clear"></div>
    <script type="text/javascript">
        $('#shopshow').click(function() {
            if ($(this).hasClass('fa-eye')) {
                $(this).removeClass('fa-eye').addClass('fa-eye-slash');
                $(this).parents().find('.shop-body').addClass('hide');
                $(this).attr("title","点此显示店铺信息");
            } else {
                $(this).addClass('fa-eye').removeClass('fa-eye-slash');
                $(this).parents().find('.shop-body').removeClass('hide');
                $(this).attr("title","点此隐藏店铺信息");
            }
        });
    </script>
    <script type="text/javascript">
        $().ready(function() {
            radialIndicator.defaults.barColor = {
                100: '#F47171',
                200: '#FF9162',
                300: '#FFFF75',
                400: '#21BCFE',
                500: '#4ED89D'
            };
            radialIndicator.defaults.minValue = 0;
            radialIndicator.defaults.maxValue = 500;
            radialIndicator.defaults.format = '#.##分';

            $('#container1').radialIndicator({
                initValue: 475
            });
            $('#container2').radialIndicator({
                initValue: 492
            });
            $('#container3').radialIndicator({
                initValue: 492
            });
            $('#container4').radialIndicator({
                initValue: 486.33333333333
            });
        });
    </script>
    <!-- ECharts单文件引入 -->
    <script src="/assets/d2eace91/js/echarts/echarts-all.js?v=20190110"></script>
    <script type="text/javascript">
        $().ready(function() {
            // 基于准备好的dom，初始化echarts图表
            var myChart = echarts.init(document.getElementById('sales_div'));
            var option = {
                tooltip: {
                    show: true
                },
                legend: {
                    data: ['订单金额']
                },
                xAxis : [
                    {
                        type : 'category',
                        data : ["01\u670803\u65e5","01\u670804\u65e5","01\u670805\u65e5","01\u670806\u65e5","01\u670807\u65e5","01\u670808\u65e5","01\u670809\u65e5","01\u670810\u65e5","01\u670811\u65e5","01\u670812\u65e5"],
                        axisLine: {  // 控制x轴线的样式
                            lineStyle: {
                                type: 'solid',
                                color: '#666',
                                width:'1' }
                        }
                    }
                ],
                yAxis : [
                    {
                        type : 'value',
                        axisLine: {  // 控制y轴线的样式
                            lineStyle: {
                                type: 'solid',
                                color: '#666',
                                width:'1' }
                        },
                        axisLabel: {

                            formatter: '{value} 元'

                        }
                    }
                ],
                series : [
                    {
                        "name":"订单金额",
                        "type":"bar",
                        "data":[0,0,0,0,0,0,0,0,300,0],
                    }
                ]
            };

            // 为echarts对象加载数据
            myChart.setOption(option);
        });
    </script>
    <script type="text/javascript">
        $().ready(function() {
            // 基于准备好的dom，初始化echarts图表
            var myChart = echarts.init(document.getElementById('customer_div'));
            option = {
                tooltip: {
                    trigger: 'item',
                },
                color:['#FF7D43','#FCB747','#97DA67','#46CECE','#B48FC2','#FF726A','#49CDFF'],
                legend: {
                    orient: 'horizontal',
                    top:'0%',
                    right:'0%',
                    x: 'left',
                    bottom: 20,
                    formatter: function (name) {
                        return (name.length > 7 ? (name.slice(0,7)+"...") : name );
                    },
                    data:["\u666e\u901a\u4f1a\u5458\uff08VIP1\uff09","\u7279\u6b8a\u4f1a\u5458","\u94bb\u77f3\u4f1a\u5458"]
                },
                calculable: true,
                series : [
                    {
                        name: '客户等级',
                        type: 'pie',
                        radius: ['40%', '50%'],
                        itemStyle: {
                            normal: {
                                label: {
                                    show: false
                                },
                                labelLine: {
                                    show: false
                                }
                            },

                            emphasis: {
                                label: {
                                    show: true,
                                    position: 'center',
                                    textStyle: {
                                        fontSize: '13',
                                        fontWeight: '300'
                                    }
                                }
                            }
                        },
                        data:[{"name":"\u666e\u901a\u4f1a\u5458\uff08VIP1\uff09","value":"3"},{"name":"\u7279\u6b8a\u4f1a\u5458","value":"0"},{"name":"\u94bb\u77f3\u4f1a\u5458","value":"3"}]
                    }
                ]
            };

            // 为echarts对象加载数据
            myChart.setOption(option);
        });
    </script>
    <script type="text/javascript">
        $().ready(function() {
            $.ajax({
                url: '/index/index/get-data',
                dataType: 'json',
                success: function(data) {
                    // 出售中的商品
                    $("#onsale_goods_count").html(data.onsale_goods_count);
//				if(data.onsale_goods_count == 0) {
//					$("#onsale_goods_count").parent().removeClass("number");
//				}
                    // 仓库中的商品
                    $("#offsale_goods_count").html(data.offsale_goods_count);
//				if(data.offsale_goods_count == 0) {
//					$("#offsale_goods_count").parent().removeClass("number");
//				}
                    // 等待审核的商品
                    $("#wait_audit_goods_count").html(data.wait_audit_goods_count);
//				if(data.wait_audit_goods_count == 0) {
//					$("#wait_audit_goods_count").parent().removeClass("number");
//				}
                    // 违规下架的商品
                    $("#illegal_goods_count").html(data.illegal_goods_count);
//				if(data.illegal_goods_count == 0) {
//					$("#illegal_goods_count").parent().removeClass("number");
//				}
                    // 待付款订单
                    $("#unpayed_order_count").html(data.unpayed_order_count);
                    if(data.unpayed_order_count == 0) {
                        $("#unpayed_order_count").removeClass("active");
                    }
                    // 待发货订单
                    $("#unshipping_order_count").html(data.unshipping_order_count);
                    if(data.unshipping_order_count == 0) {
                        $("#unshipping_order_count").removeClass("active");
                    }
                    // 待评价订单
                    $("#unevaluate_order_count").html(data.unevaluate_order_count);
                    if(data.unevaluate_order_count == 0) {
                        $("#unevaluate_order_count").removeClass("active");
                    }
                    // 退款中订单
                    $("#backing_order_count").html(data.backing_order_count);
                    if(data.backing_order_count == 0) {
                        $("#backing_order_count").removeClass("active");
                    }
                    // 售后中订单
                    // $("#sercive_order_count").html(data.sercive_order_count);
                    //  售后退款订单
                    $("#after_sale_order_count").html(data.after_sale_order_count);
                    if(data.after_sale_order_count == 0) {
                        $("#after_sale_order_count").removeClass("active");
                    }
                    // 换货维修订单
                    $("#exchange_order_count").html(data.exchange_order_count);
                    if(data.exchange_order_count == 0) {
                        $("#exchange_order_count").removeClass("active");
                    }
                    // 待处理的投诉
                    $("#wait_complaint_count").html(data.wait_complaint_count);
                    if(data.wait_complaint_count == 0) {
                        $("#wait_complaint_count").removeClass("active");
                    }
                    // 平台介入的投诉
                    $("#involve_complaint_count").html(data.involve_complaint_count);
                    if(data.involve_complaint_count == 0) {
                        $("#involve_complaint_count").removeClass("active");
                    }
                    // 今日收益
                    $("#today_gains").html("<em>￥</em>" + data.today_gains);
                    // 今日订单
                    $("#today_order_count").html(data.today_order_count);
                    // 今日添加会员
                    $("#today_users_count").html(data.today_users_count);
                }
            });
        });
    </script>
    <script type="text/javascript">
        $().ready(function() {
            $("[data-toggle='popover']").popover();

            // 查看详情
            $("body").on("click", ".link", function() {
                var msg_id = $(this).data("msg-id");
                $.open({
                    title: "站内信",
                    ajax: {
                        url: "/shop/message/view",
                        data: {
                            msg_id: msg_id
                        }
                    },
                    width: "600px",
                    btn: ['关闭']
                });
            });
        });
    </script>
    <script type="text/javascript">
        $().ready(function() {
            //店铺指引页面 弹窗
            $.ajax({
                url: '/index/index/show-message',
                dataType: 'json',
                success: function(data) {
                    if(data.data == 0) {
                        $.open({
                            title: "店铺指引",
                            ajax: {
                                url: '/index/index/seller-guide',
                            },
                            width: "1080px",
                            height: "540px",
                        });
                    }
                }
            });
            //店铺到期提醒
            $.ajax({
                url: '/index/index/expiration-reminding',
                dataType: 'json',
                success: function(result) {
                    if(result.code == 0) {
                        $(".renew-box").removeClass('hide');
                        $(".site_name").html(result.data['shop_name']);
                        $(".shop_end_time").html(result.data['end_time']);
                    }
                }
            });
        });



    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop