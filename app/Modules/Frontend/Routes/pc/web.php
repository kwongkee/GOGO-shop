<?php

use App\Modules\Frontend\Http\Controllers;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// 判断请求来源客户端
//dd(request()->getHost());
//if (is_mobile() && !is_app() && request()->getHost() == env('MOBILE_DOMAIN')) { // 微信端
//    $domain = env('MOBILE_DOMAIN');
//    $routePrefix = 'mobile_';
//} else { // pc端和app端
//    $domain = env('FRONTEND_DOMAIN');
//    $routePrefix = 'pc_';
//}


Route::group(['domain' => env('FRONTEND_DOMAIN')], function ($router) {

    // 首页
    Route::get('/index.html', 'HomeController@home')->name('pc_home'); // todo ok
//    Route::get('/', 'HomeController@home')->name('pc_home'); // 旧的首页

    // 新的页面（开发） start
    Route::get('/', 'HomeController@home')->name('pc_home'); //首页
    Route::post('/getFrame', 'HomeController@getFrame'); // 获取各弹框内容
    Route::any('/news_detail', 'HomeController@news_detail'); // 新闻详情
    Route::any('/msg_list', 'HomeController@msg_list'); // 消息列表
    Route::any('/msg_detail', 'HomeController@msg_detail'); // 消息详情
    Route::any('/customer_online', 'HomeController@customer_online'); // 客服中心
    Route::any('/rate_detail', 'HomeController@rate_detail'); // 汇率详情
    Route::any('/txt_detail', 'HomeController@txt_detail'); // 图文详情
    Route::any('/policy_detail', 'HomeController@policy_detail'); // 政策详情
    Route::any('/social_detail', 'HomeController@social_detail'); // 社交详情
    Route::any('/friendly_link', 'HomeController@friendly_link'); // 友情链接
    Route::any('/help_us', 'HomeController@help_us'); // 帮助中心
    Route::any('/rule_list', 'HomeController@rule_list'); // 平台规则
    Route::any('/version_list', 'HomeController@version_list'); // 规则版本
    Route::any('/rule_detail', 'HomeController@rule_detail'); // 规则详情
    Route::any('/platfrom_email', 'HomeController@platfrom_email'); // 平台电邮
    Route::any('/basic_info', 'HomeController@basic_info'); // 个人资料
    Route::any('/search_list', 'HomeController@search_list'); // 高级搜索页
    Route::any('/menu_detail', 'HomeController@menu_detail'); // 网站菜单页
    Route::any('/advice', 'HomeController@advice'); // 我要咨询
    Route::any('/member_login', 'HomeController@member_login'); // 我要咨询
    Route::any('/guide_page', 'HomeController@guide_page'); // 导页
    Route::any('/search_info', 'HomeController@search_info'); // 搜索
    Route::any('/user_record', 'HomeController@user_record'); // 记录用户行为

    #会员中心
    Route::any('/members/member_center', 'MembersController@member_center'); //会员中心页面
    Route::any('/members/system_manage', 'MembersController@system_manage');
    Route::any('/members/system_manage2', 'MembersController@system_manage2');
    Route::any('/members/person_basic', 'MembersController@person_basic');
    Route::any('/members/connect_account_list', 'MembersController@connect_account_list');
    Route::any('/members/connect_enterprise_list', 'MembersController@connect_enterprise_list');
    Route::any('/members/auth_info', 'MembersController@auth_info');
    Route::any('/members/connect_enterprise', 'MembersController@connect_enterprise');
    Route::any('/members/contact_info', 'MembersController@contact_info');
    Route::any('/members/receive_list', 'MembersController@receive_list');
    Route::any('/members/save_receive', 'MembersController@save_receive');
    Route::any('/members/del_receive', 'MembersController@del_receive');
    Route::any('/members/getphonenum', 'MembersController@getphonenum');
    Route::any('/members/send_list', 'MembersController@send_list');
    Route::any('/members/save_send', 'MembersController@save_send');
    Route::any('/members/get_website_qrcode', 'MembersController@get_website_qrcode');
    Route::any('/members/transfer_website', 'MembersController@transfer_website');
    Route::any('/members/coupon_list', 'MembersController@coupon_list');
    Route::any('/members/prepaid_list', 'MembersController@prepaid_list');
    Route::any('/members/sure_list', 'MembersController@sure_list');
    Route::any('/members/processing', 'MembersController@processing');

    #决策应用
    Route::any('/member/business_list', 'MemberController@business_list');
    Route::any('/member/group_list', 'MemberController@group_list');
    Route::any('/member/save_group', 'MemberController@save_group');
    Route::any('/member/save_topics', 'MemberController@save_topics');
    Route::any('/member/del_options', 'MemberController@del_options');
    Route::any('/member/topics_manage', 'MemberController@topics_manage');
    Route::any('/member/topics_manage2', 'MemberController@topics_manage2');
    Route::any('/member/topics_detail', 'MemberController@topics_detail');
    Route::any('/member/topics_list', 'MemberController@topics_list');
    Route::any('/member/send_topics_list', 'MemberController@send_topics_list');
    Route::any('/member/join_group', 'MemberController@join_group');
    Route::any('/member/get_name', 'MemberController@get_name');
    Route::any('/member/save_basic', 'MemberController@save_basic');
    Route::any('/member/check_follow', 'MemberController@check_follow');
    Route::any('/member/chat_list', 'MemberController@chat_list');
    Route::any('/member/share_topics', 'MemberController@share_topics');
    Route::any('/member/advice_list', 'MemberController@advice_list');
    Route::any('/member/save_advice', 'MemberController@save_advice');
    Route::any('/member/social_list', 'MemberController@social_list');

    #上传组件
    Route::any('/upload/upload_file', 'UploadController@upload_file');
    Route::any('/upload/upload_diy_file', 'MemberController@upload_diy_file');
    // 新的页面 end

    // 商品全部分类
    Route::get('/category.html', 'CategoryController@index')->name('pc_category'); // todo ok

    // Search Route
    Route::get('/search.html', 'SearchController@index')->name('pc_global_search'); // 全站搜索（商品/店铺）
//    Route::get('/search.html', 'GoodsController@lists')->name('pc_global_search'); // 全站搜索（商品/店铺）

    Route::post('/search/delete-record.html', 'SearchController@deleteRecord'); // 删除关键词搜索记录

    Route::get('/brand.html', 'BrandController@index'); // 品牌库 // todo ok

    // Site Route
    Route::group(['prefix' => 'site'], function () {
        Route::get('user', 'SiteController@user');
        Route::get('user.html', 'SiteController@user');
        Route::get('captcha.html', 'SiteController@captcha'); // 图片验证码
        Route::get('region-list', 'SiteController@regionList'); // 异步加载地区
        Route::get('region-list.html', 'SiteController@regionList'); // 异步加载地区
        Route::post('upload-image', 'SiteController@uploadImage'); // 用户上传图片

        Route::get('ajax-render.html', 'SiteController@ajaxRender'); // 异步加载模板内容
        Route::get('get-qrcode-login-key', 'SiteController@getQrcodeLoginKey'); // 获取二维码登录key信息

        Route::get('alioss.html', 'SiteController@alioss'); // 阿里云oss 文件上传
    });


    // 购物车 Route
    Route::get('/cart.html', 'CartController@cartList')->name('pc_cart_list'); // 购物车结算列表
    Route::group(['prefix' => 'cart'], function () {
        Route::post('calc_fee', 'CartController@calc_fee');//选购清单-计算选中商品的价格
        Route::post('buy_goods', 'CartController@buy_goods');//选购清单-购买选中的商品
        Route::post('calc_fee2', 'CartController@calc_fee2');//订购清单-计算选中商品的价格
        Route::post('sure_order_info', 'CartController@sure_order_info');//订购清单-确认清单修改数据和查看当前规格下的数据
        Route::post('close_order', 'CartController@close_order');//订购清单-关闭清单
        Route::post('create_order', 'CartController@create_order');//订购清单-创建支付单
        Route::any('cart_detail', 'CartController@cart_detail');//订购清单-清单详情
        Route::any('pay_order', 'CartController@pay_order');//订购清单-支付订单详情

        Route::get('box-goods-list.html', 'CartController@boxGoodsList'); // 顶部和右边购物车盒子
        Route::post('add.html', 'CartController@add'); // 添加购物车
        Route::post('remove.html', 'CartController@remove'); // 移除购物车
        Route::post('delete.html', 'CartController@delete'); // 移除购物车
        Route::post('select.html', 'CartController@select'); // 选择购物车商品
        Route::post('change-number.html', 'CartController@changeNumber'); // 更改购物车商品数量
        Route::post('go-checkout', 'CartController@goCheckout'); // 购物车下单 跳转到提交订单页面

        Route::post('quick-buy.html', 'CartController@quickBuy'); // 直接购买 跳转到提交订单页面
    });

    // 文章 Route
    Route::group(['prefix' => 'help'], function () {
        Route::get('default/info', 'ArticleController@showHelp'); // defaultInfo 帮助中心 文章详情 // todo ok
        Route::get('{article_id}.html', 'ArticleController@showHelp')->name('pc_show_help'); // showHelp // todo ok

        Route::get('default/search', 'ArticleController@defaultSearch'); // defaultSearch 帮助中心 文章搜索 // todo ok
        Route::post('default/search', 'ArticleController@defaultSearch'); // defaultSearch 帮助中心 文章搜索 // todo ok

//        Route::get('shop/list/{cat_id}.html', 'ArticleController@showShopList')->name('show_shop_list'); // showShopList
//        Route::get('shop/{article_id}.html', 'ArticleController@showShop')->name('show_shop'); // showShop
        Route::get('article/{article_id}.html', 'ArticleController@showShop')->name('pc_show_shop'); // showShop // todo ok
    });
    Route::group(['prefix' => 'article'], function () {
        Route::get('{article_id}.html', 'ArticleController@showArticle')->name('pc_show_article'); // 所有文章分类中的文章详情 // todo ok
        Route::get('list/{cat_id}.html', 'ArticleController@showArticleList')->name('pc_show_article_list'); // showArticleList // todo ok
    });



    /*旧的路由写法 增加一个方法就需要写一条路由*/
    // /shop-list-1.html /shop-list-1-0.html /shop-list-1-549.html
    Route::get('shop-list-{filter_str}.html', 'ShopController@shopGoodsList')->name('pc_shop_goods_list'); // 店铺内商品列表 第一个参数是店铺id 第二个参数是店铺内分类id
    Route::group(['prefix'=>'shop'], function () {
        Route::get('qrcode.html', 'ShopController@qrCode'); // 店铺二维码

        // 店铺入驻路由
        Route::get('apply.html', 'ShopController@apply');
        Route::get('apply/index.html', 'ShopController@apply');
        Route::get('apply/progress.html', 'ShopController@apply'); // 店铺入驻进度
        Route::get('apply/result.html', 'ShopController@result'); // 店铺入驻结果
        Route::get('apply/agreement-type1.html', 'ShopController@agreementType1');
        Route::any('apply/auth-info.html', 'ShopController@authInfo');
        Route::any('apply/shop-info.html', 'ShopController@shopInfo');
        Route::get('apply/client-validate', 'ShopController@clientValidate'); // clientValidate



        // 店铺街/店铺首页/店铺商品信息路由
        Route::get('street/index.html', 'ShopController@street')->name('pc_shop_street'); // 店铺街
        Route::get('{shop_id}.html', 'ShopController@shopHome')->name('pc_shop_home'); // 店铺首页
        Route::get('{shop_id}/info.html', 'ShopController@shopDetail')->name('pc_shop_info'); // 店铺详情
        Route::get('{shop_id}/search.html', 'ShopController@shopSearch')->name('pc_shop_search'); // 店铺内搜索

        Route::get('index/license.html', 'ShopController@license')->name('pc_shop_license'); // 店铺营业执照查询
        Route::get('index/info.html', 'ShopController@shopDetail'); // 店铺信息 异步加载
    });

    /*新的路由写法 只需要对每个控制器写一条路径即可*/
    // 店铺
    Route::any('/shop/apply/{action}.html', function ($action, Request $request) {
        $class = App::make(Controllers\ShopController::class);
        return $class->$action($request);
    });



    // Passport Route
    $router->any('login.html', 'PassportController@showLoginForm')->name('user.login'); // 登录界面
    $router->any('getminiprogramcode', 'PassportController@getminiprogramcode'); // 小程序授权登录
    $router->post('register/verify_code', 'PassportController@verify_code'); // 发送短信/邮箱验证码
    $router->any('login', 'PassportController@login'); // login
    $router->any('login_log', 'PassportController@login_log'); // login_log
    $router->any('register.html', 'PassportController@showRegisterForm'); // showRegisterForm
    $router->any('register/mobile.html', 'PassportController@showRegisterForm'); // showRegisterForm

    $router->any('register/email.html', 'PassportController@showRegisterForm'); // showRegisterForm
    $router->get('register/client-validate', 'PassportController@clientValidate'); // clientValidate
    $router->post('register/sms-captcha', 'PassportController@smsCaptcha'); // 发送短信验证码
    $router->post('register/email-captcha', 'PassportController@emailCaptcha'); // 发送邮箱验证码
    $router->any('site/logout.html', 'PassportController@logout')->name('user.logout'); // logout


    // 专题活动 Route
    $router->get('/topic/{topic_id}.html', 'TopicController@show')->name('pc_show_topic');

    // 资讯 Route
    Route::get('/news.html', 'NewsController@home')->name('pc_news_home'); // index
    Route::group(['prefix' => 'news'], function () {
        Route::get('/', 'NewsController@home')->name('pc_news_home'); // index
        Route::get('list/{cat_id}.html', 'NewsController@lists')->name('pc_news_list'); // lists
        Route::get('{article_id}.html', 'NewsController@show')->name('pc_show_news'); // show
    });

    // 购买下单
    Route::get('/checkout.html', 'BuyController@checkout'); // 购物车/直接购买 确认交易
    Route::group(['prefix' => 'checkout'], function () {
        Route::get('user-address', 'BuyController@userAddress'); // 用户收货地址
        Route::post('change-address', 'BuyController@changeAddress'); // 修改收货地址
        Route::post('change-best-time', 'BuyController@changeBestTime'); // 修改送货时间
        Route::post('change-invoice', 'BuyController@changeInvoice'); // 修改发票信息
        Route::post('change-payment', 'BuyController@changePayment'); // 修改支付订单信息
        Route::post('search-pickup.html', 'BuyController@searchPickup'); // 搜索自提点
        Route::post('submit.html', 'BuyController@submit'); // 提交订单
        Route::post('resubmit.html', 'BuyController@resubmit'); // 重新提交订单
        Route::get('result.html', 'BuyController@result'); // 付款结果查询
        Route::get('pay.html', 'BuyController@pay'); // 付款页面
        Route::post('set-payment.html', 'BuyController@setPayment'); // 付款页面 设置支付方式
    });

    // 订单支付
    Route::get('/payment.html', 'PaymentController@payment')->name('pc_payment'); // 订单支付 支付宝/微信
    Route::group(['prefix' => 'payment'], function () {
        Route::get('check-is-pay', 'PaymentController@checkIsPay'); // ajax检查订单是否支付
        Route::get('qr-code', 'PaymentController@qrCode')->name('pc_qrcode'); // ajax检查订单是否支付
    });

//    dd($router->routePrefix);
    // 商品
    $goodsDetailDomainState = false; // 是否开启商品详情二级域名 todo 还有问题,在二级域名下,其他控制器的方法没法正常访问, 后期完善
    if ($goodsDetailDomainState) {
        // 商品详情二级域名解析 后期在平台后台做一个开关,是否开启商品详情二级域名解析
        Route::group(['domain' => env('GOODS_DETAIL_DOMAIN')], function ($router) {
            Route::get('/goods-{goods_id}.html', 'GoodsController@showGoods')->name('pc_show_goods'); // showGoods
            Route::get('/list-{filter_str?}.html', 'GoodsController@lists')->name('pc_goods_list'); // goodsList
            Route::get('/list.html', 'GoodsController@lists'); // goodsList

//    Route::get('/list-{cat_id}-{p1?}-{p2?}-{is_platform?}-{is_free_shipping?}-{is_offpay?}-{has_goods_number?}-{sort_type?}-{p9?}-{area_code?}-{p11?}-{brand_id?}-{min_price?}-{max_price?}.html', 'GoodsController@goodsList')->name('goods_list'); // 商品列表 筛选条件
            Route::get('/{sku_id}.html', 'GoodsController@showGoods')->name('pc_show_sku_goods'); // showSkuGoods

            Route::group(['prefix' => 'goods'], function () {
                Route::get('sku.html', 'GoodsController@sku'); // sku
                Route::get('sku', 'GoodsController@sku'); // sku

                Route::get('desc.html', 'GoodsController@desc'); // goods_desc
                Route::get('qrcode.html', 'GoodsController@qrcode'); // qrcode
                Route::get('comment.html', 'GoodsController@comment'); // comment
                Route::get('comment', 'GoodsController@comment'); // comment
                Route::get('change-location.html', 'GoodsController@changeLocation'); // changeLocation
                Route::get('pickup-info.html', 'GoodsController@pickupInfo'); // 自提点详情
                Route::post('search-pickup.html', 'GoodsController@searchPickup'); // 搜索自提点
            });
        });
    } else {
        Route::get('/goods-{goods_id}.html', 'GoodsController@showGoods')->name('pc_show_goods'); // showGoods
        Route::get('/list-{filter_str?}.html', 'GoodsController@lists')->name('pc_goods_list'); // goodsList
        Route::get('/list.html', 'GoodsController@lists'); // goodsList
//    Route::get('/list-{cat_id}-{p1?}-{p2?}-{is_platform?}-{is_free_shipping?}-{is_offpay?}-{has_goods_number?}-{sort_type?}-{p9?}-{area_code?}-{p11?}-{brand_id?}-{min_price?}-{max_price?}.html', 'GoodsController@goodsList')->name('goods_list'); // 商品列表 筛选条件
        Route::get('/{sku_id}.html', 'GoodsController@showGoods')->name('pc_show_sku_goods'); // showSkuGoods
        //== 自定义请求START ==
        Route::any('/calc', 'GoodsController@calc'); // goodsList
        Route::any('/calc_otherfee', 'GoodsController@calc_otherfee'); // goodsList
        Route::any('/calc_services', 'GoodsController@calc_services'); // goodsList
        Route::any('/upload_file', 'GoodsController@upload_file'); // goodsList
        Route::any('/get_reply', 'GoodsController@get_reply'); // goodsList
        Route::any('/buy_goods', 'GoodsController@buy_goods'); // goodsList
        Route::any('/pay_list', 'GoodsController@pay_list'); // 收银台列表
        Route::any('/bill_list', 'GoodsController@bill_list'); // 账单管理
        Route::any('/bill_detail', 'GoodsController@bill_detail'); // 账单详情
        Route::any('/join_cart', 'GoodsController@join_cart'); // 加入购物车
        Route::any('/cancel_order', 'FuncController@cancel_order'); // 申请取消订单
        Route::any('/get_domestic_route', 'FuncController@get_domestic_route'); // 获取国内物流轨迹
        Route::any('/return_goods', 'FuncController@return_goods'); // 申请退换货
        Route::any('/apply', 'GoodsController@apply'); // 在线申请-选择患者
        Route::any('/save_patient', 'GoodsController@save_patient'); // 在线申请-添加/编辑患者
        Route::any('/send_code', 'GoodsController@send_code'); // 发送手机验证码
        Route::any('/get_patient_info', 'GoodsController@get_patient_info'); // 获取患者信息
        Route::any('/check_prescription', 'GoodsController@check_prescription'); // 医师开具处方
        Route::any('/loglastbuy', 'GoodsController@loglastbuy'); // 立即购买时生成购物清单信息
        Route::any('/order_confirm', 'GoodsController@order_confirm'); // 确认订单页
        Route::any('/order_confirm_calc', 'GoodsController@order_confirm_calc'); // 确认订单页-监听当前商品的数量变化
        Route::any('/apply_order', 'GoodsController@apply_order'); // 确认订单页-申请订购
        Route::any('/cashier', 'GoodsController@cashier'); // 收银台
        Route::any('/get_cashier_country', 'GoodsController@get_cashier_country'); // 收银台-获取国家收银配置

        Route::any('/taozg', 'FuncController@tao_zhongguo'); // 淘中国
        Route::any('/goods_list', 'FuncController@goods_list'); // 淘中国商品列表
        Route::any('/taozg_detail', 'FuncController@taozg_detail'); // 淘中国商品详情
        Route::any('/taozg_getprice', 'FuncController@taozg_getprice'); // 淘中国根据规格查看价格
        Route::any('/taozg_createorder', 'FuncController@taozg_createorder'); // 淘中国创建订单
        Route::any('/check_goods', 'FuncController@check_goods'); // 首页分类栏目检测有无商品，无就跳去淘中国
        Route::any('/brandstree', 'FuncController@brand_stree'); // 品牌馆
        Route::any('/gettableinfo', 'FuncController@gettableinfo'); // 获取信息
        Route::any('/getphonenum', 'FuncController@getphonenum'); // 获取当前国地信息+邮政编码
        Route::any('/get_history_price', 'FuncController@get_history_price'); // 获取当前商品历史价格
        Route::any('/getpostal', 'FuncController@getpostal'); // 获取模糊搜索的邮政编码
        Route::any('/address_list', 'FuncController@address_list'); // 地址列表
        Route::any('/save_address', 'FuncController@save_address'); // 保存地址
        Route::any('/del_address', 'FuncController@del_address'); // 保存地址
        Route::any('/getLanguage', 'FuncController@getLanguage'); // 获取语言
        Route::any('/sendcode', 'FuncController@sendcode'); // 发送“邮箱”或“手机”验证码
        Route::any('/check_verifyCode_for_rules', 'FuncController@check_verifyCode_for_rules'); // 提交验证-验证码
        //== 自定义请求END ==
        Route::group(['prefix' => 'goods'], function () {
            Route::get('sku.html', 'GoodsController@sku'); // sku
            Route::get('sku', 'GoodsController@sku'); // sku
            Route::any('calc_price_interval', 'GoodsController@calc_price_interval'); // 有商户id的计算价格区间

            Route::get('desc.html', 'GoodsController@desc'); // goods_desc
            Route::get('qrcode.html', 'GoodsController@qrcode'); // qrcode
            Route::get('comment.html', 'GoodsController@comment'); // comment
            Route::get('comment', 'GoodsController@comment'); // comment
            Route::get('change-location.html', 'GoodsController@changeLocation'); // changeLocation
            Route::get('pickup-info.html', 'GoodsController@pickupInfo'); // 自提点详情
            Route::post('search-pickup.html', 'GoodsController@searchPickup'); // 搜索自提点
        });
    }




    // 商品对比
    Route::get('/user/compare.html', 'CompareController@compare')->name('pc_compare'); // 对比商品页面
    Route::group(['prefix' => 'compare'], function () {
//        Route::post('add', 'CompareController@add'); // add
        Route::post('add', 'CompareController@toggle'); // 加入对比
        Route::post('toggle', 'CompareController@toggle'); // 加入对比
        Route::post('remove', 'CompareController@remove'); // 加入对比
        Route::get('box-goods-list', 'CompareController@boxGoodsList'); // 对比商品列表
        Route::get('freight', 'CompareController@freight'); //
        Route::get('goods-list.html', 'SiteController@goodsCompareList'); // PC端 异步加载对比商品列表
    });

    // 猜你喜欢
    Route::group(['prefix' => 'guess'], function () {
        Route::get('like', 'GuessController@like'); // like
    });

    // 站点
    Route::get('/subsite/index.html', 'SubSiteController@index'); // 跳转站点域名


    // 万能表单
    Route::get('/form/{form_id}.html', 'CustomFormController@show')->name('show_form'); // 万能表单
    Route::get('/customform/form/form-qrcode.html', 'CustomFormController@formQrcode'); // 生成表单二维码
    Route::post('/customform/form/add.html', 'CustomFormController@add'); // 提交表单




    // Auth
//    Route::post('auth/register', 'AuthController@register');
    Route::get('oauth/redirect-url/{platform}', 'OAuthController@getRedirectUrl');
    Route::get('oauth/callback/{platform}', 'OAuthController@handleCallback');


    // 支付同步回调地址
    Route::any('/respond/front-alipay', 'RespondController@frontAlipay'); // 支付宝同步通知

    // 支付异步回调地址
    Route::any('notify/front-alipay', 'NotifyController@front-alipay'); // 支付宝异步通知


    // 测试路由
    Route::get('send', 'HomeController@send');
    Route::get('collect-goods', 'HomeController@collectGoods'); // 测试 商品采集
});
