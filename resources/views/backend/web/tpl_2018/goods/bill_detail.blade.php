@extends('layouts.inner_header')

@section('header_js')
    <script src="/assets/d2eace91/js/jquery.cookie.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=20180528"></script>
@stop


{{--follow_box 注意此效果只在首页面展示--}}
@section('follow_box')

@stop

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

@section('content')
    <link rel="stylesheet" href="/css/goods.css?v=20180428"/>

    <link rel="stylesheet" href="/assets/d2eace91/layui/css/layui.css?v=23121"/>
    <link rel="stylesheet" href="/assets/d2eace91/js/layer/theme/default/layer.css?v=3.1.0" id="layuicss-layer">
    <script type="text/javascript" src="/assets/d2eace91/layui/layui.js"></script>
    <script src="/assets/d2eace91/js/jquery.js?v=1.1"></script>

    <style>
        .f15{font-size:15px;}
        .layui-form-label{font-size:15px;}
        .layui-input-block{line-height:36px;}

        .layui-btn-normal{background:#1f5188;}
        #content{padding:20px;min-height:380px;}
        @if($isframe==1)
            /*内置框打开*/
            .header,.footer{display: none;}
            .w1200{width: 100%;}
        @endif
    </style>
    <div id="content">
        <div class="w1200">
            <div class="layui-card">
                <div class="layui-card-body">
                    <p style="border-bottom: 1px solid #000;"><a href="javascript:history.back(-1);" class="f15">返回 &gt;</a></p>
                    <div class="layui-form-item">
                        <div class="layui-form-label">账单编号</div>
                        <div class="layui-input-block">
                            {{$order['ordersn']}}
                        </div>
                    </div>
                    @if($order['origin_type'] == 0)
                        <!--系统内商品订单-->
                        <div class="layui-form-item">
                            <div class="layui-form-label">商品详情</div>
                            <div class="layui-input-block">
                                <table class="layui-table">
                                    <thead>
                                    <tr>
                                        @if($goods['have_specs']==1)
                                            <th>规格名称</th>
                                        @endif
                                        <th>购买数量</th>
                                        <th>商品总额</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order['content']['buy_attr'] as $vo)
                                        <tr>
                                            @if($goods['have_specs']==1)
                                                <td>{{$vo['attr_name']}}</td>
                                            @endif
                                            <td>{{$vo['buy_num']}} {{$order['unit']}}</td>
                                            <td>{{$order['currency']}} {{$vo['now_gprice']}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-form-label">商品数量</div>
                            <div class="layui-input-block">
                                {{$order['total_num']}} {{$order['unit']}}
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-form-label">商品总额</div>
                            <div class="layui-input-block">
                                {{$order['currency']}} {{$order['total_price']}}
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-form-label">其他费用</div>
                            <div class="layui-input-block">
                                {{$order['content']['other_fee']['otherfee_currency']}} {{$order['content']['other_fee']['otherfee_total']}}
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
                                    @foreach($order['content']['other_fee']['otherfee_content']['name'] as $key => $vo)
                                        <tr>
                                            <td>{{$vo}}</td>
                                            <td>{{$order['content']['other_fee']['otherfee_content']['desc'][$key]}}</td>
                                            <td>
                                                @if(isset($order['content']['other_fee']['otherfee_content']['otherfee_standard_name'][$key]))
                                                    {{$order['content']['other_fee']['otherfee_content']['otherfee_standard_name'][$key]}}
                                                @else
                                                    其它
                                                @endif
                                            </td>
                                            <td>{{$order['content']['other_fee']['otherfee_currency']}} {{$order['content']['other_fee']['otherfee_content']['price'][$key]}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-form-label">减免金额</div>
                            <div class="layui-input-block">
                                - {{$order['currency']}} {{$order['content']['reduction_money']}}
                            </div>
                        </div>
                        @if(isset($order['content']['gift_money']))
                            <div class="layui-form-item">
                                <div class="layui-form-label">抵扣费用</div>
                                <div class="layui-input-block">
                                    - {{$order['currency']}} {{$order['content']['gift_money']}}
                                </div>
                            </div>
                        @endif
                        @if(!empty($order['content']['prefe_gift']))
                            <div class="layui-form-item">
                                <div class="layui-form-label">订单随赠</div>
                                <div class="layui-input-block">
                                    <table class="layui-table">
                                        <thead>
                                        <tr>
                                            <th>类别</th>
                                            <th>内容</th>
                                            <th>数量</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($order['content']['prefe_gift'] as $key => $vo)
                                            <tr>
                                                <td>{{$vo['accgift_typeName']}}</td>
                                                <td>{{$vo['accgift_content']}}</td>
                                                <td>{{$vo['accgift_num']}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                        <div class="layui-form-item">
                            <div class="layui-form-label">实付金额</div>
                            <div class="layui-input-block">
                                {{$order['currency']}} {{$order['true_money']}}
                            </div>
                        </div>
                    @elseif($order['origin_type'] == 1)
                    <!--backydrop/其他订单-->
                        <div class="layui-form-item">
                            <div class="layui-form-label">商品详情</div>
                            <div class="layui-input-block">
                                <table class="layui-table">
                                    <thead>
                                    <tr>
                                        <th>商品名称</th>
                                        @if($goods['have_specs']==1)
                                            <th>规格名称</th>
                                        @endif
                                        <th style="width: 10%;">购买数量</th>
                                        <th style="width: 10%;">商品总额</th>
                                        <th>操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{$goods['goods_name']}}</td>
                                        @if($goods['have_specs']==1)
                                                <td colspan="3">
                                                    <table class="layui-table">
                                                        @foreach($goods_sku as $k=>$v)
                                                            <tr>
                                                                <td>{{$v['value_name']}}</td>
                                                                <td>x&nbsp;{{$v['good_num']}}</td>
                                                                <td>RMB￥&nbsp;{{$v['good_price']}}</td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </td>
                                        @elseif($goods['have_specs']==2)
                                            <td>x {{$order['content']['good_num']}}</td>
                                            <td>RMB￥ {{$order['content']['good_price']}}</td>
                                        @endif
                                        <td><a href="/goods-{{$goods['goods_id']}}.html" class="layui-btn layui-btn-primary" target="_blank">查看商品</a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-form-label">实付金额</div>
                            <div class="layui-input-block">
                                RMB￥ {{$order['true_money']}}
                            </div>
                        </div>
                        @if($order['status']==-2 || $order['status']==1 || $order['status']==1 || $order['status']==9)
                            <div class="layui-form-item">
                                <div class="layui-form-label"></div>
                                <div class="layui-input-block">
                                    @if($order['status']==-2)
                                        <div class="layui-btn layui-btn-primary" onclick="cancel()">取消订购</div>
                                    @endif
                                    @if($order['status']==1)
                                    <!--确认收货-->
                                        <div class="layui-btn layui-btn-normal" onclick="apply_return()">退换货申请</div>
                                    @endif
                                    @if($order['status']==1 || $order['status']==9)
                                    <!--查看物流轨迹-->
                                        <div class="layui-btn layui-btn-success" onclick="logistics()">物流追踪</div>
                                    @endif
                                </div>
                            </div>
                        @endif

                    <!--退换货-->
                        <div class="apply_div" style="display: none;padding:15px;box-sizing:border-box;">
                            <form class="layui-form" action="" method="post" lay-filter="apply-element">
                                @csrf
                                <input type="hidden" name="applySource" value="9">
                                <input type="hidden" name="ordersn" value="{{$order['ordersn']}}">
                                <div class="layui-form-item">
                                    <div class="layui-form-label">申请类型</div>
                                    <div class="layui-input-block">
                                        <select name="applyType" id="applyType">
                                            <option value="1">商品退货</option>
                                            <option value="2">商品换货</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <div class="layui-form-label">退换货备注</div>
                                    <div class="layui-input-block">
                                        <textarea name="applyContent" class="layui-textarea" placeholder="请输入退货和换货的原因" lay-verify="required"></textarea>
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <div class="layui-form-label">退换货数量</div>
                                    <div class="layui-input-block">
{{--                                        <input type="number" class="layui-input" min="1" max="$order['content']['good_num']" value="$order['content']['good_num']" lay-verify="required" name="quantity" id="quantity" data-value="$order['content']['good_num']">--}}
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <div class="layui-form-label"></div>
                                    <div class="layui-input-block">
                                        <button class="layui-btn layui-btn-normal" lay-submit lay-filter="apply-element2" style="background:#ff0000;">确认</button>
                                    </div>
                                </div>
                            </form>

                        </div>

                        <!--物流路由-->
                        <div class="logistics_div" style="display: none;padding:15px;box-sizing: border-box;">

                        </div>
                    @endif
                    @if($order['status']==0)
                        <div class="layui-form-item">
                            <div class="layui-form-label">支付码</div>
                            <div class="layui-input-block">
                                <img src="{{$order['code_url']}}?v=<?php echo time();?>" alt="" style="width:150px;height:150px;">
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        layui.use(['layer','element','table','form'],function() {
            var $ = layui.$
                , layer = layui.layer
                , element = layui.element
                , form = layui.form
                , table = layui.table;

            form.render(null,'apply-element');

            form.on('submit(apply-element2)', function(data) {
                layer.load();

                $.ajax({
                    url: "/return_goods",
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

            //退换货数量监控
            var input = document.getElementById("quantity");
            input.addEventListener("input", function() {
                let v = $(this).attr('data-value');
                if (this.value > v) {
                    this.value = v;
                } else if (this.value <= 0 || this.value == '') {
                    this.value = 1;
                }
            });
        });

        //申请取消订单
        function cancel(){
            var $ = layui.$
                , layer = layui.layer;

            layer.confirm('确认取消订购吗？', {
                btn: ['确认','取消']
            }, function(){
                layer.load();
                $.ajax({
                    url: '/cancel_order',
                    method: 'post',
                    dataType: 'JSON',
                    data: {
                        'partnerOrderNo': '{{ $order['ordersn'] }}',
                        '_token':"{{csrf_token()}}"
                    },
                    success: function(res) {
                        layer.closeAll('loading');
                        layer.msg(res.msg,{time:2000},function(){
                            if(res.code==0){
                                window.location.reload();
                            }else{
                                window.location.reload();
                            }
                        });
                    }
                });
            }, function(){

            });
        }

        //退换货申请
        function apply_return(){
            var $ = layui.$
                , layer = layui.layer;

            layer.open({
                type: 1,
                title: '退换货申请',
                area: ['500px', '500px'],
                content: $('.apply_div')
            });
        }

        //物流追踪
        function logistics(){
            var $ = layui.$
                , layer = layui.layer;

            layer.load();
            $.ajax({
                url: '/get_domestic_route',
                method: 'get',
                data: {
                    'partnerOrderNo': '{{ $order['ordersn'] }}',
                },
                success: function(res) {
                    layer.closeAll('loading');
                    if(res.code==0){
                        let html = '<div class="layui-form-item">\n' +
                            '                            <div class="layui-form-label">快递公司</div>\n' +
                            '                            <div class="layui-input-block">\n' +
                                res.data.deliveryName+
                            '                            </div>\n' +
                            '                        </div>\n'+
                            '       <div class="layui-form-item">\n' +
                            '                            <div class="layui-form-label">快递单号</div>\n' +
                            '                            <div class="layui-input-block">\n' +
                                res.data.deliveryNo+
                            '                            </div>\n' +
                            '                        </div>\n'+
                            '       <div class="layui-form-item">\n' +
                            '                            <div class="layui-form-label">物流轨迹</div>\n' +
                            '                            <div class="layui-input-block">\n';
                                for(let i=0;i<res.data.originTraceInfo.traceNodes.length;i++){
                                    html += '<div class="logistics_line"><div class="logistics_time" style="font-size:15px;font-weight: 600;">'+res.data.originTraceInfo.traceNodes[i].recordTime+'</div><div class="logistics_desc" style="font-size:15px;border-bottom:1px dashed #000;">'+res.data.originTraceInfo.traceNodes[i].description+'</div></div>\n';
                                }
                            html+='                            </div>\n' +
                            '                        </div>\n';

                        $('.logistics_div').html(html);
                        layer.open({
                            type: 1,
                            title: '物流追踪',
                            area: ['500px', '500px'],
                            content: $('.logistics_div')
                        });
                    }else if(res.code==-1){
                        layer.msg(res.msg);
                    }
                }
            });
        }
    </script>
@stop