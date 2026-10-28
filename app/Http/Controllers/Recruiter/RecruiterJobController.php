<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RecruiterJobController extends Controller
{
    public function index()
    {
        // Data dummy sementara buat ngecek tampilan mirip Figma
        $lowongans = [
            (object)[
                'nama_pekerjaan' => 'Kasir',
                'persyaratan' => 'Ijazah & SKCK',
                'icon' => 'fa-solid fa-cash-register'
            ],
            (object)[
                'nama_pekerjaan' => 'Satpam',
                'persyaratan' => 'Ijazah & SKCK',
                'icon' => 'fa-solid fa-user-shield'
            ],
            (object)[
                'nama_pekerjaan' => 'House Keeping',
                'persyaratan' => 'Ijazah & SKCK',
                'icon' => 'fa-solid fa-broom'
            ],
        ];

        return view('Recruiter.lowongan-saya', compact('lowongans'));
    }
    //dummy untuk detail lowongan kasir
    public function showDetail()
    {
        // Data dummy khusus Kasir untuk form detail/edit
        $job = [
            'nama' => 'Kasir',
            'deskripsi' => 'Melayani transaksi pembayaran pelanggan, mengelola kas tunai/non-tunai, dan mencatat laporan harian.',
            'syarat' => ['Ijazah', 'SKCK'],
            'batas_pelamar' => 5,
            'gaji' => 'Rp 3.500.000 - Rp 4.500.000'
        ];

        return view('Recruiter.detail-lowongan', compact('job'));
    }

    public function update(Request $request)
    {
        // Simulasi dummy update (Nanti tinggal diganti query database)
        return redirect()->route('dashboard-penyedia')->with('success', 'Perubahan lowongan berhasil disimpan!');
    }

    public function destroy()
    {
        // Simulasi dummy delete (Nanti tinggal diganti query database)
        return redirect()->route('dashboard-penyedia')->with('success', 'Lowongan berhasil dihapus!');
    }
}