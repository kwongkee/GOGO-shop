@extends('layouts.inner_header')

@section('content')
    <script src="/assets/d2eace91/js/jquery.js?v=1.1"></script>
    <style>
        #content{padding:20px 0;background:{{$website['background']}};}
        #content .color_word{font-size:16px;padding: 15px 10px;box-sizing:border-box;}
        #content .container .row{width:100%;margin:0 auto;height: 630px;/**border:1px solid {{$website['fontcolor']}};**/background:{{$website['content']}};}
        @media (min-width: 1000px){
            .main_img{width:400px;height:280px;text-align:center;margin:20px auto;}
        }
        @media (max-width: 992px){
            .main_img{width: 100px;height: 250px;text-align: center;margin: 0px auto 20px;}
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
                                <img class="main_img" src="/assets/d2eace91/images/newhome/email.png" alt="" style="height:auto;"/>
                                <p style="color:{{$website['fontcolor']}};">Email：<a href="mailto:{{$website['email']}}" style="color:{{$website['fontcolor']}};text-decoration: underline;">{{$website['email']}}</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop