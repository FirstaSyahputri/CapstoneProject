<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Recruiter\DashboardController;
use App\Http\Controllers\Recruiter\RecruiterJobController;

Route::get('/buat-lowongan', function () {
    return view('Recruiter.buat-lowongan');
})->name('buat-lowongan');
Route::get('/profil-pelamar', function () {
    return view('Recruiter.profil-pelamar');
});
Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard-penyedia', [DashboardController::class, 'index'])->name('dashboard-penyedia');
Route::get('/lowongan-saya', [RecruiterJobController::class, 'index'])->name('lowongan-saya');
Route::get('/lowongan-saya/detail-kasir', [RecruiterJobController::class, 'showDetail'])->name('recruiter.job.detail');
// Simulasi dummy untuk simpan (update) dan hapus (delete)
Route::put('/lowongan-saya/update-kasir', [RecruiterJobController::class, 'update'])->name('recruiter.job.update');
Route::delete('/lowongan-saya/delete-kasir', [RecruiterJobController::class, 'destroy'])->name('recruiter.job.delete');