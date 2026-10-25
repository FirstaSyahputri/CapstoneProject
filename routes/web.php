<?php

use Illuminate\Support\Facades\Route;

Route::get('/buat-lowongan', function () {
    return view('Recruiter.buat-lowongan');
});
Route::get('/profil-pelamar', function () {
    return view('Recruiter.profil-pelamar');
});
Route::get('/', function () {
    return view('welcome');
});