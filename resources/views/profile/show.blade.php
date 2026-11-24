<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil | JobsKuy</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/profil.css') }}">
</head>
<body>
@php
    $isOwner = $user->role === 'recruiter';
    $roleLabel = $isOwner ? 'Pemilik Usaha' : 'Job Seeker';
    $initial = strtoupper(substr($user->name, 0, 1));
@endphp

<header class="topbar">
    <div class="topbar-left">
        <a href="{{ url('/') }}" class="back-btn"><i class="fa-solid fa-arrow-left"></i></a>
        <div class="logo">
            <div class="logo-icon"><i class="fa-solid fa-briefcase"></i></div>
            JobsKuy
        </div>
    </div>
    <div class="user-chip">
        @if($user->photo_path)
            <img class="avatar-sm" src="{{ asset('storage/'.$user->photo_path) }}" alt="">
        @else
            <div class="avatar-sm">{{ $initial }}</div>
        @endif
        <div>
            <div class="name">{{ $user->name }}</div>
            <div class="role">{{ $roleLabel }}</div>
        </div>
    </div>
</header>

<main class="page">
    <div class="stack">

        @if(session('success'))
            <div class="alert alert-success" style="margin-bottom:0">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-error" style="margin-bottom:0">
                <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
        @endif

        {{-- Kartu profil --}}
        <section class="card">
            <div class="profile-head">
                @if($user->photo_path)
                    <img class="photo" src="{{ asset('storage/'.$user->photo_path) }}" alt="Foto profil">
                @else
                    <div class="photo photo-empty">{{ $initial }}</div>
                @endif

                <div class="profile-main">
                    <div class="name-row">
                        <h1>{{ $user->name }}</h1>
                        <span class="badge"><i class="fa-solid fa-circle-check"></i> {{ $roleLabel }}</span>
                    </div>
                    <hr class="divider">
                    <div class="tiles">
                        <div class="tile">
                            <small>Email</small>
                            <strong><i class="fa-solid fa-envelope"></i> {{ $user->email }}</strong>
                        </div>
                        <div class="tile">
                            <small>Telepon</small>
                            <strong><i class="fa-solid fa-phone"></i> {{ $user->phone ?? '-' }}</strong>
                        </div>
                        <div class="tile">
                            <small>Alamat</small>
                            <strong><i class="fa-solid fa-location-dot" style="color:#dc2626"></i> {{ $user->address ?? '-' }}</strong>
                        </div>
                        @if($isOwner)
                            <div class="tile">
                                <small>Perusahaan</small>
                                <strong><i class="fa-solid fa-building"></i> {{ $user->company_name ?? '-' }}</strong>
                            </div>
                        @else
                            <div class="tile">
                                <small>Pengalaman Kerja</small>
                                <strong><i class="fa-solid fa-briefcase"></i> {{ $user->workExperiences->count() }} pengalaman</strong>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        @unless($isOwner)
            {{-- Riwayat pengalaman kerja --}}
            <section class="card">
                <h3 class="card-title"><i class="fa-solid fa-briefcase"></i> Riwayat Pengalaman Kerja</h3>
                <ul class="item-list">
                    @forelse($user->workExperiences as $exp)
                        <li class="item">
                            <div>
                                <div class="title">{{ $exp->position }}</div>
                                <div class="sub">{{ $exp->workplace }} &bull; {{ $exp->period ?? '-' }}</div>
                            </div>
                            <form method="POST" action="{{ route('profile.experience.destroy', $exp->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger-outline btn-sm"><i class="fa-solid fa-trash"></i> Hapus</button>
                            </form>
                        </li>
                    @empty
                        <li class="empty">Belum ada pengalaman kerja.</li>
                    @endforelse
                </ul>
                <form class="inline-form" method="POST" action="{{ route('profile.experience.store') }}">
                    @csrf
                    <input type="text" name="position" placeholder="Posisi" required>
                    <input type="text" name="workplace" placeholder="Tempat kerja" required>
                    <input type="text" name="period" placeholder="Periode, mis. 2022 - 2024">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Tambah</button>
                </form>
            </section>

            {{-- Gudang dokumen pribadi --}}
            <section class="card">
                <h3 class="card-title"><i class="fa-solid fa-folder-open"></i> Gudang Dokumen Pribadi</h3>
                <ul class="item-list">
                    @forelse($user->documents as $doc)
                        <li class="item">
                            <div>
                                <div class="title"><i class="fa-solid fa-file-lines" style="color:#2563eb"></i> {{ $doc->name }}</div>
                                <a class="sub" href="{{ asset('storage/'.$doc->file_path) }}" target="_blank">Lihat dokumen</a>
                            </div>
                            <form method="POST" action="{{ route('profile.document.destroy', $doc->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger-outline btn-sm"><i class="fa-solid fa-trash"></i> Hapus</button>
                            </form>
                        </li>
                    @empty
                        <li class="empty">Belum ada dokumen. Tambahkan CV atau ijazah.</li>
                    @endforelse
                </ul>
                <form class="inline-form doc" method="POST" action="{{ route('profile.document.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="name" placeholder="Nama dokumen (mis. CV)" required>
                    <input type="file" name="file" required>
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-upload"></i> Unggah</button>
                </form>
            </section>
        @endunless
    </div>

    {{-- Sidebar --}}
    <aside class="card">
        <h3 class="card-title"><i class="fa-solid fa-user-gear"></i> Pengaturan Akun</h3>
        <div class="side-actions">
            <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-block">
                <i class="fa-solid fa-pen-to-square"></i> Edit Data Profil
            </a>
            <p class="side-label">KELUAR</p>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger-outline btn-block">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </button>
            </form>
        </div>
    </aside>
</main>
</body>
</html>