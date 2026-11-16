<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\OperasionalController;
use Illuminate\Support\Facades\Route;

// Halaman Utama (Visitor)
Route::get('/', fn () => view('welcome'))->name('home');

// Autentikasi Mahasiswa
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Area Mahasiswa (Wajib Login & Role Mahasiswa)
Route::middleware(['auth', 'role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('/dashboard', [BookingController::class, 'dashboard'])->name('dashboard');
    Route::get('/pilih-unit', [BookingController::class, 'pilihUnit'])->name('pilih_unit');
    Route::get('/pilih-jadwal', [BookingController::class, 'pilihJadwal'])->name('pilih_jadwal');
    Route::get('/konfirmasi', [BookingController::class, 'konfirmasi'])->name('konfirmasi');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
});

// Autentikasi & Area Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', fn () => redirect()->route('admin.login'));
    Route::get('/login', [AuthController::class, 'showAdminLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'adminLogin'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'adminLogout'])->name('logout');

    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/approval', [OperasionalController::class, 'approval'])->name('approval');
        Route::post('/approval/{id}/approve', [OperasionalController::class, 'approve'])->name('approval.approve');
        Route::post('/approval/{id}/reject', [OperasionalController::class, 'reject'])->name('approval.reject');
        Route::get('/history', [OperasionalController::class, 'history'])->name('history');
        Route::get('/history/export', [OperasionalController::class, 'exportHistory'])->name('history.export');
        Route::get('/history/export-xlsx', [OperasionalController::class, 'exportHistory'])->name('history.export_xlsx');
    });
});