<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagsController;

Route::group(['prefix' => '/tin-tuc', 'middleware' => 'isLogin'], function() {
    Route::get('/', 'App\Http\Controllers\TinTucController@getViewDanhSach');
    Route::get('/thong-ke', 'App\Http\Controllers\TinTucController@getViewThongKe');
    Route::get('/them','App\Http\Controllers\TinTucController@getViewThem');
    Route::put('/them', 'App\Http\Controllers\TinTucController@putTinTuc');
    Route::get('/{id_tin_tuc}/cap-nhat', 'App\Http\Controllers\TinTucController@getViewCapNhat');
    Route::post('/cap-nhat', 'App\Http\Controllers\TinTucController@postTinTuc');
    Route::delete('/', 'App\Http\Controllers\TinTucController@deleteTinTuc');
});

Route::group(['prefix' => '/danh-muc', 'middleware' => 'isLogin'], function() {
    Route::get('/', 'App\Http\Controllers\DanhMucController@getViewDanhSach');
    Route::get('/them', 'App\Http\Controllers\DanhMucController@getViewThem');
    Route::put('/them', 'App\Http\Controllers\DanhMucController@putDanhMuc');
    Route::get('/{id_danh_muc}/cap-nhat', 'App\Http\Controllers\DanhMucController@getViewCapNhat');
    Route::post('/cap-nhat', 'App\Http\Controllers\DanhMucController@postDanhMuc');
    Route::delete('/', 'App\Http\Controllers\DanhMucController@deleteDanhMuc');
});

Route::group(['prefix' => '/tags', 'middleware' => 'isLogin'], function() {
    Route::get('/', 'App\Http\Controllers\TagsController@getViewDanhSach');
    Route::get('/them', 'App\Http\Controllers\TagsController@getViewThem');
    Route::put('/them', 'App\Http\Controllers\TagsController@putTag');
    Route::get('/{id_tag}/cap-nhat', 'App\Http\Controllers\TagsController@getViewCapNhat');
    Route::post('/cap-nhat', 'App\Http\Controllers\TagsController@postTag');
    Route::delete('/', 'App\Http\Controllers\TagsController@deleteTag');
});

Route::group(['prefix' => '/page', 'middleware' => 'isLogin'], function() {
    Route::get('/', 'App\Http\Controllers\PageController@getViewDanhSach');
    Route::get('/them','App\Http\Controllers\PageController@getViewThem');
    Route::put('/them', 'App\Http\Controllers\PageController@putPage');
    Route::get('/{id_pages}/cap-nhat', 'App\Http\Controllers\PageController@getViewCapNhat');
    Route::post('/cap-nhat', 'App\Http\Controllers\PageController@postPage');
    Route::delete('/', 'App\Http\Controllers\PageController@deletePage');
});

Route::group(['prefix' => '/hooks', 'middleware' => 'isLogin'], function() {
    Route::get('/', 'App\Http\Controllers\HookController@getViewDanhSach');
    Route::put('/', 'App\Http\Controllers\HookController@putHook');
    Route::post('/', 'App\Http\Controllers\HookController@postHook');
    Route::delete('/', 'App\Http\Controllers\HookController@deleteHook');
});

