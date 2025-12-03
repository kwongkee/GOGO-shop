@extends('layouts.goods_header')

<link rel="stylesheet" href="/assets/d2eace91/iconfont/iconfont.css?v=1.1"/>
<link rel="stylesheet" href="/css/common.css?v=1.1"/>

@section('style_js')
    <!--页面css/js-->
    <script src="/js/index.js?v=20180528"></script>
    <script src="/js/tabs.js?v=20180528"></script>
    <script src="/js/bubbleup.js?v=20180528"></script>
    <script src="/js/jquery.hiSlider.js?v=20180528"></script>
    <script src="/js/index_tab.js?v=20180528"></script>
    <script src="/js/jump.js?v=20180528"></script>
    <script src="/js/nav.js?v=20180528"></script>
@stop

<!--整站改色 _start-->
@if(sysconf('custom_style_enable') == 1)
    <link rel="stylesheet" href="/css/custom/site-color-style-0.css?v=1.6" id="site_style"/>
@else
    <link rel="stylesheet" href="/css/color-style.css?v=1.6" id="site_style"/>
@endif
<!--整站改色 _end-->

{{--header_css--}}
@section('header_css')@show

<script src="/assets/d2eace91/js/jquery.js?v=1.1"></script>
<script src="/js/common.js?v=1.1"></script>
<!-- 图片缓载js -->
<script src="/assets/d2eace91/js/jquery.lazyload.js?v=1.1"></script>
<script src="/assets/d2eace91/js/jquery.cookie.js?v=20180528"></script>
<script src="/assets/d2eace91/js/layer/layer.js?v=20180528"></script>
<script src="/assets/d2eace91/js/jquery.modal.js?v=20180528"></script>
<script src="/js/jquery.fly.min.js?v=1.1"></script>


{{--页面css/js--}}
@section('style_js')
    <!--页面css/js-->
    <script src="/js/index.js?v=20180528"></script>
    <script src="/js/tabs.js?v=20180528"></script>
    <script src="/js/bubbleup.js?v=20180528"></script>
    <script src="/js/jquery.hiSlider.js?v=20180528"></script>
    <script src="/js/index_tab.js?v=20180528"></script>
    <script src="/js/jump.js?v=20180528"></script>
    <script src="/js/nav.js?v=20180528"></script>
@show

