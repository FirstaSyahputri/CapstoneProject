<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $job ? $job->nama_pekerjaan : 'Lowongan tidak ditemukan' }} | JobsKuy</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/profil.css') }}">
    <link rel="stylesheet" href="{{ asset('css/detail-lowongan-pencari.css') }}">
</head>
<body>

<header class="topbar">
    <div class="topbar-left">
        <a href="javascript:history.back()" class="back-btn"><i class="fa-solid fa-arrow-left"></i></a>
        <div class="logo">
            <div class="logo-icon"><i class="fa-solid fa-briefcase"></i></div>
            JobsKuy
        </div>
    </div>
</header>

@if(!$job)
    <main class="narrow">
        <section class="card not-found">
            <i class="fa-solid fa-circle-exclamation"></i>
            <h2>Lowongan tidak ditemukan</h2>
            <p class="empty">Lowongan ini mungkin sudah dihapus atau alamatnya salah.</p>
            <a href="{{ url('/') }}" class="btn btn-primary">Kembali ke Beranda</a>
        </section>
    </main>
@else
    @php
        $isOpen = $job->status === 'aktif';
        $docs = array_filter(array_map('trim', preg_split('/[,&\n]+/', $job->persyaratan ?? '')));
        $company = $owner->company_name ?? $owner->name ?? '-';
        $mapSrc = $job->alamat ? 'https://www.google.com/maps?q='.urlencode($job->alamat).'&output=embed' : null;
        $mapLink = $job->alamat ? 'https://www.google.com/maps/search/?api=1&query='.urlencode($job->alamat) : null;
    @endphp

    <main class="page">
        <div class="stack">

            @unless($isOpen)
                <div class="alert alert-error" style="margin-bottom:0">
                    <i class="fa-solid fa-lock"></i> Lowongan ini sudah ditutup dan tidak menerima lamaran.
                </div>
            @endunless

            <section class="card">
                @if($job->foto)
                    <img class="job-hero" src="{{ asset('storage/'.$job->foto) }}" alt="Foto lowongan">
                @else
                    <div class="job-hero job-hero-empty"><i class="fa-solid fa-image"></i></div>
                @endif

                <h1 class="job-title">{{ $job->nama_pekerjaan }}</h1>
                <p class="job-company">
                    <i class="fa-solid fa-building"></i> {{ $company }}
                    <span class="status-pill {{ $isOpen ? 'status-open' : 'status-closed' }}">
                        {{ $isOpen ? 'Dibuka' : 'Ditutup' }}
                    </span>
                </p>

                <div class="tiles">
                    <div class="tile">
                        <small>Gaji</small>
                        <strong><i class="fa-solid fa-money-bill-wave"></i> {{ $job->rentang_gaji ?? 'Tidak dicantumkan' }}</strong>
                    </div>
                    <div class="tile">
                        <small>Lokasi</small>
                        <strong><i class="fa-solid fa-location-dot" style="color:#dc2626"></i> {{ $job->alamat ?? '-' }}</strong>
                    </div>
                    @if($job->batas_pelamar)
                        <div class="tile">
                            <small>Kuota pelamar</small>
                            <strong><i class="fa-solid fa-users"></i> {{ $job->batas_pelamar }} orang</strong>
                        </div>
                    @endif
                </div>
            </section>

            <section class="card">
                <h3 class="card-title"><i class="fa-solid fa-align-left"></i> Deskripsi Pekerjaan</h3>
                <p class="desc">{{ $job->deskripsi_pekerjaan }}</p>
            </section>

            <section class="card">
                <h3 class="card-title"><i class="fa-solid fa-folder-open"></i> Syarat Dokumen</h3>
                @if(count($docs))
                    <div class="doc-badges">
                        @foreach($docs as $d)<span class="doc-badge">{{ $d }}</span>@endforeach
                    </div>
                @else
                    <p class="empty">Tidak ada syarat dokumen khusus.</p>
                @endif
            </section>

            <section class="card">
                <h3 class="card-title"><i class="fa-solid fa-map-location-dot"></i> Lokasi Lowongan</h3>
                @if($mapSrc)
                    <iframe class="map-frame" src="{{ $mapSrc }}" loading="lazy" allowfullscreen></iframe>
                    <a class="map-link" href="{{ $mapLink }}" target="_blank" rel="noopener">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i> Buka di Google Maps
                    </a>
                @else
                    <p class="empty">Lokasi belum dicantumkan oleh pemilik usaha.</p>
                @endif
            </section>
        </div>

        <aside class="card">
            <h3 class="card-title"><i class="fa-solid fa-paper-plane"></i> Tertarik?</h3>
            @if($isOpen)
                <a href="{{ url('/lowongan/'.$job->id.'/lamar') }}" class="btn btn-primary btn-lg btn-block">
                    <i class="fa-solid fa-paper-plane"></i> Lamar Sekarang
                </a>
            @else
                <span class="btn btn-disabled btn-lg btn-block">Lowongan Ditutup</span>
            @endif
        </aside>
    </main>
@endif
</body>
</html>