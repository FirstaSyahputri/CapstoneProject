<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use App\Models\JobListing;
use App\Models\Application;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahLowongan = JobListing::where('status', true)->count();

        $daftarPelamar = Application::with([
            'applicant',
            'jobListing'
        ])
        ->latest()
        ->take(3)
        ->get();

        $jumlahPelamar = Application::count();

        return view(
            'Recruiter.dashboard-penyedia',
            compact(
                'jumlahLowongan',
                'jumlahPelamar',
                'daftarPelamar'
            )
        );
    }
}
