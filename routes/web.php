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
Route::post('/store', [DiagnosaController::class, 'store'])->name('diagnosa.save');

Route::get('/gejala', [GejalaController::class, 'index'])->name('gejala');
Route::get('/tambah', [GejalaController::class, 'tambah'])->name('gejala.add');
Route::post('/store', [GejalaController::class, 'store'])->name('gejala.save');
Route::get('/search', [GejalaController::class, 'search'])->name('gejala.search');
Route::get('/edit/{id}', [GejalaController::class, 'edit'])->name('gejala.edit');
Route::put('/update/{id}', [GejalaController::class, 'update'])->name('gejala.update');
Route::delete('/delete/{id}', [GejalaController::class, 'delete'])->name('gejala.delete');

Route::get('/password', [PasswordController::class, 'index'])->name('password');


Route::get('/pengetahuan', [PengetahuanController::class, 'index'])->name('pengetahuan');
Route::get('/tambah', [PengetahuanController::class, 'tambah'])->name('pengetahuan.add');
Route::post('/store', [PengetahuanController::class, 'store'])->name('pengetahuan.save');
Route::get('/search', [PengetahuanController::class, 'search'])->name('pengetahuan.search');
Route::get('/edit/{id}', [PengetahuanController::class, 'edit'])->name('pengetahuan.edit');
Route::put('/update/{id}', [PengetahuanController::class, 'update'])->name('pengetahuan.update');
Route::delete('/delete/{id}', [PengetahuanController::class, 'delete'])->name('pengetahuan.delete');


Route::get('/penyakit', [PenyakitController::class, 'index'])->name('penyakit');
Route::get('/tambah', [PenyakitController::class, 'tambah'])->name('penyakit.add');
Route::post('/store', [PenyakitController::class, 'store'])->name('penyakit.save');
Route::get('/search', [PenyakitController::class, 'search'])->name('penyakit.search');
Route::get('/edit/{id}', [PenyakitController::class, 'edit'])->name('penyakit.edit');
Route::put('/update/{id}', [PenyakitController::class, 'update'])->name('penyakit.update');
Route::delete('/delete/{id}', [PenyakitController::class, 'delete'])->name('penyakit.delete');


Route::get('/post', [PostController::class, 'index'])->name('post');


Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat');
