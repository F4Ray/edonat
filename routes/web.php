<?php

use App\Http\Controllers\DonaturController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\ProgramDonasiController;
use App\Http\Controllers\TransaksiController;
use App\Models\ProgramDonasi;
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

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('program_donasi', ProgramDonasiController::class);
Route::resource('donatur', DonaturController::class);
Route::resource('pengajuan', PengajuanController::class);
Route::group(['as' => 'pengajuan.'], function () {
    Route::put('luluskan/pengajuan/{id}', [PengajuanController::class, 'luluskan'])->name('luluskan');
});

Route::get('transaksi', [TransaksiController::class, 'index'])->name('transaksi');
Route::get('transaksi/distribusi', [TransaksiController::class, 'keluar'])->name('transaksi.distribusi');


Route::group(['as' => 'program_donasi.'], function () {
    Route::get('donasi/donatur/{id}', [ProgramDonasiController::class, 'donasi_donatur'])->name('donasi_donatur');
    Route::post('donasi/donatur/{id}', [ProgramDonasiController::class, 'store_donasi_donatur'])->name('store_donasi_donatur');
    Route::put('donasi/donatur/{id}/distribusi', [ProgramDonasiController::class, 'distribusi'])->name('distribusi');
});