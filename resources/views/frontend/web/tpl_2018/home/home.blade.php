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
    .navAndContent_feed{align-items: center;display: flex;flex-direction: column;transition: background-color 0.4s ease-in-out, opacity 0.4s ease-in-out;width: 100%;padding-bottom:45px;}
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
    #discovery-container{width:100%;height:400px;border-radius:10px;box-shadow: 0px 0px 10px 1px #bebebe;}

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
    /*.storeDiv{width: 100%;margin: 50px 0px 0px;padding: 10px 10px;position: relative;border:2px solid {{$website['color_word']}};box-sizing: border-box;border-radius: 5px;border-top-left-radius: 0;}*/
    /*.storeDiv .storeTitle{position: absolute;top:-36px;left:-2px;background:{{$website['color']}};color:{{$website['color_word']}};padding:5px 10px;border:2px solid {{$website['color_word']}};z-index: 9;border-bottom: 0;border-radius: 5px;border-bottom-right-radius: 0;border-bottom-left-radius: 0;font-weight: 800;}*/
    /*.storeDiv .column4_list{width:100%;}*/
    /*.storeDiv .hsBox{border: 3px solid #fff;border-radius: 8px;width: 100%;box-shadow: 0px 0px 8px 0px #797777;}*/
    /*.storeDiv .hsBox .hsDiv{width:100%;height: 500px;position: relative;overflow:hidden;}*/
    /*.storeDiv .hsBox .hsDiv .guide2_goods_img{width: 100%;max-width: 100%;height: -webkit-fill-available;transition: filter .6s, opacity .6s, transform .6s, box-shadow .3s;}*/
    /*.storeDiv .hsBox .hsDiv .guide2_goods_img:hover{transform: scale(1.2);}*/
    /*.storeDiv .hsBox .hsDiv .hsMask{width: 100%;height: 30%;position: absolute;bottom: 0;background: #000;opacity: 0.5;z-index: 8;border-radius: 6px;border-top-left-radius: 0;border-top-right-radius: 0;}*/
    /*.storeDiv .hsBox .hsDiv .hsContent{opacity: 1;color: #fff;z-index: 10;position: absolute;width: 100%;top: 75%;padding:0 10px;box-sizing:border-box;}*/
    /*.storeDiv .hsBox .hsDiv .hsContent .title{font-size:18px;font-weight: 800;display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 2;overflow: hidden;text-overflow: ellipsis;margin-bottom:30px;min-height:48px;max-height:48px;}*/
    /*.storeDiv .hsBox .hsDiv .hsContent .moreBtn{justify-content: right;}*/
    /*.storeDiv .hsBox .hsDiv .hsContent .moreBtn .storeName{background:{{$website['color']}};padding: 2px 10px;border-radius: 15px;border: 2px solid #fff;color:{{$website['color_word']}};margin-right:10px;max-width:100px;text-overflow: ellipsis;overflow:hidden;white-space: nowrap;font-weight: 800;}*/
    /*.storeDiv .hsBox .hsDiv .hsContent .moreBtn .priceDiv{background:{{$website['color']}};padding: 2px 10px;border-radius: 15px;border: 2px solid #fff;margin-right:10px;}*/
    /*.storeDiv .hsBox .hsDiv .hsContent .moreBtn .priceDiv .currency{color:{{$website['color_word']}};font-size:15px;font-weight: 800;margin-right:5px;}*/
    /*.storeDiv .hsBox .hsDiv .hsContent .moreBtn .priceDiv .price{color:{{$website['color_word']}};font-size:15px;font-weight: 800;}*/
    /*.storeDiv .hsBox .hsDiv .hsContent .moreBtn .detailDiv a{color: {{$website['color_word']}};font-size: 15px;background: {{$website['color']}};padding: 3px 10px;border-radius: 15px;border: 2px solid #fff;font-weight: 800;}*/
    /**超市直采END**/

    /**产业集聚START**/
    /*.industryDiv{width: 100%;margin: 50px 0px 0px;padding: 15px;box-sizing: border-box;border:2px solid {{$website['color_word']}};position: relative;border-radius: 5px;border-top-left-radius: 0;}*/
    /*.industryDiv .storeTitle{position: absolute;top:-36px;left:-2px;background:{{$website['color']}};color:{{$website['color_word']}};padding:5px 10px;border:2px solid {{$website['color_word']}};z-index: 9;border-bottom: 0;border-radius: 5px;border-bottom-right-radius: 0;border-bottom-left-radius: 0;font-weight: 800;}*/
    /*.cont6-bg {z-index: 10;opacity: 1;position: relative;}*/
    /*.cont6-bg .headTxt{padding-top: 0px;font-size: 30px;justify-content: center;position: relative;}*/
    /*.cont6-bg .headTxt .actTxt {color: #e60000;font-weight: 800;}*/
    /*.cont6-bg .headTxt .norTxt {color: #1f5188;font-weight: 800;font-size: 24px;}*/
    /*.cont6-bg .headTxt .norTxt span{font-family:PingFang SC,Hiragino Sans GB,Heiti SC,Microsoft YaHei,Helvetica,Tahoma,Arial,SimHei,WenQuanYi Micro Hei !important;font-size: 30px;margin:0 10px;}*/
    /*.cont6-bg .serviceBox{width: 100%;margin-top:0px;display: grid;grid-template-columns: repeat(3,1fr);-moz-column-gap: 20px;column-gap: 20px;row-gap: 20px;align-items: flex-start;}*/
    /*.cont6-bg .serviceBox .leftBox{width: 362px;height:580px;border:2px solid #b1b1b1;border-radius: 8px;box-shadow: 0px 0px 8px 0px #797777;margin-right:0px;}*/
    /*.cont6-bg .serviceBox .leftBox .cont6{position: relative;width: 100%;height:100%;overflow: hidden;}*/
    /*.cont6-bg .serviceBox .leftBox .cont6 .serviceContent{background-size: 100%;background-repeat:no-repeat;width: -webkit-fill-available;height:100%;position: relative;cursor: pointer;border-radius: 6px;}*/
    /*.cont6-bg .serviceBox .leftBox .cont6 .searviceMask{position: absolute;bottom:0;left:0;background:#000;z-index: 10;opacity: 0.7;width: 100%;height:100%;border-radius: 6px;display: none;}*/
    /*.cont6-bg .serviceBox .leftBox .cont6 .serviceContent .serviceDiv{z-index: 12;position: absolute;bottom:-40px;left:50%;transform:translate(-50%,-100%);}*/
    /*.cont6-bg .serviceBox .leftBox .cont6 .serviceContent .serviceDiv .serviceTitle{font-size:25px;font-weight: 800;color:#1f5188;}*/
    /*.cont6-bg .serviceBox .leftBox .cont6 .serviceContent .serviceDiv .serviceDesc{font-size:15px;font-weight: 800;display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 7;overflow: hidden;text-overflow: ellipsis;width: 100%;margin-top:15px;color:#1f5188;}*/
    /*.cont6-bg .serviceBox .leftBox .cont6 .serviceContent .serviceDiv .serviceIn{font-weight:800;margin-top:15px;width: fit-content;color: {{$website['color_word']}};font-size: 15px;background: {{$website['color']}};padding: 4px 15px;border-radius: 15px;border: 2px solid {{$website['color_word']}};}*/
    /*.cont6-bg .serviceBox .leftBox .cont6 .serviceContent .serviceDiv .mob_cont6{display:none;}*/
    /*.cont6-bg .serviceBox .rightBox{width:100%;height:100%;grid-column-start: 2;grid-column-end: 4;}*/
    /*.cont6-bg .serviceBox .rightBox .serviceContent{width:100%;}*/
    /*.cont6-bg .serviceBox .rightBox .serviceContent .swiper-container{display: none;}*/
    /*.cont6-bg .serviceBox .rightBox .serviceContent .swiper-slide{display: grid;grid-template-columns: repeat(2,1fr);-moz-column-gap: 20px;column-gap: 20px;row-gap: 20px;padding:8px;}*/
    /*.cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv{width:-webkit-fill-available;height:274px;border:1px solid #fff;border-radius: 8px;box-shadow: 0px 0px 8px 0px #797777;padding:22px 22px 22px 32px;background: {{$website['color']}};position:relative;}*/
    /*.cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv .serviceImg{margin-right:20px;width: 50%;height: 190px;border-radius: 8px;box-shadow: 0px 0px 8px 0px #797977;text-align: center;}*/
    /*.cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv .serviceImg img{width:150px;height:150px;border-radius: 8px;border: 2px solid #fff;box-shadow: 0px 0px 8px 0px #797977;}*/
    /*.cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv .serviceTitleTop{font-size:25px;font-weight: 800;color:#fff;margin-bottom:0px;text-align: center;margin-top:15%;}*/
    /*.cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv .serviceTitle{font-size:25px;font-weight: 800;color:#fff;margin-bottom:0px;text-align: center;margin-top:5px;}*/
    /*.cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv .serviceTxt{width:50%;}*/
    /*.cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv .serviceTxt .serviceDesc{font-size:15px;font-weight: 800;display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 8;overflow: hidden;text-overflow: ellipsis;width: 100%;margin-top:0px;color:{{$website['color_word']}};}*/
    /*.cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv:hover{border-color:{{$website['color']}};color:{{$website['color_word']}};}*/
    /*.cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv:hover .serviceTitle{color:{{$website['color_word']}};}*/
    /*.cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv:hover .serviceDesc{color:{{$website['color_word']}};}*/
    /*.cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv .serviceTxt .moreBtn{width: 100%;text-align: right;position:absolute;bottom: 15px;right: 25px;}*/
    /*.cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv .serviceTxt .moreBtn a{color:{{$website['color_word']}};font-size: 15px;background: {{$website['color']}};padding: 4px 15px;border-radius: 15px;border: 1px solid {{$website['color_word']}};font-weight:800;}*/
    /*.cont6-bg .serviceContent .guide_smlcontent{bottom: var(--swiper-pagination-bottom, 13%);left: var(--swiper-pagination-left, 50%);transform: translate(-38%, 0%);}*/
    /**产业集聚END**/

    /**环球节庆START**/
    /*.festivalDiv{width: 100%;margin: 50px 0px 0px;padding: 15px;box-sizing: border-box;border:2px solid {{$website['color_word']}};position: relative;border-radius: 5px;border-top-left-radius: 0;margin-bottom:40px;}*/
    /*.festivalDiv .storeTitle{position: absolute;top:-36px;left:-2px;background:{{$website['color']}};color:{{$website['color_word']}};padding:5px 10px;border:2px solid {{$website['color_word']}};z-index: 9;border-bottom: 0;border-bottom: 0;border-radius: 5px;border-bottom-right-radius: 0;border-bottom-left-radius: 0;font-weight: 800;}*/
    /*.cont4-bg {z-index: 10;opacity: 1;position: relative;}*/
    /*.cont4-bg .headTxt{padding-top: 0px;font-size: 30px;justify-content: center;position: relative;}*/
    /*.cont4-bg .headTxt .actTxt {color: #e60000;font-weight: 800;}*/
    /*.cont4-bg .headTxt .norTxt {color: #1f5188;font-weight: 800;font-size: 24px;}*/
    /*.cont4-bg .headTxt .norTxt span{font-family:PingFang SC,Hiragino Sans GB,Heiti SC,Microsoft YaHei,Helvetica,Tahoma,Arial,SimHei,WenQuanYi Micro Hei !important;font-size: 30px;margin:0 10px;}*/
    /*.cont4-bg .hs1{background:url(/assets/d2eace91/images/newhome/hotsearch1.png);background-size: 100% 100%;background-repeat: no-repeat;border: 2px solid #b1b1b1;border-radius: 8px;width: 795px;}*/
    /*.cont4-bg .hs2{border: 3px solid #fff;border-radius: 8px;width: 100%;}*/
    /*.cont4-bg .hsMask{width: 100%;height: 50%;position: absolute;bottom:0;background: #000;opacity:0.5;z-index: 8;border-radius: 6px;border-top-left-radius: 0;border-top-right-radius: 0;}*/
    /*.cont4-bg .headBox{margin-bottom:40px;}*/
    /*.cont4-bg .hsColumn{display: grid;grid-template-columns: repeat(3,1fr);-moz-column-gap: 20px;column-gap: 20px;row-gap: 20px;margin-bottom:20px;padding:8px;}*/
    /*.cont4-bg .hsColumn:last-child{margin-bottom: 0;}*/
    /*.cont4-bg .hsDiv{height:220px;position: relative;box-shadow: 0px 0px 8px 0px #797777;}*/
    /*.cont4-bg .hsDiv .guide2_country_img{width:100%;max-width: 100%;height:-webkit-fill-available;}*/
    /*.cont4-bg .hsDiv .hsContent{opacity: 1;color: #fff;z-index: 10;position:absolute;width: 100%;top: 50%;transform: translate(0, -50%);bottom:3%;transform: unset;top:unset;}*/
    /*.cont4-bg .hsDiv .hsContent .title{font-size:18px;font-weight:800;text-align: center;padding:0;font-size:15px;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;}*/
    /*.cont4-bg .hsDiv .hsContent .zh_title{font-weight:800;text-align: center;padding:0px 0;}*/
    /*.cont4-bg .hsDiv .hsContent .desc{font-size:15px;text-align: center;width: 100%;padding:0;}*/
    /*.cont4-bg .hsDiv .hsContent .moreBtn{width: 100%;text-align: center;position: absolute;right: -30%;bottom: -1%;}*/
    /*.cont4-bg .hsDiv .hsContent .moreBtn a{color: {{$website['color_word']}};font-size: 15px;background: {{$website['color']}};padding: 2px 10px;border-radius: 15px;border: 2px solid #fff;}*/
    /*.cont4-bg .hsDiv .hsContent .countryDiv{text-align: center;}*/
    /*.cont4-bg .hsDiv .hsContent .countryDiv .country_name{text-align: center;font-size:15px;font-weight:800;}*/
    /*.cont4-bg .hsDiv .hsContent .countryDiv .country_name_show{display: block;}*/
    /*.cont4-bg .hsDiv .hsContent .countryDiv .country_name_hide{display: none;}*/
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
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+SC:wght@300;400;500;700&display=swap" rel="stylesheet">
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
                                <!--<div class="nav_item"><a href="javascript:toTop(2,this);" class="navAct f15">跟踪</a></div>-->
                                <div class="nav_item"><a href="/cart.html" target="_blank" class="navAct f15">购物车</a></div>
                            </div>
                            <div class="rightNav" style="display: block;">
                                <div class="disf">
                                    @if(1>2)
                                        @foreach($data['guide'] as $k=>$v)
                                            @if(!empty($v['info']['name']))
                                                @if($k<10)
                                                    <div class="nav_item"><a href="/guide_page?id={{$v['id']}}" target="_blank" class="f15">{{$v['info']['name']}}</a></div>
                                                @endif
                                            @endif
                                        @endforeach
                                    @endif

                                    <style>
                                        .pcNavContent .overflowContainer{color:{{$website['color_word']}};font-size:15px;cursor:pointer;display:inline-block;margin-left: 5px;}
                                        .pcNavContent .overflowMenu{display:none;background:{{$website['color']}};color:{{$website['color_word']}};position: absolute;width: 100px;text-align: center;top: -70px;left: 335px;}
                                        .pcNavContent .overflowMenu .nav_item{padding:5px 10px;white-space: nowrap;}
                                        .pcNavContent .overflowMenu .nav_item a{color:{{$website['color_word']}};}
                                    </style>
                                    @if(isset($data['guide']))
                                        <div class="overflowContainer" onclick="showMenu()" style="display:
                                                @if(count($data['guide'])>9) 
                                                    block 
                                                @else 
                                                    none 
                                                @endif
                                            ;">
                                            ···
                                        </div>
                                    @endif
                                    <div class="overflowMenu">
                                        @if(1>2)
                                            @foreach($data['guide'] as $k=>$v)
                                                @if(!empty($v['info']['name']))
                                                    @if($k>9)
                                                        <div class="nav_item"><a href="/guide_page?id={{$v['id']}}" target="_blank" class="f15">{{$v['info']['name']}}</a></div>
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endif
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
                                <!--<div class="nav_item"><a href="javascript:toTop(2,this);" class="navAct f15">跟踪</a></div>-->
                                <div class="nav_item"><a href="/cart.html" target="_blank" class="navAct f15">购物车</a></div>
                                <div class="overflowContainer" onclick="showMenu()">
                                    ···
                                </div>
                                <div class="overflowMenu">
                                    @if(1>2)
                                        @foreach($data['guide'] as $k=>$v)
                                            @if(!empty($v['info']['name']))
                                                <div class="nav_item"><a href="/guide_page?id={{$v['id']}}" target="_blank" class="f15">{{$v['info']['name']}}</a></div>
                                            @endif
                                        @endforeach
                                    @endif
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
            @if(1>2)
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
                                            <option value="">{{$v['name']}}</option>
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
                        @elseif($v['content_info']['type']==8)
                            <!--产业集聚样式-->
                            <div class="industryDiv">
                                <div class="storeTitle f15">
                                    <select id="industrySelect" class="columnSelect">
                                        <option value="">{{$v['name']}}</option>
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
                                        <option value="">{{$v['name']}}</option>
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
                @else
                    <style>
                        :root {--primary-color: {{$website['color']}};--primary-light: #818cf8;--primary-dark: #3730a3;--secondary-color: #10b981;--accent-color: #f59e0b;--accent-gradient: linear-gradient(90deg, #f59e0b, #ec4899);--dark-color: #0f172a;--light-color: #f8fafc;--gray-color: #64748b;--card-bg: rgba(255, 255, 255, 0.85);--card-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);--glass-bg: rgba(255, 255, 255, 0.2);--glass-border: 1px solid rgba(255, 255, 255, 0.3);--transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);--border-radius: 20px;}
                    
                        /*发现轮播 + 切换框====start*/
                        .rc_container{max-width: 100% !important;padding:50px 0;}
                        .rc_container .header {background: linear-gradient(90deg, #4361ee 0%, #3a0ca3 100%);color: white;padding: 20px 30px;display: flex;justify-content: space-between;align-items: center;}
                        .rc_container .header h1 {font-weight: 700;font-size: 1.8rem;letter-spacing: 1px;}
                        .rc_container .date {background: rgba(255, 255, 255, 0.2);padding: 6px 15px;border-radius: 20px;font-size: 0.9rem;}
                        .rc_container .content {display: flex;flex-wrap: wrap;padding: 0px;margin:0 auto;width: 100%;}
                    
                        /* 左侧轮播图样式 */
                        .rc_container .left-section {flex: 1;min-width: 300px;padding: 15px;}
                        .rc_container .swiper-container {border-radius: 15px;overflow: hidden;box-shadow: 0 10px 30px #777;height: 400px;position: relative;}
                        .rc_container .swiper-slide {position: relative;background-size: cover;background-position: center;display: flex;flex-direction: column;justify-content: flex-end;padding: 30px;color: white;}
                        .rc_container .slide-overlay {background: linear-gradient(transparent, rgba(255, 255, 255, 0.8));position: absolute;bottom: 0;left: 0;right: 0;padding: 30px 20px 20px;}
                        .rc_container .slide-title {color:{{$website['color_word']}};font-weight: 600;margin-bottom: 20px;text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);}
                        .rc_container .slide-desc {opacity: 0.9;text-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);}
                        .rc_container .swiper-pagination {bottom: 15px !important;}
                        .rc_container .swiper-pagination-bullet {background: rgba(255, 255, 255, 0.5);opacity: 1;width: 10px;height: 10px;}
                        .rc_container .swiper-pagination-bullet-active {background: var(--primary-color);}
                    
                        /* 右侧内容样式 */
                        .rc_container .right-section {flex: 1;min-width: 300px;max-width: 420px;padding: 15px;display: flex;flex-direction: column;}
                        .rc_container .tab-container {display: flex;margin-bottom: 10px;border-bottom: 2px solid #eaeaea;}
                        .rc_container .tab {padding: 5px 30px;cursor: pointer;font-weight: 500;position: relative;color: #666;transition: all 0.3s ease;}
                        .rc_container .tab.active {color: var(--primary-color);font-weight: 600;}
                        .rc_container .tab.active::after {content: '';position: absolute;bottom: -2px;left: 0;right: 0;height: 3px;background: var(--primary-color);border-radius: 3px 3px 0 0;}
                        .rc_container .news-container {background: white;border-radius: 15px;overflow: hidden;box-shadow: 0 0px 15px #777;flex-grow: 1;display: flex;flex-direction: column;}
                        .rc_container .news-header {background: var(--accent-gradient);color: white;padding: 15px 20px;font-weight: 600;}
                        .rc_container .news-content {flex-grow: 1;overflow: hidden;position: relative;height: 300px;}
                        .rc_container .news-vertical-slider {position: absolute;top: 0;left: 0;width: 100%;height: 100%;}
                        .rc_container .news-slide {padding: 20px;border-bottom: 1px solid #f0f0f0;transition: all 0.3s ease;cursor:pointer;}
                        .rc_container .news-slide:last-child {border-bottom: none;}
                        .rc_container .news-slide:hover {background-color: #f8f9ff;transform: translateX(5px);}
                        .rc_container .news-title {font-weight: 500;margin-bottom: 8px;color: #333;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;-webkit-line-clamp: 1;width: 100%;}
                        .rc_container .news-title::before {content: "•";color: #4361ee;font-size: 1.5rem;margin-right: 10px;}
                        .rc_container .news-source {color: #4361ee;font-weight: 600;display: inline-block;background: rgba(67, 97, 238, 0.1);padding: 3px 10px;border-radius: 15px;margin-right: 10px;}
                        .rc_container .news-time {color: #888;}
                        .rc_container .news-desc {color: #666;line-height: 1.5;margin-top: 10px;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 3;-webkit-box-orient: vertical;height: 60px;}
                        .rc_container .customer-service {margin-top: 0px;background: white;border-radius: 15px;overflow: hidden;box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);display:none;height:350px;}
                        .rc_container .service-header {background: var(--accent-gradient);color: white;padding: 15px 20px;font-weight: 600;font-size: 1.2rem;}
                        .rc_container .service-content {padding: 10px;text-align: center;color: #888;font-style: italic;height: 85%;display: flex;align-items: center;justify-content: center;}
                    
                        /* 响应式设计 */
                        @media (max-width: 768px) {
                            .rc_container{padding:20px 0;max-width:400px !important;}
                            .rc_container .content {flex-direction: column;width: 100%;}
                            .rc_container .left-section, .right-section {width: 100%;}
                            .rc_container .swiper-container {height: 300px;}
                            .rc_container .header {flex-direction: column;text-align: center;gap: 10px;}
                            .rc_container .tab-container {justify-content: center;}
                        }
                    
                        @media (max-width: 480px) {
                            .rc_container .header h1 {font-size: 1.4rem;}
                            .rc_container .tab {padding: 10px 15px;font-size: 0.9rem;}
                            .rc_container .slide-title {font-size: 1.2rem;}
                        }
                    
                        /*热卖区域*/
                        .column_gd1 .goodsDiv .goodsImg{width:calc(20% - 10px);height:50px;margin-right:10px;}
                        .column_gd1 .goodsDiv .goodsInfo{width:100%;}
                        .column_gd1 .goodsDiv .goodsInfo .title{width: 100%;text-overflow: ellipsis;overflow:hidden;white-space: nowrap;color:#000;}
                        .column_gd1 .goodsDiv .goodsInfo .price{background:{{$website['color']}};color:{{$website['color_word']}};padding: 3px 10px;border-radius: 5px;width: 110px;text-align: center;margin-top:5px;border:1px solid {{$website['color_word']}};}
                        .column_gd1 .viewGoods{background:{{$website['color']}};color:{{$website['color_word']}};padding: 3px 10px;border-radius: 5px;width: fit-content;text-align: right;margin-left:15px;cursor:pointer;margin-top:5px;border:1px solid {{$website['color_word']}};}
                    
                        .news2{opacity:0;}
                        /*新闻*/
                        .column_gd1 .newsDiv{height:390px;width:100%;background:#fff;border-radius:15px;overflow:hidden;box-shadow: 0px 0px 10px 1px #bebebe;border: 0px solid {{$website['color_word']}};}
                        .column_gd1 .newsDiv .newsHead{width:100%;height:10%;border-bottom: 1px solid {{$website['color']}};}
                        .column_gd1 .newsDiv .newsHead .newsText{width:50%;text-align: center;color:#000;padding:7px 0;cursor:pointer;}
                        .column_gd1 .newsDiv .newsHead .newsAct{background:{{$website['color']}};color:{{$website['color_word']}};}
                        .column_gd1 .newsDiv .newsCont{height:90%;max-width:373px;min-width:373px;width:auto;padding:8px 10px 10px;box-sizing: border-box;position: relative;}
                        .column_gd1 .newsDiv .newsCont .swiper-container{height:100%;width:100%;}
                        .column_gd1 .newsDiv .newsCont .swiper-container .swiper-slide a{overflow: hidden;text-overflow: ellipsis;white-space:nowrap;}
                        /*发现轮播 + 切换框====end*/
                    
                        /**各板块公用样式====start**/
                        .cross-border{padding-top: 20px;padding-bottom:20px;border-top:2px solid {{$website['color']}};display: grid;align-items: center;overflow:hidden;width:100%;}
                        /*.cross-border .container{padding:30px;}*/
                        .cross-border .section-title {text-align: left;margin-bottom: 40px;}
                        .cross-border .section-title a {text-decoration: none;display: inline-block;}
                        .cross-border .section-title a h2 {font-size: 2.2rem;font-weight: 700;color: {{$website['color']}};opacity:0.8;position: relative;margin-bottom: 15px;padding-bottom: 10px;letter-spacing: -0.5px;}
                        .cross-border .section-title a h2::after {content: '';position: absolute;bottom: 0;left: 0;width: 60px;height: 3px;background: linear-gradient(90deg, {{$website['color_head']}}, {{$website['color']}});border-radius: 2px;transition: width 0.3s;}
                        .cross-border .section-title a:hover h2::after {width: 100px;}
                        .cross-border .section-title p {font-size: 1rem;line-height: 1.8;color: #555;font-weight: 400;margin: 0;text-overflow: ellipsis;overflow: hidden;display: -webkit-box;-webkit-line-clamp: 3;-webkit-box-orient: vertical;}
                        .cross-border .row .cross-section{background-position: center;background-size: cover;position:relative;transform-style: preserve-3d;box-shadow: 0px 0px 10px 1px #555;}
                        .cross-border .row .cross-section .in_mask{background-color: #444; opacity: 0.4;position: absolute;left: 0;top: 0;height: 15%;width: 100%;z-index:1;}
                        .cross-border .row .cross-section .cross-content{padding:20px 30px 80px 30px;z-index:2;position:relative;font-size: 15px;height:100%;border: 3px solid #777;}
                        .cross-border .row .cross-section .cross-content h3{color:#fff;margin-bottom:10px;padding-bottom:0;}
                        .cross-border .row .cross-section .cross-content hr{border-bottom:1px solid #fff;width:75px;margin:0 0 10px;}
                        .cross-border .row .cross-section .cross-content p{color:#fff;text-align:left;text-overflow: -o-ellipsis-lastline;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 3;line-clamp: 3;-webkit-box-orient: vertical;height:68px;font-weight:unset;}
                        .cross-border .row .cross-section .cross-content .withArrow{margin-bottom:30px;}
                        .cross-border .row .cross-section .cross-content .withArrow span{color:#fff;}
                        .cross-border .row .cross-section .cross-content .withArrow a{font-weight:unset;color:#fff;}
                        @media (max-width: 992px){
                            .cross-border .container{padding:30px;}
                        }
                        /**各板块公用样式====end**/
                    
                        /*大图轮播====start*/
                        .bigPic .cross-content hr{ border-bottom: 1px solid {{$website['color_word']}};width: 75px;margin: 0 0 10px;}
                        .cross-border.bigPic {padding: 60px 0;background: {{$website['color']}};border-top: 2px solid {{$website['color_head']}};height: auto;}
                        .bigPic .container {width:100%;max-width: 1200px;margin: 0 auto;padding: 0 20px;}
                        /*.big_swiper {overflow: hidden;border-radius: 24px;box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);background: transparent;}*/
                        .bigPic .swiper-wrapper {display: flex;}
                        .bigPic .swiper-slide {height: auto;padding: 10px;box-sizing: border-box;}
                        /* 卡片容器 */
                        .bigPic .cross_border_content {height: 100%;}
                        .bigPic .about-text {height: 100%;}
                        .bigPic .cross-section {position: relative;background-position: center;background-size: cover;background-repeat: no-repeat;border-radius: 0px;overflow: hidden;box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);transition: all 0.3s ease;height: 100%;min-height: 300px;display: flex;align-items: flex-end;}
                        /* 遮罩层 - 改为渐变 */
                        .bigPic .in_mask {position: absolute;top: 0;left: 0;width: 100%;height: 20%;background-color: #444;opacity: 0.9;z-index: 1;transition: opacity 0.3s;}
                        /* 卡片内容 */
                        .bigPic .cross-content {position: relative;z-index: 2;padding: 30px;color: {{$website['color_word']}};width: 100%;box-sizing: border-box;transform: translateY(0);transition: transform 0.3s;}
                        .bigPic .cross-content h3 {font-size: 1.8rem;font-weight: 600;margin: 0 0 15px 0;color: #fff;text-shadow: 0 2px 5px rgba(0,0,0,0.3);letter-spacing: 1px;}
                        .bigPic .cross-content h3 a {color: inherit;text-decoration: none;}
                        /* 描述文字（如果有） */
                        .bigPic .cross-content p {font-size: 0.95rem;line-height: 1.6;margin: 15px 0;opacity: 0.9;text-overflow: ellipsis;overflow: hidden;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;}
                        /* 查看详情按钮 */
                        .bigPic .view_detail {display: inline-block;padding: 10px 25px;background: rgba(255,255,255,0.2);backdrop-filter: blur(2px);border: 1px solid rgba(255,255,255,0.4);border-radius: 40px;color: #fff;font-weight: 500;text-decoration: none;transition: all 0.3s ease;margin-top: 10px;font-size: 0.95rem;letter-spacing: 0.5px;}
                        .bigPic .view_detail:hover {background: {{$website['color']}};border-color: {{$website['color_word']}};color:{{$website['color_word']}};}
                        /* 如果标题也是链接，保持一致 */
                        .bigPic .cross-content a[target="_blank"] h3 {transition: color 0.3s;}
                        @media (max-width: 992px){
                            .cross-border.bigPic{padding:20px 0;}
                            .cross-border.bigPic .section-title{margin-bottom:0;}
                            .bigPic .row{margin-top:0% !important;}
                            .bigPic .big_swiper{width:100%;max-width:400px;}
                            .bigPic .swiper-slide{padding:0;}
                        }
                        /*大图轮播====end*/
                    
                        /**业务切换框样式====start**/
                        .change_boxClick .change_body{padding: 10px;box-sizing: border-box;border-radius:10px;}
                        /* 头部切换区域 */
                        .change_boxClick .tab-header {display: flex;align-items: center;justify-content: center;/**background-color: #e9ecef;**/position: relative;width:95%;max-width: 100%;margin: 0 auto;padding:0px;border-radius:0px;border: 0px solid #fff;margin-top:10px;}
                        .change_boxClick .tab-header::after {content: "";position: absolute;bottom: 0;width: 100%;height: 2px;background: #e0e0e0;z-index: 1;}
                        .change_boxClick .tab-nav {display: flex;flex-wrap: nowrap;overflow-x: auto;scroll-behavior: smooth;-webkit-overflow-scrolling: touch;overflow:hidden;width: 100%;justify-content: center;}
                        .change_boxClick .tab-nav::-webkit-scrollbar {display: none;}
                        .change_boxClick .tab-item {flex: 0 0 auto;padding: 12px 20px;cursor: pointer;transition: all 0.3s ease;font-weight: 600;color:#555;}
                        .change_boxClick .tab-item:hover{color:{{$website['color_head']}};}
                        .change_boxClick .tab-item.active {color: {{$website['color']}};border-radius:10px;position:relative;}
                        .change_boxClick .tab-item.active::after {content: "";position: absolute;bottom: -1px;left: 0;width: 100%;height: 4px;background: {{$website['color']}};border-radius: 2px;z-index: 3;}
                    
                        /* 左右箭头 */
                        .change_boxClick .arrow {position: absolute;top: 50%;transform: translateY(-50%);width: 30px;height: 30px;background-color: rgba(255, 255, 255, 0.8);border: 1px solid #e9ecef;border-radius: 4px;cursor: pointer;display: none; /* 初始隐藏，超过宽度时显示 */justify-content: center;align-items: center;font-size: 16px;color: #495057;}
                        .change_boxClick .arrow.left {left: -40px;text-align: center;}
                        .change_boxClick .arrow.right {right: -40px;text-align: center;}
                    
                        /* 内容区域 */
                        .change_boxClick .container {max-width: 100%;margin: 30px auto 20px;display: flex;flex-wrap: wrap;padding: 0 15px;}
                        .change_boxClick .content-left {flex: 1 1 400px;background-color: #fff;padding: 20px;border: 0px solid #e9ecef;border-radius: 15px;margin-right: 20px;margin-bottom: 10px;box-shadow:0 4px 20px rgba(0, 0, 0, 0.08);}
                        .change_boxClick .content-left .content-scroll{min-height:300px;height:300px;overflow-y: auto;}
                        .change_boxClick .content-left .content-btm{margin-top:20px;}
                        .change_boxClick .content-left .content-btm .view_detailBtn{background: {{$website['color']}};color: {{$website['color_word']}};padding: 7px 10px;border-radius: 7px;font-weight: 600;}
                        .change_boxClick .content-left .content-btm .view_detailBtn2{background: {{$website['color_word']}};border:1px solid {{$website['color']}};color: {{$website['color']}};padding: 7px 10px;border-radius: 7px;font-weight: 600;margin:0 5px;}
                        .change_boxClick .content-item {margin-bottom: 20px;}
                        .change_boxClick .content-item .icon {display: inline-block;width: 20px;height: 20px;margin-right: 8px;vertical-align: middle;background-size: cover;}
                        .change_boxClick .content-item .title {display: inline-block;vertical-align: middle;margin-bottom: 8px;color: {{$website['color']}};font-weight:600;}
                        .change_boxClick .content-item .desc {color: #555;line-height: 1.6;text-indent:3rem;}
                        .change_boxClick .content-right {flex: 1 1 400px;background-color: #fff;padding: 0px;border: 0px solid #e9ecef;border-radius: 4px;margin-bottom: 10px;text-align: center;box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);}
                        .change_boxClick .content-right img {max-width: 100%;width:100%;height: 100%;border-radius: 15px;box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);transform: perspective(1000px) rotateY(-5deg);transition: transform 0.4s ease;}
                        .change_boxClick .content-right img:hover {transform: perspective(1000px) rotateY(0deg);}
                        @media (max-width: 992px){
                            .change_body .container{width:100% !important;}
                        }
                        /**业务切换框样式====end**/
                    
                        /* 常见问题项容器样式1====start*/
                        .fold_boxClick .container{padding:30px;}
                        .fold_boxClick .fold_body{padding:10px;box-sizing: border-box;background: #fff;box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);border-radius: 10px;min-height: 460px;height:460px;max-height:460px;overflow-y: auto;width:100%;}
                        .fold_boxClick .faq-item {border: 1px solid #ddd;border-radius: 6px;margin-bottom: 10px;overflow: hidden;}
                        /* 标题样式 */
                        .fold_boxClick .faq-title {background-color: {{$website['color']}};color:{{$website['color_word']}};padding: 12px 16px;cursor: pointer;font-weight: 600;font-size:15px;display: flex;justify-content: space-between;align-items: center;position:relative;opacity:0.8;}
                        .fold_boxClick .faq-title:after{content: "+";position: absolute;right: 10px;font-size: 25px;font-weight: 600;color:{{$website['color_word']}};}
                        /* 内容样式，默认隐藏 */
                        .fold_boxClick .faq-content {padding: 0 16px;max-height: 0;opacity: 0;overflow: hidden;transition: max-height 0.2s ease-out, opacity 0.2s ease-out;}
                        /* 内容展开时的样式 */
                        .fold_boxClick .faq-content.show {padding: 12px 16px;max-height: 200px; overflow-y:auto; opacity: 1;transition: max-height 0.2s ease-in, opacity 0.2s ease-in;background:#fff;}
                        /* 常见问题项容器样式1====end*/
                    
                        /* 常见问题项容器样式2====start*/
                        .fq_container .categories {display: flex;border-bottom: 2px solid #e0e0e0;/*background: #fff;*/}
                        .fq_container .category {flex: 1;text-align: center;padding: 18px 0;font-size: 18px;font-weight: 500;cursor: pointer;transition: all 0.3s ease;position: relative;color: #555;}
                        .fq_container .category.active {color: var(--primary-color);}
                        .fq_container .category.active::after {content: '';position: absolute;bottom: 0;left: 50%;transform: translateX(-50%);width: 60%;height: 3px;background: var(--primary-color);border-radius: 3px;}
                        .fq_container .category:hover {background: rgba(67, 97, 238, 0.05);}
                        .fq_container .faq-container {padding: 30px;min-height: 450px;}
                        .fq_container .swiper {height: 500px;width: 100%;}
                        .fq_container .news-item {padding: 10px;border-radius: 0px;background: white;box-shadow: 0 5px 15px rgba(0, 0, 0, 0.03);border: 1px solid #f0f0f0;transition: all 0.3s ease;cursor: pointer;display: flex;justify-content: space-between;align-items: center;}
                        .fq_container .news-item:hover {transform: translateY(-3px);box-shadow: 0 0px 15px 0px rgba(0,0,0,0.4);border-color: #e0e8ff;}
                        .fq_container .news-content {flex: 1;}
                        .fq_container .news-title {font-weight: 500;font-size: 18px;margin-bottom: 8px;color: #222;}
                        .fq_container .news-title::before {content: "Gogo";display: inline-block;background: rgba(67, 97, 238, 0.1);color: var(--primary-color);font-size: 14px;padding: 3px 8px;border-radius: 4px;margin-right: 10px;}
                        .fq_container .news-desc {font-size: 15px;color: #666;line-height: 1.5;}
                        .fq_container .news-date {background: #f8f9ff;color: var(--primary-color);padding: 8px 14px;border-radius: 30px;font-size: 14px;font-weight: 500;min-width: 110px;text-align: center;}
                        .fq_container .qa_swiper{display:none;overflow:hidden;padding:20px;box-sizing: border-box;}
                        .fq_container .qa_swiper .swiper-slide{height:unset;}
                        .fq_container .qa1_swiper{display:block;}
                    
                        /* 响应式设计 */
                        @media (max-width: 768px) {
                            .fold_boxClick .container{padding:30px;}
                            .fq_container .category {padding: 15px 0;font-size: 16px;}
                            .fq_container .faq-container {padding: 20px 15px;min-height: 400px;max-height:505px;overflow:hidden;}
                            .fq_container .swiper {height: 465px;}
                            .fq_container .news-item {padding: 15px;flex-direction: column;align-items: flex-start;}
                            .fq_container .news-date {margin-top: 15px;align-self: flex-end;}
                            .fq_container .news-title {font-size: 16px;}
                            .fq_container .news-desc {font-size: 14px;}
                            .fq_container .qa_swiper{padding:0;}
                            .fq_container .qa_swiper .swiper-slide{height:fit-content !important;}
                        }
                    
                        @media (max-width: 480px) {
                            .fq_container .categories {flex-direction: row;}
                            .fq_container .category {padding: 12px 0;border-bottom: 1px solid #eee;}
                            .fq_container .category.active::after {width: 100%;border-radius: 0;}
                            .fq_container .news-title::before {display: block;margin-right: 0;margin-bottom: 8px;}
                        }
                        /* 常见问题项容器样式2====end*/
                    
                        /*卡片样式一====start*/
                        .card1_style{margin-top:0%;}
                        .card1_style .feature-container {display: flex;flex-wrap: wrap;justify-content: space-around;padding: 20px;}
                        .card1_style .feature-item {width: 23%;min-width: 250px;border: 1px solid #e6e6e6;border-radius: 8px;box-shadow:0px 0px 15px 0px rgba(0,0,0,0.4);padding: 20px;margin-bottom: 20px;max-height: 350px;/*height: 280px;*/}
                        .card1_style .feature-item:hover{border:1px solid {{$website['color']}};}
                        .card1_style .feature-title {font-size: 18px;font-weight: bold;color: #333;display: flex;align-items: center;margin-bottom: 10px;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;}
                        .card1_style .feature-title i {font-size: 22px;margin-right: 8px;color: #009688;}
                        .card1_style .feature-desc {font-size: 14px;color: #666;line-height: 1.6;margin-bottom: 15px;min-height:40px;max-height:110px;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 5;}
                        .card1_style .feature-img {width: 100%;border-radius: 4px;overflow: hidden;}
                        .card1_style .feature-img img {width: 100%;height: 150px;display: block;}
                    
                        @media (max-width: 992px){
                            .card1_style .feature-item{width:100%;max-width:100%;}
                            .card1_style .feature-container{padding-bottom:100px;}
                        }
                        /*卡片样式一====end*/
                    
                        /*卡片样式二====start*/
                        .card2_body .container{padding:30px;}
                        .card2_style .feature-grid {display: grid;grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));grid-gap: 20px;max-width: 1200px;margin: 0 auto;}
                        /* 每个功能项样式 */
                        .card2_style .feature-item {display: flex;flex-direction: column;align-items: center;justify-content: center;text-align: center;padding: 40px 20px;border: 1px solid #ddd;border-radius: 8px;transition: all 0.3s ease;box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.4);}
                        .card2_style .feature-item:hover {border:1px solid {{$website['color']}};transform: translateY(-2px);}
                        /* 图标样式（使用 Font Awesome 示例，可替换为自定义图标） */
                        .card2_style .feature-item i {font-size: 24px;color: {{$website['color']}}; /* 红色图标 */margin-bottom: 10px;}
                        /* 文字样式 */
                        .card2_style .feature-item span {font-size: 14px;color: #1f2d3d;}
                        @media (max-width: 992px){
                            .card2_body .container{max-width:400px;padding:30px;}
                            .card2_style .feature-grid{padding:15px 20px;box-sizing: border-box;}
                            .cross-border .section-title{margin-bottom:0 !important;}
                            .card2_style{padding-bottom:100px;}
                        }
                        /*卡片样式二====end*/
                    
                        /*卡片样式三====start*/
                        /* 容器样式，实现卡片布局 */
                        .card3_style{margin-top:5%;}
                        .card3_style .containers {display: grid;grid-template-columns: repeat(2, 1fr);/*flex-wrap: wrap;*/justify-content: space-around;gap: 30px;}
                        /* 卡片通用样式 */
                        .card3_style .card {width: 100%;min-width: 280px;background-color: #fff;border-radius: 15px;box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.4);padding: 0px;display: flex;flex-direction: column;justify-content: space-between;transition: all 0.3s ease;}
                        .card3_style .card_disf{}
                        .card3_style .card_disf .desc_area{margin-left:15px;width: 68%;padding:20px 15px 20px 0;}
                        /* 卡片图标样式 */
                        .card3_style .card-icon {width: 40%;height:100%;background:{{$website['color']}};color: {{$website['color_word']}};display: flex;justify-content: center;align-items: center;font-weight: bold;margin-bottom: 0px;padding:20px 15px 20px 20px;border-top-left-radius: 15px;border-bottom-left-radius: 15px;}
                        .card3_style .card-icon img{width:100%;height:100%;border-radius: 15px;/*box-shadow: 0px 0px 15px 0px {{$website['color_word']}};border:0px solid {{$website['color_word']}};*/filter: drop-shadow(0 8px 12px rgba(0, 0, 0, 0.2));transition: transform 0.4s ease, filter 0.3s ease;}
                        /*.card3_style .card-icon img:hover{transform: scale(1.1); transition: all 0.3s ease;}*/
                        .card3_style .card:hover .card-icon img {transform: scale(1.05) rotate(2deg);filter: drop-shadow(0 12px 18px rgba(0, 0, 0, 0.3));}
                        .card3_style .api-icon {background-color: ;}
                        .card3_style .h5-icon {background-color: #667aff;}
                        .card3_style .sdk-icon {background-color: #409eff;}
                        .card3_style .platform-icon {background-color: #48b685;}
                        /* 卡片标题样式 */
                        .card3_style .card-title {color: {{$website['color']}};margin-bottom: 8px;font-weight:600;}
                        /* 卡片描述样式 */
                        .card3_style .card-desc {color: #555;line-height: 1.5;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 6;line-clamp: 6;-webkit-box-orient: vertical;overflow: hidden;}
                        /*卡片样式三====end*/
                    
                        /*标题+图片（一排四个）卡片样式====start*/
                        .storeDiv{width: 100%;margin: 50px 0px 0px;padding: 10px 10px;position: relative;/*border:2px solid {{$website['color']}};*/box-sizing: border-box;border-radius: 5px;border-top-left-radius: 0;}
                        .storeDiv .storeTitle{position: absolute;top:-34px;left:-2px;background:{{$website['color']}};color:{{$website['color_word']}};padding:5px 10px;border:2px solid {{$website['color']}};z-index: 9;border-bottom: 0;border-radius: 5px;border-bottom-right-radius: 0;border-bottom-left-radius: 0;font-weight: 800;}
                        .storeDiv .column4_list{width:100%;}
                        .storeDiv .hsBox{border: 3px solid #777;border-radius: 0px;width: 100%;box-shadow: 0px 0px 8px 0px rgba(0,0,0,0.4);}
                        .storeDiv .hsBox .hsDiv{width:100%;/*height: 500px;*/height: 255px;position: relative;overflow:hidden;}
                        .storeDiv .hsBox .hsDiv .guide2_goods_img{width: 100%;max-width: 100%;height: -webkit-fill-available;transition: filter .6s, opacity .6s, transform .6s, box-shadow .3s;}
                        .storeDiv .hsBox .hsDiv .guide2_goods_img:hover{transform: scale(1.2);}
                        .storeDiv .hsBox .hsDiv .hsMask{width: 100%;height: 25%;position: absolute;top: 0;background: #444;opacity: 0.4;z-index: 8;border-radius: 6px;border-top-left-radius: 0;border-top-right-radius: 0;}
                        .storeDiv .hsBox .hsDiv .hsContent{opacity: 1;color: #fff;z-index: 10;position: absolute;width: 100%;height:100%;top: 0%;padding:20px 30px 80px 30px;box-sizing:border-box;}
                        .storeDiv .hsBox .hsDiv .hsContent .title{font-size:17px;font-weight: 800;display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 1;overflow: hidden;text-overflow: ellipsis;margin-bottom:10px;min-height:28px;max-height:28px;}
                        .storeDiv .hsBox .hsDiv .hsContent hr{ border-bottom: 1px solid {{$website['color_word']}};width: 75px;margin: 0 0 10px;}
                        .storeDiv .hsBox .hsDiv .hsContent .moreBtn{justify-content: right;}
                        .storeDiv .hsBox .hsDiv .hsContent .moreBtn .storeName{background:{{$website['color']}};padding: 2px 10px;border-radius: 15px;border: 2px solid #fff;color:{{$website['color_word']}};margin-right:10px;max-width:100px;text-overflow: ellipsis;overflow:hidden;white-space: nowrap;font-weight: 800;}
                        .storeDiv .hsBox .hsDiv .hsContent .moreBtn .priceDiv{background:{{$website['color']}};padding: 2px 10px;border-radius: 15px;border: 2px solid #fff;margin-right:10px;}
                        .storeDiv .hsBox .hsDiv .hsContent .moreBtn .priceDiv .currency{color:{{$website['color_word']}};font-size:15px;font-weight: 800;margin-right:5px;}
                        .storeDiv .hsBox .hsDiv .hsContent .moreBtn .priceDiv .price{color:{{$website['color_word']}};font-size:15px;font-weight: 800;}
                        .storeDiv .about-desc {font-size: 14px;margin-top: 0px;line-height: 2;padding: 10px 40px;box-sizing: border-box;background: {{$website['color']}};color: {{$website['color_word']}};border-radius: 0px;opacity: 0.8;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 5;-webkit-box-orient: vertical;min-height:104px;}
                        .storeDiv .view_detail {display: inline-block;padding: 10px 25px;background: rgba(255,255,255,0.2);backdrop-filter: blur(2px);border: 1px solid rgba(255,255,255,0.4);border-radius: 40px;color: #000;font-weight: 500;text-decoration: none;transition: all 0.3s ease;margin-top: 10px;font-size: 0.95rem;letter-spacing: 0.5px;}
                        .storeDiv .view_detail:hover {background: {{$website['color']}};border-color: {{$website['color']}};color:{{$website['color_word']}};}
                    
                        @media (max-width: 992px){
                            .store_body .container{max-width:400px;}
                            .storeDiv .hsBox .hsDiv{height: /*330*/ 180px;}
                            .storeDiv .hsBox .hsDiv .hsContent .moreBtn .priceDiv .currency{font-size:12px;}
                            .storeDiv .hsBox .hsDiv .hsContent .moreBtn .priceDiv .price{font-size:12px;}
                            .storeDiv .hsBox .hsDiv .hsContent .moreBtn .priceDiv{padding:3px 5px;display:none;}
                            .storeDiv .hsBox .hsDiv .hsContent .moreBtn .detailDiv a{font-size:12px;}
                            .storeDiv .hsBox .hsDiv .hsContent .title{-webkit-line-clamp:1;margin-bottom:/*10*/ 6px;min-height: 25px;max-height: 25px;font-size:16px;}
                        }
                        /*标题+图片（一排四个）卡片样式====end*/
                    
                        /*标题+图片（一排三个）卡片样式====start*/
                        .cardDiv {width: 100%;margin: 50px 0px 0px;position: relative;/*padding: 10px 10px;border: 2px solid {$website['color']};*/box-sizing: border-box;border-radius: 5px;border-top-left-radius: 0;}
                        .cardDiv .storeTitle {position: absolute;top: -36px;left: -2px;background: {{$website['color']}};color: {{$website['color_word']}};padding: 5px 10px;border: 2px solid {{$website['color']}};z-index: 9;border-bottom: 0;border-radius: 5px;border-bottom-right-radius: 0;border-bottom-left-radius: 0;font-weight: 800;}
                        .cardDiv .swiper-container{overflow: hidden;position: relative;padding: 10px 20px;box-sizing: border-box;}
                        .cardDiv .swiper-container .swiper-slide{height:100%;margin-right: 60px;}
                        .cardDiv .cross-section{background-position: center;background-size: cover;position: relative;transform-style: preserve-3d;box-shadow: 0px 0px 10px rgba(0,0,0,0.4);border-radius: 0px;overflow:hidden;height:100% !important;}
                        .cardDiv .cross-section .in_mask {background-color: #444;opacity: 0.4;position: absolute;left: 0;top: 0;height: 25%;width: 100%;z-index: 1;}
                        .cardDiv .cross-section .cross-content hr {border-bottom: 1px solid {{$website['color_word']}};width: 75px;margin: 0 0 10px;}
                        .cardDiv .cross-section .cross-content {padding: 20px 30px 80px 30px;z-index: 2;position: relative;font-size: 15px;height: 100%;min-height: 375px;max-height: 375px;border:3px solid #777;}
                        .cardDiv .cross-section .cross-content h3 {color:{{$website['color_word']}};margin-bottom: 10px;padding-bottom: 0;text-overflow: ellipsis;overflow: hidden;white-space: nowrap;font-weight:1000;}
                        .cardDiv .cross-section .cross-content .withArrow {margin-bottom: 30px;max-height: 160px;overflow-y: auto;}
                        .cardDiv .cross-section .cross-content .withArrow li{white-space: nowrap;overflow: hidden;text-overflow: ellipsis;}
                        .cardDiv .about-text li {margin-bottom: 10px;list-style: none;}
                        .cardDiv .cross-section .cross-content .withArrow a {font-weight: unset;color: {{$website['color_word']}};}
                        .cardDiv .fa {display: inline-block;font-family: FontAwesome;font-style: normal;font-weight: normal;line-height: 1;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;box-shadow: 1px 1px 10px #eee;border: 1px solid {{$website['color_word']}};border-radius: 50%;padding: 2px 5px;}
                        .cardDiv .about-desc{font-size:18px;margin-top:0px;line-height: 1.9;background:;padding:10px 40px;box-sizing: border-box;background: {{$website['color']}};color: {{$website['color_word']}};border-radius: 0px;opacity:0.8;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 5;-webkit-box-orient: vertical;min-height:122px;}
                    
                        .cardDiv .view_detail {display: inline-block;padding: 10px 25px;background: rgba(255,255,255,0.2);backdrop-filter: blur(2px);border: 1px solid rgba(255,255,255,0.4);border-radius: 40px;color: #fff;font-weight: 500;text-decoration: none;transition: all 0.3s ease;margin-top: 10px;font-size: 0.95rem;letter-spacing: 0.5px;color:#000;}
                        .cardDiv .view_detail:hover {background: {{$website['color']}};border-color: {{$website['color_word']}};color:{{$website['color_word']}};}
                        @media (max-width: 992px){
                            .cardDiv{margin: 10px 0px 0px;}
                        }
                        /*标题+图片（一排三个）卡片样式====end*/
                    
                        /*标题+图片（两排六个）卡片样式====start*/
                        .festivalDiv {width: 100%;position: relative;/*padding: 20px;margin: 50px 0px 0px;border: 2px solid {$website['color']};*/box-sizing: border-box;border-radius: 5px;border-top-left-radius: 0;}
                        .festival_body .section-title{margin-bottom: 20px;}
                        .festivalDiv .storeTitle {position: absolute;top: -36px;left: -2px;background: {{$website['color']}};color: {{$website['color_word']}};padding: 5px 10px;border: 2px solid {{$website['color']}};z-index: 9;border-bottom: 0;border-radius: 5px;border-bottom-right-radius: 0;border-bottom-left-radius: 0;font-weight: 800;}
                        .festivalDiv .hsColumn {display: grid;grid-template-columns: repeat(3, 1fr);-moz-column-gap: 20px;column-gap: 20px;row-gap: 20px;margin-bottom: 20px;}
                        .festivalDiv .hsColumn:nth-of-type(2){margin-bottom: 0;}
                        .festivalDiv .hsDiv {height: 220px;position: relative;box-shadow: 0px 0px 8px 0px rgba(0,0,0,0.4);}
                        .festivalDiv .hs2 {border: 3px solid #777;border-radius: 0px;width: 100%;}
                        .festivalDiv .hsDiv .guide2_country_img {width: 100%;max-width: 100%;height: -webkit-fill-available;}
                        .festivalDiv .hsMask {width: 100%;height: 35%;position: absolute;top: 0;background: #444;opacity: 0.4;z-index: 8;border-radius: 6px;}
                        .festivalDiv .hsDiv .hsContent hr{ border-bottom: 1px solid {{$website['color_word']}};width: 75px;margin: 0 0 10px;}
                        .festivalDiv .hsDiv .hsContent {opacity: 1;color: #fff;z-index: 10;position: absolute;width: 100%;height: 100%;top: 0%;padding: 20px 30px 80px 30px;box-sizing: border-box;}
                        .festivalDiv .hsDiv .hsContent .title {font-size: 17px;font-weight: 800;padding: 0;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;margin-bottom:10px;}
                        .festivalDiv .hsDiv .hsContent .moreBtn {width: 100%;text-align: center;/*position: absolute;right: -30%;bottom: -1%;*/}
                        .festivalDiv .about-desc{font-size:15px;margin-top:0px;line-height: 2;padding:10px 40px;box-sizing: border-box;background: {{$website['color']}};color: {{$website['color_word']}};border-radius: 0px;opacity:0.8;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 3;-webkit-box-orient: vertical;min-height:110px;}
                        .festivalDiv .view_detail {display: inline-block;padding: 10px 25px;background: rgba(255,255,255,0.2);backdrop-filter: blur(2px);border: 1px solid rgba(255,255,255,0.4);border-radius: 40px;color: #fff;font-weight: 500;text-decoration: none;transition: all 0.3s ease;margin-top: 10px;font-size: 15px;letter-spacing: 0.5px;}
                        .festivalDiv .view_detail:hover {background: {{$website['color']}};border-color: {{$website['color_word']}};color:{{$website['color_word']}};}
                        @media (max-width: 992px){
                            .festival_body .container{max-width:400px;}
                            .festivalDiv{margin-top:20px;}
                            .festivalDiv .hsColumn {grid-template-columns: repeat(1, 1fr);margin-bottom:0;}
                            .festivalDiv .hs2{height:320px;}
                            .festivalDiv .hsMask{height:25%;}
                        }
                        /*标题+图片（两排六个）卡片样式====end*/
                    
                        /*杂志导航样式====start*/
                        .industryDiv {width: 100%;/*margin: 50px 0px 0px;padding: 20px;border: 2px solid {{$website['color']}};*/position: relative;box-sizing: border-box;border-radius: 5px;border-top-left-radius: 0;}
                        .industryDiv .storeTitle {position: absolute;top: -36px;left: -2px;background: {{$website['color']}};color: {{$website['color_word']}};padding: 5px 10px;border: 2px solid {{$website['color']}};z-index: 9;border-bottom: 0;border-radius: 5px;border-bottom-right-radius: 0;border-bottom-left-radius: 0;font-weight: 800;}
                        .industryDiv .serviceBox{width: 100%;margin-top:0px;display: grid;grid-template-columns: repeat(3,1fr);-moz-column-gap: 20px;column-gap: 20px;row-gap: 20px;align-items: flex-start;}
                        .industryDiv .serviceBox .leftBox{width: 370px;height:568px;border:2px solid {{$website['color']}};border-radius: 8px;box-shadow: 0px 0px 8px 0px rgba(0,0,0,0.4);margin-right:0px;}
                        .industryDiv .serviceBox .leftBox:hover{border-color:{{$website['color']}};}
                        .industryDiv .serviceBox .leftBox .cont6{position: relative;width: 100%;height:100%;overflow: hidden;}
                        .industryDiv .serviceBox .leftBox .cont6 .serviceContent{background-size: 100%;background-repeat:no-repeat;width: -webkit-fill-available;height:100%;position: relative;cursor: pointer;border-radius: 6px;}
                        .industryDiv .serviceBox .leftBox .cont6 .searviceMask{position: absolute;bottom:0;left:0;background:#000;z-index: 10;opacity: 0.7;width: 100%;height:100%;border-radius: 6px;display: none;}
                        .industryDiv .serviceBox .leftBox .cont6 .serviceContent .serviceDiv{z-index: 12;position: absolute;bottom:-40px;left:50%;transform:translate(-15%,-100%);width: 100%;margin:0 auto;}
                        .industryDiv .serviceBox .leftBox .cont6 .serviceContent .serviceDiv .serviceTitle{font-size:25px;font-weight: 800;color:{{$website['color']}};}
                        .industryDiv .serviceBox .leftBox .cont6 .serviceContent .serviceDiv .serviceDesc{font-size:15px;font-weight: 800;display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 7;overflow: hidden;text-overflow: ellipsis;width: 100%;margin-top:15px;color:{{$website['color']}};}
                        .industryDiv .serviceBox .leftBox .cont6 .serviceContent .serviceDiv .serviceIn{font-weight:800;margin-top:15px;width: fit-content;color: {{$website['color_word']}};font-size: 15px;background: {{$website['color']}};padding: 4px 15px;border-radius: 15px;border: 2px solid {{$website['color_word']}};}
                        .industryDiv .serviceBox .leftBox .cont6 .serviceContent .serviceDiv .serviceIn:hover{color:{{$website['color_word']}};border-color:{{$website['color']}};}
                        .industryDiv .serviceBox .leftBox .cont6 .serviceContent .serviceDiv .mob_cont6{display:none;}
                        .industryDiv .serviceBox .rightBox{width:100%;height:100%;grid-column-start: 2;grid-column-end: 4;}
                        .industryDiv .serviceBox .rightBox .serviceContent{width:100%;height:100%;}
                        .industryDiv .serviceBox .rightBox .serviceContent .swiper-container{display: none;}
                        .industryDiv .serviceBox .rightBox .serviceContent .swiper-slide{display: grid;grid-template-columns: repeat(2,1fr);-moz-column-gap: 20px;column-gap: 20px;row-gap: 20px;padding:0px;}
                        .industryDiv .serviceBox .rightBox .serviceContent .serviceDiv{width:-webkit-fill-available;height:274px;border:2px solid {{$website['color_word']}};border-radius: 8px;box-shadow: 0px 0px 8px 0px rgba(0,0,0,0.4);padding:22px 22px 22px 32px;background: #d1d0d0;position:relative;}
                        .industryDiv .serviceBox .rightBox .serviceContent .serviceDiv .serviceImg{margin-right:20px;width: 50%;height: 190px;border-radius: 8px;box-shadow: 0px 0px 8px 0px #797977;text-align: center;}
                        .industryDiv .serviceBox .rightBox .serviceContent .serviceDiv .serviceImg img{width:150px;height:150px;border-radius: 8px;border: 2px solid {{$website['color_word']}};box-shadow: 0px 0px 8px 0px #797977;}
                        .industryDiv .serviceBox .rightBox .serviceContent .serviceDiv .serviceTitleTop{font-size:25px;font-weight: 800;color:{{$website['color_word']}};margin-bottom:0px;text-align: center;margin-top:50%;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;width: 150px;padding: 0 5px;box-sizing: border-box;}
                        .industryDiv .serviceBox .rightBox .serviceContent .serviceDiv .serviceTitle{font-size:25px;font-weight: 800;color:{{$website['color_word']}};margin-bottom:0px;text-align: center;margin-top:5px;}
                        .industryDiv .serviceBox .rightBox .serviceContent .serviceDiv .serviceTxt{width:50%;}
                        .industryDiv .serviceBox .rightBox .serviceContent .serviceDiv .serviceTxt .serviceDesc{font-size:15px;font-weight: 800;display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 8;overflow: hidden;text-overflow: ellipsis;width: 100%;margin-top:0px;color:{{$website['color_word']}};}
                        .industryDiv .serviceBox .rightBox .serviceContent .serviceDiv:hover{border-color:{{$website['color']}};color:{{$website['color_word']}};}
                        .industryDiv .serviceBox .rightBox .serviceContent .serviceDiv:hover .serviceTitle{color:{{$website['color_word']}};}
                        .industryDiv .serviceBox .rightBox .serviceContent .serviceDiv:hover .serviceDesc{color:{{$website['color_word']}};}
                        .industryDiv .serviceBox .rightBox .serviceContent .serviceDiv .serviceTxt .moreBtn{width: 100%;text-align: right;position:absolute;bottom: 10px;right: 5px;}
                        .industryDiv .serviceBox .rightBox .serviceContent .serviceDiv .serviceTxt .moreBtn a:hover{border-color:{{$website['color']}};}
                        .industryDiv .serviceBox .rightBox .serviceContent .serviceDiv .serviceTxt .moreBtn a{color:#000;font-size: 15px;background: #fff;padding: 4px 15px;border-radius: 15px;border: 2px solid #000;}
                        .industryDiv .serviceContent .guide_smlcontent{bottom: var(--swiper-pagination-bottom, 13%);left: var(--swiper-pagination-left, 50%);transform: translate(-38%, 0%);}
                    
                        @media (max-width: 992px){
                            .industryDiv{margin-top:20px;}
                            .industry_body .container{width:400px;}
                            .industryDiv .serviceBox{display:block;}
                            .industryDiv .serviceBox .rightBox{display:none;}
                            .industryDiv .serviceBox .leftBox{width:100%;height:320px;min-height:320px;margin-bottom:0;}
                            .industryDiv .serviceBox .leftBox .cont6 .serviceContent{background-size:cover !important;}
                            .industryDiv .serviceBox .leftBox .cont6 .searviceMask{display:block;height:30%;}
                            .industryDiv .serviceBox .leftBox .cont6 .serviceContent .serviceDiv{bottom:1%;left:0;transform:unset;width:100%;}
                            .industryDiv .serviceBox .leftBox .cont6 .serviceContent .serviceDiv .serviceIn{margin:0 auto;padding:2px 15px;margin-bottom:10px;}
                            .industryDiv .serviceBox .leftBox .cont6 .serviceContent .serviceDiv .mob_cont6{display:block;}
                    
                            .industryDiv .serviceBox .leftBox .cont6 .serviceContent .serviceDiv .mob_cont6 .c6Title{display: inline-block;padding: 0 3px;box-sizing: border-box;max-width:100px;overflow:hidden;text-overflow:ellipsis;white-space: nowrap;}
                            .industryDiv .serviceBox .leftBox .cont6 .serviceContent .serviceDiv .mob_cont6 .c6Title a{color:{{$website['color']}};}
                        }
                        /*杂志导航样式====end*/
                    
                        /**新闻====start**/
                        .cross-news .news_container{width:100%;overflow:hidden;height:50px;}
                        .cross-news a{color: {{$website['color_word']}};text-decoration: none;display: block;font-size:15px;overflow: hidden;height:50px;line-height:50px;font-weight:600;}
                        .cross-news a:hover{color:{{$website['color_word']}};}
                        .swiper-button-disabled{display:none;}
                        /**新闻====end**/
                    
                        @media (max-width: 992px) {
                            .swiper-button-disabled{display:flex;}
                            .cross-news .disf{border: 1px solid {{$website['color_word']}};}
                            /*轮播图*/
                            #banner{margin-top:80px;}
                            #carousel-container{margin-top:0 !important;}
                            .cross-border .card3_style{overflow-y:auto;max-height:500px;}
                    
                            /*发现 + 切换框 开始*/
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
                    
                            /*热卖滚动内容*/
                            .contentBox{width: 100%;}
                            .contentSized .navSized{width: 100%;}
                            .contentSized .rightNav{width: 0%;}
                            .nav_item{white-space: nowrap;}
                            .column4_list{display: block;}
                            .column_item .content_card img{object-fit: cover;}
                            .discoveryDiv img{background-position: center;background-repeat: no-repeat;background-size: cover;height: 100%;margin: -1px 0px 0px -1px;object-fit: cover;}
                            .column_item{margin-bottom: 0px;}
                            /*发现 + 切换框 结束*/
                    
                            /**业务轮播框 start**/
                            .cross-border .big_swiper{padding:0px 15px 10px !important;box-shadow:unset;}
                            /**业务轮播框 end**/
                    
                            /**业务切换框样式 start**/
                            .change_boxClick .container{width:100%;margin:15px auto;}
                            .change_boxClick .tab-header{max-width: 90%;margin-top:10px;}
                            .change_boxClick .tab-item{padding:5px 10px;}
                            .change_boxClick .content-left,.change_boxClick .content-right{margin-right:0 !important;margin-bottom:20px !important;}
                            .change_boxClick .container .content-right:nth-child(even){margin-bottom:0 !important;}
                            .change_boxClick .container .content-left:nth-child(even){margin-bottom:0 !important;}
                            .change_boxClick .content-left .content-scroll{height:200px;min-height:200px;}
                            .change_boxClick .content-left .content-btm{height:fit-content;min-height: fit-content;margin-top:10px;}
                            .change_boxClick .content-left .content-btm .view_detailBtn{padding:4px 8px;box-sizing: border-box;}
                            .change_boxClick .content-right{margin-bottom:0;}
                            .change_boxClick .row{margin-bottom:calc( 10% - 20px) !important;}
                            .change_boxClick .row, .change_boxClick .row-fluid{margin:0;width: 100%;}
                            .change_boxClick .content-right img{height:190px;}
                            /**业务切换框样式 end**/
                    
                            /**常见问题样式二 start**/
                            .fold_boxClick .fq_list .swiper-slide{height:40px !important;box-sizing: border-box;margin:0;}
                            /**常见问题样式二 end**/
                    
                            /*卡片样式一 start*/
                            .card1_style{max-height:600px;overflow-y: auto;margin-top:0;}
                            /*卡片样式一 end*/
                    
                            /*卡片样式二 start*/
                            .card2_style{padding-top:2px;max-height:600px;overflow-y: auto;}
                            /*卡片样式二 end*/
                    
                            /*卡片样式三 start*/
                            .card3_style{margin-top:0%;}
                            .card3_style .card-icon{padding:10px 10px 10px 10px;}
                            .card3_style .card{padding:0px;box-sizing: border-box;}
                            .card3_style .containers{padding:10px 10px;box-sizing: border-box;grid-template-columns:repeat(1, 1fr);gap:15px;}
                            .card3_style .card-desc{-webkit-line-clamp: 3;}
                            .card3_style .card_disf .desc_area{width:61%;}
                            /*卡片样式三 end*/
                    
                            /**业务折叠框 start**/
                            .fold_boxClick .container{width:100%;}
                            .fold_boxClick .row{margin-bottom:calc( 10% - 20px) !important;}
                            .fold_boxClick .row, .fold_boxClick .row-fluid{margin:0;width: 100%;}
                            .fold_boxClick .fold_body2{height:410px;min-height: 410px;max-height:410px;}
                            .fold_boxClick .fq_list .num{margin-right: 0;}
                            .fold_boxClick .fq_list .slide-text{width:90%;margin-left:8px;}
                            .fold_boxClick .fq_list .slide-line{width:100%;}
                            .fold_boxClick .fq_list .slide-text .title{width:65%;min-width:65%;max-width:65%;overflow:hidden;text-overflow:ellipsis;white-space: nowrap;}
                            .fold_boxClick .fq_list .slide-text .date{text-align:;}
                            .fold_boxClick .fq_list .slide-text{justify-content: space-between;}
                            /**业务折叠框 end**/
                        }
                    
                        .view_detail{background:rgba(255,255,255,0.8);color:{{$website['color']}};position: absolute;bottom: 0px;left: 50%;transform: translate(-50%,-50%);padding: 2px 10px;border-radius: 15px;font-weight:600;border:1px solid {{$website['color_word']}};}
                        .view_detail:hover{color:{{$website['color']}};}
                        /*.ass{display:none !important;}*/
                    </style>
                    <!--板块流开始-->
                    @foreach($services as $k=>$vo)
                        
                        @if($vo['navbar_id']=='A1')
                            <!--小轮播和切换框 开始-->
                            <section class=" ass" style="width:100%;background:@if($vo['bg_type']==1) {{$vo['bg_color']}} @elseif($vo['bg_type']==2) url(https://shop.gogo198.cn/{{$vo['bg_img']}}) @endif;">
                                <div class="container website_component rc_container">
                                    <div class="content">
                                        
                                        <!-- 左侧轮播图区域 -->
                                        <div class="left-section">
                                            <div class="swiper-container" id="discovery-container">
                                                <div class="swiper-wrapper">
                                                    @foreach($discovery_rotate as $k=>$vo)
                                                        <div class="swiper-slide" style="background-image: url('https://shop.gogo198.cn/{{$vo['thumb']}}');" onclick="javascript:window.location.href='@if($vo['go_other']==1) {{$vo['other_link']}} @elseif($vo['go_other']==3) /txt_detail?id={{$vo['other_pic']}}&type=1&oid={{$vo['id']}} @elseif($vo['go_other']==4) /msg_detail?id={{$vo['other_msg']}}&type=1&oid={{$vo['id']}} @elseif($vo['go_other']==5) / @endif';">
                                                            <div class="slide-overlay">
                                                                <h3 class="slide-title f18">{{$vo['descs']}}</h3>
                                                                <p class="slide-desc f18"></p>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="swiper-pagination discovery-pagination"></div>
                                            </div>
                                        </div>
                                        
                                        <!-- 右侧内容区域 -->
                                        <div class="right-section">
                                            <div class="tab-container">
                                                <div class="tab active f18" data-tab="news">新闻资讯</div>
                                                <div class="tab f18" data-tab="service">客服中心</div>
                                            </div>
                    
                                            <div class="news-container">
                                                <div class="news-header f16">今日要闻</div>
                                                <div class="news-content">
                                                    <div class="news-vertical-slider">
                                                        @foreach($news as $k2=>$vo2)
                                                            <div class="news-slide" onclick="javascript:window.location.href='/news_detail?id={{$vo2['id']}}';">
                                                                <div class="news-title f15">{{$vo2['title']}}</div>
                                                                <div>
                                                                    <!--<span class="news-source">行业动态</span>-->
                                                                    <!--<span class="news-time">10:45 更新</span>-->
                                                                </div>
                                                                <p class="news-desc f13">{{$vo2['descs']}}</p>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                    
                                            <div class="customer-service">
                                                <div class="service-header f16 disf" style="justify-content: space-between;">
                                                    <div>客服中心</div>
                                                    <div><a href="https://boss.gogo198.cn/?s=customer/customer_online&pa=2&who_send=2&id=0&pid=0&isframe=1&uid=<?php echo session('user.gogo_id');?>" target="_blank"><img src="./img/expand.png" alt="" style="width:20px;"></a></div>
                                                </div>
                                                <div class="service-content">
                                                    <iframe src="https://boss.gogo198.cn/?s=customer/customer_online&pa=2&who_send=2&id=0&pid=0&isframe=1&uid=<?php echo session('user.gogo_id');?>" frameborder="0" style="width:100%;height:100%;"></iframe>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </section>
                            <!--小轮播和切换框 结束-->
                            
                        @elseif($vo['navbar_id']=='A2')
                            <!--常见问题-->
                            <section class="cross-border ass fold_boxClick" style="background:@if($vo['bg_type']==1) {{$vo['bg_color']}} @elseif($vo['bg_type']==2) url(https://shop.gogo198.cn/{{$vo['bg_img']}}) @endif;">
                                <div class="container">
                                    <div class="row" style="margin-bottom:calc( 3% - 10px);">
                                        <div class="col-md-12">
                                            <div class="section-title text-center">
                                                <a href="javascript:;" class="f15"><h2 class="f26">{{$vo['info']['name']}}</h2></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        @if($vo['format_type']==5)
                                        <!--标题进入图文-->
                                        <div class="fq_container">
                                            <div class="categories">
                                                @foreach($vo['fq_category_content'] as $key2=>$vo2)
                                                <div class="category @if($key2==1) active @endif" data-category="qa{{$key2}}">{{$vo2['fq_ctitle']}}</div>
                                                @endforeach
                                            </div>
                    
                                            <div class="faq-container">
                                                @foreach($vo['fq_category_content'] as $key2=>$vo2)
                                                <div class="swiper qa{{$key2}}_swiper qa_swiper" @if($key2 != 1) style="display:none" @endif>
                                                    <div class="swiper-wrapper">
                                                        @foreach($vo2['fq_list'] as $key3=>$vo3)
                                                        <div class="swiper-slide">
                                                            <div class="news-item" onclick="javascript:window.location.href='/txt_detail?id={{$vo3['id']}}&type=image_txt&oid={{$vo3['id']}}';">
                                                                <div class="news-content">
                                                                    <div class="news-title">{{$vo3['name']}}</div>
                                                                </div>
                                                                <div class="news-date">{{$vo3['createtime']}}</div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="swiper-pagination qa_page{{$key2}}" style="display:none;"></div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </section>
                        @else
                            @if($vo['format_type']==2)
                                <!--切换框-->
                                <section class="cross-border ass change_boxClick" style="background:@if($vo['bg_type']==1) {{$vo['bg_color']}} @elseif($vo['bg_type']==2) url(https://shop.gogo198.cn/{{$vo['bg_img']}}) @endif;">
                                    <div class="container">
                                        <div class="row" style="margin-bottom:0;">
                                            <div class="col-md-12">
                                                <div class="section-title text-center">
                                                    <a href="/detail?id={{$vo['info']['id']}}" target="_blank" class="f15"><h2 class="f26">{{$vo['info']['name']}}</h2></a>
                                                    <p style="margin-bottom:10px;" class="f15">{{$vo['info']['desc']}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="width:100%;">
                                            <div class="change_body">
                                                <!-- 头部切换区域 -->
                                                <div class="tab-header">
                                                    <div class="arrow left" id="prevArrow">&lt;</div>
                                                    <div class="tab-nav" id="tabNav">
                                                        @foreach($vo['info']['children'] as $k2=>$vo2)
                                                        <div class="tab-item @if($k2==1) active @endif f18" data-target="service{{$vo2['id']}}">{{$vo2['name']}}</div>
                                                        @endforeach
                                                    </div>
                                                    <div class="arrow right" id="nextArrow">&gt;</div>
                                                </div>
                                                <!-- 内容区域 -->
                                                <div class="container">
                                                    @foreach($vo['info']['children'] as $k2=>$vo2)
                                                        @if($k2%2==0)
                                                            <div class="content-right" id="contentServiceImg{{$vo2['id']}}" style="display:@if($k2==1) block @else none @endif;margin-right:20px;">
                                                                <img src="https://shop.gogo198.cn/{{$vo2['thumb']}}" alt="{{$vo2['name']}}">
                                                            </div>
                            
                                                            <div class="content-left" id="contentService{{$vo2['id']}}" style="display:@if($k2==1) block @else none @endif;margin-right:0;">
                                                                <div class="content-scroll">
                                                                    @foreach($vo['content'] as $k3=>$vo3)
                                                                        @if($vo3['fnavbar'] == $vo2['id'])
                                                                            <div class="content-item">
                                                                                <i class="{{$vo3['ficon']}} icon" style="color:{{$website['color']}}"></i>
                                                                                <span class="title f18">{{$vo3['ftitle']}}</span>
                                                                                <p class="desc f15">{{$vo3['fdesc']}}</p>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                            
                                                                <div class="content-btm">
                                                                    @foreach($vo['btn_content'] as $k3=>$vo3)
                                                                        @if($vo3['btn_navbar']==$vo2['id'])
                                                                            <a href="{{$vo3['link']}}" target="_blank" class="f15 @if($k3%2==0) view_detailBtn2 @else view_detailBtn @endif">{{$vo3['btn_title']}}</a>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="content-left" id="contentService{{$vo2['id']}}" style="display:@if($k2==1) block @else none @endif;">
                                                                <div class="content-scroll">
                                                                    @foreach($vo['content'] as $k3=>$vo3)
                                                                        @if($vo3['fnavbar'] == $vo2['id'])
                                                                            <div class="content-item">
                                                                                <i class="{{$vo3['ficon']}} icon" style="color:{{$website['color_head']}}"></i>
                                                                                <span class="title f18">{{$vo3['ftitle']}}</span>
                                                                                <p class="desc f15">{{$vo3['fdesc']}}</p>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                            
                                                                <div class="content-btm">
                                                                    @foreach($vo['btn_content'] as $k3=>$vo3)
                                                                        @if($vo3['btn_navbar']==$vo2['id'])
                                                                            <a href="{{$vo3['link']}}" target="_blank" class="f15 @if($k3%2==0) view_detailBtn2 @else view_detailBtn @endif">{{$vo3['btn_title']}}</a>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            <div class="content-right" id="contentServiceImg{{$vo2['id']}}" style="display:@if($k2==1) block @else none @endif;">
                                                                <img src="https://shop.gogo198.cn/{{$vo2['thumb']}}" alt="{{$vo2['name']}}">
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            @elseif($vo['format_type']==1)
                                <!--大图轮播-->
                                <section class="cross-border bigPic" style="background:@if($vo['bg_type']==1) {{$vo['bg_color']}} @elseif($vo['bg_type']==2) url(https://shop.gogo198.cn/{{$vo['bg_img']}}) @endif;">
                                    <div class="container">
                                        <div class="row" style="margin-bottom:0;">
                                            <div class="col-md-12">
                                                <div class="section-title text-center">
                                                    <a href="/detail?id={{$vo['info']['id']}}" target="_blank" class="f15"><h2 class="f26">{{$vo['info']['name']}}</h2></a>
                                                    <p style="margin-bottom:10px;" class="f15">{{$vo['info']['desc']}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 0%;">
                                            <div class="swiper-container{{$vo['id']}} swiper-container-horizontal big_swiper" style="overflow:hidden;position:relative;padding:0px;box-sizing:border-box;border-radius:15px;">
                                                <div class="swiper-wrapper">
                                                    @foreach($vo['info']['children'] as $vo2)
                                                        <div class="swiper-slide" style="height:100%;">
                                                            <div class=" cross_border_content">
                                                                <div class="about-text">
                                                                    <div class="cross-section" style="background-image:url(https://shop.gogo198.cn/{{$vo2['thumb']}});position:relative;">
                                                                        <div class="in_mask"></div>
                                                                        <div class="cross-content">
                                                                            @if($vo2['go_other']==1)
                                                                                <a href="{{$vo2['other_link']}}" target="_blank" class="f15"><h3 class="f22">{{$vo2['name']}}</h3></a>
                                                                            @elseif($vo2['go_other']==2)
                                                                                <a href="/detail?id={{$vo2['other_navbar']}}" target="_blank" class="f15"><h3 class="f22">{{$vo2['name']}}</h3></a>
                                                                            @else
                                                                                <a href="/detail?id={{$vo2['id']}}" target="_blank" class="f15"><h3 class="f22">{{$vo2['name']}}</h3></a>
                                                                            @endif
                                                                            <hr/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <!--左右切换-->
                                                <!--<div class="swiper-button-next sn{{$k+1}}"></div>-->
                                                <!--<div class="swiper-button-prev sprv{{$k+1}}"></div>-->
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            @elseif($vo['format_type']==4)
                                <!--标题+描述折叠-->
                                <section class="cross-border ass fold_boxClick" style="background:@if($vo['bg_type']==1) {{$vo['bg_color']}} @elseif($vo['bg_type']==2) url(https://shop.gogo198.cn/{{$vo['bg_img']}}) @endif;">
                                    <div class="container">
                                        <div class="row" style="margin-bottom:calc( 3% - 10px);">
                                            <div class="col-md-12">
                                                <div class="section-title text-center">
                                                    <a href="javascript:;" class="f15"><h2 class="f26">{{$vo['info']['name']}}</h2></a>
                                                    <p style="margin-bottom:10px;" class="f15">{{$vo['info']['desc']}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="fold_body">
                                                @foreach($vo['fq_content'] as $k2=>$vo2)
                                                    <div class="faq-item">
                                                        <div class="faq-title">{{$vo2['fq_title']}}</div>
                                                        <div class="faq-content">
                                                            {{$vo2['fq_desc']}}
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            @elseif($vo['format_type']==6)
                                <!--标题+描述+图片（一行四个）卡片-->
                                <section class="cross-border ass" style="background:@if($vo['bg_type']==1) {{$vo['bg_color']}} @elseif($vo['bg_type']==2) url(https://shop.gogo198.cn/{{$vo['bg_img']}}) @endif;">
                                    <div class="container">
                                        <div class="row" style="margin-bottom:calc( 5% - 10px);">
                                            <div class="col-md-12">
                                                <div class="section-title text-center">
                                                    <a href="/detail?id={{$vo['info']['id']}}" target="_blank" class="f15"><h2 class="f26">{{$vo['info']['name']}}</h2></a>
                                                    <p style="margin-bottom:10px;" class="f15">{{$vo['info']['desc']}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="card1_style">
                                                <div class="feature-container">
                                                    @foreach($vo['card1_content'] as $vo2)
                                                        <div class="feature-item">
                                                            <div class="feature-title">
                                                                {{$vo2['card1_title']}}
                                                            </div>
                                                            <div class="feature-desc">{{$vo2['card1_desc']}}</div>
                                                            <div class="feature-img">
                                                                <img src="https://shop.gogo198.cn/{{$vo2['card1_img']}}" alt="{{$vo2['card1_title']}}">
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            @elseif($vo['format_type']==7)
                                <!--标题+图标（两行各五个）卡片-->
                                <section class="cross-border card2_body ass" style="background:@if($vo['bg_type']==1) {{$vo['bg_color']}} @elseif($vo['bg_type']==2) url(https://shop.gogo198.cn/{{$vo['bg_img']}}) @endif;">
                                    <div class="container">
                                        <div class="row" style="margin-bottom:calc( 5% - 10px);">
                                            <div class="col-md-12">
                                                <div class="section-title text-center">
                                                    <a href="/detail?id={{$vo['info']['id']}}" target="_blank" class="f15"><h2 class="f26">{{$vo['info']['name']}}</h2></a>
                                                    <p style="margin-bottom:10px;" class="f15">{{$vo['info']['desc']}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="card2_style">
                                                <div class="feature-grid">
                                                    @foreach($vo['card2_content'] as $vo2)
                                                        <div class="feature-item">
                                                            <i class="{{$vo2['card2_icon']}}"></i>
                                                            <span>{{$vo2['card2_title']}}</span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            @elseif($vo['format_type']==8)
                                <!--标题+描述+图片（两行各两个）卡片-->
                                <section class="cross-border ass" style="background:@if($vo['bg_type']==1) {{$vo['bg_color']}} @elseif($vo['bg_type']==2) url(https://shop.gogo198.cn/{{$vo['bg_img']}}) @endif;">
                                    <div class="container">
                                        <div class="row" style="margin-bottom:0;">
                                            <div class="col-md-12">
                                                <div class="section-title text-center">
                                                    <a href="/detail?id={{$vo['info']['id']}}" target="_blank" class="f15"><h2 class="f26">{{$vo['info']['name']}}</h2></a>
                                                    <p style="margin-bottom:10px;" class="f15">{{$vo['info']['desc']}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="card3_style">
                                                <div class="containers">
                                                    @foreach($vo['card3_content'] as $vo2)
                                                        <div class="card api-card">
                                                            <div class="disf card_disf">
                                                                <div class="card-icon api-icon"><img src="https://shop.gogo198.cn/{{$vo2['card3_img']}}" alt=""></div>
                                                                <div class="desc_area">
                                                                    <h3 class="card-title">{{$vo2['card3_title']}}</h3>
                                                                    <p class="card-desc" title="{{$vo2['card3_desc']}}">{{$vo2['card3_desc']}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            @elseif($vo['format_type']==9)
                                <!--标题+图片（一排四个）卡片样式-->
                                <section class="cross-border store_body ass" style="background:@if($vo['bg_type']==1) {{$vo['bg_color']}} @elseif($vo['bg_type']==2) url(https://shop.gogo198.cn/{{$vo['bg_img']}}) @endif;">
                                    <div class="container">
                                        <div class="row" style="margin-bottom:0;">
                                            <div class="col-md-12">
                                                <div class="section-title text-center">
                                                    <a href="/detail?id={{$vo['info']['id']}}" target="_blank" class="f15"><h2 class="f26">{{$vo['info']['name']}}</h2></a>
                                                    <p style="margin-bottom:10px;" class="f15">{{$vo['info']['desc']}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="storeDiv">
                                            <div class="storeTitle f15" style="display: none;">
                                                {{$vo['info']['name']}}
                                            </div>
                                            <div class="swiper-container{{$vo['id']}} storeSwiper factorySwiper{{$vo['id']}}" style="overflow-y:visible;padding:7px;box-sizing: border-box;overflow:hidden;">
                                                <div class="swiper-wrapper">
                                                    @foreach($vo['children'] as $k2=>$v2)
                                                        <div class="swiper-slide">
                                                            <div class="hsBox disf">
                                                                <div class="hs2 hsDiv" style="position:relative;">
                                                                    <!--当前节日，所有的国家循环-->
                                                                    <img loading="lazy" alt="GOGO198 網站圖片" src="{{$v2['back_content']}}" class="guide2_goods_img">
                                                                    <div class="hsMask"></div>
                                                                    <div class="hsContent">
                                                                        <div class="title" title="{{$v2['name']}}">{{$v2['name']}}</div>
                                                                        <hr/>
                                                                        <div class="moreBtn disf">
                                                                            @if($v2['go_other']==1 || $v2['go_other']==6 || $v2['go_other']==7)
                                                                                <!--分享&我要咨询&去找客服-->
                                                                                <div class="detailDiv">
                                                                                    <a class="view_detail f15" href="javascript:common_operation({{$v2['go_other']}},this);" target="_blank">查看详情&gt;</a>
                                                                                </div>
                                                                            @elseif($v2['go_other']==2)
                                                                                <!--商品详情-->
                                                                                <div class="priceDiv disf" style="display:none;">
                                                                                    <div class="currency">{{$v2['info']['currency']}}</div>
                                                                                    <div class="price">{{$v2['info']['goods_price']}}</div>
                                                                                </div>
                                                                                <div class="detailDiv">
                                                                                    <a class="view_detail f15" href="//www.gogo198.cn/goods-{{$v2['other_goods']}}.html" target="_blank">查看详情&gt;</a>
                                                                                </div>
                                                                            @elseif($v2['go_other']==3)
                                                                                <!--菜单链接-->
                                                                                <div class="detailDiv">
                                                                                    <a class="view_detail f15" href="/detail?id={{$v2['other_navbar']}}" target="_blank">查看详情&gt;</a>
                                                                                </div>
                                                                            @elseif($v2['go_other']==4)
                                                                                <!--第三方链接-->
                                                                                <div class="detailDiv">
                                                                                    <a class="view_detail f15" href="{{$v2['link']}}" target="_blank">查看详情&gt;</a>
                                                                                </div>
                                                                            @elseif($v2['go_other']==5)
                                                                                <!--搜索关键字-->
                                                                                <div class="detailDiv">
                                                                                    <a class="view_detail f15" href="/goods_list?frame_id=1&hotsearchId={{$v2['id']}}&searchTitle={{$v2['other_keywords']}}" target="_blank">查看详情&gt;</a>
                                                                                </div>
                                                                            @elseif($v2['go_other']==8)
                                                                                <!--图文-->
                                                                                <div class="detailDiv">
                                                                                    <a class="view_detail f15" href="/txt_detail?id={{$vo2['other_pic']}}&type=image_txt&oid={{$vo2['other_pic']}}" target="_blank">查看详情&gt;</a>
                                                                                </div>
                                                                            @elseif($v2['go_other']==9)
                                                                                <!--消息-->
                                                                                <div class="detailDiv">
                                                                                    <a class="view_detail f15" href="/msg_detail?id={{$vo2['other_msg']}}&type=image_txt&oid={{$vo2['other_msg']}}" target="_blank">查看详情&gt;</a>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="about-desc">
                                                                {{$v2['desc']}}
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <!--左右切换-->
                                                <div class="swiper-button-next sn-store sn{{$vo['id']}}"></div>
                                                <div class="swiper-button-prev sp-store sp{{$vo['id']}}"></div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            @elseif($vo['format_type']==10)
                                <!--标题+图片（一排三个）卡片样式-->
                                <section class="cross-border store_body ass" style="background:@if($vo['bg_type']==1) {{$vo['bg_color']}} @elseif($vo['bg_type']==2) url(https://shop.gogo198.cn/{{$vo['bg_img']}}) @endif;">
                                    <div class="container">
                                        <div class="row" style="margin-bottom:0;">
                                            <div class="col-md-12">
                                                <div class="section-title text-center">
                                                    <a href="/detail?id={{$vo['info']['id']}}" target="_blank" class="f15"><h2 class="f26">{{$vo['info']['name']}}</h2></a>
                                                    <p style="margin-bottom:10px;" class="f15">{{$vo['info']['desc']}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cardDiv">
                                            <div class="storeTitle f15" style="display: none;">
                                                {{$vo['info']['name']}}
                                            </div>
                                            <div class="swiper-container{{$vo['id']}} cardSwiper{{$vo['id']}} swiper-container-horizontal" style="overflow:hidden;position:relative;/*padding:10px 10px;*/box-sizing:border-box;overflow:hidden;">
                                                <div class="swiper-wrapper">
                                                    @foreach($vo['children'] as $k2=>$v2)
                                                        <div class="swiper-slide" style="height:100%;">
                                                            <div class="cross_border_content">
                                                                <div class="about-text">
                                                                    <div class="cross-section" style="background-image:url({{$v2['back_content']}});background-size: 100% 100%;position:relative;">
                                                                        <div class="in_mask"></div>
                                                                        <div class="cross-content">
                                                                            @if($v2['go_other']==0)
                                                                                <!--无跳转-->
                                                                                <a href="javascript:void(0);" target="_blank" class="f15"><h3 class="f22">{{$v2['name']}}</h3></a>
                                                                            @elseif($v2['go_other']==1 || $v2['go_other']==6 || $v2['go_other']==7)
                                                                                <!--分享&我要咨询&去找客服-->
                                                                                <a href="javascript:common_operation({{$v2['go_other']}},this);" class="f15"><h3 class="f22">{{$v2['name']}}</h3></a>
                                                                            @elseif($v2['go_other']==2)
                                                                                <!--商品链接-->
                                                                                <a href="//www.gogo198.cn/goods-{{$v2['other_goods']}}.html" target="_blank" class="f15"><h3 class="f22">{{$v2['name']}}</h3></a>
                                                                            @elseif($v2['go_other']==3)
                                                                                <!--菜单链接-->
                                                                                <a href="/detail?id={{$v2['other_navbar']}}" target="_blank" class="f15"><h3 class="f22">{{$v2['name']}}</h3></a>
                                                                            @elseif($v2['go_other']==4)
                                                                                <!--第三方链接-->
                                                                                <a href="{{$v2['link']}}" target="_blank" class="f15"><h3 class="f22">{{$v2['name']}}</h3></a>
                                                                            @elseif($v2['go_other']==5)
                                                                                <!--搜索关键字-->
                                                                                <a href="/goods_list?frame_id=1&hotsearchId={{$v2['id']}}&searchTitle={{$v2['gkeywords']}}" target="_blank" class="f15"><h3 class="f22">{{$v2['name']}}</h3></a>
                                                                            @elseif($v2['go_other']==8)
                                                                                <!--图文-->
                                                                                <a href="/txt_detail?id={{$vo2.other_pic}}&type=image_txt&oid={{$vo2.other_pic}}" target="_blank" class="f15"><h3 class="f22">{{$v2['name']}}</h3></a>
                                                                            @elseif($v2['go_other']==9)
                                                                                <!--消息-->
                                                                                <a href="/msg_detail?id={{$vo2.other_msg}}&type=image_txt&oid={{$vo2.other_msg}}" target="_blank" class="f15"><h3 class="f22">{{$v2['name']}}</h3></a>
                                                                            @endif
                                                                            <hr/>
                                                                            @if(empty($v2['children']))
                                                                                @if($v2['go_other']==1 || $v2['go_other']==6 || $v2['go_other']==7)
                                                                                    <!--分享&我要咨询&去找客服-->
                                                                                    <a href="javascript:common_operation({{$v2['go_other']}},this);" class="f15 view_detail">查看详情&gt;</a>
                                                                                @elseif($v2['go_other']==2)
                                                                                    <!--商品链接-->
                                                                                    <a href="//www.gogo198.cn/goods-{{$v2['other_goods']}}.html" target="_blank" class="f15 view_detail">查看详情&gt;</a>
                                                                                @elseif($v2['go_other']==3)
                                                                                    <!--菜单链接-->
                                                                                    <a href="/detail?id={{$v2['other_navbar']}}" target="_blank" class="f15 view_detail">查看详情&gt;</a>
                                                                                @elseif($v2['go_other']==4)
                                                                                    <!--第三方链接-->
                                                                                    <a href="{{$v2['link']}}" target="_blank" class="f15 view_detail">查看详情&gt;</a>
                                                                                @elseif($v2['go_other']==5)
                                                                                    <!--搜索关键字-->
                                                                                    <a href="/goods_list?frame_id=1&hotsearchId={{$v2['id']}}&searchTitle={{$v2['gkeywords']}}" target="_blank" class="f15 view_detail">查看详情&gt;</a>
                                                                                @endif
                                                                            @else
                                                                                <ul class="withArrow">
                                                                                    @foreach($v2['children'] as $k3=>$v3)
                                                                                        @if($v3['go_other']==1 || $v3['go_other']==6 || $v3['go_other']==7)
                                                                                            <!--分享&我要咨询&去找客服-->
                                                                                            <li><a href="javascript:common_operation({{$v3['go_other']}},this);" class="f15"><i class="fa">&gt;</i> {{$v3['name']}}</a></li>
                                                                                        @elseif($v3['go_other']==2)
                                                                                            <!--商品链接-->
                                                                                            <li><a href="//www.gogo198.cn/goods-{{$v3['other_goods']}}.html" target="_blank" class="f15"><i class="fa">&gt;</i> {{$v3['name']}}</a></li>
                                                                                        @elseif($v3['go_other']==3)
                                                                                            <!--菜单链接-->
                                                                                            <li><a href="/detail?id={{$v3['other_navbar']}}" target="_blank" class="f15"><i class="fa">&gt;</i> {{$v3['name']}}</a></li>
                                                                                        @elseif($v3['go_other']==4)
                                                                                            <!--第三方链接-->
                                                                                            <li><a href="{{$v3['link']}}" target="_blank" class="f15"><i class="fa">&gt;</i> {{$v3['name']}}</a></li>
                                                                                        @elseif($v3['go_other']==5)
                                                                                            <!--搜索关键字-->
                                                                                            <li><a href="/goods_list?frame_id=1&hotsearchId={{$v3['id']}}&searchTitle={{$v3['gkeywords']}}" class="f15"><i class="fa">&gt;</i> {{$v3['name']}}</a></li>
                                                                                        @endif
                                                                                    @endforeach
                                                                                </ul>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="about-desc">
                                                                    {{$v2['desc']}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <!--左右切换-->
                                                <!--<div class="swiper-button-next sn{{$k+1}}"></div>-->
                                                <!--<div class="swiper-button-prev sp{{$k+1}}"></div>-->
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            @elseif($vo['format_type']==11)
                                <!--标题+图片（两排六个）卡片样式-->
                                <section class="cross-border festival_body ass" style="background:@if($vo['bg_type']==1) {{$vo['bg_color']}} @elseif($vo['bg_type']==2) url(https://shop.gogo198.cn/{{$vo['bg_img']}}) @endif;">
                                    <div class="container">
                                        <div class="row" style="margin-bottom:0;">
                                            <div class="col-md-12">
                                                <div class="section-title text-center">
                                                    <a href="/detail?id={{$vo['info']['id']}}" target="_blank" class="f15"><h2 class="f26">{{$vo['info']['name']}}</h2></a>
                                                    <p style="margin-bottom:10px;" class="f15">{{$vo['info']['desc']}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="festivalDiv">
                                            <div class="storeTitle f15" style="display: none;">
                                                {{$vo['info']['name']}}
                                            </div>
                                            <div class="swiper-container{{$vo['id']}} guide2_content{{$vo['id']}}" style="overflow:hidden;">
                                                <div class="swiper-wrapper">
                                                    @foreach($vo['children'] as $k2=>$v2)
                                                        <div class="swiper-slide">
                                                            @foreach($v2 as $k3=>$v3)
                                                                <div class="hsColumn">
                                                                    @foreach($v3 as $k4=>$v4)
                                                                        <div class="hsBox">
                                                                            <div class="hs2 hsDiv" style="position:relative;">
                                                                                <!--当前节日，所有的国家循环-->
                                                                                <img loading="lazy" alt="GOGO198 網站圖片" src="https://shop.gogo198.cn/{{$v4['back_content']}}" class="guide2_country_img">
                                                                                <div class="hsMask"></div>
                                                                                <div class="hsContent">
                                                                                    <div class="title" title="{{$v4['name']}}">{{$v4['name']}}</div>
                                                                                    <hr/>
                                                                                    <div class="moreBtn">
                                                                                        @if($v4['go_other']==1 || $v4['go_other']==6 || $v4['go_other']==7)
                                                                                            <!--分享&我要咨询&去找客服-->
                                                                                            <a class="view_detail" href="javascript:common_operation({{$v4['go_other']}},this);">查看详情&gt;</a>
                                                                                        @elseif($v4['go_other']==2)
                                                                                            <!--商品链接-->
                                                                                            <a class="view_detail" href="//www.gogo198.cn/goods-{{$v4['other_goods']}}.html" target="_blank">查看详情&gt;</a>
                                                                                        @elseif($v4['go_other']==3)
                                                                                            <!--菜单链接-->
                                                                                            <a class="view_detail" href="/detail?id={$v4['other_navbar']}" target="_blank">查看详情&gt;</a>
                                                                                        @elseif($v4['go_other']==4)
                                                                                            <!--第三方链接-->
                                                                                            <a class="view_detail" href="{{$v4['link']}}" target="_blank">查看详情&gt;</a>
                                                                                        @elseif($v4['go_other']==5)}
                                                                                            <!--搜索关键字-->
                                                                                            <a class="view_detail" href="/goods_list?frame_id=1&hotsearchId={{$v4['id']}}&searchTitle={{$v4['gkeywords']}}" target="_blank">查看详情&gt;</a>
                                                                                        @elseif($v4['go_other']==8)
                                                                                            <!--图文-->
                                                                                            <a href="/txt_detail?id={{$v4['other_pic']}}&type=image_txt&oid={{$v4['other_pic']}}" target="_blank" class="view_detail">查看详情&gt;</a>
                                                                                        @elseif($v4['go_other']==9)
                                                                                            <!--消息-->
                                                                                            <a href="/msg_detail?id={{$v4['other_msg']}}&type=image_txt&oid={{$v4['other_msg']}}" target="_blank" class="view_detail">查看详情&gt;</a>
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="about-desc">
                                                                                {{$v4['desc']}}
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <!--左右切换-->
                                                <div class="swiper-button-next sn{{$vo['id']}}"></div>
                                                <div class="swiper-button-prev sp{{$vo['id']}}"></div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            @elseif($vo['format_type']==12)
                                <!--杂志导航样式-->
                                <section class="cross-border industry_body ass" style="background:@if($vo['bg_type']==1) {{$vo['bg_color']}} @elseif($vo['bg_type']==2) url(https://shop.gogo198.cn/{{$vo['bg_img']}}) @endif;">
                                    <div class="container">
                                        <div class="row" style="margin-bottom:0;">
                                            <div class="col-md-12">
                                                <div class="section-title text-center">
                                                    <a href="/detail?id={{$vo['info']['id']}}" target="_blank" class="f15"><h2 class="f26">{{$vo['info']['name']}}</h2></a>
                                                    <p style="margin-bottom:10px;" class="f15">{{$vo['info']['desc']}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="industryDiv">
                                            <div class="storeTitle f15" style="display: none;">
                                                {{$vo['info']['name']}}
                                            </div>
                                            <div class="serviceBox disf">
                                                <div class="leftBox">
                                                    <div class="swiper-container{{$vo['id']}} cont6 cont6-{{$vo['id']}}">
                                                        <div class="swiper-wrapper">
                                                            @foreach($vo['big_children'] as $k2=>$v2)
                                                            <div class="swiper-slide">
                                                                <div class="searviceMask"></div>
                                                                <div class="serviceContent" style="background-size: 100% 100%;background-image: -webkit-image-set(url(https://shop.gogo198.cn/{{$v2['back_content']}}) 1x,url({https://shop.gogo198.cn/{{$v2['back_content']}}) 2x,url(https://shop.gogo198.cn/{{$v2['back_content2']}}) 3x);background-image: image-set(url(https://shop.gogo198.cn/{{$v2['back_content']}}) 1x,url(https://shop.gogo198.cn/{{$v2['back_content']}}) 2x,url(https://shop.gogo198.cn/{{$v2['back_content2']}}) 3x);">
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
                                                                                                @if($v4['go_other']==1 || $v4['go_other']==6 || $v4['go_other']==7)
                                                                                                    <a href="javascript:common_operation({{$v4['go_other']}},this);">{{$v4['name']}}</a>
                                                                                                @elseif($v4['go_other']==2)
                                                                                                    <!--商品链接-->
                                                                                                    <a href="//www.gogo198.cn/goods-{{$v4['other_goods']}}.html">{{$v4['name']}}</a>
                                                                                                @elseif($v4['go_other']==3)
                                                                                                    <!--菜单链接-->
                                                                                                    <a href="/detail?id={{$v4['other_navbar']}}">{{$v4['name']}}</a>
                                                                                                @elseif($v4['go_other']==4)
                                                                                                    <!--第三方链接-->
                                                                                                    <a href="{{$v4['link']}}" target="_blank">{{$v4['name']}}</a>
                                                                                                @elseif($v4['go_other']==5)
                                                                                                    <!--搜索关键字-->
                                                                                                    <a href="/goods_list?frame_id=1&hotsearchId={{$v4['id']}}&searchTitle={{$v4['gkeywords']}}">{{$v4['name']}}</a>
                                                                                                @elseif($v4['go_other']==8)
                                                                                                    <!--图文-->
                                                                                                    <a href="/txt_detail?id={{$v4['other_pic']}}&type=image_txt&oid={{$v4['other_pic']}}" target="_blank" class="f15"><h3 class="f22">{{$v2['name']}}</h3></a>
                                                                                                @elseif($v4['go_other']==9)
                                                                                                    <!--消息-->
                                                                                                    <a href="/msg_detail?id={{$v4['other_msg']}}&type=image_txt&oid={{$v4['other_msg']}}" target="_blank" class="f15"><h3 class="f22">{{$v2['name']}}</h3></a>
                                                                                                @endif
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
                                                        <div class="swiper-button-next sn{{$vo['id']}}"></div>
                                                        <div class="swiper-button-prev sp{{$vo['id']}}"></div>
                                                    </div>
                                                </div>
                                                <div class="rightBox">
                                                    <div class="serviceContent">
                                                        @foreach($vo['big_children'] as $k2=>$v2)
                                                        <div class="swiper-container guide_content{{$v2['id']}} guide_content_pc"  style="@if($k2==0) display:block; @endif width: 100%;height:100%;">
                                                            <div class="swiper-wrapper">
                                                                @foreach($v2['sml_children'] as $k3=>$v3)
                                                                <div class="swiper-slide">
                                                                    @foreach($v3 as $k4=>$v4)
                                                                    <div class="serviceDiv">
                                                                        <div class="disf">
                                                                            <div class="serviceImg" style="background:{{$v4['rand_background']}};">
                                                                                <div class="serviceTitleTop" title="{{$v4['name']}}">{{$v4['name']}}</div>
                                                                                <img loading="lazy" alt="GOGO198 網站圖片" src="https://shop.gogo198.cn/{{$v2['back_content']}}" class="serviceImg" style="display: none;">
                                                                            </div>
                                                                            <div class="serviceTxt">
                                                                                <div class="serviceDesc" title="{$v4['desc']}">{{$v4['desc']}}</div>
                                                                                @if($v4['go_other']==1 || $v4['go_other']==6 || $v4['go_other']==7)
                                                                                    <div class="moreBtn"><a href="javascript:common_operation({{$v4['go_other']}},this);">查看详情&gt;</a></div>
                                                                                @elseif($v4['go_other']==2)
                                                                                    <!--商品链接-->
                                                                                    <div class="moreBtn"><a href="///www.gogo198.cn/goods-{{$v4['other_goods']}}.html" target="_blank">查看详情&gt;</a></div>
                                                                                @elseif($v4['go_other']==3)
                                                                                    <!--菜单链接-->
                                                                                    <div class="moreBtn"><a href="/detail?id={{$v4['other_navbar']}}" target="_blank">查看详情&gt;</a></div>
                                                                                @elseif($v4['go_other']==4)
                                                                                    <!--第三方链接-->
                                                                                    <div class="moreBtn"><a href="{{$v4['link']}}" target="_blank">查看详情&gt;</a></div>
                                                                                @elseif($v4['go_other']==5)
                                                                                    <!--搜索关键字-->
                                                                                    <div class="moreBtn"><a href="/goods_list?frame_id=1&hotsearchId={{$v4['id']}}&searchTitle={{$v4['gkeywords']}}" target="_blank">查看详情&gt;</a></div>
                                                                                @elseif($v4['go_other']==8)
                                                                                    <!--图文-->
                                                                                    <div class="moreBtn"><a href="/txt_detail?id={{$v4.other_pic}}&type=image_txt&oid={{$v4.other_pic}}" target="_blank" class="f15"><h3 class="f22">{{$v2['name']}}</h3></a></div>
                                                                                @elseif($v4['go_other']==9)
                                                                                    <!--消息-->
                                                                                    <div class="moreBtn"><a href="/msg_detail?id={{$v4.other_msg}}&type=image_txt&oid={{$v4.other_msg}}" target="_blank" class="f15"><h3 class="f22">{{$v2['name']}}</h3></a></div>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                            <!--左右切换-->
                                                            <div class="swiper-button-next sn-child{{$v2['id']}}"></div>
                                                            <div class="swiper-button-prev sp-child{{$v2['id']}}"></div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            @elseif($vo['format_type']==13)
                                <!--一排两个卡片样式-->
                                <section class="cross-border store_body ass" style="background:@if($vo['bg_type']==1) {{$vo['bg_color']}} @elseif($vo['bg_type']==2) url(https://shop.gogo198.cn/{{$vo['bg_img']}}) @endif;">
                                    <div class="container">
                                        <div class="row" style="margin-bottom:0;">
                                            <div class="col-md-12">
                                                <div class="section-title text-center">
                                                    <a href="/detail?id={{$vo['info']['id']}}" target="_blank" class="f15"><h2 class="f26">{{$vo['info']['name']}}</h2></a>
                                                    <p style="margin-bottom:10px;" class="f15">{{$vo['info']['desc']}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cardDiv">
                                            <div class="storeTitle f15" style="display:none;">
                                                {{$vo['info']['name']}}
                                            </div>
                                            <div class="swiper-container{{$vo['id']}} cardSwiper{{$vo['id']}} swiper-container-horizontal" style="overflow:hidden;position:relative;/*padding:10px 10px;*/box-sizing:border-box;overflow:hidden;">
                                                <div class="swiper-wrapper">
                                                    @foreach($vo['children'] as $k2=>$v2)
                                                    <div class="swiper-slide" style="height:100%;">
                                                        <div class=" cross_border_content">
                                                            <div class="about-text">
                                                                <div class="cross-section" style="background-image:url({{$v2['back_content']}});background-size: 100% 100%;position:relative;">
                                                                    <div class="in_mask"></div>
                                                                    <div class="cross-content">
                                                                        @if($v2['go_other']==0)
                                                                            <!--无跳转-->
                                                                            <a href="javascript:void(0);" target="_blank" class="f15"><h3 class="f22">{{$v2['name']}}</h3></a>
                                                                        @elseif($v2['go_other']==1 || $v2['go_other']==6 || $v2['go_other']==7)
                                                                            <!--分享&我要咨询&去找客服-->
                                                                            <a href="javascript:common_operation({{$v2['go_other']}},this);" class="f15"><h3 class="f22">{{$v2['name']}}</h3></a>
                                                                        @elseif($v2['go_other']==2)
                                                                            <!--商品链接-->
                                                                            <a href="//www.gogo198.cn/goods-{{$v2['other_goods']}}.html" target="_blank" class="f15"><h3 class="f22">{{$v2['name']}}</h3></a>
                                                                        @elseif($v2['go_other']==3)
                                                                            <!--菜单链接-->
                                                                            <a href="/detail?id={{$v2['other_navbar']}}" target="_blank" class="f15"><h3 class="f22">{{$v2['name']}}</h3></a>
                                                                        @elseif($v2['go_other']==4)
                                                                            <!--第三方链接-->
                                                                            <a href="{{$v2['link']}}" target="_blank" class="f15"><h3 class="f22">{{$v2['name']}}</h3></a>
                                                                        @elseif($v2['go_other']==5)
                                                                            <!--搜索关键字-->
                                                                            <a href="/goods_list?frame_id=1&hotsearchId={{$v2['id']}}&searchTitle={{$v2['gkeywords']}}" target="_blank" class="f15"><h3 class="f22">{{$v2['name']}}</h3></a>
                                                                        @elseif($v2['go_other']==8)
                                                                            <!--图文-->
                                                                            <a href="/txt_detail?id={{$v2.other_pic}}&type=image_txt&oid={{$v2.other_pic}}" target="_blank" class="f15"><h3 class="f22">{{$v2['name']}}</h3></a>
                                                                        @elseif($v2['go_other']==9)
                                                                            <!--消息-->
                                                                            <a href="/msg_detail?id={{$v2.other_msg}}&type=image_txt&oid={{$v2.other_msg}}" target="_blank" class="f15"><h3 class="f22">{{$v2['name']}}</h3></a>
                                                                        @endif
                                                                        <hr/>
                                                                        @if(empty($v2['children']))
                                                                            @if($v2['go_other']==1 || $v2['go_other']==6 || $v2['go_other']==7)
                                                                                <!--分享&我要咨询&去找客服-->
                                                                                <a href="javascript:common_operation({{$v2['go_other']}},this);" class="f15 view_detail">查看详情&gt;</a>
                                                                            @elseif($v2['go_other']==2)
                                                                                <!--商品链接-->
                                                                                <a href="//www.gogo198.cn/goods-{{$v2['other_goods']}}.html" target="_blank" class="f15 view_detail">查看详情&gt;</a>
                                                                            @elseif($v2['go_other']==3)
                                                                                <!--菜单链接-->
                                                                                <a href="/detail?id={{$v2['other_navbar']}}" target="_blank" class="f15 view_detail">查看详情&gt;</a>
                                                                            @elseif($v2['go_other']==4)
                                                                                <!--第三方链接-->
                                                                                <a href="{{$v2['link']}}" target="_blank" class="f15 view_detail">查看详情&gt;</a>
                                                                            @elseif($v2['go_other']==5)
                                                                                <!--搜索关键字-->
                                                                                <a href="/goods_list?frame_id=1&hotsearchId={{$v2['id']}}&searchTitle={{$v2['gkeywords']}}" target="_blank" class="f15 view_detail">查看详情&gt;</a>
                                                                            @elseif($v2['go_other']==8)
                                                                                <!--图文-->
                                                                                <a href="/txt_detail?id={{$v2.other_pic}}&type=image_txt&oid={{$v2.other_pic}}" target="_blank" class="f15"><h3 class="f22">{{$v2['name']}}</h3></a>
                                                                            @elseif($v2['go_other']==9)
                                                                                <!--消息-->
                                                                                <a href="/msg_detail?id={{$v2.other_msg}}&type=image_txt&oid={{$v2.other_msg}}" target="_blank" class="f15"><h3 class="f22">{{$v2['name']}}</h3></a>
                                                                            @endif
                                                                        @else
                                                                            <ul class="withArrow">
                                                                                @foreach($v2['children'] as $k3=>$v3)
                                                                                    @if($v3['go_other']==1 || $v3['go_other']==6 || $v3['go_other']==7)
                                                                                        <!--分享&我要咨询&去找客服-->
                                                                                        <li><a href="javascript:common_operation({{$v3['go_other']}},this);" class="f15"><i class="fa">&gt;</i> {{$v3['name']}}</a></li>
                                                                                    @elseif($v3['go_other']==2)
                                                                                        <!--商品链接-->
                                                                                        <li><a href="//www.gogo198.cn/goods-{{$v3['other_goods']}}.html" target="_blank" class="f15"><i class="fa">&gt;</i> {{$v3['name']}}</a></li>
                                                                                    @elseif($v3['go_other']==3)
                                                                                        <!--菜单链接-->
                                                                                        <li><a href="/detail?id={{$v3['other_navbar']}}" target="_blank" class="f15"><i class="fa">&gt;</i> {{$v3['name']}}</a></li>
                                                                                    @elseif($v3['go_other']==4)
                                                                                        <!--第三方链接-->
                                                                                        <li><a href="{{$v3['link']}}" target="_blank" class="f15"><i class="fa">&gt;</i> {{$v3['name']}}</a></li>
                                                                                    @elseif($v3['go_other']==5)
                                                                                        <!--搜索关键字-->
                                                                                        <li><a href="/goods_list?frame_id=1&hotsearchId={{$v3['id']}}&searchTitle={{$v3['gkeywords']}}" class="f15"><i class="fa">&gt;</i> {{$v3['name']}}</a></li>
                                                                                    @elseif($v2['go_other']==8)
                                                                                        <!--图文-->
                                                                                        <a href="/txt_detail?id={{$v2.other_pic}}&type=image_txt&oid={{$v2.other_pic}}" target="_blank" class="f15"><h3 class="f22">{{$v2['name']}}</h3></a>
                                                                                    @elseif($v2['go_other']==9)
                                                                                        <!--消息-->
                                                                                        <a href="/msg_detail?id={{$v2.other_msg}}&type=image_txt&oid={{$v2.other_msg}}" target="_blank" class="f15"><h3 class="f22">{{$v2['name']}}</h3></a>
                                                                                    @endif
                                                                                @endforeach
                                                                            </ul>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="about-desc">
                                                                {{$v2['desc']}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                <!--左右切换-->
                                                <!--<div class="swiper-button-next sn{{$k+1}}"></div>-->
                                                <!--<div class="swiper-button-prev sprv{{$k+1}}"></div>-->
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            @endif
                        @endif
                    @endforeach
                    <!--板块流结束-->
                @endif
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
    
    // 存储所有板块轮播实例
    const swiperInstances = {};

    // 初始化轮播函数
    function initSwiper(swiperClass, pageClass, preview) {
        if (!swiperInstances[swiperClass]) {
            swiperInstances[swiperClass] = new Swiper(swiperClass, {
                direction: 'vertical',
                slidesPerView: preview[0],
                spaceBetween: preview[1],
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: pageClass,
                    clickable: true,
                },
                // 关键修复：添加观察者
                observer: true,
                observeParents: true,
                observeSlideChildren: true,
                // 处理幻灯片数量不足的情况
                loopAdditionalSlides: 2,
                loopPreventsSlide: true
            });
        }
        return swiperInstances[swiperClass];
    }
    
    //microsoft edge样式
    function isMicrosoftEdge() {
        var userAgent = navigator.userAgent;
        return userAgent.indexOf("Edg") > -1 || userAgent.indexOf("EdgA") > -1;
    }
    
    $(function () {
        //小轮播+切换框====start
        // 选项卡切换功能
        $('.rc_container .tab').click(function() {
            $('.rc_container .tab').removeClass('active');
            $(this).addClass('active');
            let tab_sel = $(this).attr('data-tab');

            if(tab_sel == 'service'){
                @if(!empty(session('user')))
                    $('.rc_container .news-container').hide();
                    $('.rc_container .customer-service').show();
                @else
                    window.location.href="/login.html";
                @endif
            }else{
                $('.rc_container .news-container').show();
                $('.rc_container .customer-service').hide();
            }
        });

        // 新闻垂直轮播效果
        let currentSlide = 0;
        const slides = $('.rc_container .news-slide');
        const slideHeight = slides.first().outerHeight(true);
        const totalSlides = slides.length;

        function nextNewsSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            $('.rc_container .news-vertical-slider').css('transform', `translateY(-${(currentSlide * slideHeight) - 130.91}px)`);
        }

        setInterval(nextNewsSlide, 6000);

        // 添加悬停暂停功能
        $('.rc_container .news-content').hover(
            function() {
                clearInterval(interval);
            },
            function() {
                interval = setInterval(nextNewsSlide, 6000);
            }
        );

        let interval = setInterval(nextNewsSlide, 6000);
        //小轮播+切换框====end

        // 常见问题====start
        //折叠样式
        $('.faq-title').on('click', function () {
            // 找到当前点击标题对应的内容区域
            var content = $(this).next('.faq-content');
            // 判断内容是否已展开（是否有 show 类）
            if (content.hasClass('show')) {
                // 已展开则隐藏，移除 show 类
                content.removeClass('show');
            } else {
                // 未展开则显示，添加 show 类
                content.addClass('show');
            }
        });

        //分类垂直轮播样式
        $('.fq_container .category').click(function() {
            const category = $(this).data('category');
            const swiperClass = '.' + category + '_swiper';
            const pageClass = '.qa_page' + category.replace('qa', '');

            // 更新激活状态
            $('.fq_container .category').removeClass('active');
            $(this).addClass('active');

            // 隐藏所有轮播
            $('.fq_container .qa_swiper').hide();

            // 显示当前分类轮播
            $(swiperClass).show();

            // 初始化/获取轮播实例
            let preview = [8,10];
            if(window.screen.width < 992){
                preview = [3,5];
            }
            const swiper = initSwiper(swiperClass, pageClass, preview);

            // 关键修复：延迟更新确保正确渲染
            setTimeout(() => {
                swiper.update();
                swiper.slideTo(0, 0); // 重置到第一张
                swiper.autoplay.start();

                // 处理移动端可能的布局问题
                if ($(window).width() < 768) {
                    swiper.changeDirection('horizontal', true);
                    swiper.changeDirection('vertical', true);
                }
            }, 100);
        });
        // 常见问题====end

        //切换框====start
        // 头部切换逻辑
        const $tabItems = $('.tab-item');
        var arrs = {};
        @foreach($services as $k=>$vo)
            @foreach($vo['info']['children'] as $k2=>$vo2)
                // 动态拼接键名和jQuery选择器值
                arrs['service{{$vo2['id']}}'] = $('#contentService{{$vo2['id']}}, #contentServiceImg{{$vo2['id']}}');
            @endforeach
        @endforeach

        // 赋值给最终变量
        const $contentAreas = arrs;

        $tabItems.on('click', function () {
            const target = $(this).data('target');
            $tabItems.removeClass('active');
            $(this).addClass('active');
            // 隐藏所有内容
            Object.values($contentAreas).forEach(area => area.hide());
            // 显示对应内容
            $contentAreas[target].show();
        });

        // 左右箭头逻辑
        const $tabNav = $('#tabNav');
        const $prevArrow = $('#prevArrow');
        const $nextArrow = $('#nextArrow');

        function checkArrows() {
            if(typeof($tabNav[0]) != 'undefined') {
                if ($tabNav[0].scrollWidth > $tabNav.width()) {
                    $('.arrow').show();
                } else {
                    $('.arrow').hide();
                }
            }
        }

        $(window).on('resize', checkArrows);
        checkArrows();

        $prevArrow.on('click', function () {
            $tabNav.animate({ scrollLeft: '-=100' }, 300);
        });

        $nextArrow.on('click', function () {
            $tabNav.animate({ scrollLeft: '+=100' }, 300);
        });

        // 自动切换定时器（每10秒切换）
        let currentIndex = 0;
        const totalTabs = $tabItems.length;
        setInterval(() => {
            currentIndex = (currentIndex + 1) % totalTabs;
            $tabItems.eq(currentIndex).trigger('click');
        }, 10000);
        //切换框====end
    });
    
    $(function(){
        // 视口高度（随窗口缩放变化）
        var viewportHeight = window.innerHeight - $('.pc_header').outerHeight();
        var plateHeight = window.innerHeight;
        $('#banner').css({'height': viewportHeight + 'px'});// 轮播图

        if(!IsPhone()){
            $('.cross-border').css({'height': viewportHeight + 'px'});// 业务服务

            var viewportHeight2 = viewportHeight - 350;
            $('.cross-border .row .cross-section .cross-content').css({'height': viewportHeight2 + 110 + 'px'});
        }else{
            $('.cross-border').css({'height': plateHeight + 'px'});// 业务服务
            $('.container').css({'width': window.innerWidth + 'px'});
        }


        if(IsPhone()){
            $('.contentBox').css({'-webkit-transform':'translate(-50%, -0.2%)'});
            $('.wapNavContent').show();
            $('.mobile_news_box').show();
            $('.pc_news_box').hide();
            $('.pcNavContent').hide();
            $('.change_boxClick').css({'height':'unset'});
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
    //发现轮播图结束

    //业务服务开始=================
    @if(1>2)
        <!--旧版-->
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
    @else
        if(window.screen.width < 992){
            //手机版脚本
            //延迟加载“手机版的-头部新闻轮播”
            setTimeout(function () {
                //集成
                new Swiper('#mobileNewsBox-container', {
                    loop: false, // 循环模式选项
                    direction: 'vertical',
                    autoplay: {
                        delay: 5000
                    },
                    // 如果需要分页器
                    // pagination: {
                    //     el: '.swiper-pagination',
                    // },
                });
            }, 1000);
    
            @foreach($services as $k=>$vo)
                @if($vo['format']>0)
                    <!--所有板块流轮播脚本初始化-->
                    new Swiper('.swiper-container{{$vo['id']}}', {
                        loop: true, // 循环模式选项
                        autoplay: {
                            delay: 5000
                        },
                        slidesPerView: 1,
                        paginationClickable: true,
                        spaceBetween: 60,
                        // 如果需要前进后退按钮
                        navigation: {
                            nextEl: '.sn{{$vo['id']}}',
                            prevEl: '.sp{{$vo['id']}}',
                        },
                    });
                @else
                    @if($vo['format_type']==5)
                        <!--一问一答图文内容-->
                        @foreach($vo['fq_category_content'] as $key2=>$vo2)
                            const qa{{$key2}} = new Swiper('.qa{{$key2}}_swiper', {
                                direction: 'vertical',
                                slidesPerView: 3,
                                spaceBetween: 5,
                                loop: true,
                                autoplay: {
                                    delay: 5000,
                                    disableOnInteraction: false,
                                },
                                pagination: {
                                    el: '.qa_page{{$key2}}',
                                    clickable: true,
                                },
                            });
                        @endforeach
                    @endif
                @endif
            @endforeach
        }else{
            //电脑版
            // 头部新闻轮播
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

            @foreach($services as $k=>$vo)
                @if($vo['format']>0)
                    @if($vo['format_type']==9 || $vo['format_type']==10 || $vo['format_type']==11 || $vo['format_type']==13)
                        @if($vo['format_type']==9) var slidesPerView = 4; @endif
                        @if($vo['format_type']==10) var slidesPerView = 3; @endif
                        @if($vo['format_type']==11) var slidesPerView = 1; @endif
                        @if($vo['format_type']==13) var slidesPerView = 2; @endif
    
                        new Swiper ('.swiper-container{{$vo['id']}}', {
                            direction:'horizontal',
                            loop: true, // 循环模式选项
                            autoplay: {
                                delay:5000,
                            },
                            slidesPerView: slidesPerView,
                            // setWrapperSize: true,
                            // centeredSlides: true,
                            spaceBetween: 20,
                            speed:500,
                            preventDefaultEvents:true,
                            navigation: {
                                nextEl: '.sn{{$vo['id']}}',
                                prevEl: '.sp{{$vo['id']}}',
                            },
                        });
                    @elseif($vo['format_type']==12)
                        //产业集聚-大卡片
                        new Swiper ('.cont6-{{$vo['id']}}', {
                            loop: false,
                            autoplay:false,
                            snap: false,
                            navigation: {
                                nextEl: '.sn{{$vo['id']}}',
                                prevEl: '.sp{{$vo['id']}}',
                            },
                            on: {
                                slideChange: function () {
                                    // 获取当前索引
                                    var aidx = this.activeIndex;
                                    $('.industryDiv').find('.rightBox').find('.serviceContent').find('.guide_content_pc').css('display','none');
                                    $('.industryDiv').find('.rightBox').find('.serviceContent').find('.guide_content_pc').eq(aidx).css('display','block');
                                    // console.log(aidx,$('.industryDiv').find('.serviceContent').find('.swiper-container').eq(aidx).css('display'));
                                    @foreach($vo['big_children'] as $k2=>$v2)
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
                                                    nextEl: ".sn-child{{$v2['id']}}",
                                                    prevEl: ".sp-child{{$v2['id']}}",
                                                },
                                            });
                                        }
                                    @endforeach
                                    }
                                }
                            });
    
                        //产业集聚-小卡片
                        @foreach($vo['big_children'] as $k2=>$v2)
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
                                    nextEl: ".sn-child{{$v2['id']}}",
                                    prevEl: ".sp-child{{$v2['id']}}",
                                },
                            });
                        @endforeach
    
                        //手机版循环滚动小卡片
                        @foreach($vo['big_children'] as $k2=>$v2)
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
                    @else
                        new Swiper('.swiper-container{{$vo['id']}}', {
                            loop: true, // 循环模式选项
                            autoplay: {
                                delay: 5000
                            },
                            slidesPerView: 1,
                            paginationClickable: true,
                            spaceBetween: 60,
                            // 如果需要前进后退按钮
                            // navigation: {
                            //   nextEl: '.sn{{$k+1}}',
                            //   prevEl: '.sprv{{$k+1}}',
                            // },
                        });
                    @endif
                @else
                    @if($vo['format_type']==5)
                        <!--一问一答图文内容-->
                        @foreach($vo['fq_category_content'] as $key2=>$vo2)
                            const qa{{$key2}} = new Swiper('.qa{{$key2}}_swiper', {
                                direction: 'vertical',
                                slidesPerView: 8,
                                spaceBetween: 10,
                                loop: true,
                                autoplay: {
                                    delay: 3000,
                                    disableOnInteraction: true,
                                },
                                pagination: {
                                    el: '.qa_page{{$key2}}',
                                    clickable: true,
                                },
                            });
                        @endforeach
                    @endif
                @endif
            @endforeach
        }
    @endif
    //业务服务结束=================

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