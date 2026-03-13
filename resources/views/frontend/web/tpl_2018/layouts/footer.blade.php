    <style type="text/css" media="all">
        footer{background:#2f2f2f;border-top:2px solid {{$website['color_word']}};position: fixed;bottom:0;left:0;width: 100%;display: none;z-index: 9;padding:10px;}
        footer a:hover{color:unset;}
        footer .footerItem,footer .footerItem2{text-align: center;position:relative;cursor:pointer;font-weight: 600;}
        footer .footerItem *,footer .footerItem2 *{color:{{$website['color_word']}};}
        /*footer .footerItem:hover,footer .footerItem2:hover{color:#e60000;}*/
        footer .footerItem:after{content:'';width: 0;position: absolute;top: 5px;left: 60%;height: 0;border-left: 10px solid transparent;border-right: 10px solid transparent;border-bottom: 10px solid #fff;transform: rotate(180deg);}
        footer .footerItem2:after{content:'';width: 0;position: absolute;top: 5px;left: 60%;height: 0;border-left: 10px solid transparent;border-right: 10px solid transparent;border-bottom: 10px solid #fff;}
        footer .footerItem .footerChildren,footer .footerItem2 .footerChildren{display:none;position: absolute;left:50%;bottom: 34px;background: #2f2f2f;width: max-content;color:{{$website['color_word']}};border: 2px solid {{$website['color_word']}};border-bottom: 0;border-top-left-radius: 5px;border-top-right-radius: 5px;transform: translate(-50%, 0px);}
        footer .footerItem2 .footerChildren .footerChildrenItem{padding:10px;box-sizing: border-box;border-bottom: 2px solid {{$website['color_word']}};}
        footer .footerItem2 .footerChildren .footerChildrenItem:last-child{border-bottom: 0;}
        footer .footerItem2 .footerChildren .footerChildrenItem a span{font-size: 15px;}
        .contact_contain{width: 40%;position: relative;left:10%}
        .foot-menu{justify-content: space-between;align-items:baseline;}
        footer .widgetheading{color:{{$website['color_word']}};font-weight:800;/*text-shadow: -1px 0px 0px #fff, 0px 1px 0px #fff, 1px 0px 0px #fff, 0px -1px 0px #fff;*/}
        footer ul.link-list li a{color:{{$website['color_word']}};}
        footer ul.link-list li a:hover{color:#c60001 !important;}
        .footerDiv{display: grid;grid-template-columns: repeat(4,1fr);-moz-column-gap: 0px;column-gap: 0px;row-gap: 0px;}

        @media (max-width: 992px) {
            .contact_contain{width: 80%;position: relative;left:10%}
            .foot-menu{display:block;}
            .foot-menu .col-md-4{width: 48%;display: inline-block;float: left;}

            /*底部菜单栏*/
            /*footer .footerDiv .footerItem,footer .footerDiv .footerItem2{width:48%;display: inline-block;}*/
            footer .footerItem:after{left:85%;border-left: 5px solid transparent;border-right: 5px solid transparent;border-bottom: 5px solid #fff;top:10px;}
            footer .footerItem2:after{left:85%;border-left: 5px solid transparent;border-right: 5px solid transparent;border-bottom: 5px solid #fff;top:10px;}
            footer .footerItem .footerChildren, footer .footerItem2 .footerChildren{left:-10%;transform:unset;}
            footer .footerItem:last-child .footerChildren, footer .footerItem2:last-child .footerChildren{width: 340px;left:-280%;transform:unset;}
            footer .swiper-button-prev, footer .swiper-button-next{width:20px;height:20px;top:90%;}
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
    <footer>
        <div class="footerDiv">
            <div class="footerItem f15">
                <span>联系我们</span>
                <div class="footerChildren">
                    <div class="footerChildrenItem"><i class="fa fa-phone" style="width: 18px;font-size: 15px;padding-left: 4px;"></i> <a href="tel:{{$website['mobile']}}" class="f15">{{$website['mobile']}}</a></div>
                    <div class="footerChildrenItem"><img src="/assets/d2eace91/images/newhome/email.png?v=2" alt="" style="width:18px;"/> <a href="mailto:{{$website['email']}}" class="f15">{{$website['email']}}</a></div>
                </div>
            </div>
            <div class="footerItem f15">
                <span>关注我们</span>
                <div class="footerChildren">
                    @foreach($website['social'] as $key=>$vo)
                        @if($vo['type']==1)
                            <div class="footerChildrenItem"><a href="{{$vo['link']}}" data-placement="top" title="{{$vo['name']}}" target="_blank"><img src="//shop.gogo198.cn/{{$vo['ico']}}" alt="" style="width:18px;margin-bottom: 3px;"/>&nbsp;<span>{{$vo['name']}}</span></a></div>
                        @else
                            <div class="footerChildrenItem"><a href="/social_detail?id={{$vo['id']}}" data-placement="top" title="{{$vo['name']}}"><img src="//shop.gogo198.cn/{{$vo['ico']}}" alt="" style="width:18px;margin-bottom: 3px;" target="_blank"/>&nbsp;<span>{{$vo['name']}}</span></a></div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="footerItem f15">
                <span>网站导航</span>
                <div class="footerChildren">
                    <div class="footerChildrenItem">
                        @foreach($website['footer'] as $key=>$vo)
                            <div class="col-md-4 col-sm-4">
                                <div class="widget">
                                    <h4 class="widgetheading f18" style="margin-bottom:5px;text-align:center;">{{$vo['name']}}</h4>
                                    <ul class="link-list" style="text-align:center;">
                                        @foreach($vo['children'] as $key2=>$vo2)
                                            <li><a href="{{$vo2['link']}}" class="f15">{{$vo2['name']}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="footerItem f15">
                <span>备案信息</span>
                <div class="footerChildren">
                    <div class="footerChildrenItem">
                        {!! $website['copyright'] !!}
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>

<script type="text/javascript" charset="utf-8">
    function sloganClose(t){
        $(t).parent().hide();
    }

    function isScrolledToBottom() {
        return (window.scrollY + 200 + window.innerHeight) >= document.documentElement.scrollHeight;
    }

    $(window).scroll(function(){
        if (isScrolledToBottom()) {
            $('footer').show();
        }else{
            $('footer').hide();
        }
    });

    //页脚点击事件
    $('footer .footerDiv .footerItem').click(function(){
        if($(this).find('.footerChildren').css('display') == 'block'){
            $(this).find('.footerChildren').hide();
            $(this).removeClass('footerItem2').addClass('footerItem');
        }else{
            $('.footerChildren').hide();
            $(this).siblings().removeClass('footerItem2').addClass('footerItem');

            $(this).find('.footerChildren').show();
            $(this).removeClass('footerItem').addClass('footerItem2');
        }
    });

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
            $('.navbar-collapses').addClass('navbar-collapse');
            $('.navbar-collapses').removeClass('navbar-collapses');
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