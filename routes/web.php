<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\KriteriaController;
use App\Http\Controllers\Admin\AlternatifController;
use App\Http\Controllers\Admin\PenilaianController;
use App\Http\Controllers\Admin\SawController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Guru\DashboardController as GuruDashboard;
use App\Http\Controllers\Guru\HasilController;
use App\Http\Controllers\Guru\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirect root to login
Route::get('/', function () {
    return redirect('/login');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    // Kriteria Management - Explicit routes untuk debugging
    Route::get('kriteria', [KriteriaController::class, 'index'])->name('kriteria.index');
    Route::get('kriteria/create', [KriteriaController::class, 'create'])->name('kriteria.create');
    Route::post('kriteria', [KriteriaController::class, 'store'])->name('kriteria.store');
    Route::get('kriteria/{kriteria}/edit', [KriteriaController::class, 'edit'])->name('kriteria.edit');
    Route::put('kriteria/{kriteria}', [KriteriaController::class, 'update'])->name('kriteria.update');
    Route::delete('kriteria/{kriteria}', [KriteriaController::class, 'destroy'])->name('kriteria.destroy');

    // Subkriteria Routes
    Route::get('kriteria/{kriteria}/subkriteria', [KriteriaController::class, 'subkriteria'])->name('kriteria.subkriteria');
    Route::post('kriteria/{kriteria}/subkriteria', [KriteriaController::class, 'storeSubkriteria'])->name('kriteria.subkriteria.store');
    Route::delete('subkriteria/{subkriteria}', [KriteriaController::class, 'destroySubkriteria'])->name('subkriteria.destroy');

    // Alternatif (Siswa) Management
    Route::resource('alternatif', AlternatifController::class);

    // Penilaian Management
    Route::get('penilaian', [PenilaianController::class, 'index'])->name('penilaian.index');
    Route::get('penilaian/create', [PenilaianController::class, 'create'])->name('penilaian.create');
    Route::post('penilaian', [PenilaianController::class, 'store'])->name('penilaian.store');
    Route::get('penilaian/{alternatif}/edit', [PenilaianController::class, 'edit'])->name('penilaian.edit');
    Route::put('penilaian/{alternatif}', [PenilaianController::class, 'update'])->name('penilaian.update');

    // SAW Calculation
    Route::get('saw', [SawController::class, 'index'])->name('saw.index');
    Route::post('saw/proses', [SawController::class, 'proses'])->name('saw.proses');
    Route::get('saw/hasil', [SawController::class, 'hasil'])->name('saw.hasil');

    // User Management
    Route::resource('users', UserController::class);
});

// Guru Routes
Route::middleware(['auth', 'guru'])->prefix('guru')->name('guru.')->group(function () {
    Route::get('/dashboard', [GuruDashboard::class, 'index'])->name('dashboard');

    // Hasil Penilaian
    Route::get('hasil', [HasilController::class, 'index'])->name('hasil.index');

    // Profile Management
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});
