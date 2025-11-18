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
<!-- ================== END BASE JS ================== -->
<script type="text/javascript">
    $().ready(function() {

        /*弹出消息*/
                @if(!empty(session('layerMsg')))
        var status = '{{ session()->get('layerMsg.status') }}';
        var msg = '{{ session()->get('layerMsg.msg') }}';
        switch (status) {
            case 'success':
                $.msg(msg);
                break;
            case 'error':
                $.msg(msg, function () {
                    // 关闭后的操作
                });
                break;
            case 'info':
                $.msg(msg)
                break;
            case 'warning':
                $.msg(msg, function () {
                    // 关闭后的操作
                });
                break;
        }
        // $.msg('设置成功');
        @endif

        $(".totop").click(function() {
            $("html, body").animate({
                scrollTop: 0
            }, 600);
            return false;
        });
    });
</script>
@section('header_js')@show

@section('header_style')@show

<link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.6"/>
<!-- 图片弹窗  star-->
<link rel="stylesheet" href="/assets/d2eace91/css/highslide.css?v=1.6"/>
<script src="/assets/d2eace91/js/pic/highslide-with-gallery.js?v=20180418"></script>
<link rel="stylesheet" href="/assets/d2eace91/layui/css/layui.css?v=2312"/>
<script src="/assets/d2eace91/layui/xm-select3.js?v=20180418"></script>
<!--百度富文本-->
<script type="text/javascript" src="/assets/d2eace91/plugins/ueditor/ueditor.config.js?v=777"></script>
<script type="text/javascript" src="/assets/d2eace91/plugins/ueditor/ueditor.all.min.js?v=2.8"> </script>
<script type="text/javascript" src="/assets/d2eace91/plugins/ueditor/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript" src="/assets/d2eace91/layui/layui.js"></script>
<script>
    //图片弹窗
    hs.graphicsDir = '/assets/d2eace91/js/pic/graphics/';
    hs.align = 'center';
    hs.transitions = ['expand', 'crossfade'];
    hs.outlineType = 'rounded-white';
    hs.fadeInOut = true;

    hs.addSlideshow({
        interval: 5000,
        repeat: false,
        useControls: true,
        fixedControls: 'fit',
        overlayOptions: {
            opacity: .75,
            position: 'bottom center',
            hideOnMouseOut: true
        }
    });
</script>
<!-- 图片弹窗  end-->

<style>
    #export_country,#delivery_location{width:150px;}
    .clearfix:after{height:0;display:block;visibility:hidden;content:".";clear:both;}
    .clearfix{display:inline-block;}
    .disf{display:flex;align-items:center;}
    .layui-input-block{margin-left:90px;}
    .collapse{transition:transform 250ms linear;display:block;}
    .goup{width:12px;height:12px;border:1px solid #fff;border-bottom:0;border-left:0;transform:rotate(45deg);margin-top:12px;}
    .godown{width:12px;height:12px;border:1px solid #fff;border-bottom:0;border-left:0;transform:rotate(135deg);margin-top:10px;}
    .regular_box{max-height:400px;width:100%;overflow:scroll;}
    .regular_box .chosen-container-single{display:none;}
    .spec_table .chosen-container{min-width:60px !important;max-width:100px !important;}
    .spec_table .form-control{height:32px !important;}
    .spec_table .unit_name{width:fit-content;display:inline-block;margin-left:3px;}
    .spec_table .td_width{text-align: center;}
    .spec_table .chosen-container-single .chosen-single span{margin-right:0 !important;}
    .note{display: inline-block;background-color: #22BAA0;padding: 5px 10px;border-radius: 3px;font-size: 14px;margin: 5px;color:#fff;}
    .cross_logi-div{display: none;}
    .reduction_div .chosen-container{min-width: 100px !important;}
    xm-select .xm-label .xm-label-block{height: 23px;line-height: 23px;}
    xm-select {min-height: 33px;line-height: 33px;}
    xm-select > .xm-label .scroll .label-content{padding:1px 30px 1px 10px;}
</style>
<div class="table-content">

    <!--步骤-->
    <ul class="add-goods-step">
        {{--            <li id="step_1">--}}
        {{--                <i class="fa fa-list-alt step"></i>--}}
        {{--                <h6>STEP.1</h6>--}}
        {{--                <h2>选择销售分类</h2>--}}
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
            $("#step_1").addClass("current");
        });
    </script>

    <!--表单内容-->
    <div class="content m-t-30">
        <div class="goods-info-two">
            <form id="GoodsModel" class="form-horizontal" name="GoodsModel" action="/goods/publish/index?cat_id={{ $cat_id }}" method="POST">
            {{ csrf_field() }}
            <!-- 分类编号 -->
                {{--                    <input type="hidden" id="goodsmodel-cat_id" class="form-control" name="GoodsModel[cat_id]" value="{{ $cat_id }}">--}}
                <h5 class="m-b-30">商品基本信息</h5>
                <!-- 商品类别 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="goodsmodel-goods_mode" class="col-sm-1 control-label">

                            <span class="ng-binding">商品类别：</span>
                        </label>
                        <div class="col-sm-11">
                            <div class="form-control-box">
                                <input type="hidden" name="GoodsModel[goods_mode]" value="0">
                                <div id="goodsmodel-goods_mode" class="" name="GoodsModel[goods_mode]" selection="0">
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="GoodsModel[goods_mode]" value="0" @if($goods_mode == 0){{ 'checked' }}@endif> 实物商品（物流发货）</label>
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="GoodsModel[goods_mode]" value="1" @if($goods_mode == 1){{ 'checked' }}@endif> 电子卡券（无需物流）</label>
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="GoodsModel[goods_mode]" value="2" @if($goods_mode == 2){{ 'checked' }}@endif> 服务商品（无需物流）</label></div>
                            </div>
                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
                <!-- 销售类别 -->
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="text4" class="col-sm-1 control-label">
                            <span class="text-danger ng-binding"></span>
                            <span class="ng-binding">销售分类：</span>
                        </label>
                        <div class="col-sm-11 disf">
                            <div class=" cat_div1 cat_div disf">
                                <select id="goodsmodel-sale_cate" class="form-control chosen-select" name="GoodsModel[sale_cate1]" onchange="sale_cate1(this,1)">
                                    <option value="">请选择</option>
                                    <option value="-1">自定义类别</option>
                                    @foreach($sale_cate as $k=>$v)
                                        <option value="{{$v['cat_id']}}">{{$v['cat_name']}}</option>
                                    @endforeach
                                </select>
                                <input type="text" class="form-control diyname" name="diy_catname1" value="" style="display: none;" placeholder="多层用“、”分开">
                            </div>
                            <div class=" cat_div2 cat_div disf">

                            </div>
                            <div class=" cat_div3 cat_div disf">

                            </div>
                            {{--                                <label class="control-label" data-anchor="销售分类">{!! $cat_names !!}</label>--}}
                            {{--                                <input type="hidden" id="goodsmodel-cat_id" class="form-control" name="GoodsModel[cat_id]" value="{{ $cat_id }}">--}}
                            {{--                                <a id="change_category" href="javascript:void(0);" class="btn btn-warning btn-sm m-l-5">编辑销售分类</a>--}}

                        </div>
                    </div>
                </div>
                <!--销售类别的属性-->
                <div class="simple-form-field sale_value">
                    <div class="form-group">
                        <label for="text4" class="col-sm-1 control-label">
                            <span class="text-danger ng-binding"></span>
                            <span class="ng-binding">销售分类属性：</span>
                        </label>
                        <div class="col-sm-11">
                            <div class="value_box goods-attr" style="display: grid;grid-template-columns: repeat(2,1fr);-moz-column-gap: 20px;column-gap: 20px;row-gap: 0px;">

                            </div>
                            <a id="btn_add_salecate_attr" href="javascript:void(0);" class="btn btn-warning btn-sm m-t-10">
                                <i class="fa fa-plus"></i>
                                添加属性
                            </a>
                        </div>
                    </div>
                </div>
                <!--物流分类-->
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="" class="col-sm-1 control-label">
                            <span class="ng-binding">物流分类：</span>
                        </label>
                        <div class="col-sm-11">
                            <div class="form-control-box">
                                <select id="goodsmodel-logistics_cate" class="form-control chosen-select" name="GoodsModel[logistics_cate]">
                                    <option value="1">（发货国地的）境内配送</option>
                                    <option value="2">（发货国地的）跨境集运</option>
                                </select>
                            </div>
                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
                <!--跨境物流分类-->
                <div class="simple-form-field cross_logi_cate" style="display: none;">
                    <div class="form-group">
                        <label for="" class="col-sm-1 control-label">
                            <span class="ng-binding">跨境物流分类：</span>
                        </label>
                        <div class="col-sm-11 disf">
                            <div class=" logicat_div1 logicat_div disf">
                                <select id="goodsmodel-crossb_cate" class="form-control chosen-select" name="GoodsModel[crossb_cate1]" onchange="logi_cate1(this,1)">
                                    <option value="">请选择</option>
                                    <option value="-1">自定义类别</option>
                                    @foreach($logi_cate as $k=>$v)
                                        <option value="{{$v['cat_id']}}">{{$v['cat_name']}}</option>
                                    @endforeach
                                </select>
                                <input type="text" class="form-control diyname" name="diy_loginame1" value="" style="display: none;" placeholder="多层用“、”分开">
                            </div>
                            <div class=" logicat_div2 logicat_div disf">
                                {{--                                    <div class="prohibit_div" style="display: none;">--}}
                                {{--                                        <select id="goodsmodel-prohibit_cate" class="form-control chosen-select" name="GoodsModel[prohibit_cate]">--}}
                                {{--                                            <option value="1">限制</option>--}}
                                {{--                                            <option value="2">禁止</option>--}}
                                {{--                                        </select>--}}
                                {{--                                    </div>--}}
                            </div>
                            <div class=" logicat_div3 logicat_div disf">

                            </div>
                        </div>
                    </div>
                </div>
                <!--跨境物流类别的属性-->
                <div class="simple-form-field logi_value" style="display: none;">
                    <div class="form-group">
                        <label for="text4" class="col-sm-1 control-label">
                            <span class="text-danger ng-binding"></span>
                            <span class="ng-binding">物流分类属性：</span>
                        </label>
                        <div class="col-sm-11">
                            <div class="value_box goods-attr" style="display: grid;grid-template-columns: repeat(2,1fr);-moz-column-gap: 20px;column-gap: 20px;row-gap: 0px;">

                            </div>
                            <a id="btn_add_logicate_attr" href="javascript:void(0);" class="btn btn-warning btn-sm m-t-10">
                                <i class="fa fa-plus"></i>
                                添加属性
                            </a>
                        </div>
                    </div>
                </div>
                <!--物流说明-->
                <div class="form-group">
                    <label for="goodsmodel-goods_attr" class="col-sm-1 control-label">
                        <span class="ng-binding">物流说明：</span>
                    </label>
                    <div class="col-sm-11">
                        <div class="form-control-box" style="width: 100%;">
                            <div class="goods-attr ">
                                <div class="goods-attr-tit">
                                    <span>发货国地</span>
                                </div>
                                <div class="simple-form-field" >
                                    <div class="form-group">
                                        <label for="goodsmodel-goods_attr" class="col-sm-1 control-label">
                                            <span class="ng-binding">发货国地：</span>
                                        </label>
                                        <div class="col-sm-11">
                                            <div class="form-control-box">
                                                {{--                                                    <select id="goodsmodel-delivery_location" class="form-control chosen-select" name="GoodsModel[delivery_location]">--}}
                                                {{--                                                        <option value="">请选择发货国地</option>--}}
                                                {{--                                                    </select>--}}
                                                <div id="delivery_location" class="xm-select-demo" style="display: inline-block;"></div>
                                                <div class="area_div" style="display: inline-block;"></div>
                                            </div>
                                            <div class="help-block help-block-t"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="goods-attr ">
                                <div class="goods-attr-tit">
                                    <span>服务支持</span>
                                </div>
                                <div class="simple-form-field" style="display: grid;grid-template-columns: repeat(2,1fr);-moz-column-gap: 20px;column-gap: 20px;row-gap: 0px;">
                                    <div class="form-group">
                                        <label for="goodsmodel-goods_attr" class="col-sm-2 control-label">
                                            <span class="ng-binding">服务支持：</span>
                                        </label>
                                        <div class="col-sm-10">
                                            <div class="form-control-box">
                                                <select id="goodsmodel-service_type" class="form-control chosen-select" name="GoodsModel[service_type]">
                                                    <option value="1">（发货国地的）境内配送</option>
                                                    <option value="2">（发货国地的）跨境集运</option>
                                                </select>

                                                <!--境内配送-->
                                                <div class="domestic_logi" style="display:inline-block;">
                                                    <select id="goodsmodel-domestic_type" class="form-control chosen-select" name="GoodsModel[domestic_type]">
                                                        <option value="1">支持</option>
                                                        <option value="2">不支持</option>
                                                    </select>
                                                </div>
                                                <div class="domestic_baoyou" style="display:inline-block;">
                                                    <select id="goodsmodel-domestic_baoyou" class="form-control chosen-select" name="GoodsModel[domestic_baoyou]">
                                                        <option value="1">包邮</option>
                                                        <option value="2">不包邮</option>
                                                    </select>
                                                </div>

                                                <!--跨境集运-->
                                                <div class="cross_logi" style="display:none;">
                                                    <select id="goodsmodel-cross_logi" class="form-control chosen-select" name="GoodsModel[cross_logi]">
                                                        <option value="1">支持</option>
                                                        <option value="2">不支持</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group cross_logi-div">
                                        <label for="goodsmodel-goods_attr" class="col-sm-2 control-label">
                                            <span class="ng-binding">境内集货：</span>
                                        </label>
                                        <div class="col-sm-10">
                                            <div class="form-control-box">
                                                <select id="goodsmodel-cross_logi_baoyou" class="form-control chosen-select" name="GoodsModel[cross_logi_baoyou]">
                                                    <option value="1">包邮到仓</option>
                                                    <option value="2">不包邮到仓</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group cross_logi-div">
                                        <label for="goodsmodel-goods_attr" class="col-sm-2 control-label">
                                            <span class="ng-binding">进出清关：</span>
                                        </label>
                                        <div class="col-sm-10">
                                            <div class="form-control-box">
                                                <select id="goodsmodel-cross_logi_clean" class="form-control chosen-select" name="GoodsModel[cross_logi_clean]">
                                                    <option value="1">双清</option>
                                                    <option value="2">单清</option>
                                                    <option value="3">不包</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group cross_logi-div">
                                        <label for="goodsmodel-goods_attr" class="col-sm-2 control-label">
                                            <span class="ng-binding">跨境运费：</span>
                                        </label>
                                        <div class="col-sm-10">
                                            <div class="form-control-box">
                                                <select id="goodsmodel-cross_logi_freightfee" class="form-control chosen-select" name="GoodsModel[cross_logi_freightfee]">
                                                    <option value="1">包含</option>
                                                    <option value="2">不含</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group cross_logi-div">
                                        <label for="goodsmodel-goods_attr" class="col-sm-2 control-label">
                                            <span class="ng-binding">海关税费：</span>
                                        </label>
                                        <div class="col-sm-10">
                                            <div class="form-control-box">
                                                <select id="goodsmodel-cross_logi_taxfee" class="form-control chosen-select" name="GoodsModel[cross_logi_taxfee]">
                                                    <option value="1">包含税费</option>
                                                    <option value="2">税费实付</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group cross_logi-div">
                                        <label for="goodsmodel-goods_attr" class="col-sm-2 control-label">
                                            <span class="ng-binding">当地配送：</span>
                                        </label>
                                        <div class="col-sm-10">
                                            <div class="form-control-box">
                                                <select id="goodsmodel-cross_logi_peisong" class="form-control chosen-select" name="GoodsModel[cross_logi_peisong]">
                                                    <option value="1">配送到门</option>
                                                    <option value="2">配送到仓</option>
                                                    <option value="3">海关自提</option>
                                                </select>

                                                <div class="daomen" style="display:inline-block;">
                                                    <select id="goodsmodel-cross_logi_daomen" class="form-control chosen-select" name="GoodsModel[cross_logi_daomen]">
                                                        <option value="1">私人地址</option>
                                                        <option value="2">商业地址</option>
                                                        <option value="3">偏远地址</option>
                                                    </select>
                                                </div>
                                                <div class="daocang" style="display: none;">
                                                    <select id="goodsmodel-cross_logi_daocang" class="form-control chosen-select" name="GoodsModel[cross_logi_daocang]">
                                                        <option value="1">仓库自提</option>
                                                        <option value="2">定点自提</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="goods-attr  cross_logi-div">
                                <div class="goods-attr-tit">
                                    <span>收货地址</span>
                                </div>
                                <div class="simple-form-field" >
                                    <div class="form-group">
                                        <label for="goodsmodel-goods_attr" class="col-sm-2 control-label">
                                            <span class="ng-binding">中国境外转运：</span>
                                        </label>
                                        <div class="col-sm-10">
                                            <div class="form-control-box">
                                                <select id="goodsmodel-zhuanyun" class="form-control chosen-select" name="GoodsModel[zhuanyun]">
                                                    <option value="1">支持</option>
                                                    <option value="2">不支持</option>
                                                </select>

                                                {{--                                                    <div class="support_zhuanyun" style="display:inline-block;">--}}
                                                {{--                                                        <select id="goodsmodel-zhuanyun_type" class="form-control chosen-select" name="GoodsModel[zhuanyun_type]">--}}
                                                {{--                                                            <option value="1">使用平台集运</option>--}}
                                                {{--                                                            <option value="2">买家自主集运</option>--}}
                                                {{--                                                        </select>--}}
                                                {{--                                                    </div>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!---商品品牌-->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="goodsmodel-brand_id" class="col-sm-1 control-label">
                            <span class="ng-binding">商品品牌：</span>
                        </label>
                        <div class="col-sm-11">
                            <div class="form-control-box">
                                <select id="brand_type" name="GoodsModel[brand_type]" class="form-control chosen-select">
                                    <option value="1">白牌</option>
                                    <option value="2">有牌</option>
                                </select>
                                <div class="brand_div" style="display: none;">
                                    <select name="GoodsModel[brand_type2]" class="form-control chosen-select">
                                        <option value="1">品牌</option>
                                        <option value="2">名牌</option>
                                    </select>
                                    <div class="brand_box" style="display:inline-block;">

                                    </div>
                                    <input type="text" id="goodsmodel-brandname" class="form-control" name="diy_brandname" placeholder="请输入自定义品牌名称" style="display: none;">
                                </div>
                            </div>
                            <div class="help-block help-block-t"><div class="help-block help-block-t">选择您的商品品牌，有利于商品通过品牌索引方式被找到；</div></div>
                        </div>
                    </div>
                </div>

                <!---扩展分类-->
                <div class="simple-form-field" style="display: none;">
                    <div class="form-group">
                        <label for="" class="col-sm-1 control-label">

                            <span class="ng-binding">扩展分类：</span>
                        </label>
                        <div class="col-sm-11">
                            <div class="form-control-box">

                                <div class="form-control-box choosen-select-box">
                                    <div id="other_cat_container"></div>
                                    <input type="text" id="other_cat_ids" class="form-control" value="" style="display: none;">
                                </div>

                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
                <!--新加批发 start-->
                <div class="simple-form-field" style="display: none;">
                    <div class="form-group">
                        <label for="text4" class="col-sm-1 control-label">
                            <span class="ng-binding">预售设置：</span>
                        </label>
                        <div class="col-sm-11">
                            <div class="form-control-box">
                                <label class="control-label cur-p">
                                    <input class="cur-p" type="checkbox" />
                                    预售商品
                                </label>
                            </div>
                            <div class="help-block help-block-t">预售商品不支持加入购物车</div>
                        </div>
                    </div>
                </div>
                <div class="simple-form-field" style="display: none;">
                    <div class="form-group">
                        <label for="text4" class="col-sm-1 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">发货时间：</span>
                        </label>
                        <div class="col-sm-11">
                            <div class="form-control-box">
                                <label class="control-label cur-p m-r-10">
                                    <input class="cur-p" type="radio" name="radio-date" checked="checked" />
                                    <input class="form-control form_datetime w150 m-r-10" type="text">
                                    开始发货
                                </label>
                                </br>
                                <label class="control-label cur-p m-r-10">
                                    <input class="cur-p" type="radio" type="text" name="radio-date" />
                                    付款成功
                                    <input class="form-control w90 m-l-10 m-r-10">
                                    天后发货
                                </label>
                            </div>
                            <div class="help-block help-block-t">约定几号开始发货，开始发货当前，预售活动自动结束，只允许设置90天内的发货时间，请务必按照约定时间发货以免引起客户投诉设置付款成功x天后发货，预售活动无结束时间。</div>
                        </div>
                    </div>
                </div>
                <!--新加 end-->
                <!-- 商品名称 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="goodsmodel-goods_name" class="col-sm-1 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">商品名称：</span>
                        </label>
                        <div class="col-sm-11">
                            <div class="form-control-box">
                                <input type="text" id="goodsmodel-goods_name" class="form-control" name="GoodsModel[goods_name]" data-anchor="商品名称">
                            </div>
                            <div class="help-block help-block-t"><div class="help-block help-block-t">商品标题名称长度至少3个字，最长60个字</div></div>
                        </div>
                    </div>
                </div>
                <!-- 商品关键词 -->
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="goodsmodel-keywords" class="col-sm-1 control-label">

                            <span class="ng-binding">关键词：</span>
                        </label>
                        <div class="col-sm-11">
                            <div class="form-control-box">


                                <input type="text" id="goodsmodel-keywords" class="form-control" name="GoodsModel[keywords]">


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">关键词之间用空格分割，设置后有利于搜索引擎优化</div></div>
                        </div>
                    </div>
                </div>
                <!-- 商品卖点 -->
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="goodsmodel-goods_subname" class="col-sm-1 control-label">

                            <span class="ng-binding">商品卖点：</span>
                        </label>
                        <div class="col-sm-11">
                            <div class="form-control-box">


                                <textarea id="goodsmodel-goods_subname" class="form-control" name="GoodsModel[goods_subname]" rows="5"></textarea>


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">商品卖点最长不能超过140个字，设置后有利于搜索引擎优化</div></div>
                        </div>
                    </div>
                </div>
                <!-- 计价方式 -->
                <div class="simple-form-field" style="display:;">
                    <div class="form-group">
                        <label for="goodsmodel-pricing_mode" class="col-sm-1 control-label">

                            <span class="ng-binding">计价方式：</span>
                        </label>
                        <div class="col-sm-11">
                            <div class="form-control-box">


                                <input type="hidden" name="GoodsModel[pricing_mode]" value="0">
                                <div id="goodsmodel-pricing_mode" class="" name="GoodsModel[pricing_mode]">
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="GoodsModel[pricing_mode]" value="0" checked> 计件</label>
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="GoodsModel[pricing_mode]" value="1"> 计重</label>
                                </div>


                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
                <!-- 商品单位 -->
                <div class="simple-form-field" style="display:;">
                    <div class="form-group">
                        <label for="goodsmodel-goods_unit" class="col-sm-1 control-label">
                            <span class="ng-binding">商品单位：</span>
                        </label>
                        <div class="col-sm-11">
                            <div class="form-control-box">
                                <select id="goodsmodel-goods_unit" class="form-control chosen-select" name="GoodsModel[goods_unit]">
                                    @foreach($goods_unit_list as $k=>$v)
                                        <option value="{{ $k }}">{{ $v }}</option>
                                    @endforeach
                                </select>
                                <a class="btn btn-warning btn-sm m-l-5" href="/goods/goods-unit/list" target="blank">新建商品单位</a>
                                <a class="btn btn-primary btn-sm m-l-5 reload_btn">重新加载</a>
                            </div>
                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>

                <h5 class="m-b-30">商品详情信息</h5>
                <!-- 跨境说明 -->
                <div class="form-group">
                    <label for="goodsmodel-goods_attr" class="col-sm-1 control-label">
                        <span class="ng-binding">跨境说明：</span>
                    </label>
                    <div class="col-sm-11">
                        <div class="form-control-box" style="width: 100%;">
                            <div class="goods-attr ">
                                <div class="goods-attr-tit">
                                    <span>跨境贸易限制</span>
                                </div>
                                <div class="simple-form-field" style="display: grid;grid-template-columns: repeat(2,1fr);-moz-column-gap: 20px;column-gap: 20px;row-gap: 0px;">
                                    <div class="form-group">
                                        <label for="goodsmodel-goods_attr" class="col-sm-2 control-label">
                                            <span class="ng-binding">是否可以出口：</span>
                                        </label>
                                        <div class="col-sm-10">
                                            <div class="form-control-box">
                                                <select id="goodsmodel-is_export" class="form-control chosen-select" name="GoodsModel[is_export]">
                                                    <option value="1">是</option>
                                                    <option value="2">否</option>
                                                </select>
                                            </div>
                                            <div class="help-block help-block-t"><div class="help-block help-block-t"><span class="support_export">支持</span>外币结算、跨境集运；</div></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="goodsmodel-goods_attr" class="col-sm-2 control-label">
                                            <span class="ng-binding">支持进口国家：</span>
                                        </label>
                                        <div class="col-sm-10">
                                            <div class="form-control-box">
                                                <div id="export_country" class="xm-select-demo"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="goods-attr ">
                                <div class="goods-attr-tit">
                                    <span>跨境物流限制</span>
                                </div>
                                <div class="simple-form-field" >
                                    <div class="form-group">
                                        <label for="goodsmodel-goods_attr" class="col-sm-1 control-label">
                                            <span class="ng-binding">是否跨境集运：</span>
                                        </label>
                                        <div class="col-sm-11">
                                            <div class="form-control-box">
                                                <select id="goodsmodel-is_gather" class="form-control chosen-select" name="GoodsModel[is_gather]">
                                                    <option value="1">支持跨境集运</option>
                                                    <option value="2">不能跨境集运</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="goods-attr ">
                                <div class="goods-attr-tit">
                                    <span>跨境结算限制</span>
                                </div>
                                <div class="simple-form-field" >
                                    <div class="form-group">
                                        <label for="goodsmodel-goods_attr" class="col-sm-1 control-label">
                                            <span class="ng-binding">是否外币结算：</span>
                                        </label>
                                        <div class="col-sm-11">
                                            <div class="form-control-box">
                                                <select id="goodsmodel-is_outcurrency" class="form-control chosen-select" name="GoodsModel[is_outcurrency]">
                                                    <option value="1">支持外币结算</option>
                                                    <option value="2">不能外币结算</option>
                                                </select>
                                            </div>
                                            <div class="help-block help-block-t"><div class="help-block help-block-t">支持 <span class="support_currency">本币聚合支付、外币聚合支付</span>；</div></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 商品属性 -->
                <div class="simple-form-field" style="display: none;">
                    <div class="form-group">
                        <label for="goodsmodel-goods_attr" class="col-sm-1 control-label">
                            <span class="ng-binding">商品属性：</span>
                        </label>
                        <div class="col-sm-11">
                            <div class="form-control-box">

                                <div class="goods-attr w800" data-anchor="商品属性">

                                    @if(!empty($attr_list))
                                        <div class="goods-attr-tit">
                                            <span>平台系统属性</span>
                                        </div>

                                        @foreach($attr_list as $v)
                                            <div class="simple-form-field" >
                                                <div class="form-group">
                                                    <label for="" class="col-sm-2 control-label">
                                                        @if($v['is_required'] == 1)
                                                            <span class="text-danger ng-binding">*</span>
                                                        @endif
                                                        <span class="ng-binding">{{ $v['attr_name'] }}：</span>
                                                    </label>
                                                    <div class="col-sm-11">
                                                        <div class="form-control-box">
                                                            <div class="attr-values" data-attr-id="{{ $v['attr_id'] }}" data-required="{{ $v['is_required'] }}">
                                                            @if($v['attr_style'] == 2)
                                                                {{--文本--}}
                                                                <!-- 多选属性 -->
                                                                    <input type="text" id="goods_attrs_{{ $v['attr_id'] }}" class="form-control"
                                                                           name="goods_attrs[{{ $v['attr_id'] }}]"
                                                                           data-rule-required="@if($v['is_required'] == 1){{ $v['is_required'] }}@endif" data-msg="@if($v['is_required'] == 1){{ $v['attr_name'] }}不能为空！ @endif">
                                                                    <!-- 品牌属性 -->
                                                                @elseif($v['attr_style'] == 1)
                                                                    {{--单选--}}
                                                                    <select id="goods_attrs_{{ $v['attr_id'] }}" class="form-control chosen-select"
                                                                            name="goods_attrs[{{ $v['attr_id'] }}]"
                                                                            data-rule-required="@if($v['is_required'] == 1){{ $v['is_required'] }}@endif" data-msg="@if($v['is_required'] == 1){{ $v['attr_name'] }}不能为空！ @endif">
                                                                        <option value=""></option>
                                                                        @foreach($attr_values[$v['attr_id']] as $av)
                                                                            <option value="{{ $av['id'] }}">{{ $av['value'] }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                @elseif($v['attr_style'] == 0)
                                                                    {{--多选--}}
                                                                    @foreach($attr_values[$v['attr_id']] as $av)
                                                                        <label class="control-label cur-p m-r-10">
                                                                            <input type="checkbox" id="goods_attrs_{{ $v['attr_id'] }}_{{ $av['id'] }}"
                                                                                   name="goods_attrs[{{ $v['attr_id'] }}][]" value="{{ $av['id'] }}"
                                                                                   data-rule-required="@if($v['is_required'] == 1){{ $v['is_required'] }}@endif" data-msg="@if($v['is_required'] == 1){{ $v['attr_name'] }}不能为空！ @endif">
                                                                            {{ $av['value'] }}
                                                                        </label>
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="help-block help-block-t"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif


                                    <div class="goods-attr-tit">
                                        <span>店铺自定义属性</span>
                                        <i class="fa fa-question-circle f16 c-ccc pull-right cur-p m-t-5" data-toggle="popover" data-trigger="hover" data-placement="left" data-html="true" data-content="<img width='260' height='173' src='/images/goods/custom-attributes.png'>"></i>
                                    </div>
                                    <div class="other-attrs-list">

                                    </div>
                                    <a id="btn_add_other_attr" href="javascript:void(0);" class="btn btn-warning btn-sm m-t-10">
                                        <i class="fa fa-plus"></i>
                                        添加自定义属性
                                    </a>
                                </div>

                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
                <!-- 商品详情 -->
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="text4" class="col-sm-1 control-label">
                            <span class="ng-binding">商品描述：</span>
                        </label>
                        <div class="col-sm-11">
                            <div class="form-control-box">
                                <script id="content" name="GoodsModel[pc_desc]" class="content" type="text/plain" style="width:100%;height:200px;background:#444444;">

                                </script>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 价格说明 -->
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="text4" class="col-sm-1 control-label">
                            <span class="ng-binding">价格说明：</span>
                        </label>
                        <div class="col-sm-11">
                            <div class="form-control-box" style="width: 100%;">
                                <div class="goods-attr type1 w800" style="display: none;">
                                    <div class="goods-attr-tit">
                                        <span>平台价格说明</span>
                                    </div>
                                    <div class="simple-form-field">
                                        <div class="input40">
                                            <input type="hidden" id="big_parag_num" value="1">
                                            <div class="regular_box" style="display:none;"></div>
                                            <div class="layui-form-item type1_box">
                                                <div class="layui-form-label" style="padding-top:0;">
                                                    <input type="text" name="parag_num1[]" class="layui-input parag_num" value="1." readonly>
                                                </div>
                                                <div class="layui-input-block">
                                                    <div class="disf">
                                                        <div class="disf">
                                                            <input type="hidden" class="layui-input" name="pnum1[]" value="0">
                                                            <input type="hidden" class="layui-input" name="is_title1[]" value="1">
                                                            <input type="text" class="layui-input" name="title1[]" placeholder="输入标题" value="" onkeyup="keyup(this)">
                                                        </div>
                                                        <div class="disf">
                                                            <div class="layui-btn layui-btn-success" onclick="add_common_grade(this)">新增同级</div>
                                                            <div class="layui-btn layui-btn-success" onclick="add_next_grade(this)">新增下级</div>
                                                        </div>
                                                    </div>
                                                    <div class="textarea_div">
                                                        <textarea name="content1[]" class="layui-textarea" placeholder="输入内容" value="" onkeyup="keyup2(this)"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="goods-attr type1 ">
                                    <div class="goods-attr-tit">
                                        <span>销售优惠</span>
                                    </div>
                                    <div class="simple-form-field">
                                        <div class="form-group">
                                            <label for="goodsmodel-goods_attr" class="col-sm-1 control-label" style="width: 100px;">
                                                <span class="ng-binding">减免：</span>
                                            </label>
                                            <div class="col-sm-11" style="width: 80%;">
                                                <table class="layui-table reduction_div" style="width: 100%;">
                                                    <thead>
                                                    <th>优惠权属</th>
                                                    <th>规则</th>
                                                    <th>限制</th>
                                                    <th>金额</th>
                                                    <th>操作</th>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            <select id="goodsmodel-preferential_blong" class="form-control chosen-select" name="reduction[preferential_blong][]">
                                                                <option value="1">卖家优惠</option>
                                                                <option value="2">平台优惠</option>
                                                                <option value="3">他方优惠</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select id="goodsmodel-reduction_type" class="form-control chosen-select" name="reduction[type][]" onchange="reduction_type(this,0)">
                                                                <option value="">请选择规则</option>
                                                                @foreach($reduction_rule as $k=>$v)
                                                                    <option value="{{$v['id']}}" data-name1="{{$v['content'][0]}}" data-name2="{{$v['content'][2]}}">{{$v['name']}}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select id="goodsmodel-reduction_strict" class="form-control chosen-select" name="reduction[strict][]">
                                                                <option value="1">单独</option>
                                                                <option value="2">叠加</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <div class="name1"></div>
                                                            <div class="currency_div">
                                                                <select id="goodsmodel-reduction_currency1" class="form-control chosen-select reduction_currency common_currency" name="reduction[currency1][0][]">
                                                                    <option value="">请选择币种</option>
                                                                    @foreach($currency as $k=>$v)
                                                                        <option value="{{$v['id']}}" @if($v['id']==5)
                                                                        selected
                                                                                @endif>{{$v['code_zhname']}}:{{$v['currency_symbol_origin']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <input type="number" class="layui-input" name="reduction[price1][0][]" placeholder="数值">
                                                            <div class="name2"></div>
                                                            <div class="currency_div">
                                                                <select id="goodsmodel-reduction_currency2" class="form-control chosen-select reduction_currency common_currency" name="reduction[currency2][0][]">
                                                                    <option value="">请选择币种</option>
                                                                    @foreach($currency as $k=>$v)
                                                                        <option value="{{$v['id']}}" @if($v['id']==5)
                                                                        selected
                                                                                @endif>{{$v['code_zhname']}}:{{$v['currency_symbol_origin']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <input type="number" class="layui-input" name="reduction[price2][0][]" placeholder="数值">
                                                        </td>
                                                        <td style="width: 140px;">
                                                            <div class="layui-btn layui-btn-md layui-btn-normal" onclick="reduction_add(this)">+</div>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="goodsmodel-goods_attr" class="col-sm-1 control-label" style="width: 100px;">
                                                <span class="ng-binding">随赠：</span>
                                            </label>
                                            <div class="col-sm-11" style="width: 80%;">
                                                <table class="layui-table gift_div" style="width: 100%;">
                                                    <thead>
                                                    <th>优惠权属</th>
                                                    <th>项目</th>
                                                    <th>限制</th>
                                                    <th>操作</th>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            <select id="goodsmodel-preferential_blong" class="form-control chosen-select" name="gift[preferential_blong][]">
                                                                <option value="1">卖家优惠</option>
                                                                <option value="2">平台优惠</option>
                                                                <option value="3">他方优惠</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select id="goodsmodel-gift_type" class="form-control chosen-select" name="gift[type][]" onchange="gift_type(this)">
                                                                <option value="">请选择项目</option>
                                                                <option value="1">积分</option>
                                                                <option value="2">卡券</option>
                                                                <option value="3">随赠</option>
                                                            </select>
                                                            <div class="points_coupon_div" style="display:none;">
                                                                <div class="disf">
                                                                    运营商：<select id="goodsmodel-gift_operaer" class="form-control chosen-select" name="gift[operaer][]" onchange="gift_type(this)">
                                                                        <option value="1">平台</option>
                                                                        <option value="2">卖家</option>
                                                                        <option value="3">他方</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="points_div" style="display: none;">
                                                                <div class="disf">
                                                                    按每：<select id="goodsmodel-gift_operaer" class="form-control chosen-select" name="gift[points_type][]" onchange="points_type(this)">
                                                                        <option value="1">订单/次</option>
                                                                        <option value="2">金额</option>
                                                                    </select>
                                                                </div>
                                                                <div class="disf points_money" style="display: none;">
                                                                    <select id="goodsmodel-points_currency" class="form-control chosen-select points_currency common_currency" name="gift[points_currency][]">
                                                                        <option value="">请选择币种</option>
                                                                        @foreach($currency as $k=>$v)
                                                                            <option value="{{$v['id']}}" @if($v['id']==5)
                                                                            selected
                                                                                    @endif>{{$v['code_zhname']}}:{{$v['currency_symbol_origin']}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <input type="number" class="layui-input" name="gift[points_money][]" placeholder="金额">
                                                                </div>
                                                                <div class="disf">
                                                                    送：<input type="number" class="layui-input" name="gift[points_send][]" placeholder="赠送值">
                                                                </div>
                                                            </div>

                                                            <div class="coupon_div" style="display: none;">
                                                                <div class="disf">
                                                                    面值：<select id="goodsmodel-coupon_currency" class="form-control chosen-select coupon_currency common_currency" name="gift[coupon_currency][]">
                                                                        <option value="">请选择币种</option>
                                                                        @foreach($currency as $k=>$v)
                                                                            <option value="{{$v['id']}}" @if($v['id']==5)
                                                                            selected
                                                                                    @endif>{{$v['code_zhname']}}:{{$v['currency_symbol_origin']}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <input type="number" class="layui-input" name="gift[coupon_money][]" placeholder="金额">
                                                                    <input type="number" class="layui-input" name="gift[coupon_num][]" placeholder="数量">
                                                                </div>
                                                            </div>

                                                            <div class="accgift_div" style="display: none;">
                                                                <div class="disf">
                                                                    类别：<select id="goodsmodel-gift_operaer" class="form-control chosen-select" name="gift[accgift_type][]" onchange="accgift_type(this)">
                                                                        <option value="1">虚拟</option>
                                                                        <option value="2">服务</option>
                                                                        <option value="3">实物</option>
                                                                    </select>
                                                                    <input type="text" class="layui-input" name="gift[accgift_content][]" placeholder="内容">
                                                                    <input type="number" class="layui-input" name="gift[accgift_num][]" placeholder="数量">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <select id="goodsmodel-gift_strict" class="form-control chosen-select" name="gift[strict][]">
                                                                <option value="1">单独</option>
                                                                <option value="2">叠加</option>
                                                            </select>
                                                        </td>
                                                        <td style="width:140px;">
                                                            <div class="layui-btn layui-btn-md layui-btn-normal" onclick="gift_add(this)">+</div>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="goods-attr type1 ">
                                    <div class="goods-attr-tit">
                                        <span>价格未含</span>
                                    </div>
                                    <div class="simple-form-field">
                                        <table class="layui-table noinclude_table" style="width: 100%;">
                                            <thead>
                                            <th>费用名称</th>
                                            <th>摘要描述</th>
                                            <th>计量单位</th>
                                            <th>计量单价</th>
                                            <th>操作</th>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <input type="text" id="noinclude-name" class="layui-input" name="noinclude[name][]" data-anchor="费用名称" placeholder="费用名称">
                                                </td>
                                                <td>
                                                    <input type="text" id="noinclude-desc" class="layui-input" name="noinclude[desc][]" data-anchor="摘要描述" placeholder="摘要描述">
                                                </td>
                                                <td>
                                                    <select id="noinclude-currency" class="form-control chosen-select" name="noinclude[currency][]">
                                                        @foreach($currency as $k=>$v)
                                                            <option value="{{$v['id']}}" @if($v['id'] == 5)
                                                            selected
                                                                    @endif>{{$v['code_zhname']}}:{{$v['currency_symbol_origin']}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" id="noinclude-price" class="layui-input" name="noinclude[price][]" data-anchor="计量单价" placeholder="计量单价">
                                                </td>
                                                <td style="width: 140px;">
                                                    <div class="layui-btn layui-btn-md layui-btn-normal" onclick="noinclude_add(this)">+</div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="goods-attr type1 ">
                                    <div class="goods-attr-tit">
                                        <span>潜在收费</span>
                                    </div>
                                    <div class="simple-form-field">
                                        <table class="layui-table potential_table" style="width: 100%;">
                                            <thead>
                                            <th>收款单位</th>
                                            <th>费用名称</th>
                                            <th>摘要描述</th>
                                            <th>计量单位</th>
                                            <th>计量单价</th>
                                            <th>操作</th>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <select id="noinclude-currency" class="form-control chosen-select" name="potential[currency][]">
                                                        @foreach($currency as $k=>$v)
                                                            <option value="{{$v['id']}}" @if($v['id'] == 5)
                                                            selected
                                                                    @endif>{{$v['code_zhname']}}:{{$v['currency_symbol_origin']}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" id="noinclude-name" class="layui-input" name="potential[name][]" data-anchor="费用名称" placeholder="费用名称">
                                                </td>
                                                <td>
                                                    <input type="text" id="noinclude-desc" class="layui-input" name="potential[desc][]" data-anchor="摘要描述" placeholder="摘要描述">
                                                </td>
                                                <td>
                                                    <select id="noinclude-currency" class="form-control chosen-select" name="potential[currency2][]">
                                                        @foreach($currency as $k=>$v)
                                                            <option value="{{$v['id']}}" @if($v['id'] == 5)
                                                            selected
                                                                    @endif>{{$v['code_zhname']}}:{{$v['currency_symbol_origin']}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" id="noinclude-price" class="layui-input" name="potential[price][]" data-anchor="计量单价" placeholder="计量单价">
                                                </td>
                                                <td style="width: 140px;">
                                                    <div class="layui-btn layui-btn-md layui-btn-normal" onclick="potential_add(this)">+</div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="goods-attr type1 ">
                                    <div class="goods-attr-tit">
                                        <span>卖家说明</span>
                                    </div>
                                    <div class="simple-form-field">
                                        <div class="input40">
                                            <input type="hidden" id="big_parag_num" value="1">
                                            <div class="regular_box" style="display:none;"></div>
                                            <div class="layui-form-item type1_box">
                                                <div class="layui-form-label" style="padding-top:0;">
                                                    <input type="text" name="parag_num2[]" class="layui-input parag_num" value="1." readonly>
                                                </div>
                                                <div class="layui-input-block">
                                                    <div class="disf">
                                                        <div class="disf">
                                                            <input type="hidden" class="layui-input" name="pnum2[]" value="0">
                                                            <input type="hidden" class="layui-input" name="is_title2[]" value="1">
                                                            <input type="text" class="layui-input" name="title2[]" placeholder="输入标题" value="" onkeyup="keyup(this)">
                                                        </div>
                                                        <div class="disf">
                                                            <div class="layui-btn layui-btn-success" onclick="add_common_grade2(this)">新增同级</div>
                                                            <div class="layui-btn layui-btn-success" onclick="add_next_grade2(this)">新增下级</div>
                                                        </div>
                                                    </div>
                                                    <div class="textarea_div">
                                                        <textarea name="content2[]" class="layui-textarea" placeholder="输入内容" value="" onkeyup="keyup2(this)"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="goods-attr type1 ">
                                    <div class="goods-attr-tit">
                                        <span>其他费用</span>
                                    </div>
                                    <div class="simple-form-field">
                                        <table class="layui-table otherfee_table" style="width: 100%;">
                                            <thead>
                                            <th>费用名称</th>
                                            <th>费用说明</th>
                                            <th>计费标准</th>
                                            <th>计费数值</th>
                                            <th>操作</th>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <input type="text" id="other_fee-name" class="layui-input" name="other_fee[name][]" data-anchor="费用名称" placeholder="费用名称">
                                                </td>
                                                <td>
                                                    <input type="text" id="other_fee-name" class="layui-input" name="other_fee[desc][]" data-anchor="费用说明" placeholder="费用说明">
                                                </td>
                                                <td>
                                                    <select name="other_fee[standard][]" class="form-control chosen-select" id="other_fee-standard">
                                                        <option value="">请选择标准</option>
                                                        <option value="1">按订单数量</option>
                                                        <option value="2">按包裹数量</option>
                                                        <option value="3">按商品数量</option>
                                                        <option value="4">按服务次数</option>
                                                        <option value="5">按商品总价比率</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <div class="disf">
                                                        <select id="other_fee-currency" class="form-control chosen-select" name="other_fee[currency][]">
                                                            @foreach($currency as $k=>$v)
                                                                <option value="{{$v['id']}}" @if($v['id'] == 5)
                                                                selected
                                                                        @endif>{{$v['code_zhname']}}:{{$v['currency_symbol_origin']}}</option>
                                                            @endforeach
                                                        </select>
                                                        <input type="text" id="other_fee-price" class="layui-input" name="other_fee[price][]" placeholder="如选比率请输入0.000格式">
                                                    </div>
                                                </td>
                                                <td style="width: 140px;">
                                                    <div class="layui-btn layui-btn-md layui-btn-normal" onclick="otherfee_add(this)">+</div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <h5 class="m-b-30">商品报价信息</h5>
                <!-- 商品规格 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="goodsmodel-goods_spec" class="col-sm-1 control-label">
                            <span class="ng-binding">商品规格：</span>
                        </label>
                        <div class="col-sm-11">
                            <select name="have_specs" id="have_specs" class="form-control chosen-select">
                                <option value="1">有规格型号</option>
                                <option value="2">无规格型号</option>
                            </select>
                            <div class="nohave_specs form-control-box" style="display:none;width: 100%;margin-top:10px;">
                                <!--无规格型号-->
                                <table id="sku_tableno" class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th style="text-align: center;">
                                            <span class="text-danger ng-binding">*</span>
                                            库存
                                        </th>
                                        <th style="text-align: center;">
                                            <span class="text-danger ng-binding">*</span>
                                            订购数量
                                        </th>
                                        <th style="text-align: center;">
                                            <span class="text-danger ng-binding">*</span>
                                            订购价格
                                        </th>
                                        <th style="text-align: center;">
                                            操作
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" name="nospecs[goods_number][]" value="" class="form-control small sku-field sku-goods-number" data-rule-required="" data-msg-required="SKU商品库存不能为空" data-rule-min="0" data-rule-max="9999999">
                                        </td>
                                        <td colspan="3">
                                            <table class="spec_table" style="width:100%;text-align:center;">
                                                <tr>
                                                    <td class="td_width">
                                                        <div class="disf">
                                                            <input type="number" name="nospecs[start_num][]" value="1" class="form-control w50 start_num" placeholder="起始数值">
                                                            <select name="nospecs[unit][]" class="form-control chosen-select unit" onchange="specs_unit(this)">
                                                                <option value="">请选择</option>
                                                                @foreach($unit as $k=>$v)
                                                                    <option value="{{$v['code_value']}}" data-title="{{$v['code_name']}}">{{$v['code_name']}}</option>
                                                                @endforeach
                                                            </select>
                                                            至
                                                            <select name="nospecs[select_end][]" class="form-control chosen-select " onchange="specs_selEnd(this)">
                                                                <option value="1">数值</option>
                                                                <option value="2">以上</option>
                                                            </select>
                                                            <input type="number" name="nospecs[end_num][]" value="" class="form-control w50 end_num" placeholder="尾止数值">
                                                            <div class="unit_name"></div>
                                                        </div>
                                                    </td>
                                                    <td class="td_width">
                                                        <select name="nospecs[currency][]" class="form-control chosen-select currency" onchange="specs_currency(this)">
                                                            <option value="">请选择</option>
                                                            @foreach($currency as $k=>$v)
                                                                <option value="{{$v['id']}}" data-title="{{$v['currency_symbol_origin']}}" @if($v['id']==5)
                                                                selected
                                                                        @endif>{{$v['code_zhname']}}：{{$v['currency_symbol_origin']}}</option>
                                                            @endforeach
                                                        </select>
                                                        <input type="number" name="nospecs[price][]" value="" class="form-control w70" placeholder="区间金额">
                                                    </td>
                                                    <td style="text-align:center;">
                                                        <div class="layui-btn layui-btn-md layui-btn-normal addbtn" onclick="add_interval2(this)">+</div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="have_specs form-control-box" style="width: 100%;margin-top:10px;">
                                <!--有规格型号-->
                                <div class="goods-spec w800" data-anchor="商品规格" style="width: 100% !important;max-width: 100%;">
                                    <div class="simple-form-field spec-title-box">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label w100">商品规格：</label>
                                            <div class="col-sm-11 p-0 goods-spec-names" style="width: 580px;">
                                            {{--商品规格--}}
                                            @foreach($spec_list as $v)
                                                <!--已选中的默认规格，为span添加 selected样式-->
                                                    <span class="spec-values-item selected">
                                                        <label class="control-label">
                                                            <!-- 修改0124 input 添加class="cur-not",后增加 disabled="disabled" 需增判断，做完程序后，此注释请删除-->
                                                            <input type="checkbox" value="{{ $v['attr_id'] }}"  />
                                                            {{ $v['attr_name'] }}
                                                        </label>
                                                        <!-- <a class="default-spec" href="javascript:void(0);" title="点击设置为默认规格">默认</a> -->
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>

                                        <a id="btn_add_shop_spec" href="javascript:void(0);" class="btn btn-warning btn-sm pos-a" style="right: 15px; top: 14px;">
                                            <i class="fa fa-plus"></i>
                                            添加规格
                                        </a>
                                    </div>

                                    <div id="dropzone" class="ui-sortable goods-spec-items">
                                        {{--规格列表--}}
                                        @foreach($spec_list as $k=>$v)
                                            <div class="simple-form-field goods-spec-item drop-item" data-spec-id="{{ $v['attr_id'] }}" style="display: none;">
                                                <input type="hidden" name="spec_alias[{{ $k }}][attr_id]" value="{{ $v['attr_id'] }}" />
                                                <div class="form-group spec-id-{{ $v['attr_id'] }}" data-spec-id="{{ $v['attr_id'] }}" data-spec-name="{{ $v['attr_name'] }}">
                                                    <!-- 规格名称 -->
                                                    <label class="col-sm-2 control-label spec-name cur-p l-h-22" data-spec-id="{{ $v['attr_id'] }}">
                                                    @if($v['is_alias'] == 1)
                                                        <!-- 设置规格别名 start-->
                                                            <input type="text" id="spec_name_{{ $v['attr_id'] }}"
                                                                   name="spec_alias[{{ $k }}][attr_name]" class="form-control form-control-xs text-r w70 spec-name"
                                                                   value="{{ $v['attr_name'] }}" data-spec-id="{{ $v['attr_id'] }}" data-rule-required="true" data-msg="规格名称不能为空!" maxlength="10">
                                                            <!-- 设置规格别名 end-->
                                                        @else
                                                            <span class="ng-binding">{{ $v['attr_name'] }}</span>
                                                        @endif
                                                        ：
                                                    </label>
                                                    <!-- 规格值列表 -->
                                                    <div class="col-sm-9 spec-values" data-spec-id="{{ $v['attr_id'] }}">
                                                        @foreach($v['attrs'] as $av)
                                                            <label class="control-label text-l cur-p w100" title="{{ $av['attr_vname'] }}">
                                                                <!-- 选中规格 -->
                                                                <input type="checkbox" value="{{ $av['attr_vid'] }}" data-attr-id="{{ $v['attr_id'] }}" data-vid="{{ $av['attr_vid'] }}"
                                                                       data-vname="{{ $av['attr_vname'] }}" class="spec-value">
                                                                {{ $av['attr_vname'] }}
                                                                &nbsp; &nbsp;
                                                                @if($v['is_desc'] == 1)
                                                                    <span class="color-note-text">备注</span>
                                                                    <input type="text" value="" class="color-note form-control form-control-xs w60 br-0 spec-desc" maxlength="16">
                                                                @endif
                                                            </label>
                                                        @endforeach
                                                    <!-- 遍历自定义规格 start -->
                                                        <!-- 遍历自定义规格 end -->
                                                        @if($v['is_input'] == 1)
                                                            <label class="control-label cur-p">
                                                                <input type="checkbox" value="1" class="spec-value spec-other-value" data-attr-id="{{ $v['attr_id'] }}">
                                                                <input type="text" name="other_spec[]" value="" placeholder="其他" maxlength="15" class="form-control form-control-xs w80 spec-other-text" data-rule-uniqueOtherSpecName="true">
                                                            </label>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="actions-box">
                                                    <span class="actions-btn goods-spec-item-btn-up" title="点击向上移动此规格">
                                                        <i class="fa fa-arrow-circle-o-up"></i>
                                                        上移
                                                    </span>
                                                    <span class="actions-btn goods-spec-item-btn-down" title="点击向下移动此规格">
                                                        <i class="fa fa-arrow-circle-o-down"></i>
                                                        下移
                                                    </span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div id="sku_table_container" class="table-responsive" style="display: none; overflow: visible;">
                                        <table id="sku_table" class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th class="sku-th-index text-c">序号</th>
                                                <th style="text-align: center;">
                                                    <span class="text-danger ng-binding">*</span>
                                                    库存
                                                </th>
                                                <th style="text-align: center;">
                                                    <span class="text-danger ng-binding">*</span>
                                                    订购数量
                                                </th>
                                                <th style="text-align: center;">
                                                    <span class="text-danger ng-binding">*</span>
                                                    订购价格
                                                </th>
                                                <th style="text-align: center;">
                                                    操作
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>

                                        <a id="btn_sku_more_set" href="javascript:void(0);" class="btn btn-warning btn-sm m-t-10" style="display: none;">
                                            <i class="fa fa-plus"></i>
                                            更多设置
                                        </a>

                                    </div>

                                    <!-- 规格数量大于1则发出警告提示 -->
                                    <p id="sku_table_warning" class="form-control-warning m-t-10">
                                        <i class="fa fa-exclamation-circle"></i>
                                        <span>1.设置默认规格后，才可以编辑商品的相册图片。</span>
                                        <span>2.您需要选择至少一个商品规格，才能组合成完整的规格信息。</span>
                                    </p>

                                </div>

                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
                <!-- 交易优惠 -->
                <div class="form-group" style="display: none;">
                    <label for="goodsmodel-goods_attr" class="col-sm-1 control-label">
                        <span class="ng-binding">交易优惠：</span>
                    </label>
                    <div class="col-sm-11">
                        <div class="form-control-box">
                            <div class="goods-attr w800">
                                <div class="goods-attr-tit">
                                    <span>商品平台优惠</span>
                                </div>
                                <div class="simple-form-field" >
                                    <div class="form-group">
                                        <label for="goodsmodel-goods_attr" class="col-sm-1 control-label">
                                            <span class="ng-binding">选择包邮：</span>
                                        </label>
                                        <div class="col-sm-11">
                                            <div class="form-control-box">
                                                <div id="bao_you" class="xm-select-demo" style="width:150px;"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="goodsmodel-goods_attr" class="col-sm-1 control-label">
                                            <span class="ng-binding">填写满送：</span>
                                        </label>
                                        <div class="col-sm-11">
                                            <div class="form-control-box">
                                                买满&nbsp;
                                                {{--                                                    <div class="w100" style="display: inline-block;">--}}
                                                <select id="goodsmodel-full_buycurrency" class="form-control chosen-select" name="GoodsModel[full_buy_currency]">
                                                    @foreach($currency as $k=>$v)
                                                        <option value="{{$v['id']}}" @if($v['id']==5)
                                                        selected
                                                                @endif data-title="{{$v['currency_symbol_origin']}}">{{$v['code_zhname']}}:{{$v['currency_symbol_origin']}}</option>
                                                    @endforeach
                                                </select>
                                                {{--                                                    </div>--}}
                                                <input type="number" class="form-control w50" name="GoodsModel[full_buy_price]" data-anchor="买满金额">
                                                &nbsp;减&nbsp;
                                                <div class="currency_name" style="display: inline-block;width: fit-content;">RMB￥</div>&nbsp;
                                                <input type="number" class="form-control w50" name="GoodsModel[full_buy_minusprice]" data-anchor="减除金额">
                                            </div>
                                            <div class="form-control-box" style="margin-top:10px;">
                                                买满&nbsp;
                                                <input type="number" class="form-control w50" name="GoodsModel[full_buy_num]" data-anchor="买满数值">
                                                {{--                                                    <div class="w100" style="display: inline-block;">--}}
                                                <select id="goodsmodel-full_buyunit" class="form-control chosen-select" name="GoodsModel[full_buy_unit]">
                                                    @foreach($unit as $k=>$v)
                                                        <option value="{{$v['code_value']}}">{{$v['code_name']}}</option>
                                                    @endforeach
                                                </select>
                                                {{--                                                    </div>--}}
                                                &nbsp;送&nbsp;
                                                <input type="number" class="form-control w50" name="GoodsModel[full_buy_deliverynum]" data-anchor="赠送数值">&nbsp;
                                                <div class="unit_name" style="display: inline-block;width: fit-content;">台</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="goodsmodel-goods_attr" class="col-sm-1 control-label">
                                            <span class="ng-binding">赠送实物：</span>
                                        </label>
                                        <div class="col-sm-11">
                                            <div class="form-control-box">
                                                <div class="shiwu_div">
                                                    <div class="disf">
                                                        <input type="text" class="form-control" name="GoodsModel[shiwu_desc][]" placeholder="请输入描述">
                                                        <div class="layui-btn layui-btn-md layui-btn-normal shiwu_add" onclick="shiwu_add(this)">+</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="goodsmodel-goods_attr" class="col-sm-1 control-label">
                                            <span class="ng-binding">赠送服务：</span>
                                        </label>
                                        <div class="col-sm-11">
                                            <div class="form-control-box">
                                                <div class="fuwu_div">
                                                    <div class="disf">
                                                        <input type="text" class="form-control" name="GoodsModel[fuwu_desc][]" placeholder="请输入描述">
                                                        <div class="layui-btn layui-btn-md layui-btn-normal fuwu_add" onclick="fuwu_add(this)">+</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="goods-attr w800">
                                <div class="goods-attr-tit">
                                    <span>商家增值服务</span>
                                </div>
                                <div class="simple-form-field">
                                    <div class="valueadd_div">
                                        <input type="text" class="form-control w100" name="GoodsModel[valueadd_name][]" placeholder="请输入增值服务名称">
                                        <input type="text" class="form-control w300" name="GoodsModel[valueadd_desc][]" placeholder="请输入增值服务描述">
                                        <div class="layui-btn layui-btn-md layui-btn-normal value_add" onclick="value_add(this)">+</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!---高级规格--->

                <!-- 最小起订量 -->
                <div class="simple-form-field">
                    <div class="form-group">
                        <label for="goodsmodel-goods_moq" class="col-sm-1 control-label">

                            <span class="ng-binding">最小起订量：</span>
                        </label>
                        <div class="col-sm-11">
                            <div class="form-control-box">


                                <input type="text" id="goodsmodel-goods_moq" class="form-control ipt pull-none m-r-10" name="GoodsModel[goods_moq]" data-anchor="最小起订量">


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">买家购买商品的最小购买量，购买的商品件数不能低于此数量</div></div>
                        </div>
                    </div>
                </div>
                <!-- 商品价格 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="goodsmodel-goods_price" class="col-sm-1 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">店铺价：</span>
                        </label>
                        <div class="col-sm-11">
                            <div class="form-control-box">



                                <input type="text" id="goodsmodel-goods_price" class="form-control ipt pull-none m-r-10" name="GoodsModel[goods_price]" data-anchor="店铺价">元



                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">价格必须是0.01~9999999之间的数字，且不能高于市场价</br>此价格为商品实际销售价格，如果商品存在规格，该价格显示最低价格</div></div>
                        </div>
                    </div>
                </div>
                <!-- 市场价 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="goodsmodel-market_price" class="col-sm-1 control-label">

                            <span class="ng-binding">市场价：</span>
                        </label>
                        <div class="col-sm-11">
                            <div class="form-control-box">


                                <input type="text" id="goodsmodel-market_price" class="form-control ipt pull-none m-r-10" name="GoodsModel[market_price]" value="0">元


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">为0则商品详情页不显示，价格必须是0.00~9999999之间的数字，此价格仅为市场参考售价，请根据该实际情况认真填写</div></div>
                        </div>
                    </div>
                </div>
                <!-- 成本价 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="goodsmodel-cost_price" class="col-sm-1 control-label">

                            <span class="ng-binding">成本价：</span>
                        </label>
                        <div class="col-sm-11">
                            <div class="form-control-box">


                                <input type="text" id="goodsmodel-cost_price" class="form-control ipt pull-none m-r-10" name="GoodsModel[cost_price]" value="0">元


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">价格必须是0.00~9999999之间的数字，此价格为商户对所销售的商品实际成本价格进行备注记录</div></div>
                        </div>
                    </div>
                </div>
                <!-- 商品数量 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="goodsmodel-goods_number" class="col-sm-1 control-label">
                            <span class="text-danger ng-binding">*</span>
                            <span class="ng-binding">商品库存：</span>
                        </label>
                        <div class="col-sm-11">
                            <div class="form-control-box">
                                <input type="text" id="goodsmodel-goods_number" class="form-control ipt pull-none m-r-10" name="GoodsModel[goods_number]" value="0" data-anchor="商品库存">件
                            </div>
                            <div class="help-block help-block-t"><div class="help-block help-block-t">店铺库存数量必须为0~999999999之间的整数，若启用了库存配置，则系统自动计算商品的总数，此处无需卖家填写</div></div>
                        </div>
                    </div>
                </div>
                <!-- 库存预警值 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="goodsmodel-warn_number" class="col-sm-1 control-label">

                            <span class="ng-binding">库存警告数量：</span>
                        </label>
                        <div class="col-sm-11">
                            <div class="form-control-box">


                                <input type="text" id="goodsmodel-warn_number" class="form-control ipt" name="GoodsModel[warn_number]" value="0">


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">设置最低库存预警值。当库存低于预警值时商家中心商品列表页库存列红字提醒</br>请填写0~255的数字，0为不预警</div></div>
                        </div>
                    </div>
                </div>
                <!-- 商品货号 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="goodsmodel-goods_sn" class="col-sm-1 control-label">

                            <span class="ng-binding">商品货号：</span>
                        </label>
                        <div class="col-sm-11">
                            <div class="form-control-box">


                                <input type="text" id="goodsmodel-goods_sn" class="form-control" name="GoodsModel[goods_sn]">


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">商品货号是指商家管理商品的编号，买家不可见</br>最多可输入20个字，支持输入中文、字母、数字、_、/、-和小数点</div></div>
                        </div>
                    </div>
                </div>
                <!-- 商品条形码 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="goodsmodel-goods_barcode" class="col-sm-1 control-label">

                            <span class="ng-binding">商品条形码：</span>
                        </label>
                        <div class="col-sm-11">
                            <div class="form-control-box">


                                <input type="text" id="goodsmodel-goods_barcode" class="form-control" name="GoodsModel[goods_barcode]">


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">支持一品多码，多个条形码之间用逗号分隔</div></div>
                        </div>
                    </div>
                </div>
                <!-- 库位码 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="goodsmodel-goods_stockcode" class="col-sm-1 control-label">

                            <span class="ng-binding">商品库位码：</span>
                        </label>
                        <div class="col-sm-11">
                            <div class="form-control-box">


                                <input type="text" id="goodsmodel-goods_stockcode" class="form-control" name="GoodsModel[goods_stockcode]">


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">实体仓库存储商品位置编码</div></div>
                        </div>
                    </div>
                </div>
                <!-- 商品主图 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="goodsmodel-goods_image" class="col-sm-1 control-label">

                            <span class="ng-binding">商品主图：</span>
                        </label>
                        <div class="col-sm-11">
                            <div class="form-control-box">

                                <!-- 图片相对路径 -->
                                <input type="hidden" id="goodsmodel-goods_image" class="form-control" name="GoodsModel[goods_image]">

                                <div id="goods_image_container"></div>

                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">上传商品默认主图，无规格主图时展示该图</br>支持jpg、gif、png格式上传或从图片空间中选择，建议使用尺寸800*800像素以上</br>上传后的图片将会自动保存在图片空间的默认分类中</div></div>
                        </div>
                    </div>
                </div>
                <!-- 商品主图视频 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="goodsmodel-goods_video" class="col-sm-1 control-label">

                            <span class="ng-binding">主图视频：</span>
                        </label>
                        <div class="col-sm-11">
                            <div class="form-control-box">

                                <!-- 视频相对路径 -->
                                <input type="text" id="goodsmodel-goods_video" class="form-control" name="GoodsModel[goods_video]" style="display: none;">
                                <input type="text" id="goodsmodel-goods_video2" class="form-control" name="GoodsModel[goods_video2]" style="display: none;">

                                <div id="goods_video_container"></div>

                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
                <!-- 商品详情模板 -->
                <div class="simple-form-field" style="display:none;" >
                    <div class="form-group">
                        <label for="" class="col-sm-1 control-label">

                            <span class="ng-binding">详情版式：</span>
                        </label>
                        <div class="col-sm-11">
                            <div class="form-control-box">


                                <label class="control-label">顶部模板</label>

                                <select id="goodsmodel-top_layout_id" class="form-control m-l-5 m-r-20" name="GoodsModel[top_layout_id]" data-layout-position="0">
                                    @foreach($top_layouts as $k=>$v)
                                        <option value="{{ $k }}" @if($k == 0) selected @endif>{{ $v }}</option>
                                    @endforeach
                                </select>

                                <label class="control-label">底部模板</label>

                                <select id="goodsmodel-bottom_layout_id" class="form-control m-l-5" name="GoodsModel[bottom_layout_id]" data-layout-position="1">
                                    @foreach($bottom_layouts as $k=>$v)
                                        <option value="{{ $k }}" @if($k == 0) selected @endif>{{ $v }}</option>
                                    @endforeach
                                </select>


                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
                <!-- 商品详情模板 -->
                <div class="simple-form-field" style="display:none;">
                    <div class="form-group">
                        <label for="" class="col-sm-1 control-label">


                        </label>
                        <div class="col-sm-11">
                            <div class="form-control-box">


                                <label class="control-label">包装清单版式</label>

                                <select id="goodsmodel-packing_layout_id" class="form-control m-l-5 m-r-20" name="GoodsModel[packing_layout_id]" data-layout-position="2">
                                    @foreach($packing_layouts as $k=>$v)
                                        <option value="{{ $k }}" @if($k == 0) selected @endif>{{ $v }}</option>
                                    @endforeach
                                </select>

                                <label class="control-label">售后保证版式</label>

                                <select id="goodsmodel-service_layout_id" class="form-control m-l-5" name="GoodsModel[service_layout_id]" data-layout-position="3">
                                    @foreach($service_layouts as $k=>$v)
                                        <option value="{{ $k }}" @if($k == 0) selected @endif>{{ $v }}</option>
                                    @endforeach
                                </select>

                                <div class="help-block help-block-t">
                                    您可以到
                                    <a href="/goods/layout/list" target="_blank" class="c-blue">详情版式</a>
                                    进行设置“包装清单模板”和“售后保障模板”
                                </div>
                                <br />
                                <a href="/goods/layout/add" target="_blank" class="btn btn-warning btn-sm pull-none m-r-5">新建详情版式</a>
                                <a href="javascript:void(0);" class="btn btn-primary btn-sm pull-none refresh-layout-list">刷新</a>

                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>

                <!-- 活动配置 -->
                <h5 class="m-b-30" data-anchor="活动配置">活动配置</h5>
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="goodsmodel-goods_sn" class="col-sm-1 control-label">
                            <span class="ng-binding">参加活动：</span>
                        </label>
                        <div class="col-sm-11">
                            <div class="form-control-box disf" style="width: 100%;display:flex;align-items:center;">
                                <select id="goodsmodel-have_activity" class="form-control chosen-select" name="GoodsModel[have_activity]">
                                    <option value="1">参与活动</option>
                                    <option value="2">不参与活动</option>
                                </select>
                                <div id="activity_id" class="xm-select-demo" style="width:150px;margin-top:0px;"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 商品推广 -->
                <h5 class="m-b-30" data-anchor="商品推广">商品推广</h5>
                <div class="simple-form-field"  style="display: grid;grid-template-columns: repeat(3,1fr);-moz-column-gap: 20px;column-gap: 20px;row-gap: 0px;">
                    <div class="form-group">
                        <label for="goodsmodel-goods_sn" class="col-sm-3 control-label">
                            <span class="ng-binding">长尾词：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">
                                <div class="changwei_div">
                                    <div class="form-group brand_promote">
                                        <span class="ng-binding">品牌：</span>
                                        <div class="">
                                            <div class="form-control-box">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group gcate_promote">
                                        <span class="ng-binding">品类：</span>
                                        <div class="">
                                            <div class="form-control-box">
                                                @if(isset($label_catNames))
                                                    @foreach($label_catNames as $k=>$v)
                                                        <div class="note">{{$v}}<input name="GoodsModel[shihe_changwei][gcate][{{$k}}]" value="{{$v}}" style="display:none;"></div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group gname_promote">
                                        <span class="ng-binding">品名：</span>
                                        <div class="">
                                            <div class="form-control-box">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group gattr_promote">
                                        <span class="ng-binding">属性：</span>
                                        <div class="">
                                            <div class="form-control-box">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group goption_promote">
                                        <span class="ng-binding">规格：</span>
                                        <div class="">
                                            <div class="form-control-box">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="goodsmodel-goods_sn" class="col-sm-3 control-label">
                            <span class="ng-binding">适合人群：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">
                                <div id="shihe_renqun" class="xm-select-demo" style="width:150px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="goodsmodel-goods_sn" class="col-sm-3 control-label">
                            <span class="ng-binding">适用国家：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">
                                <div id="shihe_country" class="xm-select-demo" style="width:150px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="goodsmodel-goods_sn" class="col-sm-3 control-label">
                            <span class="ng-binding">适用网媒：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">
                                <div id="shihe_media" class="xm-select-demo" style="width:150px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="goodsmodel-goods_sn" class="col-sm-3 control-label">
                            <span class="ng-binding">适用节日：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">
                                <div id="shihe_festival" class="xm-select-demo" style="width:150px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="goodsmodel-goods_sn" class="col-sm-3 control-label">
                            <span class="ng-binding">适用同款：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">
                                <div id="shihe_commongoods" class="xm-select-demo" style="width:150px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="goodsmodel-goods_sn" class="col-sm-3 control-label">
                            <span class="ng-binding">适用宗教：</span>
                        </label>
                        <div class="col-sm-9">
                            <div class="form-control-box">
                                <div id="shihe_zongjiao" class="xm-select-demo" style="width:150px;"></div>
                            </div>
                        </div>
                    </div>
                </div>

                @if($goods_mode == 0)
                    <h5 class="m-b-30" data-anchor="物流信息">商品物流信息</h5>
                    <!-- 商品重量 -->
                    <div class="simple-form-field" >
                        <div class="form-group">
                            <label for="goodsmodel-goods_weight" class="col-sm-1 control-label">

                                <span class="ng-binding">物流重量(Kg)：</span>
                            </label>
                            <div class="col-sm-11">
                                <div class="form-control-box">


                                    <input type="text" id="goodsmodel-goods_weight" class="form-control ipt pull-none m-r-10" name="GoodsModel[goods_weight]">Kg


                                </div>

                                <div class="help-block help-block-t"><div class="help-block help-block-t">商品的重量单位为千克，如果商品的运费模板按照重量计算请填写此项，为空则默认商品重量为0Kg；</br>如果SKU的重量未设置，则以此重量作为默认值；</div></div>
                            </div>
                        </div>
                    </div>
                    <!-- 商品体积 -->
                    <div class="simple-form-field" >
                        <div class="form-group">
                            <label for="goodsmodel-goods_volume" class="col-sm-1 control-label">

<span class="ng-binding">物流体积(m
            <sup>3</sup>
            )：</span>
                            </label>
                            <div class="col-sm-11">
                                <div class="form-control-box">


                                    <input type="text" id="goodsmodel-goods_volume" class="form-control ipt pull-none m-r-10" name="GoodsModel[goods_volume]">m
                                    <sup>3</sup>


                                </div>

                                <div class="help-block help-block-t"><div class="help-block help-block-t">商品的体积单位为立方米，如果商品的运费模板按照体积计算请填写此项，为空则默认商品体积为0立方米；</br>如果SKU的体积未设置，则以此体积作为默认值；</div></div>
                            </div>
                        </div>
                    </div>

                    <!-- 运费设置 -->
                    <div class="simple-form-field" >
                        <div class="form-group">
                            <label for="goodsmodel-goods_freight_type" class="col-sm-1 control-label">
                                <span class="text-danger ng-binding">*</span>
                                <span class="ng-binding">运费设置：</span>
                            </label>
                            <div class="col-sm-11">
                                <div class="form-control-box">

                                    <label class="control-label cur-p">
                                        <input type="radio" id="goodsmodel-goods_freight_type_0" name="GoodsModel[goods_freight_type]" class="goods-freight-type" value="0"  checked="checked"  />
                                        店铺统一运费
                                        <span>（￥{{ $shop_freight_fee }}）</span>
                                    </label>
                                    <br />
                                    <!--
<label class="control-label cur-p">
    <input type="radio" id="goodsmodel-goods_freight_type_1" name="GoodsModel[goods_freight_type]" class="goods-freight-type" value="1"  />
    固定运费 <input type="text" id="goodsmodel-goods_freight_fee" class="form-control ipt m-l-5" name="GoodsModel[goods_freight_fee]">
</label>
 -->
                                    <br />
                                    <label class="control-label cur-p">
                                        <input type="radio" id="goodsmodel-goods_freight_type_2" name="GoodsModel[goods_freight_type]" class="goods-freight-type" value="2"  />
                                        运费模板

                                        <select id="goodsmodel-freight_id" class="form-control m-l-5 m-r-5 freight-list" name="GoodsModel[freight_id]">
                                            @foreach($freight_list as $v)
                                                <option value="{{ $v['freight_id'] }}">{{ $v['title'] }}</option>
                                            @endforeach
                                        </select>
                                        <div class="btn-group m-r-2">
                                            <button type="button" data-toggle="dropdown" aria-expanded="true" class="btn btn-warning btn-sm dropdown-toggle">
                                                新建运费模板
                                                <span class="caret m-l-5"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li>
                                                    <a href="/shop/freight/add" target="_blank">新建全国模板</a>
                                                </li>
                                                <li>
                                                    <a href="/shop/freight/map-add" target="_blank">新建同城模板</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <a href="javascript:void(0);" class="btn btn-primary btn-sm refresh-freight-list">重新加载</a>
                                    </label>



                                    <div id="goods_freight_info" class="goods-freight col-sm-10 m-t-10"style='display: none;'>
                                        <div class="freight-pop">
                                            <div class="freight-box">
                                                <div class="logis-switch m-b-5">
                                                    <div class="switch-bar">
                                                        <!--
                                <span class="tpl-name active">
                                    平邮
                                    <b></b>
                                </span>
                                 -->
                                                    </div>
                                                    <a href="javascript:void(0);" class="help-link freight-info">查看详情</a>
                                                </div>
                                                <div class="logis-content">
                                                    <div class="col-split p-5 default-desc"></div>
                                                    <div class="col-title p-5 other-desc-title">指定区域运费</div>
                                                    <div class="p-l-5 other-desc"></div>
                                                </div>
                                            </div>
                                            <div class="deliver-warn p-5">
                                                <strong class="warn-type limit-sale">区域限售</strong>
                                                <strong class="warn-type is-free">包邮</strong>
                                                <strong class="warn-type free-set">已指定条件包邮</strong>
                                                发货地：
                                                <span class="goods-from"></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="help-block help-block-t"></div>
                            </div>
                        </div>
                    </div>
                @elseif($goods_mode == 1)
                <!-- 虚拟商品-电子卡券 -->
                    <div id="virtual_goods_container" class="m-t-30">
                        <h5 class="m-b-30" data-anchor="特殊商品">特殊商品</h5>

                        <!-- 生效类型 -->
                        <div class="simple-form-field" >
                            <div class="form-group">
                                <label for="goodsmodel-effective_type" class="col-sm-1 control-label">
                                    <span class="text-danger ng-binding">*</span>
                                    <span class="ng-binding">兑换生效期：</span>
                                </label>
                                <div class="col-sm-11">
                                    <div class="form-control-box">

                                        <input type="hidden" name="GoodsModel[effective_type]" value="0"><div id="goodsmodel-effective_type" class="" name="GoodsModel[effective_type]"><label class="control-label cur-p m-r-10"><input type="radio" name="GoodsModel[effective_type]" value="0" checked> 付款完成立即生效</label>
                                            <label class="control-label cur-p m-r-10"><input type="radio" name="GoodsModel[effective_type]" value="1"> 付款完成<input type="text" class="form-control small m-l-5 m-r-5" name="effective_hour" disabled="disabled">小时后生效</label>
                                            <label class="control-label cur-p m-r-10"><input type="radio" name="GoodsModel[effective_type]" value="2"> 付款完成次日生效</label></div>

                                        <input type="hidden" id="goodsmodel-effective_hour" class="form-control" name="GoodsModel[effective_hour]" value="0">


                                    </div>

                                    <div class="help-block help-block-t"></div>
                                </div>
                            </div>
                        </div>
                        <!-- 有效期限类型 -->
                        <div class="simple-form-field" >
                            <div class="form-group">
                                <label for="goodsmodel-valid_period_type" class="col-sm-1 control-label">
                                    <span class="text-danger ng-binding">*</span>
                                    <span class="ng-binding">使用有效期：</span>
                                </label>
                                <div class="col-sm-11">
                                    <div class="form-control-box">

                                        <input type="hidden" name="GoodsModel[valid_period_type]" value="0"><div id="goodsmodel-valid_period_type" class="" name="GoodsModel[valid_period_type]"><label class="control-label cur-p m-r-10"><input type="radio" name="GoodsModel[valid_period_type]" value="0" checked> 长期有效</label>
                                            <label class="control-label cur-p m-r-10"><input type="radio" name="GoodsModel[valid_period_type]" value="1"> <input class="form-control form_datetime ipt" name="add_time_begin" disabled="disabled" placeholder="开始时间" type="text"><span class="ctime">至</span><input class="form-control form_datetime ipt" name="add_time_end" disabled="disabled" placeholder="结束时间" type="text"></label>
                                            <label class="control-label cur-p m-r-10"><input type="radio" name="GoodsModel[valid_period_type]" value="2"> 自购买之日起，<input type="text" class="form-control small m-r-5" name="valid_period_hour" disabled="disabled">小时内有效</label></div>
                                        <!-- 隐藏域 -->
                                        <input type="hidden" id="goodsmodel-valid_period_hour" class="form-control" name="GoodsModel[valid_period_hour]" value="0">

                                        <input type="hidden" id="goodsmodel-valid_period_start_time" class="form-control" name="GoodsModel[valid_period_start_time]" value="0">

                                        <input type="hidden" id="goodsmodel-valid_period_end_time" class="form-control" name="GoodsModel[valid_period_end_time]" value="0">


                                    </div>

                                    <div class="help-block help-block-t"></div>
                                </div>
                            </div>
                        </div>
                        <!-- 使用限制 -->
                        <div class="simple-form-field" >
                            <div class="form-group">
                                <label for="goodsmodel-use_limit" class="col-sm-1 control-label">

                                    <span class="ng-binding">使用限制：</span>
                                </label>
                                <div class="col-sm-11">
                                    <div class="form-control-box">

                                        <input type="hidden" name="GoodsModel[use_limit]" value=""><div id="goodsmodel-use_limit" class="" name="GoodsModel[use_limit]" selection='[0,1]'><label class="control-label cur-p m-r-10"><input type="checkbox" name="GoodsModel[use_limit][]" value="0" checked> 免预约</label>
                                            <label class="control-label cur-p m-r-10"><input type="checkbox" name="GoodsModel[use_limit][]" value="1" checked> 节假日有效</label></div>


                                    </div>

                                    <div class="help-block help-block-t"><div class="help-block help-block-t">仅在前台会有文字提示，实际使用时不会校验</div></div>
                                </div>
                            </div>
                        </div>					<!-- 电子卡券购买上限 -->
                        <div class="simple-form-field" >
                            <div class="form-group">
                                <label for="goodsmodel-buy_limit" class="col-sm-1 control-label">
                                    <span class="text-danger ng-binding">*</span>
                                    <span class="ng-binding">电子卡券购买上限：</span>
                                </label>
                                <div class="col-sm-11">
                                    <div class="form-control-box">

                                        <input type="text" id="goodsmodel-buy_limit" class="form-control ipt m-r-10" name="GoodsModel[buy_limit]" value="1">


                                    </div>

                                    <div class="help-block help-block-t"><div class="help-block help-block-t">请填写1~10之间的数字，电子卡券最高购买数量不能超过10个。</div></div>
                                </div>
                            </div>
                        </div>
                        <!-- 支持过期退款 -->
                        <div class="simple-form-field" >
                            <div class="form-group">
                                <label for="goodsmodel-is_expired_refund" class="col-sm-1 control-label">
                                    <span class="text-danger ng-binding">*</span>
                                    <span class="ng-binding">支持过期退款：</span>
                                </label>
                                <div class="col-sm-11">
                                    <div class="form-control-box">

                                        <input type="hidden" name="GoodsModel[is_expired_refund]" value="1"><div id="goodsmodel-is_expired_refund" class="" name="GoodsModel[is_expired_refund]"><label class="control-label cur-p m-r-10"><input type="radio" name="GoodsModel[is_expired_refund]" value="1" checked> 是</label>
                                            <label class="control-label cur-p m-r-10"><input type="radio" name="GoodsModel[is_expired_refund]" value="0"> 否</label></div>


                                    </div>

                                    <div class="help-block help-block-t"><div class="help-block help-block-t">兑换码过期后是否可以申请退款。</div></div>
                                </div>
                            </div>
                        </div>
                        <!-- 自定义用户预留信息 -->
                        <div class="simple-form-field" >
                            <div class="form-group">
                                <label for="goodsmodel-user_information" class="col-sm-1 control-label">

                                    <span class="ng-binding">自定义用户预留信息 ：</span>
                                </label>
                                <div class="col-sm-11">
                                    <div class="form-control-box">

                                        <div class="user-information-container">
                                            <span class="user-information-item m-b-10 m-r-20 disp-inlblock">
                        <input type="text" class="form-control w150" placeholder="请输入预留信息名称">
                        <select class="form-control m-l-5 m-r-5">
                                                            <option value="number">数字格式</option>
                                                            <option value="string">文本格式</option>
                                                            <option value="cardno">身份证号</option>
                                                            <option value="email">邮件格式</option>
                                                            <option value="date">日期格式</option>
                                                            <option value="image">图片格式</option>
                                                        </select>
                        <label class="cur-p">
                            <input type="checkbox">
                            必填
                        </label>
                        <a href="javascript:void(0)" class="btn btn-danger btn-sm m-l-5 del-information">移除</a>
                    </span>
                                        </div>
                                        <a href="javascript:void(0)" class="add-information btn btn-warning btn-sm ">添加预留信息</a>


                                    </div>

                                    <div class="help-block help-block-t"><div class="help-block help-block-t">设置用户购买该商品时，需要预留的用户信息，商家可以在订单详情中查看该信息，最多可设置10条。</div></div>
                                </div>
                            </div>
                        </div>
                        <script id="user_information" type='text'>
                <span class="user-information-item m-b-10 m-r-20 disp-inlblock">
                    <input type="text" class="form-control w150" placeholder="请输入预留信息名称">
                    <select class="form-control m-l-5 m-r-5">
                                                    <option value="number">数字格式</option>
                                                    <option value="string">文本格式</option>
                                                    <option value="cardno">身份证号</option>
                                                    <option value="email">邮件格式</option>
                                                    <option value="date">日期格式</option>
                                                    <option value="image">图片格式</option>
                                                </select>
                    <label class="cur-p"><input type="checkbox">必填</label>
                    <a href="javascript:void(0)" class="btn btn-danger btn-sm m-l-5 del-information">移除</a>
                </span>
                </script>
                        <!-- 时间插件引入 start -->
                        <link rel="stylesheet" href="/assets/d667b223/bootstrap/datetimepicker/css/bootstrap-datetimepicker.css?v=4.0"/> <script src="/assets/d667b223/bootstrap/datetimepicker/js/bootstrap-datetimepicker.js?v=20190110"></script>
                        <script src="/assets/d667b223/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=20190110"></script>
                        <!-- 时间插件引入 end -->
                        <script type="text/javascript">
                            $('#virtual_goods_container').find('.add-information').click(function(){
                                if($(this).hasClass('disabled')){
                                    return ;
                                }
                                var user_information_html = $('#virtual_goods_container').find('#user_information').html();
                                $('#virtual_goods_container').find('.user-information-container').append(user_information_html);
                                if($('#virtual_goods_container').find('.user-information-container .user-information-item').length >= 10){
                                    $(this).addClass('disabled');
                                }

                            });
                            $('#virtual_goods_container').on('click','.del-information',function(){
                                if($(this).parent().index() == 0){
                                    $(this).parent().find('input[type="text"]').val('');
                                    $(this).parent().find('select').val('integer');
                                    $(this).parent().find('input[type="checkbox"]').removeAttr("checked")
                                }else{
                                    $(this).parent().remove();
                                    $('#virtual_goods_container').find('.add-information').removeClass('disabled');
                                }
                            });



                            $('#virtual_goods_container #goodsmodel-effective_type').find('[name="GoodsModel[effective_type]"]').change(function(){
                                $('#virtual_goods_container').find('input[name="effective_hour"]').val('');
                                $('#virtual_goods_container').find('#goodsmodel-effective_hour').val(0);
                                $('#virtual_goods_container').find('input[name="effective_hour"]').removeClass('error');
                                $.validator.clearError($("#goodsmodel-effective_type"));
                                if($(this).val() == 1){
                                    $('#virtual_goods_container').find('input[name="effective_hour"]').removeAttr('disabled');
                                }else{
                                    $('#virtual_goods_container').find('input[name="effective_hour"]').attr('disabled','disabled');
                                }
                            });

                            // 验证时间
                            $('#virtual_goods_container').find('input[name="effective_hour"]').on('input',function(){
                                validateEffectiveHour($(this));
                            });
                            $('#virtual_goods_container').find('input[name="effective_hour"]').blur(function(){
                                validateEffectiveHour($(this));
                            });

                            // 验证方法
                            function validateEffectiveHour (obj){
                                if($('#virtual_goods_container').find('[name="GoodsModel[effective_type]"]:checked').val() == 1){
                                    if($.trim(obj.val()) == ''){
                                        obj.addClass('error');
                                        $.validator.showError($("#goodsmodel-effective_type"), '时间不能为空');
                                    }
                                    else if(! (/^(\+|-)?\d+$/.test(obj.val()))){
                                        obj.addClass('error');
                                        $.validator.showError($("#goodsmodel-effective_type"), '时间必须为数字');
                                    }else{
                                        $.validator.clearError($("#goodsmodel-effective_type"));
                                        $('#virtual_goods_container').find('#goodsmodel-effective_hour').val(obj.val());
                                    }

                                }
                            }






                            $('#virtual_goods_container #goodsmodel-valid_period_type').find('[name="GoodsModel[valid_period_type]"]').change(function(){
                                $('#virtual_goods_container').find('input[name="valid_period_hour"]').val('');
                                $('#virtual_goods_container').find('#goodsmodel-valid_period_hour').val(0);
                                $('#virtual_goods_container').find('input[name="valid_period_hour"]').removeClass('error');
                                $('#virtual_goods_container').find('input[name="add_time_begin"]').removeClass('error');
                                $('#virtual_goods_container').find('input[name="add_time_end"]').removeClass('error');
                                $.validator.clearError($("#goodsmodel-valid_period_type"));
                                if($(this).val() == 2){
                                    $('#virtual_goods_container').find('input[name="valid_period_hour"]').removeAttr('disabled');
                                }else{
                                    $('#virtual_goods_container').find('input[name="valid_period_hour"]').attr('disabled','disabled');
                                }
                                $('#virtual_goods_container').find('input[name="add_time_begin"]').val('');
                                $('#virtual_goods_container').find('input[name="add_time_end"]').val('');
                                $('#virtual_goods_container').find('#goodsmodel-valid_period_start_time').val(0);
                                $('#virtual_goods_container').find('#goodsmodel-valid_period_end_time').val(0);
                                if($(this).val() == 1){
                                    $('#virtual_goods_container').find('input[name="add_time_begin"]').removeAttr('disabled');
                                    $('#virtual_goods_container').find('input[name="add_time_end"]').removeAttr('disabled');
                                }else{
                                    $('#virtual_goods_container').find('input[name="add_time_begin"]').attr('disabled','disabled');
                                    $('#virtual_goods_container').find('input[name="add_time_end"]').attr('disabled','disabled');
                                }
                            });

                            // 验证时间
                            $('#virtual_goods_container').find('input[name="valid_period_hour"]').on('input',function(){
                                validateValidPeriodHour($(this));
                            });
                            $('#virtual_goods_container').find('input[name="valid_period_hour"]').blur(function(){
                                validateValidPeriodHour($(this));
                            });

                            $('#virtual_goods_container').find('input[name="add_time_begin"]').on('input',function(){
                                validateValidPeriodHour($(this));
                            });

                            $('#virtual_goods_container').find('input[name="add_time_begin"]').blur(function(){
                                validateValidPeriodHour($(this));
                            });

                            $('#virtual_goods_container').find('input[name="add_time_end"]').on('input',function(){
                                validateValidPeriodHour($(this));
                            });

                            $('#virtual_goods_container').find('input[name="add_time_end"]').blur(function(){
                                validateValidPeriodHour($(this));
                            });

                            function validateValidPeriodHour (obj){
                                var error_message = '';
                                if($('#virtual_goods_container').find('[name="GoodsModel[valid_period_type]"]:checked').val() == 1){
                                    if($.trim(obj.val()) == ''){
                                        obj.addClass('error');
                                        $.validator.showError($("#goodsmodel-valid_period_type"), '时间不能为空');
                                        error_message = '时间不能为空';
                                    }else{
                                        obj.removeClass('error');
                                        $.validator.clearError($("#goodsmodel-valid_period_type"));
                                    }
                                }
                                else if($('#virtual_goods_container').find('[name="GoodsModel[valid_period_type]"]:checked').val() == 2){
                                    if($.trim(obj.val()) == '' || $.trim(obj.val()) == 0){
                                        obj.addClass('error');
                                        $.validator.showError($("#goodsmodel-valid_period_type"), '时间不能为空');
                                        error_message = '时间不能为空';
                                    }
                                    else if(! (/^(\+|-)?\d+$/.test(obj.val()))){
                                        obj.addClass('error');
                                        $.validator.showError($("#goodsmodel-valid_period_type"), '时间必须为整数');
                                        error_message = '时间必须为整数';
                                    }else{
                                        $.validator.clearError($("#goodsmodel-valid_period_type"));
                                        $('#virtual_goods_container').find('#goodsmodel-valid_period_hour').val(obj.val());
                                    }

                                }
                                return error_message;
                            }

                            $('.form_datetime').datetimepicker({
                                language: 'zh-CN',
                                weekStart: 1,
                                todayBtn: 1,
                                autoclose: 1,
                                todayHighlight: 1,
                                startView: 2,
                                forceParse: 0,
                                showMeridian: 1,
                                format: 'yyyy-mm-dd hh:ii:ss',
                            });

                            $('#virtual_goods_container').find('input[name="add_time_begin"]').datetimepicker().on('changeDate', function(ev) {
                                $('#virtual_goods_container').find('input[name="add_time_end"]').datetimepicker('setStartDate', ev.date);
                                $('#virtual_goods_container').find('#goodsmodel-valid_period_start_time').val($(this).val());
                                validateValidPeriodHour($(this));
                            });
                            $('#virtual_goods_container').find('input[name="add_time_end"]').datetimepicker().on('changeDate', function(ev) {
                                $('#virtual_goods_container').find('input[name="add_time_begin"]').datetimepicker('setEndDate', ev.date);
                                $('#virtual_goods_container').find('#goodsmodel-valid_period_end_time').val($(this).val());
                                validateValidPeriodHour($(this));
                            });
                        </script>
                    </div>

                @elseif($goods_mode == 2)
                <!-- 虚拟商品-电子卡券 -->
                    <div id="virtual_goods_container" class="m-t-30">
                        <h5 class="m-b-30" data-anchor="特殊商品">特殊商品</h5>

                        <!-- 使用限制 -->
                        <div class="simple-form-field" >
                            <div class="form-group">
                                <label for="goodsmodel-use_limit" class="col-sm-1 control-label">

                                    <span class="ng-binding">使用限制：</span>
                                </label>
                                <div class="col-sm-11">
                                    <div class="form-control-box">

                                        <input type="hidden" name="GoodsModel[use_limit]" value=""><div id="goodsmodel-use_limit" class="" name="GoodsModel[use_limit]" selection='[0,1]'><label class="control-label cur-p m-r-10"><input type="checkbox" name="GoodsModel[use_limit][]" value="0" checked> 免预约</label>
                                            <label class="control-label cur-p m-r-10"><input type="checkbox" name="GoodsModel[use_limit][]" value="1" checked> 节假日有效</label></div>


                                    </div>

                                    <div class="help-block help-block-t"><div class="help-block help-block-t">仅在前台会有文字提示，实际使用时不会校验</div></div>
                                </div>
                            </div>
                        </div>					<!-- 电子卡券购买上限 -->
                        <div class="simple-form-field" >
                            <div class="form-group">
                                <label for="goodsmodel-buy_limit" class="col-sm-1 control-label">
                                    <span class="text-danger ng-binding">*</span>
                                    <span class="ng-binding">电子卡券购买上限：</span>
                                </label>
                                <div class="col-sm-11">
                                    <div class="form-control-box">

                                        <input type="text" id="goodsmodel-buy_limit" class="form-control ipt m-r-10" name="GoodsModel[buy_limit]" value="1">


                                    </div>

                                    <div class="help-block help-block-t"><div class="help-block help-block-t">请填写1~10之间的数字，电子卡券最高购买数量不能超过10个。</div></div>
                                </div>
                            </div>
                        </div>
                        <!-- 自定义用户预留信息 -->
                        <div class="simple-form-field" >
                            <div class="form-group">
                                <label for="goodsmodel-user_information" class="col-sm-1 control-label">

                                    <span class="ng-binding">自定义用户预留信息 ：</span>
                                </label>
                                <div class="col-sm-11">
                                    <div class="form-control-box">

                                        <div class="user-information-container">
                                            <span class="user-information-item m-b-10 m-r-20 disp-inlblock">
                        <input type="text" class="form-control w150" placeholder="请输入预留信息名称">
                        <select class="form-control m-l-5 m-r-5">
                                                            <option value="number">数字格式</option>
                                                            <option value="string">文本格式</option>
                                                            <option value="cardno">身份证号</option>
                                                            <option value="email">邮件格式</option>
                                                            <option value="date">日期格式</option>
                                                            <option value="image">图片格式</option>
                                                        </select>
                        <label class="cur-p">
                            <input type="checkbox">
                            必填
                        </label>
                        <a href="javascript:void(0)" class="btn btn-danger btn-sm m-l-5 del-information">移除</a>
                    </span>
                                        </div>
                                        <a href="javascript:void(0)" class="add-information btn btn-warning btn-sm ">添加预留信息</a>


                                    </div>

                                    <div class="help-block help-block-t"><div class="help-block help-block-t">设置用户购买该商品时，需要预留的用户信息，商家可以在订单详情中查看该信息，最多可设置10条。</div></div>
                                </div>
                            </div>
                        </div>
                        <script id="user_information" type='text'>
                <span class="user-information-item m-b-10 m-r-20 disp-inlblock">
                    <input type="text" class="form-control w150" placeholder="请输入预留信息名称">
                    <select class="form-control m-l-5 m-r-5">
                                                    <option value="number">数字格式</option>
                                                    <option value="string">文本格式</option>
                                                    <option value="cardno">身份证号</option>
                                                    <option value="email">邮件格式</option>
                                                    <option value="date">日期格式</option>
                                                    <option value="image">图片格式</option>
                                                </select>
                    <label class="cur-p"><input type="checkbox">必填</label>
                    <a href="javascript:void(0)" class="btn btn-danger btn-sm m-l-5 del-information">移除</a>
                </span>
                </script>
                        <!-- 时间插件引入 start -->
                        <link rel="stylesheet" href="/assets/d667b223/bootstrap/datetimepicker/css/bootstrap-datetimepicker.css?v=4.0"/> <script src="/assets/d667b223/bootstrap/datetimepicker/js/bootstrap-datetimepicker.js?v=20190110"></script>
                        <script src="/assets/d667b223/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=20190110"></script>
                        <!-- 时间插件引入 end -->
                        <script type="text/javascript">
                            $('#virtual_goods_container').find('.add-information').click(function(){
                                if($(this).hasClass('disabled')){
                                    return ;
                                }
                                var user_information_html = $('#virtual_goods_container').find('#user_information').html();
                                $('#virtual_goods_container').find('.user-information-container').append(user_information_html);
                                if($('#virtual_goods_container').find('.user-information-container .user-information-item').length >= 10){
                                    $(this).addClass('disabled');
                                }

                            });
                            $('#virtual_goods_container').on('click','.del-information',function(){
                                if($(this).parent().index() == 0){
                                    $(this).parent().find('input[type="text"]').val('');
                                    $(this).parent().find('select').val('integer');
                                    $(this).parent().find('input[type="checkbox"]').removeAttr("checked")
                                }else{
                                    $(this).parent().remove();
                                    $('#virtual_goods_container').find('.add-information').removeClass('disabled');
                                }
                            });



                            $('#virtual_goods_container #goodsmodel-effective_type').find('[name="GoodsModel[effective_type]"]').change(function(){
                                $('#virtual_goods_container').find('input[name="effective_hour"]').val('');
                                $('#virtual_goods_container').find('#goodsmodel-effective_hour').val(0);
                                $('#virtual_goods_container').find('input[name="effective_hour"]').removeClass('error');
                                $.validator.clearError($("#goodsmodel-effective_type"));
                                if($(this).val() == 1){
                                    $('#virtual_goods_container').find('input[name="effective_hour"]').removeAttr('disabled');
                                }else{
                                    $('#virtual_goods_container').find('input[name="effective_hour"]').attr('disabled','disabled');
                                }
                            });

                            // 验证时间
                            $('#virtual_goods_container').find('input[name="effective_hour"]').on('input',function(){
                                validateEffectiveHour($(this));
                            });
                            $('#virtual_goods_container').find('input[name="effective_hour"]').blur(function(){
                                validateEffectiveHour($(this));
                            });

                            // 验证方法
                            function validateEffectiveHour (obj){
                                if($('#virtual_goods_container').find('[name="GoodsModel[effective_type]"]:checked').val() == 1){
                                    if($.trim(obj.val()) == ''){
                                        obj.addClass('error');
                                        $.validator.showError($("#goodsmodel-effective_type"), '时间不能为空');
                                    }
                                    else if(! (/^(\+|-)?\d+$/.test(obj.val()))){
                                        obj.addClass('error');
                                        $.validator.showError($("#goodsmodel-effective_type"), '时间必须为数字');
                                    }else{
                                        $.validator.clearError($("#goodsmodel-effective_type"));
                                        $('#virtual_goods_container').find('#goodsmodel-effective_hour').val(obj.val());
                                    }

                                }
                            }






                            $('#virtual_goods_container #goodsmodel-valid_period_type').find('[name="GoodsModel[valid_period_type]"]').change(function(){
                                $('#virtual_goods_container').find('input[name="valid_period_hour"]').val('');
                                $('#virtual_goods_container').find('#goodsmodel-valid_period_hour').val(0);
                                $('#virtual_goods_container').find('input[name="valid_period_hour"]').removeClass('error');
                                $('#virtual_goods_container').find('input[name="add_time_begin"]').removeClass('error');
                                $('#virtual_goods_container').find('input[name="add_time_end"]').removeClass('error');
                                $.validator.clearError($("#goodsmodel-valid_period_type"));
                                if($(this).val() == 2){
                                    $('#virtual_goods_container').find('input[name="valid_period_hour"]').removeAttr('disabled');
                                }else{
                                    $('#virtual_goods_container').find('input[name="valid_period_hour"]').attr('disabled','disabled');
                                }
                                $('#virtual_goods_container').find('input[name="add_time_begin"]').val('');
                                $('#virtual_goods_container').find('input[name="add_time_end"]').val('');
                                $('#virtual_goods_container').find('#goodsmodel-valid_period_start_time').val(0);
                                $('#virtual_goods_container').find('#goodsmodel-valid_period_end_time').val(0);
                                if($(this).val() == 1){
                                    $('#virtual_goods_container').find('input[name="add_time_begin"]').removeAttr('disabled');
                                    $('#virtual_goods_container').find('input[name="add_time_end"]').removeAttr('disabled');
                                }else{
                                    $('#virtual_goods_container').find('input[name="add_time_begin"]').attr('disabled','disabled');
                                    $('#virtual_goods_container').find('input[name="add_time_end"]').attr('disabled','disabled');
                                }
                            });

                            // 验证时间
                            $('#virtual_goods_container').find('input[name="valid_period_hour"]').on('input',function(){
                                validateValidPeriodHour($(this));
                            });
                            $('#virtual_goods_container').find('input[name="valid_period_hour"]').blur(function(){
                                validateValidPeriodHour($(this));
                            });

                            $('#virtual_goods_container').find('input[name="add_time_begin"]').on('input',function(){
                                validateValidPeriodHour($(this));
                            });

                            $('#virtual_goods_container').find('input[name="add_time_begin"]').blur(function(){
                                validateValidPeriodHour($(this));
                            });

                            $('#virtual_goods_container').find('input[name="add_time_end"]').on('input',function(){
                                validateValidPeriodHour($(this));
                            });

                            $('#virtual_goods_container').find('input[name="add_time_end"]').blur(function(){
                                validateValidPeriodHour($(this));
                            });

                            function validateValidPeriodHour (obj){
                                var error_message = '';
                                if($('#virtual_goods_container').find('[name="GoodsModel[valid_period_type]"]:checked').val() == 1){
                                    if($.trim(obj.val()) == ''){
                                        obj.addClass('error');
                                        $.validator.showError($("#goodsmodel-valid_period_type"), '时间不能为空');
                                        error_message = '时间不能为空';
                                    }else{
                                        obj.removeClass('error');
                                        $.validator.clearError($("#goodsmodel-valid_period_type"));
                                    }
                                }
                                else if($('#virtual_goods_container').find('[name="GoodsModel[valid_period_type]"]:checked').val() == 2){
                                    if($.trim(obj.val()) == '' || $.trim(obj.val()) == 0){
                                        obj.addClass('error');
                                        $.validator.showError($("#goodsmodel-valid_period_type"), '时间不能为空');
                                        error_message = '时间不能为空';
                                    }
                                    else if(! (/^(\+|-)?\d+$/.test(obj.val()))){
                                        obj.addClass('error');
                                        $.validator.showError($("#goodsmodel-valid_period_type"), '时间必须为整数');
                                        error_message = '时间必须为整数';
                                    }else{
                                        $.validator.clearError($("#goodsmodel-valid_period_type"));
                                        $('#virtual_goods_container').find('#goodsmodel-valid_period_hour').val(obj.val());
                                    }

                                }
                                return error_message;
                            }

                            $('.form_datetime').datetimepicker({
                                language: 'zh-CN',
                                weekStart: 1,
                                todayBtn: 1,
                                autoclose: 1,
                                todayHighlight: 1,
                                startView: 2,
                                forceParse: 0,
                                showMeridian: 1,
                                format: 'yyyy-mm-dd hh:ii:ss',
                            });

                            $('#virtual_goods_container').find('input[name="add_time_begin"]').datetimepicker().on('changeDate', function(ev) {
                                $('#virtual_goods_container').find('input[name="add_time_end"]').datetimepicker('setStartDate', ev.date);
                                $('#virtual_goods_container').find('#goodsmodel-valid_period_start_time').val($(this).val());
                                validateValidPeriodHour($(this));
                            });
                            $('#virtual_goods_container').find('input[name="add_time_end"]').datetimepicker().on('changeDate', function(ev) {
                                $('#virtual_goods_container').find('input[name="add_time_begin"]').datetimepicker('setEndDate', ev.date);
                                $('#virtual_goods_container').find('#goodsmodel-valid_period_end_time').val($(this).val());
                                validateValidPeriodHour($(this));
                            });
                        </script>
                    </div>
                @endif

                <h5 class="m-b-30" data-anchor="售后保障">售后服务保障</h5>
                <!-- 发票 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="goodsmodel-invoice_type" class="col-sm-1 control-label">

                            <span class="ng-binding">发票：</span>
                        </label>
                        <div class="col-sm-11">
                            <div class="form-control-box">


                                <input type="hidden" name="GoodsModel[invoice_type]" value="0"><div id="goodsmodel-invoice_type" class="" name="GoodsModel[invoice_type]"><label class="control-label cur-p m-r-10"><input type="radio" name="GoodsModel[invoice_type]" value="0" checked> 无</label>
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="GoodsModel[invoice_type]" value="1"> 增值税普通发票</label>
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="GoodsModel[invoice_type]" value="2"> 增值税专用发票</label>
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="GoodsModel[invoice_type]" value="3"> 增值税普通发票 和 增值税专用发票</label></div>


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">选择“无”则将不提供发票</div></div>
                        </div>
                    </div>
                </div>
                <!-- 服务保障 -->

                @foreach($contract_list as $v)
                    <div class="simple-form-field" >
                        <div class="form-group">
                            <label for="" class="col-sm-1 control-label">

                                <span class="ng-binding">{{ $v['contract_name'] }}：</span>
                            </label>
                            <div class="col-sm-11">
                                <div class="form-control-box">



                                    <input type="hidden" name="GoodsModel[contract_ids][{{ $v['contract_id'] }}]" value="0">
                                    <div class="" name="GoodsModel[contract_ids][{{ $v['contract_id'] }}]">
                                        <label class="control-label cur-p m-r-10"><input type="radio" name="GoodsModel[contract_ids][{{ $v['contract_id'] }}]" value="1"> 开启</label>
                                        <label class="control-label cur-p m-r-10"><input type="radio" name="GoodsModel[contract_ids][{{ $v['contract_id'] }}]" value="0" checked> 关闭</label></div>



                                </div>

                                <div class="help-block help-block-t"><div class="help-block help-block-t">卖家就该商品品质向买家作出承诺，承诺商品为正品。</div></div>
                            </div>
                        </div>
                    </div>
                @endforeach


                <h5 class="m-b-30" data-anchor="其他信息">其他信息</h5>
                <!-- 店铺内商品分类 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="" class="col-sm-1 control-label">

                            <span class="ng-binding">店铺内商品分类：</span>
                        </label>
                        <div class="col-sm-11">
                            <div class="form-control-box">


                                <div class="form-control-box shop-cat-choosen-select-box">
                                    <div id="shop_cat_container"></div>
                                    <input type="text" id="shop_cat_ids" class="form-control" name="shop_cat_ids" value="" style="display: none;">
                                </div>


                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>
                <!-- 会员打折 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="goodsmodel-user_discount" class="col-sm-1 control-label">

                            <span class="ng-binding">会员打折：</span>
                        </label>
                        <div class="col-sm-11">
                            <div class="form-control-box">


                                <input type="hidden" name="GoodsModel[user_discount]" value="0">
                                <div id="goodsmodel-user_discount" class="" name="GoodsModel[user_discount]">
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="GoodsModel[user_discount]" value="0" checked> 不参与会员打折</label>
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="GoodsModel[user_discount]" value="1"> 参与会员打折</label></div>


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">指的是统一的会员折扣是否参与，参与和不参与会员折扣不影响自定义会员价</br>参与会员折扣，如果设置了自定义会员价，则自定义会员价生效，统一的会员折扣不起作用，如果未设置自定义会员价，则按统一的会员折扣进行计算</br>未设置自定义会员价，选择参与会员打折后，商品详情页的价格将根据登录会员的店铺内会员等级自动计算折扣</br>选择不参与会员打折，也未设置自定义会员价，则此商品在详情页不会根据登录会员自动计算会员在店铺内享受的会员折扣</br>店铺会员等级及折扣设置请到“会员><a href="/member/rank/list" target="_blank" class="c-blue">会员等级</a>”模块进行设置</div></div>
                        </div>
                    </div>
                </div>
                <!-- 库存计数 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="goodsmodel-stock_mode" class="col-sm-1 control-label">

                            <span class="ng-binding">库存计数：</span>
                        </label>
                        <div class="col-sm-11">
                            <div class="form-control-box">


                                <input type="hidden" name="GoodsModel[stock_mode]" value="0"><div id="goodsmodel-stock_mode" class="" name="GoodsModel[stock_mode]"><label class="control-label cur-p m-r-10"><input type="radio" name="GoodsModel[stock_mode]" value="0" checked> 拍下减库存</label>
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="GoodsModel[stock_mode]" value="1"> 付款减库存</label>
                                    <label class="control-label cur-p m-r-10"><input type="radio" name="GoodsModel[stock_mode]" value="2"> 出库减库存</label></div>


                            </div>

                            <div class="help-block help-block-t"><div class="help-block help-block-t">拍下减库存：买家拍下商品即减少库存，存在恶拍风险。热销商品如需避免超卖可选此方式</br>付款减库存：买家拍下并完成付款方可减少库存，存在超卖风险。如需减少恶拍、提高回款效率，可选此方式；货到付款时将在卖家确认订单时减库存</br>出库减库存：卖家发货时减库存，如果库存充实，需要确保线上库存与线下库存保持一致，可选此方式</div></div>
                        </div>
                    </div>
                </div>
                <!-- 商品发布 -->
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="goodsmodel-goods_status" class="col-sm-1 control-label">

                            <span class="ng-binding">商品状态：</span>
                        </label>
                        <div class="col-sm-11">
                            <div class="form-control-box">


                                <label class="control-label cur-p">
                                    <input type="radio" id="goodsmodel-goods_status_1" name="GoodsModel[goods_status]" value="1" checked="checked" />
                                    立刻发布
                                </label>



                                {{--<br/>
                                <label class="control-label cur-p m-r-10">
                                    <input type="radio" name="GoodsModel[goods_status]" value="0" />
                                    定时发布
                                </label>
                                <select class="form-control sm-height pull-none m-r-5">
                                    @foreach($date_list as $k=>$v)
                                        <option value="{{ $k }}">{{ $v }}</option>
                                    @endforeach
                                </select> 时
                                <select class="form-control sm-height pull-none m-r-5 m-l-5">
                                    @foreach($hour_list as $k=>$v)
                                        <option value="{{ $k }}">{{ $v }}</option>
                                    @endforeach
                                </select> 分
                                <select class="form-control sm-height pull-none m-l-5">
                                    @foreach($minute_list as $k=>$v)
                                        <option value="{{ $k }}">{{ $v }}</option>
                                    @endforeach
                                </select>--}}



                                <br/>
                                <label class="control-label cur-p">
                                    <input type="radio" id="goodsmodel-goods_status_0" name="GoodsModel[goods_status]" value="0" />
                                    放入仓库
                                </label>


                            </div>

                            <div class="help-block help-block-t"></div>
                        </div>
                    </div>
                </div>

                <div class="goods-next p-b-30">

                    <input type="button" id="btn_publish" value="下一步，上传商品图片" class="btn btn-primary" />

                    <!--不可点击状态的下一步-->
                    <!--<button class="btn btn-default">下一步，上传商品图片</button>-->
                </div>
            </form>
            <input type="file" id="file_goods_image" name="file_goods_image" style="display: none;" multiple="multiple" accept="image/*" />
            <input type="file" id="file_pc_desc" name="file_pc_desc" style="display: none;" multiple="multiple" accept="image/jpeg,image/png" />
        </div>
    </div>
</div>

{{--extra html block--}}

<div style="display: none; overflow: visible;">
    <div id="sku_more_table_container" class="content">
        <div class="goods-info-two">
            <div class="goods-spec" style="min-width: 100%;">
                <div class="table-responsive">
                    <table id="sku_more_table" class="table table-hover">
                        <thead>
                        <tr>
                            <th class="sku-th-index">序号</th>

                            <th class="sku-goods-stockcode-td">
                                库位码
                                <div class="batch">
                                    <a href="javascript:void(0);" class="batch-edit" title="批量设置">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <div class="batch-input" style="display: none;">
                                        <h6>批量设置库位码：</h6>
                                        <a href="javascript:void(0);" class="batch-close">X</a>
                                        <input type="text" class="form-control text small pull-none" value="">
                                        <input type="button" class="btn btn-primary btn-sm pull-none m-l-5 btn_batch_set" data-field="goods_stockcode" value="设置" />
                                        <span class="arrow"></span>
                                    </div>
                                </div>
                            </th>



                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


{{--footer script page元素同级下面--}}
<style type="text/css">
    /*.col-sm-1 {width: 20%;}*/
    /*.col-sm-11 {width: 80%;}*/
    .style-seller{overflow-x: hidden;}
    .value_div{display: inline-block;}
</style>
<script>
    //销售分类=====start
    var cate_id = 0;
    function sale_cate1(t,num){
        var layer = layui.layer;
        let val = $(t).val();

        if(val==-1){
            $(t).parents(":eq(0)").find('.diyname').css('display','inline-block');
            $('.cat_div2').html("");
            $('.cat_div3').html("");
            $('.sale_value').find('.value_box').html('');
            $('.brand_box').html('');
        }else{
            $(t).parents(":eq(0)").find('.diyname').hide();
            cate_id = val;

            $.getJSON("/goods/publish/get_nextcate",{'parent_id':val},function(res){
                if(res.data.length>0){
                    var idx = layer.confirm('是否选择下一级分类？', {
                        btn: ['是','否']
                    }, function(){
                        let html = '<select id="goodsmodel-sale_cate" class="form-control chosen-select" name="GoodsModel[sale_cate2]" onchange="sale_cate1(this,2)">\n' +
                            '                                        <option value="">请选择</option>\n';
                        // '                                        <option value="-1">自定义类别</option>\n';
                        for(let i=0;i<res.data.length;i++) {
                            html += '                                            <option value="'+res.data[i].cat_id+'">'+res.data[i].cat_name+'</option>\n';
                        }
                        html += '                                    </select>\n' +
                            '                                    <input type="text" class="form-control diyname" name="diy_catname2" value="" style="display: none;" placeholder="多层用“、”分开">\n';

                        $('.cat_div2').html(html);
                        $('.chosen-select').chosen();//初始化chosen
                        layer.close(idx);
                    }, function(){
                        layer.close(idx);
                        if(num==1){
                            $('.cat_div2').html("");
                        }
                    });
                }else{
                    if(num==1){
                        $('.cat_div2').html("");
                    }
                }

                if(res.value.length>0){
                    value_insert(res.value,1);
                }else{
                    $('.sale_value').find('.value_box').html('');
                }

                if(res.brand.length>0){
                    brand_insert(res.brand);
                }else{
                    $('.brand_box').html('');
                }
            })
        }
    }
    function sale_cate2(t){
        let val = $(t).val();

        if(val==-1){
            $(t).parents(":eq(0)").find('.diyname').css('display','inline-block');
            $('.cat_div3').html("");
        }else{
            $(t).parents(":eq(0)").find('.diyname').hide();
            cate_id = val;
            $.getJSON("/goods/publish/get_nextcate",{'parent_id':val},function(res){
                if(res.data.length>0){
                    let html = '<select id="goodsmodel-sale_cate" class="form-control chosen-select" name="GoodsModel[sale_cate3]" onchange="sale_cate3(this)">\n' +
                        '                                        <option value="">请选择</option>\n'+
                        '                                        <option value="-1">自定义类别</option>\n';
                    for(let i=0;i<res.data.length;i++) {
                        html += '                                            <option value="'+res.data[i].cat_id+'">'+res.data[i].cat_name+'</option>\n';
                    }
                    html += '                                    </select>\n'+
                        '                                    <input type="text" class="form-control diyname" name="diy_catname3" value="" style="display: none;" placeholder="第三级名称">\n';

                    $('.cat_div3').html(html);
                    $('.chosen-select').chosen();//初始化chosen
                }
                if(res.value.length>0){
                    value_insert(res.value,1);
                }

                if(res.brand.length>0){
                    brand_insert(res.brand);
                }
            })
        }
    }
    function sale_cate3(t) {
        let val = $(t).val();

        if (val == -1) {
            $(t).parents(":eq(0)").find('.diyname').css('display','inline-block');
        }else{
            $(t).parents(":eq(0)").find('.diyname').hide();
            cate_id = val;
            $.getJSON("/goods/publish/get_nextcate",{'parent_id':val},function(res){
                if(res.value.length>0){
                    value_insert(res.value,1);
                }

                if(res.brand.length>0){
                    brand_insert(res.brand);
                }
            });
        }
    }
    //销售分类属性
    function value_insert(value,typ){
        let sel_name = '';
        let other_name = '';
        if(typ==1){
            sel_name = 'sale_cate';
            other_name = 'sale';
        }else if(typ==2){
            sel_name = 'logi_cate';
            other_name = 'logi';
        }
        let html = '<div class="simple-form-field other-attrs-item">\n' +
            '                                    <div class="form-group" style="margin-left:0;margin-right:0;display:flex;align-items:center;margin-bottom:0;">\n' +
            '                                        <label class="control-label" style="display:inline-block;">\n' +
            '                                            <div class="form-control-box" style="margin-right:10px;">\n' +
            '                                                <div class="value_div">\n' +
            '                                                    <label>\n' +
            '                                                        <select name="'+sel_name+'[value_name][]" class="goodsmodel-value_name form-control chosen-select" onchange="value_change(this,'+typ+')">\n' +
            '                                                            <option value="0">-- 请选择属性名称 --</option>\n' +
            '                                                            <option value="-1">自定义属性名称</option>\n';
        for(let i=0;i<value.length;i++) {
            html += '                                                      <option value="'+value[i].id+'">'+value[i].name+'</option>\n';
        }
        html+='                                                   </select>\n' +
            '                                                    </label>\n' +
            '                                                </div>\n' +
            '                                                <input type="text" class="form-control w80 other-attr-name" name="other'+other_name+'_attr_name[]" value="" placeholder="属性名" style="display: none;" onchange="check_valueName(this)"/>\n' +
            '                                                ：\n' +
            '                                            </div>\n' +
            '                                        </label>\n' +
            '                                            <div class="form-control-box control-label" style="float:unset;">\n' +
            '                                                <div class="value_desc" style="display: none;">\n' +
            '                                                    <label>\n' +
            '                                                    </label>\n' +
            '                                                </div>\n' +
            '                                                <input type="text" class="form-control w120 other-attr-value" name="other'+other_name+'_attr_value[]" value="" placeholder="多个值间用顿号分开"  style="display: none;" onchange="desc_change(this)"/>\n' +
            '                                                <a class="btn btn-danger btn-sm m-l-5 other-attr-remove">移除</a>\n' +
            '                                            </div>\n' +
            '                                    </div>\n' +
            '                                </div>';
        if(typ==1){
            $('.sale_value').find('.value_box').html(html);
        }else if(typ==2){
            $('.logi_value').find('.value_box').html(html);
        }
        $('.chosen-select').chosen();//初始化chosen
    }
    //添加属性到销售分类下
    $('#btn_add_salecate_attr').click(function(){
        if(cate_id==0){
            let html = '<div class="simple-form-field other-attrs-item">\n' +
                '                                    <div class="form-group" style="margin-left:0;margin-right:0;display:flex;align-items:center;margin-bottom:0;">\n' +
                '                                        <label class="control-label" style="display:inline-block;">\n' +
                '                                            <div class="form-control-box" style="margin-right:10px;">\n' +
                '                                                <div class="value_div">\n' +
                '                                                <input type="text" class="form-control w80 other-attr-name" name="othersale_attr_name[]" value="" placeholder="属性名" style="display: block;" onchange="check_valueName(this)"/>\n' +
                '                                                ：\n' +
                '                                            </div>\n' +
                '                                        </label>\n' +
                '                                            <div class="form-control-box control-label" style="float:unset;">\n' +
                '                                                <input type="text" class="form-control w120 other-attr-value" name="othersale_attr_value[]" value="" placeholder="多个值间用顿号分开"  style="display: block;" onchange="desc_change(this)"/>\n' +
                '                                                <a class="btn btn-danger btn-sm m-l-5 other-attr-remove">移除</a>\n' +
                '                                            </div>\n' +
                '                                    </div>\n' +
                '                                </div>';
            $('.sale_value').find('.value_box').append(html);
            $('.chosen-select').chosen();//初始化chosen
        }else{
            //有分类，则获取当前分类下的属性
            $.getJSON("/goods/publish/get_nextcate",{'parent_id':cate_id},function(res){
                if(res.value.length>0){
                    let html = '<div class="simple-form-field other-attrs-item">\n' +
                        '                                    <div class="form-group" style="margin-left:0;margin-right:0;display:flex;align-items:center;margin-bottom:0;">\n' +
                        '                                        <label class="control-label" style="display:inline-block;">\n' +
                        '                                            <div class="form-control-box" style="margin-right:10px;">\n' +
                        '                                                <div class="value_div">\n' +
                        '                                                    <label>\n' +
                        '                                                        <select name="sale_cate[value_name][]" class="goodsmodel-value_name form-control chosen-select" onchange="value_change(this,1)">\n' +
                        '                                                            <option value="0">-- 请选择属性名称 --</option>\n' +
                        '                                                            <option value="-1">自定义属性名称</option>\n';
                    for(let i=0;i<res.value.length;i++) {
                        html += '                                                      <option value="'+res.value[i].id+'">'+res.value[i].name+'</option>\n';
                    }
                    html+='                                                   </select>\n' +
                        '                                                    </label>\n' +
                        '                                                </div>\n' +
                        '                                                <input type="text" class="form-control w80 other-attr-name" name="othersale_attr_name[]" value="" placeholder="属性名" style="display: none;" onchange="check_valueName(this)"/>\n' +
                        '                                                ：\n' +
                        '                                            </div>\n' +
                        '                                        </label>\n' +
                        '                                            <div class="form-control-box control-label" style="float:unset;">\n' +
                        '                                                <div class="value_desc" style="display: none;">\n' +
                        '                                                    <label>\n' +
                        '                                                    </label>\n' +
                        '                                                </div>\n' +
                        '                                                <input type="text" class="form-control w120 other-attr-value" name="othersale_attr_value[]" value="" placeholder="多个值间用顿号分开"  style="display: none;" onchange="desc_change(this)"/>\n' +
                        '                                                <a class="btn btn-danger btn-sm m-l-5 other-attr-remove">移除</a>\n' +
                        '                                            </div>\n' +
                        '                                    </div>\n' +
                        '                                </div>';
                    $('.sale_value').find('.value_box').append(html);
                    $('.chosen-select').chosen();//初始化chosen
                }
            });
        }
    });
    //销售类品牌
    function brand_insert(brand){
        let html = '<select id="brand_id" name="GoodsModel[brand_id]" class="form-control chosen-select" onchange="change_brand(this)">\n';
        for(let i=0;i<brand.length;i++){
            html+='                             <option value="'+brand[i].brand_id+'" data-brand_name="'+brand[i].brand_name+'">'+brand[i].brand_name+'</option>\n';
        }

        html+='                           </select>';

        $('.brand_box').html(html);
        $('.chosen-select').chosen();//初始化chosen
    }
    //品牌选择
    function change_brand(t){
        // let txt = $(t).find('.chosen-single span').text();
        let val = $(t).val();
        let brand_name = $(t).find('option:selected').attr('data-brand_name');

        if(val == -1){
            $('#goodsmodel-brandname').css('display','inline-block');
        }else{
            let html = '<div class="note">'+brand_name+'</div><input name="GoodsModel[shihe_changwei][brandname][]" value="'+brand_name+'" style="display:none;">';
            $('.brand_promote').find('.form-control-box').html(html);
            $('#goodsmodel-brandname').hide();
        }
    }
    //销售分类=====end

    //跨境物流分类=====start
    var logicate_id = 0;
    function logi_cate1(t,num){
        let val = $(t).val();

        if(val==-1){
            $(t).parents(":eq(0)").find('.diyname').css('display','inline-block');
            $('.logicat_div2').html("");
            $('.logicat_div3').html("");
            $('.logi_value').find('.value_box').html("");
        }else{
            $(t).parents(":eq(0)").find('.diyname').hide();
            logicate_id = val;
            $.getJSON("/goods/publish/get_nextcate",{'parent_id':val},function(res){
                if(res.data.length>0){
                    var idx = layer.confirm('是否选择下一级分类？', {
                        btn: ['是','否']
                    }, function(){
                        let html = '<select id="goodsmodel-crossb_cate" class="form-control chosen-select" name="GoodsModel[crossb_cate2]" onchange="logi_cate1(this,2)">\n' +
                            '                                        <option value="">请选择</option>\n';
                        // '                                        <option value="-1">自定义类别</option>\n';
                        for(let i=0;i<res.data.length;i++) {
                            html += '                                            <option value="'+res.data[i].cat_id+'">'+res.data[i].cat_name+'</option>\n';
                        }
                        html += '                                    </select>\n' +
                            '                                    <input type="text" class="form-control diyname" name="diy_loginame2" value="" style="display: none;" placeholder="多层用“、”分开">\n';


                        $('.logicat_div2').html(html);
                        $('.chosen-select').chosen();//初始化chosen
                        layer.close(idx);
                    }, function(){
                        layer.close(idx);
                        if(num==1){
                            $('.logicat_div2').html("");
                        }
                    });
                }else{
                    if(num==1){
                        $('.logicat_div2').html("");
                    }
                }

                if(res.value.length>0){
                    value_insert(res.value,2);
                }else{
                    $('.logi_value').find('.value_box').html("");
                }
            })
        }
    }
    function logi_cate2(t){
        let val = $(t).val();

        if(val==-1){
            $(t).parents(":eq(0)").find('.diyname').css('display','inline-block');
            $('.logicat_div3').html("");
        }else{
            $(t).parents(":eq(0)").find('.diyname').hide();
            logicate_id = val;
            $.getJSON("/goods/publish/get_nextcate",{'parent_id':val},function(res){
                if(res.data.length>0){
                    let html = '<select id="goodsmodel-crossb_cate" class="form-control chosen-select" name="GoodsModel[crossb_cate3]" onchange="logi_cate3(this)">\n' +
                        '                                        <option value="">请选择</option>\n'+
                        '                                        <option value="-1">自定义类别</option>\n';
                    for(let i=0;i<res.data.length;i++) {
                        html += '                                            <option value="'+res.data[i].cat_id+'">'+res.data[i].cat_name+'</option>\n';
                    }
                    html += '                                    </select>\n' +
                        '                                    <input type="text" class="form-control diyname" name="diy_loginame3" value="" style="display: none;" placeholder="多级用“、”分开，最多两级">\n';

                    $('.logicat_div3').html(html);
                    $('.chosen-select').chosen();//初始化chosen
                }

                if(res.value.length>0){
                    value_insert(res.value,2);
                }
            })
        }
    }
    function logi_cate3(t) {
        let val = $(t).val();

        if (val == -1) {
            $(t).parents(":eq(0)").find('.diyname').css('display','inline-block');
        }else{
            $(t).parents(":eq(0)").find('.diyname').hide();
            logicate_id = val;
            $.getJSON("/goods/publish/get_nextcate",{'parent_id':val},function(res){
                if(res.value.length>0){
                    value_insert(res.value,2);
                }
            });
        }
    }
    //添加属性到物流分类下
    $('#btn_add_logicate_attr').click(function(){
        if(logicate_id==0){
            let html = '<div class="simple-form-field other-attrs-item">\n' +
                '                                    <div class="form-group" style="margin-left:0;margin-right:0;display:flex;align-items:center;margin-bottom:0;">\n' +
                '                                        <label class="control-label" style="display:inline-block;">\n' +
                '                                            <div class="form-control-box" style="margin-right:10px;">\n' +
                '                                                <div class="value_div">\n' +
                '                                                <input type="text" class="form-control w80 other-attr-name" name="otherlogi_attr_name[]" value="" placeholder="属性名" style="display: block;" onchange="check_valueName(this)"/>\n' +
                '                                                ：\n' +
                '                                            </div>\n' +
                '                                        </label>\n' +
                '                                            <div class="form-control-box control-label" style="float:unset;">\n' +
                '                                                <input type="text" class="form-control w120 other-attr-value" name="otherlogi_attr_value[]" value="" placeholder="多个值间用顿号分开"  style="display: block;" onchange="desc_change(this)"/>\n' +
                '                                                <a class="btn btn-danger btn-sm m-l-5 other-attr-remove">移除</a>\n' +
                '                                            </div>\n' +
                '                                    </div>\n' +
                '                                </div>';
            $('.logi_value').find('.value_box').append(html);
            $('.chosen-select').chosen();//初始化chosen
        }else{
            //有分类，则获取当前分类下的属性
            $.getJSON("/goods/publish/get_nextcate",{'parent_id':logicate_id},function(res){
                if(res.value.length>0){
                    let html = '<div class="simple-form-field other-attrs-item">\n' +
                        '                                    <div class="form-group" style="margin-left:0;margin-right:0;display:flex;align-items:center;margin-bottom:0;">\n' +
                        '                                        <label class="control-label" style="display:inline-block;">\n' +
                        '                                            <div class="form-control-box" style="margin-right:10px;">\n' +
                        '                                                <div class="value_div">\n' +
                        '                                                    <label>\n' +
                        '                                                        <select name="logi_cate[value_name][]" class="goodsmodel-value_name form-control chosen-select" onchange="value_change(this,2)">\n' +
                        '                                                            <option value="0">-- 请选择属性名称 --</option>\n' +
                        '                                                            <option value="-1">自定义属性名称</option>\n';
                    for(let i=0;i<res.value.length;i++) {
                        html += '                                                      <option value="'+res.value[i].id+'">'+res.value[i].name+'</option>\n';
                    }
                    html+='                                                   </select>\n' +
                        '                                                    </label>\n' +
                        '                                                </div>\n' +
                        '                                                <input type="text" class="form-control w80 other-attr-name" name="otherlogi_attr_name[]" value="" placeholder="属性名" style="display: none;" onchange="check_valueName(this)"/>\n' +
                        '                                                ：\n' +
                        '                                            </div>\n' +
                        '                                        </label>\n' +
                        '                                            <div class="form-control-box control-label" style="float:unset;">\n' +
                        '                                                <div class="value_desc" style="display: none;">\n' +
                        '                                                    <label>\n' +
                        '                                                    </label>\n' +
                        '                                                </div>\n' +
                        '                                                <input type="text" class="form-control w120 other-attr-value" name="otherlogi_attr_value[]" value="" placeholder="多个值间用顿号分开"  style="display: none;" onchange="desc_change(this)"/>\n' +
                        '                                                <a class="btn btn-danger btn-sm m-l-5 other-attr-remove">移除</a>\n' +
                        '                                            </div>\n' +
                        '                                    </div>\n' +
                        '                                </div>';
                    $('.logi_value').find('.value_box').append(html);
                    $('.chosen-select').chosen();//初始化chosen
                }
            });
        }
    });
    //跨境分类=====end

    //=== 2024-01-09 商品属性 START ===
    function value_change(t,typ){
        let val = $(t).val();
        if(val==-1){
            $(t).parents(":eq(3)").find('.other-attr-name').css('display','inline-block');
            $(t).parents(":eq(5)").find('.other-attr-value').css('display','inline-block');
            $(t).parents(":eq(5)").find('.value_desc').hide();
        }else{
            $(t).parents(":eq(3)").find('.other-attr-name').hide();
            if(val!=''){
                $.get("/goods/publish/checkvalue",{"val":val,'type':2},function(res){
                    let html = '';
                    if(typ==1){
                        html = '<select name="sale_cate[value_desc][]" class="goodsmodel-value_desc form-control chosen-select" onchange="valuedesc_change(this)">\n';
                    }else if(typ==2){
                        html = '<select name="logi_cate[value_desc][]" class="goodsmodel-value_desc form-control chosen-select" onchange="valuedesc_change(this)">\n';
                    }

                    html+='                                    <option value="0">-- 请选择属性描述 --</option>\n' +
                        '                                    <option value="-1">自定义属性描述</option>';
                    for(let i=0;i<res.list.length;i++){
                        html += '<option value="'+res.list[i].id+'">'+res.list[i].name+'</option>'
                    }
                    html += '</select>';
                    $(t).parents(":eq(5)").find('.value_desc').css('display','inline-block');
                    $(t).parents(":eq(5)").find('.value_desc label').html(html);
                    $('.chosen-select').chosen();//初始化chosen
                    $(t).parents(":eq(5)").find('.other-attr-value').hide();
                });
            }
        }
    }

    function valuedesc_change(t) {
        let val = $(t).val();
        if (val == -1) {
            $(t).parents(":eq(3)").find('.other-attr-value').css('display', 'inline-block');
        } else {
            $(t).parents(":eq(3)").find('.other-attr-value').hide();
            if(val!=0){
                let html = '<div class="note">'+$(t).parents(":eq(2)").find('.chosen-single span').text()+'</div><input name="GoodsModel[shihe_changwei][gattr_promote][]" value="'+$(t).parents(":eq(2)").find('.chosen-single span').text()+'" style="display:none;">';
                $('.gattr_promote').find('.form-control-box').append('<div style="display:inline-block;">'+html+'</div>&nbsp;');
            }
        }
    }

    function desc_change(t){
        let val = $(t).val();
        $.get("/goods/publish/checkvalue",{"pid":$(t).parents(":eq(3)").find('select').val(),'val':val,'type':3},function(res){
            if(res.code==-1){
                alert(res.msg);
                $(t).val("");
            }else{
                $('.gattr_promote').find('.form-control-box').append('<div style="display:inline-block;">'+val+'</div>&nbsp;');
            }
        });
    }

    function check_valueName(t){
        let val = $(t).val();
        $.get("/goods/publish/checkvalue",{"val":val,'type':1},function(res){
            if(res.code==-1){
                alert(res.msg);
                $(t).val("");
            }
        });
    }

    var ue = UE.getEditor('content', {
        initialFrameHeight: 400,
        serverUrl: '/assets/d2eace91/plugins/ueditor/php/controller.php'
    });

    layui.use(['layer','form','laydate','upload','colorpicker','element'],function() {
        var laydate = layui.laydate,
            layer = layui.layer,
            form = layui.form,
            $ = layui.jquery,
            element = layui.element;

        element.render('collapse');


    });

    //规则开始---------
    //段落是否需要标题
    function is_title(t){
        let $ = layui.jquery;
        let val = $(t).val();
        if(val==-1){
            $(t).parents(":eq(2)").find('.title').hide();
            $(t).parents(":eq(2)").find('.title').val("");
        }else{
            $(t).parents(":eq(2)").find('.title').css('display','inline-block');
        }
    }

    //新增同级
    function add_common_grade(t) {
        let $ = layui.jquery
            ,form = layui.form
            ,element = layui.element;

        var param_num = $(t).parents(":eq(3)").find('.layui-form-label').find('.layui-input').val();
        var origin_param_num = param_num;
        if(typeof(param_num)=='undefined') {
            param_num = $(t).parent().find('.parag_num').val();
        }
        param_num = param_num.replace(/\.$/, "");
        // param_num = param_num.trim('.', 'right');
        let true_param_num = param_num;//1.1
        param_num = param_num.split('.');
        let big_parag_num = 0;
        let typ = 1;
        let tpn = '';

        if (param_num.length > 1) {
            true_param_num = true_param_num.split('.');//1.10.10
            true_param_num.pop();
            for (let i = 0; i < true_param_num.length; i++) {
                tpn += true_param_num[i] + '.';
            }
            let num = parseInt(param_num[param_num.length - 1]) + 1;
            big_parag_num = tpn + '' + num;
        } else {
            if($(t).parents(":eq(4)").find('#big_parag_num').length==0){
                big_parag_num = parseInt($(t).parents(":eq(5)").find('#big_parag_num').val()) + 1;
                $(t).parents(":eq(5)").find('#big_parag_num').val(big_parag_num);
            }else{
                big_parag_num = parseInt($(t).parents(":eq(4)").find('#big_parag_num').val()) + 1;
                $(t).parents(":eq(4)").find('#big_parag_num').val(big_parag_num);
            }
            typ = 2;
        }

        //判断有无重复
        let parag_num = $(t).parents(":eq(5)").find('.parag_num');
        for(let i=0;i<parag_num.length;i++){
            if(parag_num[i].value==big_parag_num+'.'){
                if(typ==2){
                    //撤回
                    big_parag_num = parseInt($(t).parents(":eq(4)").find('#big_parag_num').val())-1;
                    $(t).parents(":eq(4)").find('#big_parag_num').val(big_parag_num);
                    // form.render(null,'component-form-element');
                }
                layer.alert('已有重复段落：'+parag_num[i].value);
                return false;
            }
        }

        if(typeof(origin_param_num)!='undefined') {
            //改变当前的样式,在外面添加
            let parag_num_div = $(t).parent().parent().parent().parent().find('.layui-form-label').clone();
            let parag_title = $(t).parent().parent().find('.disf').eq(0).clone();
            let parag_btn = $(t).parent().clone();
            let parag_textarea = $(t).parent().parent().parent().find('.textarea_div').clone();
            // console.log(parag_num_div[0].innerHTML ,'--1--', parag_title[0].innerHTML ,'--2--', parag_btn[0].innerHTML);
            let this_html = '<div class="layui-collapse type1_box" lay-accordion>\n' +
                '  <div class="layui-colla-item">\n' +
                '    <h2 class="layui-colla-title ctitle"><div class="disf">' + parag_num_div[0].innerHTML + parag_title[0].innerHTML + parag_btn[0].innerHTML + '</div></h2>\n' +
                '    <div class="layui-colla-content">' + parag_textarea[0].innerHTML + '</div>\n' +
                '  </div>\n' +
                '</div>';
            $(t).parents(":eq(4)").find('.regular_box').append(this_html);
            $(t).parents(":eq(4)").find('.regular_box').show();
        }
        //获取当前有多少个type1_box
        let len = parseInt($(t).parents(":eq(5)").find('.type1_box').length) - 1;
        if(typeof(origin_param_num)=='undefined') {
            len = parseInt($(t).parents(":eq(5)").find('.type1_box').length);
        }
        //添加同级
        let html = '<div class="layui-form-item type1_box">\n' +
            '                                    <div class="layui-form-label"><input type="text" name="parag_num1['+len+']" class="layui-input parag_num" value="'+big_parag_num+'." readonly></div>\n' +
            '                                    <div class="layui-input-block">\n'+
            '                                        <div class="disf">\n';
        if(typ==1){
            //添加下级
            html += '                                <div class="disf">\n'+
                '                                             <input type="hidden" class="layui-input" name="pnum1['+len+']" value="'+tpn+'">\n'+
                '                                             <select class="form-control chosen-select" name="is_title1['+len+']" onchange="is_title(this)">\n'+
                '                                                <option value="-1">不需要标题</option>\n'+
                '                                                <option value="1">需要标题</option>\n'+
                '                                             </select>\n'+
                '                                             <input type="text" class="layui-input title" name="title1['+len+']" placeholder="输入标题" style="display:none;" value="" onkeyup="keyup(this)">\n' +
                '                                    </div>\n';
        }else if(typ==2){
            //添加同级
            html += '                            <div class="disf">\n'+
                '                                   <input type="hidden" class="layui-input" name="pnum1['+len+']" value="0">\n'+
                '                                   <input type="text" class="layui-input" name="title1['+len+']" placeholder="输入标题" value="" onkeyup="keyup(this)">\n'+
                '                                   <input type="hidden" class="layui-input" name="is_title1['+len+']" value="1">\n'+
                '                                </div>';
        }
        html += '                                    <div class="disf">\n' +
            '                                            <div class="layui-btn layui-btn-success" onclick="add_common_grade(this)">新增同级</div>\n' +
            '                                            <div class="layui-btn layui-btn-success" onclick="add_next_grade(this)">新增下级</div>\n' +
            '                                            <div class="layui-btn layui-btn-normal" onclick="queren(this)"><div class="goup collapse"></div></div>\n' +
            '                                            <div class="layui-btn layui-btn-danger" onclick="del_parag(this)">删除</div>\n' +
            '                                        </div>\n' +
            '                                    </div>\n'+
            '                                    <div class="textarea_div"><textarea name="content1['+len+']" class="layui-textarea" placeholder="输入内容" onkeyup="keyup2(this)"></textarea></div>\n' +
            '                                 </div>\n' +
            '                             </div>';

        if(typeof(origin_param_num)!='undefined') {
            $(t).parents(":eq(6)").find('.simple-form-field').find('.input40').append(html);
            $(t).parents(":eq(3)").remove();
            $(t).parents(":eq(4)").find('.regular_box').find('.chosen-container').hide();
        }else{
            $(t).parents(":eq(7)").find('.simple-form-field').find('.input40').append(html);
        }

        element.render('collapse');
        $('.chosen-select').chosen();//初始化chosen

        //隐藏折叠框
        if(typeof(origin_param_num)=='undefined') {
            $(t).parent().parent().click();
        }
    }

    //新增下级
    function add_next_grade(t) {
        let $ = layui.jquery
            ,form = layui.form
            ,element = layui.element;
        var param_num = $(t).parent().parent().parent().parent().find('.layui-form-label').find('.layui-input').val();
        var origin_param_num = param_num;
        if(typeof(param_num)=='undefined'){
            param_num = $(t).parent().find('.parag_num').val();
        }
        let param_num2 = param_num + '1.';
        //判断有无重复
        let parag_num = $(t).parents(":eq(5)").find('.parag_num');
        for(let i=0;i<parag_num.length;i++){
            if(parag_num[i].value==param_num2){
                layer.alert('已有重复段落：'+parag_num[i].value);
                return false;
            }
        }

        //改变当前的样式
        if(typeof(origin_param_num)!='undefined') {
            //从外面添加
            let parag_num_div = $(t).parent().parent().parent().parent().find('.layui-form-label').clone();
            let parag_title = $(t).parent().parent().find('.disf').eq(0).clone();
            let parag_btn = $(t).parent().clone();
            let parag_textarea = $(t).parent().parent().parent().find('.textarea_div').clone();
            let this_html = '<div class="layui-collapse type1_box" lay-accordion>\n' +
                '  <div class="layui-colla-item">\n' +
                '    <h2 class="layui-colla-title ctitle"><div class="disf">' + parag_num_div[0].innerHTML + parag_title[0].innerHTML + parag_btn[0].innerHTML + '</div></h2>\n' +
                '    <div class="layui-colla-content">' + parag_textarea[0].innerHTML + '</div>\n' +
                '  </div>\n' +
                '</div>';
            $(t).parents(":eq(4)").find('.regular_box').append(this_html);
            $(t).parents(":eq(4)").find('.regular_box').show();
        }
        //获取当前有多少个type1_box
        let len = parseInt($(t).parents(":eq(5)").find('.type1_box').length) - 1;
        if(typeof(origin_param_num)=='undefined') {
            len = parseInt($(t).parents(":eq(5)").find('.type1_box').length);
        }
        let html = '<div class="layui-form-item type1_box">\n' +
            '                                    <div class="layui-form-label"><input type="text" name="parag_num1['+len+']" class="layui-input parag_num" value="'+param_num2+'" readonly></div>\n' +
            '                                    <div class="layui-input-block">\n' +
            '                                       <div class="disf">\n'+
            '                                        <div class="disf">\n'+
            '                                             <input type="hidden" class="layui-input" name="pnum1['+len+']" value="'+param_num+'">\n'+
            '                                             <select name="is_title1['+len+']" class="form-control chosen-select" onchange="is_title(this)">\n'+
            '                                                <option value="-1">不需要标题</option>\n'+
            '                                                <option value="1">需要标题</option>\n'+
            '                                             </select>\n'+
            '                                             <input type="text" class="layui-input title" name="title1['+len+']" placeholder="输入标题" style="display:none;" onkeyup="keyup(this)">\n' +
            '                                        </div>\n'+
            '                                        <div class="disf">\n' +
            '                                            <div class="layui-btn layui-btn-success" onclick="add_common_grade(this)">新增同级</div>\n' +
            '                                            <div class="layui-btn layui-btn-success" onclick="add_next_grade(this)">新增下级</div>\n' +
            '                                            <div class="layui-btn layui-btn-normal" onclick="queren(this)"><div class="goup collapse"></div></div>\n' +
            '                                            <div class="layui-btn layui-btn-danger" onclick="del_parag(this)">删除</div>\n' +
            '                                        </div>\n' +
            '                                       </div>\n'+
            '                                        <div class="textarea_div"><textarea name="content1['+len+']" class="layui-textarea" placeholder="输入内容" onkeyup="keyup2(this)"></textarea></div>\n' +
            '                                    </div>\n' +
            '                                </div>';

        if(typeof(origin_param_num)!='undefined') {
            $(t).parents(":eq(6)").find('.simple-form-field').find('.input40').append(html);
            $(t).parents(":eq(3)").remove();
            $(t).parents(":eq(4)").find('.regular_box').find('.chosen-container').hide();
        }else{
            $(t).parents(":eq(7)").find('.simple-form-field').find('.input40').append(html);
        }
        $('.chosen-select').chosen();//初始化chosen
        element.render('collapse');
        //隐藏折叠框
        if(typeof(origin_param_num)=='undefined') {
            $(t).parent().parent().click();
        }
    }

    //新增同级
    function add_common_grade2(t) {
        let $ = layui.jquery
            ,form = layui.form
            ,element = layui.element;

        var param_num = $(t).parents(":eq(3)").find('.layui-form-label').find('.layui-input').val();
        var origin_param_num = param_num;
        if(typeof(param_num)=='undefined') {
            param_num = $(t).parent().find('.parag_num').val();
        }
        param_num = param_num.replace(/\.$/, "");
        // param_num = param_num.trim('.', 'right');
        let true_param_num = param_num;//1.1
        param_num = param_num.split('.');
        let big_parag_num = 0;
        let typ = 1;
        let tpn = '';

        if (param_num.length > 1) {
            true_param_num = true_param_num.split('.');//1.10.10
            true_param_num.pop();
            for (let i = 0; i < true_param_num.length; i++) {
                tpn += true_param_num[i] + '.';
            }
            let num = parseInt(param_num[param_num.length - 1]) + 1;
            big_parag_num = tpn + '' + num;
        } else {
            if($(t).parents(":eq(4)").find('#big_parag_num').length==0){
                big_parag_num = parseInt($(t).parents(":eq(5)").find('#big_parag_num').val()) + 1;
                $(t).parents(":eq(5)").find('#big_parag_num').val(big_parag_num);
            }else{
                big_parag_num = parseInt($(t).parents(":eq(4)").find('#big_parag_num').val()) + 1;
                $(t).parents(":eq(4)").find('#big_parag_num').val(big_parag_num);
            }
            typ = 2;
        }

        //判断有无重复
        let parag_num = $(t).parents(":eq(5)").find('.parag_num');
        for(let i=0;i<parag_num.length;i++){
            if(parag_num[i].value==big_parag_num+'.'){
                if(typ==2){
                    //撤回
                    big_parag_num = parseInt($(t).parents(":eq(4)").find('#big_parag_num').val())-1;
                    $(t).parents(":eq(4)").find('#big_parag_num').val(big_parag_num);
                    // form.render(null,'component-form-element');
                }
                layer.alert('已有重复段落：'+parag_num[i].value);
                return false;
            }
        }

        if(typeof(origin_param_num)!='undefined') {
            //改变当前的样式,在外面添加
            let parag_num_div = $(t).parent().parent().parent().parent().find('.layui-form-label').clone();
            let parag_title = $(t).parent().parent().find('.disf').eq(0).clone();
            let parag_btn = $(t).parent().clone();
            let parag_textarea = $(t).parent().parent().parent().find('.textarea_div').clone();
            // console.log(parag_num_div[0].innerHTML ,'--1--', parag_title[0].innerHTML ,'--2--', parag_btn[0].innerHTML);
            let this_html = '<div class="layui-collapse type1_box" lay-accordion>\n' +
                '  <div class="layui-colla-item">\n' +
                '    <h2 class="layui-colla-title ctitle"><div class="disf">' + parag_num_div[0].innerHTML + parag_title[0].innerHTML + parag_btn[0].innerHTML + '</div></h2>\n' +
                '    <div class="layui-colla-content">' + parag_textarea[0].innerHTML + '</div>\n' +
                '  </div>\n' +
                '</div>';
            $(t).parents(":eq(4)").find('.regular_box').append(this_html);
            $(t).parents(":eq(4)").find('.regular_box').show();
        }
        //获取当前有多少个type1_box
        let len = parseInt($(t).parents(":eq(5)").find('.type1_box').length) - 1;
        if(typeof(origin_param_num)=='undefined') {
            len = parseInt($(t).parents(":eq(5)").find('.type1_box').length);
        }
        //添加同级
        let html = '<div class="layui-form-item type1_box">\n' +
            '                                    <div class="layui-form-label"><input type="text" name="parag_num2['+len+']" class="layui-input parag_num" value="'+big_parag_num+'." readonly></div>\n' +
            '                                    <div class="layui-input-block">\n'+
            '                                        <div class="disf">\n';
        if(typ==1){
            //添加下级
            html += '                                <div class="disf">\n'+
                '                                             <input type="hidden" class="layui-input" name="pnum2['+len+']" value="'+tpn+'">\n'+
                '                                             <select class="form-control chosen-select" name="is_title2['+len+']" onchange="is_title(this)">\n'+
                '                                                <option value="-1">不需要标题</option>\n'+
                '                                                <option value="1">需要标题</option>\n'+
                '                                             </select>\n'+
                '                                             <input type="text" class="layui-input title" name="title2['+len+']" placeholder="输入标题" style="display:none;" value="" onkeyup="keyup(this)">\n' +
                '                                    </div>\n';
        }else if(typ==2){
            //添加同级
            html += '                            <div class="disf">\n'+
                '                                   <input type="hidden" class="layui-input" name="pnum2['+len+']" value="0">\n'+
                '                                   <input type="text" class="layui-input" name="title2['+len+']" placeholder="输入标题" value="" onkeyup="keyup(this)">\n'+
                '                                   <input type="hidden" class="layui-input" name="is_title2['+len+']" value="1">\n'+
                '                                </div>';
        }
        html += '                                    <div class="disf">\n' +
            '                                            <div class="layui-btn layui-btn-success" onclick="add_common_grade2(this)">新增同级</div>\n' +
            '                                            <div class="layui-btn layui-btn-success" onclick="add_next_grade2(this)">新增下级</div>\n' +
            '                                            <div class="layui-btn layui-btn-normal" onclick="queren(this)"><div class="goup collapse"></div></div>\n' +
            '                                            <div class="layui-btn layui-btn-danger" onclick="del_parag(this)">删除</div>\n' +
            '                                        </div>\n' +
            '                                    </div>\n'+
            '                                    <div class="textarea_div"><textarea name="content2['+len+']" class="layui-textarea" placeholder="输入内容" onkeyup="keyup2(this)"></textarea></div>\n' +
            '                                 </div>\n' +
            '                             </div>';

        if(typeof(origin_param_num)!='undefined') {
            $(t).parents(":eq(6)").find('.simple-form-field').find('.input40').append(html);
            $(t).parents(":eq(3)").remove();
            $(t).parents(":eq(4)").find('.regular_box').find('.chosen-container').hide();
        }else{
            $(t).parents(":eq(7)").find('.simple-form-field').find('.input40').append(html);
        }

        element.render('collapse');
        $('.chosen-select').chosen();//初始化chosen

        //隐藏折叠框
        if(typeof(origin_param_num)=='undefined') {
            $(t).parent().parent().click();
        }
    }

    //新增下级
    function add_next_grade2(t) {
        let $ = layui.jquery
            ,form = layui.form
            ,element = layui.element;
        var param_num = $(t).parent().parent().parent().parent().find('.layui-form-label').find('.layui-input').val();
        var origin_param_num = param_num;
        if(typeof(param_num)=='undefined'){
            param_num = $(t).parent().find('.parag_num').val();
        }
        let param_num2 = param_num + '1.';
        //判断有无重复
        let parag_num = $(t).parents(":eq(5)").find('.parag_num');
        for(let i=0;i<parag_num.length;i++){
            if(parag_num[i].value==param_num2){
                layer.alert('已有重复段落：'+parag_num[i].value);
                return false;
            }
        }

        //改变当前的样式
        if(typeof(origin_param_num)!='undefined') {
            //从外面添加
            let parag_num_div = $(t).parent().parent().parent().parent().find('.layui-form-label').clone();
            let parag_title = $(t).parent().parent().find('.disf').eq(0).clone();
            let parag_btn = $(t).parent().clone();
            let parag_textarea = $(t).parent().parent().parent().find('.textarea_div').clone();
            let this_html = '<div class="layui-collapse type1_box" lay-accordion>\n' +
                '  <div class="layui-colla-item">\n' +
                '    <h2 class="layui-colla-title ctitle"><div class="disf">' + parag_num_div[0].innerHTML + parag_title[0].innerHTML + parag_btn[0].innerHTML + '</div></h2>\n' +
                '    <div class="layui-colla-content">' + parag_textarea[0].innerHTML + '</div>\n' +
                '  </div>\n' +
                '</div>';
            $(t).parents(":eq(4)").find('.regular_box').append(this_html);
            $(t).parents(":eq(4)").find('.regular_box').show();
        }
        //获取当前有多少个type1_box
        let len = parseInt($(t).parents(":eq(5)").find('.type1_box').length) - 1;
        if(typeof(origin_param_num)=='undefined') {
            len = parseInt($(t).parents(":eq(5)").find('.type1_box').length);
        }
        let html = '<div class="layui-form-item type1_box">\n' +
            '                                    <div class="layui-form-label"><input type="text" name="parag_num2['+len+']" class="layui-input parag_num" value="'+param_num2+'" readonly></div>\n' +
            '                                    <div class="layui-input-block">\n' +
            '                                       <div class="disf">\n'+
            '                                        <div class="disf">\n'+
            '                                             <input type="hidden" class="layui-input" name="pnum2['+len+']" value="'+param_num+'">\n'+
            '                                             <select name="is_title2['+len+']" class="form-control chosen-select" onchange="is_title(this)">\n'+
            '                                                <option value="-1">不需要标题</option>\n'+
            '                                                <option value="1">需要标题</option>\n'+
            '                                             </select>\n'+
            '                                             <input type="text" class="layui-input title" name="title2['+len+']" placeholder="输入标题" style="display:none;" onkeyup="keyup(this)">\n' +
            '                                        </div>\n'+
            '                                        <div class="disf">\n' +
            '                                            <div class="layui-btn layui-btn-success" onclick="add_common_grade2(this)">新增同级</div>\n' +
            '                                            <div class="layui-btn layui-btn-success" onclick="add_next_grade2(this)">新增下级</div>\n' +
            '                                            <div class="layui-btn layui-btn-normal" onclick="queren(this)"><div class="goup collapse"></div></div>\n' +
            '                                            <div class="layui-btn layui-btn-danger" onclick="del_parag(this)">删除</div>\n' +
            '                                        </div>\n' +
            '                                       </div>\n'+
            '                                        <div class="textarea_div"><textarea name="content2['+len+']" class="layui-textarea" placeholder="输入内容" onkeyup="keyup2(this)"></textarea></div>\n' +
            '                                    </div>\n' +
            '                                </div>';

        if(typeof(origin_param_num)!='undefined') {
            $(t).parents(":eq(6)").find('.simple-form-field').find('.input40').append(html);
            $(t).parents(":eq(3)").remove();
            $(t).parents(":eq(4)").find('.regular_box').find('.chosen-container').hide();
        }else{
            $(t).parents(":eq(7)").find('.simple-form-field').find('.input40').append(html);
        }
        $('.chosen-select').chosen();//初始化chosen
        element.render('collapse');
        //隐藏折叠框
        if(typeof(origin_param_num)=='undefined') {
            $(t).parent().parent().click();
        }
    }

    //复制input框
    function keyup(obj){
        let $ = layui.jquery
            ,form  = layui.form;
        $(obj).attr('value',$(obj).val());
    }

    //复制textarea框
    function keyup2(obj){
        let $ = layui.jquery
            ,form  = layui.form;
        $(obj).text($(obj).val());
    }

    //确认生成
    function queren(t){
        let $ = layui.jquery
            ,form = layui.form
            ,element = layui.element;

        if($(t).parents(":eq(3)").find('.layui-colla-title').length>0){
            if($(t).find('.goup').length>0){
                $(t).find('.goup').removeClass('goup').addClass('godown');
            }else{
                $(t).find('.godown').removeClass('godown').addClass('goup');
            }
        }

        let parag_num_div = $(t).parents(":eq(3)").find('.layui-form-label').clone();
        let parag_title = $(t).parents(":eq(1)").find('.disf').eq(0).clone();
        let parag_btn = $(t).parent().clone();
        let parag_textarea = $(t).parents(":eq(2)").find('.textarea_div').clone();
        let this_html = '<div class="layui-collapse type1_box" lay-accordion>\n' +
            '  <div class="layui-colla-item">\n' +
            '    <h2 class="layui-colla-title ctitle"><div class="disf">' + parag_num_div[0].innerHTML + parag_title[0].innerHTML + parag_btn[0].innerHTML + '</div></h2>\n' +
            '    <div class="layui-colla-content">' + parag_textarea[0].innerHTML + '</div>\n' +
            '  </div>\n' +
            '</div>';
        $(t).parents(":eq(4)").find('.regular_box').append(this_html);
        $(t).parents(":eq(3)").remove();
        // $('.type1').find('.layui-field-box').find('.input40').append(html);
        // form.render(null,'component-form-element');
        element.render('collapse');
    }

    //删除当前段落
    function del_parag(t){
        let $ = layui.jquery
            ,form  = layui.form
            ,layer = layui.layer;
        let is_big = $(t).parent().parent().parent().parent().find('.layui-form-label').find('.parag_num').val();
        // console.log(is_big);
        layer.confirm('确认要删除该段落？', {
            btn: ['确认','取消']
        }, function(){
            if(typeof(is_big)=='undefined'){
                let is_big = $(t).parent().find('.parag_num').val();
                is_big = is_big.split('.');
                if (is_big.length == 2) {
                    let big_parag_num = parseInt($(t).parents(":eq(4)").find('#big_parag_num').val()) - 1;
                    $(t).parents(":eq(4)").find('#big_parag_num').val(big_parag_num);
                }
                $(t).parents(":eq(3)").remove();
                // form.render(null,'component-form-element');
            }else {
                is_big = is_big.split('.');
                if (is_big.length == 2) {
                    let big_parag_num = parseInt($(t).parents(":eq(4)").find('#big_parag_num').val()) - 1;
                    $(t).parents(":eq(4)").find('#big_parag_num').val(big_parag_num);
                }

                $(t).parents(":eq(3)").remove();
                // form.render(null, 'component-form-element');
            }
            layer.closeAll();
        }, function(){

        });
    }
    //规则结束---------

    //规格开始---------
    function specs_unit(t){
        let val = $(t).find('option:selected').attr('data-title');
        $(t).parent().find('.unit_name').text(val);
    }
    function specs_selEnd(t){
        let val = $(t).val();
        if(val==1){
            $(t).parents(":eq(1)").find('.end_num').show();
            $(t).parents(":eq(2)").find('td').eq(-1).find('.addbtn').show();
        }else if(val==2){
            $(t).parents(":eq(1)").find('.end_num').hide();
            $(t).parents(":eq(2)").find('td').eq(-1).find('.addbtn').hide();
        }
    }

    //有规格
    function add_interval(t,tr_num){
        let start_num = parseInt($(t).parents(':eq(1)').find('.end_num').val()) + 1;
        let unit = $(t).parents(":eq(1)").find('.unit_name').text();
        let currency = $(t).parents(":eq(1)").find('.currency').find('option:selected').val();
        if($(t).parents(':eq(1)').find('.end_num').val()<1 || unit=='' || currency==''){
            alert('请填写当前区间信息');return false;
        }

        let html = '<tr>\n' +
            '                    <td class="td_width">\n' +
            '                        <div class="disf">\n' +
            '                            <input type="number" name="new_specs[start_num]['+tr_num+'][]" value="'+start_num+'" class="form-control w50 start_num" placeholder="起始数值" readonly>\n' +
            '                            <select name="new_specs[unit]['+tr_num+'][]" class="form-control chosen-select unit" onchange="specs_unit(this)">\n' +
            '                                <option value="">请选择</option>\n';
        @foreach($unit as $k=>$v)
        if(unit == "{{$v['code_name']}}"){
            html += '                              <option value="{{$v['code_value']}}" data-title="{{$v['code_name']}}" selected>{{$v['code_name']}}</option>\n';
        }else {
            html += '                              <option value="{{$v['code_value']}}" data-title="{{$v['code_name']}}">{{$v['code_name']}}</option>\n';
        }
        @endforeach
            html+='                      </select>\n' +
            '                            至\n' +
            '                            <select name="new_specs[select_end]['+tr_num+'][]" class="form-control chosen-select " onchange="specs_selEnd(this)">\n' +
            '                                <option value="1">数值</option>\n' +
            '                                <option value="2">以上</option>\n' +
            '                            </select>\n' +
            '                            <input type="number" name="new_specs[end_num]['+tr_num+'][]" value="" class="form-control w50 end_num" placeholder="尾止数值">\n' +
            '                            <div class="unit_name">'+unit+'</div>\n' +
            '                        </div>\n' +
            '                    </td>\n' +
            '                    <td class="td_width">\n' +
            '                        <select name="new_specs[currency]['+tr_num+'][]" class="form-control chosen-select currency" onchange="specs_currency(this)">\n' +
            '                            <option value="">请选择</option>\n';
        @foreach($currency as $k=>$v)
        if(currency=="{{$v['id']}}"){
            html += '                           <option value="{{$v['id']}}" data-title="{{$v['currency_symbol_origin']}}" selected>{{$v['code_zhname']}}：{{$v['currency_symbol_origin']}}</option>\n';
        }else {
            html += '                           <option value="{{$v['id']}}" data-title="{{$v['currency_symbol_origin']}}">{{$v['code_zhname']}}：{{$v['currency_symbol_origin']}}</option>\n';
        }
        @endforeach
            html+='                  </select>\n' +
            '                        <input type="number" name="new_specs[price]['+tr_num+'][]" value="" class="form-control w70" placeholder="区间金额">\n' +
            '                    </td>\n' +
            '                    <td style="text-align:center;">\n' +
            '                        <div class="layui-btn layui-btn-md layui-btn-danger delbtn" onclick="del_interval(this)">-</div>\n' +
            '                        <div class="layui-btn layui-btn-md layui-btn-normal addbtn" onclick="add_interval(this,'+tr_num+')">+</div>\n' +
            '                    </td>\n' +
            '                </tr>';
        $(t).parents(":eq(0)").hide();
        $(t).parents(":eq(2)").append(html);
        $('.chosen-select').chosen();//初始化chosen
    }

    //无规格
    function add_interval2(t){
        let start_num = parseInt($(t).parents(':eq(1)').find('.end_num').val()) + 1;
        let unit = $(t).parents(":eq(1)").find('.unit_name').text();
        let currency = $(t).parents(":eq(1)").find('.currency').find('option:selected').val();
        if($(t).parents(':eq(1)').find('.end_num').val()<1 || unit=='' || currency==''){
            alert('请填写当前区间信息');return false;
        }

        let html = '<tr>\n' +
            '                    <td class="td_width">\n' +
            '                        <div class="disf">\n' +
            '                            <input type="number" name="nospecs[start_num][]" value="'+start_num+'" class="form-control w50 start_num" placeholder="起始数值" readonly>\n' +
            '                            <select name="nospecs[unit][]" class="form-control chosen-select unit" onchange="specs_unit(this)">\n' +
            '                                <option value="">请选择</option>\n';
        @foreach($unit as $k=>$v)
        if(unit == "{{$v['code_name']}}"){
            html += '                              <option value="{{$v['code_value']}}" data-title="{{$v['code_name']}}" selected>{{$v['code_name']}}</option>\n';
        }else {
            html += '                              <option value="{{$v['code_value']}}" data-title="{{$v['code_name']}}">{{$v['code_name']}}</option>\n';
        }
        @endforeach
            html+='                      </select>\n' +
            '                            至\n' +
            '                            <select name="nospecs[select_end][]" class="form-control chosen-select " onchange="specs_selEnd(this)">\n' +
            '                                <option value="1">数值</option>\n' +
            '                                <option value="2">以上</option>\n' +
            '                            </select>\n' +
            '                            <input type="number" name="nospecs[end_num][]" value="" class="form-control w50 end_num" placeholder="尾止数值">\n' +
            '                            <div class="unit_name">'+unit+'</div>\n' +
            '                        </div>\n' +
            '                    </td>\n' +
            '                    <td class="td_width">\n' +
            '                        <select name="nospecs[currency][]" class="form-control chosen-select currency" onchange="specs_currency(this)">\n' +
            '                            <option value="">请选择</option>\n';
        @foreach($currency as $k=>$v)
        if(currency=="{{$v['id']}}"){
            html += '                           <option value="{{$v['id']}}" data-title="{{$v['currency_symbol_origin']}}" selected>{{$v['code_zhname']}}：{{$v['currency_symbol_origin']}}</option>\n';
        }else {
            html += '                           <option value="{{$v['id']}}" data-title="{{$v['currency_symbol_origin']}}">{{$v['code_zhname']}}：{{$v['currency_symbol_origin']}}</option>\n';
        }
        @endforeach
            html+='                  </select>\n' +
            '                        <input type="number" name="nospecs[price][]" value="" class="form-control w70" placeholder="区间金额">\n' +
            '                    </td>\n' +
            '                    <td style="text-align:center;">\n' +
            '                        <div class="layui-btn layui-btn-md layui-btn-danger delbtn" onclick="del_interval(this)">-</div>\n' +
            '                        <div class="layui-btn layui-btn-md layui-btn-normal addbtn" onclick="add_interval2(this)">+</div>\n' +
            '                    </td>\n' +
            '                </tr>';
        $(t).parents(":eq(0)").hide();
        $(t).parents(":eq(2)").append(html);
        $('.chosen-select').chosen();//初始化chosen
    }

    function del_interval(t){
        let layer = layui.layer,
            $ = layui.$;
        let close_idx = layer.confirm('确认要删除？', {
            btn: ['删除','取消']
        }, function(){
            $(t).parents(":eq(1)").prev().find('td').eq(-1).show();
            $(t).parents(":eq(1)").remove();
            layer.close(close_idx);
        }, function(){

        });
    }
    //规格结束---------

    //赠送实物
    function shiwu_add(t){
        let html = '<div class="disf">\n' +
            '           <input type="text" class="form-control" name="GoodsModel[shiwu_desc][]" placeholder="请输入描述">\n' +
            '           <div class="layui-btn layui-btn-md layui-btn-danger shiwu_del" onclick="shiwu_del(this,1)">-</div>\n' +
            '           <div class="layui-btn layui-btn-md layui-btn-normal shiwu_add" onclick="shiwu_add(this)">+</div>\n' +
            '       </div>';
        $(t).parent().find('.layui-btn').hide();
        $(t).parents(":eq(1)").append(html);
    }
    //赠送服务
    function fuwu_add(t){
        let html = '<div class="disf">\n' +
            '           <input type="text" class="form-control" name="GoodsModel[fuwu_desc][]" placeholder="请输入描述">\n' +
            '           <div class="layui-btn layui-btn-md layui-btn-danger fuwu_del" onclick="shiwu_del(this,2)">-</div>\n' +
            '           <div class="layui-btn layui-btn-md layui-btn-normal fuwu_add" onclick="fuwu_add(this)">+</div>\n' +
            '       </div>';
        $(t).parent().find('.layui-btn').hide();
        $(t).parents(":eq(1)").append(html);
    }
    //删除实物/服务
    function shiwu_del(t,typ){
        let $ = layui.jquery
            ,form  = layui.form
            ,layer = layui.layer;
        let txt = '实物';
        if(typ==2){
            txt = '服务';
        }else if(typ==3){
            txt = '增值服务';
        }
        let shiwu_idx = layer.confirm('确认要删除该'+txt+'描述？', {
            btn: ['确认','取消']
        }, function(){
            $(t).parent().prev().find('.layui-btn').show();
            $(t).parent().remove();
            layer.close(shiwu_idx);
        }, function(){

        });
    }

    //增值服务
    function value_add(t){
        let html = '<div class="valueadd_div">\n' +
            '           <input type="text" class="form-control w100" name="GoodsModel[valueadd_name][]" placeholder="请输入增值服务名称">\n' +
            '           <input type="text" class="form-control w300" name="GoodsModel[valueadd_desc][]" placeholder="请输入增值服务描述">\n' +
            '           <div class="layui-btn layui-btn-md layui-btn-danger fuwu_del" onclick="shiwu_del(this,3)">-</div>\n' +
            '           <div class="layui-btn layui-btn-md layui-btn-normal value_add" onclick="value_add(this)">+</div>\n' +
            '       </div>';
        $(t).parent().find('.layui-btn').hide();
        $(t).parents(":eq(1)").append(html);
    }
    //=== 2024-01-09 商品属性 END ===

    //获取下级区域
    function get_nextarea(t,type){
        if($(t).val() != 0){
            $.get("/goods/publish/getarea",{"val":$(t).val(),'type':type},function(res2){

                let html = '<div class="delivery_area2" style="display:inline-block;"><select name="GoodsModel[delivery_area2]" class="goodsmodel-value_desc form-control chosen-select">\n' +
                    '                                    <option value="0">-- 请选择市 --</option>\n';
                for(let i=0;i<res2.data.length;i++){
                    html += '<option value="'+res2.data[i].id+'">'+res2.data[i].code_name+'</option>'
                }
                html += '</select></div>';
                if($('.delivery_area2').length>0){
                    $('.delivery_area2').html(html);
                }else{
                    $('.area_div').append(html);
                }
                $('.chosen-select').chosen();//初始化chosen
            });
        }
    }

    //价格未含
    function noinclude_add(t){
        let currency_unit = $(t).parents(":eq(1)").find('td').eq(2).find('.chosen-select').val();
        let html = '<tr>\n' +
            '                                                        <td>\n' +
            '                                                            <input type="text" id="noinclude-name" class="layui-input" name="noinclude[name][]" data-anchor="费用名称" placeholder="费用名称">\n' +
            '                                                        </td>\n' +
            '                                                        <td>\n' +
            '                                                            <input type="text" id="noinclude-desc" class="layui-input" name="noinclude[desc][]" data-anchor="摘要描述" placeholder="摘要描述">\n' +
            '                                                        </td>\n' +
            '                                                        <td>\n' +
            '                                                            <select id="noinclude-currency" class="form-control chosen-select" name="noinclude[currency][]">\n';
        @foreach($currency as $k=>$v)
        if(currency_unit=="{{$v['id']}}"){
            html += '                                                              <option value="{{$v['id']}}" selected>{{$v['code_zhname']}}:{{$v['currency_symbol_origin']}}</option>\n';
        }else{
            html += '                                                              <option value="{{$v['id']}}">{{$v['code_zhname']}}:{{$v['currency_symbol_origin']}}</option>\n';
        }
        @endforeach
            html += '                                                    </select>\n' +
            '                                                        </td>\n' +
            '                                                        <td>\n' +
            '                                                            <input type="text" id="noinclude-price" class="layui-input" name="noinclude[price][]" data-anchor="计量单价" placeholder="计量单价">\n' +
            '                                                        </td>\n' +
            '                                                        <td style="width: 140px;">\n' +
            '                                                            <div class="layui-btn layui-btn-md layui-btn-danger" onclick="noinclude_del(this)">-</div>\n' +
            '                                                            <div class="layui-btn layui-btn-md layui-btn-normal" onclick="noinclude_add(this)">+</div>\n' +
            '                                                        </td>\n' +
            '                                                    </tr>';
        $(t).parent().hide();
        $('.noinclude_table').find('tbody').append(html);
        $('.chosen-select').chosen();//初始化chosen
    }

    function noinclude_del(t){
        let $ = layui.jquery
            ,form  = layui.form
            ,layer = layui.layer;

        let shiwu_idx = layer.confirm('确认要删除该费用？', {
            btn: ['确认','取消']
        }, function(){
            $(t).parents(":eq(1)").prev().find('td').eq(4).show();
            $(t).parents(":eq(1)").remove();
            layer.close(shiwu_idx);
        }, function(){

        });
    }

    //潜在价格
    function potential_add(t){
        let currency_unit = $(t).parents(":eq(1)").find('td').eq(0).find('.chosen-select').val();
        let currency_unit2 = $(t).parents(":eq(1)").find('td').eq(3).find('.chosen-select').val();
        let html = '<tr>\n' +
            '                                                    <td>\n' +
            '                                                        <select id="noinclude-currency" class="form-control chosen-select" name="potential[currency][]">\n';
        @foreach($currency as $k=>$v)
        if(currency_unit=="{{$v['id']}}") {
            html += '                                                                <option value="{{$v['id']}}" selected>{{$v['code_zhname']}}:{{$v['currency_symbol_origin']}}</option>\n';
        }else{
            html+='                                                                <option value="{{$v['id']}}">{{$v['code_zhname']}}:{{$v['currency_symbol_origin']}}</option>\n';
        }
        @endforeach
            html+='                                                  </select>\n' +
            '                                                    </td>\n' +
            '                                                    <td>\n' +
            '                                                        <input type="text" id="noinclude-name" class="layui-input" name="potential[name][]" data-anchor="费用名称" placeholder="费用名称">\n' +
            '                                                    </td>\n' +
            '                                                    <td>\n' +
            '                                                        <input type="text" id="noinclude-desc" class="layui-input" name="potential[desc][]" data-anchor="摘要描述" placeholder="摘要描述">\n' +
            '                                                    </td>\n' +
            '                                                    <td>\n' +
            '                                                        <select id="noinclude-currency" class="form-control chosen-select" name="potential[currency2][]">\n';
        @foreach($currency as $k=>$v)
        if(currency_unit2=="{{$v['id']}}") {
            html += '                                                                <option value="{{$v['id']}}" selected>{{$v['code_zhname']}}:{{$v['currency_symbol_origin']}}</option>\n';
        }else{
            html+='                                                                <option value="{{$v['id']}}">{{$v['code_zhname']}}:{{$v['currency_symbol_origin']}}</option>\n';
        }
        @endforeach
            html+='                                                  </select>\n' +
            '                                                    </td>\n' +
            '                                                    <td>\n' +
            '                                                        <input type="text" id="noinclude-price" class="layui-input" name="potential[price][]" data-anchor="计量单价" placeholder="计量单价">\n' +
            '                                                    </td>\n' +
            '                                                    <td style="width: 140px;">\n' +
            '                                                        <div class="layui-btn layui-btn-md layui-btn-danger" onclick="potential_del(this)">-</div>\n' +
            '                                                        <div class="layui-btn layui-btn-md layui-btn-normal" onclick="potential_add(this)">+</div>\n' +
            '                                                    </td>\n' +
            '                                                </tr>';

        $(t).parent().hide();
        $('.potential_table').find('tbody').append(html);
        $('.chosen-select').chosen();//初始化chosen
    }

    function potential_del(t){
        let $ = layui.jquery
            ,form  = layui.form
            ,layer = layui.layer;

        let shiwu_idx = layer.confirm('确认要删除该费用？', {
            btn: ['确认','取消']
        }, function(){
            $(t).parents(":eq(1)").prev().find('td').eq(5).show();
            $(t).parents(":eq(1)").remove();
            layer.close(shiwu_idx);
        }, function(){

        });
    }

    //销售优惠-减免
    function reduction_add(t){
        let tr_num = $(t).parents(':eq(2)').find('tr').length;
        let html = '<tr>\n' +
            '                                                                    <td>\n'+
            '                                                                       <select id="goodsmodel-preferential_blong" class="form-control chosen-select" name="reduction[preferential_blong][]">\n' +
            '                                                                            <option value="1">卖家优惠</option>\n' +
            '                                                                            <option value="2">平台优惠</option>\n' +
            '                                                                            <option value="3">他方优惠</option>\n' +
            '                                                                        </select>\n'+
            '                                                                    </td>\n'+
            '                                                                    <td>\n' +
            '                                                                        <select id="goodsmodel-reduction_type" class="form-control chosen-select" name="reduction[type][]" onchange="reduction_type(this,'+tr_num+')">\n' +
            '                                                                            <option value="">请选择规则</option>\n';
        @foreach($reduction_rule as $k=>$v)
            html+='                                                                           <option value="{{$v['id']}}" data-name1="{{$v['content'][0]}}" data-name2="{{$v['content'][2]}}">{{$v['name']}}</option>\n';
        @endforeach
            html+='                                                                   </select>\n' +
            '                                                                    </td>\n' +
            '                                                                    <td>\n' +
            '                                                                        <select id="goodsmodel-reduction_strict" class="form-control chosen-select" name="reduction[strict][]">\n' +
            '                                                                            <option value="1">单独</option>\n' +
            '                                                                            <option value="2">叠加</option>\n' +
            '                                                                        </select>\n' +
            '                                                                    </td>\n' +
            '                                                                    <td>\n' +
            '                                                                        <div class="name1"></div>\n' +
            '                                                                        <div class="currency_div">\n' +
            '                                                                            <select id="goodsmodel-reduction_currency1" class="form-control chosen-select reduction_currency common_currency" name="reduction[currency1]['+tr_num+'][]">\n' +
            '                                                                                <option value="">请选择币种</option>\n';
        @foreach($currency as $k=>$v)
            html+='                                                                                    <option value="{{$v['id']}}" @if($v['id']==5)\n' +
            '                                                                                    selected\n' +
            '                                                                                            @endif>{{$v['code_zhname']}}:{{$v['currency_symbol_origin']}}</option>\n';
        @endforeach
            html+='                                                                       </select>\n' +
            '                                                                        </div>\n' +
            '                                                                        <input type="number" class="layui-input" name="reduction[price1]['+tr_num+'][]" placeholder="数值">\n' +
            '                                                                        <div class="name2"></div>\n' +
            '                                                                        <div class="currency_div">\n' +
            '                                                                            <select id="goodsmodel-reduction_currency2" class="form-control chosen-select reduction_currency common_currency" name="reduction[currency2]['+tr_num+'][]">\n' +
            '                                                                                <option value="">请选择币种</option>\n';
        @foreach($currency as $k=>$v)
            html+='                                                                              <option value="{{$v['id']}}" @if($v['id']==5)\n' +
            '                                                                                        selected\n' +
            '                                                                                    @endif>{{$v['code_zhname']}}:{{$v['currency_symbol_origin']}}</option>\n';
        @endforeach
            html+='                                                                      </select>\n' +
            '                                                                        </div>\n' +
            '                                                                        <input type="number" class="layui-input" name="reduction[price2]['+tr_num+'][]" placeholder="数值">\n' +
            '                                                                    </td>\n' +
            '                                                                    <td style="width: 140px;">\n' +
            '                                                                        <div class="layui-btn layui-btn-md layui-btn-danger" onclick="reduction_del(this)">-</div>\n' +
            '                                                                        <div class="layui-btn layui-btn-md layui-btn-normal" onclick="reduction_add(this)">+</div>\n' +
            '                                                                    </td>\n' +
            '                                                                </tr>';

        $(t).parent().hide();
        $('.reduction_div').find('tbody').append(html);
        $('.chosen-select').chosen();//初始化chosen
    }

    function reduction_del(t){
        let $ = layui.jquery
            ,form  = layui.form
            ,layer = layui.layer;

        let shiwu_idx = layer.confirm('确认要删除该规则？', {
            btn: ['确认','取消']
        }, function(){
            $(t).parents(":eq(1)").prev().find('td').eq(4).show();
            $(t).parents(":eq(1)").remove();
            layer.close(shiwu_idx);
        }, function(){

        });
    }

    function reduction_type(t,num){
        let name1 = $(t).parent().find("option:selected").attr('data-name1');
        let name2 = $(t).parent().find("option:selected").attr('data-name2');
        $(t).parents(":eq(1)").find('td').eq(3).find('.name1').text(name1);
        $(t).parents(":eq(1)").find('td').eq(3).find('.name2').text(name2);
    }

    //销售优惠-随赠
    function gift_type(t){
        if($(t).val() == 1){
            $(t).parents(":eq(1)").find('.points_coupon_div').show();
            $(t).parents(":eq(1)").find('.points_div').show();
            $(t).parents(":eq(1)").find('.coupon_div').hide();
            $(t).parents(":eq(1)").find('.accgift_div').hide();
        }else if($(t).val() == 2){
            $(t).parents(":eq(1)").find('.points_coupon_div').show();
            $(t).parents(":eq(1)").find('.points_div').hide();
            $(t).parents(":eq(1)").find('.coupon_div').show();
            $(t).parents(":eq(1)").find('.accgift_div').hide();
        }else if($(t).val() == 3){
            $(t).parents(":eq(1)").find('.points_coupon_div').hide();
            $(t).parents(":eq(1)").find('.points_div').hide();
            $(t).parents(":eq(1)").find('.coupon_div').hide();
            $(t).parents(":eq(1)").find('.accgift_div').show();
        }
    }

    //随赠-按每
    function points_type(t){
        let val = $(t).val();

        if(val==1){
            $(t).parents(":eq(2)").find('.points_money').hide();
        }else if(val == 2){
            $(t).parents(":eq(2)").find('.points_money').show();
        }
    }

    //随赠添加
    function gift_add(t){
        let html = '<tr>\n' +
            '                                                                <td>\n' +
            '                                                                    <select id="goodsmodel-preferential_blong" class="form-control chosen-select" name="gift[preferential_blong][]">\n' +
            '                                                                        <option value="1">卖家优惠</option>\n' +
            '                                                                        <option value="2">平台优惠</option>\n' +
            '                                                                        <option value="3">他方优惠</option>\n' +
            '                                                                    </select>\n' +
            '                                                                </td>\n' +
            '                                                                <td>\n' +
            '                                                                    <select id="goodsmodel-gift_type" class="form-control chosen-select" name="gift[type][]" onchange="gift_type(this)">\n' +
            '                                                                        <option value="">请选择项目</option>\n' +
            '                                                                        <option value="1">积分</option>\n' +
            '                                                                        <option value="2">卡券</option>\n' +
            '                                                                        <option value="3">随赠</option>\n' +
            '                                                                    </select>\n' +
            '                                                                    <div class="points_coupon_div" style="display:none;">\n' +
            '                                                                        <div class="disf">\n' +
            '                                                                            运营商：<select id="goodsmodel-gift_operaer" class="form-control chosen-select" name="gift[operaer][]" onchange="gift_type(this)">\n' +
            '                                                                                <option value="1">平台</option>\n' +
            '                                                                                <option value="2">卖家</option>\n' +
            '                                                                                <option value="3">他方</option>\n' +
            '                                                                            </select>\n' +
            '                                                                        </div>\n' +
            '                                                                    </div>\n' +
            '                                                                    <div class="points_div" style="display: none;">\n' +
            '                                                                        <div class="disf">\n' +
            '                                                                            按每：<select id="goodsmodel-gift_operaer" class="form-control chosen-select" name="gift[points_type][]" onchange="points_type(this)">\n' +
            '                                                                                <option value="1">订单/次</option>\n' +
            '                                                                                <option value="2">金额</option>\n' +
            '                                                                            </select>\n' +
            '                                                                        </div>\n' +
            '                                                                        <div class="disf points_money" style="display: none;">\n' +
            '                                                                            <select id="goodsmodel-points_currency" class="form-control chosen-select points_currency common_currency" name="gift[points_currency][]">\n' +
            '                                                                                <option value="">请选择币种</option>\n';
        @foreach($currency as $k=>$v)
            html+='                                                                                    <option value="{{$v['id']}}" @if($v['id']==5)\n' +
            '                                                                                    selected\n' +
            '                                                                                            @endif>{{$v['code_zhname']}}:{{$v['currency_symbol_origin']}}</option>\n';
        @endforeach
            html+='                                                                      </select>\n' +
            '                                                                            <input type="number" class="layui-input" name="gift[points_money][]" placeholder="金额">\n' +
            '                                                                        </div>\n' +
            '                                                                        <div class="disf">\n' +
            '                                                                            送：<input type="number" class="layui-input" name="gift[points_send][]" placeholder="赠送值">\n' +
            '                                                                        </div>\n' +
            '                                                                    </div>\n' +
            '\n' +
            '                                                                    <div class="coupon_div" style="display: none;">\n' +
            '                                                                        <div class="disf">\n' +
            '                                                                            面值：<select id="goodsmodel-coupon_currency" class="form-control chosen-select coupon_currency common_currency" name="gift[coupon_currency][]">\n' +
            '                                                                                <option value="">请选择币种</option>\n';
        @foreach($currency as $k=>$v)
            html+='                                                                                    <option value="{{$v['id']}}" @if($v['id']==5)\n' +
            '                                                                                    selected\n' +
            '                                                                                            @endif>{{$v['code_zhname']}}:{{$v['currency_symbol_origin']}}</option>\n';
        @endforeach
            html+='                                                                      </select>\n' +
            '                                                                            <input type="number" class="layui-input" name="gift[coupon_money][]" placeholder="金额">\n' +
            '                                                                            <input type="number" class="layui-input" name="gift[coupon_num][]" placeholder="数量">\n' +
            '                                                                        </div>\n' +
            '                                                                    </div>\n' +
            '\n' +
            '                                                                    <div class="accgift_div" style="display: none;">\n' +
            '                                                                        <div class="disf">\n' +
            '                                                                            类别：<select id="goodsmodel-gift_operaer" class="form-control chosen-select" name="gift[accgift_type][]" onchange="accgift_type(this)">\n' +
            '                                                                                <option value="1">虚拟</option>\n' +
            '                                                                                <option value="2">服务</option>\n' +
            '                                                                                <option value="3">实物</option>\n' +
            '                                                                            </select>\n' +
            '                                                                            <input type="text" class="layui-input" name="gift[accgift_content][]" placeholder="内容">\n' +
            '                                                                            <input type="number" class="layui-input" name="gift[accgift_num][]" placeholder="数量">\n' +
            '                                                                        </div>\n' +
            '                                                                    </div>\n' +
            '                                                                </td>\n' +
            '                                                                <td>\n' +
            '                                                                    <select id="goodsmodel-gift_strict" class="form-control chosen-select" name="gift[strict][]">\n' +
            '                                                                        <option value="1">单独</option>\n' +
            '                                                                        <option value="2">叠加</option>\n' +
            '                                                                    </select>\n' +
            '                                                                </td>\n' +
            '                                                                <td style="width:140px;">\n' +
            '                                                                    <div class="layui-btn layui-btn-md layui-btn-danger" onclick="gift_del(this)">-</div>\n' +
            '                                                                    <div class="layui-btn layui-btn-md layui-btn-normal" onclick="gift_add(this)">+</div>\n' +
            '                                                                </td>\n' +
            '                                                            </tr>';

        $(t).parent().hide();
        $(t).parents(":eq(2)").append(html);
        $('.chosen-select').chosen();//初始化chosen
    }

    function gift_del(t){
        let $ = layui.jquery
            ,form  = layui.form
            ,layer = layui.layer;

        let shiwu_idx = layer.confirm('确认要删除该随赠项目？', {
            btn: ['确认','取消']
        }, function(){
            $(t).parents(":eq(1)").prev().find('td').eq(3).show();
            $(t).parents(":eq(1)").remove();
            layer.close(shiwu_idx);
        }, function(){

        });
    }

    //其他费用
    function otherfee_add(t){
        let html = '<tr>\n' +
            '                                                    <td>\n' +
            '                                                        <input type="text" id="other_fee-name" class="layui-input" name="other_fee[name][]" data-anchor="费用名称" placeholder="费用名称">\n' +
            '                                                    </td>\n' +
            '                                                    <td>\n' +
            '                                                        <input type="text" id="other_fee-name" class="layui-input" name="other_fee[desc][]" data-anchor="费用说明" placeholder="费用说明">\n' +
            '                                                    </td>\n' +
            '                                                    <td>\n' +
            '                                                        <select name="other_fee[standard][]" class="form-control chosen-select" id="other_fee-standard">\n' +
            '                                                            <option value="">请选择标准</option>\n' +
            '                                                            <option value="1">按订单数量</option>\n' +
            '                                                            <option value="2">按包裹数量</option>\n' +
            '                                                            <option value="3">按商品数量</option>\n' +
            '                                                            <option value="4">按服务次数</option>\n' +
            '                                                            <option value="5">按商品总价比率</option>\n' +
            '                                                        </select>\n' +
            '                                                    </td>\n' +
            '                                                    <td>\n' +
            '                                                        <div class="disf">\n' +
            '                                                            <select id="other_fee-currency" class="form-control chosen-select" name="other_fee[currency][]">\n';
        @foreach($currency as $k=>$v)
            html+='                                                                    <option value="{{$v['id']}}" @if($v['id'] == 5)\n' +
            '                                                                    selected\n' +
            '                                                                            @endif>{{$v['code_zhname']}}:{{$v['currency_symbol_origin']}}</option>\n';
        @endforeach
            html+='                                                      </select>\n' +
            '                                                            <input type="text" id="other_fee-price" class="layui-input" name="other_fee[price][]" placeholder="如选比率请输入0.000格式">\n' +
            '                                                        </div>\n' +
            '                                                    </td>\n' +
            '                                                    <td style="width: 140px;">\n' +
            '                                                        <div class="layui-btn layui-btn-md layui-btn-danger" onclick="otherfee_del(this)">-</div>\n' +
            '                                                        <div class="layui-btn layui-btn-md layui-btn-normal" onclick="otherfee_add(this)">+</div>\n' +
            '                                                    </td>\n' +
            '                                                </tr>';
        $(t).parent().hide();
        $(t).parents(":eq(2)").append(html);
        $('.chosen-select').chosen();//初始化chosen
    }

    function otherfee_del(t){
        let $ = layui.jquery
            ,form  = layui.form
            ,layer = layui.layer;

        let shiwu_idx = layer.confirm('确认要删除该费用？', {
            btn: ['确认','取消']
        }, function(){
            $(t).parents(":eq(1)").prev().find('td').eq(4).show();
            $(t).parents(":eq(1)").remove();
            layer.close(shiwu_idx);
        }, function(){

        });
    }
</script>
<!-- 表单验证 -->
<script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180418"></script>
<script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180418"></script>
<script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180418"></script>
<!-- AJAX上传 -->
<script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=<?php echo time();?>"></script>
<!-- 图片上传、图片空间 -->
<script src="/assets/d2eace91/js/jquery.widget.js?v=<?php echo time();?>"></script>
<script src="/assets/d2eace91/js/jquery-ui.js?v=20180418"></script>

<!--商品属性模板(废弃)-->
<script id="other_attrs_template" type='text/html'>
    <div class="simple-form-field other-attrs-item">
        <div class="form-group">
            <label class="col-sm-5 control-label" style="width:37%;">
                <div class="form-control-box">
                    <div class="value_div">
                        <label>
                            <select name="GoodsModel[value_name][]" class="goodsmodel-value_name form-control chosen-select" onchange="value_change(this)">
                                <option value="0">-- 请选择属性名称 --</option>
                                <option value="-1">自定义属性名称</option>
                                @foreach($goods_value as $k=>$v)
                                    <option value="{{$v['id']}}">{{$v['name']}}</option>
                                @endforeach
                            </select>
                        </label>
                    </div>
                    <input type="text" class="form-control w80 other-attr-name" name="other_attr_name[]" value="" placeholder="属性名" style="display: none;" onchange="check_valueName(this)"/>
                    ：
                </div>
            </label>

            <div class="col-sm-7" style="width: 63%;">
                <div class="form-control-box control-label">
                    <div class="value_desc" style="display: none;">
                        <label>

                        </label>
                    </div>
                    <input type="text" class="form-control w250 other-attr-value" name="other_attr_value[]" value="" placeholder="属性值，多个值间用英文逗号分割"  style="display: none;" onchange="desc_change(this)"/>
                    <a class="btn btn-danger btn-sm m-l-5 other-attr-remove">移除</a>
                </div>
            </div>
        </div>
    </div>
</script>

<script id="spec_other_value_template" type='text'>
    <label class="control-label">
        <input type="checkbox" value="" class="spec-value spec-other-value">
        <input type="text" name="other_spec[]" value="" placeholder="其他" maxlength="15" class="form-control form-control-xs w80 spec-other-text" data-rule-uniqueOtherSpecName="true">
    </label>
</script>

<!-- SKU表格头模板 -->
<script id="sku_th_template" type='text'>
    <th class="spec-th th_spec_id_#attr_id#">#attr_name#</th>
</script>
<!-- SKU模板 -->

<!-- SKU表格头模板 -->
<script id="sku_td_template" type='text'>
    <td class="spec-vname-td">
        <span class="spec-vname-label" data-attr-id="#attr_id#"></span>
        <input type="hidden" name="new_specs[attr_id#attr_id#][]" value="#attr_id#">
        <input type="hidden" name="new_specs[attr_vid#attr_vid#][]" value="#attr_vid#" class="" data-attr-id="#attr_vid#">
        <input type="hidden" name="new_specs[attr_vname#attr_vid#][]" value="#attr_vname#" class="" data-attr-id="#attr_vname#">
        <input type="hidden" name="new_specs[attr_desc#attr_vid#][]" value="" class="" data-attr-id="#attr_id#">
    </td>
</script>
<!-- SKU模板(废弃) -->
<script id="sku_table_template" type='text'>
    <td class="sku-td-index text-c"></td>
    <td colspan="3">
        <table class="spec_table" style="width:100%;text-align:center;">
            <tr>
                <td class="td_width">
                    <div class="disf">
                        <input type="number" name="specs222[start_num][#num#][]" value="1" class="form-control w50 start_num" placeholder="起始数值">
                        <select name="specs222[unit][#num#][]" class="form-control chosen-select unit" onchange="specs_unit(this)">
                            <option value="">请选择</option>
                            @foreach($unit as $k=>$v)
        <option value="{{$v['code_value']}}" data-title="{{$v['code_name']}}">{{$v['code_name']}}</option>
                            @endforeach
    </select>
    至
    <select name="specs222[select_end][#num#][]" class="form-control chosen-select " onchange="specs_selEnd(this)">
        <option value="1">数值</option>
        <option value="2">以上</option>
    </select>
    <input type="number" name="specs222[end_num][#num#][]" value="" class="form-control w50 end_num" placeholder="尾止数值">
    <div class="unit_name"></div>
</div>
</td>
<td class="td_width">
<select name="specs222[currency][#num#][]" class="form-control chosen-select currency" onchange="specs_currency(this)">
    <option value="">请选择</option>
@foreach($currency as $k=>$v)
        <option value="{{$v['id']}}" data-title="{{$v['currency_symbol_origin']}}" @if($v['id']==5)
            selected
@endif>{{$v['code_zhname']}}：{{$v['currency_symbol_origin']}}</option>
                        @endforeach
    </select>
    <input type="number" name="specs222[price][#num#][]" value="" class="form-control w70" placeholder="区间金额">
</td>
<td style="text-align:center;">
    <div class="layui-btn layui-btn-md layui-btn-normal addbtn" onclick="add_interval(this,#num#)">+</div>
</td>
</tr>
</table>
</td>
</script>
<!-- SKU模板 -->
<script id="sku_more_table_template" type='text'>
    <td class="sku-td-index more text-c"></td>
    <td>
        <input type="text" name="goods_stockcode" value="" class="form-control w90 sku-field">
    </td>
</script>
<!-- 阶梯价格模板 -->
<script id="step_price_tr_template" type='text'>
    <tr class="item">
        <td>
            购买
            <input class="form-control form-control-sm w70 m-l-10 m-r-10 step-number" type="text" onkeyup="this.value=this.value.replace(/[^0-9]+/,'')"  onafterpaste="this.value=this.value.replace(/[^0-9]+/,'')">
            <i class="pricing-mode">件</i>及以上，
        </td>
        <td>
        <input class="form-control form-control-sm w70 m-l-10 m-r-10 step-price" type="text" onkeyup="this.value=this.value.replace(/[^\d.]/g,'')"  onafterpaste="this.value=this.value.replace(/[^\d.]/g,'')">
            元
        </td>
        <td>
            <a class="btn btn-danger btn-sm c-fff del-step-price" href="javascript:void(0)">删除</a>
        </td>
    </tr>
</script>
<!-- 阶梯价格预览模板 -->
<script id="step_price_preview_template" type='text'>
    <tr>
        <td>
            销售规则<span class="sale-rule">一：</span>当商品购买数量为
            <strong class="m-l-5 m-r-5 preview-number"></strong>
            <i class="pricing-mode">件</i>
            时，售价为
            <strong class="c-yellow m-l-5 m-r-5 preview-price"></strong>
            元/
            <i class="pricing-mode">件</i>
        </td>
    </tr>
</script>

<!-- 验证规则 -->
<script id="client_rules" type="text">
[{"id": "goodsmodel-cat_id1", "name": "GoodsModel[cat_id1]", "attribute": "cat_id1", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Cat Id1必须是整数。"}}},{"id": "goodsmodel-cat_id2", "name": "GoodsModel[cat_id2]", "attribute": "cat_id2", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Cat Id2必须是整数。"}}},{"id": "goodsmodel-cat_id3", "name": "GoodsModel[cat_id3]", "attribute": "cat_id3", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Cat Id3必须是整数。"}}},{"id": "goodsmodel-pricing_mode", "name": "GoodsModel[pricing_mode]", "attribute": "pricing_mode", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"计价方式必须是整数。"}}},{"id": "goodsmodel-goods_unit", "name": "GoodsModel[goods_unit]", "attribute": "goods_unit", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品单位必须是整数。"}}},{"id": "goodsmodel-filter_attr_ids", "name": "GoodsModel[filter_attr_ids]", "attribute": "filter_attr_ids", "rules": {"string":true,"messages":{"string":"Filter Attr Ids必须是一条字符串。"}}},{"id": "goodsmodel-filter_attr_vids", "name": "GoodsModel[filter_attr_vids]", "attribute": "filter_attr_vids", "rules": {"string":true,"messages":{"string":"Filter Attr Vids必须是一条字符串。"}}},{"id": "goodsmodel-goods_stockcode", "name": "GoodsModel[goods_stockcode]", "attribute": "goods_stockcode", "rules": {"string":true,"messages":{"string":"商品库位码必须是一条字符串。"}}},{"id": "goodsmodel-goods_name", "name": "GoodsModel[goods_name]", "attribute": "goods_name", "rules": {"required":true,"messages":{"required":"商品名称不能为空。"}}},{"id": "goodsmodel-cat_id", "name": "GoodsModel[cat_id]", "attribute": "cat_id", "rules": {"required":true,"messages":{"required":"商品分类不能为空。"}}},{"id": "goodsmodel-shop_id", "name": "GoodsModel[shop_id]", "attribute": "shop_id", "rules": {"required":true,"messages":{"required":"店铺ID不能为空。"}}},{"id": "goodsmodel-goods_price", "name": "GoodsModel[goods_price]", "attribute": "goods_price", "rules": {"required":true,"messages":{"required":"店铺价不能为空。"}}},{"id": "goodsmodel-goods_number", "name": "GoodsModel[goods_number]", "attribute": "goods_number", "rules": {"required":true,"messages":{"required":"商品库存不能为空。"}}},{"id": "goodsmodel-add_time", "name": "GoodsModel[add_time]", "attribute": "add_time", "rules": {"required":true,"messages":{"required":"商品发布时间不能为空。"}}},{"id": "goodsmodel-last_time", "name": "GoodsModel[last_time]", "attribute": "last_time", "rules": {"required":true,"messages":{"required":"最后一次更新时间不能为空。"}}},{"id": "goodsmodel-freight_id", "name": "GoodsModel[freight_id]", "attribute": "freight_id", "rules": {"required":false,"messages":{"required":"运费模板不能为空。"}}},{"id": "goodsmodel-sku_open", "name": "GoodsModel[sku_open]", "attribute": "sku_open", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Sku Open必须是整数。"}}},{"id": "goodsmodel-sku_id", "name": "GoodsModel[sku_id]", "attribute": "sku_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Sku Id必须是整数。"}}},{"id": "goodsmodel-cat_id", "name": "GoodsModel[cat_id]", "attribute": "cat_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品分类必须是整数。"}}},{"id": "goodsmodel-shop_id", "name": "GoodsModel[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"店铺ID必须是整数。"}}},{"id": "goodsmodel-invoice_type", "name": "GoodsModel[invoice_type]", "attribute": "invoice_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"发票必须是整数。"}}},{"id": "goodsmodel-is_repair", "name": "GoodsModel[is_repair]", "attribute": "is_repair", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"保修必须是整数。"}}},{"id": "goodsmodel-user_discount", "name": "GoodsModel[user_discount]", "attribute": "user_discount", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"会员打折必须是整数。"}}},{"id": "goodsmodel-stock_mode", "name": "GoodsModel[stock_mode]", "attribute": "stock_mode", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"库存计数必须是整数。"}}},{"id": "goodsmodel-goods_number", "name": "GoodsModel[goods_number]", "attribute": "goods_number", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品库存必须是整数。"}}},{"id": "goodsmodel-warn_number", "name": "GoodsModel[warn_number]", "attribute": "warn_number", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"库存警告数量必须是整数。"}}},{"id": "goodsmodel-brand_id", "name": "GoodsModel[brand_id]", "attribute": "brand_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"品牌必须是整数。"}}},{"id": "goodsmodel-top_layout_id", "name": "GoodsModel[top_layout_id]", "attribute": "top_layout_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品顶部模板编号必须是整数。"}}},{"id": "goodsmodel-bottom_layout_id", "name": "GoodsModel[bottom_layout_id]", "attribute": "bottom_layout_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品底部模板编号必须是整数。"}}},{"id": "goodsmodel-packing_layout_id", "name": "GoodsModel[packing_layout_id]", "attribute": "packing_layout_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Packing Layout Id必须是整数。"}}},{"id": "goodsmodel-service_layout_id", "name": "GoodsModel[service_layout_id]", "attribute": "service_layout_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Service Layout Id必须是整数。"}}},{"id": "goodsmodel-click_count", "name": "GoodsModel[click_count]", "attribute": "click_count", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品浏览次数必须是整数。"}}},{"id": "goodsmodel-goods_audit", "name": "GoodsModel[goods_audit]", "attribute": "goods_audit", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"审核是否通过必须是整数。"}}},{"id": "goodsmodel-goods_status", "name": "GoodsModel[goods_status]", "attribute": "goods_status", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品状态必须是整数。"}}},{"id": "goodsmodel-is_delete", "name": "GoodsModel[is_delete]", "attribute": "is_delete", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否已删除必须是整数。"}}},{"id": "goodsmodel-is_virtual", "name": "GoodsModel[is_virtual]", "attribute": "is_virtual", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Is Virtual必须是整数。"}}},{"id": "goodsmodel-is_best", "name": "GoodsModel[is_best]", "attribute": "is_best", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否精品必须是整数。"}}},{"id": "goodsmodel-is_new", "name": "GoodsModel[is_new]", "attribute": "is_new", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否新品必须是整数。"}}},{"id": "goodsmodel-is_hot", "name": "GoodsModel[is_hot]", "attribute": "is_hot", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否热卖必须是整数。"}}},{"id": "goodsmodel-is_promote", "name": "GoodsModel[is_promote]", "attribute": "is_promote", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否促销必须是整数。"}}},{"id": "goodsmodel-supplier_id", "name": "GoodsModel[supplier_id]", "attribute": "supplier_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"供货商ID必须是整数。"}}},{"id": "goodsmodel-freight_id", "name": "GoodsModel[freight_id]", "attribute": "freight_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"运费模板必须是整数。"}}},{"id": "goodsmodel-goods_sort", "name": "GoodsModel[goods_sort]", "attribute": "goods_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Goods Sort必须是整数。"}}},{"id": "goodsmodel-audit_time", "name": "GoodsModel[audit_time]", "attribute": "audit_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Audit Time必须是整数。"}}},{"id": "goodsmodel-add_time", "name": "GoodsModel[add_time]", "attribute": "add_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品发布时间必须是整数。"}}},{"id": "goodsmodel-last_time", "name": "GoodsModel[last_time]", "attribute": "last_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"最后一次更新时间必须是整数。"}}},{"id": "goodsmodel-comment_num", "name": "GoodsModel[comment_num]", "attribute": "comment_num", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品评论次数必须是整数。"}}},{"id": "goodsmodel-sale_num", "name": "GoodsModel[sale_num]", "attribute": "sale_num", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品销售数量必须是整数。"}}},{"id": "goodsmodel-collect_num", "name": "GoodsModel[collect_num]", "attribute": "collect_num", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品收藏数量必须是整数。"}}},{"id": "goodsmodel-sales_model", "name": "GoodsModel[sales_model]", "attribute": "sales_model", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"销售模式必须是整数。"}}},{"id": "goodsmodel-goods_images", "name": "GoodsModel[goods_images]", "attribute": "goods_images", "rules": {"string":true,"messages":{"string":"Goods Images必须是一条字符串。"}}},{"id": "goodsmodel-button_name", "name": "GoodsModel[button_name]", "attribute": "button_name", "rules": {"string":true,"messages":{"string":"按钮名称必须是一条字符串。"}}},{"id": "goodsmodel-button_url", "name": "GoodsModel[button_url]", "attribute": "button_url", "rules": {"string":true,"messages":{"string":"按钮链接必须是一条字符串。"}}},{"id": "goodsmodel-goods_price", "name": "GoodsModel[goods_price]", "attribute": "goods_price", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"店铺价必须是一个数字。","decimal":"店铺价必须是一个不大于2位小数的数字。","min":"店铺价必须不小于0。","max":"店铺价必须不大于9999999。"},"decimal":2,"min":0,"max":9999999}},{"id": "goodsmodel-market_price", "name": "GoodsModel[market_price]", "attribute": "market_price", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"市场价必须是一个数字。","decimal":"市场价必须是一个不大于2位小数的数字。","min":"市场价必须不小于0。","max":"市场价必须不大于9999999。"},"decimal":2,"min":0,"max":9999999}},{"id": "goodsmodel-goods_sort", "name": "GoodsModel[goods_sort]", "attribute": "goods_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Goods Sort必须是整数。","min":"Goods Sort必须不小于0。","max":"Goods Sort必须不大于9999。"},"min":0,"max":9999}},{"id": "goodsmodel-warn_number", "name": "GoodsModel[warn_number]", "attribute": "warn_number", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"库存警告数量必须是整数。","min":"库存警告数量必须不小于0。","max":"库存警告数量必须不大于255。"},"min":0,"max":255}},{"id": "goodsmodel-goods_number", "name": "GoodsModel[goods_number]", "attribute": "goods_number", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品库存必须是整数。","min":"商品库存必须不小于0。","max":"商品库存必须不大于999999999。"},"min":0,"max":999999999}},{"id": "goodsmodel-cost_price", "name": "GoodsModel[cost_price]", "attribute": "cost_price", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"成本价必须是一个数字。","decimal":"成本价必须是一个不大于2位小数的数字。","min":"成本价必须不小于0。","max":"成本价必须不大于9999999。"},"decimal":2,"min":0,"max":9999999}},{"id": "goodsmodel-mobile_price", "name": "GoodsModel[mobile_price]", "attribute": "mobile_price", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"移动端专项价必须是一个数字。","decimal":"移动端专项价必须是一个不大于2位小数的数字。","min":"移动端专项价必须不小于0。","max":"移动端专项价必须不大于9999999。"},"decimal":2,"min":0,"max":9999999}},{"id": "goodsmodel-pc_desc", "name": "GoodsModel[pc_desc]", "attribute": "pc_desc", "rules": {"string":true,"messages":{"string":"商品电脑端描述必须是一条字符串。"}}},{"id": "goodsmodel-mobile_desc", "name": "GoodsModel[mobile_desc]", "attribute": "mobile_desc", "rules": {"string":true,"messages":{"string":"商品手机端描述必须是一条字符串。"}}},{"id": "goodsmodel-contract_ids", "name": "GoodsModel[contract_ids]", "attribute": "contract_ids", "rules": {"string":true,"messages":{"string":"保障服务必须是一条字符串。"}}},{"id": "goodsmodel-goods_name", "name": "GoodsModel[goods_name]", "attribute": "goods_name", "rules": {"string":true,"messages":{"string":"商品名称必须是一条字符串。","minlength":"商品名称应该包含至少1个字符。","maxlength":"商品名称只能包含至多60个字符。"},"minlength":1,"maxlength":60}},{"id": "goodsmodel-goods_subname", "name": "GoodsModel[goods_subname]", "attribute": "goods_subname", "rules": {"string":true,"messages":{"string":"商品卖点必须是一条字符串。","maxlength":"商品卖点只能包含至多140个字符。"},"maxlength":140}},{"id": "goodsmodel-goods_image", "name": "GoodsModel[goods_image]", "attribute": "goods_image", "rules": {"string":true,"messages":{"string":"商品主图必须是一条字符串。","maxlength":"商品主图只能包含至多255个字符。"},"maxlength":255}},{"id": "goodsmodel-goods_video", "name": "GoodsModel[goods_video]", "attribute": "goods_video", "rules": {"string":true,"messages":{"string":"主图视频必须是一条字符串。","maxlength":"主图视频只能包含至多255个字符。"},"maxlength":255}},{"id": "goodsmodel-keywords", "name": "GoodsModel[keywords]", "attribute": "keywords", "rules": {"string":true,"messages":{"string":"关键词必须是一条字符串。","maxlength":"关键词只能包含至多255个字符。"},"maxlength":255}},{"id": "goodsmodel-goods_info", "name": "GoodsModel[goods_info]", "attribute": "goods_info", "rules": {"string":true,"messages":{"string":"商品简介必须是一条字符串。","maxlength":"商品简介只能包含至多255个字符。"},"maxlength":255}},{"id": "goodsmodel-goods_reason", "name": "GoodsModel[goods_reason]", "attribute": "goods_reason", "rules": {"string":true,"messages":{"string":"Goods Reason必须是一条字符串。","maxlength":"Goods Reason只能包含至多255个字符。"},"maxlength":255}},{"id": "goodsmodel-goods_volume", "name": "GoodsModel[goods_volume]", "attribute": "goods_volume", "rules": {"string":true,"messages":{"string":"物流体积(m3)必须是一条字符串。","maxlength":"物流体积(m3)只能包含至多255个字符。"},"maxlength":255}},{"id": "goodsmodel-goods_weight", "name": "GoodsModel[goods_weight]", "attribute": "goods_weight", "rules": {"string":true,"messages":{"string":"物流重量(Kg)必须是一条字符串。","maxlength":"物流重量(Kg)只能包含至多255个字符。"},"maxlength":255}},{"id": "goodsmodel-goods_remark", "name": "GoodsModel[goods_remark]", "attribute": "goods_remark", "rules": {"string":true,"messages":{"string":"商品备注必须是一条字符串。","maxlength":"商品备注只能包含至多255个字符。"},"maxlength":255}},{"id": "goodsmodel-goods_sn", "name": "GoodsModel[goods_sn]", "attribute": "goods_sn", "rules": {"string":true,"messages":{"string":"商品货号必须是一条字符串。","maxlength":"商品货号只能包含至多60个字符。"},"maxlength":60}},{"id": "goodsmodel-goods_barcode", "name": "GoodsModel[goods_barcode]", "attribute": "goods_barcode", "rules": {"string":true,"messages":{"string":"商品条形码必须是一条字符串。","maxlength":"商品条形码只能包含至多1,500个字符。"},"maxlength":1500}},{"id": "goodsmodel-invoice_type", "name": "GoodsModel[invoice_type]", "attribute": "invoice_type", "rules": {"in":{"range":["0","1","2","3"]},"messages":{"in":"发票是无效的。"}}},{"id": "goodsmodel-is_repair", "name": "GoodsModel[is_repair]", "attribute": "is_repair", "rules": {"in":{"range":["0","1"]},"messages":{"in":"保修是无效的。"}}},{"id": "goodsmodel-user_discount", "name": "GoodsModel[user_discount]", "attribute": "user_discount", "rules": {"in":{"range":["0","1"]},"messages":{"in":"会员打折是无效的。"}}},{"id": "goodsmodel-stock_mode", "name": "GoodsModel[stock_mode]", "attribute": "stock_mode", "rules": {"in":{"range":["0","1","2"]},"messages":{"in":"库存计数是无效的。"}}},{"id": "goodsmodel-goods_status", "name": "GoodsModel[goods_status]", "attribute": "goods_status", "rules": {"in":{"range":["0","1","2"]},"messages":{"in":"商品状态是无效的。"}}},{"id": "goodsmodel-goods_freight_type", "name": "GoodsModel[goods_freight_type]", "attribute": "goods_freight_type", "rules": {"in":{"range":["0","1","2"]},"messages":{"in":"运费设置是无效的。"}}},{"id": "goodsmodel-goods_freight_fee", "name": "GoodsModel[goods_freight_fee]", "attribute": "goods_freight_fee", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"商品固定运费必须是一个数字。","decimal":"商品固定运费必须是一个不大于2位小数的数字。","min":"商品固定运费必须不小于0。","max":"商品固定运费必须不大于9999999。"},"decimal":2,"min":0,"max":9999999}},{"id": "goodsmodel-goods_sn", "name": "GoodsModel[goods_sn]", "attribute": "goods_sn", "rules": {"string":true,"messages":{"string":"商品货号必须是一条字符串。","maxlength":"商品货号只能包含至多20个字符。"},"maxlength":20}},{"id": "goodsmodel-goods_barcode", "name": "GoodsModel[goods_barcode]", "attribute": "goods_barcode", "rules": {"string":true,"messages":{"string":"商品条形码必须是一条字符串。","maxlength":"商品条形码只能包含至多1,500个字符。"},"maxlength":1500}},{"id": "goodsmodel-goods_moq", "name": "GoodsModel[goods_moq]", "attribute": "goods_moq", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"最小起订量必须是整数。","min":"最小起订量必须不小于1。"},"min":1}},{"id": "goodsmodel-button_name", "name": "GoodsModel[button_name]", "attribute": "button_name", "rules": {"string":true,"messages":{"string":"按钮名称必须是一条字符串。"}}},{"id": "goodsmodel-button_url", "name": "GoodsModel[button_url]", "attribute": "button_url", "rules": {"string":true,"messages":{"string":"按钮链接必须是一条字符串。"}}},{"id": "goodsmodel-goods_freight_fee", "name": "GoodsModel[goods_freight_fee]", "attribute": "goods_freight_fee", "rules": {"required":true,"messages":{"required":"商品固定运费不能为空。"}}},{"id": "goodsmodel-freight_id", "name": "GoodsModel[freight_id]", "attribute": "freight_id", "rules": {"compare":{"operator":">","type":"number","compareValue":0,"skipOnEmpty":1},"messages":{"compare":"运费模板不能为空"},"when":"function(){console.info($('.goods-freight-type:checked').val());return $('.goods-freight-type:checked').val() == 2;}"}},{"id": "goodsmodel-effective_type", "name": "GoodsModel[effective_type]", "attribute": "effective_type", "rules": {"required":true,"messages":{"required":"兑换生效期不能为空。"}}},{"id": "goodsmodel-valid_period_type", "name": "GoodsModel[valid_period_type]", "attribute": "valid_period_type", "rules": {"required":true,"messages":{"required":"使用有效期不能为空。"}}},{"id": "goodsmodel-is_expired_refund", "name": "GoodsModel[is_expired_refund]", "attribute": "is_expired_refund", "rules": {"required":true,"messages":{"required":"支持过期退款不能为空。"}}},{"id": "goodsmodel-buy_limit", "name": "GoodsModel[buy_limit]", "attribute": "buy_limit", "rules": {"required":true,"messages":{"required":"电子卡券购买上限不能为空。"}}},{"id": "goodsmodel-effective_hour", "name": "GoodsModel[effective_hour]", "attribute": "effective_hour", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Effective Hour必须是整数。"}}},{"id": "goodsmodel-valid_period_hour", "name": "GoodsModel[valid_period_hour]", "attribute": "valid_period_hour", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Valid Period Hour必须是整数。"}}},{"id": "goodsmodel-buy_limit", "name": "GoodsModel[buy_limit]", "attribute": "buy_limit", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"电子卡券购买上限必须是整数。","min":"电子卡券购买上限必须不小于1。","max":"电子卡券购买上限必须不大于10。"},"min":1,"max":10}},]
</script>
<script type='text/javascript'>
    //初始化规格排序
    function initSpecSortable() {
        // 商品规格排序
        $('#dropzone').droppable({
            activeClass: 'active',
            hoverClass: 'hover',
            accept: ":not(.ui-sortable-helper)", // Reject clones generated by sortable
            drop: function(e, ui) {
                var $el = $('<div class="drop-item">' + ui.draggable.text() + '</div>');
                $el.append($('<a class="delete-btn"></a><fa class="fa fa-times-circle"></fa>').click(function() {
                    $(this).parent().detach();
                }));
                $(this).append($el);
            }
        }).sortable({
            items: '.drop-item',
            // 排序之前必须拖拽的像素数
            distance: 5,
            //axis: "y",
            opacity: 0.8,
            scroll: true,
            scrollSensitivity: 63,
            start: function(event, ui) {
                $(this).removeClass("active");
            },
            update: function(event, ui) {
                // 重新计算
                evalSkuTable().always(function() {
                    // 停止缓载
                    $.loading.stop();
                });
            }
        });
    }

    $().ready(function() {
        $("[data-toggle='popover']").popover();

        //===2024-01-09 START===
        //物流分类
        $('#goodsmodel_logistics_cate_chosen').click(function(){
            let t = this;
            let txt = $(t).find('.chosen-single span').text();
            if(txt == '（发货国地的）境内配送'){
                $('#goodsmodel-service_type').find('option').eq(0).attr('selected','selected');
                $("#goodsmodel-service_type").trigger("chosen:updated");
                $('.domestic_logi').css('display','inline-block');
                $('.domestic_baoyou').css('display','inline-block');
                $('.cross_logi').hide();
                $('.cross_logi-div').hide();
                $('.cross_logi_cate').hide();
                $('.logi_value').hide();
                // if($('#goodsmodel_service_type_chosen').find('.chosen-single span').text() == '（发货国地的）境内配送' && $('#goodsmodel_domestic_type_chosen').find('.chosen-single span').text() == '支持'){
                //     $('.cross_logi_cate').hide();
                // }else{
                //     layer.msg('请先选择服务支持：境内配送');
                //     $('#goodsmodel-logistics_cate').find('option').eq(0).attr('selected',false);
                //     $('#goodsmodel-logistics_cate').find('option').eq(1).attr('selected','selected');
                //     $("#goodsmodel-logistics_cate").trigger("chosen:updated");
                //     return false;
                // }
            }else if(txt == '（发货国地的）跨境集运'){
                $('#goodsmodel-service_type').find('option').eq(1).attr('selected','selected');
                $("#goodsmodel-service_type").trigger("chosen:updated");
                $('.domestic_logi').hide();
                $('.domestic_baoyou').hide();
                $('.cross_logi').css('display','inline-block');
                $('.cross_logi-div').show();
                $('.cross_logi_cate').show();
                $('.logi_value').show();
                // if($('#goodsmodel_service_type_chosen').find('.chosen-single span').text() == '（发货国地的）跨境集运' && $('#goodsmodel_cross_logi_chosen').find('.chosen-single span').text() == '支持'){
                //     $('.cross_logi_cate').show();
                // }else{
                //     layer.msg('请先选择服务支持：跨境集运');
                //     $('#goodsmodel-logistics_cate').find('option').eq(0).attr('selected','selected');
                //     $('#goodsmodel-logistics_cate').find('option').eq(1).attr('selected',false);
                //     $("#goodsmodel-logistics_cate").trigger("chosen:updated");
                //     return false;
                // }
            }
        });

        //发货国地
        let delivery_location = xmSelect.render({
            el: '#delivery_location',
            autoRow: true, //自动换行
            filterable: true, //可搜索
            searchTips: '请搜索',
            radio: true,
            name: "GoodsModel[delivery_location]",
            model: {
                icon: 'hidden',//是否展示复选框或者单选框图标 show, hidden:变换背景色  ！！这句话是重点，不然会变成父节点也有单选框！！
                label: {
                    type: 'block',
                    block: {
                        //最大显示数量, 0:不限制
                        showCount: 1,
                        //是否显示删除图标
                        showIcon: true,
                    }
                },
            },
            prop:{
                name: 'name',
                value: 'value',
            },
            tree: {
                show: true, //用树显示
                showFolderIcon: true, //是否显示节点前的三角图标
                expandedKeys: false, //默认全部展开
                showLine: true, //显示渐近线
                indent: 20, //间距
                strict: false, //重点！！设置成非严格父子模式，这样父节点被禁用，子节点依然可以点击
                clickCheck: true,
                vaguaSearch:0,//关闭模糊搜索
            },
            toolbar: {
                show: false, //显示工具条
                list: ['ALL', 'REVERSE', 'CLEAR']
            },
            height: '300px', //最大下拉框高度
            data: {!! $all_country !!},
            initValue:[],
            on:function(res){
                if(res.isAdd==true){
                    $.get("/goods/publish/getarea",{"val":res.change[0].id,'type':1},function(res2){

                        let html = '<div style="display:inline-block;"><select name="GoodsModel[delivery_area1]" class="goodsmodel-value_desc form-control chosen-select" onchange="get_nextarea(this,2)">\n' +
                            '                                    <option value="0">-- 请选择省/州 --</option>\n';
                        for(let i=0;i<res2.data.length;i++){
                            html += '<option value="'+res2.data[i].id+'">'+res2.data[i].code_name+'</option>'
                        }
                        html += '</select></div>';
                        $('.area_div').html(html);
                        $('.chosen-select').chosen();//初始化chosen
                    });
                }
            }
        });

        //跨境物流分类
        $('#goodsmodel_crossb_cate_chosen').click(function(){
            let t = this;
            let txt = $(t).find('.chosen-single span').text();
            if(txt == '禁限货物'){
                $('.prohibit_div').css('display','inline-block');
            }else{
                $('.prohibit_div').hide();
            }
        });

        //禁限类别-禁止（其“跨境限制”的“贸易限制”等默认“禁止出口”）
        $('#goodsmodel_prohibit_cate_chosen').click(function(){
            let t = this;
            let txt = $(t).find('.chosen-single span').text();
            if(txt=='禁止'){
                // $('.goodsmodel_is_export_chosen').chosen({"no_results_text":'否'});//初始化chosen
                $("#goodsmodel-is_export").val(2);
                $("#goodsmodel-is_export").attr('readonly',true);
                $("#goodsmodel-is_export").trigger("chosen:updated");
                $("#goodsmodel-is_gather").val(2);
                $("#goodsmodel-is_gather").attr('readonly',true);
                $("#goodsmodel-is_gather").trigger("chosen:updated");
                $("#goodsmodel-is_outcurrency").val(2);
                $("#goodsmodel-is_outcurrency").attr('readonly',true);
                $("#goodsmodel-is_outcurrency").trigger("chosen:updated");
            }else{
                $("#goodsmodel-is_export").attr('readonly',false);
                $("#goodsmodel-is_export").trigger("chosen:updated");
                $("#goodsmodel-is_gather").attr('readonly',false);
                $("#goodsmodel-is_gather").trigger("chosen:updated");
                $("#goodsmodel-is_outcurrency").attr('readonly',false);
                $("#goodsmodel-is_outcurrency").trigger("chosen:updated");
            }
        });

        //商品品牌
        $('#brand_type_chosen').click(function(){
            let t = this;
            let txt = $(t).find('.chosen-single span').text();
            if(txt == '有牌'){
                $('.brand_div').css('display','inline-block');
            }else{
                $('.brand_div').hide();
            }
        });

        //自定义品牌
        // $('#brand_id_chosen').click(function(){
        //     let t = this;
        //     let txt = $(t).find('.chosen-single span').text();
        //     if(txt == '自定义品牌'){
        //         $('#goodsmodel-brandname').css('display','inline-block');
        //     }else{
        //         let html = '<div class="note">'+txt+'</div><input name="GoodsModel[shihe_changwei][brandname][]" value="'+txt+'" style="display:none;">';
        //         $('.brand_promote').find('.form-control-box').html(html);
        //         $('#goodsmodel-brandname').hide();
        //     }
        // });
        $('#goodsmodel-brandname').change(function(){
            let html = '<div class="note">'+$(this).val()+'</div><input name="GoodsModel[shihe_changwei][brandname][]" value="'+$(this).val()+'" style="display:none;">';
            $('.brand_promote').find('.form-control-box').html(html);
        });

        //服务支持-跨境集运/境内配送
        $('#goodsmodel_service_type_chosen').click(function(){
            let t = this;
            let txt = $(t).find('.chosen-single span').text();
            if(txt == '（发货国地的）境内配送'){
                $('.domestic_logi').css('display','inline-block');
                $('.domestic_baoyou').css('display','inline-block');
                $('.cross_logi').css('display','none');
                $('.cross_logi-div').hide();
            }else if(txt == '（发货国地的）跨境集运'){
                $('.domestic_logi').css('display','none');
                $('.domestic_baoyou').css('display','none');
                $('.cross_logi').css('display','inline-block');
                $('.cross_logi-div').show();
            }
        });

        //境内配送-支持
        $('#goodsmodel_domestic_type_chosen').click(function(){
            let t = this;
            let txt = $(t).find('.chosen-single span').text();
            if(txt == '支持'){
                $('.domestic_baoyou').css('display','inline-block');
            }else{
                $('.domestic_baoyou').hide();
            }
        });

        //跨境集运-支持
        $('#goodsmodel_cross_logi_chosen').click(function(){
            let t = this;
            let txt = $(t).find('.chosen-single span').text();
            if(txt == '支持'){
                $('.cross_logi-div').show();
            }else{
                $('.cross_logi-div').hide();
            }
        });

        //跨境集运-当地配送
        $('#goodsmodel_cross_logi_peisong_chosen').click(function(){
            let t = this;
            let txt = $(t).find('.chosen-single span').text();
            if(txt == '配送到门'){
                $('.daomen').css('display','inline-block');
                $('.daocang').hide();
            }else if(txt == '配送到仓'){
                $('.daomen').hide();
                $('.daocang').css('display','inline-block');
            }else{
                $('.daomen').hide();
                $('.daocang').hide();
            }
        });

        //商品名称
        $('#goodsmodel-goods_name').change(function(){
            let html = '<div class="note">'+$(this).val()+'</div><input name="GoodsModel[shihe_changwei][goodsname][]" value="'+$(this).val()+'" style="display:none;">';
            $('.gname_promote').find('.form-control-box').html(html);
        });

        //支持出口国家
        let export_country = xmSelect.render({
            el: '#export_country',
            autoRow: true, //自动换行
            filterable: true, //可搜索
            searchTips: '请搜索',
            radio: false,
            name: "GoodsModel[export_country]",
            model: {
                icon: 'hidden',//是否展示复选框或者单选框图标 show, hidden:变换背景色  ！！这句话是重点，不然会变成父节点也有单选框！！
                label: {
                    type: 'block',
                    block: {
                        //最大显示数量, 0:不限制
                        showCount: 1,
                        //是否显示删除图标
                        showIcon: true,
                    }
                },
            },
            prop:{
                name: 'name',
                value: 'value',
            },
            tree: {
                show: true, //用树显示
                showFolderIcon: true, //是否显示节点前的三角图标
                expandedKeys: false, //默认全部展开
                showLine: true, //显示渐近线
                indent: 20, //间距
                strict: false, //重点！！设置成非严格父子模式，这样父节点被禁用，子节点依然可以点击
                clickCheck: true,
                vaguaSearch:0,//关闭模糊搜索
            },
            toolbar: {
                show: false, //显示工具条
                list: ['ALL', 'REVERSE', 'CLEAR']
            },
            height: '300px', //最大下拉框高度
            data: {!! $all_country !!},
            initValue:[],
        });

        //支持出口与否
        $('#goodsmodel_is_export_chosen').click(function(){
            let t = this;
            let txt = $(t).find('.chosen-single span').text();
            if(txt=='是'){
                $('.support_export').text('支持');
                xmSelect.batch('#export_country', 'update', {
                    disabled: false
                });
            }else{
                $('.support_export').text('不支持');
                export_country.setValue([ ]);
                xmSelect.batch('#export_country', 'update', {
                    disabled: true
                });
            }
        });

        //支持外币结算
        $('#goodsmodel_is_outcurrency_chosen').click(function(){
            let t = this;
            let txt = $(t).find('.chosen-single span').text();
            if(txt=='支持外币结算') {
                $('.support_currency').text(' 本币聚合支付、外币聚合支付');
            }else{
                $('.support_currency').text(' 本币聚合支付');
            }
        });

        //有无规格
        $('#have_specs_chosen').click(function(){
            let t = this;
            let txt = $(t).find('.chosen-single span').text();
            if(txt=='有规格型号'){
                $('.have_specs').show();
                $('.nohave_specs').hide();
            }else{
                $('.have_specs').hide();
                $('.nohave_specs').show();
            }
        });

        //包邮方式
        let bao_you = xmSelect.render({
            el: '#bao_you',
            autoRow: true, //自动换行
            filterable: true, //可搜索
            searchTips: '请搜索',
            radio: false,
            name: "GoodsModel[bao_you]",
            model: {
                icon: 'hidden',//是否展示复选框或者单选框图标 show, hidden:变换背景色  ！！这句话是重点，不然会变成父节点也有单选框！！
                label: {
                    type: 'block',
                    block: {
                        //最大显示数量, 0:不限制
                        showCount: 2,
                        //是否显示删除图标
                        showIcon: true,
                    }
                },
            },
            prop:{
                name: 'name',
                value: 'value',
            },
            tree: {
                show: true, //用树显示
                showFolderIcon: true, //是否显示节点前的三角图标
                expandedKeys: false, //默认全部展开
                showLine: true, //显示渐近线
                indent: 20, //间距
                strict: false, //重点！！设置成非严格父子模式，这样父节点被禁用，子节点依然可以点击
                clickCheck: true,
                vaguaSearch:0,//关闭模糊搜索
            },
            toolbar: {
                show: false, //显示工具条
                list: ['ALL', 'REVERSE', 'CLEAR']
            },
            height: '300px', //最大下拉框高度
            data: [{'value':1,'name':'国内包邮'},{'value':2,'name':'跨境包邮'}],
            initValue:[],
        });

        //买满人民币
        $('#goodsmodel_full_buycurrency_chosen').click(function(){
            let t = this;
            let txt = $(t).find('.chosen-single span').text();

            $(t).parents(':eq(3)').find('.currency_name').text(txt);
        });

        //买满数量
        $('#goodsmodel_full_buyunit_chosen').click(function(){
            let t = this;
            let txt = $(t).find('.chosen-single span').text();

            $(t).parents(':eq(3)').find('.unit_name').text(txt);
        });

        //活动
        let activity = xmSelect.render({
            el: '#activity_id',
            autoRow: true, //自动换行
            filterable: true, //可搜索
            searchTips: '请搜索',
            radio: false,
            name: "GoodsModel[activity_id]",
            model: {
                icon: 'hidden',//是否展示复选框或者单选框图标 show, hidden:变换背景色  ！！这句话是重点，不然会变成父节点也有单选框！！
                label: {
                    type: 'block',
                    block: {
                        //最大显示数量, 0:不限制
                        showCount: 1,
                        //是否显示删除图标
                        showIcon: true,
                    }
                },
            },
            prop:{
                name: 'name',
                value: 'id',
            },
            tree: {
                show: true, //用树显示
                showFolderIcon: true, //是否显示节点前的三角图标
                expandedKeys: false, //默认全部展开
                showLine: true, //显示渐近线
                indent: 20, //间距
                strict: false, //重点！！设置成非严格父子模式，这样父节点被禁用，子节点依然可以点击
                clickCheck: true,
                vaguaSearch:0,//关闭模糊搜索
            },
            toolbar: {
                show: false, //显示工具条
                list: ['ALL', 'REVERSE', 'CLEAR']
            },
            height: '300px', //最大下拉框高度
            data: {!! $activity !!},
            initValue:[],
        });

        //参与活动
        $('#goodsmodel_have_activity_chosen').click(function(){
            let t = this;
            let txt = $(t).find('.chosen-single span').text();
            if(txt=='不参与活动'){
                $(t).parents(":eq(3)").find('#activity_id').hide();
            }else{
                $(t).parents(":eq(3)").find('#activity_id').show();
            }
        });

        //适合人群
        let renqun = xmSelect.render({
            el: '#shihe_renqun',
            autoRow: true, //自动换行
            filterable: true, //可搜索
            searchTips: '请搜索',
            radio: false,
            name: "GoodsModel[shihe_renqun]",
            model: {
                icon: 'hidden',//是否展示复选框或者单选框图标 show, hidden:变换背景色  ！！这句话是重点，不然会变成父节点也有单选框！！
                label: {
                    type: 'block',
                    block: {
                        //最大显示数量, 0:不限制
                        showCount: 1,
                        //是否显示删除图标
                        showIcon: true,
                    }
                },
            },
            prop:{
                name: 'name',
                value: 'id',
            },
            tree: {
                show: true, //用树显示
                showFolderIcon: true, //是否显示节点前的三角图标
                expandedKeys: false, //默认全部展开
                showLine: true, //显示渐近线
                indent: 20, //间距
                strict: false, //重点！！设置成非严格父子模式，这样父节点被禁用，子节点依然可以点击
                clickCheck: true,
                vaguaSearch:0,//关闭模糊搜索
            },
            toolbar: {
                show: false, //显示工具条
                list: ['ALL', 'REVERSE', 'CLEAR']
            },
            height: '300px', //最大下拉框高度
            data: {!! $shihe['renqun'] !!},
            initValue:[],
        });
        //适合国家
        let country = xmSelect.render({
            el: '#shihe_country',
            autoRow: true, //自动换行
            filterable: true, //可搜索
            searchTips: '请搜索',
            radio: false,
            name: "GoodsModel[shihe_country]",
            model: {
                icon: 'hidden',//是否展示复选框或者单选框图标 show, hidden:变换背景色  ！！这句话是重点，不然会变成父节点也有单选框！！
                label: {
                    type: 'block',
                    block: {
                        //最大显示数量, 0:不限制
                        showCount: 1,
                        //是否显示删除图标
                        showIcon: true,
                    }
                },
            },
            prop:{
                name: 'name',
                value: 'value',
            },
            tree: {
                show: true, //用树显示
                showFolderIcon: true, //是否显示节点前的三角图标
                expandedKeys: false, //默认全部展开
                showLine: true, //显示渐近线
                indent: 20, //间距
                strict: false, //重点！！设置成非严格父子模式，这样父节点被禁用，子节点依然可以点击
                clickCheck: true,
                vaguaSearch:0,//关闭模糊搜索
            },
            toolbar: {
                show: false, //显示工具条
                list: ['ALL', 'REVERSE', 'CLEAR']
            },
            height: '300px', //最大下拉框高度
            data: {!! $shihe['country'] !!},
            initValue:[],
        });
        //适合网媒
        let media = xmSelect.render({
            el: '#shihe_media',
            autoRow: true, //自动换行
            filterable: true, //可搜索
            searchTips: '请搜索',
            radio: false,
            name: "GoodsModel[shihe_media]",
            model: {
                icon: 'hidden',//是否展示复选框或者单选框图标 show, hidden:变换背景色  ！！这句话是重点，不然会变成父节点也有单选框！！
                label: {
                    type: 'block',
                    block: {
                        //最大显示数量, 0:不限制
                        showCount: 1,
                        //是否显示删除图标
                        showIcon: true,
                    }
                },
            },
            prop:{
                name: 'name',
                value: 'id',
            },
            tree: {
                show: true, //用树显示
                showFolderIcon: true, //是否显示节点前的三角图标
                expandedKeys: false, //默认全部展开
                showLine: true, //显示渐近线
                indent: 20, //间距
                strict: false, //重点！！设置成非严格父子模式，这样父节点被禁用，子节点依然可以点击
                clickCheck: true,
                vaguaSearch:0,//关闭模糊搜索
            },
            toolbar: {
                show: false, //显示工具条
                list: ['ALL', 'REVERSE', 'CLEAR']
            },
            height: '300px', //最大下拉框高度
            data: {!! $shihe['media'] !!},
            initValue:[],
        });
        //适用节日
        let festival = xmSelect.render({
            el: '#shihe_festival',
            autoRow: true, //自动换行
            filterable: true, //可搜索
            searchTips: '请搜索',
            radio: false,
            name: "GoodsModel[shihe_festival]",
            model: {
                icon: 'hidden',//是否展示复选框或者单选框图标 show, hidden:变换背景色  ！！这句话是重点，不然会变成父节点也有单选框！！
                label: {
                    type: 'block',
                    block: {
                        //最大显示数量, 0:不限制
                        showCount: 1,
                        //是否显示删除图标
                        showIcon: true,
                    }
                },
            },
            prop:{
                name: 'name',
                value: 'id',
            },
            tree: {
                show: true, //用树显示
                showFolderIcon: true, //是否显示节点前的三角图标
                expandedKeys: false, //默认全部展开
                showLine: true, //显示渐近线
                indent: 20, //间距
                strict: false, //重点！！设置成非严格父子模式，这样父节点被禁用，子节点依然可以点击
                clickCheck: true,
                vaguaSearch:0,//关闭模糊搜索
            },
            toolbar: {
                show: false, //显示工具条
                list: ['ALL', 'REVERSE', 'CLEAR']
            },
            height: '300px', //最大下拉框高度
            data: {!! $shihe['festival'] !!},
            initValue:[],
        });
        //适用同款
        let common_goods = xmSelect.render({
            el: '#shihe_commongoods',
            autoRow: true, //自动换行
            filterable: true, //可搜索
            searchTips: '请搜索',
            radio: false,
            name: "GoodsModel[shihe_commongoods]",
            model: {
                icon: 'hidden',//是否展示复选框或者单选框图标 show, hidden:变换背景色  ！！这句话是重点，不然会变成父节点也有单选框！！
                label: {
                    type: 'block',
                    block: {
                        //最大显示数量, 0:不限制
                        showCount: 1,
                        //是否显示删除图标
                        showIcon: true,
                    }
                },
            },
            prop:{
                name: 'goods_name',
                value: 'id',
            },
            tree: {
                show: true, //用树显示
                showFolderIcon: true, //是否显示节点前的三角图标
                expandedKeys: false, //默认全部展开
                showLine: true, //显示渐近线
                indent: 20, //间距
                strict: false, //重点！！设置成非严格父子模式，这样父节点被禁用，子节点依然可以点击
                clickCheck: true,
                vaguaSearch:0,//关闭模糊搜索
            },
            toolbar: {
                show: false, //显示工具条
                list: ['ALL', 'REVERSE', 'CLEAR']
            },
            height: '300px', //最大下拉框高度
            data: {!! $shihe['common_goods'] !!},
            initValue:[],
        });
        //适用宗教
        let zongjiao = xmSelect.render({
            el: '#shihe_zongjiao',
            autoRow: true, //自动换行
            filterable: true, //可搜索
            searchTips: '请搜索',
            radio: false,
            name: "GoodsModel[shihe_zongjiao]",
            model: {
                icon: 'hidden',//是否展示复选框或者单选框图标 show, hidden:变换背景色  ！！这句话是重点，不然会变成父节点也有单选框！！
                label: {
                    type: 'block',
                    block: {
                        //最大显示数量, 0:不限制
                        showCount: 1,
                        //是否显示删除图标
                        showIcon: true,
                    }
                },
            },
            prop:{
                name: 'name',
                value: 'id',
            },
            tree: {
                show: true, //用树显示
                showFolderIcon: true, //是否显示节点前的三角图标
                expandedKeys: false, //默认全部展开
                showLine: true, //显示渐近线
                indent: 20, //间距
                strict: false, //重点！！设置成非严格父子模式，这样父节点被禁用，子节点依然可以点击
                clickCheck: true,
                vaguaSearch:0,//关闭模糊搜索
            },
            toolbar: {
                show: false, //显示工具条
                list: ['ALL', 'REVERSE', 'CLEAR']
            },
            height: '300px', //最大下拉框高度
            data: {!! $shihe['zongjiao'] !!},
            initValue:[],
        });
        //===2024-01-09 END===

        //悬浮显示上下步骤按钮
        window.onscroll = function() {
            $(window).scroll(function() {
                var scrollTop = $(document).scrollTop();
                var height = $(".table-content").height();
                var wHeight = $(window).height();
                if (scrollTop > (height - wHeight)) {
                    $(".goods-next").removeClass("goods-btn-fixed");
                } else {
                    $(".goods-next").addClass("goods-btn-fixed");
                }
            });

        };
        /*商品添加页面右侧发布助手js*/
        $('.helper-icon').click(function() {
            $('.helper-icon').animate({
                'right': '-40px'
            }, 200, function() {
                $('.helper-wrap').animate({
                    'right': '0'
                }, 200);
            });
        });
        $('.help-header .fa-times-circle').click(function() {
            $('.helper-wrap').animate({
                'right': '-140px'
            }, 200, function() {
                $('.helper-icon').animate({
                    'right': '0'
                }, 200);
            });
        });

        //生成页面导航助手
        $("#helper_tool_nav").find("ul").html("");
        var count = 0;
        $("[data-anchor]").each(function() {
            var title = $(this).data("anchor");
            var element = $($.parseHTML("<li><a href='javascript:void(0);'>" + title + "</a></li>"));
            $("#helper_tool_nav").find("ul").append(element);
            var target = this;
            $(element).click(function() {
                $('html, body').animate({
                    scrollTop: $(target).offset().top - 100
                }, 500);
                if ($(target).is(":input")) {
                    $(target).focus();
                } else {
                    $(target).find(":input").first().focus();
                }
            });
            count++;
        });

        $("#helper_tool_nav").find(".count").html(count);
    });
</script>
<!-- 规格、属性 -->
<script type='text/javascript'>
    function getOtherValue(attr_id, vname) {
        return "other_" + attr_id + "_" + vname;
    }

    var evalSkuTable = null;

    $().ready(function() {

        $("#goodsmodel-goods_status_1").attr("checked", true);

        // 验证
        var validator = $("#GoodsModel").validate();
        $("select").on('change', function() {
            $(this).valid();
        });

        //-------------------------------------商品规格处理-----------------------------------------

        // 修改规格名称时级联修改表格的表头
        $("body").on("keyup", ".spec-name:text", function() {
            var attr_id = $(this).data("spec-id");
            $(".th_spec_id_" + attr_id).html($(this).val());
        });

        // 如果不存在则为0
        var vid_index = 0;
        var other_name = "其他";

        function getNewVid(attr_id) {
            return "other_" + attr_id + "_" + (vid_index++);
        }

        function setOtherSpecData(cb_object, vname) {

            var vid = $(cb_object).data("vid");
            var attr_id = $(cb_object).data("attr-id");

            if (vid == undefined || vid == null) {
                vid = getNewVid(attr_id);
            }

            if (vname == undefined || $.trim(vname) == "") {
                vname = other_name + vid_index;
            }

            $(cb_object).val(getOtherValue(attr_id, vname));
            $(cb_object).data("vid", vid);
            $(cb_object).data("vname", vname);
            $(cb_object).siblings(":text").val(vname);

            $(".spec-vname-label-" + vid).html(vname);
            $(".spec-vname-text-" + vid).val(vname);
            $(".spec-vid-text-" + vid).val(getOtherValue(attr_id, vname));

        }

        // 读取复选框获取规格信息
        function getSpecInfo(cb_object) {
            var object = {};
            object.attr_id = $(cb_object).data("attr-id");
            object.attr_vid = $(cb_object).data("vid");
            object.attr_vname = $(cb_object).data("vname");
            object.attr_desc = $(cb_object).siblings(".spec-desc").val();

            if (new String(object.attr_vid).indexOf("other_") == 0) {
                attr_vname = $(this).siblings(".spec-other-text").val();
                if ($.trim(object.attr_vname) == '') {
                    object.attr_vname = other_name;
                }
            }

            return object;
        }

        // 单击“其他规格”复选框事件
        $("body").on("click", ".spec-other-value", function() {
            var checked = $(this).is(":checked");
            if (checked) {
                var value = $(this).siblings(":text").val();
                if ($.trim(value) == '') {
                    //设置复选框参数
                    setOtherSpecData(this, other_name);
                }
                // 变色
                $(this).siblings(":text").css({
                    "color": "#000"
                });
                var template = $("#spec_other_value_template").html();
                template = $($.parseHTML(template));
                $(template).find(":checkbox").attr("data-attr-id", $(this).data("attr-id"));
                $(this).parents(".spec-values").append(template);
                $(this).siblings(":text").focus();
            } else {
                if ($(this).parents(".spec-values").find(".spec-other-value").size() > 1) {
                    $(this).parents("label").remove();
                }
            }
        });

        // “其他”文本框获取焦点事件
        $("body").on("keyup", ".spec-other-text", function() {
            var value = $(this).val();

            if ($.trim(value) == "") {
                return;
            }

            if ($(this).valid()) {
                //设置复选框参数
                var cb_object = $(this).siblings(":checkbox");
                setOtherSpecData(cb_object, value);

                // 实时计算
                evalSkuTable().always(function() {
                    $.loading.stop();
                });
            }
        });

        // “其他”文本框获取焦点事件
        $("body").on("focus", ".spec-other-text", function() {
            var value = $(this).val();
            if ($.trim(value) == other_name) {
                //var cb_object = $(this).siblings(":checkbox");
                //setOtherSpecData(cb_object, "");
            }
        });

        // “其他”文本框失去焦点事件
        $("body").on("blur", ".spec-other-text", function() {
            if ($(this).siblings(":checkbox").is(":checked") == false) {
                return;
            }
            var value = $(this).val();
            if ($.trim(value) == '') {
                value = other_name;
            }

            var cb_object = $(this).siblings(":checkbox");
            setOtherSpecData(cb_object, value);

            $(this).valid();
        });

        // 规格对象
        var spec_object = [];
        // sku对象
        var sku_object = [];

        if ($("#goods_sku_list").size() > 0) {
            try {
                sku_object = $.parseJSON($("#goods_sku_list").html());

                for ( var spec_vids in sku_object) {
                    var item = sku_object[spec_vids];
                    var ids = spec_vids.split("|");
                    var list = $.toPermute(ids);

                    for (var i = 0; i < list.length; i++) {
                        var vids = list[i].sort();
                        vids = vids.join("|");
                        sku_object[vids] = item;
                    }
                }
            } catch (e) {
                console.info(e);
            }
        }

        var eval_loading = false;

        // 规格上移
        $("body").on("click", ".goods-spec-item-btn-up", function() {

            var object = $(this).parents(".goods-spec-item:visible");
            var target = $(object).prev(".goods-spec-item:visible");

            if (eval_loading == false && $(target).size() > 0) {

                eval_loading = true;

                $(target).before(object);

                // 重新计算
                evalSkuTable().always(function() {
                    eval_loading = false;
                    // 停止缓载
                    $.loading.stop();
                });
            }

            return false;
        });

        // 规格下移
        $("body").on("click", ".goods-spec-item-btn-down", function() {

            var object = $(this).parents(".goods-spec-item:visible");
            var target = $(object).next(".goods-spec-item:visible");

            if (eval_loading == false && $(target).size() > 0) {

                eval_loading = true;

                $(target).after(object);

                // 重新计算
                evalSkuTable().always(function() {
                    eval_loading = false;
                    // 停止缓载
                    $.loading.stop();
                });
            }

            return false;
        });

        // 计算SKU表格
        evalSkuTable = function(init) {
            var deferred = $.Deferred();

            // 缓载
            $.loading.start();

            if (init == undefined) {
                init = false;
            }

            var is_all = true;

            $(".goods-spec-item").each(function() {
                if ($(this).find(":checked").size() == 0) {
                    // is_all = false;
                }
            });

            if (!is_all) {
                $("#sku_table_container").hide().find("tbody").empty();
                $("#sku_table_warning").show();
                $("#goodsmodel-goods_number").prop("readonly", false);
                $("#goodsmodel-warn_number").prop("readonly", false);

                $("#goodsmodel-market_price").prop("readonly", false);
                $("#goodsmodel-goods_price").prop("readonly", false);

                $("#goodsmodel-goods_sn").prop("readonly", false);
                $("#goodsmodel-goods_barcode").prop("readonly", false);

                // 改变Deferred对象的执行状态
                deferred.resolve();
                return deferred;
            }
            else {
                $("#sku_table_container").show();
                $("#sku_table_warning").hide();

                $("#goodsmodel-goods_number").prop("readonly", true);
                $("#goodsmodel-warn_number").prop("readonly", true);

                $("#goodsmodel-market_price").prop("readonly", true);
                $("#goodsmodel-goods_price").prop("readonly", true);

                $("#goodsmodel-goods_sn").prop("readonly", true);
                $("#goodsmodel-goods_barcode").prop("readonly", true);
            }

            var is_repeat = false;

            $(".spec-other-text").reverse().each(function() {
                if ($(this).siblings(":checkbox").is(":checked") == false) {
                    return;
                }

                if ($(this).valid()) {
                    return true;
                }

                $(this).focus();

                is_repeat = true;

                return false;
            });

            if (is_repeat) {
                // 改变Deferred对象的执行状态
                deferred.resolve();
                return deferred;
            }

            spec_ids = [];
            spec_values = [];

            var sku_td_html = "";
            var sku_th_html = "";

            var temp_attr_ids = [];

            var sku_th_template = $("#sku_th_template").html();
            // var sku_td_template = $("#sku_td_template").html();
            var sku_td_template = '<td class="spec-vname-td">\n' +
                '            <span class="spec-vname-label" data-attr-id="#attr_id#">#attr_vname#</span>\n' +
                '            <input type="hidden" name="new_specs[attr_id#attr_id#][]" value="#attr_id#">\n' +
                '            <input type="hidden" name="new_specs[attr_vid#attr_vid#][]" value="#attr_vid#" class="" data-attr-id="#attr_vid#">\n' +
                '            <input type="hidden" name="new_specs[attr_vname#attr_vid#][]" value="#attr_vname#" class="" data-attr-id="#attr_vid#">\n' +
                '            <input type="hidden" name="new_specs[attr_desc#attr_vid#][]" value="" class="" data-attr-id="">\n' +
                '        </td>';

            // 查找选中的复选框
            $(".spec-values").find(":checkbox:checked").each(function() {
                var attr_id = $(this).parents(".spec-values").data("spec-id");
                var attr_vid = $(this).data("vid");
                var attr_vname = $(this).data("vname");
                var attr_name = $(".spec-id-" + attr_id).data("spec-name");
                if ($("#spec_name_" + attr_id).size() > 0) {
                    attr_name = $("#spec_name_" + attr_id).val();
                }
                var value = $(this).val();
                var attr_desc = $(this).siblings(".spec-desc").val();

                var key = "spec-" + attr_id;

                if (spec_values[key] == undefined) {
                    spec_values[key] = [];
                    spec_ids.push(attr_id);
                }

                spec_values[key].push(this);

                if (temp_attr_ids[attr_id] == undefined) {
                    //sku_th_html += $("#sku_th_template_" + attr_id).html();
                    //sku_td_html += $("#sku_td_template_" + attr_id).html();

                    var temp = sku_th_template;
                    temp = temp.replace(/#attr_id#/g, attr_id);
                    temp = temp.replace(/#attr_vid#/g, attr_vid);
                    temp = temp.replace(/#attr_vname#/g, attr_vname);
                    temp = temp.replace(/#attr_name#/g, attr_name);
                    sku_th_html += temp;
                    // console.log(attr_id,attr_name,attr_vid,attr_vname);

                    temp = sku_td_template;
                    temp = temp.replace(/#attr_id#/g, attr_id);
                    temp = temp.replace(/#attr_vid#/g, attr_vid);
                    temp = temp.replace(/#attr_vname#/g, attr_vname);
                    temp = temp.replace(/#attr_name#/g, attr_name);
                    sku_td_html += temp;

                    temp_attr_ids[attr_id] = true;
                }
            });

            // 遍历行保存当前数据
            $("#sku_table").find("tbody").find("tr").each(function() {
                var object = $(this).serializeJson();

                var sku_id = $(this).data("sku_id");
                var is_enable = $(this).data("is_enable");

                if (is_enable == undefined) {
                    is_enable = true;
                }

                sku_object[sku_id] = object;
                sku_object[sku_id].checked = is_enable;
                sku_object[sku_id].is_enable = is_enable;
            });

            $(".spec-th").remove();
            $(".sku-th-index").after($.parseHTML(sku_th_html));

            var list = [];

            if (parseInt("10") > 1) {
                for (var i = 0; i < spec_ids.length; i++) {
                    var key = "spec-" + spec_ids[i];
                    list.push(spec_values[key]);
                }
                list = $.toDkezj(list);
            } else {
                for ( var key in spec_values) {
                    for ( var k in spec_values[key]) {
                        list.push([spec_values[key][k]]);
                    }
                }
            }

            // 如果为选中任何规格则提示
            if (list.length == 0) {
                $("#sku_table_container").hide().find("tbody").empty();
                $("#sku_table_warning").show();
                $("#goodsmodel-goods_number").prop("readonly", false);
                $("#goodsmodel-warn_number").prop("readonly", false);

                $("#goodsmodel-market_price").prop("readonly", false);
                $("#goodsmodel-goods_price").prop("readonly", false);

                $("#goodsmodel-goods_sn").prop("readonly", false);
                $("#goodsmodel-goods_barcode").prop("readonly", false);

                // 改变Deferred对象的执行状态
                deferred.resolve();
                return deferred;
            } else {
                $("#sku_table_container").show();
                $("#sku_table_warning").hide();
                $("#goodsmodel-goods_number").prop("readonly", true);
                $("#goodsmodel-warn_number").prop("readonly", true);

                $("#goodsmodel-market_price").prop("readonly", true);
                $("#goodsmodel-goods_price").prop("readonly", true);

                $("#goodsmodel-goods_sn").prop("readonly", true);
                $("#goodsmodel-goods_barcode").prop("readonly", true);
            }

            $("#sku_table").find("tbody").find("tr").remove();
            $("#sku_more_table").find("tbody").find("tr").remove();

            var total_goods_number = 0;
            var goods_price = 0;
            var market_price = 0;

            // 模板
            // var template = $("#sku_table_template").html();
            var template = '<td class="sku-td-index text-c"></td>\n' +
                '        <td>\n'+
                '            <input type="text" name="new_specs[goods_number][]" value="" class="form-control small sku-field sku-goods-number" data-rule-required="" data-msg-required="SKU商品库存不能为空" data-rule-min="0" data-rule-max="9999999">\n'+
                '        </td>\n'+
                '        <td colspan="3">\n' +
                '            <table class="spec_table" style="width:100%;text-align:center;">\n' +
                '                <tr>\n' +
                '                    <td class="td_width">\n' +
                '                        <div class="disf">\n' +
                '                            <input type="number" name="new_specs[start_num][tr_num][]" value="1" class="form-control w50 start_num" placeholder="起始数值">\n' +
                '                            <select name="new_specs[unit][tr_num][]" class="form-control chosen-select unit" onchange="specs_unit(this)">\n' +
                '                                <option value="">请选择</option>\n';
            @foreach($unit as $k=>$v)
                template+='                            <option value="{{$v['code_value']}}" data-title="{{$v['code_name']}}">{{$v['code_name']}}</option>\n';
            @endforeach
                template+='                  </select>\n' +
                '                            至\n' +
                '                            <select name="new_specs[select_end][tr_num][]" class="form-control chosen-select " onchange="specs_selEnd(this)">\n' +
                '                                <option value="1">数值</option>\n' +
                '                                <option value="2">以上</option>\n' +
                '                            </select>\n' +
                '                            <input type="number" name="new_specs[end_num][tr_num][]" value="" class="form-control w50 end_num" placeholder="尾止数值">\n' +
                '                            <div class="unit_name"></div>\n' +
                '                        </div>\n' +
                '                    </td>\n' +
                '                    <td class="td_width">\n' +
                '                        <select name="new_specs[currency][tr_num][]" class="form-control chosen-select currency" onchange="specs_currency(this)">\n' +
                '                            <option value="">请选择</option>\n';
            @foreach($currency as $k=>$v)
            if("{{$v['id']}}"==5){
                template+='                        <option value="{{$v['id']}}" data-title="{{$v['currency_symbol_origin']}}" selected>{{$v['code_zhname']}}：{{$v['currency_symbol_origin']}}</option>\n';
            }else{
                template+='                        <option value="{{$v['id']}}" data-title="{{$v['currency_symbol_origin']}}">{{$v['code_zhname']}}：{{$v['currency_symbol_origin']}}</option>\n';
            }

            @endforeach
                template+='              </select>\n' +
                '                        <input type="number" name="new_specs[price][tr_num][]" value="" class="form-control w70" placeholder="区间金额">\n' +
                '                    </td>\n' +
                '                    <td style="text-align:center;">\n' +
                '                        <div class="layui-btn layui-btn-md layui-btn-normal addbtn" onclick="add_interval(this,tr_num)">+</div>\n' +
                '                    </td>\n' +
                '                </tr>\n' +
                '            </table>\n' +
                '        </td>';
            var more_template = $("#sku_more_table_template").html();

            for (var i = 0; i < list.length; i++) {
                var objects = list[i];

                var sku_id = [];

                var html = "<tr>" + template + "</tr>";
                //更新template的索引
                html = html.replace(/tr_num/g,i);

                var more_html = "<tr>" + more_template + "</tr>";

                var element = $(html);
                var more_element = $(more_html);
                // console.log(sku_td_html);

                $(element).find(".sku-td-index").after(sku_td_html);
                $(more_element).find(".sku-td-index").after(sku_td_html);

                for (var j = 0; j < objects.length; j++) {
                    // 读取复选框获取规格信息
                    var object = getSpecInfo(objects[j]);
                    var attr_id = object.attr_id;
                    var vname = object.attr_vname;
                    var desc = object.attr_desc;
                    var vid = object.attr_vid;

                    if (new String(vid).indexOf('other_') == 0) {
                        sku_id.push(getOtherValue(attr_id, vname));
                        $(element).find("[name='specs[" + attr_id + "][attr_vid]']").val(getOtherValue(attr_id, vname)).addClass("spec-vid-text-" + vid);
                        $(more_element).find("[name='specs[" + attr_id + "][attr_vid]']").val(getOtherValue(attr_id, vname)).addClass("spec-vid-text-" + vid);
                    } else {
                        sku_id.push(vid);
                        $(element).find("[name='specs[" + attr_id + "][attr_vid]']").val(vid).addClass("spec-vid-text-" + vid);
                        $(more_element).find("[name='specs[" + attr_id + "][attr_vid]']").val(vid).addClass("spec-vid-text-" + vid);
                    }

                    $(element).find(".spec-vname-label[data-attr-id='" + attr_id + "']").html(vname).addClass("spec-vname-label-" + vid);
                    $(element).find("[name='specs[" + attr_id + "][attr_vname]']").val(vname).addClass("spec-vname-text-" + vid);
                    $(element).find("[name='specs[" + attr_id + "][attr_desc]']").val(desc).addClass("spec-desc-text-" + vid);
                    if ($('input[name="GoodsModel[sales_model]"]:checked').val() == 1) {
                        $(element).find(".sku-market-price-td").addClass('hide');
                        $(element).find(".sku-goods-price-td").addClass('hide');
                    }

                    // $(more_element).find(".spec-vname-label[data-attr-id='" + attr_id + "']").html(vname).addClass("spec-vname-label-" + vid);
                    // $(more_element).find("[name='specs[" + attr_id + "][attr_vname]']").val(vname).addClass("spec-vname-text-" + vid);
                    // $(more_element).find("[name='specs[" + attr_id + "][attr_desc]']").val(desc).addClass("spec-desc-text-" + vid);

                    //调整sku_table的值为当前sku的值
                    // $(element).find('input').eq(1).remove();
                    // $(element).find('input').eq(1).remove();
                    // $(element).find('input').eq(1).remove();
                    // $(element).find('input').eq(0).after('<input type="hidden" name="new_specs[attr_vid'+vid+'][]" value="'+vid+'" class="" data-attr-id="'+vid+'">');
                    // $(element).find('input').eq(1).after('<input type="hidden" name="new_specs[attr_vname'+vid+'][]" value="'+vname+'" class="" data-attr-id="'+vid+'">');
                    // $(element).find('input').eq(2).after('<input type="hidden" name="new_specs[attr_desc'+vid+'][]" value="" class="" data-attr-id="'+vid+'">');

                }

                // 排序，保证sku_id的拼接不受排序影响
                sku_id.sort();
                sku_id = sku_id.join("|");

                // 行标识出SKU_ID
                $(element).data("sku_id", sku_id);
                $(more_element).data("sku_id", sku_id);

                $("#sku_table").find("tbody").eq(0).append(element);
                $("#sku_more_table").find("tbody").eq(0).append(more_element);

                if (sku_object[sku_id] == undefined) {
                    sku_object[sku_id] = $(element).serializeJson();
                    if (init) {
                        // 初始化时不存在则为false
                        sku_object[sku_id].checked = false;
                    } else {
                        sku_object[sku_id].checked = true;
                    }
                } else {
                    if (sku_object[sku_id].checked == "false" || sku_object[sku_id].checked == false) {
                        sku_object[sku_id].checked = false;
                    } else {
                        sku_object[sku_id].checked = true;
                    }

                    //还原赋值
                    $(element).find(".sku-field").each(function() {
                        var name = $(this).attr("name");
                        $(this).val(sku_object[sku_id][name]);
                    });
                }

                sku_object[sku_id].is_enable = sku_object[sku_id].checked;

                // 标识是否可用
                if (sku_object[sku_id].is_enable == undefined) {
                    sku_object[sku_id].is_enable = true;
                }

                $(element).data("is_enable", sku_object[sku_id].is_enable);
                // console.log(sku_object,sku_id,1234);
                if (sku_object[sku_id].is_enable) {
                    $(element).find(".sku-td-index").html((i + 1) + '<a class="del-btn sku-item-handle" data-sku-enable=false data-sku-index="' + (i + 1) + '" title="点击禁用此规格">×</a><input name="new_specs[disabled_num][]" class="disabled_num" value="0" style="display: none;">');
                    $(element).removeClass("disabled");
                    $(element).find(":input").prop("readonly", false);

                    $(more_element).find(".sku-td-index").html((i + 1) + '<a class="del-btn sku-item-handle" data-sku-enable=false data-sku-index="' + (i + 1) + '" title="点击禁用此规格">×</a>');
                    $(more_element).removeClass("disabled");
                    $(more_element).find(":input").prop("disabled", false);
                } else {
                    $(element).find(".sku-td-index").html((i + 1) + '<a class="allow-btn sku-item-handle" data-sku-enable=true data-sku-index="' + (i + 1) + '" title="点击启用此规格">√</a><input name="new_specs[disabled_num][]" class="disabled_num" value="-1" style="display: none;">');
                    $(element).addClass("disabled");
                    $(element).find(":input").prop("readonly", true);

                    $(more_element).find(".sku-td-index").html((i + 1) + '<a class="allow-btn sku-item-handle" data-sku-enable=true data-sku-index="' + (i + 1) + '" title="点击启用此规格">√</a>');
                    $(more_element).addClass("disabled");
                    $(more_element).find(":input").prop("disabled", true);
                }

                if (sku_object[sku_id].is_enable) {
                    // 合计库存
                    if (sku_object[sku_id]['goods_number'] != '') {
                        total_goods_number = total_goods_number + parseInt(sku_object[sku_id]['goods_number']);
                    }

                    // 计算最低价格
                    if (!isNaN(parseFloat(sku_object[sku_id]['goods_price'])) && (goods_price == 0 || parseFloat(sku_object[sku_id]['goods_price']) < goods_price)) {
                        goods_price = parseFloat(sku_object[sku_id]['goods_price']);
                    }

                    // 计算最低价格
                    if (!isNaN(parseFloat(sku_object[sku_id]['market_price'])) && (market_price == 0 || parseFloat(sku_object[sku_id]['market_price']) < market_price)) {
                        market_price = parseFloat(sku_object[sku_id]['market_price']);
                    }
                }
            }

            // 选择了SKU规格组合和禁用商品库存、条形码、货号等
            if (list.length > 0) {
                if(isNaN(total_goods_number)){
                    total_goods_number = 0;
                }

                $("#goodsmodel-goods_number").prop("readonly", true).val(total_goods_number);
                $("#goodsmodel-warn_number").prop("readonly", true).val(0);

                $("#goodsmodel-market_price").prop("readonly", true).val(market_price);
                $("#goodsmodel-goods_price").prop("readonly", true).val(goods_price);

                $("#goodsmodel-goods_sn").prop("readonly", true);
                $("#goodsmodel-goods_barcode").prop("readonly", true);
            } else {
                $("#goodsmodel-goods_number").prop("readonly", false);
                $("#goodsmodel-warn_number").prop("readonly", false);

                $("#goodsmodel-market_price").prop("readonly", false);
                $("#goodsmodel-goods_price").prop("readonly", false);

                $("#goodsmodel-goods_sn").prop("readonly", false);
                $("#goodsmodel-goods_barcode").prop("readonly", false);
            }

            $('.chosen-select').chosen();//初始化chosen

            // 改变Deferred对象的执行状态
            deferred.resolve();
            let td_width = $('#sku_table').find('thead').eq(0).find('th').eq(-2).outerWidth();
            // console.log(td_width,$('#sku_table').find('thead').eq(0).find('th').eq(-2),$('#sku_table').find('thead').eq(0).find('th').eq(-2).css('width'),$('#sku_table').find('thead').eq(0).find('th').eq(-2)[0].clientWidth);
            $('#sku_table').find('.td_width').css('width',td_width+'px');
            return deferred;
        }

        function sku_info_sum(sum_goods_number, sum_warn_number, min_goods_price, min_market_price) {
            // 商品数量求和
            if (sum_goods_number) {
                var total_goods_number = 0;
                $(".sku-goods-number").each(function() {
                    if ($(this).parents("tr").data("is_enable") == false) {
                        return;
                    }
                    if ($(this).val().length > 0) {
                        total_goods_number += parseInt($(this).val());
                    }
                });

                $("#goodsmodel-goods_number").val(total_goods_number);
            }

            // 商品数量求和
            if (sum_warn_number) {
                var total_warn_number = 0;
                $(".sku-warn-number").each(function() {
                    if ($(this).parents("tr").data("is_enable") == false) {
                        return;
                    }
                    if ($(this).val().length > 0) {
                        total_warn_number += parseInt($(this).val());
                    }
                });
                if (total_warn_number > 255) {
                    total_warn_number = 255;
                }
                $("#goodsmodel-warn_number").val(total_warn_number);
            }

            // 商品价格求最低价
            if (min_goods_price) {
                var goods_price = null;
                $(".sku-goods-price").each(function() {
                    if ($(this).parents("tr").data("is_enable") == false) {
                        return;
                    }
                    if (goods_price == null || ($(this).val().length > 0 && goods_price > parseFloat($(this).val()))) {
                        goods_price = parseFloat($(this).val());
                    }
                });
                $("#goodsmodel-goods_price").val(goods_price);
            }
            // 市场价求最低价
            if (min_market_price) {
                var market_price = 0;
                $(".sku-market-price").each(function() {
                    if ($(this).parents("tr").data("is_enable") == false) {
                        return;
                    }
                    if (market_price == 0 || ($(this).val().length > 0 && market_price > parseFloat($(this).val()))) {
                        market_price = isNaN(parseFloat($(this).val())) ? 0 : parseFloat($(this).val());
                    }
                });
                $("#goodsmodel-market_price").val(market_price);
            }
        }

        // 启用、禁用SKU
        $("body").on("click", ".sku-item-handle", function() {
            var is_enable = $(this).data("sku-enable");
            var sku_index = $(this).data("sku-index");

            var tr_obj = $(this).parents("tr");

            var sku_id = $(tr_obj).data("sku_id");

            sku_object[sku_id].is_enable = is_enable;

            $(tr_obj).data("is_enable", is_enable);

            if (is_enable) {
                $(this).parents(".sku-td-index").html(sku_index + '<a class="del-btn sku-item-handle" data-sku-enable=false data-sku-index="' + sku_index + '" title="点击禁用此规格">×</a><input name="new_specs[disabled_num][]" class="disabled_num" value="0" style="display: none;">');
                $(tr_obj).removeClass("disabled");
                $(tr_obj).find(":input").prop("readonly", false).removeClass("error");
            } else {
                // 至少要有一项规格，否则提示
                if ($(tr_obj).parents("tbody").find("tr").not(".disabled").size() == 1) {
                    $.msg("如果您不想发布的商品包含任何规格，请不要勾选任何商品规格！", {
                        time: 3000
                    });
                    return;
                }
                $(this).parents(".sku-td-index").html(sku_index + '<a class="allow-btn sku-item-handle" data-sku-enable=true data-sku-index="' + sku_index + '" title="点击启用此规格">√</a><input name="new_specs[disabled_num][]" class="disabled_num" value="-1" style="display: none;">');
                $(tr_obj).addClass("disabled");
                $(tr_obj).find(":input").prop("readonly", true);
            }

            // 计算SKU信息
            sku_info_sum(true, true, true, true);

            $(tr_obj).parents("tbody").find("tr.disabled").find(":input").removeClass("error");
        });

        $("body").on("mouseenter", "#sku_table tr", function() {
            var target = $(this).find(".sku-item-handle");
            $.tips($(target).attr("title"), target, {
                tips: 4,
                time: 2000
            });
        });

        // SKU商品库存合计后赋值给商品库存
        $("body").on("keyup", ".sku-goods-number", function() {
            sku_info_sum(true, false, false, false);
        });

        // SKU库存警告数量合计后赋值给商品库存警告数量
        $("body").on("keyup", ".sku-warn-number", function() {
            sku_info_sum(false, true, false, false);
        });

        // SKU商品价格最小值计算
        $("body").on("keyup", ".sku-goods-price", function() {
            sku_info_sum(false, false, true, false);
        });

        // SKU商品市场价格最小值计算
        $("body").on("keyup", ".sku-market-price", function() {
            sku_info_sum(false, false, false, true);
        });

        // 初始化
        evalSkuTable(true).always(function() {
            // 停止缓载
            $.loading.stop();
        });

        // 点击规格值拼接表格
        $("body").on("click", ".spec-value", function() {
            evalSkuTable().always(function() {
                // 停止缓载
                countStepPrice();
                $.loading.stop();
            });

        });

        // 默认规格
        //$("body").on("click", ".default-spec", function() {
        //	$(".default-spec").parents("span").removeClass("selected");
        //	$(this).parents("span").addClass("selected");
        //	$(this).parents("span").find(":checkbox").prop("checked", true).change();
        //});

        // 点击规格分类(最大的规格分类)
        $("body").on("change", ".spec-values-item :checkbox", function() {
            let sel_txt = $.trim($(this).parent().text());
            let html = '<div class="note">'+sel_txt+'</div><input name="GoodsModel[shihe_changwei][goption][]" value="'+sel_txt+'" style="display:none;">';
            $('.goption_promote').find('.form-control-box').append('<div style="display:inline-block;">'+html+'</div>&nbsp;');
            var attr_id = $(this).val();
            var element = $(".goods-spec-item[data-spec-id='" + attr_id + "']");

            if ($(this).is(":checked")) {
                if ($(".spec-values-item :checkbox").size() == 1 || $(".spec-values-item").filter(".selected").find(":checkbox:checked").size() == 0) {
                    $(".spec-values-item").removeClass("selected");
                    $(this).parents(".spec-values-item").addClass("selected");
                }

                $(element).show();
            } else {
                var is_default = $(this).parents(".spec-values-item").hasClass("selected");
                $(this).parents(".spec-values-item").removeClass("selected");

                $(element).hide();

                if ($(element).find(":checkbox:checked").size() > 0) {
                    $(element).find(":checkbox").prop("checked", false);
                    // 重新计算
                    evalSkuTable().always(function() {
                        // 停止缓载
                        countStepPrice();
                        $.loading.stop();
                    });
                }
                // 如果此元素被选择则让下一个被选择的被选择
                if (is_default) {
                    $(".spec-values-item").find(":checkbox:checked").first().parents(".spec-values-item").addClass("selected");
                }
            }
        });

        // 初始化规格排序
        initSpecSortable();
    });
    //商品相册
    $().ready(function() {

        $("#btn_imagegallery").click(function() {

            var container = $("#imagegallery_container");

            if (!$.imagegallery(container)) {
                $(this).html("<i class=\"fa fa-picture-o\"></i>关闭图片空间");
                if ($(this).data("toggle") == false) {
                    $(container).show();
                    $(this).data("toggle", true);
                    return;
                }
                var imagegallery = $(container).imagegallery({
                    data: {
                        page: {
                            page_id: "ImageGallery_GoodsImage"
                        }
                    },
                    click: function(target, path) {
                        var image_url = $(target).attr("src");
                        $("#goods_image_tag").attr("src", image_url);
                        // 原图路径
                        $("#goodsmodel-goods_image").val(path);
                        $("#goods_image_tag").parent("a").attr("href", "http://68yun.oss-cn-beijing.aliyuncs.com/images/15164//" + path);
                    }
                });
            } else {

                if ($(container).is(":hidden")) {
                    $(this).html("<i class=\"fa fa-picture-o\"></i>关闭图片空间");
                    $(container).show();
                } else {
                    $(this).html("<i class=\"fa fa-picture-o\"></i>从图片空间选择");
                    $(container).hide();
                }
            }

        });

        // 图片空间
        $("#btn_pc_desc_imagegallery").click(function() {

            var container = $("#pc_desc_imagegallery_container");

            if (!$.imagegallery(container)) {
                $(this).html("<i class=\"fa fa-picture-o\"></i>关闭相册图片");
                if ($(this).data("toggle") == false) {
                    $(container).show();
                    $(this).data("toggle", true);
                    return;
                }
                var imagegallery = $(container).imagegallery({
                    data: {
                        page: {
                            page_id: "ImageGallery_PcDesc"
                        }
                    },
                    click: function(target, path, url) {
                        var image_url = $(target).data("url");

                        var tab_obj = $("#product-details").find(".desc-tab[aria-expanded=true]");

                        if ($(tab_obj).hasClass("mobile-desc")) {
                            var template = $("#mobile_image_template").html();
                            var element = $($.parseHTML(template));
                            $(element).find("img").attr("src", url);
                            $(element).find("img").data("path", path);
                            $(".mobile-editor").find(".control-panel").append(element);
                        } else {
                            // 获取商品详情
                            KindEditor.ready(function(K) {
                                K.insertHtml("#pc_desc", "<img src='"+image_url+"' />");
                            });
                        }
                    }
                });
            } else {

                if ($(container).is(":hidden")) {
                    $(this).html("<i class=\"fa fa-picture-o\"></i>关闭相册图片");
                    $(container).show();
                } else {
                    $(this).html("<i class=\"fa fa-picture-o\"></i>批量插入相册图片");
                    $(container).hide();
                }
            }
        });

        // 商品主图
        $("#goods_image_container").imagegroup({
            host: "http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/",
            values: [""],
            gallery: true,
            callback: function(result) {
                var values = this.getValues();
                var value = values.length > 0 ? values[0] : "";
                $("#goodsmodel-goods_image").val(value);
            },
            remove: function() {
                $("#goodsmodel-goods_image").val("");
            }
        });

        // 商品主图视频
        $("#goods_video_container").videogroup({
            host: "http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/",
            values: [""],
            gallery: true,
            options: {
                minDuration: "0",
                maxDuration: "90",
            },
            callback: function(data) {
                var values = this.getValues();
                var value = values.length > 0 ? values[0] : "";
                $("#goodsmodel-goods_video").val(value);
            },
            remove: function() {
                $("#goodsmodel-goods_video").val("");
            }
        });

        $("#btn_upload_pc_desc").click(function() {
            $.imageupload({
                url: '/site/upload-goods-desc-image',
                multiple: true,
                callback: function(result) {
                    if (result.code == 0 && result.data) {

                        if (!$.isArray(result.data)) {
                            result.data = [result.data];
                        }
                        $.each(result.data, function(i, data) {
                            var path = data.path;
                            var image_url = data.url;

                            var tab_obj = $("#product-details").find(".desc-tab[aria-expanded=true]");

                            if ($(tab_obj).hasClass("mobile-desc")) {
                                var template = $("#mobile_image_template").html();
                                var element = $($.parseHTML(template));
                                $(element).find("img").attr("src", image_url);
                                $(element).find("img").data("path", path);
                                $(".mobile-editor").find(".control-panel").append(element);
                            } else {
                                // 获取商品详情
                                KindEditor.ready(function(K) {
                                    K.insertHtml("#pc_desc", "<img src='"+image_url+"' />");
                                });
                            }
                        });
                    } else if (result.message) {
                        $.msg(result.message, {
                            time: 5000
                        })
                    }
                },
                validateFiles: function(files,options){
                    // return 1;
                }
            });
        });

        // 刷新运费模板
        $(".refresh-freight-list").click(function() {
            $.get('/goods/publish/freights', {}, function(result) {
                if (result.code == 0) {
                    var html = "<option value='0'>--请选择--</option>";

                    for (var i = 0; i < result.data.length; i++) {
                        var item = result.data[i];
                        html += "<option value='"+item.freight_id+"'>" + item.title + "</option>";
                    }

                    $("#goodsmodel-freight_id").html(html);
                } else {
                    $.msg(result.message, {
                        time: 5000
                    });
                }
            }, "json");

            $("#goods_freight_info").hide();
        });

        // 查看运费模板
        $(".freight-info").click(function() {
            var id = $(".freight-list").val();
            if (id == '') {
                return;
            }
            $.go("/shop/freight/edit?id=" + id, "_blank");
        });

        // 刷新运费模板
        $(".freight-list").change(function() {
            var id = $(this).val();

            if (id == '') {
                $("#goods_freight_info").hide();
                return;
            }

            $.get("/shop/freight/desc", {
                id: id
            }, function(result) {
                if (result.code == 0) {
                    $("#goods_freight_info").find(".default-desc").html("默认运费：" + result.data.default_desc);
                    if (result.data.desc) {
                        $("#goods_freight_info").find(".other-desc-title").show();
                        $("#goods_freight_info").find(".other-desc").show();
                        $("#goods_freight_info").find(".other-desc").html(result.data.region_names + " " + result.data.desc);
                    } else {
                        $("#goods_freight_info").find(".other-desc-title").hide();
                        $("#goods_freight_info").find(".other-desc").hide();
                    }
                    if (result.data.freight.limit_sale == 1) {
                        $("#goods_freight_info").find(".limit-sale").show();
                    } else {
                        $("#goods_freight_info").find(".limit-sale").hide();
                    }
                    if (result.data.freight.is_free == 1) {
                        $("#goods_freight_info").find(".is-free").show();
                    } else {
                        $("#goods_freight_info").find(".is-free").hide();
                    }

                    if (result.data.freight.free_set == 1) {
                        $("#goods_freight_info").find(".free-set").show();
                    } else {
                        $("#goods_freight_info").find(".free-set").hide();
                    }

                    $("#goods_freight_info").find(".goods-from").html(result.data.freight.region_names);

                    $("#goods_freight_info").show();
                } else {
                    $("#goods_freight_info").hide();
                }
            }, "json");
        });
        $(".freight-list").change();
    });
</script>
<!-- JSON2 -->
<script src="/assets/d2eace91/js/jquery.json-2.4.js?v=20180418"></script>
<!-- 在线文本编辑器 -->
<script src="/assets/d2eace91/js/editor/kindeditor-all.min.js?v=20180418"></script>
<script src="/assets/d2eace91/js/editor/lang/zh_CN.js?v=20180418"></script>
<!-- 创建KindEditor的脚本 必须设置editor_id属性-->
<script type="text/javascript">
    KindEditor.ready(function(K) {

        var extraFileUploadParams = [];
        extraFileUploadParams['B2B2C_YUNMALL_68MALL_COM_USER_PHPSESSID'] = 'sjl2ldbhqo84ht2090oh1pdb33';

        window.editor = K.create('#pc_desc', {
            width: '830px',
            height: '450px',
            items: ['source', '|', 'fullscreen', 'undo', 'redo', 'print', 'cut', 'copy', 'paste', 'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright', 'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript', 'superscript', '|', 'selectall', 'clearhtml', 'quickformat', '|', 'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'flash', 'media', 'table', 'hr', 'emoticons', 'link', 'unlink', '|', 'about'],
            themesPath: "/assets/d2eace91/js/editor/themes/",
            cssPath: "/assets/d2eace91/js/editor/themes/default/default.css",
            uploadJson: "/site/upload-image.html",
            extraFileUploadParams: extraFileUploadParams,
            allowImageUpload: true,
            allowFlashUpload: false,
            allowMediaUpload: false,
            allowFileManager: true,
            syncType: "form",
            // 设置粘贴类型，0:禁止粘贴, 1:纯文本粘贴, 2:HTML粘贴
            pasteType: 2,
            afterCreate: function() {
                var self = this;
                self.sync();
            },
            afterChange: function() {
                var self = this;
                self.sync();
            },
            afterBlur: function() {
                var self = this;
                self.sync();
            }
        });
    });
</script>
<!-- 手机端详情 -->
<script type="text/javascript">
    $().ready(function() {

        // 添加文本
        $("#btn_mobile_add_text").click(function() {
            $("#mobile_text_editor").show();
            $("#mobile_text_editor").css("z-index", 99);
            $("#mobile_text_editor").offset({
                top: $(".content-edit").offset().top,
                left: $(".content-edit").offset().left
            });
        });

        // 添加手机端图片
        $("#btn_mobile_add_image").click(function() {
            $.imageupload({
                url: '/site/upload-mobile-image',
                callback: function(result) {
                    if (result.code == 0) {
                        var template = $("#mobile_image_template").html();
                        var element = $($.parseHTML(template));
                        $(element).find("img").attr("src", result.data.url);
                        $(element).find("img").data("path", result.data.path);
                        $(".mobile-editor").find(".control-panel").append(element);
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }
            });
        });

        $("#mobile_text_editor").find(".ok").click(function() {
            var content = $("#mobile_text_editor").find("textarea").val();

            var target = $("#mobile_text_editor").find("textarea").data("target");

            if (target == null) {
                var template = $("#mobile_text_template").html();
                var element = $($.parseHTML(template));
                $(element).find(".text-html").html("");
                // 防止执行js
                $(element).find(".text-html").append($.parseHTML(content));
                var html = $(element).find(".text-html").html();
                if (html.length == 0) {
                    $("#mobile_text_editor").find("textarea").val("");
                    $("#mobile_text_editor").hide();
                    return;
                }
                $(".mobile-editor").find(".control-panel").append(element);
            } else {
                $(target).html("");
                // 防止执行js
                $(target).html($.parseHTML(content));
                var html = $(target).html();
                if (html.length == 0) {
                    $("#mobile_text_editor").find("textarea").val("");
                    $("#mobile_text_editor").hide();
                    return;
                }
            }

            // 置空
            $("#mobile_text_editor").find("textarea").data("target", null);

            $("#mobile_text_editor").find("textarea").val("");
            $("#mobile_text_editor").hide();
        });

        $("#mobile_text_editor").find(".cancel").click(function() {
            $("#mobile_text_editor").find("textarea").val("");
            $("#mobile_text_editor").hide();
        });

        $("body").click(function() {
            $(".control-panel").find(".current").removeClass("current");
        });

        // 点击展示出遮罩层和工具栏
        $("body").on("click", "div .module", function() {
            $(this).parents(".control-panel").find(".current").removeClass("current");
            $(this).addClass("current");
            return false;
        });
        //上移
        $(".control-panel").on("click", ".up", function() {
            if ($(this).parents(".module").prev().size() == 0) {
                $.msg("已经到最顶端了");
                return;
            }
            var target = $(this).parents(".module");
            $(target).insertBefore($(this).parents(".module").prev());
        });
        //下移
        $(".control-panel").on("click", ".down", function() {
            if ($(this).parents(".module").next().size() == 0) {
                $.msg("已经到最低端了");
                return;
            }
            var target = $(this).parents(".module");
            $(target).insertAfter($(this).parents(".module").next());
        });
        //移除
        $(".control-panel").on("click", ".delete", function() {
            $(this).parents(".module").remove();
        });
        //编辑
        $(".control-panel").on("click", ".edit", function() {
            var content = $(this).parents(".module").find(".text-html").html();
            $("#mobile_text_editor").find("textarea").val(content);
            //保存编辑目标信息
            $("#mobile_text_editor").find("textarea").data("target", $(this).parents(".module").find(".text-html"));
            $("#btn_mobile_add_text").click();
        });
        //替换
        $(".control-panel").on("click", ".replace", function() {
            var target = $(this).parents(".module");
            $.imageupload({
                url: '/site/upload-mobile-image',
                callback: function(result) {
                    if (result.code == 0) {
                        $(target).find("img").attr("src", result.data.url);
                        $(target).find("img").data("path", result.data.path);
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }
            });
        });
    });
</script>
<!-- 发布商品 -->
<script type="text/javascript">
    $().ready(function() {
        $(".panel-collapse .panel-body").mCustomScrollbar();
        var validator = $("#GoodsModel").validate();
        // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules("[{\"id\": \"goodsmodel-cat_id1\", \"name\": \"GoodsModel[cat_id1]\", \"attribute\": \"cat_id1\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"Cat Id1必须是整数。\"}}},{\"id\": \"goodsmodel-cat_id2\", \"name\": \"GoodsModel[cat_id2]\", \"attribute\": \"cat_id2\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"Cat Id2必须是整数。\"}}},{\"id\": \"goodsmodel-cat_id3\", \"name\": \"GoodsModel[cat_id3]\", \"attribute\": \"cat_id3\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"Cat Id3必须是整数。\"}}},{\"id\": \"goodsmodel-pricing_mode\", \"name\": \"GoodsModel[pricing_mode]\", \"attribute\": \"pricing_mode\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"计价方式必须是整数。\"}}},{\"id\": \"goodsmodel-goods_unit\", \"name\": \"GoodsModel[goods_unit]\", \"attribute\": \"goods_unit\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"商品单位必须是整数。\"}}},{\"id\": \"goodsmodel-filter_attr_ids\", \"name\": \"GoodsModel[filter_attr_ids]\", \"attribute\": \"filter_attr_ids\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"Filter Attr Ids必须是一条字符串。\"}}},{\"id\": \"goodsmodel-filter_attr_vids\", \"name\": \"GoodsModel[filter_attr_vids]\", \"attribute\": \"filter_attr_vids\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"Filter Attr Vids必须是一条字符串。\"}}},{\"id\": \"goodsmodel-goods_stockcode\", \"name\": \"GoodsModel[goods_stockcode]\", \"attribute\": \"goods_stockcode\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"商品库位码必须是一条字符串。\"}}},{\"id\": \"goodsmodel-goods_name\", \"name\": \"GoodsModel[goods_name]\", \"attribute\": \"goods_name\", \"rules\": {\"required\":true,\"messages\":{\"required\":\"商品名称不能为空。\"}}},{\"id\": \"goodsmodel-cat_id\", \"name\": \"GoodsModel[cat_id]\", \"attribute\": \"cat_id\", \"rules\": {\"required\":true,\"messages\":{\"required\":\"商品分类不能为空。\"}}},{\"id\": \"goodsmodel-shop_id\", \"name\": \"GoodsModel[shop_id]\", \"attribute\": \"shop_id\", \"rules\": {\"required\":true,\"messages\":{\"required\":\"店铺ID不能为空。\"}}},{\"id\": \"goodsmodel-goods_price\", \"name\": \"GoodsModel[goods_price]\", \"attribute\": \"goods_price\", \"rules\": {\"required\":false,\"messages\":{\"required\":\"店铺价不能为空。\"}}},{\"id\": \"goodsmodel-goods_number\", \"name\": \"GoodsModel[goods_number]\", \"attribute\": \"goods_number\", \"rules\": {\"required\":true,\"messages\":{\"required\":\"商品库存不能为空。\"}}},{\"id\": \"goodsmodel-add_time\", \"name\": \"GoodsModel[add_time]\", \"attribute\": \"add_time\", \"rules\": {\"required\":true,\"messages\":{\"required\":\"商品发布时间不能为空。\"}}},{\"id\": \"goodsmodel-last_time\", \"name\": \"GoodsModel[last_time]\", \"attribute\": \"last_time\", \"rules\": {\"required\":true,\"messages\":{\"required\":\"最后一次更新时间不能为空。\"}}},{\"id\": \"goodsmodel-freight_id\", \"name\": \"GoodsModel[freight_id]\", \"attribute\": \"freight_id\", \"rules\": {\"required\":false,\"messages\":{\"required\":\"运费模板不能为空。\"}}},{\"id\": \"goodsmodel-sku_open\", \"name\": \"GoodsModel[sku_open]\", \"attribute\": \"sku_open\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"Sku Open必须是整数。\"}}},{\"id\": \"goodsmodel-sku_id\", \"name\": \"GoodsModel[sku_id]\", \"attribute\": \"sku_id\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"Sku Id必须是整数。\"}}},{\"id\": \"goodsmodel-cat_id\", \"name\": \"GoodsModel[cat_id]\", \"attribute\": \"cat_id\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"商品分类必须是整数。\"}}},{\"id\": \"goodsmodel-shop_id\", \"name\": \"GoodsModel[shop_id]\", \"attribute\": \"shop_id\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"店铺ID必须是整数。\"}}},{\"id\": \"goodsmodel-invoice_type\", \"name\": \"GoodsModel[invoice_type]\", \"attribute\": \"invoice_type\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"发票必须是整数。\"}}},{\"id\": \"goodsmodel-is_repair\", \"name\": \"GoodsModel[is_repair]\", \"attribute\": \"is_repair\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"保修必须是整数。\"}}},{\"id\": \"goodsmodel-user_discount\", \"name\": \"GoodsModel[user_discount]\", \"attribute\": \"user_discount\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"会员打折必须是整数。\"}}},{\"id\": \"goodsmodel-stock_mode\", \"name\": \"GoodsModel[stock_mode]\", \"attribute\": \"stock_mode\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"库存计数必须是整数。\"}}},{\"id\": \"goodsmodel-goods_number\", \"name\": \"GoodsModel[goods_number]\", \"attribute\": \"goods_number\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"商品库存必须是整数。\"}}},{\"id\": \"goodsmodel-warn_number\", \"name\": \"GoodsModel[warn_number]\", \"attribute\": \"warn_number\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"库存警告数量必须是整数。\"}}},{\"id\": \"goodsmodel-brand_id\", \"name\": \"GoodsModel[brand_id]\", \"attribute\": \"brand_id\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"品牌必须是整数。\"}}},{\"id\": \"goodsmodel-top_layout_id\", \"name\": \"GoodsModel[top_layout_id]\", \"attribute\": \"top_layout_id\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"商品顶部模板编号必须是整数。\"}}},{\"id\": \"goodsmodel-bottom_layout_id\", \"name\": \"GoodsModel[bottom_layout_id]\", \"attribute\": \"bottom_layout_id\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"商品底部模板编号必须是整数。\"}}},{\"id\": \"goodsmodel-packing_layout_id\", \"name\": \"GoodsModel[packing_layout_id]\", \"attribute\": \"packing_layout_id\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"Packing Layout Id必须是整数。\"}}},{\"id\": \"goodsmodel-service_layout_id\", \"name\": \"GoodsModel[service_layout_id]\", \"attribute\": \"service_layout_id\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"Service Layout Id必须是整数。\"}}},{\"id\": \"goodsmodel-click_count\", \"name\": \"GoodsModel[click_count]\", \"attribute\": \"click_count\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"商品浏览次数必须是整数。\"}}},{\"id\": \"goodsmodel-goods_audit\", \"name\": \"GoodsModel[goods_audit]\", \"attribute\": \"goods_audit\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"审核是否通过必须是整数。\"}}},{\"id\": \"goodsmodel-goods_status\", \"name\": \"GoodsModel[goods_status]\", \"attribute\": \"goods_status\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"商品状态必须是整数。\"}}},{\"id\": \"goodsmodel-is_delete\", \"name\": \"GoodsModel[is_delete]\", \"attribute\": \"is_delete\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"是否已删除必须是整数。\"}}},{\"id\": \"goodsmodel-is_virtual\", \"name\": \"GoodsModel[is_virtual]\", \"attribute\": \"is_virtual\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"Is Virtual必须是整数。\"}}},{\"id\": \"goodsmodel-is_best\", \"name\": \"GoodsModel[is_best]\", \"attribute\": \"is_best\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"是否精品必须是整数。\"}}},{\"id\": \"goodsmodel-is_new\", \"name\": \"GoodsModel[is_new]\", \"attribute\": \"is_new\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"是否新品必须是整数。\"}}},{\"id\": \"goodsmodel-is_hot\", \"name\": \"GoodsModel[is_hot]\", \"attribute\": \"is_hot\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"是否热卖必须是整数。\"}}},{\"id\": \"goodsmodel-is_promote\", \"name\": \"GoodsModel[is_promote]\", \"attribute\": \"is_promote\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"是否促销必须是整数。\"}}},{\"id\": \"goodsmodel-supplier_id\", \"name\": \"GoodsModel[supplier_id]\", \"attribute\": \"supplier_id\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"供货商ID必须是整数。\"}}},{\"id\": \"goodsmodel-freight_id\", \"name\": \"GoodsModel[freight_id]\", \"attribute\": \"freight_id\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"运费模板必须是整数。\"}}},{\"id\": \"goodsmodel-goods_sort\", \"name\": \"GoodsModel[goods_sort]\", \"attribute\": \"goods_sort\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"Goods Sort必须是整数。\"}}},{\"id\": \"goodsmodel-audit_time\", \"name\": \"GoodsModel[audit_time]\", \"attribute\": \"audit_time\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"Audit Time必须是整数。\"}}},{\"id\": \"goodsmodel-add_time\", \"name\": \"GoodsModel[add_time]\", \"attribute\": \"add_time\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"商品发布时间必须是整数。\"}}},{\"id\": \"goodsmodel-last_time\", \"name\": \"GoodsModel[last_time]\", \"attribute\": \"last_time\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"最后一次更新时间必须是整数。\"}}},{\"id\": \"goodsmodel-comment_num\", \"name\": \"GoodsModel[comment_num]\", \"attribute\": \"comment_num\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"商品评论次数必须是整数。\"}}},{\"id\": \"goodsmodel-sale_num\", \"name\": \"GoodsModel[sale_num]\", \"attribute\": \"sale_num\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"商品销售数量必须是整数。\"}}},{\"id\": \"goodsmodel-collect_num\", \"name\": \"GoodsModel[collect_num]\", \"attribute\": \"collect_num\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"商品收藏数量必须是整数。\"}}},{\"id\": \"goodsmodel-sales_model\", \"name\": \"GoodsModel[sales_model]\", \"attribute\": \"sales_model\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"销售模式必须是整数。\"}}},{\"id\": \"goodsmodel-goods_images\", \"name\": \"GoodsModel[goods_images]\", \"attribute\": \"goods_images\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"Goods Images必须是一条字符串。\"}}},{\"id\": \"goodsmodel-button_name\", \"name\": \"GoodsModel[button_name]\", \"attribute\": \"button_name\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"按钮名称必须是一条字符串。\"}}},{\"id\": \"goodsmodel-button_url\", \"name\": \"GoodsModel[button_url]\", \"attribute\": \"button_url\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"按钮链接必须是一条字符串。\"}}},{\"id\": \"goodsmodel-goods_price\", \"name\": \"GoodsModel[goods_price]\", \"attribute\": \"goods_price\", \"rules\": {\"number\":{\"pattern\":\"\/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$\/\"},\"messages\":{\"number\":\"店铺价必须是一个数字。\",\"decimal\":\"店铺价必须是一个不大于2位小数的数字。\",\"min\":\"店铺价必须不小于0。\",\"max\":\"店铺价必须不大于9999999。\"},\"decimal\":2,\"min\":0,\"max\":9999999}},{\"id\": \"goodsmodel-market_price\", \"name\": \"GoodsModel[market_price]\", \"attribute\": \"market_price\", \"rules\": {\"number\":{\"pattern\":\"\/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$\/\"},\"messages\":{\"number\":\"市场价必须是一个数字。\",\"decimal\":\"市场价必须是一个不大于2位小数的数字。\",\"min\":\"市场价必须不小于0。\",\"max\":\"市场价必须不大于9999999。\"},\"decimal\":2,\"min\":0,\"max\":9999999}},{\"id\": \"goodsmodel-warn_number\", \"name\": \"GoodsModel[warn_number]\", \"attribute\": \"warn_number\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"库存警告数量必须是整数。\",\"min\":\"库存警告数量必须不小于0。\",\"max\":\"库存警告数量必须不大于255。\"},\"min\":0,\"max\":255}},{\"id\": \"goodsmodel-goods_number\", \"name\": \"GoodsModel[goods_number]\", \"attribute\": \"goods_number\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"商品库存必须是整数。\",\"min\":\"商品库存必须不小于0。\",\"max\":\"商品库存必须不大于999999999。\"},\"min\":0,\"max\":999999999}},{\"id\": \"goodsmodel-cost_price\", \"name\": \"GoodsModel[cost_price]\", \"attribute\": \"cost_price\", \"rules\": {\"number\":{\"pattern\":\"\/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$\/\"},\"messages\":{\"number\":\"成本价必须是一个数字。\",\"decimal\":\"成本价必须是一个不大于2位小数的数字。\",\"min\":\"成本价必须不小于0。\",\"max\":\"成本价必须不大于9999999。\"},\"decimal\":2,\"min\":0,\"max\":9999999}},{\"id\": \"goodsmodel-mobile_price\", \"name\": \"GoodsModel[mobile_price]\", \"attribute\": \"mobile_price\", \"rules\": {\"number\":{\"pattern\":\"\/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$\/\"},\"messages\":{\"number\":\"移动端专项价必须是一个数字。\",\"decimal\":\"移动端专项价必须是一个不大于2位小数的数字。\",\"min\":\"移动端专项价必须不小于0。\",\"max\":\"移动端专项价必须不大于9999999。\"},\"decimal\":2,\"min\":0,\"max\":9999999}},{\"id\": \"goodsmodel-pc_desc\", \"name\": \"GoodsModel[pc_desc]\", \"attribute\": \"pc_desc\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"商品电脑端描述必须是一条字符串。\"}}},{\"id\": \"goodsmodel-mobile_desc\", \"name\": \"GoodsModel[mobile_desc]\", \"attribute\": \"mobile_desc\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"商品手机端描述必须是一条字符串。\"}}},{\"id\": \"goodsmodel-contract_ids\", \"name\": \"GoodsModel[contract_ids]\", \"attribute\": \"contract_ids\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"保障服务必须是一条字符串。\"}}},{\"id\": \"goodsmodel-goods_name\", \"name\": \"GoodsModel[goods_name]\", \"attribute\": \"goods_name\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"商品名称必须是一条字符串。\",\"minlength\":\"商品名称应该包含至少3个字符。\",\"maxlength\":\"商品名称只能包含至多60个字符。\"},\"minlength\":3,\"maxlength\":60}},{\"id\": \"goodsmodel-goods_subname\", \"name\": \"GoodsModel[goods_subname]\", \"attribute\": \"goods_subname\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"商品卖点必须是一条字符串。\",\"maxlength\":\"商品卖点只能包含至多140个字符。\"},\"maxlength\":140}},{\"id\": \"goodsmodel-goods_image\", \"name\": \"GoodsModel[goods_image]\", \"attribute\": \"goods_image\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"商品主图必须是一条字符串。\",\"maxlength\":\"商品主图只能包含至多255个字符。\"},\"maxlength\":255}},{\"id\": \"goodsmodel-goods_video\", \"name\": \"GoodsModel[goods_video]\", \"attribute\": \"goods_video\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"主图视频必须是一条字符串。\",\"maxlength\":\"主图视频只能包含至多255个字符。\"},\"maxlength\":255}},{\"id\": \"goodsmodel-keywords\", \"name\": \"GoodsModel[keywords]\", \"attribute\": \"keywords\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"关键词必须是一条字符串。\",\"maxlength\":\"关键词只能包含至多255个字符。\"},\"maxlength\":255}},{\"id\": \"goodsmodel-goods_info\", \"name\": \"GoodsModel[goods_info]\", \"attribute\": \"goods_info\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"商品简介必须是一条字符串。\",\"maxlength\":\"商品简介只能包含至多255个字符。\"},\"maxlength\":255}},{\"id\": \"goodsmodel-goods_reason\", \"name\": \"GoodsModel[goods_reason]\", \"attribute\": \"goods_reason\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"Goods Reason必须是一条字符串。\",\"maxlength\":\"Goods Reason只能包含至多255个字符。\"},\"maxlength\":255}},{\"id\": \"goodsmodel-goods_volume\", \"name\": \"GoodsModel[goods_volume]\", \"attribute\": \"goods_volume\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"物流体积(m3)必须是一条字符串。\",\"maxlength\":\"物流体积(m3)只能包含至多255个字符。\"},\"maxlength\":255}},{\"id\": \"goodsmodel-goods_weight\", \"name\": \"GoodsModel[goods_weight]\", \"attribute\": \"goods_weight\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"物流重量(Kg)必须是一条字符串。\",\"maxlength\":\"物流重量(Kg)只能包含至多255个字符。\"},\"maxlength\":255}},{\"id\": \"goodsmodel-goods_remark\", \"name\": \"GoodsModel[goods_remark]\", \"attribute\": \"goods_remark\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"商品备注必须是一条字符串。\",\"maxlength\":\"商品备注只能包含至多255个字符。\"},\"maxlength\":255}},{\"id\": \"goodsmodel-goods_sn\", \"name\": \"GoodsModel[goods_sn]\", \"attribute\": \"goods_sn\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"商品货号必须是一条字符串。\",\"maxlength\":\"商品货号只能包含至多60个字符。\"},\"maxlength\":60}},{\"id\": \"goodsmodel-goods_barcode\", \"name\": \"GoodsModel[goods_barcode]\", \"attribute\": \"goods_barcode\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"商品条形码必须是一条字符串。\",\"maxlength\":\"商品条形码只能包含至多1,500个字符。\"},\"maxlength\":1500}},{\"id\": \"goodsmodel-invoice_type\", \"name\": \"GoodsModel[invoice_type]\", \"attribute\": \"invoice_type\", \"rules\": {\"in\":{\"range\":[\"0\",\"1\",\"2\",\"3\"]},\"messages\":{\"in\":\"发票是无效的。\"}}},{\"id\": \"goodsmodel-is_repair\", \"name\": \"GoodsModel[is_repair]\", \"attribute\": \"is_repair\", \"rules\": {\"in\":{\"range\":[\"0\",\"1\"]},\"messages\":{\"in\":\"保修是无效的。\"}}},{\"id\": \"goodsmodel-user_discount\", \"name\": \"GoodsModel[user_discount]\", \"attribute\": \"user_discount\", \"rules\": {\"in\":{\"range\":[\"0\",\"1\"]},\"messages\":{\"in\":\"会员打折是无效的。\"}}},{\"id\": \"goodsmodel-stock_mode\", \"name\": \"GoodsModel[stock_mode]\", \"attribute\": \"stock_mode\", \"rules\": {\"in\":{\"range\":[\"0\",\"1\",\"2\"]},\"messages\":{\"in\":\"库存计数是无效的。\"}}},{\"id\": \"goodsmodel-goods_status\", \"name\": \"GoodsModel[goods_status]\", \"attribute\": \"goods_status\", \"rules\": {\"in\":{\"range\":[\"0\",\"1\",\"2\"]},\"messages\":{\"in\":\"商品状态是无效的。\"}}},{\"id\": \"goodsmodel-goods_freight_type\", \"name\": \"GoodsModel[goods_freight_type]\", \"attribute\": \"goods_freight_type\", \"rules\": {\"in\":{\"range\":[\"0\",\"1\",\"2\"]},\"messages\":{\"in\":\"运费设置是无效的。\"}}},{\"id\": \"goodsmodel-goods_freight_fee\", \"name\": \"GoodsModel[goods_freight_fee]\", \"attribute\": \"goods_freight_fee\", \"rules\": {\"number\":{\"pattern\":\"\/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$\/\"},\"messages\":{\"number\":\"商品固定运费必须是一个数字。\",\"decimal\":\"商品固定运费必须是一个不大于2位小数的数字。\",\"min\":\"商品固定运费必须不小于0。\",\"max\":\"商品固定运费必须不大于9999999。\"},\"decimal\":2,\"min\":0,\"max\":9999999}},{\"id\": \"goodsmodel-goods_sn\", \"name\": \"GoodsModel[goods_sn]\", \"attribute\": \"goods_sn\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"商品货号必须是一条字符串。\",\"maxlength\":\"商品货号只能包含至多20个字符。\"},\"maxlength\":20}},{\"id\": \"goodsmodel-goods_barcode\", \"name\": \"GoodsModel[goods_barcode]\", \"attribute\": \"goods_barcode\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"商品条形码必须是一条字符串。\",\"maxlength\":\"商品条形码只能包含至多1,500个字符。\"},\"maxlength\":1500}},{\"id\": \"goodsmodel-goods_moq\", \"name\": \"GoodsModel[goods_moq]\", \"attribute\": \"goods_moq\", \"rules\": {\"integer\":{\"pattern\":\"\/^\\s*[+-]?\\d+\\s*$\/\"},\"messages\":{\"integer\":\"最小起订量必须是整数。\",\"min\":\"最小起订量必须不小于1。\"},\"min\":1}},{\"id\": \"goodsmodel-button_name\", \"name\": \"GoodsModel[button_name]\", \"attribute\": \"button_name\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"按钮名称必须是一条字符串。\"}}},{\"id\": \"goodsmodel-button_url\", \"name\": \"GoodsModel[button_url]\", \"attribute\": \"button_url\", \"rules\": {\"string\":true,\"messages\":{\"string\":\"按钮链接必须是一条字符串。\"}}},{\"id\": \"goodsmodel-goods_freight_fee\", \"name\": \"GoodsModel[goods_freight_fee]\", \"attribute\": \"goods_freight_fee\", \"rules\": {\"required\":true,\"messages\":{\"required\":\"商品固定运费不能为空。\"}}},{\"id\": \"goodsmodel-freight_id\", \"name\": \"GoodsModel[freight_id]\", \"attribute\": \"freight_id\", \"rules\": {\"compare\":{\"operator\":\"\u003E\",\"type\":\"number\",\"compareValue\":0,\"skipOnEmpty\":1},\"messages\":{\"compare\":\"运费模板不能为空\"},\"when\":\"function(){console.info($(\u0027.goods-freight-type:checked\u0027).val());return $(\u0027.goods-freight-type:checked\u0027).val() == 2;}\"}},]");

        $.validator.addMethod("uniqueOtherSpecName", function(value, element, param) {
            if ($(element).siblings(":checkbox").is(":checked") == false) {
                return true;
            }

            if (value == "") {
                $(element).focus();
                return false;
            }

            var is_repeat = false;

            $(element).parents("[data-spec-id]").find(".spec-other-text,[value='" + value + "']").not(element).each(function() {
                if ($(this).siblings(":checkbox").is(":checked") == true) {
                    if ($(this).val() == value) {
                        $(element).focus();
                        is_repeat = true;
                        return false;
                    }
                }
            });

            return !is_repeat;
        }, "自定义的规格名称不能重复");

        var error_list = [];

        $("#btn_publish").click(function() {

            var cat_id = $("#goodsmodel-cat_id").val();

            // if (cat_id == "" || cat_id == 0) {
            //     $.msg("商品分类不能为空！");
            //     return false;
            // }

            if (!validator.form()) {
                var html = "";

                error_list = validator.errorList;

                for (var i = 0; i < validator.errorList.length; i++) {
                    var element = validator.errorList[i].element;
                    var message = validator.errorList[i].message;

                    html += "<div><a href='javascript:void(0);' data-id='" + i + "'>" + message + "</a></div>";
                }

                $.alert("<div id='error_list'>" + html + "</div>");

                $("#error_list").find("a").click(function() {
                    var id = $(this).data("id");

                    var element = $(error_list[id].element);

                    $(element).focus();
                    $(window).scrollTop($(element).offset().top - $(window).height() + 120);
                })

                return false;
            }

            // AJAX发布商品
            var goods = $("#GoodsModel").serializeJson();

            goods.GoodsModel.mobile_desc = [];

            // 获取移动端详情
            $(".mobile-editor").find(".module").each(function() {
                if ($(this).find(".text-html").size() > 0) {
                    var content = $(this).find(".text-html").html();
                    if (content.length > 0) {
                        goods.GoodsModel.mobile_desc.push({
                            'content': content,
                            'type': 0
                        });
                    }
                } else if ($(this).find("img").size() > 0) {
                    var path = $(this).find("img").data("path");
                    if (path) {
                        goods.GoodsModel.mobile_desc.push({
                            'content': path,
                            'type': 1
                        });
                    }
                }
            });

            // 获取商品属性设置
            goods.goods_attrs = [];
            $(".attr-values").each(function() {
                var attr_id = $(this).data("attr-id");
                var required = $(this).data("required");
                var object = $(this).serializeJson();

                if (object['goods_attrs']) {
                    object = object['goods_attrs'][attr_id];
                    goods.goods_attrs.push({
                        attr_id: attr_id,
                        attr_vid: object
                    });
                }
            });

            // 获取商品规格设置
            goods.goods_specs = [];

            $(".spec-values").find(":checkbox:checked").each(function() {
                var attr_id = $(this).data("attr-id");
                var attr_vid = $(this).data("vid");
                var attr_vname = $(this).data("vname");
                var attr_desc = $(this).siblings(".spec-desc").val();

                if (new String(attr_vid).indexOf("other_") == 0) {
                    attr_vname = $(this).siblings(".spec-other-text").val();
                    if ($.trim(attr_vname) == '') {
                        attr_vname = '其他';
                    }
                    attr_vid = getOtherValue(attr_id, attr_vname);
                }

                goods.goods_specs.push({
                    attr_id: attr_id,
                    attr_vid: attr_vid,
                    attr_vname: attr_vname,
                    attr_desc: attr_desc
                });
            });

            // 获取商品SKU设置
            goods.sku_list = [];
            $("#sku_table").find("tbody").find("tr").each(function() {
                var object = $(this).serializeJson();
                goods.sku_list.push(object);
            });

            // 获取商品详情
            KindEditor.ready(function(K) {
                // var html = K.create("#pc_desc").html();
                var html = $('textarea[name="GoodsModel[pc_desc]"]').val();
                // $("#pc_desc").val(html);
                goods['GoodsModel']['pc_desc'] = html;
            });

            //设置其他无关属性为空
            goods.specs = null;
            goods.other_spec = null;

            // 扩展分类
            goods.other_cat_ids = [];
            $(".other-cat").find("select").each(function() {
                if ($(this).val() != 0) {
                    goods.other_cat_ids.push($(this).val());
                }
            });

            goods.other_attrs = [];

            // 店铺自定义属性处理
            $(".other-attrs-item").each(function() {

                var item = $(this).serializeJson();

                if ($.trim(item.other_attr_name) != "" || $.trim(item.other_attr_value) != "") {
                    if ($.trim(item.other_attr_name) == "") {
                        $.msg("属性名称不能为空");
                        $(this).find(".other-attr-name").focus();
                        $('html, body').animate({
                            scrollTop: $(this).offset().top - 100
                        }, 500);
                        return false;
                    } else if ($.trim(item.other_attr_value) == "") {
                        $.msg("属性值不能为空");
                        $(this).find(".other-attr-value").focus();
                        $('html, body').animate({
                            scrollTop: $(this).offset().top - 100
                        }, 500);
                        return false;
                    }
                    goods.other_attrs.push({
                        attr_name: item.other_attr_name,
                        attr_value: item.other_attr_value
                    });
                }
            });

            //处理阶梯价格
            if ($('.goods-stepped-price').length > 0 && !$('.goods-stepped-price').hasClass('hide')) {
                goods.step_price = validStepPrice();
                if (goods.step_price == false) {
                    return;
                }
            }

            // 扩展分类
            var other_cat_ids = $("#other_cat_ids").val();

            if(other_cat_ids == ""){
                goods.other_cat_ids = [];
            }else{
                goods.other_cat_ids = other_cat_ids.split(",");
            }

            var data = JSON.stringify(goods);

            // 加载
            $.loading.start();

            if ("" == "") {
                //saveData保存方法
                $.post('/goods/publish/add?cat_id={{ $cat_id }}', {
                    data: data
                }, function(result) {
                    // 停止加载
                    $.loading.stop();

                    if (result.code == 0) {
                        $.msg(result.message);
                        // 发布成功跳转页面
                        var goods_id = result.data;

                        // 加载
                        $.loading.start();
                        $.go('/func/goods/add-images?id=' + goods_id);
                    } else {
                        $.alert(result.message);
                    }
                }, 'json');
            } else {
                $.post('/goods/publish/edit?id=&scid=', {
                    data: data
                }, function(result) {
                    // 停止加载
                    $.loading.stop();

                    if (result.code == 0) {
                        $.msg(result.message, {
                            time: 2000
                        }, function() {
                            // 加载
                            $.loading.start();
                            $.go('/goods/publish/edit?id=&scid=');
                        });
                    } else {
                        $.alert(result.message);
                    }
                }, 'json');
            }

        });

        function validFreightId() {
            if ($("#goodsmodel-goods_freight_type_2").is(":checked") && $("#goodsmodel-freight_id").val() == 0) {
                $.validator.showError($("#goodsmodel-freight_id"), "运费模板不能为空");
            } else {
                $.validator.clearError($("#goodsmodel-freight_id"));
            }
        }

        $(".goods-freight-type").click(function() {
            validFreightId();
            var freight_fee_valid = $("#goodsmodel-goods_freight_fee").valid();

            if ($(this).val() != 1 && freight_fee_valid == false) {
                $("#goodsmodel-goods_freight_fee").val("0.00");
                $("#goodsmodel-goods_freight_fee").valid();
            }

            if ($(this).val() != 2) {
                $("#goodsmodel-freight_id").val("0");
                $("#goods_freight_info").hide();
            }
        });

        $("body").on("change", "#goodsmodel-freight_id", function() {

            var freight_fee_valid = $("#goodsmodel-goods_freight_fee").valid();

            if ($(".goods-freight-type:checked").val() != 1 && freight_fee_valid == false) {
                $("#goodsmodel-goods_freight_fee").val("0.00");
                $("#goodsmodel-goods_freight_fee").valid();
            }
        });

        // 批量设置
        $("body").on("click", ".btn_batch_set", function() {
            var field = $(this).data("field");
            var value = $(this).parents(".batch-input").find(":text").val();
            $(this).parents("table").find("[name='" + field + "']").val(value);
            $(this).parents(".batch-input").find(".batch-close").click();
            // 合计
            if (field == 'goods_number') {
                $(".sku-goods-number").keyup();
            }
            if (field == 'warn_number') {
                $(".sku-warn-number").keyup();
            }
            if (field == 'goods_price') {
                $(".sku-goods-price").keyup();
            }
            if (field == 'market_price') {
                $(".sku-market-price").keyup();
            }
        });

        // 刷新运费模板
        $(".refresh-layout-list").click(function() {

            $.loading.start();

            $.get('/goods/publish/layouts', {}, function(result) {
                if (result.code == 0) {

                    for (var i = 0; i < result.data.length; i++) {

                        var html = "";

                        var list = result.data[i];

                        for (var j = 0; j < list.length; j++) {
                            var item = list[j];
                            html += "<option value='"+item.layout_id+"'>" + item.layout_name + "</option>";
                        }

                        $("[data-layout-position='" + i + "']").html(html);

                    }

                } else {
                    $.msg(result.message, {
                        time: 5000
                    });
                }
            }, "json").always(function() {
                $.loading.stop()
            });
        });

        $("#btn_view").click(function() {
            $.go("http://www.b2b2c.yunmall.laravelvip.com/goods-.html", "_blank");
        });

        //添加分类按钮
        $("#btn_addCategory").click(function() {
            $(".choosen-select-box").append("");
        });

        // 鼠标悬浮
        $("body").on("mouseenter", ".batch-edit", function() {
            $.tips('点击批量设置', $(this), {
                tips: 1,
                time: 2000
            });
        });

        var goods_id = "";

        $("#change_category").click(function() {
            if (!confirm("此页面要求您确认想要离开 - 您输入的数据可能不会被保存。")) {
                return false;
            }

            if (goods_id == "") {
                $.go("/goods/publish/index");
            } else {
                $.go("/goods/publish/index?id=");
            }
        });

        $("#btn_add_other_attr").click(function() {
            var template = $("#other_attrs_template").html();
            $(".other-attrs-list").append(template);
            $('.chosen-select').chosen();//初始化chosen
        });

        $("body").on("click", ".other-attr-remove", function() {
            var target = $(this);
            $.confirm("您确定要移除此属性吗？", function(index) {
                $(target).parents(".other-attrs-item").remove();
            });
        });
    });
</script>
<script type="text/javascript">
    $(function() {
        // 批量设置价格、库存、预警值
        $("body").on('click', ".batch > .batch-edit", function() {
            $('.batch > .batch-input').hide();
            $(this).next().show();
            // 批量设置获取焦点
            $(this).parents(".batch").find(".batch-input").find(":text").focus();
        });
        $("body").on('click', ".batch-input > .batch-close", function() {
            $(this).parent().hide();
        });

        // 商品描述手机端详情导入弹框
        $('.size-tip > .leading-in').click(function() {
            $('.size-tip > .build-mdetail').show();
            return false;
        });
        $('.size-tip').find('.btn-close').click(function() {
            $('.size-tip > .build-mdetail').hide();
            return false;
        });
        $('.size-tip').find('.btn-default').click(function() {
            $('.size-tip > .build-mdetail').hide();
            return false;
        });
    })
</script>
<!-- 店铺自定义规格 -->
<script id="shop_spec_template" type="text">
    <span class="spec-values-item">
        <label class="control-label">
            <input type="checkbox" value="#attr_id#" checked="checked"/>
            #attr_name#
        </label>
        <!-- <a class="default-spec" href="javascript:void(0);" title="点击设置为默认规格">默认</a> -->
    </span>
</script>
<script type="text/javascript">
    $().ready(function() {
        $("#btn_add_shop_spec").click(function() {

            $.loading.start();

            $.open({
                title: "添加规格",
                width: "630px",
                ajax: {
                    url: "/goods/publish/add-spec",
                },
                btn: ['提交', '取消'],
                success: function(object, index) {

                    $.loading.stop();

                    var validator = $(object).find("form").validate();
                    // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
                    $.validator.addRules($(object).find(".client-rules").html());
                    $(object).data("validator", validator);
                },
                yes: function(index, object) {

                    validator = $(object).data("validator");

                    if (!validator.form()) {
                        return;
                    }

                    var form = $(object).find("form");

                    var url = $(form).attr("action");
                    var data = $(form).remove(".attr-values-area").serializeJson();

                    data = {
                        _csrf: data._csrf,
                        Attribute: data.Attribute,
                        attr_values: data.attr_values
                    };

                    var attr_values = [];

                    $(object).find(".attr-values-area:visible").each(function() {
                        if ($(this).attr("id") == "values_select") {
                            $(this).find(".attr-value,.new-attr-value").each(function() {
                                var object = $(this).serializeJson();
                                if ($.trim(object.attr_vname) != '') {
                                    attr_values.push(object);
                                }
                            });
                        }
                    });

                    data.attr_values = attr_values;

                    data = JSON.stringify(data);

                    //加载提示
                    $.loading.start();

                    $.post("/goods/publish/add-spec", {
                        data: data
                    }, function(result) {
                        if (result.code == 0) {
                            $.msg(result.message);
                            if (result.data) {

                                var key = $(".goods-spec-item").size();

                                result.data = result.data.replace(/#key#/g, key);

                                $(".goods-spec-items").append(result.data);

                                var html = $("#shop_spec_template").html();

                                html = html.replace(/#attr_id#/g, result.attr_id);
                                html = html.replace(/#attr_name#/g, result.attr_name);

                                $(".goods-spec-names").append(html);

                                // 初始化规格排序
                                initSpecSortable();
                            }
                            // 关闭
                            $.closeDialog(index);
                        } else {
                            $.msg(result.message, {
                                time: 5000
                            });
                        }
                    }, "json").always(function() {
                        $.loading.stop();
                    });
                }
            });
        });

        //

        // SKU更多设置
        $("#btn_sku_more_set").click(function() {

            var more_table = $("#sku_more_table");

            $.open({
                title: "更多SKU设置",
                width: "800px",
                content: $("#sku_more_table_container").prop("outerHTML"),
                btn: ['确定', '取消'],
                success: function(object, index) {
                    var target = $(object).find("#sku_more_table");

                    $("#sku_table").find("tbody").find("tr").each(function() {
                        var index = $(this).find("[data-sku-index]").data("sku-index");

                        var tr = $(target).find("[data-sku-index='" + index + "']").parents("tr");

                        $(this).find(".sku-field").each(function() {
                            var name = $(this).attr("name");
                            $(tr).find("[name='" + name + "']").val($(this).val());
                        });
                    });
                },
                yes: function(index, object) {
                    var target = $(object).find("#sku_more_table");

                    $(target).find("tbody").find("tr").each(function() {
                        var index = $(this).find("[data-sku-index]").data("sku-index");

                        var tr = $("#sku_table").find("[data-sku-index='" + index + "']").parents("tr");
                        var more_tr = $(more_table).find("[data-sku-index='" + index + "']").parents("tr");

                        $(this).find(".sku-field").each(function() {
                            var name = $(this).attr("name");
                            $(tr).find("[name='" + name + "']").val($(this).val());
                            $(more_tr).find("[name='" + name + "']").val($(this).val());
                        });
                    });

                    $.closeDialog(index);
                }
            });
        });

        //
    });
</script>
<!-- 处理阶梯价格js -->
<script type="text/javascript">
    $(function() {
        $('input[name="GoodsModel[sales_model]"]').change(function() {
            if ($(this).val() == 1) {
                $('.goods-stepped-price').removeClass('hide');
                $(".sku-market-price-td").addClass('hide');
                $(".sku-goods-price-td").addClass('hide');
            } else {
                $('.goods-stepped-price').addClass('hide');
                $(".sku-market-price-td").removeClass('hide');
                $(".sku-goods-price-td").removeClass('hide');
            }
        });

        $('.add-step-price').click(function() {
            var template = $('#step_price_tr_template').html();
            $('.goods-stepped-price tbody.append').append(template);
            if ($('input[name="GoodsModel[pricing_mode]"]:checked').val() == 1) {
                if ($('#goodsmodel-goods_unit').val() > 0) {
                    $('body').find('.pricing-mode').html($("#goodsmodel-goods_unit").find("option:selected").text());
                } else {
                    $('body').find('.pricing-mode').html('件');
                }
            } else {
                $('body').find('.pricing-mode').html('件');
            }
            if ($('.goods-stepped-price tbody tr[class="item"]').length > 2) {
                $(this).parents('tr').addClass('hide');
            }
            previewView();
        });
        $('body').on('click', '.del-step-price', function() {
            $(this).parent().parent().remove();
            $('.add-step-price').parents('tr').removeClass('hide');
            countStepPrice();
            previewView();
        });

        $("body").on("keyup", ".step-number", function(i, v) {
            countStepPrice();
            previewView();
        });

        $("body").on("keyup", ".step-price", function() {
            countStepPrice();
            previewView();
        });

        $('input[name="GoodsModel[pricing_mode]"]').change(function() {
            if ($(this).val() == 1) {
                if ($('#goodsmodel-goods_unit option:selected').val() > 0) {
                    $('body').find('.pricing-mode').html($('#goodsmodel-goods_unit option:selected').text());
                }
            } else {
                $('body').find('.pricing-mode').html('件');
            }
        });

        $('#goodsmodel-goods_unit').change(function() {
            if ($('input[name="GoodsModel[pricing_mode]"]:checked').val() == 1) {
                if ($(this).val() > 0) {
                    $('body').find('.pricing-mode').html($('#goodsmodel-goods_unit option:selected').text());
                }
            }
        });
        if ($('.goods-stepped-price').length > 0 && !$('.goods-stepped-price').hasClass('hide')) {
            countStepPrice();
        }
    });

    // 批发模式下，计算阶梯价格中的最大值值复制给SKU的店铺价格
    function countStepPrice() {
        if ($("input[name='GoodsModel[sales_model]']:checked").size() == 0) {
            return;
        }

        var sale_model = $("input[name='GoodsModel[sales_model]']:checked").val();

        if (sale_model == 0) {
            return;
        }

        $.validator.clearError($('.goods-stepped-price-table'));
        var min_price = 0;
        var max_price = 0;
        $.each($('.step-price'), function() {
            if (min_price == 0) {
                min_price = parseFloat($(this).val());
            }
            if (min_price >= parseFloat($(this).val())) {
                min_price = parseFloat($(this).val());
            }
        });

        $.each($('.step-price'), function() {
            if (max_price == 0) {
                max_price = parseFloat($(this).val());
            }
            if (max_price <= parseFloat($(this).val())) {
                max_price = parseFloat($(this).val());
            }
        });

        if (max_price > 0) {
            $('#sku_table_container').find('#sku_table tbody tr .sku-market-price').val(max_price);
            $('#sku_table_container').find('#sku_table tbody tr .sku-goods-price').val(max_price);
        } else {
            $('#sku_table_container').find('#sku_table tbody tr .sku-market-price').val('');
            $('#sku_table_container').find('#sku_table tbody tr .sku-goods-price').val('');
        }

        if (max_price > 0) {
            $("#goodsmodel-goods_price").val(max_price);
            $('#goodsmodel-market_price').val(max_price);
            $("#goodsmodel-goods_price").prop("readonly", true);
            $('#goodsmodel-market_price').prop("readonly", false);
        } else {
            $("#goodsmodel-goods_price").val('');
            $("#goodsmodel-goods_price").prop("readonly", false);
        }


        $('.step-number').eq(0).val();
        if ($('.step-number').eq(0).val() > 0) {
            $('#goodsmodel-goods_moq').val($('.step-number').eq(0).val());
            $("#goodsmodel-goods_moq").prop("readonly", true);
        }

        return min_price;
    }

    //生成预览
    function previewView() {
        var sale_rule = ['一', '二', '三'];
        $('.goods-stepped-price-preview tbody').html('');
        var preview_template = $('#step_price_preview_template').html();
        var step_number = [];
        $.each($('.goods-stepped-price tbody.append tr'), function(i, v) {
            step_number.push($(v).find('.step-number').val());
        });

        $.each($('.goods-stepped-price tbody.append tr'), function(i, v) {
            var number = $(v).find('.step-number').val();
            var price = $(v).find('.step-price').val();
            if (number != '' && number > 0) {
                if (step_number.length == i + 1) {
                    if (!isNaN(number)) {
                        number = '≥' + number;
                    } else {
                        number = '';
                        price = '';
                    }
                } else if (number == (step_number[i + 1] - 1)) {
                    if (!isNaN(number)) {
                        number = number;
                    } else {
                        number = '';
                        price = '';
                    }
                } else {
                    if (!isNaN(step_number[i]) && !isNaN(step_number[i + 1]) && step_number[i] != '') {
                        if (step_number[i + 1] - 1 >= 0 && ((step_number[i + 1] - 1) > step_number[i])) {
                            number = step_number[i] + '-' + (step_number[i + 1] - 1);
                        } else {
                            number = '';
                            price = '';
                        }

                    } else {
                        number = '';
                        price = '';
                    }
                }
            } else {
                number = '';
                price = '';
            }

            $('.goods-stepped-price-preview tbody').append(preview_template);
            $('.goods-stepped-price-preview tbody tr').eq(i).find('.sale-rule').html(sale_rule[i] + '：');
            $('.goods-stepped-price-preview tbody tr').eq(i).find('.preview-number').html(number);
            $('.goods-stepped-price-preview tbody tr').eq(i).find('.preview-price').html(price);
        });
    }

    // 验证阶梯价格
    function validStepPrice() {
        var step_price = [];
        var step_price_valid = true;
        var w_number, w_price;
        var message = [];
        $.each($('.goods-stepped-price tbody tr[class="item"]'), function() {
            var number = $(this).find('input').eq(0).val();
            var price = $(this).find('input').eq(1).val();
            var flag = false;
            if (w_number > 0 && w_number >= parseFloat(number)) {
                $(this).find('input').eq(0).addClass('error');
                step_price_valid = false;
                message[0] = '购买数量后者需大于前者';
            }
            if (!isNaN(number) && parseFloat(number) > 0) {
                w_number = parseFloat(number);
            } else {
                w_number = 0;
                $(this).find('input').eq(0).addClass('error');
                step_price_valid = false;
                message[1] = '购买数量必须为大于0的数字';
            }

            if (w_price > 0 && w_price <= parseFloat(price)) {
                $(this).find('input').eq(1).addClass('error');
                step_price_valid = false;
                message[2] = '商品价格后者需小于前者';
            }

            if (!isNaN(price) && parseFloat(price) > 0) {
                w_price = price;
            } else {
                w_price = 0;
                $(this).find('input').eq(1).addClass('error');
                step_price_valid = false;
                message[3] = '商品价格必须为不小于0的数字';
            }

            if (parseFloat(w_number) > 0 && parseFloat(w_price) > 0) {
                step_price.push(w_number + ',' + w_price);
            } else {
                step_price_valid = false;
            }
        });

        if (step_price.length == 0) {
            message[4] = '请设置阶梯价格';
            step_price_valid = false;
        }
        for (var i = 0; i < message.length; i++) {
            if (message[i] == "" || typeof (message[i]) == "undefined") {
                message.splice(i, 1);
                i = i - 1;

            }

        }
        if (step_price_valid == false) {
            $.msg(message.join('<br/>'));
            $.validator.showError($('.goods-stepped-price-table'), message.join('；'));
            return false;
        } else {
            return step_price;
        }
    }
</script>
<link rel="stylesheet" href="/assets/d2eace91/js/ztree/zTreeStyle.css?v=1.6"/>
<script src="/assets/d2eace91/js/ztree/jquery.ztree.all-3.5.min.js?v=20180418"></script>
<script type="text/javascript">
    $().ready(function(){
        //
        var other_cat_ids = [];
        //
        var catselector = $("#other_cat_container").catselector({
            size: 0,
            data: {
                deep: 3
            },
            values: other_cat_ids,
            addCallback: function(id, name, node) {

            },
            removeCallback: function(id) {
                this.hide();
            },
            change: function(){
                $("#other_cat_ids").val(this.getValues().join(","));
            }
        });
        // 加载初始化
        catselector.load();

        //
        var shop_cat_ids = [];
        //

        // 店铺内商品分类
        var shopcatselector = $("#shop_cat_container").catselector({
            url: '/site/shop-cat-list',
            size: 0,
            data: {
                deep: 2
            },
            values: shop_cat_ids,
            addCallback: function(id, name, node) {

            },
            removeCallback: function(id) {
                this.hide();
            },
            change: function(){
                $("#shop_cat_ids").val(this.getValues().join(","));
            }
        });
        // 加载初始化
        shopcatselector.load();
        // 重新加载红包
        $("body").on("click", ".reload_btn", function() {
            $.loading.start();
            $.get("/goods/publish/reload-goods-unit", {
            }, function(result) {
                if (result.code == 0) {
                    var list = result.data;
                    var html = "";
                    for ( var name in result.data) {
                        html += "<option value='"+name+"'>" + result.data[name] + "</option>";
                    }
                    $("#goodsmodel-goods_unit").html(html);
                    $('.chosen-select').chosen("destroy");
                    $('.chosen-select').chosen();

                } else {
                    $.msg(result.message, {
                        time: 5000
                    });
                }
            }, "JSON").always(function() {
                $.loading.stop();
            });
        });

        $('#goodsmodel-goods_mode').find('[name="GoodsModel[goods_mode]"]').change(function(){
            var goods_mode = $(this).val();
            $.confirm("切换商品类别会丢失表单数据，您确定切换吗?", function() {
                $.go('/goods/publish/index?cat_id={{ $cat_id }}&goods_mode='+goods_mode);
            });
        });
    });
</script>
