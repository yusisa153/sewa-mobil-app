<?php

use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index']);

Route::post('/tambahData', [HomeController::class, 'tambahData']);

Route::get('/hapusData/{id}', [HomeController::class, 'hapusData']);

Route::get('/master', function () {
    return view('layout.master');
});

Route::get('/peminjaman', [HomeController::class, 'peminjaman']);
Route::get('/ambilDataPeminjaman', [HomeController::class, 'ambilDataPeminjaman']);

Route::post('/storePeminjaman', [HomeController::class, 'storePeminjaman']);

Route::get('/pengembalian', [HomeController::class, 'pengembalian']);

Route::post('/storePengembalian', [HomeController::class, 'storePengembalian']);