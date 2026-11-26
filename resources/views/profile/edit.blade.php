<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Profil | JobsKuy</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/profil.css') }}">
</head>
<body>
@php $initial = strtoupper(substr($user->name, 0, 1)); @endphp

<header class="topbar">
    <div class="topbar-left">
        <a href="{{ route('profile.show') }}" class="back-btn"><i class="fa-solid fa-arrow-left"></i></a>
        <div class="logo">
            <div class="logo-icon"><i class="fa-solid fa-briefcase"></i></div>
            JobsKuy
        </div>
    </div>
</header>

<main class="narrow">
    <section class="card">
        <h3 class="card-title"><i class="fa-solid fa-pen-to-square"></i> Edit Data Profil</h3>

        @if($errors->any())
            <div class="alert alert-error">
                <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label>Foto profil</label>
            <div class="photo-preview">
                @if($user->photo_path)
                    <img class="photo" src="{{ asset('storage/'.$user->photo_path) }}" alt="Foto profil">
                @else
                    <div class="photo photo-empty">{{ $initial }}</div>
                @endif
                <input type="file" name="photo" accept="image/*">
            </div>

            <label>Nama</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required>

            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required>

            <label>Telepon</label>
            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}">

            <label>Alamat</label>
            <textarea name="address">{{ old('address', $user->address) }}</textarea>

            @if($user->role === 'recruiter')
                <label>Nama perusahaan</label>
                <input type="text" name="company_name" value="{{ old('company_name', $user->company_name) }}">
            @endif

            <div class="form-actions">
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                <a href="{{ route('profile.show') }}" class="btn btn-light">Batal</a>
            </div>
        </form>
    </section>
</main>
</body>
</html>