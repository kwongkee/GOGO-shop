<link rel="stylesheet" href="/assets/d2eace91/layui/css/layui.css?v=23121"/>
<link rel="stylesheet" href="/assets/d2eace91/js/layer/theme/default/layer.css?v=3.1.0" id="layuicss-layer">
<script type="text/javascript" src="/assets/d2eace91/layui/layui.js"></script>
<style>
    #content{padding-top:100px;}
    .cart-content{min-height:600px;margin-bottom:60px;margin-top:0px;}
    .cart-empty{width:100%;}
    .cart-empty .message{text-align: center;padding-top: 15%;}
    .cart-empty .message img{width:180px;}
    .cart-empty .message .txt{font-size:20px;font-weight: 600;margin-top:15px;}
    .cart-empty .message .btn-link{font-size:18px;font-weight: 600;background:{{$website['color']}};color:{{$website['color_word']}};border-radius:15px;padding:5px 20px;box-sizing: border-box;}

    @if($isframe==1)
        /*内置框打开*/
        .header,.footer{display: none;}
        .w1200{width: 100%;}
    @endif
    /**+/-框**/
    .amount-input {color: #666;font-size: 12px;margin: 0;margin-top: 1px;padding: 3px;display: inline-block;height: 24px;border: 1px solid #a7a6ac;width: 50px;line-height: 24px;vertical-align: middle;}
    .amount-btn {display: inline-block;vertical-align: middle;margin-left: -0.8px;margin-top: 1px;}
    .amount-btn i {width: 16px;height: 16px;font-size: 12px;color: #666;display: inline-block;line-height: 12px;}
    .amount-plus {width: 16px;height: 16px;overflow: hidden;cursor: pointer;border: 1px solid #a7a6ab;border-left: none;display: block;line-height: 14px;text-align: center;background: #f1f1f1;}
    .amount-minus {width: 16px;height: 16px;overflow: hidden;cursor: pointer;border: 1px solid #a7a6ab;border-left: none;border-top: none;display: block;line-height: 14px;text-align: center;background: #f1f1f1;}
    .amount-unit {vertical-align: middle;margin-left: 5px;}


    a {-webkit-text-decoration-skip: objects;background-color: transparent;}
    *,:after,:before {-webkit-box-sizing: border-box;box-sizing: border-box}
    ol,ul {list-style: none;margin: 0;padding: 0}
    li {margin-left: 0}
    hr {border: solid #e5e5e5;border-width: 1px 0 0}
    a {text-decoration: none}
    .next-btn.next-btn-normal:hover {background-color: #fff;color: {{$website['color_word']}};cursor:pointer;}
    .ctf-lib-address-picker-popup li,.ctf-lib-address-picker-popup ol,.ctf-lib-address-picker-popup ul {list-style: none;margin: 0;padding: 0}
    .ctf-lib-shipping-address-list .ok-cancel-btn-group .next-btn+.next-btn {margin-left: 8px}
    .cart-tab--container--Mp2ibji {padding: 5px 20px;margin:0 -20px;position: relative;background:{{$website['color']}};}
    .cart-tab--container--Mp2ibji .disfbox{width:100%;justify-content: space-between;}
    .cart-tab--container--Mp2ibji .left_title{color: {{$website['color_word']}};font-size: 20px;font-weight: 800;}
    .cart-tab--container--Mp2ibji .right_title a{color: {{$website['color_word']}};font-size: 15px;font-weight: 800;}
    .cart-tab--tabsWrapper--X_97uZl .next-tabs-tab{display: inline-block;cursor:pointer;}
    .cart-tab--tabsWrapper--X_97uZl .next-tabs-tab .next-tabs-tab-inner {font-size: 16px;padding: 0;font-weight: 400;color:#000;}
    .cart-tab--tabsWrapper--X_97uZl .next-tabs-tab.active {font-weight: 800;}
    .cart-tab--tabsWrapper--X_97uZl .next-tabs-tab.active .next-tabs-tab-inner {font-size: 16px;font-weight:800;color: {{$website['color_word']}};}
    .cart-tab--tabsWrapper--X_97uZl .next-tabs-tab:not(:last-child) {margin-right: 20px;}
    .cart-tab--tabsWrapper--X_97uZl .next-tabs-tab:not(:last-child):after {display: none}
    .cart-tab--remainWrapper--Ad_Lfpg {font-size: 12px;text-align: right}
    .cart-tab--remainWrapper--Ad_Lfpg .cart-tab--addressWrapper--fVnyBG0 {-webkit-box-align: center;-ms-flex-align: center;-webkit-align-items: center;align-items: center;border: 1px solid #e1e1e1;border-radius: 30px;color: #666;display: -webkit-inline-box;display: -webkit-inline-flex;display: -ms-inline-flexbox;display: inline-flex;font-size: 12px;height: 24px;margin-right: 12px;max-width: 300px;padding: 0 12px;vertical-align: middle}
    .cart-tab--remainWrapper--Ad_Lfpg .cart-tab--addressWrapper--fVnyBG0 .cart-tab--addressIcon--zf51JtM {height: 15px;margin-right: 6px;width: 13px}
    .cart-tab--remainWrapper--Ad_Lfpg .cart-tab--addressWrapper--fVnyBG0 .cart-tab--address--lPoSyY1 {cursor: pointer;overflow: hidden;text-overflow: ellipsis;white-space: nowrap}
    .cart-tab--remainWrapper--Ad_Lfpg .cart-tab--addressWrapper--fVnyBG0 .cart-tab--addressModify--SVJE0Yf {margin-left: 6px;cursor: pointer;}
    .header-bar--container--XmK_Sks {padding: 5px 0;}
    .header-bar--table--qVDj5tO {border-collapse: collapse;border-spacing: 0;table-layout: fixed;width: 100%}
    .header-bar--table--qVDj5tO th {color: {{$website['color_head']}};font-size: 15px;font-weight: 800;}
    .nobuy_div{margin-bottom: 140px;}
    .nobuy_div .tui-sticky-view{position: fixed;bottom: 6%;left: 50%;width: 100%;transform: translate(-50%, 0);max-width: 1200px;box-shadow: 0px 0px 10px 1px #ccc;}
    .albuy_div .header-bar--table--qVDj5tO th {color: {{$website['color_head']}};font-size: 15px;font-weight: 800;text-align:center;}
    .closebuy_div .header-bar--table--qVDj5tO th {color: {{$website['color_head']}};font-size: 15px;font-weight: 800;text-align:center;}
    .header-bar--colCheckbox--pDopfHb {text-align: left;width: 114px}
    .header-bar--colGoods--Sk6Gd9f {text-align: left}
    .header-bar--colQuantity--bw3tRQ5 {text-align: center;width: 216px}
    .header-bar--colPublishPrice--cXZm1e1 {text-align: center;width: 160px}
    .header-bar--colRebatePrice--Z06W3Wy {text-align: center;width: 150px}
    .header-bar--colSubtotal--EVTzgzQ {text-align: right;width: 150px}
    .shop-container--container--_pNFLjq {background: #fff;border-radius: 4px;margin-bottom: 16px;padding: 10px 20px}
    .shop-container--container--_pNFLjq:first-of-type {border-top-left-radius: 0;border-top-right-radius: 0}
    .tag--textWrapper--t7pf3mr {border: 1px solid transparent;border-radius: 2px;font-size: 10px;line-height: 10px;margin-left: 12px;padding: 1px 3px;text-decoration: none}
    .shop-top--container--GWvjt50 {background-color: #fff;padding: 12px 0;position: relative}
    .shop-top--companyWrapper--Nng6NUE>* {vertical-align: middle}
    .shop-top--companyWrapper--Nng6NUE label.next-checkbox-wrapper {margin-bottom:0;}
    .shop-top--companyWrapper--Nng6NUE .shop-top--companyName--xT5dktx {color: {{$website['color_word']}};font-size: 16px;margin-left: 12px;font-weight:800;}
    .shop-top--companyWrapper--Nng6NUE .shop-top--companyName--xT5dktx:hover {color: #ff4000;}
    .shop-top--marketingWrapper--RU32iwK .shop-top--marketingItem--ZwQxh06>* {display: inline-block;vertical-align: middle;}
    .item-group-container--container--fFsBi_O {margin: 0 -20px;padding: 0 20px;position: relative;}
    .item-group-container--container--fFsBi_O:not(:last-child) {border-bottom: 1px solid {{$website['color']}};margin-bottom: 16px;}
    .item-group-container--container--fFsBi_O .item-group-container--table--ESEGhi1 {border-collapse: collapse;border-spacing: 0;width: 100%}
    .item-group--container--Eu9kRqK {border-bottom: 0;}
    .item-group--colMainImage--e1B_lrM {text-align: left;vertical-align: top;width: 114px}
    .item-group--checkbox--nJ766h2 {display: inline-block;vertical-align: middle}
    .item-group--imageWrapper--gzJGxq1 {display: inline-block;margin: 0 12px;position: relative}
    .item-group--lazyLoad--PcwxEeF {display: inline-block;height: 70px;vertical-align: middle;width: 70px}
    .item-group--image--swD89NA {border-radius: 6px;height: 70px;width: 70px}
    .item-group--container--Eu9kRqK .item-group--title--F09mZrH {color: #000;font-size: 14px;vertical-align: middle;margin-left:10px;font-weight: 800;}
    .item-group--container--Eu9kRqK .item-group--title--F09mZrH:hover {color: #db1d18;}
    .item-group-bottom--holder--_utX5Td {min-height: 28px}
    .item-group-bottom--iconWrapper--i4C7pkG {background: #e5e2e2;border-top-left-radius: 4px;bottom: 0;padding: 3px 12px 6px;position: absolute;right: 0;text-align: right}
    .item-group-bottom--icon--awHT1gq {color: #999;cursor: pointer;padding: 0 8px;}
    .item-group-bottom--icon--awHT1gq:hover {color: #ff4000}
    .ctf-lib-multiple-sku-chooser .chooser-footer .next-btn+.next-btn {margin-left: 16px}
    .item--container--SrhZkVY {border-bottom: 16px solid #fff}
    .item--colQuantity--X6jdFO1 {text-align: center;width: 216px}
    .item--colPublishPrice--_Gft88l {text-align: center;width: 160px}
    .item--colRebatePrice--s5tKrMS {text-align: center;width: 150px}
    .item--colSubtotal--wD06b01 {text-align: right;width: 150px}
    .item--title--eq76Cm2 {background: #E3E6EB;border-radius: 4px;color: #333;display: inline-block;line-height: 16px;margin-left: 12px;min-height: 30px;padding: 7px 9px;vertical-align: middle;width: calc(100% - 70px);font-weight: 800;}
    .item--cellInner--xofTwaC {position: relative}
    .item--removeIcon--pj7ZyCY {color: #999;cursor: pointer;margin-left:10px;}
    .item--removeIcon--pj7ZyCY:hover {color: #ff4000}
    .item--publishPrice--ds7q4ew {color: #000;font-size: 14px;vertical-align: middle;font-weight: 800;}
    .item--publishPrice--ds7q4ew .interval_priceAct{color: #e60000;font-weight: 800;}
    .item--rebatePrice--KX1m_fR {color: #000;font-size: 14px;vertical-align: middle;font-weight: 800;}
    .item--tag--bxwoXm0 {display: inline-block;font-size: 12px;margin-top: 4px;vertical-align: middle}
    .item--subtotal--AUSnMtU {color: #db1d18;font-size: 14px;font-weight: 800;}
    .item--discount--IYDEYjd {color: #999;font-size: 12px}
    .invalid-container--container--LXOIevf {background: #fff;border-radius: 4px;margin-bottom: 20px}
    .invalid-bar--buttonWrapper--jQnPM7Y .next-btn-text.next-btn-normal {color: #666}
    .invalid-bar--buttonWrapper--jQnPM7Y .next-btn-text.next-btn-normal:hover {color: #ff4000}
    .bottom-bar--content--ui2fFlT {background-color: #fff;min-height: 70px;padding: 0 20px}
    .bottom-bar--content--ui2fFlT:after {clear: both;content: ".";display: block;height: 0;visibility: hidden}
    .bottom-bar--leftPanel--debjZit {float: left;padding-top: 20px}
    .bottom-bar--leftPanel--debjZit .bottom-bar--item--AyQVTr2 {margin-right: 12px}
    .bottom-bar--leftPanel--debjZit .bottom-bar--selectAll--nzlGkkE {margin-right: 30px}
    .bottom-bar--rightPanel--jGm5nNN {float: right}
    .bottom-bar--rightPanel--jGm5nNN .bottom-bar--item--AyQVTr2 {color: #000;font-size: 14px;margin-left: 24px;font-weight: 800;}
    .bottom-bar--rightPanel--jGm5nNN .bottom-bar--infoPanel--i5APR7t {display: inline-block;padding: 10px 0;vertical-align: top}
    .bottom-bar--rightPanel--jGm5nNN .bottom-bar--totalInfoOnly--b1aXwS6 {padding-top: 6px}
    .bottom-bar--rightPanel--jGm5nNN .bottom-bar--operationPanel--jELCo_1 {display: inline-block;padding: 14px 10px 14px 30px;vertical-align: top}
    .bottom-bar--rightPanel--jGm5nNN .bottom-bar--miscInfo--BNsiZLi .bottom-bar--totalWrapper--avZUWMQ>span {margin-right: 4px}
    .bottom-bar--textStress--C9muI9c {color: #db1d18;}
    .bottom-bar--totalPrice--J_WgGrQ {font-size: 24px;margin-left: 4px}
    .bottom-bar--totalPrice--J_WgGrQ .bottom-bar--cny--nONvixX {font-size: 12px}
    .bottom-bar--submitBtn--i_YrJri {width: 90px;cursor:pointer;}
    .cart--container--RtFTPfu {margin: 0px auto;width: 1200px}
    .cart--header--ow5WRyV {background: {{$website['color']}};border-radius: 0;padding: 0 20px;border:1px solid {{$website['color_word']}};}
    .cart--header--ow5WRyV .select_div{margin: 0 -20px;padding: 0 20px;border-top:1px solid {{$website['color_word']}};}
    .cart--content--F6tqhN2 {position: relative}

    .item-group--colMainImage--e1B_lrM .ordersn{font-size: 14px;margin-left: 0px;font-weight: 500;color: #333;}

    /**其他费用信息**/
    .otherInfo{padding:2px 5px;border:1px solid #dfdede;border-bottom:0;width:fit-content;cursor:pointer;float:left;}
    .otherInfo .projectName{font-size:14px;}
    .otherInfo .gantan{width:18px;margin-left:5px;}
    .otherInfo .projectDiv{display:none;padding:15px;}

    /*原价&现价*/
    .service_tab .origin_price{color:#666;}
    .service_tab .now_price{color:#e60000;}

    /*清单*/
    .albuy_div .order_listDiv{margin-bottom:0px;border-bottom:1px dashed #b1b1b1;}
    .albuy_div .order_listDiv:last-child{border:0;}
    .albuy_div .item-group-container--container--fFsBi_O:not(:last-child){border-bottom:1px dashed {{$website['color']}};}
    .ordersn{font-size: 15px;font-weight: 800;}
    .td1{width:20%;text-align: center;font-size: 15px;font-weight: 800;color:#000;}
    .td2,.td3{width:20%;text-align: center;font-size: 15px;color:#000;}
    .td2 .currency,.td2 .price{color:#db1d18;font-weight:800;}
    .td4{width:20%;text-align: center;font-size: 15px;font-weight: 800;color:#000;}
    .td5{width:100%;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;font-size: 15px;font-weight: 400;color:#000;}
    .td6{width:150px;font-size: 15px;font-weight: 800;color:#000;}
    .btn_group{padding:3px 10px;box-sizing: border-box;text-align: center;white-space: nowrap;cursor:pointer;width:fit-content;margin: 0 auto;}
    .sure_btn{background:#e60000;color:#fff;margin-right:8px;}
    .view_btn{background:{{$website['color']}};color:{{$website['color_word']}};border:1px solid {{$website['color_word']}};}
    .view_btn:hover{color:{{$website['color_word']}} !important;}
    .view_btn:active{color:{{$website['color_word']}} !important;}

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
    .not_selpay{background:#e3e3e3;color:#fff;}
    .alr_selpay{background:#e60000;color:#fff;}
    .close_orderlist{background:{{$website['color']}};color:#fff;margin-left:15px;}

    @media (max-width: 992px){
        .w1210,.cart--container--RtFTPfu{width: 100%;}
        body{min-width: 100%;}
        ul.next-tabs-nav{display: flex;align-items: center;}
        .header-bar--colCheckbox--pDopfHb{width: 100px;}
        .header-bar--colGoods--Sk6Gd9f{width: 60px;}
        .header-bar--colQuantity--bw3tRQ5{width: 60px;}
        .header-bar--colPublishPrice--cXZm1e1{width: 60px;}
        .header-bar--colSubtotal--EVTzgzQ{width: 60px;}
        @if($selected==1 || $selected==3)
            .header-bar--colCheckbox--pDopfHb {width: 80px;}
            .header-bar--colPublishPrice--cXZm1e1{width: 70px;}

            .td1,.td5,.td2,.td3,.td4{width: 100%;text-align: left;}
            .td4{text-align: center;margin-top:10px;}
            tr.item-group--container--Eu9kRqK{padding-bottom: 15px;border-bottom: 1px solid #000;}
            tr.item-group--container--Eu9kRqK{display: grid;grid-template-columns: 1fr;}
        @endif
        tr.item--container--SrhZkVY{display: grid;grid-template-columns: 1fr;}
        .item--title--eq76Cm2{width: calc(100% - 30px);}
        .amount-input{width:105px;}
        .item--colQuantity--X6jdFO1{margin-top:10px;}
        .item--colPublishPrice--_Gft88l{width: 100%;margin-top:10px;}
        .item--colSubtotal--wD06b01 {text-align: center;width: 100%;margin-top:10px;border-bottom:1px solid {{$website['color_word']}};}
        .item-group-bottom--holder--_utX5Td {min-height: 0;}

        /*浮框*/
        .nobuy_div .tui-sticky-view{max-width: 100%;left:unset;transform:unset;}
        .bottom-bar--rightPanel--jGm5nNN{display: flex;justify-content: space-between;width: 100%;}
        .bottom-bar--rightPanel--jGm5nNN .bottom-bar--totalInfoOnly--b1aXwS6 {padding-top: 0;white-space: nowrap;}
        .bottom-bar--rightPanel--jGm5nNN .bottom-bar--item--AyQVTr2{margin-left:0;}
        .bottom-bar--rightPanel--jGm5nNN .bottom-bar--operationPanel--jELCo_1{padding:10px 0px  0 10px;}
        .bottom-bar--totalPrice--J_WgGrQ{font-size:18px;}
    }
</style>
<div class="cart-content">
    <form class="layui-form" action="" method="post" lay-filter="glist-element">
        <div class="cart--container--RtFTPfu">
            <div class="cart--header--ow5WRyV">
                <div dir="ltr" role="row" class="next-row next-row-align-center cart-tab--container--Mp2ibji disf" style="justify-content: space-between;">
                    <!--内页名称-->
                    <div class="disf disfbox">
                        <div class="left_title">
                            @if($selected==0)
                                <span style="font-size:22px;margin-right:5px;">①</span><span>选购中心</span>
                            @else
                                <span style="font-size:22px;margin-right:5px;">②</span><span>订购中心</span>
                            @endif
                        </div>
                        <div class="right_title">
                            @if($selected==1 || $selected==3)
                                <a href="/cart.html?selected=0" target="_blank">选购中心</a>
                            @else
                                <a href="/cart.html?selected=1" target="_blank">订购中心</a>
                            @endif
                        </div>
                    </div>
                    @if(count($cart) > 0)
                        <!--收货地址（废弃）-->
                        <div dir="ltr" role="gridcell" class="next-col cart-tab--remainWrapper--Ad_Lfpg" style="display: none;">
                            <div class="cart-tab--addressWrapper--fVnyBG0">
                                <img class="cart-tab--addressIcon--zf51JtM" src="/assets/d2eace91/images/newhome/location.png" alt="地址图标">
                                <span class="cart-tab--address--lPoSyY1" title="{{$default_address}}">发货至：{{$default_address}}</span>
                                <input type="hidden" name="address_id" value="{{$address_id}}">
                                <div class="next-btn next-medium next-btn-primary next-btn-text cart-tab--addressModify--SVJE0Yf" style="white-space: nowrap;color: #e60000;" onclick="change_address(this)">
                                    <span class="next-btn-helper">更改</span>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div dir="ltr" role="row" class="next-row next-row-align-center cart-tab--container--Mp2ibji2 disf" style="justify-content: space-between;padding: 5px 0;box-sizing: border-box;">
                    <!--头部切换-->
                    <div dir="ltr" role="gridcell" class="next-col next-col-fixed-12 cart-tab--tabsWrapper--X_97uZl">
                        <div class="next-tabs next-tabs-text next-tabs-scrollable next-medium">
                            <div class="next-tabs-bar">
                                <div class="next-tabs-nav-container">
                                    <div class="next-tabs-nav-wrap">
                                        <div class="next-tabs-nav-scroll">
                                            <ul role="tablist" class="next-tabs-nav">
                                                @if($selected==0)
                                                    <!--选购中心-->
                                                    <li class="next-tabs-tab @if($selected==0)
                                                            active
                                                        @endif" onclick="change_window(0,this)">
                                                        <div class="next-tabs-tab-inner window0">已选购({{$cart_num}})</div>
                                                    </li>
                                                    <li class="next-tabs-tab @if($selected==2)
                                                            active
                                                        @endif" onclick="change_window(2,this)">
                                                        <div class="next-tabs-tab-inner window2">已关闭({{$cart_closenum}})</div>
                                                    </li>
                                                @endif

                                                @if($selected==1 || $selected==3)
                                                    <!--订购中心-->
                                                    <li class="next-tabs-tab @if($selected==1)
                                                            active
                                                        @endif" onclick="change_window(1,this)">
                                                        <div class="next-tabs-tab-inner window1">待结算({{$cart_buynum_nopay}})</div>
                                                    </li>
                                                    <li class="next-tabs-tab @if($selected==3)
                                                            active
                                                        @endif" onclick="change_window(3,this)">
                                                        <div class="next-tabs-tab-inner window3">已结算({{$cart_buynum}})</div>
                                                    </li>
                                                    <li class="next-tabs-tab @if($selected==2)
                                                            active
                                                        @endif" onclick="change_window(2,this)">
                                                        <div class="next-tabs-tab-inner window2">已关闭({{$cart_closenum}})</div>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if(count($cart) > 0)
                    <!--头部thead-->
                    <div class="select_div">
                        <div class="header-bar--container--XmK_Sks head0">
                            <table class="header-bar--table--qVDj5tO">
                                <thead>
                                <tr>
                                    <th class="header-bar--colCheckbox--pDopfHb">
                                        <label class="next-checkbox-wrapper ">
                                            <span class="next-checkbox">
                                                <input type="checkbox" class="next-checkbox-input all_select all_select1" value="" onclick="all_select(this)" lay-ignore>
                                            </span>
                                            <span class="next-checkbox-label" style="font-weight: 800;">全选</span>
                                        </label>
                                    </th>
                                    <th class="header-bar--colGoods--Sk6Gd9f">名称</th>
                                    <th class="header-bar--colQuantity--bw3tRQ5">数量</th>
                                    <th class="header-bar--colPublishPrice--cXZm1e1">单价</th>
    {{--                                <th class="header-bar--colRebatePrice--Z06W3Wy">优惠价</th>--}}
                                    <th class="header-bar--colSubtotal--EVTzgzQ">小计</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
            <div class="nobuy_div">
                @if(count($cart) > 0)
                    <!--清单信息不为空-->
                    <div class="cart--content--F6tqhN2">
                        <div style="display: block;">
                            <div>
                                <div>
                                    @foreach($cart as $shop_id=>$cart_list)
                                        <div class="shop-container--container--_pNFLjq">
                                            <div class="shop-top--container--GWvjt50">
                                                <div class="shop-top--companyWrapper--Nng6NUE">
                                                    <label class="next-checkbox-wrapper ">
                                                        <span class="next-checkbox">
                                                            <input type="checkbox" name="shop_id[]" class="next-checkbox-input all_select shop_id" value="" onclick="box_select(this,1)" lay-ignore>
                                                        </span>
                                                    </label>
                                                    @if(isset($cart_list[0]['shop_info']['company']))
                                                        <a class="shop-top--companyName--xT5dktx" href="#" target="_blank">{{ $cart_list[0]['shop_info']['company'] }}</a>
                                                    @elseif(isset($cart_list[0]['goods_info']['other_shop']['shopName']) && !empty($cart_list[0]['goods_info']['other_shop']['shopName']))
                                                        <a class="shop-top--companyName--xT5dktx" href="#" target="_blank">{{ $cart_list[0]['goods_info']['other_shop']['shopName'] }}</a>
                                                    @else
                                                        <a class="shop-top--companyName--xT5dktx" href="#" target="_blank">淘中国</a>
                                                    @endif
                                                </div>
                                            </div>
                                            @foreach($cart_list as $v)
                                                <div class="item-group-container--container--fFsBi_O">
                                                    <table class="item-group-container--table--ESEGhi1">
                                                        <tbody>
                                                        <tr class="item-group--container--Eu9kRqK">
                                                            <td class="item-group--colMainImage--e1B_lrM" rowspan="<?php echo count($v['sku_info'])+1;?>">
                                                                <div class="ordersn">{{$v['ordersn']}}</div>

                                                                <label class="next-checkbox-wrapper item-group--checkbox--nJ766h2">
                                                            <span class="next-checkbox">
                                                                <input type="checkbox" name="goods_id[]" data-id="{{$v['goods_id']}}" data-cart_id="{{$v['cart_id']}}" class="next-checkbox-input all_select goods_id" value="" onclick="box_select(this,2)" lay-ignore>
                                                            </span>
                                                                </label>
                                                                <a class="item-group--imageWrapper--gzJGxq1" href="/goods-{{$v['goods_id']}}.html" target="_blank">
                                                                    <div class="lazyload-wrapper item-group--lazyLoad--PcwxEeF">
                                                                        <div class="fancy-image item-group--image--swD89NA" style="overflow: hidden; width: 70px; height: 70px;">
                                                                            <img src="@if(isset($v['shop_info']['shop_name']))
                                                                            {{ get_image_url($v['goods_info']['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220
                                                                    @else
                                                                            {{ $v['goods_info']['goods_image'] }}?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220
                                                                    @endif" style="visibility: visible; display: block; margin-left: 0px; width: 70px; height: 70px;">
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </td>
                                                            <td colspan="5">
                                                                <a class="item-group--title--F09mZrH" href="/goods-{{$v['goods_id']}}.html" target="_blank">{{$v['goods_info']['goods_name']}}</a>
                                                                <span title="删除" class="next-icon next-icon-delete next-small item-group-bottom--icon--awHT1gq">
                                                                        <img src="/assets/d2eace91/images/newhome/delete.png" alt="" onclick="del(this,1,{{$v['cart_id']}},0)" style="width:18px;">
                                                                    </span>
                                                            </td>
                                                        </tr>
                                                        @foreach($v['sku_info'] as $k2=>$v2)
                                                            <tr class="item--container--SrhZkVY">
                                                                <td>
                                                                    <label class="next-checkbox-wrapper item--checkbox--d8yvJ9v ">
                                                                <span class="next-checkbox">
                                                                    <input type="checkbox" name="sku_id[]" data-gid="{{$v['goods_id']}}" data-id="{{$v2['sku_id']}}" data-sku_id="{{$v2['id']}}" data-cart_id="{{$v2['cart_id']}}" class="next-checkbox-input all_select sku_id" value="" onclick="box_select(this,3)" lay-ignore>
                                                                </span>
                                                                    </label>
                                                                    @if(!empty($v2['info']['spec_names']))
                                                                        <div class="item--title--eq76Cm2" title="{{$v2['info']['spec_names']}}">{{$v2['info']['spec_names']}}</div>
                                                                    @endif
                                                                </td>
                                                                <td class="item--colQuantity--X6jdFO1">
                                                                    <div class="item--cellInner--xofTwaC disf" style="justify-content: center;">
                                                                <span class="amount-widget" style="display:flex;">
                                                                    <input type="text" name="buynum[]" class="amount-input buynum" value="{{$v2['goods_num']}}" data-amount-min="1" data-amount-max="100" maxlength="8" title="请输入购买量" onchange="buynum(this)">
                                                                    <span class="amount-btn">
                                                                         <span class="amount-plus" onclick="add_num(this,100)">
                                                                            <i>+</i>
                                                                         </span>
                                                                        <span class="amount-minus" onclick="reduction_num(this)">
                                                                            <i>-</i>
                                                                        </span>
                                                                    </span>
                                                                </span>
                                                                        <span title="删除" class="next-icon next-icon-delete next-small item--removeIcon--pj7ZyCY" style="font-weight: 800;">
                                                                    <img src="/assets/d2eace91/images/newhome/delete.png" alt="" onclick="del(this,0,{{$v2['cart_id']}},{{$v2['info']['sku_id']}})" style="width:18px;">
                                                                </span>
                                                                    </div>
                                                                </td>
                                                                <td class="item--colPublishPrice--_Gft88l">
                                                                    <div class="item--publishPrice--ds7q4ew">
                                                                    @if(count($v2['info']['sku_prices']['price']) > 1)
                                                                        <!--区间价格-->
                                                                            @foreach($v2['info']['sku_prices']['price'] as $k3=>$v3)
                                                                                <p class="@if($k3==$v2['info']['sku_prices']['target_key'])
                                                                                        interval_priceAct
@else
                                                                                        interval_price
@endif">
                                                                                    @if($v2['info']['sku_prices']['select_end'][$k3]==1)
                                                                                        {{$v2['info']['sku_prices']['start_num'][$k3]}}-{{$v2['info']['sku_prices']['end_num'][$k3]}}{{$v2['info']['sku_prices']['unit'][0]}}
                                                                                    @elseif($v2['info']['sku_prices']['select_end'][$k3]==2)
                                                                                        {{$v2['info']['sku_prices']['start_num'][$k3]}}{{$v2['info']['sku_prices']['unit'][0]}}以上
                                                                                    @endif
                                                                                    {{$v2['info']['sku_prices']['currency'][0]}} <?php echo number_format($v3, 2);?>
                                                                                </p>
                                                                            @endforeach
                                                                        @else
                                                                        <!--单格-->
                                                                            {{$v2['info']['sku_prices']['currency'][0]}} {{number_format($v2['info']['sku_prices']['price'][0],2)}}
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                                <td class="item--colRebatePrice--s5tKrMS" style="display: none;">
                                                                    <div class="item--rebatePrice--KX1m_fR">
                                                                    @if(count($v2['info']['sku_prices']['price']) > 1)
                                                                        <!--区间价格-->
                                                                        @foreach($v2['info']['sku_prices']['price'] as $k3=>$v3)
                                                                            @if($k3==$v2['info']['sku_prices']['target_key'])
                                                                                {{$v2['info']['sku_prices']['currency'][0]}} {{$v3}}
                                                                            @endif
                                                                        @endforeach
                                                                    @else
                                                                        <!--单格-->
                                                                            {{$v2['info']['sku_prices']['currency'][0]}} {{$v2['info']['sku_prices']['price'][0]}}
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                                <td class="item--colSubtotal--wD06b01">
                                                                    <div class="item--subtotal--AUSnMtU">{{$v2['info']['sku_prices']['currency'][0]}} <span class="sku_price">{{$v2['price']}}</span></div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        <tr>
                                                            <td>
                                                                <div class="item-group-bottom--holder--_utX5Td"></div>
                                                            </td>
                                                            <td colspan="4">
                                                                @if(!empty($v['file']) && 1>2)
                                                                    <div class="disf otherInfo" onclick="showThisProject(this,'监管文件详情')">
                                                                        <span class="projectName">监管文件</span>
                                                                        <img src="/images/gantanhao.png" class="price_info gantan">
                                                                        <div class="projectDiv">
                                                                            <div class="gi_file_div" style="background:#fff;">
                                                                                <!--<div class="layui-btn layui-btn-normal" style="background:#d3d3d3;position:absolute;right:0;top:0;font-size: 25px;padding: 0 15px;" onclick="cancel_buy()">×</div>-->
                                                                                <div class="gi_file disf gi_border" style="margin-top:10px;">
                                                                                    <!--<div class="gi_label">文件上传</div>-->
                                                                                    <div class="gifile_info disf" style="width: 100%;">
                                                                                        <div class="layui-upload" style="text-align:left;width: 100%;">
                                                                                            <!--<button type="button" class="layui-btn" id="supervise_file-upload">上传文件</button>-->
                                                                                            <blockquote class="layui-elem-quote layui-quote-nm yulan" style="margin-top: 10px;width:100%;">
                                                                                                文件预览：
                                                                                                <div class="layui-upload-list" id="supervise_file-upload-list">
                                                                                                    @foreach($v['file'] as $fk=>$fv)
                                                                                                        <div style="display: inline-block;">
                                                                                                            <img src="https://shop.gogo198.cn/{{$fv}}" class="layui-upload-img" style="width:80px;height:80px;">
                                                                                                            <button type="button" onclick="delPic(this);" class="layui-btn layui-btn-xs layui-btn-danger" style="display:none;position: relative;left: -45px;top: -39px;">删除</button>
                                                                                                            <input type="text" name="supervise_file[]" value="{{$fv}}" style="display: none;">
                                                                                                        </div>
                                                                                                    @endforeach
                                                                                                </div>
                                                                                            </blockquote>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                @if(!empty($v['otherfee_content']) && 1>2)
                                                                    <div class="disf otherInfo" onclick="showThisProject(this,'其他费用详情')">
                                                                        <span class="projectName">其他费用：{{$v['otherfee_currency']}} {{$v['otherfee_total']}}</span>
                                                                        <img src="/images/gantanhao.png" class="price_info gantan">
                                                                        <div class="projectDiv">
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
                                                                                @foreach($v['otherfee_content']['name'] as $fk=>$fv)
                                                                                    <tr>
                                                                                        <td>{{$fv}}</td>
                                                                                        <td>{{$v['otherfee_content']['desc'][$fk]}}</td>
                                                                                        <td>{{$v['otherfee_content']['otherfee_standard_name'][$fk]}}</td>
                                                                                        <td>{{$v['otherfee_currency']}} {{$v['otherfee_content']['price'][$fk]}}</td>
                                                                                    </tr>
                                                                                @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                @if(isset($v['prefe_reduction'][0]['type']) && 1>2)
                                                                    <div class="disf otherInfo" onclick="showThisProject(this,'减免优惠详情')">
                                                                        <span class="projectName">减免优惠：- {{$v['otherfee_currency']}} {{$v['reduction_money']}}</span>
                                                                        <!--<img src="/images/gantanhao.png" class="price_info gantan">-->
                                                                        <!--<div class="projectDiv">-->
                                                                        <!--</div>-->
                                                                    </div>
                                                                @endif
                                                                @if(isset($v['prefe_gift'][0]['type']) && 1>2)
                                                                    <div class="disf otherInfo" onclick="showThisProject(this,'随赠优惠详情')">
                                                                        <span class="projectName">随赠优惠：- {{$v['otherfee_currency']}} {{$v['gift_money']}}</span>
                                                                        <img src="/images/gantanhao.png" class="price_info gantan">
                                                                        <div class="projectDiv">
                                                                            <table class="layui-table">
                                                                                <thead>
                                                                                <tr>
                                                                                    <th>优惠类别</th>
                                                                                    <th>随赠项目</th>
                                                                                    <th>随赠内容</th>
                                                                                </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                @foreach($v['prefe_gift'] as $fk=>$fv)
                                                                                    <tr>
                                                                                        <td>
                                                                                            @if($fv['operaer']==1)
                                                                                                商家优惠
                                                                                            @elseif($fv['operaer']==2)
                                                                                                平台优惠
                                                                                            @elseif($fv['operaer']==3)
                                                                                                其他优惠
                                                                                            @endif
                                                                                        </td>
                                                                                        <td>
                                                                                            @if($fv['type']==1)
                                                                                                积分
                                                                                            @elseif($fv['type']==2)
                                                                                                卡券
                                                                                            @elseif($fv['type']==3)
                                                                                                随赠（实物）
                                                                                            @endif
                                                                                        </td>
                                                                                        <td>
                                                                                            @if($fv['type']==1)
                                                                                                @if($fv['points_type']==1)
                                                                                                    按每订单/次送{{$fv['points_send']}}分
                                                                                                @elseif($fv['points_type']==2)
                                                                                                    按每{{$fv['points_currency']}}{{$fv['points_money']}}送{{$fv['points_send']}}分
                                                                                                @endif
                                                                                            @elseif($fv['type']==2)
                                                                                                价值{{$fv['coupon_currency']}}{{$fv['coupon_money']}}x{{$fv['coupon_num']}}张
                                                                                            @elseif($fv['type']==3)
                                                                                                随赠（@if($fv['accgift_type']==1)
                                                                                                    虚拟
                                                                                                @elseif($fv['accgift_type']==2)
                                                                                                    服务
                                                                                                @elseif($fv['accgift_type']==3)
                                                                                                    实物
                                                                                                @endif
                                                                                                ）*{{$fv['accgift_num']}}

                                                                                            @endif
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                @if(isset($v['services'][0]['service_id']) && 1>2)
                                                                    <div class="disf otherInfo" onclick="showThisProject(this,'更多服务详情')">
                                                                        <span class="projectName">服务费用：CNY {{$v['services_money']}}</span>
                                                                        <img src="/images/gantanhao.png" class="price_info gantan">
                                                                        <div class="projectDiv">
                                                                            <table class="layui-table">
                                                                                <thead>
                                                                                <tr>
                                                                                    <th>服务名称</th>
                                                                                    <th>服务描述</th>
                                                                                    <th style="width: 30%;">服务价格</th>
                                                                                </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                @foreach($v['services'] as $fk=>$fv)
                                                                                    <tr>
                                                                                        <td>
                                                                                            {{$fv['info']['name']}}
                                                                                        </td>
                                                                                        <td>
                                                                                            @if($fv['info']['type']==1)
                                                                                                共需{{$fv['photonum']}}件
                                                                                            @else
                                                                                                {{$fv['info']['desc']}}
                                                                                            @endif
                                                                                        </td>
                                                                                        <td>
                                                                                            @if($fv['info']['type']==1)
                                                                                                CNY {{$fv['info']['price']}} + （超过{{$fv['info']['num']}}件，每件续CNY {{$fv['info']['interval_price']}}）
                                                                                            @else
                                                                                                CNY {{$fv['info']['price']}}
                                                                                            @endif
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <div class="item-group-bottom--iconWrapper--i4C7pkG" style="display: none;">
                                                                    <span title="删除" class="next-icon next-icon-delete next-small item-group-bottom--icon--awHT1gq">
                                                                        <img src="/assets/d2eace91/images/newhome/delete.png" alt="" onclick="del(this,1,{{$v['cart_id']}},0)" style="width:18px;">
                                                                    </span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                                <div class="tui-sticky-view">
                                    <div class="">
                                        <div class="bottom-bar--content--ui2fFlT">
                                            <div class="bottom-bar--leftPanel--debjZit">
                                                <label class="next-checkbox-wrapper bottom-bar--selectAll--nzlGkkE ">
                                            <span class="next-checkbox">
                                                <input type="checkbox" class="next-checkbox-input all_select all_select2" value="" onclick="all_select(this)" lay-ignore>
                                            </span>
                                                    <span class="next-checkbox-label" style="font-weight: 800;">全选</span>
                                                </label>
                                                <div class="next-btn next-medium next-btn-normal bottom-bar--item--AyQVTr2" style="display: inline-block;padding: 0px 15px;box-sizing: border-box;border: 1px solid #000;border-radius: 15px;font-weight: 800;">
                                                    <span class="next-btn-helper" onclick="del(this,2,0)">删除<span class="delNum" style="margin-left:5px;"></span></span>
                                                </div>
                                            </div>
                                            <div class="bottom-bar--rightPanel--jGm5nNN">
                                                <div class="bottom-bar--infoPanel--i5APR7t">
                                                    <div class="bottom-bar--totalInfoOnly--b1aXwS6">
                                                        <span class="bottom-bar--item--AyQVTr2">数量总计 <span class="totalNum">0</span> 件</span>
                                                        <span class="bottom-bar--item--AyQVTr2">
                                                    共计
                                                    <span class="bottom-bar--textStress--C9muI9c bottom-bar--totalPrice--J_WgGrQ">
                                                        <span class="bottom-bar--cny--nONvixX">CNY</span> <span class="totalMoney">0.00</span>
                                                    </span>
                                                </span>
                                                    </div>
                                                </div>
                                                <div class="bottom-bar--operationPanel--jELCo_1">
                                                    <div class="next-btn next-large next-btn-primary bottom-bar--submitBtn--i_YrJri">
                                                        <span class="next-btn-helper" style="padding: 5px 20px;border: 1px solid {{$website['color_word']}};background: {{$website['color']}};color: {{$website['color_word']}};line-height: 32px;font-weight:800;" onclick="buy_goods()">立即购买</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <!--清单信息为空-->
                    <div class="cart-empty">
                        <div class="message">
                            <ul>
                                <li><img src="/images/no_cart_data.png" alt=""></li>
                                <li class="txt">选购中心还是空空的呢，快去看看心仪的商品吧~</li>
                                <li style="margin-top:15px;">
                                    <a href="/" class="btn-link" title="去购物">去购物></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                @endif
            </div>

            <!--已订购-->
            <div class="albuy_div" style="display:none;">
                <!--已订购-->
                <div class="cart--header--ow5WRyV">
                    <div>
                        <div class="header-bar--container--XmK_Sks head1">
                            <table class="header-bar--table--qVDj5tO">
                                <thead>
                                <tr>
                                    <th class="header-bar--colCheckbox--pDopfHb">清单编号</th>
                                    <th class="header-bar--colPublishPrice--cXZm1e1">商品名称</th>
                                    <th class="header-bar--colPublishPrice--cXZm1e1">清单总额</th>
                                    <th class="header-bar--colPublishPrice--cXZm1e1">创建时间</th>
                                    <th class="header-bar--colSubtotal--EVTzgzQ">操作</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="cart--content--F6tqhN2">
                    <div style="display: block;">
                        <div>
                            <div>
                                @foreach($cart_buylist as $key=>$cart_list)
                                    <div class="order_listDiv">
                                        <!--商品信息-->
                                        <div class="shop-container--container--_pNFLjq" style="margin-bottom:0;">
                                            <div class="item-group-container--container--fFsBi_O">
                                                <table class="item-group-container--table--ESEGhi1">
                                                    <tbody>

                                                        <tr class="item-group--container--Eu9kRqK">
                                                            <td class="td1">
                                                                <label class="next-checkbox-wrapper ">
                                                                    <span class="next-checkbox">
                                                                       {{$cart_list['ordersn']}}
                                                                    </span>
                                                                </label>
                                                            </td>
                                                            <td class="td5" title="{{$cart_list['content']['goods_info'][0]['goods_info']['goods_name']}}">
                                                                {{$cart_list['content']['goods_info'][0]['goods_info']['goods_name']}}
                                                            </td>
                                                            <td class="td2">
                                                                <span class="currency">CNY</span>&nbsp;<span class="price">{{$cart_list['true_money']}}</span>
                                                            </td>
                                                            <td class="td3">
                                                                <?php echo date('Y-m-d H:i:s', $cart_list['createtime']);?>
                                                            </td>
                                                            <td class="td4">
                                                                <a class="view_btn btn_group" href="/cart/cart_detail?id={{$cart_list['id']}}" target="_blank">查看详情</a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--已关闭-->
            <div class="closebuy_div" style="display: none;">
                <!--已关闭-->
                <div class="cart--header--ow5WRyV">
                    <div>
                        <div class="header-bar--container--XmK_Sks head1">
                            <table class="header-bar--table--qVDj5tO">
                                <thead>
                                <tr>
                                    <th class="header-bar--colCheckbox--pDopfHb">清单编号</th>
                                    <th class="header-bar--colPublishPrice--cXZm1e1">清单总额</th>
                                    <th class="header-bar--colPublishPrice--cXZm1e1">创建时间</th>
                                    <th class="header-bar--colSubtotal--EVTzgzQ">操作</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="cart--content--F6tqhN2">
                    <div style="display: block;">
                        <div>
                            <div>
                                <?php $totalpiece = 0;?>
                                @foreach($cart_closelist as $key=>$cart_list)
                                    <div class="order_listDiv">
                                        <!--商品信息-->
                                        <div class="shop-container--container--_pNFLjq" style="margin-bottom:0;">
                                            <div class="item-group-container--container--fFsBi_O">
                                                <table class="item-group-container--table--ESEGhi1">
                                                    <tbody>

                                                        <tr class="item-group--container--Eu9kRqK">
                                                            <td class="td1">
                                                                <label class="next-checkbox-wrapper ">
                                                                    <span class="next-checkbox">
                                                                       {{$cart_list['ordersn']}}
                                                                    </span>
                                                                </label>
                                                            </td>
                                                            <td class="td2">
                                                                {{$cart_list['true_money']}}
                                                            </td>
                                                            <td class="td3">
                                                                <?php echo date('Y-m-d H:i:s', $cart_list['createtime']);?>
                                                            </td>
                                                            <td class="td4">
                                                                <a class="view_btn btn_group" href="/cart/cart_detail?id={{$cart_list['id']}}" target="_blank">查看详情</a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">
    layui.use(['layer','element','upload','form'],function() {
        var $ = layui.$
            , layer = layui.layer
            , element = layui.element
            , form = layui.form
            , upload = layui.upload;
        form.render(null,'glist-element');

        setTimeout(function(){
            $('.window{{$selected}}').click();
        },300);
    });

    //切换当前浏览框
    function change_window(typ,t){
        var $ = layui.$
            , form = layui.form
            , layer = layui.layer;

        if(typ==0){
            $('.nobuy_div').show();
            $('.head0,.select_div').show();
            $('.cart-tab--addressWrapper--fVnyBG0').show();
            $('.head1').show();
            $('.albuy_div').hide();
            $('.closebuy_div').hide();
        }
        else if(typ==1 || typ==3){
            $('.head1').show();
            $('.albuy_div').show();
            $('.nobuy_div').hide();
            $('.closebuy_div').hide();
            $('.head0,.select_div').hide();
            $('.cart-tab--addressWrapper--fVnyBG0').hide();

            if("{{$selected}}" != typ){
                window.location.href="/cart.html?selected="+typ;
            }
        }
        else if(typ==2){
            $('.head1').show();
            $('.closebuy_div').show();
            $('.albuy_div').hide();
            $('.nobuy_div').hide();
            $('.head0,.select_div').hide();
            $('.cart-tab--addressWrapper--fVnyBG0').hide();
        }
        $(t).addClass('active');
        $(t).siblings().removeClass('active');
    }

    //更改收货地址
    function change_address(t){
        var $ = layui.$
            , form = layui.form
            , layer = layui.layer;

        let idx = layer.open({
            type:2,
            title:'收货地址',
            area:['600px','500px'],
            content:'/address_list?isframe=1',
            end:function(){
                $('.layui-layer-shade').remove();
                // layer.close(idx);
            }
        });
    }

    //显示当前项目
    function showThisProject(t,title){
        var $ = layui.$
            , form = layui.form
            , layer = layui.layer;
            
        // let idx = layer.open({
        //     type:1,
        //     title:title,
        //     area:['600px','500px'],
        //     content:$(t).find('.projectDiv'),
        //     end:function(){
        //         $('.layui-layer-shade').remove();
        //         // layer.close(idx);
        //     }
        // });

        let area = ['600px','500px'];
        let content = $(t).find('.projectDiv');
        let idx = layer.open({
            skin:'layer_frame',
            type: 1,
            title: '<div class="disf"><div class="exclamation-circle"><span>!</span></div>'+title+'</div>',
            area: area,
            content: content,
            end:function(res){
                //关闭弹窗
                layer.close(idx);
                $('.layui-layer-shade').remove();
            }
        });
    }

    //单选
    function box_select(t,typ){
        var $ = layui.$
            , form = layui.form
            , layer = layui.layer;
        layer.load();
        
        if(typ==1){
            //商铺
            if($(t).is(':checked')==true){
                 $(t).parents(":eq(4)").find('.sku_id').prop('checked',true);
                 $(t).parents(":eq(4)").find('.goods_id').prop('checked',true);
                 $('.all_select1').prop('checked',true);
                 $('.all_select2').prop('checked',true); 
             }
             else{
                 $(t).parents(":eq(4)").find('.sku_id').prop('checked',false);
                 $(t).parents(":eq(4)").find('.goods_id').prop('checked',false);
                 //查找全选下同级商铺有无选中
                let shop_element = $(t).parents(":eq(5)").find('.shop_id');
                let all_no_check = 1;
                for(let i=0;i<shop_element.length;i++){
                    if(shop_element.eq(i).is(':checked')==true){
                        all_no_check = 0;    
                    }
                }
                
                if(all_no_check==1){
                    $('.all_select1').prop('checked',false);
                    $('.all_select2').prop('checked',false);
                }
             }
        }
        else if(typ==2){
            //商品
             if($(t).is(':checked')==true){
                 $(t).parents(":eq(4)").find('.sku_id').prop('checked',true);
                 $(t).parents(":eq(7)").find('.shop-top--container--GWvjt50').find('.shop_id').prop('checked',true);
                 $('.all_select1').prop('checked',true);
                 $('.all_select2').prop('checked',true); 
             }
             else{
                 $(t).parents(":eq(4)").find('.sku_id').prop('checked',false);
                 $(t).parents(":eq(4)").find('tr').eq(0).find('.goods_id').prop('checked',false);
                    
                //查找商铺下同级商品有无选中
                let goods_element = $(t).parents(":eq(7)").find('.goods_id');
                let shop_no_check = 1;
                for(let i=0;i<goods_element.length;i++){
                    if(goods_element.eq(i).is(':checked')==true){
                        shop_no_check = 0;    
                    }
                }
                
                //无选中就取消商铺的选中
                if(shop_no_check==1){
                    $(t).parents(":eq(7)").find('.shop_id').prop('checked',false);
                    
                    //查找全选下同级商铺有无选中
                    let shop_element = $(t).parents(":eq(8)").find('.shop_id');
                    let all_no_check = 1;
                    for(let i=0;i<shop_element.length;i++){
                        if(shop_element.eq(i).is(':checked')==true){
                            all_no_check = 0;    
                        }
                    }
                    
                    if(all_no_check==1){
                        $('.all_select1').prop('checked',false);
                        $('.all_select2').prop('checked',false);
                    }
                }
             }
        }
        else if(typ==3){
            //规格
            if($(t).is(':checked')==true){
                $(t).parents(":eq(4)").find('tr').eq(0).find('.goods_id').prop('checked',true);
                $(t).parents(":eq(7)").find('.shop-top--container--GWvjt50').find('.shop_id').prop('checked',true);
                $('.all_select1').prop('checked',true);
                $('.all_select2').prop('checked',true);
            }
            else{
                //查找同级规格元素有无选中
                let sku_element = $(t).parents(":eq(4)").find('.item--container--SrhZkVY').find('.sku_id');
                
                let goods_no_check = 1;
                for(let i=0;i<sku_element.length;i++){
                    if(sku_element.eq(i).is(':checked')==true){
                        goods_no_check = 0;    
                    }
                }
                
                //无选中就取消商品的选中
                if(goods_no_check==1){
                    $(t).parents(":eq(4)").find('tr').eq(0).find('.goods_id').prop('checked',false);
                    
                    //查找商铺下同级商品有无选中
                    let goods_element = $(t).parents(":eq(7)").find('.goods_id');
                    let shop_no_check = 1;
                    for(let i=0;i<goods_element.length;i++){
                        if(goods_element.eq(i).is(':checked')==true){
                            shop_no_check = 0;    
                        }
                    }
                    
                    //无选中就取消商铺的选中
                    if(shop_no_check==1){
                        $(t).parents(":eq(7)").find('.shop_id').prop('checked',false);
                        
                        //查找全选下同级商铺有无选中
                        let shop_element = $(t).parents(":eq(8)").find('.shop_id');
                        let all_no_check = 1;
                        for(let i=0;i<shop_element.length;i++){
                            if(shop_element.eq(i).is(':checked')==true){
                                all_no_check = 0;    
                            }
                        }
                        
                        if(all_no_check==1){
                            $('.all_select1').prop('checked',false);
                            $('.all_select2').prop('checked',false);
                        }
                    }
                }
                
            }
        }
        
        setTimeout(function(){
            calc_fee(0,'','');
        },2000);
    }
    
    //全选
    function all_select(t){
        var $ = layui.$
            , form = layui.form
            , layer = layui.layer;
        layer.load();

        if($(t).is(':checked')==true){
            $('.all_select').prop('checked',true);
        }else{
            $('.all_select').prop('checked',false);
        }
        setTimeout(function(){
            calc_fee(0,'','');
        },2000);
    }
    
    //计算价格
    function calc_fee(type=0,t,type1){
        var $ = layui.$
            , form = layui.form
            , layer = layui.layer;
        
        let sku_id_length = $('.sku_id');
        
        if(sku_id_length.length>0){
            let num = 0;//删除数量
            let totalnum = 0;//总件数
            //库存+购物车+商品的总价格+商品数量
            let sku_ids = '';
            let cart_ids = '';
            let goods_ids = '';
            let sku_nums = '';
            
            for(let i=0;i<sku_id_length.length;i++){
                if(sku_id_length.eq(i).is(':checked')==true){
                    num += 1;
                    totalnum += parseInt($('.buynum').eq(i).val());
                    sku_ids += $('.sku_id').eq(i).attr('data-id')+',';
                    cart_ids += $('.sku_id').eq(i).attr('data-cart_id')+',';
                    goods_ids += $('.sku_id').eq(i).attr('data-gid')+',';
                    sku_nums += $('.buynum').eq(i).val()+',';
                }
            }
            $('.delNum').text(num);
            $('.totalNum').text(totalnum);
            
            $.post("/cart/calc_fee",{'sku_ids':sku_ids,'cart_ids':cart_ids,'goods_ids':goods_ids,'sku_nums':sku_nums,'type':type,'_token':"{{csrf_token()}}"},function(res){
                if (res.code == 0) {
                    if(type==1){
                        if(type1=='btn'){
                            $(t).parents(":eq(4)").find('.sku_price').text(res.sku_pirce);    
                        }
                        else if(type1=='input'){
                            $(t).parents(":eq(3)").find('.sku_price').text(res.sku_pirce);
                        }
                    }
                    $('.totalMoney').text(res.price);
                    layer.closeAll('loading');
                }
            },'json');
            
        }
        else{
            $('.delNum').text('');   
        }
    }

    var layer_frame_div = '';
    function del(t,typ,cart_id,sku_id=0){
        var $ = layui.$
            , form = layui.form
            , layer = layui.layer;

        var area = ['260px', '150px'];
        if(IsPhone()){
            area = ['90%', '160px'];
        }

        var html = '';

        if(typ==0){
            html = '<div class="body" style="padding:10px;box-sizing: border-box;"><div class="msg" style="font-size: 15px;color: #000;width: 100%;overflow-y: auto;margin-bottom:20px;">确认要删除该规格吗？</div><div class="btnGroup" style="display: flex;align-items: center;justify-content: center;"><a style="padding:5px 10px;background:{{$website['color']}};font-size:15px;font-weight:800;color:#000;border:1px solid #000;margin-right:20px;" href="javascript:sure_del(2,'+cart_id+','+sku_id+','+typ+');">确认</a><a href="javascript:sure_del(0);" style="padding:5px 10px;background:#db1d18;font-size:15px;font-weight:800;color:#fff;">取消</a></div></div>';

            {{--layer.confirm('确认要删除该规格吗？', {--}}
            {{--    btn: ['确认','取消']--}}
            {{--}, function(){--}}
            {{--    layer.load();--}}
            {{--    $.post("/cart/delete.html",{'cart_id':cart_id,'sku_id':sku_id,'type':typ,'_token':"{{csrf_token()}}"},function(res){--}}
            {{--        layer.closeAll('loading');--}}
            {{--        layer.msg(res.msg,{time:2000}, function () {--}}
            {{--            if (res.code == 0) {--}}
            {{--                window.location.reload();--}}
            {{--            }--}}
            {{--        });--}}
            {{--    },'json');--}}
            {{--}, function(){--}}

            {{--});--}}
        }
        else if(typ==1){
            html = '<div class="body" style="padding:10px;box-sizing: border-box;"><div class="msg" style="font-size: 15px;color: #000;width: 100%;overflow-y: auto;margin-bottom:20px;">确定要删除该商品吗？</div><div class="btnGroup" style="display: flex;align-items: center;justify-content: center;"><a style="padding:5px 10px;background:{{$website['color']}};font-size:15px;font-weight:800;color:#000;border:1px solid #000;margin-right:20px;" href="javascript:sure_del(1,'+cart_id+','+sku_id+','+typ+');">确认</a><a href="javascript:sure_del(0);" style="padding:5px 10px;background:#db1d18;font-size:15px;font-weight:800;color:#fff;">取消</a></div></div>';
            {{--layer.confirm('确定要删除该商品吗？', {--}}
            {{--    btn: ['确认','取消']--}}
            {{--}, function(){--}}
            {{--    layer.load();--}}

            {{--    $.post("/cart/delete.html",{'cart_id':cart_id,'type':typ,'_token':"{{csrf_token()}}"},function(res){--}}
            {{--        layer.closeAll('loading');--}}
            {{--        layer.msg(res.msg,{time:2000}, function () {--}}
            {{--            if (res.code == 0) {--}}
            {{--                window.location.reload();--}}
            {{--            }--}}
            {{--        });--}}
            {{--    },'json');--}}
            {{--}, function(){--}}

            {{--});--}}
        }
        else if(typ==2){
            let sku_id_length = $('.sku_id').length;
            let sku_length = 0;
            let sku_ids = '';
            let cart_ids = '';
            for(let i=0;i<sku_id_length;i++){
                if($('.sku_id').eq(i).is(':checked')==true){
                    sku_length+=1;
                    sku_ids += $('.sku_id').eq(i).attr('data-id')+',';
                    cart_ids += $('.sku_id').eq(i).attr('data-cart_id')+',';
                }
            }

            if(sku_length>0){
                html = '<div class="body" style="padding:10px;box-sizing: border-box;"><div class="msg" style="font-size: 15px;color: #000;width: 100%;overflow-y: auto;margin-bottom:20px;">确认将'+sku_length+'个商品删除？</div><div class="btnGroup" style="display: flex;align-items: center;justify-content: center;"><a style="padding:5px 10px;background:{{$website['color']}};font-size:15px;font-weight:800;color:#000;border:1px solid #000;margin-right:20px;" href="javascript:sure_del(3,\''+cart_ids+'\',\''+sku_ids+'\','+typ+');">确认</a><a href="javascript:sure_del(0);" style="padding:5px 10px;background:#db1d18;font-size:15px;font-weight:800;color:#fff;">取消</a></div></div>';

                {{--layer.confirm('确认将'+sku_length+'个商品删除？', {--}}
                {{--    btn: ['确认','取消']--}}
                {{--}, function(){--}}
                {{--    layer.load();--}}
                {{--    $.post("/cart/delete.html",{'sku_ids':sku_ids,'cart_ids':cart_ids,'type':typ,'_token':"{{csrf_token()}}"},function(res){--}}
                {{--        layer.closeAll('loading');--}}
                {{--        layer.msg(res.msg,{time:2000}, function () {--}}
                {{--            if (res.code == 0) {--}}
                {{--                window.location.reload();--}}
                {{--            }--}}
                {{--        });--}}
                {{--    },'json');--}}
                {{--}, function(){--}}

                {{--});--}}
            }
        }

        if(html!=''){
            layer_frame_div = layer.open({
                skin:'layer_frame',
                type: 1,
                title: '<div class="disf"><div class="exclamation-circle"><span>!</span></div>信息</div>',
                area: area,
                content: html,
                end:function(res){
                    layer.close(layer_frame_div);
                }
            });
        }

    }
    //确认删除
    function sure_del(sure_typ,cart_id,sku_id,typ){
        var $ = layui.$
            , form = layui.form
            , layer = layui.layer;

        if(sure_typ==0){
            //取消
            layer.close(layer_frame_div);
        }
        else if(sure_typ==1){
            //删除单个商品
            layer.load();
            $.post("/cart/delete.html",{'cart_id':cart_id,'type':typ,'_token':"{{csrf_token()}}"},function(res){
                layer.closeAll('loading');
                layer.msg(res.msg,{time:2000}, function () {
                    if (res.code == 0) {
                        window.location.reload();
                    }
                });
            },'json');
        }
        else if(sure_typ==2){
            //删除单个规格
            layer.load();
            $.post("/cart/delete.html",{'cart_id':cart_id,'sku_id':sku_id,'type':typ,'_token':"{{csrf_token()}}"},function(res){
                layer.closeAll('loading');
                layer.msg(res.msg,{time:2000}, function () {
                    if (res.code == 0) {
                        window.location.reload();
                    }
                });
            },'json');
        }
        else if(sure_typ==3){
            //全部删除
            layer.load();
            $.post("/cart/delete.html",{'sku_ids':sku_id,'cart_ids':cart_id,'type':typ,'_token':"{{csrf_token()}}"},function(res){
                layer.closeAll('loading');
                layer.msg(res.msg,{time:2000}, function () {
                    if (res.code == 0) {
                        window.location.reload();
                    }
                });
            },'json');
        }
    }
    //添加清单下的数量
    function add_num(t,max_num){
        var $ = layui.$
            , form = layui.form
            , layer = layui.layer;
        layer.load();
        
        let val = $(t).parents(':eq(2)').find('.amount-input').val();
        val = parseInt(val)+1;
        if(val<=parseInt(max_num)){
            $(t).parents(':eq(2)').find('.amount-input').val(val);
        }
        
        //“sku，商品，商铺，全选”选中
        if($(t).parents(":eq(4)").find('.sku_id').is(':checked')==false){
            $(t).parents(":eq(4)").find('.sku_id').prop('checked',true);
            $(t).parents(":eq(5)").find('tr').eq(0).find('.goods_id').prop('checked',true);
            $(t).parents(":eq(8)").find('.shop-top--container--GWvjt50').find('.shop_id').prop('checked',true);
            $('.all_select1').prop('checked',true);
            $('.all_select2').prop('checked',true);
        }

        setTimeout(function(){
            calc_fee(1,t,'btn');
        },2000);
    }

    //减少清单下的数量
    function reduction_num(t){
        var $ = layui.$
            , form = layui.form
            , layer = layui.layer;
        layer.load();
        let val = $(t).parents(':eq(2)').find('.amount-input').val();
        val = parseInt(val)-1;
        if(val>0){
            $(t).parents(':eq(2)').find('.amount-input').val(val);
        }
        
        //“sku，商品，商铺，全选”选中
        if($(t).parents(":eq(4)").find('.sku_id').is(':checked')==false){
            $(t).parents(":eq(4)").find('.sku_id').prop('checked',true);
            $(t).parents(":eq(5)").find('tr').eq(0).find('.goods_id').prop('checked',true);
            $(t).parents(":eq(8)").find('.shop-top--container--GWvjt50').find('.shop_id').prop('checked',true);
            $('.all_select1').prop('checked',true);
            $('.all_select2').prop('checked',true);
        }
        
        setTimeout(function(){
            calc_fee(1,t,'btn');
        },2000);
    }
    
    //监控数值变化
    function buynum(t){
        var $ = layui.$
            , form = layui.form
            , layer = layui.layer;
        layer.load();
        
        //“sku，商品，商铺，全选”选中
        if($(t).parents(":eq(3)").find('.sku_id').is(':checked')==false){
            $(t).parents(":eq(3)").find('.sku_id').prop('checked',true);
            $(t).parents(":eq(4)").find('tr').eq(0).find('.goods_id').prop('checked',true);
            $(t).parents(":eq(7)").find('.shop-top--container--GWvjt50').find('.shop_id').prop('checked',true);
            $('.all_select1').prop('checked',true);
            $('.all_select2').prop('checked',true);
        }
        
        setTimeout(function(){
            calc_fee(1,t,'input');
        },2000);
    }

    //购买商品
    function buy_goods(){
        var $ = layui.$
            , layer = layui.layer;

        // let addr_id = $('input[name="address_id"]').val();
        // if(addr_id=='' || addr_id==0){
        //     layer.msg('请选择收货地址');return false;
        // }

        let sku_ids = $('.sku_id');
        let buy_skuid = '';
        let cart_ids = '';
        for(let i=0;i<sku_ids.length;i++){
            if($('.sku_id').eq(i).is(':checked')==true){
                buy_skuid += $('.sku_id').eq(i).attr('data-sku_id')+',';

                if(cart_ids==''){
                    cart_ids = $('.sku_id').eq(i).attr('data-cart_id')+',';
                }else{
                    if(!cart_ids.includes($('.sku_id').eq(i).attr('data-cart_id')+',')){
                        //不包含此购物车
                        cart_ids += $('.sku_id').eq(i).attr('data-cart_id')+',';
                    }
                }
            }
        }

        if(buy_skuid==''){
            layer.msg('请勾选需要订购的商品');return false;
        }else{
            layer.load();

            // 'addr_id':addr_id
            $.post('/cart/buy_goods',{'buy_skuid':buy_skuid,'_token':"{{csrf_token()}}"},function(res){
                layer.closeAll('loading');
                layer.msg(res.msg,{time:5000}, function () {
                    if (res.code == 0) {
                        // window.location.replace("/cart.html?selected=1");
                        window.location.href="/order_confirm?cart_id="+cart_ids;
                    }
                });
            },'json');
        }
    }
</script>
@include('layouts.common_function')