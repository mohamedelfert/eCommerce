<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin','namespace' => 'Admin'],function (){

    Config::set('auth.defines','admin');
    Route::get('login','AdminController@login');
    Route::post('login','AdminController@doLogin');
    Route::get('forgot/password','AdminController@forgot_password');
    Route::post('forgot/password','AdminController@doForgot_password');
    Route::get('reset/password/{token}','AdminController@reset_password');
    Route::post('reset/password/{token}','AdminController@doReset_password');

    Route::group(['middleware' => 'admin:admin'],function (){
        Route::get('/',function (){
            return view('admin.home');
        });

        Route::any('logout','AdminController@logout');
    });

});
