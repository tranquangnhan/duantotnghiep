<?php

use App\Http\Controllers\Admin\ChamCongController;
use App\Http\Controllers\Admin\DanhMucController;
use App\Http\Controllers\Admin\DichvuController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\NhansuController;
use App\Http\Controllers\Admin\SuKienController;
use App\Http\Controllers\Admin\CosoController;
use App\Http\Controllers\Admin\LichlamviecController;
use App\Models\admin\ChamCongModel;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/admin/dangnhapadmin', [\App\Http\Controllers\DangnhapAdminController::class, 'login']);
Route::get('/admin/logout', [\App\Http\Controllers\DangnhapAdminController::class, 'logout']);
Route::post('/admin/dangnhapadmin', [\App\Http\Controllers\DangnhapAdminController::class, 'checkin']);

Route::group(['prefix' => 'quantri', 'middleware' => 'adminLogin'], function (){
    Route::get('/', [\App\Http\Controllers\DangnhapAdminController::class, 'index']);
    Route::resource('danhmuc', DanhMucController::class);

    Route::resource('dichvu', DichvuController::class);
    Route::post('dichvu/{id}', [DichvuController::class, 'update']);

    Route::resource('chamcong', ChamCongController::class);
    Route::group(['prefix' => 'chamcong'], function (){
        Route::get('/cuatoi/{id}', [ChamCongController::class, 'chamcongcuatoi']);
    });
    Route::resource('sukien', SuKienController::class);
    Route::get('/getSuKien', [SuKienController::class, 'getSukien']);
    Route::post('sukien/action', [SuKienController::class, 'action']);


    Route::resource('nhansu', NhansuController::class);
    Route::post('nhansu/{id}', [NhansuController::class, 'update']);
    Route::get('getNhanSu/{id}', [NhansuController::class, 'LongGetNhanSu']);

    Route::resource('coso', CosoController::class);
    Route::get('/delivery', [CosoController::class,'create']);
    Route::post('/select-dellivery', [CosoController::class,'select_dellivery']);
    Route::post('/add-dellivery', [CosoController::class,'add_dellivery']);
    Route::post('/update', [CosoController::class,'update']);

    Route::resource('/lichlamviec', LichlamviecController::class);
});
