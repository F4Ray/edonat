<?php

use App\Http\Controllers\ProgramDonasiController;
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

Route::group(['as' => 'program_donasi.'], function () {
    Route::get('donasi/donatur/{id}', [ProgramDonasiController::class, 'donasi_donatur'])->name('donasi_donatur');
    Route::post('donasi/donatur/{id}', [ProgramDonasiController::class, 'store_donasi_donatur'])->name('store_donasi_donatur');
});