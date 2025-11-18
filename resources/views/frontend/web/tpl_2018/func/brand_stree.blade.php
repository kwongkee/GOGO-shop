@extends('layouts.base')

@section('header_js')
    <script src="/assets/d2eace91/js/jquery.cookie.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=20180528"></script>
@stop


{{--follow_box 注意此效果只在首页面展示--}}
@section('follow_box')

@stop

@section('style_js')
    <!--页面css/js-->
    <script src="/js/index.js?v=20180528"></script>
    <script src="/js/tabs.js?v=20180528"></script>
    <script src="/js/bubbleup.js?v=20180528"></script>
    <script src="/js/jquery.hiSlider.js?v=20180528"></script>
    <script src="/js/index_tab.js?v=20180528"></script>
    <script src="/js/jump.js?v=20180528"></script>
    <script src="/js/nav.js?v=20180528"></script>
@stop

@section('content')
{{--    <link rel="stylesheet" href="/css/goods.css?v=20180428"/>--}}

{{--    <link rel="stylesheet" href="/assets/d2eace91/layui/css/layui.css?v=23121"/>--}}
{{--    <link rel="stylesheet" href="/assets/d2eace91/js/layer/theme/default/layer.css?v=3.1.0" id="layuicss-layer">--}}
{{--    <script type="text/javascript" src="/assets/d2eace91/layui/layui.js"></script>--}}
{{--    <script src="/assets/d2eace91/layui/xm-select3.js?v=20180418"></script>--}}
    <link rel="stylesheet" href="/css/shop_street.css?v=20180428"/>

    <div class="w1210" style="margin-top:15px;">
        <div class="main" id="table_list">
            <!-- -->
            <ul class="shop-list">

                @foreach($brand as $v)
                    <li>
                        <a href="javascript:;" title="{{ $v['param1'] }}">
                            <div class="p-img">
                                <img alt="" src="https://shop.gogo198.cn/{{ $v['param2'] }}">
                            </div>
                            <div class="shop-info">
                                <div class="shop-name-wrap clearfix">
                                    <div class="shop-logo fl">

                                        <img alt="" src="https://shop.gogo198.cn/{{ $v['param2'] }}">

                                    </div>
                                    <div class="shop-name fl">{{ $v['param1'] }}</div>
                                </div>
                                <div class="line"></div>
                                <div class="shop-desc clearfix">
                                    <p></p>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

{{--    <script type="text/javascript">--}}
{{--        layui.use(['layer','element','table','form'],function() {--}}
{{--            var $ = layui.$--}}
{{--                , layer = layui.layer--}}
{{--                , element = layui.element--}}
{{--                , form = layui.form--}}
{{--                , table = layui.table;--}}

{{--            form.render(null, 'search-element');--}}

{{--        });--}}
{{--    </script>--}}
@stop