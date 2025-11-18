<style>
    /**页脚介绍**/
    .footer{background:#1f5188;height:400px;/**padding:10px 0;margin-top:0px;**/}
    .footer .aboutBox{padding-top: 120px;}
    .footer .aboutBox p{font-size: 18px;color:#fff;margin-bottom:10px;}
    .footer .footerLine{width: 100%;height:2px;background: #fff;margin:80px 0;}
    .footer .container {width: 100%;}
    .footer .container .row{margin-bottom: 0px;}
    .footer .container .row .col-md-3 {width: 30%;}
    .footer h4{color:#f14646;text-shadow: -1px 0 #fff, 0 1px #fff, 1px 0 #fff, 0 -1px #fff;}
    .footer a {font-size: 18px;color: #FFFFFF;}
    .footer ul.link-list {margin: 0;padding: 0;list-style: none;}
    .footer ul.link-list li {margin: 0;padding: 2px 0 2px 0;list-style: none;}
    .footer ul.link-list li a {color: #FFFFFF;}
    .footer .col-md-4 {width: 33.33333333333333%;}
    .footer .col-md-9 {width: 70%;}
    .footer .col-md-3,.col-md-4,.col-md-9,.col-lg-6,.col-lg-12{float: left;}
    .footer .col-lg-6 {width: 50%;}
    .footer .col-lg-12 {width: 100%;}
    .footer .contact_contain {width: 50%;position: relative;}
    .footer .contact_contain .box {width: 100%;position: relative;overflow: hidden;height: 40px;}
    .footer ul.social-network {list-style: none;margin: 0;}
    .footer .social-network {float: unset !important;padding-left: 0;overflow-x: scroll;white-space: nowrap;}
    .footer ul.social-network li {margin: 0 5px;border: 1px solid #FFFFFF;padding: 5px 0 0;width: 32px;display: inline-block;text-align: center;height: 25px;vertical-align: baseline;}
    .footer .mobile_hr {display: none;}
    .footer #sub-footer{padding-top:0;margin-top:0;font-size:16px;background:#1f5188;}
    .footer #sub-footer p {margin: 0;padding: 0;}
    .footer #sub-footer span {color: #FFFFFF;}
    .footer .guanzhu{color:#f14646;font-size:18px;white-space: nowrap;font-weight:800;margin-bottom:10px;margin-top:40px;text-shadow: -1px 0 #fff, 0 1px #fff, 1px 0 #fff, 0 -1px #fff;}
</style>
<!--页脚介绍 fullscreen-section3 section-->
<div class="footer cont7-bg ">
    <div class="w1200">
        <div style="height:50px;width:100%;float:left;"></div>
        <div class="aboutBox" style="display: none;"></div>
        <div class="footerLine" style="display: none;"></div>
        <div class="container" style="font-size:16px;">
            <div class="row">
                <div class="col-md-3 col-sm-3">
                    <div class="widget">
                        <h4 class="widgetheading f18" style="margin-bottom:5px;">联系我们</h4>
                        <p>
                            <img src="//gather.gogo198.cn/img/tel.png" alt="" style="width:18px;"> <a href="tel:{{$website['mobile']}}">{{$website['mobile']}}</a> <br>
                            <img src="//gather.gogo198.cn/img/email.png" alt="" style="width:18px;"> <a href="mailto:{{$website['email']}}">{{$website['email']}}</a>
                        </p>
                    </div>
                </div>
                <div class="disf col-md-9 col-sm-9 foot-menu" style="align-items:baseline;">
                    @foreach($website['footer'] as $key=>$val)
                        <div class="col-md-4 col-sm-4">
                            <div class="widget">
                                <h4 class="widgetheading f18" style="margin-bottom:5px;text-align:right;">{{$val['name']}}</h4>
                                <ul class="link-list" style="text-align:right;">
                                    @foreach($val['children'] as $k=>$v)
                                        <li><a href="{{$v['link']}}" class="f18" target="_blank">{{$v['name']}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div id="sub-footer">
            <div class="container">
                <div class="row" style="margin-bottom:0px;">
                    <div class="col-lg-6">
                        <div class="f18 guanzhu">
                            关注我们
                        </div>
                        <div class="contact_contain">
                            <div class="box" style="">
                                <ul class="social-network" style="overflow-x:unset;position:absolute;">
                                    @foreach($website['social'] as $k=>$v)
                                        @if($v['type']==1)
                                            <li>
                                                <a href="{{$v['link']}}" data-placement="top" title="{{$v['name']}}">
                                                    <img src="https://shop.gogo198.cn/{{$v['ico']}}" alt="" style="width:18px;margin-bottom: 3px;">
                                                </a>
                                            </li>
                                        @else
                                            <li>
                                                <a href="/social_detail?id={{$v['id']}}" data-placement="top" title="{{$v['name']}}">
                                                    <img src="https://shop.gogo198.cn/{{$v['ico']}}" alt="" style="width:18px;margin-bottom: 3px;">
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            {{--                                <div class="contact_btn btn_left">&lt;</div>--}}
                            {{--                                <div class="contact_btn btn_right">&gt;</div>--}}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <hr class="mobile_hr">
                        <div class="other_website">
                            <p style="text-align:center;font-weight:unset;margin-top: 85px;">
                                <a href="https://gather.gogo198.cn/" class="f16" target="_blank" rel="noopener noreferrer">
                                    直邮易
                                </a>
                                <span>|</span>
                                <a href="http://www.gogo198.cn/" class="f16" target="_blank" rel="noopener noreferrer">
                                    淘中国
                                </a>
                                <span>|</span>
                                <a href="https://www.gogo198.net/" class="f16" target="_blank" rel="noopener noreferrer">
                                    购购网
                                </a>
                            </p>
                            <p style="text-align:center;font-weight:unset;margin-top: 5px;">
                                @if(!empty($website['join_us']))
                                    {{--                                    <span>|</span>--}}
                                    <a class="join_us" href="{{$website['join_us']}}" target="_blank" rel="noopener noreferrer">加入我们</a>
                                @endif
                                @if(!empty($website['content']['help']))
                                    <span>|</span>
                                    <a class="help_us" href="/help_us" target="_blank" rel="noopener noreferrer">帮助中心</a>
                                @endif
                                <span>|</span>
                                <a href="/friendly_link" class="f16" target="_blank" rel="noopener noreferrer">友情链接</a>
                                @if($website['service_rule']==28)
                                    <span>|</span>
                                    <a href="/rule_list" class="f16" target="_blank" rel="noopener noreferrer">平台规则</a>
                                @endif
                                @if($website['privacy_rule']==36)
                                    <span>|</span>
                                    <a href="/rule_detail?id=36" class="f16">私隐政策</a>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row copyright2" style="margin-bottom:0;">
                    <div class="col-lg-12">
                        <div style="text-align:center;margin-top:40px;">
                            {!! $website['copyright'] !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>