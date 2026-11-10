<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome'))->name('home');
Route::get('/login', fn () => view('auth.login'))->name('login');
Route::post('/login', fn () => redirect()->route('mahasiswa.dashboard'));

Route::prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('/dashboard', fn () => view('mahasiswa.dashboard'))->name('dashboard');
    Route::get('/pilih-unit', fn () => view('mahasiswa.pilih_unit'))->name('pilih_unit');
    Route::get('/pilih-jadwal', fn () => view('mahasiswa.pilih_jadwal'))->name('pilih_jadwal');
    Route::get('/konfirmasi', fn () => view('mahasiswa.konfirmasi'))->name('konfirmasi');
});