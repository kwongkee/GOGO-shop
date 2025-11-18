<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]-->
<html xmlns="http://www.w3.org/1999/xhtml">
<html lang="zh-CN">
<head>
    <title>淘中国-商城</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="Keywords" content="淘中国-商城" />
    <meta name="Description" content="淘中国-商城" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <meta name="format-detection" content="telephone=no">
    <meta name="is_frontend" content="yes" />
    <link rel="icon" type="image/x-icon" href="https://shop.gogo198.cn/collect_website/public/uploads/centralize/website_index/661787f746da7.png" />
    <link rel="shortcut icon" type="image/x-icon" href="https://shop.gogo198.cn/collect_website/public/uploads/centralize/website_index/661787f746da7.png" />
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
    <!-- 网站头像 -->
    <link rel="stylesheet" href="/assets/d2eace91/iconfont/iconfont.css?v=1.3"/>
    <link rel="stylesheet" href="/css/common.css?v=1.3"/>
    <!--整站改色 _start-->
    <link rel="stylesheet" href="/css/color-style.css?v=1.3"/>
    <!--整站改色 _end-->
    <script src="/assets/d2eace91/js/jquery.js?v=1.3"></script>
    <script src="/assets/d2eace91/js/jquery.cookie.js?v=1.3"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=1.3"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=1.3"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=1.3"></script>
    <script src="/js/common.js?v=1.3"></script>
    <!-- 图片缓载js -->
    <script src="/assets/d2eace91/js/jquery.lazyload.js?v=1.3"></script>
</head>

