<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin','namespace' => 'Admin'],function (){

    Config::set('auth.defines','admin');
    Route::get('login','AdminAuthController@login');
    Route::post('login','AdminAuthController@doLogin');
    Route::get('forgot/password','AdminAuthController@forgot_password');
    Route::post('forgot/password','AdminAuthController@doForgot_password');
    Route::get('reset/password/{token}','AdminAuthController@reset_password');
    Route::post('reset/password/{token}','AdminAuthController@doReset_password');

    Route::group(['middleware' => 'admin:admin'],function (){
        Route::resource('admin','AdminsController');

        Route::get('/',function (){
            return view('admin.home');
        });

        Route::any('logout','AdminAuthController@logout');
    });

});
