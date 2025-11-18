@include('layouts.header')
<style>
    *{line-height: 24px;}
    .chosen-container-single .chosen-search input[type="text"]{color:#000;}
    body{background:{{$website['background']}} !important;}
    .disf{display:flex;align-items:center;}
    /**搜索栏**/
    .searchBox{width: 40%;}
    .searchBox .searchLogo{text-align: center;margin-bottom:20px;}
    .searchBox .searchLogo img{width:360px;}
    .searchBox .searchContent{border-radius: 40px;background: #fff;height: 38px;border:2px solid {{$website['color_word']}};width: 100%;}
    .searchBox .selectBox select{border:0;background: none;font-size: 22px;text-align: center;}
    .searchBox .inputBox{height: 100%;width: 100%;box-shadow: 0px 0px 2px 1px #fff;border-radius: 40px;}
    .searchBox .inputBox .nameBox {padding:0px 0px 0px 20px;position: relative;width: 100%;overflow: hidden;display:flex;align-items: center;}
    .searchBox .inputBox .nameBox input{border:0;width:100%;padding-right:5px;text-align: right;font-weight: 800;}
    .searchBox .inputBox .btnBox{width:60px;height:100%;background:{{$website['color_word']}};display: flex;align-items: center;justify-content: center;border-top-right-radius: 40px;border-bottom-right-radius: 40px;padding:5px 0 0 5px;cursor: pointer;}
    .searchBox .inputBox .btnBox img{width:45px;}
    .searchBox .leftCont1{font-size: 32px;color: #fff;font-weight: 600;margin-bottom: 20px;text-align: center;text-shadow: -1px 0 4px #0e2e68, 0 1px 4px #0e2e68, 1px 0 #0e2e68, 0 -1px #0e2e68;}
    .searchBox form{margin-bottom:0;}

    #translate{display: none;}
    footer{display:block !important;}

    @media (max-width: 992px){
        #translate{display: block;}
        .navbar-default .navbar-collapse{margin-top:15px;}
    }
</style>

{{--    <style>--}}
{{--        .login-form .login-con{box-sizing: revert;}--}}
{{--        .login-wrap .form-group .text {border-bottom: 1px solid #ddd !important;}--}}
{{--    </style>--}}
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
    @include('cart.partials._cart_list')
</div>
@include('layouts.footer')
