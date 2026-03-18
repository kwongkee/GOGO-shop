<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>成为买手</title>
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
                        <!--邀请成为买手-->
                        <div class="layui-form-item">
                            <div class="layui-form-label">买手名称</div>
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
                                @if($info['is_verify']==0)
                                    未验证
                                @elseif($info['is_verify']==1)
                                    已验证
                                @endif
                            </div>
                        </div>
                    </div>
    
                    @if($info['is_verify']==0)
                        <div class="layui-form-item" style="margin-top: 25px;text-align: center;">
                            <div>
                                <button class="layui-btn layui-btn-normal" lay-submit lay-filter="component-form-element2">确认成为买手</button>
                            </div>
                        </div>
                    @endif
                @else
                    <!--申请成为买手-->
                    
                    @if(empty($info))
                        <!--没申请过-->
                        <div class="layui-form-item">
                            <div class="layui-form-label">买手类别</div>
                            <div class="layui-input-block">
                                <select name="type" id="type" lay-verify="required" lay-filter="type">
                                    <option value="2">平台买手</option>
                                </select>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-form-label">买手名称</div>
                            <div class="layui-input-block">
                                <input type="text" class="layui-input" name="name" lay-verify="required" value="" placeholder="请输入买手名称">
                            </div>
                        </div>
                           
                        <div class="type_box2">
                            <div class="layui-form-item">
                                <div class="layui-form-label">验证方式</div>
                                <div class="layui-input-block">
                                    <select name="verify_type" id="verify_type" lay-filter="verify_type">
                                        <option value="1">手机号码</option>
                                        <option value="2">电邮地址</option>
                                    </select>
                                </div>
                            </div>
                            <div class="layui-form-item phone" style="display: block">
                                <div class="layui-form-label">手机号码</div>
                                <div class="layui-input-block">
                                    <input type="number" class="layui-input" name="phone" value="{{$website_user['phone']}}" placeholder="请输入手机号码">
                                </div>
                            </div>
                            <div class="layui-form-item email" style="display: none;">
                                <div class="layui-form-label">电子邮箱</div>
                                <div class="layui-input-block">
                                    <input type="text" class="layui-input" name="email" value="{{$website_user['email']}}" placeholder="请输入电子邮箱">
                                </div>
                            </div>
                        </div>
                        
                        <div class="layui-form-item" style="margin-top: 25px;text-align: center;">
                            <div>
                                <button class="layui-btn layui-btn-normal" lay-submit lay-filter="component-form-element2">申请成为买手</button>
                            </div>
                        </div>
                    @else
                        <!--已申请，待审批-->
                        <div class="layui-form-item">
                            <div class="layui-form-label">买手类别</div>
                            <div class="layui-input-block inline_show">
                                平台买手
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-form-label">买手名称</div>
                            <div class="layui-input-block inline_show">
                                {{$info['name']}}
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-form-label">验证方式</div>
                            <div class="layui-input-block inline_show">
                                @if($info['verify_type']==1)
                                    手机号码
                                @elseif($info['verify_type']==2)
                                    电子邮箱
                                @endif
                            </div>
                        </div>
                        <div class="layui-form-item phone" style="display: block">
                            <div class="layui-form-label">
                                @if($info['verify_type']==1) 手机号码 @elseif($info['verify_type']==2) 电子邮箱 @endif
                            </div>
                            <div class="layui-input-block inline_show">
                                @if($info['verify_type']==1) {{$website_user['phone']}} @elseif($info['verify_type']==2) {{$website_user['email']}} @endif
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-form-label">审批状态</div>
                            <div class="layui-input-block inline_show">
                                @if($info['is_verify']==0)
                                <span style="color:#ff2222;">正在审核中~</span>
                                @elseif($info['is_verify']==-1)
                                <span style="color:#ff2222;">已拒绝（拒绝原因：{{$info['remark']}}）</span>
                                @endif
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
                url:"/become_buyer",
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