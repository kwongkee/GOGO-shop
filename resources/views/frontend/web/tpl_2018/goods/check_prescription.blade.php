{{--@extends('layouts.base')--}}
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
@section('header_js')
    <script src="/assets/d2eace91/js/jquery.cookie.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=20180528"></script>
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

{{--@section('content')--}}
    <link rel="stylesheet" href="/js/doc/invoice2.css?v=2312" />
    <link rel="stylesheet" href="/js/doc/pi_invoice.css?v=2312" />
    <link rel="stylesheet" href="/css/goods.css?v=20180428"/>
    <link rel="stylesheet" href="/assets/d2eace91/layui/css/layui.css?v=23121"/>
    <link rel="stylesheet" href="/assets/d2eace91/js/layer/theme/default/layer.css?v=3.1.0" id="layuicss-layer">
    <script type="text/javascript" src="/assets/d2eace91/layui/layui.js"></script>
    <script src="/assets/d2eace91/layui/xm-select3.js?v=20180418"></script>

    <style>
        .header-top,.header,.category-box,.site-footer,.right-sidebar-con{display:none;}
        .disf{display:flex;align-items: center;}
        .unit{width:20px;}
        .info{display: grid;grid-template-columns: repeat(3,1fr);-moz-column-gap: 20px;column-gap: 20px;row-gap: 0px;}
        xm-select{min-width: 100px;}
        xm-select .xm-label .xm-label-block{height: 23px;line-height: 23px;}
        xm-select {min-height: 33px;line-height: 33px;}
        xm-select > .xm-label .scroll .label-content{padding:1px 30px 1px 10px;}

        /*.prescription_div{border:2px solid #ddd;}*/
        .prescription_div{position:relative;border: 1px solid #ddd;padding: 60px 10px 10px 10px;}
        .prescription_div .head{font-weight: 800;text-align: center;}
        .prescription_div .head_1{padding-bottom: 10px;border-bottom: 1px solid #ddd;padding-left: 15px;}
        .prescription_div .head_2{padding-top: 10px;border-bottom: 1px solid #ddd;padding-bottom: 10px;}
        .prescription_div .head_2 .detail .title{width:60px;text-align: right;}
        .prescription_div .tag{font-size:15px;border:1px solid #000;padding:5px 10px;text-align: center;position: absolute;right:10px;top:10px;}
        .f20{font-size: 20px;}
        .f15{font-size: 15px;}
        .prescription_div .prescription_number{}

        .prescription_div .head_3{padding:10px 15px;box-sizing: border-box;border-bottom: 1px solid #ddd;}
        .prescription_div .head_3 .good_line{border-bottom: 1px dashed #ddd;margin-top:10px;}
        .prescription_div .head_3 .num_input{width:80px;}
        .prescription_div .head_3 .used_method{margin:10px 0 10px 20px;}
        .prescription_div .head_4{padding: 10px 15px;box-sizing: border-box;}
        .content{width: 100%;/**height: 610pt;**/}
        @media (max-width: 992px) {
            .layui-card{border:0;box-shadow: unset;}
            .prescription_div,.layui-fluid,.w1210,body{width:100%;min-width:100%;box-sizing: border-box;}
            .layui-fluid{padding:0;}
            .layui-col-space15{margin:0;}
            .layui-col-space15>*{box-sizing: border-box;}
            .layui-card-body{box-sizing: border-box;padding:0;}
            /*.head_2{grid-template-columns: repeat(2,1fr);-moz-column-gap: 0px;column-gap: 0px;row-gap: 0px;}*/
            .mobile_show .head_2{display:inline-block;}
            .mobile_show .head_2 .detail{display:inline-block;}
            .mobile_show .head_2 .detail:nth-child(odd){margin-right:8px;}
            /*.head_3 .info{grid-template-columns: repeat(2,1fr);-moz-column-gap: 0px;column-gap: 0px;row-gap: 0px;}*/
            .mobile_show .head_3 .info{display:inline-block;}
            .mobile_show .head_3 .info .f15{display:inline-block;}
            .mobile_show .head_3 .info .goption,.mobile_show .head_3 .info .gnum{margin-left:20px;}
        }
    </style>
    <div class="w1210">
        <!--选择患者-->
        <div class="layui-fluid">
            <div class="layui-row layui-col-space15">
                <form class="layui-form" action="" method="post" lay-filter="apply-element">
                    <input type="text" style="display:none;" name="id" id="id" value="{{$id}}">
                    <div class="layui-col-md12">
                        <div class="layui-card">
                            <div class="layui-card-body">
                                @if($prescription['status']==1)
                                    <!--未开具-->
                                    <div class="prescription_div" id="printId">
                                        <div class="content">
                                            <div>
                                                <div class="pi-bg" style="background:#fff;color: #000;">
                                                    <div class="tag">{{$tag}}</div>
                                                    <div class="head f20">处方笺</div>
                                                    <div class="head_1">
                                                        <div class="prescription_number disf f15"><div class="title">处方编号：</div><div class="number">{{$prescription['ordersn']}}</div></div>
                                                    </div>
                                                    <div class="head_2 info">
                                                        <div class="detail f15 disf"><div class="title">姓名：</div><div class="name">{{$patient['name']}}</div></div>
                                                        <div class="detail f15 disf"><div class="title">身份证：</div><div class="idcard">{{$patient['idcard']}}</div></div>
                                                        <div class="detail f15 disf"><div class="title">年龄：</div><div class="age">{{$patient['age']}}</div></div>
                                                        <div class="detail f15 disf"><div class="title">身高：</div><div class="height">{{$patient['height']}} CM</div></div>
                                                        <div class="detail f15 disf"><div class="title">体重：</div><div class="weight">{{$patient['weight']}} KG</div></div>
                                                        <div class="detail f15 disf"><div class="title">手机号：</div><div class="mobile">{{$patient['mobile']}}</div></div>
                                                        <div class="detail f15 disf"><div class="title">科室：</div><div class="department">{{$patient['department']}}</div></div>
                                                        <div class="detail f15 disf"><div class="title">疾病：</div><div class="disease">{{$patient['disease']}}</div></div>
                                                        <div class="detail f15 disf"><div class="title">过敏史：</div><div class="allergy">{{$patient['allergy']}}</div></div>
                                                    </div>
                                                    <div class="head_3">
                                                        <div class="rp f20">RP.</div>

                                                        @foreach($order['content']['buy_attr'] as $k=>$v)
                                                            <div class="good_line">
                                                                <div class="info">
                                                                    <div class="gname f15">{{$k+1}}.&nbsp;{{$good['goods_name']}}</div>
                                                                    <div class="goption f15 disf">
                                                                        <input type="text" class="layui-input num_input" name="opt[{{$k}}][0]" value="{{$value['drug']['option']['opt'][0]}}">
                                                                        <div class="sel_input">
                                                                            <select name="opt_unit[{{$k}}][0]" lay-search>
                                                                                <option value=""></option>
                                                                                @foreach($unit['unit'] as $k2=>$vo)
                                                                                    <option value="{{$vo['code_value']}}" @if($value['drug']['option']['opt_unit'][0]==$vo['code_value'])
                                                                                    selected
                                                                                            @endif>{{$vo['code_name']}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <span class="span1 f15">×</span>
                                                                        <input type="text" class="layui-input num_input" name="opt[{{$k}}][1]" value="{{$value['drug']['option']['opt'][1]}}">
                                                                        <div class="sel_input">
                                                                            <select name="opt_unit[{{$k}}][1]" lay-search>
                                                                                <option value=""></option>
                                                                                @foreach($unit['num_unit'] as $k2=>$vo)
                                                                                    <option value="{{$vo['id']}}" @if($value['drug']['option']['opt_unit'][1]==$vo['id'])
                                                                                    selected
                                                                                            @endif>{{$vo['name']}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="gnum f15">X{{$v['buy_num']}}{{$good_unit['unit']}}</div>
                                                                </div>
                                                                <div class="used_method f15 disf">
                                                                    用法：&nbsp;&nbsp;
                                                                    <div class="sel_input2">
                                                                        <select name="used_unit[{{$k}}][0]" lay-search>
                                                                            <option value=""></option>
                                                                            @foreach($unit['interval_unit'] as $k2=>$vo)
                                                                                <option value="{{$vo['id']}}" @if($value['drug']['used']['used_unit'][0]==$vo['id'])
                                                                                selected
                                                                                        @endif>{{$vo['name']}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    ，每次&nbsp;
                                                                    <input type="text" class="layui-input num_input" name="used[{{$k}}][0]" value="{{$value['drug']['used']['used'][0]}}">
                                                                    <div class="sel_input">
                                                                        <select name="used_unit[{{$k}}][1]" lay-search>
                                                                            <option value=""></option>
                                                                            @foreach($unit['num_unit'] as $k2=>$vo)
                                                                                <option value="{{$vo['id']}}" @if($value['drug']['used']['used_unit'][1]==$vo['id'])
                                                                                selected
                                                                                        @endif>{{$vo['name']}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    ，
                                                                    <div class="sel_input">
                                                                        <select name="used_unit[{{$k}}][2]" lay-search>
                                                                            <option value=""></option>
                                                                            @foreach($unit['eat_unit'] as $k2=>$vo)
                                                                                <option value="{{$vo['id']}}" @if($value['drug']['used']['used_unit'][2]==$vo['id'])
                                                                                selected
                                                                                        @endif>{{$vo['name']}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    ，
                                                                    <div class="sel_input">
                                                                        <select name="used_unit[{{$k}}][3]" lay-search>
                                                                            <option value=""></option>
                                                                            @foreach($unit['road_unit'] as $k2=>$vo)
                                                                                <option value="{{$vo['id']}}" @if($value['drug']['used']['used_unit'][3]==$vo['id'])
                                                                                selected
                                                                                        @endif>{{$vo['name']}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="head_4">
                                                        <div class="detail f15 disf">
                                                            <div class="title">处方签署：
                                                            </div>
                                                            <div class="sign_file">
                                                                <a href="https://shop.gogo198.cn/{{$doctor['role_content']['sign_file'][0]}}" target="_blank"><img src="https://shop.gogo198.cn/{{$doctor['role_content']['sign_file'][0]}}" alt="" style="width: 80px;"></a>
                                                                &nbsp;
                                                                <div class="layui-btn refresh_upload" onclick="refresh_upload()">重新上传</div>
                                                            </div>
                                                            <div class="upload_file" style="display: none;">
                                                                <div class="layui-upload" style="text-align:left;width: 100%;">
                                                                    <button type="button" class="layui-btn" id="sign_file-upload">上传文件</button>
                                                                    <blockquote class="layui-elem-quote layui-quote-nm yulan" style="margin-top: 10px;">
                                                                        预览图：
                                                                        <div class="layui-upload-list" id="sign_file-upload-list"></div>
                                                                    </blockquote>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($prescription['status']==2)
                                    <!--已开具-->
                                    <div class="prescription_div mobile_show" style="display: none;">
                                        <div class="content">
                                            <div>
                                                <div class="pi-bg" style="background:#fff;color: #000;">
                                                    <div class="tag">{{$tag}}</div>
                                                    <div class="head f20">处方笺</div>
                                                    <div class="head_1">
                                                        <div class="prescription_number disf f15"><div class="title">处方编号：</div><div class="number">{{$prescription['ordersn']}}</div></div>
                                                    </div>
                                                    <div class="head_2 info">
                                                        <div class="detail f15 "><div class="disf"><div class="title">姓名：</div><div class="name">{{$patient['name']}}</div></div></div>
                                                        <div class="detail f15 "><div class="disf"><div class="title">身份证：</div><div class="idcard">{{$patient['idcard']}}</div></div></div>
                                                        <div class="detail f15 "><div class="disf"><div class="title">年龄：</div><div class="age">{{$patient['age']}}</div></div></div>
                                                        <div class="detail f15 "><div class="disf"><div class="title">身高：</div><div class="height">{{$patient['height']}} CM</div></div></div>
                                                        <div class="detail f15 "><div class="disf"><div class="title">体重：</div><div class="weight">{{$patient['weight']}} KG</div></div></div>
                                                        <div class="detail f15 "><div class="disf"><div class="title">手机号：</div><div class="mobile">{{$patient['mobile']}}</div></div></div>
                                                        <div class="detail f15 "><div class="disf"><div class="title">科室：</div><div class="department">{{$patient['department']}}</div></div></div>
                                                        <div class="detail f15 "><div class="disf"><div class="title">疾病：</div><div class="disease">{{$patient['disease']}}</div></div></div>
                                                        <div class="detail f15 "><div class="disf"><div class="title">过敏史：</div><div class="allergy">{{$patient['allergy']}}</div></div></div>
                                                    </div>
                                                    <div class="head_3">
                                                        <div class="rp f20">RP.</div>
                                                        @foreach($order['content']['buy_attr'] as $k=>$v)
                                                            <div class="good_line">
                                                                <div class="info">
                                                                    <div class="gname f15">{{$k+1}}.&nbsp;{{$good['goods_name']}}</div>
                                                                    <div class="goption f15 ">
                                                                        <div class="disf">
                                                                            {{$prescription['content']['opt'][$k][0]}}
                                                                            @foreach($unit['unit'] as $k2=>$vo)
                                                                                @if($prescription['content']['opt_unit'][$k][0]==$vo['code_value'])
                                                                                    {{$vo['code_name']}}
                                                                                @endif
                                                                            @endforeach
                                                                            <span class="span1 f15">×</span>
                                                                            {{$prescription['content']['opt'][$k][1]}}
                                                                            @foreach($unit['num_unit'] as $k2=>$vo)
                                                                                @if($prescription['content']['opt_unit'][$k][1]==$vo['id'])
                                                                                    {{$vo['name']}}
                                                                                @endif
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                    <div class="gnum f15">X{{$v['buy_num']}}{{$good_unit['unit']}}</div>
                                                                </div>
                                                                <div class="used_method f15 disf">
                                                                    用法：&nbsp;&nbsp;
                                                                    @foreach($unit['interval_unit'] as $k2=>$vo)
                                                                        @if($prescription['content']['used_unit'][$k][0]==$vo['id'])
                                                                            {{$vo['name']}}
                                                                        @endif
                                                                    @endforeach
                                                                    ，每次&nbsp;{{$prescription['content']['used'][$k][0]}}
                                                                    @foreach($unit['num_unit'] as $k2=>$vo)
                                                                        @if($prescription['content']['used_unit'][$k][1]==$vo['id'])
                                                                            {{$vo['name']}}
                                                                        @endif
                                                                    @endforeach
                                                                    @foreach($unit['eat_unit'] as $k2=>$vo)
                                                                        @if($prescription['content']['used_unit'][$k][2]==$vo['id'])
                                                                            {{$vo['name']}}
                                                                        @endif
                                                                    @endforeach
                                                                    @foreach($unit['road_unit'] as $k2=>$vo)
                                                                        @if($prescription['content']['used_unit'][$k][3]==$vo['id'])
                                                                            {{$vo['name']}}
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="head_4">
                                                        <div class="detail f15 disf">
                                                            <div class="title">医师：</div>
                                                            <div class="sign_file">
                                                                <img src="{{$doctor['role_content']['sign_file'][0]}}" alt="" id="signImg" style="width: 80px;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--PC版和Mob版的导出PDF要展示PC版的样式-->
                                    <div class="prescription_div pc_show" id="printId" style="display: none;">
                                        <div class="content">
                                            <div>
                                                <div class="pi-bg" style="background:#fff;color: #000;">
                                                    <div class="tag">{{$tag}}</div>
                                                    <div class="head f20">处方笺</div>
                                                    <div class="head_1">
                                                        <div class="prescription_number disf f15"><div class="title">处方编号：</div><div class="number">{{$prescription['ordersn']}}</div></div>
                                                    </div>
                                                    <div class="head_2 info">
                                                        <div class="detail f15 "><div class="disf"><div class="title">姓名：</div><div class="name">{{$patient['name']}}</div></div></div>
                                                        <div class="detail f15 "><div class="disf"><div class="title">身份证：</div><div class="idcard">{{$patient['idcard']}}</div></div></div>
                                                        <div class="detail f15 "><div class="disf"><div class="title">年龄：</div><div class="age">{{$patient['age']}}</div></div></div>
                                                        <div class="detail f15 "><div class="disf"><div class="title">身高：</div><div class="height">{{$patient['height']}} CM</div></div></div>
                                                        <div class="detail f15 "><div class="disf"><div class="title">体重：</div><div class="weight">{{$patient['weight']}} KG</div></div></div>
                                                        <div class="detail f15 "><div class="disf"><div class="title">手机号：</div><div class="mobile">{{$patient['mobile']}}</div></div></div>
                                                        <div class="detail f15 "><div class="disf"><div class="title">科室：</div><div class="department">{{$patient['department']}}</div></div></div>
                                                        <div class="detail f15 "><div class="disf"><div class="title">疾病：</div><div class="disease">{{$patient['disease']}}</div></div></div>
                                                        <div class="detail f15 "><div class="disf"><div class="title">过敏史：</div><div class="allergy">{{$patient['allergy']}}</div></div></div>
                                                    </div>
                                                    <div class="head_3">
                                                        <div class="rp f20">RP.</div>
                                                        @foreach($order['content']['buy_attr'] as $k=>$v)
                                                            <div class="good_line">
                                                                <div class="info">
                                                                    <div class="gname f15">{{$k+1}}.&nbsp;{{$good['goods_name']}}</div>
                                                                    <div class="goption f15 ">
                                                                        <div class="disf">
                                                                            {{$prescription['content']['opt'][$k][0]}}
                                                                            @foreach($unit['unit'] as $k2=>$vo)
                                                                                @if($prescription['content']['opt_unit'][$k][0]==$vo['code_value'])
                                                                                    {{$vo['code_name']}}
                                                                                @endif
                                                                            @endforeach
                                                                            <span class="span1 f15">×</span>
                                                                            {{$prescription['content']['opt'][$k][1]}}
                                                                            @foreach($unit['num_unit'] as $k2=>$vo)
                                                                                @if($prescription['content']['opt_unit'][$k][1]==$vo['id'])
                                                                                    {{$vo['name']}}
                                                                                @endif
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                    <div class="gnum f15">X{{$v['buy_num']}}{{$good_unit['unit']}}</div>
                                                                </div>
                                                                <div class="used_method f15 disf">
                                                                    用法：&nbsp;&nbsp;
                                                                    @foreach($unit['interval_unit'] as $k2=>$vo)
                                                                        @if($prescription['content']['used_unit'][$k][0]==$vo['id'])
                                                                            {{$vo['name']}}
                                                                        @endif
                                                                    @endforeach
                                                                    ，每次&nbsp;{{$prescription['content']['used'][$k][0]}}
                                                                    @foreach($unit['num_unit'] as $k2=>$vo)
                                                                        @if($prescription['content']['used_unit'][$k][1]==$vo['id'])
                                                                            {{$vo['name']}}
                                                                        @endif
                                                                    @endforeach
                                                                    @foreach($unit['eat_unit'] as $k2=>$vo)
                                                                        @if($prescription['content']['used_unit'][$k][2]==$vo['id'])
                                                                            {{$vo['name']}}
                                                                        @endif
                                                                    @endforeach
                                                                    @foreach($unit['road_unit'] as $k2=>$vo)
                                                                        @if($prescription['content']['used_unit'][$k][3]==$vo['id'])
                                                                            {{$vo['name']}}
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="head_4">
                                                        <div class="detail f15 disf">
                                                            <div class="title">医师：</div>
                                                            <div class="sign_file">
                                                                <img src="{{$doctor['role_content']['sign_file'][0]}}" alt="" id="signImg" style="width: 80px;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="layui-form-item" style="margin-top: 25px;text-align: center;">
                                <div>
                                    @if($prescription['status']==1)
                                        <button class="layui-btn layui-btn-normal" lay-submit lay-filter="apply-element2">确认签署</button>
                                    @elseif($prescription['status']==2)
                                        <button type="button" class="layui-btn layui-btn-normal" onclick="createPDF()">生成PDF</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="/js/doc/jquery.min.js"></script>
    <script src="/js/doc/html2canvas.min.js"></script>
    <script src="/js/doc/jspdf.min.js"></script>
    <script type="text/javascript">
        layui.use(['layer','element','table','form','upload'],function() {
            var $ = layui.$
                , layer = layui.layer
                , element = layui.element
                , form = layui.form
                , upload = layui.upload
                , table = layui.table;

            form.render(null,'component-form-element');

            upload.render({
                elem: '#sign_file-upload'
                ,url: '/upload_file'
                ,accept: 'file'
                ,data: { folder: 'shopping', type: 'doctor','_token':"{{csrf_token()}}"}
                ,multiple: false
                ,number:1
                ,before: function(obj){
                    layer.load(); //上传loading
                }
                ,done: function(res){
                    layer.closeAll('loading'); //关闭loading
                    if(res.code == 1)
                    {
                        $('#sign_file-upload-list').append('<div style="display: inline-block;"><img onclick="seePic(this);" src="https://shop.gogo198.cn/'+ res.file_path +'" class="layui-upload-img" style="width:80px;height:80px;"><button type="button" onclick="delPic(this);" class="layui-btn layui-btn-xs layui-btn-danger" style="position: relative;left: -45px;top: -39px;">删除</button><input type="text" name="sign_file[]" value="'+res.file_path+'" style="display: none;"></div>');
                    }
                }
            });

            form.on('submit(apply-element2)', function(data){
                data.field['pa'] = 1;
                data.field['_token'] = "{{csrf_token()}}";
                $.ajax({
                    url: "/check_prescription",
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

            if (isMobile()) {
                $('.mobile_show').show();
                $('.pc_show').hide();
            }else{
                $('.mobile_show').hide();
                $('.pc_show').show();
            }
        });

        function refresh_upload(){
            var $ = layui.$
                , layer = layui.layer;

            $('.upload_file').show();
            $('.sign_file').hide();
        }

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

        function delPic(obj)
        {
            var layer = layui.layer,$ = layui.$;
            layer.confirm('确认要删除该附件？', {
                btn: ['删除','取消']
            }, function(){
                $(obj).parent().remove();
                layer.closeAll();
            }, function(){

            });
        }

        function seePic(thi){
            var layer = layui.layer
                ,$ = layui.jquery;

            layer.open({
                type:1,
                title:'查看图片',
                area:['100%','100%'],
                content:'<img src="'+$(thi).attr('data-img')+'" class="layui-upload-img" onerror=src="https://shop.gogo198.cn/attachment/images/default_file.png" style="width:100%;height:100%;">'
            });
        }

        function isMobile() {
            return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
        }

        function createPDF() {
            if (isMobile()) {
                $('.pc_show').css('width','1210px');
                $('.pc_show').show();
            }
            html2canvas(document.querySelector("#printId"), {
                allowTaint: !0,
                scale: 2
            }).then((function(canvas) {

                var contentWidth = canvas.width;
                var contentHeight = canvas.height;
                //一页pdf显示html页面生成的canvas高度;
                var pageHeight = contentWidth / 595.28 * 841.89;
                //未生成pdf的html页面高度
                var leftHeight = contentHeight;
                //pdf页面偏移
                var position = 0;
                //a4纸的尺寸[595.28,841.89]，html页面生成的canvas在pdf中图片的宽高1
                var imgWidth = 801.89;
                var imgHeight = 250.28;//575.28

                var pageData = canvas.toDataURL('image/jpeg', 1.0);
                // document.body.appendChild(canvas);

                var pdf = new jsPDF('l', 'pt', 'a4');
                //有两个高度需要区分，一个是html页面的实际高度，和生成pdf的页面高度(841.89)
                //当内容未超过pdf一页显示的范围，无需分页
                if (leftHeight < pageHeight) {
                    pdf.addImage(pageData, 'JPEG', 30, 10, imgWidth, imgHeight );
                } else {
                    while(leftHeight > 0) {
                        pdf.addImage(pageData, 'JPEG', 30, position, imgWidth, imgHeight);
                        leftHeight -= pageHeight;
                        position -= 821.89;
                        //避免添加空白页
                        if(leftHeight > 0) {
                            pdf.addPage();
                        }
                    }
                }

                var pdfName = '{{$prescription['ordersn']}}.pdf';
                // 将pdf输入为base格式的字符串
                var buffer = pdf.output("datauristring");
                // 将base64格式的字符串转换为file文件
                var myfile = dataURLtoFile(buffer, pdfName);
                var formdata = new FormData();
                formdata.append('file', myfile);
                formdata.append('folder', 'payer_pay');
                formdata.append('type', 'highway_manifest');


                //保存水路货物运单
                // $.ajax({
                //     url:"{:url('admin/Entrustdecl/waterway_paper_info')}",
                //     method:'post',
                //     data:{type:'wateway',ship_mark:ship_mark,ordersn:lading_no},
                //     dataType:'JSON',
                //     success:function(res){
                        pdf.save(pdfName);
                if (isMobile()) {
                    $('.pc_show').hide();
                }
                //     },
                //     error:function (data) {
                //         alert('系统错误');
                //     }
                // })
            }))
        }

        //将base64转换为文件对象
        function dataURLtoFile(dataurl, filename) {
            var arr = dataurl.split(',');
            var mime = arr[0].match(/:(.*?);/)[1];
            var bstr = atob(arr[1]);
            var n = bstr.length;
            var u8arr = new Uint8Array(n);
            while(n--){
                u8arr[n] = bstr.charCodeAt(n);
            }
            //转换成file对象
            return new File([u8arr], filename, {type:mime});
            //转换成成blob对象
            //return new Blob([u8arr],{type:mime});
        }
    </script>
{{--@stop--}}