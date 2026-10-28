<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use App\Models\JobListing;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RecruiterJobController extends Controller
{
    public function index(): View
    {
        $lowongans = JobListing::with('syaratDokumen')
            ->latest()
            ->get();

        return view('Recruiter.lowongan-saya', compact('lowongans'));
    }

    public function showDetail(int $jobListing): View
    {
        $job = JobListing::with('syaratDokumen')
            ->findOrFail($jobListing);

        return view('Recruiter.detail-lowongan', compact('job'));
    }

    public function update(
        Request $request,
        int $jobListing
    ): JsonResponse|RedirectResponse {
        // Ambil lowongan beserta syarat dokumennya.
        $job = JobListing::with('syaratDokumen')
            ->findOrFail($jobListing);

        // Validasi menggunakan nama input dari form Blade.
        $validated = $request->validate([
            'namaPekerjaan' => [
                'required',
                'string',
                'min:3',
                'max:150',
            ],
            'deskripsi' => [
                'required',
                'string',
                'min:10',
            ],
            'alamat' => [
                'required',
                'string',
                'max:2000',
            ],
            'kuota' => [
                'required',
                'integer',
                'min:1',
                'max:1000',
            ],
            'gaji' => [
                'required',
                'string',
                'max:100',
                'regex:/\d/',
            ],
            'status' => [
                'sometimes',
                'boolean',
            ],
            'dokumen' => [
                'required',
                'array',
                'min:1',
                'max:10',
            ],
            'dokumen.*' => [
                'required',
                'string',
                'min:1',
                'max:30',
            ],
        ], [
            'namaPekerjaan.required' =>
                'Nama pekerjaan wajib diisi.',
            'namaPekerjaan.min' =>
                'Nama pekerjaan minimal 3 karakter.',
            'deskripsi.required' =>
                'Deskripsi pekerjaan wajib diisi.',
            'deskripsi.min' =>
                'Deskripsi pekerjaan minimal 10 karakter.',
            'alamat.required' =>
                'Alamat pekerjaan wajib diisi.',
            'kuota.required' =>
                'Batas maksimal pelamar wajib diisi.',
            'kuota.integer' =>
                'Batas pelamar harus berupa bilangan bulat.',
            'kuota.min' =>
                'Minimal batas pelamar adalah 1.',
            'kuota.max' =>
                'Maksimal batas pelamar adalah 1000.',
            'gaji.required' =>
                'Rentang gaji wajib diisi.',
            'gaji.regex' =>
                'Rentang gaji harus mengandung angka.',
            'dokumen.required' =>
                'Tambahkan minimal satu syarat dokumen.',
            'dokumen.min' =>
                'Minimal satu syarat dokumen harus tersedia.',
            'dokumen.max' =>
                'Maksimal 10 syarat dokumen.',
            'dokumen.*.required' =>
                'Nama dokumen tidak boleh kosong.',
            'dokumen.*.max' =>
                'Nama dokumen maksimal 30 karakter.',
        ]);

        // Bersihkan nama dokumen.
        $dokumen = collect($validated['dokumen'])
            ->map(fn ($nama) => trim($nama))
            ->values();

        // Tolak dokumen yang kosong setelah spasi dibuang.
        if ($dokumen->contains(fn ($nama) => $nama === '')) {
            throw ValidationException::withMessages([
                'dokumen' => 'Nama dokumen tidak boleh kosong.',
            ]);
        }

        // Periksa ulang panjang nama setelah trim.
        if ($dokumen->contains(
            fn ($nama) => mb_strlen($nama) > 30
        )) {
            throw ValidationException::withMessages([
                'dokumen' => 'Nama dokumen maksimal 30 karakter.',
            ]);
        }

        // Nama dokumen tidak boleh duplikat.
        $namaDokumenUnik = $dokumen
            ->map(fn ($nama) => mb_strtolower($nama))
            ->unique()
            ->count();

        if ($namaDokumenUnik !== $dokumen->count()) {
            throw ValidationException::withMessages([
                'dokumen' => 'Nama dokumen tidak boleh duplikat.',
            ]);
        }

        // Petakan nama input form ke kolom database.
        DB::transaction(function () use (
            $job,
            $validated,
            $dokumen,
            $request
        ) {
            $job->update([
                'title' => trim($validated['namaPekerjaan']),
                'description' => trim($validated['deskripsi']),
                'address' => trim($validated['alamat']),
                'quota' => (int) $validated['kuota'],
                'salary' => trim($validated['gaji']),
                // Checkbox yang tidak dicentang akan menjadi false.
                'status' => $request->boolean('status'),
            ]);

            // Sinkronkan dokumen dengan isi form terbaru.
            $job->syaratDokumen()->delete();

            $job->syaratDokumen()->createMany(
                $dokumen->map(fn ($nama) => [
                    'nama_dokumen' => $nama,
                ])->all()
            );
        });

        // Respons JSON untuk proses penyimpanan melalui JavaScript.
        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Perubahan lowongan berhasil disimpan!',
                'job' => $job->fresh()->load('syaratDokumen'),
            ]);
        }

        // Respons jika form dikirim tanpa AJAX.
        return redirect()
            ->route('recruiter.lowongan.show', [
                'jobListing' => $job->id,
            ])
            ->with(
                'success',
                'Perubahan lowongan berhasil disimpan!'
            );
    }

    public function destroy(
        Request $request,
        int $jobListing
    ): RedirectResponse {
        $recruiterId = $request->user()?->getAuthIdentifier();

        abort_unless($recruiterId, 401);

        $job = JobListing::where('recruiter_id', $recruiterId)
            ->findOrFail($jobListing);

        $job->delete();

        return redirect()
            ->route('recruiter.lowongan.index')
            ->with('success', 'Lowongan berhasil dihapus!');
    }
}
