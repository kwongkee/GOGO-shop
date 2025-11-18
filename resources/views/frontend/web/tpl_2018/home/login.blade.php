@extends('layouts.inner_header')

@section('content')
    <link rel="stylesheet" href="/assets/d2eace91/iconfont/iconfont.css?v=1.1"/>
    <link rel="stylesheet" href="/css/common.css?v=1.1"/>
    <link rel="stylesheet" href="/assets/d2eace91/layui/css/layui.css?v=23121"/>
    <script type="text/javascript" src="/assets/d2eace91/layui/layui.js"></script>
    <link rel="stylesheet" href="/assets/d2eace91/js/layer/theme/default/layer.css?v=3.1.0" id="layuicss-layer">
    <script src="/assets/d2eace91/js/layer/layer.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/jquery.js?v=1.1"></script>

    <script src="/assets/d2eace91/js/layer/layer.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=1.1"></script>
    <script src="/js/jquery.fly.min.js?v=1.1"></script>
    <style type="text/css" media="all">
        *{box-sizing: border-box;line-height: 24px;}
        .disf{display: flex;align-items: center;}
        /*body{background:#fff;}*/
        .f15{font-size:15px;color:#000;margin-top:15px;}
        .opera_btn{cursor:pointer;border-bottom:1px solid #000;}

        .nologin,.allogin{display:none;}

        .login-form .login-con{box-sizing: revert;}
        .login-wrap .form-group .text {border-bottom: 1px solid #ddd !important;}

        #content{padding:20px;box-sizing:border-box;}
        #content .content{min-height:600px;}
    </style>
    <section id="content" class="non_topimg">
        <div class="w1200">
            <div class="content">
                <a href="/" style="font-size: 15px;color: #000;border-bottom: 1px solid #000;">&lt;&lt;返回首页</a>
                <div class="f15 nologin"><div class="disf">您未登录/注册，请<div class="login_btn opera_btn" onclick="login()">登录</div></div></div>
                <div class="f15 allogin"><div class="disf">尊敬的用户（{{session('user.gogo_id')}}）您已登录，<a href="/site/logout.html"><div class="logout_btn opera_btn">注销</div></a></div></div>
            </div>
        </div>
    </section>
    <script>
        $(function(){
            if("{{session('user.user_id')}}" ==''){
                $.login.show();
                $('.nologin').show();
                return false;
            }else{
                $('.allogin').show();
            }
        });

        function login(){
            $.login.show();
            return false;
        }

        function logout(){

        }
    </script>
@stop