<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Penyedia - JobsKuy</title>
    <!-- Font & Icon -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="{{ asset('css/dashboard-penyedia.css') }}">
</head>
<body>

    <div class="app-layout">
        <!-- KONTEN UTAMA DASHBOARD -->
        <main class="main-content">
            <div class="dashboard-container">
                <!-- TOPBAR -->
                <header class="topbar">
                    <div class="topbar-left">
                        <h1>Dashboard</h1>
                    </div>
                </header>

                <!-- STAT CARDS & TOMBOL -->
                <div class="top-section-grid">
                    <div class="stats-group">
                        <div class="stat-card">
                            <div class="stat-info">
                                <span class="stat-label">Daftar Pelamar</span>
                                <span class="stat-number">{{ $jumlahPelamar }}</span>
                            </div>
                            <div class="stat-icon">
                                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                            </div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-info">
                                <span class="stat-label">Lowongan Kerja Saya</span>
                                <span class="stat-number">{{ $jumlahLowongan }}</span>
                            </div>
                            <div class="stat-icon">
                                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                            </div>
                        </div>
                    </div>

                    <div class="action-group">
                        <a href="{{ route('buat-lowongan') }}" class="btn-primary">
                            <i class="ph ph-plus-circle" style="font-size: 20px; vertical-align: middle; margin-right: 6px;"></i>
                            Buat Lowongan Baru
                        </a>
                    </div>
                </div>

                <!-- REVIEW PELAMAR SECTION -->
                <section class="review-section">
                    <h3>Review Pelamar :</h3>

                    <div class="applicant-grid">
                        <!-- Item Pelamar 1 -->
                        <div class="applicant-card">
                            <div class="applicant-left">
                                <img src="{{ asset('images/budi.png') }}" alt="Budi Santoso" class="applicant-img">
                                <div class="applicant-info">
                                    <h4>Budi Santoso</h4>
                                    <p class="role">Pelamar Satpam</p>
                                    <p class="requirements">Ijazah & SKCK</p>
                                </div>
                            </div>
                            <span class="arrow">&rsaquo;</span>
                        </div>

                        <!-- Item Pelamar 2 -->
                        <div class="applicant-card">
                            <div class="applicant-left">
                                <img src="{{ asset('images/faris.png') }}" alt="Faris Effendi" class="applicant-img">
                                <div class="applicant-info">
                                    <h4>Faris Effendi</h4>
                                    <p class="role">Pelamar Kasir</p>
                                    <p class="requirements">Ijazah</p>
                                </div>
                            </div>
                            <span class="arrow">&rsaquo;</span>
                        </div>

                        <!-- Item Pelamar 3 -->
                        <div class="applicant-card">
                            <div class="applicant-left">
                                <img src="{{ asset('images/rudiansyah.png') }}" alt="Rudiansyah" class="applicant-img">
                                <div class="applicant-info">
                                    <h4>Rudiansyah</h4>
                                    <p class="role">Pelamar Kasir</p>
                                    <p class="requirements">Ijazah & SKCK</p>
                                </div>
                            </div>
                            <span class="arrow">&rsaquo;</span>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </div>

</body>
</html>