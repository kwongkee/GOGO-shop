@extends('layouts.inner_header')

@section('content')
    <script src="/assets/d2eace91/js/jquery.js?v=1.1"></script>
    <link rel="stylesheet" href="/assets/d2eace91/layui/css/layui.css?v=23121"/>
    <script type="text/javascript" src="/assets/d2eace91/layui/layui.js"></script>

    <style>
        #content{padding:20px 0;background:{{$website['background']}};}
        #content .container .content{padding: 30px 20px 30px;box-sizing: border-box;position: relative;margin-top: 10px;height: 630px;}
        .layui-form-item .layui-form-label{color:{{$website['fontcolor']}};}
        @if($isframe==1)
            /*内置框打开*/
            .header,.footer{display: none;}
            .w1200{width: 100%;}
            #content .container .content{height:500px;}
            #content{padding:20px;}
        @endif
    </style>
    <section id="content">
        <div class="w1200">
            <div class="container">
                <div class="content">
                    <form class="layui-form" action="" lay-filter="component-form-group">
                        @csrf
                        <div class="layui-form-item">
                            <label class="layui-form-label">账户昵称</label>
                            <div class="layui-input-block">
                                <input type="text" class="layui-input" name="nickname" id="nickname" value="{{ $user['nickname'] }}">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">真实名称</label>
                            <div class="layui-input-block">
                                <input type="text" class="layui-input" name="realname" id="realname" value="{{ $user['user_name'] }}">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">手机号码</label>
                            <div class="layui-input-block">
                                <input type="text" class="layui-input" name="mobile" id="mobile" value="{{ $user['mobile'] }}">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">邮箱地址</label>
                            <div class="layui-input-block">
                                <input type="text" class="layui-input" name="email" id="email" value="{{ $user['email'] }}">
                            </div>
                        </div>

                        <div class="layui-form-item layui-layout-admin">
                            <div class="layui-input-block">
                                <div class="layui-footer" style="position:relative;left: 0;background:{{$website['background']}};">
                                    <button class="layui-btn layui-sub" lay-submit="" lay-filter="component-form-group1">立即保存</button>
                                    {{--                            <button type="reset" class="layui-btn layui-btn-primary">重置</button>--}}
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
        layui.use(['layer','form',],function() {
            var $ = layui.$
                , layer = layui.layer
                , form = layui.form;

            form.render(null,'component-form-group');

            form.on('submit(component-form-group1)',function(data){
                $.ajax({
                    url: "/basic_info",
                    method: 'post',
                    data: data.field,
                    dataType: 'JSON',
                    success: function (res) {
                        layer.msg(res.msg, {time: 2000}, function () {
                            if (res.code == 0) {
                                window.location.reload();
                                // var index = parent.layer.getFrameIndex(window.name);
                                // parent.layer.close(index);
                                // parent.window.location.reload();
                            }
                        });
                    },
                    error: function (data) {
                        layer.msg('系统错误', {time: 2000});
                    }
                });
                return false;
            });
        });
    </script>
@stop