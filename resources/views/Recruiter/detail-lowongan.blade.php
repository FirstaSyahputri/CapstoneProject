<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Lowongan Kerja</title>
    <!-- Memanggil CSS Terpisah -->
    <link rel="stylesheet" href="{{ asset('css/detail-lowongan.css') }}">
    <!-- FontAwesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <div class="dashboard-container">
        <!-- Header Tanpa Tombol Panah -->
        <div class="header-section">
            <h1 class="page-title">Detail Lowongan Kerja</h1>
        </div>

        <div class="divider"></div>
        <!-- Form / Konten Detail Lowongan -->
        <form action="{{ route('recruiter.job.update') }}" method="POST" id="jobDetailForm">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label class="form-label">Nama Pekerjaan</label>
                <!-- Mode Awal: Teks Biasa, Mode Edit: Input -->
                <div class="view-mode" id="view-nama">Kasir</div>
                <div class="edit-mode" style="display: none;">
                    <input type="text" name="nama_pekerjaan" class="form-input" value="Kasir">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Deskripsi Pekerjaan</label>
                <div class="view-mode" id="view-deskripsi">Melayani transaksi pembayaran pelanggan, mengelola kas tunai/non-tunai, dan mencatat laporan harian.</div>
                <div class="edit-mode" style="display: none;">
                    <textarea name="deskripsi_pekerjaan" class="form-textarea">Melayani transaksi pembayaran pelanggan, mengelola kas tunai/non-tunai, dan mencatat laporan harian.</textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Syarat Dokumen Tambahan</label>
                
                <!-- Mode Read-Only -->
                <div class="view-mode">
                    <div class="badge-container" id="viewDocContainer">
                        <span class="doc-badge"><i class="fa-solid fa-file-lines"></i> Ijazah</span>
                        <span class="doc-badge"><i class="fa-solid fa-file-lines"></i> SKCK</span>
                    </div>
                </div>

                <!-- Mode Edit -->
                <div class="edit-mode" style="display: none;">
                    <div class="badge-container" id="editBadgeContainer" style="margin-bottom: 12px;">
                        <span class="doc-badge"><i class="fa-solid fa-file-lines"></i> Ijazah</span>
                        <span class="doc-badge"><i class="fa-solid fa-file-lines"></i> SKCK</span>
                    </div>

                    <!-- Kotak Input dan Tombol + Tambah Sejajar Berdampingan -->
                    <div class="doc-input-wrapper">
                        <input type="text" id="inputNamaDokumen" class="form-input" placeholder="Nama dokumen, contoh: SIM A">
                        <button type="button" class="btn-action btn-ubah" onclick="tambahDokumenBaru()">+ Tambah</button>
                    </div>
                    <small id="errorMsgDokumen" style="color: #E74C3C; display: none; margin-top: 5px; font-size: 0.85rem;">Nama dokumen tidak boleh kosong.</small>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Batas Maksimal Pelamar Kerja</label>
                <div class="view-mode" id="view-batas">5</div>
                <div class="edit-mode" style="display: none;">
                    <input type="number" name="batas_pelamar" class="form-input" value="5">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Rentang Gaji</label>
                <div class="view-mode" id="view-gaji">Rp 3.500.000 - Rp 4.500.000</div>
                <div class="edit-mode" style="display: none;">
                    <input type="text" name="rentang_gaji" class="form-input" value="Rp 3.500.000 - Rp 4.500.000">
                </div>
            </div>

            <!-- Bagian Tombol Aksi -->
            <div class="form-action-container">
                <button type="button" id="btnToggleEdit" class="btn-action btn-ubah" onclick="toggleEditMode()">Ubah</button>
            </div>
        </form>
    </div>

    <!-- Skrip JavaScript untuk Mengubah Mode Tampilan ke Edit/Simpan -->

    <script>
        let isEditMode = false;

        function toggleEditMode() {
            const viewElements = document.querySelectorAll('.view-mode');
            const editElements = document.querySelectorAll('.edit-mode');
            const btnAction = document.getElementById('btnToggleEdit');

            if (!isEditMode) {
                viewElements.forEach(el => el.style.display = 'none');
                editElements.forEach(el => el.style.display = 'block');
                
                btnAction.innerText = 'Simpan';
                btnAction.classList.remove('btn-ubah');
                btnAction.classList.add('btn-simpan');
                btnAction.type = 'button'; 
                
                isEditMode = true;
            } else {
                // Alih-alih alert(), tampilkan modal card custom yang hijau
                document.getElementById('successModal').style.display = 'flex';
            }
        }

        // Fungsi saat tombol OK di dalam modal diklik
        function tutupModalDanSubmit() {
            const form = document.getElementById('jobDetailForm');
            form.submit(); // Melakukan submit form ke server
        }

        // Proses menambah dokumen baru ke list badge (tetap seperti punyamu)
        function tambahDokumenBaru() {
            let inputField = document.getElementById('inputNamaDokumen');
            let namaDokumen = inputField.value.trim();
            let errorMsg = document.getElementById('errorMsgDokumen');

            if (namaDokumen === "") {
                inputField.style.borderColor = "#E74C3C";
                errorMsg.style.display = "block";
                return;
            }

            inputField.style.borderColor = "#C4CBD6";
            errorMsg.style.display = "none";

            const editBadgeContainer = document.getElementById('editBadgeContainer');
            const newBadgeEdit = document.createElement('span');
            newBadgeEdit.className = 'doc-badge';
            newBadgeEdit.innerHTML = `<i class="fa-solid fa-file-lines"></i> ${namaDokumen}`;
            editBadgeContainer.appendChild(newBadgeEdit);

            const viewDocContainer = document.getElementById('viewDocContainer');
            const newBadgeView = document.createElement('span');
            newBadgeView.className = 'doc-badge';
            newBadgeView.innerHTML = `<i class="fa-solid fa-file-lines"></i> ${namaDokumen}`;
            viewDocContainer.appendChild(newBadgeView);

            inputField.value = "";
        }
    </script>
    <div id="successModal" class="modal-overlay" style="display: none;">
        <div class="modal-card">
            <div class="modal-icon-container">
                <i class="fa-solid fa-award modal-check-icon"></i>
            </div>
            <h2 class="modal-title">Perubahan Telah<br>Berhasil Disimpan</h2>
            <p class="modal-subtitle">Perubahan data lowongan kerja anda<br>telah diperbarui</p>
            <button type="button" class="modal-btn-ok" onclick="tutupModalDanSubmit()">OK</button>
        </div>
    </div>
</body>
</html