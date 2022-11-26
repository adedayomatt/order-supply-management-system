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

    Route::get('customer/{customer}/supplies','CustomerController@supplies')->name('customer.supplies');
    Route::get('customer/{customer}/supply/new','CustomerController@newSupply')->name('customer.supply.create');
    
    Route::get('customer/{customer}/payments', 'CustomerController@payments')->name('customer.payments');
    Route::get('customer/{customer}/payment/new', 'CustomerController@newPayment')->name('customer.payment.create');
    

    Route::get('payments','PaymentController@index')->name('payments');
    Route::get('payment/create','PaymentController@create')->name('payment.create');
    Route::get('payment/{id}/edit','PaymentController@edit')->name('payment.edit');
    Route::put('payment/{id}/update','PaymentController@update')->name('payment.update');
    Route::post('payment/store','PaymentController@store')->name('payment.store');
    Route::delete('payment/{id}/delete','PaymentController@delete')->name('payment.delete');

    Route::get('payments','PaymentController@index')->name('payments');
    
    Route::resource('user','UserController');
    Route::get('user/{user}/payments','UserController@payments')->name('user.payments');
    Route::get('user/{user}/supplies','UserController@supplies')->name('user.supplies');
    Route::get('user/{user}/password','UserController@changePassword')->name('user.password.change');
    Route::put('user/{user}/password','UserController@updatePassword')->name('user.password.update');
    
    Route::get('supplies','SupplyController@index')->name('supplies');
    Route::get('supply/create','SupplyController@create')->name('supply.create');
    Route::post('supply/ceate','SupplyController@store')->name('supply.store');
    Route::get('supply/{id}/edit','SupplyController@edit')->name('supply.edit');
    Route::put('supply/{id}/update','SupplyController@update')->name('supply.update');
    Route::post('supply/{supply}/revert','SupplyController@revert')->name('supply.revert');
    Route::delete('supply/{supply}/delete','SupplyController@delete')->name('supply.delete');
    
});

// Route::get('/home', 'HomeController@index')->name('home');
