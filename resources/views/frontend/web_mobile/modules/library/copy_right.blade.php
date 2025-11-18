<div class="copyright hide">
    <div class="footer-copyright">
        <a class="copyright-img" href="javascript:go_laravelvip()">
            <img src="/images/support-logo.png">
            技术支持：乐融沃
        </a>
    </div>
</div>

<script type="text/javascript">
    function go_laravelvip() {
        if (window.__wxjs_environment !== 'miniprogram') {
            window.location.href = 'http://m.laravelvip.com/statistics.html?product_type=shop&domain=http://{{ env('MOBILE_DOMAIN') }}';
        } else {
            {{--window.location.href = 'http://{{ env('MOBILE_DOMAIN') }}';--}}
        }
    }

    function GetUrlRelativePath(){
        var url = document.location.toString();
        var arrUrl = url.split("//");

        var start = arrUrl[1].indexOf("/");
        var relUrl = arrUrl[1].substring(start);

        if(relUrl.indexOf("?") != -1){
            relUrl = relUrl.split("?")[0];
        }
        return relUrl;
    }
    var hide_list = ['/bill','/bill.html','/user/order/bill-list.html'];

    if($.inArray(GetUrlRelativePath(window.location.href), hide_list) == -1){
        $('.copyright').removeClass('hide');
    }

</script>