<!--头部-->
@include('layouts.header')
<style type="text/css" media="all">
    *{line-height: 24px;}
    .chosen-container-single .chosen-search input[type="text"]{color:#000;}
    body{background:#fff !important;}
    .disf{display:flex;align-items:center;}
    a:focus,a:active{color:#000 !important;border-color:#000 !important;}
    /**轮播区域START**/
    #banner{position: fixed;top: 0;left: 0;height:100%;width: 100%;}
    /**轮播图修改样式**/
    #carousel-container{height:100%;width: 100%;margin-top:105px;}
    .swiper-button-prev, .swiper-button-next{color: {{$website['color_word']}};background: {{$website['color']}};box-shadow: 0px 0px 10px 0 #fff;border: 1px solid {{$website['color_word']}};border-radius: 50%;width: 30px;height: 30px;}
    /*.swiper-button-prev:hover,.swiper-button-next:hover{background:#e60000;}*/
    .swiper-button-prev:after, .swiper-button-next:after {font-size: 14px;font-weight: 800;}
    .swiper-pagination-bullet {width: 6px;height: 6px;background-color: #FFFFFF;opacity: 1;}
    .swiper-pagination-bullet-active {width: 14px;height: 6px;border-radius: 3px;opacity: 1;background-color: #FFFFFF;}
    .swiper-button-disabled{display:none;}

    /**搜索栏**/
    .searchBox{width: 40%;}
    .searchBox .searchLogo{text-align: center;margin-bottom:20px;}
    .searchBox .searchLogo img{width:360px;}
    .searchBox .searchContent{border-radius: 40px;background: #fff;height: 38px;border:1px solid {{$website['color_word']}};width: 100%;}
    .searchBox .selectBox select{border:0;background: none;font-size: 22px;text-align: center;}
    .searchBox .inputBox{height: 100%;width: 100%;box-shadow: 0px 0px 2px 1px {{$website['color_word']}};border-radius: 40px;}
    .searchBox .inputBox .nameBox {padding:0px 0px 0px 20px;position: relative;width: 100%;overflow: hidden;display:flex;align-items: center;}
    .searchBox .inputBox .nameBox input{border:0;width:100%;padding-right:5px;text-align: right;font-weight: 800;}
    .searchBox .inputBox .btnBox{width:60px;height:100%;background:{{$website['color_word']}};display: flex;align-items: center;justify-content: center;border-top-right-radius: 40px;border-bottom-right-radius: 40px;padding:5px 0 0 5px;cursor: pointer;}
    .searchBox .inputBox .btnBox img{width:45px;}
    .searchBox .leftCont1{font-size: 32px;color: #fff;font-weight: 600;margin-bottom: 20px;text-align: center;text-shadow: -1px 0 4px #0e2e68, 0 1px 4px #0e2e68, 1px 0 #0e2e68, 0 -1px #0e2e68;}

    /*选择方式*/
    .searchBox .inputBox .nameBox #method{border:0;text-align: center;width:15%;padding-right:5px;height: 53px;border-left: 1px solid {{$website['color']}};}
    /**轮播区域END**/

    /**内容滚动区域START**/
    .contentBox{position:absolute;left: 50%;transform: translate(-50%, 0%);z-index: 9;top:95%;width: 1200px;box-shadow: 0px 0px 10px 3px #6c6b6b;background:{{$website['color']}};border-top-left-radius: 15px;border-top-right-radius: 15px;}
    .navAndContent {align-items: center;display: flex;flex-direction: column;min-height: 100vh;position: relative;}
    .navAndContent_feed{align-items: center;display: flex;flex-direction: column;transition: background-color 0.4s ease-in-out, opacity 0.4s ease-in-out;width: 100%;}
    .g_nav_container {display: flex;justify-content: center;width: 100%;}
    #g_nav{width: 100%;z-index: 500;}
    .contentSized .navSized {align-items: center;display: flex;gap: 5px;width: 100%;padding:10px 20px;box-sizing: border-box;}
    .contentSized .rightNav {padding:10px 20px 10px 0;box-sizing: border-box;}
    .contentSized .rightNav .nav_item_active{background:{{$website['color']}};color:{{$website['color_word']}};}
    /*.contentSized .rightNav .nav_item_active:hover{background:#e60000;}*/
    .contentSized .rightNav .nav_item_active a{color:{{$website['color_word']}};}
    .nav_item_active a:link{color:{{$website['color_word']}};}
    .navAct{color:#fff;font-weight: 800;}
    .navAct:hover{color:#fff;}
    .navAct:focus{color:#fff;}
    .nav_item{padding:0 10px;box-sizing: border-box;transition:all 0.3s ease;white-space: nowrap;}
    .nav_item a{color:{{$website['color_word']}};font-weight:800;}
    #g_nav .nav_item:hover{background:{{$website['color']}};padding: 4px 12px;box-sizing: border-box;border: 2px solid {{$website['color_word']}};border-radius: 25px;color:{{$website['color_word']}} !important;}
    #g_nav .nav_item:hover a{color:{{$website['color_word']}} !important;}
    .nav_item_active{padding: 4px 12px;box-sizing: border-box;border: 2px solid {{$website['color_word']}};border-radius: 25px;background:{{$website['color']}};}
    .navAndContent_feed > .contentBelowNav {margin-top: 0;padding: 20px;padding-top:0;}
    .contentPlaceHolder {min-height: 100vh;width: 100%;}
    .column4_list{display: grid;grid-template-columns: repeat(3,1fr);-moz-column-gap: 20px;column-gap: 20px;row-gap: 20px;}
    .column4_list .column_gad2{grid-column-start: 1;grid-column-end: 3;}
    .column_item{border-radius: 10px;}

    /*发现轮播*/
    .discoveryDiv{position:relative;height:100%;}
    .discoveryDiv .titleDiv{position:absolute;width:100%;height:80px;bottom:0;left:0;color:#fff;background:rgba(0,0,0,0.5);padding: 15px;box-sizing: border-box;font-weight: 800;white-space: nowrap;text-overflow: ellipsis;overflow:hidden;}
    .discoveryDiv .shareBox{position: absolute;top:10px;right:10px;background: #fff;border-radius: 50%;color:#000;width:30px;height:30px;line-height: 27px;text-align: center;box-shadow: 0px 0px 10px 1px #bebebe;cursor:pointer;display:none;}
    .discoveryDiv .shareBox .bds_more{background: none; color: #000;  margin: 0px; padding-left: 0px; display: block;font-size:32px !important;line-height: 25px;text-align: center;width: 100%;}
    #discovery-container{width:100%;height:385px;border-radius:10px;box-shadow: 0px 0px 10px 1px #bebebe;}

    /*热卖*/
    .column_gd1 .goodsDiv .goodsImg{width:calc(20% - 10px);height:50px;margin-right:10px;}
    .column_gd1 .goodsDiv .goodsInfo{width:80%;}
    .column_gd1 .goodsDiv .goodsInfo .title{width: 100%;text-overflow: ellipsis;overflow:hidden;white-space: nowrap;color:#000;}
    .column_gd1 .goodsDiv .goodsInfo .price{background:{{$website['color']}};color:{{$website['color_word']}};padding: 3px 10px;border-radius: 5px;width: 110px;text-align: center;margin-top:5px;border:1px solid {{$website['color_word']}};}
    .column_gd1 .viewGoods{background:{{$website['color']}};color:{{$website['color_word']}};padding: 3px 10px;border-radius: 5px;width: fit-content;text-align: center;margin-left:15px;cursor:pointer;margin-top:5px;border:1px solid {{$website['color_word']}};}

    .news2{opacity:0;}
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

    .column_gd1 .newsDiv{height:390px;width:100%;background:#fff;border-radius:15px;overflow:hidden;box-shadow: 0px 0px 10px 1px #bebebe;border: 0px solid {{$website['color_word']}};}
    .column_gd1 .newsDiv .newsHead{width:100%;height:10%;border-bottom: 1px solid {{$website['color']}};}
    .column_gd1 .newsDiv .newsHead .newsText{width:50%;text-align: center;color:#000;padding:7px 0;cursor:pointer;}
    .column_gd1 .newsDiv .newsHead .newsAct{background:{{$website['color_word']}};color:{{$website['color']}};}
    .column_gd1 .newsDiv .newsCont{height:90%;max-width:373px;min-width:373px;width:auto;padding:8px 10px 10px;box-sizing: border-box;position: relative;}
    .column_gd1 .newsDiv .newsCont .swiper-container{height:100%;width:100%;}
    .column_gd1 .newsDiv .newsCont .swiper-container .swiper-slide a{overflow: hidden;text-overflow: ellipsis;white-space:nowrap;}
    /**内容滚动区域END**/

    /*各板块下拉框*/
    .columnSelect{background:{{$website['color']}};width:100%;max-width: 90px;border:0;}

    /**超市直采START**/
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
    /**超市直采END**/

    /**产业集聚START**/
    .industryDiv{width: 100%;margin: 50px 0px 0px;padding: 15px;box-sizing: border-box;border:2px solid {{$website['color_word']}};position: relative;border-radius: 5px;border-top-left-radius: 0;}
    .industryDiv .storeTitle{position: absolute;top:-36px;left:-2px;background:{{$website['color']}};color:{{$website['color_word']}};padding:5px 10px;border:2px solid {{$website['color_word']}};z-index: 9;border-bottom: 0;border-radius: 5px;border-bottom-right-radius: 0;border-bottom-left-radius: 0;font-weight: 800;}
    .cont6-bg {z-index: 10;opacity: 1;position: relative;}
    .cont6-bg .headTxt{padding-top: 0px;font-size: 30px;justify-content: center;position: relative;}
    .cont6-bg .headTxt .actTxt {color: #e60000;font-weight: 800;}
    .cont6-bg .headTxt .norTxt {color: #1f5188;font-weight: 800;font-size: 24px;}
    .cont6-bg .headTxt .norTxt span{font-family:PingFang SC,Hiragino Sans GB,Heiti SC,Microsoft YaHei,Helvetica,Tahoma,Arial,SimHei,WenQuanYi Micro Hei !important;font-size: 30px;margin:0 10px;}
    .cont6-bg .serviceBox{width: 100%;margin-top:0px;display: grid;grid-template-columns: repeat(3,1fr);-moz-column-gap: 20px;column-gap: 20px;row-gap: 20px;align-items: flex-start;}
    .cont6-bg .serviceBox .leftBox{width: 362px;height:580px;border:2px solid #b1b1b1;border-radius: 8px;box-shadow: 0px 0px 8px 0px #797777;margin-right:0px;}
    .cont6-bg .serviceBox .leftBox .cont6{position: relative;width: 100%;height:100%;overflow: hidden;}
    .cont6-bg .serviceBox .leftBox .cont6 .serviceContent{background-size: 100%;background-repeat:no-repeat;width: -webkit-fill-available;height:100%;position: relative;cursor: pointer;border-radius: 6px;}
    .cont6-bg .serviceBox .leftBox .cont6 .searviceMask{position: absolute;bottom:0;left:0;background:#000;z-index: 10;opacity: 0.7;width: 100%;height:100%;border-radius: 6px;display: none;}
    .cont6-bg .serviceBox .leftBox .cont6 .serviceContent .serviceDiv{z-index: 12;position: absolute;bottom:-40px;left:50%;transform:translate(-50%,-100%);}
    .cont6-bg .serviceBox .leftBox .cont6 .serviceContent .serviceDiv .serviceTitle{font-size:25px;font-weight: 800;color:#1f5188;}
    .cont6-bg .serviceBox .leftBox .cont6 .serviceContent .serviceDiv .serviceDesc{font-size:15px;font-weight: 800;display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 7;overflow: hidden;text-overflow: ellipsis;width: 100%;margin-top:15px;color:#1f5188;}
    .cont6-bg .serviceBox .leftBox .cont6 .serviceContent .serviceDiv .serviceIn{font-weight:800;margin-top:15px;width: fit-content;color: {{$website['color_word']}};font-size: 15px;background: {{$website['color']}};padding: 4px 15px;border-radius: 15px;border: 2px solid {{$website['color_word']}};}
    .cont6-bg .serviceBox .leftBox .cont6 .serviceContent .serviceDiv .mob_cont6{display:none;}
    .cont6-bg .serviceBox .rightBox{width:100%;height:100%;grid-column-start: 2;grid-column-end: 4;}
    .cont6-bg .serviceBox .rightBox .serviceContent{width:100%;}
    .cont6-bg .serviceBox .rightBox .serviceContent .swiper-container{display: none;}
    .cont6-bg .serviceBox .rightBox .serviceContent .swiper-slide{display: grid;grid-template-columns: repeat(2,1fr);-moz-column-gap: 20px;column-gap: 20px;row-gap: 20px;padding:8px;}
    .cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv{width:-webkit-fill-available;height:274px;border:1px solid #fff;border-radius: 8px;box-shadow: 0px 0px 8px 0px #797777;padding:22px 22px 22px 32px;background: {{$website['color']}};position:relative;}
    .cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv .serviceImg{margin-right:20px;width: 50%;height: 190px;border-radius: 8px;box-shadow: 0px 0px 8px 0px #797977;text-align: center;}
    .cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv .serviceImg img{width:150px;height:150px;border-radius: 8px;border: 2px solid #fff;box-shadow: 0px 0px 8px 0px #797977;}
    .cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv .serviceTitleTop{font-size:25px;font-weight: 800;color:#fff;margin-bottom:0px;text-align: center;margin-top:15%;}
    .cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv .serviceTitle{font-size:25px;font-weight: 800;color:#fff;margin-bottom:0px;text-align: center;margin-top:5px;}
    .cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv .serviceTxt{width:50%;}
    .cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv .serviceTxt .serviceDesc{font-size:15px;font-weight: 800;display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 8;overflow: hidden;text-overflow: ellipsis;width: 100%;margin-top:0px;color:{{$website['color_word']}};}
    .cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv:hover{border-color:{{$website['color']}};color:{{$website['color_word']}};}
    .cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv:hover .serviceTitle{color:{{$website['color_word']}};}
    .cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv:hover .serviceDesc{color:{{$website['color_word']}};}
    .cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv .serviceTxt .moreBtn{width: 100%;text-align: right;position:absolute;bottom: 15px;right: 25px;}
    .cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv .serviceTxt .moreBtn a{color:{{$website['color_word']}};font-size: 15px;background: {{$website['color']}};padding: 4px 15px;border-radius: 15px;border: 1px solid {{$website['color_word']}};font-weight:800;}
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
    .cont4-bg .hsMask{width: 100%;height: 50%;position: absolute;bottom:0;background: #000;opacity:0.5;z-index: 8;border-radius: 6px;border-top-left-radius: 0;border-top-right-radius: 0;}
    .cont4-bg .headBox{margin-bottom:40px;}
    .cont4-bg .hsColumn{display: grid;grid-template-columns: repeat(3,1fr);-moz-column-gap: 20px;column-gap: 20px;row-gap: 20px;margin-bottom:20px;padding:8px;}
    .cont4-bg .hsColumn:last-child{margin-bottom: 0;}
    .cont4-bg .hsDiv{height:220px;position: relative;box-shadow: 0px 0px 8px 0px #797777;}
    .cont4-bg .hsDiv .guide2_country_img{width:100%;max-width: 100%;height:-webkit-fill-available;}
    .cont4-bg .hsDiv .hsContent{opacity: 1;color: #fff;z-index: 10;position:absolute;width: 100%;top: 50%;transform: translate(0, -50%);bottom:3%;transform: unset;top:unset;}
    .cont4-bg .hsDiv .hsContent .title{font-size:18px;font-weight:800;text-align: center;padding:0;font-size:15px;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;}
    .cont4-bg .hsDiv .hsContent .zh_title{font-weight:800;text-align: center;padding:0px 0;}
    .cont4-bg .hsDiv .hsContent .desc{font-size:15px;text-align: center;width: 100%;padding:0;}
    .cont4-bg .hsDiv .hsContent .moreBtn{width: 100%;text-align: center;position: absolute;right: -30%;bottom: -1%;}
    .cont4-bg .hsDiv .hsContent .moreBtn a{color: {{$website['color_word']}};font-size: 15px;background: {{$website['color']}};padding: 2px 10px;border-radius: 15px;border: 2px solid #fff;}
    .cont4-bg .hsDiv .hsContent .countryDiv{text-align: center;}
    .cont4-bg .hsDiv .hsContent .countryDiv .country_name{text-align: center;font-size:15px;font-weight:800;}
    .cont4-bg .hsDiv .hsContent .countryDiv .country_name_show{display: block;}
    .cont4-bg .hsDiv .hsContent .countryDiv .country_name_hide{display: none;}
    /**环球节庆END**/

    .mobile_image{display:none;}
    @media (max-width: 992px) {
        /*.pc_image{display: none;}*/
        /*.mobile_image{display: block;}*/

        .swiper-button-disabled{display:flex;}
        /*搜索栏Logo*/
        .searchBox .searchLogo{display: none;}
        /*手机版轮播图居中且全屏显示*/
        #carousel-container{margin-top:35px;}
        #carousel-container img{background-position: center;background-repeat: no-repeat;background-size: cover;height: 101%;margin: -1px 0px 0px -1px;object-fit: cover;padding: 0;position: absolute;width: 101%;}
        /*搜索框*/
        .searchBox{width: 90%;top:72%;}
        .searchBox .searchContent{height:45px;}
        .searchBox .inputBox .btnBox img{width:50px;}
        .searchBox .inputBox .nameBox{position:relative;overflow: unset;}
        .searchBox .newsContainer{width: 100%;position: absolute;bottom: -40px;}
        .searchBox .inputBox .nameBox input{width:100%;font-size:15px !important;}
        .searchBox .inputBox .nameBox #method{width:40%;}
        .newsContainer .news a p{color:{{$website['color_word']}};text-shadow: -1px 0 1px #0e2e68, 0 1px 1px #0e2e68, 1px 0 #0e2e68, 0 -1px #0e2e68;}

        /*发现*/
        .nav_item_active{padding:2px 12px;}
        .column4_list{margin-top:15px;}
        .discoveryDiv .titleDiv{font-size:16px !important;height:70px;}
        #discovery-container{height: 355px;}
        .column_gd1 .newsDiv{height:355px;}
        .column_gd1 .newsDiv .newsHead .newsText{font-size:15px !important;}
        .column_gd1 .goodsDiv .goodsInfo .price{padding: 2px 8px;width: 100px;}
        .column_gd1 .viewGoods{padding: 2px 8px;}

        /*热卖&客服*/
        .column_gd1{margin-top:30px;}
        .column_gd1 .newsDiv .newsCont{width:100%;min-width: unset;max-width: unset;}
        .column_gd1 .goodsDiv .goodsInfo .title{width: 100%;}
        .column_gd1 .goodsDiv .goodsInfo .price{margin-top:3px !important;}
        .column_gd1 .viewGoods{margin-top:3px !important;}

        /*滚动内容*/
        .contentBox{width: 100%;}
        .contentSized .navSized{width: 100%;}
        .contentSized .rightNav{width: 0%;}
        .nav_item{white-space: nowrap;}
        .column4_list{display: block;}
        .column_item .content_card img{object-fit: cover;}
        .discoveryDiv img{background-position: center;background-repeat: no-repeat;background-size: cover;height: 100%;margin: -1px 0px 0px -1px;object-fit: cover;}
        .column_item{margin-bottom: 0px;}

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
        .cont6-bg .serviceBox .leftBox .cont6 .serviceContent .serviceDiv .mob_cont6 .c6Title a{color:{{$website['color']}};font-size:15px;}

        /*环球节庆*/
        .festivalDiv{margin-top:60px;}
        .cont4-bg .hsColumn{grid-template-columns:repeat(1,1fr);}
        .cont4-bg .hsDiv{height:320px;}
        .cont4-bg .hsMask{height:32%;bottom:0;}
        .cont4-bg .hsDiv .hsContent{bottom:1%;transform: unset;top:unset;}
        .cont4-bg .hsDiv .hsContent .title{font-size:15px;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;padding:0;}
        .cont4-bg .hsDiv .hsContent .desc{padding:0;}
        .cont4-bg .hsDiv .hsContent .moreBtn{width:fit-content;right:6%;}
        .cont4-bg .hsDiv .hsContent .moreBtn a{display: block;padding:0 10px;}
        .cont4-bg .hsDiv .hsContent .zh_title{overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;}
    }

</style>
<link rel="stylesheet" href="/assets/d2eace91/js/chosen/chosen.css?v=1.2"/>
<link rel="stylesheet" href="/assets/d2eace91/layui/css/layui.css">
<section id="banner" class="fullscreen-section" style="border:1px solid {{$website['color_word']}};">
    <!-- 轮播图开始 -->
    <div class="swiper-container" id="carousel-container">
        <!--轮播内容-->
        <div class="swiper-wrapper">
            @foreach($rotate as $k=>$vo)
            <div class="swiper-slide">
                @if($vo['type']==0)
                    @if(!empty($vo['link']))
                        <img src="//shop.gogo198.cn/{{$vo['thumb']}}"  style="width:100%;height:-webkit-fill-available;" class="carousel-image pc_image" onclick="openInNewTab('{{$vo['link']}}');"/>
                    @else
                        <img src="//shop.gogo198.cn/{{$vo['thumb']}}"  style="width:100%;height:-webkit-fill-available;" class="carousel-image pc_image"/>
                    @endif
                @elseif($vo['type']==1)
                    <video src="//shop.gogo198.cn/{{$vo['thumb']}}" style="width:100%;height:-webkit-fill-available;" class="carousel-image pc_image" autoplay loop muted></video>
                @endif
{{--                <img src="//shop.gogo198.cn/{{$vo['api_thumb']}}"  style="width:100%;height:-webkit-fill-available;" class="carousel-image mobile_image"/>--}}
            </div>
            @endforeach
        </div>
    </div>
    <!-- 轮播图结束 -->
</section>

<div class="contentBox">
    <input type="hidden" id="shareTitle" value="">
    <input type="hidden" id="shareUrl" value="">
    <section class="navAndContent navAndContent_tb navAndContent_nb">
        <div class="navAndContent_feed">
            <!--内容一级，导航-->
            <div class="g_nav_container">
                <div id="g_nav">
                    <div class="contentSized contentSizedOneColumn pcNavContent">
                        <div class="disf" style="justify-content: space-between;">
                            <div class="leftNav navSized">
                                <div class="nav_item nav_item_active"><a href="javascript:toTop(1,this);" class="navAct f15">发现</a></div>
                                <div class="nav_item"><a href="javascript:toTop(2,this);" class="navAct f15">跟踪</a></div>
                                <div class="nav_item"><a href="/cart.html" target="_blank" class="navAct f15">购物车</a></div>
                            </div>
                            <div class="rightNav" style="display: block;">
                                <div class="disf">
                                    @foreach($data['guide'] as $k=>$v)
                                        @if($k<10)
                                            <div class="nav_item"><a href="/guide_page?id={{$v['id']}}" target="_blank" class="f15">{{$v['title']}}</a></div>
                                        @endif
                                    @endforeach

                                    <style>
                                        .pcNavContent .overflowContainer{color:{{$website['color_word']}};font-size:15px;cursor:pointer;display:inline-block;margin-left: 5px;}
                                        .pcNavContent .overflowMenu{display:none;background:{{$website['color']}};color:{{$website['color_word']}};position: absolute;width: 100px;text-align: center;top: -70px;left: 335px;}
                                        .pcNavContent .overflowMenu .nav_item{padding:5px 10px;white-space: nowrap;}
                                        .pcNavContent .overflowMenu .nav_item a{color:{{$website['color_word']}};}
                                    </style>
                                    <div class="overflowContainer" onclick="showMenu()" style="display:@if(count($data['guide'])>9)
                                            block
                                    @else
                                            none
                                    @endif;">
                                        ···
                                    </div>
                                    <div class="overflowMenu">
                                        @foreach($data['guide'] as $k=>$v)
                                            @if($k>9)
                                                <div class="nav_item"><a href="/guide_page?id={{$v['id']}}" target="_blank" class="f15">{{$v['title']}}</a></div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>

                                <div class="nav_item_active" style="display: none;">
                                    <a href="javascript:connect_kefu();" class="disf">
                                        <span class="f15" style="display: inline-block;white-space: nowrap;margin-left:5px;">客服中心</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="contentSized contentSizedOneColumn wapNavContent" style="display: none;">
                        <style>
                            .wapNavContent .leftNav{display: inline-block;overflow: visible;height:45px;position: relative;padding: 10px 10px 10px 20px;}
                            .wapNavContent .rightNav{display: inline-block;}
                            .wapNavContent .navSized .nav_item{display: inline-block;}
                            .wapNavContent .overflowContainer{color:{{$website['color_word']}};font-size:25px;font-weight:800;cursor:pointer;display:inline-block;margin-left: 5px;}
                            .wapNavContent .overflowMenu{display:none;background:{{$website['color']}};color:{{$website['color_word']}};font-weight:800;position: absolute;width: 100px;text-align: center;top: -140px;right: 75px;}
                            .wapNavContent .overflowMenu .nav_item{padding:5px 10px;}
                            .wapNavContent .overflowMenu .nav_item a{color:{{$website['color_word']}};}
                        </style>
                        <div class="disf" style="justify-content: space-between;align-items: baseline;">
                            <div class="leftNav navSized">
                                <div class="nav_item nav_item_active"><a href="javascript:toTop(1,this);" class="navAct f15">发现</a></div>
                                <div class="nav_item"><a href="javascript:toTop(2,this);" class="navAct f15">跟踪</a></div>
                                <div class="nav_item"><a href="/cart.html" target="_blank" class="navAct f15">购物车</a></div>
{{--                                foreach($data['guide'] as $k=>$v)--}}
{{--                                    if($k<2)--}}
{{--                                        <div class="nav_item"><a href="/guide_page?id=$v['id']}}" target="_blank" class="f15">$v['title']}}</a></div>--}}
{{--                                    endif--}}
{{--                                endforeach--}}
                                <div class="overflowContainer" onclick="showMenu()">
                                    ···
                                </div>
                                <div class="overflowMenu">
                                    @foreach($data['guide'] as $k=>$v)
                                        <div class="nav_item"><a href="/guide_page?id={{$v['id']}}" target="_blank" class="f15">{{$v['title']}}</a></div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="rightNav" style="display: none;">
                                <div class="nav_item_active">
                                    <a href="javascript:connect_kefu();" class="disf">
                                        <span class="f15" style="display: inline-block;white-space: nowrap;margin-left:5px;">客服中心</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--内容二级-->
            <div class="contentBelowNav contentSized contentSizedOneColumn contentPlaceHolder">
                <!--内容二级，发现&热卖-->
                <div class="column4_list">
                    <div class="column_gad2 column_item">
                        <div class="column1">
                            <div class="swiper-container" id="discovery-container">
                                <!--轮播内容-->
                                <div class="swiper-wrapper">
                                    @foreach($discovery_rotate as $k=>$vo)
                                        <div class="swiper-slide">
                                            <div class="discoveryDiv">
                                                <a href="@if($vo['go_other']==1)
                                                            {{$vo['other_link']}}
                                                        @elseif($vo['go_other']==2)
                                                            @if($vo['other_navbar']==121)
                                                                /
                                                            @elseif($vo['other_navbar']==122)
                                                                //gather.gogo198.cn
                                                            @endif
                                                        @elseif($vo['go_other']==3)
                                                            /txt_detail?id={{$vo['other_pic']}}&type=1&oid={{$vo['id']}}
                                                        @elseif($vo['go_other']==4)
                                                            /msg_detail?id={{$data['other_msg']}}&type=1&oid={{$vo['id']}}
                                                        @elseif($vo['go_other']==5)
                                                            /goods_list?frame_id=4&hotsearchId={{$vo['id']}}&searchTitle={{$vo['other_keywords']}}
                                                        @endif" target="_blank">
                                                    <img src="//shop.gogo198.cn/{{$vo['thumb']}}" srcset="//shop.gogo198.cn/{{$vo['thumb']}} 1x, //shop.gogo198.cn/{{$vo['thumb']}} 2x, //shop.gogo198.cn/{{$vo['thumb']}} 3x" alt="" style="width:100%;" class="carousel-image"/>
                                                    <div class="titleDiv f22">
                                                        {{$vo['descs']}}
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <!--左右切换-->
                                <div class="swiper-button-next sn1"></div>
                                <div class="swiper-button-prev sp1"></div>
                                <!--分页器-->
                                <div class="swiper-pagination" style="text-align:center;"></div>
                            </div>
                        </div>

                        <div class="column2" style="display: none;">
                            <div class="socialDiv">
                                <script src="https://static.elfsight.com/platform/platform.js" async></script> <div class="elfsight-app-16a1bf14-23e8-4616-9398-e54c14f74e34" data-elfsight-app-lazy></div>
                            </div>
                        </div>
                    </div>
                    <div class="column_gd1 column_item">
                        <div class="newsDiv">
                            <div class="newsHead disf">
                                <div class="newsText leftText newsAct f20" onclick="change_news(1)">热卖</div>
                                <div class="newsText rightText f20" onclick="change_news(2)">客服</div>
                            </div>
                            <div class="newsCont">
                                <div class="swiper-container news1">
                                    <div class="swiper-wrapper">
                                        @foreach($hotbuy as $k=>$vo)
                                            @if(!empty($vo['mainItemImgs']))
                                                <div class="swiper-slide">
                                                    <div class="goodsDiv">
                                                        <a href="/goods-{{$vo['goods_id']}}.html" target="_blank">
                                                            <div class="disf">
                                                                <div class="goodsImg" style="background: url({{$vo['mainItemImgs'][0]['path']}}) no-repeat 100% 100%;background-size: cover;"></div>
                                                                <div class="goodsInfo">
                                                                    <div class="title f15" title="{{$vo['goods_name']}}">{{$vo['goods_name']}}</div>
                                                                    <div class="disf">
                                                                        <div class="price f15">{{$vo['currency']}} {{$vo['goods_price']}}</div>
                                                                        <div class="viewGoods">详情</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="news2" style="width:95%;height:98%;">
                                    <iframe src="https://boss.gogo198.cn/?s=customer/customer_online&pa=2&who_send=2&id=0&pid=0&isframe=1&uid=<?php echo session('user.gogo_id');?>" frameborder="0" style="width:100%;height:100%;"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @foreach($data['guide'] as $k=>$v)
                    @if($v['content_info']['type']==7)
                        <!--平台推荐样式-->

                            <div class="storeDiv">
                                <div class="storeTitle f15">
                                    <select id="storeSelect" class="columnSelect">
                                        <option value="">{{$v['title']}}</option>
                                        @if(!empty($data['guide'][$k]['company_info']))
                                            @foreach($data['guide'][$k]['company_info'] as $k2=>$v2)
                                                <option value="{{$v2['id']}}">{{$v2['company']}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="swiper-container storeSwiper storeSwiper{{$k}}" style="overflow-y:visible;padding:7px;box-sizing: border-box;">
                                    <div class="swiper-wrapper">
                                        @if(!empty($data['guide'][$k]['goods_info']))
                                            @foreach($data['guide'][$k]['goods_info'] as $k2=>$v2)
                                                <div class="swiper-slide">
                                                    <div class="hsBox disf">
                                                        <div class="hs2 hsDiv" style="position:relative;">
                                                            <!--当前节日，所有的国家循环-->
                                                            <img src="{{$v2['goods_image']}}" alt="" class="guide2_goods_img">
                                                            <div class="hsMask"></div>
                                                            <div class="hsContent">
                                                                <div class="title" title="{{$v2['goods_name']}}">{{$v2['goods_name']}}</div>
                                                                <div class="moreBtn disf">
                                                                    <div class="storeName">{{$v2['company']}}</div>
                                                                    <div class="priceDiv disf">
                                                                        <div class="currency">{{$v2['goods_currency']}}</div>
                                                                        <div class="price">{{$v2['price']}}</div>
                                                                    </div>
                                                                    <div class="detailDiv">
                                                                        <a href="/goods-{{$v2['goods_id']}}.html" target="_blank">购物&gt;</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            @for($i=0;$i<4;$i++)
                                            <div class="swiper-slide">
                                                <div class="hsBox disf">
                                                    <div class="hs2 hsDiv" style="position:relative;">
                                                        <!--当前节日，所有的国家循环-->
                                                        <?php $rand_num=mt_rand(1, 2);?>
                                                        <img src="/images/goods_empty{{$rand_num}}.jpg" alt="" class="guide2_goods_img">
                                                        <div class="hsMask"></div>
                                                        <div class="hsContent">
                                                            <div class="title" title="">淘中国</div>
                                                            <div class="moreBtn disf">

{{--                                                                <div class="priceDiv disf">--}}
{{--                                                                    <div class="currency">{{$v2['goods_currency']}}</div>--}}
{{--                                                                    <div class="price">{{$v2['price']}}</div>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="detailDiv">--}}
{{--                                                                    <a href="/goods-{{$v2['goods_id']}}.html" target="_blank">购物&gt;</a>--}}
{{--                                                                </div>--}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endfor
                                        @endif
                                    </div>
                                    <!--左右切换-->
                                    <div class="swiper-button-next sn-store sn-store{{$k}}"></div>
                                    <div class="swiper-button-prev sp-store sp-store{{$k}}"></div>
                                </div>
                            </div>

                        @if(1>2)
                        @if($v['id']==14)
                            <div class="storeDiv">
                                <div class="storeTitle f15">
                                    <select id="factorySelect" class="columnSelect">
                                        <option value="">{{$v['title']}}</option>
                                        @foreach($data['guide'][$k]['company_info'] as $k2=>$v2)
                                        <option value="{{$v2['id']}}">{{$v2['company']}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="swiper-container storeSwiper factorySwiper{{$k}}" style="overflow-y:visible;padding:7px;box-sizing: border-box;">
                                    <div class="swiper-wrapper">
                                        @foreach($data['guide'][$k]['company_goods_info'] as $k3=>$v3)
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
                                    <div class="swiper-button-next sn-store sn-factory{{$k}}"></div>
                                    <div class="swiper-button-prev sp-store sp-factory{{$k}}"></div>
                                </div>

                            </div>
                        @else
                            <div class="storeDiv">
                                <div class="storeTitle f15">
                                    <select id="storeSelect" class="columnSelect">
                                        <option value="">{{$v['title']}}</option>
                                        <option value="">山姆店1</option>
                                        <option value="">山姆店2</option>
                                        <option value="">山姆店3</option>
                                        {{--                                    @foreach($v['children'] as $k2=>$v2)--}}
                                        {{--                                        @foreach($v2 as $k3=>$v3)--}}
                                        {{--                                            @foreach($v3 as $k4=>$v4)--}}
                                        {{--                                                <option value="{{$v4['id']}}">{{$v4['en_name']}}</option>--}}
                                        {{--                                            @endforeach--}}
                                        {{--                                        @endforeach--}}
                                        {{--                                    @endforeach--}}
                                    </select>
                                </div>
                                <div class="swiper-container storeSwiper storeSwiper{{$k}}" style="overflow-y:visible;padding:7px;box-sizing: border-box;">
                                    <div class="swiper-wrapper">
                                        @for($i=0;$i<6;$i++)
                                            <div class="swiper-slide">
                                                <div class="hsBox disf">
                                                    <div class="hs2 hsDiv" style="position:relative;">
                                                        <!--当前节日，所有的国家循环-->
                                                        <img src="https://img.alicdn.com/bao/uploaded/i3/2206588314948/O1CN01cZ9caO1mQEjLrHHWz_!!2206588314948-2-C2M.png" alt="" class="guide2_goods_img">
                                                        <div class="hsMask"></div>
                                                        <div class="hsContent">
                                                            <div class="title" title="商品{{$i}}">@if($i==2)
                                                                    批发国庆节胸针中国庆典胸章万岁金属爱国徽章纪念别针纪念品国旗
                                                                @else
                                                                    商品{{$i}}
                                                                @endif</div>
                                                            <div class="moreBtn disf">
                                                                <div class="storeName">山姆店{{$i}}</div>
                                                                <div class="priceDiv disf">
                                                                    <div class="currency">CNY</div>
                                                                    <div class="price">99999.99</div>
                                                                </div>
                                                                <div class="detailDiv">
                                                                    <a href="/good-a.html" target="_blank">购物&gt;</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endfor
                                    </div>
                                    <!--左右切换-->
                                    <div class="swiper-button-next sn-store sn-store{{$k}}"></div>
                                    <div class="swiper-button-prev sp-store sp-store{{$k}}"></div>
                                </div>
                            </div>
                        @endif
                        @endif
                    @elseif($v['content_info']['type']==8)
                        <!--产业集聚样式-->
                        <div class="industryDiv">
                            <div class="storeTitle f15">
                                <select id="industrySelect" class="columnSelect">
                                    <option value="">{{$v['title']}}</option>
                                    @if(!empty($v['big_children']))
                                        @foreach($v['big_children'] as $k2=>$v2)
                                            <option value="{{$v2['id']}}">{{$v2['name']}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="cont6-bg fullscreen-section3 section">
                                <div class="w1200" style="height:100%;">
                                    <div class="serviceBox disf">
                                        <div class="leftBox">
                                            <div class="swiper-container cont6 cont6-{{$k}}">
                                                <div class="swiper-wrapper">
                                                    @if(!empty($v['big_children']))
                                                        @foreach($v['big_children'] as $k2=>$v2)
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
                                                    @else

                                                    @endif
                                                </div>
                                                <!--左右切换-->
                                                <div class="swiper-button-next sn-cont6-{{$k}}"></div>
                                                <div class="swiper-button-prev sp-cont6-{{$k}}"></div>
                                            </div>
                                        </div>
                                        <div class="rightBox">
                                            <div class="serviceContent">
                                                @foreach($v['big_children'] as $k2=>$v2)
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
                    @elseif($v['content_info']['type']==9)
                        <!--环球节庆样式-->
                        <div class="festivalDiv">
                            <div class="storeTitle f15">
                                <select id="festivalSelect" class="columnSelect">
                                    <option value="">{{$v['title']}}</option>
                                    @foreach($v['children'] as $k2=>$v2)
                                        @foreach($v2 as $k3=>$v3)
                                            @foreach($v3 as $k4=>$v4)
                                                <option value="{{$v4['id']}}">{{$v4['en_name']}}</option>
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                            <div class="cont4-bg fullscreen-section3 section">
                                <div class="w1200" style="height:100%;">
                                    <div class="hsContent" style="height: 80%;overflow: hidden;">
                                        <div class="swiper-container guide2_content{{$k}}">
                                            <div class="swiper-wrapper">
                                                @foreach($v['children'] as $k2=>$v2)
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
                                            <div class="swiper-button-next sn-festival{{$k}}"></div>
                                            <div class="swiper-button-prev sp-festival{{$k}}"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
</div>
@include('layouts.footer')

<script src="/assets/d2eace91/layui/layui.js"></script>
<script src="/assets/d2eace91/js/chosen/jquery.chosen.js?v=1.3"></script>
<script type="text/javascript" charset="utf-8">
    $('.city-select').chosen();

    layui.use(['layer','element','upload','form'],function() {
        var $ = layui.$
            , layer = layui.layer
            , element = layui.element
            , form = layui.form
            , upload = layui.upload;
    });

    //banner点击跳转
    function openInNewTab(link=''){
        if(link!=''){
            const newWindow = window.open(link, '_blank', 'noopener,noreferrer');
            if (newWindow) newWindow.opener = null;
        }
    }

    // onmouseover更新分享组件的url和title
    function change_share_config(t) {
        let bdUrl = $(t).find('.bds_more').attr('data-bdUrl');
        let title = $(t).find('.bds_more').attr('data-title');
        $('#shareUrl').val(bdUrl);
        $('#shareTitle').val(title);

        setConfigShare();
    }

    function setShareConfig(cmd,config){
        config.bdUrl = $('#shareUrl').val();
        config.bdText = $('#shareTitle').val();
        return config;
    }

    function setConfigShare(){
        if(window._bd_share_main){
            window._bd_share_config = {
                'common': {
                    "bdText":$('#shareTitle').val(),
                    "bdUrl":$('#shareUrl').val(),
                    // onBeforeClick:setShareConfig
                },
                'share': {}
            };
            window._bd_share_main.init();
        }else{
            window._bd_share_config = {
                'common': {
                    "bdText":$('#shareTitle').val(),
                    "bdUrl":$('#shareUrl').val(),
                    // onBeforeClick:setShareConfig
                },
                'share': {}
            };
            with (document) {
                0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = './js/api/js/share.js?v=<?php echo time();?>.js?cdnversion=' + ~(-new Date() / 36e5)];
            }
        }
    }

    //microsoft edge样式
    function isMicrosoftEdge() {
        var userAgent = navigator.userAgent;
        return userAgent.indexOf("Edg") > -1 || userAgent.indexOf("EdgA") > -1;
    }

    var auto_time = '';
    $(function(){
        //获取北京时间
        auto_time = setInterval(function getTime(){
            // 创建一个 Date 对象
            var date = new Date();

            // 使用 toLocaleString() 方法将 Date 对象转换为所需的格式
            var formatted_date = date.toLocaleString('en-US', { year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false });
            formatted_date = formatted_date.split(', ');
            $('.beijing-time .beijing_sec').html(formatted_date[1]);
        },1000);

        if(IsPhone()){
            $('.contentBox').css({'-webkit-transform':'translate(-50%, -0.2%)'});
            $('.wapNavContent').show();
            $('.mobile_news_box').show();
            $('.pc_news_box').hide();
            $('.pcNavContent').hide();
        }else{
            if (isMicrosoftEdge()) {
                $('.contentBox').css({'-webkit-transform':'translate(-50%, 0.2%)'});
            }
            $('.mobile_news_box').hide();
        }
    });

    //获取城市时间
    function selectCity(t){
        let val = $(t).val();

        $.post('//shop.gogo198.cn/collect_website/public/?s=api/getgoods/get_worldcity_time', {'city':val}, function(data) {
            // setInterval(function getWorldTime(){
            formatTime(data.data.result.datetime_1);
            // }, 1000);
        }, 'json');
    }

    function formatTime(times='') {
        clearInterval(auto_time);

        const time = new Date(times);

        function update() {
            // 更新时间
            const hours = time.getHours().toString().padStart(2, '0');
            const minutes = time.getMinutes().toString().padStart(2, '0');
            const seconds = time.getSeconds().toString().padStart(2, '0');
            $('.beijing-time .beijing_sec').html(`${hours}:${minutes}:${seconds}`);

            // 更新日期
            const year = time.getFullYear();
            const month = (time.getMonth() + 1).toString().padStart(2, '0');
            const day = time.getDate().toString().padStart(2, '0');
            $('.beijing-time .beijing_date').html(`${year}/${month}/${day}`);

            // 递增秒数，模拟时间流逝
            time.setSeconds(time.getSeconds() + 1);
        }
        // 首次更新时间和日期
        update();

        // 每秒更新时间和日期
        auto_time = setInterval(update, 1000);
    }

    //手机版显示超出菜单
    function showMenu(){
        if($('.overflowMenu').css('display')=='block'){
            $('.overflowMenu').css('display','none');
        }else{
            $('.overflowMenu').css('display','block');
        }
    }

    //切换新闻/疾病
    function change_news(type){
        if(type==1){
            $('.leftText').addClass('newsAct');
            $('.rightText').removeClass('newsAct');
        }else if(type==2){
            @if(!empty(session('user')))
                $('.rightText').addClass('newsAct');
                $('.leftText').removeClass('newsAct');
                let width = $('.newsCont').width();
                let height = $('.newsCont').height();
                $('#aichat').css({'width':width,'height':height});
            @else
                window.location.href="/login.html";
            @endif
        }
        $('.news'+type).css({'opacity':1,'position':'absolute','top':'5px','left':'10px','z-index':11});
        $('.news'+type).siblings().css({'opacity':0,'z-index':10});
    }

    //轮播图==============START
    //轮播图轮播
    new Swiper ('#carousel-container', {
        loop: true, // 循环模式选项
        autoplay: {
            delay:30000,
        },
        // 如果需要分页器
        pagination: {
            el: '.swiper-pagination',
        },
    });

    //新闻轮播
    var newsSwiper = new Swiper('.news', {
        direction:'vertical',
        loop: true, // 循环模式选项
        autoplay: {
            delay:5000
        },
        spaceBetween: 1,
        // 如果需要分页器
        // pagination: {
        //     el: '.swiper-pagination',
        // },
    });
    // newsSwiper.on('init', function () {
    //     var activeIndex = newsSwiper.activeIndex;
    //     var slide = newsSwiper.slides[activeIndex];
    //     slide.innerHTML = '<marquee direction="left">'+slide.innerHTML+'</marquee>';
    // });
    // newsSwiper.on('slideChangeTransitionStart', function(){
    //     var activeIndex = newsSwiper.activeIndex;
    //     var slide = newsSwiper.slides[activeIndex];
    //     slide.innerHTML = '<marquee direction="left">'+slide.innerHTML+'</marquee>';
    // });
    //汇率轮播
    var rate = new Swiper ('.rate_swiper', {
        loop: true,
        direction:'vertical',
        spaceBetween:0,
        autoplay:{
            delay:5000,
            disableOnInteraction:false,
        },
    });

    //口号轮播
    var slogan_swiper = new Swiper ('.slogan_swiper', {
        loop: true,
        direction:'vertical',
        spaceBetween:0,
        autoplay:{
            delay:5000,
            disableOnInteraction:false,
        },
    });

    //浏览量轮播
    var readNum = new Swiper ('.readNum', {
        loop: true,
        direction:'vertical',
        spaceBetween:0,
        autoplay:{
            delay:5000,
            disableOnInteraction:false,
        },
    });

    //延迟加载“手机版的-汇率、浏览量、口号、新闻”
    setTimeout(function() {
        //集成
        new Swiper ('#mobileNewsBox-container', {
            loop: true, // 循环模式选项
            direction:'vertical',
            autoplay: {
                delay:15000,
            },
            // 如果需要分页器
            // pagination: {
            //     el: '.swiper-pagination',
            // },
        });
        //汇率
        var mrate_swiper = new Swiper ('.mrate_swiper', {
            loop: true,
            direction:'vertical',
            spaceBetween:0,
            autoplay:{
                delay:5000,
                disableOnInteraction:false,
            },
        });
        //阅读量
        var mreadNum = new Swiper('.mreadNum', {
            loop: true,
            direction: 'vertical',
            spaceBetween: 0,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
        });
        //口号轮播
        var mslogan_swiper = new Swiper ('.mslogan_swiper', {
            loop: true,
            direction:'vertical',
            spaceBetween:0,
            autoplay:{
                delay:5000,
                disableOnInteraction:false,
            },
        });
    },1000);
    //轮播图==============END

    // 发现页轮播图开始
    new Swiper ('#discovery-container', {
        loop: true, // 循环模式选项
        autoplay: {
            delay:10000,
        },
        // 如果需要分页器
        pagination: {
            el: '.swiper-pagination',
        },
        speed:500,
        navigation: {
            nextEl: '.sn1',
            prevEl: '.sp1',
        },
    });

    //热卖
    new Swiper ('.news1', {
        direction:'vertical',
        loop: true, // 循环模式选项
        autoplay: {
            delay:6000,
        },
        slidesPerView: 5,
        setWrapperSize: true,
        centeredSlides: true,
        spaceBetween: 0,
    });

    @foreach($data['guide'] as $k=>$v)
        @if($v['content_info']['type']==7)
            //平台推荐样式
            if(IsPhone()){
                new Swiper ('.storeSwiper{{$k}}', {
                    direction:'horizontal',
                    loop: true, // 循环模式选项
                    autoplay: {
                        delay:5000,
                    },
                    slidesPerView: 1,
                    setWrapperSize: true,
                    centeredSlides: true,
                    spaceBetween: 20,
                    speed:500,
                    preventDefaultEvents:true,
                    navigation: {
                        nextEl: '.sn-store{{$k}}',
                        prevEl: '.sp-store{{$k}}',
                    },
                });
            }
            else{
                new Swiper ('.storeSwiper{{$k}}', {
                    direction:'horizontal',
                    loop: true, // 循环模式选项
                    autoplay: {
                        delay:5000,
                    },
                    slidesPerView: 2,
                    // setWrapperSize: true,
                    // centeredSlides: true,
                    spaceBetween: 20,
                    speed:500,
                    preventDefaultEvents:true,
                    navigation: {
                        nextEl: '.sn-store{{$k}}',
                        prevEl: '.sp-store{{$k}}',
                    },
                });
            }
        @elseif($v['content_info']['type']==8)
            //产业集聚样式

            //产业集聚-大卡片
            new Swiper ('.cont6-{{$k}}', {
                loop: false,
                autoplay:false,
                snap: false,
                navigation: {
                    nextEl: '.sn-cont6-{{$k}}',
                    prevEl: '.sp-cont6-{{$k}}',
                },
                on: {
                    slideChange: function () {
                        // 获取当前索引
                        var aidx = this.activeIndex;
                        $('.industryDiv').find('.rightBox').find('.serviceContent').find('.guide_content_pc').css('display','none');
                        $('.industryDiv').find('.rightBox').find('.serviceContent').find('.guide_content_pc').eq(aidx).css('display','block');
                        // console.log(aidx,$('.industryDiv').find('.serviceContent').find('.swiper-container').eq(aidx).css('display'));
                        @foreach($v['big_children'] as $k2=>$v2)
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
                                    nextEl: ".sn-industry{{$v2['id']}}",
                                    prevEl: ".sp-industry{{$v2['id']}}",
                                },
                            });
                        }
                        @endforeach
                    }
                }
            });

            //产业集聚-小卡片
            @foreach($v['big_children'] as $k2=>$v2)
                var guide_content{{$v2['id']}} = new Swiper ('.guide_content{{$v2['id']}}', {
                    direction:'horizontal',
                    loop: false,
                    autoplay:{
                        delay:5000,
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
            @foreach($v['big_children'] as $k2=>$v2)
                new Swiper ('.cont6_children_content{{$v2['id']}}', {
                    direction:'horizontal',
                    loop: true,
                    autoplay:{
                        delay:5000,
                        disableOnInteraction:true,
                    },
                    slidesPerView: 1,
                    setWrapperSize: true,
                    centeredSlides: true,
                    speed:500,
                });
            @endforeach
        @elseif($v['content_info']['type']==9)
            //环球节庆样式
            new Swiper ('.guide2_content{{$k}}', {
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
                navigation: {
                    nextEl: '.sn-festival{{$k}}',
                    prevEl: '.sp-festival{{$k}}',
                },
            });

            //节日国家循环
            @foreach($v['children'] as $k2=>$v2)
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
    @endforeach
    //发现轮播图结束

    //页面滚动时的效果变化（头部）
    window.addEventListener('scroll', function() {
        var scrollPosition = window.scrollY;
        // console.log(scrollPosition,$(window).height()-200);
        if(scrollPosition>$(window).height()-200){
            if(IsPhone()){
                $('#banner').css({'margin-top':'0px'});
            }else{
                $('header').find('.news_box').hide();
                $('#carousel-container').css('margin-top','76px');
            }
        }else{
            if(IsPhone()){
                $('#banner').css({'margin-top':'83px'});
            }else{
                $('header').find('.news_box').show();
                $('#carousel-container').css('margin-top','105px');
            }
        }
    });

    //点击发现时的切换效果
    function toTop(typ){
        $('html,body').animate({scrollTop:$(window).height()-150},'smooth');
        if(typ==1){
            $('.column1').show();
            $('.column2').hide();
        }else if(typ==2){
            $('.column1').hide();
            $('.column2').show();
        }
        $('.contentSized .disf .nav_item').eq(typ-1).addClass('nav_item_active');
        $('.contentSized .disf .nav_item').eq(typ-1).siblings().removeClass('nav_item_active');
    }
</script>

@include('layouts.common_function')