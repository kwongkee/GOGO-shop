<link rel="stylesheet" href="/assets/d2eace91/layui/css/layui.css?v=2312"/>
<script src="/assets/d2eace91/layui/xm-select3.js?v=20180418"></script>
<script type="text/javascript" src="/assets/d2eace91/layui/layui.js"></script>
<!--百度富文本-->
<script type="text/javascript" src="/assets/d2eace91/plugins/ueditor/ueditor.config.js?v=777"></script>
<script type="text/javascript" src="/assets/d2eace91/plugins/ueditor/ueditor.all.min.js?v=2.8"> </script>
<script type="text/javascript" src="/assets/d2eace91/plugins/ueditor/lang/zh-cn/zh-cn.js"></script>
<style>
    .layui-col-space15>*{padding:20px;}
    .layui-row{background:#e0d7d7;}
    /*富文本样式*/
    .edui-editor-iframeholder iframe{background:#444444;}
    .edui-editor{z-index: 1 !important;}
</style>
<div class="layui-fluid" style="padding:5px;">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-body" style="padding:10px;">
                    <form class="layui-form" action="">
                        @csrf
                        <div class="layui-form-item">
                            <div class="layui-form-label">网站小标志(200*200)</div>
                            <div class="layui-input-block">
                                <div class="layui-upload" style="margin-top: 10px;">
                                    <button type="button" class="layui-btn" id="slogo_file-upload">上传图片(一张)</button>
                                    <blockquote class="layui-elem-quote layui-quote-nm yulan" style="margin-top: 10px;">
                                        预览图：
                                        <div class="layui-upload-list" id="slogo_file-upload-list">
                                            @if(!empty($data['slogo']))
                                            <div style="display: inline-block;">
                                                <img onclick="seePic(this);" src="https://shop.gogo198.cn/{{$data['slogo']}}" class="layui-upload-img" style="width:80px;height:80px;">
                                                <button type="button" onclick="delPic(this);" class="layui-btn layui-btn-xs layui-btn-danger" style="position: relative;left: -45px;top: -39px;">删除</button>
                                                <input type="hidden" name="slogo_file[]" value="{{$data['slogo']}}">
                                            </div>
                                            @endif
                                        </div>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-form-label">网站标志(125*55)</div>
                            <div class="layui-input-block">
                                <div class="layui-upload" style="margin-top: 10px;">
                                    <button type="button" class="layui-btn" id="logo_file-upload">上传图片(一张)</button>
                                    <blockquote class="layui-elem-quote layui-quote-nm yulan" style="margin-top: 10px;">
                                        预览图：
                                        <div class="layui-upload-list" id="logo_file-upload-list">
                                            @if(!empty($data['logo']))
                                            <div style="display: inline-block;">
                                                <img onclick="seePic(this);" src="https://shop.gogo198.cn/{{$data['logo']}}" class="layui-upload-img" style="width:80px;height:80px;">
                                                <button type="button" onclick="delPic(this);" class="layui-btn layui-btn-xs layui-btn-danger" style="position: relative;left: -45px;top: -39px;">删除</button>
                                                <input type="hidden" name="logo_file[]" value="{{$data['logo']}}">
                                            </div>
                                            @endif
                                        </div>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                        <div class="layui-form-item" style="display: none;">
                            <div class="layui-form-label">首页背景图<br/>(896*1344)</div>
                            <div class="layui-input-block">
                                <div class="layui-upload" style="margin-top: 10px;">
                                    <button type="button" class="layui-btn" id="inpic_file-upload">上传图片(一张)</button>
                                    <blockquote class="layui-elem-quote layui-quote-nm yulan" style="margin-top: 10px;">
                                        预览图：
                                        <div class="layui-upload-list" id="inpic_file-upload-list">
                                            @if(!empty($data['inpic']))
                                            <div style="display: inline-block;">
                                                <img onclick="seePic(this);" src="https://shop.gogo198.cn/{{$data['inpic']}}" class="layui-upload-img" style="width:80px;height:80px;">
                                                <button type="button" onclick="delPic(this);" class="layui-btn layui-btn-xs layui-btn-danger" style="position: relative;left: -45px;top: -39px;">删除</button>
                                                <input type="hidden" name="inpic[]" value="{{$data['inpic']}}">
                                            </div>
                                            @endif
                                        </div>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">网站名称</label>
                            <div class="layui-input-block">
                                <input type="text" name="name" value="{{$data['name']}}"  lay-verify="required" placeholder="请输入网站名称" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">网站描述</label>
                            <div class="layui-input-block">
                                <input type="text" name="desc" value="{{$data['desc']}}"  lay-verify="required" placeholder="请输入网站描述" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">网站关键词</label>
                            <div class="layui-input-block">
                                <input type="text" name="keywords" value="{{$data['keywords']}}"  lay-verify="required" placeholder="请输入网站关键词" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">客服电话</label>
                            <div class="layui-input-block">
                                <input type="text" name="mobile" value="{{$data['mobile']}}"  lay-verify="required" placeholder="请输入客服电话" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">客服电邮</label>
                            <div class="layui-input-block">
                                <input type="text" name="email" value="{{$data['email']}}"  lay-verify="required" placeholder="请输入客服电邮" autocomplete="off" class="layui-input">
                            </div>
                        </div>

                        <div class="layui-form-item" style="display: none;">
                            <label class="layui-form-label">服务时间</label>
                            <div class="layui-input-block">
                                <input type="text" name="service_time" value="{{$data['service_time']}}"  lay-verify="" placeholder="请输入服务时间" autocomplete="off" class="layui-input">
                            </div>
                        </div>

                        <div class="layui-form-item">
                            <label class="layui-form-label">加入我们</label>
                            <div class="layui-input-block">
                                <input type="text" name="join_us" value="{{$data['join_us']}}"  lay-verify="" placeholder="请输入加入我们链接" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">服务协议</label>
                            <div class="layui-input-block">
                                <select name="service_rule" lay-search>
                                    <option value="">请选择</option>
                                    @foreach($rule as $vo)
                                    <option value="{{$vo['id']}}" @if($data['service_rule']==$vo['id'])
                                        selected
                                    @endif>{{$vo['rule_name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">私隐声明</label>
                            <div class="layui-input-block">
                                <select name="privacy_rule" lay-search>
                                    <option value="">请选择</option>
                                    @foreach($rule as $vo)
                                    <option value="{{$vo['id']}}" @if($data['privacy_rule']==$vo['id'])
                                        selected
                                    @endif>{{$vo['rule_name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="layui-form-item" style="display: none;">
                            <div class="layui-form-label">关于我们</div>
                            <div class="layui-input-block">
                                <script id="introduce" name="content[introduce]" type="text/plain" style="width:100%;height:100px;">
                                    @if(!empty($data['content']['introduce']))
                                        {!! $data['content']['introduce'] !!}
                                    @endif
                                </script>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-form-label">帮助中心</div>
                            <div class="layui-input-block">
                                <script id="help" name="content[help]" type="text/plain" style="width:100%;height:100px;">
                                    @if(!empty($data['content']['help']))
                                        {!! $data['content']['help'] !!}
                                    @endif
                                </script>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-form-label">版权信息</div>
                            <div class="layui-input-block">
                                <script id="copyright" name="copyright" type="text/plain" style="width:100%;height:100px;">
                                    @if(!empty($data['copyright']))
                                        {!! $data['copyright'] !!}
                                    @endif
                                </script>
                                <div class="clearfix"></div>
                            </div>
                        </div>

                        <div class="layui-form-item">
                            <div class="layui-input-block">
                                <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    layui.use(['layer','form','laydate','upload','table','element'],function() {
        var laydate = layui.laydate,
            layer = layui.layer,
            form = layui.form,
            $ = layui.jquery,
            table = layui.table,
            element = layui.element,
            upload = layui.upload;

        form.render(null,'component-form-group');

        UE.getEditor('introduce', {
            initialFrameHeight: 200,
            serverUrl: '/assets/d2eace91/plugins/ueditor/php/controller.php',
        });
        UE.getEditor('copyright', {
            initialFrameHeight: 200,
            serverUrl: '/assets/d2eace91/plugins/ueditor/php/controller.php',
        });
        UE.getEditor('help', {
            initialFrameHeight: 200,
            serverUrl: '/assets/d2eace91/plugins/ueditor/php/controller.php',
        });

        setTimeout(function(){
            console.log($('#edui1').find('body'));
            $('#edui1').find('body').css('background','#666');
        },3000);

        form.on('submit(formDemo)',function(data){
            $.ajax({
                url: "/func/site/basic_info",
                method: 'post',
                data: data.field,
                dataType: 'JSON',
                success: function (res) {
                    layer.msg(res.msg, {time: 2000}, function () {
                        if (res.code == 0) {
                            window.location.reload();
                        }
                    });
                },
                error: function (data) {
                    layer.msg('系统错误', {time: 2000});
                }
            });
            return false;
        });

        upload.render({
            elem: '#slogo_file-upload'
            ,url: '/func/upload_file'
            ,accept: 'file'
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

                    $('#slogo_file-upload-list').append('<div style="display: inline-block;"><img onclick="seePic(this);" src="https://shop.gogo198.cn/'+ res.file_path +'" class="layui-upload-img" style="width:80px;height:80px;"><button type="button" onclick="delPic(this);" class="layui-btn layui-btn-xs layui-btn-danger" style="position: relative;left: -45px;top: -39px;">删除</button><input type="hidden" name="slogo_file[]" value="'+res.file_path+'"></div>');
                }
            }
        });

        // 轮播图内页文件
        upload.render({
            elem: '#logo_file-upload'
            ,url: '/func/upload_file'
            ,accept: 'file'
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

                    $('#logo_file-upload-list').append('<div style="display: inline-block;"><img onclick="seePic(this);" src="https://shop.gogo198.cn/'+ res.file_path +'" class="layui-upload-img" style="width:80px;height:80px;"><button type="button" onclick="delPic(this);" class="layui-btn layui-btn-xs layui-btn-danger" style="position: relative;left: -45px;top: -39px;">删除</button><input type="hidden" name="logo_file[]" value="'+res.file_path+'"></div>');
                }
            }
        });

        upload.render({
            elem: '#inpic_file-upload'
            ,url: '/func/upload_file'
            ,accept: 'file'
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

                    $('#inpic_file-upload-list').append('<div style="display: inline-block;"><img onclick="seePic(this);" src="https://shop.gogo198.cn/'+ res.file_path +'" class="layui-upload-img" style="width:80px;height:80px;"><button type="button" onclick="delPic(this);" class="layui-btn layui-btn-xs layui-btn-danger" style="position: relative;left: -45px;top: -39px;">删除</button><input type="hidden" name="inpic[]" value="'+res.file_path+'"></div>');
                }
            }
        });

        // 轮播图内页文件
        upload.render({
            elem: '#banner_file-upload'
            ,url: '/func/upload_file'
            ,accept: 'file'
            ,data: { folder: 'centralize', type: 'gather_index'}
            ,multiple: false
            ,number:1
            ,before: function(obj){
                layer.load(); //上传loading
            }
            ,done: function(res){
                layer.closeAll('loading'); //关闭loading
                if(res.code == 1)
                {

                    $('#banner_file-upload-list').append('<div style="display: inline-block;"><img onclick="seePic(this);" src="https://shop.gogo198.cn/'+ res.file_path +'" class="layui-upload-img" style="width:80px;height:80px;"><button type="button" onclick="delPic(this);" class="layui-btn layui-btn-xs layui-btn-danger" style="position: relative;left: -45px;top: -39px;">删除</button><input type="hidden" name="banner_file[]" value="'+res.file_path+'"></div>');
                }
            }
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