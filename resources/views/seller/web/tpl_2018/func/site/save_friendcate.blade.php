<link rel="stylesheet" href="/assets/d2eace91/layui/css/layui.css?v=2312"/>
<script type="text/javascript" src="/assets/d2eace91/layui/layui.js"></script>
<script src="/assets/d2eace91/layui/xm-select.js"></script>
<style>
    .disf{display:flex;align-items: center;}
    .layui-card-header{background:#0a8ddf;color:#fff;}
</style>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <form class="layui-form" action="" method="post" lay-filter="component-form-element">
            <input type="text" style="display:none;" name="id" id="id" value="{{$id}}">
            @csrf
            <div class="layui-col-md12">
                <div class="layui-card">
                    <div class="layui-card-body">
                        <div class="layui-form-item">
                            <div class="layui-form-label">分类名称</div>
                            <div class="layui-input-block">
                                <input type="text" class="layui-input" lay-verify="required" name="name[zh]" value="{{$data['name']['zh']}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="layui-form-item" style="margin-top: 25px;text-align: center;">
                <div>
                    <button class="layui-btn layui-btn-normal" lay-submit lay-filter="component-form-element">立即提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    layui.use(['layer','form', 'table', 'upload','laydate','colorpicker'],function(){
        var layer = layui.layer
            ,form  = layui.form
            ,$ = layui.jquery
            ,upload = layui.upload
            ,laydate = layui.laydate
            ,colorpicker = layui.colorpicker;

        form.render(null,'component-form-element');

        form.on('submit(component-form-element)', function(data){
            // JSON.stringify()
            // console.log(data.field);return false;
            // if( $('#img_file-upload-list').children().length == 0 )
            // {
            //     layer.msg('请上传轮播图！');
            //     return false;
            // }

            $.ajax({
                url:"/func/site/save_friendcate",
                method:'post',
                data:data.field,
                dataType:'JSON',
                success:function(res){
                    layer.msg(res.msg,{time:2000}, function () {
                        if(res.code == 0)
                        {
                            parent.location.reload();
                        }
                    });
                },
                error:function (data) {
                    layer.msg('系统错误',{time:2000});
                }
            });
            return false;
        });
    });

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

</script>
