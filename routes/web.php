<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Recruiter\DashboardController;
use App\Http\Controllers\Recruiter\RecruiterJobController;
use App\Http\Controllers\Seeker\LowonganDetailController;

Route::get('/buat-lowongan', function () {
    return view('Recruiter.buat-lowongan');
})->name('buat-lowongan');
Route::get('/profil-pelamar', function () {
    return view('Recruiter.profil-pelamar');
});
Route::get('/', function () {
    return view('welcome');
});
Route::get('/updatewawancara', function () {
    return view('Seeker.updatewawancara');
});

// Punya temanmu (kelola lowongan)
Route::get('/dashboard-penyedia', [DashboardController::class, 'index'])->name('dashboard-penyedia');
Route::get('/lowongan-saya', [RecruiterJobController::class, 'index'])->name('lowongan-saya');
Route::get('/lowongan-saya/detail-kasir', [RecruiterJobController::class, 'showDetail'])->name('recruiter.job.detail');
Route::put('/lowongan-saya/update-kasir', [RecruiterJobController::class, 'update'])->name('recruiter.job.update');
Route::delete('/lowongan-saya/delete-kasir', [RecruiterJobController::class, 'destroy'])->name('recruiter.job.delete');

// US-05: detail lowongan untuk pencari kerja (tanpa login)
Route::get('/lowongan/{id}', [LowonganDetailController::class, 'show'])->name('lowongan.show');

// US-03: profil
Route::middleware('auth')->group(function () {
    Route::get('/profil', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profil/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profil', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profil/pengalaman', [ProfileController::class, 'storeExperience'])->name('profile.experience.store');
    Route::delete('/profil/pengalaman/{id}', [ProfileController::class, 'destroyExperience'])->name('profile.experience.destroy');
    Route::post('/profil/dokumen', [ProfileController::class, 'storeDocument'])->name('profile.document.store');
    Route::delete('/profil/dokumen/{id}', [ProfileController::class, 'destroyDocument'])->name('profile.document.destroy');
    Route::post('/logout', [ProfileController::class, 'logout'])->name('logout');
});