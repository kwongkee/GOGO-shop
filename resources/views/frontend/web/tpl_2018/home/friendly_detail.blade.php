@extends('layouts.inner_header')

@section('content')
    <link rel="stylesheet" href="/assets/d2eace91/layui/css/layui.css?v=23121"/>
    <script type="text/javascript" src="/assets/d2eace91/layui/layui.js"></script>
    <link rel="stylesheet" href="/assets/d2eace91/js/layer/theme/default/layer.css?v=3.1.0" id="layuicss-layer">
    <script src="/assets/d2eace91/js/layer/layer.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/jquery.js?v=1.1"></script>

    <style type="text/css" media="all">
        #content{background:{{$website['background']}};}
        #content .container{padding:30px;}
        #content .container .title{font-size:20px;font-weight:600;color:{{$website['fontcolor']}};}
        #content .container .title2{margin-top:20px;width:250px;font-size:15px;display:inline-block;color:{{$website['fontcolor']}};}
        .con_box{margin-top:30px;border-bottom:1px solid #eee;padding-bottom:10px;}
        .con_box:first-child{margin-top:0px;}
    </style>
    <!--<img class="detail_topimg" src="https://shop.gogo198.cn/{$website['inpic']}" alt="" style="max-width:100%;width:100%;">-->
    <section id="content" class="non_topimg" style="padding-top:0;">
        <div class="w1200">
            <div class="container">
                @foreach($linkcate_list as $k=>$vo)
                    <div class="con_box">
                        <div class="title">{{$vo['name']}}</div>
                        @foreach($vo['children'] as $k2=>$vo2)
                            <a href="{{$vo2['link']}}" target="_blank"><div class="title2">{{$vo2['name']}}</div></a>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@stop