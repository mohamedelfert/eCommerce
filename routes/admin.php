<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin','namespace' => 'Admin'],function (){

    Config::set('auth.defaults','admin');
    Route::get('login','AdminController@login');
    Route::post('login','AdminController@doLogin');

    Route::group(['middleware' => 'admin:admin'],function (){
        Route::get('/',function (){
            return view('admin.home');
        });

        Route::any('logout','AdminController@logout');
    });

});
