<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RuanganController;

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
Route::get('auth/google', [LoginController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback']);
Route::get('/', function () {
    return view('/home');
});
Route::resource('ruangan', RuanganController::class);
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [RuanganController::class, 'index'])->name('ruangan.index');
    Route::get('/ruangan/pinjam/{id}', [RuanganController::class, 'showPinjamForm'])->name('ruangan.pinjam');

    Route::middleware('role:admin')->group(function () {
        Route::get('/ruangan/create', [RuanganController::class, 'create'])->name('ruangan.create');
        Route::post('/ruangan', [RuanganController::class, 'store'])->name('ruangan.store');
        Route::get('/ruangan/{id}/edit', [RuanganController::class, 'edit'])->name('ruangan.edit');
        Route::put('/ruangan/{id}', [RuanganController::class, 'update'])->name('ruangan.update');
        Route::delete('/ruangan/{id}', [RuanganController::class, 'destroy'])->name('ruangan.destroy');
        Route::put('/ruangan/{id}/verify', [RuanganController::class, 'verify'])->name('ruangan.verify');
    });

    Route::middleware('role:mahasiswa')->group(function () {
        Route::get('/home', [HomeController::class, 'index'])->name('home');
        Route::post('/ruangan/pinjam/{id}', [RuanganController::class, 'storePinjam'])->name('ruangan.storePinjam');
        Route::get('/ruangan/{id}/book', [RuanganController::class, 'book'])->name('ruangan.book');
        Route::post('/ruangan/{id}/book', [RuanganController::class, 'processBooking'])->name('ruangan.processBooking');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