@section('content')
    <!-- 内容 -->
    <!-- css -->
    <link rel="stylesheet" href="/css/goods.css?v=20180428"/>

    <script src="/assets/d2eace91/js/jquery.method.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/szy.cart.js?v=<?php echo time();?>"></script>
    <!-- 地区选择器 -->
    <script src="/assets/d2eace91/js/jquery.region.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=<?php echo time();?>"></script>
    <script src="/assets/d2eace91/js/jquery.history.js?v=20180528"></script>
    <!-- 放大镜 _start -->
    <script type="text/javascript" src="/js/magiczoom.js"></script>
    <!-- 放大镜 _end -->

    <link rel="stylesheet" href="/assets/d2eace91/layui/css/layui.css?v=23121"/>
    <link rel="stylesheet" href="/assets/d2eace91/js/layer/theme/default/layer.css?v=3.1.0" id="layuicss-layer">
    <link rel="stylesheet" href="/assets/d2eace91/js/chosen/chosen.css?v=1.2"/>
    <script type="text/javascript" src="/assets/d2eace91/layui/layui.js"></script>
    <script src="/assets/d2eace91/js/chosen/jquery.chosen.js?v=1.3"></script>

    <style>
        body{background:{{$website['background']}} !important;}
        .w1210{margin-top:120px;}
        .store-service .store-service-group .service-list{padding-left:80px;}
        .tree li span{height:20px;}
        .goto{text-decoration: underline;}
        .layui-form input[type=checkbox], .layui-form input[type=radio], .layui-form select{display:block;}
        /*弹窗位置*/
        .layui-layer{top:50% !important;transform: translate(0px, -50%);}
        /*chosen搜索框颜色*/
        .chosen-container.chosen-with-drop .chosen-drop{color:#000;}
        /*layui时间线*/
        .layui-timeline-axis{color:{{$website['color']}};}
        .video-show,.video .video-js{width:100% !important;}
        .layui-table{margin:0;}
        .layui-table th{background:{{$website['color']}};color:{{$website['color_word']}};}

        /**添加地址**/
        .sort_div select{display:none !important;}
        .sort_div,.addr{display: grid;grid-template-columns: repeat(1,1fr);-moz-column-gap: 0px;column-gap: 0px;row-gap: 0px;}
        .postal_temp{border:1px solid #000;width: 48px;height: 38px;text-align: center;line-height: 38px;margin-right:2px;}
        .postal_code{margin-right:2px;}
        .addr{width:100%;}
        .hide2{display: none;}
        .address_div .layui-form-label{width:100px;}

        .goods-info,.fl,.goodsDetail{background:{{$website['content']}};}
        .clearfix .fl{display: none;}
        .goodsDetail{width: 100%;}
        .goods-info{padding: 20px;box-sizing: border-box;width: 100%;}
        /*加入分销、收藏商品、分享积分*/
        .goods-gallery-bottom{display: flex;align-items: center;justify-content: center;}
        .goods-gallery-bottom a.goods-compare{margin-right:10px;}
        .goods-gallery-bottom a.goods-compare i{height: 18px;}
        .goods-gallery-bottom .bdsharebuttonbox a{padding-left:0;font-size: 15px;}

        #gg-zoom{width: 100%;}
        .goodsgallery .gg-current-img img{width:100%;}

        /**规格信息排列start**/
        .choose dl.attr dd li{max-width: 220px;}
        .choose dl.attr dd li.not_price_allow a span{cursor: not-allowed; opacity: 0.3;}
        .choose dl.attr dd li a{border:2px solid #b8b7bd;}
        .choose dl.attr dd li.spec-hover a{border:2px solid #e60000;}
        .choose dl.attr dd li.selected a{border:0;}
        .choose dl.attr dd li.selected>a{background:{{$website['color']}};border:2px solid {{$website['color_word']}};}
        .choose dl.attr dd li.selected>a span{color:{{$website['color_word']}} !important;}
        .choose dl.attr dd li a span{max-width: 200px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;font-weight: 800;color:#000;}
        /**已选规格**/
        .already_select .optionSel{background: #f7e6e1;color: #e60000;padding: 2px 5px;box-sizing: border-box;font-size: 12px;cursor: pointer;display: inline-block;}
        /**规格信息排列end**/

        /*数量+ -*/
        .choose dl.amount dd .amount-widget .amount-btn{margin-top:0;}
        .choose dl.amount dd .amount-widget .amount-plus{height:16px;}

        /*商品头部详情信息start*/
        .second-color{color:#e60000;}
        .helpBox{box-sizing: content-box;margin-bottom: 10px;}
        .helpBox .help_cont1 {background: #f1d4d9;border-radius: 10px;color: #E31939;cursor: help;font-size: 12px;height: 20px;line-height: 12px;padding: 4px 30px 4px 10px;position: relative;vertical-align: 5px;width: auto;}
        .helpBox .help_cont1:after {background: url(/assets/d2eace91/images/newhome/question-1.png) no-repeat;background-size: contain;content: "";display: inline-block;height: 25px;margin-left: 8px;position: absolute;right: 4px;top: -2px;vertical-align: top;width: 25px;}
        .helpBox .before-u-buy {color: #333;cursor: pointer;display: inline-block;font-size: 12px;height: 20px;line-height: 20px;margin-left: 10px;vertical-align: top;}
        .goods-price{background:unset;padding:0;}
        .goods-price .realy-price .now-prices .p-price{font-size:20px;}
        .choose dl.attr dt{margin-top:5px;}
        .choose dl.attr dt,.choose dl.amount dt{font-weight:800;color:#000;font-size: 12px;}

        .detail-info p.goods-brief{text-align: right;margin-bottom:0;}

        /*轮播图*/
        .preview{width: 40%;}
        .goodsgallery{width:100%;}
        .goodsgallery .gg-current-img{padding: 0;width: 100%;box-shadow: 0px 0px 4px 1px #6b1616;border:0;}
        .goodsgallery .gg-current-img #gg-zoom{width:100% !important;}
        .goodsgallery .gg-current-img img{height:470px;}
        .goodsgallery .gg-container{margin-left:0;width: 100%;}
        .goodsgallery .gg-container .gg-content{height:95px;width: 100%;}
        .goodsgallery .gg-container ul{width: 100% !important;}
        .goodsgallery .gg-container li{width:93.5px;height:93.5px;}
        .goodsgallery .gg-container li img{width:100%;height:100%;}
        .goodsgallery .gg-container li .current img{border-color:/*main_color_start*/#FF9600/*main_color_end*/;}
        /*轮播图左右切换*/
        .goodsgallery a.gg-left-btn,.goodsgallery a.gg-right-btn{display: none;}
        /*商品详情*/
        .detail-info{width:60%;}
        .detail-info .goods-name{color: #000 !important;padding: 10px;border: 2px solid #d9d9d9;border-radius: 7px;font-size: 23px;font-weight: 800;}
        .detail-info .goods-url{font-size: 14px;font-weight: 600;color: {{$website['color_word']}};background: {{$website['color']}};padding: 1px 8px;box-sizing: border-box;border-radius: 5px;border: 2px solid #d9d9d9;}
        .detail-info .goods-brief{display: inline-block;width: fit-content;margin-right:10px;margin-top:5px;}
        .detail-info .goods-price{margin-top:30px;margin-bottom:0;height:72px;}
        .detail-info .goods-price .now-prices{background: #E3E6EB;float: left;padding: 3px 10px;box-sizing: border-box;min-width: 320px;justify-content: space-between;border: 2px solid #d9d9d9;border-radius: 5px;margin-right:20px;}
        .detail-info .goods-price .now-prices .priceDiv *{font-size:18px;}
        .detail-info .goods-price .now-prices .priceDiv .SZY-CURRENCY{font-size:23px;color:#000;}
        .detail-info .goods-price .now-prices .priceDiv .SZY-PRICE{font-size:23px;color:#db1d18;}
        .detail-info .goods-price .now-prices .operaDiv .operaBtn{border:2px solid #fff;border-radius: 8px;background:{{$website['color']}};color:{{$website['color_word']}};padding:0px 10px;font-weight:800;cursor:pointer;}
        .detail-info .goods-price .now-prices .operaDiv .operaBtn:nth-of-type(1){margin-bottom:5px;}
        .detail-info .goods-price .now-service{float:left;}
        .detail-info .goods-price .now-service .service-one{font-size:15px;color:#000;font-weight: 800;}
        .detail-info .goods-price .now-service p{color:#000;}
        /*集货仓&收货地址*/
        .purchase_process{margin:30px 0;}
        .purchase_process *{box-sizing: border-box;}
        dl, dt, li, ol, ul {list-style-type: none;}
        .purchase_process .goods-options-freight {background: #E3E6EB;margin-top: 0px;padding: 5px 10px;border-radius: 5px;border: 2px solid #d9d9d9;}
        .purchase_process dd,.purchase_process div{font-size: 14px;font-style: normal;margin: 0;padding: 0;}
        .purchase_process .new-goods-options-content>.label {align-items: center;display: flex;flex-wrap: wrap;margin-bottom: 10px;padding-left: 25px;position: relative;}
        .purchase_process .new-goods-options-content>.label.label-one:before {background: {{$website['color']}};border-radius: 50%;bottom: 0;color: {{$website['color_word']}};content: "1";font-size: 13px;height: 18px;left: 0;line-height: 13px;margin: auto;position: absolute;text-align: center;top: 0;width: 18px;border:2px solid {{$website['color']}};}
        .purchase_process .new-goods-options-content>.label.label-two:before {background: {{$website['color']}};border-radius: 50%;bottom: 0;color: {{$website['color_word']}};content: "2";font-size: 13px;height: 18px;left: 0;line-height: 13px;margin: auto;position: absolute;text-align: center;top: 0;width: 18px;border:2px solid {{$website['color']}};}
        .purchase_process .new-goods-options-content>.label.label-three:before {background: {{$website['color']}};border-radius: 50%;bottom: 0;color: {{$website['color_word']}};content: "3";font-size: 13px;height: 18px;left: 0;line-height: 13px;margin: auto;position: absolute;text-align: center;top: 0;width: 18px;border:2px solid {{$website['color']}};}
        .purchase_process .goods-freight {border: 1px solid #eee;color: #999;height: 26px;line-height: 29px;text-indent: 40px;transition: all .3s linear;vertical-align: top;width: 80px;}
        .new-goods-options-content .label-title {color: {{$website['color_word']}};font-size: 15px;font-weight:600;}
        .new-goods-options-content>.label .arrow {color: {{$website['color_word']}};font-size: 18px;line-height: 18px;margin: 0px 5px;}
        .new-goods-options-content>.label .label-description {font-size: 12px;}
        .new-goods-options-content>.label .label-description em {color: #333;font-weight: 700;margin-left: 8px;}
        .new-goods-options-content>.label .label-freight {align-items: center;display: flex;margin-left: auto;}
        .new-goods-options-content>.label .label-freight label {align-items: center;display: flex;font-size: 12px;}
        .new-goods-options-content>.label .label-input {align-items: center;display: flex;margin: 0 0 0 10px;}
        .new-goods-options-content .rightLabel span{color:{{$website['color_word']}};font-size: 15px;}
        .new-goods-options-content .rightLabel .freight_estimate{color:{{$website['color_word']}};background:{{$website['color']}};font-size: 15px;border:2px solid #d9d9d9;padding:3px 5px;box-sizing: border-box;border-radius: 5px;cursor:pointer;}
        .new-goods-options-content .leftLabel .freight_estimate{color:{{$website['color_word']}};background:{{$website['color']}};font-size: 15px;border:2px solid #d9d9d9;padding:3px 5px;box-sizing: border-box;border-radius: 5px;cursor:pointer;}
        .purchase_process .new-goods-options-content.cn .label-input .goods-freight-rmb {line-height: 27px !important;position: absolute;}
        .new-goods-options-content>.label .label-input em, .new-goods-options-content>.label .label-input input{font-size: 12px;}
        .new-goods-options-content>.label.label-tow:after {background: #ddd;content: "";height: 14px;left: 7px;margin: 6px 0;position: absolute;top: -20px;width: 2px;}
        .new-goods-options-content>.label.label-tow {margin-bottom: 12px;}
        .goods-info_container .country-select {font-size: 12px;padding-left: 26px;}
        .new-goods-options-content>.label {align-items: center;display: flex;flex-wrap: wrap;margin-bottom: 15px;padding-left: 25px;position: relative;}
        .new-goods-options-content>.label.label-tow:before {background: #E31939;border-radius: 50%;color: #fff;content: "2";font-size: 12px;height: 16px;left: 0;line-height: 16px;margin: auto;position: absolute;text-align: center;width: 16px;z-index: 1;}
        .goods-info_container .country-select>span:first-child {margin-right: 8px;}
        .new-goods-options-content>.label .arrow {color: #666;font-size: 18px;line-height: 18px;margin: 0px 5px;}
        .new-goods-options-content>.label.label-tow .label-title {margin-right: 10px;}
        .goods-info_container .country-select .country-select-search {height: 30px;margin-right: 8px;width: 150px;}
        .new-goods-options-content>.label .label-freight {align-items: center;display: flex;margin-left: auto;}
        .new-goods-options-content>.label .label-freight>span {font-size: 12px;}
        .new-goods-options-content>.label .label-freight .label-icon {display: flex;}
        .purchase_process .goods-options-freight a {color: {{$website['color_word']}};}
        .new-goods-options-content>.label .label-freight .label-icon li span {color: #333;cursor: pointer;font-size: 20px;font-weight: 700;line-height: 24px;margin-left: 8px;transition: all .3s linear;user-select: none;}
        .purchase_process .new-goods-options-content>.label-three{margin-bottom:0;}
        /*商品规格*/
        .choose_buy{border:2px solid #ddd;border-radius:5px;padding:2px;box-sizing: border-box;}
        .choose{background:#E3E6EB;padding:0;border-radius: 5px;border: 2px solid #d9d9d9;box-sizing: border-box;width:100%;margin-bottom:10px;}
        .choose .layui-tab{width: 100%;margin:0;}
        .choose .layui-tab-title{border-bottom:2px solid #ddd;height:32px;}
        .choose .layui-tab-title li{font-weight: 800;font-size:15px;border-bottom:2px solid #ddd;border-right:2px solid #ddd;color:#000;line-height:32px;}
        .choose .layui-tab-title .layui-this:after{border-bottom-color:{{$website['color']}};}
        .choose .layui-tab-title .layui-this{color:{{$website['color_word']}};background:{{$website['color']}};}
        .choose .layui-tab .layui-tab-content{width: 100%;padding: 5px 0px 0px 0px;}
        .choose dl dd{width: 100%;height: 114px;overflow-y: auto;scrollbar-color: {{$website['color_word']}} #ffffff;}
        .choose dl.attr{padding-left:0;width: 100%;margin-bottom:0;}
        .choose dl.attr dd li{max-width: unset; width:48%;}
        .choose dl.attr dd li a{min-width: 100%;max-width:100%;overflow:hidden;}
        .choose dl.attr dd li a span{max-width:100%;min-width: 100%;}
        .choose dl.attr dd li.selected i{display: none;}
        .choose dl.attr dd li.selected>i{right:-2px;display: block;}
        .choose dl.attr dd li.no-stock a{border:2px dashed #ccc;}

        .have_child_finger{width: 20px;position: absolute;right: 15px;top: 8px;cursor:pointer;}
        .choose dl.attr dd li:nth-child(odd) .attr_children{position:absolute;top: 44px;left:0;display:none;z-index:9;}
        .choose dl.attr dd li:nth-child(even) .attr_children{position:absolute;top: 44px;left:-315px;display:none;z-index:9;}
        .attr_children .attr_childrenBox{min-width: 634px;max-width: 652px;min-height:90px;max-height:90px;background: #ccc;overflow-y:auto;padding-top:20px;}
        .choose dl.attr dd li:nth-child(odd) .attr_children:before{content:'';width: 0;height: 0;border-left: 10px solid transparent;border-right: 10px solid transparent;border-bottom: 10px solid #ccc;position: absolute;top: -10px;left: calc(50% - 175px);}
        .choose dl.attr dd li:nth-child(even) .attr_children:before{content:'';width: 0;height: 0;border-left: 10px solid transparent;border-right: 10px solid transparent;border-bottom: 10px solid #ccc;position: absolute;top: -10px;left: calc(100% - 175px);}
        .attr_children .closeAttrDiv{position:absolute;right:15px;top:-5px;font-size:22px;color:#000;font-weight:800;cursor:pointer;}
        .attr_children li a{border: 2px solid #b8b7bd !important;}
        .attr_children li.selected>a{border: 2px solid #1761b7 !important;}

        /*购物清单==================START*/
        /*已选规格&选购数量*/
        .buy_div{background:#E3E6EB;padding:5px 10px;border-radius: 5px;border: 2px solid #d9d9d9;box-sizing: border-box;width:100%;align-items: flex-start;}
        .buy_div .already_select .selectBtn{background:#db1d18;padding:2px 5px;font-size: 15px;box-sizing: border-box;margin-right:5px;color:#fff;white-space:nowrap;font-weight: 800;}
        .buy_div .already_select .selectOptionName{border: 2px solid #b8b7bd;background:#fff;width: calc(100% - 45px);height: fit-content;max-height:90px;overflow:hidden;white-space: nowrap;text-overflow: ellipsis;font-size:15px;overflow-y:auto;scrollbar-color: {{$website['color']}} #ffffff;}
        .buy_div .already_select .selectOptionName .paramDiv{border-bottom:2px solid #ddd;}
        .buy_div .already_select .selectOptionName .paramDiv:last-child{border-bottom:0;}
        .buy_div .already_select .selectOptionName .select_param{background:{{$website['color']}};font-size: 13px;color:{{$website['color_word']}};font-weight:800;padding:2px 5px;box-sizing: border-box;width: 48px;min-width: 48px;max-width: 48px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;text-align: center;}
        .buy_div .already_select .selectOptionName .optionSel{background:unset;padding:1px 5px;font-size:13px;color:#000;width: 100%;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;font-weight:800;color:#000;}
        .buy_div .select_buy{margin-top:0px;width: 42%;}
        .buy_div .select_buy .selectBtn{background:#db1d18;padding:2px 5px;font-size: 15px;box-sizing: border-box;margin-right:5px;color:#fff;font-weight: 800;white-space: nowrap;width: 48px;min-width: 48px;max-width: 48px;text-align: center;}
        /*数量+ -*/
        .buy_div .select_buy .amount .amount-widget .amount-btn{margin-top:0;}
        .buy_div .select_buy .amount .amount-widget .amount-plus{height:15px;}
        .buy_div .amount-input {color: #db1d18;font-size: 12px;margin: 0;margin-top: 0px;padding: 3px;display: inline-block;height: 22px;border: 1px solid #a7a6ac;width: 75px;line-height: 24px;vertical-align: middle;text-align: center;font-weight:800;}
        .buy_div .amount-btn {display: inline-block;vertical-align: middle;margin-left: -4px;margin-top: 1px;}
        .buy_div .amount-btn i {width: 16px;height: 14px;font-size: 12px;color: #666;display: inline-block;user-select: none;}
        .buy_div  .amount-plus {width: 16px;height: 16px;overflow: hidden;cursor: pointer;border: 1px solid #a7a6ab;border-left: none;display: block;line-height: 14px;text-align: center;background: #f1f1f1;}
        .buy_div .amount-minus {width: 16px;height: 16px;overflow: hidden;cursor: pointer;border: 1px solid #a7a6ab;border-left: none;border-top: none;display: block;line-height: 14px;text-align: center;background: #f1f1f1;}
        .buy_div .amount_num{margin-right:0px;width: 57%;align-items: flex-start;}
        .buy_div .select_buy .select_buy_headBox .amount_num{width:fit-content;}
        .buy_div .select_buy .select_buy_btmBox{margin-top:5px;}
        .buy_div .select_buy .select_buy_btmBox .priceDiv{width:fit-content;margin-right:10px;}
        .buy_div .select_buy .select_buy_btmBox .SZY-CURRENCY{font-size:15px;color:#fff;background:#db1d18;padding:2px 5px;box-sizing: border-box;font-weight: 800;width: 48px;min-width: 48px;max-width: 48px;text-align: center;}
        .buy_div .select_buy .select_buy_btmBox .SZY-PRICE{font-size:15px;font-weight:800;background:#fff;color:#db1d18;border: 1px solid #a7a6ac;padding: 2px 16px;box-sizing: border-box;min-width: 100px;text-align: center;}
        .buy_div .select_buy .btn_buy{padding:3px 10px;box-sizing: border-box;margin-right:10px;color:#fff;cursor:pointer;}
        .buy_div .select_buy .buy-goods,.buy_div .select_buy .buy-goods-soon{background:#db1d18;margin-right:0;float:right;font-weight: 800;}
        .buy_div .select_buy .join_list{background:{{$website['color']}};color:{{$website['color_word']}};font-weight:800;white-space: nowrap;}
        .buy_div .select_buy .show_list{background:unset;padding: 0;margin-right: 0;}
        .buy_div .select_buy .amount_num{margin-right:10px;}

        .buy_list{position:relative;width: 100%;padding:10px;box-sizing: border-box;display:none;}
        .buy_list .glist_form{background:#fff;padding:15px;box-sizing: border-box;/*position:absolute;top:45px;left:0px;*/border: 1px solid #ededed;z-index: 10;/*box-shadow: 0px 0px 10px 1px #999;*/width: 100%;}
        .buy_list .glist_form .buy_table{max-height: 175px;overflow-y: auto;}
        .yixuan_div{margin-top: 0px;width: 100%;height: 40px;background: #f2f2f2;padding: 10px 20px;box-sizing: border-box;}
        .yixuan_div .yixuan,.yixuan_div .yixuan2{cursor: pointer;position:relative;width:fit-content;font-size:15px;}
        .yixuan_div .yixuan:after{content:'';position:absolute;width:8px;height:8px;border-top:1px solid #666;border-right:1px solid #666;right:-17px;bottom:7px;transform: rotate(135deg);}
        .yixuan_div .yixuan2:after{content:'';position:absolute;width:8px;height:8px;border-top:1px solid #666;border-right:1px solid #666;right:-17px;bottom:3px;transform: rotate(-45deg);}
        /**清单里的+ -**/
        .buy_list .amount-input {color: #666;font-size: 12px;margin: 0;margin-top: 1px;padding: 3px;display: inline-block;height: 24px;border: 1px solid #a7a6ac;width: 36px;line-height: 24px;vertical-align: middle;}
        .buy_list .amount-btn {display: inline-block;vertical-align: middle;margin-left: -0.8px;margin-top: 1px;}
        .buy_list .amount-btn i {width: 16px;height: 14px;font-size: 12px;color: #666;display: inline-block;}
        .buy_list  .amount-plus {width: 16px;height: 16px;overflow: hidden;cursor: pointer;border: 1px solid #a7a6ab;border-left: none;display: block;line-height: 14px;text-align: center;background: #f1f1f1;}
        .buy_list .amount-minus {width: 16px;height: 16px;overflow: hidden;cursor: pointer;border: 1px solid #a7a6ab;border-left: none;border-top: none;display: block;line-height: 14px;text-align: center;background: #f1f1f1;}
        .buy_list .amount-unit {vertical-align: middle;margin-left: 5px;}

        /**商品计费详情**/
        .buy_info{padding:10px 0;box-sizing:border-box;}
        .buy_info .gi_label{font-size:15px;font-weight:600;width:70px;}
        .buy_info .gi_otherfee_price,.buy_info .gi_otherfee_price2{position:relative;cursor:pointer;}
        .buy_info .gi_otherfee_price:after{content:'';position: absolute;width:8px;height:8px;border-top:1px solid #666;border-right:1px solid #666;right:-20px;top:5px ;transform:rotate(135deg);}
        .buy_info .gi_otherfee_price2:after{content:'';position: absolute;width:8px;height:8px;border-top:1px solid #666;border-right:1px solid #666;right:-20px;top:6px ;transform:rotate(-45deg);}
        .buy_info .otherfee_div{padding: 20px;box-sizing: border-box;box-shadow: 0px 0px 10px 1px #999;position: absolute;top: 20px;left: 0px;background: #fff;z-index: 11;min-width:600px;}

        /**购物优惠**/
        .buy_info .preferential_div,.buy_info .see_prefe,.buy_info .see_prefe2{position:relative;cursor:pointer;}
        .buy_info .see_prefe:after{content:'';position: absolute;width:8px;height:8px;border-top:1px solid #666;border-right:1px solid #666;right:-20px;top:5px ;transform:rotate(135deg);}
        .buy_info .see_prefe2:after{content:'';position: absolute;width:8px;height:8px;border-top:1px solid #666;border-right:1px solid #666;right:-20px;top:6px ;transform:rotate(-45deg);}
        .buy_info .prefe_info{padding: 20px;box-sizing: border-box;box-shadow: 0px 0px 10px 1px #999;position: absolute;top: 20px;left: 0px;background: #fff;z-index: 11;min-width: 700px;}
        .buy_info .offer-title{padding-top:0;}
        .buy_info .gift_common{display: block;border: 1px solid #666;padding: 5px 10px;}
        .buy_info .gift_common .points_divName,.buy_info .gift_common .coupon_divName{margin-right:8px;}

        /**订单随赠**/
        .buy_info .prefeProduct_div,.buy_info .see_prefeProduct,.buy_info .see_prefeProduct2{position:relative;cursor:pointer;}
        .buy_info .see_prefeProduct:after{content:'';position: absolute;width:8px;height:8px;border-top:1px solid #666;border-right:1px solid #666;right:-20px;top:5px ;transform:rotate(135deg);}
        .buy_info .see_prefeProduct2:after{content:'';position: absolute;width:8px;height:8px;border-top:1px solid #666;border-right:1px solid #666;right:-20px;top:6px ;transform:rotate(-45deg);}
        .buy_info .prefeProduct_info{padding: 20px;box-sizing: border-box;box-shadow: 0px 0px 10px 1px #999;position: absolute;top: 20px;left: 0px;background: #fff;z-index: 11;min-width: 400px;}
        /*购物清单==================END*/

        /*商品头部详情信息end*/

        /*商品尾部详情信息start*/
        /*商品详情*/
        .detailContent{width:100%;height:fit-content;margin-bottom: 60px;}
        /*详情头部*/
        .detailContent .detailHead{width:100%;max-width: 1210px;z-index: 9;}
        .detailContent .detailHead .detailHeadBox{width:100%;padding:20px 30px;box-sizing: border-box;background:{{$website['color']}};}
        .detailContent .detailHead .detailHeadBox .detailHeadTxt{font-size: 20px;color:{{$website['color_word']}};font-weight: 800;margin-right:30px;display: inline-block;position:relative;cursor:pointer;}
        .detailContent .detailHead .detailHeadBox .detailHeadTxtAct:after{content:'';position:absolute;left: 50%;bottom: 0;width: calc(100% - 20px);height: 2px;border-bottom: 2px solid #fff;transform: translate(-50%, 8px);}
        .detailContent .detailHead .detailBtmBox{width: 100%;padding:10px 30px;box-sizing: border-box;background:#fff;border: 2px solid #d9d9d9;}
        .detailContent .detailHead .detailBtmBox .detailBtmShow{display: block;}
        .detailContent .detailHead .detailBtmBox .detailBtmHide{display: none;}
        .detailContent .detailHead .detailBtmBox .detailBtmDiv{width: 100%;}
        .detailContent .detailHead .detailBtmBox .detailBtmDiv .detailBtmTxt{font-size: 15px;color:{{$website['color_word']}};display: inline-block;margin-right:50px;font-weight: 800;position:relative;cursor:pointer;}
        .detailContent .detailHead .detailBtmBox .detailBtmTxtAct:after{content:'';position:absolute;left: 50%;bottom: 0;width: calc(100% - 20px);height: 2px;border-bottom: 2px solid {{$website['color']}};transform: translate(-50%, 5px);}
        /*详情底部*/
        .detailContent .detailBtm .detailBtmLeft{width: 70%;height:100%;float:left;margin-bottom:60px;}
        .detailContent .detailBtm .detailBtmLeft .detailBtmShow{display: block;margin-bottom:50px;}
        .detailContent .detailBtm .detailBtmLeft .detailBtmHide{display: none;}
        .detailContent .detailBtm .detailBtmLeft .detailBtmTitle{font-size:20px;color:#ff9702;margin:10px 0 10px 30px;font-weight:800;}
        .detailContent .detailBtm .detailBtmLeft .detailBtmInfo{border:5px solid #d1d6dc;}
        .detailContent .detailBtm .detailBtmLeft .detailBtmInfo .baseDropsInfo--wbxz8fyq {width: 100%;}
        .detailContent .detailBtm .detailBtmLeft .detailBtmInfo .baseDropsInfo--wbxz8fyq .tableWrapper--APDk75pt {border-left: 1px solid #f0f3f5;border-radius: 4px;border-top: 1px solid #f0f3f5;display: flex;flex-direction: row;flex-wrap: wrap;overflow: hidden;width: 100%;}
        .detailContent .detailBtm .detailBtmLeft .detailBtmInfo .infoItem--Z4hNxv8b {--variable-limitLineNumver: 2;align-items: center;background: #fff;border-bottom: 1px solid #f0f3f5;border-right: 1px solid #f0f3f5;display: flex;flex-direction: row;justify-content: flex-start;position: relative;width: 50%;}
        .detailContent .detailBtm .detailBtmLeft .detailBtmInfo .infoItem--Z4hNxv8b .infoItemTitle--P41WPBIx {align-items: center;background: #f3f6f8;color: #11192d;display: flex;flex-direction: row;font-family: PingFangSC-Medium;font-size: 14px;height: 100%;justify-content: flex-start;letter-spacing: 0;line-height: 18px;min-height: 50px;padding: 0 24px;text-align: left;width: 160px;font-weight: 800;color:#000;}
        .detailContent .detailBtm .detailBtmLeft .detailBtmInfo .infoItem--Z4hNxv8b .infoItemContent--IJwpPvuk {-webkit-box-orient: vertical;-webkit-line-clamp: var(--variable-limitLineNumver);color: #11192d;display: -webkit-box;font-family: PingFangSC-Medium;font-size: 14px;letter-spacing: 0;line-height: 20px;margin: 0 24px;max-height: 40px;overflow: hidden;text-align: left;width: 240px;font-weight: 800;color:#000;}
        .detailContent .detailBtm .detailBtmLeft .detailBtmInfo p video{width: 100%;}
        .detailContent .detailBtm .detailBtmLeft .detailBtmInfo p img{width: 100%;}
        .detailContent .detailBtm .detailBtmRight{width: calc(30% - 20px);height:fit-content;float:left;margin-left:20px;margin-top:45px;}
        .detailContent .detailBtm .detailBtmRight .buyBox{width: 100%;height:fit-content;float:left;border:5px solid #d1d6dc;}
        .detailContent .detailBtm .detailBtmRight .buyBox .buyBoxHead{width: 100%;height:fit-content;padding:10px;box-sizing: border-box;}
        .detailContent .detailBtm .detailBtmRight .buyBox .buyBoxHead .buyBoxImg{width:100px;height:100px;display: inline-block;}
        .detailContent .detailBtm .detailBtmRight .buyBox .buyBoxHead .now-prices{margin-left:10px;width: calc(100% - 120px);height: 60px;line-height:35px;display: inline-block;background: #E3E6EB;padding: 10px 10px;box-sizing: border-box;justify-content: space-between;border: 2px solid #d9d9d9;border-radius: 5px;}
        .detailContent .detailBtm .detailBtmRight .buyBox .buyBoxHead .now-prices .priceDiv * {font-size: 18px;}
        .detailContent .detailBtm .detailBtmRight .buyBox .buyBoxHead .now-prices .priceDiv .SZY-CURRENCY {font-size: 18px;color: #000;}
        .detailContent .detailBtm .detailBtmRight .buyBox .buyBoxHead .now-prices .priceDiv .SZY-PRICE {font-size: 18px;color: #db1d18;}
        .detailContent .detailBtm .detailBtmRight .buyBox .buyBoxMiddle{padding:0 10px;box-sizing:border-box;}
        .detailContent .detailBtm .detailBtmRight .buyBox .buyBoxMiddle .layui-tab-title .layui-this:after{height:32px;}
        .detailContent .detailBtm .detailBtmRight .buyBox .buyBoxMiddle .choose dl.attr dd li{width:97%;}
        .detailContent .detailBtm .detailBtmRight .buyBox .buyBoxBtm{padding:0 10px;box-sizing: border-box;margin-bottom:10px;}
        .detailContent .detailBtm .detailBtmRight .buyBox .buyBoxBtm .buy_div .select_buy{width:100%;margin-top:5px;}
        .detailContent .detailBtm .detailBtmRight .buyBox .buyBoxBtm .buy_div .already_select{width:100%;overflow: hidden;}
        .detailContent .detailBtm .detailBtmRight .buyBox .buyBoxBtm .buy_div .already_select .selectOptionName{width:100%;}
        /*商品尾部详情信息end*/

        .layui-btn-danger{background: #db1d18;}
        .footer ul.social-network li{height:24px !important;}
        @media (max-width: 992px){
            body{width:100% !important;min-width: 100% !important;}
            .sort_div, .addr{grid-template-columns: repeat(1,1fr);}
            .w1210{width: 100% !important;margin: 110px 0 0;}

            /*轮播图*/
            .preview{width: 100% !important;float:unset;}
            .goods-info{width: 100% !important;}
            .goodsgallery{float:unset;width: 100% !important;}
            .goodsgallery .gg-current-img img{width: 100% !important;height:fit-content;}
            .goodsgallery .gg-container{float:unset;}
            .goodsgallery .gg-container li{width: 20%;height:fit-content;}
            .goodsgallery .gg-container .gg-content{height:fit-content;float:unset;}
            .goodsgallery .gg-container ul{position:unset;}
            .goods-gallery-bottom{width: 100%;margin-top:20px;}

            /*商品基本信息===start*/
            .detail-info{width: 100%;padding:0;}
            /*商品名称*/
            .detail-info .goods-name{width: 100%;margin-top:20px;}
            /*商品价格*/
            .detail-info .goods-price{height:fit-content;}
            .detail-info .goods-price .now-prices{float:unset;min-width: 100%;}
            /*服务响应*/
            .detail-info .goods-price .now-service{float:unset;margin-top:20px;}
            /*运货&收货地址*/
            .purchase_process{width: 100%;}
            .purchase_process .label-two .rightLabel{margin-top:10px;}
            /*库存属性*/
            .choose dl.attr dd li{width: 47%;}
            .choose dl.attr dd li:nth-child(odd) .attr_children:before{left:calc(50% - 245px);}
            .choose dl.attr dd li:nth-child(even) .attr_children:before{left:calc(50% - 245px);}
            .choose dl.attr dd li:nth-child(odd) .attr_children .attr_childrenBox {min-width: calc(105% * 2);max-width: calc(105% * 2);}
            .choose dl.attr dd li:nth-child(even) .attr_children .attr_childrenBox {min-width: calc(68% * 2);max-width: calc(68% * 2);}
            .attr_children .closeAttrDiv{right:-170px;}
            .choose dl.attr dd li:nth-child(even) .attr_children{left:-165px;}
            /*已选规格*/
            .buy_div{display: inline-block;}
            .buy_div .already_select .selectBtn{min-width:48px;text-align: center;}
            .buy_div .amount_num{width: 100%;}
            .buy_div .already_select .selectOptionName .select_param{width: 65px;min-width: 65px;max-width: 85px;}
            .buy_div .select_buy{width:100%;}
            .buy_div .amount-input{width: 80%;}
            .buy_div .select_buy .select_buy_headBox{margin-top:15px;}
            .buy_div .select_buy .select_buy_btmBox{margin-top:15px;}
            .buy_div .select_buy .select_buy_btmBox .SZY-PRICE{min-width: 120px;}
            /*商品详情购买框*/
            .detailContent .detailBtm .detailBtmRight{display:none;}
            .detailContent .detailBtm .detailBtmLeft{width:100%;}
            /*商品描述头部*/
            .detailContent .detailHead{max-width: 100%;}
            .detailContent .detailHead .detailHeadBox .detailHeadTxt{margin-right:unset;width: 100px;}
            .detailContent .detailHead .detailBtmBox .detailBtmDiv .detailBtmTxt{width: 105px;margin-right:0;}
            /*商品基本信息===end*/

            .MagicZoomBigImageCont{display:none;}
        }
    </style>
    <div class="w1210">
        <div class="disf" style="align-items: normal;margin-top:20px;">
            <div class="goods-info">
                <!-- 商品详细信息 -->
                <!-- 商品图片以及相册 _star-->
                <div id="preview" class="preview">
                    <!-- 商品相册容器 -->
                    <div class="goodsgallery"></div>
                    <script id="SZY_SKU_IMAGES" type="text">
                        {!! json_encode($sku['sku_images']) !!}
                    </script>
                    <script type="text/javascript">
                        // 图片相册
                        $(".goodsgallery").goodsgallery({
                            images: $.parseJSON($("#SZY_SKU_IMAGES").html()),
                            video:"{{$goods['goods_video']}}"
{{--                            video: " get_video_url($goods['goods_video'])"--}}
                        });
                    </script>
                    <!--相册 END-->

                    <div class="goods-gallery-bottom">
                        {{--浏览量--}}
                        <a href="javascript:void(0);" class="goods-compare compare-btn fr add-compare" data-goods-id="" data-sku-id="" data-image-url="?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" style="display: none;">
                            <i class="iconfont icon-yanjing" style="background: url(/assets/d2eace91/images/newhome/grey_eyes.png) 0 5px no-repeat;    background-size: 100%;"></i>
                            {{$goods['click_count']}}
                        </a>

                        {{--加入分销--}}
                        <a href="javascript:void(0);" class="goods-compare compare-btn fr add-compare" data-goods-id="" data-sku-id="" data-image-url="?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320">
                            <i class="iconfont icon-shuma"></i>
                            加入分销
                        </a>

                        {{--收藏--}}
                        <a href="javascript:void(0);" class="goods-col fr @if($goods['is_collect']) curr @endif collect-goods" data-goods-id="{{ $goods['goods_id'] }}">
                            @if($goods['is_collect'])
                                {{--已收藏--}}
                                <i class="iconfont">&#xe6b1;</i>
                                <span>取消收藏({{ $goods['collect_num'] }}人气)</span>
                            @else
                                {{--未收藏--}}
                                <i class="iconfont">&#xe6b3;</i>
                                <span>收藏商品</span>
                            @endif
                        </a>

                        {{--分享积分--}}
                        <!--<div class="bdsharebuttonbox fr">-->
                        <!--    <a class="bds_more" href="#" data-cmd="more" style="background: none; color: #999; line-height: 25px; height: 25px; display: block;">-->
                        <!--        <i class="iconfont">&#xe6ac;</i>-->
                        <!--        分享积分-->
                        <!--    </a>-->
                        <!--</div>-->
                        
                        {{--分享小程序--}}
                        <div class="bdsharebuttonbox fr">
                            <a class="bds_more2" href="javascript:get_miniprogram();" style="background: none; color: #999; line-height: 25px; height: 25px; display: block;margin-left:5px;">
                                <!--<i class="iconfont">&#xe6ac;</i>-->
                                <img src="/static/api/img/share/weixin_miniprogram.ico" style="width:15px;height:15px;">
                                分享小程序
                            </a>
                        </div>
                    </div>

                    <script type="text/javascript">
                        window._bd_share_config = {
                            "common": {
                                "bdSnsKey": {},
                                "bdText": "我在@" + "{{$website['name']}}" + " 发现了一个非常不错的商品：" + $(".SZY-GOODS-NAME-BASE").text() + "。感觉不错，分享一下~",
                                "bdMini": "2",
                                "bdMiniList": false,
                                "bdPic": "{{ get_image_url($goods['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320",
                                "bdStyle": "0",
                                "bdSize": "16"
                            },
                            "share": {}
                        };
                        with (document) {
                            0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = '/static/api/js/share.js?v=<?php echo time();?>.js?cdnversion=' + ~(-new Date() / 36e5)];
                        }
                    </script>
                </div>
                <!-- 商品图片以及相册 _end-->

                <!-- 商品详细信息 _star-->
                <div class="detail-info">
                    <form action="" method="post" name="" id="">
                        <!-- 商品名称 -->
                        <div class="goods-name SZY-GOODS-NAME">
                            <div class="goodsName" style="min-height:48px;">{{$goods['goods_name']}}</div>
                            @if($goods['shop_id']==0)
                                <div class="goods-brief goodsUrl">
                                    <a href="{{$goods['other_goods_link']}}" target="_blank" class="goods-url">商品链接&gt;</a>
                                </div>
                                <div class="goods-brief priceHistory">
                                    <a href="javascript:history_price();" class="goods-url" style="background:#ff9702;">历史价格&gt;</a>
                                </div>
                            @endif
                        </div>

                        <!--商品价格-->
                        <div class="goods-price">
                            <div class="now-prices disf">
                                <div class="@if($goods['shop_id']==0) priceDiv @else priceDiv1 @endif">
                                    @if($goods['shop_id']==0)
                                        <strong class="p-price SZY-GOODS-PRICE"><span class="SZY-CURRENCY">{{$goods['currency']}}</span>&nbsp;<span class="SZY-PRICE"><?php echo number_format($goods['goods_price'], 2);?></span></strong>
                                    @else
                                        <style>
                                            .priceDiv1{min-width:190px;}
                                            .step_price_div{max-height: 75px;overflow-y: auto;width: 100%;overflow-x: clip;scrollbar-color: {{$website['color']}} #ffffff;}
                                            .step_price_div .font12{color:#000;font-size:12px !important;font-weight:800;}
                                            .step_price_div .font15{color:#000;font-size:15px !important;font-weight:800;}
                                            .step_price_div .price{color:#db1d18;font-size:15px !important;font-weight:800;padding-left:2px !important;}
                                            .step_price_div .step_num{min-width:80px;}
                                        </style>
                                        <div class="step_price_div">
                                            @foreach($sku['sku_prices']['start_num'] as $k=>$v)
                                                <div class="disf">
                                                    <div class="disf step_num">
                                                        <div class="start_num font12">{{$v}}</div>
                                                        @if($sku['sku_prices']['select_end'][$k]==1)
                                                            -
                                                            <div class="end_num font12">{{$sku['sku_prices']['end_num'][$k]}}</div>
                                                            <div class="unit font12">{{$sku['sku_prices']['unit'][0]}}</div>
                                                        @else
                                                            <div class="end_num font12">{{$sku['sku_prices']['unit'][0]}}&nbsp;以上</div>
                                                        @endif
                                                    </div>
                                                    <div class="disf step_price_box">
                                                        <div class="disf" style="justify-content: left;">
                                                            <div class="font15 currency">{{$sku['sku_prices']['currency'][0]}}</div>
                                                            <div class="font15 price"><?php echo number_format($sku['sku_prices']['price'][$k], 2);?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                                <div class="operaDiv">
                                    <div class="operaBtn">个性定制&nbsp;></div>
                                    <div class="operaBtn" onclick="exchangeBtn({{$goods['goods_price']}})">币种换算&nbsp;></div>
                                </div>
                            </div>
                            <div class="now-service">
                                <p class="service-one">服务响应：</p>
                                @foreach($timeInterval as $k=>$v)
                                <p>· 北京时间<span class="serviceTimeSpan">{{$v['start']}}</span>~<span class="serviceTimeSpan">{{$v['end']}}</span>付款，预计{{$v['typeName']}}<span class="serviceTimeSpan">{{$v['fast']}}</span>前响应</p>
                                @endforeach
                            </div>
                        </div>

                        <!--运费&收货地址-->
                        <div class="purchase_process">
                            <dl class="goods-options-row goods-options-freight">
                                <dd class="cn new-goods-options-content">
                                    @if($goods['service_type']==1 || $goods['gather_method']==1 || $goods['shop_id']==0)
                                        <div class="label label-one" style="justify-content: space-between;">
                                            <div class="leftLabel">
                                                <span class="label-title">中国卖家</span>
                                                <span class="font-icon arrow">&gt;</span>
                                                <span class="label-title">中国集货仓</span>
                                            </div>
                                            <div class="rightLabel">
                                                <span>国内运费：</span>
                                                @if($goods['domestic_baoyou']==1)
                                                    <span class="freight_price">免费</span>
                                                @elseif($goods['domestic_baoyou']==2)
                                                    <span class="freight_currency">CNY</span>
                                                    <span class="freight_price" style="color:#db1d18;">{{$goods['goods_freight_fee']}}</span>
                                                @else
                                                    <span class="freight_price">免费</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="label label-two" style="justify-content: space-between;">
                                            <div class="leftLabel" style="display: flex;align-items: center;">
                                                <span class="label-title">中国集货仓</span>
                                                <span class="font-icon arrow">&gt;</span>
                                                <span class="label-title">选择邮编：</span>
                                                <select id="selectCountry" onchange="selectCountrys(this)" class="chosen-select country-selects">
                                                    <option value="">请选择</option>
                                                    @foreach($country as $k=>$v)
                                                        <option value="{{$v['id']}}">{{$v['param2']}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="sel_postal" style="display: inline-block;margin-left:5px;">

                                                </div>
                                                <select id="select_addr" onchange="select_addrr(this)" style="display:none;min-width: 130px;width: 130px;color: #000;">
                                                    <option value="">——请选择操作——</option>
                                                    <option value="1" @if(empty($address))
                                                    disabled="disabled"
                                                            @else
                                                            selected
                                                            @endif>选择地址</option>
                                                    <option value="2">新增地址</option>
                                                </select>
                                            </div>
                                            <div class="rightLabel">
                                                <a href="javascript:freight_calc(this);" class="freight_estimate">国际运费估算 >></a>
                                            </div>
                                        </div>
                                    @elseif($goods['service_type']==2 || $goods['gather_method']==2 || $goods['support_export']==1)
                                        <!--支持跨境配送&自主集运-->
                                        <div class="label label-one" style="justify-content: space-between;">
                                            <div class="leftLabel">
                                                <span class="label-title">卖家发货</span>
                                                <span class="font-icon arrow">&gt;</span>
                                                <span class="label-title">地址：{{$goods['shipping_country_info']['param2']}}
                                                    @foreach($goods['shipping_areas'] as $k=>$v)
                                                        {{$v['code_name']}}
                                                    @endforeach
                                                </span>
                                            </div>
                                            <div class="rightLabel">
                                                <span>国内运费：</span>
                                                @if($goods['domestic_baoyou']==1)
                                                    <span class="freight_price">免费</span>
                                                @elseif($goods['domestic_baoyou']==2)
                                                    <span class="freight_currency">CNY</span>
                                                    <span class="freight_price" style="color:#db1d18;">{{$goods['goods_freight_fee']}}</span>
                                                @else
                                                    <span class="freight_price">免费</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="label label-two" style="justify-content: space-between;">
                                            <div class="leftLabel" style="display: flex;align-items: center;">
                                                <span class="label-title">支持集运的国地</span>
                                                <span class="font-icon arrow">&gt;</span>
                                                <span class="label-title">选择邮编：</span>
                                                <select id="selectCountry" onchange="selectCountrys(this)" class="chosen-select country-selects">
                                                    <option value="">请选择</option>
                                                    @foreach($country as $k=>$v)
                                                        <option value="{{$v['id']}}">{{$v['param2']}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="sel_postal" style="display: inline-block;margin-left:5px;">

                                                </div>
                                            </div>
                                            <div class="rightLabel">
                                                <a href="javascript:freight_calc(this);" class="freight_estimate">国际运费估算 >></a>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="label label-three country-select2" style="display:none;">
                                        <div class="country-select-search ant-select ant-select-enabled">
                                            <div class="ant-select-selection ant-select-selection--single" tabindex="0">
                                                <div class="disf">
                                                    <select name="address_id" id="address_id" style="border: 1px solid #000;padding: 0px 10px;width: 220px;color:#000;" lay-verify="required">
                                                        <option value="">————请选择————</option>
                                                        @if(!empty($address))
                                                            @foreach($address as $k=>$v)
                                                                <option value="{{$v['id']}}" @if($v['is_default']==1)
                                                                selected
                                                                        @endif>{{$v['user_name']}}，{{$v['mobile']}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </dd>
                            </dl>
                        </div>

                        <div class="choose_buy">
                            <!--商品规格-->
                            <div class="choose SZY-GOODS-SPEC-ITEMS" style="display: @if($goods['have_specs']==2) none @endif ;">
                                @if(!empty($goods['spec_list']))
                                <div class="layui-tab" lay-filter="test-hash">
                                    <ul class="layui-tab-title">
                                        @foreach($goods['spec_list'] as $k=>$v)
                                            @if(isset($v['attr_name']))
                                                <li class="@if($k==0)
                                                        layui-this
                                                    @endif" lay-id="{{$v['attr_id']}}">{{$v['attr_name']}}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                    <div class="layui-tab-content">
                                        @foreach($goods['spec_list'] as $k=>$v)
                                            @if(isset($v['attr_name']))
                                                <div class="layui-tab-item @if($k==0)
                                                        layui-show
                                                @endif">
                                                    <!-- 如果规格下没有库存，红色提示背景给dl标签追加class值"no-stock-bg" -->
                                                    <dl class="attr attr{{$v['attr_id']}} @if($k==0)
                                                            attr_show
@else
                                                            attr_hide
@endif">
                                                        <dd class="dd">
                                                            <ul class="ul0" data-attr-id="{{ $v['attr_id'] }}">

                                                            @foreach($v['attr_values'] as $kk=>$vv)
                                                                <!-- 属性值被选中的状态 -->
                                                                    <!-- 如果规格下没有库存，虚线格式给li标签追加class值“no-stock” -->
                                                                    <li class="goods-spec-item @if($vv['has_sku']==-1) not_price_allow @else price_allow  @endif
                                                                        @if(in_array($vv['attr_vid'], $sku['spec_vids'])) selected @endif"
                                                                        data-spec-id="{{ $v['attr_id'] }}" data-attr-id="{{ $vv['attr_vid'] }}" data-is-default="{{ $v['is_default'] }}" data-points-goods="0" data-attr-have_child="@if(!empty($vv['children'])) 1 @else 0 @endif">
                                                                        <a href="javascript:void(0);" title="{{ $vv['attr_value'] }}" @if(!empty($vv['children']))
                                                                            onclick="show_children_attrvalue(this,{{$vv['attr_vid']}})"
                                                                        @endif>
                                                                            @if($v['is_default'] && !empty($vv['spec_image']))
                                                                                <img src="{{ get_image_url($vv['spec_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" width="34" height="34" alt="">
                                                                            @endif
                                                                            <span class="value-label">{{ $vv['attr_value'] }}</span>
                                                                        </a>
                                                                        @if(!empty($vv['children']))
                                                                            <!--手指-->
                                                                            <img src="/images/have_child_finger.png" class="have_child_finger" onclick="show_children_attrvalue(this,{{$vv['attr_vid']}})">
                                                                            <!--下级属性DIV-->
                                                                            <div class="attr_children">
                                                                                <div class="closeAttrDiv" style="@if(count($vv['children'])<=2) right:0px; @endif" onclick="close_children_attrvalue(this,{{$vv['attr_vid']}})">×</div>
                                                                                <div class="attr_childrenBox">
                                                                                    <ul data-attr-id="{{ $v['attr_id'] }}">
                                                                                        @foreach($vv['children'] as $k3=>$v3)
                                                                                            <?php $attr_vid3=$vv['attr_vid'].'-'.$v3['attr_vid'];?>
                                                                                            <li class="goods-spec-item @if($vv['has_sku']==-1) not_price_allow @else price_allow  @endif
                                                                                            @if(in_array($attr_vid3, $sku['spec_vids'])) selected @endif"
                                                                                                data-spec-id="{{ $v['attr_id'] }}" data-attr-id="{{$attr_vid3}}" data-is-default="{{ $v['is_default'] }}" data-points-goods="0" data-attr-have_child="0">
                                                                                                <a href="javascript:void(0);" title="{{ $v3['attr_value'] }}">
                                                                                                    @if($v['is_default'] && !empty($v3['spec_image']))
                                                                                                        <img src="{{ get_image_url($v3['spec_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" width="34" height="34" alt="">
                                                                                                    @endif
                                                                                                    <span class="value-label">{{ $v3['attr_value'] }}</span>

                                                                                                </a>
                                                                                                <i></i>
                                                                                            </li>
                                                                                        @endforeach
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                        <i></i>
                                                                    </li>
                                                                @endforeach

                                                            </ul>
                                                        </dd>
                                                    </dl>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                            </div>

                            <!--已选规格&选购数量-->
                            <div class="buy_div disf" style="justify-content: space-between;">
                                <!--已选规格-->
                                @if($goods['have_specs']==1)
                                    <div class="already_select disf amount amount_num">
                                        <div class="selectBtn">已选</div>
                                        <div class="selectOptionName">
                                            @if(!empty($goods['spec_list']))
                                                @foreach($goods['spec_list'] as $k=>$v)
                                                    @if(isset($v['attr_name']))
                                                        <div class="disf paramDiv param{{$v['attr_id']}}">
                                                            <div class="select_param" title="{{$v['attr_name']}}">{{$v['attr_name']}}</div>
                                                            <div class="optionSel">
                                                                @foreach($v['attr_values'] as $kk=>$vv)
                                                                    @if(!empty($vv['children']))
                                                                        @foreach($vv['children'] as $k3=>$v3)
                                                                            <?php $now_attrIds = $vv['attr_vid'].'-'.$v3['attr_vid'];?>
                                                                            @if(in_array($now_attrIds, $sku['spec_vids']))
                                                                                <span title="{{ $vv['attr_value'] }}-{{ $v3['attr_value'] }}">{{ $vv['attr_value'] }}-{{ $v3['attr_value'] }}</span>
                                                                            @endif
                                                                        @endforeach
                                                                    @else
                                                                        @if(in_array($vv['attr_vid'], $sku['spec_vids']))
                                                                            <span title="{{ $vv['attr_value'] }}">{{ $vv['attr_value'] }}</span>
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                <!--选购数量-->
                                <div class="select_buy">
                                    <div class="select_buy_headBox disf">
                                        <div class="selectBtn">数量</div>
                                        <dl class="amount amount_num">
                                            <dd class="dd">
                                            <span class="amount-widget">
                                                <input type="text" class="amount-input" value="1"
                                                       data-sales_model="{{ $goods['sales_model'] }}"
                                                       data-goods_id="{{ $goods['goods_id'] }}"
                                                       data-sku_id="{{ $sku['sku_id'] }}"
                                                       data-amount-min="1"
                                                       data-amount-max="{{ $sku['goods_number'] }}"
                                                       maxlength="8" title="请输入购买量">
                                                <span class="amount-btn">
                                                    <span class="amount-plus">
                                                        <i>+</i>
                                                    </span>
                                                    <span class="amount-minus">
                                                        <i>-</i>
                                                    </span>
                                                </span>
                                            </span>
                                            </dd>
                                        </dl>
                                        @if($goods['goods_status']==1)
                                        <div class="btn_buy buy-goods-soon">立即购买</div>
                                        @endif
                                    </div>
                                    <div class="select_buy_btmBox disf">
                                        <div class="priceDiv">
                                            @if($goods['shop_id']==0)
                                                <div class="p-price SZY-GOODS-PRICE disf"><div class="SZY-CURRENCY">{{$goods['currency']}}</div>&nbsp;<div class="SZY-PRICE"><?php echo number_format($goods['goods_price'], 2);?></div></div>
                                            @else
                                                <div class="p-price sSZY-GOODS-PRICE disf"><div class="SZY-CURRENCY">{{$goods['currency']}}</div>&nbsp;<div class="SZY-PRICE"><?php echo number_format($goods['goods_price'], 2);?></div></div>
                                            @endif
                                        </div>
                                        @if($goods['goods_status']==1)
                                        <div class="btn_buy join_list" onclick="join_list()">加入选购</div>
                                        @endif
{{--                                        <div class="btn_buy yixuan show_list" onclick="show_glist(this)"><img src="/images/book.png" style="width:20px;height:20px;"></div>--}}
                                        <div class="btn_buy yixuan show_list" onclick="javascript:window.location.href='/cart.html';"><img src="/images/book.png" style="width:20px;height:20px;"></div>
                                    </div>
                                </div>
                            </div>

                            <!--加入清单start（点击“加入选购”按钮默认点击这个“立即订购”按钮）-->
                            <div class="buy_list" style="display:none;">
                                <div class="glist_form" style="display: none;">
                                    <form class="layui-form" action="" method="post" lay-filter="glist-element">
                                        @csrf
                                        <div class="buy_table">

                                        </div>
                                        <div class="buy_info">
                                            <div class="goods_info">
                                                <div class="gi_num disf gi_border">
                                                    <div class="gi_label">商品数量</div>
                                                    <div class="gi_info disf">
                                                        <div class="gi_number"></div>
                                                        <div class="gi_unit">{{$sku_info[0]['sku_prices']['unit'][0]}}</div>
                                                    </div>
                                                </div>
                                                <div class="gi_prices disf gi_border">
                                                    <div class="gi_label">商品总价</div>
                                                    <div class="gi_info disf">
                                                        <div class="gi_currency" style="margin-right:5px;">{{$goods['currency']}}</div>
                                                        <div class="gi_price">0</div>
                                                    </div>
                                                </div>
                                                @if($goods['shop_id']>0 && empty($goods['drug_id']) && 1>2)
                                                    <div class="gi_otherfee disf gi_border">
                                                        <div class="gi_label">其他费用</div>
                                                        <div class="gi_info disf">
                                                            <div class="gi_otherfee_currency">{{$goods['otherfee_currency']}}</div>
                                                            <div class="gi_otherfee_price">
                                                                <div class="otherfee_price">{{$goods['otherfee_total']}}</div>
                                                                <div class="otherfee_div" style="display: none;">
                                                                    <table class="layui-table">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>费用名称</th>
                                                                            <th>费用说明</th>
                                                                            <th>计费标准</th>
                                                                            <th>计费价格</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="gi_preferential disf gi_border">
                                                        <div class="gi_label">购物优惠</div>
                                                        <div class="gi_info disf">
                                                            <div class="preferential_div">
                                                                <div class="see_prefe">查看优惠</div>
                                                                <div class="prefe_info" style="display: none;">
                                                                    <div class="offer-title"><div class="offer-title-icon"></div><div class="offer-title-content">减免优惠</div></div>
                                                                    <table class="layui-table reduction_table">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>优惠类别</th>
                                                                            <th>减免项目</th>
                                                                            <th>减免金额</th>
                                                                            <th>减免限制</th>
                                                                            <th>操作</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>

                                                                        </tbody>
                                                                    </table>

                                                                    <div class="offer-title" style="padding-top:15px;"><div class="offer-title-icon"></div><div class="offer-title-content">随赠优惠</div></div>
                                                                    <table class="layui-table gift_table">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>优惠类别</th>
                                                                            <th>随赠项目</th>
                                                                            <th>随赠内容</th>
                                                                            <th>随赠限制</th>
                                                                            <th>操作</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="reduction_prices disf gi_border">
                                                        <div class="gi_label">优惠减免</div>
                                                        <div class="gi_info disf">
                                                            <div class="gi_currency">-&nbsp;{{$goods['reduction_content']['currency1'][0]}}</div>
                                                            <div class="reduction_price">0</div>
                                                        </div>
                                                    </div>
                                                    <div class="gift_prices disf gi_border" style="display: none;">
                                                        <div class="gi_label">抵扣费用</div>
                                                        <div class="gi_info disf">
                                                            <div class="gift_content">
                                                                <div class="disf">
                                                                    <div class="points_divs gift_common" style="display: none;">
                                                                        <div class="disf">
                                                                            <div class="points_divName">积分</div>
                                                                            <div class="points_divCurrency"></div>
                                                                            <div class="points_divMoney"></div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="coupon_divs gift_common" style="display: none;">
                                                                        <div class="disf">
                                                                            <div class="coupon_divName">卡券</div>
                                                                            <div class="coupon_divCurrency"></div>
                                                                            <div class="coupon_divMoney"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="product_prices disf gi_border" style="display:none;">
                                                        <div class="gi_label">订单随赠</div>
                                                        <div class="gi_info disf">
                                                            <div class="prefeProduct_div">
                                                                <div class="see_prefeProduct">查看随赠</div>
                                                                <div class="prefeProduct_info" style="display: none;">
                                                                    <table class="layui-table prefeProduct_table">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>类别</th>
                                                                            <th>内容</th>
                                                                            <th>数量</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            <!--服务-->
                                                <style>
                                                    .gi_services input[type="checkbox"],.gi_services input[type="radio"]{display: none;}
                                                    .gi_services .layui-form-radio{margin-top:0;margin-right:2px;}
                                                    .layui-form-radio>i:hover, .layui-form-radioed>i{color:#1f5188;}
                                                    .gi_services .gantan{width:20px;margin-left:10px;}
                                                    .gi_services .photoNum{margin:0 2px;}
                                                    .gi_services .servicesTitle{font-size:15px;}
                                                    .gi_services .servicesPrice{font-size:15px;color:#e60000;float:right;font-weight: 600;}
                                                    .gi_services .servicesCon{width: 100%;margin-bottom:10px;}
                                                    .gi_services .servicesCon .servicesInput,.gi_services .servicesCon .servicesTitle,.gi_services .servicesCon .servicesTips,.gi_services .servicesCon .servicesPrice{display:inline-block;}
                                                    .gi_services .tipsDiv{padding:20px;box-sizing: border-box;font-size:15px;}
                                                    /**已选/未选样式**/
                                                    .alselBox{position:relative;}
                                                    .alsel,.alsel2{cursor:pointer;}
                                                    .alsel:after{content: '';position: absolute;width: 8px;height: 8px;border-top: 1px solid #666;border-right: 1px solid #666;right: -20px;top: 5px;transform: rotate(135deg);}
                                                    .alsel2:after{content: '';position: absolute;width: 8px;height: 8px;border-top: 1px solid #666;border-right: 1px solid #666;right: -20px;top: 6px;transform: rotate(-45deg);}
                                                    .alselBox .servicesDiv{background:#fff;padding:20px;box-sizing: border-box;box-shadow: 0px 0px 10px 1px #999;position: absolute;top: 20px;left: -85px;z-index: 11;min-width: 578px;}
                                                </style>
                                                <div class="gi_services disf gi_border" style="display: none;">
                                                    <div class="gi_label">更多服务</div>
                                                    <div class="gi_info disf">
                                                        <div class="alselBox">
                                                            <div class="alsel">已选<span class="projectNum">1</span>项</div>
                                                            <div class="servicesDiv" style="display: none;">
{{--                                                                $services_money--}}
                                                                <input type="number" id="service_money" value="0" style="display: none;">
                                                                <input type="number" id="photo_money" value="0" style="display: none;">
                                                                @foreach($services as $k=>$v)
                                                                    <div class="servicesCon" data-id="{{$v['id']}}" data-type="{{$v['type']}}">
                                                                        <input type="checkbox" name="services[]" class="servicesInput" lay-ignore value="@if($v['is_select']==1)
                                                                                1
@else
                                                                                0
@endif" onclick="select_services({{$v['id']}},{{$v['type']}},this,'{{$v['name']}}')" @if($v['is_select']==1)
                                                                               checked disabled
                                                                                @endif>
                                                                        @if($v['type']==1)
                                                                            <div class="servicesTitle">【{{$v['name']}}】&nbsp;共需<span class="photoNum">1</span>件</div>
                                                                        @else
                                                                            <div class="servicesTitle">【{{$v['name']}}】&nbsp;{{$v['desc']}}</div>
                                                                        @endif
                                                                        <div class="servicesTips">
                                                                            <img src="/images/gantanhao.png" class="gantan" onclick="showTips(this,'{{$v['name']}}')">
                                                                            <div class="tipsDiv" style="display: none;">
                                                                                @if($v['type']==3)
                                                                                    {{$time_interval}}
                                                                                @else
                                                                                    {!! $v['tips'] !!}
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        @if($v['type']==2)
                                                                            <div class="servicesTitle disf" style="margin-left:10px;">
                                                                                <input type="radio" name="services_child[{{$k}}]" value="1" title="是" checked>
                                                                                <input type="radio" name="services_child[{{$k}}]" value="0" title="否">
                                                                            </div>
                                                                        @endif
                                                                        <div class="servicesPrice">
                                                                            {{$v['currency']}} <span class="serprice">{{$v['price']}}</span>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="gi_pay disf gi_border">
                                                    <div class="gi_label">实付费用</div>
                                                    <div class="gipay_info disf">
                                                        <div class="gipay_currency" style="margin-right:5px;">{{$goods['currency']}}</div>
                                                        <div class="gipay_price">0</div>
                                                    </div>
                                                </div>
                                                @if(isset($goods['platform_valueInfo']))
                                                    @if(isset($goods['platform_valueInfo']['perform_type']))
                                                        <div class="gi_attention disf gi_border" style="margin-top:10px;">
                                                            <div class="gi_label" style="text-align: right;padding-right: 11px;box-sizing: border-box;">注意</div>
                                                            <div class="giattention_info disf" style="width: 80%;">
                                                                {{$goods['platform_valueInfo']['msg']}}
                                                            </div>
                                                        </div>
                                                        @if($goods['platform_valueInfo']['perform_type']==1)
                                                            <div class="gi_file_div" style="display:none;background:#fff;">
                                                                <div class="layui-btn layui-btn-normal" style="background:#d3d3d3;position:absolute;right:0;top:0;font-size: 25px;padding: 0 15px;" onclick="cancel_buy()">×</div>
                                                                <div class="gi_file disf gi_border" style="margin-top:10px;">
                                                                    <div class="gi_label">文件上传</div>
                                                                    <div class="gifile_info disf" style="width: 80%;">
                                                                        <div class="layui-upload" style="text-align:left;width: 100%;">
                                                                            <button type="button" class="layui-btn" id="supervise_file-upload">上传文件</button>
                                                                            <blockquote class="layui-elem-quote layui-quote-nm yulan" style="margin-top: 10px;">
                                                                                预览图：
                                                                                <div class="layui-upload-list" id="supervise_file-upload-list"></div>
                                                                            </blockquote>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="upload_file_footer">
                                                                    <button class="layui-btn layui-btn-normal" lay-submit lay-filter="glist-element2" style="background:#ff0000;margin-left:70px;display:none;">立即订购</button>
                                                                    <button class="layui-btn layui-btn-normal" lay-submit lay-filter="glist-element3" style="border:1px solid #1E9FFF;color:#fff;margin-left:0px;">立即加购</button>
                                                                </div>
                                                            </div>
                                                        @elseif($goods['platform_valueInfo']['perform_type']==2 && $goods['platform_valueInfo']['drug']['value']['value']>=4)
                                                        <!--在线申请-->

                                                        @endif
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                        <div class="buy_footer disf">
                                            @if(!isset($goods['platform_valueInfo']))
                                                <button class="layui-btn layui-btn-normal" lay-submit lay-filter="glist-element2" style="background:#ff0000;display:none;">立即订购</button>
                                                <button class="layui-btn layui-btn-normal order_now" lay-submit lay-filter="glist-element3" style="border:1px solid #1E9FFF;color:#fff;margin-left:0px;background:{{$website['color']}};">立即订购</button>
                                            @else
                                                @if($goods['platform_valueInfo']['perform_type']==1)
                                                    <div class="layui-btn layui-btn-normal" style="background:#ff0000;" onclick="goto_buy()">上传文件</div>
                                                @elseif($goods['platform_valueInfo']['perform_type']==2 && $goods['platform_valueInfo']['drug']['value']['value']>=4)
                                                <!--在线申请-->
                                                    <button class="layui-btn layui-btn-normal" lay-submit lay-filter="apply-element" style="background:#ff0000;">在线申请</button>
                                                @endif
                                                <div class="layui-btn layui-btn-normal" style="background:#d3d3d3;" onclick="giveup_buy()">放弃购买</div>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                                <div class="yixuan_div" style="display: none;">
                                    <div class="yixuan" onclick="show_glist(this)">已选清单</div>
                                </div>
                            </div>
                            <!--加入清单end-->

                            <!--拍照需求start（废弃）-->
                            <div class="photoNumBox" style="display:none;padding:20px;box-sizing: border-box;font-size:15px;">
                                <input type="hidden" id="service_id" value="">
                                <div class="photo_wrap">
                                    <style>
                                        .photo-operation .amount-input {color: #666;font-size: 12px;margin: 0;margin-top: 1px;padding: 3px;display: inline-block;height: 24px;border: 1px solid #a7a6ac;width: 36px;line-height: 24px;vertical-align: middle;}
                                        .photo-operation .amount-btn {display: inline-block;vertical-align: middle;margin-left: -2.8px;margin-top: 1px;}
                                        .photo-operation .amount-btn i {width: 16px;height: 16px;font-size: 12px;color: #666;display: inline-block;}
                                        .photo-operation  .amount-plus {width: 16px;height: 16px;overflow: hidden;cursor: pointer;border: 1px solid #a7a6ab;border-left: none;display: block;line-height: 14px;text-align: center;background: #f1f1f1;}
                                        .photo-operation .amount-minus {width: 16px;height: 14px;overflow: hidden;cursor: pointer;border: 1px solid #a7a6ab;border-left: none;border-top: none;display: block;line-height: 14px;text-align: center;background: #f1f1f1;}
                                        .photo-operation .orion-input-number{margin-left:5px;}
                                        .remarks-list-wrap{max-height: 330px;overflow-y: scroll;}
                                        .photo_btnarea{margin-top:10px;text-align: right;}
                                    </style>
                                    <div class="photo-operation disf">
                                        <strong>要求数量</strong>
                                        <div class="orion-input-number">
                                            <input type="text" name="photonum" class="amount-input photonum" value="1" min="1" data-amount-min="1" data-amount-max="200" maxlength="8" readonly>
                                            <span class="amount-btn">
                                                     <span class="amount-plus" onclick="add_photonum(this,200)">
                                                         <i>+</i>
                                                     </span>
                                                     <span class="amount-minus" onclick="reduction_photonum(this)">
                                                         <i>-</i>
                                                     </span>
                                                </span>
                                        </div>
                                    </div>
                                    <!--照片要求-->
                                    <div class="remarks-list-wrap">
                                        <div class="child-order">
                                            <div class="count-box">
                                                <span>要求1</span>
                                            </div>
                                            <textarea rows="3" class="layui-textarea" name="photoRequest[]" maxlength="150" autocomplete="on" placeholder="备注特殊要求"></textarea>
                                        </div>
                                    </div>
                                    <!--确定/取消-->
                                    <div class="photo_btnarea">
                                        <div class="layui-btn layui-btn-primary" onclick="surephoto(this,0)">取消</div>
                                        <div class="layui-btn layui-btn-normal" onclick="surephoto(this,1)">确定</div>
                                    </div>
                                </div>
                            </div>
                            <!--拍照需求end-->

                            <!--选择收货地址start（废弃）-->
                            <div class="address_div" style="display: none;padding:15px;box-sizing: border-box;">
                                <form class="layui-form" action="" method="post" lay-filter="address-element">
                                    <div class="layui-card">
                                        <div class="layui-card-body" style="padding:0;">
                                            <div class="sort_div">
                                                <div class="layui-form-item">
                                                    <div class="layui-form-label">国地</div>
                                                    <div class="layui-input-block">
                                                        <!--<div id="xmselect_country" class="xm-select-demo" style="width:100%;"></div>-->
                                                        <style>
                                                            .countryBox{display:inline-block;margin-left:5px;margin-top:5px;}
                                                            .countryBox:first-child{margin-left:0;}
                                                            .countryDiv{width:100px;}
                                                        </style>
                                                        <div class="countryDiv countryBox">
                                                            <select name="country" id="country" lay-verify="required" lay-search lay-filter="country">
                                                                <option value="">请选择国地</option>
                                                                @foreach($country as $k=>$v)
                                                                    <option value="{{$v['id']}}">{{$v['param2']}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="countryDiv countryBox postal_sel"></div>
{{--                                                        <div class="countryDiv countryBox province"></div>--}}
{{--                                                        <div class="countryDiv countryBox city"></div>--}}
{{--                                                        <div class="countryDiv countryBox area"></div>--}}
{{--                                                        <div class="countryDiv countryBox area2"></div>--}}
{{--                                                        <div class="countryDiv countryBox area3"></div>--}}
{{--                                                        <div class="countryDiv countryBox area4"></div>--}}
                                                        <div class="diycountry" style="padding:2px 5px;box-sizing:border-box;display:none;">
                                                            <input class="layui-input countryDiv countryBox" name="diycountry[]" placeholder="邮政编码">

                                                            <div class="layui-btn layui-btn-success add" onclick="add_diycountry(this)" style="display:inline-block;">+</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" id="address_num" value="1">

                                                <div class="layui-form-item">
                                                    <div class="layui-form-label">详细地址</div>
                                                    <div class="layui-input-block disf">
                                                        <input type="text" class="layui-input" lay-verify="required" name="address1" value="" placeholder="请输入地址">
                                                        <div class="layui-btn layui-btn-success add" onclick="add_address()">+</div>
                                                    </div>
                                                </div>
                                                <div class="addr">

                                                </div>
                                                <div class="layui-form-item">
                                                    <div class="layui-form-label">收货人名称</div>
                                                    <div class="layui-input-block disf">
                                                        <input type="text" class="layui-input" lay-verify="required" name="user_name1" id="user_name1" value="" placeholder="请输入名">
                                                        <input type="text" class="layui-input" lay-verify="" name="user_name2" id="user_name2" value="" placeholder="请输入中间名">
                                                        <input type="text" class="layui-input" lay-verify="required" name="user_name3" id="user_name3" value="" placeholder="请输入姓">
                                                    </div>
                                                </div>
                                                <div class="layui-form-item">
                                                    <label class="layui-form-label">联系电话</label>
                                                    <div class="layui-input-block disf">
                                                        <input type="text" name="area_mobile" id="area_mobile" lay-verify="required" placeholder="区号" autocomplete="off" class="layui-input" value="" style="width:50px;" readonly>
                                                        <input type="text" name="mobile" lay-verify="required" placeholder="请输入联系电话" autocomplete="off" class="layui-input" value="">
                                                        <input type="text" name="mobile2" lay-verify="" placeholder="请输入联系电话2" autocomplete="off" class="layui-input" value="">
                                                    </div>
                                                </div>
                                                <div class="layui-form-item postalDiv" style="display: none;">
                                                    <div class="layui-form-label">邮政编码</div>
                                                    <div class="layui-input-block postal_div hide2">
                                                        <div class="disf">
                                                            <div style="width:42px;">例子：</div>
                                                            <div class="postal_rule disf"></div>
                                                        </div>
                                                        <div class="disf">
                                                            <div style="width:42px;">填写：</div>
                                                            <div class="postal_rule2 disf" style="width: 200px;"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="layui-form-item">
                                                    <div class="layui-form-label">电子邮箱</div>
                                                    <div class="layui-input-block">
                                                        <input type="text" class="layui-input" lay-verify="" name="email" id="email" value="" placeholder="请输入电子邮箱">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="disf" style="justify-content:center;text-align: center;">
                                                <button class="layui-btn" lay-submit="" lay-filter="address-element2" style="background:{{$website['color']}};">立即提交</button>
                                                <div style="margin-left:10px;">
                                                    <input type="checkbox" name="is_default" id="is_default" lay-skin="primary" title="默认" value="1" checked onclick="is_default(this)" style="display:none;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!--选择收货地址end-->
                        </div>
                    </form>
                </div>
                <script id="SZY_SKU_LIST" type="text">
                    {{--sku list--}}
                    {!! json_encode($goods['sku_list']) !!}
                </script>
                <script src="/assets/d2eace91/layui/xm-select3.js?v=20180418"></script>
                <script type="text/javascript">
                    var sku_ids = [];
                    var local_region_code = "{{ $region_code }}";
                    var sku_freights = [];
                    var change_sku_images = false;

                    //显示第三级规格型号
                    function show_children_attrvalue(t,attr_vid){
                        $('.attr_children').hide();
                        $(t).parent().find('.attr_children').show();
                        $('.attr_childrenBox .goods-spec-item').removeClass('selected');
                        $(t).parent().find('.attr_children').find('.attr_childrenBox ul').find('li').eq(0).click();
                    }
                    //关闭第三级规格型号
                    function close_children_attrvalue(t,attr_vid){
                        $(t).parent().hide();
                    }

                    //历史价格
                    function history_price(){
                        var $ = layui.$
                            , form = layui.form
                            , layer = layui.layer;
                        layer.load();

                        $.getJSON('/get_history_price',{'id':"{{$goods['goods_id']}}",'_token':"{{csrf_token()}}"},function(res){
                            layer.closeAll('loading');
                            if(res.code==0){
                                if(res.list.length>0){
                                    let html = '<div class="body" style="padding:10px;box-sizing: border-box;">\n'+
                                        ' <div class="layui-timeline">\n' +
                                        '  <div class="layui-timeline-item">\n' +
                                        '    <i class="layui-icon layui-timeline-axis"></i>\n';
                                    for(let i=0;i<res.list.length;i++){
                                        html += '    <div class="layui-timeline-content layui-text">\n' +
                                            '      <h3 class="layui-timeline-title" style="font-weight: 800;">'+res.list[i].createtime+'</h3>\n' +
                                            '      <p style="font-size:15px;color:#000;">\n' +
                                            '        商品金额由<span style="font-size:18px;font-weight:800;margin:0 2px;color:#000;">'+res.list[i].odd_price+'</span>变更为<span style="font-size:18px;font-weight:800;margin:0 2px;color:#db1d18;">'+res.list[i].now_price+'</span>（<span style="font-size:18px;font-weight:800;margin:0 2px;color:#db1d18;">'+res.list[i].sort_type_name+'</span>）\n' +
                                            '      </p>\n' +
                                            '    </div>\n';
                                    }

                                    html += '  </div>\n' +
                                        '  </div>\n' +
                                        '</div>';

                                    let area = ['500px', '500px'];

                                    var layer_frame_div = layer.open({
                                        skin:'layer_frame',
                                        type: 1,
                                        title: '<div class="disf"><div class="exclamation-circle"><span>!</span></div>历史价格</div>',
                                        area: area,
                                        content: html,
                                        end:function(res){
                                            //刷新页面
                                            layer.close(layer_frame_div);
                                        }
                                    });
                                }
                            }
                            else if(res.code==-1){
                                layer.msg(res.msg);
                            }
                        });
                    }

                    //选择国家
                    $('.country-selects').chosen();
                    function selectCountrys(t){
                        let val = $(t).val();
                        $.getJSON('/getphonenum',{'id':val,'pa':1,'_token':"{{csrf_token()}}"},function(res2){
                            let html = '<select id="selectPostal" class="chosen-select postal-select">\n';
                                if(res2.postal.length>0){
                                    for(let i=0;i<res2.postal.length;i++){
                                        html += '<option value="'+res2.postal[i].id+'">'+res2.postal[i].code_name+'</option>\n';
                                    }
                                }else{
                                    html += '<option value="0">暂无邮编</option>\n';
                                }

                            html += '</select>';

                            $('.sel_postal').html(html);
                            setTimeout(function(){
                                $('.postal-select').chosen();

                                var searchTerm = '';var postal_timer;var isinput = 0;
                                $('.sel_postal .chosen-container input').on('input', function (e) {
                                    // 获取搜索的词
                                    searchTerm = $(this).val();
                                    isinput = 1;
                                    postal_timer = setInterval(postal_func,2000);
                                    clearInterval(postal_timer-1);//删除前一个定时器
                                });
                                var postal_func = function(){
                                    // console.log(isinput,searchTerm);
                                    if(isinput==1){
                                        if(searchTerm != ''){
                                            layer.load();
                                            //停止输入，查询

                                            // 调用接口地址，这里以一个假设的接口地址为例
                                            var apiUrl = "/getpostal?keywords="+searchTerm+"&country="+val;

                                            // 使用AJAX获取数据
                                            $.ajax({
                                                type: 'GET',
                                                url: apiUrl,
                                                dataType: 'json',
                                                success: function(data) {
                                                    // 假设返回的数据格式为：{ results: [{ id: 1, text: 'Option 1' }, ...] }
                                                    // var newData = [];
                                                    // $.each(data.results, function(i, item) {
                                                    //     newData.push({
                                                    //         value: item.id,
                                                    //         text: item.code_name
                                                    //     });
                                                    // });

                                                    // 更新Chosen的选项
                                                    var html = [];
                                                    $.each(data.results, function(i, item) {
                                                        html2 = new Option(item.code_name,item.id);
                                                        html.push(html2);
                                                    });
                                                    $('.postal-select').html(html);
                                                    $('.postal-select').trigger('chosen:updated');
                                                    layer.closeAll('loading');
                                                },
                                                error: function(jqXHR, textStatus, errorThrown) {
                                                    console.error('Search failed: ' + textStatus);
                                                }
                                            });

                                            searchTerm = '';//清空搜索词
                                            isinput = 0;//无搜索正在空余状态

                                            clearInterval(postal_timer);
                                            postal_timer = null;
                                        }
                                    }else{
                                        clearInterval(postal_timer);
                                        postal_timer = null;
                                    }
                                };
                            },500);
                        });
                    }

                    //购物清单---start
                    //加入购物清单
                    function join_list(){
                        var $ = layui.$
                            , form = layui.form
                            , layer = layui.layer;
                        layer.load();
                        if("{{session('user.user_id')}}" ==''){
                            // $.loading.start();
                            // return false;
                            // $.login.show();
                            show_login();
                            return false;
                        }
                        if("{{$goods['have_specs']}}"==1){
                            //有规格
                            let attr = $('.SZY-GOODS-SPEC-ITEMS').find('.attr');
                            let attr_arr = [];
                            let spec_ids = '';
                            let attr_ids = '';
                            
                            for(let i=0;i<attr.length;i++){
                                //获取规格信息
                                let two_level_attr = $('.SZY-GOODS-SPEC-ITEMS').find('.attr').eq(i).find('ul').find('.selected');
                                let spec_name = $('.SZY-GOODS-SPEC-ITEMS').find('.layui-tab').find('.layui-tab-title').find('li').eq(i).text();
                                for(let i2=0;i2<two_level_attr.length;i2++){
                                    if($('.SZY-GOODS-SPEC-ITEMS').find('.attr').eq(i).find('ul').find('.selected').eq(i2).data('attr-have_child')!=1){
                                        
                                        let spec_id = $('.SZY-GOODS-SPEC-ITEMS').find('.attr').eq(i).find('ul .selected').eq(i2).data('spec-id');
                                        let attr_id = $('.SZY-GOODS-SPEC-ITEMS').find('.attr').eq(i).find('ul .selected').eq(i2).data('attr-id');
                                        let attr_name = $('.SZY-GOODS-SPEC-ITEMS').find('.attr').eq(i).find('ul .selected').eq(i2).find('a span').text();
                                        attr_arr.unshift([spec_name,spec_id,attr_id,attr_name]);
        
                                        //整理规格类别和值
                                        spec_ids += spec_id+'_';
                                        attr_ids += attr_id+'_';
                                    }
                                } 
                                // console.log(spec_name+' '+spec_id+' , '+attr_id+' '+attr_name);
                            }
                            // console.log(attr_arr);return false;
                            //整理规格类别和值，去除最后一位符号
                            spec_ids = spec_ids.slice(0, -1);
                            attr_ids = attr_ids.slice(0, -1);

                            //整理成规格名称
                            let attr_name = '';
                            for(let i=0;i<attr_arr.length;i++){
                                attr_name += attr_arr[i][0]+'：'+attr_arr[i][3]+'，';
                            }
                            attr_name = attr_name.slice(0, -1);
                            // console.log(attr_name);

                            //获取数量
                            let amount_num = $('.amount_num').find('.amount-input').val();
                            $('.amount_num').find('.amount-input').val(1);
                            let amount_nummax = $('.amount_num').find('.amount-input').attr('data-amount-max');

                            //先检测该规格有无报价，有则允许进入清单
                            $.getJSON("/calc", {
                                'attr_ids': attr_ids,
                                'buy_num': amount_num,
                                'gid': "{{$goods['goods_id']}}"
                            }, function (res) {
                                if (res.code == -1) {
                                    layer.msg(res.msg);
                                    return false;
                                }
                                else{
                                    if($('.buy_list .buy_table').children().length == 0){
                                        let html = '                       <table class="layui-table">\n' +
                                            '                                    <thead>\n' +
                                            '                                        <tr>\n' +
                                            '                                            <th>规格名称</th>\n' +
                                            '                                            <th>购买数量</th>\n' +
                                            '                                            <th>商品总额</th>\n' +
                                            '                                            <th>操作</th>\n' +
                                            '                                        </tr>\n' +
                                            '                                    </thead>\n' +
                                            '                                    <tbody>\n' +
                                            '                                        <tr class="spec_'+attr_ids+'">\n' +
                                            '                                            <td title="'+attr_name+'">\n' +
                                            '                                                '+attr_name+'\n' +
                                            '                                                <input type="text" name="attr_name[]" value="'+attr_name+'" class="attr_name" style="display: none;">\n'+
                                            '                                                <input type="text" name="spec_ids[]" value="'+spec_ids+'" class="spec_ids" style="display: none;">\n'+
                                            '                                                <input type="text" name="attr_ids[]" value="'+attr_ids+'" class="attr_ids" style="display: none;">\n'+
                                            '                                            </td>\n' +
                                            '                                            <td>' +
                                            '                                                <span class="amount-widget" style="display:flex;">\n' +
                                            '                                                  <input type="text" name="buynum[]" class="amount-input buynum" value="'+amount_num+'"\n' +
                                            '                                                    data-amount-min="1"\n' +
                                            '                                                    data-amount-max="'+amount_nummax+'"\n' +
                                            '                                                    maxlength="8" title="请输入购买量" onchange="buynum(this)">\n' +
                                            '                                                  <span class="amount-btn">\n' +
                                            '                                                     <span class="amount-plus" onclick="add_num(this,'+amount_nummax+')">\n' +
                                            '                                                        <i>+</i>\n' +
                                            '                                                     </span>\n' +
                                            '                                                    <span class="amount-minus" onclick="reduction_num(this)">\n' +
                                            '                                                        <i>-</i>\n' +
                                            '                                                    </span>\n' +
                                            '                                                  </span>\n' +
                                            '                                                <span class="amount-unit" style="display:none;">{{$sku_info[0]['sku_prices']['unit'][0]}}</span>\n' +
                                            '                                                  <span class="amount-unit" style="margin-left:10px;"></span>\n' +
                                            '                                                </span>\n'+
                                            '                                            </td>\n' +
                                            '                                            <td>{{$goods['currency']}}<span class="now_gprice"></span><input type="text" name="now_gprice[]" value="" class="now_gpriceinput" style="display: none;"></td>\n'+
                                            '                                            <td><div class="layui-btn layui-btn-danger layui-btn-md" onclick="del_glist(this)">×</td>\n' +
                                            '                                        </tr>\n' +
                                            '                                    </tbody>\n' +
                                            '                                </table>';

                                        $('.buy_table').html(html);
                                        form.render(null,'glist-element');
                                        // $('.buy_list').show();
                                        calc_method(attr_ids,amount_num);
                                    }
                                    else{
                                        //已有内容，判断是否已添加过此规格
                                        if($('.glist_form').find('.spec_'+attr_ids).length==0){
                                            let html = '                                   <tr class="spec_'+attr_ids+'">\n' +
                                                '                                            <td title="'+attr_name+'">\n' +
                                                '                                                '+attr_name+'\n' +
                                                '                                                <input type="text" name="attr_name[]" value="'+attr_name+'" class="attr_name" style="display: none;">\n'+
                                                '                                                <input type="text" name="spec_ids[]" value="'+spec_ids+'" class="spec_ids" style="display: none;">\n'+
                                                '                                                <input type="text" name="attr_ids[]" value="'+attr_ids+'" class="attr_ids" style="display: none;">\n'+
                                                '                                            </td>\n' +
                                                '                                            <td>' +
                                                '                                                <span class="amount-widget" style="display:flex;">\n' +
                                                '                                                  <input type="text" name="buynum[]" class="amount-input buynum" value="'+amount_num+'"\n' +
                                                '                                                    data-amount-min="1"\n' +
                                                '                                                    data-amount-max="'+amount_nummax+'"\n' +
                                                '                                                    maxlength="8" title="请输入购买量" onchange="buynum(this)">\n' +
                                                '                                                  <span class="amount-btn">\n' +
                                                '                                                     <span class="amount-plus" onclick="add_num(this,'+amount_nummax+')">\n' +
                                                '                                                        <i>+</i>\n' +
                                                '                                                     </span>\n' +
                                                '                                                    <span class="amount-minus" onclick="reduction_num(this)">\n' +
                                                '                                                        <i>-</i>\n' +
                                                '                                                    </span>\n' +
                                                '                                                  </span>\n' +
                                                '                                                <span class="amount-unit" style="display:none;">{{$sku_info[0]['sku_prices']['unit'][0]}}</span>\n' +
                                                '                                                  <span class="amount-unit" style="margin-left:10px;"></span>\n' +
                                                '                                                </span>\n'+
                                                '                                            </td>\n' +
                                                '                                            <td>{{$goods['currency']}}<span class="now_gprice"></span><input type="text" name="now_gprice[]" value="" class="now_gpriceinput" style="display: none;"></td>\n'+
                                                '                                            <td><div class="layui-btn layui-btn-danger layui-btn-md" onclick="del_glist(this)">×</td>\n' +
                                                '                                        </tr>\n';
                                            $('.buy_table tbody').append(html);
                                            form.render(null,'glist-element');
                                            calc_method(attr_ids,amount_num);
                                        }
                                        else{
                                            let max_num = $('.spec_'+attr_ids).find('.amount-input').attr('data-amount-max');
                                            let ori_val =  $('.spec_'+attr_ids).find('.amount-input').val();
                                            ori_val = parseInt(ori_val) + parseInt(amount_num);
                                            if(ori_val>max_num){
                                                //超出最大库存
                                                $('.spec_'+attr_ids).find('.amount-input').val(max_num);
                                                calc_method(attr_ids,max_num);
                                            }else{
                                                //低于最大库存
                                                $('.spec_'+attr_ids).find('.amount-input').val(ori_val);
                                                calc_method(attr_ids,ori_val);
                                            }
                                        }
                                    }
                                }
                            });
                        }
                        else if("{{$goods['have_specs']}}"==2){
                            //无规格

                            //1、获取数量
                            let amount_num = $('.amount_num').find('.amount-input').val();
                            $('.amount_num').find('.amount-input').val(1);
                            let amount_nummax = $('.amount_num').find('.amount-input').attr('data-amount-max');
                            let attr_ids = 0;

                            if($('.buy_list .buy_table').children().length == 0){
                                let html = '                       <table class="layui-table">\n' +
                                    '                                    <thead>\n' +
                                    '                                        <tr>\n' +
                                    '                                            <th>购买数量</th>\n' +
                                    '                                            <th>商品总额</th>\n' +
                                    '                                            <th>操作</th>\n' +
                                    '                                        </tr>\n' +
                                    '                                    </thead>\n' +
                                    '                                    <tbody>\n' +
                                    '                                        <tr class="spec_'+attr_ids+'">\n' +
                                    '                                            <td>' +
                                    '                                                <span class="amount-widget" style="display:flex;">\n' +
                                    '                                                  <input type="text" name="buynum[]" class="amount-input buynum" value="'+amount_num+'"\n' +
                                    '                                                    data-amount-min="1"\n' +
                                    '                                                    data-amount-max="'+amount_nummax+'"\n' +
                                    '                                                    maxlength="8" title="请输入购买量" onchange="buynum(this)">\n' +
                                    '                                                  <span class="amount-btn">\n' +
                                    '                                                     <span class="amount-plus" onclick="add_num(this,'+amount_nummax+')">\n' +
                                    '                                                        <i>+</i>\n' +
                                    '                                                     </span>\n' +
                                    '                                                    <span class="amount-minus" onclick="reduction_num(this)">\n' +
                                    '                                                        <i>-</i>\n' +
                                    '                                                    </span>\n' +
                                    '                                                  </span>\n' +
                                    '                                                <span class="amount-unit" style="display:none;">{{$sku_info[0]['sku_prices']['unit'][0]}}</span>\n' +
                                    '                                                  <span class="amount-unit" style="margin-left:10px;"></span>\n' +
                                    '                                                </span>\n'+
                                    '                                            </td>\n' +
                                    '                                            <td>{{$sku_info[0]['sku_prices']['currency'][0]}}<span class="now_gprice"></span><input type="text" name="now_gprice[]" value="" class="now_gpriceinput" style="display: none;"></td>\n'+
                                    '                                            <td><div class="layui-btn layui-btn-danger layui-btn-md" onclick="del_glist(this)">×</td>\n' +
                                    '                                        </tr>\n' +
                                    '                                    </tbody>\n' +
                                    '                                </table>';

                                $('.buy_table').html(html);
                                form.render(null,'glist-element');
                                // $('.buy_list').show();
                                calc_method(attr_ids,amount_num);
                            }
                            else{
                                //已有内容，判断是否已添加过此规格
                                let max_num = $('.spec_'+attr_ids).find('.amount-input').attr('data-amount-max');
                                let ori_val =  $('.spec_'+attr_ids).find('.amount-input').val();
                                ori_val = parseInt(ori_val) + parseInt(amount_num);
                                if(ori_val>max_num){
                                    //超出最大库存
                                    $('.spec_'+attr_ids).find('.amount-input').val(max_num);
                                    calc_method(attr_ids,max_num);
                                }else{
                                    //低于最大库存
                                    $('.spec_'+attr_ids).find('.amount-input').val(ori_val);
                                    calc_method(attr_ids,ori_val);
                                }
                            }
                        }
                    }

                    //显示服务tips
                    function showTips(t,name){
                        var $ = layui.$
                            , form = layui.form
                            , layer = layui.layer;

                        layer.open({
                            type: 1,
                            title: name,
                            area: ['500px', '400px'],
                            // zIndex:999999999,
                            content: '<div style="padding:20px;box-sizing: border-box;font-size:15px;">'+$(t).parent().find('.tipsDiv').html()+'</div>'
                        });
                    }

                    //选择服务start
                    var photo_layer = '';
                    function select_services(id,type,t,name){
                        var $ = layui.$
                            , form = layui.form
                            , layer = layui.layer;

                        let val = $(t).val();
                        if(val==0){
                            if(type!=1) {
                                $(t).val("1");
                            }else{
                                $('.servicesInput').eq(0).prop('checked',false);
                            }
                        }else{
                            if(type!=1){
                                $(t).val("0");
                            }else{
                                $('.servicesInput').eq(0).prop('checked',true);
                            }
                        }

                        let num = 0;
                        for(let i=0;i<$('.servicesInput').length;i++){
                            if($('.servicesInput').eq(i).val()==1){
                                num +=1;
                            }
                        }

                        $('.gi_services').find('.alselBox .alsel2').find('.projectNum').text(num);

                        if(type==1){
                            //拍照
                            $('#service_id').val(id);
                            let area = ['800px','500px'];
                            if(IsPhone()){
                                area = ['100%','100%'];
                            }
                            photo_layer = layer.open({
                                type: 1,
                                title: name,
                                area: area,
                                // zIndex:999999999,
                                content: $('.photoNumBox'),
                                closeBtn: 0,
                            });
                        }else{
                            layer.load();
                            $.getJSON("/calc_services", {
                                'id': id,
                                'price':$('#service_money').val(),
                                'val':val,
                            }, function (res) {
                                layer.closeAll('loading');
                                if(res.code==0){
                                    // let service_money = parseFloat($('#service_money').val()) + parseFloat(res.data.price);
                                    // $('#service_money').val(service_money.toFixed(2));
                                    $('#service_money').val(res.data.price);
                                }
                            });
                            calc_totalmoney(1800);
                        }
                    }

                    //增加照片
                    function add_photonum(t,bignum){
                        var $ = layui.$
                            , form = layui.form
                            , layer = layui.layer;

                        let val = parseInt($('.photoNumBox').find('.photonum').val()) + 1;
                        $('.photoNumBox').find('.photonum').val(val);

                        let num = parseInt($('.photoNumBox').find('.remarks-list-wrap .child-order').length)+1;
                        let html = '<div class="child-order">\n' +
                            '                                        <div class="count-box">\n' +
                            '                                            <span>照片'+num+'</span>\n' +
                            '                                        </div>\n' +
                            '                                        <textarea rows="3" class="layui-textarea" name="photoRequest[]" maxlength="150" autocomplete="on" placeholder="备注拍照特殊要求"></textarea>\n' +
                            '                                    </div>';

                        $('.remarks-list-wrap').append(html);

                        $('.photoNum').text(val);
                    }

                    //减少照片
                    function reduction_photonum(t){
                        var $ = layui.$
                            , form = layui.form
                            , layer = layui.layer;

                        if($('.photoNumBox').find('.photonum').val()>1){
                            let val = parseInt($('.photoNumBox').find('.photonum').val()) - 1;
                            $('.photoNumBox').find('.photonum').val(val);
                            $('.photoNumBox').find('.remarks-list-wrap').find('.child-order').last().remove();
                            $('.photoNum').text(val);
                            layer.load();
                            $.getJSON("/calc_services", {
                                'id': $('#service_id').val(),
                                'price':$('#photo_money').val(),//已选服务总金额
                                'num':$(t).parent().parent().find('.photonum').val()
                            }, function (res) {
                                layer.closeAll('loading');
                                if(res.code==0){
                                    // let service_money = parseFloat($('#service_money').val()) + parseFloat(res.data.price);
                                    // $('#service_money').val(service_money.toFixed(2));
                                    $('#photo_money').val(res.data.price);
                                }
                            });
                        }
                    }

                    function surephoto(t,typ){
                        var $ = layui.$
                            , form = layui.form
                            , layer = layui.layer;

                        if(typ==0){
                            $('.photoNum').text('1');
                            $('.photoNumBox').find('.photonum').val(1);
                            $('.photoNumBox').find('.remarks-list-wrap').find('.child-order :gt(0)').remove();

                            $('.servicesInput').eq(0).prop('checked',false);
                            $('.servicesInput').eq(0).val('0');

                            $('#photo_money').val(0);
                        }else{
                            $('.servicesInput').eq(0).prop('checked',true);
                            $('.servicesInput').eq(0).val('1');
                            layer.load();
                            $.getJSON("/calc_services", {
                                'id': $('#service_id').val(),
                                'price':$('#photo_money').val(),//已选服务总金额
                                'num':$(t).parent().parent().find('.photonum').val()
                            }, function (res) {
                                layer.closeAll('loading');
                                if(res.code==0){
                                    // let service_money = parseFloat($('#service_money').val()) + parseFloat(res.data.price);
                                    // $('#service_money').val(service_money.toFixed(2));
                                    $('#photo_money').val(res.data.price);
                                }
                            });
                        }

                        layer.close(photo_layer);

                        calc_totalmoney(1800);
                        return false;
                    }
                    //选择服务end

                    //其他费用
                    $(function(){
                       //其他费用
                       $('.gi_otherfee_price').click(function(){
                           if($('.otherfee_div').css('display')=='none'){
                               $('.otherfee_div').show();
                               $('.gi_otherfee_price').removeClass('gi_otherfee_price').addClass('gi_otherfee_price2');
                           }else{
                               $('.otherfee_div').hide();
                               $('.gi_otherfee_price2').removeClass('gi_otherfee_price2').addClass('gi_otherfee_price');
                           }
                       });

                       //其他优惠
                       $('.see_prefe').click(function(){
                           if($('.prefe_info').css('display')=='none'){
                               $('.prefe_info').show();
                               $('.see_prefe').removeClass('see_prefe').addClass('see_prefe2');
                           }else{
                               $('.prefe_info').hide();
                               $('.see_prefe2').removeClass('see_prefe2').addClass('see_prefe');
                           }
                       });

                       //订单随赠
                       $('.see_prefeProduct').click(function(){
                           if($('.prefeProduct_info').css('display')=='none'){
                               $('.prefeProduct_info').show();
                               $('.see_prefeProduct').removeClass('see_prefeProduct').addClass('see_prefeProduct2');
                           }else{
                               $('.prefeProduct_info').hide();
                               $('.see_prefeProduct2').removeClass('see_prefeProduct2').addClass('see_prefeProduct');
                           }
                       });

                        //其他服务
                        $('.alsel').click(function(){
                            if($('.servicesDiv').css('display')=='none'){
                                $('.servicesDiv').show();
                                $('.alsel').removeClass('alsel').addClass('alsel2');
                            }else{
                                $('.servicesDiv').hide();
                                $('.alsel2').removeClass('alsel2').addClass('alsel');
                            }
                        });
                    });

                    //删除当前清单信息
                    function del_glist(t){
                        var $ = layui.$
                            , form = layui.form
                            , layer = layui.layer;

                        let del_num = $(t).parents(":eq(1)").find('td').eq(1).find('.amount-input').val();
                        let gi_number = parseInt($('.gi_number').text()) - parseInt(del_num);
                        $('.gi_number').text(gi_number);

                        $(t).parents(":eq(1)").remove();

                        let attr_ids = '0';
                        @if($goods['have_specs']==1)
                            attr_ids = $(t).parents(":eq(1)").find('td').eq(0).find('.attr_ids').val();
                        @endif
                        calc_method(attr_ids,0);
                    }

                    //显示购物清单
                    function show_glist(t){
                        var area = ['600px', '433px'];
                        if(IsPhone()){
                            area = ['100%', '350px'];
                        }
                        if($(t).hasClass('yixuan')){
                            $(t).removeClass('yixuan').addClass('yixuan2');
                            $('.buy_list,.glist_form').show();

                            layer_frame_div = layer.open({
                                skin:'layer_frame',
                                type: 1,
                                title: '<div class="disf"><div class="exclamation-circle"><span>!</span></div>选购中心</div>',
                                area: area,
                                content: $('.buy_list'),
                                end:function(res){
                                    $('.buy_list,.glist_form').hide();
                                    $(t).removeClass('yixuan2').addClass('yixuan');
                                }
                            });
                        }else{
                            $(t).removeClass('yixuan2').addClass('yixuan');
                            $('.buy_list,.glist_form').hide();
                        }
                    }

                    //添加清单下的数量
                    function add_num(t,max_num){
                        var $ = layui.$
                            , form = layui.form
                            , layer = layui.layer;

                        let val = $(t).parents(':eq(2)').find('.amount-input').val();
                        val = parseInt(val)+1;
                        if(val<=parseInt(max_num)){
                            $(t).parents(':eq(2)').find('.amount-input').val(val);
                            let attr_ids = '0';
                            @if($goods['have_specs']==1)
                                attr_ids = $(t).parents(":eq(3)").find('td').eq(0).find('.attr_ids').val();
                            @endif
                            calc_method(attr_ids,val);
                        }
                    }

                    //减少清单下的数量
                    function reduction_num(t){
                        var $ = layui.$
                            , form = layui.form
                            , layer = layui.layer;
                        let val = $(t).parents(':eq(2)').find('.amount-input').val();
                        val = parseInt(val)-1;
                        if(val>0){
                            $(t).parents(':eq(2)').find('.amount-input').val(val);
                            let attr_ids = '0';
                            @if($goods['have_specs']==1)
                                attr_ids = $(t).parents(":eq(3)").find('td').eq(0).find('.attr_ids').val();
                            @endif
                            calc_method(attr_ids,val);
                        }
                    }

                    //数量框变化
                    function buynum(t){
                        var $ = layui.$
                            , form = layui.form
                            , layer = layui.layer;
                        let attr_ids = '0';
                        let buy_num = $(t).parents(':eq(2)').find('.amount-input').val();
                        @if($goods['have_specs']==1)
                            attr_ids = $(t).parents(":eq(3)").find('td').eq(0).find('.attr_ids').val();
                        @endif

                        calc_method(attr_ids,buy_num);
                    }

                    //统计数量等信息
                    function calc_method(attr_ids='0',buy_num=0){
                        var layer = layui.layer
                            ,$ = layui.jquery;

                        // layer.load();
                        //统计数量+
                        let pre_tr = $('.buy_table tbody').find('tr');
                        let total = 0;
                        for(let i=0;i<pre_tr.length;i++){
                            let val = 0;
                            if(attr_ids==0){
                                val = $('.buy_table tbody').find('tr').eq(i).find('td').eq(0).find('.amount-input').val();
                                if(!parseInt(val)>0){
                                    val = $('.buy_table tbody').find('tr').eq(i).find('td').eq(1).find('.amount-input').val();
                                }
                            }else{
                                val = $('.buy_table tbody').find('tr').eq(i).find('td').eq(1).find('.amount-input').val();
                            }
                            total = total + parseInt(val);
                        }
                        $('.gi_number').text(total);
                        //统计金额
                        var total_price = 0;
                        for(let i=0;i<pre_tr.length;i++) {
                            if(i==0){
                                total_price = 0;
                            }
                            let attr_ids2 = '';
                            let buy_num = 0;
                            if(attr_ids==0){
                                attr_ids2 = '';
                                buy_num = $('.buy_table tbody').find('tr').eq(i).find('td').eq(0).find('.amount-input').val();
                            }else{
                                attr_ids2 = $('.buy_table tbody').find('tr').eq(i).find('td').eq(0).find('.attr_ids').val();
                                buy_num = $('.buy_table tbody').find('tr').eq(i).find('td').eq(1).find('.amount-input').val();
                            }

                            $.getJSON("/calc", {
                                'attr_ids': attr_ids2,
                                'buy_num': buy_num,
                                'gid': "{{$goods['goods_id']}}"
                            }, function (res) {
                                if(res.code==-1){
                                    layer.msg(res.msg);return false;
                                }
                                let eq = 2;
                                if(attr_ids==0){
                                    eq = 1;
                                }
                                $('.buy_table tbody').find('tr').eq(i).find('td').eq(eq).find('.now_gprice').text(res.data.price);
                                $('.buy_table tbody').find('tr').eq(i).find('td').eq(eq).find('.now_gpriceinput').val(res.data.price);
                                total_price = parseFloat(total_price) + parseFloat(res.data.price);
                                $('.gi_price').text(total_price.toFixed(2));
                            });

                            if(i+1==pre_tr.length){
                                setTimeout(function(){
                                    //计算其他费用+优惠减免
                                    $.getJSON("/calc_otherfee", {
                                        'total_price': $('.gi_price').text(),
                                        'total': total,
                                        'gid': "{{$goods['goods_id']}}"
                                    }, function (res) {
                                        //其他费用
                                        let html = '';

                                        @if($goods['shop_id']>0 && empty($goods['drug_id']))
                                            @if(1>2)
                                                if(res.data.otherfee_content.name[0]!=''){
                                                    for(let i=0;i<res.data.otherfee_content.name.length;i++){
                                                        html += '<tr>' +
                                                            '        <td>'+res.data.otherfee_content.name[i]+'</td>\n'+
                                                            '        <td>'+res.data.otherfee_content.desc[i]+'</td>\n'+
                                                            '        <td>'+res.data.otherfee_content.otherfee_standard_name[i]+'</td>\n'+
                                                            '        <td>'+res.data.otherfee_currency+' '+res.data.otherfee_content.price[i]+'</td>\n'+
                                                            '    </tr>';
                                                    }
                                                    if($('.otherfee_div tbody tr').length==0){
                                                        $('.otherfee_div tbody').append(html);
                                                    }else{
                                                        $('.otherfee_div tbody').html(html);
                                                    }
                                                    $('.gi_otherfee_price .otherfee_price').text(res.data.otherfee_total);
                                                }

                                                //优惠减免
                                                let html2 = '';
                                                if(res.data.reduction.length>0){
                                                    for(let i=0;i<res.data.reduction.length;i++){
                                                        html2 += '<tr>' +
                                                            '        <td>'+res.data.reduction[i]['preferential_blong_name']+'</td>\n'+
                                                            '        <td>'+res.data.reduction[i]['project_name']+'（'+res.data.reduction[i]['content'][0]+res.data.reduction[i]['price1']+res.data.reduction[i]['content'][2]+res.data.reduction[i]['price2']+'）</td>\n'+
                                                            '        <td>-&nbsp;'+res.data.reduction[i]['currency1'][0]+res.data.reduction[i]['price2']+'</td>\n'+
                                                            '        <td>'+res.data.reduction[i]['strict_name']+'</td>\n'+
                                                            '        <td><input type="checkbox" name="reduction[]" value="'+i+'" class="prefe_reduction reduction_'+res.data.reduction[i]['strict']+'" title="" lay-skin="primary" data-strict="'+res.data.reduction[i]['strict']+'" data-type="'+res.data.reduction[i]['type']+'" data-reduction_currency="'+res.data.reduction[i]['currency1']+'" data-reduction_price="'+res.data.reduction[i]['price2']+'" onclick="select_reduction(this,'+i+')">\n'+
                                                            '    </tr>';
                                                    }

                                                    if($('.reduction_table tbody tr').length==0){
                                                        $('.reduction_table tbody').append(html2);
                                                    }else{
                                                        $('.reduction_table tbody').html(html2);
                                                    }
                                                }

                                                //优惠随赠
                                                let html3 = '';
                                                if(res.data.gift.length>0){
                                                    for(let i=0;i<res.data.gift.length;i++){
                                                        if(res.data.gift[i]['type']==1){
                                                            //积分
                                                            html3 += '<tr>' +
                                                                '        <td>'+res.data.gift[i]['preferential_blong_name']+'</td>\n'+
                                                                '        <td>'+res.data.gift[i]['type_name']+'</td>\n'+
                                                                '        <td>'+res.data.gift[i]['points_typeName']+res.data.gift[i]['points_send']+'分</td>\n'+
                                                                '        <td>'+res.data.gift[i]['strict_name']+'</td>\n'+
                                                                '        <td><input type="checkbox" name="gift[]" value="'+i+'" class="prefe_gift reduction_'+res.data.gift[i]['strict']+'" title="" lay-skin="primary" data-strict="'+res.data.gift[i]['strict']+'" data-points_send="'+res.data.gift[i]['points_send']+'" data-operaer="'+res.data.gift[i]['operaer']+'" data-points_type="'+res.data.gift[i]['points_type']+'" data-points_currency="'+res.data.gift[i]['points_currency']+'" data-points_money="'+res.data.gift[i]['points_money']+'" data-type="'+res.data.gift[i]['type']+'" onclick="select_gift(this,'+i+','+res.data.gift[i]['type']+')"></td>\n'+
                                                                '    </tr>';
                                                        }else if(res.data.gift[i]['type']==2){
                                                            //卡券
                                                            html3 += '<tr>' +
                                                                '        <td>'+res.data.gift[i]['preferential_blong_name']+'</td>\n'+
                                                                '        <td>'+res.data.gift[i]['type_name']+'</td>\n'+
                                                                '        <td>价值'+res.data.gift[i]['coupon_currency']+res.data.gift[i]['coupon_money']+'×'+res.data.gift[i]['coupon_num']+'张</td>\n'+
                                                                '        <td>'+res.data.gift[i]['strict_name']+'</td>\n'+
                                                                '        <td><input type="checkbox" name="gift[]" value="'+i+'" class="prefe_gift reduction_'+res.data.gift[i]['strict']+'" title="" lay-skin="primary" data-strict="'+res.data.gift[i]['strict']+'" data-operaer="'+res.data.gift[i]['operaer']+'" data-coupon_currency="'+res.data.gift[i]['coupon_currency']+'" data-coupon_money="'+res.data.gift[i]['coupon_money']+'" data-coupon_num="'+res.data.gift[i]['coupon_num']+'" data-type="'+res.data.gift[i]['type']+'" onclick="select_gift(this,'+i+','+res.data.gift[i]['type']+')"></td>\n'+
                                                                '    </tr>';
                                                        }else if(res.data.gift[i]['type']==3){
                                                            //随赠
                                                            html3 += '<tr>' +
                                                                '        <td>'+res.data.gift[i]['preferential_blong_name']+'</td>\n'+
                                                                '        <td>'+res.data.gift[i]['type_name']+'（'+res.data.gift[i]['accgift_typeName']+'）</td>\n'+
                                                                '        <td>'+res.data.gift[i]['accgift_content']+'*'+res.data.gift[i]['accgift_num']+'</td>\n'+
                                                                '        <td>'+res.data.gift[i]['strict_name']+'</td>\n'+
                                                                '        <td><input type="checkbox" name="gift[]" value="'+i+'" class="prefe_gift reduction_'+res.data.gift[i]['strict']+'" title="" lay-skin="primary" data-strict="'+res.data.gift[i]['strict']+'" data-accgift_content="'+res.data.gift[i]['accgift_content']+'" data-accgift_num="'+res.data.gift[i]['accgift_num']+'" data-accgift_type="'+res.data.gift[i]['accgift_type']+'" data-accgift_typeName="'+res.data.gift[i]['accgift_typeName']+'" data-type="'+res.data.gift[i]['type']+'" onclick="select_gift(this,'+i+','+res.data.gift[i]['type']+')"></td>\n'+
                                                                '    </tr>';
                                                        }

                                                        if($('.gift_table tbody tr').length==0){
                                                            $('.gift_table tbody').append(html3);
                                                        }else{
                                                            $('.gift_table tbody').html(html3);
                                                        }
                                                    }
                                                }
                                            @endif
                                        @endif

                                        //统计实付金额
                                        calc_totalmoney(0);
                                    });

                                    // layer.closeAll('loading');
                                    $('.buy_list').find('.order_now').click();
                                },2000);
                            }
                        }

                        //重新选择时，隐藏并清空已选优惠
                        hide_preferential();
                    }

                    //统计实付金额
                    function calc_totalmoney(timer=0){
                        setTimeout(function(){
                            let gi_price = $('.gi_price').text();
                            let otherfee_price = $('.otherfee_price').text();//其他费用
                            if(otherfee_price==''){otherfee_price=0;}
                            let reduction_price = $('.reduction_price').text();//减免金额
                            if(reduction_price==''){reduction_price=0;}
                            let points_divMoney = $('.points_divMoney').text();//积分金额
                            if(points_divMoney==''){points_divMoney=0;}
                            let coupon_divMoney = $('.coupon_divMoney').text();//优惠券金额
                            if(coupon_divMoney==''){coupon_divMoney=0;}
                            let service_money = $('#service_money').val();//服务金额
                            if(service_money==''){service_money=0;}
                            let photo_money = $('#photo_money').val();//服务金额
                            if(photo_money==''){photo_money=0;}
                            let totalprice = parseFloat(gi_price) + parseFloat(otherfee_price) - parseFloat(reduction_price) - parseFloat(points_divMoney) - parseFloat(coupon_divMoney) + parseFloat(service_money) + parseFloat(photo_money);

                            $('.gipay_price').text(totalprice.toFixed(2));
                        },timer);
                    }

                    //隐藏所有优惠
                    function hide_preferential(){
                        $('.coupon_divCurrency').text('');
                        $('.coupon_divCurrency').text('');
                        $('.coupon_divs').hide();
                        $('.points_divCurrency').text('');
                        $('.points_divMoney').text('');
                        $('.points_divs').hide();
                        $('.reduction_price').text(0);

                        $('.coupon_divs').hide();
                        $('.gift_prices').hide();
                        $('.product_prices').hide();
                    }

                    //选择随赠优惠
                    function select_gift(t,idx,typ){
                        let strict = $(t).attr('data-strict');
                        let gift_tr = $('.gift_table tbody tr');
                        if(typ==1){
                            //积分
                            let points_divCurrency = $(t).attr('data-points_currency');
                            let points_send = $(t).attr('data-points_send');
                            $('.points_divCurrency').text(points_divCurrency);
                            $('.points_divMoney').text(points_send);
                            $('.gift_prices .points_divs').css('display','block');
                            $('.gift_prices').css('display','flex');

                            if(strict==1){
                                $('.coupon_divCurrency').text('');
                                $('.coupon_divMoney').text('');
                                $('.coupon_divs').hide();
                                $('.product_prices').hide();

                                for(let i=0;i<gift_tr.length;i++){
                                    if(i!=idx){
                                        $('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').prop('checked',false);
                                        if(typ!=$('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').attr('data-type')){
                                            hide_preferential2($('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').attr('data-type'));
                                        }
                                    }else{
                                        if($('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').is(":checked")==false){
                                            hide_preferential2($('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').attr('data-type'));
                                        }
                                    }
                                }
                            }else if(strict==2){
                                for(let i=0;i<gift_tr.length;i++){
                                    if(i!=idx){
                                        if($('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').attr('data-strict')==1 && $('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').is(":checked")==true){
                                            $('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').prop('checked',false);
                                            if($('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').attr('data-type')!=typ) {
                                                hide_preferential2($('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').attr('data-type'));
                                            }
                                        }
                                    }else{
                                        if($('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').is(":checked")==false){
                                            hide_preferential2($('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').attr('data-type'));
                                        }
                                    }
                                }
                            }
                        }
                        else if(typ==2){
                            //卡券
                            let coupon_divCurrency = $(t).attr('data-coupon_currency');
                            let coupon_divMoney = $(t).attr('data-coupon_money');
                            let coupon_num = $(t).attr('data-coupon_num');
                            $('.coupon_divCurrency').text(coupon_divCurrency);
                            $('.coupon_divMoney').text(coupon_divMoney*coupon_num);
                            $('.gift_prices .coupon_divs').css('display','block');
                            $('.gift_prices').css('display','flex');
                            if(strict==1){
                                $('.points_divCurrency').text('');
                                $('.points_divMoney').text('');
                                $('.points_divs').hide();
                                $('.product_prices').hide();
                                for(let i=0;i<gift_tr.length;i++){
                                    if(i!=idx){
                                        $('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').prop('checked',false);
                                        if(typ!=$('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').attr('data-type')){
                                            hide_preferential2($('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').attr('data-type'));
                                        }
                                    }else{
                                        if($('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').is(":checked")==false){
                                            hide_preferential2($('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').attr('data-type'));
                                        }
                                    }
                                }
                            }else if(strict==2){
                                for(let i=0;i<gift_tr.length;i++){
                                    if(i!=idx){
                                        if($('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').attr('data-strict')==1 && $('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').is(":checked")==true){
                                            $('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').prop('checked',false);
                                            if($('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').attr('data-type')!=typ){
                                                hide_preferential2($('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').attr('data-type'));
                                            }
                                        }
                                    }else{
                                        if($('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').is(":checked")==false){
                                            hide_preferential2($('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').attr('data-type'));
                                        }
                                    }
                                }
                            }
                        }
                        else if(typ==3){
                            //随赠
                            let accgift_typename = $(t).attr('data-accgift_typename');
                            let accgift_content = $(t).attr('data-accgift_content');
                            let accgift_num = $(t).attr('data-accgift_num');

                            let html = '<tr class="tr_'+accgift_content+'">\n'+
                            '              <td>'+accgift_typename+'</td>\n'+
                            '              <td>'+accgift_content+'</td>\n'+
                            '              <td>'+accgift_num+'</td>\n'+
                            '           </tr>';
                            let prefe_table_tr = $('.prefeProduct_table tbody').find('tr');
                            if(prefe_table_tr.length==0){
                                $('.prefeProduct_table tbody').html(html);
                            }else{
                                if($('.prefeProduct_table tbody').find('.tr_'+accgift_content).length==0){
                                    //没出现
                                    $('.prefeProduct_table tbody').append(html);
                                }else{
                                    $('.prefeProduct_table tbody').find('.tr_'+accgift_content).remove();
                                }
                            }

                            if(strict==1){
                                $('.points_divCurrency').text('');
                                $('.points_divMoney').text('');
                                $('.points_divs').hide();
                                $('.coupon_divCurrency').text('');
                                $('.coupon_divMoney').text('');
                                $('.coupon_divs').hide();
                                $('.gift_prices').hide();
                                $('.product_prices').show();
                                for(let i=0;i<gift_tr.length;i++){
                                    if(i!=idx){
                                        $('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').prop('checked',false);
                                        hide_preferential2($('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').attr('data-type'));
                                    }
                                }
                            }else if(strict==2){
                                for(let i=0;i<gift_tr.length;i++){
                                    if(i!=idx){
                                        if($('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').attr('data-strict')==1 && $('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').is(":checked")==true){
                                            $('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').prop('checked',false);
                                            hide_preferential2($('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').attr('data-type'));
                                        }
                                    }
                                    // else{
                                    //     if($('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').is(":checked")==false){
                                    //         hide_preferential2($('.gift_table tbody tr').eq(i).find('td').eq(4).find('input').attr('data-type'));
                                    //     }
                                    // }
                                }
                            }
                            $('.product_prices').show();
                        }

                        //统计实付金额
                        calc_totalmoney(1800);
                    }

                    //遇到单独的随赠奖励就隐藏前端样式
                    function hide_preferential2(typ=0){
                        if(typ==1){
                            $('.points_divCurrency').text('');
                            $('.points_divMoney').text('');
                            $('.points_divs').hide();
                        }else if(typ==2){
                            $('.coupon_divCurrency').text('');
                            $('.coupon_divMoney').text('');
                            $('.coupon_divs').hide();
                        }else if(typ==3){
                            $('.product_prices').hide();
                            $('.product_prices').find('.prefeProduct_table tbody').html("");
                        }
                    }

                    //选择减免优惠
                    function select_reduction(t,idx){
                        let strict = $(t).attr('data-strict');
                        let price = $(t).attr('data-reduction_price');
                        let reduction_tr = $('.reduction_table tbody tr');
                        let reduction_price = 0;
                        if(strict==1){
                            //单独
                            for(let i=0;i<reduction_tr.length;i++){
                                if(i!=idx){
                                    $('.reduction_table tbody tr').eq(i).find('td').eq(4).find('input').prop('checked',false);
                                    reduction_price = parseFloat(price);
                                }else{
                                    if(reduction_tr.length==1){
                                        //只有一个优惠的情况
                                        reduction_price = parseFloat(price);
                                    }else if($('.reduction_table tbody tr').eq(i).find('td').eq(4).find('input').is(":checked") == false){
                                        //取消时，价格为0
                                        reduction_price = 0;
                                    }
                                }
                            }
                        }else if(strict==2){
                            //叠加
                            for(let i=0;i<reduction_tr.length;i++) {
                                $('.reduction_table tbody tr').eq(i).find('td').eq(4).find('.reduction_1').prop('checked', false);
                                if($('.reduction_table tbody tr').eq(i).find('td').eq(4).find('.reduction_2').prop('checked')==true){
                                    reduction_price = parseFloat(reduction_price) + parseFloat($('.reduction_table tbody tr').eq(i).find('td').eq(4).find('.reduction_2').attr('data-reduction_price'));
                                }
                            }
                        }

                        $('.reduction_price').text(reduction_price);

                        //统计实付金额
                        calc_totalmoney(1800);
                    }

                    //放弃购买
                    function giveup_buy(){
                        $('.yixuan2').removeClass('yixuan2').addClass('yixuan');
                        $('.glist_form').hide();
                    }

                    //上传文件
                    function goto_buy(){
                        var layer = layui.layer
                            ,$ = layui.jquery;

                        $('.gi_file_div').show();
                        $('.buy_footer ').hide();
                        // layer.open({
                        //     type: 1,
                        //     title: '上传文件并提交',
                        //     area: ['500px', '500px'],
                        //     // zIndex:999999999,
                        //     content: $('.gi_file_div')
                        // });
                        // $('.layui-layer-shade').css('z-index',9);
                        $('.gi_file_div').css({'padding':'20px','box-sizing':'border-box','border': '2px solid #d3d3d3','position':'absolute','bottom':0,'left':0,'width':'100%'});

                    }

                    //取消上传
                    function cancel_buy(){
                        var layer = layui.layer
                            ,$ = layui.jquery;
                        $('.gi_file_div').hide();
                        $('.buy_footer').show();
                    }
                    //购物清单---end

                    function getSkuId() {
                        var spec_ids = [];
                        $(".choose").find(".attr").each(function() {
                            var spec_id = $(this).find(".selected").data("spec-id");
                            spec_ids.push(spec_id);
                        });

                        var sku_id = $.cart.getSkuId(spec_ids, sku_ids);
                        if (sku_id == null) {
                            return false;
                        }

                        return sku_id;
                    }

                    function changeLocation(region_code) {
                        if (region_code == undefined || region_code == null || region_code.length == 0) {
                            return;
                        }

                        var sku_id = getSkuId();

                        return $.get("/goods/change-location.html", {
                            "sku_id": sku_id,
                            "region_code": region_code
                        }, function(result) {
                            if (result.code == 0) {
                                local_region_code = region_code;
                                sku_freights[region_code] = result.data;

                                if (result.data.is_last == 0) {
                                    // return;
                                }

                                $(".freight-info").html(result.data.freight_info);
                                $(".freight-free-info").find(".content").html("");

                                if ($.isArray(result.data.free_list) && result.data.free_list.length > 0) {

                                    for (var i = 0; i < result.data.free_list.length; i++) {
                                        $(".freight-free-info").find(".content").append("<p>" + result.data.free_list[i] + "</p>");
                                    }

                                    // 显示包邮条件
                                    $(".freight-free-info").show();
                                } else {
                                    // 隐藏包邮条件
                                    $(".freight-free-info").hide();
                                }

                                if ($(document).data("SZY-SKU-" + sku_id)) {
                                    var sku = $(document).data("SZY-SKU-" + sku_id);
                                    setSkuInfo(sku);
                                } else {

                                    // 库存
                                    if (result.data.goods_number > 0) {
                                        if ("1" == 1) {
                                            $(".SZY-GOODS-NUMBER").html("库存" + result.data.goods_number + "件");
                                        } else {
                                            $(".SZY-GOODS-NUMBER").html("");
                                        }
                                    } else {
                                        $(".SZY-GOODS-NUMBER").html("库存不足");
                                    }
                                    // 购买
                                    if (result.data.goods_number == 0) {
                                        $(".add-cart").addClass("disabled");
                                        $(".buy-goods").addClass("disabled");
                                    } else {
                                        $(".buy-goods").removeClass("disabled");
                                        $(".add-cart").removeClass("disabled");
                                    }
                                }
                            }
                        }, "json");
                    }

                    function getSkuInfo(sku_id,attr_id, callback) {
                        //修改了bug
                        // if ($(document).data("SZY-SKU-" + sku_id)) {
                        //     console.log(199);
                        //     var sku = $(document).data("SZY-SKU-" + sku_id);
                        //     // 回调
                        //     if ($.isFunction(callback)) {
                        //         callback.call({}, sku);
                        //     }
                        // } else {
                        //     console.log(sku_id,attr_id,555);
                            $.get('/goods/sku', {
                                sku_id: sku_id,
                                attr_id: attr_id,
                                is_lib_goods: ""
                            }, function(result) {
                                if (result.code == 0) {
                                    var sku = result.data;
                                    // console.log(callback);//setSkuInfo
                                    $(document).data("SZY-SKU-" + sku_id, sku);
                                    // 回调
                                    if ($.isFunction(callback)) {
                                        callback.call({}, sku);
                                    }
                                } else {
                                    $.msg(result.msg, {
                                        time: 5000
                                    });
                                }
                            }, "json");
                        // }
                    }

                    // 设置SKU信息
                    function setSkuInfo(sku) {

                        var is_lib_goods = "";
                        if (is_lib_goods == true) {
                            return false;
                        }

                        if (sku == undefined || sku == null || sku == false) {
                            $(".add-cart").addClass("disabled");
                            $(".buy-goods").addClass("disabled");
                            $(".SZY-GOODS-NUMBER").html("库存不足");
                            return;
                        }

                        //修改bug
                        if(sku.sku_images.length>0){
                            change_sku_images = true;
                        }

                        // 点击默认规格才会切换相册
                        if (change_sku_images == true) {
                            // 相册
                            $(".goodsgallery").goodsgallery({
                                images: sku.sku_images,
                                video: ""
                            });
                            change_sku_images = false;
                        }

                        var goods_number = sku.goods_number;

                        if (goods_number > 0) {
                            $('.amount-input').val(1);
                            if (sku_freights[local_region_code]) {
                                if (sku_freights[local_region_code].limit_sale == 1) {
                                    // 区域限售商品
                                }
                            } else {

                                // changeLocation(local_region_code).always(function(result) {
                                //     if (result.code == 0 && result.data.limit_sale == 1) {
                                //         setSkuInfo(sku);
                                //     }
                                // });
                                // return;
                            }
                        }

                        @if($goods['have_specs']==1)
                            //变换当前所选规格的名称
                            for(let i=0;i<sku.spec_ids.length;i++){
                                $('.already_select').find('.param'+sku.spec_ids[i]).find('.optionSel').text(sku.spec_attr_value[i]);
                            }
                            // $('.already_select').find('.optionSel').text(sku.spec_attr_value);
                        @endif

                        @if($goods['shop_id']>0)
                            // 商品名称
                            $(".SZY-GOODS-NAME").html(sku.sku_name);
                            //设置价格为最低
                            $('.sSZY-GOODS-PRICE').find('.SZY-CURRENCY').text(sku.low_price[0]);
                            $('.sSZY-GOODS-PRICE').find('.SZY-PRICE').text(sku.low_price[1]);
                            //重新修改商品价格区间展示 2024/12/04
                            let htmls = '';
                            for(let i=0;i<sku.sku_prices.start_num.length;i++){
                                htmls += '<div class="disf">\n' +
                                    '                                                    <div class="disf step_num">\n' +
                                    '                                                        <div class="start_num font12">'+sku.sku_prices.start_num[i]+'</div>\n';
                                if(sku.sku_prices.select_end[i]==1) {
                                    htmls += '                                                                                                                    -\n' +
                                        '                                                            <div class="end_num font12">'+sku.sku_prices.end_num[i]+'</div>\n' +
                                        '                                                            <div class="unit font12">'+sku.sku_prices.unit[0]+'</div>\n';
                                }
                                else{
                                    htmls += '                                                        <div class="end_num font12">'+sku.sku_prices.unit[0]+'&nbsp;以上</div>';
                                }
                                htmls += '                                               </div>\n' +
                                    '                                                    <div class="disf step_price_box">\n' +
                                    '                                                        <div class="disf" style="justify-content: left;">\n' +
                                    '                                                            <div class="font15 currency">'+sku.sku_prices.currency[0]+'</div>\n' +
                                    '                                                            <div class="font15 price">'+sku.sku_prices.price[i]+'</div>\n' +
                                    '                                                        </div>\n' +
                                    '                                                    </div>\n' +
                                    '                                                </div>';
                            }
                            $('.step_price_div').html(htmls);

                            if(1>2){
                                //商品规格区间 2024/01/19添加
                                let interval_html = '<table class="interval_table layui-table">\n' +
                                    '                            <thead>\n' +
                                    '                            <tr>\n' +
                                    '                            <th>起批量</th>\n' +
                                    '                            <th>价格</th>\n' +
                                    '                            </tr>\n' +
                                    '                            </thead>\n' +
                                    '                            <tbody>';

                                for(let i=0;i<sku.sku_prices.start_num.length;i++){
                                    interval_html += '<tr>\n'+
                                        '                     <td>' +
                                        '                         <div class="disf" style="justify-content: left;">\n'+
                                        '                         <div class="start_num font15">'+sku.sku_prices.start_num[i]+'</div>\n';
                                    if(sku.sku_prices.select_end[i]==1){
                                        interval_html += '     -\n'+
                                            '                          <div class="end_num font15">'+sku.sku_prices.end_num[i]+'</div><div class="unit font15">'+sku.sku_prices.unit[i]+'</div>\n';
                                    }else if(sku.sku_prices.select_end[i]==2){
                                        interval_html += '     <div class="end_num font15">'+sku.sku_prices.unit[i]+'&nbsp;以上</div>\n';
                                    }

                                    interval_html += '         </div>\n'+
                                        '                     </td>\n'+
                                        '                     <td>' +
                                        '                         <div class="disf" style="justify-content: left;">\n'+
                                        '                             <div class="font15">'+sku.sku_prices.currency[i]+'</div>\n'+
                                        '                             <div class="font15 color">'+sku.sku_prices.price[i]+'</div>\n'+
                                        '                         </div>\n'+
                                        '                     </td>\n'+
                                        '                 </td>';
                                }

                                interval_html += '</tbody>\n' +
                                    '       </table>';
                                $('.interval_div').html(interval_html);
                            }
                        @else
                            $('.SZY-GOODS-PRICE').find('.SZY-CURRENCY').text(sku.low_price[0]);
                            $('.SZY-GOODS-PRICE').find('.SZY-PRICE').text(sku.low_price[1]);
                        @endif

                        if (parseFloat(sku.market_price) == 0) {
                            $(".SZY-MARKET-PRICE").parents(".show-price").hide();
                        } else {
                            $(".SZY-MARKET-PRICE").parents(".show-price").show();
                        }

                        // 库存
                        if (goods_number > 0) {
                            if ("1" == 1) {
                                $('.amount_num').find('.amount-input').attr('data-amount-max',goods_number);
                                $('.amount_num').find('.amount-input').attr('data-sku_id',sku.sku_id);
                                $(".SZY-GOODS-NUMBER").html("库存" + goods_number + "件");
                            } else {
                                $(".SZY-GOODS-NUMBER").html("");
                            }
                        } else {
                            $(".SZY-GOODS-NUMBER").html("库存不足");
                        }

                        if (goods_number == 0) {
                            $(".add-cart").addClass("disabled");
                            $(".buy-goods").addClass("disabled");
                        } else {
                            $(".buy-goods").removeClass("disabled");
                            $(".add-cart").removeClass("disabled");
                        }

                        $(".amount-input").data("amount-min", 1);
                        $(".amount-input").data("amount-max", goods_number);

                        if (goods_number > 0 && $(".amount-input").val() == 0) {
                            $(".amount-input").val(1);
                        } else if (goods_number == 0 && $(".amount-input").val() != 0) {
                            $(".amount-input").val(0);
                        }

                        var goods_number_input = parseInt($(".amount-input").val());

                        if (goods_number_input > goods_number) {
                            $(".amount-input").val(goods_number);
                        }

                        // 判断促销模块是否显示
                        var show_activity = false;

                        //
                        show_activity = true;
                        //

                        // 会员价格
                        if (sku.rank_prices != undefined && sku.rank_prices != null) {
                            $(".SZY-RANK-LIST").find("p").remove();
                            var html = "";
                            for (var i = 0; i < sku.rank_prices.length; i++) {
                                var item = sku.rank_prices[i];
                                html += "<p>" + item.rank_name + ":" + item.rank_price_format + "</p>";
                            }
                            $(".SZY-RANK-LIST").append(html);
                            $(".SZY-RANK-PRICES").show();
                            // 展示促销
                            show_activity = true;
                        } else {
                            $(".SZY-RANK-PRICES").hide();
                        }

                        if (sku.member_price_message) {
                            $(".SZY-RANK-PRICES").show();
                            $(".SZY-RANK-MESSAGE").html(sku.member_price_message);
                            // 展示促销
                            show_activity = true;
                        } else {
                            $(".SZY-RANK-PRICES").hide();
                        }

                        // 处理赠品
                        if (sku.gift_list && sku.gift_list.length > 0) {

                            $(".SZY-GIFT-LIST").show();
                            $(".SZY-GIFT-LIST").find(".prom-gift").children().remove();

                            for (var i = 0; i < sku.gift_list.length; i++) {
                                var gift = sku.gift_list[i];
                                var template = $("#SZY_GIFT_TEMPLATE").html();
                                var element = $($.parseHTML(template));
                                $(element).find("img").attr("src", gift.goods_image_thumb);
                                $(element).find("a").attr("href", "/" + gift.gift_sku_id + ".html");
                                $(element).find("a").attr("title", "/" + gift.sku_name);
                                $(element).find(".gift-number").html("× " + gift.gift_number);
                                $(".SZY-GIFT-LIST").find(".prom-gift").append(element);
                            }

                            // 展示促销
                            show_activity = true;
                        } else {
                            $(".SZY-GIFT-LIST").hide();
                            $(".SZY-GIFT-LABEL").nextAll().remove();
                        }
                        //订单返现
                        if(typeof(sku.cash_back)!='undefined'){
                            if (sku.cash_back.message) {
                                show_activity = true;
                            }
                        }

                        if ($(".SZY-ACTIVITY").find(".discount").size() > 0) {
                            // 展示促销
                            show_activity = true;
                            $(".SZY-MARKET-PRICE").html(sku.original_price_format);
                        }

                        if (show_activity) {

                            $(".SZY-ACTIVITY").hide();
                        } else {
                            $(".SZY-ACTIVITY").hide();
                        }
                    }

                    $().ready(function() {
                        //==== 自定义触发 2024-01-26 START ====
                        //价格区间弹出
                        $('.price_info').hover(function(){
                            $(this).parents(":eq(1)").find('.interval_div').show();
                            $(this).parents(":eq(1)").find('.interval_div').css({'position':'absolute','top':'25px','left':'145px'});
                        },function(){
                            $(this).parents(":eq(1)").find('.interval_div').hide();
                        });
                        //==== 自定义触发 2024-01-26 END ====

                        // 获取SKU列表
                        sku_ids = $.parseJSON($("#SZY_SKU_LIST").html());
                        // 检查SKU组合
                        $.cart.checkSkus($(".SZY-GOODS-SPEC-ITEMS").find('.attr'), sku_ids);
                        // 绑定规格事件
                        $.cart.checkSpecs($(".SZY-GOODS-SPEC-ITEMS").find('.attr'), sku_ids, $(".SZY-GOODS-SPEC-ITEMS").find('.attr').find(".price_allow"), function(sku) {
                            // var attr_id = $(this).data('attr-id');//当前属性id
                            var attr_id = '';
                            //获取所有已选规格
                            $('.SZY-GOODS-SPEC-ITEMS').find('.attr').find('.selected').each(function(){
                                if($(this).data('attr-have_child')==0){
                                    attr_id += $(this).data('attr-id')+'|';
                                }
                            });
                            attr_id = attr_id.split('|').reverse().join('|');
                            // 是否为默认规格
                            var is_default = $(this).data("is-default");

                            if (is_default) {
                                // 如果是默认规格则标识将切换SKU的图片相册
                                change_sku_images = true;
                            }
                            // console.log(sku);
                            // console.log(sku.sku_id,attr_id,555);return false;
                            // SKU存在
                            getSkuInfo(sku.sku_id,attr_id, function(sku) {
                                setSkuInfo(sku);
                                $("title").html(sku.sku_name);
                            });
                        }, function() {

                            // 是否为默认规格
                            var is_default = $(this).data("is-default");

                            if (is_default) {
                                // 如果是默认规格则标识将切换SKU的图片相册
                                change_sku_images = true;
                            }

                            // SKU不存在
                            $(".add-cart").addClass("disabled");
                            $(".buy-goods").addClass("disabled");
                            $(".SZY-GOODS-NUMBER").html("库存不足");

                            $("title").html($(".SZY-GOODS-NAME-BASE").text());
                        });

                        // 商品数量步进器
                        var goods_number_amount = $(".amount-input").amount({
                            value: 1,
                            min: 1,
                            max: "97",
                            change: function(element, value) {
                                var sku_id = element.attr('data-sku_id');
                                if (value == this.max) {
                                }

                                if(value>0 && "{{$goods['shop_id']}}">0){
                                    $('.amount-input').val(value);
                                    $.post('/goods/calc_price_interval',{'sku_id':sku_id,'num':value,'_token':"{{csrf_token()}}"},function(data){
                                        $('.priceDiv').find('.sSZY-GOODS-PRICE').find('.SZY-PRICE').text(data.price);
                                    },'json');
                                }
                            },
                            max_callback: function() {
                                $.msg("最多只能购买" + this.max + "件");
                            },
                            min_callback: function() {
                                $.msg("商品数量必须大于" + (this.min - 1));
                            }
                        });

                        // 添加购物车
                        $(".add-cart").click(function(event) {

                            var is_lib_goods = "";
                            if (is_lib_goods == true) {
                                return false;
                            }

                            if ($(this).hasClass("disabled")) {
                                return false;
                            }

                            var image_url = $(".goodsgallery").find(".gg-handler li:first img").attr("src");
                            var sku_id = getSkuId();
                            $.cart.add(sku_id, $(".amount-input").val(), {
                                is_sku: true,
                                image_url: image_url,
                                event: event,
                                info_callback: function() {

                                }
                            });
                            return false;
                        });

                        // 立即购买（废弃）
                        $(".buy-goods").click(function() {
                            var act_type = "11";
                            var purchase = "15";
                            var pre_sale = "2";
                            var virtual = "0";
                            var is_lib_goods = "";
                            if (is_lib_goods == true) {
                                return;
                            }

                            if ($(this).hasClass("disabled")) {
                                return;
                            }
                            var sku_id = getSkuId();
                            var number = $(".amount-input").val();
                            var data = {};
                            if (act_type == purchase || act_type == pre_sale) {
                                data.act_type = act_type;
                            }
                            if (virtual > 0) {
                                data.virtual = virtual;
                            }
                            $.cart.quickBuy(sku_id, number, data);

                        });

                        // 立即兑换
                        $(".exchange-goods").click(function() {

                            if ($(this).hasClass("disabled")) {
                                var goods_number = "";
                                if (goods_number == 0) {
                                    $.msg('库存不足');
                                } else {
                                    $.msg('积分不足');
                                }
                                return;
                            }
                            var sku_id = getSkuId();
                            var number = $(".amount-input").val();
                            var data = {};
                            data.exchange = true;
                            $.cart.quickBuy(sku_id, number, data);
                        });

                        //立即购买
                        $('.buy-goods-soon').click(function(){
                            if("{{session('user.user_id')}}" != ''){
                                // var sku_id = getSkuId();
                                let li_selected = $('.SZY-GOODS-SPEC-ITEMS').find('.selected');
                                let spec_vids = '';
                                for(let i=0;i<li_selected.length;i++){
                                    if(li_selected.eq(i).data('attr-have_child')!=1){
                                        spec_vids += li_selected.eq(i).data('attr-id')+'|';
                                    }
                                }

                                var number = $(this).parents(":eq(2)").find(".amount-input").val();
                                layer.load();
                                $.ajax({
                                    url: "/loglastbuy",
                                    method: 'post',
                                    data: {'spec_vids':spec_vids,'number':number,'goods_id':"{{$goods['goods_id']}}",'type':1,'_token':"{{csrf_token()}}"},
                                    dataType: 'JSON',
                                    success: function (res) {
                                        layer.closeAll('loading');
                                        // layer.msg(res.msg,{time:2000}, function () {
                                        if (res.code == 0) {
                                            window.location.href='/order_confirm?cart_id='+res.cart_id;
                                        }else if(res.code==-1){
                                            layer.msg(res.msg);
                                        }
                                        // });
                                    }
                                });
                            }else{
                                show_login();
                            }
                        });
                    });
                </script>
                <!-- 商品详细信息 _end-->
            </div>
        </div>

        <!--商品详情-->
        <div class="detailContent">
            <div class="detailHead">
                <div class="detailHeadBox">
                    <div class="detailHeadTxt detailHeadTxtAct" onclick="change_detail_head(0,this)">商品详情</div>
                    @if($goods['shop_id']>0)
                        <div class="detailHeadTxt" onclick="change_detail_head(1,this)">物流说明</div>
                        <div class="detailHeadTxt" onclick="change_detail_head(2,this)">卖家说明</div>
                        @if(!empty($goods['reduction_content']) || !empty($goods['gift_content']) || !empty($goods['noinclude_content']) || !empty($goods['potential_content']) || !empty($goods['activity_info']))
                        <div class="detailHeadTxt" onclick="change_detail_head(3,this)">价格说明</div>
                        @endif
                    @endif
                </div>
                <div class="detailBtmBox">
                    <div class="detailBtmDiv detailBtmShow" onclick="location_to('paramInfoDiv')">
                        @if($goods['shop_id']>0 && !empty($goods['spec_info']) || !empty($goods['manufacture']) || !empty($goods['sales']) || !empty($goods['foreign']) || !empty($goods['effective']) || !empty($goods['store']) || !empty($goods['packing']))
                        <div class="detailBtmTxt detailBtmTxtAct">参数信息</div>
                        @endif
                        <div class="detailBtmTxt @if($goods['shop_id']==0)
                                detailBtmTxtAct
                        @endif" onclick="location_to('picTitleDiv')">图文详情</div>
                    </div>
                    <div class="detailBtmDiv detailBtmHide">
                        <div class="detailBtmTxt detailBtmTxtAct">物流支撑</div>
                    </div>
                    <div class="detailBtmDiv detailBtmHide">
                        <div class="detailBtmTxt detailBtmTxtAct">规则声明</div>
                    </div>
                    <div class="detailBtmDiv detailBtmHide">
                        @if($goods['shop_id']>0 && !empty($goods['reduction_content']))
                            <div class="detailBtmTxt detailBtmTxtAct" onclick="location_to('reductionInfoDiv')">销售优惠-减免</div>
                        @endif
                        @if($goods['shop_id']>0 && !empty($goods['gift_content']))
                            <div class="detailBtmTxt" onclick="location_to('giftInfoDiv')">销售优惠-随赠</div>
                        @endif
                        @if($goods['shop_id']>0 && !empty($goods['noinclude_content']))
                            <div class="detailBtmTxt" onclick="location_to('noincludeInfoDiv')">价格未含</div>
                        @endif
                        @if($goods['shop_id']>0 && !empty($goods['potential_content']))
                            <div class="detailBtmTxt" onclick="location_to('potentialInfoDiv')">潜在收费</div>
                        @endif
                        @if($goods['shop_id']>0 && !empty($goods['activity_info']))
                            <div class="detailBtmTxt" onclick="location_to('activityInfoDiv')">活动参与</div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="detailBtm">
                <div class="detailBtmLeft">
                    <div class="detailBtmDiv detailBtmShow">
                        @if($goods['shop_id']>0 && !empty($goods['manufacture']))
                            <div class="detailBtmTitle paramInfoDiv">制造企业</div>
                            <div class="detailBtmInfo">
                                <div class="baseDropsInfo--wbxz8fyq">
                                    <div class="tableWrapper--APDk75pt">
                                        @if(isset($goods['manufacture']['company_name']))
                                            <div class="infoItem--Z4hNxv8b">
                                                <div class="infoItemTitle--P41WPBIx" title="企业名称">企业名称</div>
                                                <div class="infoItemContent--IJwpPvuk" title="{{$goods['manufacture']['company_name']}}">{{$goods['manufacture']['company_name']}}</div>
                                            </div>
                                        @endif
                                        @if(isset($goods['manufacture']['address']))
                                            <?php $area_addr = '';?>
                                            @if(isset($goods['manufacture']['area1'])) <?php $area_addr .= $goods['manufacture']['area1_name'];?> @endif
                                            @if(isset($goods['manufacture']['area2'])) <?php $area_addr .= $goods['manufacture']['area2_name'];?> @endif
                                            @if(isset($goods['manufacture']['area3'])) <?php $area_addr .= $goods['manufacture']['area3_name'];?> @endif
                                            @if(isset($goods['manufacture']['area4'])) <?php $area_addr .= $goods['manufacture']['area4_name'];?> @endif
                                            @if(isset($goods['manufacture']['area5'])) <?php $area_addr .= $goods['manufacture']['area5_name'];?> @endif
                                            @if(isset($goods['manufacture']['area6'])) <?php $area_addr .= $goods['manufacture']['area6_name'];?> @endif

                                            <div class="infoItem--Z4hNxv8b">
                                                <div class="infoItemTitle--P41WPBIx" title="注册地址">注册地址</div>
                                                <div class="infoItemContent--IJwpPvuk" title="{{$goods['manufacture']['country_name']}}<?php echo $area_addr;?>{{$goods['manufacture']['address']}}">
                                                    {{$goods['manufacture']['country_name']}}<?php echo $area_addr;?>{{$goods['manufacture']['address']}}
                                                </div>
                                            </div>
                                        @endif
                                        @if(isset($goods['manufacture']['connect_type']))
                                            <div class="infoItem--Z4hNxv8b">
                                                <div class="infoItemTitle--P41WPBIx" title="{{$goods['manufacture']['connect_type']}}">{{$goods['manufacture']['connect_type']}}</div>
                                                <div class="infoItemContent--IJwpPvuk" title="{{$goods['manufacture']['connect_info']}}">{{$goods['manufacture']['connect_info']}}</div>
                                            </div>
                                        @endif
                                        @if(isset($goods['manufacture']['product_license']))
                                            <div class="infoItem--Z4hNxv8b">
                                                <div class="infoItemTitle--P41WPBIx" title="生产许可">生产许可</div>
                                                <div class="infoItemContent--IJwpPvuk" title="{{$goods['manufacture']['product_license']}}">{{$goods['manufacture']['product_license']}}</div>
                                            </div>
                                        @endif
                                        @if(isset($goods['manufacture']['product_standard']))
                                            <div class="infoItem--Z4hNxv8b">
                                                <div class="infoItemTitle--P41WPBIx" title="生产标准">生产标准</div>
                                                <div class="infoItemContent--IJwpPvuk" title="{{$goods['manufacture']['product_standard']}}">{{$goods['manufacture']['product_standard']}}</div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($goods['shop_id']>0 && !empty($goods['sales']))
                            <div class="detailBtmTitle paramInfoDiv">销售企业</div>
                            <div class="detailBtmInfo">
                                <div class="baseDropsInfo--wbxz8fyq">
                                    <div class="tableWrapper--APDk75pt">
                                        @if(isset($goods['sales']['company_name']))
                                            <div class="infoItem--Z4hNxv8b">
                                                <div class="infoItemTitle--P41WPBIx" title="企业名称">企业名称</div>
                                                <div class="infoItemContent--IJwpPvuk" title="{{$goods['sales']['company_name']}}">{{$goods['sales']['company_name']}}</div>
                                            </div>
                                        @endif
                                        @if(isset($goods['sales']['address']))
                                            <?php $area_addr = '';?>
                                            @if(isset($goods['sales']['area1'])) <?php $area_addr .= $goods['sales']['area1_name'];?> @endif
                                            @if(isset($goods['sales']['area2'])) <?php $area_addr .= $goods['sales']['area2_name'];?> @endif
                                            @if(isset($goods['sales']['area3'])) <?php $area_addr .= $goods['sales']['area3_name'];?> @endif
                                            @if(isset($goods['sales']['area4'])) <?php $area_addr .= $goods['sales']['area4_name'];?> @endif
                                            @if(isset($goods['sales']['area5'])) <?php $area_addr .= $goods['sales']['area5_name'];?> @endif
                                            @if(isset($goods['sales']['area6'])) <?php $area_addr .= $goods['sales']['area6_name'];?> @endif

                                            <div class="infoItem--Z4hNxv8b">
                                                <div class="infoItemTitle--P41WPBIx" title="注册地址">注册地址</div>
                                                <div class="infoItemContent--IJwpPvuk" title="{{$goods['sales']['country_name']}}<?php echo $area_addr;?>{{$goods['sales']['address']}}">
                                                    {{$goods['sales']['country_name']}}<?php echo $area_addr;?>{{$goods['sales']['address']}}
                                                </div>
                                            </div>
                                        @endif
                                        @if(isset($goods['sales']['connect_type']))
                                            <div class="infoItem--Z4hNxv8b">
                                                <div class="infoItemTitle--P41WPBIx" title="{{$goods['sales']['connect_type']}}">{{$goods['sales']['connect_type']}}</div>
                                                <div class="infoItemContent--IJwpPvuk" title="{{$goods['sales']['connect_info']}}">{{$goods['sales']['connect_info']}}</div>
                                            </div>
                                        @endif
                                        @if(isset($goods['sales']['product_license']))
                                            <div class="infoItem--Z4hNxv8b">
                                                <div class="infoItemTitle--P41WPBIx" title="销售许可">销售许可</div>
                                                <div class="infoItemContent--IJwpPvuk" title="{{$goods['sales']['product_license']}}">{{$goods['sales']['product_license']}}</div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($goods['shop_id']>0 && !empty($goods['foreign']))
                            <div class="detailBtmTitle paramInfoDiv">外贸企业</div>
                            <div class="detailBtmInfo">
                                <div class="baseDropsInfo--wbxz8fyq">
                                    <div class="tableWrapper--APDk75pt">
                                        @if(isset($goods['foreign']['company_name']))
                                            <div class="infoItem--Z4hNxv8b">
                                                <div class="infoItemTitle--P41WPBIx" title="企业名称">企业名称</div>
                                                <div class="infoItemContent--IJwpPvuk" title="{{$goods['foreign']['company_name']}}">{{$goods['foreign']['company_name']}}</div>
                                            </div>
                                        @endif
                                            @if(isset($goods['foreign']['address']))
                                                <?php $area_addr = '';?>
                                                @if(isset($goods['foreign']['area1'])) <?php $area_addr .= $goods['foreign']['area1_name'];?> @endif
                                                @if(isset($goods['foreign']['area2'])) <?php $area_addr .= $goods['foreign']['area2_name'];?> @endif
                                                @if(isset($goods['foreign']['area3'])) <?php $area_addr .= $goods['foreign']['area3_name'];?> @endif
                                                @if(isset($goods['foreign']['area4'])) <?php $area_addr .= $goods['foreign']['area4_name'];?> @endif
                                                @if(isset($goods['foreign']['area5'])) <?php $area_addr .= $goods['foreign']['area5_name'];?> @endif
                                                @if(isset($goods['foreign']['area6'])) <?php $area_addr .= $goods['foreign']['area6_name'];?> @endif

                                                <div class="infoItem--Z4hNxv8b">
                                                    <div class="infoItemTitle--P41WPBIx" title="注册地址">注册地址</div>
                                                    <div class="infoItemContent--IJwpPvuk" title="{{$goods['foreign']['country_name']}}<?php echo $area_addr;?>{{$goods['foreign']['address']}}">
                                                        {{$goods['foreign']['country_name']}}<?php echo $area_addr;?>{{$goods['foreign']['address']}}
                                                    </div>
                                                </div>
                                            @endif
                                        @if(isset($goods['foreign']['connect_type']))
                                            <div class="infoItem--Z4hNxv8b">
                                                <div class="infoItemTitle--P41WPBIx" title="{{$goods['foreign']['connect_type']}}">{{$goods['foreign']['connect_type']}}</div>
                                                <div class="infoItemContent--IJwpPvuk" title="{{$goods['foreign']['connect_info']}}">{{$goods['foreign']['connect_info']}}</div>
                                            </div>
                                        @endif
                                        @if(isset($goods['foreign']['product_type']))
                                            <div class="infoItem--Z4hNxv8b">
                                                <div class="infoItemTitle--P41WPBIx" title="{{$goods['foreign']['product_type']}}">{{$goods['foreign']['product_type']}}</div>
                                                <div class="infoItemContent--IJwpPvuk" title="{{$goods['foreign']['product_license']}}">{{$goods['foreign']['product_license']}}</div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($goods['shop_id']>0 && !empty($goods['effective']))
                            <div class="detailBtmTitle paramInfoDiv">有效期限</div>
                            <div class="detailBtmInfo">
                                <div class="baseDropsInfo--wbxz8fyq">
                                    <div class="tableWrapper--APDk75pt">
                                        @if(isset($goods['effective']['type']))
                                            <div class="infoItem--Z4hNxv8b">
                                                <div class="infoItemTitle--P41WPBIx" title="生产日期">生产日期</div>
                                                <div class="infoItemContent--IJwpPvuk" title="@if($goods['effective']['type']==1)
                                                        详见包装
                                                @elseif($goods['effective']['type']==2)
                                                    @if($goods['effective']['type2']==1)
                                                        {{$goods['effective']['fixed_day']}}
                                                    @elseif($goods['effective']['type2']==2)
                                                        {{$goods['effective']['interval_day']}}
                                                    @endif
                                                @endif">
                                                    @if($goods['effective']['type']==1)
                                                        详见包装
                                                    @elseif($goods['effective']['type']==2)
                                                        @if($goods['effective']['type2']==1)
                                                            {{$goods['effective']['fixed_day']}}
                                                        @elseif($goods['effective']['type2']==2)
                                                            {{$goods['effective']['interval_day']}}
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                        @if(isset($goods['effective']['valid_period']))
                                            <div class="infoItem--Z4hNxv8b">
                                                <div class="infoItemTitle--P41WPBIx" title="有效期限">有效期限</div>
                                                <div class="infoItemContent--IJwpPvuk" title="{{$goods['effective']['valid_period']}}{{$goods['effective']['valid_unit']}}">
                                                    {{$goods['effective']['valid_period']}}{{$goods['effective']['valid_unit']}}
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($goods['shop_id']>0 && !empty($goods['store']))
                            <div class="detailBtmTitle paramInfoDiv">贮存条件</div>
                            <div class="detailBtmInfo">
                                <div class="baseDropsInfo--wbxz8fyq">
                                    <div class="tableWrapper--APDk75pt">
                                        @if(isset($goods['store']['temperature_condition']))
                                            <div class="infoItem--Z4hNxv8b">
                                                <div class="infoItemTitle--P41WPBIx" title="温度条件">温度条件</div>
                                                <div class="infoItemContent--IJwpPvuk" title="{{$goods['store']['temperature_condition']}}">
                                                    {{$goods['store']['temperature_condition']}}
                                                </div>
                                            </div>
                                        @endif
                                        @if(isset($goods['store']['humidity_condition']))
                                            <div class="infoItem--Z4hNxv8b">
                                                <div class="infoItemTitle--P41WPBIx" title="湿度条件">湿度条件</div>
                                                <div class="infoItemContent--IJwpPvuk" title="@if($goods['store']['humidity_condition']=='相对湿度 X%-Y % 保存')
                                                        相对湿度 {{$goods['store']['humidity_x']}}%-{{$goods['store']['humidity_y']}}% 保存
                                                    @else
                                                        {{$goods['store']['humidity_condition']}}
                                                    @endif
                                                        ">
                                                    @if($goods['store']['humidity_condition']=='相对湿度 X%-Y % 保存')
                                                        相对湿度 {{$goods['store']['humidity_x']}}%-{{$goods['store']['humidity_y']}}% 保存
                                                    @else
                                                        {{$goods['store']['humidity_condition']}}
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                        @if(isset($goods['store']['light_condition']))
                                            <div class="infoItem--Z4hNxv8b">
                                                <div class="infoItemTitle--P41WPBIx" title="光照条件">光照条件</div>
                                                <div class="infoItemContent--IJwpPvuk" title="{{$goods['store']['light_condition']}}">
                                                    {{$goods['store']['light_condition']}}
                                                </div>
                                            </div>
                                        @endif
                                        @if(isset($goods['store']['packing_condition']))
                                            <div class="infoItem--Z4hNxv8b">
                                                <div class="infoItemTitle--P41WPBIx" title="包装条件">包装条件</div>
                                                <div class="infoItemContent--IJwpPvuk" title="{{$goods['store']['packing_condition']}}">
                                                    {{$goods['store']['packing_condition']}}
                                                </div>
                                            </div>
                                        @endif
                                        @if(isset($goods['store']['store_condition']))
                                            <div class="infoItem--Z4hNxv8b">
                                                <div class="infoItemTitle--P41WPBIx" title="储存环境">储存环境</div>
                                                <div class="infoItemContent--IJwpPvuk" title="{{$goods['store']['store_condition']}}">
                                                    {{$goods['store']['store_condition']}}
                                                </div>
                                            </div>
                                        @endif
                                        @if(isset($goods['store']['special_condition']))
                                            <div class="infoItem--Z4hNxv8b">
                                                <div class="infoItemTitle--P41WPBIx" title="特殊要求">特殊要求</div>
                                                <div class="infoItemContent--IJwpPvuk" title="{{$goods['store']['special_condition']}}">
                                                    {{$goods['store']['special_condition']}}
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($goods['shop_id']>0 && !empty($goods['packing']))
                            <div class="detailBtmTitle paramInfoDiv">产品包装</div>
                            <div class="detailBtmInfo">
                                <div class="baseDropsInfo--wbxz8fyq">
                                    <div class="tableWrapper--APDk75pt">
                                        @if(isset($goods['packing']['type']))
                                            <div class="infoItem--Z4hNxv8b">
                                                <div class="infoItemTitle--P41WPBIx" title="有无包装">有无包装</div>
                                                <div class="infoItemContent--IJwpPvuk" title="{{$goods['packing']['type']}}">
                                                    {{$goods['packing']['type']}}
                                                </div>
                                            </div>
                                            @if($goods['packing']['type']=='无包装')
                                                <div class="infoItem--Z4hNxv8b">
                                                    <div class="infoItemTitle--P41WPBIx" title="产品包装">产品包装</div>
                                                    <div class="infoItemContent--IJwpPvuk" title="{{$goods['packing']['no_pack']}}">
                                                        {{$goods['packing']['no_pack']}}
                                                    </div>
                                                </div>
                                            @elseif($goods['packing']['type']=='有包装')
                                                <div class="infoItem--Z4hNxv8b">
                                                    <div class="infoItemTitle--P41WPBIx" title="包装方式">包装方式</div>
                                                    <div class="infoItemContent--IJwpPvuk" title="@if($goods['packing']['method']==1)
                                                            木质包装
                                                        @elseif($goods['packing']['method']==2)
                                                            纸质包装
                                                        @elseif($goods['packing']['method']==3)
                                                            塑料包装
                                                        @elseif($goods['packing']['method']==4)
                                                            金属包装
                                                        @elseif($goods['packing']['method']==5)
                                                            玻璃包装
                                                        @elseif($goods['packing']['method']==6)
                                                            复合包装
                                                        @endif">
                                                        @if($goods['packing']['method']==1)
                                                            木质包装
                                                        @elseif($goods['packing']['method']==2)
                                                            纸质包装
                                                        @elseif($goods['packing']['method']==3)
                                                            塑料包装
                                                        @elseif($goods['packing']['method']==4)
                                                            金属包装
                                                        @elseif($goods['packing']['method']==5)
                                                            玻璃包装
                                                        @elseif($goods['packing']['method']==6)
                                                            复合包装
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="infoItem--Z4hNxv8b">
                                                    <div class="infoItemTitle--P41WPBIx" title="包装容器">包装容器</div>
                                                    <div class="infoItemContent--IJwpPvuk" title="{{$goods['packing']['packing_container_name']}}">
                                                        {{$goods['packing']['packing_container_name']}}
                                                    </div>
                                                </div>
                                                <div class="infoItem--Z4hNxv8b">
                                                    <div class="infoItemTitle--P41WPBIx" title="包装材料">包装材料</div>
                                                    <div class="infoItemContent--IJwpPvuk" title="{{$goods['packing']['packing_material_name']}}">
                                                        {{$goods['packing']['packing_material_name']}}
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($goods['shop_id']>0 && !empty($goods['spec_info']))
                            <div class="detailBtmTitle paramInfoDiv">参数信息</div>
                            <div class="detailBtmInfo">
                                <div class="baseDropsInfo--wbxz8fyq">
                                    <div class="tableWrapper--APDk75pt">
                                        @foreach($goods['spec_info'] as $k=>$v)
                                            <div class="infoItem--Z4hNxv8b">
                                                <div class="infoItemTitle--P41WPBIx" title="{{$v['spec_name']}}">{{$v['spec_name']}}</div>
                                                <div class="infoItemContent--IJwpPvuk" title="{{$v['spec_desc']}}">{{$v['spec_desc']}}</div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if(!empty($goods['pc_desc']))
                            <div class="detailBtmTitle picTitleDiv">图文详情</div>
                            <div class="detailBtmInfo" style="min-height:500px;">
                                {!! $goods['pc_desc'] !!}
                            </div>
                        @endif
                    </div>

                    @if($goods['shop_id']>0 && !empty($goods['spec_info']))
                    <div class="detailBtmDiv detailBtmHide">
                        <div class="detailBtmTitle paramInfoDiv">物流支撑</div>
                        <div class="detailBtmInfo">
                            <div class="baseDropsInfo--wbxz8fyq" style="min-height: 500px;">
                                <div class="tableWrapper--APDk75pt">
                                    <div class="infoItem--Z4hNxv8b">
                                        <div class="infoItemTitle--P41WPBIx">物流支撑</div>
                                        <div class="infoItemContent--IJwpPvuk">支持（{{$goods['shipping_country_name']}}）@if($goods['service_type']==1) 国内配送 @elseif($goods['service_type']==2) 跨境配送 @endif</div>
                                    </div>
                                    @if($goods['service_type']==1)
                                        @foreach($goods['domestic_logistics']['name'] as $k=>$v)
                                            <div class="infoItem--Z4hNxv8b">
                                                <div class="infoItemTitle--P41WPBIx">{{$v}}</div>
                                                <div class="infoItemContent--IJwpPvuk" title="{{$goods['domestic_logistics']['areas'][$k]['area1']}} {{$goods['domestic_logistics']['areas'][$k]['area2']}} {{$goods['domestic_logistics']['areas'][$k]['area3']}} {{$goods['domestic_logistics']['areas'][$k]['area4']}} {{$goods['domestic_logistics']['areas'][$k]['area5']}} {{$goods['domestic_logistics']['areas'][$k]['area6']}}">
                                                    {{$goods['domestic_logistics']['areas'][$k]['area1']}} {{$goods['domestic_logistics']['areas'][$k]['area2']}} {{$goods['domestic_logistics']['areas'][$k]['area3']}} {{$goods['domestic_logistics']['areas'][$k]['area4']}} {{$goods['domestic_logistics']['areas'][$k]['area5']}} {{$goods['domestic_logistics']['areas'][$k]['area6']}}
                                                </div>
                                            </div>
                                        @endforeach
                                    @elseif($goods['service_type']==2 && $goods['gather_method']==2 && $goods['support_export']==1)
                                        @foreach($goods['gather_countrys']['areas'] as $k=>$v)
                                            <div class="infoItem--Z4hNxv8b">
                                                <div class="infoItemTitle--P41WPBIx">{{$v['area1']['param1']}}-{{$v['area2']['param2']}}</div>
                                                <?php $postal='';?>
                                                @foreach($v['area3'] as $k2=>$v2)
                                                    <?php $postal.=$v2['code_name'].'、';?>
                                                @endforeach
                                                <div class="infoItemContent--IJwpPvuk" title="<?php echo rtrim($postal, '、');?>">
                                                    <?php echo rtrim($postal, '、');?>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($goods['shop_id']>0 && !empty($goods['rule_id']))
                        <style>
                            .detailBtmDiv .layui-colla-title{background:{{$website['color']}};color:{{$website['color_word']}};}
                            .detailBtmDiv p{font-size:15px;color:#000;}
                        </style>
                        <div class="detailBtmDiv detailBtmHide">
                            <div class="detailBtmTitle paramInfoDiv">规则声明</div>
                            <div class="detailBtmInfo">
                                <div style="border:0px solid {{$website['fontcolor']}};height: 650px;overflow-y: scroll;padding:0 10px;box-sizing:border-box;background:#fff;">
                                    <!--序言头部-->
                                    @if($goods['rule']['is_preamble']==1 && $goods['rule']['position_display']==1)
                                        <div class="preamble_con" style="margin-top:0.5cm;">{!! $goods['rule']['preamble_con'] !!}</div>
                                    @endif
                                    @if($goods['rule']['type']==1)
                                        <div class="layui-collapse" lay-accordion="now" style="margin:10px 0;">
                                            @foreach($goods['rule']['content2'] as $key=>$vo)
                                                <div class="layui-colla-item">
                                                    <h2 class="layui-colla-title">{{$vo['parag_num']}}&nbsp;{{$vo['title']}}</h2>
                                                    <div class="layui-colla-content @if($key==0)
                                                            layui-show
@endif">
                                                        <p>{{$vo['content']}}</p>
                                                        @if(!empty($vo['children']))
                                                            @foreach($vo['children'] as $key2=>$vo2)
                                                                <div class="layui-collapse" lay-accordion="now" onclick="hide_sib(this)">
                                                                    <div class="layui-colla-item">
                                                                        <h2 class="layui-colla-title">{{$vo2['parag_num']}}&nbsp;{{$vo2['title']}}</h2>
                                                                        <div class="layui-colla-content @if($key2==0)
                                                                                layui-show
@endif">
                                                                            <p>{{$vo2['content']}}</p>
                                                                            @if(!empty($vo2['children']))
                                                                                @foreach($vo2['children'] as $key3 => $vo3)
                                                                                    <div class="layui-collapse" lay-accordion="now" lay-filter="now" onclick="hide_sib(this)">
                                                                                        <div class="layui-colla-item">
                                                                                            <h2 class="layui-colla-title" data-parag_num="{{$vo3['parag_num']}}">{{$vo3['parag_num']}}&nbsp;{{$vo3['title']}}</h2>
                                                                                            <div class="layui-colla-content">
                                                                                                <p>{{$vo3['content']}}</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div style="padding-top:1cm;">
                                            @foreach($goods['rule']['content'] as $k=>$vo)
                                                <div class="context">{!! $vo !!}</div>
                                            @endforeach
                                        </div>
                                    @endif
                                <!--序言底部-->
                                    @if($goods['rule']['is_preamble']==1 && $goods['rule']['position_display']==2)
                                        <div class="preamble_con" style="margin-bottom:0.5cm;">{{$goods['rule']['preamble_con']}}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($goods['shop_id']>0 && !empty($goods['reduction_content']))
                        <div class="detailBtmDiv detailBtmHide">
                            @if($goods['shop_id']>0 && !empty($goods['reduction_content']))
                                <div class="detailBtmTitle reductionInfoDiv">销售优惠-减免</div>
                                <div class="detailBtmInfo">
                                    <table class="layui-table">
                                        <thead>
                                        <th>优惠权属</th>
                                        <th>优惠限制</th>
                                        <th>优惠金额</th>
                                        </thead>
                                        <tbody>
                                        @foreach($goods['reduction_content']['preferential_blong'] as $k=>$v)
                                            <tr>
                                                <td>
                                                    @if($v==1)
                                                        卖家优惠
                                                    @elseif($v==2)
                                                        平台优惠
                                                    @elseif($v==3)
                                                        他方优惠
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($goods['reduction_content']['strict'][$k]==1)
                                                        单独
                                                    @elseif($goods['reduction_content']['strict'][$k]==2)
                                                        叠加
                                                    @endif
                                                </td>
                                                <td>
                                                    {{$goods['reduction_content']['content'][$k][0]}} {{$goods['reduction_content']['currency1']}} {{$goods['reduction_content']['price1'][$k]}} {{$goods['reduction_content']['content'][$k][2]}} {{$goods['reduction_content']['currency1']}} {{$goods['reduction_content']['price2'][$k]}}
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                            @if($goods['shop_id']>0 && !empty($goods['gift_content']))
                                <div class="detailBtmTitle giftInfoDiv">销售优惠-随赠</div>
                                <div class="detailBtmInfo">
                                    <table class="layui-table">
                                        <thead>
                                        <th>优惠权属</th>
                                        <th>优惠项目</th>
                                        <th>优惠限制</th>
                                        </thead>
                                        <tbody>
                                        @foreach($goods['gift_content']['preferential_blong'] as $k=>$v)
                                            <tr>
                                                <td>
                                                    @if($v==1)
                                                        卖家优惠
                                                    @elseif($v==2)
                                                        平台优惠
                                                    @elseif($v==3)
                                                        他方优惠
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($goods['gift_content']['type'][$k]==1)
                                                        积分赠送
                                                        @if($goods['gift_content']['points_type'][$k]==1)
                                                            按订单/次，赠送{{$goods['gift_content']['points_send'][$k]}}积分
                                                        @elseif($goods['gift_content']['points_type'][$k]==2)
                                                            按金额，每{{$goods['gift_content']['points_currency']}}<?php echo number_format($goods['gift_content']['points_money'][$k], 2);?>赠送{{$goods['gift_content']['points_send'][$k]}}积分
                                                        @endif
                                                    @elseif($goods['gift_content']['type'][$k]==2)
                                                        卡券赠送，赠送{{$goods['gift_content']['coupon_num'][$k]}}张价值{{$goods['gift_content']['coupon_currency']}}<?php echo number_format($goods['gift_content']['coupon_money'][$k], 2);?>
                                                    @elseif($goods['gift_content']['type'][$k]==3)
                                                        @if($goods['gift_content']['accgift_type'][$k]==1)
                                                            虚拟赠送，赠送{{$goods['gift_content']['accgift_num'][$k]}}（个/件/次）{{$goods['gift_content']['accgift_content'][$k]}}
                                                        @elseif($goods['gift_content']['accgift_type'][$k]==2)
                                                            服务赠送，赠送{{$goods['gift_content']['accgift_num'][$k]}}（个/件/次）{{$goods['gift_content']['accgift_content'][$k]}}
                                                        @elseif($goods['gift_content']['accgift_type'][$k]==3)
                                                            实物赠送，赠送{{$goods['gift_content']['accgift_num'][$k]}}（个/件/次）{{$goods['gift_content']['accgift_content'][$k]}}
                                                        @endif
                                                    @endif


                                                </td>
                                                <td>
                                                    @if($goods['gift_content']['strict'][$k]==1)
                                                        单独
                                                    @elseif($goods['gift_content']['strict'][$k]==2)
                                                        叠加
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                            @if($goods['shop_id']>0 && !empty($goods['noinclude_content']))
                                <div class="detailBtmTitle noincludeInfoDiv">价格未含</div>
                                <div class="detailBtmInfo">
                                    <table class="layui-table">
                                        <thead>
                                        <th>费用名称</th>
                                        <th>摘要描述</th>
                                        <th>计量单价</th>
                                        </thead>
                                        <tbody>
                                        @foreach($goods['noinclude_content']['name'] as $k=>$v)
                                            <tr>
                                                <td>{{$v}}</td>
                                                <td>{{$goods['noinclude_content']['desc'][$k]}}</td>
                                                <td>{{$goods['noinclude_content']['currency']}} {{$goods['noinclude_content']['price'][$k]}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                            @if($goods['shop_id']>0 && !empty($goods['potential_content']))
                                <div class="detailBtmTitle potentialInfoDiv">潜在收费</div>
                                <div class="detailBtmInfo">
                                    <table class="layui-table">
                                        <thead>
                                        <th>费用名称</th>
                                        <th>摘要描述</th>
                                        <th>计量单价</th>
                                        </thead>
                                        <tbody>
                                        @foreach($goods['potential_content']['name'] as $k=>$v)
                                            <tr>
                                                <td>{{$v}}</td>
                                                <td>{{$goods['potential_content']['desc'][$k]}}</td>
                                                <td>{{$goods['potential_content']['currency'][$k]}} {{$goods['potential_content']['price'][$k]}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                            @if($goods['shop_id']>0 && !empty($goods['activity_info']))
                                <div class="detailBtmTitle activityInfoDiv">活动参与</div>
                                <div class="detailBtmInfo">
                                    <table class="layui-table">
                                        <thead>
                                        <th>活动名称</th>
                                        <th>#</th>
                                        </thead>
                                        <tbody>
                                        @foreach($goods['activity_info'] as $k=>$v)
                                            <tr>
                                                <td>{{$v['name']}}</td>
                                                <td><div class="layui-btn layui-btn-xs layui-btn-normal" style="background:{{$website['color']}};color:{{$website['color_word']}};border:1px solid {{$website['color_word']}};">进入活动</div></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
                <div class="detailBtmRight">
                    <div class="buyBox">
                        <div class="buyBoxHead">
                            <img src="{{$goods['goods_image']}}" class="buyBoxImg">
                            <div class="now-prices disf">
                                <div class="priceDiv">
                                    @if($goods['shop_id']==0)
                                        <strong class="p-price SZY-GOODS-PRICE"><span class="SZY-CURRENCY">{{$goods['currency']}}</span>&nbsp;<span class="SZY-PRICE"><?php echo number_format($goods['goods_price'], 2);?></span></strong>
                                    @else
                                        <style>
                                            .detailContent .detailBtm .detailBtmRight .buyBox .buyBoxHead .now-prices{height:100px;line-height: unset;float:right;overflow-y: auto;margin-left:0;width: calc(100% - 110px);padding: 10px 0px 10px 5px;}
                                            .detailContent .detailBtm .detailBtmRight .buyBox .buyBoxHead .step_price_div .step_num{min-width: 78px;}
                                        </style>
                                        <div class="step_price_div">
                                            @foreach($sku['sku_prices']['start_num'] as $k=>$v)
                                                <div class="disf">
                                                    <div class="disf step_num">
                                                        <div class="start_num font12">{{$v}}</div>
                                                        @if($sku['sku_prices']['select_end'][$k]==1)
                                                            -
                                                            <div class="end_num font12">{{$sku['sku_prices']['end_num'][$k]}}</div>
                                                            <div class="unit font12">{{$sku['sku_prices']['unit'][0]}}</div>
                                                        @else
                                                            <div class="end_num font12">{{$sku['sku_prices']['unit'][0]}}&nbsp;以上</div>
                                                        @endif
                                                    </div>
                                                    <div class="disf step_price_box">
                                                        <div class="disf" style="justify-content: left;">
                                                            <div class="font15 currency">{{$sku['sku_prices']['currency'][0]}}</div>
                                                            <div class="font15 price"><?php echo number_format($sku['sku_prices']['price'][$k], 2);?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if(1>2)
                        <div class="buyBoxMiddle">
                            <div class="choose SZY-GOODS-SPEC-ITEMS">
                                @if(!empty($goods['spec_list']))
                                    <div class="layui-tab" lay-filter="test-hash">
                                        <ul class="layui-tab-title">
                                            @foreach($goods['spec_list'] as $k=>$v)
                                                @if(isset($v['attr_name']))
                                                    <li class="@if($k==0)
                                                            layui-this
@endif" lay-id="{{$v['attr_id']}}">{{$v['attr_name']}}</li>
                                                @endif
                                            @endforeach
                                        </ul>
                                        <div class="layui-tab-content">
                                            @foreach($goods['spec_list'] as $k=>$v)
                                                @if(isset($v['attr_name']))
                                                    <div class="layui-tab-item @if($k==0)
                                                            layui-show
@endif">
                                                        <!-- 如果规格下没有库存，红色提示背景给dl标签追加class值"no-stock-bg" -->
                                                        <dl class="attr attr{{$v['attr_id']}} @if($k==0)
                                                                attr_show
@else
                                                                attr_hide
@endif">
                                                            <dd class="dd">
                                                                <ul data-attr-id="{{ $v['attr_id'] }}">

                                                                @foreach($v['attr_values'] as $kk=>$vv)
                                                                    <!-- 属性值被选中的状态 -->
                                                                        <!-- 如果规格下没有库存，虚线格式给li标签追加class值“no-stock” -->
                                                                        <li class="goods-spec-item @if(in_array($vv['attr_vid'], $sku['spec_vids'])) selected @endif"
                                                                            data-spec-id="{{ $v['attr_id'] }}" data-attr-id="{{ $vv['attr_vid'] }}" data-is-default="{{ $v['is_default'] }}" data-points-goods="0">
                                                                            <a href="javascript:void(0);" title="{{ $vv['attr_value'] }}">
                                                                                @if($v['is_default'] && !empty($vv['spec_image']))
                                                                                    <img src="{{ get_image_url($vv['spec_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" width="34" height="34" alt="">
                                                                                @endif
                                                                                <span class="value-label">{{ $vv['attr_value'] }}</span>
                                                                            </a>
                                                                            <i></i>
                                                                        </li>
                                                                    @endforeach

                                                                </ul>
                                                            </dd>
                                                        </dl>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @endif
                        <div class="buyBoxBtm">
                            <div class="buy_div">
                                <!--已选规格-->
                                @if($goods['have_specs']==1)
                                    <div class="already_select disf amount amount_num">
{{--                                        <div class="selectBtn">已选</div>--}}
                                        <div class="selectOptionName">
                                            @if(!empty($goods['spec_list']))
                                                @foreach($goods['spec_list'] as $k=>$v)
                                                    @if(isset($v['attr_name']))
                                                        <div class="disf paramDiv param{{$v['attr_id']}}">
                                                            <div class="select_param" title="{{$v['attr_name']}}">{{$v['attr_name']}}</div>
                                                            <div class="optionSel">
                                                                @foreach($v['attr_values'] as $kk=>$vv)
                                                                    @if(!empty($vv['children']))
                                                                        @foreach($vv['children'] as $k3=>$v3)
                                                                            <?php $now_attrIds = $vv['attr_vid'].'-'.$v3['attr_vid'];?>
                                                                            @if(in_array($now_attrIds, $sku['spec_vids']))
                                                                                <span title="{{ $vv['attr_value'] }}-{{ $v3['attr_value'] }}">{{ $vv['attr_value'] }}-{{ $v3['attr_value'] }}</span>
                                                                            @endif
                                                                        @endforeach
                                                                    @else
                                                                        @if(in_array($vv['attr_vid'], $sku['spec_vids']))
                                                                            <span title="{{ $vv['attr_value'] }}">{{ $vv['attr_value'] }}</span>
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                            @endif
                            <!--选购数量-->
                                <div class="select_buy">
                                    <div class="select_buy_headBox disf">
                                        <div class="selectBtn" style="margin-right:0;">数量</div>
                                        <dl class="amount amount_num">
                                            <dd class="dd">
                                            <span class="amount-widget">
                                                <input type="text" class="amount-input" value="1"
                                                       data-sales_model="{{ $goods['sales_model'] }}"
                                                       data-goods_id="{{ $goods['goods_id'] }}"
                                                       data-sku_id="{{ $sku['sku_id'] }}"
                                                       data-amount-min="1"
                                                       data-amount-max="{{ $sku['goods_number'] }}"
                                                       maxlength="8" title="请输入购买量">
                                                <span class="amount-btn">
                                                    <span class="amount-plus">
                                                        <i>+</i>
                                                    </span>
                                                    <span class="amount-minus">
                                                        <i>-</i>
                                                    </span>
                                                </span>
                                            </span>
                                            </dd>
                                        </dl>
                                    </div>
                                    <div class="select_buy_btmBox disf" style="justify-content: right;">
                                        @if($goods['goods_status']==1)
                                        <div class="btn_buy buy-goods-soon" style="margin-right:10px;">立即购买</div>
                                        <div class="btn_buy join_list" onclick="join_list()">加入选购</div>
                                        @endif
                                        <div class="btn_buy yixuan show_list" onclick="javascript:window.location.href='/cart.html';"><img src="/images/book.png" style="width:20px;height:20px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        //页面滚动，商品详情tabber和小的加入清单页
        window.addEventListener('scroll', function() {
            var scrollPosition = window.scrollY;
            // console.log(scrollPosition,$(window).height());
            if(IsPhone()){
                if (scrollPosition >= 1300) {
                    $('.detailContent .detailHead').css({'position':'fixed','top':'112px'});
                }else{
                    if(window.scrollY<1250){
                        $('.detailContent .detailHead').css({'position':'unset','top':'unset'});
                    }
                }
            }
            else{
                if (scrollPosition >= 700) {
                    $('.detailContent .detailHead').css({'position':'fixed','top':'100px'});
                }else{
                    if(window.scrollY<600){
                        $('.detailContent .detailHead').css({'position':'unset','top':'unset'});
                    }
                }

                if (scrollPosition >= 850) {
                    $('.detailContent .detailBtm .detailBtmRight .buyBox').css({'position':'fixed','top':'230px','max-width':'343px'});
                }else{
                    $('.detailContent .detailBtm .detailBtmRight .buyBox').css({'position':'unset','top':'unset'});
                }
            }
        });

        //切换产品详情底部tabber
        function change_detail_head(num,t){
            $(t).addClass('detailHeadTxtAct');
            $(t).siblings().removeClass('detailHeadTxtAct');

            //二级小分类
            $('.detailContent .detailHead .detailBtmBox').find('.detailBtmDiv').eq(num).addClass('detailBtmShow');
            $('.detailContent .detailHead .detailBtmBox').find('.detailBtmDiv').eq(num).removeClass('detailBtmHide');
            $('.detailContent .detailHead .detailBtmBox').find('.detailBtmDiv').eq(num).siblings().removeClass('detailBtmShow');
            $('.detailContent .detailHead .detailBtmBox').find('.detailBtmDiv').eq(num).siblings().addClass('detailBtmHide');

            //三级内容
            $('.detailBtmLeft').find('.detailBtmDiv').removeClass('detailBtmShow').addClass('detailBtmHide');
            $('.detailBtmLeft').find('.detailBtmDiv').eq(num).removeClass('detailBtmHide').addClass('detailBtmShow');
        }

        //跳转到指定滚动class的位置
        function location_to(classname){
            var position = $('.'+classname).offset().top;
            $('html, body').animate({scrollTop: position - 115}, 'slow');
        }

        layui.use(['layer','element','upload','form'],function() {
            var $ = layui.$
                , layer = layui.layer
                , element = layui.element
                , form = layui.form
                , upload = layui.upload;

            element.render('collapse');

            form.render(null,'component-form-element');
            form.render(null,'component-form-element3');
            form.render(null,'glist-element');

            //立即购买
            form.on('submit(glist-element2)', function(data){
                layer.load();
                //整理数组
                var buy_attr = []; // 存放结果的数组
                //服务数组
                var services_attr = [];
                for(let i=0;i<$('.servicesDiv').find('.servicesInput').length;i++){
                    if($('.servicesDiv').find('.servicesInput').eq(i).val()==1){
                        let service_id =  $('.servicesDiv').find('.servicesInput').eq(i).parent().attr('data-id');
                        if(service_id==1){
                            let photoRequest = '';
                            for(let i2=0;i2<$('.photoNumBox').find('.layui-textarea').length;i2++){
                                photoRequest += $('.photoNumBox').find('.layui-textarea').eq(i2).val() + '@@@';
                            }
                            services_attr.push({'service_id':service_id,'photonum':$('.photoNumBox').find('.photonum').val(),'photoRequest':photoRequest});
                        }else{
                            services_attr.push({'service_id':service_id});
                        }
                    }
                }

                if("{{$goods['have_specs']}}"==1){
                    //有规格

                    //整理商品信息
                    $('.attr_ids').each(function(index,element) {
                        var value = $(this).val();
                        var spec_id = $('.spec_ids').eq(index).val();
                        var attr_name = $('.attr_name').eq(index).val();
                        var buy_num = $('.buynum').eq(index).val();
                        var now_gprice = $('.now_gpriceinput').eq(index).val();
                        buy_attr.push({'attr_id':value,'spec_id':spec_id,'attr_name':attr_name,'buy_num':buy_num,'now_gprice':now_gprice});
                    });
                    // console.log(buy_attr,data.field);return false;
                }else if("{{$goods['have_specs']}}"==2){
                    //无规格
                    $('.buynum').each(function(index,element) {
                        var buy_num = $('.buynum').eq(index).val();
                        var now_gprice = $('.now_gpriceinput').eq(index).val();
                        buy_attr.push({'buy_num':buy_num,'now_gprice':now_gprice});
                    });
                }

                // if($('#select_addr').val()!=1){
                //     alert('请选择收货地址');
                //     layer.closeAll('loading');
                //     return false;
                // }
                // if($('#address_id').val()==''){
                //     alert('请选择收货地址');
                //     layer.closeAll('loading');
                //     return false;
                // }
                //'address_id':$('#address_id').val()
                @if($goods['shop_id']==0)
                    var data = {'buy_attr':buy_attr,'id':"{{$goods['goods_id']}}",'services_attr':services_attr};
                    $.ajax({
                        url: "/taozg_createorder",
                        method: 'post',
                        data: {'data':data,'_token':"{{csrf_token()}}"},
                        dataType: 'JSON',
                        success: function (res) {
                            layer.closeAll('loading');
                            layer.msg(res.msg,{time:2000}, function () {
                                if (res.code == 0) {
                                    //已生产订单后，跳转到账单中心（支付中心）
                                    // window.location.href="/bill_list";
                                    window.location.href="/pay_list?key="+res.data.ordersn;
                                }
                            });
                        }
                    });
                @else
                    //整理减免优惠信息
                    var prefe_reduction = [];
                    $('.prefe_reduction').each(function(index,element){
                        //判断有无选中
                        if($(this).is(':checked')==true){
                            prefe_reduction.push({'strict':$(this).attr('data-strict'),'type':$(this).attr('data-type'),'reduction_currency':$(this).attr('data-reduction_currency'),'reduction_price':$(this).attr('data-reduction_price')});
                        }
                    });

                    //整理随赠优惠信息
                    var prefe_gift = [];
                    $('.prefe_gift').each(function(index,element){
                        //判断有无选中
                        if($(this).is(':checked')==true){
                            if($(this).attr('data-type')==1){
                                //积分
                                prefe_gift.push({'strict':$(this).attr('data-strict'),'type':$(this).attr('data-type'),'operaer':$(this).attr('data-operaer'),'points_type':$(this).attr('data-points_type'),'points_currency':$(this).attr('data-points_currency'),'points_money':$(this).attr('data-points_money'),'points_send':$(this).attr('data-points_send')});
                            }else if($(this).attr('data-type')==2){
                                //卡券
                                prefe_gift.push({'strict':$(this).attr('data-strict'),'type':$(this).attr('data-type'),'operaer':$(this).attr('data-operaer'),'coupon_num':$(this).attr('data-coupon_num'),'coupon_currency':$(this).attr('data-coupon_currency'),'coupon_money':$(this).attr('data-coupon_money')});
                            }else if($(this).attr('data-type')==3){
                                //随赠
                                prefe_gift.push({'strict':$(this).attr('data-strict'),'type':$(this).attr('data-type'),'accgift_type':$(this).attr('data-accgift_type'),'accgift_content':$(this).attr('data-accgift_content'),'accgift_num':$(this).attr('data-accgift_num')});
                            }
                        }
                    });

                    //监管文件
                    var supervise_file = [];
                    for(let i=0;i<$('#supervise_file-upload-list').find('input').length;i++){
                        supervise_file.push({'file':$('#supervise_file-upload-list').find('input').eq(i).val()});
                    }
                    data.field['supervise_file'] = supervise_file;

                    $.ajax({
                        url: "/buy_goods",
                        method: 'post',
                        data: {'data': data.field,'prefe_reduction':prefe_reduction,'prefe_gift':prefe_gift,'buy_attr':buy_attr,'services_attr':services_attr,'address_id':$('#address_id').val(),'good_id':"{{$goods['goods_id']}}",'shop_id':"{{$goods['shop_id']}}",'isapply':0,'_token':"{{csrf_token()}}"},
                        dataType: 'JSON',
                        success: function (res) {
                            layer.closeAll('loading');
                            layer.msg(res.msg,{time:2000}, function () {
                                if (res.code == 0) {
                                    if(res.data.pay_method==1){
                                        layer.open({
                                            type: 1,
                                            title: '请打开微信扫码进入支付',
                                            area: ['300px', '300px'],
                                            content: '<div style="padding:20px;box-sizing: border-box;text-align:center;"><img src="'+res.data.code_url+'?v=<?php echo time();?>" style="width:150px;height:150px;"><p>请打开微信扫码进入支付</p></div>'
                                        });
                                    }
                                    // window.location.reload();
                                }
                            });
                        }
                    });
                @endif
                return false;
            });

            //立即加购
            form.on('submit(glist-element3)',function(data){
                // layer.load();
                //整理数组
                var buy_attr = []; // 存放结果的数组
                //服务数组
                var services_attr = [];
                for(let i=0;i<$('.servicesDiv').find('.servicesInput').length;i++){
                    if($('.servicesDiv').find('.servicesInput').eq(i).val()==1){
                        let service_type =  $('.servicesDiv').find('.servicesInput').eq(i).parent().attr('data-type');
                        let service_id =  $('.servicesDiv').find('.servicesInput').eq(i).parent().attr('data-id');
                        if(service_type==1){
                            let photoRequest = '';
                            for(let i2=0;i2<$('.photoNumBox').find('.layui-textarea').length;i2++){
                                photoRequest += $('.photoNumBox').find('.layui-textarea').eq(i2).val() + '@@@';
                            }
                            services_attr.push({'service_id':service_id,'photonum':$('.photoNumBox').find('.photonum').val(),'photoRequest':photoRequest});
                        }else{
                            services_attr.push({'service_id':service_id});
                        }
                    }
                }

                if("{{$goods['have_specs']}}"==1){
                    //有规格

                    //整理商品信息
                    $('.attr_ids').each(function(index,element) {
                        var value = $(this).val();
                        var spec_id = $('.spec_ids').eq(index).val();
                        var attr_name = $('.attr_name').eq(index).val();
                        var buy_num = $('.buynum').eq(index).val();
                        var now_gprice = $('.now_gpriceinput').eq(index).val();
                        buy_attr.push({'attr_id':value,'spec_id':spec_id,'attr_name':attr_name,'buy_num':buy_num,'now_gprice':now_gprice});
                    });
                    // console.log(buy_attr,data.field);return false;
                }
                else if("{{$goods['have_specs']}}"==2){
                    //无规格
                    $('.buynum').each(function(index,element) {
                        var buy_num = $('.buynum').eq(index).val();
                        var now_gprice = $('.now_gpriceinput').eq(index).val();
                        buy_attr.push({'buy_num':buy_num,'now_gprice':now_gprice});
                    });
                }

                var data = {'buy_attr':buy_attr,'id':"{{$goods['goods_id']}}",'services_attr':services_attr};
                $.ajax({
                    url: "/join_cart",
                    method: 'post',
                    data: {'data':data,'_token':"{{csrf_token()}}",'share_uid':"{{$share_uid}}",'campaign_id':"{{$campaign_id}}"},
                    dataType: 'JSON',
                    success: function (res) {
                        layer.closeAll('loading');
                        // layer.msg(res.msg,{time:2000}, function () {
                        if (res.code == 0) {
                            var area = ['260px', '150px'];
                            if(IsPhone()){
                                area = ['90%', '160px'];
                            }
                            layer_frame_div = open_frame('信息',res.msg,'/cart.html','查看选购','javascript:window.location.reload();','继续选购',1,area,1);

                            // layer.confirm(res.msg, {
                            //     btn: ['去选购中心','继续选购']
                            // }, function(){
                            //     //已加入购物车后，跳转到加购清单
                            //     window.location.href="/cart.html";
                            // }, function(){
                            //     window.location.reload();
                            // });
                        }else if(res.code == -1){
                            alert(res.msg);
                        }
                        // });
                    }
                });

                @if(1>2)
                    @if($goods['shop_id']==0 || $goods['drug_id']>0)
                        // if($('#select_addr').val()!=1){
                        //     alert('请选择收货地址');
                        //     layer.closeAll('loading');
                        //     return false;
                        // }
                        // if($('#address_id').val()==''){
                        //     alert('请选择收货地址');
                        //     layer.closeAll('loading');
                        //     return false;
                        // }
                        //'address_id':$('#address_id').val()
                        var data = {'buy_attr':buy_attr,'id':"{{$goods['goods_id']}}",'services_attr':services_attr};
                        $.ajax({
                            url: "/join_cart",
                            method: 'post',
                            data: {'data':data,'_token':"{{csrf_token()}}"},
                            dataType: 'JSON',
                            success: function (res) {
                                layer.closeAll('loading');
                                // layer.msg(res.msg,{time:2000}, function () {
                                    if (res.code == 0) {
                                        var area = ['260px', '150px'];
                                        if(IsPhone()){
                                            area = ['100%', '350px'];
                                        }
                                        layer_frame_div = open_frame('信息',res.msg,'/cart.html','查看选购','javascript:window.location.reload();','继续选购',1,area,1);

                                        // layer.confirm(res.msg, {
                                        //     btn: ['去选购中心','继续选购']
                                        // }, function(){
                                        //     //已加入购物车后，跳转到加购清单
                                        //     window.location.href="/cart.html";
                                        // }, function(){
                                        //     window.location.reload();
                                        // });
                                    }else if(res.code == -1){
                                        alert(res.msg);
                                    }
                                // });
                            }
                        });
                    @else
                        //整理减免优惠信息
                        var prefe_reduction = [];
                        $('.prefe_reduction').each(function(index,element){
                            //判断有无选中
                            if($(this).is(':checked')==true){
                                prefe_reduction.push({'strict':$(this).attr('data-strict'),'type':$(this).attr('data-type'),'reduction_currency':$(this).attr('data-reduction_currency'),'reduction_price':$(this).attr('data-reduction_price')});
                            }
                        });

                        //整理随赠优惠信息
                        var prefe_gift = [];
                        $('.prefe_gift').each(function(index,element){
                            //判断有无选中
                            if($(this).is(':checked')==true){
                                if($(this).attr('data-type')==1){
                                    //积分
                                    prefe_gift.push({'strict':$(this).attr('data-strict'),'type':$(this).attr('data-type'),'operaer':$(this).attr('data-operaer'),'points_type':$(this).attr('data-points_type'),'points_currency':$(this).attr('data-points_currency'),'points_money':$(this).attr('data-points_money'),'points_send':$(this).attr('data-points_send')});
                                }else if($(this).attr('data-type')==2){
                                    //卡券
                                    prefe_gift.push({'strict':$(this).attr('data-strict'),'type':$(this).attr('data-type'),'operaer':$(this).attr('data-operaer'),'coupon_num':$(this).attr('data-coupon_num'),'coupon_currency':$(this).attr('data-coupon_currency'),'coupon_money':$(this).attr('data-coupon_money')});
                                }else if($(this).attr('data-type')==3){
                                    //随赠
                                    prefe_gift.push({'strict':$(this).attr('data-strict'),'type':$(this).attr('data-type'),'accgift_type':$(this).attr('data-accgift_type'),'accgift_content':$(this).attr('data-accgift_content'),'accgift_num':$(this).attr('data-accgift_num')});
                                }
                            }
                        });

                        //监管文件
                        var supervise_file = [];
                        for(let i=0;i<$('#supervise_file-upload-list').find('input').length;i++){
                            supervise_file.push({'file':$('#supervise_file-upload-list').find('input').eq(i).val()});
                        }
                        data.field['supervise_file'] = supervise_file;

                        data.field['buy_attr'] = buy_attr;
                        data.field['services_attr'] = services_attr;
                        data.field['id'] = "{{$goods['goods_id']}}";

                        $.ajax({
                            url: "/join_cart",
                            method: 'post',
                            data: {'data': data.field,'prefe_reduction':prefe_reduction,'prefe_gift':prefe_gift,'isapply':0,'_token':"{{csrf_token()}}"},
                            dataType: 'JSON',
                            success: function (res) {
                                layer.closeAll('loading');
                                if (res.code == 0) {
                                    var area = ['260px', '150px'];
                                    if(IsPhone()){
                                        area = ['100%', '350px'];
                                    }
                                    layer_frame_div = open_frame('信息',res.msg,'/cart.html','查看选购','javascript:window.location.reload();','继续选购',1,area,1);

                                    // layer.confirm(res.msg, {
                                    //     btn: ['查看选购','继续选购']
                                    // }, function(){
                                    //     //已加入购物车后，跳转到加购清单
                                    //     window.location.href="/cart.html";
                                    // }, function(){
                                    //     window.location.reload();
                                    // });
                                }else if(res.code == -1){
                                    alert(res.msg);
                                }
                            }
                        });
                    @endif
                @endif
                return false;
            });

            //在线申请
            form.on('submit(apply-element)',function(data){
                layer.load();
                //整理数组
                var buy_attr = []; // 存放结果的数组
                if("{{$goods['have_specs']}}"==1){
                    //有规格

                    //整理商品信息
                    $('.attr_ids').each(function(index,element) {
                        var value = $(this).val();
                        var spec_id = $('.spec_ids').eq(index).val();
                        var attr_name = $('.attr_name').eq(index).val();
                        var buy_num = $('.buynum').eq(index).val();
                        var now_gprice = $('.now_gpriceinput').eq(index).val();
                        buy_attr.push({'attr_id':value,'spec_id':spec_id,'attr_name':attr_name,'buy_num':buy_num,'now_gprice':now_gprice});
                    });
                    // console.log(buy_attr,data.field);return false;
                }else if("{{$goods['have_specs']}}"==2){
                    //无规格
                    $('.buynum').each(function(index,element) {
                        var buy_num = $('.buynum').eq(index).val();
                        var now_gprice = $('.now_gpriceinput').eq(index).val();
                        buy_attr.push({'buy_num':buy_num,'now_gprice':now_gprice});
                    });
                }

                //整理减免优惠信息
                var prefe_reduction = [];
                $('.prefe_reduction').each(function(index,element){
                    //判断有无选中
                    if($(this).is(':checked')==true){
                        prefe_reduction.push({'strict':$(this).attr('data-strict'),'type':$(this).attr('data-type'),'reduction_currency':$(this).attr('data-reduction_currency'),'reduction_price':$(this).attr('data-reduction_price')});
                    }
                });

                //整理随赠优惠信息
                var prefe_gift = [];
                $('.prefe_gift').each(function(index,element){
                    //判断有无选中
                    if($(this).is(':checked')==true){
                        if($(this).attr('data-type')==1){
                            //积分
                            prefe_gift.push({'strict':$(this).attr('data-strict'),'type':$(this).attr('data-type'),'operaer':$(this).attr('data-operaer'),'points_type':$(this).attr('data-points_type'),'points_currency':$(this).attr('data-points_currency'),'points_money':$(this).attr('data-points_money'),'points_send':$(this).attr('data-points_send')});
                        }else if($(this).attr('data-type')==2){
                            //卡券
                            prefe_gift.push({'strict':$(this).attr('data-strict'),'type':$(this).attr('data-type'),'operaer':$(this).attr('data-operaer'),'coupon_num':$(this).attr('data-coupon_num'),'coupon_currency':$(this).attr('data-coupon_currency'),'coupon_money':$(this).attr('data-coupon_money')});
                        }else if($(this).attr('data-type')==3){
                            //随赠
                            prefe_gift.push({'strict':$(this).attr('data-strict'),'type':$(this).attr('data-type'),'accgift_type':$(this).attr('data-accgift_type'),'accgift_content':$(this).attr('data-accgift_content'),'accgift_num':$(this).attr('data-accgift_num')});
                        }
                    }
                });

                $.ajax({
                    url: "/buy_goods",
                    method: 'post',
                    data: {'data': data.field,'prefe_reduction':prefe_reduction,'prefe_gift':prefe_gift,'buy_attr':buy_attr,'good_id':"{{$goods['goods_id']}}",'shop_id':"{{$goods['shop_id']}}",'isapply':1,'_token':"{{csrf_token()}}"},
                    dataType: 'JSON',
                    success: function (res) {
                        layer.closeAll('loading');
                        layer.msg(res.msg,{time:2000}, function () {
                            if (res.code == 0) {
                                @if($goods['shop_id']>0 && isset($goods['platform_valueInfo']))
                                    window.location.href="{{$goods['platform_valueInfo']['apply_link']}}?oid="+res.data.order_id;
                                @endif
                            }
                        });
                    }
                });
                return false;
            });

            upload.render({
                elem: '#supervise_file-upload'
                ,url: '/upload_file'
                ,accept: 'file'
                ,data: { folder: 'shopping', type: 'supervise','_token':"{{csrf_token()}}"}
                ,multiple: false
                ,number:9
                ,before: function(obj){
                    // layer.load(); //上传loading
                }
                ,done: function(res){
                    // layer.closeAll('loading'); //关闭loading
                    if(res.code == 1)
                    {
                        $('#supervise_file-upload-list').append('<div style="display: inline-block;"><img onclick="seePic(this);" src="https://shop.gogo198.cn/'+ res.file_path +'" class="layui-upload-img" style="width:80px;height:80px;"><button type="button" onclick="delPic(this);" class="layui-btn layui-btn-xs layui-btn-danger" style="position: relative;left: -45px;top: -39px;">删除</button><input type="text" name="supervise_file[]" value="'+res.file_path+'" style="display: none;"></div>');
                        form.render(null,'glist-element');
                    }
                }
            });

            //获取国家、邮编、地区
            let nowElement='';
            let vaguaSearch=0;
            form.on('select(country)',function(data){
                let val = data.value;
                layer.load();
                //获取区号+邮编+一级行政区域
                $.getJSON('/getphonenum',{'id':val,'pa':1,'_token':"{{csrf_token()}}"},function(res2){
                    layer.closeAll('loading');
                    $('#area_mobile').val(res2.phone);

                    //邮编
                    // var regNumber = /\d+/;
                    // var regString = /[a-zA-Z]+/;
                    // let html = '';
                    // let html2 = '';
                    // for(let i=0;i<res2.post.length;i++){
                    //     if(regNumber.test(res2.post[i]) || regString.test(res2.post[i])) {
                    //         html += '<div class="postal_temp">'+res2.post[i]+'</div>';
                    //         html2 += '<input type="text" name="postal_code[]" lay-verify="required" placeholder="" autocomplete="off" class="layui-input postal_code" value="" style="width:50px;" maxlength="1">';
                    //     }else{
                    //         html += '<div class="postal_temp" style="font-size:18px;font-weight:800;">'+res2.post[i]+'</div>';
                    //         html2 += '<input type="text" name="postal_code[]" lay-verify="" placeholder="" autocomplete="off" class="layui-input postal_code" value="'+res2.post[i]+'" style="width:50px;" maxlength="1">';
                    //     }
                    // }
                    // $('.postal_rule').html(html);
                    // $('.postal_rule2').html(html2);
                    // $('.postal_div').show();

                    //省
                    // let html3 = '<select name="province" lay-search lay-filter="province">'+
                    //             ' <option value="">请选择</option>'+
                    //             ' <option value="自定义">自定义</option>';
                    // for(let i=0;i<res2.province.length;i++){
                    //     html3 += '<option value="'+res2.province[i].id+'">'+res2.province[i].code_name+'</option>';
                    // }
                    // html3 += '</select>';
                    // $('.sort_div').find('.province').html(html3);

                    //邮政编码
                    let html4 = '<select name="postal" lay-search lay-filter="postal">\n'+
                                '    <option value="">请选择</option>\n'+
                                '    <option value="自定义">自定义</option>\n';
                    for(let i=0;i<res2.postal.length;i++){
                        html4 += '<option value="'+res2.postal[i].id+'">'+res2.postal[i].code_name+'</option>';
                    }
                    html4 += '</select>';
                    $('.sort_div').find('.postal_sel').html(html4);

                    //输入当前input后自动聚焦下一个
                    // $('.postal_code').on('input',function(){
                    //     if ($(this).val().length === parseInt($(this).attr('maxlength'))) {
                    //         $(this).next('.postal_code').focus();
                    //     }
                    // });
                    form.render(null,'address-element');
                });
            });
            form.on('select(postal)',function(data) {
                let val = data.value;

                layer.load();
                if(val=='自定义'){
                    $('.sort_div').find('.diycountry').show();
                    // $('.sort_div').find('.province,.city,.area,.area2,area3,area4').hide();
                    $('.alread_select_areas').remove();
                }else if(val!=''){
                    $.getJSON('/getphonenum',{'id':val,'pa':3,'_token':"{{csrf_token()}}"},function(res2){
                        let html = '';

                        for(let i=0;i<res2.areas.length;i++){
                            html += '<input class="layui-input countryDiv countryBox alread_select_areas" name="diycountry[]" placeholder="行政区域" value="'+res2.areas[i]+'" style="" readonly>';
                        }
                        $('.postal_sel').after(html);
                        // $('.sort_div').find('.province').html(html);
                        // $('.sort_div').find('.city').html(html);
                        // $('.sort_div').find('.area').html(html);
                        form.render(null,'address-element');
                    });
                }
                layer.closeAll('loading');
            });

            //地址提交
            form.on('submit(address-element2)',function(data){
                layer.load();
                $.ajax({
                    url: "/save_address",
                    method: 'post',
                    data: data.field,
                    dataType: 'JSON',
                    success: function (res) {
                        layer.closeAll('loading');
                        layer.msg(res.msg,{time:2000}, function () {
                            if (res.code == 0) {
                                window.location.reload();
                            }
                        });
                    }
                });
                return false;
            });

            @if($goods['shop_id']>0 && empty($goods['drug_id']) && 1>2)
                document.getElementById("sale_navDiv").addEventListener("click", function(event) {
                    event.preventDefault(); // 阻止默认的链接行为
                    scro("sale_div");
                });
                document.getElementById("logi_navDiv").addEventListener("click", function(event) {
                    event.preventDefault(); // 阻止默认的链接行为
                    scro("logi_div");
                });
                document.getElementById("price_navDiv").addEventListener("click", function(event) {
                    event.preventDefault(); // 阻止默认的链接行为
                    scro("price_div");
                });
                document.getElementById("cross_navDiv").addEventListener("click", function(event) {
                    event.preventDefault(); // 阻止默认的链接行为
                    scro("cross_div");
                });
                document.getElementById("transport_navDiv").addEventListener("click", function(event) {
                    event.preventDefault(); // 阻止默认的链接行为
                    scro("transport_div");
                });
                document.getElementById("platform_navDiv").addEventListener("click", function(event) {
                    event.preventDefault(); // 阻止默认的链接行为
                    scro("platform_div");
                });
                document.getElementById("transaction_navDiv").addEventListener("click", function(event) {
                    event.preventDefault(); // 阻止默认的链接行为
                    scro("transaction_div");
                });
                document.getElementById("baozhang_navDiv").addEventListener("click", function(event) {
                    event.preventDefault(); // 阻止默认的链接行为
                    scro("baozhang_div");
                });
                document.getElementById("content_navDiv").addEventListener("click", function(event) {
                    event.preventDefault(); // 阻止默认的链接行为
                    scro("content_div");
                });
            @endif
            //商品信息滚动-end
        });

        //规格切换
        function selAttr(attr_id,t){
            var layer = layui.layer,$ = layui.$;

            $(t).addClass('optionSeleted');
            $(t).siblings().removeClass('optionSeleted');

            $('.optionBody').find('.attr'+attr_id).addClass('attr_show');
            $('.optionBody').find('.attr'+attr_id).removeClass('attr_hide');
            $('.optionBody').find('.attr'+attr_id).siblings().removeClass('attr_show');
            $('.optionBody').find('.attr'+attr_id).siblings().addClass('attr_hide');
        }

        //货币转换
        function exchangeBtn(price=0){
            var layer = layui.layer,$ = layui.$;

            var area = ['600px', '500px'];
            if(IsPhone()){
                area = ['100%', '350px'];
            }
            // window.open("/rate_detail?id=1&isframe=1&price="+price);
            layer.open({
                skin:'layer_frame',
                type:2,
                title:'<div class="disf"><div class="exclamation-circle"><span>!</span></div>货币转换</div>',
                area:area,
                content:'/rate_detail?id=1&isframe=1&price='+price
            });
        }

        function view_reply(id,t){
            var layer = layui.layer,$ = layui.$;

            var text = '';
            $.getJSON("/get_reply",{'id':id},function(res){
                if(res.data==null){
                    layer.msg('暂无回复');
                }else{
                    text = res.data.content;
                    // $(t).parent().find('.reply_content').text();
                    setTimeout(function(){
                        layer.open({
                            type:1,
                            title:'查看回复',
                            area:['600px','500px'],
                            content:'<div class="reply_content" style="padding:10px;box-sizing:border-box;">'+text+'</div>'
                        });
                        // $(t).parent().find('.reply_content').show();
                    },1000);
                }
            });
        }

        function scro(elem){
            var targetElement = document.getElementById(elem); // 获取目标元素
            targetElement.scrollIntoView({ behavior: "smooth" }); // 平滑滚动到目标元素位置
        }

        function delPic(obj)
        {
            var layer = layui.layer,$ = layui.$;
            layer.confirm('确认要删除该附件？', {
                btn: ['删除','取消']
            }, function(){
                $(obj).parent().remove();
                layer.closeAll();
            }, function(){

            });
        }

        function seePic(thi){
            var layer = layui.layer
                ,$ = layui.jquery;

            layer.open({
                type:1,
                title:'查看图片',
                area:['100%','100%'],
                content:'<img src="'+$(thi).attr('data-img')+'" class="layui-upload-img" onerror=src="https://shop.gogo198.cn/attachment/images/default_file.png" style="width:100%;height:100%;">'
            });
        }

        function IsPhone() {
            var info = navigator.userAgent;
            var isPhone = /Mobi|Android|iPhone/i.test(info);
            return isPhone;
        }

        function show_login(){
            var $ = layui.$
                , layer = layui.layer;
            layer.load();
            setTimeout(function(){
                // $.login.show();
                window.location.href='{!! $origin_page !!}';
            },1500);
        }

        function add_addr(){
            var $ = layui.$
                , layer = layui.layer;
            if("{{session('user.user_id')}}" != ''){
                let area = ['800px','500px'];
                if(IsPhone()){
                    area = ['100%','100%'];
                }

                layer.open({
                    type: 1,
                    title:'添加地址',
                    area: area,
                    content: $('.address_div')
                });
            }else{
                show_login();
            }
        }

        function add_address(){
            var $ = layui.$
                , layer = layui.layer
                , form = layui.form;
            let address_num = $('#address_num').val();
            address_num = parseInt(address_num) + 1;
            var html = '<div class="layui-form-item">\n' +
            '                    <div class="layui-form-label">详细地址'+address_num+'</div>\n' +
            '                    <div class="layui-input-block disf">\n' +
            '                        <input type="text" class="layui-input" lay-verify="required" name="address2[]" value="" placeholder="请输入地址">\n' +
            '                        <div class="layui-btn layui-btn-success add" onclick="add_address()">+</div>\n';
            if(address_num<=3){
                html += '             <div class="layui-btn layui-btn-danger del" onclick="del_address(this)">-</div>\n';
            }
            else if(address_num>3){
                layer.msg('只能添加3个地址');
                return false;
            }
            html += '            </div>\n' +
                '          </div>';
            $('#address_num').val(address_num);

            $('.addr').append(html);
            form.render(null, 'component-form-group');
        }

        function del_address(t){
            var $ = layui.$
                , layer = layui.layer
                , form = layui.form;
            let adr_idx = layer.confirm('确认要删除该地址吗？',function(index){
                let address_num = $('#address_num').val();
                address_num = parseInt(address_num) - 1;
                $('#address_num').val(address_num);
                $(t).parent().parent().remove();
                form.render(null, 'component-form-group');
                layer.close(adr_idx);
            });
        }

        function is_default(t){
            var $ = layui.$
                , layer = layui.layer
                , form = layui.form;

            if($(t).val()==1){
                $(t).val("0");
            }else{
                $(t).val("1");
            }
        }

        function add_diycountry(t){
            var $ = layui.$
                , layer = layui.layer
                , form = layui.form;

            let html = '<input class="layui-input countryDiv countryBox" name="diycountry[]" placeholder="行政区域" style="">';
            $(t).before(html);
        }

        function select_addrr(t){
            var $ = layui.$
                , form = layui.form
                , layer = layui.layer;

            if("{{session('user.user_id')}}" != ''){
                let val = $(t).val();
                if(val==1){
                    $('.country-select').show();
                }else if(val==2){
                    $('.country-select').hide();
                    add_addr();
                }else if(val==''){
                    $('.country-select').hide();
                }
            }else{
                show_login();
            }
        }

        //跳转到运费估算
        function freight_calc(t){
            var $ = layui.$,layer = layui.layer;
            let goodsName = $('.goodsName').text();
            let country = $('#selectCountry').val();
            let postal = $('#selectPostal').val();
            // console.log(goodsName,country,postal);
            if(country=='' || postal == ''){
                layer.msg('请选择国家和邮编');
                return false;
            }else{
                let url = '//gather.gogo198.cn/?s=gather/freight_estimation&country='+country+'&postal='+postal;
                window.open(url, '_blank');
            }
        }

        //交易流程-start
        function switch_process(key,t){
            $(t).parents(":eq(1)").find('.switch_process_' + key).addClass('hover');
            $(t).parents(":eq(1)").find('.switch_process_' + key).siblings().removeClass('hover');
            $(t).parents(":eq(1)").find('.process_num_' + key).siblings().hide();
            $(t).parents(":eq(1)").find('.process_num_' + key).show();
            if(IsPhone()){
                //手机版滑动
                if(key==2){
                    $(t).parents(":eq(1)").find('.control_process').animate({ scrollLeft: 0 }, 500);
                }
                else if(key==3){
                    $(t).parents(":eq(1)").find('.control_process').animate({ scrollLeft: 130 }, 500);
                }else if(key==4){
                    $(t).parents(":eq(1)").find('.control_process').animate({ scrollLeft: 250 }, 500);
                }
            }
        }
        //交易流程-end
    </script>

    <!-- 头部右侧鼠标经过图片放大效果 _start -->
    <script type="text/javascript" src="/js/bubbleup.js"></script>
    <!-- 头部右侧鼠标经过图片放大效果 _end -->
    <!-- 套餐、店内排行等左右切换效果 _start-->
    <script type="text/javascript" src="/js/tabs.js"></script>
    <!-- 套餐、店内排行等左右切换效果 _end -->
    <!-- 右侧商品信息等定位切换效果 _start -->
{{--    <script type="text/javascript" src="/js/tabs_totop.js"></script>--}}
    <!-- 右侧商品信息等定位切换效果 _end -->
    <!-- 控制图片经过放大 -->
    <script type="text/javascript" src="/js/goods.js"></script>
    <!-- 地址选择 _start -->
    <script type="text/javascript" src="/js/select_region.js"></script>
    <!-- 地址选择 _end -->
    @if(!empty($user_info))
        <!-- 分享 -->
        <script type="text/javascript">
            var url =  location.href;
            {{--if (url.indexOf("user_id=") == -1 && window.history && history.pushState){--}}
            {{--    if(url.indexOf("?") == -1){--}}
            {{--        url += "?user_id=" + "{{ $user_info['user_id'] }}";--}}
            {{--    }else{--}}
            {{--        url += "&user_id=" + "{{ $user_info['user_id'] }}";--}}
            {{--    }--}}
            {{--    history.replaceState(null, document.title, url);--}}
            {{--}--}}
        </script>
    @endif

    <!-- 获取当前地址 -->
    <script type="text/javascript">
        var deferred = $.Deferred();

        var local_region_code = "{{ $region_code }}";

        $().ready(function() {

            //
            if (local_region_code && local_region_code.length > 0) {
                changeLocation(local_region_code);
            }
            //

            // 添加收藏
            $(".collect-goods").click(function(event) {
                var target = $(this);
                var goods_id = $(this).data("goods-id");

                var sku_id = getSkuId();

                $.collect.toggleGoods(goods_id, sku_id, function(result) {
                    if (result.code != 0) {
                        return;
                    }

                    var desc = "";

                    //
                    if(result.collect_count > 0){
                        desc = "(" + result.collect_count + "人气)";
                    }
                    //
                    if (result.data == 1) {
                        $(target).addClass("curr");
                        $(target).find('i').html('&#xe6b1;');
                        $(target).find("span").html("取消收藏" + desc);
                    } else {
                        $(target).removeClass("curr");
                        $(target).find('i').html('&#xe6b3;');
                        $(target).find("span").html("收藏商品" + desc);
                    }
                }, true);
            });
            // 添加收藏
            $(".collect-shop").click(function(event) {
                var target = $(this);
                var shop_id = "1";
                $.collect.toggleShop(shop_id, function(result) {
                    if (result.data == 1) {
                        $(target).find("span").html("取消关注");
                        $(target).find('i').html('&#xe6b1;');
                    } else {
                        $(target).find("span").html("关注本店");
                        $(target).find('i').html('&#xe6b3;');
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        function get_miniprogram(){
            var $ = layui.$
                , form = layui.form
                , layer = layui.layer;
           
            $.getJSON('/get_miniprogram',{'goods_id':"{{$goods['goods_id']}}",'_token':"{{csrf_token()}}"},function(res){
                layer.closeAll('loading');
                layer.msg(res.msg,{time:2000}, function () {
                    if (res.code == 0) {
                        layer.open({
                            type: 1,
                            title: '推广图片',
                            area: ['300px', '300px'],
                            content: '<div style="padding:20px;box-sizing: border-box;text-align:center;"><img src="'+res.img+'?v=<?php echo time();?>" style="width:150px;height:200px;"><p style="margin-top:5px;font-size:15px;font-weight:600;">长按保存推广图片</p></div>'
                        });
                    }
                });
            });
        }
        
        $().ready(function() {
            @if($goods['shop_id']>1000000)
                var desc_container = $(".goods-detail-content");
                var evaluate_container = $("#goods_evaluate");

                function load() {

                    // 加载商品详情
                    if (!$("body").data("loading-goods-desc")) {
                        // 计算高度
                        if ($(document).scrollTop() >= $(desc_container).offset().top - $(window).height()) {
                            $("body").data("loading-goods-desc", true);
                            $.get("/goods/desc.html", {
                                sku_id: "{{ $goods['sku_id'] }}",
                                is_lib_goods: ""
                            }, function(result) {
                                $(desc_container).html(result.pc_desc);
                            }, "json");
                        }
                    }
                    // 评论
                    if (!$("body").data("loading-goods-comment") && $(evaluate_container).size() > 0) {
                        // 计算高度
                        if ($(document).scrollTop() >= $(evaluate_container).offset().top - $(window).height()) {
                            $("body").data("loading-goods-comment", true);
                            $.get('/goods/comment.html', {
                                sku_id: "{{ $goods['goods_id'] }}",
                                output: 1
                            }, function(result) {
                                if (result.code == 0) {
                                    $(evaluate_container).html(result.data);
                                    // $(evaluate_container).html('');
                                }
                            }, "json");
                        }
                    }
                }

                // load();

                // 加载商品详情和评论
                // $(window).scroll(function() {
                //     load();
                // });
            @endif
        });

        // 初始化变量
        let startTime = document.visibilityState === 'visible' ? Date.now() : null;
        let totalTime = 0;

        // 处理页面可见性变化
        document.addEventListener('visibilitychange', () => {
            if (document.visibilityState === 'hidden') {
                // 页面隐藏：累加时间并暂停计时
                if (startTime !== null) {
                    totalTime += Date.now() - startTime;
                    startTime = null;
                }
            } else {
                // 页面可见：重新开始计时
                startTime = Date.now();
            }
        });

        // 用户离开时发送数据
        window.addEventListener('beforeunload', () => {
            // 累加最后一段可见时间
            if (startTime !== null) {
                totalTime += Date.now() - startTime;
            }

            // 转换为秒并发送
            const seconds = Math.round(totalTime / 1000);
            const data = JSON.stringify({ seconds:seconds,goods_id:"{{$goods['goods_id']}}",type:1 });

            // 使用可靠的数据发送方法
            // navigator.sendBeacon('/user_record', data);
            $.post('/user_record',{seconds:seconds,goods_id:"{{$goods['goods_id']}}",type:1},function(data){

            });
        });

        // 可选：处理页面刷新/导航
        {{--window.addEventListener('pagehide', () => {--}}
        {{--    // 累加最后一段可见时间--}}
        {{--    if (startTime !== null) {--}}
        {{--        totalTime += Date.now() - startTime;--}}
        {{--    }--}}

        {{--    // 转换为秒并发送--}}
        {{--    const seconds = Math.round(totalTime / 1000);--}}
        {{--    const data = JSON.stringify({ seconds:seconds,goods_id:"{{$goods['goods_id']}}",type:1 });--}}

        {{--    // 使用可靠的数据发送方法--}}
        {{--    // navigator.sendBeacon('/user_record', data);--}}
        {{--    $.post('/user_record',{seconds:seconds,goods_id:"{{$goods['goods_id']}}",type:1},function(data){--}}

        {{--    });--}}
        {{--});--}}

        // 使用 onbeforeunload 事件检测退出
        {{--window.onbeforeunload = function () {--}}
        {{--    const endTime = Date.now();--}}
        {{--    const seconds = Math.floor((endTime - startTime) / 1000);--}}
        {{--    console.log(`用户浏览时长为：${seconds} 秒`);--}}

        {{--    // 发送数据到服务器（示例 URL，需替换为实际接口）--}}
        {{--    $.post('/user_record',{seconds:seconds,goods_id:"{{$goods['goods_id']}}",type:1},function(data){--}}

        {{--    });--}}
        {{--};--}}
    </script>

    @include('layouts.right_slide_show')
    @include('layouts.common_function')
@stop

