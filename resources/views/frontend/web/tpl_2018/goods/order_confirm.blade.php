@include('layouts.header')
    <link rel="stylesheet" href="/assets/d2eace91/iconfont/iconfont.css?v=1.1"/>
    <link rel="stylesheet" href="/css/common.css?v=1.1"/>
    <script src="/assets/d2eace91/js/jquery.js?v=1.1"></script>

    <script src="/js/common.js?v=1.1"></script>
    <!-- JS -->
    <script src="/assets/d2eace91/js/jquery.cookie.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=1.1"></script>
    <script src="/js/jquery.fly.min.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/szy.cart.js?v=1.1"></script>
    <link rel="stylesheet" href="/assets/d2eace91/layui/css/layui.css?v=23121"/>
    <link rel="stylesheet" href="/assets/d2eace91/js/layer/theme/default/layer.css?v=3.1.0" id="layuicss-layer">
    <script type="text/javascript" src="/assets/d2eace91/layui/layui.js"></script>
    <style>
        /**{line-height: 24px;}*/
        .chosen-container-single .chosen-search input[type="text"]{color:#000;}
        body{background:{{$website['background']}} !important;}
        .disf{display:flex;align-items:center;}
        .layer_frame .layui-btn-normal{color:{{$website['color_word']}};border:1px solid {{$website['color_word']}};}
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

        .sure_container{padding-top:100px;margin-bottom: 200px;}
        .sure_detail_title{background: {{$website['color']}};color: {{$website['color_word']}};font-size: 20px;font-weight: 800;padding: 5px 30px;box-sizing: border-box;}
        .sure_container .w1210{width:1210px;margin:0 auto;background: #fff;}
        .sure_container .content {border: 1px solid #eee;box-sizing: border-box;padding: 20px;position: relative;}
        .goods_list .goods_list_title_cn .sure_goods_title{color: #333;font-size: 15px;font-weight: 700;float:left;padding-bottom:20px;line-height: 25px;}
        .goods_list .goods_list_title_cn em{background-color: #000;float: left;height: 1px;margin-top: 13px;width: 92%;}
        .goods_list .list-th{background-color: #E3E6EB;display: flex;height: 38px;width: 100%;}
        .goods_list .list-th span:first-of-type {padding-left: 20px;}
        .goods_list .list-th span {align-items: center;color: #000;display: flex;font-size: 15px;font-weight:800;line-height: 38px;}
        .goods_list .list-th .right-th {align-items: center;display: flex;margin-left: auto;}
        .goods_list .list-th .right-th span:last-child {padding-left: 152px;padding-right: 20px;}
        .goods_list .shop-item {font-size: 12px;padding-bottom: 6px;padding-top: 30px;width: 100%;}
        .goods_list .shop-item .shop-title {align-items: center;display: flex;overflow: hidden;padding-bottom: 6px;}
        .goods_list .shop-item .shop-img {float: left;height: 16px;margin: 0 10px 0 0;width: 16px;}
        .goods_list .shop-item .shop-name, .goods_list .shop-item .special-shop-name {-webkit-line-clamp: 2;-webkit-box-orient: vertical;display: -webkit-box;float: left;font-size: 15px;line-height: 18px;margin-right: 10px;overflow: hidden;text-overflow: ellipsis;}
        .goods_list .shop-item .shop-name {color: {{$website['color_word']}};font-weight:800;}
        .goods_list .shop-item .warehouse {background: {{$website['color']}};border-radius: 2px;color: {{$website['color_word']}};border:1px solid {{$website['color_word']}};float: left;margin-right: 10px;padding: 5px 9px;font-size:14px;font-weight:800;}
        .goods_list .shop-item .goods-box {border: 1px solid #dfdfdf;}
        .goods_list .shop-item .goods-box .goods-item {background: #E3E6EB;border-bottom: 1px solid #ddd;display: flex;flex-direction: column;padding-top: 20px;position: relative;width: 100%;}
        .goods_list .shop-item .goods-box .goods-item .good-info {background: #E3E6EB;display: flex;}
        .goods_list .shop-item .goods-box .goods-item .img-box {float: left;height: 80px;margin-left: 20px;width: 80px;}
        .common-img-wrap {background: none !important;display: inline-block;height: 100%;overflow: hidden;position: relative;width: 100%;}
        .common-img-wrap .common-img {background: none !important;bottom: 0;display: block;left: 0;margin: auto;max-height: 100%;max-width: 100%;opacity: 0;position: absolute;right: 0;top: 0;transition: all .3s linear;}
        .goods_list .shop-item .goods-box .goods-item .goods-name {height: auto;margin-left: 10px;overflow: hidden;width: 100%;}
        .goods_list .shop-item .goods-box .goods-item .goods-name a {text-decoration: none;}
        .goods_list .shop-item .goods-box .goods-item .goods-name .title {color: #000;font-size: 18px;font-weight:800;line-height: 20px;overflow: hidden;width: 100%;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;}
        .goods_list .shop-item .goods-box .goods-item .goods-name .color-type {color: #333;font-size: 15px;height: 20px;margin-bottom: 4px;margin-top: 8px;overflow: hidden;font-weight:800;}
        .goods_list .shop-item .goods-box .goods-item .remark {word-wrap: break-word;background-color: transparent;border: 1px dashed transparent;color: #666;height: 78px;margin-left: 44px;margin-top: -20px;outline: none;overflow-y: auto;padding: 20px;position: relative;width: 220px;}
        .goods_list .shop-item .goods-box .goods-item .add-photo-tip-background{float: left;font-size: 12px;height: 100%;overflow: hidden;}
        .goods_list .shop-item .goods-box .goods-item .good-operation-right {margin-left: auto;margin-right: 25px;}
        .goods_list .shop-item .goods-box .goods-item .count-cn {box-sizing: border-box;color: #666;float: left;font-size: 12px;height: 100%;overflow: hidden;padding-left: 110px;text-align: right;width: fit-content;}
        .goods_list .shop-item .goods-box .goods-item .count-cn .amount-input {color: #db1d18;font-size: 12px;margin: 0;margin-top: 0px;padding: 3px;display: inline-block;height: 24px;border: 1px solid #a7a6ac;width: 75px;line-height: 24px;vertical-align: middle;text-align: center;font-weight:800;}
        .goods_list .shop-item .goods-box .goods-item .count-cn .amount-btn {display: inline-block;vertical-align: middle;margin-left: -4px;margin-top: 1px;}
        .goods_list .shop-item .goods-box .goods-item .count-cn .amount-btn i {width: 16px;height: 14px;font-size: 13px;color: #666;font-weight:800;display: inline-block;font-style: normal;user-select:none;}
        .goods_list .shop-item .goods-box .goods-item .count-cn .amount-plus {width: 16px;height: 16px;overflow: hidden;cursor: pointer;border: 1px solid #a7a6ab;border-left: none;display: block;line-height: 14px;text-align: center;background: #f1f1f1;}
        .goods_list .shop-item .goods-box .goods-item .count-cn .amount-minus {width: 16px;height: 16px;overflow: hidden;cursor: pointer;border: 1px solid #a7a6ab;border-left: none;border-top: none;display: block;line-height: 14px;text-align: center;background: #f1f1f1;}

        .goods_list .shop-item .goods-box .goods-item .goods-price {color: #db1d18;font-weight: 700;margin-left: 45px;text-align: right;width: 218px;float: left;font-size: 22px;height: 100%;overflow: hidden;}
        .goods_list .shop-item .goods-box .goods-item .goods-add-photo-cont {align-items: center;display: flex;flex: 0 0 100%;font-size: 12px;padding-left: 15px;position: relative;}
        .goods_list .shop-item .goods-box .goods-item .goods-add-photo-cont .ant-checkbox-wrapper {align-items: center;display: flex;}

        .feeDiv{width: 100%;padding: 20px;box-sizing: border-box;}
        .feeDiv .layui-collapse{border-color:#fff;}
        .feeDiv .layui-colla-title{width:100%;padding:0 15px 0 15px;color:#000;font-weight:800;}
        .feeDiv .goods-price{float:unset !important;text-align: unset !important;margin-left:0 !important;width:unset !important;font-size: 14px !important;}
        .feeDiv .layui-colla-icon{right:15px !important;left:unset !important;}
        .feeDiv .servicesDiv{padding:0px;box-sizing: border-box;position:unset;top: 0px;left: 0px;z-index: 11;min-width: 578px;}
        .feeDiv .servicesCon{width: 100%;margin-bottom: 10px;}
        .feeDiv .servicesCon .servicesInput, .feeDiv .servicesCon .servicesTitle, .feeDiv .servicesCon .servicesTips, .feeDiv .servicesCon .servicesPrice{display: inline-block;font-size:15px;font-weight:800;color:#000;}
        .feeDiv .servicesCon .servicesTitle{min-width: 270px;max-width:270px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;}
        .feeTable{width: 100%;text-align: center;}
        .feeTable thead th{text-align: center;font-size: 18px;}
        .feeTable tbody .count-cn{float:unset !important;}
        .feeTable tbody td{font-size:15px;}
        .feeDiv .servicesCon .servicesPrice{color:#db1d18;}
        .feeDiv .gantan {width: 15px;margin-left: 0px;margin-top:-10px;cursor:pointer;}
        .feeDiv .tipsDiv {padding: 20px;box-sizing: border-box;font-size: 15px;}
        .feeDiv .servicesPrice {font-size: 14px;color: #db1d18;float: right;font-weight: 600;width: 100%;}

        /*当前购物清单总价*/
        .goods_list .total-price{color: #000;height: 74px;line-height: 74px;overflow: hidden;text-align: right;width: 100%;font-size: 15px;font-weight: 800;}
        .goods_list .total-price b {color: #db1d18;float: right;font-size: 26px;}
        .goods_list .total-price a {float: right;}
        .goods_list .total-price a .i-cn, .goods_list .total-price a .i-en {color: #000;display: inline-block;line-height: 20px;}

        /*最终价格*/
        .confirm-order {font-size: 12px;/*overflow: hidden;*/position: fixed;left: 50%;background: #fff;bottom: 6%;transform: translate(-50%, 0);width: 100%;max-width: 1210px;box-shadow: 0px 0px 10px 1px #ccc;}
        .confirm-order .leftBox{margin-left:20px;}
        .confirm-order .total-price{color: #000;height: 74px;line-height: 74px;overflow: hidden;text-align: right;width: 100%;font-size: 15px;font-weight: 800;}
        .confirm-order .total-price b {color: #db1d18;float: right;font-size: 26px;}
        .confirm-order .total-price a {float: right;}
        .confirm-order .total-price a .i-cn, .goods_list .total-price a .i-en {color: #000;display: inline-block;line-height: 20px;}
        .confirm-order .children {display: flex;margin-left: auto;overflow: hidden;width: 100%}
        .confirm-order .agree-pro {color: #333;display: flex;font-size: 12px;margin: 10px 20px 10px auto;}
        .confirm-order .agree-pro label{margin-bottom:0;}
        .confirm-order .agree-pro label>span {padding-right: 0;font-size: 15px;font-weight: 800;}
        .confirm-order .agree-pro a {color: #1268bb}
        .confirm-order .agree-pro i {color: #333}
        .confirm-order .agree-pro .ant-checkbox-inner {height: 14px;width: 14px}
        .confirm-order .submit-button {display: flex;margin-bottom: 10px}
        .confirm-order .submit-button button {background-color: {{$website['color']}};box-sizing: border-box;font-size: 16px;height: 40px;margin-left: auto;margin-right: 20px;width: 180px;border:1px solid {{$website['color_word']}};color:{{$website['color_word']}};font-weight: 800;}
        .confirm-order .submit-button button:hover {opacity: .9}
        .confirm-order .submit-button button[disabled] {background-color: #f5f5f5}
        .confirm-order .confirm-btn,.confirm-order .confirm-btn-active {border-radius: 2px;color: #fff;float: right;font-size: 16px;height: 40px;line-height: 40px;margin: 0 40px 20px auto;text-align: center;width: 180px}
        .confirm-order .confirm-btn-active {background-color: #1268bb;cursor: pointer;margin-right: 22px}
        .confirm-order .confirm-btn-noagree {background-color: #ccc;border-radius: 2px;color: #fff;float: right;font-size: 16px;height: 40px;line-height: 40px;margin: 0 29px 20px auto;text-align: center;width: 180px}
        .confirm-order .warm-reminder {background-color: #fffff5;border: 1px solid #ffe0b8;color: #f48e2b;float: right;font-size: 13px;font-weight:800;/*height: 28px;*/line-height: 28px;margin: 0 22px 10px auto;padding: 0 10px 0 32px}

        #translate{display: none;}
        footer{display: block !important;}

        /*拍照要求*/
        .photoNumBox{display:none;padding:20px;box-sizing: border-box;font-size:15px;color: #000;}
        .photo-operation .amount-input {color: #666;font-size: 12px;margin: 0;margin-top: 1px;padding: 3px;display: inline-block;height: 24px;border: 1px solid #a7a6ac;width: 36px;line-height: 24px;vertical-align: middle;}
        .photo-operation .amount-btn {display: inline-block;vertical-align: middle;margin-left: -3px;margin-top: 1px;}
        .photo-operation .amount-btn i {width: 16px;height: 18px;font-size: 12px;color: #666;display: inline-block;}
        .photo-operation  .amount-plus {width: 16px;height: 16px;overflow: hidden;cursor: pointer;border: 1px solid #a7a6ab;border-left: none;display: block;line-height: 14px;text-align: center;background: #f1f1f1;}
        .photo-operation .amount-minus {width: 16px;height: 16px;overflow: hidden;cursor: pointer;border: 1px solid #a7a6ab;border-left: none;border-top: none;display: block;line-height: 14px;text-align: center;background: #f1f1f1;}
        .photo-operation .orion-input-number{margin-left:5px;}
        .remarks-list-wrap{max-height: 330px;overflow-y: auto;padding:10px;box-sizing: border-box;}
        .remarks-list-wrap .count-box{text-align:left;}
        .photo_btnarea{margin-top:10px;text-align: right;}

        @media (max-width: 992px){
            body{min-width: 100% !important;}
            .navbar-default .navbar-collapse{margin-top:15px;}
            #translate{display: block;}
            .sure_container .w1210{width:100%;}
            .sure_container .content{margin-bottom:260px;}

            .goods_list .shop-item{padding-top:10px;}
            .goods_list .shop-item .goods-box .goods-item .good-info{display: inline-block;}
            .goods_list .shop-item .goods-box .goods-item .img-box{margin:0 10px;}
            .goods_list .shop-item .goods-box .goods-item .goods-name{overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 3;-webkit-box-orient: vertical;width: 60%;height: 80px;}
            .goods_list .shop-item .goods-box .goods-item .goods-name .color-type{text-overflow: ellipsis;white-space: nowrap;}
            .goods_list .shop-item .goods-box .goods-item .good-operation-right{margin-right:20px;width: fit-content;}
            .goods_list .shop-item .goods-box .goods-item .goods-price{margin-left:0;font-size:15px;display: flex;align-items: center;justify-content: right;}
            .goods_list .shop-item .goods-box .goods-item .goods-price .price_num{margin-left:5px;}
            .goods_list .shop-item .goods-box .goods-item .remark{display: none;}

            .feeTable thead th{display:none;}
            .feeTable tbody tr{display: grid;grid-template-columns: 1fr;}
            .feeTable tbody tr td:nth-of-type(1){display:none;}
            .feeTable tbody tr{border-bottom:1px solid #000;padding-bottom: 10px;margin-bottom: 10px;}
            .feeTable tbody tr:last-child{border-bottom:0;padding-bottom:0;margin-bottom: 0;}
            .feeTable tbody tr .goods-price{justify-content: center !important;}
            .feeDiv{padding:20px 10px;}

            .feeDiv .servicesDiv{min-width: 100%;}
            .feeDiv .servicesCon .servicesTitle{width: fit-content;min-width: fit-content;}
            .remarks-list-wrap{padding:0 !important;}

            .confirm-order{box-shadow: 0px 0px 10px 1px #666;}
            .confirm-order .disf{display: block;}
            .confirm-order .total-price{height:50px;line-height: 50px;text-align: left;padding: 0 20px;}
            .confirm-order .total-price b{font-size: 20px;}
            .confirm-order .total-price a{float:unset;}
            .confirm-order .leftBox{margin-left:0;}
            .confirm-order .agree-pro{margin:0 20px;}
            .confirm-order .warm-reminder{float:unset;margin:0 20px;padding:0 20px;}
        }
    </style>
    <div class="sure_container">
        <div class="w1210">
            <div class="sure_detail_title">
                <span style="font-size:22px;margin-right:5px;">③</span><span>结算中心&nbsp;&gt;&nbsp;订单确认</span>
            </div>
            <div class="content">
                <div class="goods_list">
{{--                    <div class="goods_list_title_cn">--}}
{{--                        <div class="sure_goods_title">确认商品信息</div>--}}
{{--                        <em></em>--}}
{{--                    </div>--}}
                    <div class="list-th list-th-cn">
                        <span>商品名称</span>
                        <div class="right-th">
                            <span>商品总价</span>
                        </div>
                    </div>
                    <!--各购物清单的商品-->
                    @foreach($data as $k=>$v)
                        <div class="shop-item">
                            <div class="shop-title">
{{--                                <img class="shop-img" src="https://www.superbuy.com/cn/source/img/buy/icon_tmall.png">--}}
                                <a class="shop-name" href="javascript:void(0);" target="_blank">{{$v['shop_name']}}</a>
                                <span class="warehouse">中国集货仓</span>
                            </div>
                            <div class="goods-box">
                                <div class="goods-item">
                                    @foreach($v['sku_info'] as $k2=>$v2)
                                        <div class="good-info" style="@if($k2>0)
                                                border-top: 1px solid #fff;padding-top: 10px;margin-top: 10px;
                                        @endif">
                                            <a target="_blank" href="/goods-{{$v['goods_id']}}.html" aria-label="goodsLink" rel="noreferrer">
                                                <div class="img-box">
                                                    <div class="common-img-wrap">
                                                        <img src="{{$v2['goods_image']}}" referrerpolicy="no-referrer" alt="common-img" draggable="false" class="common-img" style="opacity: 1;">
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="goods-name">
                                                <a target="_blank" href="/goods-{{$v['goods_id']}}.html" aria-label="goodsLink" rel="noreferrer">
                                                    <p class="title">{{$v2['bgoods_name']}}</p>
                                                </a>
                                                <p class="color-type">{{$v2['boption_name']}}</p>
                                                <div class="waring"></div>
                                            </div>
                                            <div class="remark"></div>
                                            <div class="add-photo-tip-background"></div>
                                            <div class="good-operation-right">
                                                @if($k2==0)
                                                <div class="goods-price">{{$v['currency']}} <span class="price_num">{{$v['total_price']}}</span></div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="feeDiv">
                                        <div class="layui-collapse" lay-accordion>
                                            <!--商品价格-->
                                            <div class="layui-colla-item">
                                                <div class="layui-colla-title">
                                                    <div class="disf">
                                                        <span>商品费用：</span>
                                                        <div class="goods-price">{{$v['currency']}} <span class="price_num">{{$v['price']}}</span></div>
                                                    </div>
                                                </div>
                                                <div class="layui-colla-content">
                                                    <table class="feeTable">
                                                        <thead>
                                                        <th>序号</th>
                                                        <th>规格名称</th>
                                                        <th>商品数量</th>
                                                        <th>商品价格</th>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($v['sku_info'] as $k2=>$v2)
                                                            <tr>
                                                                <td><?php echo $k2+1;?></td>
                                                                <td>{{$v2['soption_name']}}</td>
                                                                <td>
                                                                    <div class="count-cn" style="padding:0;margin:0 auto;">
                                                                        <span class="amount-widget">
                                                                            <input type="text" class="amount-input" name="buy_num[]" value="{{$v2['num']}}"
                                                                                   data-goods_id="{{ $v['goods_id'] }}"
                                                                                   data-cart_id="{{$v['cart_id']}}"
                                                                                   data-sku_id="{{ $v2['sku_id'] }}"
                                                                                   data-amount-min="1"
                                                                                   data-amount-max="1000"
                                                                                   maxlength="8" title="请输入购买量"  onchange="buynum(this)">
                                                                            <span class="amount-btn">
                                                                                <span class="amount-plus" data-goods_id="{{$v['goods_id']}}" data-cart_id="{{$v['cart_id']}}" data-sku_id="{{$v2['sku_id']}}" data-amount-max="1000" onclick="add_num(this,1000)">
                                                                                    <i>+</i>
                                                                                </span>
                                                                                <span class="amount-minus" data-goods_id="{{$v['goods_id']}}" data-cart_id="{{$v['cart_id']}}" data-sku_id="{{$v2['sku_id']}}" data-amount-max="1000" onclick="reduction_num(this)">
                                                                                    <i>-</i>
                                                                                </span>
                                                                            </span>
                                                                        </span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="goods-price">{{$v2['currency']}} <span class="price_num">{{$v2['price']}}</span></div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <!--附加费用-->
                                            <div class="layui-colla-item">
                                                <div class="layui-colla-title">
                                                    <div class="disf">
                                                        <span>附加费用：</span>
                                                        <div class="goods-price">CNY <span class="price_num">{{$v['services']['additional_money']}}</span></div>
                                                    </div>
                                                </div>
                                                <div class="layui-colla-content">
                                                    <table class="feeTable">
                                                        <thead>
                                                        <th>序号</th>
                                                        <th>费用名称</th>
                                                        <th>费用说明</th>
                                                        <th>费用单价</th>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($v['services']['additional'] as $k2=>$v2)
                                                        <tr>
                                                            <td><?php echo $k2+1;?></td>
                                                            <td>{{$v2['name']}}</td>
                                                            <td>{{$v2['desc']}}</td>
                                                            <td>
                                                                <div class="servicesPrice">
                                                                    {{$v2['currency']}} <span class="serprice">{{$v2['price']}}</span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <!--增值服务-->
                                            <div class="layui-colla-item">
                                                <div class="layui-colla-title">
                                                    <div class="disf">
                                                        <span>增值服务：</span>
                                                        <div class="goods-price">CNY <span class="price_num">{{$v['services']['increment_money']}}</span></div>
                                                    </div>
                                                </div>
                                                <div class="layui-colla-content">
                                                    <div class="servicesDiv" style="display:block;">
                                                        <!--当前购物清单增值服务-->
                                                        <input type="number" id="service_money{{$v['cart_id']}}" class="services_money{{$v['cart_id']}}" value="0" style="display: none;">
                                                        <!--当前购物清单拍照数量-->
                                                        <input type="number" id="photo_money{{$v['cart_id']}}" class="photo_money{{$v['cart_id']}}" value="0" style="display: none;">

                                                        <table class="feeTable">
                                                            <thead>
                                                            <th>序号</th>
                                                            <th>服务名称</th>
                                                            <th>服务说明</th>
                                                            <th>服务价格</th>
                                                            <th>服务单价</th>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($v['services']['increment'] as $k2=>$v2)
                                                                <?php $is_selected=0;?>
                                                                @if(!empty($v['services_old']))
                                                                @foreach($v['services_old'] as $k3=>$v3)
                                                                    @if($is_selected==0)
                                                                        @if($v3['service_id']==$v2['id'])
                                                                            <?php $is_selected=1;?>
                                                                        @else
                                                                            <?php $is_selected=0;?>
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                                @endif
                                                            <tr class="servicesCon" data-id="{{$v2['id']}}" data-type="{{$v2['type']}}">
                                                                <td><?php echo $k2+1;?></td>
                                                                <td>
                                                                    <input type="checkbox" name="services[]" class="servicesInput services servicesInput{{$v['cart_id']}}" lay-ignore value="@if($v2['is_select']==1)
                                                                            1
@else
                                                                    @if($is_selected==1)
                                                                            1
                                                                    @else
                                                                            0
                                                                    @endif
@endif" onclick="select_services({{$v2['id']}},{{$v2['type']}},this,'{{$v2['name']}}',{{$v['cart_id']}})" @if($v2['is_select']==1)
                                                                           checked disabled
                                                                           @else
                                                                               @if($is_selected==1)
                                                                                    checked
                                                                                @endif
                                                                            @endif
                                                                        >
                                                                    {{$v2['name']}}
                                                                </td>
                                                                <td>
                                                                    @if($v2['type']==1)
                                                                        <div class="servicesTitle" >共需<span class="photoNum photoNum{{$v['cart_id']}}">{{$v2['photonum']}}</span>件</div>
                                                                    @else
                                                                        <div class="servicesTitle" title="{{$v2['desc']}}">{{$v2['desc']}}</div>
                                                                    @endif
                                                                    <div class="servicesTips">
                                                                        <img src="/images/gantanhao.png" class="gantan" onclick="showTips(this,'{{$v2['name']}}')">
                                                                        <div class="tipsDiv" style="display: none;">
                                                                            @if($v2['type']==3)

                                                                            @else
                                                                                {!! $v2['tips'] !!}
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    @if($v2['type']==2)
                                                                        <div class="servicesTitle disf" style="margin-left:10px;display:none;">
                                                                            <input type="radio" name="services_child[{{$k2}}]" value="1" title="是" checked>
                                                                            <input type="radio" name="services_child[{{$k2}}]" value="0" title="否">
                                                                        </div>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <div class="servicesPrice">
                                                                        {{$v2['currency']}} <span class="serprice">{{$v2['price']}}</span>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="servicesPrice">
                                                                        {{$v2['currency']}} <span class="serprice">{{$v2['final_money']}}</span>
                                                                    </div>

                                                                    @if($v2['type']==1)
                                                                        <!--拍照需求start-->
                                                                        <div class="photoNumBox" id="cart_photo{{$v['cart_id']}}">
                                                                            <input type="hidden" id="service_id{{$v['cart_id']}}" value="">
                                                                            <div class="photo_wrap">
                                                                                <div class="photo-operation disf">
                                                                                    <strong>要求数量</strong>
                                                                                    <div class="orion-input-number">
                                                                                        <input type="text" name="photonum" class="amount-input photonum photonum{{$v['cart_id']}}" value="1" min="1" data-amount-min="1" data-amount-max="200" maxlength="8" readonly>
                                                                                        <span class="amount-btn">
                                             <span class="amount-plus" onclick="add_photonum(this,200,{{$v['cart_id']}})">
                                                 <i>+</i>
                                             </span>
                                             <span class="amount-minus" onclick="reduction_photonum(this,{{$v['cart_id']}})">
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
                                                                                        <textarea rows="3" class="layui-textarea photoRequest{{$v['cart_id']}}" name="photoRequest{{$v['cart_id']}}[]" maxlength="150" autocomplete="on" placeholder="备注特殊要求"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                                <!--确定/取消-->
                                                                                <div class="photo_btnarea">
                                                                                    <div class="layui-btn layui-btn-primary" onclick="surephoto(this,0,{{$v['cart_id']}})">取消</div>
                                                                                    <div class="layui-btn layui-btn-normal" onclick="surephoto(this,1,{{$v['cart_id']}})">确定</div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!--拍照需求end-->
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>
                                            </div>
                                            <!--潜在费用-->
                                            <div class="layui-colla-item">
                                                <div class="layui-colla-title">
                                                    <div class="disf">
                                                        <span>潜在费用：</span>
                                                        <div class="goods-price">CNY <span class="price_num">{{$v['services']['potential_money']}}</span></div>
                                                    </div>
                                                </div>
                                                <div class="layui-colla-content">
                                                    <table class="feeTable">
                                                        <thead>
                                                            <th>序号</th>
                                                            <th>费用名称</th>
                                                            <th>费用说明</th>
                                                            <th>费用单价</th>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($v['services']['potential'] as $k2=>$v2)
                                                            <tr>
                                                                <td><?php echo $k2+1;?></td>
                                                                <td>{{$v2['name']}}</td>
                                                                <td>{{$v2['desc']}}</td>
                                                                <td>
                                                                    <div class="servicesPrice">
                                                                        {{$v2['currency']}} <span class="serprice">{{$v2['price']}}</span>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!--当前所有购物清单的总价-->
{{--                    <div class="total-price">--}}
{{--                        <b><span class="final_currency">{{$final['final_currency']}}</span> <span class="final_price">{{$final['final_price']}}</span></b>--}}
{{--                        待支付总价--}}
{{--                        <a href="#">--}}
{{--                            <i class="i-cn">（国际运费需另计）</i>--}}
{{--                        </a>--}}
{{--                    </div>--}}
                </div>
            </div>
            <!--显示服务协议弹框-->
            <div class="services_div" style="display:none;"></div>

            <div class="confirm-order">
                <div class="disf" style="justify-content: space-between;">
                    <div class="leftBox">
                        <!--当前所有购物清单的总价-->
                        <div class="total-price">
                            <b><span class="final_currency">{{$final['final_currency']}}</span> <span class="final_price">{{$final['final_price']}}</span></b>
                            待支付总价
                            <a href="#">
                                <i class="i-cn">（国际运费需另计）</i>
                            </a>
                        </div>
                    </div>
                    <div class="rightBox">
                        <div class="children">
                            <div class="agree-pro">
                                <label class="ant-checkbox-wrapper ant-checkbox-wrapper-checked">
{{--                                    <span class="ant-checkbox ant-checkbox-checked">--}}
{{--                                        <input type="checkbox" class="ant-checkbox-input" value="" checked="">--}}
{{--                                        <span class="ant-checkbox-inner"></span>--}}
{{--                                    </span>--}}
{{--                                    <span>--}}
{{--                                        <i>我已阅读并同意<a href="javascript:show_services_rule(40);" target="_blank">《委托商品代购与转运服务协议》</a></i>--}}
{{--                                    </span>--}}
                                    <!--规则确认-->
                                    @include('layouts.services_rule')
                                </label>
                            </div>
                        </div>
                        <div class="children submit-button">
                            <button type="button" class="ant-btn ant-btn-primary" onclick="buy_goods()">
                                <span>帮我订购</span>
                            </button>
                        </div>
                        <div class="children">
                            <div class="warm-reminder">温馨提示：订单提交并且支付成功后，请耐心等待商品入库。入库后可提交寄送的商品。</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        layui.use(['layer','element','upload','form'],function() {
            var $ = layui.$
                , layer = layui.layer
                , element = layui.element
                , form = layui.form
                , upload = layui.upload;
            form.render(null,'glist-element');
        });

        //计算价格
        function calc_fee(type=0,t,type1){
            var $ = layui.$
                , form = layui.form
                , layer = layui.layer;

            //获取当前的所有购物清单id
            let cart_id = $(t).attr('data-cart_id');
            //获取商品id
            let goods_id = $(t).attr('data-goods_id');
            //获取sku_id
            let sku_id = $(t).attr('data-sku_id');
            //最大购买数量
            let amount_max = $(t).attr('data-amount-max');
            //当前计费数量
            let buy_num = 1;
            if(type1 == 'input'){
                buy_num = $(t).val();
            }
            else if(type1 == 'btn'){
                buy_num = $(t).parents(":eq(1)").find('.amount-input').val();
            }

            // console.log(goods_id,sku_id,amount_max,buy_num);return false;
            $.post("/order_confirm_calc",{'cart_ids':"{{$cart_id}}",'cart_id':cart_id,'sku_id':sku_id,'goods_id':goods_id,'buy_num':buy_num,'type':type,'_token':"{{csrf_token()}}"},function(res){
                if (res.code == 0) {
                    if(type==1){
                        if(type1=='btn'){
                            $(t).parents(":eq(4)").find('td').eq(3).find('.goods-price .price_num').text(res.data.sku_price);
                            $(t).parents(":eq(8)").find('.layui-colla-title').find('.goods-price .price_num').text(res.data.all_sku_price);
                            $(t).parents(":eq(11)").find('.good-info').eq(0).find('.good-operation-right').find('.goods-price').find('.price_num').text(res.data.total_price);
                        }
                        else if(type1=='input'){
                            $(t).parents(":eq(3)").find('td').eq(3).find('.goods-price .price_num').text(res.data.sku_price);
                            $(t).parents(":eq(7)").find('.layui-colla-title').find('.goods-price .price_num').text(res.data.all_sku_price);
                            $(t).parents(":eq(10)").find('.good-info').eq(0).find('.good-operation-right').find('.goods-price').find('.price_num').text(res.data.total_price);
                        }
                        $('.final_price').text(res.data.final_price);
                    }
                    // $('.totalMoney').text(res.price);//最终价格
                    window.location.reload();
                }else{
                    layer.msg(res.msg);
                    setTimeout(function(){
                        window.location.reload();
                    },3000);
                }
                layer.closeAll('loading');
            },'json');
        }

        //添加数量
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

            setTimeout(function(){
                calc_fee(1,t,'btn');
            },2000);
        }

        //减少数量
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

            setTimeout(function(){
                calc_fee(1,t,'input');
            },2000);
        }

        //选择服务start
        //显示服务tips
        function showTips(t,name){
            var $ = layui.$
                , form = layui.form
                , layer = layui.layer;

            let area = ['500px', '400px'];
            if(IsPhone()){
                area = ['100%','400px'];
            }
            // layer.open({
            //     type: 1,
            //     title: name,
            //     area: ['500px', '400px'],
            //     // zIndex:999999999,
            //     content: '<div style="padding:20px;box-sizing: border-box;font-size:15px;color:#000;">'+$(t).parent().find('.tipsDiv').html()+'</div>'
            // });

            let msg = $(t).parent().find('.tipsDiv').html();
            open_frame(name,msg,"",'',"","",2,area,0);
        }
        var photo_layer = '';
        function select_services(id,type,t,name,cart_id){
            var $ = layui.$
                , form = layui.form
                , layer = layui.layer;

            let val = $(t).val();

            if(val==0){
                //未选择前，进来
                if(type!=1) {
                    //拍照
                    $(t).val("1");
                }else{
                    //其他服务
                    $('.servicesInput'+cart_id).eq(0).prop('checked',false);
                }
            }else{
                //已选择后，进来
                if(type!=1){
                    //拍照
                    $(t).val("0");
                }else{
                    //其他服务
                    $('.servicesInput'+cart_id).eq(0).prop('checked',true);
                }
            }
            // console.log(val,id,type,name,cart_id);return false;

            // let num = 0;
            // for(let i=0;i<$('.servicesInput').length;i++){
            //     if($('.servicesInput').eq(i).val()==1){
            //         num +=1;
            //     }
            // }

            // $('.gi_services').find('.alselBox .alsel2').find('.projectNum').text(num);

            if(type==1){
                //拍照
                $('#service_id'+cart_id).val(id);
                let area = ['800px','500px'];
                if(IsPhone()){
                    area = ['100%','500px'];
                }

                // photo_layer = layer.open({
                //     type: 1,
                //     title: name,
                //     area: area,
                //     // zIndex:999999999,
                //     content: $('#cart_photo'+cart_id),
                //     closeBtn: 0,
                // });

                let content = $('#cart_photo'+cart_id);
                photo_layer = layer.open({
                    skin:'layer_frame',
                    type: 1,
                    title: '<div class="disf"><div class="exclamation-circle"><span>!</span></div>'+name+'</div>',
                    area: area,
                    content: content,
                    closeBtn: 0,
                });
            }else{
                layer.load();
                $.getJSON("/calc_services", {
                    'id': id,
                    'price':$('#service_money'+cart_id).val(),
                    'val':val,
                    'now_cart_id':cart_id,
                    'cart_ids':"{{$cart_id}}",
                }, function (res) {
                    layer.closeAll('loading');
                    if(res.code==0){
                        //当前购物清单的服务总价
                        $('#service_money'+cart_id).val(res.data.services_sumprice);
                        //当前订单总价
                        $('.final_price').text(res.data.final.final_price);
                        //服务单格
                        $(t).parents(":eq(1)").find('td').eq(4).find('.servicesPrice .serprice').text(res.data.services_price);
                        //服务总价
                        $(t).parents(":eq(6)").find('.layui-colla-title').find('.goods-price').find('.price_num').text(res.data.services_sumprice);
                        //商品总价
                        $(t).parents(":eq(9)").find('.good-info').eq(0).find('.good-operation-right').find('.goods-price').find('.price_num').text(res.data.goods_sumprice);
                    }
                });
                // calc_totalmoney(1800);
            }
        }

        //增加照片
        function add_photonum(t,bignum,cart_id){
            var $ = layui.$
                , form = layui.form
                , layer = layui.layer;

            let val = parseInt($('#cart_photo'+cart_id).find('.photonum').val()) + 1;
            $('#cart_photo'+cart_id).find('.photonum').val(val);

            let num = parseInt($('#cart_photo'+cart_id).find('.remarks-list-wrap .child-order').length)+1;
            let html = '<div class="child-order">\n' +
                '                                        <div class="count-box">\n' +
                '                                            <span>要求'+num+'</span>\n' +
                '                                        </div>\n' +
                '                                        <textarea rows="3" class="layui-textarea photoRequest'+cart_id+'" name="photoRequest'+cart_id+'[]" maxlength="150" autocomplete="on" placeholder="备注拍照特殊要求"></textarea>\n' +
                '                                    </div>';

            $('#cart_photo'+cart_id).find('.remarks-list-wrap').append(html);

            $('#cart_photo'+cart_id).find('.photoNum').text(val);
        }

        //减少照片
        function reduction_photonum(t,cart_id){
            var $ = layui.$
                , form = layui.form
                , layer = layui.layer;

            if($('#cart_photo'+cart_id).find('.photonum').val()>1){
                let val = parseInt($('#cart_photo'+cart_id).find('.photonum').val()) - 1;
                $('#cart_photo'+cart_id).find('.photonum').val(val);
                $('#cart_photo'+cart_id).find('.remarks-list-wrap').find('.child-order').last().remove();
                $('#cart_photo'+cart_id).find('.photoNum').text(val);

                // layer.load();
                // $.getJSON("/calc_services", {
                //     'id': $('#service_id'+cart_id).val(),
                //     'price':$('#photo_money'+cart_id).val(),//已选服务总金额
                //     'num':$(t).parent().parent().find('.photonum').val()
                // }, function (res) {
                //     layer.closeAll('loading');
                //     if(res.code==0){
                //         // let service_money = parseFloat($('#service_money').val()) + parseFloat(res.data.price);
                //         // $('#service_money').val(service_money.toFixed(2));
                //         $('#photo_money'+cart_id).val(res.data.price);
                //     }
                // });
            }
        }

        function surephoto(t,typ,cart_id){
            var $ = layui.$
                , form = layui.form
                , layer = layui.layer;

            if(typ==0){
                $('.photoNum'+cart_id).text('1');
                $('#cart_photo'+cart_id).find('.photonum').val(1);
                $('#cart_photo'+cart_id).find('.remarks-list-wrap').find('.child-order :gt(0)').remove();

                $('.servicesInput'+cart_id).eq(0).prop('checked',false);
                $('.servicesInput'+cart_id).eq(0).val('0');

                $('#photo_money'+cart_id).val(0);
            }else{
                $('.servicesInput'+cart_id).eq(0).prop('checked',true);
                $('.servicesInput'+cart_id).eq(0).val('1');

                var photoRequest = '';
                for(let i=0;i<$('.photoRequest'+cart_id).length;i++){
                    photoRequest += $('.photoRequest'+cart_id).eq(i).val()+'@@@';
                }

                layer.load();
                $.getJSON("/calc_services", {
                    'id': $('#service_id'+cart_id).val(),
                    'price':$('#photo_money'+cart_id).val(),//已选服务总金额
                    'num':$(t).parent().parent().find('.photonum').val(),
                    'photoRequest':photoRequest,
                    'now_cart_id':cart_id,
                    'cart_ids':"{{$cart_id}}",
                    'val':0
                }, function (res) {
                    layer.closeAll('loading');
                    if(res.code==0){
                        $('#service_money'+cart_id).val(res.data.services_sumprice);
                        //拍照数量
                        $(t).parents(":eq(4)").find('td').eq(2).find('.servicesTitle').find('.photoNum').text($(t).parent().parent().find('.photonum').val());
                        //当前订单总价
                        $('.final_price').text(res.data.final.final_price);
                        //服务单格
                        $(t).parents(":eq(3)").find('.servicesPrice .serprice').text(res.data.services_price);
                        //服务总价
                        $(t).parents(":eq(9)").find('.layui-colla-title').find('.goods-price').find('.price_num').text(res.data.services_sumprice);
                        //商品总价
                        $(t).parents(":eq(12)").find('.good-info').eq(0).find('.good-operation-right').find('.goods-price').find('.price_num').text(res.data.goods_sumprice);
                    }
                });
            }

            layer.close(photo_layer);

            // calc_totalmoney(1800);
            return false;
        }
        //选择服务end

        //帮我订购
        function buy_goods(){
            var $ = layui.$
                , layer = layui.layer;

            //判断有无点击确认协议
            @if(!empty($check_content))
                @if(!empty($check_content['confirm']['title'][0]))
                    if($('input[name="confirm"]:checked').length==0){
                        layer.msg('请同意确认协议');return false;
                    }
                @endif

                @if(!empty($check_content['sure']['title'][0]))
                    if($('input[name="sure"]:checked').length==0){
                        layer.msg('请同意确认协议');return false;
                    }
                @endif

                @if(!empty($check_content['knows']['title'][0]))
                    if($('input[name="knows"]:checked').length==0){
                        layer.msg('请同意确认协议');return false;
                    }
                @endif
            @endif

            layer.load();
            $.post('/apply_order',{'cart_id':"{{$cart_id}}",'_token':"{{csrf_token()}}"},function(res) {
                layer.closeAll('loading');
                layer.msg(res.msg,{time:2000}, function () {
                    if (res.code == 0) {
                        window.location.replace("/cart.html?selected=1");
                    }
                });
            },'json');
        }
    </script>

@include('layouts.footer')
@include('layouts.common_function')


