@extends('layouts.inner_header')

@section('content')
    <link rel="stylesheet" href="/assets/d2eace91/layui/css/layui.css?v=23121"/>
    <link rel="stylesheet" href="/assets/d2eace91/js/layer/theme/default/layer.css?v=3.1.0" id="layuicss-layer">
    <script type="text/javascript" src="/assets/d2eace91/layui/layui.js"></script>
    <script src="/assets/d2eace91/js/jquery.js?v=1.1"></script>

    <style>
        #content{padding-top:20px;padding-bottom:20px;background:{{$website['background']}};}
        .content{padding:20px 20px;box-sizing:border-box;height:630px;}
        /**添加地址**/
        .sort_div select{display:none !important;}
        .sort_div,.addr{display: grid;grid-template-columns: repeat(1,1fr);-moz-column-gap: 0px;column-gap: 0px;row-gap: 0px;}
        .postal_temp{border:1px solid #000;width: 48px;height: 38px;text-align: center;line-height: 38px;margin-right:2px;}
        .postal_code{margin-right:2px;}
        .addr{width:100%;}
        .hide2{display: none;}
        .sort_div, .addr{padding:15px;box-sizing: border-box;}
        .sort_div{padding-bottom: 0;}
        .addr{padding-top: 0;}
        @media (max-width: 992px){
            .sort_div, .addr{grid-template-columns: repeat(1,1fr);}
        }
        .layui-form-label,.layui-input-block{font-size:15px;}
        .upd_txt{line-height: 38px;}
        @if($isframe==1)
            /*内置框打开*/
            header,.header,.footer,footer{display: none !important;}
            .w1200{width: 100%;}
            #content{padding-top:0;}
            .detail_topimg, .non_topimg{margin-top:0;}
        @endif
    </style>

    <section id="content" class="non_topimg">
        <div class="w1200">
            <p class="navbar_menu"><i class="fa fa-sign-in" style="margin-right:5px;display:none;"></i><a href="/">HOME</a>&nbsp;<span style="color:{{$website['fontcolor']}};">\</span>&nbsp;<a href="javascript:history.back(-1);">收货地址列表</a>&nbsp;<span style="color:{{$website['fontcolor']}};">\</span>&nbsp;<span style="color:{{$website['fontcolor']}};">保存收货地址</span>&nbsp;</p>
            <div class="address_div" style="padding:15px;box-sizing: border-box;">
                <form class="layui-form" action="" method="post" lay-filter="address-element">
                    <input type="hidden" name="id" value="{{$id}}">
                    <div class="layui-card">
                        <div class="layui-card-body" style="padding:0;">
                            <div class="sort_div">
                                <div class="layui-form-item">
                                    <div class="layui-form-label">国地</div>
                                    <div class="layui-input-block">
                                        <!--<div id="xmselect_country" class="xm-select-demo" style="width:100%;"></div>-->
                                        <style>
                                            .countryBox{display:inline-block;margin-left:5px;}
                                            .countryBox:first-child{margin-left:0;}
                                            .countryDiv{width:100px;}
                                        </style>
                                        @if($id>0)
                                            <p class="upd_txt">{{$address['detail_area']}}</p>
                                        @else
                                            <div class="countryDiv countryBox">
                                                <select name="country" id="country" lay-verify="required" lay-search lay-filter="country">
                                                    <option value="">请选择国地</option>
                                                    @foreach($country as $k=>$v)
                                                        <option value="{{$v['id']}}">{{$v['param2']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="countryDiv countryBox province"></div>
                                            <div class="countryDiv countryBox city"></div>
                                            <div class="countryDiv countryBox area"></div>
                                            <div class="countryDiv countryBox area2"></div>
                                            <div class="countryDiv countryBox area3"></div>
                                            <div class="countryDiv countryBox area4"></div>
                                            <div class="diycountry" style="padding:2px 5px;box-sizing:border-box;display:none;">
                                                <input class="layui-input countryDiv countryBox" name="diycountry[]" placeholder="请输入行政区域">

                                                <div class="layui-btn layui-btn-success add" onclick="add_diycountry(this)" style="display:inline-block;">+</div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <div class="layui-form-label">收货人名称</div>
                                    <div class="layui-input-block disf">
                                        <input type="text" class="layui-input" lay-verify="required" name="user_name1" id="user_name1" value="{{$address['user_name'][0]}}" placeholder="请输入名">
                                        <input type="text" class="layui-input" lay-verify="" name="user_name2" id="user_name2" value="{{$address['user_name'][1]}}" placeholder="请输入中间名">
                                        <input type="text" class="layui-input" lay-verify="required" name="user_name3" id="user_name3" value="{{$address['user_name'][2]}}" placeholder="请输入姓">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">联系电话</label>
                                    <div class="layui-input-block disf">
                                        <input type="text" name="area_mobile" id="area_mobile" lay-verify="required" placeholder="区号" autocomplete="off" class="layui-input" value="{{$address['area_mobile']}}" style="width:50px;" readonly>
                                        <input type="text" name="mobile" lay-verify="required" placeholder="请输入联系电话" autocomplete="off" class="layui-input" value="{{$address['mobile']}}">
                                        <input type="text" name="mobile2" lay-verify="" placeholder="请输入联系电话2" autocomplete="off" class="layui-input" value="{{$address['mobile2']}}">
                                    </div>
                                </div>
                                <div class="layui-form-item">
                                    <div class="layui-form-label">邮政编码</div>
                                    <div class="layui-input-block postal_div">
                                        @if($id>0)
                                            <p class="upd_txt">{{$address['postal_code']}}</p>
                                        @else
                                            <div class="disf">
                                                <div style="width:50px;">例子：</div>
                                                <div class="postal_rule disf"></div>
                                            </div>
                                            <div class="disf">
                                                <div style="width:50px;">填写：</div>
                                                <div class="postal_rule2 disf" style="width: 200px;"></div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="layui-form-item">
                                    <div class="layui-form-label">电子邮箱</div>
                                    <div class="layui-input-block">
                                        <input type="text" class="layui-input" lay-verify="" name="email" id="email" value="{{$address['email']}}" placeholder="请输入电子邮箱">
                                    </div>
                                </div>

                                <input type="hidden" id="address_num" value="<?php echo 1+count($address['address2']);?>">

                                <div class="layui-form-item">
                                    <div class="layui-form-label">详细地址</div>
                                    <div class="layui-input-block disf">
                                        <input type="text" class="layui-input" lay-verify="required" name="address1" value="{{$address['address1']}}" placeholder="请输入地址">
                                        <div class="layui-btn layui-btn-success add" onclick="add_address()">+</div>
                                    </div>
                                </div>
                            </div>
                            <div class="addr">
                                @if(!empty($address['address2']))
                                    @foreach($address['address2'] as $k=>$v)
                                        <div class="layui-form-item">
                                            <div class="layui-form-label">地址<?php echo $k+1;?></div>
                                                <div class="layui-input-block disf">
                                                    <input type="text" class="layui-input" lay-verify="required" name="address2[]" value="{{$v}}" placeholder="请输入地址">
                                                    <div class="layui-btn layui-btn-success add" onclick="add_address()">+</div>
                                                    <div class="layui-btn layui-btn-danger del" onclick="del_address(this)">-</div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="disf" style="justify-content:center;text-align: center;">
                                <button class="layui-btn" lay-submit="" lay-filter="address-element2" style="background:#1f5188;">立即提交</button>
                                <div style="margin-left:10px;">
                                    <input type="checkbox" name="is_default" id="is_default" lay-skin="primary" title="默认" value="{{$address['is_default']}}" @if($address['is_default']==1)
                                          checked
                                    @endif onclick="is_defaults(this)" lay-ignore style="display:none;">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script>
        layui.use(['layer', 'form', 'table', 'upload'], function () {
            var $ = layui.$
                , layer = layui.layer
                , form = layui.form
                , element = layui.element
                , upload = layui.upload
                , table = layui.table;

            form.render(null, 'address-element');

            form.on('select(country)',function(data){
                let val = data.value;
                //获取区号+邮编+一级行政区域
                $.getJSON('/getphonenum',{'id':val,'pa':1,'_token':"{{csrf_token()}}"},function(res2){
                    $('#area_mobile').val(res2.phone);

                    //邮编
                    var regNumber = /\d+/;
                    var regString = /[a-zA-Z]+/;
                    let html = '';
                    let html2 = '';
                    for(let i=0;i<res2.post.length;i++){
                        if(regNumber.test(res2.post[i]) || regString.test(res2.post[i])) {
                            html += '<div class="postal_temp">'+res2.post[i]+'</div>';
                            html2 += '<input type="text" name="postal_code[]" lay-verify="required" placeholder="" autocomplete="off" class="layui-input postal_code" value="" style="width:50px;" maxlength="1">';
                        }else{
                            html += '<div class="postal_temp" style="font-size:18px;font-weight:800;">'+res2.post[i]+'</div>';
                            html2 += '<input type="text" name="postal_code[]" lay-verify="" placeholder="" autocomplete="off" class="layui-input postal_code" value="'+res2.post[i]+'" style="width:50px;" maxlength="1">';
                        }
                    }
                    $('.postal_rule').html(html);
                    $('.postal_rule2').html(html2);
                    $('.postal_div').show();

                    //省
                    let html3 = '<select name="province" lay-search lay-filter="province">'+
                        ' <option value="">请选择</option>'+
                        ' <option value="自定义">自定义</option>';
                    for(let i=0;i<res2.province.length;i++){
                        html3 += '<option value="'+res2.province[i].id+'">'+res2.province[i].code_name+'</option>';
                    }
                    html3 += '</select>';
                    $('.sort_div').find('.province').html(html3);
                    form.render(null,'address-element');
                });
            });
            form.on('select(province)',function(data){
                let val = data.value;
                if(val=='自定义'){
                    $('.sort_div').find('.diycountry').show();
                    $('.sort_div').find('.province').hide();
                    $('.sort_div').find('.city').hide();
                    $('.sort_div').find('.area').hide();
                    $('.sort_div').find('.area2').hide();
                    $('.sort_div').find('.area3').hide();
                    $('.sort_div').find('.area4').hide();
                    //   $('.sort_div').find('.area').hide();
                }else if(val!=''){
                    $.getJSON('/getphonenum',{'id':val,'pa':2,'_token':"{{csrf_token()}}"},function(res2){
                        let html = '<select name="city" lay-search lay-filter="city">'+
                            ' <option value="">请选择</option>'+
                            ' <option value="自定义">自定义</option>';
                        for(let i=0;i<res2.area.length;i++){
                            html += '<option value="'+res2.area[i].id+'">'+res2.area[i].code_name+'</option>';
                        }
                        html += '</select>';
                        $('.sort_div').find('.city').html(html);
                        form.render(null,'address-element');
                    });
                }
            });
            form.on('select(city)',function(data){
                let val = data.value;
                if(val=='自定义'){
                    $('.sort_div').find('.diycountry').show();
                    // $('.sort_div').find('.province').hide();
                    $('.sort_div').find('.city').hide();
                    $('.sort_div').find('.area').hide();
                    $('.sort_div').find('.area2').hide();
                    $('.sort_div').find('.area3').hide();
                    $('.sort_div').find('.area4').hide();
                    //   $('.sort_div').find('.area').hide();
                }else if(val!=''){
                    $.getJSON('/getphonenum',{'id':val,'pa':2,'_token':"{{csrf_token()}}"},function(res2){
                        let html = '<select name="area" lay-search lay-filter="area">'+
                            ' <option value="">请选择</option>'+
                            ' <option value="自定义">自定义</option>';
                        for(let i=0;i<res2.area.length;i++){
                            html += '<option value="'+res2.area[i].id+'">'+res2.area[i].code_name+'</option>';
                        }
                        html += '</select>';
                        $('.sort_div').find('.area').html(html);
                        form.render(null,'address-element');
                    });
                }
            });
            form.on('select(area)',function(data){
                let val = data.value;
                if(val=='自定义'){
                    $('.sort_div').find('.diycountry').show();
                    // $('.sort_div').find('.province').hide();
                    // $('.sort_div').find('.city').hide();
                    $('.sort_div').find('.area').hide();
                    $('.sort_div').find('.area2').hide();
                    $('.sort_div').find('.area3').hide();
                    $('.sort_div').find('.area4').hide();
                }else if(val!=''){
                    $.getJSON('/getphonenum',{'id':val,'pa':2,'_token':"{{csrf_token()}}"},function(res2){
                        let html = '<select name="area2" lay-search lay-filter="area2">'+
                            ' <option value="">请选择</option>'+
                            ' <option value="自定义">自定义</option>';
                        for(let i=0;i<res2.area.length;i++){
                            html += '<option value="'+res2.area[i].id+'">'+res2.area[i].code_name+'</option>';
                        }
                        html += '</select>';
                        $('.sort_div').find('.area2').append(html);
                        form.render(null,'address-element');
                    });
                }
            });
            form.on('select(area2)',function(data){
                let val = data.value;
                if(val=='自定义'){
                    $('.sort_div').find('.diycountry').show();
                    // $('.sort_div').find('.province').hide();
                    // $('.sort_div').find('.city').hide();
                    // $('.sort_div').find('.area').hide();
                    $('.sort_div').find('.area2').hide();
                    $('.sort_div').find('.area3').hide();
                    $('.sort_div').find('.area4').hide();
                }else if(val!=''){
                    $.getJSON('/getphonenum',{'id':val,'pa':2,'_token':"{{csrf_token()}}"},function(res2){
                        let html = '<div class="countryDiv countryBox"><select name="area3" lay-search lay-filter="area3">'+
                            ' <option value="">请选择</option>'+
                            ' <option value="自定义">自定义</option>';
                        for(let i=0;i<res2.area.length;i++){
                            html += '<option value="'+res2.area[i].id+'">'+res2.area[i].code_name+'</option>';
                        }
                        html += '</select></div>';
                        $('.sort_div').find('.area3').html(html);
                        form.render(null,'address-element');
                    });
                }
            });
            form.on('select(area3)',function(data){
                let val = data.value;
                if(val=='自定义'){
                    $('.sort_div').find('.diycountry').show();
                    $('.sort_div').find('.area3').hide();
                    $('.sort_div').find('.area4').hide();
                }else if(val!=''){
                    $.getJSON('/getphonenum',{'id':val,'pa':2,'_token':"{{csrf_token()}}"},function(res2){
                        let html = '<select name="area4" lay-search lay-filter="area4">'+
                            ' <option value="">请选择</option>'+
                            ' <option value="自定义">自定义</option>';
                        for(let i=0;i<res2.area.length;i++){
                            html += '<option value="'+res2.area[i].id+'">'+res2.area[i].code_name+'</option>';
                        }
                        html += '</select>';
                        $('.sort_div').find('.area4').html(html);
                        form.render(null,'address-element');
                    });
                }
            });
            form.on('select(area4)',function(data){
                let val = data.value;
                if(val=='自定义'){
                    $('.sort_div').find('.diycountry').show();
                    $('.sort_div').find('.area4').hide();
                }
            });

            //地址提交
            form.on('submit(address-element2)',function(data){
                data.field['is_default'] = $('#is_default').val();

                $.ajax({
                    url: "/save_address",
                    method: 'post',
                    data: {'data': data.field,'_token':"{{csrf_token()}}"},
                    dataType: 'JSON',
                    success: function (res) {
                        layer.msg(res.msg,{time:2000}, function () {
                            if (res.code == 0) {
                                parent.location.reload();
                            }
                        });
                    }
                });
                return false;
            });
        });

        function add_addr(){
            var $ = layui.$
                , layer = layui.layer;
            if("{{session('user.user_id')}}" != ''){
                let area = ['800px','500px'];
                if(IsPhone()){
                    area = ['100%','100%'];
                }

                layer.open({
                    type: 1,
                    title:'添加地址',
                    area: area,
                    content: $('.address_div')
                });
            }else{
                show_login();
            }
        }

        function add_address(){
            var $ = layui.$
                , layer = layui.layer
                , form = layui.form;
            let address_num = $('#address_num').val();
            address_num = parseInt(address_num) + 1;
            $('#address_num').val(address_num);
            let html = '<div class="layui-form-item">\n' +
                '                    <div class="layui-form-label">地址'+address_num+'</div>\n' +
                '                    <div class="layui-input-block disf">\n' +
                '                        <input type="text" class="layui-input" lay-verify="required" name="address2[]" value="" placeholder="请输入地址">\n' +
                '                        <div class="layui-btn layui-btn-success add" onclick="add_address()">+</div>\n' +
                '                        <div class="layui-btn layui-btn-danger del" onclick="del_address(this)">-</div>\n' +
                '                    </div>\n' +
                '                </div>';

            $('.addr').append(html);
            form.render(null, 'component-form-group');
        }

        function del_address(t){
            var $ = layui.$
                , layer = layui.layer
                , form = layui.form;
            let adr_idx = layer.confirm('确认要删除该地址吗？',function(index){
                let address_num = $('#address_num').val();
                address_num = parseInt(address_num) - 1;
                $('#address_num').val(address_num);
                $(t).parent().parent().remove();
                form.render(null, 'component-form-group');
                layer.close(adr_idx);
            });
        }

        function is_defaults(t){
            var $ = layui.$
                , layer = layui.layer
                , form = layui.form;

            if($(t).val()==1){
                $(t).val("0");
            }else{
                $(t).val("1");
            }
            form.render(null, 'address-element');
        }

        function add_diycountry(t){
            var $ = layui.$
                , layer = layui.layer
                , form = layui.form;

            let html = '<input class="layui-input countryDiv countryBox" name="diycountry[]" placeholder="请输入行政区域" style="">';
            $(t).before(html);
        }

        function select_addrr(t){
            var $ = layui.$
                , form = layui.form
                , layer = layui.layer;
            if("{{session('user.user_id')}}" != ''){
                let val = $(t).val();
                if(val==1){
                    $('.country-select').show();
                }else if(val==2){
                    $('.country-select').hide();
                    add_addr();
                }else if(val==''){
                    $('.country-select').hide();
                }
            }else{
                show_login();
            }
        }

        function show_login(){
            var $ = layui.$
                , layer = layui.layer;
            layer.load();
            setTimeout(function(){
                $.login.show();
            },1500);
        }
    </script>
@stop