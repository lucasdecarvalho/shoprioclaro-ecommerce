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

// Main
Route::get('/', 'IndexController@index')->name('index');
Route::get('/example', 'IndexController@example')->name('example');
Route::get('/search', 'IndexController@word')->name('search.word');

Route::get('/shop', 'IndexController@index')->name('index');
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

Route::get('send-mail', function () {
   
    $details = [
        'title' => 'Olá, {{ $shop->name }}! Agradecemos por sua compra em nossa loja.',
        'body' => 'Caso precise de alguma ajuda com o seu pedido, fale conosco através do WhatsApp® (19) 91234-5678.'
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
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

