<!--头部-->
@include('layouts.header')
<style type="text/css" media="all">
    .chosen-container-single .chosen-search input[type="text"]{color:#000;}
    .kefuDiv{display:none;}
    body{background:#fff !important;}
    .disf{display:flex;align-items:center;}
    /**轮播区域START**/
    #banner{position: fixed;top: 0;left: 0;height:100%;width: 100%;}
    /**轮播图修改样式**/
    #carousel-container{height:100%;width: 100%;}
    .swiper-button-prev, .swiper-button-next{color: #fff;background: rgba(94,95,94,0.5);box-shadow: 0px 0px 10px 0 #fff;border: 1px solid #fff;border-radius: 50%;width: 30px;height: 30px;}
    .swiper-button-prev:hover,.swiper-button-next:hover{background:#e60000;}
    .swiper-button-prev:after, .swiper-button-next:after {font-size: 14px;}
    .swiper-pagination-bullet {width: 6px;height: 6px;background-color: #FFFFFF;opacity: 1;}
    .swiper-pagination-bullet-active {width: 14px;height: 6px;border-radius: 3px;opacity: 1;background-color: #FFFFFF;}
    .swiper-button-disabled{display:none;}

    /**搜索栏**/
    .searchBox{width: 50%;position: absolute;top: 65%;z-index: 9;left: 50%;transform: translate(-50%, -50%);}
    .searchBox .searchLogo{text-align: center;margin-bottom:20px;}
    .searchBox .searchLogo img{width:360px;}
    .searchBox .searchContent{border-radius: 40px;background: #fff;height: 55px;border:1px solid #fff;width: 100%;}
    .searchBox .selectBox select{border:0;background: none;font-size: 22px;text-align: center;}
    .searchBox .inputBox{height: 100%;width: 100%;box-shadow: 0px 0px 15px 4px #555353;border-radius: 40px;}
    .searchBox .inputBox .nameBox {padding:0px 0px 0px 20px;position: relative;width: 100%;overflow: hidden;display:flex;align-items: center;}
    .searchBox .inputBox .nameBox input{border:0;width:40%;padding-right:5px;text-align: center;}
    .searchBox .inputBox .btnBox{width:60px;height:100%;background:{{$website['color']}};display: flex;align-items: center;justify-content: center;border-top-right-radius: 40px;border-bottom-right-radius: 40px;padding:5px 0 0 5px;cursor: pointer;}
    .searchBox .inputBox .btnBox img{width:60px;}
    .searchBox .leftCont1{font-size: 32px;color: #fff;font-weight: 600;margin-bottom: 20px;text-align: center;text-shadow: -1px 0 4px #0e2e68, 0 1px 4px #0e2e68, 1px 0 #0e2e68, 0 -1px #0e2e68;}

    /*最新医讯*/
    .newsContainer{width: 45%;justify-content: center;transition:all 0.3s ease;padding-right:5px;}
    .newsContainer .leftTxt{color:#fff;display: inline-block;font-weight:800;width: fit-content;height:28px;text-shadow: -1px 0 4px #0e2e68, 0 1px 4px #0e2e68, 1px 0 #0e2e68, 0 -1px #0e2e68;}
    .newsContainer .rightTxt{width: 100%;}
    .newsContainer .news{height: 20px;overflow: hidden;width: 100%;}
    .newsContainer .news .swiper-slide{text-overflow: ellipsis;white-space: nowrap;}
    .newsContainer .news a{color:{{$website['color_word']}};font-weight:800;}
    .newsContainer .news a p{color:#000;font-weight:800;line-height: 20px;width:100%;white-space: nowrap;text-overflow:unset;overflow: unset;/*text-shadow: -1px 0 1px #0e2e68, 0 1px 1px #0e2e68, 1px 0 #0e2e68, 0 -1px #0e2e68;*/}

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
    .contentSized .rightNav .nav_item_active{background:{{$website['color']}};color:#fff;}
    .contentSized .rightNav .nav_item_active:hover{background:#e60000;}
    .contentSized .rightNav .nav_item_active a{color:#fff;}
    .navAct{color:#fff;font-weight: 800;}
    .navAct:hover{color:#fff;}
    .navAct:focus{color:#fff;}
    .nav_item{padding:0 10px;box-sizing: border-box;transition:all 0.3s ease;}
    .nav_item a{color:#fff;}
    #g_nav .nav_item:hover{background:#e60000;padding: 4px 12px;box-sizing: border-box;border: 2px solid #bebebe;border-radius: 12px;color:{{$website['color_word']}} !important;}
    #g_nav .nav_item:hover a{color:{{$website['color_word']}} !important;}
    .nav_item_active{padding: 4px 12px;box-sizing: border-box;border: 2px solid #bebebe;border-radius: 12px;background:{{$website['color']}};}
    .nav_item_active:hover{background:#e60000;}
    .navAndContent_feed > .contentBelowNav {margin-top: 0;padding: 20px;padding-top:0;}
    .contentPlaceHolder {min-height: 100vh;width: 100%;}
    /*.column4_list{!**display: grid;grid-template-columns: repeat(4,1fr);-moz-column-gap: 20px;column-gap: 20px;row-gap: 20px;**!}*/
    .column4_list{display: grid;grid-template-columns: repeat(3,1fr);-moz-column-gap: 20px;column-gap: 20px;row-gap: 20px;}
    .column4_list .column_gad2{grid-column-start: 1;grid-column-end: 3;}
    .column_item{border-radius: 10px;}

    /*发现轮播*/
    .discoveryDiv{position:relative;height:100%;}
    .discoveryDiv .titleDiv{position:absolute;width:100%;height:80px;bottom:0;left:0;color:#fff;background:rgba(0,0,0,0.5);padding: 15px;box-sizing: border-box;font-weight: 800;white-space: nowrap;text-overflow: ellipsis;overflow:hidden;}
    .discoveryDiv .shareBox{position: absolute;top:10px;right:10px;background: #fff;border-radius: 50%;color:#000;width:30px;height:30px;line-height: 27px;text-align: center;box-shadow: 0px 0px 10px 1px #bebebe;cursor:pointer;display:none;}
    .discoveryDiv .shareBox .bds_more{background: none; color: #000;  margin: 0px; padding-left: 0px; display: block;font-size:32px !important;line-height: 25px;text-align: center;width: 100%;}
    #discovery-container{width:100%;height:385px;border-radius:10px;box-shadow: 0px 0px 10px 1px #bebebe;}

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

    .column_gd1 .newsDiv{height:390px;width:100%;background:#fff;border-radius:15px;overflow:hidden;box-shadow: 0px 0px 10px 1px #bebebe;border: 5px solid {{$website['color_word']}};}
    .column_gd1 .newsDiv .newsHead{width:100%;height:10%;border-bottom: 1px solid {{$website['color']}};}
    .column_gd1 .newsDiv .newsHead .newsText{width:50%;text-align: center;color:#000;padding:5px 0;cursor:pointer;}
    .column_gd1 .newsDiv .newsHead .newsAct{background:{{$website['color']}};color:#fff;}
    .column_gd1 .newsDiv .newsCont{height:90%;max-width:373px;min-width:373px;width:auto;padding:8px 10px 10px;box-sizing: border-box;position: relative;}
    .column_gd1 .newsDiv .newsCont .swiper-container{height:100%;width:100%;}
    /*.column_gd1 .newsDiv .newsCont .swiper-container .swiper-slide{height:50px !important;overflow: hidden;text-overflow: ellipsis;white-space:nowrap;}*/
    .column_gd1 .newsDiv .newsCont .swiper-container .swiper-slide a{overflow: hidden;text-overflow: ellipsis;white-space:nowrap;}
    /**内容滚动区域END**/

    /*PC版时间+汇率+浏览量*/
    /*时间*/
    .news_box{background:{{$website['color']}};width: calc(100% - 60px);margin-top:0px;padding: 0px;box-sizing: border-box;border-radius:5px;}
    .news_box .time{margin:0px 0px 0;color:#fff;}
    .news_box .time span{font-size: 15px;white-space: nowrap;}
    .news_box .time #selectCity{width: 90px;font-size: 15px;border: 0;background: #fff;text-align: center;color:#000;}
    .news_box .time .chosen-container{width: 120px;}
    /*汇率*/
    .news_box .rate{margin-top:0px;padding-left: 0px;justify-content: center;}
    .news_box .rate .leftTxt{color:#fff;display: inline-block;font-weight:100;width: 30%;text-align:right;}
    .news_box .rate .rightTxt{display: inline-block;width: 70%;}
    .news_box .rate .rate_swiper{height: 18px;overflow: hidden;width: 100%;}
    .news_box .rate_swiper .swiper-slide{text-overflow: ellipsis;white-space: nowrap;}
    .news_box .rate_swiper a{color:#fff;font-weight:100;}
    .news_box .rate_swiper a p{color:#fff;font-weight:100;line-height: 20px;width:100%;white-space: nowrap;text-overflow:ellipsis;overflow: hidden;}
    /*浏览量*/
    .news_box .readNum{height: 18px;overflow: hidden;margin-top:0px;}
    .news_box .readNum p{font-size:15px;color:#fff;line-height:19px;white-space: nowrap;}
    /*手机版时间+汇率+浏览量*/
    .mobile_news_box{display:none;position: absolute;bottom: -150px;width: 100%;}
    .mobile_news_box .news_box{text-align: center;width: calc(100% + 10px);padding: 10px;box-sizing: border-box;box-shadow: 0px 0px 15px 4px #555353;}
    .mobile_news_box .news_box .rate{margin: 10px 0;}

    /**平台推荐START**/
    .storeDiv{width: 100%;margin: 40px 0px 0px;padding: 10px 10px;position: relative;border:2px solid {{$website['color_word']}};box-sizing: border-box;border-radius: 5px;border-top-left-radius: 0;}
    .storeDiv .storeTitle{position: absolute;top:-30px;left:-2px;background:{{$website['color']}};color:{{$website['color_word']}};padding:5px 10px;border:2px solid {{$website['color_word']}};z-index: 9;border-bottom: 0;border-radius: 5px;border-bottom-right-radius: 0;border-bottom-left-radius: 0;}
    .storeDiv .storeOperaDiv{position: absolute;top: calc(50%);left: 0;background:rgba(0,0,0,0.5);width: 100%;}
    .storeDiv .storeOperaDiv .operaItem{padding:10px;box-sizing: border-box;color:#fff;border-right: 1px solid #fff;cursor:pointer;transition:all 0.3s ease;}
    .storeDiv .storeOperaDiv .operaItem:hover{background:{{$website['color']}};}
    .storeDiv .storeOperaDiv .operaItem:last-child{border:0;}
    .storeDiv .storeOperaDiv .operaItem.operaItemAct{background:{{$website['color']}};}
    .storeDiv .content_body .introduceBox{color:{{$website['color_word']}};overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 5;-webkit-box-orient: vertical;}
    .storeDiv .content_body .goodsBox{height: 100%;}
    .storeDiv .content_body .goodsBox .goodsDiv{margin-bottom: 10px;}
    .storeDiv .content_body .goodsBox .goodsDiv .goodsImg{width:calc(30% - 10px);height:100px;margin-right:10px;}
    .storeDiv .content_body .goodsBox .goodsDiv .goodsInfo{width:70%;}
    .storeDiv .content_body .goodsBox .goodsDiv .goodsInfo .title{width: 100%;color:{{$website['color_word']}};overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 3;-webkit-box-orient: vertical;white-space: pre-wrap;}
    .storeDiv .content_body .goodsBox .goodsDiv .goodsInfo .price{background:{{$website['color_word']}};color:{{$website['color']}};padding: 3px 10px;border-radius: 5px;width: 110px;text-align: center;margin-top:10px;}
    .storeDiv .content_body .goodsBox .goodsDiv .goodsInfo .viewGoods{background:#e60000;color:{{$website['color_word']}};padding: 3px 10px;border-radius: 5px;width: fit-content;text-align: center;margin-left:15px;cursor:pointer;margin-top:10px;}
    /**平台推荐END**/

    /**产业集聚START**/
    .industryDiv{width: 100%;margin: 50px 0px 0px;padding: 15px;box-sizing: border-box;border:2px solid {{$website['color_word']}};position: relative;border-radius: 5px;border-top-left-radius: 0;}
    .industryDiv .storeTitle{position: absolute;top:-30px;left:-2px;background:{{$website['color']}};color:{{$website['color_word']}};padding:5px 10px;border:2px solid {{$website['color_word']}};z-index: 9;border-bottom: 0;border-radius: 5px;border-bottom-right-radius: 0;border-bottom-left-radius: 0;}
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
    .cont6-bg .serviceBox .leftBox .cont6 .searviceMask{position: absolute;top:0;left:0;background:#fff;z-index: 10;opacity: 0.7;width: 100%;height:100%;border-radius: 6px;display: none;}
    .cont6-bg .serviceBox .leftBox .cont6 .serviceContent .serviceDiv{z-index: 12;position: absolute;bottom:-40px;left:50%;transform:translate(-15%,-100%);width: 100%;margin:0 auto;}
    .cont6-bg .serviceBox .leftBox .cont6 .serviceContent .serviceDiv .serviceTitle{font-size:25px;font-weight: 800;color:#1f5188;}
    .cont6-bg .serviceBox .leftBox .cont6 .serviceContent .serviceDiv .serviceDesc{font-size:15px;font-weight: 800;display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 7;overflow: hidden;text-overflow: ellipsis;width: 100%;margin-top:15px;color:#1f5188;}
    .cont6-bg .serviceBox .leftBox .cont6 .serviceContent .serviceDiv .serviceIn{font-weight:800;margin-top:15px;width: fit-content;color: #fff;font-size: 15px;background: #1f5188;padding: 4px 15px;border-radius: 15px;border: 2px solid #fff;}
    .cont6-bg .serviceBox .leftBox .cont6 .serviceContent .serviceDiv .serviceIn:hover{color:#fff;background:#e60000;}
    .cont6-bg .serviceBox .rightBox{width:100%;height:100%;grid-column-start: 2;grid-column-end: 4;}
    .cont6-bg .serviceBox .rightBox .serviceContent{width:100%;}
    .cont6-bg .serviceBox .rightBox .serviceContent .swiper-slide{display: grid;grid-template-columns: repeat(2,1fr);-moz-column-gap: 20px;column-gap: 20px;row-gap: 20px;padding:0px;}
    .cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv{width:-webkit-fill-available;height:274px;border:2px solid #b1b1b1;border-radius: 8px;box-shadow: 0px 0px 8px 0px #797777;padding:22px 22px 22px 32px;background: #d1d0d0;position:relative;}
    .cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv .serviceImg{margin-right:20px;}
    .cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv .serviceImg img{width:150px;height:150px;border-radius: 8px;border: 2px solid #fff;box-shadow: 0px 0px 8px 0px #797977;}
    .cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv .serviceTitle{font-size:25px;font-weight: 800;color:#1f5188;margin-bottom:15px;text-align: center;}
    .cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv .serviceTxt .serviceDesc{font-size:15px;font-weight: 800;display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 8;overflow: hidden;text-overflow: ellipsis;width: 100%;margin-top:0px;color:#1f5188;}
    .cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv:hover{border-color:{{$website['color']}};color:#fff;}
    .cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv:hover .serviceTitle{color:#fff;}
    .cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv:hover .serviceDesc{color:#fff;}
    .cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv .serviceTxt .moreBtn{width: 100%;text-align: right;position:absolute;bottom: 10px;right: 5px;}
    .cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv .serviceTxt .moreBtn a:hover{background:#e60000;}
    .cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv .serviceTxt .moreBtn a{color:#fff;font-size: 15px;background: {{$website['color']}};padding: 4px 15px;border-radius: 15px;border: 2px solid #fff;}
    .cont6-bg .serviceContent .guide_smlcontent{bottom: var(--swiper-pagination-bottom, 13%);left: var(--swiper-pagination-left, 50%);transform: translate(-38%, 0%);}
    /**产业集聚END**/

    /**环球节庆START**/
    .festivalDiv{width: 100%;margin: 50px 0px 0px;padding: 15px;box-sizing: border-box;border:2px solid {{$website['color_word']}};position: relative;border-radius: 5px;border-top-left-radius: 0;margin-bottom:40px;}
    .festivalDiv .storeTitle{position: absolute;top:-30px;left:-2px;background:{{$website['color']}};color:{{$website['color_word']}};padding:5px 10px;border:2px solid {{$website['color_word']}};z-index: 9;border-bottom: 0;border-bottom: 0;border-radius: 5px;border-bottom-right-radius: 0;border-bottom-left-radius: 0;}
    .cont4-bg {z-index: 10;opacity: 1;position: relative;}
    .cont4-bg .headTxt{padding-top: 0px;font-size: 30px;justify-content: center;position: relative;}
    .cont4-bg .headTxt .actTxt {color: #e60000;font-weight: 800;}
    .cont4-bg .headTxt .norTxt {color: #1f5188;font-weight: 800;font-size: 24px;}
    .cont4-bg .headTxt .norTxt span{font-family:PingFang SC,Hiragino Sans GB,Heiti SC,Microsoft YaHei,Helvetica,Tahoma,Arial,SimHei,WenQuanYi Micro Hei !important;font-size: 30px;margin:0 10px;}
    .cont4-bg .hs1{background:url(/assets/d2eace91/images/newhome/hotsearch1.png);background-size: 100% 100%;background-repeat: no-repeat;border: 2px solid #b1b1b1;border-radius: 8px;width: 795px;}
    .cont4-bg .hs2{background:url(/assets/d2eace91/images/newhome/hotsearch2.png);background-size: 100% 100%;background-repeat: no-repeat;border: 3px solid #fff;border-radius: 8px;width: 100%;}
    .cont4-bg .hsMask{width: 100%;height: 100%;position: absolute;background: #000;opacity:0.5;z-index: 8;border-radius: 6px;}
    .cont4-bg .headBox{margin-bottom:40px;}
    .cont4-bg .hsColumn{display: grid;grid-template-columns: repeat(3,1fr);-moz-column-gap: 20px;column-gap: 20px;row-gap: 20px;margin-bottom:20px;}
    .cont4-bg .hsColumn:last-child{margin-bottom: 0;}
    .cont4-bg .hsDiv{height:220px;position: relative;box-shadow: 0px 0px 8px 0px #797777;}
    .cont4-bg .hsDiv:hover{border-color:{{$website['color']}};transition: all 0.3s ease;}
    .cont4-bg .hsDiv:hover .hsContent .title,.cont4-bg .hsDiv:hover .hsContent .zh_title,.cont4-bg .hsDiv:hover .hsContent .desc{color:#fff;transition: all 0.3s ease;background:#e60000;opacity:0.8;}
    .cont4-bg .hsDiv:hover>.hsMask{display: none;}
    .cont4-bg .hsDiv .hsContent{opacity: 1;color: #fff;z-index: 10;position:absolute;width: 100%;top: 50%;transform: translate(0, -50%);}
    .cont4-bg .hsDiv .hsContent .title{font-size:18px;font-weight:800;text-align: center;padding:10px 0;}
    .cont4-bg .hsDiv .hsContent .zh_title{font-weight:800;text-align: center;padding:0px 0;}
    .cont4-bg .hsDiv .hsContent .desc{font-size:15px;text-align: center;width: 100%;padding:10px 0;}
    .cont4-bg .hsDiv .hsContent .moreBtn{width: 100%;text-align: center;margin-top: 20px;}
    .cont4-bg .hsDiv .hsContent .moreBtn a{color: #fff;font-size: 15px;background: {{$website['color']}};padding: 4px 15px;border-radius: 15px;border: 2px solid #fff;}
    /**环球节庆END**/

    @media (max-width: 992px) {
        .swiper-button-disabled{display:flex;}
        /*手机版轮播图居中且全屏显示*/
        #carousel-container img{background-position: center;background-repeat: no-repeat;background-size: cover;height: 101%;margin: -1px 0px 0px -1px;object-fit: cover;padding: 0;position: absolute;width: 101%;}
        /*搜索框*/
        .searchBox{width: 90%;top:40%;}
        .searchBox .inputBox .nameBox{position:relative;overflow: unset;}
        .searchBox .newsContainer{width: 100%;position: absolute;bottom: -40px;}
        .searchBox .inputBox .nameBox input{width:80%;}
        .searchBox .inputBox .nameBox #method{width:40%;}
        .newsContainer .news a p{color:{{$website['color_word']}};text-shadow: -1px 0 1px #0e2e68, 0 1px 1px #0e2e68, 1px 0 #0e2e68, 0 -1px #0e2e68;}

    /*热卖&客服*/
    .column_gd1{margin-top:20px;}
    .column_gd1 .newsDiv .newsCont{width:100%;min-width: unset;max-width: unset;}
    .column_gd1 .goodsDiv .goodsInfo .title{width: 80%;}



    /*滚动内容*/
    .contentBox{width: 90%;}
    .contentSized .navSized{width: 100%;}
    .contentSized .rightNav{width: 0%;}
    .nav_item{white-space: nowrap;}
    .column4_list{display: block;}
    .column_item .content_card img{object-fit: cover;}
    .discoveryDiv img{background-position: center;background-repeat: no-repeat;background-size: cover;height: 100%;margin: -1px 0px 0px -1px;object-fit: cover;}
    .column_item{margin-bottom: 0px;}

    /**平台推荐**/
    .storeDiv{margin:50px 0px 0px;}
    .sn-store,.sp-store{top:45%;}
    .storeDiv .storeOperaDiv{top:49%;}
    .storeDiv .content_body .goodsBox .goodsDiv .goodsInfo .viewGoods{white-space: nowrap;}
    .column_item .content_card .content_body{height:130px;}

    /*产业集聚*/
    .cont6-bg .serviceBox{grid-template-columns:repeat(1,1fr);display:block;}
    .cont6-bg .serviceBox .leftBox{width: 100%;height: 450px;min-height: 450px;margin-bottom:20px;}

    /*环球节庆*/
    .cont4-bg .hsColumn{grid-template-columns:repeat(1,1fr);}
    }
</style>
<link rel="stylesheet" href="/assets/d2eace91/js/chosen/chosen.css?v=1.2"/>
<link rel="stylesheet" href="/assets/d2eace91/layui/css/layui.css">

<script type="text/javascript" charset="utf-8">
    var head= document.getElementsByTagName('head')[0]; var script= document.createElement('script'); script.type= 'text/javascript'; script.src= '//www.gogo198.cn/assets/d2eace91/js/res.zvo.cn_translate_inspector_v2.js?v=12<?php echo time();?>'; head.appendChild(script);
</script>
<style>
    *{line-height: 19px;}
</style>
<section id="banner" class="fullscreen-section" style="border:1px solid {{$website['color_word']}};">
    <!-- 轮播图开始 -->
    <div class="swiper-container" id="carousel-container">
        <!--轮播内容-->
        <div class="swiper-wrapper">
            @foreach($rotate as $k=>$vo)
            <div class="swiper-slide">
                <img src="//shop.gogo198.cn/{{$vo['thumb']}}" alt="" style="width:100%;height:-webkit-fill-available;" class="carousel-image"/>
            </div>
            @endforeach
        </div>
    </div>
    <!-- 轮播图结束 -->

    <!--搜索栏-->
    <div class="searchBox">
        <!--搜索栏-->
        <div class="searchLogo">
            <img src="//shop.gogo198.cn/{{$search['img']}}" alt="">
        </div>
        <form action="">
            <div class="searchContent disf">
                <div class="inputBox disf">
                    <div class="nameBox">
                        <div class="newsContainer">
                            <div class="rightTxt">
                                <div class="swiper-container news">
                                    <div class="swiper-wrapper">
                                        @foreach($news as $k=>$vo)
                                        <div class="swiper-slide">
                                            <a href="" target="_blank"><p class="f18">{{$vo['title']}}</p></a>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--手机版时间+汇率+浏览量-->
                        <!--时间+站内信息-->
                        <div class="mobile_news_box">
                            <div class="news_box">
                                {{--                                <div class="disf" style="justify-content: space-around;">--}}
                                    <div class="time">
                                        <div class="drop-down beijing-time disf">
                                            <span>
                                                <select id="selectCity" onchange="selectCity(this)" class="chosen-select city-select">
                                                    @foreach($citys as $k=>$v)
                                                        <optgroup label="{{$k}}">
                                                            @foreach($v as $k2=>$v2)
                                                                <option value="{{$v2['city_en']}}"><span>{{$v2['contryCn']}}</span>{{$v2['cityCn']}}</option>
                                                            @endforeach
                                                        </optgroup>
                                                    @endforeach
                                                </select>
                                            </span>&nbsp;
                                            <span class="beijing_date"><?php echo date('Y/m/d');?></span>&nbsp;<span class="beijing_sec" style="width:60px;"></span>
                                        </div>
                                    </div>
                                    <div class="rate disf">
                                        <div class="leftTxt">实时汇率：</div>
                                        <div class="rightTxt">
                                            <div class="swiper-container rate_swiper">
                                                <div class="swiper-wrapper">
                                                    @foreach($data['rate'] as $k=>$v)
                                                    <div class="swiper-slide">
                                                        <a href="/rate_detail?id={{$v['id']}}" target="_blank"><p>1人民币&nbsp;≈&nbsp;<?php echo number_format(1*$v['rate'], 3);?>{{$v['name']}}</p></a>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--浏览量-->
                                    <div class="readNumBox">
                                        <div class="swiper-container readNum">
                                            <div class="swiper-wrapper">
                                                <div class="swiper-slide">
                                                    <p>昨天已有 ［{{$data['yesterday']}}］ 人次访问</p>
                                                </div>
                                                <div class="swiper-slide">
                                                    <p>本月累计 ［{{$data['this_month']}}］ 人次访问</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--                                </div>--}}
                            </div>
                        </div>
                        <input type="text" name="name" placeholder="{{$search['search_title']}}" class="f20" id="searchInput">
                    </div>
                    <div class="btnBox" onclick="search_info(this)">
                        <img src="/assets/d2eace91/images/newhome/search_icon.png">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!--搜索栏-->

</section>
<div class="contentBox">
    <input type="hidden" id="shareTitle" value="">
    <input type="hidden" id="shareUrl" value="">
    <section class="navAndContent navAndContent_tb navAndContent_nb">
        <div class="navAndContent_feed">
            <div class="g_nav_container">
                <div id="g_nav">
                    <div class="contentSized contentSizedOneColumn pcNavContent">
                        <div class="disf" style="justify-content: space-between;">
                            <div class="leftNav navSized">
                                <div class="nav_item nav_item_active"><a href="javascript:toTop();" class="navAct f15">发现</a></div>
                                <div class="nav_item"><a href="javascript:void(0);" target="_blank" class="f15">平台推荐</a></div>
                                <div class="nav_item"><a href="javascript:void(0);" target="_blank" class="f15">产业集聚</a></div>
                                <div class="nav_item"><a href="javascript:void(0);" target="_blank" class="f15">环球节庆</a></div>
                            </div>
                            <div class="rightNav" style="display: block;">
                                <div class="nav_item_active" style="display: none;">
                                    <a href="javascript:connect_kefu();" class="disf">
                                        <span class="f15" style="display: inline-block;white-space: nowrap;margin-left:5px;">客服中心</span>
                                    </a>
                                </div>
                                <!--时间+站内信息-->
                                <div class="news_box" style="display: block;">
                                    <div class="disf" style="justify-content: space-around;">
                                        <div class="time">
                                            <div class="drop-down beijing-time disf">
                                                <span>
                                                    <select id="selectCity" onchange="selectCity(this)" class="chosen-select city-select">
                                                        @foreach($citys as $k=>$v)
                                                            <optgroup label="{{$k}}">
                                                                @foreach($v as $k2=>$v2)
                                                                    <option value="{{$v2['city_en']}}"><span>{{$v2['contryCn']}}</span>{{$v2['cityCn']}}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        @endforeach
                                                    </select>
                                                </span>&nbsp;
                                                <span class="beijing_date"><?php echo date('Y/m/d');?></span>&nbsp;<span class="beijing_sec" style="width:60px;"></span>
                                            </div>
                                        </div>
                                        <div class="rate disf">
                                            <div class="leftTxt">实时汇率：</div>
                                            <div class="rightTxt">
                                                <div class="swiper-container rate_swiper">
                                                    <div class="swiper-wrapper">
                                                        @foreach($data['rate'] as $k=>$v)
                                                        <div class="swiper-slide">
                                                            <a href="/rate_detail?id={{$v['id']}}" target="_blank"><p>1人民币&nbsp;≈&nbsp;<?php echo number_format(1*$v['rate'], 3);?>{{$v['name']}}</p></a>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!--浏览量-->
                                        <div class="readNumBox">
                                            <div class="swiper-container readNum">
                                                <div class="swiper-wrapper">
                                                    <div class="swiper-slide">
                                                        <p>昨天已有 ［{{$data['yesterday']}}］ 人次访问</p>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <p>本月累计 ［{{$data['this_month']}}］ 人次访问</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="contentSized contentSizedOneColumn wapNavContent" style="display: none;">
                        <style>
                            .wapNavContent .leftNav{display: inline-block;overflow: visible;height:45px;position: relative;padding: 10px 10px 10px 20px;}
                            .wapNavContent .rightNav{display: inline-block;}
                            .wapNavContent .navSized .nav_item{display: inline-block;}
                            .wapNavContent .overflowContainer{color:{{$website['color_word']}};font-size:15px;cursor:pointer;display:inline-block;margin-left: 5px;}
                            .wapNavContent .overflowMenu{display:none;background:#fff;color:#000;position: absolute;width: 100px;text-align: center;top: -30px;right: 0px;}
                            .wapNavContent .overflowMenu .nav_item{padding:5px 10px;}
                            .wapNavContent .overflowMenu .nav_item a{color:#000;}
                        </style>
                        <div class="disf" style="justify-content: space-between;align-items: baseline;">
                            <div class="leftNav navSized">
                                <div class="nav_item nav_item_active"><a href="javascript:toTop();" class="navAct f15">发现</a></div>
                                <div class="nav_item"><a href="javascript:void(0);" target="_blank" class="f15">平台推荐</a></div>
                                <div class="nav_item"><a href="javascript:void(0);" target="_blank" class="f15">产业集聚</a></div>
                                <div class="overflowContainer" onclick="showMenu()">
                                    ···
                                </div>
                                <div class="overflowMenu">
                                    <div class="nav_item"><a href="javascript:void(0);" target="_blank" class="f15">环球节庆</a></div>
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
            <div class="contentBelowNav contentSized contentSizedOneColumn contentPlaceHolder">
                <div class="column4_list">
                    <div class="column_gad2 column_item">
                        <div class="swiper-container" id="discovery-container">
                            <!--轮播内容-->
                            <div class="swiper-wrapper">
                                @foreach($discovery_rotate as $k=>$vo)
                                <div class="swiper-slide">
                                    <div class="discoveryDiv">
                                        <a href="{{$vo['other_link']}}" target="_blank">
                                            <img src="//shop.gogo198.cn/{{$vo['thumb']}}" alt="" style="width:100%;" class="carousel-image"/>
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
                    <div class="column_gd1 column_item">
                        <div class="newsDiv">
                            <div class="newsHead disf">
                                <div class="newsText leftText newsAct f20" onclick="change_news(1)">热卖</div>
                                <div class="newsText rightText f20" onclick="change_news(2)">客服</div>
                            </div>
                            <div class="newsCont">
                                <div class="swiper-container news1">
                                    <div class="swiper-wrapper">
                                        <style>
                                            .column_gd1 .goodsDiv .goodsImg{width:calc(20% - 10px);height:50px;margin-right:10px;}
                                            .column_gd1 .goodsDiv .goodsInfo{width:80%;}
                                            .column_gd1 .goodsDiv .goodsInfo .title{width: 100%;text-overflow: ellipsis;overflow:hidden;white-space: nowrap;color:#000;}
                                            .column_gd1 .goodsDiv .goodsInfo .price{background:{{$website['color']}};color:{{$website['color_word']}};padding: 3px 10px;border-radius: 5px;width: 110px;text-align: center;margin-top:5px;}
                                            .column_gd1 .viewGoods{background:#e60000;color:{{$website['color_word']}};padding: 3px 10px;border-radius: 5px;width: fit-content;text-align: center;margin-left:15px;cursor:pointer;margin-top:5px;}
                                        </style>
                                        @foreach($hotbuy as $k=>$vo)
                                        <div class="swiper-slide">
                                            <div class="goodsDiv">
                                                <a href="/goods-{{$vo['goods_id']}}.html" target="_blank">
                                                    <div class="disf">
                                                        <div class="goodsImg" style="background: url({{$vo['mainItemImgs'][0]['path']}}) no-repeat 100% 100%;background-size: cover;"></div>
                                                        <div class="goodsInfo">
                                                            <div class="title f15" title="{{$vo['goods_name']}}">{{$vo['goods_name']}}</div>
                                                            <div class="disf">
                                                                <div class="price f15">CNY {{$vo['goods_price']}}</div>
                                                                <div class="viewGoods">详情</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="news2">
                                    <div class="column_item">
                                        <div class="content_card">
                                            <img src="//shop.gogo198.cn/collect_website/public/uploads/centralize/website_detail/66978ef9abf69.jpg" alt="" class="img_bg">
                                            <div class="content_body">
                                                <div class="text">
                                                    <a class="card_name f16" href="javascript:void(0);">我们提供全天候的人工智能问诊，让您随时随地获得医疗帮助。体验传统与科技相融，护航您的健康。</a>
                                                </div>
                                                <div class="attribution" style="text-align: center;">
                                                    <a href="javascript:connect_aikefu();" class="attribution-text f15" style="color:{{$website['color_word']}};padding:2px 8px;border-radius:12px;border:1px solid {{$website['color_word']}};">马上问诊</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--平台推荐-->
                <div class="storeDiv">
                    <div class="storeTitle f15">平台推荐</div>
                    <div class="swiper-container storeSwiper" style="overflow-y:visible;padding:7px;box-sizing: border-box;">
                        <div class="swiper-wrapper">
                            <style>
                                .storeDiv .goodsBox,.storeDiv .customerBox{display: none;}
                                .storeDiv .operaDiv{width: 100%;}
                            </style>
                            @for($i=0;$i<6;$i++)
                            <div class="swiper-slide">
                                <div class="column_item">
                                    <div class="content_card">
                                        <img src="https://shop.gogo198.cn/collect_website/public/uploads/centralize/website_rotate/6659a4762cd2a.jpg" alt="" class="img_bg">
                                        <div class="storeOperaDiv disf">
                                            <div class="operaItem f15 operaItemAct" onclick="storeSwitch(this,1)">介绍</div>
                                            <div class="operaItem f15" onclick="storeSwitch(this,2)">商品</div>
                                            <div class="operaItem f15">客服</div>
                                            <div class="operaItem f15">进入</div>
                                        </div>
                                        <div class="content_body">
                                            <div class="introduceBox operaDiv f15">
                                                介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍介绍
                                            </div>
                                            <div class="goodsBox operaDiv">
                                                <div class="swiper-container storeGoods{{$i}}">
                                                    <div class="swiper-wrapper">
                                                        @foreach($hotbuy as $k=>$vo)
                                                        <div class="swiper-slide">
                                                            <div class="goodsDiv">
                                                                <a href="/goods-{{$vo['goods_id']}}.html" target="_blank">
                                                                    <div class="disf" style="align-items: flex-start;">
                                                                        <div class="goodsImg" style="background: url({{$vo['mainItemImgs'][0]['path']}}) no-repeat 100% 100%;background-size: cover;"></div>
                                                                        <div class="goodsInfo">
                                                                            <div class="title f15" title="{{$vo['goods_name']}}">{{$vo['goods_name']}}</div>
                                                                            <div class="disf">
                                                                                <div class="price f15">CNY {{$vo['goods_price']}}</div>
                                                                                <div class="viewGoods">详情</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="customerBox operaDiv">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endfor
                        </div>
                        <!--左右切换-->
                        <div class="swiper-button-next sn-store"></div>
                        <div class="swiper-button-prev sp-store"></div>
                    </div>
                </div>
                <!--平台推荐最新版-->
                <div class="storeDiv" style="display: none;">
                    <div class="storeTitle f15">{{$v['title']}}</div>
                    <div class="swiper-container storeSwiper storeSwiper{{$k}}" style="overflow-y:visible;padding:7px;box-sizing: border-box;">
                        <div class="swiper-wrapper">
                            <style>
                                .storeDiv .goodsBox,.storeDiv .customerBox{display: none;}
                                .storeDiv .operaDiv{width: 100%;}
                            </style>
                            @for($i=0;$i<6;$i++)
                            <div class="swiper-slide">
                                <div class="column_item">
                                    <div class="content_card">
                                        <img src="https://shop.gogo198.cn/collect_website/public/uploads/centralize/website_index/店铺{{$i}}.jpg" alt="" class="img_bg">
                                        <div class="storeOperaDiv disf">
                                            <div class="operaItem f15 operaItemAct" onclick="storeSwitch(this,1)">介绍</div>
                                            <div class="operaItem f15" onclick="storeSwitch(this,2)">商品</div>
                                            <div class="operaItem f15">客服</div>
                                            <div class="operaItem f15">进入</div>
                                        </div>
                                        <div class="content_body">
                                            <div class="introduceBox operaDiv f15">
                                                中国汽车用品专门店
                                            </div>
                                            <div class="goodsBox operaDiv">
                                                <div class="swiper-container storeGoods{{$i}}">
                                                    <div class="swiper-wrapper">
                                                        @foreach($hotbuy as $key=>$vo)
                                                        <div class="swiper-slide">
                                                            <div class="goodsDiv">
                                                                <a href="/goods-{{$vo['goods_id']}}.html" target="_blank">
                                                                    <div class="disf" style="align-items: flex-start;">
                                                                        <div class="goodsImg" style="background: url({{$vo['mainItemImgs'][0]['path']}}) no-repeat 100% 100%;background-size: cover;"></div>
                                                                        <div class="goodsInfo">
                                                                            <div class="title f15" title="{{$vo['goods_name']}}">{{$vo['goods_name']}}</div>
                                                                            <div class="disf">
                                                                                <div class="price f15">CNY {{$vo['goods_price']}}</div>
                                                                                <div class="viewGoods">详情</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="customerBox operaDiv">

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
                <!--产业集聚-->
                <div class="industryDiv">
                    <div class="storeTitle f15">产业集聚</div>
                    <div class="cont6-bg fullscreen-section3 section">
                        <div class="w1200" style="height:100%;">
                            <div class="serviceBox disf">
                                <div class="leftBox">
                                    <div class="swiper-container cont6">
                                        <div class="swiper-wrapper">
                                            @foreach($industry['big_children'] as $k=>$v)
                                            <div class="swiper-slide">
                                                <div class="searviceMask"></div>
                                                <div class="serviceContent" style="background:url(https://shop.gogo198.cn/{{$v['back_content']}});background-size: 100% 100%;">
                                                    <div class="serviceDiv">
                                                        {{--                                                            <div class="serviceTitle" style="display: none;">$v['name']</div>--}}
                                                        {{--                                                            <div class="serviceDesc" style="display: none;" title="$v['desc']">$v['desc']</div>--}}
                                                        {{--                                                            onclick="switchIndustry(this,$v['id'])"--}}
                                                        <div class="serviceIn" >{{$v['name']}}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <!--左右切换-->
                                        <div class="swiper-button-next sn-cont6"></div>
                                        <div class="swiper-button-prev sp-cont6"></div>
                                        {{--                                        <div class="swiper-pagination guide_bigcontent"></div>--}}
                                    </div>
                                </div>
                                <div class="rightBox">
                                    <div class="serviceContent">
                                        @foreach($industry['big_children'] as $k=>$v)
                                        <div class="swiper-container guide_content{{$v['id']}}" style="display: @if($k==0)
                                                    block
                                                    @else
                                                    none
                                                    @endif;width: 100%;height:100%;">
                                            <div class="swiper-wrapper">
                                                @foreach($v['sml_children'] as $k2=>$v2)
                                                <div class="swiper-slide">
                                                    @foreach($v2 as $k3=>$v3)
                                                    <div class="serviceDiv">
                                                        <div class="disf">
                                                            <div class="serviceImg">
                                                                <div class="serviceTitle">{{$v3['name']}}</div>
                                                                <img src="//shop.gogo198.cn/{{$v3['back_content']}}" alt="">
                                                            </div>
                                                            <div class="serviceTxt">
                                                                <div class="serviceDesc" title="{{$v3['desc']}}">{{$v3['desc']}}</div>
                                                                <div class="moreBtn"><a href="/goods_list?frame_id=2&hotsearchId={{$v3['id']}}" target="_blank">更多&gt;</a></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                @endforeach
                                            </div>
                                            <!--左右切换-->
                                            <div class="swiper-button-next sn-industry{{$v['id']}}"></div>
                                            <div class="swiper-button-prev sp-industry{{$v['id']}}"></div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--环球节庆-->
                <div class="festivalDiv">
                    <div class="storeTitle f15">环球节庆</div>
                    <div class="cont4-bg fullscreen-section3 section">
                        <div class="w1200" style="height:100%;">
                            <div class="hsContent" style="height: 80%;overflow: hidden;">
                                <div class="swiper-container guide2_content">
                                    <div class="swiper-wrapper">
                                        @foreach($festival['children'] as $k=>$v)
                                        <div class="swiper-slide">
                                            @foreach($v as $k2=>$v2)
                                            <div class="hsColumn">
                                                @foreach($v2 as $k3=>$v3)
                                                <div class="hsBox disf">
                                                    <div class="hs2 hsDiv" style="background:@if(!empty($v3['country_pic']))
                                                                    url({{$v3['country_pic']}})
                                                                @elseif(!empty($v3['back_content']))
                                                                        url(//shop.gogo198.cn/{{$v3['back_content']}})
                                                                @endif
                                                                        ;background-size: cover;background-repeat:no-repeat;">
                                                        <div class="hsMask"></div>
                                                        <div class="hsContent">
                                                            <div class="title" title="{{$v3['en_name']}}">{{$v3['en_name']}}</div>
                                                            @if(!empty($v3['zh_name']))
                                                            <div class="zh_title f15" title="{{$v3['zh_name']}}">{{$v3['zh_name']}}</div>
                                                            @endif
                                                            <div class="desc f15" title="{{$v3['date']}}">{{$v3['date']}}</div>
                                                            <div class="moreBtn"><a href="/goods_list?frame_id=2&hotsearchId={{$v3['id']}}&is_festival=1" target="_blank">更多&gt;</a></div>
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
                                    {{--                                    <div class="swiper-pagination guide_smlcontent guide_smlcontent2"></div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@include('layouts.footer')


<script src="/assets/d2eace91/layui/layui.js"></script>
<script src="/assets/d2eace91/js/chosen/jquery.chosen.js?v=1.3"></script>
<script type="text/javascript" charset="utf-8">
    $('.city-select').chosen();

    //搜索提交
    function search_info(t){
        let method = $('#method').val();
        let title = $('#searchInput').val();

        $.post('/?s=main/search_info',{'method':method,'title':title},function(res){
            window.open(res.href, '_blank');
        });
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
            $('.pcNavContent').hide();
        }else{
            if (isMicrosoftEdge()) {
                $('.contentBox').css({'-webkit-transform':'translate(-50%, 0.2%)'});
            }
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
            $('.rightText').addClass('newsAct');
            $('.leftText').removeClass('newsAct');
            let width = $('.newsCont').width();
            let height = $('.newsCont').height();
            $('#aichat').css({'width':width,'height':height});
        }
        $('.news'+type).css({'opacity':1,'position':'absolute','top':'5px','left':'10px','z-index':11});
        $('.news'+type).siblings().css({'opacity':0,'z-index':10});
    }

    //轮播图开始
    new Swiper ('#carousel-container', {
        loop: true, // 循环模式选项
        autoplay: {
            delay:10000,
        },
        // 如果需要分页器
        pagination: {
            el: '.swiper-pagination',
        },
    });

    //新闻轮播
    var newsSwiper = new Swiper ('.news', {
        direction:'vertical',
        loop: true, // 循环模式选项
        autoplay: {
            delay:10000
        },
        spaceBetween: 1,
        // 如果需要分页器
        // pagination: {
        //     el: '.swiper-pagination',
        // },
    });
    var rate = new Swiper ('.rate_swiper', {
        loop: true,
        direction:'vertical',
        spaceBetween:0,
        autoplay:{
            delay:3000,
            disableOnInteraction:false,
        },
    });
    var slogan_swiper = new Swiper ('.slogan_swiper', {
        loop: true,
        direction:'vertical',
        spaceBetween:0,
        autoplay:{
            delay:3000,
            disableOnInteraction:false,
        },
    });
    var readNum = new Swiper ('.readNum', {
        loop: true,
        direction:'vertical',
        spaceBetween:0,
        autoplay:{
            delay:3000,
            disableOnInteraction:false,
        },
    });
    //站内信息
    var station_news = new Swiper('.station_news', {
        loop: true,
        direction:'vertical',
        spaceBetween:13,
        slidesPerView:4,
        autoplay:{
            delay:3000,
            disableOnInteraction:false,
        },
    });
    newsSwiper.on('init', function () {
        var activeIndex = newsSwiper.activeIndex;
        var slide = newsSwiper.slides[activeIndex];
        slide.innerHTML = '<marquee direction="left">'+slide.innerHTML+'</marquee>';
    });
    newsSwiper.on('slideChangeTransitionStart', function(){
        var activeIndex = newsSwiper.activeIndex;
        var slide = newsSwiper.slides[activeIndex];
        slide.innerHTML = '<marquee direction="left">'+slide.innerHTML+'</marquee>';
    });
    //轮播图结束

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

    //平台推荐
    if(IsPhone()){
        new Swiper ('.storeSwiper', {
            direction:'horizontal',
            loop: true, // 循环模式选项
            autoplay: {
                delay:6000,
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
    }else{
        new Swiper ('.storeSwiper', {
            direction:'horizontal',
            loop: true, // 循环模式选项
            autoplay: {
                delay:6000,
            },
            slidesPerView: 3,
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

    //平台推荐下的商品
    setTimeout(function(){
    @for($i=0;$i<6;$i++)
        new Swiper ('.storeGoods{{$i}}', {
            direction:'horizontal',
            loop: false, // 循环模式选项
            autoplay: {
                delay:3000,
            },
            slidesPerView: 1,
            setWrapperSize: true,
            centeredSlides: true,
            spaceBetween: 0,
            preventDefaultEvents:true
        });
    @endfor
    },2000);


    //产业集聚-大卡片
    var cont6Swiper = new Swiper ('.cont6', {
        loop: false,
        autoplay:false,
        snap: false,
        navigation: {
            nextEl: '.sn-cont6',
            prevEl: '.sp-cont6',
        },
        // pagination: {
        //     el: '.guide_bigcontent',
        //     type: 'bullets', // 设置为bullets类型
        //     clickable: true, // 允许点击点切换轮播
        // },
        on: {
            slideChange: function () {
                // 获取当前索引
                var aidx = this.activeIndex;
                $('.serviceContent').find('.swiper-container').eq(aidx).siblings().css({'display': 'none'});
                $('.serviceContent').find('.swiper-container').eq(aidx).css({'display': 'block'});
            @foreach($industry['big_children'] as $k=>$v)
                if ({{$k}}==aidx){
                    new Swiper('.guide_content{{$v['id']}}', {
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
                            nextEl: ".sn-industry{{$v['id']}}",
                            prevEl: ".sp-industry{{$v['id']}}",
                        },
                    });
                }
            @endforeach
            }
        }
    });

    {{--cont6Swiper.on('tap', function () {--}}
        {{--    console.log(this);--}}
        {{--    var aidx = this.snapIndex;--}}
        {{--    console.log(aidx,this.activeIndex);--}}
        {{--    $('.serviceContent').find('.swiper-container').eq(aidx).siblings().css({'display': 'none'});--}}
        {{--    $('.serviceContent').find('.swiper-container').eq(aidx).css({'display': 'block'});--}}
        {{--    @foreach($industry['big_children'] as $k=>$v)--}}
        {{--    if ({{$k}}==aidx){--}}
            {{--        new Swiper('.guide_content{{$v['id']}}', {--}}
                {{--            direction: 'horizontal',--}}
                {{--            loop: false,--}}
                {{--            autoplay: {--}}
                    {{--                delay: 6000,--}}
                    {{--                disableOnInteraction: true,--}}
                    {{--            },--}}
                {{--            setWrapperSize: true,--}}
                {{--            centeredSlides: true,--}}
                {{--            speed: 500,--}}
                {{--            navigation: {--}}
                    {{--                nextEl: ".sn-industry{{$v['id']}}",--}}
                    {{--                prevEl: ".sp-industry{{$v['id']}}",--}}
                    {{--            },--}}
                {{--        });--}}
    {{--    }--}}
    {{--    @endforeach--}}
    {{--});--}}

    //产业集聚-小卡片
    @foreach($industry['big_children'] as $k=>$v)
    var guide_content{{$v['id']}} = new Swiper ('.guide_content{{$v['id']}}', {
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
            nextEl: ".sn-industry{{$v['id']}}",
            prevEl: ".sp-industry{{$v['id']}}",
        },
    });
    @endforeach



    //环球节庆
    new Swiper ('.guide2_content', {
        direction:'horizontal',
        loop: true, // 循环模式选项
        autoplay: {
            delay:6000,
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
    //发现轮播图结束

    window.addEventListener('scroll', function() {
        var scrollPosition = window.scrollY;
        // console.log(scrollPosition,$(window).height()-200);
        if(scrollPosition>$(window).height()-200){
            $('header').hide();
            if(IsPhone()){
                $('#banner').css({'margin-top':'0px'});
            }
        }else{
            $('header').show();
            if(IsPhone()){
                $('#banner').css({'margin-top':'83px'});
            }
        }

    });

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

    function switchIndustry(t,id){
        $('.guide_content'+id).siblings().css({'display':'none'});
        $('.guide_content'+id).css({'display':'block'});
        new Swiper ('.guide_content{{$v['id']}}', {
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
                nextEl: ".sn-industry{{$v['id']}}",
                prevEl: ".sp-industry{{$v['id']}}",
            },
        });
    }

    function toTop(){
        $('html,body').animate({scrollTop:$(window).height()-60},'smooth');
    }
</script>
<!-- 加载Layer插件 -->
<!--<script src="/assets/d2eace91/js/layer/layer.js?v=1.2"></script>-->
<!--<script src="/assets/d2eace91/js/jquery.method.js?v=1.2"></script>
<script src="/assets/d2eace91/js/jquery.modal.js?v=1.2"></script>
<script src="/assets/d2eace91/js/jquery.widget.js?v=<?php echo time();?>"></script>

<link rel="stylesheet" href="/assets/d2eace91/layui/css/layui.css?v=23121"/>
<link rel="stylesheet" href="/assets/d2eace91/iconfont/iconfont.css?v=1.1"/>
<link rel="stylesheet" href="/css/common.css?v=1.1"/>-->