@extends('layouts.user_layout')

{{--header_css--}}
@section('header_css')
    <link rel="stylesheet" href="/css/user.css?v=20181020"/>
@stop

{{--header_js--}}
@section('header_js')

@stop

@section('content')

    <header class="header-top-nav">
        <div class="header">
            <div class="header-left">
                <a class="sb-back" href="javascript:history.back(-1);" title="返回">
                    <i class="iconfont"></i>
                </a>
            </div>
            <div class="header-middle">投诉详情</div>
            <div class="header-right">

                <aside class="show-menu-btn">
                    <div class="show-menu" id="show_more">
                        <a href="javascript:void(0);">
                            <i class="iconfont"></i>
                        </a>
                    </div>
                </aside>

            </div>
        </div>
    </header>
    <div class="back-info-content">
        <!-- 提交投诉、修改投诉申请后的页面 _start -->
        <div class="content-status">
            <dl class="user-status-imfor">
                <dt class="imfor-icon">
                    <img src="/images/common/warning.png">
                </dt>
                <dd class="imfor-title">
                    <h3>您已提交了投诉申请，请等待卖家处理</h3>
                </dd>
            </dl>
            <ul class="user-status-prompt">
                <li> 卖家在3日之内未处理，您可以申请平台方介入处理 </li>
                <li>
                    <span>投诉原因：</span>
                    承诺的没做到
                </li>
                <li>
                    <span>投诉说明：</span>
                    aaaa
                </li>
            </ul>
            <div class="user-status-operate ub">
                <a href="/user/complaint/edit?complaint_id=12.html" class="return-apply ub-f1">修改投诉申请</a>
                <a href="javascript:;" onclick="delConfirm('12')" class="return-apply ub-f1">撤销投诉申请</a>
            </div>

        </div>
        <!-- 提交投诉、修改投诉申请后的页面 _end -->


        <!-- 卖家回复投诉后的页面 _start -->
        <!-- 卖家回复投诉后的页面 _end -->


        <!-- 买家撤销投诉后的页面 _start -->
        <!-- 买家撤销投诉后的页面 _end -->


        <!-- 买家申请平台仲裁后的页面 _start -->
        <!-- 买家申请平台仲裁后的页面 _end -->

        <!-- 仲裁成功后的页面 _start -->
        <!-- 仲裁成功后的页面 _end -->


        <!-- 仲裁失败后的页面 _start -->
        <!-- 仲裁失败后的页面 _end -->

        <div class="blank-div"></div>
        <div class="content-imfor">
            <div class="imfor-title">
                <h3>投诉信息</h3>
            </div>
            <ul>
                <li>
                    <div class="imfor-dt">店铺名称</div>
                    <div class="imfor-dd">小不点</div>
                </li>
            </ul>
            <ul class="back-info-ul">
                <li>
                    <div class="imfor-dt">投诉原因</div>
                    <div class="imfor-dd">承诺的没做到
                    </div>
                </li>
                <li>
                    <div class="imfor-dt">投诉编号</div>
                    <div class="imfor-dd">2018111006351656642</div>
                </li>
                <li>
                    <div class="imfor-dt">投诉时间</div>
                    <div class="imfor-dd">2018-11-10 14:35:16</div>
                </li>
                <li class="hide">
                    <div class="imfor-dt">投诉说明</div>
                    <div class="imfor-dd">aaaa</div>
                </li>
                <li class="hide">
                    <div class="imfor-dt">订单编号</div>
                    <div class="imfor-dd">
                        <a href="/user/order/info?id=268.html">20181029091710347650</a>
                    </div>
                </li>
                <li class="hide">
                    <div class="imfor-dt">运&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;费</div>
                    <div class="imfor-dd">29.00元</div>
                </li>
                <li class="hide">
                    <div class="imfor-dt">总&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;计</div>
                    <div class="imfor-dd">149.00元</div>
                </li>
                <li class="hide">
                    <div class="imfor-dt">成交时间</div>
                    <div class="imfor-dd">2018-10-29 17:17:10</div>
                </li>
                <li>
                    <a href="javascript:;" class="get-more-info">
                        <span>更多</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- 协商记录 -->
        <div class="blank-div"></div>
        <div class="message-box">
            <div class="imfor-title">
                <h3>协商记录</h3>
            </div>
            <div class="consult-record-message">
                <ul>

                    <li>
                        <p class="desc">
                            <span>买家</span>
                            &nbsp;[ SZY157FTPJ8849]：aaaa
                        </p>
                        <div class="voucher">

                            <!---->
                            <a href="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/user/5/images/2018/11/10/15418317135898.jpg" onclick="return hs.expand(this)">
                                <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/user/5/images/2018/11/10/15418317135898.jpg" class="goods-thumb" />
                            </a>

                            <!---->
                        </div>
                        <p class="time">[2018-11-10 14:35:16]</p>
                    </li>

                </ul>
            </div>
        </div>
    </div>

    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180027"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180027"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180027"></script>
    <!-- AJAX上传+图片预览 -->
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=20180027"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20180027"></script>
    <script src="/js/image_upload/lrz.all.bundle.js?v=20180027"></script>
    <script id="client_rules" type="text">
