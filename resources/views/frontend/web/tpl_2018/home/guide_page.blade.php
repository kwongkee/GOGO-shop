@extends('layouts.goods_header')

@section('content')
    <style>
        body {background: #f4f4f4 !important;}
        .contentBox{margin-top:160px;}
        .contentBox .contentBelowNav{width: 1210px;margin: 0 auto;}
        .swiper-button-prev, .swiper-button-next{color: {{$website['color_word']}};background: {{$website['color']}};box-shadow: 0px 0px 10px 0 #fff;border: 1px solid #fff;border-radius: 50%;width: 30px;height: 30px;}
        /*.swiper-button-prev:hover,.swiper-button-next:hover{background:#e60000;}*/
        .swiper-button-prev:after, .swiper-button-next:after {font-size: 14px;font-weight:800;}
        .swiper-pagination-bullet {width: 6px;height: 6px;background-color: #FFFFFF;opacity: 1;}
        .swiper-pagination-bullet-active {width: 14px;height: 6px;border-radius: 3px;opacity: 1;background-color: #FFFFFF;}
        .swiper-button-disabled{display:none;}
        .columnSelect{background:{{$website['color']}};width:100%;max-width: 90px;border:0;}
        footer{display: block !important;}

        /*卡片*/
        .column_item .content_card{border-radius: 10px;background:#fff;box-shadow: 0px 0px 10px 1px #bebebe;position: relative;overflow: hidden;}
        .column_item .content_card .shareBox{position: absolute;top:10px;right:10px;background: #fff;border-radius: 50%;color:#000;width:30px;height:30px;line-height: 27px;text-align: center;box-shadow: 0px 0px 10px 1px #bebebe;cursor:pointer;display:none;}
        .column_item .content_card .shareBox .bds_more{background: none; color: #000;  margin: 0px; padding-left: 0px; display: block;font-size:32px !important;line-height: 25px;text-align: center;width: 100%;}
        .column_item .content_card img{width: 100%;height:200px;}
        .column_item .content_card .content_body{background:{{$website['color']}};padding:15px;box-sizing: border-box;height:130px;position:relative;}
        .column_item .content_card .content_body .text .attribution{margin-bottom:12px;}
        .column_item .content_card .content_body .text a{color:{{$website['color_word']}};}
        .column_item .content_card .content_body .text a.attribution-text{padding: 2px 8px;border-radius: 12px;border: 1px solid {{$website['color_word']}};}
        .column_item .content_card .content_body .text a.attribution-text:hover{background:#e60000;}
        .column_item .content_card .content_body .card_name{font-weight: 800;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 3;-webkit-box-orient: vertical;-webkit-box-orient: vertical;}
        .column_item .content_card .content_body .detail_btn{padding: 2px 8px;border-radius: 12px;border: 1px solid {{$website['color_word']}};color:{{$website['color_word']}};width:fit-content;position: absolute;right: 15px;bottom: 10px;cursor:pointer;background:{{$website['color']}};}
        .column_item .content_card .content_body .detail_btn:hover{background:#e60000;}
        .column_item .content_card .content_body .attribution a:hover{background:#e60000;}
        .column_item:hover .shareBox{display:block;transition:all 0.3s ease;}

        /**平台推荐START**/
        .storeDiv{width: 100%;margin: 50px 0px 0px;padding: 10px 10px;position: relative;border:2px solid {{$website['color_word']}};box-sizing: border-box;border-radius: 5px;border-top-left-radius: 0;}
        .storeDiv .storeTitle{position: absolute;top:-36px;left:-2px;background:{{$website['color']}};color:{{$website['color_word']}};padding:5px 10px;border:2px solid {{$website['color_word']}};z-index: 9;border-bottom: 0;border-radius: 5px;border-bottom-right-radius: 0;border-bottom-left-radius: 0;font-weight: 800;}
        .storeDiv .column4_list{width:100%;}
        .storeDiv .hsBox{border: 3px solid #fff;border-radius: 8px;width: 100%;box-shadow: 0px 0px 8px 0px #797777;}
        .storeDiv .hsBox .hsDiv{width:100%;height: 500px;position: relative;overflow:hidden;}
        .storeDiv .hsBox .hsDiv .guide2_goods_img{width: 100%;max-width: 100%;height: -webkit-fill-available;transition: filter .6s, opacity .6s, transform .6s, box-shadow .3s;}
        .storeDiv .hsBox .hsDiv .guide2_goods_img:hover{transform: scale(1.2);}
        .storeDiv .hsBox .hsDiv .hsMask{width: 100%;height: 30%;position: absolute;bottom: 0;background: #000;opacity: 0.5;z-index: 8;border-radius: 6px;border-top-left-radius: 0;border-top-right-radius: 0;}
        .storeDiv .hsBox .hsDiv .hsContent{opacity: 1;color: #fff;z-index: 10;position: absolute;width: 100%;top: 75%;padding:0 10px;box-sizing:border-box;}
        .storeDiv .hsBox .hsDiv .hsContent .title{font-size:18px;font-weight: 800;display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 2;overflow: hidden;text-overflow: ellipsis;margin-bottom:30px;min-height:48px;max-height:48px;}
        .storeDiv .hsBox .hsDiv .hsContent .moreBtn{justify-content: right;}
        .storeDiv .hsBox .hsDiv .hsContent .moreBtn .storeName{background:{{$website['color']}};padding: 2px 10px;border-radius: 15px;border: 2px solid #fff;color:{{$website['color_word']}};margin-right:10px;max-width:100px;text-overflow: ellipsis;overflow:hidden;white-space: nowrap;font-weight: 800;}
        .storeDiv .hsBox .hsDiv .hsContent .moreBtn .priceDiv{background:{{$website['color']}};padding: 2px 10px;border-radius: 15px;border: 2px solid #fff;margin-right:10px;}
        .storeDiv .hsBox .hsDiv .hsContent .moreBtn .priceDiv .currency{color:{{$website['color_word']}};font-size:15px;font-weight: 800;margin-right:5px;}
        .storeDiv .hsBox .hsDiv .hsContent .moreBtn .priceDiv .price{color:{{$website['color_word']}};font-size:15px;font-weight: 800;}
        .storeDiv .hsBox .hsDiv .hsContent .moreBtn .detailDiv a{color: {{$website['color_word']}};font-size: 15px;background: {{$website['color']}};padding: 3px 10px;border-radius: 15px;border: 2px solid #fff;font-weight: 800;}
        /**平台推荐END**/

        /**产业集聚START**/
        .industryDiv{width: 100%;margin: 50px 0px 0px;padding: 15px;box-sizing: border-box;border:2px solid {{$website['color_word']}};position: relative;border-radius: 5px;border-top-left-radius: 0;}
        .industryDiv .storeTitle{position: absolute;top:-36px;left:-2px;background:{{$website['color']}};color:{{$website['color_word']}};padding:5px 10px;border:2px solid {{$website['color_word']}};z-index: 9;border-bottom: 0;border-radius: 5px;border-bottom-right-radius: 0;border-bottom-left-radius: 0;font-weight: 800;}
        .cont6-bg {z-index: 10;opacity: 1;position: relative;}
        .cont6-bg .headTxt{padding-top: 0px;font-size: 30px;justify-content: center;position: relative;}
        .cont6-bg .headTxt .actTxt {color: #e60000;font-weight: 800;}
        .cont6-bg .headTxt .norTxt {color: #1f5188;font-weight: 800;font-size: 24px;}
        .cont6-bg .headTxt .norTxt span{font-family:PingFang SC,Hiragino Sans GB,Heiti SC,Microsoft YaHei,Helvetica,Tahoma,Arial,SimHei,WenQuanYi Micro Hei !important;font-size: 30px;margin:0 10px;}
        .cont6-bg .serviceBox{width: 100%;margin-top:0px;display: grid;grid-template-columns: repeat(3,1fr);-moz-column-gap: 20px;column-gap: 20px;row-gap: 20px;align-items: flex-start;}
        .cont6-bg .serviceBox .leftBox{width: 362px;height:568px;border:2px solid #b1b1b1;border-radius: 8px;box-shadow: 0px 0px 8px 0px #797777;margin-right:0px;}
        .cont6-bg .serviceBox .leftBox:hover{border-color:#1f5188;}
        .cont6-bg .serviceBox .leftBox .cont6{position: relative;width: 100%;height:100%;overflow: hidden;}
        .cont6-bg .serviceBox .leftBox .cont6 .serviceContent{background-size: 100%;background-repeat:no-repeat;width: -webkit-fill-available;height:100%;position: relative;cursor: pointer;border-radius: 6px;}
        .cont6-bg .serviceBox .leftBox .cont6 .searviceMask{position: absolute;bottom:0;left:0;background:#000;z-index: 10;opacity: 0.7;width: 100%;height:100%;border-radius: 6px;display: none;}
        .cont6-bg .serviceBox .leftBox .cont6 .serviceContent .serviceDiv{z-index: 12;position: absolute;bottom:-40px;left:50%;transform:translate(-50%,-100%);}
        .cont6-bg .serviceBox .leftBox .cont6 .serviceContent .serviceDiv .serviceTitle{font-size:25px;font-weight: 800;color:#1f5188;}
        .cont6-bg .serviceBox .leftBox .cont6 .serviceContent .serviceDiv .serviceDesc{font-size:15px;font-weight: 800;display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 7;overflow: hidden;text-overflow: ellipsis;width: 100%;margin-top:15px;color:#1f5188;}
        .cont6-bg .serviceBox .leftBox .cont6 .serviceContent .serviceDiv .serviceIn{font-weight:800;margin-top:15px;width: fit-content;color: {{$website['color_word']}};font-size: 15px;background: {{$website['color']}};padding: 4px 15px;border-radius: 15px;border: 2px solid {{$website['color']}};}
        /*.cont6-bg .serviceBox .leftBox .cont6 .serviceContent .serviceDiv .serviceIn:hover{color:#fff;background:#e60000;}*/
        .cont6-bg .serviceBox .leftBox .cont6 .serviceContent .serviceDiv .mob_cont6{display:none;}
        .cont6-bg .serviceBox .rightBox{width:100%;height:100%;grid-column-start: 2;grid-column-end: 4;}
        .cont6-bg .serviceBox .rightBox .serviceContent{width:100%;}
        .cont6-bg .serviceBox .rightBox .serviceContent .swiper-container{display: none;}
        .cont6-bg .serviceBox .rightBox .serviceContent .swiper-slide{display: grid;grid-template-columns: repeat(2,1fr);-moz-column-gap: 20px;column-gap: 20px;row-gap: 20px;padding:0px;}
        .cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv{width:-webkit-fill-available;height:274px;border:2px solid #b1b1b1;border-radius: 8px;box-shadow: 0px 0px 8px 0px #797777;padding:22px 22px 22px 32px;background: {{$website['color']}};position:relative;}
        .cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv .serviceImg{margin-right:20px;width: 50%;height: 190px;border-radius: 8px;box-shadow: 0px 0px 8px 0px #797977;text-align: center;}
        .cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv .serviceImg img{width:150px;height:150px;border-radius: 8px;border: 2px solid #fff;box-shadow: 0px 0px 8px 0px #797977;}
        .cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv .serviceTitleTop{font-size:25px;font-weight: 800;color:#fff;margin-bottom:0px;text-align: center;margin-top:15%;}
        .cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv .serviceTitle{font-size:25px;font-weight: 800;color:#fff;margin-bottom:0px;text-align: center;margin-top:5px;}
        .cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv .serviceTxt{width:50%;}
        .cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv .serviceTxt .serviceDesc{font-size:15px;font-weight: 800;display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 8;overflow: hidden;text-overflow: ellipsis;width: 100%;margin-top:0px;color:{{$website['color_word']}};}
        .cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv:hover{border-color:{{$website['color']}};color:{{$website['color_word']}};}
        .cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv:hover .serviceTitle{color:{{$website['color_word']}};}
        .cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv:hover .serviceDesc{color:{{$website['color_word']}};}
        .cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv .serviceTxt .moreBtn{width: 100%;text-align: right;position:absolute;bottom: 10px;right: 5px;}
        /*.cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv .serviceTxt .moreBtn a:hover{background:#e60000;}*/
        .cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv .serviceTxt .moreBtn a{color:{{$website['color_word']}};font-size: 15px;background: {{$website['color']}};padding: 4px 15px;border-radius: 15px;border: 2px solid {{$website['color_word']}};font-weight:800;}
        .cont6-bg .serviceContent .guide_smlcontent{bottom: var(--swiper-pagination-bottom, 13%);left: var(--swiper-pagination-left, 50%);transform: translate(-38%, 0%);}
        /**产业集聚END**/

        /**环球节庆START**/
        .festivalDiv{width: 100%;margin: 50px 0px 0px;padding: 15px;box-sizing: border-box;border:2px solid {{$website['color_word']}};position: relative;border-radius: 5px;border-top-left-radius: 0;margin-bottom:40px;}
        .festivalDiv .storeTitle{position: absolute;top:-36px;left:-2px;background:{{$website['color']}};color:{{$website['color_word']}};padding:5px 10px;border:2px solid {{$website['color_word']}};z-index: 9;border-bottom: 0;border-bottom: 0;border-radius: 5px;border-bottom-right-radius: 0;border-bottom-left-radius: 0;font-weight: 800;}
        .cont4-bg {z-index: 10;opacity: 1;position: relative;}
        .cont4-bg .headTxt{padding-top: 0px;font-size: 30px;justify-content: center;position: relative;}
        .cont4-bg .headTxt .actTxt {color: #e60000;font-weight: 800;}
        .cont4-bg .headTxt .norTxt {color: #1f5188;font-weight: 800;font-size: 24px;}
        .cont4-bg .headTxt .norTxt span{font-family:PingFang SC,Hiragino Sans GB,Heiti SC,Microsoft YaHei,Helvetica,Tahoma,Arial,SimHei,WenQuanYi Micro Hei !important;font-size: 30px;margin:0 10px;}
        .cont4-bg .hs1{background:url(/assets/d2eace91/images/newhome/hotsearch1.png);background-size: 100% 100%;background-repeat: no-repeat;border: 2px solid #b1b1b1;border-radius: 8px;width: 795px;}
        .cont4-bg .hs2{border: 3px solid #fff;border-radius: 8px;width: 100%;}
        .cont4-bg .hsMask{width: 100%;height: 50%;position: absolute;bottom:0;background: #000;opacity:0.5;z-index: 8;border-radius: 6px;}
        .cont4-bg .headBox{margin-bottom:40px;}
        .cont4-bg .hsColumn{display: grid;grid-template-columns: repeat(3,1fr);-moz-column-gap: 20px;column-gap: 20px;row-gap: 20px;margin-bottom:20px;}
        .cont4-bg .hsColumn:last-child{margin-bottom: 0;}
        .cont4-bg .hsDiv{height:220px;position: relative;box-shadow: 0px 0px 8px 0px #797777;}
        {{--    .cont4-bg .hsDiv:hover{border-color:{{$website['color']}};transition: all 0.3s ease;}--}}
/*.cont4-bg .hsDiv:hover .hsContent .title,.cont4-bg .hsDiv:hover .hsContent .zh_title,.cont4-bg .hsDiv:hover .hsContent .desc{color:#fff;transition: all 0.3s ease;background:#e60000;opacity:0.8;}*/
        /*.cont4-bg .hsDiv:hover>.hsMask{display: none;}*/
        .cont4-bg .hsDiv .guide2_country_img{width:100%;max-width: 100%;height:-webkit-fill-available;}
        .cont4-bg .hsDiv .hsContent{opacity: 1;color: #fff;z-index: 10;position:absolute;width: 100%;top: 50%;transform: translate(0, -50%);bottom:3%;transform: unset;top:unset;}
        .cont4-bg .hsDiv .hsContent .title{font-size:18px;font-weight:800;text-align: center;padding:0;font-size:15px;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;}
        .cont4-bg .hsDiv .hsContent .zh_title{font-weight:800;text-align: center;padding:0px 0;}
        .cont4-bg .hsDiv .hsContent .desc{font-size:15px;text-align: center;width: 100%;padding:0;}
        .cont4-bg .hsDiv .hsContent .moreBtn{width: 100%;text-align: center;position: absolute;right: -30%;bottom: -1%;}
        .cont4-bg .hsDiv .hsContent .moreBtn a{color: {{$website['color_word']}};font-size: 15px;background: {{$website['color']}};padding: 2px 10px;border-radius: 15px;border: 2px solid #fff;}
        /*.cont4-bg .hsDiv .hsContent .moreBtn a:hover{background:#e60000;}*/
        .cont4-bg .hsDiv .hsContent .countryDiv{text-align: center;}
        .cont4-bg .hsDiv .hsContent .countryDiv .country_name{text-align: center;font-size:15px;font-weight:800;}
        .cont4-bg .hsDiv .hsContent .countryDiv .country_name_show{display: block;}
        .cont4-bg .hsDiv .hsContent .countryDiv .country_name_hide{display: none;}
        /**环球节庆END**/

        @media (max-width: 992px){
            .column_item{margin-bottom: 0px;}
            .contentBox .contentBelowNav{width:100%;}

            .storeTitle{top:-35px;}
            /**平台推荐**/
            .storeDiv{margin:60px 0px 0px;padding:5px 10px;}
            .storeDiv .hsBox .hsDiv{height:330px;}
            .storeDiv .hsBox .hsDiv .hsContent .title{margin-bottom:20px;}
            .storeDiv .hsBox .hsDiv .hsMask{height:40%;}
            .storeDiv .hsBox .hsDiv .hsContent{top:65%;}
            .storeDiv .hsBox .hsDiv .hsContent .moreBtn .detailDiv a{white-space: nowrap;}
            .sn-store,.sp-store{top:45%;}
            .storeDiv .storeOperaDiv{top:49%;}
            .storeDiv .content_body .goodsBox .goodsDiv .goodsInfo .viewGoods{white-space: nowrap;}
            .column_item .content_card .content_body{height:130px;}

            /*产业集聚*/
            .industryDiv{padding:15px;margin-top:60px;}
            .cont6-bg .serviceBox .leftBox .cont6 .serviceContent .serviceDiv{transform:unset;width: 100%;}
            .cont6-bg .serviceBox{grid-template-columns:repeat(1,1fr);display:block;}
            .cont6-bg .serviceBox .leftBox{width: 100%;height: 320px;min-height: 320px;margin-bottom:0px;}
            .cont6-bg .serviceBox .rightBox{display:none;}
            .cont6-bg .serviceBox .leftBox .cont6 .searviceMask{position: absolute;bottom:0;left:0;background:#000;z-index: 10;opacity: 0.7;width: 100%;height:30%;border-radius: 6px;display: block;}
            .cont6-bg .serviceBox .leftBox .cont6 .serviceContent .serviceDiv{bottom:1%;left:0;}
            .cont6-bg .serviceBox .leftBox .cont6 .serviceContent .serviceDiv .serviceIn{margin:0 auto;padding: 2px 15px;}
            .cont6-bg .serviceBox .leftBox .cont6 .serviceContent .serviceDiv .mob_cont6{display:block;padding: 10px;box-sizing: border-box;}
            .cont6-bg .serviceBox .leftBox .cont6 .serviceContent .serviceDiv .mob_cont6 .swiper-container{display:block;}
            .cont6-bg .serviceBox .leftBox .cont6 .serviceContent .serviceDiv .mob_cont6 .c6Title{display: inline-block;padding: 0 3px;box-sizing: border-box;}
            .cont6-bg .serviceBox .leftBox .cont6 .serviceContent .serviceDiv .mob_cont6 .c6Title a{color:#fff;font-size:15px;}

            /*环球节庆*/
            .festivalDiv{margin-top:60px;}
            .cont4-bg{height: 585px;overflow-y: auto;}
            .cont4-bg .hsColumn{grid-template-columns:repeat(1,1fr);}
            .cont4-bg .hsDiv{height:280px;}
            .cont4-bg .hsMask{height:32%;bottom:0;}
            .cont4-bg .hsDiv .hsContent{bottom:1%;transform: unset;top:unset;}
            .cont4-bg .hsDiv .hsContent .title{font-size:15px;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;padding:0;}
            .cont4-bg .hsDiv .hsContent .desc{padding:0;}
            .cont4-bg .hsDiv .hsContent .moreBtn{width:fit-content;right:6%;}
            .cont4-bg .hsDiv .hsContent .moreBtn a{display: block;padding:0 10px;}
            .cont4-bg .hsDiv .hsContent .zh_title{overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;}
        }
    </style>
    <div class="contentBox">
        <section class="navAndContent navAndContent_tb navAndContent_nb">
            <div class="navAndContent_feed">
                <div class="contentBelowNav contentSized contentSizedOneColumn contentPlaceHolder">

                    @if($data['guide']['content_info']['type']==7)
                        <!--平台推荐样式-->
                        <div class="storeDiv">
                            <div class="storeTitle f15">
                                <select id="factorySelect" class="columnSelect">
                                    <option value="">{{$data['guide']['title']}}</option>
                                    @foreach($data['guide']['company_info'] as $k2=>$v2)
                                        <option value="{{$v2['id']}}">{{$v2['company']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="swiper-container storeSwiper factorySwiper" style="overflow-y:visible;padding:7px;box-sizing: border-box;">
                                <div class="swiper-wrapper">
                                    @foreach($data['guide']['goods_info'] as $k3=>$v3)
                                        <div class="swiper-slide">
                                            <div class="hsBox">
                                                <div class="hs2 hsDiv" style="position:relative;">
                                                    <!--当前节日，所有的国家循环-->
                                                    <img src="{{$v3['goods_image']}}" alt="" class="guide2_goods_img">
                                                    <div class="hsMask"></div>
                                                    <div class="hsContent">
                                                        <div class="title" title="{{$v3['goods_name']}}">{{$v3['goods_name']}}</div>
                                                        <div class="moreBtn disf">
                                                            <div class="storeName" title="{{$v3['company']}}">{{$v3['company']}}</div>
                                                            <div class="priceDiv disf">
                                                                <div class="currency">{{$v3['goods_currency']}}</div>
                                                                <div class="price">{{$v3['price']}}</div>
                                                            </div>
                                                            <div class="detailDiv">
                                                                <a href="/goods-{{$v3['goods_id']}}.html" target="_blank">购物&gt;</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <!--左右切换-->
                                <div class="swiper-button-next sn-store sn-factory"></div>
                                <div class="swiper-button-prev sp-store sp-factory"></div>
                            </div>

                        </div>
                    @elseif($data['guide']['content_info']['type']==8)
                        <!--产业集聚样式-->
                        <div class="industryDiv">
                            <div class="storeTitle f15">
                                <select id="storeSelect" class="columnSelect">
                                    <option value="">{{$data['guide']['title']}}</option>
                                    @foreach($data['guide']['big_children'] as $k2=>$v2)
                                        <option value="{{$v2['id']}}">{{$v2['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="cont6-bg section">
                                <div class="w1200" style="height:100%;">
                                    <div class="serviceBox disf">
                                        <div class="leftBox">
                                            <div class="swiper-container cont6 cont6-">
                                                <div class="swiper-wrapper">
                                                    @foreach($data['guide']['big_children'] as $k2=>$v2)
                                                        <div class="swiper-slide">
                                                            <div class="searviceMask"></div>
                                                            <div class="serviceContent" style="background-size: 100% 100%;background-image: -webkit-image-set(url(https://shop.gogo198.cn/{{$v2['back_content']}}) 1x,url(https://shop.gogo198.cn/{{$v2['back_content']}}) 2x,url(https://shop.gogo198.cn/{{$v2['back_content2']}}) 3x);background-image: image-set(url(https://shop.gogo198.cn/{{$v2['back_content']}}) 1x,url(https://shop.gogo198.cn/{{$v2['back_content']}}) 2x,url(https://shop.gogo198.cn/{{$v2['back_content2']}}) 3x);">
                                                                <div class="serviceDiv">
                                                                    <div class="serviceIn">{{$v2['name']}}</div>
                                                                    <!--手机滚动该产业带的板块-->
                                                                    <div class="mob_cont6">
                                                                        <div class="swiper-container cont6_children_content{{$v2['id']}}" style="width: 100%;height:100%;">
                                                                            <div class="swiper-wrapper">
                                                                                @foreach($v2['sml_children'] as $k3=>$v3)
                                                                                    <div class="swiper-slide">
                                                                                        <div style="text-align: center">
                                                                                            @foreach($v3 as $k4=>$v4)
                                                                                                <div class="c6Title">
                                                                                                    <a href="">{{$v4['name']}}{{$v4['name2']}}</a>
                                                                                                </div>
                                                                                            @endforeach
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <!--左右切换-->
                                                <div class="swiper-button-next sn-cont6-"></div>
                                                <div class="swiper-button-prev sp-cont6-"></div>
                                            </div>
                                        </div>
                                        <div class="rightBox">
                                            <div class="serviceContent">
                                                @foreach($data['guide']['big_children'] as $k2=>$v2)
                                                    <div class="swiper-container guide_content{{$v2['id']}} guide_content_pc"  style="@if($k2==0)
                                                            display:block;
                                                    @endif width: 100%;height:100%;">
                                                        <div class="swiper-wrapper">
                                                            @foreach($v2['sml_children'] as $k3=>$v3)
                                                                <div class="swiper-slide">
                                                                    @foreach($v3 as $k4=>$v4)
                                                                        <div class="serviceDiv">
                                                                            <div class="disf">
                                                                                <div class="serviceImg" style="background:{{$v4['rand_background']}};">
                                                                                    <img src="/images/industry/{{$v4['img_name']}}.png" alt="" class="serviceImg23" style="width: 40px;height:40px;border:0;border-radius: 0;margin-top:30%;box-shadow: unset;">
                                                                                    <div class="serviceTitleTop">{{$v4['name']}}{{$v4['name2']}}</div>
                                                                                    {{--                                                                                    <div class="serviceTitle"></div>--}}
                                                                                    <img src="//shop.gogo198.cn/{{$v4['back_content']}}" alt="" class="serviceImg" style="display: none;">
                                                                                </div>
                                                                                <div class="serviceTxt">
                                                                                    <div class="serviceDesc" title="{{$v4['desc']}}">{{$v4['desc']}}</div>
                                                                                    <div class="moreBtn"><a href="/goods_list?frame_id=1&hotsearchId={{$v4['id']}}&searchTitle={{$v4['name']}}{{$v4['name2']}}" target="_blank">更多&gt;</a></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <!--左右切换-->
                                                        <div class="swiper-button-next sn-industry{{$v2['id']}}"></div>
                                                        <div class="swiper-button-prev sp-industry{{$v2['id']}}"></div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($data['guide']['content_info']['type']==9)
                        <!--环球节庆样式-->
                        <div class="festivalDiv">
                            <div class="storeTitle f15">
                                <select id="storeSelect" class="columnSelect">
                                    <option value="">{{$data['guide']['title']}}</option>
                                    @foreach($data['guide']['children'] as $k2=>$v2)
                                        @foreach($v2 as $k3=>$v3)
                                            @foreach($v3 as $k4=>$v4)
                                                <option value="{{$v4['id']}}">{{$v4['en_name']}}</option>
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                            <div class="cont4-bg section">
                                <div class="w1200" style="height:100%;">
                                    <div class="hsContent" style="height: 100%;">
                                        <div class="swiper-container guide2_content">
                                            <div class="swiper-wrapper">
                                                @foreach($data['guide']['children'] as $k2=>$v2)
                                                    <div class="swiper-slide">
                                                        @foreach($v2 as $k3=>$v3)
                                                            <div class="hsColumn">
                                                                @foreach($v3 as $k4=>$v4)
                                                                    <div class="hsBox disf">
                                                                        <div class="hs2 hsDiv" style="position:relative;">
                                                                            <!--当前节日，所有的国家循环-->
                                                                            <div class="swiper-container guide2_country_content{{$v4['id']}}" style="position: absolute;top:0;left:0;width:100%;height: 100%;">
                                                                                <div class="swiper-wrapper">
                                                                                    @foreach($v4['national_flag'] as $k5=>$v5)
                                                                                        <div class="swiper-slide">
                                                                                            <img src="{{$v5}}" alt="" class="guide2_country_img">
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>
                                                                            <div class="hsMask"></div>
                                                                            <div class="hsContent">
                                                                                <div class="countryDiv">
                                                                                    @foreach($v4['country_name'] as $k5=>$v5)
                                                                                        <div class="country_name @if($k5==0)
                                                                                                country_name_show
            @else
                                                                                                country_name_hide
            @endif">{{$v5}}</div>
                                                                                    @endforeach
                                                                                </div>
                                                                                <div class="title" title="{{$v4['en_name']}}">{{$v4['en_name']}}</div>
                                                                                @if(!empty($v4['zh_name']))
                                                                                    <div class="zh_title f15" title="{{$v4['zh_name']}}">{{$v4['zh_name']}}</div>
                                                                                @endif
                                                                                <div class="desc f15" title="{{$v4['date']}}">{{$v4['date']}}</div>
                                                                                <div class="moreBtn"><a href="/goods_list?frame_id=2&hotsearchId={{$v4['id']}}&searchTitle=@if(!empty($v4['zh_name']))
                                                                                    {{$v4['zh_name']}}
                                                                                    @else
                                                                                    {{$v4['en_name']}}
                                                                                    @endif" target="_blank">购物&gt;</a></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            </div>
                                            <!--左右切换-->
                                            <div class="swiper-button-next sn-festival"></div>
                                            <div class="swiper-button-prev sp-festival"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </div>

    <script>
        function IsPhone() {
            var info = navigator.userAgent;
            var isPhone = /mobile/i.test(info);
            return isPhone;
        }

        //平台推荐的切换效果
        function storeSwitch(t,typ){
            $(t).addClass('operaItemAct');
            $(t).siblings().removeClass('operaItemAct');

            $(t).parents(":eq(1)").find('.content_body').find('.operaDiv').hide();
            if(typ==1){
                $(t).parents(":eq(1)").find('.content_body').find('.introduceBox').show();
            }
            else if(typ==2){
                $(t).parents(":eq(1)").find('.content_body').find('.goodsBox').show();
            }
        }

        @if($data['guide']['content_info']['type']==7)
            //平台推荐样式

            if(IsPhone()){
                new Swiper ('.storeSwiper', {
                    direction:'horizontal',
                    loop: true, // 循环模式选项
                    autoplay: {
                        delay:10000,
                    },
                    slidesPerView: 1,
                    setWrapperSize: true,
                    centeredSlides: true,
                    spaceBetween: 20,
                    speed:500,
                    preventDefaultEvents:true,
                    navigation: {
                        nextEl: '.sn-store',
                        prevEl: '.sp-store',
                    },
                });
            }
            else{
                new Swiper ('.storeSwiper', {
                    direction:'horizontal',
                    loop: true, // 循环模式选项
                    autoplay: {
                        delay:10000,
                    },
                    slidesPerView: 2,
                    // setWrapperSize: true,
                    // centeredSlides: true,
                    spaceBetween: 20,
                    speed:500,
                    preventDefaultEvents:true,
                    navigation: {
                        nextEl: '.sn-store',
                        prevEl: '.sp-store',
                    },
                });
            }


            //平台推荐下的商品
            {{--setTimeout(function(){--}}
            {{--    @for($i=0;$i<6;$i++)--}}
            {{--        new Swiper ('.storeGoods{{$i}}', {--}}
            {{--            direction:'horizontal',--}}
            {{--            loop: false, // 循环模式选项--}}
            {{--            autoplay: {--}}
            {{--                delay:3000,--}}
            {{--            },--}}
            {{--            slidesPerView: 1,--}}
            {{--            setWrapperSize: true,--}}
            {{--            centeredSlides: true,--}}
            {{--            spaceBetween: 0,--}}
            {{--            preventDefaultEvents:true--}}
            {{--        });--}}
            {{--    @endfor--}}
            {{--},2000);--}}
        @elseif($data['guide']['content_info']['type']==8)
            //产业集聚样式
            //产业集聚-大卡片

            new Swiper ('.cont6-', {
                loop: false,
                autoplay:false,
                snap: false,
                navigation: {
                    nextEl: '.sn-cont6-',
                    prevEl: '.sp-cont6-',
                },
                on: {
                    slideChange: function () {
                        // 获取当前索引
                        var aidx = this.activeIndex;
                        $('.industryDiv').find('.rightBox').find('.serviceContent').find('.guide_content_pc').css('display','none');
                        $('.industryDiv').find('.rightBox').find('.serviceContent').find('.guide_content_pc').eq(aidx).css('display','block');
                        // console.log(aidx,$('.industryDiv').find('.serviceContent').find('.swiper-container').eq(aidx).css('display'));
                        @foreach($data['guide']['big_children'] as $k2=>$v2)
                        if ({{$k2}}==aidx){
                            new Swiper('.guide_content{{$v2['id']}}', {
                                direction: 'horizontal',
                                loop: false,
                                autoplay: {
                                    delay: 6000,
                                    disableOnInteraction: true,
                                },
                                setWrapperSize: true,
                                centeredSlides: true,
                                speed: 500,
                                navigation: {
                                    nextEl: ".sn-industry",
                                    prevEl: ".sp-industry",
                                },
                            });
                        }
                        @endforeach
                    }
                }
            });

            //产业集聚-小卡片
            @foreach($data['guide']['big_children'] as $k2=>$v2)
                var guide_content{{$v2['id']}} = new Swiper ('.guide_content{{$v2['id']}}', {
                    direction:'horizontal',
                    loop: false,
                    autoplay:{
                        delay:6000,
                        disableOnInteraction:true,
                    },
                    setWrapperSize: true,
                    centeredSlides: true,
                    speed:500,
                    navigation: {
                        nextEl: ".sn-industry{{$v2['id']}}",
                        prevEl: ".sp-industry{{$v2['id']}}",
                    },
                });
            @endforeach

            //手机版循环滚动小卡片
            @foreach($data['guide']['big_children'] as $k2=>$v2)
                new Swiper ('.cont6_children_content{{$v2['id']}}', {
                    direction:'horizontal',
                    loop: true,
                    autoplay:{
                        delay:6000,
                        disableOnInteraction:true,
                    },
                    slidesPerView: 1,
                    setWrapperSize: true,
                    centeredSlides: true,
                    speed:500,
                });
            @endforeach
        @elseif($data['guide']['content_info']['type']==9)
            //环球节庆样式
            new Swiper ('.guide2_content', {
                direction:'horizontal',
                loop: true, // 循环模式选项
                autoplay: {
                    delay:20000,
                },
                slidesPerView: 1,
                setWrapperSize: true,
                centeredSlides: true,
                spaceBetween: 20,
                speed:500,
                navigation: {
                    nextEl: '.sn-festival',
                    prevEl: '.sp-festival',
                },
            });

            //节日国家循环
            @foreach($data['guide']['children'] as $k2=>$v2)
                @foreach($v2 as $k3=>$v3)
                    @foreach($v3 as $k4=>$v4)
                        new Swiper(".guide2_country_content{{$v4['id']}}", {
                            direction:'horizontal',
                            loop: false, // 循环模式选项
                            autoplay: {
                                delay:5000,
                            },
                            slidesPerView: 1,
                            setWrapperSize: true,
                            centeredSlides: true,
                            spaceBetween: 0,
                            speed:500,
                            on:{
                                slideChange:function(){
                                    let actIdx = this.activeIndex;
                                    $(".guide2_country_content{{$v4['id']}}").parent().find('.hsContent').find('.countryDiv').find('.country_name').eq(actIdx).removeClass('country_name_hide');
                                    $(".guide2_country_content{{$v4['id']}}").parent().find('.hsContent').find('.countryDiv').find('.country_name').eq(actIdx).addClass('country_name_show');
                                    $(".guide2_country_content{{$v4['id']}}").parent().find('.hsContent').find('.countryDiv').find('.country_name').eq(actIdx).siblings().removeClass('country_name_show');
                                    $(".guide2_country_content{{$v4['id']}}").parent().find('.hsContent').find('.countryDiv').find('.country_name').eq(actIdx).siblings().addClass('country_name_hide');
                                }
                            }
                        });
                    @endforeach
                @endforeach
            @endforeach
        @endif
    </script>
@stop