
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Recruiter | JobsKuy')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    >

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/color-palette.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">

    @stack('styles')
</head>

<body>

<div class="recruiter-layout">

    <aside class="recruiter-sidebar">

        <!-- Profil Recruiter -->
        <div class="sidebar-profile">
            <div class="sidebar-avatar">
                <i class="fa-solid fa-user"></i>
            </div>

            <div class="sidebar-profile-info">
                <div class="sidebar-profile-name">
                    {{ auth()->user()->name ?? 'Recruiter' }}
                </div>

                <div class="sidebar-profile-role">
                    Recruiter
                </div>
            </div>
        </div>

        <!-- Navigasi -->
        <nav class="sidebar-nav">

            <a
                href="{{ route('recruiter.dashboard') }}"
                class="sidebar-link {{ request()->routeIs('recruiter.dashboard') ? 'active' : '' }}"
            >
                <i class="fa-solid fa-house"></i>
                <span>Dashboard</span>
            </a>

            <a
                href="{{ route('recruiter.lowongan.index') }}"
                class="sidebar-link {{ request()->routeIs('recruiter.lowongan.index') ? 'active' : '' }}"
            >
                <i class="fa-solid fa-briefcase"></i>
                <span>Lowongan Kerja Saya</span>
            </a>

            <a
                href="{{ route('recruiter.lowongan.create') }}"
                class="sidebar-link {{ request()->routeIs('recruiter.lowongan.create') ? 'active' : '' }}"
            >
                <i class="fa-solid fa-circle-plus"></i>
                <span>Buat Lowongan Baru</span>
            </a>

            <a
                href="{{ route('recruiter.pelamar.index') }}"
                class="sidebar-link {{ request()->routeIs('recruiter.pelamar.*') || request()->routeIs('recruiter.lamaran.*') ? 'active' : '' }}"
            >
                <i class="fa-solid fa-users"></i>
                <span>Daftar Pelamar</span>

            <a
                href="{{ route('recruiter.pesan.index') }}"
                class="sidebar-link {{ request()->routeIs('recruiter.pesan.*') ? 'active' : '' }}"
            >
                <i class="fa-solid fa-envelope"></i>
                <span>Pesan Saya</span>
            </a>

        </nav>

        <div class="sidebar-bottom">

            @if (Route::has('logout'))
                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button
                        type="submit"
                        class="sidebar-link sidebar-logout"
                    >
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Keluar</span>
                    </button>
                </form>
            @else
                <button
                    type="button"
                    class="sidebar-link sidebar-logout"
                    disabled
                    title="Fitur logout belum tersedia"
                >
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Keluar</span>
                </button>
            @endif

        </div>

        <footer class="recruiter-footer">
            <span>© {{ date('Y') }} JobsKuy.</span>
        </footer>

    </aside>

    <div class="recruiter-main">

        <!-- HEADER -->
        <header class="recruiter-header">

            <div class="header-left">

                <button
                    type="button"
                    class="sidebar-toggle"
                    id="sidebarToggle"
                    aria-label="Sembunyikan sidebar"
                    aria-expanded="true"
                    title="Sembunyikan atau tampilkan sidebar"
                >
                    <i class="fa-solid fa-bars"></i>
                </button>

                <div class="header-brand">

                    <img
                        src="{{ asset('images/logo_jobskuy.png') }}"
                        alt="Logo JobsKuy"
                        class="header-logo"
                        onerror="this.style.display='none'"
                    >

                    <span class="header-brand-name">JobsKuy</span>

                    <span class="header-role-badge">Recruiter</span>

                </div>

            </div>

            <div class="header-actions">

                <!-- Notifikasi -->
                <button
                    type="button"
                    class="header-icon-button"
                    aria-label="Notifikasi"
                    title="Notifikasi"
                >
                    <i class="fa-regular fa-bell"></i>
                    <span class="notification-dot"></span>
                </button>

                <!-- Profil Recruiter -->
                <button
                    type="button"
                    class="header-profile"
                    aria-label="Profil recruiter"
                    title="Profil recruiter"
                >
                    <span class="header-avatar">
                        <i class="fa-solid fa-user"></i>
                    </span>
                </button>

            </div>

        </header>

        <main class="recruiter-content">
            @yield('content')
        </main>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


<script src="{{ asset('js/sidebar.js') }}"></script>

@stack('scripts')
@yield('scripts')

</body>
</html>

