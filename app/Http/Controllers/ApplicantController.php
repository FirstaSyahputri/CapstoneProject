<?php

namespace App\Http\Controllers;

class ApplicantController extends Controller
{
    /**
     * US-11: Meninjau pelamar.
     * Versi awal memakai data contoh. Ganti dengan query database
     * setelah tabel jobs dan applications dari teman tersedia.
     */
    public function index()
    {
        $applications = collect([
            ['id' => 1, 'name' => 'Budi Santoso',  'email' => 'budi@mail.com',  'photo' => null, 'status' => 'pending',   'job_title' => 'Office Boy'],
            ['id' => 2, 'name' => 'Siti Aminah',   'email' => 'siti@mail.com',  'photo' => null, 'status' => 'interview', 'job_title' => 'Satpam'],
            ['id' => 3, 'name' => 'Andi Wijaya',   'email' => 'andi@mail.com',  'photo' => null, 'status' => 'rejected',  'job_title' => 'Pegawai Kafe'],
            ['id' => 4, 'name' => 'Dewi Lestari',  'email' => 'dewi@mail.com',  'photo' => null, 'status' => 'accepted',  'job_title' => 'Pegawai Kafe'],
            ['id' => 5, 'name' => 'Rudi Hartono',  'email' => 'rudi@mail.com',  'photo' => null, 'status' => 'pending',   'job_title' => 'Satpam'],
        ])->map(fn ($a) => (object) $a);

        return view('Recruiter.daftar-pelamar', compact('applications'));
    }

    /*
     * VERSI DATABASE (pakai setelah migration jobs dan applications ada):
     *
     * use App\Models\Application;
     *
     * $applications = Application::with(['applicant:id,name,email,photo', 'job:id,title'])
     *     ->whereHas('job', fn ($q) => $q->where('owner_id', auth()->id()))
     *     ->latest()
     *     ->get()
     *     ->map(fn ($a) => (object) [
     *         'id'        => $a->id,
     *         'name'      => $a->applicant->name,
     *         'email'     => $a->applicant->email,
     *         'photo'     => $a->applicant->photo,
     *         'status'    => $a->status,
     *         'job_title' => $a->job->title,
     *     ]);
     *
     * Dengan memetakan ke objek yang sama, file view tidak perlu diubah.
     */
}
