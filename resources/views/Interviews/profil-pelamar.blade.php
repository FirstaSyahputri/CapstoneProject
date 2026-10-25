<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pelamar - JobsKuy</title>
    <!-- Google Fonts untuk tampilan UI bersih -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #f1f5f9; display: flex; justify-content: center; align-items: flex-start; min-height: 100vh; padding: 20px 0; }
        
        /* Container Tampilan Web Mobile-Responsive Center */
        /* Ubah dari max-width 440px dan border-radius menjadi full-width */
        .app-layout { 
            width: 100%; 
            max-width: 100%; /* Menghilangkan batasan lebar */
            background: #ffffff; 
            min-height: 100vh; 
            border-radius: 0; /* Menghilangkan sudut melengkung ala HP */
            box-shadow: none; 
            overflow: hidden; 
            position: relative; 
            display: flex; 
            flex-direction: column; 
        }
        /* Header Navigasi */
        .nav-header { display: flex; align-items: center; padding: 20px 24px; border-bottom: 1px solid #e2e8f0; background: #ffffff; sticky: top; }
        .back-btn { font-size: 20px; text-decoration: none; color: #0f172a; margin-right: 16px; cursor: pointer; border: none; background: none; }
        .nav-title { font-size: 20px; font-weight: 700; color: #0f172a; }

        /* Content Container */
        .content { padding: 20px 24px 100px; flex-grow: 1; overflow-y: auto; }

        /* Video Container */
        .video-card { width: 100%; height: 210px; background: #0f172a; border-radius: 16px; position: relative; overflow: hidden; display: flex; align-items: center; justify-content: center; margin-bottom: 16px; }
        .video-card img { width: 100%; height: 100%; object-fit: cover; opacity: 0.85; }
        .play-btn { position: absolute; width: 56px; height: 56px; background: rgba(255,255,255,0.9); border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: 0 4px 12px rgba(0,0,0,0.2); }
        .play-btn::after { content: ''; display: block; width: 0; height: 0; border-top: 10px solid transparent; border-bottom: 10px solid transparent; border-left: 16px solid #0f172a; margin-left: 4px; }

        /* User Profile Card */
        .user-card { background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 16px; display: flex; align-items: center; gap: 12px; margin-bottom: 20px; box-shadow: 0 4px 12px rgba(0,0,0,0.03); }
        .avatar-icon { width: 44px; height: 44px; background: #f1f5f9; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 20px; color: #475569; }
        .user-info h3 { font-size: 18px; font-weight: 700; color: #0f172a; }
        .badge-verified { display: inline-block; background: #dcfce7; color: #15803d; font-size: 11px; font-weight: 600; padding: 2px 8px; border-radius: 12px; margin-top: 4px; }

        /* Section Text */
        .section-label { font-size: 12px; font-weight: 600; color: #64748b; margin-bottom: 8px; }
        .about-card { background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 14px 16px; font-size: 14px; color: #334155; font-style: italic; margin-bottom: 24px; box-shadow: 0 2px 6px rgba(0,0,0,0.02); }

        /* Dokumen Lampiran Grid */
        .section-title { font-size: 18px; font-weight: 700; color: #0f172a; margin-bottom: 14px; }
        .documents-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
        .doc-btn { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px; padding: 16px 12px; display: flex; flex-direction: column; align-items: center; gap: 8px; cursor: pointer; text-decoration: none; color: #334155; font-size: 13px; font-weight: 600; transition: all 0.2s; }
        .doc-btn:hover { background: #f1f5f9; border-color: #cbd5e1; }
        .doc-icon { font-size: 24px; color: #0f172a; }

        /* Floating Bottom Action Bar */
        .action-bar { position: absolute; bottom: 0; left: 0; right: 0; background: #ffffff; padding: 16px 24px; border-top: 1px solid #f1f5f9; display: flex; gap: 12px; }
        .btn { flex: 1; padding: 14px; border-radius: 12px; font-size: 15px; font-weight: 700; border: none; cursor: pointer; transition: opacity 0.2s; }
        .btn-tolak { background: #8b95a5; color: #ffffff; }
        .btn-wawancara { background: #22c55e; color: #ffffff; }
        .btn:hover { opacity: 0.9; }

        /* Modal Overlay & Card Styling */
        .modal-overlay { display: none; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.4); backdrop-filter: blur(2px); z-index: 100; justify-content: center; align-items: center; padding: 20px; }
        .modal-card { background: #ffffff; width: 100%; max-width: 360px; border-radius: 20px; padding: 24px; box-shadow: 0 20px 30px rgba(0,0,0,0.15); text-align: center; animation: popIn 0.2s ease-out; }

        @keyframes popIn { from { transform: scale(0.95); opacity: 0; } to { transform: scale(1); opacity: 1; } }

        /* Form Inputs in Modals */
        .modal-card input, .modal-card textarea { width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 13px; margin-top: 4px; margin-bottom: 12px; outline: none; background: #f8fafc; }
        .modal-card input:focus, .modal-card textarea:focus { border-color: #22c55e; background: #ffffff; }
        .modal-card label { display: block; text-align: left; font-size: 12px; font-weight: 600; color: #475569; }

        /* Template Options for Rejection */
        .template-card { border: 1px solid #cbd5e1; border-radius: 12px; padding: 12px; text-align: left; margin-bottom: 10px; cursor: pointer; position: relative; background: #ffffff; transition: all 0.2s; }
        .template-card.selected { border-color: #22c55e; background: #f0fdf4; }
        .template-title { font-size: 13px; font-weight: 700; color: #0f172a; margin-bottom: 4px; }
        .template-desc { font-size: 11px; color: #64748b; line-height: 1.4; }
        .badge-selected { position: absolute; top: 10px; right: 10px; background: #22c55e; color: #ffffff; font-size: 9px; font-weight: 700; padding: 2px 6px; border-radius: 6px; }

        /* Success Modal Specifics */
        .success-icon { width: 64px; height: 64px; background: #16a34a; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 32px; margin: 0 auto 16px; }
    </style>
</head>
<body>

    <div class="app-layout">
        <!-- Header -->
        <div class="nav-header">
            <button class="back-btn" onclick="history.back()">←</button>
            <h1 class="nav-title">Profil Pelamar</h1>
        </div>

        <!-- Scrollable Content -->
        <div class="content">
            <!-- Video Perkenalan Pelamar -->
            <div class="video-card">
                <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=600&q=80" alt="Video Pelamar">
                <div class="play-btn"></div>
            </div>

            <!-- Identitas Pelamar -->
            <div class="user-card">
                <div class="avatar-icon">👤</div>
                <div class="user-info">
                    <h3>Budi Santoso</h3>
                    <span class="badge-verified">Verified</span>
                </div>
            </div>

            <!-- tentang Pelamar -->
            <div class="section-label">Tentang Budi</div>
            <div class="about-card">
                "Saya terbiasa kerja gesit dan jujur"
            </div>

            <!-- Dokumen Lampiran -->
            <div class="section-title">Dokumen Lampiran</div>
            <div class="documents-grid">
                <a href="#" class="doc-btn">
                    <span class="doc-icon">📄</span>
                    <span>Lihat Ijazah</span>
                </a>
                <a href="#" class="doc-btn">
                    <span class="doc-icon">📄</span>
                    <span>Lihat SKCK</span>
                </a>
            </div>
        </div>

        <!-- Action Bar (Sticky Bottom) -->
        <div class="action-bar">
            <button class="btn btn-tolak" onclick="showModal('modalTolak')">Tolak</button>
            <button class="btn btn-wawancara" onclick="showModal('modalWawancara')">Wawancara</button>
        </div>

        <!-- ================= MODAL 1: KONFIRMASI PENOLAKAN ================= -->
        <div id="modalTolak" class="modal-overlay">
            <div class="modal-card" style="background: #fff5f5;">
                <h3 style="font-size: 18px; font-weight: 700; color: #0f172a; margin-bottom: 12px;">Konfirmasi Penolakan</h3>
                <p style="font-size: 14px; color: #475569; margin-bottom: 24px; line-height: 1.4;">
                    Apakah Anda yakin ingin menolak pelamar ini?
                </p>
                <div style="display: flex; gap: 10px;">
                    <button class="btn" style="background: #94a3b8; color: white;" onclick="hideModal('modalTolak')">Batal</button>
                    <button class="btn" style="background: #ef4444; color: white;" onclick="switchModal('modalTolak', 'modalPesan')">Tolak</button>
                </div>
            </div>
        </div>

        <!-- ================= MODAL 2: PESAN SEMANGAT & MASUKAN ================= -->
        <div id="modalPesan" class="modal-overlay">
            <div class="modal-card" style="background: #fff5f5;">
                <h3 style="font-size: 16px; font-weight: 700; color: #0f172a; margin-bottom: 16px;">
                    Pesan Semangat & Masukan :
                </h3>

                <!-- Option 1 -->
                <div class="template-card selected" onclick="chooseTemplate(this)">
                    <span class="badge-selected">Selected</span>
                    <div class="template-title">Positif & Memberi Harapan</div>
                    <div class="template-desc">
                        Halo Budi, lamaranmu inspiratif! Namun, kualifikasi posisi ini belum berjodoh. Jangan menyerah, terus asah skill & temukan peluang barumu
                    </div>
                </div>

                <!-- Option 2 -->
                <div class="template-card" onclick="chooseTemplate(this)">
                    <div class="template-title">Kritis & Berguna</div>
                    <div class="template-desc">
                        Halo Budi, kami lihat skill komunikasimu bagus. Fokus kembangkan skill teknis/sertifikasi untuk peran serupa. Kami simpan profilmu!
                    </div>
                </div>

                <!-- Option 3 -->
                <div class="template-card" onclick="chooseTemplate(this)">
                    <div class="template-title">Kandidat lain dan Doa terbaik</div>
                    <div class="template-desc">
                        Maaf Budi, Kami temukan kandidat dengan pengalaman spesifik yang lebih sesuai. Doa terbaik kami untuk perjalanan karirmu!
                    </div>
                </div>

                <div style="display: flex; gap: 10px; margin-top: 16px;">
                    <button class="btn" style="background: #94a3b8; color: white;" onclick="hideModal('modalPesan')">Batal</button>
                    <button class="btn" style="background: #ef4444; color: white;" onclick="submitRejection()">Kirim & Tolak</button>
                </div>
            </div>
        </div>

        <!-- ================= MODAL 3: BUAT UNDANGAN WAWANCARA ================= -->
        <div id="modalWawancara" class="modal-overlay">
            <div class="modal-card" style="background: #e2e8f0;">
                <h3 style="font-size: 16px; font-weight: 700; color: #0f172a; margin-bottom: 6px;">Jadwalkan Wawancara</h3>
                <p style="font-size: 11px; color: #475569; margin-bottom: 14px;">
                    Konfirmasi tanggal dari waktu yang diusulkan untuk wawancara Budi Santoso
                </p>

                <div style="display: flex; gap: 8px;">
                    <div style="flex: 1;">
                        <label>Pilih Tanggal</label>
                        <input type="date">
                    </div>
                    <div style="flex: 1;">
                        <label>Pilih Waktu</label>
                        <input type="time">
                    </div>
                </div>

                <label>Tempat Wawancara</label>
                <input type="text" placeholder="Masukkan lokasi...">

                <label>Catatan (opsional) :</label>
                <input type="text" placeholder="Masukkan catatan...">

                <label>Link Wawancara (opsional) :</label>
                <input type="text" placeholder="Masukkan link...">

                <div style="display: flex; gap: 10px; margin-top: 8px;">
                    <button class="btn" style="background: #ffffff; color: #334155; border: 1px solid #cbd5e1;" onclick="hideModal('modalWawancara')">Batal</button>
                    <button class="btn btn-wawancara" onclick="switchModal('modalWawancara', 'modalSukses')">Konfirmasi</button>
                </div>
            </div>
        </div>

        <!-- ================= MODAL 4: UNDANGAN TERKIRIM ================= -->
        <div id="modalSukses" class="modal-overlay">
            <div class="modal-card" style="background: #f0fdf4;">
                <div class="success-icon">✓</div>
                <h3 style="font-size: 20px; font-weight: 700; color: #0f172a; margin-bottom: 10px;">Undangan Terkirim</h3>
                <p style="font-size: 13px; color: #475569; margin-bottom: 20px; line-height: 1.4;">
                    Budi Santoso telah menerima undangan wawancara Anda
                </p>
                <button class="btn btn-wawancara" style="width: 100%;" onclick="hideModal('modalSukses')">OK</button>
            </div>
        </div>

    </div>

    <!-- JavaScript Interaktif -->
    <script>
        function showModal(id) {
            document.getElementById(id).style.display = 'flex';
        }

        function hideModal(id) {
            document.getElementById(id).style.display = 'none';
        }

        function switchModal(fromId, toId) {
            hideModal(fromId);
            showModal(toId);
        }

        function chooseTemplate(element) {
            document.querySelectorAll('.template-card').forEach(card => {
                card.classList.remove('selected');
                const badge = card.querySelector('.badge-selected');
                if (badge) badge.remove();
            });

            element.classList.add('selected');
            const badgeHTML = '<span class="badge-selected">Selected</span>';
            element.insertAdjacentHTML('afterbegin', badgeHTML);
        }

        function submitRejection() {
            alert('Penolakan beserta pesan masukan berhasil dikirim!');
            hideModal('modalPesan');
        }
    </script>
</body>
</html>