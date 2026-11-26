<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index()
    {

        // 1. Menghitung jumlah total lowongan aktif milik penyedia (misal berdasarkan id user yang login)

        $jumlahLowongan = DB::table('lowongans')->where('status', 'aktif')->count();

        // 2. Menghitung jumlah total pelamar yang masuk ke lowongan tersebut

        $jumlahPelamar = DB::table('applicants')->count();

        // 3. Kirim data angka tersebut ke view Blade dashboard

        return view('Recruiter.dashboard-penyedia', compact('jumlahLowongan', 'jumlahPelamar'));

    }
}
