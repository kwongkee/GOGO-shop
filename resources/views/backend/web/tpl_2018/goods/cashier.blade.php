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
    .searchBox .searchContent{border-radius: 40px;background: #fff;height: 38px;border:1px solid #fff;width: 100%;}
    .searchBox .selectBox select{border:0;background: none;font-size: 22px;text-align: center;}
    .searchBox .inputBox{height: 100%;width: 100%;box-shadow: 0px 0px 2px 1px #fff;border-radius: 40px;}
    .searchBox .inputBox .nameBox {padding:0px 0px 0px 20px;position: relative;width: 100%;overflow: hidden;display:flex;align-items: center;}
    .searchBox .inputBox .nameBox input{border:0;width:100%;padding-right:5px;text-align: right;font-weight: 800;}
    .searchBox .inputBox .btnBox{width:60px;height:100%;background:{{$website['color']}};display: flex;align-items: center;justify-content: center;border-top-right-radius: 40px;border-bottom-right-radius: 40px;padding:5px 0 0 5px;cursor: pointer;}
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
    .cashierDiv .cashier_head .order_money{justify-content: space-between;padding:5px 15px;box-sizing: border-box;border:1px solid {{$website['color']}};border-top:0;}
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
    .cashier_body .btn_group .buy_goods{font-size: 30px;font-weight: 800;color: #fff;background: {{$website['color']}};padding: 25px 20px;box-sizing: border-box;border-radius: 8px;width: fit-content;margin:0 0 0 auto;cursor:pointer;}

    /*选择框*/
    .selectCountry{margin-bottom:0px;}
    .selectCountry .label_title{font-size:16px;color:#000;margin-right:10px;font-weight: 800;}
    .selectCountry .chosen-container{min-width: 100px;}
    .chosen-container-single .chosen-single span{font-weight: 800;font-size: 16px;color: #000;}
    .chosen-container .chosen-results li{font-size:15px;}

    #translate{display: none;}
    footer{display: block !important;}
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
                <div class="buy_goods" onclick="pay_order()">
                    立即支付
                </div>
            </div>
        </div>
    </div>
</div>


@include('layouts.footer')
<script src="/assets/d2eace91/layui/layui.js"></script>
<script src="/assets/d2eace91/js/chosen/jquery.chosen.js?v=1.3"></script>
<script type="text/javascript" charset="utf-8">
    $('.country-select').chosen();

    layui.use(['layer','element','upload','form'],function() {
        var $ = layui.$
            , layer = layui.layer
            , element = layui.element
            , form = layui.form
            , upload = layui.upload;
    });

    function selectCountry(t){
        let val = $(t).val();

        if(val>0){
            $.post('/get_cashier_country', {'country':val,'orderid':{{$order['id']}}}, function(res) {
                if(res.code==-1){
                    layer.msg(res.msg);
                    $('.cashier_div').html("");
                    $('.btn_group').hide();
                }else{
                    if(res.data.length>0){
                        //订单实付
                        $('.shifu_div').find('.currency').text(res.shifu.currency);
                        $('.shifu_div').find('.price').text(res.shifu.price);

                        //循环遍历支付通道
                        let html = '';
                        for(let i=0;i<res.data.length;i++){
                            if(res.data[i].type==11){
                                //余额支付
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
                                //银行转账
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
                                //网上支付
                                html += '<div class="cashier_list" style="margin-top:30px;">\n' +
                                    '                    <p class="pay_title">'+res.data[i].name+'</p>\n' +
                                    '                    <div class="payMethod">\n';
                                    for(let i2=0;i2<res.data[i].children.length;i2++) {
                                        html += '                    <div class="payCommonStyle disf">\n' +
                                        '                                <input type="radio" name="payMethod" id="settle2_'+res.data[i].children[i2].id+'" class="payRadio" value="'+res.data[i].children[i2].id+'">\n' +
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
                                    }
                                html += '                    </div>\n' +
                                    '                </div>';
                            }
                        }

                        $('.cashier_div').html(html);
                        $('.btn_group').show();
                    }
                }
            }, 'json');
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
            $.post("/cart/create_order", {'oid':"{{$order['id']}}",'typ':2,'pay_id':payMethod, '_token': "{{csrf_token()}}"}, function (res) {
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