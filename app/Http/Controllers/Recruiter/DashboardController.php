<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index()
    {

        $jumlahLowongan = DB::table('lowongans')->where('status', 'aktif')->count();

        $jumlahPelamar = DB::table('applicants')->count();

        return view('Recruiter.dashboard-penyedia', compact('jumlahLowongan', 'jumlahPelamar'));

    }
}