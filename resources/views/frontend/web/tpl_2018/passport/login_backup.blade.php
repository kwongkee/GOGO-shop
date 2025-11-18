@extends('layouts.goods_header')

@section('content')
    <link rel="stylesheet" href="/assets/d2eace91/js/chosen/chosen.css?v=1.2"/>
    <link rel="stylesheet" href="/assets/d2eace91/layui/css/layui.css">

    <style type="text/css" media="all">
        body{background:{{$website['background']}} !important;}
        .disf{display:flex;}
        #content{margin-top:100px;background: {{$website['content']}};}
        #content .container{width: 80%;max-width: 1200px;padding: 0px;margin: 30px auto 40px;border-radius: 5px;background-color: unset;box-shadow: 0 0 16px rgba(0,0,0,.04);box-shadow: unset;}
        .content{padding:20px 20px;box-sizing:border-box;}
        .content .col-md-12{padding:0;float:unset;}
        .content .box_content{justify-content:center;border-radius:8px;margin-bottom:30px;}
        .content .box_content{background:;color:;border:1px solid ;font-size:25px;text-align:center;padding:30px;width:100%;}
        .content .box_content img{width:40px;margin-right:5px;}
        .layui-elem-field legend,.layui-form-item .layui-form-label{color:;}

        .content .title{font-size:26px;color:#fff;font-weight:800;text-align:center;line-height:normal !important;}
        .content .control-group{margin-top:10px;}
        .content .control-group .label_title{width:80px;color:#fff;font-weight:800;font-size:15px;text-align:right;margin-right:10px;}
        .content .control-group #reg_method{width:110px;}
        .content .control-group .phone,.content .control-group .email{width:82.5%;}
        .content .control-group .controls .form-control{width:100%;font-size:15px;}
        .content .control-group .controls .btn-send{padding:7px 0px;width:25%;background:#1E9FFF;color:{{$website['fontcolor']}};border:1px solid {{$website['fontcolor']}};}
        .content form{text-align:left;}
        .content form .btn-submit {background: {{$website['color']}};color: {{$website['color_word']}};border: 1px solid {{$website['color_word']}};padding: 10px 100px;box-sizing: border-box;float: unset !important;margin-top: 15px;cursor:pointer;}

        .form-control {display: block;width: 100%;height: 34px;padding: 6px 12px;font-size: 14px;line-height: 1.428571429;}

        .phone{display:none;}
        footer{display: block !important;}

        .loginBox{width:400px;text-align: center;margin:0 auto;}
        .loginBox .methodDiv{margin-bottom:25px;}
        .loginBox .methodDiv .methodBox{margin-right:20px;position:relative;color:{{$website['fontcolor']}};font-size: 16px;cursor:pointer;}
        .loginBox .methodDiv .methodAct{font-weight:600;}
        .loginBox .methodDiv .methodAct:after{position:absolute;content:'';left:0;bottom:-10px;width: 100%;height:3px;background:#f1be83;}
        .loginBox .methodContent .numberDiv{padding-bottom: 5px;border-bottom: 1px solid {{$website['fontcolor']}};}
        .loginBox .methodContent .phone_login .form-control{width:80%;}
        .loginBox .methodContent .phone_login .selectBox{width:25%;}
        .loginBox .methodContent .phone_login .selectBox *{font-family: Courier !important;font-weight: 800;}
        .loginBox .methodContent .phone_login .selectBox .chosen-container{width:100%;text-align: left;background: unset !important;}
        .loginBox .methodContent .phone_login .selectBox .chosen-container-single .chosen-single{background: unset !important;box-shadow: unset;border: 0;border-right: 1px solid {{$website['fontcolor']}};border-radius: 0;position: relative;padding-left:0;}
        .loginBox .methodContent .phone_login .selectBox .chosen-container-active.chosen-with-drop .chosen-single{background: unset !important;color: {{$website['fontcolor']}} !important;font-size: 15px !important;border: 0 !important;outline: unset !important;box-shadow: unset !important;}
        .loginBox .methodContent .phone_login .selectBox .chosen-container-single .chosen-single span{background: unset !important;color: {{$website['fontcolor']}} !important;font-size: 15px;border: 0 !important;outline: unset !important;box-shadow: unset !important;position:relative;font-weight: 800;}
        .loginBox .methodContent .phone_login .selectBox .chosen-container-single .chosen-single:after{position: absolute;content: '';top: 7px;right: 7px;width: 8px;height: 8px;border: 2px solid {{$website['fontcolor']}};border-left: 0;border-bottom: 0;transform: rotate(135deg);}
        .loginBox .methodContent .phone_login .selectBox .chosen-container-single .chosen-single div{display:none;}
        .loginBox .methodContent .phone_login .selectBox .chosen-results li{padding:5px 0 !important;}
        .loginBox .methodContent .phone_login .country_code{background:unset;width:100%;border:0;color:{{$website['fontcolor']}};border-right:1px solid {{$website['fontcolor']}};}
        .loginBox .methodContent .phone_login #country_code option:not(:checked) {color: #000;}
        .loginBox .methodContent .phone_login #country_code option:not(:checked) span{display: block;}
        .loginBox .methodContent .phone_login #country_code option:checked{color:#000;}
        .loginBox .methodContent .numberDiv .form-control,.loginBox .methodContent .codeDiv .form-control{background: unset;border: 1;color: {{$website['fontcolor']}};}
        .loginBox .methodContent .numberDiv .form-control::placeholder,.loginBox .methodContent .codeDiv .form-control::placeholder {color: {{$website['fontcolor']}};}
        .loginBox .methodContent .phone_login{display:none;}
        .loginBox .methodContent .codeDiv{margin-top:20px;padding-bottom:5px;border-bottom: 1px solid {{$website['fontcolor']}};}
        .loginBox .methodContent .codeDiv .sendcode{padding:7px 25px;color:{{$website['fontcolor']}};white-space: nowrap;padding-right:0;cursor:pointer;}
        .loginBox .btn-submit{width:100%;margin-top:24px;padding:7px 0;}
        .loginBox .other_method_title{margin-top:10px;position: relative;color:{{$website['fontcolor']}};font-size:14px;}
        .loginBox .other_method_title:before{position: absolute;content:'';width: 25%;top: 10px;left: 0;height: 1px;background: {{$website['fontcolor']}};}
        .loginBox .other_method_title:after{position: absolute;content:'';width: 25%;top: 10px;right: 0;height: 1px;background: {{$website['fontcolor']}};}
        .loginBox .other_method_loginBox{margin:25px 0;}
        .loginBox .other_method_loginBox .loginImg{width:35px;margin-bottom:5px;display: inline-block;cursor:pointer;}
        .loginBox .other_method_loginBox p{font-size:13px;color:{$website['fontcolor']};}
        .loginBox .other_method_loginBox .disf div{margin-right:5px;}
        .loginBox .other_method_loginBox .disf div:last-child{margin-right:0px;}
        .loginBox .signTip{color:{{$website['fontcolor']}};margin-top:10px;font-size:14px;}
        .loginBox .signTip a{color:{{$website['fontcolor']}};text-decoration: underline;}
        .loginBox input{appearance:none !important;background:unset !important;}


        /*微信公众号扫码pc*/
        @media screen and (min-width: 769px) {
            #wxapplogin{display:none;}
            #wxqrlogin{display:block;}
        }
        /*微信公众号扫码h5*/
        @media screen and (max-width: 768px) {
            #wxapplogin{display:block;}
            #wxqrlogin{display:none;}
            .loginBox{width:100%;}
        }

        @media (max-width:992px){
            .container_content{margin-top:15px;}
            #content{margin-top:40px;}
            #content .container{width:90%;}
            .content .control-group .phone,.content .control-group .email{width:53%;}
            .content{padding:10px 10px;}
            .layui-fluid,.layui-card-body{padding:0;}
        }
    </style>
    <section id="content" class="non_topimg" >
        <div class="container">
            <div class="content" >
                <div class="col-md-12">
                    <div class="loginBox">
                        <div class="methodDiv disf">
                            <div class="methodBox methodAct" onclick="change_method(1,this)">邮箱登录</div>
                            <div class="methodBox" onclick="change_method(2,this)">手机登录</div>
                        </div>
                        <form name="sentMessage" id="loginForm2" novalidate>
                            <div class="methodContent ">
                                <input type="hidden" name="reg_method" id="reg_method" value="2">
                                <div class="numberDiv email_login">
                                    <input type="text" class="form-control" placeholder="请输入您的电子邮箱" id="email" name="email" value="" required />
                                </div>
                                <div class="numberDiv phone_login">
                                    <div class="disf">
                                        <div class="selectBox">
                                            <select name="country_code" id="country_code" class="country_code">
                                                @foreach($country_code as $k=>$vo)
                                                <option value="{{$vo['id']}}" @if($vo['id']==162)
                                                    selected
                                                @endif>{{$vo['param6']}} {{$vo['param8']}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <input type="text" class="form-control" placeholder="请输入您的手机号码" id="phone" name="phone" required />
                                    </div>
                                </div>
                                <div class="codeDiv disf">
                                    <input type="text" class="form-control" placeholder="请输入6位验证码" id="code" name="code" value="" required/>
                                    <div class="sendcode" onclick="send_code()" id="sendCode">获取验证码</div>
                                </div>
                            </div>
                            <button type="submit" class="btn pull-center btn-submit">登录/注册</button><br />
                            <p style="font-size:14px;color:{{$website['fontcolor']}};text-align: left;margin-top:10px;">未注册的手机/邮箱验证通过后将自动注册</p>
                        </form>
                        <div class="other_method_title">授权登录(仅支持已注册会员)</div>
                        <div class="other_method_loginBox">
                            <div class="disf" style="justify-content: center;">
                                @foreach($authlogin_apps as $k=>$vo)
                                <div>
                                    <img src="https://shop.gogo198.cn/{{$vo['icon']}}" alt="" class="loginImg" title="{{$vo['name']}}" onclick="other_login({{$vo['id']}})">
                                    <p>{{$vo['name']}}</p>
                                </div>
                                @endforeach
{{--                                <a href="https://gogo198.us.auth0.com/v2/logout?client_id=3LuZWceTu0CTzV5z4VBXfDWMaEE3yIVF&returnTo=https://www.gogo198.cn/auth/protected_resource">Google注销</a>--}}
                            </div>
                        </div>
                        <div class="signTip">
                            自动登录/注册即代表同意已阅读 Gogo 的 <a href="/rule_detail?pid=28&id=28" target="_blank">《用户条款》</a> 和 <a href="/rule_detail?pid=36&id=36" target="_blank">《私隐政策》</a>。
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--微信小程序登录-->
    <div id="wx_miniprogram_qrcode" style="display: none;text-align: center;padding:10px;box-sizing: border-box;"><img src="/images/gogo_miniprogram.png" alt="" style="width: 200px;"></div>

    <script src="/assets/d2eace91/js/jquery.js?v=20180418"></script>
    <script src="/assets/d2eace91/layui/layui.js"></script>
    <script src="/assets/d2eace91/js/chosen/jquery.chosen.js?v=1.3"></script>
    <script type="text/javascript" charset="utf-8">
        layui.use(['layer','form','laydate','upload'],function() {
            var $ = layui.$
                , layer = layui.layer
                , form = layui.form
                , laydate = layui.laydate
                , upload = layui.upload;

            $('.country_code').chosen();

            // $('.country_code').on('change', function(e, params) {
            //     $.getJSON("?s=gather/getminiprogramcode", {pa:4,id:params.selected}, function(data) {
            //         $('.loginBox .methodContent .phone_login .selectBox .chosen-container-single .chosen-single span').text(data.data);
            //
            //     });
            // });

            $('#loginForm2').submit(function(){
                // let json = $('#regForm').serialize();

                let number = '';
                let country_code = 0;
                if($('#reg_method').val()==1){
                    number = $('#phone').val();
                    if(number==''){
                        alert('请输入您的手机号码');return false;
                    }
                    country_code = $('#country_code').val();
                }else if($('#reg_method').val()==2){
                    number = $('#email').val();
                    if(number==''){
                        alert('请输入您的邮箱地址');return false;
                    }
                }

                if($('#code').val()==''){
                    alert('请输入验证码');return false;
                }

                layer.load();
                $.ajax({
                    url: "/login",
                    method: 'post',
                    data: {'reg_method':$('#reg_method').val(),'SmsLoginModel[account]':number,'country_code':country_code,'SmsLoginModel[smsCaptcha]':$('#code').val(),'SmsLoginModel[captcha]':'','SmsLoginModel[rememberMe]':'','act':'act_login','back_act':'','back_url':'','ajax_layout':1,'_token':"{{csrf_token()}}"},
                    dataType: 'JSON',
                    success: function (res) {
                        var $ = layui.$
                            , layer = layui.layer;

                        layer.closeAll('loading');

                        if(res.code==-1){
                            alert(res.message);
                            return false;
                        }else{
                            alert(res.message);
                            if("{{$open}}"==1){
                                parent.location.href="/?s=index/thanks";
                            }else if("{{$open}}"==2){
                                window.location.href="http://chat.gogo198.net/?s=index/chat&refresh=1&uid="+res.uid;
                            }else if("{{$open}}"==3){
                                var layer = layui.layer;
                                var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                                parent.layer.close(index);
                            }else if("{{$open}}"==4){
                                if("{{$param2}}"!=''){
                                    window.location.href="{!! $param2 !!}";
                                }else{
                                    window.history.back(-1);
                                }
                            }else if("{{$open}}"==5){
                                window.location.href="/?s=index/save_template&buss_pid={$param[0]}&buss_id={$param[1]}&ordersn={$param[2]}";
                            }else{
                                // if(res.company==1){
                                // 	//有企业，跳转去选择页（入口）
                                // 	setTimeout(function(){
                                // 		window.location.href='/?s=index/change_identity';
                                // 	},1000);
                                // }else{
                                //会员中心
                                window.location.href='/';
                                // window.location.href='/member_center';
                                // }
                            }
                        }
                    },
                    error: function (data) {

                    }
                });

                return false;
            });
        });

        $(function(){
            $('#reg_method').change(function(){
                let val = $(this).val();
                if(val==1){
                    $('.email').hide();
                    $('.phone').show();
                }else if(val==2){
                    $('.email').show();
                    $('.phone').hide();
                }
            });


        });

        function change_method(typ,t){
            if(typ==1){
                $('.email_login').show();
                $('.phone_login').hide();
                $('#code').val("");
                $('#reg_method').val(2);
            }
            else if(typ==2){
                $('.email_login').hide();
                $('.phone_login').show();
                $('#code').val("");
                $('#reg_method').val(1);
            }
            $(t).addClass('methodAct');
            $(t).siblings().removeClass('methodAct');
        }

        function other_login(typ){
            var $ = layui.$
                , layer = layui.layer;

            if(typ==1){
                //微信
                // layer.confirm('使用微信授权时可能会受到网页拦截，如有拦截时请在浏览器右上角点击“始终允许”按钮，并重复操作', {
                // 	btn: ['我已知晓', '取消']
                // }, function () {
                layer.open({
                    type: 1,
                    title: "微信扫码登录",
                    closeBtn: 1,
                    area: ['auto'],
                    shadeClose: true,
                    content: $('#wx_qrcode')
                });
                // }, function (){
                //
                // });
            }
            else if(typ==2){
                //微信小程序
                // layer.open({
                //     type: 1,
                //     title: "微信小程序扫码登录",
                //     closeBtn: 1,
                //     area: ['auto'],
                //     shadeClose: true,
                //     content: $('#wx_miniprogram_qrcode')
                // });

                $.getJSON("getminiprogramcode", {pa:1,'_token':"{{csrf_token()}}"}, function(data) {
                    layer.open({
                        type: 1,
                        title: '微信小程序登录：',
                        shadeClose: true,
                        shade: 0.3,
                        area: ['300px', '300px'],
                        content: '<div style="padding:20px;text-align: center;"><img src="'+data.img+'" style="width:180px;"><p style="margin-top:15px;font-size: 15px;color:#fff;text-align: center;">请打开手机扫描</p></div>',
                    });
                    //开始每5秒查询
                    var timer = setInterval(function(){
                        $.getJSON("getminiprogramcode", {pa:2,auth_id:data.auth_id,'_token':"{{csrf_token()}}"}, function(data2) {
                            if(data2.code==1){
                                //授权成功
                                // alert(data2.msg);
                                if(data2.code==-1){
                                    alert(data2.msg);
                                    return false;
                                }else{
                                    alert(data2.msg);
                                    if("{{$open}}"==1){
                                        parent.location.href="/?s=index/thanks";
                                    }else if("{{$open}}"==2){
                                        window.location.href="http://chat.gogo198.net/?s=index/chat&refresh=1&uid="+data2.uid;
                                    }else if("{{$open}}"==3){
                                        clearInterval(timer);
                                        var layer = layui.layer;
                                        var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                                        parent.layer.close(index);
                                    }else if("{{$open}}"==4){
                                        clearInterval(timer);
                                        if("{{$param2}}"!=''){
                                            window.location.href="{!! $param2 !!}";
                                        }else{
                                            window.history.back(-1);
                                        }
                                    }else if("{{$open}}"==5){
                                        window.location.href="/?s=index/save_template&buss_pid={$param[0]}&buss_id={$param[1]}&ordersn={$param[2]}";
                                    }else{
                                        // if(res.company==1){
                                        // 	//有企业，跳转去选择页（入口）
                                        // 	setTimeout(function(){
                                        // 		window.location.href='/?s=index/change_identity';
                                        // 	},1000);
                                        // }else{
                                        clearInterval(timer);
                                        //会员中心
                                        window.location.href='/';

                                        // window.location.href='/member_center';
                                        // }
                                    }
                                }
                            }else if(data2.code==-1){
                                //拒绝授权
                                // alert(data2.msg);
                                window.location.reload();
                            }else if(data2.code==0){
                                //继续每5秒查询你
                            }
                        });
                    },5000);
                });
            }
            else if(typ==3){
                //auth0登录
                window.location.href='https://gogo198.us.auth0.com/authorize?response_type=code&client_id=3LuZWceTu0CTzV5z4VBXfDWMaEE3yIVF&redirect_uri=https://www.gogo198.cn/auth/authorization_callback&scope=openid%20profile%20email&state={{csrf_token()}}';
                {{--window.location.href='https://gogo198.us.auth0.com/authorize?response_type=code&client_id=3LuZWceTu0CTzV5z4VBXfDWMaEE3yIVF&scope=openid%20profile%20email&redirect_uri=https://www.gogo198.net/?s=api/authorization_callback&web_origin=https://www.gogo198.cn&state={{csrf_token()}}';--}}
            }
        }

        //倒计时
        var n=60;
        function timers(){
            n-=1;
            if(n==0){
                n=60;
                $("#sendCode").html("获取验证码");
            }else{
                $("#sendCode").html(n+" 秒后可重试");
                setTimeout(function () {
                    timers();
                },1000);
            }
        }

        function send_code(){
            let val = $('#reg_method').val();
            let number = '';
            let country_code = 0;
            if(val==1){
                number = $('input[name="phone"]').val();
                if(number==''){
                    alert('手机格式错误');return false;
                }
                country_code = $('#country_code').val();
            }else if(val==2){
                number = $('input[name="email"]').val();
                var myreg=/^([a-zA-Z]|[0-9])(\w|\-)+@[a-zA-Z0-9]+\.([a-zA-Z]{2,4})$/; //邮箱正则
                if (!myreg.test(number)){
                    alert('邮箱格式错误');return false;
                }
            }
            if(n==60){
                timers();
                $.ajax({
                    url: "/register/verify_code",
                    method: 'post',
                    data: {'code_type':val,'number':number,'country_code':country_code,'islogin':1,'_token':"{{csrf_token()}}"},
                    dataType: 'JSON',
                    success: function (res) {
                        if(res.code==-1){
                            alert(res.message);
                            return false;
                        }else{

                        }
                    },
                    error: function (data) {

                    }
                });
            }
        }
    </script>
@stop