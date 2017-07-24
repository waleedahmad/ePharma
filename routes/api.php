<?php

Route::group(
    [   'middleware'  =>  ['auth:api'],
        'namespace' => 'Api'
    ], function(){

    Route::get('/user', 'UserController@getUser');

    Route::get('/checkout', 'UserController@checkout');
    Route::get('/category/{category}', 'AppController@getCategorizedMedicines');

    Route::post('/cart', 'CheckoutController@addItemToCart');
    Route::delete('/cart', 'CheckoutController@removeItemFromCart');
    Route::get('/cart/process', 'CheckoutController@processCheckout');
    Route::get('/receipts', 'UserController@showReceipts');
    Route::get('/receipt','UserController@getReceipt');

    Route::get('/user/info', 'UserController@getUserInfo');
    Route::post('/user/info', 'UserController@saveUserInfo');
    Route::post('/user/info/update', 'UserController@updateUserInfo');
    Route::get('/user/info/towns', 'UserController@getTowns');

    Route::get('/search', 'UserController@search');
    Route::get('/medicine', 'UserController@showMedicine');
});

Route::group(
    [
        'middleware'  =>  ['guest:api'],
        'namespace' =>  'Api'
    ], function(){
    Route::post('/register','AuthController@registerUser');

    Route::post('/login', 'AuthController@authenticateUser');
});