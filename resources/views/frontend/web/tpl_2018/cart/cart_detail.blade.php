@include('layouts.header')
<link rel="stylesheet" href="/assets/d2eace91/iconfont/iconfont.css?v=1.1"/>
<link rel="stylesheet" href="/css/common.css?v=1.1"/>
<link rel="stylesheet" href="/assets/d2eace91/layui/css/layui.css?v=23121"/>
<link rel="stylesheet" href="/assets/d2eace91/js/layer/theme/default/layer.css?v=3.1.0" id="layuicss-layer">
@section('header_css')
    <link rel="stylesheet" href="/css/flow.css?v=20180702"/>
@stop

<style>
    *{line-height: 24px;}
    .chosen-container-single .chosen-search input[type="text"]{color:#000;}
    body{background:{{$website['background']}} !important;}
    .disf{display:flex;align-items:center;}

    .now_price,.origin_price{font-size: 15px;font-weight: 800;color:#db1d18;}
    .layui-tab-title li{color:#000;font-weight:800;}
    .layui-table thead tr{background:{{$website['color']}};color:{{$website['color_word']}};}
    /**搜索栏**/
    .searchBox{width: 40%;}
    .searchBox .searchLogo{text-align: center;margin-bottom:20px;}
    .searchBox .searchLogo img{width:360px;}
    .searchBox .searchContent{border-radius: 40px;background: #fff;height: 38px;border:2px solid {{$website['color_word']}};width: 100%;}
    .searchBox .selectBox select{border:0;background: none;font-size: 22px;text-align: center;}
    .searchBox .inputBox{height: 100%;width: 100%;box-shadow: 0px 0px 2px 1px #fff;border-radius: 40px;}
    .searchBox .inputBox .nameBox {padding:0px 0px 0px 20px;position: relative;width: 100%;overflow: hidden;display:flex;align-items: center;}
    .searchBox .inputBox .nameBox input{border:0;width:100%;padding-right:5px;text-align: right;font-weight: 800;}
    .searchBox .inputBox .btnBox{width:60px;height:100%;background:{{$website['color_word']}};display: flex;align-items: center;justify-content: center;border-top-right-radius: 40px;border-bottom-right-radius: 40px;padding:5px 0 0 5px;cursor: pointer;}
    .searchBox .inputBox .btnBox img{width:45px;}
    .searchBox .leftCont1{font-size: 32px;color: #fff;font-weight: 600;margin-bottom: 20px;text-align: center;text-shadow: -1px 0 4px #0e2e68, 0 1px 4px #0e2e68, 1px 0 #0e2e68, 0 -1px #0e2e68;}
    .searchBox form{margin-bottom:0;}

    #translate{display: none;}
    footer{display:block !important;}

    .cart-content{min-height:600px;}
    .cart-empty{width:100%;}
    .cart-empty .message{text-align: center;padding-top: 15%;}
    .cart-empty .message img{width:180px;}
    .cart-empty .message .txt{font-size:20px;font-weight: 600;margin-top:15px;}
    .cart-empty .message .btn-link{font-size:18px;font-weight: 600;background:{{$website['color']}};color:#fff;border-radius:15px;padding:5px 20px;box-sizing: border-box;}

    @if($isframe==1)
    /*内置框打开*/
    .header,.footer{display: none;}
    .w1200{width: 100%;}
    @endif


    #content{padding-top:100px;}
    a {-webkit-text-decoration-skip: objects;background-color: transparent;}
    *,:after,:before {-webkit-box-sizing: border-box;box-sizing: border-box}
    ol,ul {list-style: none;margin: 0;padding: 0}
    li {margin-left: 0}
    hr {border: solid #e5e5e5;border-width: 1px 0 0}
    a {text-decoration: none}
    .ctf-lib-address-picker-popup li,.ctf-lib-address-picker-popup ol,.ctf-lib-address-picker-popup ul {list-style: none;margin: 0;padding: 0}
    .ctf-lib-shipping-address-list .ok-cancel-btn-group .next-btn+.next-btn {margin-left: 8px}
    .cart-tab--container--Mp2ibji {padding: 12px 0;position: relative;}
    .header-bar--container--XmK_Sks {padding: 12px 0}
    .header-bar--table--qVDj5tO {border-collapse: collapse;border-spacing: 0;table-layout: fixed;width: 100%}
    .header-bar--table--qVDj5tO th {color: #000;font-size: 15px;font-weight: 800;}
    .header-bar--colCheckbox--pDopfHb {text-align: left;width: 114px}
    .header-bar--colGoods--Sk6Gd9f {text-align: left}
    .header-bar--colQuantity--bw3tRQ5 {text-align: center;width: 216px}
    .header-bar--colPublishPrice--cXZm1e1 {text-align: center;width: 160px}
    .header-bar--colSubtotal--EVTzgzQ {text-align: right;width: 150px}
    .shop-container--container--_pNFLjq {background: #fff;border-radius: 4px;margin-bottom: 16px;padding: 0 20px}
    .shop-container--container--_pNFLjq:first-of-type {border-top-left-radius: 0;border-top-right-radius: 0}
    .shop-top--container--GWvjt50 {background-color: #fff;padding: 12px 0;position: relative}
    .shop-top--companyWrapper--Nng6NUE>* {vertical-align: middle}
    .shop-top--marketingWrapper--RU32iwK .shop-top--marketingItem--ZwQxh06>* {display: inline-block;vertical-align: middle;}
    .item-group-container--container--fFsBi_O {margin: 0 -20px;padding: 0 20px;position: relative;}
    .item-group-container--container--fFsBi_O:not(:last-child) {border-bottom: 1px solid {{$website['color']}};margin-bottom: 16px;}
    .item-group-container--container--fFsBi_O .item-group-container--table--ESEGhi1 {border-collapse: collapse;border-spacing: 0;width: 100%}
    .item-group--container--Eu9kRqK {border-bottom: 16px solid #fff}
    .item-group--container--Eu9kRqK .item-group--title--F09mZrH {color: #000;font-size: 15px;vertical-align: middle;margin-left:0px;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;margin: 0 10px;}
    .item-group--container--Eu9kRqK .item-group--title--F09mZrH:hover {color: #e60000;}
    .ctf-lib-multiple-sku-chooser .chooser-footer .next-btn+.next-btn {margin-left: 16px}
    .item--colQuantity--X6jdFO1 {text-align: center;width: 216px;font-size:15px;color:#000; }
    .item--colPublishPrice--_Gft88l {text-align: center;width: 160px;font-size:15px;color:#db1d18;font-weight: 500;}
    .item--colSubtotal--wD06b01 {text-align: right;width: 150px}
    .item--title--eq76Cm2 {background: #f9f9f9;border-radius: 4px;color: #666;display: inline-block;line-height: 16px;margin-left: 12px;min-height: 30px;padding: 7px 9px;vertical-align: middle;width: calc(100% - 70px)}
    .cart--container--RtFTPfu {margin: 0px auto;width: 1200px}
    .cart--header--ow5WRyV {background: #f7f7f7;border-radius: 4px 4px 0 0;padding: 0 20px}
    .cart--content--F6tqhN2 {position: relative}

    .item-group--colMainImage--e1B_lrM .ordersn{font-size: 14px;margin-left: 0px;font-weight: 500;color: #333;}


    /*清单*/
    .albuy_div .order_listDiv{margin-bottom:15px;}
    .albuy_div .item-group-container--container--fFsBi_O:not(:last-child){border-bottom:1px dashed {{$website['color']}};}
    .albuy_div .ordersn{font-size: 15px;font-weight: 800;color:#000;}
    .albuy_div .shop_name{margin-left:15px;font-weight: 800;font-size: 15px;color:#000;}
    .albuy_div .cart_head_div{border:1px solid {{$website['color']}};}
    .albuy_div .cart_detail_title{background:{{$website['color']}};color: {{$website['color_word']}};font-size: 20px;font-weight: 800;padding: 5px 30px;box-sizing: border-box;}

    .td1{width:114px;text-align: center;}
    .td2,.td3{width:260px;max-width: 260px;font-size:15px;color:#000;}
    .td3 .currency,.td3 .price{color:#db1d18;font-weight:800;}
    .td4{width:216px;}
    .td5{width:160px;}
    .td6{width:150px;}
    .btn_group{padding:3px 10px;box-sizing: border-box;text-align: center;white-space: nowrap;cursor:pointer;font-size: 15px;font-weight: 800;}
    .sure_btn{background:#e60000;color:#fff;margin-right:8px;}
    .view_btn{background:{{$website['color']}};color:{{$website['color_word']}};border:1px solid {{$website['color_word']}};}

    .totalMoneyDiv{background: #fff;padding: 10px 20px;border-top: 1px solid {{$website['color']}};}
    .totalMoneyDiv .disf{justify-content: space-between;}
    .totalMoneyDiv .leftContent{font-size: 15px;font-weight: 600;}
    .totalMoneyDiv .rightContent{font-size: 15px;font-weight: 600;}
    .totalMoneyDiv .rightContent .pieceNumDiv,.totalMoneyDiv .rightContent .orderMoneyDiv{display: inline-block;}
    .totalMoneyDiv .rightContent .pieceNumDiv .pieceNum,.totalMoneyDiv .rightContent .orderMoneyDiv .orderMoney{font-size:18px;color:#e60000;}

    .addrDiv{background: #fff;padding: 10px 20px;border-top: 1px solid {{$website['color']}};}
    .addrDiv .disf{justify-content: space-between;}
    .addrDiv .leftContent{font-size: 15px;font-weight: 600;}
    .addrDiv .rightContent{font-size: 15px;font-weight: 600;width:600px;}
    .addrDiv .rightContent div .addr_title{width:80px;display: inline-block;text-align: right;}
    /*清单底部*/
    .operaDiv{background: #fff;padding: 10px 20px;}
    .not_selpay{background:#bbb9b9;color:#fff;}
    .alr_selpay{background:#db1d18;color:#fff;}
    .close_orderlist{background:#000;color:#fff;margin-left:15px;}
    a:hover{color:#fff;}

    /**弹窗样式**/
    .layer_frame .layui-layer-title{background:#bebebe;color:#fff;}
    .layer_frame .layui-layer-content{overflow:unset !important;}
    .layer_frame .layui-layer-setwin{top:-28px !important;}
    .layer_frame .layui-layer-title .disf{height:100%;}
    .layer_frame .exclamation-circle {position: relative;margin-right:8px;}
    .layer_frame .exclamation-circle span{font-size: 14px;font-weight:900;color: #fff;font-family: PingFang SC, Hiragino Sans GB, Heiti SC, Microsoft YaHei, Helvetica, Tahoma, Arial, SimHei, WenQuanYi Micro Hei !important;}
    .layer_frame .exclamation-circle::after {content: '';position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);width: 14px;height: 14px;background-color: #fff;border-radius: 50%;opacity:0.5;}
    .layer_frame .page_innerhead{width:100%;border-bottom:1px solid {{$website['color']}};}
    .layer_frame .page_innerhead .pageBack{width:15%;text-align: center;padding:10px 0;font-size:15px;color:#000;font-weight:600;background:#bebebe;cursor:pointer;position:relative;}
    .layer_frame .page_innerhead .pageSel{width:42.5%;text-align: center;padding:10px 0;font-size:15px;color:#000;font-weight:600;background:#fff;cursor:pointer;position:relative;border:1px solid #e1e1e1;}
    .layer_frame .page_innerhead .pageSel:first-child{border-right:1px solid #fff;}
    .layer_frame .page_innerhead .pageAct{background:{{$website['color']}};color:{{$website['color_word']}};}
    .layer_frame .page_innerhead .pageAct:after {content: '';position: absolute;top: 15px;right: 35px;width: 8px;height: 8px;border-top: 2px solid #fff;border-right: 2px solid #fff;transform: rotate(135deg);}
    .layer_frame .layui-layer-content .rightBox .page_content{height:88%;overflow-y: auto;}
    .layer_frame .layui-layer-content .rightBox .page_content .rightContent{height:100%;}
    .layui-tab.service_tab{width:400px;}

    @media (max-width: 992px){
        body{min-width: 100%;}
        #translate{display: block;}
        .w1210{width: 100%;}
        .cart--container--RtFTPfu{width: 100%;}
        .navbar-default .navbar-collapse{margin-top:15px;}
        .header-bar--container--XmK_Sks{overflow-x: auto;}
        .header-bar--colCheckbox--pDopfHb{width: 70px;}
        .header-bar--colGoods--Sk6Gd9f{width: 70px;}
        .header-bar--colQuantity--bw3tRQ5{width: 70px;}
        .header-bar--colPublishPrice--cXZm1e1{width: 70px;}
        .header-bar--colSubtotal--EVTzgzQ{width: 50px;}
        .albuy_div{margin-bottom: 50px;}
        .albuy_div .shop_name{margin-left:0;}

        tr.item-group--container--Eu9kRqK{display: grid;grid-template-columns: 1fr;border-bottom: 1px solid #000;padding-bottom: 20px;}
        .td1{text-align: left;}
        .td2, .td3{width: 100%;max-width: 100%;text-align: right;}
        .td4,.td5,.td6{width: 100%;max-width: 100%;text-align: right;}

        .layui-tab.service_tab{width:100%;}
    }
</style>


{{--    <style>--}}
{{--        *{line-height: 24px;}--}}
{{--        #content{padding-top:100px;}--}}
{{--        .login-form .login-con{box-sizing: revert;}--}}
{{--        .login-wrap .form-group .text {border-bottom: 1px solid #ddd !important;}--}}
{{--    </style>--}}


<div class="w1210" id="content">
    {{--引入列表--}}

    <div class="cart-content">
        <form class="layui-form" action="" method="post" lay-filter="glist-element">
            <div class="cart--container--RtFTPfu">
                <div class="albuy_div">
                    <!--订购详情-->
                    <div class="cart_head_div">
                        <div class="cart_detail_title">账单中心</div>
                        <div class="cart--header--ow5WRyV">
                            <div>
                                <div class="header-bar--container--XmK_Sks head1">
                                    <table class="header-bar--table--qVDj5tO">
                                        <thead>
                                        <tr>
                                            <th class="header-bar--colCheckbox--pDopfHb">清单编号</th>
                                            <th class="header-bar--colGoods--Sk6Gd9f">商品名称</th>
                                            {{--                                        <th class="header-bar--colGoods--Sk6Gd9f">规格名称</th>--}}
                                            <th class="header-bar--colGoods--Sk6Gd9f">商品单价</th>
                                            <th class="header-bar--colQuantity--bw3tRQ5">订购数量</th>
                                            <th class="header-bar--colPublishPrice--cXZm1e1">商品总价</th>
                                            <th class="header-bar--colPublishPrice--cXZm1e1">平台费用</th>
                                            <th class="header-bar--colSubtotal--EVTzgzQ">操作</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="cart--content--F6tqhN2">
                        <div style="display: block;">
                            <div>
                                <div>
                                    <div class="order_listDiv">
                                        <!--商品信息-->
                                        <div class="shop-container--container--_pNFLjq" style="margin-bottom:0;">
                                            <div class="shop-top--container--GWvjt50">
                                                <label class="next-checkbox-wrapper">
                                                    <span class="next-checkbox" style="display: ;">
                                                        @if($cart_buylist['status']==-9 || $cart_buylist['status']==-10 || $cart_buylist['status']==-11 || $cart_buylist['status']==0)
                                                            <input type="checkbox" class="next-checkbox-input order_select order_select1" value="" onclick="order_select(this,{{$cart_buylist['id']}})" lay-ignore
{{--                                                       if(!empty($cart_buylist['edit_address']))--}}
{{--                                                            if(!isset($cart_buylist['edit_address']['is_sure']))--}}
{{--                                                            disabled--}}
{{--                                                            endif--}}
{{--                                                       endif--}}
                                                            >
                                                       @endif
                                                    </span>
                                                    <span class="ordersn">{{$cart_buylist['ordersn']}}</span>
                                                </label>
                                            </div>
                                            @foreach($shoper as $k=>$v)
                                                <div class="shop_name">{{$v['shop_name']}}</div>
                                                @foreach($v['children']['goods_info'] as $kk=>$vv)
                                                    <?php $totalnum = 0;?>
                                                    @foreach($cart_buylist['content']['goods_info'] as $k2=>$v2)
                                                        @if($v2['good_id']==$vv['goods_id'])
                                                            <div class="item-group-container--container--fFsBi_O">
                                                                <table class="item-group-container--table--ESEGhi1">
                                                                    <tbody>
                                                                    @foreach($v2['sku_info'] as $k3=>$v3)
                                                                        <tr class="item-group--container--Eu9kRqK @if(isset($v3['is_close']))
                                                                        @if($v3['is_close']==1)
                                                                                noused
@endif
                                                                        @endif">
                                                                            <td class="td1">
                                                                                <label class="next-checkbox-wrapper " style="display:;">
                                                                                    <span class="next-checkbox">
                                                                                        @if($cart_buylist['status']==-9 || $cart_buylist['status']==-10 || $cart_buylist['status']==-11 || $cart_buylist['status']==0)
                                                                                            <input type="checkbox" name="sku_id2[]" class="next-checkbox-input order_select2 sku_id2" value="" onclick="sku_select(this,{{$cart_buylist['id']}})" data-skuid="{{$v3['sku_id']}}" data-goods_id="{{$v2['good_id']}}" data-cart_id="{{$v3['cart_id']}}" lay-ignore @if($v3['is_edit']==1)
{{--                                                                                                if(!empty($cart_buylist['edit_address']))--}}
{{--                                                                                                    if(!isset($cart_buylist['edit_address']['is_sure']))--}}
                                                                                                        disabled
{{--                                                                                                    endif--}}
{{--                                                                                                endif--}}
                                                                                            @endif>
                                                                                        @endif
                                                                                    </span>
                                                                                </label>
                                                                            </td>
                                                                            <td class="td2">
                                                                                <div class="disf">
                                                                                    <img src="@if(!empty($v3['sku_info']['sku_images']))
                                                                                    {{$v3['sku_info']['sku_images']}}
                                                                                    @else
                                                                                    {{$v2['goods_info']['goods_image']}}
                                                                                    @endif" alt="" class="goods_image" style="visibility: visible; display: block; margin-left: 0px; width: 70px; height: 70px;">
                                                                                    <a class="item-group--title--F09mZrH" href="/goods-{{$v2['good_id']}}.html" target="_blank" title="{{$v2['goods_info']['goods_name']}} {{$v3['sku_info']['spec_names']}}">{{$v2['goods_info']['goods_name']}}&nbsp;{{$v3['sku_info']['spec_names']}}</a>
                                                                                </div>
                                                                            </td>
                                                                            <td class="td3" style="display: none;">
                                                                                @if(!empty($v3['sku_info']['spec_names']))
                                                                                    <div class="item--title--eq76Cm2" title="{{$v3['sku_info']['spec_names']}}">{{$v3['sku_info']['spec_names']}}</div>
                                                                                @endif
                                                                            </td>
                                                                            <td class="td3">
                                                                                <span class="currency">{{$v['goods_currency']}}</span>&nbsp;<span class="price">
{{--                                                                                    $v3['sku_info']['goods_price']--}}
                                                                                    @foreach($v3['sku_info']['sku_prices']['start_num'] as $k4=>$v4)
                                                                                        @if($v3['sku_info']['sku_prices']['select_end'][$k4]==1)
                                                                                            @if($v4<$v3['goods_num'] && $v3['goods_num']<$v3['sku_info']['sku_prices']['end_num'][$k4])
                                                                                                <?php echo number_format($v3['sku_info']['sku_prices']['price'][$k4],2);?>
                                                                                                <?php break;?>
                                                                                            @endif
                                                                                        @else
                                                                                            <?php echo number_format($v3['sku_info']['sku_prices']['price'][$k4],2);?>
                                                                                        @endif

                                                                                    @endforeach
                                                                                </span>
                                                                            </td>
                                                                            <td class="item--colQuantity--X6jdFO1 td4">
                                                                                x {{$v3['goods_num']}}
                                                                                @if(isset($v3['is_close']) && $cart_buylist['status']==1)
                                                                                    @if($v3['is_close']==0)
                                                                                        <?php $totalnum+=$v3['goods_num'];?>
                                                                                    @endif
                                                                                @elseif($cart_buylist['status']==-2 || $cart_buylist['status']==0)
                                                                                    <?php $totalnum+=$v3['goods_num'];?>
                                                                                @endif
                                                                            </td>
                                                                            <td class="item--colPublishPrice--_Gft88l td5">
                                                                                {{$v['goods_currency']}} {{$v3['price']}}
                                                                            </td>
                                                                            <td class="item--colPublishPrice--_Gft88l td5">
                                                                                @if($k3==0)
                                                                                    {{$v['goods_currency']}} <?php echo number_format($v2['services_money']+$v2['otherfee_total']-$v2['reduction_money']-$v2['gift_money']+$v2['noinclude_money']+$v2['potential_money'],2);?>
                                                                                @endif
                                                                            </td>
                                                                            <td class="item--colSubtotal--wD06b01 td6">
                                                                                <div class="disf" style="justify-content: right;">
                                                                                    @if($v3['is_edit']==1)
                                                                                        <div class="sure_btn btn_group" onclick="sure_content(this,{{$cart_buylist['id']}},1,{{$k2}},{{$k3}},{{$v3['sku_id']}})">确认明细</div>
                                                                                    @endif
                                                                                    @if($cart_buylist['is_level']!=1)
                                                                                        <div class="view_btn btn_group" onclick="view_content(this,{{$cart_buylist['id']}},{{$k2}},{{$k3}},{{$v3['sku_id']}})">服务明细</div>
                                                                                    @endif
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                            <?php $totalnum = 0;?>

                                        </div>
                                        <!--合计金额信息-->
                                        <div class="totalMoneyDiv" style="display: @if($cart_buylist['status']==-9 || $cart_buylist['status']==-10 || $cart_buylist['status']==-11 || $cart_buylist['status']==0)
                                                    block
                                                @else
                                                    none
                                                @endif;">
                                            <div class="disf">
                                                <div class="leftContent">合计：</div>
                                                <div class="rightContent">
                                                    <div class="pieceNumDiv">
                                                        <span class="pieceNum">
                                                            @if($cart_buylist['status']==-9 || $cart_buylist['status']==-10 || $cart_buylist['status']==-11 || $cart_buylist['status']==0)
                                                            0
                                                            @else
                                                                {{$totalnum}}
                                                            @endif
                                                        </span>
                                                        &nbsp;件
                                                    </div>
                                                    &nbsp;&nbsp;
                                                    <div class="orderMoneyDiv">
                                                        <span class="orderCurrency">CNY</span>
                                                        &nbsp;
                                                        <span class="orderMoney">
                                                            @if($cart_buylist['status']==-9 || $cart_buylist['status']==-10 || $cart_buylist['status']==-11 || $cart_buylist['status']==0)
                                                            0.00
                                                            @else
                                                                {{$cart_buylist['true_money']}}
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--收货信息-->
{{--                                        <div class="addrDiv" style="display: none;">--}}
{{--                                            <div class="disf">--}}
{{--                                                <div class="leftContent">收货信息</div>--}}
{{--                                                <div class="rightContent">--}}
{{--                                                    if(!empty($cart_buylist['edit_address']))--}}
{{--                                                        <div><div class="addr_title">收货地址：</div>$cart_buylist['edit_address']['address']}}</div>--}}
{{--                                                        <div><div class="addr_title">邮政编码：</div>$cart_buylist['edit_address']['postal']}}</div>--}}
{{--                                                        <div><div class="addr_title">收件人：</div>$cart_buylist['edit_address']['user_name']}}</div>--}}
{{--                                                        <div><div class="addr_title">电话：</div>$cart_buylist['edit_address']['area_mobile']}} $cart_buylist['edit_address']['mobile']}}  $cart_buylist['edit_address']['mobile2']}}</div>--}}
{{--                                                        <div><div class="addr_title">电邮：</div>$cart_buylist['edit_address']['email']}}</div>--}}
{{--                                                    else--}}
{{--                                                        <div><div class="addr_title">收货地址：</div>$cart_buylist['address']['address']}}</div>--}}
{{--                                                        <div><div class="addr_title">邮政编码：</div>$cart_buylist['address']['postal']}}</div>--}}
{{--                                                        <div><div class="addr_title">收件人：</div>$cart_buylist['address']['user_name']}}</div>--}}
{{--                                                        <div><div class="addr_title">电话：</div>$cart_buylist['address']['area_mobile']}} $cart_buylist['address']['mobile']}}  $cart_buylist['address']['mobile2']}}</div>--}}
{{--                                                        <div><div class="addr_title">电邮：</div>$cart_buylist['address']['email']}}</div>--}}
{{--                                                    endif--}}

{{--                                                    if(!isset($cart_buylist['edit_address']['is_sure']) && ($cart_buylist['status']==-9 || $cart_buylist['status']==-10 || $cart_buylist['status']==-11))--}}
{{--                                                        <div class="sure_btn btn_group" onclick="sure_content(this,$cart_buylist['id']}},2)" style="width:fit-content;margin-top:10px;margin-left:80px;">确认内容</div>--}}
{{--                                                    endif--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        <!--清单操作-->
                                        <div class="operaDiv" style="background: #fff;padding:20px;border-top: 1px solid {{$website['color']}};">
                                            <div class="disf" style="justify-content: end;">
                                                <div class="leftContent"></div>
                                                <div class="rightContent">
                                                    @if($order_type==2)
                                                        <!--代发-->
                                                        @if($cart_buylist['status']==-9 || $cart_buylist['status']==-10)
                                                            <div class="disf">
                                                                <div class="btn_group not_selpay" onclick="pay_orderlist(this,{{$cart_buylist['id']}},1)">勾选，请求支付</div>
                                                                <div class="btn_group close_orderlist" onclick="close_orderlist(this,{{$cart_buylist['id']}})">关闭订单</div>
                                                            </div>
                                                        @elseif($cart_buylist['status']==-14  || $cart_buylist['status']==0)
                                                            <div class="disf">
                                                                <a href="/cashier?orderid={{$cart_buylist['id']}}" target="_blank" class="btn_group alr_selpay">前往结算</a>
    {{--                                                            <div class="btn_group alr_selpay" onclick="pay_orderlist(this,{{$cart_buylist['id']}},3)">前往收银台</div>--}}
                                                            </div>
                                                        @elseif($cart_buylist['status']==1)
    {{--                                                        <div class="disf">--}}
    {{--                                                            <a class="btn_group view_btn" href="/cart/pay_order?oid={{$cart_buylist['id']}}" target="_blank">查看支付订单</a>--}}
    {{--                                                        </div>--}}
                                                        @endif
                                                    @elseif($order_type==1)
                                                        <!--直发-->
                                                        @if($cart_buylist['status']==0)
                                                            <div class="disf">
                                                                <a href="/cashier?orderid={{$cart_buylist['id']}}" target="_blank" class="btn_group alr_selpay">前往结算</a>
    {{--                                                            <div class="btn_group alr_selpay" onclick="pay_orderlist(this,{{$cart_buylist['id']}},3)">前往收银台</div>--}}
                                                            </div>
                                                        @endif
                                                    @endif
                                                    
                                                    @if($cart_buylist['status']>=1 && $cart_buylist['is_package']==1)
                                                        <div class="disf">
                                                            <a href="/logistics_tracking?orderid={{$cart_buylist['id']}}" target="_blank" class="btn_group alr_selpay">查询物流轨迹</a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="/assets/d2eace91/js/jquery.js?v=1.1"></script>


    <script src="/js/common.js?v=1.1"></script>
    <!-- 图片缓载js -->
    <script src="/assets/d2eace91/js/jquery.lazyload.js?v=1.1"></script>
    <!-- JS -->
    <script src="/assets/d2eace91/js/jquery.cookie.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=1.1"></script>
    <script src="/js/jquery.fly.min.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/szy.cart.js?v=1.1"></script>
    <!--[if lte IE 9]>
    <script src="/js/requestAnimationFrame.js?v=1.1"></script>
    <![endif]-->
    <script type="text/javascript" src="/assets/d2eace91/layui/layui.js"></script>
    <script type="text/javascript">
        // 缓载图片
        $().ready(function(){
            $.imgloading.loading();
            //图片预加载
            document.onreadystatechange = function() {
                if (document.readyState == "complete") {
                    $.imgloading.setting({
                        threshold: 1000
                    });
                    $.imgloading.loading();
                }
            }
        });
    </script>
    <script type="text/javascript">
        layui.use(['layer','element','upload','form'],function() {
            var $ = layui.$
                , layer = layui.layer
                , element = layui.element
                , form = layui.form
                , upload = layui.upload;
            form.render(null,'glist-element');
        });

        //切换当前浏览框
        function change_window(typ,t){
            var $ = layui.$
                , form = layui.form
                , layer = layui.layer;

            if(typ==0){
                $('.nobuy_div').show();
                $('.head0').show();
                $('.cart-tab--addressWrapper--fVnyBG0').show();
                $('.head1').show();
                $('.albuy_div').hide();
                $('.closebuy_div').hide();
            }
            else if(typ==1){
                $('.head1').show();
                $('.albuy_div').show();
                $('.nobuy_div').hide();
                $('.closebuy_div').hide();
                $('.head0').hide();
                $('.cart-tab--addressWrapper--fVnyBG0').hide();
            }
            else if(typ==2){
                $('.head1').show();
                $('.closebuy_div').show();
                $('.albuy_div').hide();
                $('.nobuy_div').hide();
                $('.head0').hide();
                $('.cart-tab--addressWrapper--fVnyBG0').hide();
            }
            $(t).addClass('active');
            $(t).siblings().removeClass('active');
        }

        //已购清单操作==========================================================START
        //确认内容
        function sure_content(t,id,typ,gkey=0,skey=0,sku_id=0){
            var $ = layui.$
                , layer = layui.layer;

            if(typ==1){
                //确认商品规格/价格/数量信息
                layer.confirm('确认该商品信息正确无误吗？', {
                    btn: ['确认','取消']
                }, function() {
                    layer.load();
                    $.post("/cart/sure_order_info", {
                        'order_id': id,
                        'type': typ,
                        'gkey':gkey,
                        'skey':skey,
                        'sku_id':sku_id,
                        '_token': "{{csrf_token()}}"
                    }, function (res) {
                        layer.msg(res.msg, {time: 2000}, function () {
                            if (res.code == 0) {
                                layer.closeAll('loading');
                                let href = window.location.href;
                                if(href.includes("selected")){
                                    window.location.reload();
                                }else{
                                    window.location.replace(href + "?selected=1");
                                }
                            }
                        });
                    }, 'json');
                }, function() {

                });
            }
            else if(typ==2){
                //确认地址信息
                layer.confirm('确认该收货地址正确无误吗？', {
                    btn: ['确认','取消']
                }, function() {
                    layer.load();
                    $.post("/cart/sure_order_info", {
                        'order_id': id,
                        'type': typ,
                        '_token': "{{csrf_token()}}"
                    }, function (res) {
                        layer.msg(res.msg, {time: 2000}, function () {
                            if (res.code == 0) {
                                layer.closeAll('loading');
                                window.location.replace(window.location.href + "?selected=1");
                            }
                        });
                    }, 'json');
                }, function() {

                });
            }
        }

        //查看内容
        //弹框显示条件
        var layer_frame_div = '';
        function view_content(t,id,gkey,skey,sku_id){
            var $ = layui.$
                , element = layui.element
                , layer = layui.layer;

            layer.load();

            let main_html = '';
            $.post('/cart/sure_order_info',{'order_id':id,'type':3,'gkey':gkey,'skey':skey,'sku_id':sku_id,'_token':'{{csrf_token()}}'},function(res) {
                if(res.code==0){
                    main_html += '<div class="layui-tab service_tab" lay-filter="test-hash">\n' +
                        '  <ul class="layui-tab-title">\n';
                    if(res.datas.file != null && res.datas.file != '') {
                        main_html += '<li class="">监管文件</li>\n';
                    }
                    if(res.datas.otherfee_content!='' && res.datas.otherfee_content!=null) {
                        main_html += '<li class="">其他费用</li>\n';
                    }
                    if(res.datas.reduction_money>0) {
                        main_html += '<li class="">减免优惠</li>\n';
                    }
                    if(res.datas.prefe_gift != null && res.datas.prefe_gift != '') {
                        main_html += '<li class="">随赠优惠</li>\n';
                    }
                    if(res.datas.noinclude_money>0) {
                        main_html += '<li class="">价格未含</li>\n';
                    }
                    if(res.datas.potential_money>0) {
                        main_html += '<li class="">潜在收费</li>\n';
                    }
                    if(res.datas.services != null) {
                        main_html += '<li class="">更多服务</li>\n';
                    }
                    main_html+='</ul>\n' +
                        '  <div class="layui-tab-content">\n';
                    if(res.datas.file != null && res.datas.file != '') {
                        main_html += '<div class="layui-tab-item">';
                        <!--监管文件-->
                        main_html += '<div class="gi_file_div" style="background:#fff;">\n' +
                            '                                                                                <div class="gi_file disf gi_border" style="margin-top:10px;">\n' +
                            '                                                                                    <div class="gifile_info disf" style="width: 100%;">\n' +
                            '                                                                                        <div class="layui-upload" style="text-align:left;width: 100%;">\n' +
                            '                                                                                            <blockquote class="layui-elem-quote layui-quote-nm yulan" style="margin-top: 10px;width:100%;background:#e6e6e6;">\n' +
                            '                                                                                                文件预览：\n' +
                            '                                                                                                <div class="layui-upload-list" id="supervise_file-upload-list">\n';
                        for(let i=0;i<res.datas.file.length;i++){
                            main_html += '                                                                                       <div style="display: inline-block;">\n' +
                                '                                                                                                            <img src="https://shop.gogo198.cn/'+res.datas.file[i]+'" class="layui-upload-img" style="width:80px;height:80px;">\n' +
                                '                                                                                                        </div>\n';
                        }
                        main_html += '                                                                                                </div>\n' +
                            '                                                                                            </blockquote>\n' +
                            '                                                                                        </div>\n' +
                            '                                                                                    </div>\n' +
                            '                                                                                </div>\n' +
                            '                                                                            </div>';
                        main_html += '</div>\n';
                    }
                    if(res.datas.otherfee_content!='' && res.datas.otherfee_content!=null) {
                        main_html += '<div class="layui-tab-item">';
                        <!--其他费用详情-->
                        main_html += '                                                               <div class="projectDiv">\n' +
                            '                                                                            <table class="layui-table">\n' +
                            '                                                                                <thead>\n' +
                            '                                                                                <tr>\n' +
                            '                                                                                    <th>费用名称</th>\n' +
                            '                                                                                    <th>费用说明</th>\n' +
                            '                                                                                    <th>计费价格</th>\n' +
                            '                                                                                </tr>\n' +
                            '                                                                                </thead>\n' +
                            '                                                                                <tbody>\n';
                        for(let i=0;i<res.datas.otherfee_content.length;i++){
                            main_html += '                                                                        <tr>\n' +
                                '                                                                                        <td>'+res.datas.otherfee_content[i]['name']+'</td>\n' +
                                '                                                                                        <td>'+res.datas.otherfee_content[i]['desc']+'</td>\n' +
                                '                                                                                        <td>'+res.datas.otherfee_content[i]['currency']+' '+res.datas.otherfee_content[i]['price']+'</td>\n' +
                                '                                                                                    </tr>\n';
                        }
                        main_html += '                                                                                </tbody>\n' +
                            '                                                                            </table>\n';
                        if(res.datas.odd_otherfee_total!=res.datas.otherfee_total && res.datas.odd_otherfee_total != ''){
                            main_html += '<div class="origin_price">原价：'+res.datas.otherfee_currency+' '+res.datas.odd_otherfee_total+'</div>';
                            main_html += '<div class="now_price">现价：'+res.datas.otherfee_currency+' '+res.datas.otherfee_total+'</div>';
                        }else{
                            main_html += '<div class="now_price">总价：'+res.datas.otherfee_currency+' '+res.datas.otherfee_total+'</div>';
                        }
                        main_html += '                                                                </div>';
                        main_html += '</div>\n';
                    }
                    if(res.datas.reduction_money>0) {
                        main_html += '<div class="layui-tab-item">' +
                            '              <div class="projectDiv">\n' +
                            '                                                                            <table class="layui-table">\n' +
                            '                                                                                <thead>\n' +
                            '                                                                                <tr>\n' +
                            '                                                                                    <th>费用名称</th>\n' +
                            '                                                                                    <th>摘要描述</th>\n' +
                            '                                                                                    <th>减免费用</th>\n' +
                            '                                                                                </tr>\n' +
                            '                                                                                </thead>\n' +
                            '                                                                                <tbody>\n';
                        for(let i2=0;i2<res.datas.reduction_content.length;i2++){
                            main_html+=' <td>'+res.datas.reduction_content[i2]['name']+'</td>\n'+
                                ' <td>'+res.datas.reduction_content[i2]['desc']+'</td>\n'+
                                ' <td>'+res.datas.reduction_content[i2]['currency']+' '+res.datas.reduction_content[i2]['price']+'</td>\n';
                        }
                        main_html+='                                                                         </tbody>\n' +
                            '                                                                            </table>\n';
                        if(res.datas.odd_reduction_money!=res.datas.reduction_money){
                            if(res.datas.odd_reduction_money!='') {
                                main_html += '<div class="origin_price">原减免：' + res.datas.otherfee_currency + ' ' + res.datas.odd_reduction_money + '</div>';
                            }
                            main_html += '<div class="now_price">现减免：'+res.datas.otherfee_currency+' '+res.datas.reduction_money+'</div>';
                        }else{
                            main_html += '<div class="now_price">总减免：'+res.datas.otherfee_currency+' '+res.datas.reduction_money+'</div>';
                        }
                        main_html += '             </div>' +
                            '         </div>';
                    }
                    if(res.datas.prefe_gift != null && res.datas.prefe_gift != '') {
                        main_html += '<div class="layui-tab-item">' +
                            '              <div class="projectDiv">\n' +
                            '                                                                            <table class="layui-table">\n' +
                            '                                                                                <thead>\n' +
                            '                                                                                <tr>\n' +
                            '                                                                                    <th>优惠权属</th>\n' +
                            '                                                                                    <th>随赠内容</th>\n' +
                            '                                                                                    <th>随赠费用</th>\n' +
                            '                                                                                </tr>\n' +
                            '                                                                                </thead>\n' +
                            '                                                                                <tbody>\n';
                        for(let i2=0;i2<res.datas.prefe_gift.length;i2++){
                            main_html+=' <td>'+res.datas.prefe_gift[i2]['name']+'</td>\n'+
                                ' <td>'+res.datas.prefe_gift[i2]['desc']+'</td>\n'+
                                ' <td>'+res.datas.prefe_gift[i2]['currency']+' '+res.datas.prefe_gift[i2]['price']+'</td>\n';
                        }
                        main_html+='                                                                         </tbody>\n' +
                            '                                                                            </table>\n';
                        if(res.datas.odd_gift_money!=res.datas.gift_money){
                            if(res.datas.odd_gift_money!='') {
                                main_html += '<div class="origin_price">原价：' + res.datas.otherfee_currency + ' ' + res.datas.odd_gift_money + '</div>';
                            }
                            main_html += '<div class="now_price">现价：'+res.datas.otherfee_currency+' '+res.datas.gift_money+'</div>';
                        }else{
                            main_html += '<div class="now_price">总价：'+res.datas.otherfee_currency+' '+res.datas.gift_money+'</div>';
                        }
                        main_html += '             </div>' +
                            '         </div>';
                    }
                    if(res.datas.noinclude_money>0) {
                        //价格未含
                        main_html += '<div class="layui-tab-item">' +
                            '              <div class="projectDiv">\n' +
                            '                                                                            <table class="layui-table">\n' +
                            '                                                                                <thead>\n' +
                            '                                                                                <tr>\n' +
                            '                                                                                    <th>费用名称</th>\n' +
                            '                                                                                    <th>摘要描述</th>\n' +
                            '                                                                                    <th>应收费用</th>\n' +
                            '                                                                                </tr>\n' +
                            '                                                                                </thead>\n' +
                            '                                                                                <tbody>\n';
                        for(let i2=0;i2<res.datas.noinclude_content.length;i2++){
                            main_html+='<tr>' +
                                ' <td>'+res.datas.noinclude_content[i2]['name']+'</td>\n'+
                                ' <td>'+res.datas.noinclude_content[i2]['desc']+'</td>\n'+
                                ' <td>'+res.datas.noinclude_content[i2]['currency']+' '+res.datas.noinclude_content[i2]['price']+'</td>\n'+
                                '</tr>';
                        }
                        main_html+='                                                                         </tbody>\n' +
                            '                                                                            </table>\n';
                        if(res.datas.odd_noinclude_money!=res.datas.noinclude_money){
                            if(res.datas.odd_noinclude_money!='') {
                                main_html += '<div class="origin_price">原价：' + res.datas.otherfee_currency + ' ' + res.datas.odd_noinclude_money + '</div>';
                            }
                            main_html += '<div class="now_price">现价：'+res.datas.otherfee_currency+' '+res.datas.noinclude_money+'</div>';
                        }else{
                            main_html += '<div class="now_price">总价：'+res.datas.otherfee_currency+' '+res.datas.noinclude_money+'</div>';
                        }
                        main_html += '             </div>' +
                            '         </div>';
                    }
                    if(res.datas.potential_money>0) {
                        //潜在收费
                        main_html += '<div class="layui-tab-item">' +
                            '              <div class="projectDiv">\n' +
                            '                                                                            <table class="layui-table">\n' +
                            '                                                                                <thead>\n' +
                            '                                                                                <tr>\n' +
                            '                                                                                    <th>费用名称</th>\n' +
                            '                                                                                    <th>摘要描述</th>\n' +
                            '                                                                                    <th>应收费用</th>\n' +
                            '                                                                                </tr>\n' +
                            '                                                                                </thead>\n' +
                            '                                                                                <tbody>\n';
                        for(let i2=0;i2<res.datas.potential_content.length;i2++){
                            main_html+='<tr>\n'+
                                ' <td>'+res.datas.potential_content[i2]['name']+'</td>\n'+
                                ' <td>'+res.datas.potential_content[i2]['desc']+'</td>\n'+
                                ' <td>'+res.datas.potential_content[i2]['currency']+' '+res.datas.potential_content[i2]['price']+'</td>\n'+
                                '</tr>';
                        }
                        main_html+='                                                                         </tbody>\n' +
                            '                                                                            </table>\n';
                        if(res.datas.odd_noinclude_money!=res.datas.noinclude_money){
                            if(res.datas.odd_noinclude_money!='') {
                                main_html += '<div class="origin_price">原价：' + res.datas.otherfee_currency + ' ' + res.datas.odd_potential_money + '</div>';
                            }
                            main_html += '<div class="now_price">现价：'+res.datas.otherfee_currency+' '+res.datas.potential_money+'</div>';
                        }else{
                            main_html += '<div class="now_price">总价：'+res.datas.otherfee_currency+' '+res.datas.potential_money+'</div>';
                        }
                        main_html += '             </div>' +
                            '         </div>';
                    }
                    if(res.datas.services != null) {
                        main_html += '<div class="layui-tab-item">';
                        <!--更多服务-->
                        main_html += '<div class="projectDiv">\n' +
                            '                                                                            <table class="layui-table">\n' +
                            '                                                                                <thead>\n' +
                            '                                                                                <tr>\n' +
                            '                                                                                    <th style="white-space: nowrap;">服务名称</th>\n' +
                            '                                                                                    <th>服务描述</th>\n' +
                            '                                                                                    <th>服务价格</th>\n' +
                            '                                                                                </tr>\n' +
                            '                                                                                </thead>\n' +
                            '                                                                                <tbody>\n';
                        for(let i=0;i<res.datas.services.length;i++){
                            main_html += '                                                                   <tr>\n' +
                                '                                                                                        <td>'+res.datas.services[i].info.name+'</td>\n' +
                                '                                                                                        <td>\n';
                            if(res.datas.services[i].info.type==1) {
                                main_html += '                                                                        共需拍' + res.datas.services[i].photonum + '张\n';
                            }
                            else {
                                main_html += '                                                                        ' + res.datas.services[i].info.desc + '\n';
                            }
                            main_html += '                                                                        </td>\n' +
                                '                                                                                     <td>\n';
                            if(res.datas.services[i].info.type==1) {
                                main_html += '                                                                        CNY ' + res.datas.services[i].info.price + ' + 续CNY ' + res.datas.services[i].info.interval_price + '\n';
                            }
                            else{
                                main_html += '                                                                        CNY '+ res.datas.services[i].info.price +'\n';
                            }
                            main_html += '                                                                        </td>\n' +
                                '                                                                                 </tr>\n';
                        }

                        main_html += '                                                                    </tbody>\n' +
                            '                                                                            </table>\n';
                        if(res.datas.odd_services_money!=res.datas.services_money){
                            if(res.datas.odd_services_money!=''){
                                main_html += '<div class="origin_price">原价：'+res.datas.otherfee_currency+' '+res.datas.odd_services_money+'</div>';
                            }
                            main_html += '<div class="now_price"">现价：'+res.datas.services_currency+' '+res.datas.services_money+'</div>';
                        }else{
                            main_html += '<div class="now_price">总价：'+res.datas.otherfee_currency+' '+res.datas.services_money+'</div>';
                        }
                        main_html += '                                                             </div>';
                        main_html += '</div>\n';
                    }
                    main_html += '</div>\n' +
                        '</div>';

                    let name = '查看内容';
                    $.post('/getFrame',{'id':3,'type':99,'_token':'{{csrf_token()}}'},function(res2) {
                        let html = '<div class="disf" style="align-items: flex-start;width:100%;height:100%;">'+
                            '       <div class="leftBox" style="width:29%;height:100%;">\n' +
                            '                 <img src="https://shop.gogo198.cn/'+res2.adv['img']+'" class="windowsAdv" alt="" style="cursor:pointer;width:100%;height:100%;">\n' +
                            '            </div>'+
                            '            <div class="rightBox" style="width:71%;height:100%;border-left:1px solid #fff;">'+
                            '                 <div class="page_innerhead disf">'+
                            '                      <div class="pageBack" onclick="showPageInfo(3,this)">&lt;返回</div>'+
                            '                      <div class="pageSel pageAct" onclick="showPageInfo(1,this)">'+name+'</div>'+
                            '                      <div class="pageSel" onclick="showPageInfo(2,this)">在线客服</div>'+
                            '                 </div>'+
                            '                 <div class="page_content">'+
                            '                      <div class="leftContent">'+main_html+'</div>'+
                            '                      <div class="rightContent"></div>';
                        '                 </div>';
                        '            </div>'+
                        '       </div>';

                        var area = ['600px', '433px'];
                        if(IsPhone()){
                            area = ['100%','400px'];
                        }

                        layer_frame_div = layer.open({
                            skin:'layer_frame',
                            type: 1,
                            title: '<div class="disf"><div class="exclamation-circle"><span>!</span></div>系统提示：'+name+'</div>',
                            area: area,
                            content: html
                        });

                        layer.closeAll('loading');
                        $('.service_tab').find('.layui-tab-title').find('li').eq(0).addClass('layui-this');
                        $('.service_tab').find('.layui-tab-content').find('.layui-tab-item').eq(0).addClass('layui-show');

                        element.render('tab');

                    },'json');

                }
            },'json');
            // return false;
        }

        function showPageInfo(typ,t){
            var $ = layui.$,
                layer = layui.layer;
            layer.load();
            if(typ==1){
                $(t).addClass('pageAct');
                $(t).siblings().removeClass('pageAct');
                $('.layer_frame').find('.layui-layer-content').find('.page_content').find('.leftContent').show();
                $('.layer_frame').find('.layui-layer-content').find('.page_content').find('.rightContent').hide();
            }
            else if(typ==2){
                //客服
                $(t).addClass('pageAct');
                $(t).siblings().removeClass('pageAct');
                if("{{session('user.user_id')}}" ==''){
                    $.login.show();
                    return false;
                }

                if($('.layer_frame').find('.layui-layer-content').find('.page_content').find('.rightContent').find('iframe').length==0){
                    // let html = '<iframe id="chat" name="chat" style="width: 100%;height: 100%;" frameborder="0" scrolling="yes" src="/customer_online?isframe=1&control_height=190"></iframe>';
                    let html = '<iframe id="chat" name="chat" style="width: 100%;height: 100%;" frameborder="0" scrolling="yes" src="https://boss.gogo198.cn/?s=customer/customer_online&pa=2&who_send=2&id=0&pid=0&isframe=1&uid=<?php echo session('user.gogo_id');?>"></iframe>';
                    $('.layer_frame').find('.layui-layer-content').find('.page_content').find('.rightContent').html(html);
                }
                $('.layer_frame').find('.layui-layer-content').find('.page_content').find('.leftContent').hide();
                $('.layer_frame').find('.layui-layer-content').find('.page_content').find('.rightContent').show();
            }
            else if(typ==3){
                layer.close(layer_frame_div);
            }
            layer.closeAll('loading');
        }

        //当前清单全选（可选的）商品
        function order_select(t,oid){
            var $ = layui.$
                , layer = layui.layer;

            if(!$(t).prop('disabled')){
                //没有禁用属性
                let sku = $(t).parents(":eq(3)").find('.sku_id2');

                for(let i=0;i<sku.length;i++){
                    if($(t).is(':checked')==true) {
                        if(!$(t).parents(":eq(3)").find('.sku_id2').eq(i).prop('disabled')){
                            $(t).parents(":eq(3)").find('.sku_id2').eq(i).prop('checked',true);
                        }
                    }
                    else {
                        if(!$(t).parents(":eq(3)").find('.sku_id2').eq(i).prop('disabled')){
                            $(t).parents(":eq(3)").find('.sku_id2').eq(i).prop('checked',false);
                        }
                    }
                }
                calc_buy_select(t,1,oid);
            }else{
                //有禁用属性
                layer.msg('请先确认收货地址信息是否正确');
            }
        }

        //当前清单商品下的规格信息
        function sku_select(t,oid){
            var $ = layui.$
                , layer = layui.layer;

            if(!$(t).prop('disabled')){
                let sku = $(t).parents(":eq(7)").find('.sku_id2');
                let is_checked = false;
                for(let i=0;i<sku.length;i++){
                    if($(t).is(':checked')==true) {
                        is_checked = true;
                    }else if($(t).parents(":eq(7)").find('.sku_id2').eq(i).is(':checked')==true){
                        is_checked = true;
                    }
                }
                $(t).parents(":eq(7)").find('.order_select1').prop('checked',is_checked);
                calc_buy_select(t,2,oid);
            }
        }

        //计算所选费用
        function calc_buy_select(t,typ,oid){
            var $ = layui.$
                , layer = layui.layer;
            layer.load();
            let sku_id_length = '';
            if(typ==1){
                //全部
                sku_id_length = $(t).parents(':eq(3)').find('.sku_id2');
            }
            else if(typ==2){
                //单选
                sku_id_length = $(t).parents(':eq(7)').find('.sku_id2');
            }

            if(sku_id_length.length>0){
                let totalnum = 0;//总件数
                //库存+购物车+商品的总价格+商品数量
                let sku_ids = '';
                let cart_ids = '';
                let goods_ids = '';
                let sku_nums = '';

                for(let i=0;i<sku_id_length.length;i++){
                    if(sku_id_length.eq(i).is(':checked')==true){
                        if(typ==1){
                            let td4 = $(t).parents(':eq(3)').find('.sku_id2').eq(i).parents(":eq(3)").find('.td4').text();
                            td4 = td4.trim();
                            //处理数量“x 1”的问题--start
                            let num = td4.split('').filter(char => char !== 'x').join('');
                            num = num.trim();
                            totalnum += parseInt(num);
                            //处理数量“x 1”的问题--end
                            sku_nums += td4+',';
                            sku_ids += $(t).parents(':eq(3)').find('.sku_id2').eq(i).attr('data-skuid')+',';
                            cart_ids += $(t).parents(':eq(3)').find('.sku_id2').eq(i).attr('data-cart_id')+',';
                            goods_ids += $(t).parents(':eq(3)').find('.sku_id2').eq(i).attr('data-goods_id')+',';
                        }else if(typ==2){
                            let td4 = $(t).parents(':eq(7)').find('.sku_id2').eq(i).parents(":eq(3)").find('.td4').text();
                            td4 = td4.trim();
                            //处理数量“x 1”的问题--start
                            let num = td4.split('').filter(char => char !== 'x').join('');
                            num = num.trim();
                            totalnum += parseInt(num);
                            //处理数量“x 1”的问题--end
                            sku_nums += td4+',';
                            sku_ids += $(t).parents(':eq(7)').find('.sku_id2').eq(i).attr('data-skuid')+',';
                            cart_ids += $(t).parents(':eq(7)').find('.sku_id2').eq(i).attr('data-cart_id')+',';
                            goods_ids += $(t).parents(':eq(7)').find('.sku_id2').eq(i).attr('data-goods_id')+',';
                        }
                    }
                }

                $.post("/cart/calc_fee2",{'oid':oid,'sku_ids':sku_ids,'cart_ids':cart_ids,'goods_ids':goods_ids,'sku_nums':sku_nums,'type':2,'_token':"{{csrf_token()}}"},function(res){
                    if (res.code == 0) {
                        if(typ==1){
                            $(t).parents(":eq(4)").find('.pieceNum').text(totalnum);
                            $(t).parents(":eq(4)").find('.orderMoney').text(res.price);
                            $(t).parents(":eq(4)").find('.not_selpay').removeClass('not_selpay').addClass('alr_selpay');
                        }else if(typ==2){
                            $(t).parents(":eq(8)").find('.pieceNum').text(totalnum);
                            $(t).parents(":eq(8)").find('.orderMoney').text(res.price);
                            $(t).parents(":eq(8)").find('.not_selpay').removeClass('not_selpay').addClass('alr_selpay');
                        }
                        layer.closeAll('loading');

                        if(sku_ids==''){
                            if(typ==1){
                                $(t).parents(":eq(4)").find('.alr_selpay').removeClass('alr_selpay').addClass('not_selpay');
                            }
                            else if(typ==2){
                                $(t).parents(":eq(8)").find('.alr_selpay').removeClass('alr_selpay').addClass('not_selpay');
                            }
                        }
                    }
                },'json');

            }
            else{
                $('.delNum').text('');
            }
        }
        var layer_frame_div = '';
        //关闭订单=======================================================================start
        function close_orderlist(t,oid){
            var $ = layui.$
                , layer = layui.layer;

            {{--layer.confirm('确认要关闭该清单吗？', {--}}
            {{--    btn: ['确认','取消']--}}
            {{--}, function(){--}}
            {{--    layer.load();--}}
            {{--    $.post("/cart/close_order",{'oid':oid,'_token':"{{csrf_token()}}"},function(res){--}}
            {{--        layer.closeAll('loading');--}}
            {{--        layer.msg(res.msg,{time:2000}, function () {--}}
            {{--            if (res.code == 0) {--}}
            {{--                window.location.reload();--}}
            {{--            }--}}
            {{--        });--}}
            {{--    },'json');--}}
            {{--}, function(){--}}

            {{--});--}}

            let area = ['250px','150px'];
            let html = '<div class="body" style="padding:10px;box-sizing: border-box;"><div class="msg" style="font-size: 15px;color: #000;width: 100%;overflow-y: auto;margin-bottom:20px;">确认要关闭该清单吗？</div><div class="btnGroup" style="display: flex;align-items: center;justify-content: center;"><a style="padding:5px 10px;background:{{$website['color']}};font-size:15px;font-weight:800;color:#fff;margin-right:20px;" href="javascript:sure_closeOrderList('+oid+');">确认</a><a href="javascript:cancel_closeOrderList();" style="padding:5px 10px;background:#db1d18;font-size:15px;font-weight:800;color:#fff;">取消</a></div></div>';

            layer_frame_div = layer.open({
                skin:'layer_frame',
                type: 1,
                title: '<div class="disf"><div class="exclamation-circle"><span>!</span></div>信息</div>',
                area: area,
                content: html,
                end:function(res){
                    //关闭弹窗
                    layer.close(layer_frame_div);
                }
            });
        }
        //确认关闭订单
        function sure_closeOrderList(oid){
            var $ = layui.$
                , layer = layui.layer;

            layer.load();
            $.post("/cart/close_order",{'oid':oid,'_token':"{{csrf_token()}}"},function(res){
                layer.closeAll('loading');
                layer.msg(res.msg,{time:2000}, function () {
                    if (res.code == 0) {
                        window.location.reload();
                    }
                });
            },'json');
        }
        //取消关闭订单
        function cancel_closeOrderList(){
            var $ = layui.$
                , layer = layui.layer;

            layer.close(layer_frame_div);
        }
        //关闭订单=======================================================================end

        //支付订单
        function pay_orderlist(t,oid,typ){
            var $ = layui.$
                , layer = layui.layer;

            if(typ==1){
                let sku_id_length = $(t).parents(':eq(4)').find('.sku_id2');

                if(sku_id_length.length>0) {
                    let sku_ids = '';
                    let cart_ids = '';
                    let goods_ids = '';
                    let sku_nums = '';

                    for(let i=0;i<sku_id_length.length;i++){
                        if(sku_id_length.eq(i).is(':checked')==true){
                            let td4 = $(t).parents(':eq(4)').find('.sku_id2').eq(i).parents(":eq(3)").find('.td4').text();
                            td4 = td4.trim();
                            sku_nums += td4+',';
                            sku_ids += $(t).parents(':eq(4)').find('.sku_id2').eq(i).attr('data-skuid')+',';
                            cart_ids += $(t).parents(':eq(4)').find('.sku_id2').eq(i).attr('data-cart_id')+',';
                            goods_ids += $(t).parents(':eq(4)').find('.sku_id2').eq(i).attr('data-goods_id')+',';
                        }
                    }

                    if(sku_ids==''){
                        layer.msg('请选择该清单内要请求支付的商品');return false;
                    }
                    else{
                        layer.load();
                        $.post("/cart/create_order", {'oid':oid,'sku_ids':sku_ids,'cart_ids':cart_ids,'goods_ids':goods_ids,'sku_nums':sku_nums,'typ':typ, '_token': "{{csrf_token()}}"}, function (res) {
                            layer.closeAll('loading');

                            if(res.code == 0){
                                layer.msg(res.msg);
                                setTimeout(function(){
                                    window.location.reload();
                                },3000);
                            }
                        }, 'json');

                        if(1>2){
                            layer.confirm('确认要请求支付该清单吗？', {
                                btn: ['确认', '取消']
                            }, function () {
                                layer.load();
                                $.post("/cart/create_order", {'oid':oid,'sku_ids':sku_ids,'cart_ids':cart_ids,'goods_ids':goods_ids,'sku_nums':sku_nums,'typ':typ, '_token': "{{csrf_token()}}"}, function (res) {
                                    layer.closeAll('loading');
                                    // layer.msg(res.msg, {time: 2000}, function () {
                                    if(res.code == 0){
                                        layer.msg(res.msg);
                                        setTimeout(function(){
                                            window.location.reload();
                                        },3000);
                                    }
                                    else if (res.code == 10) {
                                        layer.open({
                                            type: 1,
                                            title: '请打开微信扫码进入支付',
                                            area: ['300px', '300px'],
                                            content: '<div style="padding:20px;box-sizing: border-box;text-align:center;"><img src="'+res.data.code_url+'?v=<?php echo time();?>" style="width:150px;height:150px;"><p>请打开微信扫码进入支付</p></div>',
                                            cancel:function(){
                                                window.location.reload();
                                            }
                                        });
                                    }
                                    else if (res.code == -1){
                                        //弹出公众号二维码框
                                        let area = ['320px', '320px'];
                                        // if (IsPhone()) {
                                        //     area = ['90%', '60%'];
                                        // }
                                        layer.open({
                                            skin: 'grey_div',
                                            type: 1,
                                            title: '进入“Gogo購購网”微信小程序并关注公众号',
                                            area: area,
                                            content: '<div style="padding:10px;box-sizing:border-box;text-align: center;color:#000;"><img src="/images/gogo_miniprogram.png" style="max-width:150px;width:100%;margin-bottom:10px;"><p class="f15" style="font-size: 15px;">为了提供更多的服务，请登录小程序并关注我司公众号“Gogo購購网”</p><br/><p style="font-size:15px;" class="f15">完成上述操作后，请手动刷新页面</p></div>'
                                        });
                                    }
                                    // });
                                }, 'json');
                            }, function () {

                            });
                        }
                    }
                }
            }
            else if(typ==2){
                //扫码支付（在收银台做）
                layer.load();
                $.post("/cart/create_order", {'oid':oid,'typ':typ, '_token': "{{csrf_token()}}"}, function (res) {
                    layer.closeAll('loading');
                    // layer.msg(res.msg, {time: 2000}, function () {
                    if (res.code == 0) {
                        layer.open({
                            type: 1,
                            title: '请打开微信扫码进入支付',
                            area: ['300px', '300px'],
                            content: '<div style="padding:20px;box-sizing: border-box;text-align:center;"><img src="'+res.data.code_url+'?v=<?php echo time();?>" style="width:150px;height:150px;"><p>请打开微信扫码进入支付</p></div>'
                        });
                    }
                    // });
                }, 'json');
            }
        }
        //已购清单操作==========================================================END

        //显示当前项目
        function showThisProject(t,title){
            var $ = layui.$
                , form = layui.form
                , layer = layui.layer;

            let idx = layer.open({
                type:1,
                title:title,
                area:['600px','500px'],
                content:$(t).find('.projectDiv'),
                end:function(){
                    $('.layui-layer-shade').remove();
                    // layer.close(idx);
                }
            });
        }
    </script>
</div>

@include('layouts.common_function')
@include('layouts.footer')
{{--<script>--}}
{{--    $(function(){--}}
{{--        if("{{session('user.user_id')}}" ==''){--}}
{{--            $.login.show();--}}
{{--        }--}}
{{--    });--}}
{{--</script>--}}

