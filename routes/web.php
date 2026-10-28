<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicantController;

Route::get('/buat-lowongan', function () {
    return view('Recruiter.buat-lowongan');
});
Route::get('/profil-pelamar', function () {
    return view('Recruiter.profil-pelamar');
});
Route::get('/daftar-pelamar', [ApplicantController::class, 'index'])
    ->name('recruiter.pelamar');
Route::get('/', function () {
    return view('welcome');
});