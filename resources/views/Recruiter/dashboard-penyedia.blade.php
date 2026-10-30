@extends('Recruiter.layout')

@push('styles')
    <link href="{{ asset('css/dashboard-penyedia.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="dashboard-container">

        <div class="top-section-grid">
            <div class="stats-group">

                <div class="stat-card">
                    <div class="stat-info">
                        <span class="stat-label">Daftar Pelamar</span>
                        <span class="stat-number">{{ $jumlahPelamar }}</span>
                    </div>

                    <div class="stat-icon">
                        <svg width="24" height="24" fill="none"
                             stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <span class="stat-label">Lowongan Kerja Saya</span>
                        <span class="stat-number">{{ $jumlahLowongan }}</span>
                    </div>

                    <div class="stat-icon">
                        <svg width="24" height="24" fill="none"
                             stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24">
                            <rect x="2" y="7" width="20" height="14"
                                  rx="2" ry="2"></rect>
                            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                        </svg>
                    </div>
                </div>

            </div>

        </div>

        <section class="review-section">
            <h3>Review Pelamar</h3>

            <div class="applicant-grid">
                @forelse ($daftarPelamar as $app)
                    <a
                        href="{{ route('recruiter.pelamar.show', $app) }}"
                        class="applicant-card"
                    >
                        <div class="applicant-left">
                            <div class="applicant-img applicant-placeholder">
                                <i class="ph ph-user"></i>
                            </div>

                            <div class="applicant-info">
                                <h4>
                                    {{ $app->applicant->name
                                        ?? $app->applicant->nama
                                        ?? 'Nama pelamar belum tersedia' }}
                                </h4>

                                <p class="role">
                                    {{ $app->jobListing->title
                                        ?? $app->jobListing->nama_lowongan
                                        ?? 'Lowongan tidak tersedia' }}
                                </p>

                                <p class="requirements">
                                    Status: {{ ucfirst($app->status ?? 'Menunggu') }}
                                </p>
                            </div>
                        </div>

                        <span class="arrow">&rsaquo;</span>
                    </a>
                @empty
                    <p>Belum ada pelamar yang masuk.</p>
                @endforelse
            </div>
        </section>

    </div>
@endsection
