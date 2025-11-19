<style>
    .padding-big {
        padding: 20px;
    }
    .x3-move {
        /*margin-left: 25%;*/
        display: inline-block;
        /*border-right:1px solid #ccc;*/
    }
    .x6 {
        width: 50%;
    }
    .x1, .x2, .x3, .x4, .x5, .x6, .x7, .x8, .x9, .x10, .x11, .x12 {
        float: left;
    }
    .x1, .x2, .x3, .x4, .x5, .x6, .x7, .x8, .x9, .x10, .x11, .x12, .xl1, .xl2, .xl3, .xl4, .xl5, .xl6, .xl7, .xl8, .xl9, .xl10, .xl11, .xl12, .xs1, .xs2, .xs3, .xs4, .xs5, .xs6, .xs7, .xs8, .xs9, .xs10, .xs11, .xs12, .xm1, .xm2, .xm3, .xm4, .xm5, .xm6, .xm7, .xm8, .xm9, .xm10, .xm11, .xm12, .xb1, .xb2, .xb3, .xb4, .xb5, .xb6, .xb7, .xb8, .xb9, .xb10, .xb11, .xb12 {
        position: relative;
        min-height: 1px;
    }
    .text-sub{
        color: #041837;
    }
    .padding {
        padding: 10px;
    }
    .text-center {
        text-align: center;
    }
    h1, h2, h3 {
        font-weight: bold;
        color: #fff;
    }
    h3, .h3 {
        font-size: 22px;
    }
    h3 small, .h3 small {
        font-size: 60%;
        filter: alpha(opacity=60);
        opacity: .6;
        color: #041837;
    }
    .form-group {
        padding-bottom: 0px;
    }
    .input-group {
        border-collapse: separate;
        display: table;
        position: relative;
        width: 100%;
        display: flex;
        align-items: center;
    }
    .input-group .input:last-child {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }
    .form-group .input-btn{
        width:100%;
        text-align: center;
        padding:7px 15px;
        box-sizing: border-box;
        display: inline-block;
        background:rgb(1,142,215);
        color:#fff;
        border-radius:15px;
        cursor:pointer;
        margin-bottom:10px;
    }
    .form-group .input-btn:hover{background:rgb(186,33,38);}
    .form-big .input, .form-big .button {
        padding: 10px;
        font-size: 15px;
        line-height: 24px;
        height: 46px;
    }
    .input-group .input {
        width: 100%;
    }
    .input-group .input {
        display: table-cell;
    }
    .input {
        font-size: 14px;
        padding: 6px;
        border: solid 1px #ddd;
        width: 100%;
        height: 34px;
        line-height: 20px;
        display: block;
        border-radius: 4px;
        -webkit-appearance: none;
        /*box-shadow: 0 1px 1px rgb(0 0 0) inset;*/
        transition: all 1s cubic-bezier(0.175, 0.885, 0.32, 1) 0s;
    }
    .input-group .addon {
        background-color: #fff;
        border: 1px solid #ddd;
        /*border-radius: 4px;*/
        line-height: 1;
        padding: 6px 12px;
        text-align: center;
        width:18%;
        height:46px;
        /*border-top-right-radius: 0;*/
    }
    .bg-blue{background:#444444;border:0;color:#fff;}

    .advice *{box-sizing: border-box;}
    .advice .form-group {margin-bottom: 15px;}

    .need_service,.need_share,.need_advice{padding:15px 10px;box-sizing:border-box;font-size:15px;font-weight:800;box-shadow:1px 1px 10px #333;text-align:center;border:1px solid #666;color:#000;background:#fff;white-space:nowrap;border-radius: 5px;}

    /**分享**/
    .mask{background:black;opacity:0.7;display:none;width:100%;position:fixed;z-index:9999;top:0;left:0;height:100%;}
    .mask_content{display:none;width: 80%;background: #1f5188;position: fixed;bottom: 50% !important;left: 50%;z-index: 99999;transform: translate(-50%, 30%);}
    .mask_content input{float: right;width: 100%;line-height: 30px;font-size: 14px;color: #000;border: none;}
    .mask_content .bt{font-size: 16px;color: #fff;text-align: center;line-height: 45px;border-bottom: 1px solid #f5f2f2;background: #1f5188;}
    .mask_content .position{text-align: center;}
    .mask_content .position ul li {overflow: hidden;background: #fff;padding: 2% 4%;border-bottom: 1px solid #f5f2f2;}
    .mask_content .position .p1{width: 80px;text-align:left;float: left;line-height: 30px;font-size: 14px;color: #000;}
    .mask_content #status1{color: #000;margin-bottom: 1rem;margin-top: 1rem;}
    .mask_content #status2{color: #000;margin-bottom: 1.5rem;}
    .mask_content .btn-line{margin-top:80px;width:100%;}
    .mask_content button {color: #444444;background: #F3F3F3;border: 1px #DADADA solid;padding: 5px 10px;border-radius: 2px;font-weight: bold;font-size: 12pt;outline: none;}
    .mask_content .cancel{margin-right:0;background: -webkit-linear-gradient(top, #e60000, #e60000);background: -moz-linear-gradient(top, #DD4B39, #D14836);background: -ms-linear-gradient(top, #DD4B39, #D14836);box-sizing:border-box;color: white;text-shadow: 0 1px 0 #C04131;width:100%;border: 1px solid #fff;padding: 10px;margin-top: 10px;}
    .mask_content .submit{color: white;background: #4C8FFB;border: 1px #3079ED solid;box-shadow: inset 0 1px 0 #80B0FB;}

    .need_service_box{position: fixed;right: 60px;top: 50%;}

    @media screen and (max-width: 768px){
        .x6 {width: 100%;}
        .x3-move {margin-left: 0;border-bottom:1px solid #fff;border-right:0;}
        .input-group .addon{width:20%;}
        .box_content{display:flex;align-items:center;justify-content:space-evenly;}
        .need_service_box{right:-70px;}
    }

    @media (min-width: 1000px){
        .mask_content{width:350px;}
        .box_content{display:flex;align-items:center;justify-content:space-evenly;}
    }
    .share_img{display:inline-block;margin:5px 10px 0 0;width: 65px;}
    .share_img img{width:35px;}
    .share_img .tit{font-size:15px;color:#fff;}

</style>

<div class="need_service_box">
    <div class="box_content">
        <a href="javascript:connect_kefu();">
            <div class="need_advice">
                <i class="fa fa-user" style="color:#000;font-size:15px;margin-right:3px;"></i>
                在线客服
            </div>
        </a>
    </div>
</div>

