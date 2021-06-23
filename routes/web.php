<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DiagnosaController;
use App\Http\Controllers\GejalaController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PengetahuanController;
use App\Http\Controllers\PenyakitController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RiwayatController;

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
    return view('index');
});

Auth::routes();

Route::get('/admin', [DashboardAdminController::class, 'index'])->name('db.admin');

Route::get('/diagnosa', [DiagnosaController::class, 'index'])->name('diagnosa');
Route::get('/tambah', [DiagnosaController::class, 'tambah'])->name('diagnosa.add');
Route::get('/store', [DiagnosaController::class, 'store'])->name('diagnosa.save');

Route::get('/gejala', [GejalaController::class, 'index'])->name('gejala');
Route::get('/tambah', [GejalaController::class, 'tambah'])->name('gejala.add');
Route::get('/store', [GejalaController::class, 'store'])->name('gejala.save');

Route::get('/password', [PasswordController::class, 'index'])->name('password');

Route::get('/pengetahuan', [PengetahuanController::class, 'index'])->name('pengetahuan');

Route::get('/penyakit', [PenyakitController::class, 'index'])->name('penyakit');

Route::get('/post', [PostController::class, 'index'])->name('post');

Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat');
