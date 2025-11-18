<style type="text/css" media="all">
    .contact_contain{width: 40%;position: relative;left:10%}
    .foot-menu{justify-content: space-between;align-items:baseline;}
    @media (max-width: 992px) {
        .contact_contain{width: 80%;position: relative;left:10%}
        .foot-menu{display:block;}
        .foot-menu .col-md-4{width: 48%;display: inline-block;float: left;}
    }
    .contact_contain .box{width: 100%;position: relative;overflow: hidden;height:34px;}
    .contact_contain .box_wheel{height: 500px;position: absolute;overflow: hidden;}
    .contact_contain .box_wheel li{width: 1040px;height: 500px;background: pink;text-align: center;line-height: 500px;float: left;}
    .contact_contain .contact_btn{width: 30px;height: 30px;line-height: 30px;text-align: center;color: #f1be83;font-size: 30px;cursor: pointer;display:none;}
    .contact_contain .btn_left{position: absolute;left: -50px;top: 0%;}
    .contact_contain .btn_right{position: absolute;right: -50px;top: 0%;}

    .copyright p span:first-child{display:none;}
    .col-md-4{margin-bottom: 10px;}
</style>
<footer style="background:{{$website['color']}};border-top:2px solid {{$website['color_word']}};">
    <div class="container" style="font-size:16px;">
        <div class="row">
            <div class="col-md-3 col-sm-3">
                <div class="widget">
                    <h4 class="widgetheading f18" style="margin-bottom:5px;">联系淘中国</h4>
                    <p>
                        <i class="fa fa-phone" style="width: 18px;font-size: 15px;padding-left: 4px;"></i> <a href="tel:{{$website['mobile']}}">{{$website['mobile']}}</a> <br>
                        <img src="/assets/d2eace91/images/newhome/email.png?v=2" alt="" style="width:18px;"/> <a href="mailto:{{$website['email']}}">{{$website['email']}}</a>
                    </p>
                </div>
            </div>
            <div class="col-md-9 col-sm-9 foot-menu">
                @foreach($website['footer'] as $key=>$vo)
                    <div class="col-md-4 col-sm-4">
                        <div class="widget">
                            <h4 class="widgetheading f18" style="margin-bottom:5px;text-align:center;">{{$vo['name']}}</h4>
                            <ul class="link-list" style="text-align:center;">
                                @foreach($vo['children'] as $key2=>$vo2)
                                    <li><a href="{{$vo2['link']}}" class="f18">{{$vo2['name']}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div id="sub-footer" style="padding-top:0;margin-top:0;font-size:16px;background:{{$website['color']}};">
        <div class="container">
            <div class="row" style="margin-bottom:0;">
                <div class="col-lg-5">
                    <div style="color:#f1be83;font-weight:unset;font-size:18px;white-space: nowrap;margin-bottom:10px;" class="f18">
                        关注淘中国
                    </div>
                    <div class="contact_contain">
                        <div class="box" style="">
                            <ul class="social-network" style="overflow-x:unset;position:absolute;">
                                @foreach($website['social'] as $key=>$vo)
                                    @if($vo['type']==1)
                                        <li style="margin-left:0;"><a href="{{$vo['link']}}" data-placement="top" title="{{$vo['name']}}" target="_blank"><img src="//shop.gogo198.cn/{{$vo['ico']}}" alt="" style="width:18px;margin-bottom: 3px;"/></a></li>
                                    @else
                                        <li><a href="?s=index/contact_detail&id={{$vo['id']}}" data-placement="top" title="{$vo['name']}"><img src="//shop.gogo198.cn/{{$vo['ico']}}" alt="" style="width:18px;margin-bottom: 3px;" target="_blank"/></a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <div class="contact_btn btn_left"><</div>
                        <div class="contact_btn btn_right">></div>
                    </div>
                    <ul class="social-network2" style="display:none;">
                        @foreach($website['social'] as $key=>$vo)
                            @if($vo['type']==1)
                                <li style="margin-left:0;"><a href="{{$vo['link']}}" data-placement="top" title="{}{$vo['name']}}" target="_blank"><img src="//shop.gogo198.cn/{{$vo['ico']}}" alt="" style="width:18px;margin-bottom: 3px;"/></a></li>
                            @else
                                <li><a href="?s=index/contact_detail&id={{$vo['id']}}" data-placement="top" title="{}{$vo['name']}}"><img src="//shop.gogo198.cn/{{$vo['ico']}}" alt="" style="width:18px;margin-bottom: 3px;"/></a></li>
                            @endif
                        @endforeach
                    </ul>
                </div>

            </div>
            <div class="row copyright2" style="margin-bottom:20px;">
                <div class="col-lg-12">
                    <div style="text-align:center;">
                        {!! $website['copyright'] !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>

<!-- JS文件 -->
<script src="/assets/d2eace91/js/jquery.js"></script>
{{--<script src="https://healink.gogo198.com/js/jquery.easing.1.3.js"></script>--}}
<script src="/assets/d2eace91/bootstrap/js/bootstrap.min.js?v=5"></script>
{{--<script src="https://healink.gogo198.com/js/jquery.fancybox.pack.js"></script>--}}
{{--<script src="https://healink.gogo198.com/js/jquery.fancybox-media.js"></script>--}}
{{--<script src="https://healink.gogo198.com/js/jquery.flexslider.js"></script>--}}
{{--<!--插件脚本 -->--}}
{{--<script src="https://healink.gogo198.com/js/modernizr.custom.js"></script>--}}
{{--<script src="https://healink.gogo198.com/js/jquery.isotope.min.js"></script>--}}
{{--<script src="https://healink.gogo198.com/js/jquery.magnific-popup.min.js"></script>--}}
{{--<script src="https://healink.gogo198.com/js/animate.js"></script>--}}
{{--<script src="https://healink.gogo198.com/js/custom.js"></script>--}}
<script type="text/javascript" charset="utf-8">
    // window.addEventListener('load', function() {
    //     var images = document.getElementsByClassName('carousel-image');
    //     if(typeof(images[0])!='undefined'){
    //         var minHeight = images[0].height;
    //
    //         for (var i = 0; i < images.length; i++) {
    //             if (images[i].height < minHeight) {
    //                 minHeight = images[i].height;
    //             }
    //         }
    //         var container = document.getElementById('carousel-container');
    //         container.style.height = minHeight + 'px';
    //     }
    // });

    function IsPhone() {
        var info = navigator.userAgent;
        var isPhone = /mobile/i.test(info);
        return isPhone;
    }

    $('.haschild').click(function(){
        $(this).parent().find('.dropdown').addClass('open');
        $(this).parent().parent().parent('.dd_parent').addClass('open2');

        if(IsPhone()){
            $('.navbar-collapse').stop().animate({
                scrollTop: 500
            }, 1000);
        }
    });

    function removeclass(t){
        $(t).siblings().removeClass('open2');
    }

    function change_language2(lang){
        $.ajax({
            url: "?s=index/change_language",
            method: 'post',
            data: {'lang':lang},
            dataType: 'JSON',
            success: function (res) {
                window.location.reload();
            },
            error: function (data) {

            }
        });
    }

    //打开平台的应用
    function open_apps(){
        if($('.appsDiv').css('display')=='block'){
            $('.appsDiv').css('display','none');
        }else{
            $('.appsDiv').css('display','block');
        }
    }

    //手机版显示超出菜单
    function showMenu(){
        if($('.overflowMenu').css('display')=='block'){
            $('.overflowMenu').css('display','none');
        }else{
            $('.overflowMenu').css('display','block');
        }
    }

    $(function(){
        if(IsPhone()){
            $('.mobile_translate').attr('id','translate');
            $('.web_translate').attr('id','123');
            $('.join_us').attr('href','//m.zhipin.com/gongsi/job/50deb42e6099c4a61Hx739u6.html?ka=job-detail-company_custompage');
            //内页头部判断
            $('.wapGuide').show();
            $('.pcGuide').hide();
        }else{
            $('.mobile_translate').attr('id','123');
            $('.web_translate').attr('id','translate');
        }

        //控制联系方式
        var liW = $(".social-network li").width()+2+10;
//			获取li元素的长度(个数)
        var len = $(".social-network li").length;

//			计算ul的总宽度
        var ulW = len*liW;
//			设置ul的宽度
        $(".social-network").css("width",ulW);
        if($(".social-network").css("width")>$(".contact_contain").css('width')){
            $('.contact_btn').show();
            $('.contact_contain').css('left','10%');
        }else{
            $('.contact_btn').hide();
            $('.contact_contain').css('left','0%');
        }
        var idx = 0;
        $(".btn_left").click(function(){
            idx --;  //索引自加
            if(idx == -1){
                idx = len - 1;
            }
            changeLi(idx);
        });
        $(".btn_right").click(function(){
            idx ++;  //索引自减
            if(idx == len){
                idx = 0;
            }
            changeLi(idx);
        });
        function changeLi(idx){
            var move = -idx * liW;
            $(".social-network").stop().animate({"left":move},300);
        }
    });

    //注销账号
    function logout(){
        if(confirm("是否确认注销此账户？")){
            $.ajax({
                url: "?s=index/logout_account",
                method: 'post',
                data: {'pa':1},
                dataType: 'JSON',
                success: function (res) {
                    if(res.code==-1){
                        alert(res.msg);
                    }
                    else if(res.code==0){
                        window.location.href="/";
                    }
                },
                error: function (data) {

                }
            });
        }
    }

    //占满屏判断
    function setFullScreenSectionHeight() {
        var windowHeight = $(window).height()+20;
        console.log(windowHeight);
        $('.fullscreen-section').css({'height':windowHeight+'px'});
    }

    setFullScreenSectionHeight();

    $(window).resize(function() {
        setFullScreenSectionHeight();
    });
</script>
</body>
</html>