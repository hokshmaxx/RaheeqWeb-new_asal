<?php



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use App\Http\Controllers\WEB\Site\HomeController;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [
        'localeSessionRedirect',
        'localizationRedirect',
        'localeViewPath'
    ]
], function () {
    // Route::get('/failPayment', function () { return view('website.fail');})->name('failPayment');
    // Route::get('/successPayment', function () { return view('website.success');})->name('successPayment');
    // Route::get('/payment', function () { return view('website.payment');})->name('payment');


        Route::group(['middleware' => ['auth']], function () {
        Route::get('myProfile', 'WEB\Site\UsersController@myProfile')->name('myProfile');
        Route::post('updateMyProfile', 'WEB\Site\UsersController@updateMyProfile')->name('updateMyProfile');
        Route::get('/changePassword', 'WEB\Site\UsersController@changePassword')->name('changePassword');
        Route::post('/updatePassword', 'WEB\Site\UsersController@updatePassword')->name('updatePassword');
        Route::get('myAddresses', 'WEB\Site\UsersController@myAddresses')->name('myAddresses');
        Route::get('createAddress', 'WEB\Site\UsersController@createAddress')->name('createAddress');
        Route::get('checkout/createAddress', 'WEB\Site\UsersController@createAddress')->name('checkoutCreateAddress');
        Route::post('createAddress', 'WEB\Site\UsersController@storeAddress')->name('storeAddress');
        Route::get('editAddress/{id}', 'WEB\Site\UsersController@editAddress')->name('editAddress');
        Route::get('checkout/editAddress/{id}', 'WEB\Site\UsersController@editAddress')->name('checkoutEditAddress');
        Route::post('updateAddress/{id}', 'WEB\Site\UsersController@updateAddress')->name('updateAddress');
        Route::get('deletAdress/{id}', 'WEB\Site\UsersController@deletAdress')->name('deletAdress');
        Route::get('myOrders', 'WEB\Site\UsersController@myOrders')->name('myOrders');
        Route::get('order/{id}', 'WEB\Site\UsersController@orderDetails')->name('orderDetails');

        Route::get('logout', 'WEB\Site\UsersController@logout')->name('logout');


        Route::get('/favorites', 'WEB\Site\HomeController@myFavorites')->name('myFavorites');
        Route::get('/addToFavorite/{id}', 'WEB\Site\HomeController@addFavorite')->name('addFavorite');
        Route::get('/removeFromFavorite/{id}', 'WEB\Site\HomeController@deleteFromFavorit')->name('deleteFromFavorit');


    });

    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
        Route::get('/', 'WEB\Site\HomeController@home')->name('home');
    // Route::get('/', function () {
    //     return redirect('/admin/home');
    // });
    Route::get('/category/{id}/{slug}', 'WEB\Site\HomeController@productByCategory')->name('category');

    Route::get('/vender_category_list/{V_id}/{id}/{slug}', 'WEB\Site\HomeController@productByvenderCategory')->name('vender_category_list');

    Route::get('/vender_category/{id}', 'WEB\Site\HomeController@productByVender')->name('vender_category');
    Route::get('/products/{id}/{slug}', 'WEB\Site\HomeController@prouctDetails')->name('prouctDetails');
    Route::post('/reviews/store', [HomeController::class, 'storeReview'])->name('reviews.store');

    Route::get('/offers', 'WEB\Site\HomeController@offers')->name('offers');
    Route::get('/products/NewArrival', 'WEB\Site\HomeController@newArrival')->name('NewArrival');
    Route::get('/products/search', 'WEB\Site\HomeController@searchProducts')->name('search');


    Route::get('/pages/{slug}', 'WEB\Site\HomeController@pages')->name('pages');



    /**
     * Cart Route
     */
    Route::get('/addProductTocart/{id}', 'WEB\Site\CartController@addProductTocart')->name('addProductTocart');
    Route::get('/removeProductFromCart/{id}', 'WEB\Site\CartController@removeProductFromCart')->name('removeProductFromCart');
    Route::get('/removeProductFromCartPage/{id}', 'WEB\Site\CartController@removeProductFromCartPage')->name('removeProductFromCartPage');
    Route::post('/updateGiftPackaging','WEB\Site\CartController@updateGiftPackaging')->name('updateGiftPackaging');;

    Route::get('/tap/callback', 'WEB\Site\CartController@tapCallback')->name('tap.callback');
    Route::post('/tap/webhook', 'WEB\Site\CartController@tapWebhook')->name('tap.webhook');

    // Optional: Route to check payment status
    Route::get('/payment/status/{order_id}','WEB\Site\CartController@checkPaymentStatus')->name('payment.status');

    Route::get('/checkPromo', 'WEB\Site\CartController@checkPromo')->name('checkPromo');
    Route::get('/changeQuantity/{id}', 'WEB\Site\CartController@changeQuantity')->name('changeQuantity');
    Route::get('/cart/', 'WEB\Site\CartController@myCart')->name('myCart');
    Route::get('/checkout', 'WEB\Site\CartController@checkout')->name('checkout');
    Route::Post('/storeCheckOut', 'WEB\Site\CartController@storeCheckOut')->name('storeCheckOut');
    Route::get('/calculateDileveryCostByAriaId', 'WEB\Site\CartController@calculateDileveryCostByAriaId')->name('calculateDileveryCostByAriaId');
    Route::get('/calculateDileveryCostByAddressId', 'WEB\Site\CartController@calculateDileveryCostByAddressId')->name('calculateDileveryCostByAddressId');


    Route::get('/login', 'WEB\Site\UsersController@loginView')->name('login');
    Route::post('/login', 'WEB\Site\UsersController@loginPost')->name('loginPost');

    Route::get('/register', 'WEB\Site\UsersController@loginView')->name('register');
    Route::post('/register', 'WEB\Site\UsersController@registerPost')->name('registerPost');

    Route::get('register_vender', 'WEB\Site\UsersController@showRegistrationForm');
    Route::post('register_vender', 'WEB\Site\UsersController@registerVenderPost')->name('registerVenderPost');

    Route::get('/contact', 'WEB\Site\HomeController@contact')->name('contact');
    Route::post('/subscribeNow', 'WEB\Site\HomeController@subscribeNow')->name('subscribeNow');
    Route::post('/contact_us', 'WEB\Site\HomeController@contactUs');
    Route::get('/page/{id}', 'WEB\Site\HomeController@pages');

    Route::get('forgot/password', 'Auth\ForgotPasswordController@forgotPasswordForm')->name('forgotPasswordForm');
    Route::post('sendResetLinkEmail', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('sendResetLinkEmail');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.new');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');


    /**
     *   ADMIN AUTH
     */

    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', function () {
            return route('/login');
        });


        Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('admin.login.form');
        Route::post('/login', 'AdminAuth\LoginController@login')->name('admin.login');
        Route::get('/logout', 'AdminAuth\LoginController@logout')->name('admin.logout');
      //  Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.reset');
     //   Route::post('/password/email', 'AdminAuth\ForgotPasswordController@send_email')->name('admin.password.email');
    });





    Route::group(['middleware' => ['web', 'admin'], 'prefix' => 'admin', 'as' => 'admin.',], function () {
        Route::get('/', function () {
            return redirect('/admin/home');
        });
        Route::post('/changeStatus/{model}', 'WEB\Admin\HomeController@changeStatus');
        Route::get('home', 'WEB\Admin\HomeController@index')->name('admin.home');
        Route::get('/admins/{id}/edit', 'WEB\Admin\AdminController@edit')->name('admins.edit');
        Route::patch('/admins/{id}', 'WEB\Admin\AdminController@update')->name('users.update');
        Route::get('/admins/{id}/edit_password', 'WEB\Admin\AdminController@edit_password')->name('admins.edit_password');
        Route::post('/admins/{id}/edit_password', 'WEB\Admin\AdminController@update_password')->name('admins.edit_password');

        if (can('admins')) {
            Route::get('/admins', 'WEB\Admin\AdminController@index')->name('admins.all');
            Route::post('/admins/changeStatus', 'WEB\Admin\AdminController@changeStatus')->name('admin_changeStatus');

            Route::delete('admins/{id}', 'WEB\Admin\AdminController@destroy')->name('admins.destroy');
            Route::post('admin/products/import',  'WEB\Admin\ProductsController@import')->name('products.import');

            Route::post('/admins', 'WEB\Admin\AdminController@store')->name('admins.store');
            Route::get('/admins/create', 'WEB\Admin\AdminController@create')->name('admins.create');
            Route::get('/editMyProfile', 'WEB\Admin\AdminController@editMyProfile')->name('admins.editMyProfile');
            Route::post('/updateProfile', 'WEB\Admin\AdminController@updateProfile')->name('admins.updateProfile');
            Route::get('/changeMyPassword', 'WEB\Admin\AdminController@changeMyPassword')->name('admins.changeMyPassword');
            Route::post('/updateMyPassword', 'WEB\Admin\AdminController@updateMyPassword')->name('admins.updateMyPassword');

            Route::resource('/reviews', 'WEB\Admin\ReviewController')->only(['index', 'edit', 'update', 'destroy']);



        }

        if (can('users')) {
            Route::get('/users', 'WEB\Admin\UsersController@index')->name('users.all');
            Route::post('/users', 'WEB\Admin\UsersController@store')->name('users.store');
            Route::get('/users/create', 'WEB\Admin\UsersController@create')->name('users.create');
            Route::delete('users/{id}', 'WEB\Admin\UsersController@destroy')->name('users.destroy');
            Route::get('/users/{id}/edit', 'WEB\Admin\UsersController@edit')->name('users.edit');
            Route::get('/users/{id}/orders', 'WEB\Admin\UsersController@orders')->name('users.orders');
            Route::patch('/users/{id}', 'WEB\Admin\UsersController@update')->name('users.update');
            Route::get('/users/{id}/edit_password', 'WEB\Admin\UsersController@edit_password')->name('users.edit_password');
            Route::post('/users/{id}/edit_password', 'WEB\Admin\UsersController@update_password')->name('users.edit_password');
            Route::get('/exportUsers', 'WEB\Admin\UsersController@exportUsers');




            Route::get('/users/{id}/addresses', 'WEB\Admin\UsersController@addresses')->name('users.addresses');
            Route::get('/users/{id}/addresses/create', 'WEB\Admin\UsersController@createAddress')->name('users.addresses');
            Route::post('/users/{id}/addresses/store', 'WEB\Admin\UsersController@storeAddress')->name('users.addresses');

            Route::get('/users/{id}/addresses/{address}/edit', 'WEB\Admin\UsersController@editAddress')->name('users.addresses');
            Route::patch('/users/{id}/addresses/{address}/update', 'WEB\Admin\UsersController@updateAddress')->name('users.addresses');
            Route::delete('/deleteAddress/{id}', 'WEB\Admin\UsersController@deleteAddress')->name('users.addresses');
        }

        if (can('vender')) {
            Route::get('/vender', 'WEB\Admin\VenderController@index')->name('venders.all');
            Route::get('/verified_vender', 'WEB\Admin\VenderController@verifiedVender');
            Route::get('/unverified_vender', 'WEB\Admin\VenderController@unverifiedVender');
            Route::get('/request_vender', 'WEB\Admin\VenderController@requestVender');
            Route::delete('vender/{id}', 'WEB\Admin\VenderController@destroy')->name('vender.destroy');
            Route::delete('unverified_vender/{id}', 'WEB\Admin\VenderController@destroy')->name('vender.destroy');
            Route::delete('verified_vender/{id}', 'WEB\Admin\VenderController@destroy')->name('vender.destroy');
            Route::get('/active_vender{id}', 'WEB\Admin\VenderController@activeVender');
            Route::get('/vender/{id}/edit', 'WEB\Admin\VenderController@edit')->name('venders.edit');
            Route::patch('/vender/{id}', 'WEB\Admin\VenderController@update')->name('venders.update');
            Route::get('/vender/create', 'WEB\Admin\VenderController@create')->name('venders.create');
            Route::post('/vender', 'WEB\Admin\VenderController@store')->name('venders.store');

            Route::post('/vender/{id}/addresses/store', 'WEB\Admin\VenderController@storeAddress')->name('venders.addresses');

            Route::get('/exportvender', 'WEB\Admin\VenderController@exportvender');



        }
        if (can('Vitamin')) {
            # code...
            Route::get('/Vitamin', 'WEB\Admin\VitaminController@index');
              Route::get('/Vitamin/{id}/edit', 'WEB\Admin\VitaminController@edit')->name('Vitamin.edit');
            Route::patch('/Vitamin/{id}', 'WEB\Admin\VitaminController@update')->name('Vitamin.update');
            Route::get('/Vitamin/create', 'WEB\Admin\VitaminController@create')->name('Vitamin.create');
            Route::post('/Vitamin', 'WEB\Admin\VitaminController@store')->name('Vitamin.store');

        }

        if (can('categories')) {
            Route::resource('/categories', 'WEB\Admin\CategoriesController');

            Route::resource('/additions', 'WEB\Admin\AdditionsController');
            Route::resource('/serviceProvidersTypes', 'WEB\Admin\ServiceProvidersTypeController');

        }
            Route::resource('/ages', 'WEB\Admin\AgesController');
            Route::resource('/posts', 'WEB\Admin\PostController');
        if (can('contact_us')) {
            Route::get('/contact', 'WEB\Admin\ContactController@index');
            Route::get('/viewMessage/{id}', 'WEB\Admin\ContactController@viewMessage');
            Route::delete('/contact/{id}', 'WEB\Admin\ContactController@destroy');

            Route::get('/workrequests', 'WEB\Admin\WorkrequestController@index');
            Route::get('/workeRequests/{id}', 'WEB\Admin\WorkrequestController@viewMessage');
            Route::delete('/workrequests/{id}', 'WEB\Admin\WorkrequestController@destroy');

            Route::get('/subscribes', 'WEB\Admin\SubscribeEmailController@index');
            Route::delete('/subscribes/{id}', 'WEB\Admin\SubscribeEmailController@destroy');

            Route::resource('/specialRequests', 'WEB\Admin\SpecialRequestController');
        }

        if (can('settings')) {
            Route::get('settings', 'WEB\Admin\SettingController@index')->name('settings.all');
            Route::post('settings', 'WEB\Admin\SettingController@update')->name('settings.update');


            Route::get('system_maintenance', 'WEB\Admin\SettingController@system_maintenance')->name('system.maintenance');
            Route::post('system_maintenance', 'WEB\Admin\SettingController@update_system_maintenance')->name('update.system.maintenance');

            Route::get('system_seo', 'WEB\Admin\SettingController@system_seo')->name('system.seo');
            Route::post('system_seo', 'WEB\Admin\SettingController@update_system_seo')->name('update.system.seo');


            Route::get('/sliders', 'WEB\Admin\SliderController@index');

        }

        if(can('pages'))
        {
            Route::resource('/roles', 'WEB\Admin\RolesController');
            Route::resource('/pages', 'WEB\Admin\PagesController');
            Route::post('/pages/changeStatus', 'WEB\Admin\PagesController@changeStatus');
        }

        if (can('promotions')) {
            // Route::resource('/promotions', 'WEB\Admin\Promotion_codeController');
            Route::resource('/coupons', 'WEB\Admin\CouponController');
            Route::post('promotions_changeStatus', 'WEB\Admin\Promotion_codeController@changeStatus');

        }

        if (can('products')) {
            Route::resource('/products', 'WEB\Admin\ProductsController');
            Route::get('/products/{id}/logs', 'WEB\Admin\ProductsController@logs');
            Route::resource('/productReques', 'WEB\Admin\ProductRequestController');
            Route::resource('/editProductPriceRequests', 'WEB\Admin\EditProductPriceController');
            Route::post('/accept_product_price_request/{id}', 'WEB\Admin\EditProductPriceController@acceptProductPriceRequest');
            Route::post('/delete-gift-packaging','WEB\Admin\ProductsController@deleteGiftPackaging')->name('delete.gift.packaging');
            Route::post('/remove-varint','WEB\Admin\ProductsController@removeVarint')->name('delete.varint');

            //   Route::get('/storeProducts', 'WEB\Admin\ProductsController@store');
            Route::resource('/productoffers', 'WEB\Admin\ProductofferController');

             Route::get('/products/{id}/offers', 'WEB\Admin\ProductsController@productOffers');
             Route::get('/products/{id}/addOffer', 'WEB\Admin\ProductsController@addOffer');
             Route::post('/products/{id}/addOffer', 'WEB\Admin\ProductsController@storeOffer');
             Route::get('/product/{id}/review', 'WEB\Admin\ProductsController@productReview');

        }
//        if (can('ads')) {
            Route::resource('/ads', 'WEB\Admin\AdsController');
            Route::resource('/banners', 'WEB\Admin\BannerController');


       // }
        if (can('cities')) {
            Route::resource('/countries', 'WEB\Admin\CountryController');
            Route::resource('/cities', 'WEB\Admin\CitiesController');
            Route::resource('/areas', 'WEB\Admin\AreaController');
            Route::resource('/giftcards', 'WEB\Admin\GiftcardController');
        }
        if (can('orders')) {
            Route::resource('orders', 'WEB\Admin\OrdersController');
            Route::get('orders/orderDetails/{id}', 'WEB\Admin\OrdersController@orderDetails');
            Route::get('orders/change_orderSts/{value}/{id}', 'WEB\Admin\OrdersController@change_orderSts');
            Route::get('orders/printOrder/{id}', 'WEB\Admin\OrdersController@printOrder');

        }

        if (can('rates')) {
            Route::resource('rates', 'WEB\Admin\RateController');
            Route::get('rates/rateDetails/{id}', 'WEB\Admin\RateController@rateDetails');
        }

        if (can('questions')) {
            Route::resource('questions', 'WEB\Admin\QuestionsController');
            Route::post('/questions/{id}', 'WEB\Admin\QuestionsController@update');
        }

        if (can('owners')) {
            Route::resource('/owners', 'WEB\Admin\OwnersController');
            Route::get('/owners/{id}/edit_password', 'WEB\Admin\OwnersController@edit_password')->name('owners.edit_password');
            Route::post('/owners/{id}/edit_password', 'WEB\Admin\OwnersController@update_password')->name('owners.edit_password');

        }


        if (can('notifications')) {

            Route::resource('/notifications', 'WEB\Admin\NotificationMessageController');
        }


        if(can('permissions'))
        {
            Route::resource('/role', 'WEB\Admin\RoleController');
        }

        if (can('deliverynote')) {

            Route::get('/deliverynote', 'WEB\Admin\DeliveryController@index')->name('deliverynote.all');
            Route::post('/deliverynote', 'WEB\Admin\DeliveryController@store')->name('deliverynote.store');
            Route::get('/deliverynote/create', 'WEB\Admin\DeliveryController@create')->name('deliverynote.create');
            Route::delete('deliverynote/{id}', 'WEB\Admin\DeliveryController@destroy')->name('deliverynote.destroy');
            Route::get('/deliverynote/{id}/edit', 'WEB\Admin\DeliveryController@edit')->name('deliverynote.edit');
            Route::get('/deliverynote/{id}/orders', 'WEB\Admin\DeliveryController@orders')->name('deliverynote.orders');
            Route::patch('/deliverynote/{id}', 'WEB\Admin\DeliveryController@update')->name('deliverynote.update');
            Route::get('/exportdeliverynote', 'WEB\Admin\DeliveryController@exportdeliverynote');

//            varintType
            Route::get('/varintType', 'WEB\Admin\ProductVarintTypeController@index')->name('varintType.all');
            Route::post('/varintType', 'WEB\Admin\ProductVarintTypeController@store')->name('varintType.store');
            Route::get('/varintType/create', 'WEB\Admin\ProductVarintTypeController@create')->name('varintType.create');
            Route::delete('varintType/{id}', 'WEB\Admin\ProductVarintTypeController@destroy')->name('varintType.destroy');
            Route::get('/varintType/{id}/edit', 'WEB\Admin\ProductVarintTypeController@edit')->name('varintType.edit');
            Route::get('/varintType/{id}/orders', 'WEB\Admin\ProductVarintTypeController@orders')->name('varintType.orders');
            Route::patch('/varintType/{id}', 'WEB\Admin\ProductVarintTypeController@update')->name('varintType.update');
            Route::get('/exportvarintType', 'WEB\Admin\ProductVarintTypeController@exportvarintType');

        }


    });
    Route::get('/cancelOrders', 'WEB\Site\HomeController@cancelOrders')->name('cancelOrders');
    /**
     * Payment success page
     */
    Route::get('/successPayment','API\v1\PaymentController@success')->name('successPayment');
    Route::get('/failPayment','API\v1\PaymentController@fail')->name('failPayment');


    Route::group(['prefix' => 'vender'], function () {
        Route::get('/', function () {
            return redirect()->route('Vender.login.form');
        });

        // Route::get('/register', function () {
        //     return redirect()->route('Vender.auth.register');
        // });

        /**
         * Registration ..
            */

            Route::get('/editMyProfile', 'VenderAuth\RegisterController@editMyProfile')->name('venders.editMyProfile');
            Route::post('/updateVenderProfile', 'VenderAuth\RegisterController@updateProfile');
            Route::get('/editVenderAddress', 'VenderAuth\RegisterController@editAddress');
            Route::post('/VenderAddress', 'VenderAuth\RegisterController@updateVenderAddress');

            Route::get('/changeMyPassword', 'VenderAuth\RegisterController@changeMyPassword');
            Route::post('/updateMyPassword', 'WEB\Admin\RegisterController@updateMyPassword');

            Route::get('/login', 'VenderAuth\LoginController@showLoginForm')->name('Vender.login.form');
            Route::post('/login', 'VenderAuth\LoginController@login')->name('Vender.login');
            Route::get('/logout', 'VenderAuth\LoginController@logout')->name('Vender.logout');


            Route::group(['middleware' => 'vender'], function() {

                Route::get('/home',  'WEB\Vender\HomeController@index')->name('vender.home');
                Route::post('/vender_changeStatus/{model}', 'WEB\Vender\HomeController@changeStatus');
                Route::get('/venders/{id}/edit_password', 'VenderAuth\RegisterController@edit_password');
                Route::post('/venders/{id}/edit_password', 'VenderAuth\RegisterController@update_password');
                if (can('products')) {
                    Route::resource('/products', 'WEB\Vender\ProductsController');
                    Route::get('/products/{id}/logs', 'WEB\Vender\ProductsController@logs');
                    Route::resource('/productReques', 'WEB\Vender\ProductRequestController');
                    Route::resource('/editProductPriceRequests', 'WEB\Vender\EditProductPriceController');
                    Route::post('/accept_product_price_request/{id}', 'WEB\Vender\EditProductPriceController@acceptProductPriceRequest');

                    Route::post('/delete-gift-packaging','WEB\Admin\ProductsController@deleteGiftPackaging')->name('delete.gift.packaging');
                    Route::post('/remove-varint','WEB\Admin\ProductsController@removeVarint')->name('delete.varint');

                    //   Route::get('/storeProducts', 'WEB\Vender\ProductsController@store');
                    // Route::resource('/productoffers', 'WEB\Vender\ProductofferController');

                    Route::get('/products/{id}/offers', 'WEB\Vender\ProductsController@productOffers');
                    Route::get('/products/{id}/addOffer', 'WEB\Vender\ProductsController@addOffer');
                    Route::post('/products/{id}/addOffer', 'WEB\Vender\ProductsController@storeOffer');
                    Route::get('/product/{id}/review', 'WEB\Vender\ProductsController@productReview');

                }

                if (can('promotions')) {
                    // Route::resource('/promotions', 'WEB\Admin\Promotion_codeController');
                    Route::resource('/coupons', 'WEB\Vender\CouponController');
                    Route::post('promotions_changeStatus', 'WEB\Vender\Promotion_codeController@changeStatus');

                }


                if (can('orders')) {
                    Route::resource('orders', 'WEB\Vender\OrdersController');
                    Route::get('orders/orderDetails/{id}', 'WEB\Vender\OrdersController@orderDetails');
                    Route::post('orders/change_orderSts/{value}/{id}', 'WEB\Vender\OrdersController@change_orderSts');
                    Route::get('orders/printOrder/{id}', 'WEB\Vender\OrdersController@printOrder');

                }
            });


    });


});


