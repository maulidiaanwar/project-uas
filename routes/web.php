<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\guruController;
use App\Http\Controllers\Admin\kelasController;
use App\Http\Controllers\Admin\RuangController;
use App\Http\Controllers\Admin\siswaController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

// grup route untuk admin
Route::prefix('admin')->group(function(){
    // route untuk auth
    Route::group(['middleware' => 'auth'], function(){
    // buat route untuk dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');
    //route untuk data guru
    Route::resource('/guru',guruController::class,['as'=>'admin']);
    //route untuk data guru
    Route::resource('/siswa',SiswaController::class,['as'=>'admin']);
    //route untuk data ruang
    Route::resource('/ruang',RuangController::class,['as'=>'admin']);
    });
});

