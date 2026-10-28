
@extends('Recruiter.layout')

@section('title', 'Daftar Pelamar')

@push('styles')
    <link href="{{ asset('css/daftar-pelamar.css') }}" rel="stylesheet">
@endpush

@section('content')
@php
    
        $statusMap = [
            'pending' => [
                'label' => 'Lamaran Terkirim',
                'class' => 'status-pending',
            ],
            'viewed' => [
                'label' => 'Dilihat oleh Pemilik',
                'class' => 'status-viewed',
            ],
            'review' => [
                'label' => 'Berkas Direview',
                'class' => 'status-review',
            ],
            'interview' => [
                'label' => 'Wawancara',
                'class' => 'status-interview',
            ],
        ];

    $statusTabs = [
        'all' => 'Semua',
        'pending' => 'Lamaran Terkirim',
        'viewed' => 'Dilihat oleh Pemilik',
        'review' => 'Berkas Direview',
        'interview' => 'Wawancara',
    ];
@endphp

<div class="applicants-page">

    {{-- Header halaman --}}
    <div class="applicants-header">
        <div>
            <h1 class="applicants-title">Daftar Pelamar</h1>
            <p class="applicants-subtitle">
                Kelola dan tinjau pelamar yang mendaftar pada lowongan kerja Anda.
            </p>
        </div>

        <div class="applicants-total">
            <div class="applicants-total-icon">
                <i class="fa-solid fa-users"></i>
            </div>
            <div>
                <span class="applicants-total-number">
                    {{ $applications->total() }}
                </span>
                <span class="applicants-total-label">Total lamaran</span>
            </div>
        </div>
    </div>

    {{-- Pencarian dan filter --}}
    <section class="applicants-toolbar">
        <div class="applicants-search">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input
                type="search"
                id="search-input"
                placeholder="Cari nama, email, atau posisi..."
                aria-label="Cari pelamar"
            >
        </div>

        <div class="applicants-filters" id="status-tabs">
            @foreach ($statusTabs as $key => $label)
                <button
                    type="button"
                    class="applicant-filter {{ $key === 'all' ? 'active' : '' }}"
                    data-status="{{ $key }}"
                    aria-pressed="{{ $key === 'all' ? 'true' : 'false' }}"
                >
                    {{ $label }}
                </button>
            @endforeach
        </div>
    </section>

    {{-- Informasi jumlah hasil --}}
    <div class="applicants-result-info">
        <span id="visible-count">{{ $applications->count() }}</span>
        pelamar ditampilkan pada halaman ini
    </div>

    {{-- Daftar kartu pelamar --}}
    <div class="applicants-grid" id="applicant-grid">
        @forelse ($applications as $app)
            @php
                $applicant = $app->applicant;
                $job = $app->jobListing;

                $name = $applicant->name
                    ?? $applicant->nama
                    ?? 'Nama belum tersedia';

                $email = $applicant->email ?? 'Email belum tersedia';

                $jobTitle = $job->title
                    ?? $job->judul
                    ?? $job->nama_lowongan
                    ?? 'Posisi tidak tersedia';

                $rawStatus = $app->status ?? 'pending';
                $status = $statusMap[$rawStatus] ?? [
                    'label' => ucfirst($rawStatus),
                    'class' => 'status-pending',
                ];

                $photo = $applicant->photo
                    ?? $applicant->foto
                    ?? $applicant->foto_profil
                    ?? null;
            @endphp

            <article
                class="applicant-card"
                data-status="{{ $rawStatus }}"
                data-search="{{ \Illuminate\Support\Str::lower($name.' '.$email.' '.$jobTitle) }}"
            >
                <div class="applicant-card-top">
                    <div class="applicant-avatar">
                        @if ($photo)
                            <img
                                src="{{ asset('storage/'.$photo) }}"
                                alt="Foto {{ $name }}"
                            >
                        @else
                            <div class="applicant-avatar-placeholder">
                                <i class="fa-solid fa-user"></i>
                            </div>
                        @endif
                    </div>

                    <div class="applicant-identity">
                        <h2 title="{{ $name }}">{{ $name }}</h2>

                        <p class="applicant-email" title="{{ $email }}">
                            <i class="fa-regular fa-envelope"></i>
                            <span>{{ $email }}</span>
                        </p>

                        <p class="applicant-position" title="{{ $jobTitle }}">
                            <i class="fa-solid fa-briefcase"></i>
                            <span>{{ $jobTitle }}</span>
                        </p>
                    </div>
                </div>

                <div class="applicant-card-divider"></div>

                <div class="applicant-card-footer">
                    <span class="applicant-status {{ $status['class'] }}">
                        <span class="status-dot"></span>
                        {{ $status['label'] }}
                    </span>

                    <a
                        href="{{ route('recruiter.pelamar.show', $app) }}"
                        class="applicant-detail-button"
                    >
                        Lihat Profil
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </article>
        @empty
            <div class="applicants-empty">
                <div class="applicants-empty-icon">
                    <i class="fa-solid fa-user-slash"></i>
                </div>
                <h2>Belum ada pelamar</h2>
                <p>
                    Lamaran yang masuk akan ditampilkan di halaman ini.
                </p>
            </div>
        @endforelse
    </div>

    {{-- Kondisi kosong saat pencarian/filter tidak menemukan hasil --}}
    <div id="filter-empty-state" class="applicants-empty d-none">
        <div class="applicants-empty-icon">
            <i class="fa-solid fa-magnifying-glass"></i>
        </div>
        <h2>Pelamar tidak ditemukan</h2>
        <p>Coba gunakan kata kunci atau filter status yang berbeda.</p>
    </div>

    {{-- Pagination Laravel --}}
    @if ($applications->hasPages())
        <div class="applicants-pagination">
            {{ $applications->links() }}
        </div>
    @endif

</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/daftar-pelamar.js') }}"></script>
@endpush
