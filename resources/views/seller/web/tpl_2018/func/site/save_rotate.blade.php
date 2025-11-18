<link rel="stylesheet" href="/assets/d2eace91/layui/css/layui.css?v=2312"/>
<script type="text/javascript" src="/assets/d2eace91/layui/layui.js"></script>
<style>
    .disf{display:flex;align-items: center;}
    .layui-card-header{background:#0a8ddf;color:#fff;}
    .other_link,.other_navbar,.other_pic,.other_msg{display:none;}
</style>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <form class="layui-form" action="" method="post" lay-filter="component-form-element">
            <input type="text" style="display:none;" name="id" id="id" value="{{$id}}">
            <div class="layui-col-md12">
                <div class="layui-card">
                    <div class="layui-card-body">
                        <div class="layui-form-item">
                            <div class="layui-form-label">轮播图标题</div>
                            <div class="layui-input-block">
                                <input type="text" class="layui-input" lay-verify="required" name="title" value="{{$data['title']}}">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-form-label">首页轮播图(1920*500)</div>
                            <div class="layui-input-block">
                                <div class="layui-upload" style="margin-top: 10px;">
                                    <button type="button" class="layui-btn" id="img_file-upload">上传图片(一张)</button>
                                    <blockquote class="layui-elem-quote layui-quote-nm yulan" style="margin-top: 10px;">
                                        预览图：
                                        <div class="layui-upload-list" id="img_file-upload-list">
                                            @if(!empty($data['thumb']))
                                            <div style="display: inline-block;">
                                                <img onclick="seePic(this);" src="https://shop.gogo198.cn/{{$data['thumb']}}" class="layui-upload-img" style="width:80px;height:80px;">
                                                <button type="button" onclick="delPic(this);" class="layui-btn layui-btn-xs layui-btn-danger" style="position: relative;left: -45px;top: -39px;">删除</button>
                                                <input type="hidden" name="thumb[]" value="{{$data['thumb']}}">
                                            </div>
                                            @endif
                                        </div>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-form-label">跳转链接</div>
                            <div class="layui-input-block">
                                <select name="go_other" lay-filter="go_other">
                                    <option value="0">否</option>
                                    <option value="1" @if($data['go_other']==1)
                                        selected
                                    @endif>第三方链接</option>
                                    <option value="2" @if($data['go_other']==2)
                                        selected
                                    @endif>应用链接</option>
                                    <option value="3" @if($data['go_other']==3)
                                        selected
                                    @endif>图文链接</option>
                                    <option value="4" @if($data['go_other']==4)
                                        selected
                                    @endif>消息链接</option>
                                </select>
                            </div>
                        </div>
                        <div class="layui-form-item other_link" @if($data['go_other']==1)
                                style="display:block;"
                            @endif>
                            <div class="layui-form-label">第三方链接</div>
                            <div class="layui-input-block">
                                <input type="text" class="layui-input" name="other_link" placeholder="请输入第三方链接" value="{{$data['other_link']}}">
                            </div>
                        </div>
                        <div class="layui-form-item other_navbar" @if($data['go_other']==2)
                                style="display:block;"
                             @endif>
                            <div class="layui-form-label">应用链接</div>
                            <div class="layui-input-block">
                                <select name="other_navbar" lay-search>
                                    <option value="">请选择应用</option>
                                    @foreach($list as $k=>$vo)
                                        <option value="{{$vo['id']}}" @if($data['other_navbar']==$vo['id'])
                                            selected
                                        @endif>{{$vo['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="layui-form-item other_pic" @if($data['go_other']==3)
                                style="display:block;"
                             @endif>
                            <div class="layui-form-label">图文链接</div>
                            <div class="layui-input-block">
                                <select name="other_pic" lay-search>
                                    <option value="">请选择图文</option>
                                    @foreach($pic_list as $k=>$vo)
                                    <option value="{{$vo['id']}}" @if($data['other_pic']==$vo['id'])
                                        selected
                                    @endif>{{$vo['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="layui-form-item other_msg" @if($data['go_other']==4)
                                style="display:block;"
                             @endif>
                            <div class="layui-form-label">消息链接</div>
                            <div class="layui-input-block">
                                <select name="other_msg" lay-search>
                                    <option value="">请选择消息</option>
                                    @foreach($msg_list as $k=>$vo)
                                    <option value="{{$vo['id']}}" @if($data['other_msg']==$vo['id'])
                                        selected
                                    @endif>{{$vo['name']}}</option>
                                    @endforeach
                                </select>
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
    layui.use(['layer','form', 'table', 'upload'],function(){
        var layer = layui.layer
            ,form  = layui.form
            ,$ = layui.jquery
            ,upload = layui.upload;

        form.on('select(go_other)',function(data){
            let val = data.value;
            if(val==0){
                $('.other_link').hide();
                $('.other_navbar').hide();
                $('.other_pic').hide();
                $('.other_msg').hide();
            }else if(val==1){
                $('.other_link').show();
                $('.other_navbar').hide();
                $('.other_pic').hide();
                $('.other_msg').hide();
            }else if(val==2){
                $('.other_link').hide();
                $('.other_pic').hide();
                $('.other_msg').hide();
                $('.other_navbar').show();
            }else if(val==3){
                $('.other_link').hide();
                $('.other_pic').show();
                $('.other_msg').hide();
                $('.other_navbar').hide();
            }else if(val==4){
                $('.other_link').hide();
                $('.other_pic').hide();
                $('.other_msg').show();
                $('.other_navbar').hide();
            }
        });

        form.on('submit(component-form-element)', function(data){
            // JSON.stringify()
            // console.log(data.field);return false;
            if( $('#img_file-upload-list').children().length == 0 )
            {
                layer.msg('请上传轮播图！');
                return false;
            }

            $.ajax({
                url:"/func/site/save_rotate",
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

        // 轮播图文件
        upload.render({
            elem: '#img_file-upload'
            ,url: '/func/upload_file'
            ,accept: 'image'
            ,data: { folder: 'centralize', type: 'website_rotate','_token':"{{csrf_token()}}"}
            ,multiple: false
            ,number:1
            ,before: function(obj){
                layer.load(); //上传loading
            }
            ,done: function(res){
                layer.closeAll('loading'); //关闭loading
                if(res.code == 1)
                {

                    $('#img_file-upload-list').append('<div style="display: inline-block;"><img onclick="seePic(this);" src="https://shop.gogo198.cn/'+ res.file_path +'" class="layui-upload-img" style="width:80px;height:80px;"><button type="button" onclick="delPic(this);" class="layui-btn layui-btn-xs layui-btn-danger" style="position: relative;left: -45px;top: -39px;">删除</button><input type="hidden" name="thumb[]" value="'+res.file_path+'"></div>')
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
