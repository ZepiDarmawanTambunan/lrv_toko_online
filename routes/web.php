<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// Route::get('/debug-sentry', function () {
//     throw new Exception('My first Sentry error!');
// });

Route::get('/', 'HomeController@index')->name('home');
Route::get('/categories', 'CategoryController@index')->name('categories');
Route::get('/categories/{id}', 'CategoryController@detail')->name('categories-detail');

Route::get('/details/{id}', 'DetailController@index')->name('detail');
Route::post('/details/{id}', 'DetailController@add')->name('detail-add');

Route::get('/success', 'CartController@success')->name('success');
Route::get('/register/success', 'Auth\RegisterController@success')->name('register-success');

Route::group(['middleware' => ['auth']], function () {
    // CART
    Route::get('/cart', 'CartController@index')->name('cart');
    Route::delete('/cart/{id}', 'CartController@delete')->name('cart-delete');
    Route::post('/checkout', 'CheckoutController@process')->name('checkout');

    // PRODUCTS
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/dashboard/products', 'DashboardProductController@index')->name('dashboard-products');
    Route::get('/dashboard/products/create', 'DashboardProductController@create')->name('dashboard-products-create');
    Route::get('/dashboard/products/{id}', 'DashboardProductController@details')->name('dashboard-products-details');

    // TRANSACTION
    Route::get('/dashboard/transactions', 'DashboardTransactionController@index')->name('dashboard-transactions');
    Route::get('/dashboard/transactions/{id}', 'DashboardTransactionController@details')->name('dashboard-transactions-details');

    // SETTINGS
    Route::get('/dashboard/settings', 'DashboardSettingController@store')->name('dashboard-settings-store');
    Route::get('/dashboard/account', 'DashboardSettingController@account')->name('dashboard-settings-account');
});

Route::prefix('admin')
    ->namespace('Admin')
    ->name('admin-')
    ->group(function () {
        Route::get('/', 'DashboardController@index')->name('dashboard');
        Route::resource('category', 'CategoryController');
        Route::delete('/category', 'CategoryController@delete')->name('category.delete');  //delete checkbox
        Route::resource('user', 'UserController');
        Route::resource('product', 'ProductController');
        Route::resource('product-gallery', 'ProductGalleryController');
    });

Auth::routes();
