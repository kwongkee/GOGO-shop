<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>独立站平台 - website.gogo198.net</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!--<link rel="stylesheet" href="css/all.min.css">-->
    <!--<link rel="stylesheet" href="layui/css/layui.css">-->
    <link rel="stylesheet" href="/assets/d2eace91/layui/css/layui.css?v=23121"/>
    <style>
        :root {--primary: #8B5FBF;--primary-light: #9b4de3;--primary-dark: #6A4A9C;--accent: #F0E6FF;--background: #f8f9fa;--card-bg: #ffffff;--text: #333333;--text-light: #666666;--shadow: 0 5px 15px rgba(0, 0, 0, 0.08);--shadow-hover: 0 8px 25px rgba(0, 0, 0, 0.12);--gradient: linear-gradient(135deg, #8B5FBF 0%, #6A4A9C 100%);--border-radius: 12px;}

        * {margin: 0;padding: 0;box-sizing: border-box;font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;}
        .action-buttons {display: flex;justify-content:end;gap: 15px;}
        .btn {padding: 10px 20px;border-radius: 50px;font-weight: 600;cursor: pointer;transition: all 0.3s ease;display: flex;align-items: center;gap: 8px;border: none;}
        .btn-primary {background: var(--gradient);color: white;}
        .btn-primary:hover {transform: translateY(-3px);box-shadow: var(--shadow-hover);}
        .btn-outline {background: transparent;color: var(--primary);border: 2px solid var(--primary-light);}
        .btn-outline:hover {background: var(--primary-light);color: white;}
        /* 表单样式 */
        .form-container {max-width: 800px;}
        .form-group {margin-bottom: 20px;}
        .form-label {display: block;margin-bottom: 8px;font-weight: 600;color: var(--primary-dark);}
        .form-control {width: 100%;padding: 15px;border: 2px solid #e0e0e0;border-radius: 10px;font-size: 1rem;transition: border-color 0.3s ease;}
        .form-control:focus {border-color: var(--primary);outline: none;}
        .form-row {display: grid;grid-template-columns: repeat(2, 1fr);gap: 20px;}

        .content-header {display: flex;justify-content: space-between;align-items: center;margin-bottom: 25px;padding-bottom: 15px;border-bottom: 1px solid #eee;}
        .content-title {font-size: 1.5rem;color: var(--primary-dark);}
        .btn{background:var(--primary-light);color: white;border: none;white-space:nowrap;}
        .btn-warning {background: #f8ac59;color: white;border: none;}
        .btn-print {background: #009688;color: white;border: none;}
        .btn-print:hover {background: #009688;}
        .btn-edit {background: var(--primary-light);color: white;border: none;}
        .btn-edit:hover {background: var(--primary);}
        .btn-delete {background: transparent;color: #ff4757;border: 2px solid #ff4757;}
        .btn-delete:hover {background: #ff4757;color: white;}
        .layui-btn-xs{line-height:21px;}
        .layui-table th{background: var(--accent);color: var(--primary-dark);font-weight: 600;}

        /* 模态框样式 */
        .modal {display: none;position: fixed;top: 0;left: 0;width: 100%;height: 100%;background: rgba(0, 0, 0, 0.5);backdrop-filter: blur(5px);z-index: 2000;align-items: center;justify-content: center;}
        .modal-content {background: white;border-radius: 20px;padding: 30px;width: 90%;max-width: 90%;box-shadow: var(--shadow-hover);position: relative;}
        .close-modal {position: absolute;top: 20px;right: 20px;font-size: 1.5rem;color: #999;cursor: pointer;transition: color 0.3s ease;}
        .close-modal:hover {color: var(--primary);}
        .modal-title {font-size: 1.5rem;margin-bottom: 20px;color: var(--primary);}
        .form-group {margin-bottom: 20px;}
        .form-group label {display: block;margin-bottom: 8px;font-weight: 600;color: var(--primary-dark);}
        .form-group input,
        .form-group select {width: 100%;padding: 15px;border: 2px solid #e0e0e0;border-radius: 10px;font-size: 1rem;transition: border-color 0.3s ease;border-top-left-radius: 0;border-bottom-left-radius: 0;}
        .form-group input:focus,
        .form-group select:focus {border-color: var(--primary);outline: none;}
        .form-actions {display: flex;justify-content: flex-end;gap: 15px;margin-top: 25px;}

        .layui-form-label{width:100px;}
        .layui-colorpicker-trigger-span{line-height: 24px;}
        .layui-btn-container{display: flex;}
        .btnHide-1{display:none;}
        .channel-actions {display: flex;gap: 10px;}
        
        .col-sm-12{padding:10px;box-sizing:border-box;}
        .layui-colla-title{background:#000;color:#fff;}
        .layui-form-item{margin-bottom:0;}
        .layui-input-block{line-height: 36px;}
    </style>
</head>
<body>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="layui-collapse" lay-accordion="now" style="margin:10px 0;">
                    @foreach($freight_detail['mini_cost'] as $key5 => $vo)
                        <div class="layui-colla-item">
                            <h2 class="layui-colla-title">运费说明</h2>
                            <div class="layui-colla-content">
                                <div class="layui-collapse" lay-accordion="now" style="margin:10px 0;">
                                    <div class="layui-colla-item">
                                        <h2 class="layui-colla-title">计费标准</h2>
                                        <div class="layui-colla-content">
                                            @if($freight_detail['mini_cost'][$key5]==1)
                                                <div class="white_color">最低消费：{{$freight_detail['mini_num'][$key5]}} {{$freight_detail['unit'][$key5]}}</div>
                                            @endif
                                            <div class="layui-collapse" lay-accordion="now" style="margin:10px 0;">
                                                @foreach($freight_detail['qj1'][$key5] as $key4 => $vo4)
                                                    <div class="layui-colla-item">
                                                        <h2 class="layui-colla-title">（自 {{$vo4}} {{$freight_detail['unit'][$key5]}} 至
                                                        @if($freight_detail['qj2_method'][$key5][$key4]==1) {{$freight_detail['qj2'][$key5][$key4]}} {{$freight_detail['unit'][$key5]}} 
                                                        @else
                                                            以上
                                                        @endif
                                                        ）</h2>
                                                        <div class="layui-colla-content">
                                                            <div class="layui-form-item">
                                                                <label class="layui-form-label">计费区间</label>
                                                                <div class="layui-input-block">
                                                                    <div class="white_color">自 {{$vo4}} {{$freight_detail['unit'][$key5]}} 至
                                                                    @if($freight_detail['qj2_method'][$key5][$key4]==1)          {{$freight_detail['qj2'][$key5][$key4]}}    {{$freight_detail['unit'][$key5]}} 
                                                                    @else
                                                                        以上
                                                                    @endif</div>
                                                                </div>
                                                            </div>
                                                            <div class="layui-form-item">
                                                                <label class="layui-form-label">计费进阶</label>
                                                                <div class="layui-input-block">
                                                                    <div class="white_color">{{$freight_detail['jinjie'][$key5][$key4]}}&nbsp;{{$freight_detail['unit'][$key5]}}</div>
                                                                </div>
                                                            </div>
                                                            <!--计费方式-->
                                                            <div class="layui-collapse" lay-accordion="now" style="margin:10px 0;">
                                                                @foreach($freight_detail['jf_method'][$key5][$key4] as $key3 => $vo3)
                                                                    <div class="layui-colla-item">
                                                                        <h2 class="layui-colla-title">
                                                                        @if($vo3==1)
                                                                        首续计费
                                                                        @elseif($vo3==2)
                                                                        按量计费
                                                                        @elseif($vo3==3)
                                                                        分段计费
                                                                        @endif</h2>
                                                                        <div class="layui-colla-content">
                                                                            @if($vo3!=3)
<!--                                                                                        <div class="layui-form-item">-->
<!--                                                                                            <label class="layui-form-label">计费方式</label>-->
<!--                                                                                            <div class="layui-input-block">-->
                                                                                    <div class="white_color">
                                                                                        @if($vo3==1)
                                                                                            <!--首续-->
                                                                                            <p class="white_color">首重：&nbsp;{{$freight_detail['shouzhong'][$key5][$key4][$key3]}} {{$freight_detail['unit'][$key5]}} / {{$freight_detail['currency_name'][$key5][$key4][0]}} {{$freight_detail['shouzhong_money'][$key5][$key4][$key3]}}</p>
                                                                                            <p class="white_color">续重：&nbsp;{{$freight_detail['xuzhong'][$key5][$key4][$key3]}} {{$freight_detail['unit'][$key5]}} / {{$freight_detail['currency_name'][$key5][$key4][0]}} {{$freight_detail['xuzhong_money'][$key5][$key4][$key3]}}</p>
                                                                                        @elseif($vo3==2)
                                                                                            <!--按量-->
                                                                                            {{$freight_detail['anliang'][$key5][$key4][$key3]}} {{$freight_detail['unit'][$key5]}} / {{$freight_detail['currency_name'][$key5][$key4][1]}} {{$freight_detail['anliang_money'][$key5][$key4][$key3]}}
                                                                                        @endif
                                                                                    </div>
<!--                                                                                            </div>-->
<!--                                                                                        </div>-->
                                                                            @else
                                                                            <!--分段-->
                                                                            <div class="layui-collapse" lay-accordion="now" style="margin:10px 0;">
                                                                                @foreach($freight_detail['fenduan_num1'][$key5][$key4][0] as $key2 => $vo2)
                                                                                <div class="layui-colla-item">
                                                                                    <h2 class="layui-colla-title">（{{$vo2}} {{$freight_detail['unit'][$key5]}} 至 @if($freight_detail['fenduan_method'][$key5][$key4][0][$key2]==1) {{$freight_detail['fenduan_num2'][$key5][$key4][0][$key2]}} {{$freight_detail['unit'][$key5]}}
                                                                                    @else
                                                                                    以上
                                                                                    @endif
                                                                                    ）</h2>
                                                                                    <div class="layui-colla-content">
                                                                                        <div class="white_color">
                                                                                            {{$vo2}} {{$freight_detail['unit'][$key5]}} 至 @if($freight_detail['fenduan_method'][$key5][$key4][0][$key2]==1) {{$freight_detail['fenduan_num2'][$key5][$key4][0][$key2]}} {{$freight_detail['unit'][$key5]}}
                                                                                            @else
                                                                                            以上
                                                                                            @endif / {{$freight_detail['currency_name'][$key5][$key4][2]}} {{$freight_detail['fenduan_money'][$key5][$key4][0][$key2]}}
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                @endforeach
                                                                            </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="layui-collapse" lay-accordion="now" style="margin:10px 0;">
                                    <div class="layui-colla-item">
                                        <h2 class="layui-colla-title">体积算法</h2>
                                        <div class="layui-colla-content">
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">计费比率</label>
                                                <div class="layui-input-block">
                                                    <div class="white_color">{{$freight_detail['rate'][$key5]}}</div>
                                                </div>
                                            </div>
                                            <div class="layui-form-item">
                                                <label class="layui-form-label">分泡方式</label>
                                                <div class="layui-input-block">
                                                    <div class="white_color">{{$freight_detail['fenpao'][$key5]}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<!--<script src="js/jquery-3.6.0.min.js"></script>-->
<!--<script src="layui/layui.js"></script>-->
<script src="/assets/d2eace91/js/jquery.js?v=1.1"></script>
<script type="text/javascript" src="/assets/d2eace91/layui/layui.js"></script>
<script>
    layui.use(['layer','form','laydate','upload','element'],function() {
        var laydate = layui.laydate
        ,layer = layui.layer
        ,form = layui.form
        ,$ = layui.jquery
        ,upload = layui.upload
        ,element = layui.element;
    });
    
    function get_warehouse_infos(id){
        var layer = layui.layer
            ,form = layui.form
            ,$ = layui.jquery;
            
        $.ajax({
            url: "https://shop.gogo198.cn/collect_website/public/?s=api/func/get_warehouse_info",
            method: 'post',
            data: {'id': id},
            dataType: 'JSON',
            timeout: 10000,
            success: function (res) {
                if(res.code==0){
                    let html = '<table class="layui-table">\n'+
                    '<tr>\n'+
                    '    <td>仓库名称：</td>\n'+
                    '    <td>'+res.data.warehouse_name+'</td>\n'+
                    '    <td>仓库简称：</td>\n'+
                    '    <td>'+res.data.warehouse_code+'</td>\n'+
                    '</tr>\n'+
                    '<tr>\n'+
                    '    <td>仓库描述：</td>\n'+
                    '    <td>'+res.data.desc+'</td>\n'+
                    '    <td>仓库图片：</td>\n'+
                    '    <td>\n';
                    for(let i=0;i<res.data.pic.length;i++){
                    html += '    <img src="'+res.data.pic[i]+'" onclick="javascript:window.open(\''+res.data.pic[i]+'\');" style="width:50px;height:50px;display:inline-block;margin-right:5px;margin-bottom:5px;cursor:pointer;"/>\n';
                    }
                    html+='    </td>\n'+
                    '</tr>\n'+
                    '<tr>\n'+
                    '    <td>仓储类别：</td>\n'+
                    '    <td>'+res.data.warehouse_type+'</td>\n'+
                    '    <td>仓储结构：</td>\n'+
                    '    <td>'+res.data.warehouse_structure+'</td>\n'+
                    '</tr>\n'+
                    '<tr>\n'+
                    '    <td>运营模式：</td>\n'+
                    '    <td>'+res.data.warehouse_mode+'</td>\n'+
                    '    <td>仓储温度：</td>\n'+
                    '    <td>'+res.data.warehouse_temperature+'</td>\n'+
                    '</tr>\n'+
                    '<tr>\n'+
                    '    <td>仓库设备：</td>\n'+
                    '    <td>'+res.data.warehouse_equipment+'</td>\n';
                    if(res.data.have_postal_code==1){
                        html+='<td>邮政编码：</td>\n'+
                        '    <td>'+res.data.postal_code+'</td>\n';
                    }
                    else if(res.data.have_postal_code==2){
                        html+='<td>行政区域：</td>\n'+
                        '    <td>'+res.data.country_name+res.data.province_name+res.data.city_name+res.data.district_name+res.data.town_name+res.data.village_name+'</td>\n';
                    }
                    html+='</tr>\n'+
                    '<tr>\n'+
                    '    <td>详细地址：</td>\n';
                    if(res.data.have_postal_code==1){
                        html+='    <td>'+res.data.country_name+res.data.pre_address+res.data.address1+'</td>\n';
                    }
                    else if(res.data.have_postal_code==2){
                        html+='    <td>'+res.data.address1+'</td>\n';
                    }
                    
                    html+='<td>收件人名称：</td>\n'+
                    '    <td>'+res.data.name+'</td>\n'+
                    '</tr>\n'+
                    '<tr>\n'+
                    '    <td>联系电话：</td>\n'+
                    '    <td>'+res.data.area_code+res.data.mobile+'</td>\n'+
                    '    <td></td>\n'+
                    '    <td></td>\n'+
                    '</tr>\n'+
                    '</table>';
                    
                    $('.warehouse_info').html(html);
                }
            }
        });
    }
</script>
</html>