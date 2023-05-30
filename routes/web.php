<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IdentitasPpsController;
use App\Http\Controllers\KlasifikasiArsipController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('klasifikasi-arsip', KlasifikasiArsipController::class);
    Route::get('identitas-pps', [IdentitasPpsController::class, 'index'])->name('identitas-pps.index');
    Route::get('create', [IdentitasPpsController::class, 'create'])->name('identitas-pps.create');
    Route::get('get-kota', [IdentitasPpsController::class, 'get_kota'])->name('get.kota');
    Route::get('get-kecamatan', [IdentitasPpsController::class, 'get_kecamatan'])->name('get.kecamatan');
    Route::get('get-kelurahan', [IdentitasPpsController::class, 'get_kelurahan'])->name('get.kelurahan');
    });
