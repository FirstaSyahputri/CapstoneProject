<?php

namespace App\Http\Controllers\Seeker;

use App\Http\Controllers\Controller;
use App\Models\Lowongan;
use App\Models\User;

class LowonganDetailController extends Controller
{
    public function show($id)
    {
        $job = Lowongan::find($id);

        // Data kosong: tampilkan halaman "tidak ditemukan"
        if (!$job) {
            return response()->view('Seeker.detail-lowongan-pencari', ['job' => null, 'owner' => null], 404);
        }

        $owner = $job->recruiter_id ? User::find($job->recruiter_id) : null;

        return view('Seeker.detail-lowongan-pencari', compact('job', 'owner'));
    }
}