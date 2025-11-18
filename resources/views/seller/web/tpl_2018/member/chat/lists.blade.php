{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')

@stop

{{--content--}}
@section('content')
    <link rel="stylesheet" href="/assets/d2eace91/layui/css/layui.css?v=2312"/>
    <script src="/assets/d2eace91/layui/xm-select3.js?v=20180418"></script>
    <script type="text/javascript" src="/assets/d2eace91/layui/layui.js"></script>
    <div class="common-title">
        <div class="ftitle">
            <h3>咨询列表</h3>

        </div>

    </div>
    <div class="table-responsive">
        <div class="layui-fluid" style="padding:5px;">
            <div class="layui-row layui-col-space15">
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-body" style="padding:0px;">
                            <div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
                                <div class="layui-btn-group test-table-operate-btn" style="margin-bottom: 10px;">
                                    <button class="layui-btn layui-btn-normal" onclick="location.reload()">刷新</button>
                                </div>
                                <div class="main-table-reload-btn" style="display:none;margin-bottom: 10px;float: right;">
                                    搜索关键词：
                                    <div class="layui-inline">
                                        <input class="layui-input" placeholder="要搜索的关键词"  id="keywords" autocomplete="off">
                                    </div>
                                    <button class="layui-btn layui-btn-normal" data-type="reload">搜索</button>
                                </div>
                                <table class="layui-hide" id="mainTable"></table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="reply_div" style="display: none;padding:20px;box-sizing: border-box;">
        <form class="layui-form" action="" lay-filter="component-form-group">
            @csrf
            <input type="text" name="id" id="reply_id" style="display: none;" value="">

            <div class="layui-form-item">
                <label class="layui-form-label" style="width: 100px;">回复内容</label>
                <div class="layui-input-block">
                    <textarea name="content" id="content" class="layui-textarea" placeholder="请输入回复内容..." layer-verify="required"></textarea>
                </div>
            </div>

            <div class="layui-form-item layui-layout-admin">
                <div class="layui-input-block">
                    <div class="layui-footer" style="position:relative;left: 0;background:#fff;">
                        <button class="layui-btn layui-sub" lay-submit="" lay-filter="component-form-group1">立即提交</button>
                        {{--                            <button type="reset" class="layui-btn layui-btn-primary">重置</button>--}}
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block--}}
@section('extra_html')

@stop


{{--helper_tool--}}
@section('helper_tool')

@stop


{{--footer script page元素同级下面--}}
@section('footer_script')
    <script>
        layui.use(['layer','form','laydate','upload','table','element'],function() {
            var laydate = layui.laydate,
                layer = layui.layer,
                form = layui.form,
                $ = layui.jquery,
                table = layui.table,
                element = layui.element;

            element.render('collapse');
            form.render(null,'component-form-group');

            table.render({
                elem: '#mainTable'
                ,url: "/member/chat/list?pa=1&type={{$type}}"
                ,cellMinWidth: 200
                ,cols: [[
                    {field:'id', width:80, title: '编号'}
                    ,{field:'content',  title: '咨询内容'}
                    ,{field:'createtime', title: '咨询时间'}
                    ,{width:120, align:'center', fixed: 'right', title: '操作', templet: function(d){
                            {{--'<a onclick="openWindow('+"'"+d.name+"["+d.code+"]线路列表'" +',' + "'url("/centralizer_manage/index/line_children")?id="+ d.id + "'"+');" class="layui-btn layui-btn-xs layui-btn-normal">线路列表</a>',--}}
                            //回复内容
                            if(d.is_reply==0){
                                return [
                                    '<a onclick="openWindow('+"'回复"+d.id +"'"+',' + "'"+ d.id + "',0"+');" class="layui-btn layui-btn-xs layui-btn-normal">回复</a>',
                                    // '<a onclick="del('+ "'"+d.id+"'" +',1);" class="layui-btn layui-btn-xs layui-btn-danger">删除</a>'
                                ].join('');
                            }else if(d.is_reply==1){
                                return ['已处理'].join('');
                            }

                        } }
                ]]
                ,page: true
            });

            form.on('submit(component-form-group1)',function(data){
                $.ajax({
                    url: "/member/chat/reply",
                    method: 'post',
                    data: data.field,
                    dataType: 'JSON',
                    success: function (res) {
                        layer.msg(res.msg, {time: 2000}, function () {
                            if (res.code == 0) {
                                window.location.href='/member/chat/list?type=1';
                                // var index = parent.layer.getFrameIndex(window.name);
                                // parent.layer.close(index);
                                // parent.window.location.reload();
                            }
                        });
                    },
                    error: function (data) {
                        layer.msg('系统错误', {time: 2000});
                    }
                });
                return false;
            });

            <!--代码集end-->
            var $ = layui.$, active = {
                reload: function(){
                    //执行重载
                    table.reload('mainTable', {
                        page: {
                            curr: 1 //重新从第 1 页开始
                        }
                        ,where: {
                            keywords: $("#keywords").val(),
                        }
                    });
                }
            };

            $('.main-table-reload-btn .layui-btn').on('click', function(){
                var type = $(this).data('type');
                active[type] ? active[type].call(this) : '';
            });
        });

        function openWindow(title,id,type=0)
        {
            var layer = layui.layer;
            $('#reply_id').val(id);
            var index = layer.open({
                type: 1,
                title: title,
                content: $('.reply_div'),
                area:['800px','500px']
            });
            // layer.full(index);

        }
    </script>
    <script type="text/javascript">
        $().ready(function() {
            var tablelist = $("#table_list").tablelist();
            // 删除
            $("body").on('click', '.del', function() {
                var id = $(this).data("rank-id");
                var name = $(this).data("rank-name");
                tablelist.remove({
                    confirm: "您确认删除会员等级【" + name + "】吗？",
                    url: 'delete',
                    data: {
                        id: id
                    }
                });
            });
        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop