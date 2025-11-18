@extends('layouts.inner_header')

@section('content')
    <link href="/css/font-awesome.css" rel="stylesheet">

    <style type="text/css" media="all">
        .fa{font-family:FontAwesome !important;}
        .header{border-bottom:3px solid #fff;}
        .footer{border-top:3px solid #fff;}

        .non_topimg{background:{{$website['background']}};}
        .title{font-size:25px;color:{{$website['fontcolor']}};text-align:center;margin-bottom:18px;}

        #content{padding:20px 0;}
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
            #content .container{padding-top:30px;}
            #content{padding-top:0;margin:0;}
            .main_img,.color_word{width:400px;height:280px;text-align:center;margin:20px auto;}
        }
        @media (max-width: 992px){
            .main_img,.color_word{width:100%;height:250px;text-align:center;margin:20px auto;}
            .color_word{padding:30px;box-sizing:border-box;}
            .detail_topimg, .non_topimg{margin-top:85px;}
            .title{line-height: 30px;}
        }
        .need_service,.need_share,.need_advice{padding:7px 10px;box-sizing:border-box;font-size:15px;font-weight:800;box-shadow:1px 1px 10px #333;text-align:center;/* margin-top:15px; */border:1px solid #D2A778;color:#ffffff;background:#0B2074;white-space:nowrap;}

        .detail_container .row .about-logo *{background:#666666 !important;font-size:16px;}
        .detail_container .row .about-logo img{box-shadow:1px 1px 15px #000;}

        /*.box_content a:nth-of-type(1){display:none;}*/
        .box_content a:nth-of-type(2){display:none;}
        a{color:{{$website['fontcolor']}};}
        .navbar_menu,.navbar_menu2{color:{{$website['fontcolor']}};font-size:16px;margin-bottom:10px;}
        .navbar_menu a,.navbar_menu2 a{color:{{$website['fontcolor']}};}
        .navbar_menu a:last-child{color:#D2A778;font-weight:700;}
        .navbar_menu2 a:last-child{color:#D2A778;font-weight:700;}
        .page_box{padding:10px 0;box-sizing: border-box;justify-content: space-between;color:{{$website['fontcolor']}};padding-bottom:0;}
        .page_box a{color:{{$website['fontcolor']}};}

        .footer ul.social-network li{height:24px !important;}

        .navbar_menu2{display: none;}
        @if($isframe==1)
            .header,.footer,.navbar_menu{display: none;}
            #content {padding: 20px;}
            .w1200{width: 100%;}
            .navbar_menu2{display: block;}
            .detail_topimg, .non_topimg{margin-top:0px;}
            body{min-width: 100% !important;}
            #content .container .content{height: 350px;}
        @endif
    </style>

    <section id="content" class="non_topimg">
        <div class="w1200">
            <div class="container detail_container">
                <p class="navbar_menu"><i class="fa fa-sign-in" style="margin-right:5px;display:none;"></i><a href="/">HOME</a>&nbsp;<span style="color:{{$website['fontcolor']}};">\</span>&nbsp;{{$news['name']}}</p>
                <p class="navbar_menu2"><a href="javascript:history.back(-1);">上一页</a>&nbsp;<span style="color:{{$website['fontcolor']}};">\</span>&nbsp;{{$news['name']}}</p>
            </div>
            <div class="container" style="padding-top:0;">
                <div class="title">{{$news['name']}}</div>
                <div class="content" >
{{--                    <div class="in_mask"></div>--}}
                    <div class="contents">{{$news['desc']}}</div>
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
                <div class="page_box disf">
                    <div class="prev">@if(empty($prev_news))
                            上一篇：无
                        @else
                            <a href="/msg_detail?id={{$prev_news['id']}}"><&nbsp;上一篇</a>
                        @endif
                    </div>
                    <div class="next">@if(empty($next_news))
                            下一篇：无
                        @else
                            <a href="/msg_detail?id={{$next_news['id']}}">下一篇&nbsp;></a>
                        @endif
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
    </script>
@stop