[{"id": "complaintmodel-complaint_desc", "name": "ComplaintModel[complaint_desc]", "attribute": "complaint_desc", "rules": {"required":true,"messages":{"required":"投诉说明不能为空。"}}},{"id": "complaintmodel-complaint_type", "name": "ComplaintModel[complaint_type]", "attribute": "complaint_type", "rules": {"required":true,"messages":{"required":"投诉原因不能为空。"}}},{"id": "complaintmodel-complaint_images", "name": "ComplaintModel[complaint_images]", "attribute": "complaint_images", "rules": {"required":true,"messages":{"required":"上传投诉凭证图片不能为空。"}}},{"id": "complaintmodel-complaint_type", "name": "ComplaintModel[complaint_type]", "attribute": "complaint_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"投诉原因必须是整数。"}}},{"id": "complaintmodel-complaint_status", "name": "ComplaintModel[complaint_status]", "attribute": "complaint_status", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"0- 等待卖家处理  1 - 卖家已回复  2-买家撤销投诉 3 - 平台方介入 4-平台方仲裁中  5- 仲裁成功  6-仲裁失败必须是整数。"}}},{"id": "complaintmodel-add_time", "name": "ComplaintModel[add_time]", "attribute": "add_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"创建时间必须是整数。"}}},{"id": "complaintmodel-complaint_mobile", "name": "ComplaintModel[complaint_mobile]", "attribute": "complaint_mobile", "rules": {"string":true,"messages":{"string":"联系电话必须是一条字符串。","maxlength":"联系电话只能包含至多20个字符。"},"maxlength":20}},{"id": "complaintmodel-complaint_desc", "name": "ComplaintModel[complaint_desc]", "attribute": "complaint_desc", "rules": {"string":true,"messages":{"string":"投诉说明必须是一条字符串。","maxlength":"投诉说明只能包含至多255个字符。"},"maxlength":255}},{"id": "complaintmodel-complaint_mobile", "name": "ComplaintModel[complaint_mobile]", "attribute": "complaint_mobile", "rules": {"match":{"pattern":/^((13|15|18|17|14)\d{9}|(199|198|166)\d{8})$/,"not":false,"skipOnEmpty":1},"messages":{"match":"联系电话是无效的。"}}},]
</script>
    <script type="text/javascript">
        $().ready(function() {
            var validator = $("#ComplaintModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());

            $("body").on('click', '.sub_complaint', function() {
                if (!validator.form()) {
                    return false;
                }
                var data = $("#ComplaintModel").serializeJson();
                var action = "/user/complaint/edit.html?complaint_id=12.html";

                $.post(action, data, function(result) {
                    $.msg(result.message);
                    if (result.code == 0) {
                        var url = "/user/complaint/list"
                        $.go(url);
                        if (typeof (tablelist) !== 'undefined') {
                            tablelist.load();
                        }
                    }
                }, "json");
            });
            //图片上传
            $("body").on('click', '.img-uploading', function() {
                var obj = $(this);
                var image_path = $('#imgpath').val();
                var image_show = obj.parent('.content-status').find('.image-container');
                $.localResizeIMG({
                    callback: function(image) {
                        image_show.append("<div class='img-uploading-list'><img src='"+image.data.url+"' data-path='"+image.data.path+"'><span class='img-del'></span>");
                        if (image_path != '') {
                            image_path = image_path + ',' + image.data.path;
                        } else {
                            image_path = image.data.path;
                        }
                        $('#imgpath').val(image_path);
                        $.msg(image.message);
                        if (image_show.find('img').size() >= 6) {
                            obj.addClass('hide');
                        }
                    }
                });
            });

            $('body').on('click', '.img-del', function() {
                var obj = $(this);
                obj.parent().remove();
                var image_path = [];
                $.each($('.image-container img'), function(i, v) {
                    image_path.push($(v).data('path'));
                });
                $('#imgpath').val(image_path.join(','));
                if ($('.image-container').find('img').size() < 6) {
                    $('.img-uploading').removeClass('hide');
                }
            });

            $('.get-more-info').click(function() {
                $('.back-info-ul li').each(function() {
                    if ($(this).hasClass('hide')) {
                        $(this).removeClass('hide');
                    }
                    $('.get-more-info').parent('li').addClass('hide');
                });
            });
        });
        //撤销投诉
        function delConfirm(id) {
            $.confirm('撤销后您将不能重新发起投诉申请，是否确认撤销?', {
                btn: ['确定', '取消']
                //按钮
            }, function() {
                $.go("/user/complaint/del?complaint_id=12.html");
            }, function() {
            })
        }
    </script>
    <link rel="stylesheet" href="/assets/d2eace91/css/highslide.css?v=20181020"/>
    <script src="/assets/d2eace91/js/pic/highslide-with-gallery.js?v=20180027"></script>
    <script type="text/javascript">
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
    <script type="text/javascript">
        $().ready(function() {


        })
    </script>
    <script src="/js/jquery.fly.min.js?v=20180027"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js?v=20180027"></script>

    <div class="show-menu-info" id="menu">
        <ul>
            <li><a href="/"><span class="index-menu"></span><i>商城首页</i></a></li>
            <li><a href="/category.html"><span class="category-menu"></span><i>分类</i></a></li>
            <li><a href="/cart.html"><span class="cart-menu"></span><i>购物车</i></a></li>
            <li style=" border:0;"><a href="/user.html"><span class="user-menu"></span><i>我的</i></a></li>
        </ul>
    </div>
    <!-- 第三方流量统计 -->
    <div style="display: none;"></div>
    <!-- 底部 _end-->

@stop