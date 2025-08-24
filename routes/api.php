<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'auth:api'], function () {


    Route::post('/editProfile', 'API\v1\UserController@editProfile');
    Route::post('/changePassword', 'API\v1\UserController@changePassword');
    Route::get('/MyProfile', 'API\v1\UserController@MyProfile');
    Route::post('/sendMessage', 'API\UserController@sendMessage');
    Route::get('/getMyMessages', 'API\UserController@getMyMessages');
    Route::get('/logout', 'API\v1\UserController@logout');
    Route::post('/receiveNotification', 'API\v1\UserController@receiveNotification');



    Route::get('myNotifications', 'API\v1\UserController@myNotifications');

    Route::get('getMyAddresses', 'API\v1\UserController@getMyAddresses');
    Route::post('addAddress', 'API\v1\UserController@addAddress');
    Route::get('deleteAddress/{id}', 'API\v1\UserController@deleteAddress');
    Route::post('/editAddress/{id}', 'API\v1\UserController@editAddress');


});



Route::get('getSetting', 'API\v1\AppController@getSetting');
Route::post('/admin/register', 'AdminAuth\RegisterController@create')->name('admin.auth.regisct');

Route::post('changeLanguge', 'API\v1\AppController@changeLanguge');
Route::get('getFaq', 'API\v1\AppController@getFaq');
Route::get('pages/{id}', 'API\v1\AppController@pages');
Route::post('contactUs', 'API\v1\AppController@contactUs');
Route::get('getAges', 'API\v1\AppController@getAges');
Route::get('filter', 'API\v1\AppController@filter');
Route::get('search', 'API\v1\AppController@search');
Route::get('testPay', 'API\AppController@testPay');
Route::post('/delete_account','API\v1\AppController@delete_account');

Route::post('/login', 'API\v1\UserController@login');
Route::post('/signUp', 'API\v1\UserController@signUp');

Route::post('/forgotPassword', 'API\v1\UserController@forgotPassword');

Route::get('getCategories', 'API\v1\AppController@getCategories');
Route::post('update-gift-packaging', 'API\v1\CartController@updateGiftPackaging');
Route::get('getProducts', 'API\v1\AppController@getProducts');
Route::get('getProductDetails/{id}', 'API\v1\AppController@getProductDetails');
Route::get('getAreas', 'API\v1\AppController@getAreas');
Route::post('addProductToCart', 'API\v1\CartController@addProductToCart');
Route::get('deleteProductCart/{id}', 'API\v1\CartController@deleteProductCart');
Route::post('getMyCart', 'API\v1\CartController@getMyCart');
Route::post('checkCode', 'API\v1\CartController@checkCode');
Route::get('addAndRemoveFromFavorite/{id}', 'API\v1\FavoriteController@addAndRemoveFromFavorite');
Route::get('getMyFavorite', 'API\v1\FavoriteController@getMyFavorite');

Route::get('getdeliverynoteList', 'API\v1\FavoriteController@getdeliverynoteList');


Route::post('changeQuantity/{id}', 'API\v1\CartController@changeQuantity');
Route::post('checkOut', 'API\v1\CartController@checkOut');
Route::get('tap/callback', 'API\v1\CartController@mobileTapCallback')->name('mobile.tap.callback');
Route::post('tap/webhook', 'API\v1\CartController@mobileTapWebhook')->name('mobile.tap.webhook');

// Payment status check
Route::post('payment/status','API\v1\CartController@getMobilePaymentStatus')->name('mobile.payment.status');

Route::get('getMyOrders', 'API\v1\UserController@getMyOrders');
Route::get('getOrderDetail/{id}', 'API\v1\UserController@getOrderDetail');

Route::get('/merchant_auth', 'API\v1\PaymentController@merchant_auth');
Route::post('/cardToken', 'API\v1\PaymentController@card_token');
Route::post('/payment_user', 'API\v1\PaymentController@payment_user');
Route::post('/refund', 'API\v1\PaymentController@refund');


// vendor API change's

Route::post('/login_vendor', 'API\v1\VenderController@login');
Route::post('/request_vendor', 'API\v1\VenderController@request_register');
Route::post('/vender_editProfile', 'API\v1\VenderController@vender_editProfile');
Route::get('/venderProfile', 'API\v1\VenderController@MyProfile');
Route::post('/VenderAddress','API\v1\VenderController@Vender_address');
Route::post('/password_update', 'API\v1\VenderController@password_update');
Route::post('/Upload_profile','API\v1\VenderController@Change_profile');

//product ..
Route::get('product_list','API\v1\ProductController@product_list');
Route::post('create_product','API\v1\ProductController@create_product');
Route::post('edit_product/{id}','API\v1\ProductController@edit_product');
Route::post('delete_product','API\v1\ProductController@delete_product');
Route::get('vender_filter', 'API\v1\VenderController@vender_filter');


/**
 * Vender Particuler product
 */

//coupon
Route::get('coupon_list','API\v1\ProductController@coupon_list');
Route::post('create_coupon','API\v1\ProductController@create_coupon');
Route::post('delete_coupon','API\v1\ProductController@delete_coupon');
Route::get('coupon_search','API\v1\ProductController@coupon_search');
Route::post('edit_coupon','API\v1\ProductController@edit_coupon');

//home
Route::get('/home','API\v1\VenderController@Home');
Route::get('/getCategory','API\v1\VenderController@getCategory');
Route::post('/current_order','API\v1\OrderController@Order_list');
Route::post('/ClientDeatils','API\v1\OrderController@client_details');
Route::post('/Product_change','API\v1\OrderController@update_product_status');

/**
 * user Vendor list
 */
Route::get('getVendorList', 'API\v1\AppController@getVendor_list');
Route::get('VenderProducts', 'API\v1\AppController@getVenderProducts');

Route::get('listed_product','API\v1\ProductController@listed_product');



// home
Route::get('userHome', 'API\v1\CartController@userHome');
Route::get('Product_vender', 'API\v1\AppController@list_vender_category');
Route::get('vender_information', 'API\v1\AppController@vender_information');

Route::get('/successPayment','API\v1\PaymentController@success')->name('successPayment');
Route::get('/failPayment','API\v1\PaymentController@fail')->name('failPayment');

Route::post('/update_token','API\v1\VenderController@update_token');


//
Route::post('/payment_status','API\v1\PaymentController@payment_status')->name('payment_status');
Route::post('/clear_cart','API\v1\PaymentController@clear_cart')->name('clear_cart');
