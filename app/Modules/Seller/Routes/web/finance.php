<?php

Route::group(['domain' => env('SELLER_DOMAIN')], function ($router) {

    // Finance Route
    Route::group(['prefix' => 'finance'], function () {
        // SellerAccount
        Route::group(['prefix' => 'seller-account'], function () {
            Route::get('list', 'Finance\SellerAccountController@lists'); // lists
            Route::get('list.html', 'Finance\SellerAccountController@lists'); // lists
        });

        // AccountDetail
        Route::group(['prefix' => 'account-detail'], function () {
            Route::get('list', 'Finance\AccountDetailController@lists'); // lists
            Route::get('list.html', 'Finance\AccountDetailController@lists'); // lists
        });
    });
});
