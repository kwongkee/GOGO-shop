@extends('layouts.goods_header')
<link rel="stylesheet" href="/assets/d2eace91/layui/css/layui.css?v=23121"/>
<script type="text/javascript" src="/assets/d2eace91/layui/layui.js"></script>

@section('content')
    <style type="text/css" media="all">
        *{line-height:24px;}
        body{background:{{$website['background']}} !important;}
        .title{font-size:30px;font-weight:600;color:{{$website['fontcolor']}};text-align:center;margin:18px 0;}
        /*.disf{display:flex;align-items: center;}*/
        #content{padding:20px 0;}
        #content .container{margin-top:20px;}
        #content .container .content{border: 1px solid {{$website['fontcolor']}};padding:30px 20px 60px;box-sizing:border-box;position:relative;margin-top:10px;height:630px;background:{{$website['content']}};}
        #content .container .content .in_mask{background-color: #000;opacity: 0.4;position: absolute;left: 0;top: 0;height: 100%;width: 100%;z-index: 1;}
        #content .container .content .contents{z-index:2;position:relative;color:#000;font-size: 15px;}
        #content .container{padding-bottom:0px;}
        #content .color_word{font-size:15px;padding: 15px 10px;box-sizing:border-box;}

        .contents img{width:100%;}
        .content{position: relative;}


        @media (min-width: 993px) {
            .contents img{width:500px;}
        }
        @media (min-width: 1000px){
            #content .container{padding-top:30px;}
            #content{padding-top:0;margin:0;}
            /*.need_service_box{margin-top: 180px;margin-left: 180px;}*/
            .main_img,.color_word{width:400px;height:280px;text-align:center;margin:20px auto;}
        }
        @media (max-width: 992px){
            .main_img,.color_word{width:100%;height:250px;text-align:center;margin:20px auto;}
            .color_word{padding:30px;box-sizing:border-box;}
            .detail_topimg, .non_topimg{margin-top:85px;}
            .title{line-height: 30px;}
        }
        .need_service,.need_share,.need_advice{padding:7px 10px;box-sizing:border-box;font-size:15px;font-weight:800;box-shadow:1px 1px 10px #333;text-align:center;/* margin-top:15px; */border:1px solid #D2A778;color:#ffffff;background:#0B2074;white-space:nowrap;}

        .detail_container .row .about-logo *{background:#666666 !important;font-size:16px;}
        .detail_container .row .about-logo img{box-shadow:1px 1px 15px #000;}

        .box_content a:nth-of-type(1){display:none;}
        .box_content a:nth-of-type(2){display:none;}
        a{color:#fff;}
        .navbar_menu{color:{{$website['fontcolor']}};font-size:16px;}
        .navbar_menu a{color:{{$website['fontcolor']}};}
        .navbar_menu a:last-child{color:{{$website['fontcolor']}};font-weight:700;}
        .page_box{padding:10px 0;box-sizing: border-box;justify-content: space-between;color:#fff;padding-bottom:0;}
        .page_box a{color:#fff;}

        footer{display: block !important;}
        .footer ul.social-network li{height:24px !important;}

        .content .currency{width:100px;}

        @if($isframe==1)
            header,footer{display: none !important;}
            .header,.footer,.navbar_menu{display:none;}
            .w1200{width:100%;}
            #content{margin-top:0;padding-top:0;}
            #content .container{margin-top:0px;}
            #content .container .content{height:400px;}
        @endif
    </style>


    <section id="content" class="non_topimg" style="background: {{$website['background']}};">
        <div class="w1200">
            <div class="container detail_container">
                <p class="navbar_menu"><a href="/">HOME</a>&nbsp;<span style="color:{{$website['fontcolor']}};">\</span>&nbsp;人民币兑换{{$data['name']}}汇率</p>
{{--                <hr style="border-top:1px solid #fff;">--}}
            </div>
            <div class="container" style="padding-top:0;">
                <div class="title">人民币兑换{{$data['name']}}汇率</div>
                <div class="content" >
                    <div class="contents">
{{--                        <p>汇率：<span class="rate">{$data['rate']}</span></p>--}}
{{--                        <p>1人民币&nbsp;≈&nbsp;?php echo number_format(1*$data['rate'],3);?{$data['name']}</p>--}}
{{--                        ?php $ex_rate = number_format(1/$data['rate'],3);?--}}
{{--                        <p>1{$data['name']}&nbsp;≈&nbsp;?php echo $ex_rate;?人民币</p>--}}

                        <form class="layui-form" action="" lay-filter="component-form-group">
                            <div class="disf">
                                <div class="leftBox disf">
                                    <select name="from_currency" id="from_currency" lay-filter="from_currency" lay-search>
                                        <option value="158" selected>CNY：人民币</option>
                                        @foreach($currency as $k=>$v)
                                            <option value="{{$v['id']}}">{{$v['symbol']}}：{{$v['name']}}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" class="layui-input currency" name="from_money" id="from_money" value="{{$price}}" onchange="from_moneys(this)">
                                </div>
                                <div class="rightBox disf">
                                    <p style="color:#fff;font-size:18px;">&nbsp;≈&nbsp;</p>
                                    <select name="to_currency" id="to_currency" lay-filter="to_currency" lay-search>
                                        <option value="158">CNY：人民币</option>
                                        @foreach($currency as $k=>$v)
                                            <option value="{{$v['id']}}" @if($v['id']==$id)
                                                selected
                                            @endif>{{$v['symbol']}}：{{$v['name']}}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" class="layui-input currency" name="to_money" id="to_money" value="<?php echo number_format(1*$data['rate'], 3);?>" readonly>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="/assets/d2eace91/js/jquery.js?v=1.1"></script>
    <script>
        function IsPhone() {
            var info = navigator.userAgent;
            var isPhone = /mobile/i.test(info);
            return isPhone;
        }

        layui.use(['layer','form','laydate','upload','element'],function() {
            var $ = layui.$
                , layer = layui.layer
                , form = layui.form
                , laydate = layui.laydate
                , element = layui.element
                , upload = layui.upload;

            form.render(null,'component-form-group');

            form.on('select(from_currency)',function(data) {
                let val = data.value;
                let from_money = $('#from_money').val();
                let to_currency = $('#to_currency').val();

                if(from_money>0){
                    layer.load();
                    $.ajax({
                        url: "/rate_detail",
                        method: 'post',
                        data: {'pa': 1, 'from_currency': val,'from_money':from_money,'to_currency':to_currency, '_token': "{{csrf_token()}}"},
                        dataType: 'JSON',
                        success: function (res) {
                            layer.msg(res.msg,{time:2000}, function () {
                                if(res.code == 0)
                                {
                                    $('#to_money').val(res.data.money);
                                }
                            });
                            layer.closeAll('loading');
                        }
                    });
                }
            });

            form.on('select(to_currency)',function(data) {
                let val = data.value;
                let from_money = $('#from_money').val();
                let from_currency = $('#from_currency').val();

                if(from_money>0){
                    layer.load();
                    $.ajax({
                        url: "/rate_detail",
                        method: 'post',
                        data: {'pa': 1, 'from_currency': from_currency,'from_money':from_money,'to_currency':val, '_token': "{{csrf_token()}}"},
                        dataType: 'JSON',
                        success: function (res) {
                            layer.msg(res.msg,{time:2000}, function () {
                                if(res.code == 0)
                                {
                                    $('#to_money').val(res.data.money);
                                }
                            });
                            layer.closeAll('loading');
                        }
                    });
                }
            });
            @if($isframe==1 && $price>=1)
                get_moneys();
            @endif
        });

        function get_moneys(){
            layer.load();
            $.ajax({
                url: "/rate_detail",
                method: 'post',
                data: {'pa': 1, 'from_currency': 158,'from_money':"{{$price}}",'to_currency':1, '_token': "{{csrf_token()}}"},
                dataType: 'JSON',
                success: function (res) {
                    layer.msg(res.msg,{time:2000}, function () {
                        if(res.code == 0)
                        {
                            $('#to_money').val(res.data.money);
                        }
                    });
                    layer.closeAll('loading');
                }
            });
        }

        function from_moneys(t){
            let val = $(t).val();

            if(val>0){
                let to_currency = $('#to_currency').val();
                let from_currency = $('#from_currency').val();
                layer.load();
                $.ajax({
                    url: "/rate_detail",
                    method: 'post',
                    data: {'pa': 1, 'from_currency': from_currency,'from_money':val,'to_currency':to_currency, '_token': "{{csrf_token()}}"},
                    dataType: 'JSON',
                    success: function (res) {
                        layer.msg(res.msg,{time:2000}, function () {
                            if(res.code == 0)
                            {
                                $('#to_money').val(res.data.money);
                            }
                        });
                        layer.closeAll('loading');
                    }
                });
            }
        }
    </script>
@stop