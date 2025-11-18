<link rel="stylesheet" href="/assets/d2eace91/layui/css/layui.css?v=2312"/>
<style>
    body{background: #e0d7d7;}
    .disf{display: flex;align-items: center;}
    tbody .layui-table-cell{height:58px;line-height: 58px;}
    .gimg{width:60px;height:60px;margin-right:10px;}
</style>
<div class="layui-fluid" style="padding:15px;">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-body" style="background:#fff;padding:10px;">
                    <div class="layui-btn-group test-table-operate-btn" style="margin-bottom: 10px;">
                        <!--<button class="layui-btn layui-btn-normal" onclick="openWindow('发布产品','/func/goods/save_goods');">发布产品</button>-->
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
            ,url: "/func/goods/shelf_manage?pa=1"
            ,cellMinWidth: 200
            ,cols: [[
                {field:'goods_id', width:80, title: '编号'}
                // ,{field:'goods_name',  title: '商品名称'}
                ,{align:'center', title: '商品名称',templet:function(d){
                    var result = "";
                    result += '<div class="disf">';
                    result += '<img class="gimg" src="https://api.gogo198.cn/images'+d.goods_image+'">';
                    result += '<div class="gname">'+d.goods_name+'</div>';
                    result += '</div>';
                    return [
                        result
                    ].join('');
                }}
                ,{field:'goods_price',  title: '本店价格'}
                ,{field:'goods_number',  title: '库存'}
                ,{field:'status_name',  title: '状态'}
                ,{field:'created_at',  title: '发布时间'}
                ,{width:180, align:'center', fixed: 'right', title: '操作', templet: function(d){
                        var result = "";

                        result += '<a onclick="openWindow('+ "'["+d.goods_name+"]编辑'" +',' + "'/func/goods/save_goods?&id="+ d.id + '\');" class="layui-btn layui-btn-xs layui-btn-normal">编辑</a>';
                        if(d.goods_status==-1){
                            result += '<a onclick="del('+ "'"+d.id+"'" +',0);" class="layui-btn layui-btn-xs layui-btn-success">提交上架审核</a>';
                        }else if(d.goods_status==1){
                            result += '<a onclick="del('+ "'"+d.id+"'" +',-1);" class="layui-btn layui-btn-xs layui-btn-danger">下架</a>';
                        }
                        result += '<a onclick="del('+ "'"+d.id+"'" +',1);" class="layui-btn layui-btn-xs layui-btn-danger">删除</a>';

                        return [
                            result
                        ].join('');

                        return result;
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
    });

    function openWindow(title,url,type)
    {
        var layer = layui.layer;
        var index = layer.open({
            type: 2,
            title: title,
            content: url,
            area:['100%','100%']
        });
        // layer.full(index);
    }

    function del(id,typ){
        var layer = layui.layer,$ = layui.$;
        layer.confirm('确认要删除该商品吗？',{
            btn:['删除','取消']
        }, function(){
            $.ajax({
                url:"/func/site/del_goods",
                method:'post',
                data:{id:id,typ:typ,'_token':"{{csrf_token()}}"},
                dataType:'JSON',
                success:function(res){
                    layer.msg(res.msg,{time:2000}, function () {
                        if(res.code == 0)
                        {
                            window.location.reload();
                        }
                    });
                },
                error:function (data) {
                    layer.msg('系统错误',{time:2000});
                }
            });
            layer.closeAll();
        }, function(){

        });
    }
</script>
