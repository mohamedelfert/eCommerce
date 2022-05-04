<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

    Config::set('auth.defines', 'admin');
    Route::get('login', 'AdminAuthController@login');
    Route::post('login', 'AdminAuthController@doLogin');
    Route::get('forgot/password', 'AdminAuthController@forgot_password');
    Route::post('forgot/password', 'AdminAuthController@doForgot_password');
    Route::get('reset/password/{token}', 'AdminAuthController@reset_password');
    Route::post('reset/password/{token}', 'AdminAuthController@doReset_password');

    Route::group(['middleware' => 'admin:admin'], function () {
        /**************************** Admins *******************************/
        Route::resource('admin', 'AdminsController');
        Route::delete('admin/destroy/all', 'AdminsController@delete_all');

        /**************************** Users *******************************/
        Route::resource('user', 'UsersController');
        Route::delete('user/destroy/all', 'UsersController@delete_all');

        /**************************** Countries *******************************/
        Route::resource('countries', 'CountryController');
        Route::delete('countries/destroy/all', 'CountryController@delete_all');

        /**************************** Cities *******************************/
        Route::resource('cities', 'CityController');
        Route::delete('cities/destroy/all', 'CityController@delete_all');

        /**************************** States *******************************/
        Route::resource('states', 'StateController');
        Route::delete('states/destroy/all', 'StateController@delete_all');

        /**************************** Departments *******************************/
        Route::resource('departments', 'DepartmentController');

        /**************************** TradeMarks *******************************/
        Route::resource('trademarks', 'TradeMarkController');
        Route::delete('trademarks/destroy/all', 'TradeMarkController@delete_all');

        /**************************** Manufacturers *******************************/
        Route::resource('manufacturers', 'ManufacturerController');
        Route::delete('manufacturers/destroy/all', 'ManufacturerController@delete_all');

        /**************************** Shipping Companies *******************************/
        Route::resource('companies', 'ShippingCompanyController');
        Route::delete('companies/destroy/all', 'ShippingCompanyController@delete_all');

        /**************************** Malls *******************************/
        Route::resource('malls', 'MallController');
        Route::delete('malls/destroy/all', 'MallController@delete_all');

        /**************************** Colors *******************************/
        Route::resource('colors', 'ColorController');
        Route::delete('colors/destroy/all', 'ColorController@delete_all');

        /**************************** Sizes *******************************/
        Route::resource('sizes', 'SizeController');
        Route::delete('sizes/destroy/all', 'SizeController@delete_all');

        /**************************** Weights *******************************/
        Route::resource('weights', 'WeightController');
        Route::delete('weights/destroy/all', 'WeightController@delete_all');

        /**************************** Products *******************************/
        Route::resource('products', 'ProductController');
        Route::delete('products/destroy/all', 'ProductController@delete_all');
        Route::post('upload/image/{product_id}', 'ProductController@upload_file');
        Route::post('delete/image', 'ProductController@delete_file');
        Route::post('upload/product/image/{product_id}', 'ProductController@upload_main_photo');
        Route::post('delete/product/image/{product_id}', 'ProductController@delete_main_photo');
        Route::post('load/weight/size', 'ProductController@prepare_size_weight');
        Route::post('products/copy/{product_id}', 'ProductController@copy_product');
        Route::post('products/search', 'ProductController@product_search');

        /**************************** Settings *******************************/
        Route::get('setting', 'SettingsController@setting');
        Route::post('setting', 'SettingsController@setting_save');

        Route::get('/', 'HomeController@index');

        Route::any('logout', 'AdminAuthController@logout');
    });

    /**************************** this route for change language *******************************/
    Route::get('lang/{lang}', function ($lang) {
        session()->has('lang') ? session()->forget('lang') : '';
        $lang == 'ar' ? session()->put('lang', 'ar') : session()->put('lang', 'en');
        return back();
    });

});
