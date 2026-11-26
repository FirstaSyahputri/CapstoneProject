<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lowongan Kerja Saya</title>
    <!-- Memanggil CSS Terpisah -->
    <link rel="stylesheet" href="{{ asset('css/lowongan-saya.css') }}">
    <!-- FontAwesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <div class="dashboard-container">
        <!-- Header / Navigasi Atas -->
        <div class="header-section">
            <h1 class="page-title">Lowongan Kerja Saya</h1>
        </div>

        <div class="divider"></div>

        <!-- Section Utama -->
        <div class="content-section">
            <h2 class="section-title">Lowongan Kerja Aktif</h2>

            <!-- Search Bar -->
            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass search-icon"></i>
                <input type="text" placeholder="Cari Pekerjaan" class="search-input">
            </div>

            <!-- List Card Lowongan -->
            <div class="job-list">
                
                @forelse($lowongans as $job)
                <div class="job-card">
                    <div class="job-card-left">
                        <div class="job-icon-box">
                            <i class="{{ $job->icon ?? 'fa-solid fa-briefcase' }}"></i>
                        </div>
                        <div class="job-details">
                            <h3 class="job-name">{{ $job->nama_pekerjaan }}</h3>
                            <p class="job-requirements">Syarat dokumen : {{ $job->persyaratan }}</p>
                        </div>
                    </div>
                    
                    <div class="job-card-right">
                    <!-- Tombol Detail dengan class CSS terpisah -->
                        <a href="{{ route('recruiter.job.detail') }}" class="btn-detail">Detail</a>
                     <!-- Tombol Hapus yang memicu Modal Pop-up -->
                        <button type="button" class="btn-delete" onclick="openDeleteModal('{{ $job->nama_pekerjaan }}')">Hapus</button>

                    <!-- Form tersembunyi untuk proses hapus -->
                        <form id="delete-form-{{ $job->nama_pekerjaan }}" action="{{ route('recruiter.job.delete') }}" method="POST" style="display: none;">
                 @csrf
                @method('DELETE')
    </form>
</div>
                </div>
                @empty
                <p class="empty-state">Belum ada lowongan kerja aktif.</p>
                @endforelse

            </div>
        </div>
    </div>

    <!-- ================= MODAL / POP-UP KONFIRMASI HAPUS ================= -->
    <div id="deleteModal" class="modal-overlay">
        <div class="modal-box">
            <h3>Konfirmasi Penghapusan</h3>
            <p>Apakah Anda yakin ingin menghapus lowongan <strong id="jobNameText"></strong> ini?</p>
            <div class="modal-btn-container">
                <button type="button" class="btn-modal-cancel" onclick="closeDeleteModal()">Batal</button>
                <button type="button" class="btn-modal-confirm" id="confirmDeleteBtn">Hapus</button>
            </div>
        </div>
    </div>

    <!-- Skrip JavaScript untuk Mengontrol Pop-up -->
    <script>
        let selectedJobName = '';

        function openDeleteModal(jobName) {
            selectedJobName = jobName;
            document.getElementById('jobNameText').innerText = '"' + jobName + '"';
            document.getElementById('deleteModal').style.display = 'flex';
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').style.display = 'none';
            selectedJobName = '';
        }

        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            if (selectedJobName) {
                let formId = 'delete-form-' + selectedJobName;
                let form = document.getElementById(formId);
                if (form) {
                    form.submit();
                }
            }
        });
    </script>

</body>
</html>