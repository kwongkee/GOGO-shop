<!--首页导流区-->
<style>
    .guide_content{width:1210px;margin:10px auto;}
    @media (max-width: 992px){
        .guide_content{width:100%;padding:0 10px;}
    }
</style>
<div class="guide_content">
    @foreach($data['websites']['guide'] as $k=>$v)
        @if($v['format_info']['id']==1)
            <!--店铺展示版式-->
            @if(!empty($v['children']))
                @include('home.guide_format1',['k'=>$k,'v'=>$v])
            @endif
        @elseif($v['format_info']['id']==2 || $v['format_info']['id']==5)
            <!--卡片导航展示版式/图文展示版式-->
            @if(!empty($v['children']))
                @include('home.guide_format2',['k'=>$k,'v'=>$v])
            @endif
        @elseif($v['format_info']['id']==3)
            <!--触发搜索版式-->
            @if(!empty($v['children']))
                @include('home.guide_format3',['k'=>$k,'v'=>$v])
            @endif
        @elseif($v['format_info']['id']==4)
            <!--杂志导航版式-->
            @if(!empty($v['big_children']))
                @include('home.guide_format4',['k'=>$k,'v'=>$v])
            @endif
        @endif
    @endforeach
</div>