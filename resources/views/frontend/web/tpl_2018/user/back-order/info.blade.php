@extends('layouts.user_layout')

{{--header_js--}}
@section('header_js')

@stop

@section('content')

    <!-- 正文，由view提供 -->
    <div class="con-right fr">
        <div class="con-right-text">
            <div class="tabmenu">
                <ul class="tab">
                    <li class="active">申请售后</li>
                </ul>
            </div>
            <div class="content-info">

                <div class="order-step order-return-step">
                    <!--完成步骤为dl添加current样式，完成操作内容后会显示完成时间-->



                    <dl class="current step-first">

                        <dt>买家申请换货</dt>
                        <dd class="step-bg"></dd>
                        <dd class="date" title="买家申请换货">2018-07-25 15:38:07</dd>
                    </dl>


                    <dl class="current">

                        <dt>商家处理换货申请</dt>
                        <dd class="step-bg"></dd>
                        <dd class="date" title="商家处理换货申请">2018-08-14 15:38:10</dd>
                    </dl>


                    <dl class="current">

                        <dt>换货关闭</dt>
                        <dd class="step-bg"></dd>
                        <dd class="date" title="换货关闭">2018-08-14 15:38:10</dd>
                    </dl>

                </div>


                <div class="content-con">
                    <div class="imfor-info">
                        <table class="content-info-table" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                                <td class="content-imfor">
                                    <div class="imfor-title">
                                        <h3>申请售后商品</h3>
                                    </div>
                                    <ul>
                                        <li>
                                            <div class="imfor-dt imfor-dt-spe">
                                                <a href="http://www.b2b2c.yunmall.68mall.com/goods-125.html" title="查看商品详情" target="_blank" class="item-img">
                                                    <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/taobao-yun-images/43565178652/TB144JQHpXXXXbOXVXXXXXXXXXX_!!0-item_pic.jpg?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" alt="" />
                                                </a>
                                            </div>
                                            <div class="imfor-dd color">
                                                <div class="item-name">
                                                    <a href="http://www.b2b2c.yunmall.68mall.com/goods-125.html" title="查看商品详情" target="_blank">
                                                        <span>荷美尔Hormel 经典一口香热狗肠 250g</span>
                                                    </a>
                                                </div>
                                                <div class="item-props">
												<span class="sku">

													<span>颜色：银色</span>

													<span>容量：8G</span>

												</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="separate-top">
                                            <div class="imfor-dt">单&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;价：</div>
                                            <div class="imfor-dd">￥1.00 * 1 (数量)</div>
                                        </li>
                                        <li>
                                            <div class="imfor-dt">小&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;计：</div>
                                            <div class="imfor-dd color">￥1</div>
                                        </li>
                                        <li>
                                            <div class="imfor-dt">商&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;家：</div>
                                            <div class="imfor-dd imfor-short-dd">
                                                <a href="http://www.b2b2c.yunmall.68mall.com/shop/1.html" target="_blank" title="楠丹木业" class="btn-link">楠丹木业</a>

                                                <span class="ww-light">


												<!-- s等于1时带文字，等于2时不带文字 -->
<a target="_blank" href="http://amos.alicdn.com/getcid.aw?v=2&uid=zlww26837&site=cntaobao&s=2&groupid=0&charset=utf-8">
	<img border="0" src="http://amos.alicdn.com/online.aw?v=2&uid=zlww26837&site=cntaobao&s=2&charset=utf-8" alt="淘宝旺旺" title="" />
	<span></span>
