<style>
    /*店铺展示版式*/
    .storeDiv {width: 100%;margin: 50px 0px 0px;padding: 10px 10px;position: relative;border: 2px solid {{$data['websites']['info']['color']}};box-sizing: border-box;border-radius: 5px;border-top-left-radius: 0;}
    .storeDiv .storeTitle {position: absolute;top: -36px;left: -2px;background: #1761b7;color: {{$data['websites']['info']['color_word']}};padding: 5px 10px;border: 2px solid {{$data['websites']['info']['color']}};z-index: 9;border-bottom: 0;border-radius: 5px;border-bottom-right-radius: 0;border-bottom-left-radius: 0;font-weight: 800;}
    .storeDiv .column4_list{width:100%;}
    .storeDiv .hsBox{border: 3px solid #fff;border-radius: 8px;width: 100%;}
    .storeDiv .hsBox .hsDiv{width:100%;height: 220px;position: relative;}
    .storeDiv .hsBox .hsDiv .guide2_goods_img{width: 100%;max-width: 100%;height: -webkit-fill-available;}
    .storeDiv .hsBox .hsDiv .hsMask{width: 100%;height: 50%;position: absolute;bottom: 0;background: #000;opacity: 0.5;z-index: 8;border-radius: 6px;}
    .storeDiv .hsBox .hsDiv .hsContent{opacity: 1;color: #fff;z-index: 10;position: absolute;width: 100%;top: 54%;padding:0 10px;box-sizing:border-box;}
    .storeDiv .hsBox .hsDiv .hsContent .title{font-size:18px;font-weight: 800;display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 2;overflow: hidden;text-overflow: ellipsis;margin-bottom:10px;min-height:48px;max-height:48px;}
    .storeDiv .hsBox .hsDiv .hsContent .moreBtn{justify-content: right;}
    .storeDiv .hsBox .hsDiv .hsContent .moreBtn .storeName{background:{{$data['websites']['info']['color']}};padding: 2px 10px;border-radius: 15px;border: 2px solid #fff;margin-right:10px;max-width:100px;text-overflow: ellipsis;overflow:hidden;white-space: nowrap;}
    .storeDiv .hsBox .hsDiv .hsContent .moreBtn .priceDiv{background:{{$data['websites']['info']['color']}};padding: 2px 10px;border-radius: 15px;border: 2px solid #fff;margin-right:10px;}
    .storeDiv .hsBox .hsDiv .hsContent .moreBtn .priceDiv .currency{color:#fff;font-size:15px;font-weight: 800;margin-right:5px;}
    .storeDiv .hsBox .hsDiv .hsContent .moreBtn .priceDiv .price{color:#fff;font-size:15px;font-weight: 800;}
    .storeDiv .hsBox .hsDiv .hsContent .moreBtn .detailDiv a{color: #fff;font-size: 15px;background: #e60000;padding: 3px 10px;border-radius: 15px;border: 2px solid #fff;font-weight: 800;}
    /*店铺展示版式*/
</style>

<div class="storeDiv">
    <div class="storeTitle f15">
        {{$v['title']}}
    </div>
    <div class="swiper-container storeSwiper factorySwiper{{$k}}" style="overflow-y:visible;padding:7px;box-sizing: border-box;">
        <div class="swiper-wrapper">
            @foreach($v['children'] as $k2=>$v2)
                <div class="swiper-slide">
                    <div class="hsBox disf">
                        <div class="hs2 hsDiv" style="position:relative;">
                            <!--当前节日，所有的国家循环-->
                            <img src="{{$data['source_link']}}{{$v2['back_content']}}" alt="" class="guide2_goods_img">
                            <div class="hsMask"></div>
                            <div class="hsContent">
                                <div class="title" title="{{$v2['name']}}">{{$v2['name']}}</div>
                                <div class="moreBtn disf">
                                {{--                                                <div class="storeName" title="{{$v2['company']}}">{{$v2['company']}}</div>--}}
                                @if($v2['go_other']==1 || $v2['go_other']==6 || $v2['go_other']==7)
                                    <!--分享&我要咨询&去找客服-->
                                        <div class="detailDiv">
                                            <a href="javascript:common_operation({{$v2['go_other']}},this);" target="_blank">查看详情&gt;</a>
                                        </div>
                                @elseif($v2['go_other']==2)
                                    <!--商品详情-->
                                        <div class="priceDiv disf">
                                            <div class="currency">{{$v2['info']['currency']}}</div>
                                            <div class="price">{{$v2['info']['goods_price']}}</div>
                                        </div>
                                        <div class="detailDiv">
                                            <a href="/goods-{{$v2['other_goods']}}.html" target="_blank">查看详情&gt;</a>
                                        </div>
                                @elseif($v2['go_other']==3)
                                    <!--菜单链接-->
                                        <div class="detailDiv">
                                            <a href="/detail?id={{$v2['other_navbar']}}" target="_blank">查看详情&gt;</a>
                                        </div>
                                @elseif($v2['go_other']==4)
                                    <!--第三方链接-->
                                        <div class="detailDiv">
                                            <a href="{{$v2['link']}}" target="_blank">查看详情&gt;</a>
                                        </div>
                                @elseif($v2['go_other']==5)
                                    <!--搜索关键字-->
                                        <div class="detailDiv">
                                            <a href="/goods_list?frame_id=1&hotsearchId={{$v2['id']}}&searchTitle={{$v2['other_keywords']}}" target="_blank">查看详情&gt;</a>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!--左右切换-->
        <div class="swiper-button-next sn-store sn-factory{{$k}}"></div>
        <div class="swiper-button-prev sp-store sp-factory{{$k}}"></div>
    </div>
</div>
