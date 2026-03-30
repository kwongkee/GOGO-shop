<style>
    /**弹窗样式**/
    .layer_frame .layui-layer-title{background:{{$website['color']}};color:{{$website['color_word']}};}
    .layer_frame .layui-layer-content{overflow:unset !important;}
    .layer_frame .layui-layer-setwin{top:12px;}
    .layer_frame .layui-layer-title .disf{height:100%;}
    .layer_frame .exclamation-circle {position: relative;margin-right:8px;}
    .layer_frame .exclamation-circle span{font-size: 14px;font-weight:900;color: {{$website['color_word']}};font-family: PingFang SC, Hiragino Sans GB, Heiti SC, Microsoft YaHei, Helvetica, Tahoma, Arial, SimHei, WenQuanYi Micro Hei !important;}
    .layer_frame .exclamation-circle::after {content: '';position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);width: 14px;height: 14px;background-color: {{$website['color_word']}};border-radius: 50%;opacity:0.3;}
    .layer_frame .layui-layer-content .rightBox .page_content{height:88%;overflow-y: auto;overflow-x:hidden;}
    .layer_frame .layui-layer-content .rightBox .page_content .rightContent{height:100%;display: none;}
</style>
<script>
    //搜索提交
    function search_info(t){
        // let method = $('#method').val();
        var title = '';
        if(IsPhone()){
            title = $('.mobile_search_title').val();
        }else{
            title = $('.pc_search_title').val();
        }
        var layer = layui.layer;

        layer.load();
        $.post('/search_info',{'title':title},function(res){
            if(res.code==-1){
                alert(res.msg);
            }
            else if(res.code==0){
                window.location.href=res.href;
            }
            layer.closeAll('loading');
        },'json');
    }

    //联系客服
    function connect_kefu(){
        var layer = layui.layer;
        var location = window.location.href;

        @if(!empty(session('user')))
            let area = ['900px','650px'];
            if(IsPhone()){
                area = ['100%','90%'];
            }

            {{--let html = '<div class="body" style="padding:10px;box-sizing: border-box;height:100%;"><iframe src="https://boss.gogo198.cn/?s=customer/customer_ai&pa=2&who_send=2&id=0&pid=0&isframe=1&company_id=0&uid=php echo session('user.gogo_id');" frameborder="0" style="width:100%;height:100%;"></iframe></div>';--}}
            //默认平台客服（购购网平台）
            let html = '<div class="body" style="padding:10px;box-sizing: border-box;height:100%;"><iframe src="https://boss.gogo198.cn/?s=memberc/member_center&identify=0&is_shopping=1&outsideUrl=\''+location+'\'&company_id=0&mid=<?php echo base64_encode(session('user.gogo_id'));?>" frameborder="0" style="width:100%;height:100%;"></iframe></div>';
            //商家id
            @if(isset($goods->shop_id))
                html = '<div class="body" style="padding:10px;box-sizing: border-box;height:100%;"><iframe src="https://boss.gogo198.cn/?s=memberc/member_center&identify=0&is_shopping=1&outsideUrl=\''+location+'\'&company_id={{$goods->shop_id}}&mid=<?php echo base64_encode(session('user.gogo_id'));?>" frameborder="0" style="width:100%;height:100%;"></iframe></div>';
            @elseif(isset($goods['shop_id']))
                html = '<div class="body" style="padding:10px;box-sizing: border-box;height:100%;"><iframe src="https://boss.gogo198.cn/?s=memberc/member_center&identify=0&is_shopping=1&outsideUrl=\''+location+'\'&company_id={{$goods['shop_id']}}&mid=<?php echo base64_encode(session('user.gogo_id'));?>" frameborder="0" style="width:100%;height:100%;"></iframe></div>';
            @endif
            
            var layer_frame_div = layer.open({
                skin:'layer_frame',
                type: 1,
                title: '<div class="disf"><div class="exclamation-circle"><span>!</span></div>在线客服</div>',
                area: area,
                content: html,
                end:function(res){
                    //关闭弹窗
                    layer.close(layer_frame_div);
                }
            });
        @else
            window.location.href="/login.html";
        @endif
    }

    //消息弹框（带按钮）
    function open_frame(title='信息',msg="",left_href="",left_txt='',right_href="",right_txt="",opera=1,area,show_btn=1){
        let html = '<div class="body" style="padding:10px;box-sizing: border-box;"><div class="msg" style="font-size: 15px;color: #000;width: 100%;overflow-y: auto;margin-bottom:20px;">'+msg+'</div>';
        if(show_btn==1){
            html += '<div class="btnGroup" style="display: flex;align-items: center;justify-content: center;"><a style="padding:5px 10px;background:{{$website['color']}};font-size:15px;font-weight:800;color:{{$website['color_word']}};margin-right:20px;border:1px solid {{$website['color_word']}};" href="'+left_href+'">'+left_txt+'</a><a href="'+right_href+'" style="padding:5px 10px;background:#db1d18;font-size:15px;font-weight:800;color:#fff;">'+right_txt+'</a></div></div>';
        }
        else{
            html += '</div>';
        }
        var layer_frame_div = layer.open({
            skin:'layer_frame',
            type: 1,
            title: '<div class="disf"><div class="exclamation-circle"><span>!</span></div>'+title+'</div>',
            area: area,
            content: html,
            end:function(res){
                if(opera==1){
                    //刷新页面
                    window.location.reload();
                }
                else if(opera==2){
                    //关闭弹窗
                    layer.close(layer_frame_div);
                }
            }
        });
        return layer_frame_div;
    }
</script>