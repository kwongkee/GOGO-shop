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
                    <li class="active">退款退货</li>
                </ul>
            </div>
            <div class="content-info">
                <div class="content-list refund-return-list">
                    <form id="searchForm" action="/user/back.html" method="GET">
                        <div class="screen-term">
                            <label style="width: 29%;">
                                <span>订单编号：</span>
                                <input type="text" id="order_sn" class="form-control" name="order_sn" placeholder="订单编号">
                            </label>
                            <label style="width: 29%;">
                                <span>退款退货单编号：</span>
                                <input type="text" id="back_sn" class="form-control" name="back_sn" placeholder="退款退货单编号">
                            </label>
                            <label>
                                <input id="btn_submit" type="submit" value="搜索" class="search" />
                            </label>
                        </div>
                    </form>



                    <div id="table_list">
                        <table class="table">
                            <thead>
                            <tr>
                                <th style="width: 30%;">商品信息/订单编号/退款编号</th>
                                <th style="width: 16%;">卖家</th>
                                <th style="width: 8%;">交易金额(整单)</th>
                                <th style="width: 8%;">退款金额</th>
                                <th style="width: 10%;">申请时间</th>
                                <th style="width: 10%;">超时时间</th>
                                <th style="width: 13%;">退款退货状态</th>
                                <th style="width: 5%;">操作</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr>
                                <td class="after-sales-goods">
                                    <div style="overflow: hidden;">

                                        <a class="goods-img" href="http://www.b2b2c.yunmall.68mall.com/goods-205.html" target="_blank">
                                            <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/shop/1/gallery/2018/09/28/15381362582058.jpg?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" />
                                        </a>
                                        <div class="item-con">
                                            <div class="item-name">
                                                <a href="http://www.b2b2c.yunmall.68mall.com/goods-205.html" target="_blank" title="创建红茶 均色 XS">创建红茶 均色 XS</a>
                                            </div>
                                            <p>订单编号：20181012083859575140</p>
                                            <p>退款编号：2018111007306</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="shop-info">
                                        店铺：
                                        <a href="/shop/1.html" target="_blank" title="楠丹木业" class="btn-link">楠丹木业</a>
                                    </p>
                                    <p class="shop-info">
                                        卖家：

                                        <a href="/shop/1.html" target="_blank" title="测试店铺" class="btn-link">测试店铺</a>
                                    </p>
                                </td>
                                <td align="center">￥258.00</td>
                                <td align="center">￥6.00</td>
                                <td align="center">2018-11-10 11:29:44</td>
                                <td align="center">2018-11-17 11:29:44</td>
                                <td align="center">
                                    <p>买家申请退款，等待卖家确认</p>
                                </td>
                                <td align="center">
                                    <div class="operate">
                                        <a href="/user/back/info?id=15" class="btn-link">查看</a>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="after-sales-goods">
                                    <div style="overflow: hidden;">

                                        <a class="goods-img" href="http://www.b2b2c.yunmall.68mall.com/goods-17.html" target="_blank">
                                            <img src="http://images.68mall.com/system/config/default_image/default_goods_image_0.gif?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" />
                                        </a>
                                        <div class="item-con">
                                            <div class="item-name">
                                                <a href="http://www.b2b2c.yunmall.68mall.com/goods-17.html" target="_blank" title="大海参1 S">大海参1 S</a>
                                            </div>
                                            <p>订单编号：20180717090728262310</p>
                                            <p>退款编号：2018072528819</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="shop-info">
                                        店铺：
                                        <a href="/shop/1.html" target="_blank" title="楠丹木业" class="btn-link">楠丹木业</a>
                                    </p>
                                    <p class="shop-info">
                                        卖家：

                                        <a href="/shop/1.html" target="_blank" title="测试店铺" class="btn-link">测试店铺</a>
                                    </p>
                                </td>
                                <td align="center">￥1.00</td>
                                <td align="center">￥1.00</td>
                                <td align="center">2018-07-25 17:23:51</td>
                                <td align="center">2018-07-25 17:24:12</td>
                                <td align="center">
                                    <p>退款关闭</p>
                                </td>
                                <td align="center">
                                    <div class="operate">
                                        <a href="/user/back/info?id=9" class="btn-link">查看</a>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="after-sales-goods">
                                    <div style="overflow: hidden;">

                                        <a class="goods-img" href="http://www.b2b2c.yunmall.68mall.com/goods-17.html" target="_blank">
                                            <img src="/assets/d2eace91/images/default/goods.gif" />
                                        </a>
                                        <div class="item-con">
                                            <div class="item-name">
                                                <a href="http://www.b2b2c.yunmall.68mall.com/goods-17.html" target="_blank" title="大海参1">大海参1</a>
                                            </div>
                                            <p>订单编号：20180509033453440630</p>
                                            <p>退款编号：2018080900220</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="shop-info">
                                        店铺：
                                        <a href="/shop/1.html" target="_blank" title="楠丹木业" class="btn-link">楠丹木业</a>
                                    </p>
                                    <p class="shop-info">
                                        卖家：

                                        <a href="/shop/1.html" target="_blank" title="测试店铺" class="btn-link">测试店铺</a>
                                    </p>
                                </td>
                                <td align="center">￥0.01</td>
                                <td align="center">￥0.01</td>
                                <td align="center">2018-08-09 16:31:22</td>
                                <td align="center">2018-08-09 17:10:18</td>
                                <td align="center">
                                    <p>退款成功</p>
                                </td>
                                <td align="center">
                                    <div class="operate">
                                        <a href="/user/back/info?id=7" class="btn-link">查看</a>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="after-sales-goods">
                                    <div style="overflow: hidden;">

                                        <a class="goods-img" href="http://www.b2b2c.yunmall.68mall.com/goods-11.html" target="_blank">
                                            <img src="http://68dsw.oss-cn-beijing.aliyuncs.com/demo/shop/1/gallery/2017/08/25/15036308618249.jpg?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" />
                                        </a>
                                        <div class="item-con">
                                            <div class="item-name">
                                                <a href="http://www.b2b2c.yunmall.68mall.com/goods-11.html" target="_blank" title="高山红富士苹果新鲜脆甜多汁水果批发">高山红富士苹果新鲜脆甜多汁水果批发</a>
                                            </div>
                                            <p>订单编号：20180419102401381800</p>
                                            <p>退款编号：2018042366096</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="shop-info">
                                        店铺：
                                        <a href="/shop/1.html" target="_blank" title="楠丹木业" class="btn-link">楠丹木业</a>
                                    </p>
                                    <p class="shop-info">
                                        卖家：

                                        <a href="/shop/1.html" target="_blank" title="测试店铺" class="btn-link">测试店铺</a>
                                    </p>
                                </td>
                                <td align="center">￥1.00</td>
                                <td align="center">￥1.00</td>
                                <td align="center">2018-04-23 17:09:57</td>
                                <td align="center">2018-04-23 17:13:12</td>
                                <td align="center">
                                    <p>退款成功</p>
                                </td>
                                <td align="center">
                                    <div class="operate">
                                        <a href="/user/back/info?id=3" class="btn-link">查看</a>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="after-sales-goods">
                                    <div style="overflow: hidden;">

                                        <a class="goods-img" href="http://www.b2b2c.yunmall.68mall.com/goods-11.html" target="_blank">
                                            <img src="http://68dsw.oss-cn-beijing.aliyuncs.com/demo/shop/1/gallery/2017/08/25/15036308618249.jpg?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" />
                                        </a>
                                        <div class="item-con">
                                            <div class="item-name">
                                                <a href="http://www.b2b2c.yunmall.68mall.com/goods-11.html" target="_blank" title="高山红富士苹果新鲜脆甜多汁水果批发">高山红富士苹果新鲜脆甜多汁水果批发</a>
                                            </div>
                                            <p>订单编号：20180418064209286610</p>
                                            <p>退款编号：2018072568584</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="shop-info">
                                        店铺：
                                        <a href="/shop/1.html" target="_blank" title="楠丹木业" class="btn-link">楠丹木业</a>
                                    </p>
                                    <p class="shop-info">
                                        卖家：

                                        <a href="/shop/1.html" target="_blank" title="测试店铺" class="btn-link">测试店铺</a>
                                    </p>
                                </td>
                                <td align="center">￥1.00</td>
                                <td align="center">￥1.00</td>
                                <td align="center">2018-07-25 15:23:08</td>
                                <td align="center">2018-07-26 16:00:57</td>
                                <td align="center">
                                    <p>退款成功</p>
                                </td>
                                <td align="center">
                                    <div class="operate">
                                        <a href="/user/back/info?id=2" class="btn-link">查看</a>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="after-sales-goods">
                                    <div style="overflow: hidden;">

                                        <a class="goods-img" href="http://www.b2b2c.yunmall.68mall.com/goods-11.html" target="_blank">
                                            <img src="http://68dsw.oss-cn-beijing.aliyuncs.com/demo/shop/1/gallery/2017/08/25/15036308618249.jpg?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" />
                                        </a>
                                        <div class="item-con">
                                            <div class="item-name">
                                                <a href="http://www.b2b2c.yunmall.68mall.com/goods-11.html" target="_blank" title="高山红富士苹果新鲜脆甜多汁水果批发">高山红富士苹果新鲜脆甜多汁水果批发</a>
                                            </div>
                                            <p>订单编号：20180418070003256260</p>
                                            <p>退款编号：2018041881040</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="shop-info">
                                        店铺：
                                        <a href="/shop/1.html" target="_blank" title="楠丹木业" class="btn-link">楠丹木业</a>
                                    </p>
                                    <p class="shop-info">
                                        卖家：

                                        <a href="/shop/1.html" target="_blank" title="测试店铺" class="btn-link">测试店铺</a>
                                    </p>
                                </td>
                                <td align="center">￥19.60</td>
                                <td align="center">￥1.00</td>
                                <td align="center">2018-04-18 15:50:39</td>
                                <td align="center">2018-04-18 15:53:37</td>
                                <td align="center">
                                    <p>退款关闭</p>
                                </td>
                                <td align="center">
                                    <div class="operate">
                                        <a href="/user/back/info?id=1" class="btn-link">查看</a>
                                    </div>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                        <!--分页-->
                        <div class="page">
                            <div class="page-wrap fr">
                                <div id="pagination" class="pull-right page-box">


                                    <div id="pagination" class="page">
                                        <script data-page-json="true" type="text">
	{"page_key":"page","page_id":"pagination","default_page_size":10,"cur_page":1,"page_size":10,"page_size_list":[10,50,500,1000],"record_count":6,"page_count":1,"offset":0,"url":null,"sql":null}
