@extends('layouts.goods_header')

@section('content')
    <link rel="stylesheet" href="/assets/d2eace91/layui/css/layui.css?v=23121"/>
    <link rel="stylesheet" href="/assets/d2eace91/js/layer/theme/default/layer.css?v=3.1.0" id="layuicss-layer">
    <script type="text/javascript" src="/assets/d2eace91/layui/layui.js"></script>
    <script src="/assets/d2eace91/js/jquery.js?v=1.1"></script>

    <style type="text/css" media="all">
        .layui-colla-content{padding:5px;}
        #content{padding-top:120px;padding-bottom:20px;background:{{$website['background']}};height:630px;}
        .content{padding:20px 20px;box-sizing:border-box;}
        .content .col-md-12{padding:0;float:unset;}
        .content .box_content{justify-content:center;border-radius:8px;margin-bottom:30px;}
        .content .box_content{background:{{$website['background']}};color:{{$website['fontcolor']}};border:1px solid {{$website['fontcolor']}};font-size:25px;text-align:center;padding:30px;width:100%;}
        .content .box_content img{width:40px;margin-right:5px;}
        .layui-card{background:{{$website['background']}};}
        .navbar_menu{color: {{$website['fontcolor']}};font-size: 16px;margin-bottom:10px;}
        .navbar_menu a{color:{{$website['fontcolor']}};}
        .layui-colla-title{color:{{$website['fontcolor']}};background-color:{{$website['content']}};}
        .preamble_con,.layui-colla-content{color:{{$website['fontcolor']}};font-size:15px;}
        .layui-colla-content p{margin-bottom:0.3cm;}
        .rule_div{color: {{$website['fontcolor']}};background-color: {{$website['content']}};padding:10px 5px;justify-content: space-between;border-bottom: 1px solid {$website['fontcolor']};font-size:15px;}
        .rule_div:last-child{border:0;}
        .rule_div .left_title{width:80%;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;white-space: nowrap;}

        footer{display: block !important;}

        @media (max-width: 992px){
            .content{padding:20px 0;}
        }
    </style>

    <section id="content" class="non_topimg">
        <div class="w1200">
            <div class="container">
                <div class="content" >
                    <div class="layui-fluid" style="padding:0;">
                        <div class="layui-row layui-col-space15">
                            <div class="layui-col-md12" style="padding:0;">
                                <p class="navbar_menu"><i class="fa fa-sign-in" style="margin-right:5px;display:none;"></i><a href="/">HOME</a>&nbsp;<span style="color:{{$website['fontcolor']}};">\</span>&nbsp;<span style="color:{{$website['fontcolor']}};">平台规则</span></p>

                                <div class="layui-card">
                                    <div class="layui-card-body">
                                        @foreach($list as $key => $vo)
                                            <div class="layui-collapse" lay-accordion>
                                                <div class="layui-colla-item">
                                                    <h2 class="layui-colla-title">{{$vo['name']}}</h2>
                                                    <div class="layui-colla-content">
                                                        @foreach($vo['children'] as $key2 => $vo2)
                                                            <div class="layui-collapse" lay-accordion>
                                                                <div class="layui-colla-item">
                                                                    <h2 class="layui-colla-title">{{$vo2['name']}}</h2>
                                                                    <div class="layui-colla-content">
                                                                        @foreach($vo2['children'] as $key3 => $vo3)
                                                                            <div class="disf rule_div">
                                                                                <div class="left_title">{{$vo3['rule_name']}}</div>
                                                                                <div class="right_btn"><div class="layui-btn layui-btn-primary layui-btn-xs" style="background:unset;border:1px solid {{$website['fontcolor']}};color:{{$website['fontcolor']}};" onclick="rule_history({{$vo3['id']}})">查看历史版本</div></div>
                                                                            </div>

                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
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
            </div>
        </div>
    </section>

    <script>
        layui.use(['layer', 'form', 'table', 'upload','element'], function () {
            var $ = layui.$
                , layer = layui.layer
                , form = layui.form
                , element = layui.element
                , upload = layui.upload
                , table = layui.table;

            form.render(null,'component-form-element');
            element.on('collapse(now)', function(data){

            });
        });

        function rule_history(id){
            var $ = layui.$
                , layer = layui.layer;
            window.location.href="/version_list?pid="+id;
        }
        function rule_view(pid,id){
            var $ = layui.$
                , layer = layui.layer;
            window.location.href="/rule?pid="+pid+'&id='+id;
        }
    </script>
@stop

@include('layouts.footer')