@extends('layouts.base')

@section('header_js')
    <script src="/assets/d2eace91/js/jquery.cookie.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=20180528"></script>
@stop


{{--follow_box 注意此效果只在首页面展示--}}
@section('follow_box')

@stop

@section('style_js')
    <!--页面css/js-->
    <script src="/js/index.js?v=20180528"></script>
    <script src="/js/tabs.js?v=20180528"></script>
    <script src="/js/bubbleup.js?v=20180528"></script>
    <script src="/js/jquery.hiSlider.js?v=20180528"></script>
    <script src="/js/index_tab.js?v=20180528"></script>
    <script src="/js/jump.js?v=20180528"></script>
    <script src="/js/nav.js?v=20180528"></script>
@stop

@section('content')
    <link rel="stylesheet" href="/css/goods.css?v=20180428"/>

    <link rel="stylesheet" href="/assets/d2eace91/layui/css/layui.css?v=23121"/>
    <link rel="stylesheet" href="/assets/d2eace91/js/layer/theme/default/layer.css?v=3.1.0" id="layuicss-layer">
    <script type="text/javascript" src="/assets/d2eace91/layui/layui.js"></script>
    <script src="/assets/d2eace91/layui/xm-select3.js?v=20180418"></script>

    <style>
        .disf{display:flex;align-items: center;}
        .unit{width:20px;}
        .info{display: grid;grid-template-columns: repeat(3,1fr);-moz-column-gap: 0px;column-gap: 0px;row-gap: 0px;}
        xm-select{min-width: 100px;}
        xm-select .xm-label .xm-label-block{height: 23px;line-height: 23px;}
        xm-select {min-height: 33px;line-height: 33px;}
        xm-select > .xm-label .scroll .label-content{padding:1px 30px 1px 10px;}

        /*.prescription_div{border:2px solid #ddd;}*/
        .prescription_div{position:relative;border: 1px solid #ddd;padding: 60px 10px 10px 10px;}
        .prescription_div .head{font-weight: 800;text-align: center;}
        .prescription_div .head_1{padding-bottom: 10px;border-bottom: 1px solid #ddd;padding-left: 15px;}
        .prescription_div .head_2{padding-top: 10px;}
        .prescription_div .head_2 .detail .title{width:60px;text-align: right;}
        .prescription_div .tag{font-size:15px;border:1px solid #000;padding:5px 10px;text-align: center;position: absolute;right:10px;top:10px;}
        .f20{font-size: 20px;}
        .f15{font-size: 15px;}
        .prescription_div .prescription_number{}
    </style>
    <div class="w1210">
        <!--选择患者-->
        <div class="layui-fluid">
            <div class="layui-row layui-col-space15">
                <form class="layui-form" action="" method="post" lay-filter="apply-element">
                    <input type="text" style="display:none;" name="oid" id="oid" value="{{$orderid}}">
                    <div class="layui-col-md12">
                        <div class="layui-card">
                            <div class="layui-card-body">
                                <div class="layui-form-item">
                                    <div class="layui-form-label">选择用药人</div>
                                    <div class="layui-input-block disf">
                                        <select name="patient_id" lay-search lay-filter="patient_info">
                                            <option value="">请选择用药人</option>
                                            <option value="-1">添加用药人</option>
                                            @foreach($patient as $k=>$v)
                                                <option value="{{$v['id']}}">{{$v['name']}} | {{$v['mobile']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="prescription_div" style="display:none;">
                                    <div class="head f20">处方笺</div>
                                    <div class="head_1">
                                        <div class="prescription_number disf f15"><div class="title">处方编号：</div><div class="number"></div></div>
                                    </div>
                                    <div class="head_2 info">
                                        <div class="detail f15 disf"><div class="title">姓名：</div><div class="name"></div></div>
                                        <div class="detail f15 disf"><div class="title">身份证：</div><div class="idcard"></div></div>
                                        <div class="detail f15 disf"><div class="title">年龄：</div><div class="age"></div></div>
                                        <div class="detail f15 disf"><div class="title">身高：</div><div class="height"></div></div>
                                        <div class="detail f15 disf"><div class="title">体重：</div><div class="weight"></div></div>
                                        <div class="detail f15 disf"><div class="title">手机号：</div><div class="mobile"></div></div>
                                        <div class="detail f15 disf"><div class="title">科室：</div><div class="department"></div></div>
                                        <div class="detail f15 disf"><div class="title">疾病：</div><div class="disease"></div></div>
                                        <div class="detail f15 disf"><div class="title">过敏史：</div><div class="allergy"></div></div>
                                    </div>
                                </div>
                            </div>

                            <div class="layui-form-item" style="margin-top: 25px;text-align: center;">
                                <div>
                                    <button class="layui-btn layui-btn-normal" lay-submit lay-filter="apply-element2">提交申请</button>
                                    {{--                            <button type="reset" class="layui-btn layui-btn-primary">重置</button>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        layui.use(['layer','element','table','form'],function() {
            var $ = layui.$
                , layer = layui.layer
                , element = layui.element
                , form = layui.form
                , table = layui.table;

            form.render(null,'component-form-element');

            form.on('select(is_allergy)',function(data){
                let val = data.value;

                if(val==1){
                    $('.allergy_box').show();
                }else{
                    $('.allergy_box').hide();
                }
            });

            form.on('select(patient_info)',function(data){
                let val = data.value;
                if(val==-1){
                    //跳转到添加用药人页面
                    window.location.href="/save_patient?oid={{$orderid}}";
                }else if(val!='' && val!=-1){
                    layer.load();
                    $.ajax({
                        url: "/get_patient_info",
                        method: 'post',
                        data: {'id':val},
                        dataType: 'JSON',
                        success: function (res) {
                            layer.closeAll('loading');
                            // layer.msg(res.msg,{time:2000}, function () {
                            if (res.code == 0) {
                                $('.prescription_div').append('<div class="tag">{{$tag}}</div>');
                                $('.prescription_div').find('.number').text(res.ordersn);
                                $('.prescription_div').find('.name').text(res.data.name);
                                $('.prescription_div').find('.idcard').text(res.data.idcard);
                                $('.prescription_div').find('.age').text(res.data.age);
                                $('.prescription_div').find('.mobile').text(res.data.mobile);
                                $('.prescription_div').find('.height').text(res.data.height+' CM');
                                $('.prescription_div').find('.weight').text(res.data.weight+' KG');
                                $('.prescription_div').find('.department').text(res.data.department);
                                $('.prescription_div').find('.disease').text(res.data.disease);
                                $('.prescription_div').find('.allergy').text(res.data.allergy);
                                $('.prescription_div').show();
                            }
                            // });
                        }
                    });
                }
            });

            form.on('submit(apply-element2)', function(data){
                data.field['pa'] = 1;
                $.ajax({
                    url: "/apply",
                    method: 'post',
                    data: data.field,
                    dataType: 'JSON',
                    success: function (res) {
                        layer.closeAll('loading');
                        layer.msg(res.msg,{time:2000}, function () {
                            if (res.code == 0) {
                                window.location.reload();
                            }
                        });
                    }
                });
                return false;
            });
        });

        function openWindow(id,typ,uniacid) {
            let url = '';
            if (typ == 1) {
                window.location.href = "https://shop.gogo198.cn/app/index.php?i=" + uniacid + "&c=entry&p=detail&do=order&m=sz_yi&id=" + id;
            } else if (typ == 2) {
                window.location.href = '/bill_detail?id=' + id;
            }
        }

        //校验身份证号
        function ChangeIDCard(t){
            let val = $(t).val();
            if(!isValidIDCard(val)){
                $(t).val("");
                layer.msg('请输入正确的身份证号');
                $('.age_box').hide();
            }else{
                let age = getAgeByIdCard(val);
                let age_info = age['age']+'周岁'+age['month']+'月'+age['day']+'日';
                $('.age_box').find('.age_div').html(age_info+'<input name="age" value="'+age_info+'" type="hidden">');
                $('.age_box').show();
            }
        }

        function getAgeByIdCard(idCard) {
            const birthYear = parseInt(idCard.substr(6, 4));
            const birthMonth = parseInt(idCard.substr(10, 2));
            const birthDay = parseInt(idCard.substr(12, 2));

            const today = new Date();
            let age = today.getFullYear() - birthYear;
            let month = today.getMonth()+1 - birthMonth;
            let day = today.getDate()+1 - birthDay;
            if (day < 0) {
                month--;
                day += new Date(today.getFullYear(), today.getMonth(), 0).getDate();
            }

            if (month < 0) {
                age--;
                month += 12;
            }
            return { age, month, day };
        }

        function isValidIDCard(idCard) {
            const reg = /^(\d{15}$|^\d{18}$|^\d{17}(\d|X|x))$/;
            return reg.test(idCard);
        }

        //倒计时
        var n=60;
        function timers(){
            n-=1;
            if(n==0){
                n=60;
                $("#sendCode").html("发送");
            }else{
                $("#sendCode").html(n+"重试");
                setTimeout(function () {
                    timers();
                },1000);
            }
        }

        function send_code(){
            let number = '';

            number = $('input[name="mobile"]').val();
            if(number==''){
                alert('手机格式错误');return false;
            }

            if(n==60){
                timers();
                $.ajax({
                    url: "/send_code",
                    method: 'post',
                    data: {'number':number,'type':1},
                    dataType: 'JSON',
                    success: function (res) {
                        if(res.code==-1){
                            alert(res.msg);
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