</a>

											</span>

                                            </div>
                                        </li>
                                        <li>
                                            <div class="imfor-dt">物流信息：</div>
                                            <div class="imfor-dd">
                                                <a href="/user/order/express?id=147" target="_blank">发货物流信息</a>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="imfor-title imfor-title-top">
                                        <h3>订单信息</h3>
                                    </div>
                                    <ul>
                                        <li>
                                            <div class="imfor-dt">订单编号：</div>
                                            <div class="imfor-dd">
                                                <a href="/user/order/info?id=147" title="查看订单详情" class="btn-link" target="_blank">20180718021625565170</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="imfor-dt">运&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;费：</div>
                                            <div class="imfor-dd">￥0.00</div>
                                        </li>
                                        <li>
                                            <div class="imfor-dt">总&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;计：</div>
                                            <div class="imfor-dd color">￥1.00</div>
                                        </li>
                                        <li>
                                            <div class="imfor-dt">成交时间：</div>
                                            <div class="imfor-dd">2018-07-18 10:16:25</div>
                                        </li>
                                    </ul>
                                </td>

                                <!-- 提交换货申请后的页面 _start -->

                                <!-- 提交换货申请后的页面 _end -->

                                <!-- 买家撤销换货申请之后 _start -->

                                <!-- 买家撤销换货申请之后 _end -->

                                <!-- 卖家拒绝换货申请 _start -->

                                <!-- 卖家拒绝换货申请 _end -->

                                <!-- 卖家已同意换货申请 _start -->

                                <!-- 卖家已同意退款退货申请，等待买家寄回货物 _end -->

                                <!-- 换货成功 _start -->

                                <!-- 换货成功 _end -->
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="consult-record">
                        <div class="tabmenu">
                            <ul class="tab">
                                <li class="active">协商记录</li>
                            </ul>
                        </div>
                        <div class="consult-record-message">
                            <ul>

                                <li>
                                    <div class="message-content">
                                        <div class="message-info">
                                            <p class="message-admin">
                                                <span class="name btn-link">121 - 卖家</span>
                                                <span class="time">2018-07-30 15:38:10</span>
                                            </p>
                                            <ul>
                                                <li>
                                                    <div class="dt">凭证信息：</div>
                                                    <div class="dd">
                                                        <span>卖家同意了买家换货申请，换货申请达成，等待买家发货。<br>卖家确认换货地址： ( 收) </span>

                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <div class="message-content">
                                        <div class="message-info">
                                            <p class="message-admin">
                                                <span class="name btn-link">666 - 买家</span>
                                                <span class="time">2018-07-25 15:38:08</span>
                                            </p>
                                            <ul>
                                                <li>
                                                    <div class="dt">凭证信息：</div>
                                                    <div class="dd">
												<span>买家发起了换货申请，换货原因：收到商品少件或破损
，换货收货地址：浙江省哈哈哈 台州市 椒江区啦啦啦（右右收）13325660000，换货说明：asfawww。</span>

                                                        <div class="voucher">

                                                        </div>

                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <script>
            function _edit(back_id, send_id) {

                $.loading.start();
                $.get('/user/back/edit', {
                    id: back_id,
                    send_id: send_id
                }, function(result) {
                    // $.msg(result.message);
                    if (result.code == 0) {
                        if (send_id == 2) {
                            if ($.modal($(this))) {
                                $.modal($(this)).show();
                            } else {
                                $.modal({
                                    // 标题
                                    title: '请填写退货物流信息',
                                    trigger: $(this),
                                    // ajax加载的设置
                                    ajax: {
                                        url: '/user/back/edit-order',
                                        data: {
                                            type: 'shipping',
                                            id: back_id
                                        }
                                    },
                                });
                            }
                        } else {
                            window.location.href = "/user/back/edit?id=" + back_id;
                        }
                    } else {
                        window.location.reload();
                    }
                }, 'json');
            }

            function _cancel(back_id, send_id) {
                $.post('/user/back/cancel', {
                    id: back_id,
                    send_id: send_id
                }, function(result) {
                    $.msg(result.message);

                    if (result.code == 0) {
                        window.location.href = "/user/back/info?id=" + back_id;
                    } else {
                        window.location.reload();
                    }
                }, 'json');
            }
        </script>
        <!-- 填写退货物流单弹框 _start -->
        <script>
            $().ready(function() {
                $("body").on("click", ".confirm", function() {
                    var id = $(this).data("id");
                    $.confirm("确认完成？", function() {
                        $.loading.start();
                        $.ajax({
                            cache: false,
                            type: "POST",
                            data: {
                                id: id
                            },
                            url: "confirm",
                            success: function(result) {
                                var result = eval('(' + result + ')');
                                if (result.code == 0) {
                                    $.go("info?id=" + id);
                                    $.msg(result.message);
                                } else {
                                    $.msg(result.message);
                                }
                            },
                            error: function(result) {
                                $.msg("异常");
                            }
                        });
                    });
                });
            });
        </script>

        <link rel="stylesheet" href="../../../assets/d2eace91/css/highslide.css?v=20181020"/>
        <!-- 点击大图展示 -->
        <script src="../../../assets/d2eace91/js/pic/imgPreview.js?v=20180027"></script>
        <script src="../../../assets/d2eace91/js/pic/highslide-with-gallery.js?v=20180027"></script>
        <script type="text/javascript">
            //图片弹窗
            hs.graphicsDir = '../../../assets/d2eace91/js/pic/graphics/';
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
        <!-- 填写退货物流单弹框 _end --></div>

@stop