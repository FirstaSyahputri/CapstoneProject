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
=======
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobsKuy - Daftar Pelamar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: { 50: '#F0F7FF', 100: '#E0F2FE', 500: '#3B82F6', 600: '#2563EB', 700: '#1D4ED8' }
                    },
                    fontFamily: { sans: ['Inter', 'sans-serif'] }
                }
            }
        }
    </script>
    <style>
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #F0F7FF; }
        ::-webkit-scrollbar-thumb { background: #CBD5E1; border-radius: 4px; }
    </style>
</head>
<body class="bg-brand-50 text-slate-800 font-sans antialiased min-h-screen flex flex-col">

    @php
        // label dan warna badge per status
        $statusMap = [
            'pending'   => ['label' => 'Perlu Dievaluasi', 'class' => 'bg-blue-50 text-brand-600 border-blue-200'],
            'interview' => ['label' => 'Wawancara',        'class' => 'bg-amber-50 text-amber-600 border-amber-200'],
            'accepted'  => ['label' => 'Diterima',         'class' => 'bg-emerald-50 text-emerald-600 border-emerald-200'],
            'rejected'  => ['label' => 'Ditolak',          'class' => 'bg-red-50 text-red-600 border-red-200'],
        ];
        $tabs = ['all' => 'Semua'] + collect($statusMap)->map(fn ($s) => $s['label'])->all();
    @endphp

    <!-- Header -->
    <header class="bg-white border-b border-blue-100 sticky top-0 z-40 px-4 lg:px-8 py-3 shadow-sm">
        <div class="max-w-[1700px] mx-auto flex items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <a href="/" class="p-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 transition"><i class="fa-solid fa-arrow-left"></i></a>
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-brand-600 text-white flex items-center justify-center font-bold"><i class="fa-solid fa-briefcase text-sm"></i></div>
                    <span class="text-base font-bold text-slate-900 tracking-tight">JobsKuy</span>
                </div>
            </div>

            <div class="hidden md:flex items-center bg-slate-100 rounded-xl px-3 py-1.5 w-80 border border-slate-200 focus-within:border-brand-600">
                <i class="fa-solid fa-magnifying-glass text-slate-400 mr-2 text-xs"></i>
                <input id="search-input" type="text" placeholder="Cari nama atau posisi..." class="bg-transparent text-xs w-full focus:outline-none">
            </div>

            <div class="flex items-center gap-2.5">
                <div class="hidden sm:block text-right">
                    <p class="text-xs font-bold text-slate-800 leading-none">Universitas Anak Kost</p>
                    <p class="text-[10px] text-slate-500 mt-0.5">JobsKuy Recruiter</p>
                </div>
            </div>
        </div>
    </header>

    <!-- Konten -->
    <main class="max-w-[1700px] w-full mx-auto px-4 lg:px-8 py-6 flex-1">

        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3 mb-5">
            <div>
                <h1 class="text-xl font-bold text-slate-900">Daftar Pelamar</h1>
                <p class="text-xs text-slate-500 mt-0.5">
                    <span id="total-count">{{ $applications->count() }}</span> pelamar di lowongan Anda
                </p>
            </div>

            <!-- Filter status -->
            <div class="flex flex-wrap gap-2" id="status-tabs">
                @foreach ($tabs as $key => $label)
                    <button type="button" data-status="{{ $key }}"
                        class="tab-btn px-3 py-1.5 rounded-full text-xs font-semibold border transition
                               {{ $key === 'all' ? 'bg-brand-600 text-white border-brand-600' : 'bg-white text-slate-600 border-slate-200 hover:bg-slate-50' }}">
                        {{ $label }}
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Grid kartu pelamar -->
        <div id="applicant-grid" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
            @foreach ($applications as $app)
                @php $st = $statusMap[$app->status] ?? $statusMap['pending']; @endphp
                <div class="applicant-card bg-white rounded-2xl p-5 border border-blue-100 shadow-sm hover:shadow-md transition flex flex-col gap-4"
                     data-status="{{ $app->status }}"
                     data-search="{{ strtolower($app->name.' '.$app->job_title) }}">

                    <div class="flex items-center gap-4">
                        <img src="{{ $app->photo ? asset('storage/'.$app->photo) : 'https://ui-avatars.com/api/?background=2563EB&color=fff&name='.urlencode($app->name) }}"
                             alt="Foto {{ $app->name }}"
                             class="w-16 h-16 rounded-2xl object-cover border-2 border-brand-500 shadow-sm">
                        <div class="flex-1 min-w-0">
                            <h2 class="text-sm font-bold text-slate-900 truncate">{{ $app->name }}</h2>
                            <p class="text-[11px] text-slate-500 truncate"><i class="fa-regular fa-envelope mr-1"></i>{{ $app->email }}</p>
                            <p class="text-[11px] font-medium text-brand-600 mt-1 truncate"><i class="fa-solid fa-user-tag mr-1"></i>{{ $app->job_title }}</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-3 border-t border-slate-100">
                        <span class="text-[11px] font-semibold px-2.5 py-1 rounded-full border {{ $st['class'] }}">{{ $st['label'] }}</span>
                        <a href="{{ url('/profil-pelamar') }}"
                           class="px-3 py-1.5 bg-brand-600 hover:bg-brand-700 text-white text-xs font-semibold rounded-xl transition">
                            Lihat Profil <i class="fa-solid fa-arrow-right ml-1 text-[10px]"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Kondisi kosong -->
        <div id="empty-state" class="{{ $applications->isEmpty() ? '' : 'hidden' }} text-center py-16">
            <div class="w-14 h-14 mx-auto rounded-2xl bg-white border border-blue-100 text-slate-400 flex items-center justify-center text-xl mb-3">
                <i class="fa-solid fa-user-slash"></i>
            </div>
            <p class="text-sm font-semibold text-slate-700">Belum ada pelamar</p>
            <p class="text-xs text-slate-500 mt-1">Pelamar yang cocok dengan filter akan tampil di sini.</p>
        </div>
    </main>

    <script>
        const cards = document.querySelectorAll('.applicant-card');
        const emptyState = document.getElementById('empty-state');
        let activeStatus = 'all';

        function applyFilter() {
            const q = document.getElementById('search-input').value.trim().toLowerCase();
            let visible = 0;
            cards.forEach(card => {
                const okStatus = activeStatus === 'all' || card.dataset.status === activeStatus;
                const okSearch = !q || card.dataset.search.includes(q);
                const show = okStatus && okSearch;
                card.classList.toggle('hidden', !show);
                if (show) visible++;
            });
            emptyState.classList.toggle('hidden', visible > 0);
        }

        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                activeStatus = btn.dataset.status;
                document.querySelectorAll('.tab-btn').forEach(b => {
                    b.className = 'tab-btn px-3 py-1.5 rounded-full text-xs font-semibold border transition bg-white text-slate-600 border-slate-200 hover:bg-slate-50';
                });
                btn.className = 'tab-btn px-3 py-1.5 rounded-full text-xs font-semibold border transition bg-brand-600 text-white border-brand-600';
                applyFilter();
            });
        });

        document.getElementById('search-input').addEventListener('input', applyFilter);
    </script>
</body>
</html>
