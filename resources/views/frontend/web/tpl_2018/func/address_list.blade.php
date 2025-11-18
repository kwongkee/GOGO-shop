@extends('layouts.inner_header')

@section('content')
    <link rel="stylesheet" href="/assets/d2eace91/layui/css/layui.css?v=23121"/>
    <link rel="stylesheet" href="/assets/d2eace91/js/layer/theme/default/layer.css?v=3.1.0" id="layuicss-layer">
    <script type="text/javascript" src="/assets/d2eace91/layui/layui.js"></script>
    <script src="/assets/d2eace91/js/jquery.js?v=1.1"></script>

    {{--    登陆用start--}}
    <link rel="stylesheet" href="/css/common.css?v=1.1"/>
    <script src="/js/common.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/jquery.cookie.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=1.1"></script>
    <style>
        *{line-height: 24px;}
        .login-form .login-con{box-sizing: revert;}
        .login-wrap .form-group .text {border-bottom: 1px solid #ddd !important;}
    </style>
    {{--    登陆用end--}}

    <style type="text/css" media="all">
        #content{padding-top:20px;padding-bottom:20px;background:{{$website['background']}};}
        .content{padding:20px 20px;box-sizing:border-box;height:630px;}
        .content .col-md-12{padding:0;float:unset;}
        .content .box_content{justify-content:center;border-radius:8px;margin-bottom:30px;}
        .content .box_content{background:{{$website['background']}};color:{{$website['fontcolor']}};border:1px solid {{$website['fontcolor']}};font-size:25px;text-align:center;padding:30px;width:100%;}
        .content .box_content img{width:40px;margin-right:5px;}
        .inquiry_box{display:none;}
        .navbar_menu{color: {{$website['fontcolor']}};font-size: 16px;margin-bottom:10px;}
        .navbar_menu a{color:{{$website['fontcolor']}};}
        .layui-table-page{background:#f2f2f2;}
        .layui-card{background:unset;}
        .layui-table thead tr{background:{{$website['content']}};color:#fff;}
        .layui-table-view .layui-table td{color:{{$website['fontcolor']}};}
        /*.xm-select-demo .xm-label{overflow: hidden;}*/
        /*.xm-select-demo .xm-label-block{white-space: nowrap;}*/

        @if($isframe==1)
            /*内置框打开*/
            header,.header,.footer,footer{display: none;}
            .w1200{width: 100%;}
            #content{padding-top:0;}
            .layui-card-body{padding:0;}
            .detail_topimg, .non_topimg{margin-top:0;}
        @endif
    </style>

    <section id="content" class="non_topimg">
        <div class="w1200">
            <div class="container">
                <div class="content" >
                    <div class="layui-fluid" style="padding:0;">
                        <div class="layui-row layui-col-space15">
                            <div class="layui-col-md12" style="padding:0;">
                                @if($isframe==0)
                                <p class="navbar_menu"><i class="fa fa-sign-in" style="margin-right:5px;display:none;"></i><a href="/">HOME</a>&nbsp;<span style="color:{{$website['fontcolor']}};">\</span>&nbsp;<span style="color:{{$website['fontcolor']}};">收货地址列表</span>&nbsp;</p>
                                @endif
                                <div class="layui-card">
                                    <div class="layui-card-header">
                                        <div class="layui-btn layui-btn-normal layui-btn-md" style="background: #1f5188;" onclick="add_address()">添加地址</div>
                                    </div>
                                    <div class="layui-card-body">
                                        <table class="layui-hide" id="mainTable"></table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        layui.use(['layer', 'table'], function () {
            var $ = layui.$
                , layer = layui.layer
                , table = layui.table;

            if("{{session('user.user_id')}}" ==''){
                $.login.show();
            }else{
                table.render({
                    elem: '#mainTable'
                    ,url: "/address_list?pa=1"
                    ,cellMinWidth: 200
                    ,cols: [[
                        {field:'user_name', title: '收货人'}
                        ,{field:'detail_area', title: '所在地区'}
                        ,{field:'detail_address', title: '详细地址'}
                        ,{field:'postal', title: '邮编'}
                        ,{field:'mobile', title: '手机/电话'}
                        ,{align:'center',  title: '操作',fixed:'right',width:120, templet: function(d){
                                return [
                                    '<a onclick="openWindow('+"'"+ d.id +"'" +','+"1"+ ');" class="layui-btn layui-btn-normal layui-btn-xs" style="background:#1f5188;">编辑</a>',
                                    '<a onclick="openWindow('+"'"+ d.id +"'" +','+"2"+ ');" class="layui-btn layui-btn-danger layui-btn-xs">删除</a>',
                                ].join('');
                            } }
                    ]]
                    ,page: true
                });
            }
        });

        function openWindow(id,typ){
            let url = '';
            if("{{session('user.user_id')}}" ==''){
                $.login.show();
            }else {
                if (typ == 1) {
                    //编辑收货地址
                    window.location.href = "/save_address?isframe={{$isframe}}&id=" + id;
                } else if (typ == 2) {
                    //删除收货地址
                    layer.confirm('确认要删除该收货地址吗？', {
                        btn: ['确认', '取消']
                    }, function () {
                        layer.load();
                        $.post("/del_address", {'id': id, '_token': "{{csrf_token()}}"}, function (res) {
                            layer.msg(res.msg, {time: 2000}, function () {
                                if (res.code == 0) {
                                    window.location.reload();
                                }
                            });
                        }, 'json');
                    }, function () {

                    });
                }
            }
        }

        function add_address(){
            var $ = layui.$
                , layer = layui.layer;
            if("{{session('user.user_id')}}" ==''){
                $.login.show();
            }else {
                window.location.href = "/save_address?isframe={{$isframe}}";
            }
        }
    </script>
@stop