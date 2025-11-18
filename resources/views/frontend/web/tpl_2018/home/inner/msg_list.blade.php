@extends('layouts.inner_header')

@section('content')
    <link rel="stylesheet" href="/assets/d2eace91/layui/css/layui.css?v=23121"/>
    <link rel="stylesheet" href="/assets/d2eace91/js/layer/theme/default/layer.css?v=3.1.0" id="layuicss-layer">
    <script type="text/javascript" src="/assets/d2eace91/layui/layui.js"></script>
    <script src="/assets/d2eace91/js/jquery.js?v=1.1"></script>

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

        @if($isframe==1)
            .header,.footer{display: none;}
            .w1200{width: 100%;}
        @endif
    </style>

    <section id="content" class="non_topimg">
        <div class="w1200">
            <div class="container">
                <div class="content" >
                    <div class="layui-fluid" style="padding:0;">
                        <div class="layui-row layui-col-space15">
                            <div class="layui-col-md12" style="padding:0;">
                                <div class="layui-card">
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
        layui.use(['layer', 'form', 'table', 'upload'], function () {
            var $ = layui.$
                , layer = layui.layer
                , form = layui.form
                , element = layui.element
                , upload = layui.upload
                , table = layui.table;

            form.render(null,'component-form-element');

            table.render({
                elem: '#mainTable'
                ,url: "/msg_list?pa=1"
                ,cellMinWidth: 200
                ,cols: [[
                    {field:'name', title: '消息标题'}
                    ,{field:'createtime', title: '发布日期'}
                    ,{align:'center',  title: '操作',fixed:'right',width:120, templet: function(d){
                            return [
                                '<a onclick="openWindow('+"'"+ d.id +"'" +','+"1"+ ');" class="layui-btn layui-btn-primary layui-btn-xs" style="color:#0e2e68;border:1px solid #0e2e68;">查看详情</a>',
                                // '<a onclick="openWindow('+"'"+ d.id +"'" +','+"1"+ ');" class="layui-btn layui-btn-primary layui-btn-xs">历史版本</a>',
                            ].join('');
                        } }
                ]]
                ,page: true
            });
        });

        function openWindow(id,typ,type_id){
            let url = '';
            if(typ==1){
                window.location.href="/msg_detail?id="+id+"&isframe={{$isframe}}";
            }
        }
    </script>
@stop