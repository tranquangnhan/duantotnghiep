<?php

use App\Http\Controllers\Admin\DanhMucController;
use App\Http\Controllers\Auth\LoginController;
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
    return view('welcome');
});

Route::get('/test',[\App\Http\Controllers\Admin\DanhMucController::class,'index']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/logout', [LoginController::class,'logout']);

Route::group(['prefix' => 'admin123','middleware'=>['auth','Admin']],function (){
    Route::resource('danhmuc', DanhMucController::class);
});