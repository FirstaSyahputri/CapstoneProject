<?php

use Illuminate\Support\Facades\Route;

Route::get('/buat-lowongan', function () {
    return view('interviews.buat-lowongan');
});
Route::get('/profil-pelamar', function () {
    return view('interviews.profil-pelamar');
});
Route::get('/', function () {
    return view('welcome');
});