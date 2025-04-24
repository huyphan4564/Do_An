<?php

use App\Http\Controllers\FEController;
use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\FEController@getViewHome');
Route::get('/change-language', 'App\Http\Controllers\FEController@changeLocation');
Route::get('/danh-muc/{url}', 'App\Http\Controllers\FEController@danhMucCT');
Route::get('/{slug}', 'App\Http\Controllers\FEController@getViewBaiViet');
Route::get('/page/{slug}', 'App\Http\Controllers\FEController@trangCT');


