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

//Route::group(['domain' => 'a.laravelmall.cc'], function () {
//   Route::get('/', function () {
//       return 123;
//   });
//});


Route::group(['domain' => env('SELLER_DOMAIN')], function ($router) {

    // Site Route
    Route::group(['prefix' => 'site'], function () {
        Route::any('image-gallery', 'SiteController@imageGallery'); // imageGallery
        Route::any('video-gallery', 'SiteController@videoGallery'); // videoGallery
        Route::post('upload-image', 'SiteController@uploadImage'); // uploadImage
        Route::any('upload-goods-desc-image', 'SiteController@uploadGoodsDescImage'); // uploadGoodsDescImage 上传PC端商品描述图片
        Route::post('upload-mobile-image', 'SiteController@uploadMobileImage'); // uploadMobileImage 上传Mobile端商品描述图片
        Route::post('upload-goods-image', 'SiteController@uploadGoodsImage'); // uploadGoodsImage 上传商品图片
        Route::get('region-list', 'SiteController@regionList'); // regionList
        Route::get('region-list.html', 'SiteController@regionList'); // regionList
        Route::get('cat-list', 'SiteController@catList'); // 异步加载商品分类
        Route::get('cat-list.html', 'SiteController@catList'); // 异步加载商品分类
        Route::get('shop-cat-list', 'SiteController@shopCatList'); // 异步加载店铺分类列表
        Route::any('video-selector', 'SiteController@videoSelector'); // videoSelector
        Route::post('video-selector.html', 'SiteController@videoSelector'); // videoSelector
        Route::any('image-selector', 'SiteController@imageSelector'); // imageSelector
        Route::any('image-selector.html', 'SiteController@imageSelector'); // imageSelector
        Route::any('tpl-backup', 'SiteController@tplBackup'); // tplBackup 模板备份
        Route::any('tpl-backup.html', 'SiteController@tplBackup'); // tplBackup 模板备份
        Route::get('update-message', 'SiteController@updateMessage'); // updateMessage
        Route::get('update-message.html', 'SiteController@updateMessage'); // updateMessage
        Route::post('message-update', 'SiteController@messageUpdate'); // messageUpdate
        Route::post('sms-captcha', 'SiteController@smsCaptcha'); // 发送验证码

        Route::get('sale-region-list.html', 'SiteController@regionList'); // regionList 售卖地区列表
    });

    //自定义方法2024-06-20=====start
    #站点管理
    Route::any('/func/site/basic_info', 'Func\SiteController@basic_info'); //基本配置
    Route::any('/func/site/rotate_manage', 'Func\SiteController@rotate_manage'); //轮播图管理
    Route::any('/func/site/save_rotate', 'Func\SiteController@save_rotate'); //轮播图管理
    Route::any('/func/site/del_rotate', 'Func\SiteController@del_rotate'); //轮播图管理
    Route::any('/func/site/search_manage', 'Func\SiteController@search_manage'); //搜索栏配置
    Route::any('/func/site/msg_manage', 'Func\SiteController@msg_manage'); //消息管理（引用我们）
    Route::any('/func/site/gather_process_manage', 'Func\SiteController@gather_process_manage'); //流程管理
    Route::any('/func/site/save_process', 'Func\SiteController@save_process'); //流程管理
    Route::any('/func/site/del_process', 'Func\SiteController@del_process'); //流程管理
    Route::any('/func/site/guide_manage', 'Func\SiteController@guide_manage'); //导页管理
    Route::any('/func/site/save_guide', 'Func\SiteController@save_guide'); //导页管理
    Route::any('/func/site/del_guide', 'Func\SiteController@del_guide'); //导页管理
    Route::any('/func/site/guide_content_manage', 'Func\SiteController@guide_content_manage'); //导页管理
    Route::any('/func/site/save_guide_content', 'Func\SiteController@save_guide_content'); //导页管理
    Route::any('/func/site/del_guide_content', 'Func\SiteController@del_guide_content'); //导页管理
    Route::any('/func/site/get_format_request', 'Func\SiteController@get_format_request'); //导页管理
    Route::any('/func/site/contact_manage', 'Func\SiteController@contact_manage'); //社交管理
    Route::any('/func/site/save_contact', 'Func\SiteController@save_contact'); //社交管理
    Route::any('/func/site/del_contact', 'Func\SiteController@del_contact'); //社交管理
    Route::any('/func/site/footer_manage', 'Func\SiteController@footer_manage'); //页脚管理
    Route::any('/func/site/save_footer', 'Func\SiteController@save_footer'); //页脚管理
    Route::any('/func/site/footer_child', 'Func\SiteController@footer_child'); //页脚管理
    Route::any('/func/site/del_footer', 'Func\SiteController@del_footer'); //页脚管理
    Route::any('/func/site/save_frame', 'Func\SiteController@save_frame'); //页脚管理
    Route::any('/func/site/del_frame', 'Func\SiteController@del_frame'); //页脚管理
    Route::any('/func/site/friendcate_manage', 'Func\SiteController@friendcate_manage'); //友情链接管理
    Route::any('/func/site/save_friendcate', 'Func\SiteController@save_friendcate'); //友情链接管理
    Route::any('/func/site/del_friendcate', 'Func\SiteController@del_friendcate'); //友情链接管理
    Route::any('/func/site/friend_manage', 'Func\SiteController@friend_manage'); //友情链接管理
    Route::any('/func/site/save_friend', 'Func\SiteController@save_friend'); //友情链接管理
    Route::any('/func/site/del_friend', 'Func\SiteController@del_friend'); //友情链接管理

    #产品管理
    Route::any('/func/goods/goods_manage', 'Func\GoodsController@goods_manage'); //产品管理
    Route::any('/func/goods/save_goods', 'Func\GoodsController@save_goods'); //产品管理
    Route::any('/func/goods/del_goods', 'Func\GoodsController@del_goods'); //产品管理
    Route::any('/func/goods/add-images', 'Func\GoodsController@add_images'); //产品管理
    Route::any('/func/goods/success', 'Func\GoodsController@success'); //产品管理
    Route::any('/func/goods/stock_manage', 'Func\GoodsController@stock_manage'); //库存管理
    Route::any('/func/goods/shelf_manage', 'Func\GoodsController@shelf_manage'); //上架管理

    #交易管理
    Route::any('/func/trade/book_manage', 'Func\TradeController@book_manage'); //订购管理
    Route::any('/func/trade/order_manage', 'Func\TradeController@order_manage'); //订单管理

    Route::any('/func/upload_file', 'Func\SiteController@upload_file');//上传文件接口
    //自定义方法2024-06-20=====end

    // Passport Route
    $router->get('login', 'PassportController@showLoginForm')->name('seller.login'); // showLoginForm
    $router->get('login.html', 'PassportController@showLoginForm')->name('seller.login'); // showLoginForm
    $router->post('login', 'PassportController@login'); // login
    $router->any('wuserlogin', 'PassportController@wuserlogin'); // 购购网login
    $router->post('site/logout', 'PassportController@logout')->name('seller.logout'); // logout

    // WorkerMan Route
    $router->get('workerman/test', 'WorkerManController@test');
    $router->get('workerman/test_view', 'WorkerManController@test_view');
});
