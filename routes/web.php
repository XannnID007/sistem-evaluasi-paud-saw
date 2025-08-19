<?php

// routes/web.php - Updated routes dengan parameter key baru
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\SawController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Guru\HasilController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Guru\ProfileController;
use App\Http\Controllers\Admin\KriteriaController;
use App\Http\Controllers\Admin\PenilaianController;
use App\Http\Controllers\Admin\AlternatifController;
use App\Http\Controllers\Guru\DashboardController as GuruDashboard;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;

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

    // Kriteria Management - Updated dengan parameter key baru
    Route::get('kriteria', [KriteriaController::class, 'index'])->name('kriteria.index');
    Route::get('kriteria/create', [KriteriaController::class, 'create'])->name('kriteria.create');
    Route::post('kriteria', [KriteriaController::class, 'store'])->name('kriteria.store');
    Route::get('kriteria/{kriteria_id}/edit', [KriteriaController::class, 'edit'])->name('kriteria.edit');
    Route::put('kriteria/{kriteria_id}', [KriteriaController::class, 'update'])->name('kriteria.update');
    Route::delete('kriteria/{kriteria_id}', [KriteriaController::class, 'destroy'])->name('kriteria.destroy');

    // Subkriteria Routes - Updated dengan parameter key baru
    Route::get('kriteria/{kriteria_id}/subkriteria', [KriteriaController::class, 'subkriteria'])->name('kriteria.subkriteria');
    Route::post('kriteria/{kriteria_id}/subkriteria', [KriteriaController::class, 'storeSubkriteria'])->name('kriteria.subkriteria.store');
    Route::delete('subkriteria/{subdatakriteria_id}', [KriteriaController::class, 'destroySubkriteria'])->name('subkriteria.destroy');

    // Alternatif (Siswa) Management - Updated dengan parameter key baru
    Route::get('alternatif', [AlternatifController::class, 'index'])->name('alternatif.index');
    Route::get('alternatif/create', [AlternatifController::class, 'create'])->name('alternatif.create');
    Route::post('alternatif', [AlternatifController::class, 'store'])->name('alternatif.store');
    Route::get('alternatif/{alternatif_id}/edit', [AlternatifController::class, 'edit'])->name('alternatif.edit');
    Route::put('alternatif/{alternatif_id}', [AlternatifController::class, 'update'])->name('alternatif.update');
    Route::delete('alternatif/{alternatif_id}', [AlternatifController::class, 'destroy'])->name('alternatif.destroy');

    // Penilaian Management - Updated dengan parameter key baru
    Route::get('penilaian', [PenilaianController::class, 'index'])->name('penilaian.index');
    Route::get('penilaian/create', [PenilaianController::class, 'create'])->name('penilaian.create');
    Route::post('penilaian', [PenilaianController::class, 'store'])->name('penilaian.store');
    Route::get('penilaian/{alternatif_id}/edit', [PenilaianController::class, 'edit'])->name('penilaian.edit');
    Route::put('penilaian/{alternatif_id}', [PenilaianController::class, 'update'])->name('penilaian.update');

    // SAW Calculation
    Route::get('saw', [SawController::class, 'index'])->name('saw.index');
    Route::post('saw/proses', [SawController::class, 'proses'])->name('saw.proses');
    Route::get('saw/hasil', [SawController::class, 'hasil'])->name('saw.hasil');

    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/hasil-saw/pdf', [ReportController::class, 'cetakHasilSaw'])->name('hasil-saw.pdf');
        Route::get('/data-siswa/pdf', [ReportController::class, 'cetakDataSiswa'])->name('data-siswa.pdf');
        Route::get('/nilai-alternatif/pdf', [ReportController::class, 'cetakNilaiAlternatif'])->name('nilai-alternatif.pdf');
        Route::get('/matriks-saw/pdf', [ReportController::class, 'cetakMatriksSaw'])->name('matriks-saw.pdf');
    });

    // User Management - Updated dengan parameter key baru
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::get('users/{user_id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{user_id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{user_id}', [UserController::class, 'destroy'])->name('users.destroy');
});

// Guru Routes
Route::middleware(['auth', 'guru'])->prefix('guru')->name('guru.')->group(function () {
    Route::get('/dashboard', [GuruDashboard::class, 'index'])->name('dashboard');

    // Hasil Penilaian
    Route::get('hasil', [HasilController::class, 'index'])->name('hasil.index');
    Route::get('hasil/export-pdf', [HasilController::class, 'exportHasilPdf'])->name('hasil.export-pdf');

    // Profile Management
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});
