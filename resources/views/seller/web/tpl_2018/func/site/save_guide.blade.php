<link rel="stylesheet" href="/assets/d2eace91/layui/css/layui.css?v=2312"/>
<script type="text/javascript" src="/assets/d2eace91/layui/layui.js"></script>
<script src="/assets/d2eace91/layui/xm-select.js"></script>
<style>
    .disf{display:flex;align-items: center;}
    .disf .format_seldiv{width:200px;}
    .disf .format_div{width:300px;}
    .layui-card-header{background:#0a8ddf;color:#fff;}
    .other_link,.other_navbar,.other_pic,.other_msg{display:none;}
    .f15{font-size: 15px;}
    .f20{font-size: 20px;}
    .f25{font-size: 25px;}
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
                            <div class="layui-form-label">排序</div>
                            <div class="layui-input-block">
                                <input type="text" class="layui-input" lay-verify="" name="displayorders" value="{{$data['displayorders']}}">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-form-label">主标题</div>
                            <div class="layui-input-block">
                                <input type="text" class="layui-input" lay-verify="required" name="title" value="{{$data['title']}}" placeholder="请输入主标题">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-form-label">描述</div>
                            <div class="layui-input-block">
                                <input type="text" class="layui-input" lay-verify="required" name="desc" value="{{$data['desc']}}" placeholder="请输入描述">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-form-label">选择版式</div>
                            <div class="layui-input-block">
                                <div class="disf">
                                    <div class="format_seldiv">
                                        <select name="content_id" id="content_id" lay-verify="required" lay-filter="content_id">
                                            <option value="">请选择版式</option>
                                            @foreach($content2 as $vo)
                                            <option value="{{$vo['id']}}" @if($vo['id']==$data['content_id'])
                                                selected
                                            @endif>{{$vo['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="format_div">
                                        <div class="gcate_div" style="display:@if($id==0)
                                                none
                                            @elseif($data['format_info']['type']==1 && $data['format_info']['type2']==3)
                                                block
                                            @else
                                                none
                                            @endif;">
                                            <div id="catediv" class="xm-select-demo"></div>
                                        </div>
                                        <div class="gkeywords_div" style="display:@if($id==0)
                                                none
                                            @elseif($data['format_info']['type']==1 && $data['format_info']['type2']==4)
                                                block
                                            @else
                                                none
                                            @endif;">
                                            <input type="text" class="layui-input" name="gkeywords" placeholder="关键词以“、”号隔开" value="{{$data['gkeywords']}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="layui-form-item timesel" style="display:@if($id==0)
                                none
                            @elseif($data['format_info']['type']==1 && $data['format_info']['type2']==4)
                                block
                            @else
                                none
                            @endif;">
                            <div class="layui-form-label">爬取时间</div>
                            <div class="layui-input-block disf">
                                <input type="text" class="layui-input" id="starttime" name="starttime" value="{{$data['starttime']}}">
                                <input type="text" class="layui-input" id="endtime" name="endtime" value="{{$data['endtime']}}">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-form-label">更多配置</div>
                            <div class="layui-input-block">
                                <select name="more_id" id="more_id" lay-verify="">
                                    <option value="">请选择</option>
                                    @foreach($content as $vo)
                                    <option value="{{$vo['id']}}" @if($vo['id']==$data['more_id'])
                                        selected
                                    @endif>{{$vo['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <div class="layui-form-label">导页背景</div>
                            <div class="layui-input-block">
                                <select name="back_type" id="back_type" lay-search lay-filter="back_type">
                                    <option value="1" @if($data['back_type']==1)
                                        selected
                                    @endif>调色版</option>
                                    <option value="2" @if($data['back_type']==2)
                                        selected
                                    @endif>背景图</option>
                                </select>
                            </div>
                        </div>

                        <div class="layui-form-item back_color" style="display:@if($data['back_type']==1)
                                block
                            @else
                                none
                            @endif;">
                            <div class="layui-form-label">调色版</div>
                            <div class="layui-input-block">
                                <div id="color"></div>
                                <input type="hidden" name="back_content" value="{{$data['back_content']}}">
                            </div>
                        </div>
                        <div class="layui-form-item back_img" style="display:@if($data['back_type']==2)
                                block
                            @else
                                none
                            @endif;">
                            <div class="layui-form-label">背景图(1920*800)</div>
                            <div class="layui-input-block">
                                <div class="layui-upload" style="margin-top: 10px;">
                                    <button type="button" class="layui-btn" id="img_file2-upload">上传图片(一张)</button>
                                    <blockquote class="layui-elem-quote layui-quote-nm yulan" style="margin-top: 10px;">
                                        预览图：
                                        <div class="layui-upload-list" id="img_file2-upload-list">
                                            @if(!empty($data['back_content']))
                                            <div style="display: inline-block;">
                                                <img onclick="seePic(this);" src="https://shop.gogo198.cn/{{$data['back_content']}}" class="layui-upload-img" style="width:80px;height:80px;">
                                                <button type="button" onclick="delPic(this);" class="layui-btn layui-btn-xs layui-btn-danger" style="position: relative;left: -45px;top: -39px;">删除</button>
                                                <input type="hidden" name="back_img[]" value="{{$data['back_content']}}">
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

        @if($data['back_type']==1)
            colorpicker.render({
                elem:'#color',
                alpha:true,
                size:'lg',
                predefine:true,
                color:'{{$data["back_content"]}}',
                done:function(color){
                    $('input[name="back_content"]').val(color);
                }
            });
        @else
            colorpicker.render({
                elem:'#color',
                alpha:true,
                size:'lg',
                done:function(color){
                    $('input[name="back_content"]').val(color);
                }
            });
        @endif

        setTimeout(function(){
            xmSelect.render({
                el: '#catediv',
                name: "gcateid",
                autoRow: true, //自动换行
                filterable: true, //可搜索
                searchTips: '请选择',
                radio:true,
                model: {
                    icon: 'hidden',//是否展示复选框或者单选框图标 show, hidden:变换背景色  ！！这句话是重点，不然会变成父节点也有单选框！！
                },
                tree: {
                    show: true, //用树显示
                    showFolderIcon: true, //是否显示节点前的三角图标
                    expandedKeys: true, //默认全部展开
                    showLine: true, //显示渐近线
                    indent: 20, //间距
                    strict: false, //重点！！设置成非严格父子模式，这样父节点被禁用，子节点依然可以点击
                    clickCheck:true,
                },
                toolbar: {
                    show: false, //显示工具条
                    list: ['ALL', 'REVERSE', 'CLEAR']
                },
                height: '300px', //最大下拉框高度
                data: {!! $catearr !!},
                initValue:[{{$data['gcateid']}}]
            });
        },2000);

        laydate.render({
            elem: '#starttime',
            type:'datetime'//指定元素
        });
        laydate.render({
            elem: '#endtime',
            type:'datetime'//指定元素
        });

        form.render(null,'component-form-element');

        //选择版式
        form.on('select(content_id)',function(data){
            let val = data.value;
            layer.load();
            //获取版式要求
            $.ajax({
                url:"/func/site/get_format_request",
                method:'post',
                data:{'format_id':val,'_token':"{{csrf_token()}}"},
                dataType:'JSON',
                success:function(res){
                    layer.closeAll('loading');
                    if(res.code == 0)
                    {
                        if(res.format['type2']==3 && res.format['type']==1){
                            //商品类别
                            $('.format_div').find('.gcate_div').show();
                            $('.format_div').find('.gkeywords_div').hide();
                            $('.format_div').find('.timesel').hide();
                            $('.introduce_div').hide();

                        }
                        else if(res.format['type2']==4 && res.format['type']==1){
                            //商品关键字
                            $('.format_div').find('.gcate_div').hide();
                            $('.format_div').find('.gkeywords_div').show();
                            $('.format_div').find('.timesel').show();
                            $('.introduce_div').hide();
                        }
                        else if(res.format['type']==4){
                            //卡片展示【大卡片+小卡片】
                            $('.introduce_div').show();
                            $('.format_div').find('.gcate_div').hide();
                            $('.format_div').find('.gkeywords_div').hide();
                            $('.format_div').find('.timesel').hide();
                        }
                        else{
                            $('.format_div').find('.gcate_div').hide();
                            $('.format_div').find('.gkeywords_div').hide();
                            $('.format_div').find('.timesel').hide();
                            $('.introduce_div').hide();
                        }
                    }
                },
                error:function (data) {
                    layer.msg('系统错误',{time:2000});
                }
            });
        });

        form.on('select(back_type)',function(data){
            let val = data.value;
            if(val==1){
                $('.back_color').show();
                $('.back_img').hide();
            }else if(val==2){
                $('.back_color').hide();
                $('.back_img').show();
            }
        });

        form.on('submit(component-form-element)', function(data){
            // JSON.stringify()
            // console.log(data.field);return false;
            // if( $('#img_file-upload-list').children().length == 0 )
            // {
            //     layer.msg('请上传轮播图！');
            //     return false;
            // }

            $.ajax({
                url:"/func/site/save_guide",
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
            elem: '#img_file2-upload'
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
