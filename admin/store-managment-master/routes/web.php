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

Route::get('/', fn() => redirect()->route('dashboard.index'));

Auth::routes(['register' => false, 'confirm' => false, 'reset' => false]);


Route::middleware('auth')->prefix('/dashboard')->group(function () {
    Route::get('/', 'DashboardController@index')->name('dashboard.index');
    Route::get('/ui', 'DashboardController@ui');

    Route::get('/users', 'UserController@index')->name('users.index');
    Route::get('/users/create', 'UserController@create')->name('users.create');
    Route::post('/users', 'UserController@store')->name('users.store');
    Route::get('/users/{user}/edit', 'UserController@edit')->name('users.edit');
    Route::put('/users/{user}', 'UserController@update')->name('users.update');
    Route::delete('/users/{user}', 'UserController@destroy')->name('users.destroy');

    Route::resource('/categories', 'CategoryController');
    Route::get('/get/subcategories/{id}', 'CategoryController@getSubcategories')->name('categories.getsubcategories');
    Route::resource('/subcategories', 'SubcategoryController');

    Route::resource('/products', 'ProductController', ['update' => false]);
    Route::post('/products/update/{product}', 'ProductController@update')->name('products.update');

    Route::resource('/orders', 'OrderController');

    Route::resource('/order/details', 'OrderController');

    Route::get('/customer/services/create', 'CustomerServiceController@create')->name('customer.services.create');
    Route::get('/customer/services', 'CustomerServiceController@index')->name('customer.services.index');
    Route::get('/customer/services/{order}', 'CustomerServiceController@show')->name('customer.services.show');
    Route::post('/customer/services', 'CustomerServiceController@store')->name('customer.services.store');

    Route::get('/deliveries', 'DeliveryController@index')->name('deliveries.index');
    Route::get('/deliveries/{order}', 'DeliveryController@show')->name('deliveries.show');

});
