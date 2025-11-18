@extends('layouts.inner_header')

@section('content')
    <style>
        *{line-height: 24px;}
        .login-form .login-con{box-sizing: revert;}
        .login-wrap .form-group .text {border-bottom: 1px solid #ddd !important;}
    </style>
    <link rel="stylesheet" href="/assets/d2eace91/iconfont/iconfont.css?v=1.1"/>
    <link rel="stylesheet" href="/css/common.css?v=1.1"/>
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

@section('header_css')
    <link rel="stylesheet" href="/css/flow.css?v=20180702"/>
@stop

<div class="w1210" id="content">
    {{--引入列表--}}

    <link rel="stylesheet" href="/assets/d2eace91/layui/css/layui.css?v=23121"/>
    <link rel="stylesheet" href="/assets/d2eace91/js/layer/theme/default/layer.css?v=3.1.0" id="layuicss-layer">
    <script type="text/javascript" src="/assets/d2eace91/layui/layui.js"></script>
    <style>
        body{background:{{$website['background']}};}
        .cart-content{min-height:600px;}
        .cart-empty{width:100%;}
        .cart-empty .message{text-align: center;padding-top: 15%;}
        .cart-empty .message img{width:180px;}
        .cart-empty .message .txt{font-size:20px;font-weight: 600;margin-top:15px;}
        .cart-empty .message .btn-link{font-size:18px;font-weight: 600;background:#1f5188;color:#fff;border-radius:15px;padding:5px 20px;box-sizing: border-box;}

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

        .payorderDiv{min-height:600px;padding:15px 10px;background:#fff;}
        .payorderDiv .payorderHead{display: grid;grid-template-columns: repeat(2,1fr);-moz-column-gap: 10px;column-gap: 10px;row-gap: 10px;}
        .payorderDiv .payorderHead .detail{padding-left:10%;}
        .payorderDiv .payorderHead .detailName{font-size: 15px;font-weight: 600;margin-right: 10px;}
        .payorderDiv .payorderHead .detailVal{font-size: 15px;font-weight: 600;}
        .payorderDiv .buy_list{font-size: 15px;font-weight: 600;text-align: center;margin-top:10px;}
    </style>
    <div class="payorderDiv">
        <div class="payorderHead">
            <div class="detail disf">
                <div class="detailName">订单编号</div>
                <div class="detailVal">{{$payorder['ordersn']}}</div>
            </div>
            <div class="detail disf">
                <div class="detailName">交易时间</div>
                <div class="detailVal">{{$payorder['paytime']}}</div>
            </div>
            <div class="detail disf">
                <div class="detailName">支付方式</div>
                <div class="detailVal">{{$payorder['pay_methodName']}}</div>
            </div>
            <div class="detail disf">
                <div class="detailName">支付币种</div>
                <div class="detailVal">{{$payorder['currency']}}</div>
            </div>
            <div class="detail disf">
                <div class="detailName">应付总额</div>
                <div class="detailVal">{{$payorder['trade_price']}}</div>
            </div>
            <div class="detail disf">
                <div class="detailName">已付金额</div>
                <div class="detailVal">{{$payorder['trade_price']}}</div>
            </div>
            <div class="detail disf">
                <div class="detailName">未付金额</div>
                <div class="detailVal">{{$payorder['weifu']}}</div>
            </div>
        </div>
        <div class="buy_list">
            <div class="buy_listName">--- 购物清单 ---</div>
            <div class="goodslist">
                <table class="layui-table">
                    <thead>
                        <th>商品名称</th>
                        <th>规格名称</th>
                        <th>数量</th>
                        <th>小计</th>
                    </thead>
                    <tbody>
                        @foreach($cart_buylist['content']['goods_info'] as $k2=>$v2)
                            @foreach($v2['sku_info'] as $k3=>$v3)
                                @if(isset($v3['is_close']))
                                    @if($v3['is_close']==0)
                                         <tr>
                                            <td><a href="/goods-{{$v2['good_id']}}.html" target="_blank">{{$v2['goods_info']['goods_name']}}</a></td>
                                            <td>{{$v3['sku_info']['spec_names']}}</td>
                                            <td>{{$v3['goods_num']}}</td>
                                            <td>{{$v3['price']}}</td>
                                         </tr>
                                    @endif
                                @endif
                            @endforeach
                        @endforeach
                   </tbody>
                </table>
            </div>
        </div>
    </div>
    <style>
        /**弹窗样式**/
        .layer_frame .layui-layer-title{background:#bebebe;color:#fff;}
        .layer_frame .layui-layer-content{overflow:unset !important;}
        .layer_frame .layui-layer-setwin{top:-28px;}
        .layer_frame .layui-layer-title .disf{height:100%;}
        .layer_frame .exclamation-circle {position: relative;margin-right:8px;}
        .layer_frame .exclamation-circle span{font-size: 14px;font-weight:900;color: #fff;font-family: PingFang SC, Hiragino Sans GB, Heiti SC, Microsoft YaHei, Helvetica, Tahoma, Arial, SimHei, WenQuanYi Micro Hei !important;}
        .layer_frame .exclamation-circle::after {content: '';position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);width: 14px;height: 14px;background-color: #fff;border-radius: 50%;opacity:0.5;}
        .layer_frame .page_innerhead{width:100%;border-bottom:1px solid #1f5188;}
        .layer_frame .page_innerhead .pageBack{width:15%;text-align: center;padding:10px 0;font-size:15px;color:#000;font-weight:600;background:#bebebe;cursor:pointer;position:relative;}
        .layer_frame .page_innerhead .pageSel{width:42.5%;text-align: center;padding:10px 0;font-size:15px;color:#000;font-weight:600;background:#fff;cursor:pointer;position:relative;}
        .layer_frame .page_innerhead .pageSel:first-child{border-right:1px solid #fff;}
        .layer_frame .page_innerhead .pageAct{background:#1f5188;color:#fff;}
        .layer_frame .page_innerhead .pageAct:after {content: '';position: absolute;top: 15px;right: 35px;width: 8px;height: 8px;border-top: 2px solid #fff;border-right: 2px solid #fff;transform: rotate(135deg);}
        .layer_frame .layui-layer-content .rightBox .page_content{height:88%;overflow-y: auto;}
        .layer_frame .layui-layer-content .rightBox .page_content .rightContent{height:100%;}
    </style>
    <script type="text/javascript">
        layui.use(['layer','element','upload','form'],function() {
            var $ = layui.$
                , layer = layui.layer
                , element = layui.element
                , form = layui.form
                , upload = layui.upload;
            form.render(null,'glist-element');
        });

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
                    main_html += '<div class="layui-tab service_tab" lay-filter="test-hash" style="width:400px;">\n' +
                        '  <ul class="layui-tab-title">\n';
                    if(res.datas.file.length>0) {
                        main_html += '<li class="">监管文件</li>\n';
                    }
                    if(res.datas.otherfee_content!='' && res.datas.otherfee_content!=null) {
                        main_html += '<li class="">其他费用</li>\n';
                    }
                    if(res.datas.reduction_money>0) {
                        main_html += '<li class="">减免优惠</li>\n';
                    }
                    if(res.datas.prefe_gift.length>0) {
                        main_html += '<li class="">随赠优惠</li>\n';
                    }
                    if(res.datas.services.length>0) {
                        main_html += '<li class="">更多服务</li>\n';
                    }
                    main_html+='</ul>\n' +
                        '  <div class="layui-tab-content">\n';
                    if(res.datas.file.length>0) {
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
                            '                                                                                    <th>计费标准</th>\n' +
                            '                                                                                    <th>计费价格</th>\n' +
                            '                                                                                </tr>\n' +
                            '                                                                                </thead>\n' +
                            '                                                                                <tbody>\n';
                        for(let i=0;i<res.datas.otherfee_content['name'].length;i++){
                            main_html += '                                                                        <tr>\n' +
                                '                                                                                        <td>'+res.datas.otherfee_content['name'][i]+'</td>\n' +
                                '                                                                                        <td>'+res.datas.otherfee_content['desc'][i]+'</td>\n' +
                                '                                                                                        <td>'+res.datas.otherfee_content['otherfee_standard_name'][i]+'</td>\n' +
                                '                                                                                        <td>'+res.datas.otherfee_currency+' '+res.datas.otherfee_content['price'][i]+'</td>\n' +
                                '                                                                                    </tr>\n';
                        }
                        main_html += '                                                                                </tbody>\n' +
                            '                                                                            </table>\n';
                        if(res.datas.odd_otherfee_total!=res.datas.otherfee_total){
                            main_html += '<div class="origin_price">原价：'+res.datas.otherfee_currency+' '+res.datas.odd_otherfee_total+'</div>';
                            main_html += '<div class="now_price">现价：'+res.datas.otherfee_currency+' '+res.datas.otherfee_total+'</div>';
                        }else{
                            main_html += '<div class="now_price">总价：'+res.datas.otherfee_currency+' '+res.datas.otherfee_total+'</div>';
                        }
                        main_html += '                                                                </div>';
                        main_html += '</div>\n';
                    }
                    if(res.datas.reduction_money>0) {
                        main_html += '<div class="layui-tab-item">';
                        <!--减免优惠详情-->
                        main_html += '<div class="disf projectDiv">\n';
                        if(res.datas.odd_reduction_money!=res.datas.reduction_money){
                            if(res.datas.odd_reduction_money!='') {
                                main_html += '<div class="origin_price">原价：' + res.datas.otherfee_currency + ' ' + res.datas.odd_reduction_money + '</div>';
                            }
                            main_html += '<div class="now_price">现价：'+res.datas.otherfee_currency+' '+res.datas.reduction_money+'</div>';
                        }else{
                            main_html += '<div class="now_price">总价：'+res.datas.otherfee_currency+' '+res.datas.reduction_money+'</div>';
                        }
                        main_html += '</div>';
                        main_html += '</div>\n';
                    }
                    if(res.datas.prefe_gift.length>0) {
                        main_html += '<div class="layui-tab-item">';
                        <!--随赠优惠详情-->
                        main_html += '<div class="projectDiv">\n' +
                            '                                                                            <table class="layui-table">\n' +
                            '                                                                                <thead>\n' +
                            '                                                                                <tr>\n' +
                            '                                                                                    <th>优惠类别</th>\n' +
                            '                                                                                    <th>随赠项目</th>\n' +
                            '                                                                                    <th>随赠内容</th>\n' +
                            '                                                                                </tr>\n' +
                            '                                                                                </thead>\n' +
                            '                                                                                <tbody>\n';
                        for(let i=0;i<res.datas.prefe_gift.length;i++) {
                            main_html += '                                                                       <tr>\n' +
                                '                                                                                        <td>\n';
                            if (res.datas.prefe_gift[i].operaer == 1) {
                                main_html += '                                                                           商家优惠\n';
                            } else if (res.datas.prefe_gift[i].operaer == 2) {
                                main_html += '                                                                           平台优惠\n';
                            } else if (res.datas.prefe_gift[i].operaer == 3) {
                                main_html += '                                                                           其他优惠\n';
                            }
                            main_html += '                                                                           </td>\n' +
                                '                                                                                        <td>\n';
                            if (res.datas.prefe_gift[i].type == 1) {
                                main_html += '                                                                           积分\n';
                            } else if (res.datas.prefe_gift[i].type == 2) {
                                main_html += '                                                                           卡券\n';
                            } else if (res.datas.prefe_gift[i].type == 3) {
                                main_html += '                                                                           随赠（实物）\n';
                            }
                            main_html += '                                                                             </td>\n' +
                                '                                                                                        <td>\n';
                            if (res.datas.prefe_gift[i].type == 1) {
                                if (res.datas.prefe_gift[i].points_type == 1) {
                                    main_html += '按每订单/次送' + res.datas.prefe_gift[i].points_send + '分';
                                } else if (res.datas.prefe_gift[i].points_type == 2) {
                                    main_html += '按每' + res.datas.prefe_gift[i].points_currency + res.datas.prefe_gift[i].points_money + '送' + res.datas.prefe_gift[i].points_send;
                                }
                            } else if (res.datas.prefe_gift[i].type == 2) {
                                main_html += '价值' + res.datas.prefe_gift[i].coupon_currency + res.datas.prefe_gift[i].coupon_money + 'x' + res.datas.prefe_gift[i].coupon_num + '张';
                            } else if (res.datas.prefe_gift[i].type == 3) {
                                main_html += '随赠（';
                                if (res.datas.prefe_gift[i].accgift_type == 1) {
                                    main_html += '虚拟';
                                } else if (res.datas.prefe_gift[i].accgift_type == 2) {
                                    main_html += '服务';
                                } else if (res.datas.prefe_gift[i].accgift_type == 3) {
                                    main_html += '实物';
                                }
                                main_html += '）*' + res.datas.prefe_gift[i].accgift_num;
                            }
                            main_html += '                                                                           </td>\n' +
                                '                                                                                    </tr>\n';
                        }
                        main_html += '                                                                            </tbody>\n' +
                            '                                                                            </table>\n';
                        if(res.datas.odd_gift_money!=res.datas.gift_money){
                            if(res.datas.odd_gift_money!='') {
                                main_html += '<div class="origin_price">原价：' + res.datas.otherfee_currency + ' ' + res.datas.odd_gift_money + '</div>';
                            }
                            main_html += '<div class="now_price">现价：'+res.datas.otherfee_currency+' '+res.datas.gift_money+'</div>';
                        }else{
                            main_html += '<div class="now_price">总价：'+res.datas.otherfee_currency+' '+res.datas.gift_money+'</div>';
                        }
                        main_html += '                                                              </div>';
                        main_html += '</div>\n';
                    }
                    if(res.datas.services.length>0) {
                        main_html += '<div class="layui-tab-item">';
                        <!--更多服务-->
                        main_html += '<div class="projectDiv">\n' +
                            '                                                                            <table class="layui-table">\n' +
                            '                                                                                <thead>\n' +
                            '                                                                                <tr>\n' +
                            '                                                                                    <th>服务名称</th>\n' +
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
                            main_html += '<div class="now_price">现价：'+res.datas.otherfee_currency+' '+res.datas.services_money+'</div>';
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

                        layer_frame_div = layer.open({
                            skin:'layer_frame',
                            type: 1,
                            title: '<div class="disf"><div class="exclamation-circle"><span>!</span></div>系统提示：'+name+'</div>',
                            area: ['600px', '433px'],
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
                    let html = '<iframe id="chat" name="chat" style="width: 100%;height: 100%;" frameborder="0" scrolling="yes" src="/customer_online?isframe=1&control_height=190"></iframe>';
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

        //查看支付订单
        function pay_list(t,oid){
            var $ = layui.$
                , form = layui.form
                , layer = layui.layer;

            layer.load();

            let main_html = '';
            $.post('/cart/get_payorder',{'oid':oid,'_token':'{{csrf_token()}}'},function(res) {
                main_html = '<div class="payorderDiv">\n' +
                    '        <div class="payorderHead">\n' +
                    '            <div class="detail disf">\n' +
                    '                <div class="detailName">订单编号</div>\n' +
                    '                <div class="detailVal">'+res.data.ordersn+'</div>\n' +
                    '            </div>\n' +
                    '            <div class="detail disf">\n' +
                    '                <div class="detailName">交易时间</div>\n' +
                    '                <div class="detailVal">'+res.data.createtime+'</div>\n' +
                    '            </div>\n' +
                    '            <div class="detail disf">\n' +
                    '                <div class="detailName">支付方式</div>\n' +
                    '                <div class="detailVal">'+res.data.pay_methodName+'</div>\n' +
                    '            </div>\n' +
                    '            <div class="detail disf">\n' +
                    '                <div class="detailName">支付币种</div>\n' +
                    '                <div class="detailVal">'+res.data.currency+'</div>\n' +
                    '            </div>\n' +
                    '            <div class="detail disf">\n' +
                    '                <div class="detailName">应付总额</div>\n' +
                    '                <div class="detailVal">'+res.data.total_money+'</div>\n' +
                    '            </div>\n' +
                    '            <div class="detail disf">\n' +
                    '                <div class="detailName">已付金额</div>\n' +
                    '                <div class="detailVal">'+res.data.total_money+'</div>\n' +
                    '            </div>\n' +
                    '            <div class="detail disf">\n' +
                    '                <div class="detailName">未付金额</div>\n' +
                    '                <div class="detailVal">'+res.data.weifu+'</div>\n' +
                    '            </div>\n' +
                    '        </div>\n' +
                    '        <div class="buy_list">\n' +
                    '            <div class="buy_listName">购物清单</div>\n' +
                    '            <div class="goodslist">\n' +
                    '                <table class="layui-table">\n' +
                    '                    <thead>\n' +
                    '                        <th>商品名称</th>\n' +
                    '                        <th>规格名称</th>\n' +
                    '                        <th>数量</th>\n' +
                    '                        <th>小计</th>\n' +
                    '                    </thead>\n' +
                    '                    <tbody>\n';
                @foreach($cart_buylist['content']['goods_info'] as $k2=>$v2)
                        @foreach($v2['sku_info'] as $k3=>$v3)
                        @if(isset($v3['is_close']))
                        @if($v3['is_close']==0)
                    main_html += '                         <tr>\n' +
                    '                                           <td>{{$v2['goods_info']['goods_name']}}</td>\n' +
                    '                                           <td>{{$v3['sku_info']['spec_names']}}</td>\n' +
                    '                                           <td>{{$v3['goods_num']}}</td>\n' +
                    '                                        <td>{{$v3['price']}}</td>\n' +
                    '                                    </tr>\n';
                @endif
                        @endif
                        @endforeach
                        @endforeach
                    main_html += '       </tbody>\n' +
                    '                </table>\n' +
                    '            </div>\n' +
                    '        </div>\n' +
                    '    </div>';

                let name = '支付订单';
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

                    layer_frame_div = layer.open({
                        skin:'layer_frame',
                        type: 1,
                        title: '<div class="disf"><div class="exclamation-circle"><span>!</span></div>系统提示：'+name+'</div>',
                        area: ['600px', '433px'],
                        content: html
                    });

                    layer.closeAll('loading');
                },'json');
            },'json');
        }
        //已购清单操作==========================================================END
    </script>
</div>
<script>
    $(function(){
        if("{{session('user.user_id')}}" ==''){
            $.login.show();
        }
    });
</script>
@stop

