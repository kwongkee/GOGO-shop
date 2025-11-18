<link rel="stylesheet" href="/assets/d2eace91/layui/css/layui.css?v=2312"/>
<script type="text/javascript" src="/assets/d2eace91/layui/layui.js"></script>
<script src="/assets/d2eace91/layui/xm-select.js"></script>
<style>
    .format1,.format2,.url,.seo_content,.other_link,.other_navbar,.link,.img{display:none;}
    .seo_content{border:1px solid #eee;padding:20px;box-sizing: border-box;}
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
                            <div class="layui-form-label">社交名称</div>
                            <div class="layui-input-block">
                                <input type="text" class="layui-input" lay-verify="required" name="name" value="{{$data['name']}}">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-form-label">图标<br/>(200*200)</div>
                            <div class="layui-input-block">
                                <div class="layui-upload" style="margin-top: 10px;">
                                    <button type="button" class="layui-btn" id="img_file-upload">上传图片(一张)</button>
                                    <blockquote class="layui-elem-quote layui-quote-nm yulan" style="margin-top: 10px;">
                                        预览图：
                                        <div class="layui-upload-list" id="img_file-upload-list" style="background: #e6e6e6;">
                                            @if(!empty($data['ico']))
                                            <div style="display: inline-block;">
                                                <img onclick="seePic(this);" src="https://shop.gogo198.cn/{{$data['ico']}}" class="layui-upload-img" style="width:80px;height:80px;">
                                                <button type="button" onclick="delPic(this);" class="layui-btn layui-btn-xs layui-btn-danger" style="position: relative;left: -45px;top: -39px;">删除</button>
                                                <input type="hidden" name="ico[]" value="{{$data['ico']}}">
                                            </div>
                                            @endif
                                        </div>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-form-label">跳转方式</div>
                            <div class="layui-input-block">
                                <select name="type" id="type" lay-filter="type">
                                    <option value="">请选择</option>
                                    <option value="1" @if($data['type']==1)
                                        selected
                                    @endif>链接</option>
                                    <option value="2" @if($data['type']==2)
                                        selected
                                    @endif>二维码</option>
                                </select>
                            </div>
                        </div>
                        <div class="layui-form-item link" @if($data['type']==1)
                            style="display:block;"
                         @endif>
                            <div class="layui-form-label">链接</div>
                            <div class="layui-input-block">
                                <input type="text" class="layui-input" name="link" value="{{$data['link']}}">
                            </div>
                        </div>
                        <div class="layui-form-item img" @if($data['type']==2)
                            style="display:block;"
                         @endif>
                            <div class="layui-form-label">二维码</div>
                            <div class="layui-input-block">
                                <div class="layui-upload" style="margin-top: 10px;">
                                    <button type="button" class="layui-btn" id="img_file2-upload">上传图片(一张)</button>
                                    <blockquote class="layui-elem-quote layui-quote-nm yulan" style="margin-top: 10px;">
                                        预览图：
                                        <div class="layui-upload-list" id="img_file2-upload-list" style="background: #e6e6e6;">
                                            @if(!empty($data['img']))
                                            <div style="display: inline-block;">
                                                <img onclick="seePic(this);" src="https://shop.gogo198.cn/{{$data['img']}}" class="layui-upload-img" style="width:80px;height:80px;">
                                                <button type="button" onclick="delPic(this);" class="layui-btn layui-btn-xs layui-btn-danger" style="position: relative;left: -45px;top: -39px;">删除</button>
                                                <input type="hidden" name="img[]" value="{{$data['img']}}">
                                            </div>
                                            @endif
                                        </div>
                                    </blockquote>
                                </div>
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

        //跳转方式
        form.on('select(type)',function(data){
            let val = data.value;
            if(val==1){
                $('.link').show();
                $('.img').hide();
            }else if(val==2){
                $('.link').hide();
                $('.img').show();
            }else{
                $('.link').hide();
                $('.img').hide();
            }
        });

        // ico
        upload.render({
            elem: '#img_file-upload'
            ,url: '/func/upload_file'
            ,accept: 'image'
            ,data: { folder: 'centralize', type: 'website_contact'}
            ,multiple: false
            ,number:1
            ,before: function(obj){
                layer.load(); //上传loading
            }
            ,done: function(res){
                layer.closeAll('loading'); //关闭loading
                if(res.code == 1)
                {

                    $('#img_file-upload-list').append('<div style="display: inline-block;"><img onclick="seePic(this);" src="https://shop.gogo198.cn/'+ res.file_path +'" class="layui-upload-img" style="width:80px;height:80px;"><button type="button" onclick="delPic(this);" class="layui-btn layui-btn-xs layui-btn-danger" style="position: relative;left: -45px;top: -39px;">删除</button><input type="hidden" name="ico[]" value="'+res.file_path+'"></div>')
                }
            }
        });

        //二维码
        upload.render({
            elem: '#img_file2-upload'
            ,url: '/func/upload_file'
            ,accept: 'image'
            ,data: { folder: 'centralize', type: 'website_contact'}
            ,multiple: false
            ,number:1
            ,before: function(obj){
                layer.load(); //上传loading
            }
            ,done: function(res){
                layer.closeAll('loading'); //关闭loading
                if(res.code == 1)
                {

                    $('#img_file2-upload-list').append('<div style="display: inline-block;"><img onclick="seePic(this);" src="https://shop.gogo198.cn/'+ res.file_path +'" class="layui-upload-img" style="width:80px;height:80px;"><button type="button" onclick="delPic(this);" class="layui-btn layui-btn-xs layui-btn-danger" style="position: relative;left: -45px;top: -39px;">删除</button><input type="hidden" name="img[]" value="'+res.file_path+'"></div>')
                }
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
                url:"/func/site/save_contact",
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
