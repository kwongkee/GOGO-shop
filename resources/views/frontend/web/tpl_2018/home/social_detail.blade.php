@extends('layouts.goods_header')

@section('content')
    <link rel="stylesheet" href="/assets/d2eace91/layui/css/layui.css?v=23121"/>
    <script type="text/javascript" src="/assets/d2eace91/layui/layui.js"></script>
    <link rel="stylesheet" href="/assets/d2eace91/js/layer/theme/default/layer.css?v=3.1.0" id="layuicss-layer">
    <script src="/assets/d2eace91/js/layer/layer.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/jquery.js?v=1.1"></script>

    <style>
        footer{display:block !important;}
        #content{padding:20px 0;padding-top:130px;background:{{$website['background']}};}
        #content .color_word{font-size:16px;padding: 15px 10px;box-sizing:border-box;}
        #content .container .row{width:100%;margin:0 auto;height: 630px;border:1px solid {{$website['fontcolor']}};background:{{$website['content']}};}
        @media (min-width: 1000px){
            .main_img{width:400px;height:280px;text-align:center;margin:20px auto;}
        }
        @media (max-width: 992px){
            .main_img{width:100%;height:250px;text-align:center;margin:20px auto;}
        }
        @if($isframe==1)
            /*内置框打开*/
            .header,.footer{display: none;}
            .w1200{width: 100%;}
            #content{padding:20px;}
            #content .container .row{height:unset;}
        @endif
    </style>
    <section id="content">
        <div class="w1200">
            <div class="container detail_container">
                <div class="row">
                    <div class="col-md-12" style="padding:10px;box-sizing:border-box;">
                        <div class="about-logo">
                            <div class="" style="text-align:center;">
                                <p style="text-align: center;color: #000;font-size: 25px;font-weight: 800;">{{$data['name']}}</p>
                                <img class="main_img" src="//shop.gogo198.cn/{{$data['img']}}" alt="" style="height:auto;"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop