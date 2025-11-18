<link rel="stylesheet" href="/assets/d2eace91/layui/css/layui.css?v=2312"/>
<style>
    body{background: #e0d7d7;}
</style>
<div class="layui-fluid" style="padding:15px;">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-body" style="background:#fff;padding:10px;">
                    <div class="layui-btn-group test-table-operate-btn" style="margin-bottom: 10px;">
                        <button class="layui-btn layui-btn-normal" onclick="openWindow('新增流程','/func/site/save_process');">新增流程</button>
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

<div class="manage_process" style="display: none;padding:10px;box-sizing: border-box;">
    <form action="">
        <input type="hidden" name="opera_id" id="opera_id" value="">
        <input type="hidden" name="opera_name" id="opera_name" value="">
        <div class="form-group" style="margin-bottom:10px;">
            <label for="level">列表</label>
            <select name="level" id="level" class="form-control">
                <option value="1">本级列表</option>
                <option value="2">下级列表</option>
            </select>
        </div>
        <div class="form-group">
            <label for="opera">操作</label>
            <select name="opera" id="opera" class="form-control">
                <option value="9">——请选择——</option>
                <option value="1">编辑</option>
                <option value="2">删除</option>
                <option value="3">新增</option>
            </select>
        </div>
    </form>
</div>

<script type="text/javascript" src="/assets/d2eace91/layui/layui.js"></script>
<script>
    layui.config({
        base: '/layuiadmin/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['layer', 'table', 'upload'], function(){
        var $ = layui.jquery
            ,table = layui.table
            ,layer = layui.layer
            ,upload = layui.upload;

        table.render({
            elem: '#mainTable'
            ,url: "/func/site/gather_process_manage?pa=1&pid={{$pid}}"
            ,cellMinWidth: 200
            ,cols: [[
                {field:'displayorders', width:80, title: '序号'}
                ,{field:'step',  title: '序号描述'}
                ,{field:'content',  title: '流程描述'}
                ,{field:'createtime',  title: '创建时间'}
                ,{width:180, align:'center', fixed: 'right', title: '操作', templet: function(d){
                        return [
                            '<a onclick="openWindow('+ "'新增流程'" +',' + "'/func/site/save_process?pid="+ d.id + '\');" class="layui-btn layui-btn-xs layui-btn-normal">新增流程</a>',
                            '<a onclick="manage_process('+ "'"+d.content+"'" +',' +  d.id + ');" class="layui-btn layui-btn-xs layui-btn-danger">管理流程</a>'
                        ].join('');
                    } }
            ]]
            ,page: true
        });

        var $ = layui.$, active = {
            reload: function(){
                //执行重载
                table.reload('mainTable', {
                    page: {
                        curr: 1 //重新从第 1 页开始
                    }
                    ,where: {
                        keywords: $("#keywords").val()
                    }
                });
            }
        };

        $('.main-table-reload-btn .layui-btn').on('click', function(){
            var type = $(this).data('type');
            active[type] ? active[type].call(this) : '';
        });

        $('#level').change(function(){
            let val = $(this).val();
            let pid = $('#opera_id').val();
            let name = $('#opera_name').val();
            if(val==2){
                var index = layer.open({
                    type: 2,
                    title: name+'-流程列表',
                    area:['100%','100%'],
                    content: "/func/site/gather_process_manage?pid="+pid
                });
            }
            if(val==2){
                $(this).find('option[value="1"]').attr('selected','true');
            }
        });

        $('#opera').change(function(){
            let val = $(this).val();
            let pid = $('#opera_id').val();
            let name = $('#opera_name').val();

            if(val==1){
                edit(pid,name);
            }else if(val==2){
                del(pid,name);
            }else if(val==3){
                save_process(pid,name);
            }

            if(val!=9){
                $(this).find('option[value="9"]').attr('selected','true');
            }
        });
    });

    function save_process(id,name){
        var $ = layui.jquery
            ,layer = layui.layer;

        var index = layer.open({
            type: 2,
            title: '新增流程',
            area:['100%','100%'],
            content: "/func/site/save_process?pid="+id
        });
    }

    function manage_process(name,id){
        var $ = layui.jquery
            ,layer = layui.layer;

        $('#opera_id').val(id);
        $('#opera_name').val(name);
        var index = layer.open({
            type: 1,
            title: '管理流程-'+name,
            area:['50%','50%'],
            content: $('.manage_process')
        });
    }

    function openWindow(title,url,type=0)
    {
        var $ = layui.jquery
            ,layer = layui.layer;

        var index = layer.open({
            type: 2,
            title: title,
            content: url,
            area:['100%','100%']
        });
        // layer.full(index);
    }

    function edit(id,name){
        var $ = layui.jquery
            ,layer = layui.layer;

        var index = layer.open({
            type: 2,
            title: '查看-'+name,
            area:['100%','100%'],
            content: "/func/site/save_process?id="+id
        });
        // layer.full(index);
    }


    function save(title) {
        var $ = layui.jquery
            ,layer = layui.layer;

        var index = layer.open({
            type: 2,
            title: '新增流程',
            area:['100%','100%'],
            content: "/func/site/save_process?pid={{$pid}}"
        });
        // layer.full(index);
    }

    function save_common(pid,title,displayorders){
        var $ = layui.jquery
            ,layer = layui.layer;

        var index = layer.open({
            type: 2,
            title: title,
            area:['100%','100%'],
            content: "/func/site/save_process?pid="+pid+"&displayorders="+displayorders
        });
    }

    function save_child(pid,title,displayorders){
        var $ = layui.jquery
            ,layer = layui.layer;

        var index = layer.open({
            type: 2,
            title: title,
            area:['100%','100%'],
            content: "/func/site/save_process?pid="+pid
        });
    }

    function child_list(pid,title){
        var $ = layui.jquery
            ,layer = layui.layer;

        var index = layer.open({
            type: 2,
            title: title,
            area:['100%','100%'],
            content: "/func/site/gather_process_manage?pid="+pid
        });
    }

    function del(id,title){
        var $ = layui.jquery
            ,layer = layui.layer;

        layer.confirm('确认删除该流程吗？',function(index){
            $.ajax({
                url: "/func/site/del_process",
                data:{'id':id},
                type:'post',
                cache:false,
                dataType:'json',
                success:function(data){
                    if(data.code==0)
                    {
                        layer.msg(data.msg, {
                            icon: 1,
                            time: 2000
                        }, function(){
                            window.location.reload();
                        });
                        return true;
                    }else {
                        layer.msg(data.msg, {icon:2, time:2000});
                        return false;
                    }
                },
                error:function() {
                    layer.msg('系统出错,请重试',{icon:2,time:1000});
                }
            });
        });
    }
</script>
