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
        Route::resource('admin', 'AdminsController');
        Route::delete('admin/destroy/all', 'AdminsController@delete_all');

        Route::get('/', function () {
            return view('admin.home');
        });

        Route::any('logout', 'AdminAuthController@logout');
    });

    //Route::get('datatables/lang', function () {
//        $langJson = [
//            'sProcessing' => trans('admin.sProcessing'),
//            'sLengthMenu' => trans('admin.sLengthMenu'),
//            'sZeroRecords' => trans('admin.sZeroRecords'),
//            'sEmptyTable' => trans('admin.sEmptyTable'),
//            'sInfo' => trans('admin.sInfo'),
//            'sInfoEmpty' => trans('admin.sInfoEmpty'),
//            'sInfoFiltered' => trans('admin.sInfoFiltered'),
//            'sInfoPostFix' => trans('admin.sInfoPostFix'),
//            'sSearch' => trans('admin.sSearch'),
//            'sUrl' => trans('admin.sUrl'),
//            'sInfoThousands' => trans('admin.sInfoThousands'),
//            'sLoadingRecords' => trans('admin.sLoadingRecords'),
//            'oPaginate' => [
//                'sFirst' => trans('admin.sFirst'),
//                'sLast' => trans('admin.sLast'),
//                'sNext' => trans('admin.sNext'),
//                'sPrevious' => trans('admin.sPrevious'),
//            ],
//            'oAria' => [
//                'sSortAscending' => trans('admin.sSortAscending'),
//                'sSortDescending' => trans('admin.sSortDescending'),
//            ],
//        ];
//        return response()->json($langJson);
//    });

    /**************************** this route for change language *******************************/
    Route::get('lang/{lang}',function ($lang){
       session()->has('lang') ? session()->forget('lang') : '';
       $lang == 'ar' ? session()->put('lang','ar') : session()->put('lang','en');
       return back();
    });

});
