<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome'))->name('home');
Route::get('/login', fn () => view('auth.login'))->name('login');
Route::post('/login', fn () => redirect()->route('mahasiswa.dashboard'));
Route::post('/logout', fn () => redirect()->route('home'))->name('logout');

Route::prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('/dashboard', fn () => view('mahasiswa.dashboard'))->name('dashboard');
    Route::get('/pilih-unit', fn () => view('mahasiswa.pilih_unit'))->name('pilih_unit');
    Route::get('/pilih-jadwal', fn () => view('mahasiswa.pilih_jadwal'))->name('pilih_jadwal');
    Route::get('/konfirmasi', fn () => view('mahasiswa.konfirmasi'))->name('konfirmasi');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', fn () => view('admin.login'))->name('login');
    Route::post('/login', fn () => redirect()->route('admin.approval'))->name('login.submit');
    Route::post('/logout', fn () => redirect()->route('admin.login'))->name('logout');

    Route::get('/approval', fn () => view('admin.approval'))->name('approval');
    Route::get('/history', fn () => view('admin.history'))->name('history');
});