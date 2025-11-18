<!-- ================== BEGIN BASE CSS STYLE ================== -->
<link rel="stylesheet" href="/assets/d2eace91/fonts/css/font-awesome.min.css?v=1.2"/>
<link rel="stylesheet" href="/assets/d2eace91/css/scrollBar/jquery.mCustomScrollbar.css?v=1.2"/>
<link rel="stylesheet" href="/assets/d2eace91/bootstrap/css/bootstrap.min.css?v=1.2"/>
<link rel="stylesheet" href="/assets/d2eace91/css/animate.css?v=1.2"/>
<link rel="stylesheet" href="/assets/d2eace91/bootstrap/switch/css/bootstrap-switch.min.css?v=1.2"/>
<link rel="stylesheet" href="/assets/d2eace91/js/chosen/chosen.css?v=1.2"/>
<link rel="stylesheet" href="/assets/d2eace91/css/common.css?v=1.2"/>
<link rel="stylesheet" href="/css/seller.css?v=1.2"/>
<!-- -->
<link rel="stylesheet" href="/css/mj-style.css?v=1.2"/>
<!-- ================== END BASE CSS STYLE ================== -->

<!--[if lt IE 9]>
<script src="/assets/d2eace91/js/html5shiv.min.js?v=1.2"></script>
<script src="/assets/d2eace91/js/respond.min.js?v=1.2"></script>
<![endif]-->
<!-- ================== BEGIN BASE JS ================== -->
<script src="/assets/d2eace91/js/jquery.js?v=1.2"></script>
<!-- 加载Layer插件 -->
<script src="/assets/d2eace91/js/layer/layer.js?v=1.2"></script>
<script src="/assets/d2eace91/js/jquery.method.js?v=1.2"></script>
<script src="/assets/d2eace91/js/jquery.modal.js?v=1.2"></script>
<!-- -->
<script src="/assets/d2eace91/bootstrap/js/bootstrap.min.js?v=1.2"></script>
<script src="/assets/d2eace91/bootstrap/switch/js/bootstrap-switch.min.js?v=1.2"></script>
<script src="/assets/d2eace91/js/scrollBar/jquery.mousewheel.min.js?v=1.2"></script>
<script src="/assets/d2eace91/js/scrollBar/jquery.mCustomScrollbar.js?v=1.2"></script>
<script src="/assets/d2eace91/js/chosen/jquery.chosen.js?v=1.3"></script>
<script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=1.2"></script>
<script src="/assets/d2eace91/js/common.js?v=1.2"></script>
<script src="/assets/d2eace91/js/jquery.cookie.js?v=1.2"></script>
<script src="/assets/d2eace91/js/clipboard.min.js?v=1.2"></script>
<!-- 加载Chosen插件 END-->
<script src="/js/common.js?v=1.2"></script>
{{--todo 暂时注释--}}
<script src="/assets/d2eace91/js/lodop/LodopFuncs.js?v=1.3"></script>
<script type="text/javascript">
    // 返回顶部js
    $(window).scroll(function() {
        var position = $(window).scrollTop();
        if (position >0) {
            $('.totop').removeClass('bounceOut').addClass('animated bounceIn');
        } else {
            $('.totop').removeClass('bounceIn').addClass('animated bounceOut');
        }
    });

</script>

<link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.6"/>

<div class="table-content">
    <!--步骤-->
    <ul class="add-goods-step">
        {{--            <li id="step_1">--}}
        {{--                <i class="fa fa-list-alt step"></i>--}}
        {{--                <h6>STEP.1</h6>--}}
        {{--                <h2>选择商品分类</h2>--}}
        {{--                <i class="fa fa-angle-right"></i>--}}
        {{--            </li>--}}
        <li id="step_1">
            <i class="fa fa-edit step"></i>
            <h6>STEP.1</h6>
            <h2>填写商品详情</h2>
            <i class="fa fa-angle-right"></i>
        </li>
        <li id="step_2">
            <i class="fa fa-image step"></i>
            <h6>STEP.2</h6>
            <h2>上传商品图片</h2>
            <i class="fa fa-angle-right"></i>
        </li>
        <li id="step_3">
            <i class="fa fa-check-square-o step"></i>
            <h6>STEP.3</h6>
            <h2>商品发布成功</h2>
        </li>
    </ul>
    <script type="text/javascript">
        $().ready(function(){
            $("#step_3").addClass("current");
        });
    </script>
    <div class="content">
        <div class="goods-info-four">
            <div class="issued-success">
                <h2>
                    <i class="fa fa-check-circle-o m-r-10"></i>
                    恭喜您，商品发布成功！
                </h2>
                <div class="issued-success-content m-t-20">
                    <p>
                        <a class="add-gift" href="/func/goods/save_goods">
                            <i class="fa fa-plus"></i>
                            继续添加商品
                        </a>
                    </p>
{{--                    <p class="page-jump">--}}
{{--                        <a class="c-blue m-r-20" href="{{ route('pc_show_goods', ['goods_id'=>$goods_id]) }}" target="_blank">去店铺查看商品详情&gt;&gt;</a>--}}
{{--                        <a class="c-blue" href="/goods/publish/edit-gift?id={{ $goods_id }}&ref_url=/goods/default/onsale" >为此商品添加赠品&gt;&gt;</a>--}}
{{--                    </p>--}}
                    <h5 style="display:none">您还可以:</h5>
                    <ul class="" style="display:none">
                        <li>
                            1. 继续 "
                            <a href="/func/goods/save_goods?id={{ $goods_id }}" class="c-blue" >重新编辑刚发布的商品</a>
                            "
                        </li>
                        <li>
                            2. 进入 产品管理 "
                            <a href="/func/goods/goods_manage" class="c-blue">出售中的商品</a>
                            "
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>