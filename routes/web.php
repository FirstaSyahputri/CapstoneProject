
<?php

use App\Http\Controllers\Recruiter\LowonganController;
use App\Http\Controllers\Recruiter\PelamarController;
use App\Http\Controllers\Recruiter\StatusLamaranController;
use App\Http\Controllers\Recruiter\DashboardController;
use App\Http\Controllers\Recruiter\RecruiterJobController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicantController;

Route::get('/buat-lowongan', [LowonganController::class, 'create'])
    ->name('buat-lowongan'
);

Route::get('/profil-pelamar', function () {
    return view('Recruiter.profil-pelamar');
});
Route::get('/daftar-pelamar', [ApplicantController::class, 'index'])
    ->name('recruiter.pelamar');
    
Route::get('/', function () {
    return redirect()->route('recruiter.dashboard');
})->name('home');

Route::prefix('recruiter')
    ->name('recruiter.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/lowongan', [RecruiterJobController::class, 'index'])
            ->name('lowongan.index');

        Route::get('/lowongan/buat', [LowonganController::class, 'create'])
            ->name('lowongan.create');

        Route::post('/lowongan', [LowonganController::class, 'store'])
            ->name('lowongan.store');

        Route::get('/lowongan/{jobListing}', [RecruiterJobController::class, 'showDetail'])
            ->whereNumber('jobListing')
            ->name('lowongan.show');

        Route::get('/pelamar', [PelamarController::class, 'index'])
            ->name('pelamar.index');

        Route::get('/pelamar/{application}', [PelamarController::class, 'show'])
            ->name('pelamar.show');

        Route::patch('/lamaran/{application}/status', [StatusLamaranController::class, 'update'])
            ->name('lamaran.status.update');

        Route::view('/pesan', 'Recruiter.placeholder', [
            'title' => 'Pesan Saya',
            'description' => 'Fitur pesan akan dikembangkan pada tahap berikutnya.',
        ])->name('pesan.index');
    });

Route::get('/dashboard-penyedia', [DashboardController::class, 'index'])
    ->name('dashboard-penyedia');

Route::get('/lowongan-saya', [RecruiterJobController::class, 'index'])
    ->name('lowongan-saya');

// Update lowongan
Route::put('/lowongan-saya/{jobListing}', [RecruiterJobController::class, 'update'])
    ->whereNumber('jobListing')
    ->name('recruiter.job.update');

// Hapus lowongan
Route::delete('/lowongan-saya/{jobListing}', [RecruiterJobController::class, 'destroy'])
    ->whereNumber('jobListing')
    ->name('recruiter.job.delete');
