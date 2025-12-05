@extends('layouts.goods_header')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/assets/d2eace91/layui/css/layui.css?v=23121"/>
    <link rel="stylesheet" href="/assets/d2eace91/js/layer/theme/default/layer.css?v=3.1.0" id="layuicss-layer">
    <script type="text/javascript" src="/assets/d2eace91/layui/layui.js"></script>
    <style>
        * {margin: 0;padding: 0;box-sizing: border-box;font-family: 'Segoe UI', 'Microsoft YaHei', sans-serif;}
        p {margin:0 !important;}
        
        body {
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        
        .news-card {
            background: rgb({{$color->param1}},{{$color->param2}},{{$color->param3}});
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            max-width: 500px;
            width: 100%;
            overflow: hidden;
            position: relative;
            margin-top:60px;
        }
        
        .news-header {
            padding: 30px 30px 20px;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .news-title {
            font-size: 26px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 15px;
            line-height: 1.3;
        }
        
        .goods_title{font-weight:800;color:#fff;font-size:24px;margin-top:24px !important;line-height:1.1;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 2; -webkit-box-orient: vertical;}
        .goods_desc{font-size:16px;color:#fff;margin-top:20px !important;line-height:28px;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 2; -webkit-box-orient: vertical;}
        .goods_price{font-size:24px;color:#fff;font-weight:800;position: absolute;right: 20px;top: 94px;border-left: 1px solid #fff;padding-left: 10px;background: rgb({{$color->param1}},{{$color->param2}},{{$color->param3}});}
        
        .news-meta {
            display: flex;
            align-items: center;
            color: #666;
            font-size: 14px;
        }
        
        .news-date {
            margin-right: 15px;
        }
        
        .news-content {
            padding: 25px 30px;
            font-size: 16px;
            color: #444;
        }
        
        .news-image {
            width: 100%;
            height: 440px;
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
            font-weight: 600;
            box-shadow: 0px 0px 10px 2px #fff;
            position:relative;
        }
        .news-image img{border-radius:10px;}
        
        .news-footer {box-sizing:border-box;margin-bottom:25px;margin-top:20px;display: flex;justify-content: center;align-items: center;}
        
        .news-source {font-size: 14px;color: #888;position: absolute;left: 10px;bottom: 10px;border-radius: 15px;padding:2px 10px;}
        .news-source .shop_logo{width:20px;height:20px;border-radius:50%;margin-right:10px;border:1px solid #fff;}
        .news-source .shop_name{font-size:16px;color:#000;}
        
        /* 右下角按钮区域 */
        .action-buttons {
            position: fixed;
            bottom: 30px;
            right: 30px;
            display: flex;
            flex-direction: column;
            gap: 15px;
            z-index: 100;
        }
        
        .action-btn {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #555;
            font-size: 15px;
            margin-right:10px;
        }
        .action-btn img{width:20px;height:20px;}
        .action-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }
        .action-btn.detail:hover {
            background: #FF5252;
            color: white;
        }
        
        .action-btn.cart:hover {
            background: #FF5252;
            color: white;
        }
        
        .action-btn.favorite:hover {
            background: #FF5252;
            color: white;
        }
        
        .action-btn.download:hover {
            background: #FF5252;
            color: white;
        }
        
        .action-btn.share:hover {
            background: #FF5252;
            color: white;
        }
        
        .mobile_show_word{display:none;}
        /* 响应式设计 */
        @media (max-width: 768px) {
            .pc_show_word{display: none;}
            .mobile_show_word{display:block;}
            .news-card {
                margin: 120px 10px 50px 10px;
            }
            
            .news-header {
                padding: 20px 20px 15px;
            }
            
            .news-title {
                font-size: 22px;
            }
            .goods_title{font-size:22px;}
            .goods_desc{font-size:16px;line-height:27px;}
            .goods_price{font-size:22px;position: absolute;right: 20px;top: 92px;border-left: 1px solid #fff;padding-left: 10px;}
            
            .news-content {
                padding: 20px;
            }
            
            .news-image {
                height: 350px;
            }
            
            .action-buttons {
                bottom: 20px;
                right: 20px;
            }
            
            .news-views .action-btn{width: 35px;height: 35px;margin-right:20px;font-size: 15px;}
            .news-views .action-btn.comment{margin-right:0;}
            .news-footer{padding:0 40px;box-sizing:border-box;margin-bottom:25px;}
            .news-source .shop_name{font-size:12px;white-space: nowrap;width: 200px;text-overflow: ellipsis;overflow: hidden;}
        }
    </style>
    <div id="cs" style="display:none;"></div>
    <div class="news-card">
        <div class="news-content">
            <div class="news-image">
                <img src="{{$goods->goods_image}}" style="width:100%;height:100%;"/>
                <div class="news-source disf">
                    <img src="{{$shop_logo}}" class="shop_logo">
                    <div class="shop_name">{{$shop_name}}</div>
                </div>
            </div>
            <div style="padding:0 20px;box-sizing:border-box;position:relative;">
                <p class="goods_title">{{$goods->goods_name}}</p>
                <p class="goods_desc">
                    {{$goods_share_words[0]}}
                    <span class="pc_show_word">
                        @if(isset($goods_share_words[1]))
                            {{$goods_share_words[1]}}
                        @endif
                    </span>
                    <span class="mobile_show_word">...</span>
                </p>
                <p class="goods_price">{{$true_low_price}}</p>
            </div>
        </div>
        
        <div class="news-footer">
            <div class="news-views disf">
                <a href="/goodsdetail-{{$goods->goods_id}}.html?share_uid={{$share_uid}}&campaign_id={{$campaign_id}}" target="_blank">
                    <div class="action-btn detail" title="详情">
                        <img src="/images/goods_miniprogram/detail.png">
                    </div>
                </a>
                <a href="/cart.html" target="_blank">
                    <div class="action-btn cart" title="购物车">
                        <img src="/images/goods_miniprogram/cart.png">
                    </div>
                </a>
                <div class="action-btn favorite" title="点赞" onclick="_collect()">
                    <img src="/images/goods_miniprogram/goods.png">
                </div>
                <div class="action-btn share" title="分享" onclick="_share2()">
                    <img src="/images/goods_miniprogram/share.png">
                </div>
                
                <div class="action-btn comment" title="评论" onclick="_comment()">
                    <img src="/images/goods_miniprogram/comment.png">
                </div>
            </div>
        </div>
    </div>
    
    <div id="select_share" style="display:none;padding:20px;box-sizing:border-box;text-align:center;">
        <div class="disf" style="justify-content:center;" onclick="_download()">
            <div class="action-btn download" title="下载">
                <img src="/images/goods_miniprogram/download.png">
            </div>
            <span style="font-size: 15px;font-weight: 800;">下载</span>
        </div>
        <div class="disf" style="justify-content:center;margin-top:20px;" onclick="_share()">
            <div class="action-btn share" title="分享">
                <img src="/images/goods_miniprogram/share.png">
            </div>
            <span style="font-size: 15px;font-weight: 800;">分享</span>
        </div>
    </div>
    
    <div id="comment_send" style="display:none;padding:20px;box-sizing:border-box;text-align:center;">
        <textarea class="layui-textarea" id="comment_area" placeholder="请留下你对此商品的评论..."></textarea>
        <div class="btn comment_submit" id="comment_submit" style="margin-top:10px;background: #ff2222;color: #fff;font-size: 15px;font-weight: 800;">立即提交</div>
    </div>
    
    @include('layouts.right_slide_show')
    @include('layouts.common_function')
    @include('layouts.footer')
    <script>
        // 为按钮添加交互效果
        document.querySelectorAll('.action-btn2').forEach(button => {
            button.addEventListener('click', function() {
                const action = this.classList[1]; // 获取按钮类型
                const titles = {
                    'cart': '购物车',
                    'favorite': '收藏',
                    'download': '下载',
                    'share': '分享'
                };
                
                // 创建提示元素
                const notification = document.createElement('div');
                notification.textContent = `${titles[action]}功能已触发`;
                notification.style.cssText = `
                    position: fixed;
                    bottom: 120px;
                    right: 30px;
                    background: rgba(0,0,0,0.7);
                    color: white;
                    padding: 10px 15px;
                    border-radius: 5px;
                    z-index: 1000;
                    font-size: 14px;
                    transition: opacity 0.3s;
                `;
                
                document.body.appendChild(notification);
                
                // 2秒后淡出并移除提示
                setTimeout(() => {
                    notification.style.opacity = '0';
                    setTimeout(() => {
                        document.body.removeChild(notification);
                    }, 300);
                }, 2000);
            });
        });
        
        layui.use(['layer','element','upload','form'],function() {
            var $ = layui.$
                , layer = layui.layer
                , element = layui.element
                , form = layui.form
                , upload = layui.upload;
                
            $('#comment_submit').click(function(){
                let comment_area = $('#comment_area').val();
                if(comment_area==''){
                    layer.msg('请输入评论内容');return false;
                }
                
                $.post('/goodscomment',{'goods_id':"{{$goods->goods_id}}",'_token':"{{csrf_token()}}",'share_uid':"{{$share_uid}}",'campaign_id':"{{$campaign_id}}",'comment':comment_area},function(res){
                    layer.closeAll('loading');
                    layer.msg(res.msg,{time:2000}, function () {
                        if (res.code == 0) {
                            window.location.reload();
                        }
                    });
                });
            });
        });
        
        function _collect(){
            var $ = layui.$
                , form = layui.form
                , layer = layui.layer;
                
            layer.load();
            
            $.post('/user/collect/toggle.html',{'goods_id':"{{$goods->goods_id}}",'sku_id':"{{$goods->sku_id}}",'show_count':1,'_token':"{{csrf_token()}}",'share_uid':"{{$share_uid}}",'campaign_id':"{{$campaign_id}}"},function(res){
                layer.closeAll('loading');
                res = JSON.parse(res);
                layer.msg(res.message,{time:2000}, function () {
                    if (res.code == 0) {
                        
                    }
                });
            });
        }
        
        //评论
        function _comment(){
            var $ = layui.$
                , form = layui.form
                , layer = layui.layer;
                
            layer.open({
               type:1,
               title:'立即评论',
               area:['300px','300px'],
               content:$('#comment_send')
            });
        }
        
        function _download(){
            var $ = layui.$
                , form = layui.form
                , layer = layui.layer;
            
            layer.load();
            
            $.getJSON('/get_miniprogram',{'goods_id':"{{$goods->goods_id}}",'_token':"{{csrf_token()}}",'share_uid':"{{$share_uid}}",'campaign_id':"{{$campaign_id}}"},function(res){
                layer.closeAll('loading');
                layer.msg(res.msg,{time:2000}, function () {
                    if (res.code == 0) {
                        layer.open({
                            type: 1,
                            title: '推广图片',
                            area: ['300px', '300px'],
                            content: '<div style="padding:20px;box-sizing: border-box;text-align:center;"><img src="'+res.img+'?v=<?php echo time();?>" style="width:150px;height:200px;"><p style="margin-top:5px;font-size:15px;font-weight:600;">长按保存推广图片</p></div>'
                        });
                    }
                });
            });
        }
        
        function _share(){
            var $ = layui.$
                , form = layui.form
                , layer = layui.layer;
            let src = window.location.href;
            
            layer.open({
                type: 1,
                title: '分享链接',
                area: ['300px', '300px'],
                content: '<div style="padding:20px;box-sizing: border-box;text-align:center;"><p style="margin-top:0px;font-size:15px;font-weight:600;">'+src+'</p><div class="btn" onclick="copy_btn(1)" style="margin-top:50px;font-size:20px;font-weight:600;background:#fff;border-radius:15px;border:1px solid #000;color:#000;">一键复制</div></div>'
            });
        }
        
        //分享新版
        function _share2(){
            var $ = layui.$
                , form = layui.form
                , layer = layui.layer;
                
            layer.open({
               type:1,
               title:'选择分享',
               area:['300px','300px'],
               content:$('#select_share')
            });
        }
        
        function copy_btn(typ){
            var $ = layui.$
                , form = layui.form
                , layer = layui.layer;
            let src = window.location.href;
            if(typ==1){
                $.getJSON('/get_miniprogram',{'goods_id':"{{$goods->goods_id}}",'_token':"{{csrf_token()}}",'share_uid':"{{$share_uid}}",'campaign_id':"{{$campaign_id}}",'method':2},function(res){
                });
                document.getElementById("cs").innerHTML=src;
            
                //開始複製
                var oInput = document.createElement('textarea');
                oInput.value = src;
                
                document.body.appendChild(oInput);
                oInput.select(); // 选择对象
                document.execCommand("Copy"); // 执行浏览器复制命令
                oInput.remove();
                layer.msg("复制成功");
            }
        }
    </script>
@stop