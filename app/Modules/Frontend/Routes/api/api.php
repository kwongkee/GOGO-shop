<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your module. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::group(['namespace'=>'Api'],function() {
//    //Auth0接口===========================================================================start
//    //授权回调
//    Route::any('auth/authorization_callback', 'AuthController@authorization_callback');
//    //token凭证回调
//    Route::any('auth/token_callback', 'AuthController@token_callback');
//    //Auth0接口===========================================================================end
//});

//Route::get('/frontend', function (Request $request) {
Route::group(['namespace'=>'Api'], function () {
    // return $request->frontend();
    //Auth0接口===========================================================================start
    //授权回调
    Route::any('auth/authorization_callback', 'AuthController@authorization_callback');
    //token凭证回调
    Route::any('auth/token_callback', 'AuthController@token_callback');
    //auth0注销回调
    Route::any('auth/protected_resource', 'AuthController@protected_resource');
    //auth0登录成功后，用户信息回调
    Route::any('auth/userinfo_callback', 'AuthController@userinfo_callback');
    //Auth0接口===========================================================================end
});
//->middleware('auth:api')
