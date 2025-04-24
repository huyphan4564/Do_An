<?php

Route::group(['prefix' => '/sliders', 'middleware' => 'isLogin'], function() {
    Route::get('/','App\Http\Controllers\SildersController@getViewSliders');
    Route::put('/', 'App\Http\Controllers\SildersController@putSliders');
    Route::delete('/', 'App\Http\Controllers\SildersController@deleteSliders');
    Route::post('/', 'App\Http\Controllers\SildersController@postSliders');

    Route::group(['prefix' => '/{id_slide}', 'middleware' => 'isLogin'], function (){
        Route::get('/', 'App\Http\Controllers\SildersController@getViewSlidersCT');
        Route::put('/', 'App\Http\Controllers\SildersController@putSlidersCT');
        Route::delete('/', 'App\Http\Controllers\SildersController@deleteSlidersCT');
        Route::post('/', 'App\Http\Controllers\SildersController@postSlidersCT');
    });
});

Route::group(['prefix' => '/cai-dat', 'middleware' => 'isLogin'], function (){

    Route::get('/','App\Http\Controllers\CaiDatController@getViewCaiDat');
    Route::put('/','App\Http\Controllers\CaiDatController@putCaiDat');
    Route::post('/','App\Http\Controllers\CaiDatController@postCaiDat');
    Route::delete('/','App\Http\Controllers\CaiDatController@deleteCaiDat');

    Route::group(['prefix' => '/website', 'middleware' => 'isLogin'], function (){
        Route::get('/', 'App\Http\Controllers\CaiDatController@getViewCaiDatWebsite');
        Route::post('/', 'App\Http\Controllers\CaiDatController@postCaiDatWebsite');
    });

    Route::group(['prefix' => '/giao-dien', 'middleware' => 'isLogin'], function (){
        Route::get('/', 'App\Http\Controllers\CaiDatController@getViewCaiDatGiaoDien');
        Route::post('/', 'App\Http\Controllers\CaiDatController@postCaiDatGiaoDien');
    });

    Route::group(['prefix' => '/menu', 'middleware' => 'isLogin'], function (){
        Route::get('/', 'App\Http\Controllers\CaiDatController@getViewCaiDatMenu');
        Route::post('/', 'App\Http\Controllers\CaiDatController@postCaiDatMenu');
    });

    Route::group(['prefix' => '/redirect', 'middleware' => 'isLogin'], function (){
        Route::get('/', 'App\Http\Controllers\RedirectController@getRedirect');
        Route::put('/', 'App\Http\Controllers\RedirectController@putRedirect');
        Route::post('/', 'App\Http\Controllers\RedirectController@postRedirect');
        Route::delete('/', 'App\Http\Controllers\RedirectController@deleteRedirect');
    });

    Route::group(['prefix' => '/backup', 'middleware' => 'isLogin'], function (){
        Route::get('/', 'App\Http\Controllers\CaiDatController@getViewBackup');
        Route::post('/', 'App\Http\Controllers\CaiDatController@postBackup');
        Route::post('/run', 'App\Http\Controllers\CaiDatController@runBackup');


    });




});
