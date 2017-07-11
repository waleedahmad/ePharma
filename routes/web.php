<?php

Route::get('/','AppController@getIndex');

Route::group(['middleware' =>	['auth']], function(){

    Route::group(['middleware'  =>  ['admin']], function(){
        Route::get('/admin/companies', 'AdminController@getCompanies');
        Route::get('/admin/company/add', 'AdminController@getAddCompany');
        Route::get('/admin/company/edit/{id}', 'AdminController@getEditCompany');
        Route::post('/admin/company/update', 'AdminController@updateCompany');
        Route::post('/admin/company', 'AdminController@addCompany');
        Route::delete('/admin/company', 'AdminController@deleteCompany');

        Route::get('/admin/branches', 'AdminController@getBranches');
        Route::get('/admin/branch/add', 'AdminController@getAddBranch');
        Route::get('/admin/branch/edit/{id}', 'AdminController@getEditBranch');
        Route::post('/admin/branch/update', 'AdminController@updateBranch');
        Route::post('/admin/branch', 'AdminController@addBranch');
        Route::delete('/admin/branch', 'AdminController@deleteBranch');

        Route::get('/admin/users', 'AdminController@getUsers');
        Route::get('/admin/user/add', 'AdminController@getAddUser');
        Route::post('/admin/user', 'AdminController@addUser');
        Route::delete('/admin/user', 'AdminController@deleteUser');
    });

    Route::group(['middleware'  =>  ['b_admin']], function(){
        Route::get('/branch/medicines', 'BranchController@getMedicines');
        Route::get('/branch/medicine/add', 'BranchController@getAddMedicine');
        Route::get('/branch/medicine/edit/{id}', 'BranchController@getEditMedicine');
        Route::post('/branch/medicine/update', 'BranchController@updateMedicine');
        Route::post('/branch/medicine', 'BranchController@addMedicine');
        Route::delete('/branch/medicine', 'BranchController@deleteMedicine');

        Route::get('/branch/stock', 'BranchController@getStock');
        Route::get('/branch/stock/add', 'BranchController@getAddStock');
        Route::get('/branch/stock/edit/{id}', 'BranchController@getEditStock');
        Route::post('/branch/stock/update', 'BranchController@updateStock');
        Route::post('/branch/stock', 'BranchController@addStock');
        Route::delete('/branch/stock', 'BranchController@deleteStock');
        Route::get('/branch/orders', 'BranchController@branchOrders');
        Route::get('/branch/order/{id}', 'BranchController@viewOrder');
        Route::get('/branch/order/{id}/clear', 'BranchController@clearOrders');
    });

    Route::group(['middleware'  =>  ['user']], function(){
        Route::get('/search', 'UserController@search');
        Route::get('/checkout', 'UserController@checkout');
        Route::get('/medicine/{id}', 'UserController@showMedicine');

        Route::post('/cart', 'CheckoutController@addItemToCart');
        Route::delete('/cart', 'CheckoutController@removeItemFromCart');
        Route::get('/cart/process', 'CheckoutController@processCheckout');
        Route::get('/receipts', 'UserController@showReceipts');
        Route::get('/receipt/{id}','UserController@getReceipt');

    });


    Route::get('/logout','AuthController@logout');
});


Route::group(['middleware'	=>	['guest']], function(){
    Route::get('/register', 'AuthController@getRegister');

    Route::post('/register','AuthController@registerUser');

    Route::get('/login', 'AuthController@getLogin');

    Route::post('/login', 'AuthController@authenticateUser');

    Route::get('/forgot/password','AuthController@forgotPassword');

    Route::post('/forgot/password','AuthController@recoverPassword');

    Route::get('/reset/password/{token}/{email}','AuthController@getResetForm');

    Route::post('/reset/password','AuthController@resetPassword');

    Route::get('/verify/user/{token}/{email}', 'AuthController@verifyUser');
});