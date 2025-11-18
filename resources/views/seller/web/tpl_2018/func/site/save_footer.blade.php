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
            <input type="text" style="display:none;" name="pid" id="pid" value="{{$pid}}">
            @csrf
            <div class="layui-col-md12">
                <div class="layui-card">
                    <div class="layui-card-body">
                        <div class="layui-form-item">
                            <div class="layui-form-label">菜单名称</div>
                            <div class="layui-input-block">
                                <input type="text" class="layui-input" name="name" placeholder="请输入菜单名称" value="{{$data['name']}}">
                            </div>
                        </div>
                        @if($pid!=0)
                            <div class="layui-form-item">
                                <div class="layui-form-label">导流类型</div>
                                <div class="layui-input-block">
                                    <select name="type" lay-filter="type">
                                        <option value="1" @if($data['type']==1)
                                            selected
                                        @endif>应用</option>
                                        <option value="2" @if($data['type']==2)
                                            selected
                                        @endif>政策</option>
                                        <option value="3" @if($data['type']==3)
                                            selected
                                        @endif>消息</option>
                                        <option value="4" @if($data['type']==4)
                                            selected
                                        @endif>规则</option>
                                        <option value="5" @if($data['type']==5)
                                            selected
                                        @endif>图文</option>
                                    </select>
                                </div>
                            </div>
                            <div class="layui-form-item select_app" style="display: @if($data['type']==1)
                                    block
                                @else
                                    none
                                @endif;">
                                <div class="layui-form-label">选择应用</div>
                                <div class="layui-input-block">
                                    <select name="content_id1" lay-search>
                                        <option value="">请选择应用</option>
                                        @foreach($appLink as $vo)
                                        <option value="{{$vo['id']}}" @if($vo['id']==$data['content_id'])
                                            selected
                                        @endif>{{$vo['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="layui-form-item select_policy" style="display: @if($data['type']==2)
                                    block
                                @else
                                    none
                                @endif;">
                                <div class="layui-form-label">选择政策</div>
                                <div class="layui-input-block">
                                    <select name="content_id2" lay-search>
                                        <option value="">请选择政策</option>
                                        @foreach($policyLink as $vo)
                                        <option value="{{$vo['id']}}" @if($vo['id']==$data['content_id'])
                                            selected
                                        @endif>{{$vo['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="layui-form-item select_msg" style="display: @if($data['type']==3)
                                    block
                                @else
                                    none
                                @endif;">
                                <div class="layui-form-label">选择消息</div>
                                <div class="layui-input-block">
                                    <select name="content_id3" lay-search>
                                        <option value="">请选择消息</option>
                                        @foreach($msgLink as $vo)
                                        <option value="{{$vo['id']}}" @if($vo['id']==$data['content_id'])
                                            selected
                                        @endif>{{$vo['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="layui-form-item select_rule" style="display: @if($data['type']==4)
                                    block
                                @else
                                    none
                                @endif;">
                                <div class="layui-form-label">选择规则</div>
                                <div class="layui-input-block">
                                    <select name="content_id4" lay-search>
                                        <option value="">请选择规则</option>
                                        @foreach($ruleLink as $vo)
                                        <option value="{{$vo['id']}}" @if($vo['id']==$data['content_id'])
                                            selected
                                        @endif>{{$vo['rule_name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="layui-form-item select_img" style="display: @if($data['type']==5)
                                    block
                                @else
                                    none
                                @endif;">
                                <div class="layui-form-label">选择图文</div>
                                <div class="layui-input-block">
                                    <select name="content_id5" lay-search>
                                        <option value="">请选择图文</option>
                                        @foreach($imgLink as $vo)
                                        <option value="{{$vo['id']}}" @if($vo['id']==$data['content_id'])
                                            selected
                                        @endif>{{$vo['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="layui-form-item">
                                <div class="layui-form-label">页面底部应用链接</div>
                                <div class="layui-input-block">
                                    <select name="have_link" lay-filter="have_link">
                                        <option value="0" @if($data['have_link']==0)
                                            selected
                                        @endif>无需配置</option>
                                        <option value="1" @if($data['have_link']==1)
                                            selected
                                        @endif>需要配置</option>
                                    </select>
                                </div>
                            </div>
                            <div class="layui-form-item other_app" style="display: @if($data['have_link']==1)
                                    block
                                @else
                                    none
                                @endif;">
                                <div class="layui-form-label">选择应用</div>
                                <div class="layui-input-block">
                                    <select name="app_id" lay-search>
                                        <option value="">请选择应用</option>
                                        @foreach($appLink as $vo)
                                        <option value="{{$vo['id']}}" @if($vo['id']==$data['app_id'])
                                            selected
                                        @endif>{{$vo['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif
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

        form.on('select(type)',function(data){
            let val = data.value;

            if(val==1){
                $('.select_app').show();
                $('.select_policy').hide();
                $('.select_msg').hide();
                $('.select_rule').hide();
                $('.select_img').hide();
            }else if(val==2){
                $('.select_app').hide();
                $('.select_policy').show();
                $('.select_msg').hide();
                $('.select_rule').hide();
                $('.select_img').hide();
            }else if(val==3){
                $('.select_app').hide();
                $('.select_policy').hide();
                $('.select_msg').show();
                $('.select_rule').hide();
                $('.select_img').hide();
            }else if(val==4){
                $('.select_app').hide();
                $('.select_policy').hide();
                $('.select_msg').hide();
                $('.select_rule').show();
                $('.select_img').hide();
            }else if(val==5){
                $('.select_app').hide();
                $('.select_policy').hide();
                $('.select_msg').hide();
                $('.select_rule').hide();
                $('.select_img').show();
            }
        });

        form.on('select(have_link)',function(data){
            let val = data.value;
            if(val==1){
                $('.other_app').show();
            }else if(val==0){
                $('.other_app').hide();
            }
        });

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
                url:"/func/site/save_footer",
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

        upload.render({
            elem: '#img_file-upload'
            ,url: '/func/upload_file'
            ,accept: 'image'
            ,data: { folder: 'centralize', type: 'website_index'}
            ,multiple: false
            ,number:1
            ,before: function(obj){
                layer.load(); //上传loading
            }
            ,done: function(res){
                layer.closeAll('loading'); //关闭loading
                if(res.code == 1)
                {

                    $('#img_file-upload-list').append('<div style="display: inline-block;"><img onclick="seePic(this);" src="/'+ res.file_path +'" class="layui-upload-img" style="width:80px;height:80px;"><button type="button" onclick="delPic(this);" class="layui-btn layui-btn-xs layui-btn-danger" style="position: relative;left: -45px;top: -39px;">删除</button><input type="hidden" name="icon[]" value="'+res.file_path+'"></div>');
                }
            }
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
