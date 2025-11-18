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
        .layui-btn-normal{background:#1f5188;}
        #content{padding:20px;min-height:380px;}
        .layui-table thead tr{background:{{$website['content']}};color:#fff;}
        .layui-table-view .layui-table td{color:{{$website['fontcolor']}};}
        @if($isframe==1)
            /*内置框打开*/
            .header,.footer{display: none;}
            .w1200{width: 100%;}

        @endif
    </style>

    <div id="content">
        <div class="w1200">
            <table class="layui-hide" id="mainTable"></table>
        </div>
    </div>

    <script type="text/javascript">
        layui.use(['layer','element','table','form'],function() {
            var $ = layui.$
                , layer = layui.layer
                , element = layui.element
                , form = layui.form
                , table = layui.table;
            if("{{session('user.user_id')}}" != ''){
                table.render({
                    elem: '#mainTable'
                    ,url: "/bill_list?pa=1"
                    ,cellMinWidth: 200
                    ,cols: [[
                        {field:'ordersn', title: '账单编号'}
                        ,{field:'true_money', title: '合计金额'}
                        ,{field:'status_name', title: '状态'}
                        ,{field:'createtime', title: '创建时间'}
                        ,{align:'center',  title: '操作',fixed:'right',width:120, templet: function(d){
                                return [
                                    '<a onclick="openWindow('+"'"+ d.id +"'" +','+"2"+ ','+d.uniacid+');" class="layui-btn layui-btn-normal layui-btn-xs">查看详情</a>',
                                    // '<a onclick="openWindow('+"'"+ d.id +"'" +','+"2"+ ');" class="layui-btn layui-btn-danger layui-btn-xs">删除</a>',
                                ].join('');
                            } }
                    ]]
                    ,page: true
                });
            }else{
                $.login.show();
            }
        });

        function openWindow(id,typ,uniacid) {
            let url = '';
            if (typ == 1) {
                window.location.href = "https://shop.gogo198.cn/app/index.php?i=" + uniacid + "&c=entry&p=detail&do=order&m=sz_yi&id=" + id;
            } else if (typ == 2) {
                window.location.href = '/bill_detail?id=' + id+'&isframe={{$isframe}}';
            }
        }
    </script>
@stop