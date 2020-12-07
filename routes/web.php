<?php

use Illuminate\Support\Facades\Route;

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

// Route::group(['prefix' => 'exemplo'], function() {

    // Main
    Route::get('/', 'IndexController@index')->name('index');
    Route::get('/search', 'IndexController@word')->name('search.word');

    Route::get('/shop', 'IndexController@index')->name('shop');
    Route::get('/shop/{slug}', 'ShopController@index')->name('shop.index');
    Route::get('/shop/{slug}/{productId}', 'ShopController@show')->name('shop.show');

    // Cart
    Route::get('/cart', 'CartController@index')->name('cart.index');
    Route::post('/cart', 'CartController@store')->name('cart.store');
    Route::put('/cart/{product}', 'CartController@update')->name('cart.update');
    Route::delete('/cart/{product}', 'CartController@destroy')->name('cart.destroy');

    // Checkout
    Route::get('/checkout', 'CieloController@index')->name('checkout.index')->middleware('auth');
    Route::post('/checkout', 'CieloController@payer')->name('checkout.payer')->middleware('auth');
    Route::post('/checkout/coupons', 'CieloController@coupon')->name('checkout.coupon');

    Route::get('/success', function () {
    
        $details = [
            'title' => 'Sua loja recebeu um novo pedido!',
            'body'  => 'Bom trabalho! Sua loja recebeu um novo pedido. Para mais detalhes, acesse o seu painel de administrador e clique em Relatórios > Vendas e Pedidos. Faça o envio o quanto antes e não deixe de notificar o comprador.'
        ];
    
        \Mail::to('lucasuix@gmail.com')->send(new \App\Mail\SoldMail($details));
    
    });

    // Authentications
    Auth::routes();

    // Admin
    Route::group(['prefix' => 'admin','middleware' => 'is_admin'], function() {

        Route::get('/', 'ProductController@index');
        Route::resource('products', 'ProductController');
        Route::resource('sales', 'SoldController');
        Route::resource('categories', 'CategoryController');
        Route::resource('users', 'UserController');
        Route::resource('newsletter', 'NewsletterController');
        Route::resource('coupons', 'CouponController');
        Route::resource('banners', 'BannerController');
    });

    // Client
    Route::get('/client', 'HomeController@index')->name('client.index');
    Route::put('/client', 'HomeController@update')->name('client.update');
    Route::get('/home', 'HomeController@index')->name('client.index');
    Route::get('/logout', 'Auth\LoginController@logout');

// });