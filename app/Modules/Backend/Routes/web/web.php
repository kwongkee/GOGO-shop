<?php

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

use Illuminate\Support\Facades\Route;

Route::group(['domain' => env('BACKEND_DOMAIN')], function ($router) {
    Route::any('/', 'HomeController@home');//主界面
    Route::any('/rate_detail', 'HomeController@rate_detail'); // 汇率详情
    Route::any('/rule_list', 'HomeController@rule_list'); // 平台规则
    Route::any('/version_list', 'HomeController@version_list'); // 规则版本
    Route::any('/rule_detail', 'HomeController@rule_detail'); // 规则详情
    Route::any('/detail', 'HomeController@detail'); // 菜单详情
    Route::any('/advice', 'HomeController@advice'); // 我要咨询
    Route::post('/getFrame', 'HomeController@getFrame'); // 获取各弹框内容
    Route::any('/social_detail', 'HomeController@social_detail'); // 社交详情
    Route::any('/qualific', 'HomeController@qualific'); // 资质详情
    #待做
    Route::any('/search_info', 'HomeController@search_info'); // 搜索


    //登录============================================================================================================================start
    $router->any('login.html', 'PassportController@showLoginForm')->name('user.login'); // 登录界面
    $router->any('getminiprogramcode', 'PassportController@getminiprogramcode'); // 小程序授权登录
    $router->post('register/verify_code', 'PassportController@verify_code'); // 发送短信/邮箱验证码
    $router->any('login', 'PassportController@login'); // login
    $router->any('site/logout.html', 'PassportController@logout')->name('user.logout'); // logout
    $router->any('login_log', 'PassportController@login_log'); // login_log
    //登录============================================================================================================================end

    //上传方法============================================================================================================================start
    Route::any('/upload/upload_file', 'UploadController@upload_file');
    Route::any('/upload/upload_diy_file', 'MemberController@upload_diy_file');
    //上传方法============================================================================================================================end

    //商品详情============================================================================================================================start
    Route::get('/goods-{goods_id}.html', 'GoodsController@showGoods')->name('pc_show_goods'); // showGoods
    Route::get('/list-{filter_str?}.html', 'GoodsController@lists')->name('pc_goods_list'); // goodsList
    Route::get('/list.html', 'GoodsController@lists'); // goodsList
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
    //商品详情============================================================================================================================end



//    Route::get('/', 'MainController@index'); // main
//    Route::get('main', 'MainController@index'); // main
//
//    // Site Route
//    Route::group(['prefix' => 'site'], function () {
//        Route::any('image-gallery', 'SiteController@imageGallery'); // imageGallery
//        Route::any('video-gallery', 'SiteController@videoGallery'); // videoGallery
//        Route::post('upload-image', 'SiteController@uploadImage'); // uploadImage
//        Route::post('upload-goods-desc-image', 'SiteController@uploadGoodsDescImage'); // uploadGoodsDescImage 上传PC端商品描述图片
//        Route::post('upload-mobile-image', 'SiteController@uploadMobileImage'); // uploadMobileImage 上传Mobile端商品描述图片
//        Route::post('upload-goods-image', 'SiteController@uploadGoodsImage'); // uploadGoodsImage 上传商品图片
//        Route::get('region-list', 'SiteController@regionList'); // regionList
//        Route::get('region-list.html', 'SiteController@regionList'); // regionList
//        Route::get('cat-list', 'SiteController@catList'); // catList
//        Route::any('video-selector', 'SiteController@videoSelector'); // videoSelector
//        Route::any('video-selector.html', 'SiteController@videoSelector'); // videoSelector
//        Route::any('image-selector', 'SiteController@imageSelector'); // imageSelector
//        Route::any('image-selector.html', 'SiteController@imageSelector'); // imageSelector
//        Route::any('tpl-backup', 'SiteController@tplBackup'); // tplBackup 模板备份
//        Route::get('tpl-data', 'SiteController@tplData'); // tplData ajax 渲染模板数据
//
//        Route::get('update-message', 'SiteController@updateMessage'); // updateMessage
//        Route::post('message-update', 'SiteController@messageUpdate'); // messageUpdate
//        Route::post('send-test-mail', 'SiteController@sendTestMail'); // sendTestMail 邮件设置 发送测试邮件
//        Route::post('send-test-sms', 'SiteController@sendTestSms'); // sendTestSms 短信设置 发送测试短信
//
//        Route::get('progress.html', 'SiteController@progress'); // 导入数据执行进度
//
//
//    });
//
//    // Passport Route
//    $router->get('login', 'PassportController@showLoginForm')->name('admin.login'); // showLoginForm
//    $router->get('login.html', 'PassportController@showLoginForm'); // showLoginForm
//    $router->post('login', 'PassportController@login'); // login
//    $router->post('login.html', 'PassportController@login'); // login
//    $router->post('site/logout', 'PassportController@logout')->name('admin.logout'); // logout



    // Main Route
//    Route::get('main', 'MainController@index')->name('index'); // main

    /**** Index Module Route****/

    /**** Article Module Route****/

    /**** System Module Route****/

    /**** Design Module Route****/

    /**** Topic Module Route****/
});


Route::group(['domain' => env('PUSH_DOMAIN')], function ($router) {
    Route::get('/', 'PushController@index');
});
