@extends('layouts.goods_header')

@section('content')
    <link href="/css/font-awesome.css" rel="stylesheet">
    <style type="text/css" media="all">
        .fa{font-family:FontAwesome !important;}

        .header{border-bottom:3px solid #fff;}
        .footer{border-top:3px solid #fff;}

        .non_topimg{background:{{$website['background']}};}
        .title{font-size:25px;color:{{$website['fontcolor']}};text-align:center;margin-bottom:18px;}

        #content{padding:120px 0 40px;}
        #content .container .content{border: 1px solid {{$website['fontcolor']}};background:{{$website['content']}};padding:30px 20px 60px;box-sizing:border-box;position:relative;margin-top:10px;height:650px;box-shadow: 0px 0px 8px 1px #dfdede;overflow-y:scroll;}
        #content .container .content .in_mask{background-color: #000;opacity: 0;position: absolute;left: 0;top: 0;height: 100%;width: 100%;z-index: 1;}
        #content .container .content .contents{z-index:2;position:relative;color:{{$website['fontcolor']}};font-size: 20px;}
        #content .container{padding-bottom:0px;}
        #content .color_word{font-size:15px;padding: 15px 10px;box-sizing:border-box;}

        .contents img{width:100%;}
        .content{position: relative;}


        @media (min-width: 993px) {
            .contents img{width:500px;}
        }
        @media (min-width: 1000px){
            #content{margin:0;}
            .main_img,.color_word{width:400px;height:280px;text-align:center;margin:20px auto;}
        }
        @media (max-width: 992px){
            .main_img,.color_word{width:100%;height:250px;text-align:center;margin:20px auto;}
            .color_word{padding:30px;box-sizing:border-box;}
            .detail_topimg, .non_topimg{margin-top:85px;}
            .title{line-height: 30px;}
            body{min-width: 100% !important;}
            #content {padding: 40px 0 40px;}
        }
        .need_service,.need_share,.need_advice{padding:7px 10px;box-sizing:border-box;font-size:15px;font-weight:800;box-shadow:1px 1px 10px #333;text-align:center;/* margin-top:15px; */border:1px solid #D2A778;color:#ffffff;background:#0B2074;white-space:nowrap;}

        .detail_container .row .about-logo *{background:#666666 !important;font-size:16px;}
        .detail_container .row .about-logo img{box-shadow:1px 1px 15px #000;}

        .box_content a:nth-of-type(1){display:none;}
        .box_content a:nth-of-type(2){display:none;}
        a{color:{{$website['fontcolor']}};}
        .navbar_menu{color:{{$website['fontcolor']}};font-size:16px;}
        .navbar_menu a{color:{{$website['fontcolor']}};}
        .navbar_menu a:last-child{color:#D2A778;font-weight:700;}
        .page_box{padding:10px 0;box-sizing: border-box;justify-content: space-between;color:{{$website['fontcolor']}};padding-bottom:0;}
        .page_box a{color:{{$website['fontcolor']}};}

        .footer ul.social-network li{height:24px !important;}
    </style>

    <section id="content" class="non_topimg">
        <div class="w1200">
            <div class="container detail_container">
                <p class="navbar_menu"><i class="fa fa-sign-in" style="margin-right:5px;display:none;"></i><a href="/">HOME</a>&nbsp;<span style="color:{{$website['fontcolor']}};">\</span>&nbsp;{{$news['name']}}</p>
                <hr style="border-top:1px solid {{$website['fontcolor']}};">
            </div>
            <div class="container" style="padding-top:0;">
            <div class="title">{{$news['name']}}</div>
            <div class="content" >
                <!--<div class="in_mask"></div>-->
                <div class="contents">{!! $news['content'] !!}</div>
                @include("layouts.like")
                <div class="like">
                    <div class="disf">
                        <div class="like_box disf" onclick="like_num()">
                            <img src="https://www.gogo198.net/img/like.png" alt="">
                            <div class="like_num upd_num">&nbsp;{{$news['like_num']}}</div>
                        </div>
                        <div class="like_box disf" onclick="comment()">
                            <img src="https://www.gogo198.net/img/comment.png" alt="">
                            <div class="like_num upd_comment_num">&nbsp;{{$news['comment_num']}}</div>
                        </div>
                        <div class="like_box disf" onclick="show_share()">
                            <img src="/assets/d2eace91/images/newhome/share.png" alt="" style="width: 18px;height:18px;">
                            <div class="like_num upd_share_num">&nbsp;{{$news['share_num']}}</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <hr  style="border-top:1px solid #fff;"/>
            <div class="row">
                <div class="col-md-12">
                    @include("layouts.advice")
                </div>
            </div>
            <div class="row comment_box" style="border:1px solid {{$website['fontcolor']}};background:{{$website['content']}};">
                @if(!empty($all_comment))
                    @foreach($all_comment as $k=>$vo)
                        <div class="comment_div">
                            <div class="disf" style="justify-content: space-between;">
                                <div class="name f15">游客:{{$vo['ip']}}</div>
                                <div class="time f15"><?php echo date('Y-m-d H:i', $vo['createtime']);?></div>
                            </div>
                            <div class="comment_content f15">{{$vo['text']}}</div>
                        </div>
                    @endforeach
                @else
                    <div class="f15 no_comment" style="text-align: center;color:{{$website['fontcolor']}};">——暂无评论——</div>
                @endif
            </div>
        </div>
        </div>
    </section>


    <div class="comment" style="display: none;padding:20px;box-sizing: border-box;text-align: center;">
        <textarea name="comment_content" id="comment_content" class="layui-textarea" placeholder="请留下您的评论..."></textarea>
        <div class="layui-btn layui-btn-md submit_comment" style="margin-top:15px;">立即评论</div>
    </div>
    <script src="/assets/d2eace91/js/jquery.js?v=1.1"></script>

    <script src="https://res.wx.qq.com/open/js/jweixin-1.6.0.js" type="text/javascript"></script>
    <script src="/assets/d2eace91/js/jquery.cookie.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=20180528"></script>
    <script src="/js/jquery.hiSlider.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=<?php echo time();?>"></script>
    <script>
        function IsPhone() {
            var info = navigator.userAgent;
            var isPhone = /mobile/i.test(info);
            return isPhone;
        }

        $(function(){
            let link = "{{$news['link']}}";
            let html = '<a href="'+link+'">' +
                '<div class="need_share"><img src="/assets/d2eace91/images/newhome/eyes.png" alt="" style="width: 20px;">查看原文</div>\n'+
            '</a>';
            $('.box_content').append(html);


            /*带图片的微信分享*/
            let imgUrl = "https://www.gogo198.net/img/share_logo.png?v=231234";
            let lineLink = "{{$signPackage['url']}}";
            let descContent = "<?php echo substr($signPackage['desc'], 0, 150);?>";
            let shareTitle = "{{$signPackage['name']}}";
            wx.config({
                debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
                appId: "{{$signPackage['appId']}}", // 必填，公众号的唯一标识
                timestamp: '{{$signPackage["timestamp"]}}', // 必填，生成签名的时间戳
                nonceStr: '{{$signPackage["nonceStr"]}}', // 必填，生成签名的随机串
                signature: '{{$signPackage["signature"]}}',// 必填，签名，见附录1
                jsApiList: ['checkJsApi','updateAppMessageShareData','updateTimelineShareData'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
            });
            wx.checkJsApi({
                jsApiList: ['updateAppMessageShareData','updateTimelineShareData'],
                success: function (res) {
                    // console.log(JSON.stringify(res));
                    // alert(JSON.stringify(res.checkResult.getLocation));
                    if (res.checkResult.updateAppMessageShareData == false) {
                        alert('你的微信版本太低，不支持微信JS接口，请升级到最新的微信版本！');
                        return;
                    }
                }
            });
            wx.ready(function(){
                //分享“微信”和“QQ”好友
                wx.updateAppMessageShareData({
                    title: shareTitle, // 分享标题
                    desc: descContent, // 分享描述
                    link: lineLink, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                    imgUrl: imgUrl, // 分享图标
                    success: function () {
                        // 设置成功
                        //   layer.msg('分享成功');
                    },
                    fail: function (erres) {
                        // alert('失败：', erres)
                    }
                });
                //分享“微信朋友圈”和“QQ空间”
                wx.updateTimelineShareData({
                    title: shareTitle, // 分享标题
                    link: lineLink, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                    imgUrl: imgUrl, // 分享图标
                    success: function () {
                        // 设置成功
                    },
                    fail: function (erres) {
                        // alert('失败：', erres)
                    }
                });
            });
            wx.error(function(res){
                // config信息验证失败会执行error函数，如签名过期导致验证失败，具体错误信息可以打开config的debug模式查看，也可以在返回的res参数中查看，对于SPA可以在这里更新签名。
                console.log(res);
            });
        });
    </script>
@stop