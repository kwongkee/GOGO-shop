@extends('layouts.inner_header')

@section('content')
    <link rel="stylesheet" href="/assets/d2eace91/layui/css/layui.css?v=23121"/>
    <script type="text/javascript" src="/assets/d2eace91/layui/layui.js"></script>
    <link rel="stylesheet" href="/assets/d2eace91/js/layer/theme/default/layer.css?v=3.1.0" id="layuicss-layer">
    <script src="/assets/d2eace91/js/layer/layer.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/jquery.js?v=1.1"></script>
    <style type="text/css" media="all">
        .header{border-bottom:3px solid #fff;}
        .footer{border-top:3px solid #fff;}

        .non_topimg{background:{{$website['background']}};}
        .title{font-size:25px;color:{{$website['fontcolor']}};text-align:center;margin-bottom:18px;}

        #content{padding:20px 0;}
        #content .container .content{border: 1px solid {{$website['fontcolor']}};background:{{$website['content']}};padding:30px 20px 60px;box-sizing:border-box;position:relative;margin-top:10px;height:650px;box-shadow: 0px 0px 8px 1px #dfdede;overflow-y:scroll;}
        #content .container .content .in_mask{background-color: #000;opacity: 0;position: absolute;left: 0;top: 0;height: 100%;width: 100%;z-index: 1;}
        #content .container .content .contents{z-index:2;position:relative;color:{{$website['fontcolor']}};font-size: 20px;}
        #content .container{padding-bottom:0px;}
        #content .color_word{font-size:15px;padding: 15px 10px;box-sizing:border-box;}

        .pay address, .pay body, .pay caption, .pay dd, .pay div, .pay dl, .pay dt, .pay fieldset, .pay form, .pay h1, .pay h2, .pay h3, .pay h4, .pay h5, .pay h6, .pay iframe, .pay input, .pay legend, .pay li, .pay ol, .pay p, .pay pre, .pay select, .pay table, .pay td, .pay textarea, .pay ul {
            color: #333;
            font-size: 12px;
        }

        .pay .header2 {font-size: 24px;height: 30px;line-height: 30px;}
        .order-detail-bar.active {max-height: none;}
        .pay .order {margin-top: 25px;overflow: hidden;transition: height .2s ease-in-out;}
        .pay .order table {background: #fbfbfb;table-layout: fixed;width: 100%;}
        .pay * {box-sizing: border-box;}
        .pay .order .title {height: 50px;padding-left: 30px;}
        .pay .order .tip {display: inline-block;font-size: 16px;font-weight: 700;width: 200px;}
        .pay .order .toggleDetail {background: transparent;background: none;border-color: transparent;color: #1268bb;cursor: pointer;display: inline-block;font-size: 14px;line-height: 1;margin-left: 850px;outline: none;text-align: center;text-align: right;width: 70px;}
        .pay .order tbody {border-top: 1px solid #ddd;}
        .pay .order tbody tr:first-child>td {color: #999;}
        .pay .order tbody td {padding: 10px 0;}
        .pay .payment {margin-top: 30px;}
        .payment .info {transition: all .3s linear;}
        .pay .info li {display: inline-block;font-size: 14px;margin-right: 20px;}
        .pay .info span {font-weight: 700;}
        .pay .info li:last-child {float: right;margin-right: 0;text-align: right;}
        .pay .info li:last-child span {color: #e60000;font-size: 24px;font-weight: 700;}
        .pay .remittance-tip {border-color: #e8f9fd;border-radius: 16px 16px 0 0;border-width: 21px;border-top: none;border: 3px solid #f5f5f5;margin-top: 10px;}
        .pay .remittance-tip .remittance_title {background: #f5f5f5;color: #333;font-size: 14px;font-weight: 600;padding: 10px 0 10px 40px;}
        .pay .remittance-tip .remittance_title span:last-child {color: #f55;font-size: 12px;margin-left: 8px;}
        .pay .remittance-tip .remittance_title span:last-child a {color: #1f5188;}
        .pay .remittance-tip .dl-el {display: flex;justify-content: space-between;position: relative;line-height: 74px;}
        .pay .remittance-tip .dl-el .icon {background: url(https://cdn.superbuy.com/starit-superbuy/dist/cn/source/img/pay/remittance_bg.png) no-repeat;content: "";display: inline-block;margin-left: 20px;margin-top: 11px;position: relative;vertical-align: top;width: 123px;}
        .pay .remittance-tip .dl-el .icon-1210 {background: url(https://cdn.superbuy.com/starit-superbuy/dist/cn/source/img/pay/Transferwise.png) no-repeat;background-position: 50%;height: 50px;}
        .pay .remittance-tip .dl-el .recommend {background-size: 90px 20px;background: url(https://cdn.superbuy.com/starit-superbuy/dist/cn/source/img/pay/recommend.png) no-repeat;color: #fff;font-weight: 700;height: 20px;left: 140px;line-height: 20px;position: absolute;text-align: center;top: 10px;width: 40px;}
        .balance-title, .pay .remittance-tip .dl-el dt, .pay .remittance-tip .dl-el span {font-weight: 700;}
        .pay .remittance-tip dd, .pay .remittance-tip dt {display: inline-block;line-height: 74px;}
        .pay .remittance-tip dd {color: #666;}
        .pay .remittance-tip .dl-el .discribe {margin-bottom: 14px;margin-top: 28px;}
        .pay .remittance-tip .dl-el .discribe .discount-discribe {display: block;line-height: 14px;margin-top: 3px;width: 700px;}
        .transfer_wise em {color: #e60000;font-weight: 700;}
        .pay .remittance-tip .dl-el .go-remit {display: inline-block;float: right;line-height: 74px;margin-right: 18px;position: relative;z-index: 1;}
        .pay .remittance-tip .dl-el .go-remit a {font-weight: 700;border-color: #e60000;color: #e60000 !important;line-height: 30px;margin-top:18px;}
        .ant-btn>i, .ant-btn>span {display: inline-block;pointer-events: none;transition: margin-left .3s cubic-bezier(.645,.045,.355,1);}
        .pay .remittance-tip .dl-el .icon-1108 {background-position-y: -34px;height: 50px;}
        .ant-btn {background: transparent;background-color: #fff;background-image: none;border: 1px solid #d9d9d9;border-radius: 4px;box-shadow: 0 2px 0 rgba(0, 0, 0, .015);color: rgba(0, 0, 0, .65);cursor: pointer;display: inline-block;font-size: 14px;font-weight: 400;height: 32px;line-height: 1.499;outline: none;padding: 0 15px;position: relative;text-align: center;touch-action: manipulation;transition: all .3s cubic-bezier(.645,.045,.355,1);user-select: none;white-space: nowrap;}
    </style>
    <section id="content" class="non_topimg">
        <div class="w1200 pay">
            <h1 class="header2">收银台</h1>
            <div class="order order-detail-bar active">
                <table>
                    <thead>
                    <tr>
                        <td colspan="5" class="title">
                            <span class="tip">
                                <span>订单提交成功！</span>
                            </span>
{{--                            <span class="count-down">请在<span class="timer">71小时45分</span>内支付，超时则将自动取消订单</span>--}}
                            <button type="button" class="toggleDetail active">订单详情</button>
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td></td>
                        <td>交易流水号</td>
                        <td>商品价格</td>
                        <td>附加服务费</td>
                        <td>总价</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>{{$order['ordersn']}}</td>
                        <td>CNY {{$order['true_money']}}</td>
                        <td>CNY 0.00</td>
                        <td>CNY {{$order['true_money']}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="payment">
                <div>
                    <div class="" style="">
                        <ul class="info cn" style="display: flex;justify-content: space-between;align-items: center;">
                            <li>
                                应付总额：<span>CNY {{$order['true_money']}}</span>
                            </li>
                            <li>支付手续费：<span> CNY 0.00 </span></li>
                            <li>实际应付金额：<span> CNY {{$order['true_money']}} </span></li>
                        </ul>
                    </div>
                </div>
                <div class="remittance-container">
                    <div class="remittance-tip cn" id="remittance">
                        <div class="remittance_title  cn">
                            <span>银行转账汇款</span>
                            <span>境外线下汇款享充值优惠&nbsp;&nbsp;</span>
                        </div>
                        <dl>
                            <div class="dl-el">
                                <i class="icon icon-1210 cn"></i>
                                <span class="cn recommend">推荐</span>
                                <dt>银行转账</dt>
                                <dd>
                                    <div class="discribe cn">
                                        <a aria-label="pay-message" target="_blank" href="https://bbs.superbuy.com/forum.php?mod=viewthread&amp;tid=497326&amp;htag=18pc-banner2"></a>
                                        <span class="discount-discribe">
                                            <span class="transfer_wise">
                                                <em>0手续费，</em>汇款享优惠，500元订单比用PayPal支付约节省
                                                <em>￥30，</em>订单金额越高，节省越多！
                                            </span>
{{--                                            <a target="_blank" href="/cn/page/help/#p3_23_helpId1210" style="color: rgb(24, 144, 255);">查看使用帮助</a>--}}
                                        </span>
                                    </div>
                                </dd>
                                <div class="go-remit">
                                    <a href="javascript:void(0);" class="ant-btn ant-btn-danger ant-btn-background-ghost" style="padding: 0px 20px;"><span>优惠充值</span></a>
                                </div>
                            </div>
                            <div class="dl-el">
                                <i class="icon icon-1108 cn"></i>
                                <dt>海外电汇</dt>
                                <dd>
                                    <div class="discribe cn">
                                        <a aria-label="pay-message" target="_blank" href="https://bbs.superbuy.com/forum.php?mod=viewthread&amp;tid=497326&amp;htag=18pc-banner2"></a>
                                        <span class="discount-discribe">海外电汇会产生入账手续费，该费用取决于您的汇款银行，请汇款人选择承担全部手续费。入账金额以扣除手续费后的实际到账金额为准。
{{--                                            <a target="_blank" href="/cn/page/help/#search_helpId1108" style="color: rgb(24, 144, 255);">查看使用帮助</a>--}}
                                        </span>
                                    </div>
                                </dd>
                                <div class="go-remit">
                                    <a href="javascript:void(0);" class="ant-btn ant-btn-danger ant-btn-background-ghost" style="padding: 0px 20px;"><span>优惠充值</span></a>
                                </div>
                            </div>
                        </dl>
                    </div>
                    <div class="mask"></div></div>
            </div>
        </div>
    </section>
@stop