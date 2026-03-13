@include('layouts.header')
<link rel="stylesheet" href="/assets/d2eace91/layui/css/layui.css">
<link rel="stylesheet" href="/assets/d2eace91/js/chosen/chosen.css?v=1.2"/>
<style>
    *{line-height: 24px;}
    .chosen-container-single .chosen-search input[type="text"]{color:#000;}
    body{background:{{$website['background']}} !important;}
    .disf{display:flex;align-items:center;}
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

    .cashierDiv{/*position: fixed;top: 100px;left: 0;*/padding-top:100px;height: 100%;width: 100%;margin-bottom: 70px;}
    .cashierDiv .w1210{width:1210px;margin:0 auto;}
    .cashierDiv .cashier_head{margin-bottom:20px;background:#fff;}
    .cashierDiv .cashier_head .cashier_title{background:{{$website['color']}};color:{{$website['color_word']}};font-size:20px;font-weight: 800;padding:5px 30px;box-sizing: border-box;}
    .cashierDiv .cashier_head .cashier_title .nav_box a{color:{{$website['color_word']}};font-size:15px;margin-right:30px;}
    .cashierDiv .cashier_head .cashier_title .nav_box a:last-child{margin-right:0;}
    .cashierDiv .cashier_head .order_info{justify-content: space-between;padding:5px 15px;box-sizing: border-box;border:1px solid {{$website['color']}};border-top:0;}
    .cashierDiv .cashier_head .order_info .left,.cashierDiv .cashier_head .order_info .right a{font-size:16px;color:{{$website['color']}};font-weight: 800;}
    .cashierDiv .cashier_head .order_money{justify-content: space-between;padding:5px 15px;box-sizing: border-box;border:1px solid {{$website['color_word']}};}
    .cashierDiv .cashier_head .order_money .default_div{color:#000;font-weight: 800;font-size: 16px;}
    .cashierDiv .cashier_head .order_money .active_div{color:#db1d18;font-weight: 800;font-size: 16px;}

    .cashier_body{padding:10px 80px;box-sizing: border-box;background:#E7EFF7;border: 1px solid {{$website['color']}};border-radius: 0;}
    .cashier_body .cashier_list .pay_title{font-size:16px;color:#000;font-weight: 800;}
    .cashier_body .cashier_list .payMethod{border:1px solid {{$website['color']}};border-radius: 8px;background:#fff;padding:10px;box-sizing: border-box;}
    .cashier_body .cashier_list .payMethod .payRadio{margin-right:10px;}
    .cashier_body .cashier_list .payMethod .payIcon{border:1px solid {{$website['color']}};padding:10px 20px;box-sizing: border-box;border-radius: 8px;margin-right:10px;}
    .cashier_body .cashier_list .payMethod .payIcon img{width:125px;height:55px;}
    .cashier_body .cashier_list .payMethod .payInfo .available_balance{color:#000;font-size: 15px;font-weight: 800;}
    .cashier_body .cashier_list .payMethod .payInfo .no_balance{color:#FF5203;font-size: 15px;font-weight: 800;}
    .cashier_body .cashier_list .payMethod .payInfo .need_balance{color:#000;font-size: 15px;font-weight: 800;}
    .cashier_body .cashier_list .payMethod .payInfo .need_balance .currency{color:#db1d18;}
    .cashier_body .cashier_list .payMethod .payInfo .need_balance .price{color:#db1d18;}
    .cashier_body .cashier_list .payMethod .payInfo .payName{color:#000;font-size:18px;font-weight:800;}
    .cashier_body .cashier_list .payMethod .payInfo .payDesc{color:#000;font-size:15px;font-weight:400;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;width: 100%;max-height: 50px;}
    .cashier_body .cashier_list .payMethod .payInfo .payRight .order_currency_pay{color:#000;font-size:15px;font-weight:800;text-align: right; }
    .cashier_body .cashier_list .payMethod .payInfo .payRight .other_currency_pay{color:#db1d18;font-size: 15px;font-weight: 800;}
    .cashier_body .cashier_list .payMethod .payInfo .payRight .to_cny_pay{color:#000;font-size: 15px;font-weight: 800;text-align: right;}
    .cashier_body .cashier_list .payMethod .payCommonStyle{margin-bottom:20px;}
    .cashier_body .cashier_list .payMethod .payCommonStyle:last-child{margin-bottom: 0;}
    /*立即购买组*/
    .cashier_body .btn_group{margin-top:20px;padding:0 10px 0 34px;box-sizing: border-box;display: none;}
    .cashier_body .btn_group .pay_now{border:1px solid {{$website['color']}};padding:10px 20px;box-sizing: border-box;background: #fff;border-radius: 8px;}
    .cashier_body .btn_group .pay_now img{width: 125px;height: 55px;}
    .cashier_body .btn_group .service_div{margin-bottom:10px;}
    .cashier_body .btn_group .service_div .service_name{font-size:15px;margin-left:5px;font-weight: 800;color:#000;}
    .cashier_body .btn_group .service_div .cash_on_delivery{margin-top:0;}
    .cashier_body .btn_group .buy_goods{font-size: 30px;font-weight: 800;color: {{$website['color_word']}};background: {{$website['color']}};padding: 25px 20px;box-sizing: border-box;border-radius: 8px;width: fit-content;margin:0 0 0 auto;cursor:pointer;border:1px solid #fff;}
    .cashier_body .btn_group .icon_hide{display:none;}
    .cashier_body .btn_group .instruction{padding:0px 10px;background:{{$website['color']}};margin-left: 5px;border-radius: 50%;text-align: center;position:relative;cursor:pointer;color:{{$website['color_word']}};font-size: 15px;font-weight: 800;opacity:0.8;box-shadow: 0px 0px 10px 0px #8f8f8f;}

    /*选择框*/
    .selectCountry{margin-bottom:0px;}
    .selectCountry .label_title{font-size:16px;color:#000;margin-right:10px;font-weight: 800;}
    .selectCountry .chosen-container{min-width: 100px;}
    .chosen-container-single .chosen-single span{font-weight: 800;font-size: 16px;color: #000;}
    .chosen-container .chosen-results li{font-size:15px;}

    /*layui-form的radio颜色变化*/
    .layui-form-radio{margin:0;padding:0;}
    .layui-form-radio>i{margin-right: 0}
    .layui-form-radio>i:hover, .layui-form-radioed>i{color:{{$website['color']}};}
    .layui-form-checkbox[lay-skin=primary]{padding-left: 18px;}
    .layui-form-checkbox[lay-skin=primary]:hover i{border-color:{{$website['color']}};}
    .layui-form-checked[lay-skin=primary] i{border:{{$website['color']}};background:{{$website['color']}};}

    .service_div .layui-form-checked[lay-skin=primary] i,.service_div .layui-form-checked[lay-skin=primary] i:hover{color:#000;}
    #translate{display: none;}
    footer{display: block !important;}

    @media (max-width: 992px){
        body{min-width: 100%;}
        #translate{display: block;}
        .navbar-default .navbar-collapse{margin-top:15px;}

        .cashierDiv .w1210{width:100%;}
        .cashierDiv .cashier_head .cashier_title{padding:10px 20px;font-size:18px;}
        .cashierDiv .cashier_head .cashier_title .nav_box a{margin-right:15px;}
        .cashierDiv .cashier_head .order_money{display: block;}
        .cashier_body{padding:10px 20px;}
        .cashier_body .cashier_list .payMethod .payIcon{padding:0;text-align: center;}
        .cashier_body .cashier_list .payMethod .payCommonStyle{display: block;border-bottom:1px solid #000;padding-bottom: 15px;}
        .cashier_body .cashier_list .payMethod .payCommonStyle:last-child{border-bottom:0;padding-bottom: 0;}
        .cashier_body .cashier_list .payMethod .payCommonStyle .payInfo .disf{display: block;}
        .cashier_body .cashier_list .payMethod .payCommonStyle .payInfo .disf .payLeft{max-width: 100% !important;}
        .cashier_body .cashier_list .payMethod .payInfo .payRight .order_currency_pay{text-align: right !important;}
        .cashier_body .cashier_list .payMethod .payInfo .payRight .to_cny_pay{text-align: right !important;}
        .cashier_body .cashier_list .payMethod .payInfo .payRight .other_currency_pay{text-align: right !important;}
    }
</style>

<div class="cashierDiv">
    <div class="w1210">
        <div class="cashier_head">
            <div class="cashier_title disf" style="justify-content: space-between;">
                <div class="left_title">
                    <span style="font-size:22px;margin-right:5px;">③</span><span>结算中心&nbsp;&gt;&nbsp;订单支付</span>
                </div>
                <div class="nav_box">
                    <a href="/cart.html?selected=0" target="_blank" class="nav_div">选购中心</a>
                    <a href="/cart.html?selected=1" target="_blank" class="nav_div">订购中心</a>
                </div>
            </div>

            <div class="disf order_info">
                <div class="left">订单编号：{{$order['ordersn']}}</div>
                <div class="right"><a href="/cart/cart_detail?id={{$order['id']}}" target="_blank">订单详情</a></div>
            </div>
            <div class="disf order_money">
                <div class="yingfu_div default_div">订单应付：<span class="currency">{{$order['currency']}}</span>&nbsp;<span class="price">{{$order['true_money']}}</span></div>
                <div class="weifu_div default_div">
                    @if($order['status']==-14 || $order['status']==0)
                    <div class="disf selectCountry">
                        <div class="label_title">使用</div>
                        <div class="label_content">
                            <select id="selectCity" onchange="selectCountry(this)" class="chosen-select country-select">
                                <option value="">请选择国家地区</option>
                                @foreach($country as $k=>$v)
                                    <option value="{{$v['id']}}">{{$v['param2']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <span style="margin-left:10px;">的支付</span>
                    </div>
                    @endif
                </div>
                <div class="shifu_div active_div">订单实付：<span class="currency"></span>&nbsp;<span class="price">0.00</span></div>
            </div>
        </div>
        <div class="cashier_body">
            <div class="cashier_div">

            </div>

            <div class="btn_group">
{{--                <div class="pay_now">--}}
{{--                    <img src="//shop.gogo198.cn/collect_website/public/uploads/centralize/website_pay/67205bdfc5bba.png" alt="">--}}
{{--                </div>--}}

                @if($cash_on_delivery['cash_on_delivery']==2)
                    <div class="service_div disf" style="justify-content: end;">
                        <div class="layui-form">
                            <input type="checkbox" name="cash_on_delivery" id="cash_on_delivery" lay-skin="primary" lay-filter="cash_on_delivery">
                        </div>
                        <div class="service_name">货到付款</div>
                        <div class="icon_hide instruction" title="点击查看详情" onclick="view_instruction(this)" data-down_payment="{{$cash_on_delivery['down_payment']}}" data-prepaid_method="{{$cash_on_delivery['prepaid_method']}}" data-prepaid_percent="{{$cash_on_delivery['prepaid_percent']}}" data-prepaid_currency="{{$cash_on_delivery['prepaid_currency']}}" data-prepaid_amount="{{$cash_on_delivery['prepaid_amount']}}">!</div>
                    </div>
                @endif
                <div class="buy_goods domestic_pay" onclick="pay_order()">
                    立即支付
                </div>
                <!--paypal参数==START==-->
                <div id="paypal_pay" style="display: none;padding: 10px 20px;box-sizing: border-box;overflow-y:auto;"></div>
                <div id="result-message" style="display: none;"></div>
                <!--paypal参数==END==-->
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')
<script src="/assets/d2eace91/layui/layui.js"></script>
<script src="/assets/d2eace91/js/chosen/jquery.chosen.js?v=1.3"></script>

{{--<script src="https://www.paypal.com/sdk/js?client-id=AebwMIVqGwMKSszXOecOoGoDayjcvAt6kV6m83Oqtvk0mus5mH-PwyjXMPUT25BRtNgyIjKDHyMx5D9p&buyer-country=US&currency=USD&components=buttons,applepay,googlepay&enable-funding=venmo,paylater,card" data-sdk-integration-source="developer-studio"></script>--}}
<script src="https://www.paypal.com/sdk/js?client-id=Ac6L5MpzRfeUvYqDUknEzE-xtEAdpiI3s3Y3HU-o1pCTgHq8N0qOrtNIOaU_AgxeKL2UrZCxtLUiOdXs&currency=USD"></script>
<script type="text/javascript" charset="utf-8">
    $('.country-select').chosen();

    layui.use(['layer','element','upload','form'],function() {
        var $ = layui.$
            , layer = layui.layer
            , element = layui.element
            , form = layui.form
            , upload = layui.upload;

        //货到付款
        form.on('checkbox(cash_on_delivery)', function(data){
            // console.log(data.elem); // 获取当前被点击的checkbox元素
            // console.log(data.elem.checked); // 获取当前checkbox是否被选中
            // console.log(data.value); // 获取当前checkbox的值

            if(data.elem.checked==true){
                //选中货到付款
                $(this).parents(':eq(1)').find('.instruction').show();

                //计算货到付款的需支付金额
                let country = $('#selectCity').val();
                cash_on_delivery(country,2);
            }
            else{
                $(this).parents(':eq(1)').find('.instruction').hide();
                let country = $('#selectCity').val();
                cash_on_delivery(country,1);
            }
        });

    });
    
    //查看货到付款说明信息
    function view_instruction(t){
        var $ = layui.$
            , layer = layui.layer;

        let down_payment = $(t).attr('data-down_payment');
        let prepaid_method = $(t).attr('data-prepaid_method');
        let prepaid_percent = $(t).attr('data-prepaid_percent');
        let prepaid_currency = $(t).attr('data-prepaid_currency');
        let prepaid_amount = $(t).attr('data-prepaid_amount');

        let txt_str = '支持货到付款，';
        if(down_payment==1){
            //预付定金-不支持
            txt_str += '不需要预付定金。'
        }
        else if(down_payment==2){
            txt_str += '需要预付定金。<br/>';
            if(prepaid_method==1){
                //按比例
                txt_str += '预付收费方式：按比例。<br/>预付金额计算：商品售价 * 购买数量 * '+prepaid_percent+'% ';
            }
            else if(prepaid_method==2){
                //按定额
                txt_str += '预付收费方式：按订单。<br/>预付金额计算：'+prepaid_currency+' '+prepaid_amount+'/订单';
            }

        }

        open_frame('收费方式',txt_str,'','','','',2,['300px','200px'],0);
    }

    //选择国家显示相应的支付通道
    function selectCountry(t){
        let val = $(t).val();

        if(val>0){
            $.post('/get_cashier_country', {'country':val,'orderid':{{$order['id']}},'cash_on_delivery':1}, function(res) {
                order_template(res,val);
            }, 'json');
        }
    }

    //计算货到付款的需支付金额
    function cash_on_delivery(country,cash_on_delivery){
        $.post('/get_cashier_country', {'country':country,'orderid':{{$order['id']}},'cash_on_delivery':cash_on_delivery}, function(res) {
            order_template(res);
        }, 'json');
    }

    //循环支付通道相应信息
    function order_template(res,country_id=0){
        var $ = layui.$
            , layer = layui.layer
            , form = layui.form;

        if(res.code==-1){
            layer.msg(res.msg);
            $('.cashier_div').html("");
            $('.btn_group').hide();
        }else{
            if(res.data.length>0){
                //订单实付
                $('.shifu_div').find('.currency').text(res.shifu.currency);
                if(res.shifu.reduce_price>0){
                    $('.shifu_div').find('.price').text(res.shifu.price + '(抵扣：'+res.shifu.reduce_price+')');
                }
                else{
                    $('.shifu_div').find('.price').text(res.shifu.price);
                }

                //循环遍历支付通道
                let html = '';
                for(let i=0;i<res.data.length;i++){
                    if(res.data[i].type==11){
                        //余额支付（废弃）
                        html += '<div class="cashier_list">\n' +
                            '                <p class="pay_title">'+res.data[i].name+'</p>\n'+
                            '                <div class="payMethod">\n';
                        for(let i2=0;i2<res.data[i].children.length;i2++) {
                            html += '            <div class="disf">\n' +
                                '                        <input type="radio" name="payMethod" id="balance" class="payRadio" value="0" checked>\n' +
                                '                        <div class="payIcon">\n' +
                                '                            <img src="//shop.gogo198.cn/' + res.data[i].children[i2].icon + '" alt="">\n' +
                                '                        </div>\n' +
                                '                        <div class="payInfo">\n' +
                                '                            <span class="available_balance">可用余额：<span class="currency">'+res.currency+' </span><span class="price">0.00</span></span>，<span class="no_balance">余额不足</span>，<span class="need_balance">还需充值：<span class="currency">'+res.currency+' </span><span class="price">'+true_money+'</span></span>\n' +
                                '                        </div>\n' +
                                '                    </div>\n';
                        }
                        html += '                </div>\n'+
                            '            </div>';
                    }
                    else if(res.data[i].type==22){
                        //银行转账（废弃）
                        html += '<div class="cashier_list" style="margin-top:30px;">\n' +
                            '                    <p class="pay_title">'+res.data[i].name+'</p>\n'+
                            '                    <div class="payMethod">\n';
                        for(let i2=0;i2<res.data[i].children.length;i2++) {
                            html += '                    <div class="disf">\n' +
                                '                                <input type="radio" name="payMethod" id="settle1_'+res.data[i].children[i2].id+'" class="payRadio" value="'+res.data[i].children[i2].id+'">\n' +
                                '                                <div class="payIcon">\n' +
                                '                                    <img src="//shop.gogo198.cn/'+res.data[i].children[i2].icon+'" alt="">\n' +
                                '                                </div>\n' +
                                '                                <div class="payInfo">\n' +
                                '                                    <div class="payName">'+res.data[i].children[i2].name+'</div>\n' +
                                '                                    <div class="payDesc">'+res.data[i].children[i2].remark+'</div>\n' +
                                '                                            <div class="payDesc">说明：'+res.data[i].children[i2].rate_remark+'（汇率='+res.data[i].children[i2].rate+'）</div>\n' +
                                '                                </div>\n' +
                                '                            </div>\n';
                        }
                        html += '                        </div>\n'+
                            '                </div>';
                    }
                    else if(res.data[i].type==2 || res.data[i].type==3 || res.data[i].type==1){
                        //银行转账+网上支付+余额支付
                        html += '<div class="cashier_list" style="margin-top:30px;">\n' +
                            '                    <p class="pay_title">'+res.data[i].name+'</p>\n' +
                            '                    <div class="payMethod">\n';
                        for(let i2=0;i2<res.data[i].children.length;i2++) {
                            html += '                    <div class="payCommonStyle disf">\n' +
                                '                                <input type="radio" name="payMethod" id="settle2_'+res.data[i].children[i2].id+'" class="payRadio" value="'+res.data[i].children[i2].id+'" onclick="checkPay(this,'+res.data[i].children[i2].pay_id+',\''+res.data[i].children[i2].name+'\')">\n' +
                                '                                <div class="payIcon">\n' +
                                '                                    <img src="//shop.gogo198.cn/'+res.data[i].children[i2].icon+'" alt="">\n' +
                                '                                </div>\n' +
                                '                                <div class="payInfo" style="width: 100%;">\n' +
                                '                                    <div class="disf" style="justify-content: space-between;">\n' +
                                '                                        <div class="payLeft left" style="max-width:75%;">\n' +
                                '                                            <div class="payName">'+res.data[i].children[i2].name+'</div>\n' +
                                '                                            <div class="payDesc">'+res.data[i].children[i2].remark+'</div>\n' +
                                '                                            <div class="payDesc">汇率说明：'+res.data[i].children[i2].rate_remark+'（汇率='+res.data[i].children[i2].rate+'）</div>\n' +
                                '                                        </div>\n' +
                                '                                        <div class="payRight right">\n' +
                                '                                            <div class="order_currency_pay">订单费用：<span class="currency">'+res.data[i].children[i2].currency+'</span>&nbsp;<span class="price">'+res.data[i].children[i2].order_money+'</span></div>\n' +
                                '                                            <div class="to_cny_pay" style="text-align: left;">手续费用：<span class="currency">'+res.data[i].children[i2].currency+'</span>&nbsp;<span class="price">'+res.data[i].children[i2].rate_money+'</span></div>\n' +
                                '                                            <div class="other_currency_pay" style="text-align: left;">实付费用：<span class="currency">'+res.data[i].children[i2].currency+'</span>&nbsp;<span class="price">'+res.data[i].children[i2].true_money+'</span></div>\n' +
                                '                                        </div>\n' +
                                '                                    </div>\n' +
                                '                                </div>\n' +
                                '                            </div>\n';

                            if(country_id!=162){
                                if(res.data[i].children[i2].pay_id==3){
                                    //paypal支付
                                    window.paypal.Buttons({
                                        style: {
                                            shape: "rect",
                                            layout: "vertical",
                                            color: "gold",
                                            label: "paypal",
                                        },
                                        message: {
                                            amount: 100,
                                        },
                                        async createOrder() {
                                            try {
                                                //原生paypal请求
                                                const response = await fetch("https://shop.gogo198.cn/collect_website/public/?s=/api/paypal/index", {
                                                    method: "POST",
                                                    headers: {
                                                        "Content-Type": "application/x-www-form-urlencoded",
                                                    },
                                                    body: JSON.stringify({
                                                        info:{
                                                            id:"{{$order['id']}}",//订单id
                                                            currency:"{{$order['currency']}}",//订单币种
                                                            true_money:"{{$order['true_money']}}",//订单总金额
                                                            handing_fee:res.data[i].children[i2].rate_money,//手续费
                                                        },
                                                        {{--cart: [--}}
                                                        {{--    {--}}
                                                        {{--        id: "$order['id']",--}}
                                                        {{--        quantity: 2,--}}
                                                        {{--        currency:"$order['currency']",--}}
                                                        {{--        true_money:"$order['true_money']"--}}
                                                        {{--    },--}}
                                                        {{--],--}}
                                                        type: 'orders',//创建类型
                                                    }),
                                                });
                                                const orderData = await response.json();
    
                                                if (orderData.id) {
                                                    return orderData.id;
                                                }
                                                const errorDetail = orderData?.details?.[0];
                                                const errorMessage = errorDetail
                                                    ? `${errorDetail.issue} ${errorDetail.description} (${orderData.debug_id})`
                                                    : JSON.stringify(orderData);
    
                                                throw new Error(errorMessage);
                                            } catch (error) {
                                                console.log(error);
                                                // resultMessage(`Could not initiate PayPal Checkout...<br><br>${error}`);
                                            }
                                        } ,
                                        async onApprove(data, actions) {
                                            // console.log(data,111);
                                            try {
                                                // const response = await fetch(`/api/orders/${data.orderID}/capture`,
                                                const response = await fetch(`https://shop.gogo198.cn/collect_website/public/?s=/api/paypal/index`,
                                                    {
                                                        method: "POST",
                                                        headers: {
                                                            "Content-Type": "application/x-www-form-urlencoded",
                                                        },
                                                        body:JSON.stringify({
                                                            type:data.orderID+'/capture',
                                                            paymentSource:data.paymentSource,
                                                        }),
                                                    }
                                                );
    
                                                const orderData = await response.json();
                                                // Three cases to handle:
                                                //   (1) Recoverable INSTRUMENT_DECLINED -> call actions.restart()
                                                //   (2) Other non-recoverable errors -> Show a failure message
                                                //   (3) Successful transaction -> Show confirmation or thank you message
    
                                                const errorDetail = orderData?.details?.[0];
    
                                                if (errorDetail?.issue === "INSTRUMENT_DECLINED") {
                                                    // (1) Recoverable INSTRUMENT_DECLINED -> call actions.restart()
                                                    // recoverable state, per
                                                    // https://developer.paypal.com/docs/checkout/standard/customize/handle-funding-failures/
                                                    return actions.restart();
                                                } else if (errorDetail) {
                                                    // (2) Other non-recoverable errors -> Show a failure message
                                                    throw new Error(
                                                        `${errorDetail.description} (${orderData.debug_id})`
                                                    );
                                                } else if (!orderData.purchase_units) {
                                                    throw new Error(JSON.stringify(orderData));
                                                } else {
                                                    // (3) Successful transaction -> Show confirmation or thank you message
                                                    // Or go to another URL:  actions.redirect('thank_you.html');
                                                    const transaction =
                                                        orderData?.purchase_units?.[0]?.payments
                                                            ?.captures?.[0] ||
                                                        orderData?.purchase_units?.[0]?.payments
                                                            ?.authorizations?.[0];
                                                    resultMessage(
                                                        `Transaction ${transaction.status}: ${transaction.id}<br/>
              <br/>See console for all available details`
                                                    );
                                                    console.log(
                                                        "Capture result",
                                                        orderData,
                                                        JSON.stringify(orderData, null, 2)
                                                    );
    
                                                    //支付完成后跳转到已结账中心
                                                    if(orderData['status']=='COMPLETED'){
                                                        layer.msg('支付成功!正在跳转订购中心【已结算】',{time:2000}, function () {
                                                            window.location.href='/cart.html?selected=3';
                                                        });
                                                    }
                                                }
                                            } catch (error) {
                                                console.log(error);
                                                resultMessage(
                                                    `Sorry, your transaction could not be processed...<br/><br/>${error}`
                                                );
                                            }
                                        } ,
                                    }).render('#paypal_pay');
                                }    
                            }
                            

                            //paypal消息打印
                            function resultMessage(message) {
                                const container = document.querySelector("#result-message");
                                container.innerHTML = message;
                            }

                        }
                        html += '                    </div>\n' +
                            '                </div>';

                        form.render('');
                    }
                }

                $('.cashier_div').html(html);
                $('.btn_group').show();
            }
        }
    }

    //判断支付单选按钮是否选中
    var paypal_frame_div;
    function checkPay(t,pay_id=0,pay_name=''){
        var $ = layui.$
            , layer = layui.layer;

        if($(t).is(':checked') && pay_id==3) {
            let area = ['300px', '270px'];
            paypal_frame_div = layer.open({
                skin:'layer_frame',
                type: 1,
                title: '<div class="disf"><div class="exclamation-circle"><span>!</span></div>'+pay_name+'</div>',
                area: area,
                content: $('#paypal_pay'),
                end:function(res){
                    //刷新页面
                    layer.close(paypal_frame_div);
                    $(t).prop('checked',false);
                }
            });
        }
        else{
            $('#paypal_pay').hide();
            layer.close(paypal_frame_div);
        }
    }

    //立即支付
    function pay_order(){
        var $ = layui.$
            , layer = layui.layer;

        //查看有无选择支付信息
        var payMethod = $('input[name="payMethod"]:checked').val();
        if(payMethod>0){
            layer.load();
            //是否货到付款，1否，2是
            var cash_on_delivery = 1;
            @if($cash_on_delivery['cash_on_delivery']==2)
                cash_on_delivery = 2;
            @endif
            
            
            $.post("/cart/create_order", {'oid':"{{$order['id']}}",'typ':2,'pay_id':payMethod, '_token': "{{csrf_token()}}",'cash_on_delivery':cash_on_delivery}, function (res) {
                layer.closeAll('loading');
                // layer.msg(res.msg, {time: 2000}, function () {
                if (res.code == 0) {
                    let area = ['300px', '250px'];

                    let html = '<div class="body" style="padding:10px;box-sizing: border-box;text-align:center;"><img src="'+res.data.code_url+'?v=<?php echo time();?>" style="width:150px;height:150px;"><p>请打开微信扫码进入支付</p></div>';
                    var layer_frame_div = layer.open({
                        skin:'layer_frame',
                        type: 1,
                        title: '<div class="disf"><div class="exclamation-circle"><span>!</span></div>请打开微信扫码进入支付</div>',
                        area: area,
                        content: html,
                        end:function(res){
                            //刷新页面
                            window.location.reload();
                        }
                    });

                    //查询结果刷新
                    setInterval(function(){
                        $.post("/cart/create_order", {'oid':"{{$order['id']}}",'typ':4,'pay_id':payMethod, '_token': "{{csrf_token()}}",'cash_on_delivery':cash_on_delivery}, function (res) {
                            if(res.code==0){
                                layer.msg(res.msg,{time:2000}, function () {
                                    window.location.href="https://www.gogo198.cn/cart/cart_detail?id={{$order['id']}}";
                                });
                            }
                        });
                    },1500);
                }
                else if (res.code == -1){
                    //弹出公众号二维码框
                    let area = ['320px', '320px'];
                    // if (IsPhone()) {
                    //     area = ['90%', '60%'];
                    // }
                    // layer.open({
                    //     skin: 'grey_div',
                    //     type: 1,
                    //     title: '进入“Gogo購購网”微信小程序并关注公众号',
                    //     area: area,
                    //     content: '<div style="padding:10px;box-sizing:border-box;text-align: center;color:#000;"><img src="/images/gogo_miniprogram.png" style="max-width:150px;width:100%;margin-bottom:10px;"><p class="f15" style="font-size: 15px;">为了提供更多的服务，请登录小程序并关注我司公众号“Gogo購購网”</p><br/><p style="font-size:15px;" class="f15">完成上述操作后，请手动刷新页面</p></div>'
                    // });

                    let html = '<div class="body" style="padding:10px;box-sizing: border-box;text-align: center;"><img src="/images/gogo_miniprogram.png" style="max-width:150px;width:100%;margin-bottom:10px;"><p class="f15" style="font-size: 15px;">为了提供更多的服务，请登录小程序并关注我司公众号“Gogo購購网”</p><br/><p style="font-size:15px;" class="f15">完成上述操作后，请手动刷新页面</p></div>';
                    var layer_frame_div = layer.open({
                        skin:'layer_frame',
                        type: 1,
                        title: '<div class="disf"><div class="exclamation-circle"><span>!</span></div>进入“Gogo購購网”微信小程序并关注公众号</div>',
                        area: area,
                        content: html,
                        end:function(res){
                            //刷新页面
                            window.location.reload();
                        }
                    });
                }
                // });
            }, 'json');
        }
        else{
            layer.msg('请选择支付方式');
            return false;
        }
    }
</script>
@include('layouts.common_function')