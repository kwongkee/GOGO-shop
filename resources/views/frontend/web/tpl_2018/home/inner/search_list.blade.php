@extends('layouts.goods_header')

@section('content')
    <link rel="stylesheet" href="/assets/d2eace91/layui/css/layui.css?v=23121"/>
    <script type="text/javascript" src="/assets/d2eace91/layui/layui.js"></script>
    <link rel="stylesheet" href="/assets/d2eace91/js/layer/theme/default/layer.css?v=3.1.0" id="layuicss-layer">
    <script src="/assets/d2eace91/js/layer/layer.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/jquery.js?v=1.1"></script>

    <style type="text/css" media="all">
        *{box-sizing: border-box;line-height: 17px;}
        .disf{display: flex;align-items: center;}
        #content{padding:20px;background:{{$website['background']}};box-sizing:border-box;}
        /*.content{height:630px;}*/
        #content .content .selector{margin-top:20px;}
        #content .content .high_search{border-bottom: 1px solid {{$website['content']}};background:{{$website['content']}};}
        #content .content .high_search:first-child{border-top:1px solid {{$website['content']}};}
        #content .content .high_search .leftVal{font-size:15px;font-weight: 800;color:{{$website['fontcolor']}};text-align: left;width:100px;padding:5px 10px;}
        #content .content .high_search .rightVal{padding:5px 10px;background:#ffffff;width: 85%;height:40px;overflow: hidden;position:relative;transition: all 0.3s ease;}
        #content .content .high_search .rightVal .valItem{font-size:13px;width: 90px;display: inline-block;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;cursor:pointer;padding:5px 0;color:{{$website['fontcolor']}};}
        #content .content .high_search .rightVal .valItem_act{color:#e60000;}
        #content .content .high_search .rightVal .valItem:hover{color:#e60000;}
        #content .content .high_search .rightVal .loadmore_search{position: absolute;top: 5px;right: 0px;font-size: 13px;padding: 5px 10px;display: flex;align-items: center;border:1px solid {{$website['content']}};cursor:pointer;transition: all 0.3s ease;}
        #content .content .high_search .rightVal .loadmore_search .more_icon{width:7px;height:7px;border-top:1px solid {{$website['content']}};border-right:1px solid {{$website['content']}};transform: rotate(135deg);margin-left:5px;background:#ffffff;}
        #content .content .high_search .rightVal .loadmore_search2 {position: absolute;top: 5px;right: 0px;font-size: 13px;padding: 5px 10px;display: flex;align-items: end;border:1px solid {{$website['content']}};cursor:pointer;transition: all 0.3s ease;}
        #content .content .high_search .rightVal .loadmore_search2 .more_icon{width:7px;height:7px;border-top:1px solid {{$website['content']}};border-right:1px solid {{$website['content']}};transform: rotate(315deg);margin-left:5px;background:#ffffff;}

        .searchContent{/**box-shadow: 0px 0px 8px 0px #797777;overflow: hidden;**/border-radius: 40px;background: #fff;height: 45px;border:1px solid {{$website['content']}};}
        .searchContent .inputBox{height: 100%;width: 100%;}
        .searchContent .inputBox .nameBox {padding:13px 30px;position: relative;width: 100%;}
        .searchContent .inputBox .nameBox input{border:0;font-size: 22px;width: 100%;}
        /*.searchContent .inputBox .btnBox{width:60px;height:100%;background:#1761b7;display: flex;align-items: center;justify-content: center;border-top-right-radius: 40px;border-bottom-right-radius: 40px;padding:5px 0 0 5px;cursor: pointer;}*/
        .searchContent .inputBox .btnBox{width: 60px;height: 100%;background: #1761b7;display: flex;align-items: center;justify-content: center;border-top-right-radius: 40px;border-bottom-right-radius: 40px;padding: 0px 0 0 0px;cursor: pointer;font-size: 18px;color: #fff;}
        .searchContent .inputBox .btnBox img{width:50px;}
        .searchBox{margin:0 auto;margin-top:15px;background:#1761b7;width:fit-content;padding:0px 15px;box-sizing: border-box;border-radius: 5px;box-shadow: 0px 0px 10px 3px #bebebe;display:none;cursor:pointer;}
        .searchBox span{color:#ffffff;font-size:18px;}
        .searchBox img{width:50px;}

        .navbar_menu{color: {{$website['fontcolor']}};font-size: 16px;margin-bottom:10px;}
        .navbar_menu a{color:{{$website['fontcolor']}};}

        /**已选条件**/
        .selected{display:none;margin-top:15px;padding:5px 15px;box-sizing: border-box;border-top: 1px solid #bebebe;border-bottom: 1px solid #bebebe;}
        .selected .title{font-size: 15px;width: 15%;}
        .selected .condition_div{width:85%;max-height: 90px;overflow-y: scroll;}
        .selected .condition_div .condition_cdiv{background: #f7e6e1;color: #e60000;padding: 2px 5px;box-sizing: border-box;font-size:12px;cursor:pointer;margin: 5px 0 5px 10px;display: inline-block;}
        .selected .condition_div .condition_cdiv span{margin-left:5px;}

        /**自定字段**/
        .fields_div{margin-top:15px;border-bottom: 1px solid #bebebe;padding-bottom: 15px;display:none;}
        .fieldsBox{display: grid;grid-template-columns: repeat(3,1fr);-moz-column-gap: 10px;column-gap: 10px;row-gap: 10px;}
        .fieldsBox input[type="number"]{width:50px;font-size: 12px;padding: 2px 5px;box-sizing: border-box;border:1px solid #000;}
        .fieldsBox select{width:80px;font-size: 12px;padding: 2px 5px;border: 1px solid #000;box-sizing: border-box;}
        .fieldsBox input[type="checkbox"]{width:fit-content;margin-right:5px;}
        .fieldsBox .fieldsContent{font-size:12px;}
        .fieldsBox .fieldsContent .name{font-size:15px;margin-right:5px;}
        .fieldsBox .fieldsContent .areaBox,.fieldsBox .fieldsContent .areaBox2{font-size: 13px;padding: 5px 20px 5px 10px;position:relative;border: 1px solid #000;cursor: pointer;transition: all 0.3s ease;width:60%;}
        .fieldsBox .fieldsContent .areaBox .areaTitle,.fieldsBox .fieldsContent .areaBox2 .areaTitle{width:100%;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;}
        .fieldsBox .fieldsContent .areaBox:after{content:'';position: absolute;top:9px;right:6px;width:7px;height:7px;border-top:1px solid #000;border-right:1px solid #000;transform: rotate(135deg);}
        .fieldsBox .fieldsContent .areaBox2:after{content:'';position: absolute;top:13px;right:6px;width:7px;height:7px;border-top:1px solid #000;border-right:1px solid #000;transform: rotate(315deg);}
        .fieldsBox .fieldsContent .areaBox2 .areaContent{position:absolute;top:30px;left:-1px;width:400px;height:fit-content;padding:10px;background:#fff;border: 1px solid #bebebe;box-shadow: 0px 0px 5px 1px #bebebe;}
        .fieldsBox .fieldsContent .areaBox2 .areaContent .areaDiv{width:110px;display:inline-block;margin:0 10px 10px 0px;position:relative;}
        .fieldsBox .fieldsContent .areaBox2 .areaContent .areaDiv:nth-child(3n){margin-right:0;}
        .fieldsBox .fieldsContent .areaBox2 .areaContent .areaDiv .areaName{font-size:13px;}
        .fieldsBox .fieldsContent .areaBox2 .areaContent .areaDiv .areaName:hover{color:#e60000;}
        .fieldsBox .fieldsContent .areaBox2 .areaContent .areaDiv .areaChild{position:absolute;top:0px;left:50px;background:#bebebe;padding:10px;width:300px;height:fit-content;display: none;z-index: 9;}
        .fieldsBox .fieldsContent .areaBox2 .areaContent .areaDiv .areaChild:after{content:'';position: absolute;top: 5px;left: -15px;width: 0;height: 0;border-left: 10px solid transparent;border-right: 10px solid transparent;border-bottom: 10px solid #bebebe;transform: rotate(270deg);}
        .fieldsBox .fieldsContent .areaBox2 .areaContent .areaDiv .areaChild .cityName{width: 80px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;margin-right: 10px;margin-bottom: 8px;cursor: pointer;display: inline-block;}
        .fieldsBox .fieldsContent .areaBox2 .areaContent .areaDiv .areaChild .cityName:hover{color:#e60000;}


        .noresult-content{text-align: center;display:none;}
        .noresult-content img{width: 205px;height:205px;margin-top:10px;}
        .noresult-content .noresult-hd{font-size: 20px;margin-top:10px;}

        @if($isframe==1)
            header,footer,.header,.footer{display: none;}
            .w1200{width: 100%;}
            html,.pace-done,#wrapper{height:100%;}
            .non_topimg{margin-top:0;height: -webkit-fill-available;}
            #content{height:100%;}
        @endif
    </style>

    <section id="content" class="non_topimg">
        <div class="w1200">
            <div class="content">
                <div class="searchContent disf">
                    <div class="inputBox disf">
                        <div class="nameBox">
                            <input type="text" name="name" id="name" placeholder="请输入商品关键字" id="searchInput">
                        </div>
                        <div class="btnBox" onclick="search_goods()">
                            查询
                        </div>
                    </div>
                </div>

                <div class="selector">

                </div>

                <!--已选-->
                <div class="selected">
                    <div class="disf">
                        <span class="title">已选条件：</span>
                        <div class="condition_div">

                        </div>
                    </div>
                </div>

                <!--自定义字段-->
                <div class="fields_div">

                </div>

                <div class="searchBox" onclick="searchGoods()">
                    <div class="disf">
                        <span>搜索商品</span>
                        <img src="/assets/d2eace91/images/newhome/search_icon.png">
                    </div>
                </div>

                <!--暂无信息-->
                <div class="noresult-content">
                    <img src="https://cbu01.alicdn.com/cms/upload/2013/909/997/1799909_1367035968.png" >
                    <h2 class="noresult-hd">没找到相关的商品</h2>
                </div>
                <!--高级搜索条件-->
                <input type="hidden" id="condition_arr" value="">
                <input type="hidden" class="area_info" value="">
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

            form.render(null,'component-form-element');

            // table.render({
            //     elem: '#mainTable'
            //     ,url: "/msg_list?pa=1"
            //     ,cellMinWidth: 200
            //     ,cols: [[
            //         {field:'name', title: '消息标题'}
            //         ,{field:'createtime', title: '发布日期'}
            //         ,{align:'center',  title: '操作',fixed:'right',width:120, templet: function(d){
            //                 return [
            //                     '<a onclick="openWindow('+"'"+ d.id +"'" +','+"1"+ ');" class="layui-btn layui-btn-primary layui-btn-xs" style="color:#0e2e68;border:1px solid #0e2e68;">查看详情</a>',
            //                     // '<a onclick="openWindow('+"'"+ d.id +"'" +','+"1"+ ');" class="layui-btn layui-btn-primary layui-btn-xs">历史版本</a>',
            //                 ].join('');
            //             } }
            //     ]]
            //     ,page: true
            // });
        });

        function search_goods(){
            var $ = layui.$,
                layer = layui.layer;

            let name = $('#name').val();
            if(name==''){
                layer.msg('请输入商品关键词');return false;
            }

            parent.location.href='/goods_list?cate_name='+name;
            return false;

            //20241023废弃
            $.ajax({
                url: "/taozg",
                method: 'post',
                data: {'cate_name':name,'_token':"{{csrf_token()}}",'pa':1,'id':"{{$id}}"},
                dataType: 'JSON',
                success: function (res) {
                    layer.closeAll('loading');
                    layer.msg(res.msg,{time:2000}, function () {
                        if (res.code == 0) {
                            //商城内有该商品分类下的商品
                            // window.location.href="/list-"+res.id+'.html';
                        }
                        else if(res.code == -1){
                            //通过接口/数据表找到的商品

                            //渲染条件信息
                            let condition_html = '';

                            //1、分类
                            if(res.condition['category'].length>0){
                                condition_html += '<div class="disf high_search">\n' +
                                    '                            <div class="leftVal">类别：</div>\n' +
                                    '                            <div class="rightVal">\n';
                                for(let i=0;i<res.condition['category'].length;i++) {
                                    condition_html += '                <div class="valItem category'+res.condition['category'][i].cat_id+'" title="'+res.condition['category'][i].cat_name+'" onclick="conSelect(this,'+res.condition['category'][i].cat_id+',0,1,\'类别\')">'+res.condition['category'][i].cat_name+'</div>\n';
                                }
                                condition_html += '                    <div class="loadmore_search" onclick="loadmore_search(this)">更多<div class="more_icon"></div></div>';
                                condition_html += '               </div>\n' +
                                    '              </div>';
                            }

                            //2、规格
                            if(res.condition['options'].length>0){
                                for(let i=0;i<res.condition['options'].length;i++) {
                                    condition_html += '<div class="disf high_search">\n' +
                                        '                            <div class="leftVal">'+res.condition['options'][i].spec_name+'：</div>\n' +
                                        '                            <div class="rightVal">\n';
                                    for(let i2=0;i2<res.condition['options'][i]['children'].length;i2++){
                                        condition_html += '                <div class="valItem option'+res.condition['options'][i].spec_ids+'_'+res.condition['options'][i]['children'][i2]['value_id']+'" title="'+res.condition['options'][i]['children'][i2]['value_name']+'" onclick="conSelect(this,'+res.condition['options'][i]['children'][i2]['value_id']+','+res.condition['options'][i].spec_ids+',2,\''+res.condition['options'][i].spec_name+'\')">'+res.condition['options'][i]['children'][i2]['value_name']+'</div>\n';
                                    }
                                    condition_html += '                    <div class="loadmore_search" onclick="loadmore_search(this)">更多<div class="more_icon"></div></div>';
                                    condition_html += '               </div>\n' +
                                        '              </div>';
                                }
                            }

                            //3、品牌
                            if(res.condition['brand'].length>0){
                                condition_html += '<div class="disf high_search">\n' +
                                    '                            <div class="leftVal">品牌：</div>\n' +
                                    '                            <div class="rightVal">\n';
                                for(let i=0;i<res.condition['brand'].length;i++){
                                    condition_html += '                <div class="valItem brand'+res.condition['brand'][i]+'" title="'+res.condition['brand'][i]+'" onclick="conSelect(this,\''+res.condition['brand'][i]+'\',\'brand'+res.condition['brand'][i]+'\',3,\'品牌\')">'+res.condition['brand'][i]+'</div>\n';
                                }
                                condition_html += '                    <div class="loadmore_search" onclick="loadmore_search(this)">更多<div class="more_icon"></div></div>';
                                condition_html += '               </div>\n' +
                                    '              </div>';
                            }
                            $('.selector').html(condition_html);

                            //4、自定字段
                            let zd_html = '<div class="fieldsBox">';
                            if(res.condition['column_content'].length>0){
                                for(let i=0;i<res.condition['column_content'].length;i++) {
                                    if(res.condition['column_content'][i].stype==1){
                                        <!--价格幅度-->
                                        zd_html += '<div class="disf fieldsContent">\n'+
                                        '     <div class="name">'+res.condition['column_content'][i].name+'</div>\n'+
                                        '     <div class="operaBox disf"><input type="number" class="minNum field_arr" id="minNum'+res.condition['column_content'][i].id+'" min="0" placeholder="0" value="" data-id="'+res.condition['column_content'][i].id+'"><span>——</span><input type="number" class="maxNum field_arr" id="maxNum'+res.condition['column_content'][i].id+'" min="0" placeholder="0" value="" data-id="'+res.condition['column_content'][i].id+'"></div>\n'+
                                        '</div>';
                                    }
                                    else if(res.condition['column_content'][i].stype==2){
                                        <!--下拉选择-->
                                        zd_html += '<div class="disf fieldsContent">\n'+
                                        '     <div class="name">'+res.condition['column_content'][i].name+'</div>\n'+
                                        '     <div class="operaBox disf">\n' +
                                        '          <select class="field_arr" id="select'+res.condition['column_content'][i].id+'" data-id="'+res.condition['column_content'][i].id+'">';
                                        for(let i2=0;i2<res.condition['column_content'][i].content.length;i2++){
                                            if(res.condition['column_content'][i].content[i2]!=''){
                                                zd_html += '<<option value="'+res.condition['column_content'][i].content[i2]+'">'+res.condition['column_content'][i].content[i2]+'</option>>\n';
                                            }
                                        }
                                        zd_html +='</select>\n'+
                                        '     </div>\n'+
                                        '</div>';
                                    }
                                    else if(res.condition['column_content'][i].stype==3) {
                                        <!--单选参数-->
                                        zd_html += '<div class="disf fieldsContent">\n' +
                                            '       <input type="checkbox" class="field_arr" id="checkbox' + res.condition['column_content'][i].id + '" data-id="' + res.condition['column_content'][i].id + '" value="0" onclick="checkbox_click(this)">\n' +
                                            '       <div class="name">' + res.condition['column_content'][i].name + '</div>\n' +
                                            '   </div>\n';
                                    }
                                    else if(res.condition['column_content'][i].stype==4){
                                        <!--发货地区-->
                                        zd_html += '<div class="disf fieldsContent">\n'+
                                                '        <div class="areaBox" onclick="show_areaDetail(this)">\n'+
                                                '            <div class="areaTitle">发货地区</div>\n'+
                                                '            <div class="areaContent" style="display:none;">';
                                        for(let i2=0;i2<res.condition['province'].length;i2++){
                                            zd_html += '          <div class="areaDiv">\n' +
                                                '                      <div class="areaName" title="'+ res.condition['province'][i2].code_name +'" onclick="get_city('+ res.condition['province'][i2].id +',this)">' + res.condition['province'][i2].code_name + '</div>\n' +
                                                '                      <div class="areaChild"></div>\n'+
                                                '                 </div>\n';
                                        }
                                        zd_html += '         </div>\n'+
                                        '               </div>\n'+
                                        '           </div>\n';
                                    }
                                }
                            }
                            zd_html += "</div>";
                            $('.fields_div').html(zd_html);

                            $('.searchBox').show();
                            $('.fields_div').show();
                            $('.noresult-content').hide();
                            //渲染商品信息
                            // let html = '';
                            // for(let i=0;i<res.data.length;i++){
                            //     html += '<div class="goods_box">\n'+
                            //         '    <div class="goods_image">\n'+
                            //         '        <img src="'+res.data[i].goods_image+'" class="img">\n'+
                            //         '    </div>\n'+
                            //         '    <div class="goods_info">\n'+
                            //         '        <div class="goods_name">'+res.data[i].goods_name+'</div>\n'+
                            //         '        <div class="operate disf">\n'+
                            //         '            <span class="goods_price">RMB￥&nbsp;'+res.data[i].goods_price+'</span>\n'+
                            //         '            <div class="view_detail" onclick="view_detail('+res.data[i].goods_id+')">查看详情</div>\n'+
                            //         '        </div>\n'+
                            //         '    </div>\n'+
                            //         '</div>';
                            // }
                            //
                            // $('.goods_list').html(html);
                        }
                        else if(res.code == -2){
                            //通过接口/数据表没有找到的商品
                            $('.noresult-content').show();
                        }
                    });
                }
            });
        }

        function show_areaDetail(t){
            var $ = layui.$,
                layer = layui.layer;

            if($(t).hasClass('areaBox2')){
                $(t).removeClass('areaBox2');
                $(t).addClass('areaBox');
                $(t).find('.areaContent').hide();
                $('.areaChild').hide();
            }else{
                $(t).addClass('areaBox2');
                $(t).removeClass('areaBox');
                $(t).find('.areaContent').show();
            }
        }

        function get_city(province_id,t){
            var $ = layui.$,
                layer = layui.layer;
            if($(t).parent().find('.areaChild').html()==''){
                $.ajax({
                    url: "/taozg",
                    method: 'post',
                    data: {'_token': "{{csrf_token()}}", 'pa': 2,'province_id':province_id},
                    dataType: 'JSON',
                    success: function (res) {
                        if(res.code==0){
                            let html = '';
                            for(let i=0;i<res.data.length;i++){
                                html += '<div class="cityName" title="'+res.data[i].code_name+'" data-id="'+res.data[i].id+'" onclick="selectCity(\''+res.data[i].code_name+'\','+res.data[i].id+',this)">'+res.data[i].code_name+'</div>';
                            }
                            $(t).parent().find('.areaChild').html(html);
                        }
                    }
                });
            }
            setTimeout(function(){
                $(t).parents(':eq(2)').addClass('areaBox2');$(t).parents(':eq(2)').removeClass('areaBox');$('.areaContent').show();
                $('.areaChild').hide();$(t).parent().find('.areaChild').show();
                $('.areaTitle').text($(t).text());
                $('.area_info').val(province_id);
            },10);
        }

        function selectCity(name,id,t){
            var $ = layui.$,
                layer = layui.layer;

            $('.areaTitle').text(name);
            $('.area_info').val(id);
        }

        function loadmore_search(t){
            var $ = layui.$,
                layer = layui.layer;

            if($(t).hasClass('loadmore_search')){
                $(t).removeClass('loadmore_search');
                $(t).addClass('loadmore_search2');
                $(t).parent().css('height','fit-content');
            }else{
                $(t).removeClass('loadmore_search2');
                $(t).addClass('loadmore_search');
                $(t).parent().css('height','40px');
            }

        }

        function conSelect(t,val,pid,typ,pname){
            if(!$(t).hasClass('valItem_act')){
                $(t).addClass('valItem_act');
                let txt = $(t).text();
                let search_input = $('#condition_arr').val();
                let value = '';
                if(typ==1){
                    //分类
                    let html = '<div class="conditionCate_'+val+' condition_cdiv">'+pname+'：'+txt+'<span onclick="delSelect(this,'+val+','+pid+','+typ+')">x</span></div>';
                    $('.selected').find('.condition_div').append(html);
                    value = search_input+'cate_'+val+'@@@';
                }
                else if(typ==2){
                    //规格
                    let html = '<div class="conditionOpt_'+val+' condition_cdiv">'+pname+'：'+txt+'<span onclick="delSelect(this,'+val+','+pid+','+typ+')">x</span></div>';
                    $('.selected').find('.condition_div').append(html);
                    value = search_input+'opt_'+pid+'|'+val+'@@@';
                }
                else if(typ==3){
                    //品牌
                    let html = '<div class="conditionBrand_'+val+' condition_cdiv">'+pname+'：'+txt+'<span onclick="delSelect(this,'+val+','+pid+','+typ+')">x</span></div>';
                    $('.selected').find('.condition_div').append(html);
                    value = search_input+'brand_'+val+'@@@';
                }
                $('#condition_arr').val(value);
                $('.selected').show();
            }else{
                $(t).removeClass('valItem_act');
                delSelect(t,val,pid,typ);
            }
        }

        function delSelect(t,val,pid,typ){
            let search_input = $('#condition_arr').val();
            let value = '';
            if(typ==1){
                //分类
                $('.category'+val).removeClass('valItem_act');
                $('.conditionCate_'+val).remove();
                value = search_input.replace('cate_'+val+'@@@','');
            }
            else if(typ==2) {
                //规格
                $('.option'+pid+'_'+val).removeClass('valItem_act');
                $('.conditionOpt_'+val).remove();
                value = search_input.replace('opt_'+pid+'|'+val+'@@@','');
            }
            else if(typ==3) {
                //品牌
                $('.brand'+val).removeClass('valItem_act');
                $('.conditionBrand_'+val).remove();
                value = search_input.replace('brand_'+val+'@@@','');
            }
            $('#condition_arr').val(value);

            //无搜索条件了
            let $div = $('.selected').find('.condition_div').html();
            if($div.trim() == ''){
                $('.selected').hide();
            }
        }

        function searchGoods(){
            var $ = layui.$,
                layer = layui.layer;
            let name = $('#name').val();
            if(name==''){
                layer.msg('请输入商品名称/分类名称');return false;
            }

            //获取商品字段数据
            let condition_arr = $('#condition_arr').val();

            //获取自定字段数据
            let field_arr = [];
            for(let i=0;i<$('.field_arr').length;i++){
                //合并自定字段的id和输入/选中值
                let aval = '0';
                if($('.field_arr').eq(i).val()!=''){
                    aval=$('.field_arr').eq(i).val();
                }
                let arr = {'id':$('.field_arr').eq(i).attr('data-id'),'val':aval};
                field_arr.push(arr);
                // console.log(field_arr);
            }


            if($('.area_info').val()!=''){
                field_arr.push({'id':'4','val':$('.areaTitle').text(),'area_id':$('.area_info').val()});
            }
            condition_arr = btoa(unescape(encodeURIComponent(condition_arr)));
            field_arr = btoa(unescape(encodeURIComponent(JSON.stringify((field_arr)))));
            // console.log(field_arr);return false;
            window.open("/goods_list?cate_name="+name+"&frame_id={{$id}}&g_condition="+condition_arr+"&field_condition="+field_arr);
        }

        function checkbox_click(t){
            var $ = layui.$,
                layer = layui.layer;

            if($(t).val()==0){
                $(t).val(1);
            }else{
                $(t).val(0);
            }
        }

        function view_detail(id){
            @if($isframe==1)
                parent.open("/goods-"+id+".html");
            @else
                window.location.href="/goods-"+id+".html";
            @endif
        }
    </script>
@stop