<link rel="stylesheet" href="/assets/d2eace91/layui/css/layui.css?v=23121">
<link rel="stylesheet" href="/assets/d2eace91/iconfont/iconfont.css?v=1.1"/>
<link rel="stylesheet" href="/css/common.css?v=1.1"/>
<style>
    /**喜欢和评论**/
    .like{position: absolute;right:15px;bottom:10px;}
    .like img{width:20px;height:20px;}
    .like .like_box{margin-left:15px;text-align: center;cursor:pointer;}
    .like .like_num{color:#fff;font-size:13px;}

    .comment_box{border:1px solid #fff;padding:15px;box-sizing:border-box;color:#fff;max-height:800px;overflow-y:scroll;}
    .comment_box .comment_div{margin-bottom:15px;}
    .comment_box .comment_content{border-bottom: 1px solid #fff;padding: 15px 0;box-sizing:border-box;}
</style>
<script src="/assets/d2eace91/layui/layui.js"></script>
<script>
    var win_index = '';
    layui.use(['layer', 'form', 'table', 'upload','element'], function () {
        var $ = layui.$
            , layer = layui.layer
            , form = layui.form
            , element = layui.element
            , upload = layui.upload
            , table = layui.table;

        form.render(null, 'component-form-element');

        $('.submit_comment').click(function(){
            let val = $('#comment_content').val();
            if(val==''){
                layer.alert('评论不能为空');
            }else{
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "/news_detail", //ajax请求地址
                    data: {'id': "{{$news['id']}}",'pa':2,'val':val,'type':"{{$type}}",'_token':"{{csrf_token()}}"},
                    success: function (data) {
                        if(data.code==0){
                            $('#comment_content').val("");
                            layer.close(win_index);
                            let html = '<div class="comment_div">\n' +
                                '                        <div class="disf" style="justify-content: space-between;">\n' +
                                '                            <div class="name f15">游客:'+data.ip+'</div>\n' +
                                '                            <div class="time f15">'+data.time+'</div>\n' +
                                '                        </div>\n' +
                                '                        <div class="comment_content f15">'+val+'</div>\n' +
                                '                    </div>';
                            if($('.comment_box').find('.no_comment').length){
                                $('.comment_box').find('.no_comment').remove();
                            }
                            $('.comment_box').append(html);
                        }
                    }
                });
            }
        });
    });
    var like = 0;
    function like_num(){
        if(like==0){
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "/news_detail", //ajax请求地址
                data: {'id': "{{$news['id']}}",'pa':1,'type':"{{$type}}",'_token':"{{csrf_token()}}"},
                success: function (data) {
                    like=1;
                    $('.upd_num').text("  <?php echo $news['like_num']+1;?>");
                }
            });
        }else{
            layer.alert('你已点赞！');
        }
    }

    function comment(){
        var $ = layui.$
            , layer = layui.layer;
        if("{{session('user.user_id')}}" != ''){
            if(IsPhone()){
                win_index = layer.open({
                    type: 1,
                    title: '评论',
                    shadeClose: true,
                    shade: 0.3,
                    area: ['80%', '28%'],
                    content: $('.comment'),
                });
            }else{
                win_index = layer.open({
                    type: 1,
                    title: '评论',
                    shadeClose: true,
                    shade: 0.3,
                    area: ['50%', '28%'],
                    content: $('.comment'),
                });
            }
        }else{
            show_login();
        }
    }

    function show_login(){
        var $ = layui.$
            , layer = layui.layer;
        layer.load();
        setTimeout(function(){
            $.login.show();
            layer.closeAll('loading');
        },1500);
    }
</script>