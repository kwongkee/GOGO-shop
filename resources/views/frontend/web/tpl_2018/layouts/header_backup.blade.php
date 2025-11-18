<style>
    /**头部**/
    .header *{box-sizing: border-box;}
    .header{background:#1f5188 !important;padding:10px 0 !important;height:fit-content !important;}
    .header .w1200{justify-content: space-between;}
    .header .logo img{width:250px;height:66px;cursor: pointer;}
    .header .menuList{}
    .header .menuList .menuItem{color:#fff;font-size: 20px;padding: 5px 30px;margin-right: 20px;}
    .header .menuList .menuItem:last-child{margin-right: 0;padding-right: 0;}
    .header .menuList .menuItems:hover{background:#fff;color:#e60000;border-radius:5px;font-weight: 600;transition: all 0.3s ease;}
    .header .menuList .menuLine{height: 20px;background: #fff;width: 2px;margin-right:20px;}
    .header #translate #translateSelectLanguage{width:95px;font-size:18px !important;background: none;border: 0;color: #fff;}
    .header #translate #translateSelectLanguage option{color: #000;}
</style>
<div class="header">
    <div class="w1200 disf">
        <div class="logo">
            <img src="//shop.gogo198.cn/{{$website['logo']}}" alt="" onclick="javascript:window.location.href='//www.gogo198.cn';">
        </div>
        <div class="menuList disf">
            <a href="javascript:void(0);" class="menuItem menuItems">代购</a>
            <div class="menuLine"></div>
            <a href="//gather.gogo198.cn" target="_blank" class="menuItem menuItems">集运</a>
            <div class="menuLine"></div>
            <a href="//www.gogo198.net/?s=index/account_manage" class="menuItem menuItems" target="_blank">@if(empty(session('user')))
                    我的
                @else
                    {{session('user.nickname')}}
                @endif</a>
            <div class="menuLine"></div>
            <div class="menuItem"><div id="translate" class="web_translate"></div></div>
        </div>
    </div>
</div>