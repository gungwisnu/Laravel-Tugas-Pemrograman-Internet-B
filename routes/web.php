<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\MahasiswaController;

Route::get('/', function () {
    return view('welcome');
});

// Route sederhana
Route::get('/hello', function () {
    return 'Hello Laravel!';
});

// Route pakai controller
Route::get('/hello-controller', [HelloController::class, 'index']);

// Route pencarian
Route::get('/mahasiswa/search', [MahasiswaController::class, 'search'])->name('mahasiswa.search');

// Route konfirmasi hapus
Route::get('/mahasiswa/{mahasiswa}/confirm-delete', [MahasiswaController::class, 'confirmDelete'])
    ->name('mahasiswa.confirmDelete');

// Route resource utama (otomatis generate CRUD)
Route::resource('mahasiswa', MahasiswaController::class);