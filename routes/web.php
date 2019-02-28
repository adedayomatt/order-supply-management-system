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

Route::get('/','AppController@transactions')->name('index');
Auth::routes();

Route::get('/pause', 'AppController@staff')->name('pause');
Route::group(['middleware' => 'auth'], function(){
    Route::resource('customer','CustomerController');
    Route::get('customer/{customer}/order','CustomerController@order')->name('customer.order');
    Route::get('customer/{customer}/orders','CustomerController@orders')->name('customer.orders');
    Route::get('customer/{customer}/supplies','CustomerController@supplies')->name('customer.supplies');
    
    Route::resource('user','UserController');
    Route::get('user/{user}/orders','UserController@orders')->name('user.orders');
    Route::get('user/{user}/supplies','UserController@supplies')->name('user.supplies');
    Route::get('user/{user}/password','UserController@changePassword')->name('password.change');
    Route::put('user/{user}/password','UserController@updatePassword')->name('password.update');
    
    Route::resource('order','OrderController');
    Route::put('order/{order}/close', 'OrderController@close')->name('order.close');
    Route::put('order/{order}/reopen', 'OrderController@open')->name('order.open');
    Route::get('order/{order}/supply','SupplyController@create')->name('supply.create');
    Route::post('order/{order}/supply','SupplyController@store')->name('supply.store');
    Route::get('order/{order}/supply/{supply}','SupplyController@show')->name('supply.show');
    Route::get('supplies','SupplyController@index')->name('supplies');
    Route::post('supply/{supply}/revert','SupplyController@revert')->name('supply.revert');
    
});

// Route::get('/home', 'HomeController@index')->name('home');
