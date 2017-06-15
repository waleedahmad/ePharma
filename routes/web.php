<?php

Route::get('/','AppController@getIndex');


Route::group(['middleware' =>	['auth']], function(){
    Route::get('/logout','AuthController@logout');
});

Route::group(['middleware'  =>  ['admin']], function(){
    Route::get('/admin/companies', 'AdminController@getCompanies');
    Route::get('/admin/company/add', 'AdminController@getAddCompany');
    Route::get('/admin/company/edit/{id}', 'AdminController@getEditCompany');
    Route::post('/admin/company/update', 'AdminController@updateCompany');
    Route::post('/admin/company', 'AdminController@addCompany');
    Route::delete('/admin/company', 'AdminController@deleteCompany');

    Route::get('/admin/branches', 'AdminController@getBranches');
    Route::get('/admin/branch/add', 'AdminController@getAddBranch');
    Route::get('/admin/branch/edit', 'AdminController@getEditBranch');
    Route::post('/admin/branch/update', 'AdminController@updateBranch');
    Route::post('/admin/branch', 'AdminController@addBranch');
    Route::delete('/admin/branch', 'AdminController@deleteBranch');

    Route::get('/admin/users', 'AdminController@getUsers');
    Route::get('/admin/user/add', 'AdminController@getAddUser');
    Route::post('/admin/user', 'AdminController@addUser');
    Route::delete('/admin/user', 'AdminController@deleteUser');
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