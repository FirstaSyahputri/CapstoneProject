<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobPostingController;

Route::get('/buat-lowongan', function () {
    return view('Recruiter.buat-lowongan');
});
Route::get('/profil-pelamar', function () {
    return view('Recruiter.profil-pelamar');
});
Route::get('/', function () {
    return view('welcome');
});
Route::get('/updatewawancara', function () {
    return view('Seeker.updatewawancara');
});

// US-05: detail lowongan (tanpa login, supaya pencari kerja bisa melihat)
Route::get('/lowongan/{id}', [JobPostingController::class, 'show'])->name('lowongan.show');

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