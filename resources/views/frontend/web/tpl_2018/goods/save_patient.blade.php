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
    </style>
    <div class="w1210">

        <!--患者信息-->
        <div class="layui-fluid">
            <div class="layui-row layui-col-space15">
                <form class="layui-form" action="" method="post" lay-filter="component-form-element">
                    <input type="text" style="display:none;" name="oid" id="oid" value="{{$orderid}}">
                    <div class="layui-col-md12">
                        <div class="layui-card">
                            <div class="layui-card-body">
                                <div class="info">
                                    <div class="layui-form-item">
                                        <div class="layui-form-label">姓名</div>
                                        <div class="layui-input-block disf">
                                            <input type="text" class="layui-input" name="name" value="" placeholder="姓名" lay-verify="required">
                                        </div>
                                    </div>
                                    <div class="layui-form-item">
                                        <div class="layui-form-label">身份证</div>
                                        <div class="layui-input-block disf">
                                            <input type="text" class="layui-input" name="idcard" value="" placeholder="身份证" onchange="ChangeIDCard(this)" lay-verify="required">
                                        </div>
                                    </div>
                                    <div class="layui-form-item age_box" style="display: none;">
                                        <div class="layui-form-label">年龄</div>
                                        <div class="layui-input-block disf">
                                            <div class="age_div"></div>
                                        </div>
                                    </div>
                                    <div class="layui-form-item">
                                        <div class="layui-form-label">身高</div>
                                        <div class="layui-input-block disf">
                                            <input type="number" class="layui-input" name="height" value="" placeholder="身高">&nbsp;<span class="unit">CM</span>
                                        </div>
                                    </div>
                                    <div class="layui-form-item">
                                        <div class="layui-form-label">体重</div>
                                        <div class="layui-input-block disf">
                                            <input type="number" class="layui-input" name="weight" value="" placeholder="体重">&nbsp;<span class="unit">KG</span>
                                        </div>
                                    </div>
                                    <div class="layui-form-item">
                                        <div class="layui-form-label">手机</div>
                                        <div class="layui-input-block disf">
                                            <input type="number" class="layui-input" name="mobile" value="" placeholder="手机" lay-verify="required">
                                            <input type="number" class="layui-input" name="code" value="" placeholder="验证码" lay-verify="required">
                                            <div class="layui-btn" onclick="send_code()" id="sendCode">发送</div>
                                        </div>
                                    </div>
                                    <div class="layui-form-item">
                                        <div class="layui-form-label">临床诊断</div>
                                        <div class="layui-input-block disf">
                                            <div id="disease_id" class="xm-select-demo"></div>
                                        </div>
                                    </div>
                                    <div class="layui-form-item">
                                        <div class="layui-form-label">过敏史</div>
                                        <div class="layui-input-block disf">
                                            <select name="is_allergy" lay-filter="is_allergy">
                                                <option value="0">未发现</option>
                                                <option value="1">有过敏史</option>
                                            </select>
                                            <div class="allergy_box" style="display: none;">
                                                <div id="allergy_id" class="xm-select-demo"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item" style="margin-top: 25px;text-align: center;">
                        <div>
                            <button class="layui-btn layui-btn-normal" lay-submit lay-filter="component-form-element2">保存并申请</button>
                            {{--                            <button type="reset" class="layui-btn layui-btn-primary">重置</button>--}}
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

            //过敏史
            let allergy_id = xmSelect.render({
                el: '#allergy_id',
                autoRow: true, //自动换行
                filterable: true, //可搜索
                searchTips: '请搜索',
                radio: false,
                name: "allergy_id",
                model: {
                    icon: 'hidden',//是否展示复选框或者单选框图标 show, hidden:变换背景色  ！！这句话是重点，不然会变成父节点也有单选框！！
                    label: {
                        type: 'block',
                        block: {
                            //最大显示数量, 0:不限制
                            showCount: 1,
                            //是否显示删除图标
                            showIcon: true,
                        }
                    },
                },
                prop:{
                    name: 'name',
                    value: 'id',
                },
                tree: {
                    show: true, //用树显示
                    showFolderIcon: true, //是否显示节点前的三角图标
                    expandedKeys: false, //默认全部展开
                    showLine: true, //显示渐近线
                    indent: 20, //间距
                    strict: false, //重点！！设置成非严格父子模式，这样父节点被禁用，子节点依然可以点击
                    clickCheck: true,
                    vaguaSearch:0,//关闭模糊搜索
                },
                toolbar: {
                    show: false, //显示工具条
                    list: ['ALL', 'REVERSE', 'CLEAR']
                },
                height: '300px', //最大下拉框高度
                data: {!! $allergy !!},
                initValue:[],
            });
            //疾病
            let disease_id = xmSelect.render({
                el: '#disease_id',
                autoRow: true, //自动换行
                filterable: true, //可搜索
                searchTips: '请搜索',
                radio: true,
                name: "disease_id",
                model: {
                    icon: 'hidden',//是否展示复选框或者单选框图标 show, hidden:变换背景色  ！！这句话是重点，不然会变成父节点也有单选框！！
                    label: {
                        type: 'block',
                        block: {
                            //最大显示数量, 0:不限制
                            showCount: 1,
                            //是否显示删除图标
                            showIcon: true,
                        }
                    },
                },
                prop:{
                    name: 'cat_name',
                    value: 'cat_id',
                },
                tree: {
                    show: true, //用树显示
                    showFolderIcon: true, //是否显示节点前的三角图标
                    expandedKeys: false, //默认全部展开
                    showLine: true, //显示渐近线
                    indent: 20, //间距
                    strict: false, //重点！！设置成非严格父子模式，这样父节点被禁用，子节点依然可以点击
                    clickCheck: true,
                    vaguaSearch:0,//关闭模糊搜索
                },
                toolbar: {
                    show: false, //显示工具条
                    list: ['ALL', 'REVERSE', 'CLEAR']
                },
                height: '300px', //最大下拉框高度
                data: {!! $disease !!},
                initValue:[],
            });

            form.render(null,'component-form-element');

            form.on('select(is_allergy)',function(data){
                let val = data.value;

                if(val==1){
                    $('.allergy_box').show();
                }else{
                    $('.allergy_box').hide();
                }
            });

            form.on('submit(component-form-element2)', function(data){
                data.field['pa'] = 1;
                $.ajax({
                    url: "/save_patient",
                    method: 'post',
                    data: data.field,
                    dataType: 'JSON',
                    success: function (res) {
                        layer.closeAll('loading');
                        layer.msg(res.msg,{time:2000}, function () {
                            if (res.code == 0) {

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