<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>成为客服</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0">
    <link rel="stylesheet" href="/assets/d2eace91/layui/css/layui.css">
    <script src="/assets/d2eace91/layui/layui.js"></script>
    <style>
        .layui-fluid{padding-top:15px;}
        .layui-form-item{margin-bottom: 10px;}
        .inline{line-height: 38px;}
        .disf{display:flex;align-items: center;}
        .inline_show{line-height:38px;}
    </style>
</head>
<body style="background: #eee;">
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <form class="layui-form" action="" id="bill" method="post" lay-filter="component-form-element">
                <input type="text" style="display:none;" name="id" id="id" value="{{$id}}">
                <input type="text" style="display:none;" name="pa" id="pa" value="1">
                <div class="layui-card">
                    @if(!empty($id))
                        <!--邀请成为客服-->
                        <div class="layui-form-item">
                            <div class="layui-form-label">客服名称</div>
                            <div class="layui-input-block inline">
                                {{$info['name']}}
                            </div>
                        </div>
                        @if(!empty($info['phone']))
                            <div class="layui-form-item">
                                <div class="layui-form-label">手机号码</div>
                                <div class="layui-input-block inline">
                                    {{$info['phone']}}
                                </div>
                            </div>
                        @endif
                        @if(!empty($info['email']))
                            <div class="layui-form-item">
                                <div class="layui-form-label">邮箱号码</div>
                                <div class="layui-input-block inline">
                                    {{$info['email']}}
                                </div>
                            </div>
                        @endif
                        <div class="layui-form-item">
                            <div class="layui-form-label">验证状态</div>
                            <div class="layui-input-block inline">
                                @if($info['status']==0)
                                    未验证
                                @elseif($info['status']==1)
                                    已验证
                                @elseif($info['status']==-1)
                                    已拒绝
                                @endif
                            </div>
                        </div>
                    </div>
    
                    @if($info['status']==0)
                        <div class="layui-form-item" style="margin-top: 25px;text-align: center;">
                            <div>
                                <button class="layui-btn layui-btn-normal" lay-submit lay-filter="component-form-element2">确认成为客服</button>
                            </div>
                        </div>
                    @endif
                @endif
            </form>
        </div>
    </div>
</div>
</body>
<script>
    layui.use(['layer', 'form', 'table', 'upload'], function () {
        var $ = layui.$
            , layer = layui.layer
            , form = layui.form
            , element = layui.element
            , upload = layui.upload
            , table = layui.table;

        form.on('select(verify_type)',function(data){
            let val = data.value;
            if(val==1){
                $('.phone').show();
                $('.email').hide();
            }else if(val==2){
                $('.phone').hide();
                $('.email').show();
            }
        });

        form.on('submit(component-form-element2)',function(data){
            layer.load();
            $.ajax({
                url:"/become_servicer",
                method:'post',
                data:data.field,
                dataType:'JSON',
                success:function(res){
                    layer.closeAll('loading');
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
            return false;
        });
    });

    function openWindow(ip,typ) {
        let url = '';
        if (typ == 1) {
            window.location.href = "/?s=log_detail&ip=" + ip;
        }
    }
</script>
</html>