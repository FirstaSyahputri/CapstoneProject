<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;

class PelamarController extends Controller
{
    public function index()
    {
        $applications = Application::with([
            'applicant',
            'jobListing',
        ])
            ->latest()
            ->paginate(10);

        return view(
            'Recruiter.daftar-pelamar',
            compact('applications')
        );
    }

    public function show(Application $application)
    {
        $application->load([
            'applicant.experiences',
            'documents',
            'jobListing',
        ]);

        return view(
            'Recruiter.profil-pelamar',
            compact('application')
        );
    }
}