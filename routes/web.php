<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TinTucController;
use App\Http\Controllers\DanhMucController;
use App\Http\Controllers\TagsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/auth/login','App\Http\Controllers\TaiKhoanController@getViewDangNhap');
Route::get('/auth/login/google','App\Http\Controllers\TaiKhoanController@gotoGoogleLogin');
Route::get('/auth/login/google/callback','App\Http\Controllers\TaiKhoanController@callbackGoogleLogin');
Route::get('/auth/logout','App\Http\Controllers\TaiKhoanController@dangXuat');

Route::group(['prefix' => '/auth', 'middleware' => 'isLogin'], function() {
    Route::get('/', 'App\Http\Controllers\AuthController@AuthPage');

    Route::group(['prefix' => '/tai-khoan', 'middleware' => 'isLogin'], function() {
        Route::get('/', 'App\Http\Controllers\TaiKhoanController@getViewDSTaiKhoan');
        Route::put('/', 'App\Http\Controllers\TaiKhoanController@putTaiKhoan');
        Route::post('/', 'App\Http\Controllers\TaiKhoanController@postTaiKhoan');
        Route::delete('/', 'App\Http\Controllers\TaiKhoanController@deleteTaiKhoan');
    });

    # Router của Hoàng Huy
    require_once 'hoanghuy.php';


    # Router của Tấn Phát
    require_once 'tanphat.php';
});

Route::get('/a', function (){
    return redirect()->to(asset('a.txt'));
});

# Router của Xuân đi
require_once 'xuandi.php';
