<!--原商品详情样式-->
            <div class="right right-con " style="display: none;">
                <div class="wrapper">
                    <div id="main-nav-holder" class="goods-detail">
                        <ul id="nav" class="tab">
                            <li class="title-list current">
                                <a href="javascript:;">商品分类</a>
                            </li>
                            <li class="title-list">
                                <a href="javascript:;">商品信息</a>
                            </li>
                            <li class="title-list">
                                <a href="javascript:;">商品描述</a>
                            </li>
                            <li class="title-list">
                                <a id="evaluate_count" href="javascript:;">销售评价</a>
                            </li>
                            <li class="title-list">
                                <a href="javascript:;">买家须知</a>
                            </li>
{{--                            <li class="title-list">--}}
{{--                                <a id="evaluate_count" href="javascript:;">累计评价(0)</a>--}}
{{--                            </li>--}}

{{--                            <li class="title-list">--}}
{{--                                <a href="javascript:;">服务保障</a>--}}
{{--                            </li>--}}
                        </ul>
                        <div class="right-side">
                            <!-- 失效不展示 -->
                            <a href="javascript:void(0);" class="right-addcart add-cart " id="right-addcart">
                                <i class="iconfont">&#xe6a8;</i>
                                加入购物车
                            </a>

                            <div class="right-side-con">
                                <ul class="right-side-ul">
                                    <li class="abs-active">
                                        <i></i>
                                        <span>规格参数</span>
                                    </li>
                                    <li>
                                        <i></i>
                                        <span>商品详情</span>
                                    </li>
                                    <li>
                                        <i></i>
                                        <span>商品评价</span>
                                    </li>
                                    <li>
                                        <i></i>
                                        <span>常见问题</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div id="main_widget_1">
                        <!-- 规格参数 _star -->
                        <div id="goods_attr_list" class="goods-detail-con goods-detail-tabs">
                            <style>
                                .offer-title{display: flex;align-items: center;margin: 0 20px;padding: 15px 0 0;}
                                .offer-title .offer-title-icon{width: 4px;height: 13px;background: #E31939;border-radius: 1px;}
                                .offer-title .offer-title-content{margin-left: 6px;font-weight: 700;color: #333;font-size:17px;}
                                .goods-spec{padding-top:0px;}
                                .wrapper #goods_introduce .detail-content{padding:10px 15px;}
                                .goods-detail-content img{max-width:100%;}
                            </style>

                            <div class="offer-title"><div class="offer-title-icon"></div><div class="offer-title-content">跨境限制</div></div>
                            <ul class="goods-spec">
                                <li>
                                    是否可以出口：
                                    <span id="crossborder-restrict" title="" class="goods-attr-value">@if($goods['crossborder_restrict']['is_export']==1)是@else否@endif</span>
                                </li>
                                <li>
                                    支持进口国家：
                                    <span id="crossborder-restrict" title="@foreach($goods['crossborder_restrict']['export_country'] as $k=>$v){{$v['param2']}}&nbsp;@endforeach" class="goods-attr-value">@if($goods['crossborder_restrict']['is_export']==1)
                                        @foreach($goods['crossborder_restrict']['export_country'] as $k=>$v){{$v['param2']}}&nbsp;@endforeach
                                        @else无@endif</span>
                                </li>
                                <li>
                                    支持跨境集运：
                                    <span id="crossborder-restrict" title="" class="goods-attr-value">@if($goods['crossborder_restrict']['is_gather']==1)@else不@endif支持</span>
                                </li>
                                <li>
                                    支持外币结算：
                                    <span id="crossborder-restrict" title="@if($goods['crossborder_restrict']['is_outcurrency']==1)支持本币聚合支付、外币聚合支付@else支持本币聚合支付@endif" class="goods-attr-value">@if($goods['crossborder_restrict']['is_outcurrency']==1)支持本币聚合支付、外币聚合支付@else支持本币聚合支付@endif</span>
                                </li>
                            </ul>

                            <div class="offer-title"><div class="offer-title-icon"></div><div class="offer-title-content">商品属性</div></div>
                            <ul class="goods-spec">
                                <li>
                                    商品名称：
                                    <span id="goods_attr_goods_name" title="{{ $goods['goods_name'] }}" class="goods-attr-value">{{ $goods['goods_name'] }}</span>
                                </li>
                                <li>
                                    店铺：
                                    <span id="goods_attr_shop_name" title="{{ $shop_info['shop']['shop_name'] }}" class="goods-attr-value">{{ $shop_info['shop']['shop_name'] }}</span>
                                </li>
                                @if(!empty($goods['brand_name']))
                                    <li>
                                        商品品牌：
                                        <span id="goods_attr_brand_name" title="{{ $goods['brand_name'] }}" class="goods-attr-value">{{ $goods['brand_name'] }}</span>
                                    </li>
                                @endif
                                <!-- 商品规格 -->
                                @if(!empty($goods['spec_list']))
                                    @foreach($goods['spec_list'] as $v)
                                        @if(isset($v['attr_name']))
                                        <li>
                                            {{ $v['attr_name'] }}：
                                            <span title="{{ $v['attr_name'] }}" class="goods-attr-value">

                                                {{ implode(' ', array_column($v['attr_values'], 'attr_value')) }}

                                            </span>
                                        </li>
                                        @endif
                                    @endforeach
                                @endif

                                {{--属性列表--}}
                                @if(!empty($goods['other_attrs']))
                                    @if(isset($goods['other_attrs']['value_name'][0]))
                                    @foreach($goods['other_attrs']['value_name'] as $k => $v)
                                        @if(isset($v))
                                        <li>
                                            {{ $v }}：
                                            <span id="goods_attr_" title="{{ $goods['other_attrs']['value_desc'][$k] }}" class="goods-attr-value">{{ $goods['other_attrs']['value_desc'][$k] }}</span>
                                        </li>
                                        @endif
                                    @endforeach
                                    @endif
                                @endif
                                @if(!empty($goods['attr_list']))
                                   @foreach($goods['attr_list'] as $v)
                                        @if(isset($v['attr_name']))
                                        <li>
                                            {{ $v['attr_name'] }}：
                                            <span id="goods_attr_" title="{{ $v['attr_values'] }}" class="goods-attr-value">{{ $v['attr_values'] }}</span>
                                        </li>
                                        @endif
                                    @endforeach
                                @endif
                            </ul>

                            @if(!empty($goods['platform_intro'][0]['content']) && !empty($goods['platform_intro'][0]['title']))
                            <div class="offer-title"><div class="offer-title-icon"></div><div class="offer-title-content">平台价格说明</div></div>
                            <div class="goods-spec">
                                <div class="layui-collapse" lay-accordion="now" style="margin:10px 0;width: 100%;">
                                    @foreach($goods['platform_intro'] as $key=>$vo)
                                        <div class="layui-colla-item">
                                            <h2 class="layui-colla-title">{{$vo['parag_num']}}&nbsp;{{$vo['title']}}</h2>
                                            <div class="layui-colla-content">
                                                <p>{{$vo['content']}}</p>
                                                @if(!empty($vo['children']))
                                                    <div class="layui-collapse" lay-accordion="now">
                                                        @foreach($vo['children'] as $key2=>$vo2)
                                                            <div class="layui-colla-item">
                                                                <h2 class="layui-colla-title">{{$vo2['parag_num']}}&nbsp;{{$vo2['title']}}</h2>
                                                                <div class="layui-colla-content">
                                                                    <p>{{$vo2['content']}}</p>
                                                                    @if(!empty($vo2['children']))
                                                                        <div class="layui-collapse" lay-accordion="now" lay-filter="now">
                                                                            @foreach($vo2['children'] as $key3=>$vo3)
                                                                                <div class="layui-colla-item">
                                                                                    <h2 class="layui-colla-title" data-parag_num="{{$vo3['parag_num']}}">{{$vo3['parag_num']}}&nbsp;{{$vo3['title']}}</h2>
                                                                                    <div class="layui-colla-content">
                                                                                        <p>{{$vo3['content']}}</p>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            @if(!empty($goods['userprice_intro'][0]['content']) && !empty($goods['userprice_intro'][0]['title']))
                            <div class="offer-title"><div class="offer-title-icon"></div><div class="offer-title-content">用户价格说明</div></div>
                            <div class="goods-spec">
                                <div class="layui-collapse" lay-accordion="now" style="margin:10px 0;width: 100%;">
                                    @foreach($goods['userprice_intro'] as $key=>$vo)
                                        <div class="layui-colla-item">
                                            <h2 class="layui-colla-title">{{$vo['parag_num']}}&nbsp;{{$vo['title']}}</h2>
                                            <div class="layui-colla-content">
                                                <p>{{$vo['content']}}</p>
                                                @if(!empty($vo['children']))
                                                    <div class="layui-collapse" lay-accordion="now">
                                                        @foreach($vo['children'] as $key2=>$vo2)
                                                            <div class="layui-colla-item">
                                                                <h2 class="layui-colla-title">{{$vo2['parag_num']}}&nbsp;{{$vo2['title']}}</h2>
                                                                <div class="layui-colla-content">
                                                                    <p>{{$vo2['content']}}</p>
                                                                    @if(!empty($vo2['children']))
                                                                        <div class="layui-collapse" lay-accordion="now" lay-filter="now">
                                                                            @foreach($vo2['children'] as $key3=>$vo3)
                                                                                <div class="layui-colla-item">
                                                                                    <h2 class="layui-colla-title" data-parag_num="{{$vo3['parag_num']}}">{{$vo3['parag_num']}}&nbsp;{{$vo3['title']}}</h2>
                                                                                    <div class="layui-colla-content">
                                                                                        <p>{{$vo3['content']}}</p>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            @if(!empty($goods['platform_preferent']['bao_you'][0]) || (!empty($goods['platform_preferent']['full_buy_price']) && !empty($goods['platform_preferent']['full_buy_minusprice'])) || (!empty($goods['platform_preferent']['full_buy_num']) && !empty($goods['platform_preferent']['full_buy_deliverynum'])) || !empty($goods['platform_preferent']['shiwu_desc'][0]) || !empty($goods['platform_preferent']['fuwu_desc'][0]))
                            <div class="offer-title"><div class="offer-title-icon"></div><div class="offer-title-content">商品平台优惠</div></div>
                            <ul class="goods-spec">
                                @if(!empty($goods['platform_preferent']['bao_you'][0]))
                                <li>
                                    包邮方式：
                                    <span id="goods_attr_goods_name" title="@foreach($goods['platform_preferent']['bao_you'] as $k=>$v){{$v}}&nbsp;@endforeach" class="goods-attr-value">
                                        @foreach($goods['platform_preferent']['bao_you'] as $k=>$v){{$v}}&nbsp;@endforeach
                                    </span>
                                </li>
                                @endif
                                @if(!empty($goods['platform_preferent']['full_buy_price']) && !empty($goods['platform_preferent']['full_buy_minusprice']))
                                <li>
                                    满减金额：
                                    <span id="goods_attr_goods_name" title="买满{{$goods['platform_preferent']['full_buy_currency']}}{{$goods['platform_preferent']['full_buy_price']}}减{{$goods['platform_preferent']['full_buy_currency']}}{{$goods['platform_preferent']['full_buy_minusprice']}}" class="goods-attr-value">
                                        买满{{$goods['platform_preferent']['full_buy_currency']}}{{$goods['platform_preferent']['full_buy_price']}}减{{$goods['platform_preferent']['full_buy_currency']}}{{$goods['platform_preferent']['full_buy_minusprice']}}
                                    </span>
                                </li>
                                @endif
                                @if(!empty($goods['platform_preferent']['full_buy_num']) && !empty($goods['platform_preferent']['full_buy_deliverynum']))
                                    <li>
                                        满送物品：
                                        <span id="goods_attr_goods_name" title="买满{{$goods['platform_preferent']['full_buy_num']}}{{$goods['platform_preferent']['full_buy_unit']}}送{{$goods['platform_preferent']['full_buy_deliverynum']}}{{$goods['platform_preferent']['full_buy_unit']}}" class="goods-attr-value">
                                        买满{{$goods['platform_preferent']['full_buy_num']}}{{$goods['platform_preferent']['full_buy_unit']}}送{{$goods['platform_preferent']['full_buy_deliverynum']}}{{$goods['platform_preferent']['full_buy_unit']}}
                                    </span>
                                    </li>
                                @endif
                                @if(!empty($goods['platform_preferent']['shiwu_desc'][0]))
                                    <li>
                                        赠送实物：
                                        <span id="goods_attr_goods_name" title="@foreach($goods['platform_preferent']['shiwu_desc'] as $k=>$v){{$v}}&nbsp;@endforeach" class="goods-attr-value">@foreach($goods['platform_preferent']['shiwu_desc'] as $k=>$v){{$v}}&nbsp;@endforeach</span>
                                    </li>
                                @endif
                                @if(!empty($goods['platform_preferent']['fuwu_desc'][0]))
                                    <li>
                                        赠送服务：
                                        <span id="goods_attr_goods_name" title="@foreach($goods['platform_preferent']['fuwu_desc'] as $k=>$v){{$v}}&nbsp;@endforeach" class="goods-attr-value">@foreach($goods['platform_preferent']['fuwu_desc'] as $k=>$v){{$v}}&nbsp;@endforeach</span>
                                    </li>
                                @endif
                            </ul>
                            @endif

                            @if(!empty($goods['merchant_valueadd']['valueadd_name'][0]))
                            <div class="offer-title"><div class="offer-title-icon"></div><div class="offer-title-content">商家增值服务</div></div>
                            <ul class="goods-spec">
                                @foreach($goods['merchant_valueadd']['valueadd_name'] as $k=>$v)
                                <li>
                                    {{$v}}：
                                    <span id="goods_attr_goods_name" title="{{$goods['merchant_valueadd']['valueadd_desc'][$k]}}" class="goods-attr-value">{{$goods['merchant_valueadd']['valueadd_desc'][$k]}}</span>
                                </li>
                                @endforeach
                            </ul>
                            @endif

                            @if($goods['activity_info']['have_activity']==1 && !empty($goods['activity_info']['activity_id']))
                                <div class="offer-title"><div class="offer-title-icon"></div><div class="offer-title-content">参与活动信息</div></div>
                                <ul class="goods-spec">
                                    @foreach($goods['activity_info']['activity_id'] as $k=>$v)
                                        <li>
                                            活动名称：
                                            <span id="goods_attr_goods_name" title="{{$v->name}}" class="goods-attr-value">{{$v->name}}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                            <div class="offer-title"><div class="offer-title-icon"></div><div class="offer-title-content">商品推广信息</div></div>
                            <ul class="goods-spec">
                                @foreach($goods['promotion_text']['shihe_brandname'] as $k=>$v)
                                    <li>
                                        品牌：
                                        <span id="goods_attr_goods_name" title="{{$v}}" class="goods-attr-value">{{$v}}</span>
                                    </li>
                                @endforeach
                                <li>
                                    品类：
                                    @foreach($goods['promotion_text']['shihe_gcate'] as $k=>$v)
                                        <span id="goods_attr_goods_name" title="{{$v}}" class="goods-attr-value">{{$v}}</span>
                                    @endforeach
                                </li>
                                @foreach($goods['promotion_text']['shihe_goodsname'] as $k=>$v)
                                    <li>
                                        品名：
                                        <span id="goods_attr_goods_name" title="{{$v}}" class="goods-attr-value">{{$v}}</span>
                                    </li>
                                @endforeach
                                <li>
                                    属性：
                                    @foreach($goods['promotion_text']['shihe_gattr_promote'] as $k=>$v)
                                        <span id="goods_attr_goods_name" title="{{$v}}" class="goods-attr-value">{{$v}}</span>
                                    @endforeach
                                </li>
                                @if($goods['have_specs']==1)
                                <li>
                                    规格：
                                    @foreach($goods['promotion_text']['shihe_goption'] as $k=>$v)
                                        <span id="goods_attr_goods_name" title="{{$v}}" class="goods-attr-value">{{$v}}</span>
                                    @endforeach
                                </li>
                                @endif
                                @if(!empty($goods['promotion_text']['shihe_renqun']))
                                <li>
                                    适合人群：
                                    @foreach($goods['promotion_text']['shihe_renqun'] as $k=>$v)
                                        <span id="goods_attr_goods_name" title="{{$v->name}}" class="goods-attr-value">{{$v->name}}</span>
                                    @endforeach
                                </li>
                                @endif
                                @if(!empty($goods['promotion_text']['shihe_country']))
                                <li>
                                    适用国家：
                                    @foreach($goods['promotion_text']['shihe_country'] as $k=>$v)
                                        <span id="goods_attr_goods_name" title="{{$v->param2}}" class="goods-attr-value">{{$v->param2}}</span>
                                    @endforeach
                                </li>
                                @endif
                                @if(!empty($goods['promotion_text']['shihe_media']))
                                <li>
                                    适用网媒：
                                    @foreach($goods['promotion_text']['shihe_media'] as $k=>$v)
                                        <span id="goods_attr_goods_name" title="{{$v->name}}" class="goods-attr-value">{{$v->name}}</span>
                                    @endforeach
                                </li>
                                @endif
                                @if(!empty($goods['promotion_text']['shihe_festival']))
                                <li>
                                    适用节日：
                                    @foreach($goods['promotion_text']['shihe_festival'] as $k=>$v)
                                        <span id="goods_attr_goods_name" title="{{$v->name}}" class="goods-attr-value">{{$v->name}}</span>
                                    @endforeach
                                </li>
                                @endif
                                @if(!empty($goods['promotion_text']['shihe_commongoods']))
                                <li>
                                    适用同款：
                                    @foreach($goods['promotion_text']['shihe_commongoods'] as $k=>$v)
                                        <span id="goods_attr_goods_name" title="{{$v->goods_name}}" class="goods-attr-value">{{$v->goods_name}}</span>
                                    @endforeach
                                </li>
                                @endif
                                @if(!empty($goods['promotion_text']['shihe_zongjiao']))
                                    <li>
                                        适用宗教：
                                        @foreach($goods['promotion_text']['shihe_zongjiao'] as $k=>$v)
                                            <span id="goods_attr_goods_name" title="{{$v->name}}" class="goods-attr-value">{{$v->name}}</span>
                                        @endforeach
                                    </li>
                                @endif
                            </ul>

                        </div>
                        <!-- 规格参数 _end -->

                        <!-- 商品详情 _star -->
                        <div id="goods_introduce" class="goods-detail-con goods-detail-tabs">
                            <div class="offer-title"><div class="offer-title-icon"></div><div class="offer-title-content">商品详情</div></div>

                            <!-- 店铺红包 -->

                            <!-- 推荐商品 -->

                            <!-- 商品后台上传的商品描述 -->
                            <div class="detail-content goods-detail-content">
                                <div class="ajax-loading">
                                    <img src="/images/loading.gif" />
                                </div>



                            </div>
                        </div>
                        <!-- 商品详情 end -->

                        <!-- 商品评价 start -->
                        <div id="goods_evaluate2" class="goods-detail-con goods-detail-tabs"></div>
                        <!-- 商品评价 end -->

                        <!-- 服务 start -->

                        <!-- 常见问题 _star -->
                        <div id="common_problem" class="goods-detail-con goods-detail-tabs">
                            <div class="wenti">
                                <div class="tab-title">
                                    <span class="color">常见问题</span>
                                </div>
                                <div class="tab-body">

                                    @foreach($goods['question_list'] as $k=>$v)
                                    <div class="list @if($k == 4) last @endif">
                                        <div class="question">
                                            <span class="icon fl"></span>
                                            <strong class="common-right">{{ $v['question'] }}</strong>
                                        </div>
                                        <div class="answer">
                                            <span class="icon fl"></span>
                                            <p class="common-right">{{ $v['answer'] }}</p>
                                        </div>
                                    </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                        <!-- 常见问题 _end -->
                        <!-- 服务 end -->

                    </div>
                </div>
            </div>