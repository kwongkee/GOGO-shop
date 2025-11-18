<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]-->
<html xmlns="http://www.w3.org/1999/xhtml">
<html lang="zh-CN">
<head>
    <title>{{ $website['name'] }}</title>
    <!-- 头部元数据 -->
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="Keywords" content="{{ $website['keywords'] }}" />
    <meta name="Description" content="{{ $website['desc'] }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <meta name="format-detection" content="telephone=no">
    <meta name="is_frontend" content="yes" />
    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="//shop.gogo198.cn/{{ $website['slogo'] }}" />
    <link rel="shortcut icon" type="image/x-icon" href="//shop.gogo198.cn/{{ $website['slogo'] }}" />
    <!-- #is_wabp_start -->
    <meta name="is_webp" content="no" />

    <style>
        body{overflow-x:hidden;}
        *{font-family: "Microsoft JhengHei", 微軟正黑體, "Arial", sans-serif !important;padding:0;margin:0;box-sizing: border-box;}
        a{text-decoration: none;}
        li, ul {padding: 0;margin: 0;list-style: none;}
        .w1200{width: 1200px;margin:0 auto;}
        .f18 {font-size: 18px !important;}
        .f16 {font-size: 16px !important;}
        .f12 {font-size: 12px !important;}
        .disf{display:flex;align-items: center;}
        /**所有轮播点样式**/
        .swiper-pagination {position: absolute;bottom: 10px;left: 10%;transform: translateX(-50%);}
        .swiper-pagination .swiper-pagination-bullet{border:2px solid #e60000;background:none;opacity:1;width:20px;height:20px;box-shadow: 0px 2px 6px 0px #797777;}
        .swiper-pagination .swiper-pagination-bullet-active{background:#e60000;}
        /*.fullscreen-section {position: relative;top: 0;left: 0;width: 100%;height: 100%;background-color: lightblue; !* 背景颜色 *!}*/
        .swiper-button-next,.swiper-button-prev {box-shadow: 0px 0px 8px 0px #797777;}
        /**登录框样式**/
        .login-form .login-con{box-sizing: revert;}
        .login-wrap .form-group .text{border-bottom: 1px solid #ddd !important;}

        /**右侧滑动**/
        .right-content{position: fixed;right:2%;top:29%;background:#fff;border-radius:5px;box-shadow: 0px 0px 8px 0px #797777;padding:40px 0;z-index: 11;}
        .right-content .rightList{text-align: center;position: relative;}
        .right-content .rightList .rightCont{height:300px;width:100%;overflow: hidden;transition: all 0.3s ease;}
        .right-content .rightList .topArrow{position: absolute;top:-30px;left:28px;width:15px;height:15px;border-right:3px solid #b1b1b1;border-bottom:3px solid #b1b1b1;transform:rotate(225deg);cursor: pointer;display: none;}
        .right-content .rightList .btmArrow{position: absolute;bottom:-30px;left:28px;width:15px;height:15px;border-right:3px solid #b1b1b1;border-bottom:3px solid #b1b1b1;transform:rotate(45deg);cursor: pointer;}
        .right-content .rightList .rightItem{padding:13px 17px;transition:all 0.3s ease;cursor:pointer;}
        .right-content .rightList .rightItem a{color:#1f5188;font-weight: 800;font-size: 18px;}
        .right-content .rightList .rightItem:hover{background:#e60000;transition: all 0.3s ease;}
        .right-content .rightList .rightItem:hover a{color:#fff;transition: all 0.3s ease;}
        .right-content .rightList .rightItemActive {background:#e60000;}
        .right-content .rightList .rightItemActive a{color:#fff;}
        .right-content .rightList .rightItem img{width:35px;height:35px;}
        .right-content .rightList .rightLine{width: 25px;height: 2px;background: #b1b1b1;margin: 18px auto;}

        /**轮播图**/
        .cont1-bg{width:100%;position:relative;}
        .cont1-bg .lunbo{width:100%;position:relative;overflow: hidden;}
        .cont1-bg .cont1{width: 100%;height: 69%;position: relative;}
        .cont1-bg .cont1 .swiper-slide{width: 100%;height: 100%;background-size: cover;background-position: center;}
        .cont1-bg .cont1 img{width: 100%;height: 100%;max-height:590px;}
        .cont1-bg .cont1 .swiper-pagination {position: absolute;bottom: 10px;left: 50%;transform: translateX(-50%);}
        .cont1-bg .cont1 .swiper-pagination .swiper-pagination-bullet{border:2px solid #e60000;background:none;opacity:1;width:15px;height:15px;box-shadow: 0px 2px 6px 0px #797777;}
        .cont1-bg .cont1 .swiper-pagination .swiper-pagination-bullet-active{background:#e60000;}
        /**==搜索框**/
        /*.cont1-bg .cont2-bg{!**position: absolute;bottom:-14%;left:50%;transform:translate(-50%,0%);**!width:100%;height:169px;box-shadow: 0px 0px 8px 0px #797777;z-index: 12;background:linear-gradient(to bottom,#1b73ea,#84d1fb);padding: 40px 30px;cursor:pointer;}*/
        .cont1-bg .cont2-bg{/**position: absolute;bottom:-14%;left:50%;transform:translate(-50%,0%);**/width:100%;height:25%;box-shadow: 0px 0px 8px 0px #797777;z-index: 12;/**background:#1f5188;**/padding: 30px 30px;}
        /*.cont1-bg .leftBox{padding-right:10px;margin-right:10px;}*/
        .cont1-bg .leftBox .leftCont1{font-size:32px;color:#fff;font-weight: 600;}
        .cont1-bg .leftBox .leftCont2{font-size:19.5px;color:#fff;margin-top: 30px;font-weight: 600;}
        .cont1-bg .cont2-bg .rightBox .leftCont1{font-size: 32px;color: #fff;font-weight: 600;margin-bottom: 20px;text-align: center;}
        .cont1-bg .rightBox{border-left: 1px solid #fff;padding: 0 30px;margin: 0 80px;border-right: 1px solid #fff;width: 50%}
        .cont1-bg .rightBox .searchContent{box-shadow: 0px 0px 8px 0px #797777;/**overflow: hidden;**/border-radius: 40px;background: #fff;height: 55px;border:1px solid #fff;width: 100%;}
        .cont1-bg .rightBox .selectBox{background: none;width: 140px;border-right: 1px solid #808080;height: 100%;text-align: center;display: flex;align-items: center;justify-content: center;}
        .cont1-bg .rightBox .selectBox select{border:0;background: none;font-size: 22px;text-align: center;}
        .cont1-bg .rightBox .inputBox{height: 100%;width: 100%;}
        .cont1-bg .rightBox .inputBox .nameBox {padding:13px 30px;position: relative;width: 100%;overflow: hidden;}
        .cont1-bg .rightBox .inputBox .nameBox input{border:0;font-size: 22px;width:100%;}
        .cont1-bg .rightBox .inputBox .btnBox{width:60px;height:100%;background:#1f5188;display: flex;align-items: center;justify-content: center;border-top-right-radius: 40px;border-bottom-right-radius: 40px;padding:5px 0 0 5px;cursor: pointer;}
        .cont1-bg .rightBox .inputBox .btnBox img{width:60px;}


        .diyBackground{background:url(/assets/d2eace91/images/newhome/diy_background.png);background-size: cover;background-repeat: no-repeat;position: relative;}
        .backgroundMask{background:#fff;opacity: 0.8;position: absolute;top:0;left:0;width: 100%;height:100%;z-index: 8;}
        /**热卖头部**/
        .cont3-bg{z-index: 10;opacity: 1;position: relative;}
        .cont3-bg .headBox,.cont4-bg .headBox,.cont5-bg .headBox,.cont6-bg .headBox{padding: 60px 20px 0;justify-content: space-between;}
        .cont3-bg .headBox .headTxt {font-size:30px;position: relative;justify-content: flex-start;}
        .cont3-bg .headBox .headTxt .actTxt{color:#e60000;font-weight: 800;position: relative;}
        /*.cont3-bg .headTxt .actTxt:after{content: '';position: absolute;bottom: -10px;left: 0%;width: 95px;height: 3px;background: #e60000;border-radius: 10px;}*/
        .cont3-bg .headBox .headTxt .norTxt{color:#1f5188;font-weight: 800;font-size:24px;}
        .cont3-bg .headBox .headTxt .norTxt span{font-family:PingFang SC,Hiragino Sans GB,Heiti SC,Microsoft YaHei,Helvetica,Tahoma,Arial,SimHei,WenQuanYi Micro Hei !important;font-size: 30px;margin:0 10px;}
        .cont3-bg .headBox .moreBtn,.cont4-bg .headBox .moreBtn,.cont5-bg .headBox .moreBtn,.cont6-bg .headBox .moreBtn{font-size: 20px;background:#1f5188;color:#fff;padding:4px 20px;border-radius: 15px;}
        .cont3-bg .headBox .moreBtn a,.cont4-bg .headBox .moreBtn a,.cont5-bg .headBox .moreBtn a,.cont6-bg .headBox .moreBtn a{color:#fff;}
        .cont3-bg .productBox{overflow: hidden;padding: 0 5px 5px;}
        .cont3-bg .productBox .cont3-next,.cont3-bg .productBox .cont3-4D-next,.cont3-bg .productBox .cont3-6D-next{right: var(--swiper-navigation-sides-offset, 250px);}
        .cont3-bg .productBox .cont3-next:after{color: #fff;background: #e60000;padding: 10px 20px;border-radius: 35px;box-shadow: 0px 0px 8px 0px #797777;}
        .cont3-bg .productBox .cont3-4D-next:after{color: #fff;background: #e60000;padding: 10px 20px;border-radius: 35px;box-shadow: 0px 0px 8px 0px #797777;}
        .cont3-bg .productBox .cont3-6D-next:after{color: #fff;background: #e60000;padding: 10px 20px;border-radius: 35px;box-shadow: 0px 0px 8px 0px #797777;}
        .cont3-bg .productBox .cont3-prev,.cont3-bg .productBox .cont3-4D-prev,.cont3-bg .productBox .cont3-6D-prev{left: var(--swiper-navigation-sides-offset, 250px);}
        .cont3-bg .productBox .cont3-prev:after{color: #fff;background: #e60000;padding: 10px 20px;border-radius: 35px;box-shadow: 0px 0px 8px 0px #797777;}
        .cont3-bg .productBox .cont3-4D-prev:after{color: #fff;background: #e60000;padding: 10px 20px;border-radius: 35px;box-shadow: 0px 0px 8px 0px #797777;}
        .cont3-bg .productBox .cont3-6D-prev:after{color: #fff;background: #e60000;padding: 10px 20px;border-radius: 35px;box-shadow: 0px 0px 8px 0px #797777;}
        /**热卖1**/
        .cont3-bg .productBox .twoBox{width: 100%;justify-content: space-between;margin-top:60px;padding: 0 12px;margin-bottom:80px;}
        .cont3-bg .productBox .twoBox .productContent{width: 525px;height:660px;/**background:#e2e2da;**/border-radius: 6px;box-shadow: 0px 0px 10px 1px #797777;padding:0px;margin-left:10px;}
        .cont3-bg .productBox .twoBox .productContent .productDiv{border:2px solid #1f5188;width: 100%;height:100%;border-radius: 8px;}
        .cont3-bg .productBox .twoBox .productContent .productDiv:hover{border-color:#e60000;transition: all 0.3s ease;}
        .cont3-bg .productBox .twoBox .productContent .productDiv .goodsBox{border-top-left-radius:8px;border-top-right-radius:8px;background:#fff;padding:10px 15px 20px;position:relative;}
        .cont3-bg .productBox .twoBox .productContent .infoBox{height: 155px;background: #1f5188;border-bottom-left-radius:5px;border-bottom-right-radius:5px;padding: 20px 15px 10px;}
        .cont3-bg .productBox .twoBox .productContent .infoBox .leftInfo{width: 70%;border-right: 2px solid #fff;padding-right: 10px;margin-right: 10px;}
        .cont3-bg .productBox .twoBox .productContent .infoBox .gname{font-size:16px;color:#fff;display: -webkit-box;-webkit-box-orient: vertical; -webkit-line-clamp: 2;overflow: hidden;text-overflow: ellipsis;height:48px;}
        .cont3-bg .productBox .twoBox .productContent .infoBox .rightInfo{width: 30%;background:url(/assets/d2eace91/images/newhome/price.png);background-size:100%;background-repeat: no-repeat;position:relative;}
        .cont3-bg .productBox .twoBox .productContent .infoBox .leftInfo .gData{margin-top:20px;}
        .cont3-bg .productBox .twoBox .productContent .infoBox .leftInfo .gData .gDataItem{text-align: center;margin:0 37px 0 32px;}
        .cont3-bg .productBox .twoBox .productContent .infoBox .leftInfo .gData .line{width:2px;height:32px;background:#fff;}
        .cont3-bg .productBox .twoBox .productContent .infoBox .leftInfo .gData .gDataItem .gDataNum{color:#fff;font-size:14px;}
        .cont3-bg .productBox .twoBox .productContent .infoBox .leftInfo .gData img{width:25px;}
        .cont3-bg .productBox .twoBox .productContent .infoBox .rightInfo .priceBuy{position:relative;height: 105px;cursor: pointer;}
        .cont3-bg .productBox .twoBox .productContent .infoBox .rightInfo .priceBuy .currency{position:absolute;top: 2px;left: 14px;color: #fff;font-size: 12px;font-weight: 600;}
        .cont3-bg .productBox .twoBox .productContent .infoBox .rightInfo .priceBuy .price{position:absolute;top: 34px;left: 50%;transform: translate(-40%, 0);color: #fff;font-size: 25px;font-weight: 600;}
        .cont3-bg .productBox .twoBox .productContent .infoBox .rightInfo .priceBuy .detail{position:absolute;bottom: 12px;left: 50%;transform: translate(-38%, 0);color: #e60000;font-size: 15px;text-shadow: -1px 0 #fff, 0 1px #fff, 1px 0 #fff, 0 -1px #fff;}
        .cont3-bg .productBox .twoBox .other_currency{position: absolute;left: 50%;bottom: -5px; transform:translate(-50%,0);}
        .cont3-bg .productBox .twoBox .other_currency .equal{font-size:15px;color:#fff;}
        .cont3-bg .productBox .twoBox .other_currency select{width:50px;}
        /**商品轮播图**/
        .cont3-bg .productBox .productContent .productDiv .cont3-1{overflow: hidden;}
        .cont3-bg .productBox .productContent .productDiv .cont3-1 img{width:100%;height:471px;border:5px solid #dbd9d9;}
        /**热卖2**/
        .cont3-bg .productBox .threeBox{display:none;}
        /*,.cont3-bg .productBox .fourDivs,.cont3-bg .productBox .sixDivs{display:none;}*/
        .cont3-bg .productBox .threeBox{width: 100%;justify-content: space-between;margin-top:80px;padding: 0 5px;}
        .cont3-bg .productBox .threeBox .productContent{width: 385px;height:540px;background:#e2e2da;border-radius: 6px;box-shadow: 0px 0px 8px 0px #797777;padding:10px;margin-left:10px;}
        .cont3-bg .productBox .threeBox .productContent .productDiv{border:2px solid #b1b1b1;width: 100%;height:100%;border-radius: 8px;}
        .cont3-bg .productBox .threeBox .productContent .productDiv:hover{border-color:#e60000;transition: all 0.3s ease;}
        .cont3-bg .productBox .threeBox .productContent .productDiv .goodsBox{border-top-left-radius:8px;border-top-right-radius:8px;background:#fff;padding:15px;}
        .cont3-bg .productBox .threeBox .productContent .infoBox{height: 155px;background: #b1b1b1;border-bottom-left-radius:5px;border-bottom-right-radius:5px;padding: 20px 15px 10px;}
        .cont3-bg .productBox .threeBox .productContent .infoBox .leftInfo{width: 70%;}
        .cont3-bg .productBox .threeBox .productContent .infoBox .gname{font-size:15px;color:#fff;display: -webkit-box;-webkit-box-orient: vertical; -webkit-line-clamp: 2;overflow: hidden;text-overflow: ellipsis;}
        .cont3-bg .productBox .threeBox .productContent .infoBox .rightInfo{width: 30%;background:url(/assets/d2eace91/images/newhome/price.png);background-size:100%;background-repeat: no-repeat;position:relative;}
        .cont3-bg .productBox .threeBox .productContent .infoBox .leftInfo .gData{margin-top:20px;}
        .cont3-bg .productBox .threeBox .productContent .infoBox .leftInfo .gData .gDataItem{text-align: center;margin:0 28px 0 10px;}
        .cont3-bg .productBox .threeBox .productContent .infoBox .leftInfo .gData .line{width:2px;height:32px;background:#fff;}
        .cont3-bg .productBox .threeBox .productContent .infoBox .leftInfo .gData .gDataItem .gDataNum{color:#fff;font-size:13px;}
        .cont3-bg .productBox .threeBox .productContent .infoBox .leftInfo .gData img{width:22px;}
        .cont3-bg .productBox .threeBox .productContent .infoBox .rightInfo .priceBuy{position:relative;height: 60px;}
        .cont3-bg .productBox .threeBox .productContent .infoBox .rightInfo .priceBuy .currency{position:absolute;top: 7px;left: 9px;color: #fff;font-size: 12px;font-weight: 600;}
        .cont3-bg .productBox .threeBox .productContent .infoBox .rightInfo .priceBuy .price{position:absolute;top: 26px;left: 50%;transform: translate(-43%, 0);color: #fff;font-size: 17px;font-weight: 600;}
        .cont3-bg .productBox .threeBox .productContent .infoBox .rightInfo .priceBuy .detail{position:absolute;bottom: 0px;left: 50%;transform: translate(-47%, 0);color: #fff;font-size: 11px;}
        /**热卖3**/
        .cont3-bg .productBox .fourBox{width: 100%;justify-content: space-between;margin-top:40px;padding: 0 5px;}
        .cont3-bg .productBox .fourBox .fourBoxContent{display: grid;grid-template-columns: repeat(2,1fr);-moz-column-gap: 0px;column-gap: 0px;row-gap: 20px; width: 100%;height: auto;justify-items: center;align-items: center;}
        .cont3-bg .productBox .fourBox .productContent{width: 385px;height:380px;/**background:#e2e2da;**/border-radius: 6px;box-shadow: 0px 0px 10px 1px #797777;padding:0px;margin-left:10px;}
        .cont3-bg .productBox .fourBox .productContent .productDiv{border:2px solid #1f5188;width: 100%;height:100%;border-radius: 8px;}
        .cont3-bg .productBox .fourBox .productContent .productDiv:hover{border-color:#e60000;transition: all 0.3s ease;}
        .cont3-bg .productBox .fourBox .productContent .productDiv .goodsBox{border-top-left-radius:8px;border-top-right-radius:8px;background:#fff;padding:15px;position:relative;}
        .cont3-bg .productBox .fourBox .productContent .infoBox{height: 106px;background: #1f5188;border-bottom-left-radius:5px;border-bottom-right-radius:5px;padding: 10px 15px;}
        .cont3-bg .productBox .fourBox .productContent .infoBox .leftInfo{width: 70%;border-right: 2px solid #fff;padding-right: 10px;margin-right: 10px;}
        .cont3-bg .productBox .fourBox .productContent .infoBox .gname{font-size:15px;color:#fff;display: -webkit-box;-webkit-box-orient: vertical; -webkit-line-clamp: 1;overflow: hidden;text-overflow: ellipsis;}
        .cont3-bg .productBox .fourBox .productContent .infoBox .rightInfo{width: 30%;background:url(/assets/d2eace91/images/newhome/price.png);background-size:100%;background-repeat: no-repeat;position:relative;}
        .cont3-bg .productBox .fourBox .productContent .infoBox .leftInfo .gData{margin-top:20px;}
        .cont3-bg .productBox .fourBox .productContent .infoBox .leftInfo .gData .gDataItem{text-align: center;margin:0 28px 0 10px;}
        .cont3-bg .productBox .fourBox .productContent .infoBox .leftInfo .gData .line{width:2px;height:32px;background:#fff;}
        .cont3-bg .productBox .fourBox .productContent .infoBox .leftInfo .gData .gDataItem .gDataNum{color:#fff;font-size:12px;}
        .cont3-bg .productBox .fourBox .productContent .infoBox .leftInfo .gData img{width:18px;}
        .cont3-bg .productBox .fourBox .productContent .infoBox .rightInfo .priceBuy{position:relative;height: 60px;cursor: pointer;}
        .cont3-bg .productBox .fourBox .productContent .infoBox .rightInfo .priceBuy .currency{position:absolute;top: -1px;left: 9px;color: #fff;font-size: 10px;font-weight: 600;}
        .cont3-bg .productBox .fourBox .productContent .infoBox .rightInfo .priceBuy .price{position:absolute;top: 24px;left: 50%;transform: translate(-43%, 0);color: #fff;font-size: 16px;font-weight: 600;}
        .cont3-bg .productBox .fourBox .productContent .infoBox .rightInfo .priceBuy .detail{position:absolute;bottom: -2px;left: 50%;transform: translate(-47%, 0);color: #e60000;font-size: 11px;text-shadow: -1px 0 #fff, 0 1px #fff, 1px 0 #fff, 0 -1px #fff;}
        .cont3-bg .productBox .fourBox .productContent .productDiv .cont3-2{overflow: hidden;}
        .cont3-bg .productBox .fourBox .productContent .productDiv .cont3-2 img{width:100%;height:240px;border:5px solid #dbd9d9;}
        .cont3-bg .productBox .fourBox .other_currency{position: absolute;left: 50%;bottom: -25px; transform:translate(-50%,0);}
        .cont3-bg .productBox .fourBox .other_currency .equal{font-size:15px;color:#fff;}
        .cont3-bg .productBox .fourBox .other_currency select{width:50px;}
        /**热卖4**/
        .cont3-bg .productBox .sixBox{width: 100%;justify-content: space-between;margin-top:40px;padding: 0 5px;}
        .cont3-bg .productBox .sixBox .sixBoxContent{display: grid;grid-template-columns: repeat(3,1fr);-moz-column-gap: 0px;column-gap: 0px;row-gap: 20px; width: 100%;height: auto;justify-items: center;align-items: center;}
        .cont3-bg .productBox .sixBox .productContent{width: 385px;height:380px;/**background:#e2e2da;**/border-radius: 6px;box-shadow: 0px 0px 10px 1px #797777;padding:0px;margin-left:0px;}
        .cont3-bg .productBox .sixBox .productContent .productDiv{border:2px solid #1f5188;width: 100%;height:100%;border-radius: 8px;}
        .cont3-bg .productBox .sixBox .productContent .productDiv:hover{border-color:#e60000;transition: all 0.3s ease;}
        .cont3-bg .productBox .sixBox .productContent .productDiv .goodsBox{border-top-left-radius:8px;border-top-right-radius:8px;background:#fff;padding:15px;position:relative;}
        .cont3-bg .productBox .sixBox .productContent .infoBox{height: 106px;background: #1f5188;border-bottom-left-radius:5px;border-bottom-right-radius:5px;padding: 10px 15px;}
        .cont3-bg .productBox .sixBox .productContent .infoBox .leftInfo{width: 70%;border-right: 2px solid #fff;padding-right: 10px;margin-right: 10px;}
        .cont3-bg .productBox .sixBox .productContent .infoBox .gname{font-size:15px;color:#fff;display: -webkit-box;-webkit-box-orient: vertical; -webkit-line-clamp: 1;overflow: hidden;text-overflow: ellipsis;}
        .cont3-bg .productBox .sixBox .productContent .infoBox .rightInfo{width: 30%;background:url(/assets/d2eace91/images/newhome/price.png);background-size:100%;background-repeat: no-repeat;position:relative;}
        .cont3-bg .productBox .sixBox .productContent .infoBox .leftInfo .gData{margin-top:20px;}
        .cont3-bg .productBox .sixBox .productContent .infoBox .leftInfo .gData .gDataItem{text-align: center;margin:0 28px 0 10px;}
        .cont3-bg .productBox .sixBox .productContent .infoBox .leftInfo .gData .line{width:2px;height:32px;background:#fff;}
        .cont3-bg .productBox .sixBox .productContent .infoBox .leftInfo .gData .gDataItem .gDataNum{color:#fff;font-size:12px;}
        .cont3-bg .productBox .sixBox .productContent .infoBox .leftInfo .gData img{width:18px;}
        .cont3-bg .productBox .sixBox .productContent .infoBox .rightInfo .priceBuy{position:relative;height: 60px;cursor: pointer;}
        .cont3-bg .productBox .sixBox .productContent .infoBox .rightInfo .priceBuy .currency{position:absolute;top: 0px;left: 9px;color: #fff;font-size: 10px;font-weight: 600;}
        .cont3-bg .productBox .sixBox .productContent .infoBox .rightInfo .priceBuy .price{position:absolute;top: 23px;left: 50%;transform: translate(-43%, 0);color: #fff;font-size: 16px;font-weight: 600;}
        .cont3-bg .productBox .sixBox .productContent .infoBox .rightInfo .priceBuy .detail{position:absolute;bottom: -2px;left: 50%;transform: translate(-47%, 0);color: #e60000;font-size: 11px; text-shadow: -1px 0 #fff, 0 1px #fff, 1px 0 #fff, 0 -1px #fff;}
        .cont3-bg .productBox .sixBox .productContent .productDiv .cont3-3{overflow: hidden;}
        .cont3-bg .productBox .sixBox .productContent .productDiv .cont3-3 img{width:100%;height:240px;border:5px solid #dbd9d9;}
        .cont3-bg .productBox .sixBox .other_currency{position: absolute;left: 50%;bottom: -25px; transform:translate(-50%,0);}
        .cont3-bg .productBox .sixBox .other_currency .equal{font-size:15px;color:#fff;}
        .cont3-bg .productBox .sixBox .other_currency select{width:50px;}
        .cont3-bg .productBox .sixBox .other_currency{position: absolute;left: 50%;bottom: -25px; transform:translate(-50%,0);}
        .cont3-bg .productBox .sixBox .other_currency .equal{font-size:15px;color:#fff;}
        .cont3-bg .productBox .sixBox .other_currency select{width:50px;}
        /**版式切换**/
        .cont3-bg .formatBox{justify-content: flex-end;/**margin-top:10px;**/position: absolute;right: 9%;top: 60%;z-index: 99;}
        .cont3-bg .formatBox .formatDiv{margin-right:10px;cursor:pointer;}
        .cont3-bg .formatBox .formatDiv img{width:45px;}
        .twoBox .swiper-pagination .swiper-pagination-bullet,.fourBox .swiper-pagination .swiper-pagination-bullet,.sixBox .swiper-pagination .swiper-pagination-bullet{width:12px;height:12px;}
        .twoBox .swiper-pagination,.fourBox .swiper-pagination,.sixBox .swiper-pagination{bottom:var(--swiper-pagination-bottom,4px) !important;}


        /**热搜**/
        .cont4-bg {z-index: 10;opacity: 1;position: relative;}
        .cont4-bg .headTxt{padding-top: 0px;font-size: 30px;justify-content: center;position: relative;}
        .cont4-bg .headTxt .actTxt {color: #e60000;font-weight: 800;}
        .cont4-bg .headTxt .norTxt {color: #1f5188;font-weight: 800;font-size: 24px;}
        .cont4-bg .headTxt .norTxt span{font-family:PingFang SC,Hiragino Sans GB,Heiti SC,Microsoft YaHei,Helvetica,Tahoma,Arial,SimHei,WenQuanYi Micro Hei !important;font-size: 30px;margin:0 10px;}
        /*.cont4-bg .headTxt:after {content: '';position: absolute;bottom: -10px;left: 46%;width: 95px;height: 3px;background: #1f5188;border-radius: 10px;}*/
        .cont4-bg .hs1{background:url(/assets/d2eace91/images/newhome/hotsearch1.png);background-size: 100% 100%;background-repeat: no-repeat;border: 2px solid #b1b1b1;border-radius: 8px;width: 795px;}
        .cont4-bg .hs2{background:url(/assets/d2eace91/images/newhome/hotsearch2.png);background-size: 100% 100%;background-repeat: no-repeat;border: 3px solid #fff;border-radius: 8px;width: 370px;}
        .cont4-bg .hsMask{width: 100%;height: 100%;position: absolute;background: #000;opacity:0.5;z-index: 8;border-radius: 6px;}
        .cont4-bg .headBox{margin-bottom:40px;}
        .cont4-bg .hsDiv{height:220px;position: relative;box-shadow: 0px 0px 8px 0px #797777;margin-right:30px;margin-bottom:15px;margin-top:8px;}
        .cont4-bg .hsDiv:hover{border-color:#1f5188;transition: all 0.3s ease;}
        .cont4-bg .hsDiv:hover .hsContent .title,.cont4-bg .hsDiv:hover .hsContent .desc{color:#fff;transition: all 0.3s ease;background:#1f5188;opacity:0.8;}
        .cont4-bg .hsDiv:hover>.hsMask{display: none;}
        .cont4-bg .hsDiv .hsContent{opacity: 1;color: #fff;z-index: 10;position:absolute;width: 100%;top: 50%;transform: translate(0, -50%);}
        .cont4-bg .hsDiv .hsContent .title{font-size:30px;font-weight:800;text-align: center;padding:10px 0;}
        .cont4-bg .hsDiv .hsContent .desc{font-size:15px;text-align: center;width: 80%;margin: 0 auto;}
        .cont4-bg .hsDiv .hsContent .moreBtn{width: 100%;text-align: center;margin-top: 10px;}
        .cont4-bg .hsDiv .hsContent .moreBtn a{color: #fff;font-size: 15px;background: #1f5188;padding: 4px 15px;border-radius: 15px;border: 2px solid #fff;}

        /**热议**/
        .cont5-bg {z-index: 10;opacity: 1;position: relative;background:#fff;}
        .cont5-bg .headTxt{padding-top: 0px;font-size: 30px;justify-content: center;position: relative;}
        .cont5-bg .headTxt .actTxt {color: #e60000;font-weight: 800;}
        .cont5-bg .headTxt .norTxt {color: #1f5188;font-weight: 800;font-size: 24px;}
        .cont5-bg .headTxt .norTxt span{font-family:PingFang SC,Hiragino Sans GB,Heiti SC,Microsoft YaHei,Helvetica,Tahoma,Arial,SimHei,WenQuanYi Micro Hei !important;font-size: 30px;margin:0 10px;}
        /*.cont5-bg .headTxt:after {content: '';position: absolute;bottom: -10px;left: 46%;width: 95px;height: 3px;background: #1f5188;border-radius: 10px;}*/
        .cont5-bg .hotDesc {color: #1f5188;font-size: 16px;margin-top:35px;text-align: center;font-weight:800;}
        .cont5-bg .hotContent {display: grid;grid-template-columns: repeat(3,1fr);-moz-column-gap: 50px;column-gap: 90px;row-gap: 40px;margin-top: 60px;}
        .cont5-bg .hotContent .hotDiv{height:649px;width: 335px;border:2px solid #b1b1b1;border-radius: 8px;box-shadow: 0px 0px 8px 0px #797777;cursor:pointer;}
        .cont5-bg .hotContent .hotDiv:hover{border-color:#e60000;transition: all 0.3s ease;}
        .cont5-bg .hotBox{overflow: hidden;}
        .cont5-bg .hotBox .cont5-next{right: var(--swiper-navigation-sides-offset, 250px);}
        .cont5-bg .hotBox .cont5-next:after{color: #fff;background: #e60000;padding: 10px 20px;border-radius: 35px;}
        .cont5-bg .hotBox .cont5-prev{left: var(--swiper-navigation-sides-offset, 250px);}
        .cont5-bg .hotBox .cont5-prev:after{color: #fff;background: #e60000;padding: 10px 20px;border-radius: 35px;}
        .cont5-bg .hotContent .hotDiv .infoDiv {/**padding: 15px 10px;**/padding-bottom:15px;}
        .cont5-bg .hotContent .hotDiv .infoDiv .avatar{margin-right:15px;}
        .cont5-bg .hotContent .hotDiv .infoDiv .avatar img{width:60px;border-radius: 50%;}
        .cont5-bg .hotContent .hotDiv .infoDiv .infoBox{width: 100%;}
        .cont5-bg .hotContent .hotDiv .infoContent{padding: 15px 10px;}
        .cont5-bg .hotContent .hotDiv .infoContent2{background: #1f5188;padding: 15px 10px;}
        .cont5-bg .hotContent .hotDiv .infoDiv .infoBox .infoLine{font-size:15px;color:#fff;font-weight:800;}
        .cont5-bg .hotContent .hotDiv .infoDesc{/**padding: 0 10px;**/font-size: 13px;color: #1f5188;font-weight: 800;background:#fff;padding: 5px 5px 3px;display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 2;overflow: hidden;text-overflow: ellipsis;height:55px;}
        .cont5-bg .hotContent .hotDiv .infoStar{padding: 0px 5px 9px;background:#fff;}
        .cont5-bg .hotContent .hotDiv .infoStar img{width: 110px;}
        .cont5-bg .hotContent .hotDiv .infoStar .rating {unicode-bidi: bidi-override;direction: rtl;text-align: left;}
        .cont5-bg .hotContent .hotDiv .infoStar .rating > span {display: inline-block;position: relative;color: gold;font-size:20px;}
        .cont5-bg .hotContent .hotDiv .infoStar .rating > span:before{content: "\2605";position: absolute;left: 0;color: gold;}
        /*.rating > span:hover, .rating > span:hover ~ span {color: transparent;}*/
        /*.rating > span:hover:before, .rating > span:hover ~ span:before {content: "\2605";position: absolute;left: 0;color: gold;}*/
        .cont5-bg .hotContent .hotDiv .infoPic{padding: 0 10px;overflow: hidden;}
        .cont5-bg .hotContent .hotDiv .infoPic .picDiv{padding:10px;background:#e2e2da;}
        .cont5-bg .hotContent .hotDiv .infoPic .cont5-1{overflow: hidden;position: relative;}
        .cont5-bg .hotContent .hotDiv .infoPic img{width:100%;height:215px;}
        .cont5-bg .hotContent .hotDiv .goodsBox{padding: 15px 10px;}
        .cont5-bg .hotContent .hotDiv .goodsBox .goodsDiv{background: #f0f0f0;padding:10px;box-shadow: 0px 0px 10px 4px #8f8f8f;border: 2px solid #1f5188;}
        .cont5-bg .hotContent .hotDiv .goodsBox .goodsDiv .goodsImg img{width: 70px;height:70px;}
        .cont5-bg .hotContent .hotDiv .goodsBox .goodsDiv .goodsImg{margin-right:10px;}
        .cont5-bg .hotContent .hotDiv .goodsBox .goodsDiv .goodsInfo .goodsTitle{color:#1f5188;font-size:15px;font-weight:800;display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 2;overflow: hidden;text-overflow: ellipsis;}
        .cont5-bg .hotContent .hotDiv .goodsBox .goodsDiv .goodsInfo .goodsPrice{font-size: 18px;color:#e60000;margin-top:5px;font-weight: 800;}
        .cont5-bg .hotContent .hotDiv .operaBox{background:#1f5188;border-top:1px solid #b1b1b1;padding: 7.5px;border-bottom-left-radius: 6px;border-bottom-right-radius: 6px;}
        .cont5-bg .hotContent .hotDiv .operaBox .operaDiv{width: 50%;justify-content: center;position: relative;}
        .cont5-bg .hotContent .hotDiv .operaBox .operaDiv1:after{content:'';position: absolute;right: 0;bottom: 1px;width: 1px;height: 18px;background: #fff;}
        .cont5-bg .hotContent .hotDiv .operaBox .operaDiv .icon{margin-right:5px;}
        .cont5-bg .hotContent .hotDiv .operaBox .operaDiv .icon img{width:25px;}
        .cont5-bg .hotContent .hotDiv .operaBox .operaDiv .word{font-size:15px;color:#fff;font-weight:800;}
        .cont5-bg .swiper-button-next, .cont5-bg .swiper-button-prev{top: var(--swiper-navigation-top-offset, 60%);}

        /**业务服务**/
        .cont6-bg {z-index: 10;opacity: 1;position: relative;}
        .cont6-bg .headTxt{padding-top: 0px;font-size: 30px;justify-content: center;position: relative;}
        .cont6-bg .headTxt .actTxt {color: #e60000;font-weight: 800;}
        .cont6-bg .headTxt .norTxt {color: #1f5188;font-weight: 800;font-size: 24px;}
        .cont6-bg .headTxt .norTxt span{font-family:PingFang SC,Hiragino Sans GB,Heiti SC,Microsoft YaHei,Helvetica,Tahoma,Arial,SimHei,WenQuanYi Micro Hei !important;font-size: 30px;margin:0 10px;}
        /*.cont6-bg .headTxt:after {content: '';position: absolute;bottom: -10px;left: 46%;width: 95px;height: 3px;background: #1f5188;border-radius: 10px;}*/
        .cont6-bg .serviceBox{width: 100%;margin-top:70px;}
        .cont6-bg .serviceBox .leftBox{width: 420px;height:578px;border:2px solid #b1b1b1;border-radius: 8px;box-shadow: 0px 0px 8px 0px #797777;margin-right:40px;}
        .cont6-bg .serviceBox .leftBox:hover{border-color:#1f5188;}
        .cont6-bg .serviceBox .leftBox .cont6{position: relative;width: 100%;height:100%;overflow: hidden;}
        .cont6-bg .serviceBox .leftBox .cont6 .serviceContent{background-size: 100%;background-repeat:no-repeat;width: 100%;height:100%;position: relative;cursor: pointer;border-radius: 6px;}
        .cont6-bg .serviceBox .leftBox .cont6 .searviceMask{position: absolute;top:0;left:0;background:#fff;z-index: 10;opacity: 0.7;width: 100%;height:100%;border-radius: 6px;display: none;}
        .cont6-bg .serviceBox .leftBox .cont6 .serviceContent .serviceDiv{z-index: 12;position: absolute;bottom:-45px;left:50%;transform:translate(-15%,-100%);width: 300px;margin:0 auto;}
        .cont6-bg .serviceBox .leftBox .cont6 .serviceContent .serviceDiv .serviceTitle{font-size:25px;font-weight: 800;color:#1f5188;}
        .cont6-bg .serviceBox .leftBox .cont6 .serviceContent .serviceDiv .serviceDesc{font-size:15px;font-weight: 800;display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 7;overflow: hidden;text-overflow: ellipsis;width: 100%;margin-top:15px;color:#1f5188;}
        /*.cont6-bg .serviceBox .leftBox .cont6 .serviceContent .serviceDiv .serviceIn{font-size: 15px;font-weight:800;padding:5px 20px;border:2px solid #1f5188;color:#ffffff;margin-top:15px;width: fit-content;border-radius:8px;background:#1f5188;}*/
        .cont6-bg .serviceBox .leftBox .cont6 .serviceContent .serviceDiv .serviceIn{font-weight:800;margin-top:15px;width: fit-content;color: #fff;font-size: 15px;background: #1f5188;padding: 4px 15px;border-radius: 15px;border: 2px solid #fff;}
        .cont6-bg .serviceBox .leftBox .cont6 .serviceContent .serviceDiv .serviceIn:hover{color:#fff;background:#e60000;}
        .cont6-bg .serviceBox .rightBox{width:740px;height:590px;overflow:hidden;}
        .cont6-bg .serviceBox .rightBox .serviceContent .swiper-slide{display: grid;grid-template-columns: repeat(2,1fr);-moz-column-gap: 40px;column-gap: 40px;row-gap: 30px;padding:5px;}
        .cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv{height:274px;border:2px solid #b1b1b1;border-radius: 8px;box-shadow: 0px 0px 8px 0px #797777;padding:22px 22px 22px 32px;background: #d1d0d0;position:relative;}
        .cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv .serviceImg{margin-right:20px;}
        .cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv .serviceImg img{width:150px;height:150px;border-radius: 8px;border: 2px solid #fff;box-shadow: 0px 0px 8px 0px #797977;}
        .cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv .serviceTitle{font-size:25px;font-weight: 800;color:#1f5188;margin-bottom:15px;text-align: center;}
        .cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv .serviceTxt .serviceDesc{font-size:15px;font-weight: 800;display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 8;overflow: hidden;text-overflow: ellipsis;width: 100%;margin-top:0px;color:#1f5188;}
        .cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv:hover{border-color:#1f5188;background:#1f5188;color:#fff;}
        .cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv:hover  .serviceTitle{color:#fff;}
        .cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv .serviceTxt .moreBtn{width: 100%;text-align: right;position:absolute;bottom: 10px;right: 5px;}
        .cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv .serviceTxt .moreBtn a:hover{background:#e60000;}
        .cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv .serviceTxt .moreBtn a{color:#fff;font-size: 15px;background: #1f5188;padding: 4px 15px;border-radius: 15px;border: 2px solid #fff;}
        .cont6-bg .serviceContent .guide_smlcontent{bottom: var(--swiper-pagination-bottom, 13%);left: var(--swiper-pagination-left, 50%);transform: translate(-38%, 0%);}
    </style>
    <link rel="stylesheet" href="/assets/d2eace91/css/swiper.min.css?v=1.2">
    {{--    <link rel="stylesheet" href="/assets/d2eace91/css/font-awesome.min.css?v=1.2">--}}
    <script src="/assets/d2eace91/js/jquery.js?v=1.1"></script>
    <script src="/assets/d2eace91/js/swiper.min.js?v=1.2"></script>
    <link rel="stylesheet" href="/assets/d2eace91/js/chosen/chosen.css?v=1.2"/>
    <script src="/assets/d2eace91/js/chosen/jquery.chosen.js?v=1.3"></script>
    <script type="text/javascript" charset="utf-8">
        var head= document.getElementsByTagName('head')[0]; var script= document.createElement('script'); script.type= 'text/javascript'; script.src= '//www.gogo198.cn/assets/d2eace91/js/res.zvo.cn_translate_inspector_v2.js?v=12<?php echo time();?>'; head.appendChild(script);
    </script>
</head>
<body>
<!--头部-->
@include('layouts.header')

<!--右侧滑动-->
@include('layouts.right_slide')

<!--右侧滑动(废弃)-->
<div class="right-content" style="display: none;">
    <div class="rightList">
        <div class="topArrow" onclick="topArrow('right',2)"></div>
        <div class="rightCont">
            <div class="rightItem rightItemActive" onclick="pageScroll(this,1)"><a href="javascript:void(0);">首页</a></div>
            <div class="rightLine"></div>
            <div class="rightItem" onclick="pageScroll(this,3)"><a href="javascript:void(0);">热卖</a></div>
            <div class="rightLine"></div>
            <div class="rightItem" onclick="pageScroll(this,4)"><a href="javascript:void(0);">热搜</a></div>
            <div class="rightLine"></div>
            <div class="rightItem" onclick="pageScroll(this,5)"><a href="javascript:void(0);">热议</a></div>
            <div class="rightLine"></div>
            <div class="rightItem" onclick="pageScroll(this,6)"><a href="javascript:void(0);">服务</a></div>
            <div class="rightLine"></div>
            <div class="rightItem" onclick="pageScroll(this,7,'footer')"><a href="javascript:void(0);">介绍</a></div>
        </div>
        <div class="btmArrow" onclick="btmArrow('right',2)"></div>
    </div>
</div>

<!--轮播图-->
<div class="cont1-bg fullscreen-section section">
    <div class="swiper-container cont1">
        <div class="swiper-wrapper">
            <style>
                /*.cont1 .swiper-slide{position:relative;}*/
                /*.cont1 img{width: 100%;height: 100%;object-fit: cover;object-position: center;position: absolute;top: 0;left: 0;}*/
            </style>
            @foreach($rotate as $k=>$v)
                <div class="swiper-slide">
                    <img src="//shop.gogo198.cn/{{$v['thumb']}}" alt="" @if($v['go_other']>0)
                    style="cursor: pointer;"
                         onclick="javascript:window.location.href='{{$v['link']}}';"
                            @endif>
                </div>
            @endforeach
        </div>
        <!-- 如果需要分页器 -->
        <div class="swiper-pagination rotate_page"></div>
    </div>

    <!--搜索-->
    <div class="cont2-bg searchBox" style="background: url(https://shop.gogo198.cn/{{$search['back_img']}}) top center no-repeat;">
        {{--            <div class="w1200">--}}
        <div class="disf" style="/**justify-content: space-around;**/">
            <div class="leftBox" style="margin-left:0px;width: 25%;">
                <div class="speed_nav">快速导航</div>
                <style>
                    .speed_nav{text-align: center;color: #fff;font-size: 20px;font-weight: 800;}
                    .featureBox{position: relative;}
                    .featureBox .btn_left {position: absolute;right: -50px;top: 15%;transform: rotate(90deg);}
                    .featureBox .contact_btn {width: 30px;height: 30px;line-height: 30px;text-align: center;color: #fff;background: #000;font-size: 30px;cursor: pointer;border-radius: 50%;display: none;}
                    .featureBox .contact_btn:hover{background:#e60000;}
                    .featureBox .btn_left:after {font-family: swiper-icons;font-size: 20px;font-weight:800;content:'prev';text-transform: none !important;letter-spacing: 0;font-variant: initial;}
                    .featureBox .btn_right:after {font-family: swiper-icons;font-size: 20px;font-weight:800;content:'next';text-transform: none !important;letter-spacing: 0;font-variant: initial;}
                    .featureBox .btn_right {position: absolute;right: -50px;top: 60%;transform: rotate(90deg);}
                    .featureBox .featureContent{position: relative;width: 100%;height: 160px;overflow: hidden;}
                    .feature-list {height: 160px;position: absolute;width: 100%;/**padding-top: 30px;**/white-space: nowrap;top: 0%;transition: .2s ease-in-out;}
                    .feature-list dl {width: 100%;/**display:inline-block;**/height: 120px;padding-top:20px;overflow-y:scroll;margin-top:20px;}
                    .feature-list dl:first-child{margin-top:0;}
                    dl, dt, li, ol, ul,dd {list-style-type: none !important;}
                    .feature-list dl dt {align-items: center;color: #fff;display: flex;margin-bottom: 8px;position: relative;cursor:pointer;padding-left:20px;}
                    .feature-list dl .show_process_open h3:after{content:"▲";position: absolute;right: -20px;top: 0;transform: rotate(180deg);font-size: 12px;}
                    .feature-list dl .show_process_close h3:after{content:"▲";position: absolute;right: -20px;top: 0;transform: rotate(0deg);font-size: 12px;}
                    /*.feature-list dl .show_process_open:before{content: "＋";height: 15px;margin-right: 20px;width: 15px;position: absolute;top: 0px;left: 0px;color: #fff;line-height: 15px;border: 1px solid #fff;cursor: pointer;}*/
                    /*.feature-list dl .show_process_close:before{content: "-";height: 15px;margin-right: 20px;width: 15px;position: absolute;top: 0px;left: 0px;font-size:30px;line-height: 10px;color: #fff;line-height: 15px;border: 1px solid #fff;cursor: pointer;}*/
                    .feature-list dl dt>span {background: #e60000;border-radius: 20px;height: 20px;margin-right: 10px;text-align: center;width: 20px;line-height: 20px;}
                    .feature-list dl dt h3 {font-weight: 100;font-size: 20px;}
                    .feature-list dl dt h3 {color: #fff;display: flex;font-size: 16px;line-height: 16px;position: relative;text-transform: uppercase;}
                    /*.feature-list dl:first-child h3:after {left: calc(100% + 27px);}*/
                    /*.feature-list dl dt h3:after {!**border-bottom: 1px dashed #fff;**!bottom: 0;content: "";height: 1px;left: calc(100% + 16px);margin: auto 0;position: absolute;top: 0;width: 115px;}*/
                    /*.feature-list dl dd {font-size: 14px;line-height: 24px;position: relative;padding-left:40px;}*/
                    /*.feature-list dd,.feature-list li {align-items: center;display: flex;}*/
                    .feature-list dl dd:before {margin-right: 6px;}
                    /*.feature-list dd:before, .feature-list li:before {content: "＋";height: 15px;margin-right: 20px;width: 15px;position: absolute;top: 4px;left: 20px;color: #fff;line-height: 15px;border: 1px solid #fff;cursor: pointer;}*/
                    .feature-list dl dd h4 {color: #fff;}
                    .feature-list dl dd h4 a{text-decoration: none;font-size:14px;}
                    .feature-list dl dd a {color: #fff;text-decoration: underline;transition: all .3s linear;}
                    .feature-list .feature_close{display: none;transition:all .3s ease;}
                    .feature-list .process_nav,.feature-list .process_nav2,.feature-list .process_nav_none{position: relative;font-size: 14px;line-height: 24px;position: relative;padding-left:80px;}
                    .feature-list .process_nav .process_nav, .feature-list .process_nav .process_nav2,.feature-list .process_nav2 .process_nav2,.feature-list .process_nav2 .process_nav{padding-left:20px;}
                    .feature-list .process_nav .process_nav:before, .feature-list .process_nav .process_nav2:before,.feature-list .process_nav2 .process_nav2:before,.feature-list .process_nav2 .process_nav:before{left:0px;}
                    .feature-list .process_nav:before{content: "＋";height: 15px;margin-right: 20px;width: 15px;position: absolute;top: 4px;left: 60px;color: #fff;line-height: 15px;border: 1px solid #fff;cursor: pointer;}
                    .feature-list .feature_open{display: block;}
                    .feature-list .process_nav2:before{content:"-";height: 15px;margin-right: 20px;width: 15px;position: absolute;top: 4px;left: 60px;color: #fff;font-size:30px;line-height: 10px;border: 1px solid #fff;cursor: pointer;}
                    .feature-list .dd_child{padding-left:20px;}
                    .feature-list .dd_child .feature_top{position: relative;}
                    .feature-list .dt_child_close{display:none;}
                    .feature-list .dt_child_open{display:block;}
                    .feature-list .dt_parent{margin-bottom:20px;}
                    /* 自定义滚动条轨道 */
                    .feature-list dl::-webkit-scrollbar {
                        width: 10px;
                        height: 10px;
                    }

                    .feature-list dl::-webkit-scrollbar-thumb {
                        background: linear-gradient(to bottom right, #1f5188 0%, #1f5188 100%);
                        border-radius: 5px;
                    }

                    .feature-list dl::-webkit-scrollbar-track {
                        background-color: #ddd;
                        border: 2px solid #fff;
                    }

                    .feature-list dl::-webkit-scrollbar-button {
                        background-color: #fff;
                        border-radius: 5px;
                    }

                    .feature-list dl::-webkit-scrollbar-button:hover {
                        background-color: #999999;
                    }
                </style>
                <div class="featureBox">
                    <div class="contact_btn btn_left" style="display: none;"></div>
                    <div class="contact_btn btn_right" style="display: none;"></div>
                    <div class="featureContent">
                        <div class="feature-list">
                            <dl>
                                @foreach($data['process'] as $k=>$v)
                                    <div class="dt_parent">
                                        <dt class="show_process_open" @if(!empty($v['children']))
                                        onclick="show_process(this)"
                                                @endif
                                        >
                                            <span>{{$k+1}}</span>
                                            <h3>{{$v['content']}}</h3>
                                        </dt>
                                        <div class="dt_child_close">
                                            @foreach($v['children'] as $k2=>$v2)
                                                <dd class="process_nav">
                                                    <div class="feature_top" @if(!empty($v2['children']))
                                                    onclick="process_nav(this)"
                                                            @endif><h4><a href="@if(!empty($v2['children']))
                                                                    javascript:void(0);
@else
                                                            {{$v2['link']}}
                                                            @endif" @if(empty($v2['children']))
                                                                          target="_blank"
                                                                    @endif>{{$v2['content']}}</a></h4>
                                                    </div>
                                                    @if(!empty($v2['children']))
                                                        <div class="dd_child">
                                                            <ul class="feature_close">
                                                                @foreach($v2['children'] as $k3=>$v3)
                                                                    <li class="process_nav">
                                                                        <div class="feature_top" @if(!empty($v3['children']))
                                                                        onclick="process_nav(this)"
                                                                                @endif><h4><a href="@if(!empty($v3['children']))
                                                                                        javascript:void(0);
@else
                                                                                {{$v3['link']}}
                                                                                @endif" @if(empty($v3['children']))
                                                                                              target="_blank"
                                                                                        @endif>{{$v3['content']}}</a></h4></div>
                                                                        @if(!empty($v3['children']))
                                                                            <div class="dd_child">
                                                                                <ul class="feature_close">
                                                                                    @foreach($v3['children'] as $k4=>$v4)
                                                                                        <li>
                                                                                            <h4><a href="@if(!empty($v4['children']))
                                                                                                        javascript:void(0);
@else
                                                                                                {{$v4['link']}}
                                                                                                @endif" @if(empty($v4['children']))
                                                                                                   target="_blank"
                                                                                                        @endif>{{$v4['content']}}</a></h4>
                                                                                        </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            </div>
                                                                        @endif
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
                                                </dd>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </dl>
                        </div>
                    </div>
                    <script>
                        //流程+ -
                        function show_process(t){
                            $(t).next().toggleClass('dt_child_open');
                            $(t).toggleClass('show_process_close');
                        }

                        function process_nav(t){
                            $(t).parent().toggleClass('process_nav2');
                            $(t).parent().find('.dd_child').eq(0).find('.feature_close').eq(0).toggleClass('feature_open');
                        }

                        //控制联系方式
                        var liW = $(".feature-list dl").height()+40;
                        //			获取li元素的长度(个数)
                        var len = $(".feature-list dl").length;
                        var idx = 0;
                        $(".featureBox .btn_left").click(function(){
                            idx --;  //索引自加
                            if(idx == -1){
                                idx = len - 1;
                            }
                            changeLi(idx);
                        });
                        $(".featureBox .btn_right").click(function(){
                            idx ++;  //索引自减
                            if(idx == len){
                                idx = 0;
                            }
                            changeLi(idx);
                        });
                        function changeLi(idx){
                            var move = -idx * liW;
                            $(".featureBox .feature-list").animate({"top":move},1);
                        }
                    </script>
                </div>
            </div>
            <div class="rightBox">
                <!--搜索栏-->
                <div class="leftCont1">{{$search['title']}}</div>
                <div class="leftCont1" style="font-size: 20px;font-weight: 100;">{{$search['desc']}}</div>
                <form action="">
                    <div class="selectBox" style="display: none;">
                        <select name="type">
                            @foreach($schFrame as $k=>$v)
                                <option value="{{$v['id']}}">{{$v['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="searchContent disf">
                        <div class="inputBox disf">
                            <div class="nameBox">
                                <input type="text" name="name" placeholder="{{$search['search_title']}}" id="searchInput">
                                <div class="placeholder-img" style="background: url(https://shop.gogo198.cn/{{$search['img']}}) no-repeat 2px;height: 100%;left: 300px;pointer-events: none;position: absolute;top: 1px;transition: all .3s linear;width: 40%;"></div>
                            </div>
                            <div class="btnBox" onclick="showWindows(21,2)">
                                <img src="/assets/d2eace91/images/newhome/search_icon.png">
                            </div>
                        </div>
                    </div>
                </form>
                <!--今日中国-->
                <div class="leftCont2" style="display: none;">
                    <div class="leftTxt">今日中国：</div>
                    <div class="rightTxt">
                        <style>
                            /*.leftCont2{margin-top:10px;padding-left: 60px;}*/
                            .leftTxt{color:#fff;display: inline-block;font-weight:800;font-size:15px;}
                            .rightTxt{display: inline-block;width: 420px;}
                            .news{height: 18px;overflow: hidden;width: 100%;}
                            .news .swiper-slide{text-overflow: ellipsis;white-space: nowrap;}
                            .news a{color:#fff;font-weight:800;line-height: 22px;}
                            .news a p{color:#fff;font-weight:800;line-height: 22px;width:100%;white-space: nowrap;text-overflow:ellipsis;overflow: hidden;font-size:15px;}
                        </style>
                        <div class="swiper-container news">
                            <div class="swiper-wrapper">
                                @foreach($news as $k=>$v)
                                    <div class="swiper-slide">
                                        <a href="/news_detail?id={{$v['id']}}" target="_blank"><p>{{$v['title']}}</p></a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="rightBox2">
                <div class="speed_nav">站内信息</div>
                <div class="leftCont2" style="padding: 10px 0 20px;height: 150px;">
                    {{--                            <div class="leftTxt">站内信息：</div>--}}
                    <style>
                        .station_news{overflow: hidden;height: 120px;}
                        .station_news a p {color: #fff;font-weight: 100;font-size:14px;line-height: 22px;width: 100%;white-space: nowrap;text-overflow: ellipsis;overflow: hidden;}
                        .slide-height{height:20px !important;}
                        .rightBox2{width:25%;}
                        .rightBox2 .rightTxt{width: 100%;}
                    </style>
                    <div class="rightTxt">
                        <div class="swiper-container station_news">
                            <div class="swiper-wrapper">
                                @foreach($data['msg'] as $k=>$v)
                                    <div class="swiper-slide slide-height">
                                        <a href="/msg_detail?id={{$v['id']}}" target="_blank"><p>{{$v['name']}}</p></a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--            </div>--}}
    </div>

    <!--今日中国+时间+站内信息-->
    <div class="news_box">
        {{--            <div class="w1200">--}}
        <div class="disf" style="justify-content: space-around;">
            <div class="leftCont2">
                <div class="leftTxt">今日中国：</div>
                <div class="rightTxt">
                    <div class="swiper-container news">
                        <div class="swiper-wrapper">
                            @foreach($news as $k=>$v)
                                <div class="swiper-slide">
                                    <a href="/news_detail?id={{$v['id']}}" target="_blank"><p>{{$v['title']}}</p></a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="time">
                <style>
                    .time span{font-size: 15px;}
                    .time #selectCity{width: 120px;font-size: 15px;border: 0;background: #fff;text-align: center;}
                    .time .chosen-container{width: 120px;}
                </style>
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
                            </span>&nbsp;<span class="beijing_date"><?php echo date('Y/m/d');?></span>&nbsp;<span class="beijing_sec"></span></div>
            </div>
            <div class="leftCont2">
                <div class="leftTxt">实时汇率：</div>
                <div class="rightTxt">
                    <style>
                        .news_box{background:#1f5188;border-top:1px solid #fff;height:6%;}
                        .leftCont2{margin-top:10px;padding-left: 0px;}
                        .leftTxt{color:#fff;display: inline-block;font-weight:100;}
                        .rightTxt{display: inline-block;max-width: 230px;}
                        .news{height: 18px;overflow: hidden;width: 100%;}
                        .news .swiper-slide{text-overflow: ellipsis;white-space: nowrap;}
                        .news a{color:#fff;font-weight:100;line-height: 22px;}
                        .news a p{color:#fff;font-weight:100;line-height: 22px;width:100%;white-space: nowrap;text-overflow:ellipsis;overflow: hidden;}
                        .news_box .time{margin:10px 18px 0;color:#fff;}
                    </style>
                    <div class="swiper-container news">
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
                <style>
                    .readNum{height: 18px;overflow: hidden;margin-top:10px;}
                    .readNum p{font-size:15px;color:#fff;line-height:19px;}
                </style>
                <div class="swiper-container readNum">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <p>昨天已有 ［{{$data['yesterday']}}］ 人次访问我们网站</p>
                        </div>
                        <div class="swiper-slide">
                            <p>本月累计 ［{{$data['this_month']}}］ 人次访问我们网站</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--            </div>--}}
    </div>
</div>

<!--内容版块-->
<div class="diyBackground" style="background: unset;">
    <div class="backgroundMask" style="display: none;"></div>
@foreach($data['guide'] as $key=>$val)
    @if($val['content_id']==1)
        <!--商品展示板块-->
            <div class="cont3-bg fullscreen-section2 section" style="@if($val['back_type']==1)
                    background:{{$val['back_content']}};
            @elseif($val['back_type']==2)
                    background:url(https://shop.gogo198.cn/{{$val['back_content']}});background-size: 100%;background-repeat: no-repeat;
            @endif">
                <div class="w1200">
                    <div class="headBox disf">
                        <div class="headTxt disf">
                            <div class="actTxt">{{$val['title']}}</div>
                            <div class="norTxt"><span>·</span>{{$val['desc']}}</div>
                        </div>
                        <div class="more" style="display:@if(empty($val['link']))
                                none
                        @else
                                block
                        @endif;">
                            <div class="moreBtn"><a href="{{$val['link']}}" target="_blank">更多&gt;</a></div>
                        </div>
                    </div>
                    <!--版式样式-->
                    <div class="productBox">
                        <div class="twoDivs">
                            <div class="swiper-container cont3">
                                <div class="swiper-wrapper">
                                    @foreach($val['two_children'] as $k=>$v)
                                        <div class="swiper-slide">
                                            <!--版式二-->
                                            <div class="twoBox disf">
                                                @foreach($v as $k2=>$v2)
                                                    <div class="productContent">
                                                        <div class="productDiv">
                                                            <!--商品轮播-->
                                                            <div class="goodsBox">
                                                                <div class="swiper-container cont3-1">
                                                                    <div class="swiper-wrapper">
                                                                        @foreach($v2['mainItemImgs'] as $k3=>$v3)
                                                                            <div class="swiper-slide">
                                                                                <img src="{{$v3['path']}}" alt="">
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                    <div class="swiper-pagination page_2"></div>
                                                                </div>
                                                            </div>
                                                            <!--商品信息-->
                                                            <div class="infoBox">
                                                                <div class="disf" style="align-items: center;">
                                                                    <div class="leftInfo">
                                                                        <div class="gname">{{$v2['goods_name']}}</div>
                                                                        <div class="gData disf">
                                                                            <div class="gDataItem">
                                                                                <img src="/assets/d2eace91/images/newhome/data1.png" alt="">
                                                                                <div class="gDataNum">{{$v2['click_count']}}</div>
                                                                            </div>
                                                                            <div class="line"></div>
                                                                            <div class="gDataItem">
                                                                                <img src="/assets/d2eace91/images/newhome/data2.png" alt="">
                                                                                <div class="gDataNum">{{$v2['star_count']}}</div>
                                                                            </div>
                                                                            <div class="line"></div>
                                                                            <div class="gDataItem">
                                                                                <img src="/assets/d2eace91/images/newhome/data3.png" alt="">
                                                                                <div class="gDataNum">{{$v2['share_count']}}</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="rightInfo">
                                                                        <a href="/goods-{{$v2['goods_id']}}.html" target="_blank">
                                                                            <div class="priceBuy">
                                                                                <div class="currency">CNY</div>
                                                                                <div class="price">{{$v2['goods_price']}}</div>
                                                                            </div>
                                                                            <div class="other_currency">
                                                                                <div class="disf">
                                                                                    <span class="equal" style="display: none;">≈&nbsp;USD&nbsp;9999.99</span>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <!--版式三（废弃）-->
                                            <div class="threeBox">
                                                <div class="disf">

                                                    <div class="productContent">
                                                        <div class="productDiv">
                                                            <!--商品轮播-->
                                                            <div class="goodsBox">
                                                                <div class="swiper-container cont3-1">
                                                                    <div class="swiper-wrapper">
                                                                        <div class="swiper-slide">
                                                                            <img src="" alt="">
                                                                        </div>
                                                                        <div class="swiper-slide">
                                                                            <img src="" alt="">
                                                                        </div>
                                                                        <div class="swiper-slide">
                                                                            <img src="" alt="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="swiper-pagination"></div>
                                                                </div>
                                                            </div>
                                                            <!--商品信息-->
                                                            <div class="infoBox">
                                                                <div class="disf">
                                                                    <div class="leftInfo">
                                                                        <div class="gname">五芳斋豆沙青团糯米糍蛋黄肉松麻薯雪眉娘糕点艾草青团子清明果</div>
                                                                        <div class="gData disf">
                                                                            <div class="gDataItem">
                                                                                <img src="/assets/d2eace91/images/newhome/data1.png" alt="">
                                                                                <div class="gDataNum">{{$v2['click_count']}}</div>
                                                                            </div>
                                                                            <div class="line"></div>
                                                                            <div class="gDataItem">
                                                                                <img src="/assets/d2eace91/images/newhome/data2.png" alt="">
                                                                                <div class="gDataNum">{{$v2['star_count']}}</div>
                                                                            </div>
                                                                            <div class="line"></div>
                                                                            <div class="gDataItem">
                                                                                <img src="/assets/d2eace91/images/newhome/data3.png" alt="">
                                                                                <div class="gDataNum">{{$v2['share_count']}}</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="rightInfo">
                                                                        <div class="priceBuy">
                                                                            <div class="currency">CNY</div>
                                                                            <div class="price">9999.99</div>
                                                                            <div class="detail">Buy</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="swiper-button-next cont3-next"></div>
                                <div class="swiper-button-prev cont3-prev"></div>
                            </div>
                        </div>

                        <div class="fourDivs" style="display: none;">
                            <div class="swiper-container cont3-4D">
                                <div class="swiper-wrapper">
                                    <!--版式四-->
                                    @foreach($val['for_children'] as $k=>$v)
                                        <div class="swiper-slide fourDivs">
                                            <div class="fourBox">
                                                <div class="fourBoxContent">
                                                    @foreach($v as $k2=>$v2)
                                                        <div class="productContent">
                                                            <div class="productDiv">
                                                                <!--商品轮播-->
                                                                <div class="goodsBox">
                                                                    <div class="swiper-container cont3-2">
                                                                        <div class="swiper-wrapper">
                                                                            @foreach($v2['mainItemImgs'] as $k3=>$v3)
                                                                                <div class="swiper-slide">
                                                                                    <img src="{{$v3['path']}}" alt="">
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                        <div class="swiper-pagination page_4"></div>
                                                                    </div>
                                                                </div>
                                                                <!--商品信息-->
                                                                <div class="infoBox">
                                                                    <div class="disf" style="align-items: center;">
                                                                        <div class="leftInfo">
                                                                            <div class="gname">{{$v2['goods_name']}}</div>
                                                                            <div class="gData disf">
                                                                                <div class="gDataItem">
                                                                                    <img src="/assets/d2eace91/images/newhome/data1.png" alt="">
                                                                                    <div class="gDataNum">{{$v2['click_count']}}</div>
                                                                                </div>
                                                                                <div class="line"></div>
                                                                                <div class="gDataItem">
                                                                                    <img src="/assets/d2eace91/images/newhome/data2.png" alt="">
                                                                                    <div class="gDataNum">{{$v2['star_count']}}</div>
                                                                                </div>
                                                                                <div class="line"></div>
                                                                                <div class="gDataItem">
                                                                                    <img src="/assets/d2eace91/images/newhome/data3.png" alt="">
                                                                                    <div class="gDataNum">{{$v2['share_count']}}</div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="rightInfo">
                                                                            <a href="/goods-{{$v2['goods_id']}}.html" target="_blank">
                                                                                <div class="priceBuy">
                                                                                    <div class="currency">CNY</div>
                                                                                    <div class="price">{{$v2['goods_price']}}</div>
                                                                                    <div class="other_currency">
                                                                                        <div class="disf">
                                                                                            <span class="equal" style="display: none;">≈&nbsp;USD&nbsp;9999.99</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="swiper-button-next cont3-4D-next"></div>
                                <div class="swiper-button-prev cont3-4D-prev"></div>
                            </div>
                        </div>

                        <div class="sixDivs" style="display: none;">
                            <div class="swiper-container cont3-6D">
                                <div class="swiper-wrapper">
                                    <!--版式六-->
                                    @foreach($val['six_children'] as $k=>$v)
                                        <div class="swiper-slide sixDivs">
                                            <div class="sixBox">
                                                <div class="sixBoxContent">
                                                    @foreach($v as $k2=>$v2)
                                                        <div class="productContent">
                                                            <div class="productDiv">
                                                                <!--商品轮播-->
                                                                <div class="goodsBox">
                                                                    <div class="swiper-container cont3-3">
                                                                        <div class="swiper-wrapper">
                                                                            @foreach($v2['mainItemImgs'] as $k3=>$v3)
                                                                                <div class="swiper-slide">
                                                                                    <img src="{{$v3['path']}}" alt="">
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                        <div class="swiper-pagination page_6"></div>
                                                                    </div>
                                                                </div>
                                                                <!--商品信息-->
                                                                <div class="infoBox">
                                                                    <div class="disf" style="align-items: center;">
                                                                        <div class="leftInfo">
                                                                            <div class="gname">{{$v2['goods_name']}}</div>
                                                                            <div class="gData disf">
                                                                                <div class="gDataItem">
                                                                                    <img src="/assets/d2eace91/images/newhome/data1.png" alt="">
                                                                                    <div class="gDataNum">{{$v2['click_count']}}</div>
                                                                                </div>
                                                                                <div class="line"></div>
                                                                                <div class="gDataItem">
                                                                                    <img src="/assets/d2eace91/images/newhome/data2.png" alt="">
                                                                                    <div class="gDataNum">{{$v2['star_count']}}</div>
                                                                                </div>
                                                                                <div class="line"></div>
                                                                                <div class="gDataItem">
                                                                                    <img src="/assets/d2eace91/images/newhome/data3.png" alt="">
                                                                                    <div class="gDataNum">{{$v2['share_count']}}</div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="rightInfo">
                                                                            <a href="/goods-{{$v2['goods_id']}}.html" target="_blank">
                                                                                <div class="priceBuy">
                                                                                    <div class="currency">CNY</div>
                                                                                    <div class="price">{{$v2['goods_price']}}</div>
                                                                                    <div class="other_currency">
                                                                                        <div class="disf">
                                                                                            <span class="equal" style="display: none;">≈&nbsp;USD&nbsp;9999.99</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="swiper-button-next cont3-6D-next"></div>
                                <div class="swiper-button-prev cont3-6D-prev"></div>
                            </div>
                        </div>
                    </div>
                    <!--版式选择-->
                    <div class="formatBox disf">
                        <div class="formatDiv twoFormat" onclick="changeFormat(1,this)">
                            <img src="/assets/d2eace91/images/newhome/format1-act.png" alt="">
                        </div>
                        <div class="formatDiv" onclick="changeFormat(2,this)" style="display: none;">
                            <img src="/assets/d2eace91/images/newhome/format2.png" alt="">
                        </div>
                        <div class="formatDiv fourFormat" onclick="changeFormat(3,this)">
                            <img src="/assets/d2eace91/images/newhome/format3.png" alt="">
                        </div>
                        <div class="formatDiv sixFormat" onclick="changeFormat(4,this)">
                            <img src="/assets/d2eace91/images/newhome/format4.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
    @elseif($val['content_id']==2)
        <!--卡片展示【小卡片】-->
            <div class="cont4-bg fullscreen-section3 section" style="@if($val['back_type']==1)
                    background:{{$val['back_content']}};
            @elseif($val['back_type']==2)
                    background:url(https://shop.gogo198.cn/{{$val['back_content']}});background-size: 100%;background-repeat: no-repeat;
            @endif">
                <div class="w1200" style="height:100%;">
                    <div class="headBox disf">
                        <div class="headTxt disf">
                            <div class="actTxt">{{$val['title']}}</div>
                            <div class="norTxt"><span>·</span>{{$val['desc']}}</div>
                        </div>
                        <div class="more" style="display:@if(empty($val['link']))
                                none
                        @else
                                block
                        @endif;">
                            <div class="moreBtn"><a href="{{$val['link']}}" target="_blank">更多&gt;</a></div>
                        </div>
                    </div>

                    <div class="hsContent" style="height: 80%;overflow: hidden;">
                        <div class="swiper-container guide{{$key}}_content">
                            <div class="swiper-wrapper">
                                @foreach($val['children'] as $k=>$v)
                                    <div class="swiper-slide">
                                        @foreach($v as $k2=>$v2)
                                            <div class="hsBox disf">
                                                @foreach($v2 as $k3=>$v3)
                                                    <div class="hs2 hsDiv" style="background:@if($v3['back_type']==1)
                                                    {{$v3['back_content']}}
                                                    @elseif($v3['back_type']==2)
                                                            url(https://shop.gogo198.cn/{{$v3['back_content']}})
                                                    @endif
                                                            ;">
                                                        <div class="hsMask"></div>
                                                        <div class="hsContent">
                                                            <div class="title">{{$v3['name']}}</div>
                                                            <div class="desc" title="{{$v3['desc']}}" style="display:none;">{{$v3['desc']}}</div>
                                                            <div class="moreBtn"><a href="@if($v3['go_other']>0)
                                                                {{$v3['link2']}}
                                                                @else
                                                                        /goods_list?frame_id=2&hotsearchId={{$v3['id']}}
                                                                @endif" target="_blank">更多&gt;</a></div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-pagination guide_smlcontent{{$key}} guide_smlcontent"></div>
                        </div>
                    </div>
                </div>
            </div>
    @elseif($val['content_id']==3)
        <!--评价板块展示-->
            <div class="cont5-bg fullscreen-section3 section" style="display:none;@if($val['back_type']==1)
                    background:{{$val['back_content']}};
            @elseif($val['back_type']==2)
                    background:url(https://shop.gogo198.cn/{{$val['back_content']}});background-size: 100%;background-repeat: no-repeat;
            @endif">
                <div class="w1200">
                    <div class="headBox disf">
                        <div class="headTxt disf">
                            <div class="actTxt">{{$val['title']}}</div>
                            <div class="norTxt"><span>·</span>{{$val['desc']}}</div>
                        </div>
                        <div class="more" style="display:@if(empty($val['link']))
                                none
                        @else
                                block
                        @endif;">
                            <div class="moreBtn"><a href="{{$val['link']}}" target="_blank">更多&gt;</a></div>
                        </div>
                    </div>
                    <div class="hotBox">
                        <div class="swiper-container cont5">
                            <div class="swiper-wrapper">
                                @foreach($val['children'] as $k=>$v)
                                    <div class="swiper-slide">
                                        <div class="hotContent">
                                            @foreach($v as $k2=>$v2)
                                                <div class="hotDiv">
                                                    <div class="infoContent">
                                                        <div class="infoContent2">
                                                            <div class="infoDiv disf">
                                                                <div class="avatar">
                                                                    <img src="//api.gogo198.cn/images/site/1/images/2024/03/04/17095225787143.png" alt="">
                                                                </div>
                                                                <div class="infoBox">
                                                                    <div class="infoLine">用户名称：{{$v2['name']}}</div>
                                                                    <div class="infoLine">#{{$v2['country']}}</div>
                                                                    <div class="infoLine">#{{$v2['line']}}</div>
                                                                </div>
                                                            </div>
                                                            <div class="infoDesc">{{$v2['comment']}}</div>
                                                            {{--                                                <div class="infoStar"><img src="/assets/d2eace91/images/newhome/star.png" alt=""></div>--}}

                                                            <div class="infoStar">
                                                                <div class="rating">
                                                                    <span>☆</span>
                                                                    <span>☆</span>
                                                                    <span>☆</span>
                                                                    <span>☆</span>
                                                                    <span>☆</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="infoPic">
                                                        <div class="picDiv">
                                                            <div class="swiper-container cont5-1">
                                                                <div class="swiper-wrapper">
                                                                    @foreach($v2['photo'] as $k3=>$v3)
                                                                        <div class="swiper-slide">
                                                                            <img src="{{$v3}}" alt="">
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                                <div class="swiper-pagination"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="goodsBox">
                                                        <div class="goodsDiv disf">
                                                            <div class="goodsImg"><img src="{{$v2['goods']['img']}}" alt=""></div>
                                                            <div class="goodsInfo">
                                                                <div class="goodsTitle">{{$v2['goods']['name']}}</div>
                                                                <div class="goodsPrice">CNY {{$v2['goods']['price']}}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="operaBox">
                                                        <div class="disf">
                                                            <div class="operaDiv disf operaDiv1" onclick="window.location.href='/goods-{{$v2['id']}}.html'">
                                                                <div class="icon">
                                                                    <img src="/assets/d2eace91/images/newhome/cart.png" alt="" style="width:25px;">
                                                                </div>
                                                                <div class="word">加购</div>
                                                            </div>
                                                            <div class="operaDiv disf">
                                                                <div class="icon">
                                                                    <img src="/assets/d2eace91/images/newhome/comment.png" alt="">
                                                                </div>
                                                                <div class="word">评论</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-button-next cont5-next"></div>
                            <div class="swiper-button-prev cont5-prev"></div>
                        </div>
                    </div>
                </div>
            </div>
    @elseif($val['content_id']==4)
        <!--卡片展示【大卡片+小卡片】-->
            <div class="cont6-bg fullscreen-section3 section" style="@if($val['back_type']==1)
                    background:{{$val['back_content']}};
            @elseif($val['back_type']==2)
                    background:url(https://shop.gogo198.cn/{{$val['back_content']}});background-size: 100%;background-repeat: no-repeat;
            @endif">
                <div class="w1200" style="height:100%;">
                    <div class="headBox disf">
                        <div class="headTxt disf">
                            <div class="actTxt">{{$val['title']}}</div>
                            <div class="norTxt"><span>·</span>{{$val['desc']}}</div>
                        </div>
                        <div class="more" style="display:@if(empty($val['link']))
                                none
                        @else
                                block
                        @endif;">
                            <div class="moreBtn"><a href="{{$val['link']}}" target="_blank">更多&gt;</a></div>
                        </div>
                    </div>
                    <div class="serviceBox disf">
                        <div class="leftBox">
                            <div class="swiper-container cont6 guide{{$key}}">
                                <div class="swiper-wrapper">
                                    @foreach($val['big_children'] as $k=>$v)
                                        <div class="swiper-slide">
                                            <div class="searviceMask"></div>
                                            <div class="serviceContent" style="background:url(https://shop.gogo198.cn/{{$v['back_content']}});background-size: 100% 100%;">
                                                <div class="serviceDiv">
                                                    <div class="serviceTitle" style="display: none;">{{$v['name']}}</div>
                                                    <div class="serviceDesc" style="display: none;" title="{{$v['desc']}}">{{$v['desc']}}</div>
                                                    <div class="serviceIn"><a href="@if(!empty($v['link2']))
                                                        {{$v['link2']}}
                                                        @endif" target="_blank" style="color:#fff;">更多&gt;</a></div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="swiper-pagination guide_bigcontent{{$key}}"></div>
                            </div>
                        </div>
                        <div class="rightBox">
                            <div class="serviceContent">
                                <div class="swiper-container guide{{$key}}_content">
                                    <div class="swiper-wrapper">
                                        @foreach($val['sml_children'] as $k=>$v)
                                            <div class="swiper-slide">
                                                @foreach($v as $k2=>$v2)
                                                    <div class="serviceDiv">
                                                        <div class="disf">
                                                            <div class="serviceImg">
                                                                <div class="serviceTitle">{{$v2['name']}}</div>

                                                                <img src="https://shop.gogo198.cn/{{$v2['back_content']}}" alt="">
                                                            </div>
                                                            <div class="serviceTxt">
                                                                <div class="serviceDesc" title="{{$v2['desc']}}">{{$v2['desc']}}</div>
                                                                <div class="moreBtn"><a href="/goods_list?frame_id=2&hotsearchId={{$v2['id']}}" target="_blank">更多&gt;</a></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="swiper-pagination guide_smlcontent{{$key}} guide_smlcontent"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="aboutmeBox">
                        <style>
                            .aboutmeBox{border-top: 2px solid #1f5188;margin-top: 10px;padding-top: 10px;max-height: 20%;overflow-y: auto;display:none;}
                            .aboutmeBox p{font-size:15px;}
                        </style>
                        {!! $val['introduce'] !!}
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>

<!--页脚介绍-->
@include('layouts.footer')
</body>
<!-- 加载Layer插件 -->
<script src="/assets/d2eace91/js/layer/layer.js?v=1.2"></script>
<script src="/assets/d2eace91/js/jquery.method.js?v=1.2"></script>
<script src="/assets/d2eace91/js/jquery.modal.js?v=1.2"></script>
<script src="/assets/d2eace91/js/jquery.widget.js?v=<?php echo time();?>"></script>

<link rel="stylesheet" href="/assets/d2eace91/layui/css/layui.css?v=23121"/>
<link rel="stylesheet" href="/assets/d2eace91/iconfont/iconfont.css?v=1.1"/>
<link rel="stylesheet" href="/css/common.css?v=1.1"/>
<link rel="stylesheet" href="/assets/d2eace91/js/layer/theme/default/layer.css?v=3.1.0" id="layuicss-layer">
<script type="text/javascript" src="/assets/d2eace91/layui/layui.js"></script>


<script>
    $('.city-select').chosen();
    //轮播图
    var cont1 = new Swiper ('.cont1', {
        loop: true,
        autoplay:{
            delay:5000,
            disableOnInteraction:false,
        },
        // 如果需要分页器
        pagination: {
            el: '.rotate_page',
            type: 'bullets', // 设置为bullets类型
            clickable: true, // 允许点击点切换轮播
        },

        // 如果需要前进后退按钮
        // nextButton: '.swiper-button-next',
        // prevButton: '.swiper-button-prev',

        // 如果需要滚动条
        // scrollbar: '.swiper-scrollbar',
    });

    //产品轮播
    var cont3 = new Swiper ('.cont3', {
        loop: true,
        autoplay:{
            delay:15000,
            disableOnInteraction:false,
        },
        navigation: {
            nextEl: '.cont3-next', // 设置下一个按钮的类名或选择器
            prevEl: '.cont3-prev', // 设置上一个按钮的类名或选择器
        },
    });
    var cont3_4D = new Swiper ('.cont3-4D', {
        loop: true,
        autoplay:{
            delay:15000,
            disableOnInteraction:false,
        },
        navigation: {
            nextEl: '.cont3-4D-next', // 设置下一个按钮的类名或选择器
            prevEl: '.cont3-4D-prev', // 设置上一个按钮的类名或选择器
        },
    });
    var cont3_6D = new Swiper ('.cont3-6D', {
        loop: true,
        autoplay:{
            delay:15000,
            disableOnInteraction:false,
        },
        navigation: {
            nextEl: '.cont3-6D-next', // 设置下一个按钮的类名或选择器
            prevEl: '.cont3-6D-prev', // 设置上一个按钮的类名或选择器
        },
    });
    var cont3_1 = new Swiper ('.cont3-1', {
        loop: false,
        autoplay:{
            delay:3000,
            disableOnInteraction:false,
        },
        pagination: {
            el: '.page_2',
            type: 'bullets', // 设置为bullets类型
            clickable: true, // 允许点击点切换轮播
        },
        effect:'fade'
    });
    var cont3_2 = new Swiper ('.cont3-2', {
        loop: false,
        autoplay:{
            delay:300000000,
            disableOnInteraction:false,
        },
        pagination: {
            el: '.page_4',
            type: 'bullets', // 设置为bullets类型
            clickable: true, // 允许点击点切换轮播
        },
    });
    var cont3_3 = new Swiper ('.cont3-3', {
        loop: false,
        autoplay:{
            delay:300000000,
            disableOnInteraction:false,
        },
        pagination: {
            el: '.page_6',
            type: 'bullets', // 设置为bullets类型
            clickable: true, // 允许点击点切换轮播
        },
    });

    //热议
    var cont5 = new Swiper ('.cont5', {
        loop: true,
        autoplay:{
            delay:15000,
            disableOnInteraction:false,
        },
        navigation: {
            nextEl: '.cont5-next', // 设置下一个按钮的类名或选择器
            prevEl: '.cont5-prev', // 设置上一个按钮的类名或选择器
        },
    });
    var cont5_1 = new Swiper ('.cont5-1', {
        loop: false,
        autoplay:{
            delay:30000000,
            disableOnInteraction:false,
        },
        pagination: {
            el: '.swiper-pagination',
            type: 'bullets', // 设置为bullets类型
            clickable: true, // 允许点击点切换轮播
        },
    });

    @foreach($data['guide'] as $key=>$val)
    @if($val['content_id']==2)
    new Swiper ('.guide{{$key}}_content', {
        loop: true,
        autoplay:{
            delay:10000,
            disableOnInteraction:false,
        },
        pagination: {
            el: '.guide_smlcontent{{$key}}',
            type: 'bullets', // 设置为bullets类型
            clickable: true, // 允许点击点切换轮播
        },
    });
    @elseif($val['content_id']==4)
    new Swiper ('.guide{{$key}}', {
        loop: true,
        autoplay:{
            delay:300000000,
            disableOnInteraction:false,
        },
        pagination: {
            el: '.guide_bigcontent{{$key}}',
            type: 'bullets', // 设置为bullets类型
            clickable: true, // 允许点击点切换轮播
        },
    });

    @foreach($val as $k2=>$v2)
    new Swiper ('.guide{{$key}}_content', {
        loop: true,
        autoplay:{
            delay:10000,
            disableOnInteraction:false,
        },
        pagination: {
            el: '.guide_smlcontent{{$key}}',
            type: 'bullets', // 设置为bullets类型
            clickable: true, // 允许点击点切换轮播
        },
    });
    @endforeach
    @endif
    @endforeach

    //弹框新闻
    var cont7 = new Swiper ('.cont7', {
        loop: true,
        direction:'vertical',
        spaceBetween:0,
        autoplay:{
            delay:3000,
            disableOnInteraction:false,
        },
    });

    //新闻
    var news = new Swiper ('.news', {
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

    window.addEventListener('load', function() {
        var images = document.getElementsByClassName('carousel-image');
        if(typeof(images[0])!='undefined'){
            var minHeight = images[0].height;

            for (var i = 0; i < images.length; i++) {
                if (images[i].height < minHeight) {
                    minHeight = images[i].height;
                }
            }
            var container = document.getElementById('carousel-container');
            container.style.height = minHeight + 'px';
        }
    });
    var auto_time = '';
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
        setInterval(update, 1000);
    }

    // var leftContentHeight = 0;
    // var rightContentHeight = 0;
    $(document).ready(function() {
        //获取北京时间
        auto_time = setInterval(function getTime(){
            // 创建一个 Date 对象
            var date = new Date();

            // 使用 toLocaleString() 方法将 Date 对象转换为所需的格式
            var formatted_date = date.toLocaleString('en-US', { year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true });
            formatted_date = formatted_date.split(', ');
            $('.beijing-time .beijing_sec').html(formatted_date[1]);
        },1000);


        //占满屏判断
        function setFullScreenSectionHeight() {
            var windowHeight = $(window).height();
            $('.fullscreen-section').height(windowHeight-86);
            $('.fullscreen-section2').height(windowHeight+50);
            $('.fullscreen-section3').height(windowHeight);
        }

        setFullScreenSectionHeight();

        $(window).resize(function() {
            setFullScreenSectionHeight();
        });

        //业务服务鼠标移入移出动画
        $('.cont6-bg .serviceBox .rightBox .serviceContent .serviceDiv').hover(function(){
            $(this).find('.serviceTxt .serviceTitle').css('color','#fff');
            $(this).find('.serviceTxt .serviceDesc').css('color','#fff');
        },function () {
            $(this).find('.serviceTxt .serviceTitle').css('color','#1f5188');
            $(this).find('.serviceTxt .serviceDesc').css('color','#1f5188');
        });

        // //左侧浮动框高度
        // let leftItemHeight = Math.round($('.left-content .leftItem').length * $('.left-content .leftItem').eq(0).outerHeight() * 100) / 100;
        // let leftLineHeight = Math.round(($('.left-content .leftLine').length * $('.left-content .leftLine').eq(0).outerHeight()) + ($('.left-content .leftLine').length * 18) * 100) / 100;
        // leftContentHeight = Math.floor(Math.round((leftItemHeight + leftLineHeight) * 100) /100);
        //
        // //右侧浮动框高度
        // let rightItemHeight = Math.round($('.right-content .rightItem').length * $('.right-content .rightItem').eq(0).outerHeight() * 100) / 100;
        // let rightLineHeight = Math.round(($('.right-content .rightLine').length * $('.right-content .rightLine').eq(0).outerHeight()) + ($('.right-content .rightLine').length * 18) * 100) / 100;
        // rightContentHeight = Math.floor(Math.round((rightItemHeight + rightLineHeight) * 100) /100);

        //搜索框事件
        $("#searchInput").focus(function() {
            $('.placeholder-img').hide();
        },function(){
            var inputValue = $(this).val();
            if (inputValue !== "") {
                $('.placeholder-img').hide();
            } else {
                $('.placeholder-img').show();
            }
        });
        // $("#searchInput").blur(function() {
        //     $('.placeholder-img').show();
        // });
        $("#searchInput").keyup(function() {
            var inputValue = $(this).val();
            if (inputValue !== "") {
                $('.placeholder-img').hide();
            } else {
                $('.placeholder-img').show();
            }
        });
    });



    //改变产品格式START=====================
    function changeFormat(type,t){
        let src = '/assets/d2eace91/images/newhome/format';
        if(type==1){
            $(t).find('img').attr('src',src+type+'-act.png');
            // $(t).parent().find('.formatDiv').eq(1).find('img').attr('src',src+'2.png');
            // $(t).parent().find('.formatDiv').eq(2).find('img').attr('src',src+'3.png');
            // $(t).parent().find('.formatDiv').eq(3).find('img').attr('src',src+'4.png');
            $(t).parent().find('.fourFormat').find('img').attr('src',src+'3.png');
            $(t).parent().find('.sixFormat').find('img').attr('src',src+'4.png');
            $('.cont3-bg').find('.twoDivs').show();
            $('.cont3-bg').find('.fourDivs').hide();
            $('.cont3-bg').find('.sixDivs').hide();
            $('.cont3-bg').find('.twoDivs .swiper-container .swiper-wrapper').css('transform','translate3d(1px, 0px, 0px)');
            console.log(2);
        }else if(type==2){
            $(t).find('img').attr('src',src+type+'-act.png');
            $(t).parent().find('.formatDiv').eq(0).find('img').attr('src',src+'1.png');
            $(t).parent().find('.formatDiv').eq(2).find('img').attr('src',src+'3.png');
            $(t).parent().find('.formatDiv').eq(3).find('img').attr('src',src+'4.png');
            $('.cont3-bg').find('.twoBox').hide();
            $('.cont3-bg').find('.threeBox').show();
            $('.cont3-bg').find('.fourBox').hide();
            $('.cont3-bg').find('.sixBox').hide();
        }else if(type==3){
            $(t).find('img').attr('src',src+type+'-act.png');
            // $(t).parent().find('.formatDiv').eq(0).find('img').attr('src',src+'1.png');
            // $(t).parent().find('.formatDiv').eq(1).find('img').attr('src',src+'2.png');
            // $(t).parent().find('.formatDiv').eq(3).find('img').attr('src',src+'4.png');
            $(t).parent().find('.twoFormat').find('img').attr('src',src+'1.png');
            $(t).parent().find('.sixFormat').find('img').attr('src',src+'4.png');
            $('.cont3-bg').find('.twoDivs').hide();
            // $('.cont3-bg').find('.threeBox').hide();
            $('.cont3-bg').find('.fourDivs').show();
            $('.cont3-bg').find('.sixDivs').hide();
            $('.cont3-bg').find('.fourDivs .swiper-container .swiper-wrapper').css('transform','translate3d(1px, 0px, 0px)');
            console.log(4);
        }else if(type==4){
            $(t).find('img').attr('src',src+type+'-act.png');
            // $(t).parent().find('.formatDiv').eq(0).find('img').attr('src',src+'1.png');
            // $(t).parent().find('.formatDiv').eq(1).find('img').attr('src',src+'2.png');
            // $(t).parent().find('.formatDiv').eq(2).find('img').attr('src',src+'3.png');
            $(t).parent().find('.fourFormat').find('img').attr('src',src+'3.png');
            $(t).parent().find('.twoFormat').find('img').attr('src',src+'1.png');
            $('.cont3-bg').find('.twoDivs').hide();
            // $('.cont3-bg').find('.threeBox').hide();
            $('.cont3-bg').find('.fourDivs').hide();
            $('.cont3-bg').find('.sixDivs').show();
            $('.cont3-bg').find('.sixDivs .swiper-container .swiper-wrapper').css('transform','translate3d(1px, 0px, 0px)');
            console.log(6);
        }
    }
    //改变产品格式END=======================

    //页面滚动START========================
    function pageScroll(t,type,name=''){
        var $target = $('.cont'+type+'-bg');
        var targetTop = $target.offset().top;
        if(type==1){
            targetTop = 0;
        }
        $('html, body').stop().animate({
            scrollTop: targetTop
        }, 500);

        $(t).siblings().removeClass('rightItemActive');
        $(t).addClass('rightItemActive');

        // $('.right-content .rightCont').animate({
        //     scrollTop:'75px'
        // });
    }

    $(document).ready(function() {
        var $sections = $('.section'); // 假设所有板块都有一个共同的类名section
        var currentSectionIndex = -1;

        // $(window).on('scroll', function() {
        //     var scrollTop = $(this).scrollTop();
        //     for (var i = 0; i < $sections.length; i++) {
        //         var sectionTop = $sections.eq(i).offset().top;
        //         if (scrollTop >= sectionTop) {
        //             currentSectionIndex = i;
        //         } else {
        //             break;
        //         }
        //     }
        //     // console.log('当前在板块' + (currentSectionIndex + 1));
        //
        //     $('.right-content .rightCont .rightItem').removeClass('rightItemActive');
        //     $('.right-content .rightCont .rightItem').eq(currentSectionIndex).addClass('rightItemActive');
        //     if(currentSectionIndex==0){
        //         rightFollowScroll(-1,currentSectionIndex);
        //     }else if(currentSectionIndex==1 || currentSectionIndex==2){
        //         rightFollowScroll(0,currentSectionIndex);
        //     }else if(currentSectionIndex==3){
        //         rightFollowScroll(95,currentSectionIndex);
        //     }else if(currentSectionIndex==4){
        //         rightFollowScroll(190,currentSectionIndex);
        //     }else if(currentSectionIndex==5){
        //         rightFollowScroll(285,currentSectionIndex);
        //     }
        // });
    });

    function rightFollowScroll(scrollParam=0,sindex){
        var canHeight = Math.floor(Math.round((rightContentHeight-$('.rightList .rightCont').height()+118) * 100)/100);
        if(scrollParam==-1){
            $('.right-content .topArrow').hide();
        }else if(scrollParam < canHeight){
            // $('.right-content .rightCont').animate({
            //     scrollTop:scrollParam
            // });

            //jq失效就用js方法
            document.getElementsByClassName('rightCont')[0].scrollTo({top: scrollParam, behavior: "smooth"});

            $('.right-content .topArrow').show();
            $('.right-content .btmArrow').show();

            btmHeight = scrollParam;
        }else{
            $('.right-content .btmArrow').hide();
        }
    }
    //页面滚动END==========================
</script>
</body>