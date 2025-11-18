@extends('layouts.user_layout')

{{--header_js--}}
@section('header_js')

@stop

@section('content')

    <!-- 正文，由view提供 -->
    <div class="con-right fr">
        <div class="con-right-text">
            <div class="tabmenu">
                <div class="user-status">
                    @foreach($trade_type_items as $key=>$item)
                    <span class="user-statu @if($key == 'trans-detail'){{ 'active' }}@endif">
                        <a id='{{ $key }}' class="tabs-@if($key == 'trans-detail'){{ 'color' }}@endif">
                            <span>{{ $item }}</span>
                            <em class="tag-em"></em>
                            <span class="vertical-line">|</span>
                        </a>
                    </span>
                    @endforeach
                </div>
                <div class="user-tab-right">

                    <a href="/user/recharge/online-recharge.html">在线充值</a>

                    <a href="/user/recharge-card/info.html">储值卡充值</a>

                    <a href="/user/deposit/add">申请提现</a>

                </div>
            </div>
            <div class="content-info">
                <div class="content-list">
                    <form id="searchForm" name="searchForm" action="/user/capital-account.html" method="GET">
                        <div class="content-search order-search" style="display: none"></div>
                        <div class="order-screen-term" style="display: none">
                            <label style="width: 30%;">
                                <span>交易类型：</span>
                                <span class="select">
                                    <select id="trade_type" class="form-control" name="trade_type">
                                        @foreach($trade_type_items as $key=>$item)
                                        <option value="{{ $key }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </span>
                                <span id="searchFormSubmit" class="order-search-btn">搜索</span>
                            </label>
                        </div>
                    </form>

                    <div class="use-detail account-detail clearfix">
                        <div class="on-line fl">
                            <p class="title">线上账户资金</p>
                            <p class="info">
						<span>
							可提现资金：
							<strong class="second-color">{{ $user['user_money'] }}</strong>
							元
						</span>
                                <span>
							不可提现资金：
							<strong class="second-color">{{ $user['user_money_limit'] }}</strong>
							元
						</span>
                                <span>
							冻结资金：
							<strong class="second-color">{{ $user['frozen_money'] }}</strong>
							元
						</span>
                            </p>
                        </div>
                        <div class="offline fr">
                            <p class="title">线下账户资金</p>
                            <p class="info">
						<span>
							账户可用资金：
							<strong class="second-color" id="balance">{{ $user['user_money'] }}</strong>
							元
						</span>
                                <a href="javascript:void(0);" title="查看各商家账户资金" class="see-btn">查看各商家账户资金</a>
                            </p>
                        </div>
                    </div>


                    <div class="content-list">
                        <!-- 交易明细 _start -->
                        <div id="con_status_1" class="list-type">
                            <div class="list-type-text">

                                {{--引入列表--}}
                                @include('user.capital-account.partials._list')

                            </div>
                        </div>
                    </div>

                    <div class="operat-tips">
                        <h4>我的资金账户注意事项</h4>
                        <ul class="operat-panel">
                            <li>
                                <span>账户余额是您在本网站可用于支付的金额，您可在线充值.</span>
                            </li>
                            <li>
                                <span>您资金账户中的余额分为三类：可提现资金、不可提现资金、冻结资金</span>
                            </li>
                            <li>
                                <span>如果您创建了店铺，则可以看到店铺的资金变动明细</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            var tablelist = null;
            $().ready(function() {
                tablelist = $("#table_list").tablelist({
                    params: $("#searchForm").serializeJson(),
                });

                $("#searchForm").submit(function() {
                    // 控制下方快速选择tab样式
                    if ($("#trade_type").val() != '') {
                        $("a[class^='tabs-']").removeClass('color');
                        $("a[id='" + $("#trade_type").val() + "']").addClass('color');
                        $(".user-statu").removeClass('active');
                        $("a[id=''" + $("#trade_type").val() + "']").parent(".user-statu").addClass('active');
                    } else {
                        $("a[class^='tabs-']").removeClass('color');
                        $("a[id='trans-detail']").addClass('color');
                        $(".user-statu").removeClass('active');
                        $("a[id='trans-detail").parent(".user-statu").addClass('active');
                    }

                    // 序列化表单为JSON对象
                    var data = $(this).serializeJson();
                    // Ajax加载数据
                    tablelist.load(data);
                    // 阻止表单提交
                    return false;
                });
            });

            $("a[class^='tabs-']").click(function() {
                $("a[class^='tabs-']").removeClass('color');
                $(".user-statu").removeClass('active');
                $(this).addClass('color');
                $(this).parent(".user-statu").addClass('active');

                $("#trade_type").val($(this).attr("id"));

                tablelist = $("#table_list").tablelist({
                    params: $("#searchForm").serializeJson()
                });
                tablelist.load();
            });
        </script>
        <script type="text/javascript">
            $().ready(function() {

                $("body").on("click", ".see-btn", function() {
                    $.loading.start();
                    $.open({
                        title: "查看各商家账户资金",
                        ajax: {
                            url: "/user/capital-account/view",
                            data: {}
                        },
                        width: "700px",
                        btn: ['关闭'],
                        end: function(index, object) {
                            // $.go('/user/capital-account.html');
                        }
                    });
                });

                $.ajax({
                    url: '/user/capital-account/get-data',
                    dataType: 'json',
                    success: function(data) {
                        $("#balance").html(data.balance);
                    }
                });
            });
        </script>
    </div>

@stop