<body class="pace-done">
    <style>
        /**头部**/
        .header *{box-sizing: border-box;}
        .header{background:#1f5188 !important;padding:10px 0 !important;height:fit-content !important;width: 100% !important;}
        .header .w1200{justify-content: space-between;}
        .header .logo img{width:250px;height:66px;cursor: pointer;}
        .header .menuList{}
        .header .menuList .menuItem{color:#fff;font-size: 20px;padding: 5px 30px;margin-right: 20px;}
        .header .menuList .menuItem:last-child{margin-right: 0;padding-right: 0;}
        .header .menuList .menuItems:hover{background:#fff;color:#e60000;border-radius:5px;font-weight: 600;transition: all 0.3s ease;}
        .header .menuList .menuLine{height: 20px;background: #fff;width: 2px;margin-right:20px;}
        .header #translate #translateSelectLanguage{width:95px;font-size:18px !important;background: none;border: 0;color: #fff;}
        .header #translate #translateSelectLanguage option{color: #000;}
    </style>
    <div class="header">
        <div class="w1200 disf">
            <div class="logo">
                <img src="https://shop.gogo198.cn/collect_website/public/uploads/centralize/website_index/66178c16d453b.png" alt="" onclick="javascript:window.location.href='https://www.gogo198.cn';">
            </div>
            <div class="menuList disf">
                <a href="javascript:void(0);" class="menuItem menuItems">代购</a>
                <div class="menuLine"></div>
                <a href="https://www.gogo198.com" target="_blank" class="menuItem menuItems">集运</a>
                <div class="menuLine"></div>
                <a href="https://www.gogo198.net/?s=index/account_manage" class="menuItem menuItems" target="_blank">我的</a>
                <div class="menuLine"></div>
                <div class="menuItem"><div id="translate" class="web_translate"></div></div>
            </div>
        </div>
    </div>

    <!-- 内容 -->
    <link href="/css/error.css" rel="stylesheet" type="text/css" />
    <div class="error-content" style="height:580px;">
        <div class="w990">
            <div class="error">
                <div class="error-l"></div>
                <div class="error-r">
                    <div class="error-title">
                        <p class="color" style="text-align: left; font-size: 24px;">系统提示</p>
                    </div>
                    <p class="error-line"></p>
                    <div class="error-box">


                        <p class="color" style="text-align: left; font-size: 16px;">@if($exception->getMessage() != '' && env('APP_DEBUG') === true){{ $exception->getMessage()}}@else页面未找到。@endif</p>

                        <p class="error-btn">
                            您可以

                            <a href="@if(null !== $exception->getPrevious()){{ $exception->getPrevious() }}@else/@endif" class="color">返回上一页</a>

                            或者
                            <a href="/" class="color">返回首页</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- 站点底部-->
    <style>
        /**页脚介绍**/
        .footer{background:#1f5188;height:400px;/**padding:10px 0;margin-top:0px;**/}
        .footer .aboutBox{padding-top: 120px;}
        .footer .aboutBox p{font-size: 18px;color:#fff;margin-bottom:10px;}
        .footer .footerLine{width: 100%;height:2px;background: #fff;margin:80px 0;}
        .footer .container {width: 100%;}
        .footer .container .row{margin-bottom: 30px;}
        .footer .container .row .col-md-3 {width: 30%;}
        .footer h4{color:#f14646;text-shadow: -1px 0 #fff, 0 1px #fff, 1px 0 #fff, 0 -1px #fff;}
        .footer a {font-size: 18px;color: #FFFFFF;}
        .footer ul.link-list {margin: 0;padding: 0;list-style: none;}
        .footer ul.link-list li {margin: 0;padding: 2px 0 2px 0;list-style: none;}
        .footer ul.link-list li a {color: #FFFFFF;}
        .footer .col-md-4 {width: 33.33333333333333%;}
        .footer .col-md-9 {width: 70%;}
        .footer .col-md-3,.col-md-4,.col-md-9,.col-lg-6,.col-lg-12{float: left;}
        .footer .col-lg-6 {width: 50%;}
        .footer .col-lg-12 {width: 100%;}
        .footer .contact_contain {width: 50%;position: relative;}
        .footer .contact_contain .box {width: 100%;position: relative;overflow: hidden;height: 40px;}
        .footer ul.social-network {list-style: none;margin: 0;}
        .footer .social-network {float: unset !important;padding-left: 0;overflow-x: scroll;white-space: nowrap;}
        .footer ul.social-network li {margin: 0 5px;border: 1px solid #FFFFFF;padding: 5px 0 0;width: 32px;display: inline-block;text-align: center;height: 25px;vertical-align: baseline;}
        .footer .mobile_hr {display: none;}
        .footer #sub-footer{padding-top:0;margin-top:0;font-size:16px;background:#1f5188;}
        .footer #sub-footer p {margin: 0;padding: 0;}
        .footer #sub-footer span {color: #FFFFFF;}
        .footer .guanzhu{color:#f14646;font-size:18px;white-space: nowrap;font-weight:800;margin-bottom:10px;margin-top:40px;text-shadow: -1px 0 #fff, 0 1px #fff, 1px 0 #fff, 0 -1px #fff;}
    </style>
    <div class="footer cont7-bg ">
        <div class="w1200">
            <div style="height:50px;width:100%;float:left;"></div>
            <div class="aboutBox" style="display: none;"></div>
            <div class="footerLine" style="display: none;"></div>
            <div class="container" style="font-size:16px;">
                <div class="row">
                    <div class="col-md-3 col-sm-3">
                        <div class="widget">
                            <h4 class="widgetheading f18" style="margin-bottom:5px;">联系我们</h4>
                            <p>
                                <img src="//gather.gogo198.cn/img/tel.png" alt="" style="width:18px;"> <a href="tel:+86 18028 192198">+86 18028 192198</a> <br>
                                <img src="//gather.gogo198.cn/img/email.png" alt="" style="width:18px;"> <a href="mailto:198@gogo198.net">198@gogo198.net</a>
                            </p>
                        </div>
                    </div>
                    <div class="disf col-md-9 col-sm-9 foot-menu" style="align-items:baseline;">
                        <div class="col-md-4 col-sm-4">
                            <div class="widget">
                                <h4 class="widgetheading f18" style="margin-bottom:5px;text-align:right;">客户服务</h4>
                                <ul class="link-list" style="text-align:right;">
                                    <li><a href="/basic_info?foid=2" class="f18" target="_blank">个人中心</a></li>
                                    <li><a href="/bill_list?foid=3" class="f18" target="_blank">账单中心</a></li>
                                    <li><a href="https://www.gogo198.net/?s=index/tradeflow_buyer&amp;foid=4" class="f18" target="_blank">订单中心</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="widget">
                                <h4 class="widgetheading f18" style="margin-bottom:5px;text-align:right;">服务指南</h4>
                                <ul class="link-list" style="text-align:right;">
                                    <li><a href="/txt_detail?id=2&amp;type=yejiao&amp;oid=9&amp;foid=9" class="f18" target="_blank">操作指南</a></li>
                                    <li><a href="/rule_detail?id=28&amp;foid=10" class="f18" target="_blank">平台规则</a></li>
                                    <li><a href="/policy_detail?id=15&amp;foid=11" class="f18" target="_blank">政策法规</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="widget">
                                <h4 class="widgetheading f18" style="margin-bottom:5px;text-align:right;">支付方式</h4>
                                <ul class="link-list" style="text-align:right;">
                                    <li><a href="/txt_detail?id=0&amp;type=yejiao&amp;oid=12&amp;foid=12" class="f18" target="_blank">会员预付</a></li>
                                    <li><a href="/txt_detail?id=0&amp;type=yejiao&amp;oid=13&amp;foid=13" class="f18" target="_blank">网络支付</a></li>
                                    <li><a href="/txt_detail?id=2&amp;type=yejiao&amp;oid=14&amp;foid=14" class="f18" target="_blank">银行支付</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="widget">
                                <h4 class="widgetheading f18" style="margin-bottom:5px;text-align:right;">物流相关</h4>
                                <ul class="link-list" style="text-align:right;">
                                    <li><a href="?foid=15" class="f18" target="_blank">签收验货</a></li>
                                    <li><a href="?foid=16" class="f18" target="_blank">集货仓储</a></li>
                                    <li><a href="?foid=17" class="f18" target="_blank">跨境转运</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="widget">
                                <h4 class="widgetheading f18" style="margin-bottom:5px;text-align:right;">售后服务</h4>
                                <ul class="link-list" style="text-align:right;">
                                    <li><a href="/rule_detail?id=28&amp;foid=18" class="f18" target="_blank">商品保管</a></li>
                                    <li><a href="?foid=19" class="f18" target="_blank">保险赔偿</a></li>
                                    <li><a href="?foid=20" class="f18" target="_blank">货物退换</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="sub-footer">
                <div class="container">
                    <div class="row" style="margin-bottom:20px;">
                        <div class="col-lg-6">
                            <div class="f18 guanzhu">
                                关注我们
                            </div>
                            <div class="contact_contain">
                                <div class="box" style="">
                                    <ul class="social-network" style="overflow-x:unset;position:absolute;">
                                        <li>
                                            <a href="/social_detail?id=6" data-placement="top" title="Wechat">
                                                <img src="https://shop.gogo198.cn/collect_website/public/uploads/centralize/website_contact/662616175ae87.png" alt="" style="width:18px;margin-bottom: 3px;">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.facebook.com/profile.php?id=100064291419772&amp;mibextid=ZbWKwL" data-placement="top" title="facebook">
                                                <img src="https://shop.gogo198.cn/collect_website/public/uploads/centralize/website_contact/66276326329ee.png" alt="" style="width:18px;margin-bottom: 3px;">
                                            </a>
                                        </li>
                                    </ul>
                                </div>


                            </div>
                        </div>
                        <div class="col-lg-6">
                            <hr class="mobile_hr">
                            <div class="other_website">
                                <p style="text-align:center;font-weight:unset;margin-top: 85px;">
                                    <a href="https://gather.gogo198.cn/" class="f16" target="_blank" rel="noopener noreferrer">
                                        直邮易
                                    </a>
                                    <span>|</span>
                                    <a href="http://www.gogo198.cn/" class="f16" target="_blank" rel="noopener noreferrer">
                                        淘中国
                                    </a>
                                    <span>|</span>
                                    <a href="https://www.gogo198.net/" class="f16" target="_blank" rel="noopener noreferrer">
                                        购购网
                                    </a>
                                </p>
                                <p style="text-align:center;font-weight:unset;margin-top: 5px;">
{{--                                    <span>|</span>--}}
                                    <a class="join_us" href="https://www.zhipin.com/web/geek/job?query=%E4%BD%9B%E5%B1%B1%E5%B8%82%E9%92%9C%E9%93%AD%E5%95%86%E5%8A%A1%E8%B5%84%E8%AE%AF%E6%9C%8D%E5%8A%A1%E6%9C%89%E9%99%90%E5%85%AC%E5%8F%B8&amp;city=101280800" target="_blank" rel="noopener noreferrer">加入我们</a>
                                    <span>|</span>
                                    <a class="help_us" href="/help_us" target="_blank" rel="noopener noreferrer">帮助中心</a>
                                    <span>|</span>
                                    <a href="/friendly_link" class="f16" target="_blank" rel="noopener noreferrer">友情链接</a>
                                    <span>|</span>
                                    <a href="/rule_list" class="f16" target="_blank" rel="noopener noreferrer">平台规则</a>
                                    <span>|</span>
                                    <a href="/rule_detail?id=36" class="f16">私隐政策</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row copyright2" style="margin-bottom:0;">
                        <div class="col-lg-12">
                            <div style="text-align:center;margin-top:40px;">
                                <p style="text-align: center;"><span style="font-size: 15px; color: rgb(255, 255, 255);"><a href="https://beian.miit.gov.cn/" target="_blank" style="text-align: center; text-wrap: wrap; box-sizing: border-box; padding: 0px; margin: 0px; font-family: Poppins, sans-serif; font-size: 15px; color: rgb(255, 255, 255);"><span style="font-size: 15px;color:#fff;">粤ICP备09003656号-35</span></a>&nbsp;|&nbsp;<a href="https://www.beian.gov.cn/portal/registerSystemInfo?recordcode=44060502000493" target="_blank" style="text-align: center; text-wrap: wrap; box-sizing: border-box; padding: 0px; margin: 0px; font-family: Poppins, sans-serif; font-size: 15px; color: rgb(255, 255, 255);">京公网安备44060502000493号</a><br>Copyright&nbsp;©&nbsp;2003&nbsp;-&nbsp;2023&nbsp;&nbsp;購購網&nbsp;版权所有</span><br></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/js/jquery.fly.min.js?v=1.3"></script>
    <script src="/assets/d2eace91/js/szy.cart.js?v=1.3"></script>
    <!--[if lte IE 9]>
    <script src="/js/requestAnimationFrame.js?v=1.3"></script>
    <![endif]-->
    <script type="text/javascript">
        $().ready(function(){
            // 缓载图片
            $.imgloading.loading();
        });
    </script>

    <script id="yii_debug_toolbar" type="text">
        <![CDATA[YII-BLOCK-BODY-END]]>
    </script>
    <script type="text/javascript">
        $().ready(function(){
            $("body").append($.parseHTML($("#yii_debug_toolbar").html(), true));
        });
    </script>

    <script type="text/javascript" charset="utf-8">
        var head= document.getElementsByTagName('head')[0]; var script= document.createElement('script'); script.type= 'text/javascript'; script.src= 'https://www.gogo198.cn/assets/d2eace91/js/res.zvo.cn_translate_inspector_v2.js?v=132<?php echo time();?>'; head.appendChild(script);
    </script>
</body>
</html>


