<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use App\Models\JobListing;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class LowonganController extends Controller
{
    public function create(): View
    {
        return view('Recruiter.buat-lowongan');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'namaPekerjaan' => ['required', 'string', 'min:3', 'max:150'],
            'deskripsi' => ['required', 'string', 'min:10'],
            'alamat' => ['required', 'string', 'max:2000'],
            'kuota' => ['required', 'integer', 'min:1', 'max:1000'],
            'gaji' => ['required', 'string', 'max:100', 'regex:/\d/'],
            'status' => ['sometimes', 'accepted'],
            'dokumen' => ['required', 'array', 'min:1', 'max:10'],
            'dokumen.*' => ['required', 'string', 'min:1', 'max:30'],
        ], [
            'namaPekerjaan.required' => 'Nama pekerjaan wajib diisi.',
            'namaPekerjaan.min' => 'Nama pekerjaan minimal 3 karakter.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'deskripsi.min' => 'Deskripsi minimal 10 karakter.',
            'alamat.required' => 'Alamat wajib diisi.',
            'kuota.required' => 'Batas pelamar wajib diisi.',
            'kuota.integer' => 'Batas pelamar harus berupa bilangan bulat.',
            'kuota.min' => 'Minimal 1 pelamar.',
            'kuota.max' => 'Maksimal 1000 pelamar.',
            'gaji.required' => 'Rentang gaji wajib diisi.',
            'gaji.regex' => 'Gaji harus mengandung angka.',
            'dokumen.required' => 'Tambahkan minimal satu syarat dokumen.',
            'dokumen.min' => 'Tambahkan minimal satu syarat dokumen.',
            'dokumen.max' => 'Maksimal 10 syarat dokumen.',
            'dokumen.*.max' => 'Nama dokumen maksimal 30 karakter.',
        ]);

        $dokumen = collect($validated['dokumen'])
            ->map(fn ($nama) => trim($nama))
            ->filter(fn ($nama) => $nama !== '')
            ->values();

        if (
            $dokumen->isEmpty()
            || $dokumen->count() !== count($validated['dokumen'])
        ) {
            throw ValidationException::withMessages([
                'dokumen' => 'Semua nama dokumen harus diisi.',
            ]);
        }

        if ($dokumen->contains(fn ($nama) => mb_strlen($nama) > 30)) {
            throw ValidationException::withMessages([
                'dokumen' => 'Nama dokumen maksimal 30 karakter.',
            ]);
        }

        if (
            $dokumen->map(fn ($nama) => mb_strtolower($nama))
                ->unique()
                ->count() !== $dokumen->count()
        ) {
            throw ValidationException::withMessages([
                'dokumen' => 'Nama dokumen tidak boleh duplikat.',
            ]);
        }

        $recruiterId = \App\Models\User::query()->value('id');

        if (!$recruiterId) {
            abort(500, 'Belum ada data recruiter pada tabel users.');
        }

        DB::transaction(function () use (
            $validated,
            $dokumen,
            $recruiterId,
            $request
        ) {
            $lowongan = JobListing::create([
                'recruiter_id' => $recruiterId,
                'title' => trim($validated['namaPekerjaan']),
                'description' => trim($validated['deskripsi']),
                'address' => trim($validated['alamat']),
                'quota' => (int) $validated['kuota'],
                'salary' => trim($validated['gaji']),
                'status' => $request->boolean('status'),
            ]);

            $lowongan->syaratDokumen()->createMany(
                $dokumen->map(fn ($nama) => [
                    'nama_dokumen' => $nama,
                ])->all()
            );
        });

        return redirect()
            ->route('recruiter.lowongan.index')
            ->with('success', 'Lowongan berhasil disimpan.');
    }
}
