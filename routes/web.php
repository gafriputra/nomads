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



// use Illuminate\Routing\Route;

// tentukan route dan beri nama
Route::get('/', 'HomeController@index')
    ->name('home');

Route::get('/detail/{slug}', 'DetailController@index')
    ->name('detail');

Route::post('/checkout/{id}', 'CheckoutController@process') //jika yang diterima post dengan parameter itu, maka arahkan ke
    ->name('checkout-process') //kasih alias
    ->middleware(['auth', 'verified']); //harus sudah login terverifikasi

Route::get('/checkout/{id}', 'CheckoutController@index') //jika yang diterima et dengan parameter itu, maka arahkan ke
    ->name('checkout') //kasih alias
    ->middleware(['auth', 'verified']); //harus sudah login terverifikasi

Route::post('/checkout/create/{detail_id}', 'CheckoutController@create') //jika yang diterima post dengan parameter itu, maka arahkan ke
    ->name('checkout-create') //kasih alias
    ->middleware(['auth', 'verified']); //harus sudah login terverifikasi

Route::get('/checkout/remove/{detail_id}', 'CheckoutController@remove') //jika yang diterima get dengan parameter itu, maka arahkan ke
    ->name('checkout-remove') //kasih alias
    ->middleware(['auth', 'verified']); //harus sudah login terverifikasi

Route::get('/checkout/confirm/{id}', 'CheckoutController@success') //jika yang diterima get dengan parameter itu, maka arahkan ke
    ->name('checkout-success') //kasih alias
    ->middleware(['auth', 'verified']); //harus sudah login terverifikasi



// bungkus dulu, biar rapi. dan fungsi namespace biar gapakek nulis admin lagi
Route::prefix('admin')
    ->namespace('Admin')
    ->middleware(['auth', 'admin']) // nambahin satpamnya dr kernel
    ->group(function () { //digroupin
        Route::get('/', 'DashboardController@index') //contoh webkita.com/admin //panggil controller dan methodnya
            ->name('dashboard'); //dikasih nama routenya, nanti tinggal manggil

        // daftarin route, (nama abel, controller)
        Route::resource('travel-package', 'TravelPackageController');
        Route::resource('gallery', 'GalleryController');
        Route::resource('transaction', 'TransactionController');
    });

Auth::routes(['verify' => true]);


// Midtrans
Route::post('/midtrans/callback', 'MidtransController@notificationHandler');
Route::get('/midtrans/finish', 'MidtransController@finishRedirect');
Route::get('/midtrans/unfinish', 'MidtransController@unfinishRedirect');
Route::get('/midtrans/error', 'MidtransController@errorRedirect');