</script>
                                        <div class="page-wrap fr">
                                            <div class="total">共6条记录
                                                <!-- 每页显示：
                                                <select class="select m-r-5" data-page-size="10">


                                                    <!--<option value="10" selected="selected">10</option>-->



                                                <!--<option value="50">50</option>-->



                                                <!--<option value="500">500</option>-->



                                                <!--<option value="1000">1000</option>-->


                                                <!--</select>
                                                条 -->

                                            </div>
                                        </div>
                                        <div class="page-num fr">
		<span class="num prev disabled"class="disabled" style="display: none;">
			<a class="fa fa-angle-double-left" data-go-page="1" title="第一页"></a>
		</span>

                                            <span >
			<a class="num prev disabled " title="上一页">上一页</a>
		</span>








                                            <!--   -->

                                            <span class="num curr">
			<a data-cur-page="1">1</a>
		</span>







                                            <span class="disabled" style="display: none;">
			<a class="num " class="fa fa-angle-double-right" data-go-page="1" title="最后一页"></a>
		</span>

                                            <span >
			<a class="num next disabled" title="下一页">下一页</a>
		</span>

                                        </div>
                                        <!-- <div class="pagination-goto">
                                                <input class="ipt form-control goto-input" type="text">
                                                <button class="btn btn-default goto-button" title="点击跳转到指定页面">GO</button>
                                                <a class="goto-link" data-go-page="" style="display: none;"></a>
                                            </div> -->
                                        <script type="text/javascript">
                                            $().ready(function() {
                                                $(".pagination-goto > .goto-input").keyup(function(e) {
                                                    $(".pagination-goto > .goto-link").attr("data-go-page", $(this).val());
                                                    if (e.keyCode == 13) {
                                                        $(".pagination-goto > .goto-link").click();
                                                    }
                                                });
                                                $(".pagination-goto > .goto-button").click(function() {
                                                    var page = $(".pagination-goto > .goto-link").attr("data-go-page");
                                                    if ($.trim(page) == '') {
                                                        return false;
                                                    }
                                                    $(".pagination-goto > .goto-link").attr("data-go-page", page);
                                                    $(".pagination-goto > .goto-link").click();
                                                    return false;
                                                });
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="operat-tips">
                    <h4>退款退货注意事项</h4>
                    <ul class="operat-panel">
                        <li>
                            <span>买家“确认收货”前和“确认收货”后发起的“仅退款/退款退货”申请均属于退款退货管理。</span>
                        </li>
                        <li>
                            <span>买家“确认收货”后发起的维修申请、换货申请均属于换货维修管理。</span>
                        </li>
                        <li>
                            <span>卖家同意退款后，退款信息将自动推送至平台方，由平台方管理员为买家退款。</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            var tablelist = null;
            $().ready(function() {
                // 加载时加入即时查询搜索条件
                tablelist = $("#table_list").tablelist({
                    params: $("#searchForm").serializeJson()
                });
                // 搜索
                $("#searchForm").submit(function() {
                    // 序列化表单为JSON对象
                    var data = $(this).serializeJson();
                    console.info(data);
                    // Ajax加载数据
                    tablelist.load(data);
                    // 阻止表单提交
                    return false;
                });
            });
        </script>
    </div>

@stop