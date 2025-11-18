<link rel="stylesheet" href="/assets/d2eace91/layui/css/layui.css?v=2312"/>
<script type="text/javascript" src="/assets/d2eace91/layui/layui.js"></script>
<style>
    .disf{display:flex;align-items: center;}
    .layui-card-header{background:#0a8ddf;color:#fff;}
</style>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <form class="layui-form" action="" method="post" lay-filter="component-form-element">
            @csrf
            <div class="layui-col-md12">
                <div class="layui-card">
                    <div class="layui-card-body">
                        <div class="layui-form-item">
                            <div class="layui-form-label">主标题</div>
                            <div class="layui-input-block">
                                <input type="text" class="layui-input" lay-verify="required" name="title" value="{{$data['title']}}">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-form-label">副标题</div>
                            <div class="layui-input-block">
                                <input type="text" class="layui-input" lay-verify="required" name="desc" value="{{$data['desc']}}">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-form-label">搜索文字</div>
                            <div class="layui-input-block">
                                <input type="text" class="layui-input" lay-verify="required" name="search_title" value="{{$data['search_title']}}">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-form-label">搜索图片(316*46)</div>
                            <div class="layui-input-block">
                                <div class="layui-upload" style="margin-top: 10px;">
                                    <button type="button" class="layui-btn" id="img_file-upload">上传图片(一张)</button>
                                    <blockquote class="layui-elem-quote layui-quote-nm yulan" style="margin-top: 10px;">
                                        预览图：
                                        <div class="layui-upload-list" id="img_file-upload-list">
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
                        <div class="layui-form-item">
                            <div class="layui-form-label">底部图(1920*250)</div>
                            <div class="layui-input-block">
                                <div class="layui-upload" style="margin-top: 10px;">
                                    <button type="button" class="layui-btn" id="img_file2-upload">上传图片(一张)</button>
                                    <blockquote class="layui-elem-quote layui-quote-nm yulan" style="margin-top: 10px;">
                                        预览图：
                                        <div class="layui-upload-list" id="img_file2-upload-list">
                                            @if(!empty($data['back_img']))
                                            <div style="display: inline-block;">
                                                <img onclick="seePic(this);" src="https://shop.gogo198.cn/{{$data['back_img']}}" class="layui-upload-img" style="width:80px;height:80px;">
                                                <button type="button" onclick="delPic(this);" class="layui-btn layui-btn-xs layui-btn-danger" style="position: relative;left: -45px;top: -39px;">删除</button>
                                                <input type="hidden" name="back_img[]" value="{{$data['back_img']}}">
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
                layer.msg('请上传搜索图！');
                return false;
            }

            if( $('#img_file2-upload-list').children().length == 0 )
            {
                layer.msg('请上传底部图！');
                return false;
            }

            $.ajax({
                url:"/func/site/search_manage",
                method:'post',
                data:data.field,
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
            return false;
        });

        // 搜索图文件
        upload.render({
            elem: '#img_file-upload'
            ,url: '/func/upload_file'
            ,accept: 'image'
            ,data: { folder: 'centralize', type: 'website_index','_token':"{{csrf_token()}}"}
            ,multiple: false
            ,number:1
            ,before: function(obj){
                layer.load(); //上传loading
            }
            ,done: function(res){
                layer.closeAll('loading'); //关闭loading
                if(res.code == 1)
                {

                    $('#img_file-upload-list').append('<div style="display: inline-block;"><img onclick="seePic(this);" src="https://shop.gogo198.cn/'+ res.file_path +'" class="layui-upload-img" style="width:80px;height:80px;"><button type="button" onclick="delPic(this);" class="layui-btn layui-btn-xs layui-btn-danger" style="position: relative;left: -45px;top: -39px;">删除</button><input type="hidden" name="img[]" value="'+res.file_path+'"></div>')
                }
            }
        });

        // 底部图文件
        upload.render({
            elem: '#img_file2-upload'
            ,url: '/func/upload_file'
            ,accept: 'image'
            ,data: { folder: 'centralize', type: 'website_index','_token':"{{csrf_token()}}"}
            ,multiple: false
            ,number:1
            ,before: function(obj){
                layer.load(); //上传loading
            }
            ,done: function(res){
                layer.closeAll('loading'); //关闭loading
                if(res.code == 1)
                {

                    $('#img_file2-upload-list').append('<div style="display: inline-block;"><img onclick="seePic(this);" src="https://shop.gogo198.cn/'+ res.file_path +'" class="layui-upload-img" style="width:80px;height:80px;"><button type="button" onclick="delPic(this);" class="layui-btn layui-btn-xs layui-btn-danger" style="position: relative;left: -45px;top: -39px;">删除</button><input type="hidden" name="back_img[]" value="'+res.file_path+'"></div>')
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
