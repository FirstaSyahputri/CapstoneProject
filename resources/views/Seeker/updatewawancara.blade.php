<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobsKuy - Status Lamaran Saya</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/updatewawancara.css') }}">
</head>
<body>


    <header>
        <div class="header-wrap">
            <div class="flex items-center gap-3">
                <a href="#" style="padding: 8px; border-radius: 12px; background: var(--slate-100); color: var(--slate-600); text-decoration: none;"><i class="fa-solid fa-arrow-left"></i></a>
                <div class="flex items-center gap-2">
                    <div style="width: 32px; height: 32px; border-radius: 8px; background: var(--brand-600); color: white; display: flex; align-items: center; justify-content: center; font-weight: bold;"><i class="fa-solid fa-briefcase" style="font-size: 14px;"></i></div>
                    <span style="font-size: 16px; font-weight: bold; color: var(--slate-900);">JobsKuy</span>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <span class="badge-brand">
                    <span style="width: 8px; height: 8px; border-radius: 50%; background: var(--brand-600);"></span> Pelacak Status Lamaran
                </span>
                <div style="height: 24px; width: 1px; background: var(--slate-200);" class="hidden sm:block"></div>
                <div class="flex items-center gap-2.5">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=120&q=80" alt="Budi Santoso" style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover; border: 1px solid var(--brand-500);">
                    <div style="text-align: left;" class="hidden sm:block">
                        <p style="font-size: 12px; font-weight: bold; color: var(--slate-800); line-height: 1;">Budi Santoso</p>
                        <p style="font-size: 10px; color: var(--slate-500); margin-top: 2px;">Job Seeker</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main>
        <!-- Data Diri, Video Perkenalan, Bio, & Dokumen Lampiran -->
        <section class="col-8" style="display: flex; flex-direction: column; gap: 24px;">
            
            <!-- Kandidat Info -->
            <div class="card sm-flex-row" style="display: flex; gap: 20px; align-items: flex-start;">
                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=250&q=80" alt="Budi Santoso" style="width: 96px; height: 96px; border-radius: 16px; object-fit: cover; border: 2px solid var(--brand-500); box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
                <div style="flex: 1; width: 100%;">
                    <div class="flex sm-flex-row items-center" style="justify-content: flex-start; gap: 8px; flex-wrap: wrap;">
                        <h1 style="font-size: 20px; font-weight: bold; color: var(--slate-900);">Budi Santoso</h1>
                        <span class="badge-emerald"><i class="fa-solid fa-circle-check"></i> Verified Profile & Document</span>
                    </div>
                    <p style="font-size: 12px; font-weight: 500; color: var(--brand-600); margin-top: 4px;"><i class="fa-solid fa-user-tag" style="margin-right: 4px;"></i> Posisi Dilamar: <span style="font-weight: bold; color: var(--slate-800);">Office Boy</span></p>

                    <div class="grid grid-cols-2 sm:grid-cols-4" style="gap: 8px; margin-top: 16px; padding-top: 16px; border-top: 1px solid var(--slate-100); font-size: 12px;">
                        <div style="background: var(--brand-50); padding: 10px; border-radius: 12px; border: 1px solid var(--brand-100);"><span style="font-size: 10px; color: var(--slate-500); display: block;">Domisili</span><span style="font-weight: bold; color: var(--slate-800);"><i class="fa-solid fa-location-dot" style="color: var(--red-600); margin-right: 4px;"></i> Bandung</span></div>
                        <div style="background: var(--brand-50); padding: 10px; border-radius: 12px; border: 1px solid var(--brand-100);"><span style="font-size: 10px; color: var(--slate-500); display: block;">Pengalaman</span><span style="font-weight: bold; color: var(--slate-800);"><i class="fa-solid fa-briefcase" style="color: var(--brand-600); margin-right: 4px;"></i>2 Tahun</span></div>
                        <div style="background: var(--brand-50); padding: 10px; border-radius: 12px; border: 1px solid var(--brand-100);"><span style="font-size: 10px; color: var(--slate-500); display: block;">Pendidikan</span><span style="font-weight: bold; color: var(--slate-800);"><i class="fa-solid fa-graduation-cap" style="color: var(--amber-500); margin-right: 4px;"></i>SMK</span></div>
                        <div style="background: var(--brand-50); padding: 10px; border-radius: 12px; border: 1px solid var(--brand-100);"><span style="font-size: 10px; color: var(--slate-500); display: block;">Ketersediaan</span><span style="font-weight: bold; color: var(--emerald-600);"><i class="fa-solid fa-bolt" style="margin-right: 4px;"></i>Segera</span></div>
                    </div>
                </div>
            </div>

            <!-- Video Perkenalan Diri -->
            <div class="card">
                <div class="flex justify-between items-center" style="margin-bottom: 12px;">
                    <h2 style="font-size: 12px; font-weight: bold; color: var(--slate-700); text-transform: uppercase; letter-spacing: 0.05em; display: flex; align-items: center; gap: 8px;">
                        <i class="fa-solid fa-video" style="color: var(--brand-600);"></i> Video Perkenalan Diri (1 Menit)
                    </h2>
                    <span class="badge-brand">00:58</span>
                </div>
                <div class="video-wrapper" onclick="playVideoModal()">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=800&q=80" alt="Video Thumb">
                    <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(2,6,23,0.8), transparent, rgba(0,0,0,0.2));"></div>
                    <button class="play-btn">
                        <i class="fa-solid fa-play" style="font-size: 20px; margin-left: 4px;"></i>
                    </button>
                    <div style="position: absolute; bottom: 12px; left: 12px; right: 12px; display: flex; justify-content: space-between; align-items: center; font-size: 12px; color: white; background: rgba(15,23,42,0.8); backdrop-filter: blur(4px); padding: 6px 12px; border-radius: 12px;">
                        <span><i class="fa-solid fa-user-check" style="color: #34D399; margin-right: 4px;"></i> Budi Santoso - Perkenalan</span>
                        <span style="font-size: 10px; color: var(--slate-300);">HD 720p</span>
                    </div>
                </div>
            </div>

            <!-- Tentang Kandidat -->
            <div class="card">
                <h2 style="font-size: 14px; font-weight: bold; color: var(--slate-900); margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
                    <i class="fa-solid fa-address-card" style="color: var(--brand-600);"></i> Tentang Kandidat (BIO)
                </h2>
                <p style="font-size: 12px; color: var(--slate-600); line-height: 1.6; background: var(--brand-50); padding: 16px; border-radius: 12px; border: 1px solid var(--brand-100);">
                    "Saya adalah lulusan SMK yang memiliki pengalaman kerja selama lebih dari 2 tahun di bidang pengelolaan gudang dan kurir pengiriman logistik. Terbiasa bekerja fisik dengan ketelitian tinggi, paham mengenai penataan barang, stock opname bulanan, serta pengoperasian perangkat handheld scanner. Pekerja keras, disiplin waktu, tidak perokok, dan memiliki SIM A & SIM C aktif yang siap digunakan."
                </p>
                <div class="flex" style="flex-wrap: wrap; gap: 6px; margin-top: 12px;">
                    <span style="background: var(--slate-100); color: var(--slate-700); font-size: 11px; padding: 4px 10px; border-radius: 8px; border: 1px solid var(--slate-200);">Stock Opname</span>
                    <span style="background: var(--slate-100); color: var(--slate-700); font-size: 11px; padding: 4px 10px; border-radius: 8px; border: 1px solid var(--slate-200);">SIM C & SIM A</span>
                    <span style="background: var(--slate-100); color: var(--slate-700); font-size: 11px; padding: 4px 10px; border-radius: 8px; border: 1px solid var(--slate-200);">Siap Shift Malam</span>
                </div>
            </div>

            <!-- Dokumen Lampiran -->
            <div class="card">
                <h2 style="font-size: 14px; font-weight: bold; color: var(--slate-900); margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                    <i class="fa-solid fa-folder-closed" style="color: var(--amber-500);"></i> Dokumen Lampiran
                </h2>
                <div class="grid sm-grid-cols-2" style="grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 12px;">
                    <div style="background: var(--brand-50); padding: 14px; border-radius: 12px; border: 1px solid var(--brand-100); display: flex; align-items: center; justify-content: space-between;">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-graduation-cap" style="font-size: 18px; color: var(--brand-600);"></i>
                            <div><h3 style="font-size: 12px; font-weight: 600; color: var(--slate-800);">Ijazah Terakhir (SMK)</h3><span style="font-size: 10px; color: var(--emerald-600);">Verified</span></div>
                        </div>
                        <button onclick="alert('Pratinjau Ijazah Terakhir')" style="padding: 6px 12px; background: white; color: var(--slate-700); font-size: 12px; border-radius: 8px; border: 1px solid var(--slate-200); font-weight: 500; cursor: pointer;">Lihat</button>
                    </div>

                    <div style="background: var(--brand-50); padding: 14px; border-radius: 12px; border: 1px solid var(--brand-100); display: flex; align-items: center; justify-content: space-between;">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-shield-halved" style="font-size: 18px; color: var(--emerald-600);"></i>
                            <div><h3 style="font-size: 12px; font-weight: 600; color: var(--slate-800);">SKCK Kepolisian</h3><span style="font-size: 10px; color: var(--emerald-600);">Aktif s/d 2026</span></div>
                        </div>
                        <button onclick="alert('Pratinjau SKCK Kepolisian')" style="padding: 6px 12px; background: white; color: var(--slate-700); font-size: 12px; border-radius: 8px; border: 1px solid var(--slate-200); font-weight: 500; cursor: pointer;">Lihat</button>
                    </div>

                    <div style="background: var(--brand-50); padding: 14px; border-radius: 12px; border: 1px solid var(--brand-100); display: flex; align-items: center; justify-content: space-between;">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-id-card" style="font-size: 18px; color: #7C3AED;"></i>
                            <div><h3 style="font-size: 12px; font-weight: 600; color: var(--slate-800);">KTP & SIM C / A</h3><span style="font-size: 10px; color: var(--emerald-600);">Cocok</span></div>
                        </div>
                        <button onclick="alert('Pratinjau KTP & SIM')" style="padding: 6px 12px; background: white; color: var(--slate-700); font-size: 12px; border-radius: 8px; border: 1px solid var(--slate-200); font-weight: 500; cursor: pointer;">Lihat</button>
                    </div>

                    <div style="background: var(--brand-50); padding: 14px; border-radius: 12px; border: 1px solid var(--brand-100); display: flex; align-items: center; justify-content: space-between;">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-certificate" style="font-size: 18px; color: var(--amber-500);"></i>
                            <div><h3 style="font-size: 12px; font-weight: 600; color: var(--slate-800);">Sertifikat Pekerjaan</h3><span style="font-size: 10px; color: var(--slate-500);">Thn 2024</span></div>
                        </div>
                        <button onclick="alert('Pratinjau Sertifikat Pekerjaan')" style="padding: 6px 12px; background: white; color: var(--slate-700); font-size: 12px; border-radius: 8px; border: 1px solid var(--slate-200); font-weight: 500; cursor: pointer;">Lihat</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Progress Status Lamaran & Kontak -->
        <section class="col-4" style="display: flex; flex-direction: column; gap: 20px;">
            <div class="card card-sticky">
                <h2 style="font-size: 14px; font-weight: bold; color: var(--slate-900); margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                    <i class="fa-solid fa-list-check" style="color: var(--brand-600);"></i> Pelacakan Status Lamaran
                </h2>

                <!-- Timeline Tracker -->
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div>
                            <p style="font-size: 12px; font-weight: bold; color: var(--slate-800);">Lamaran Terkirim</p>
                            <p style="font-size: 10px; color: var(--slate-500);">10 April, 09:00 WIB</p>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div>
                            <p style="font-size: 12px; font-weight: bold; color: var(--slate-800);">Dilihat oleh Pemilik</p>
                            <p style="font-size: 10px; color: var(--slate-500);">10 April, 11:30 WIB</p>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div>
                            <p style="font-size: 12px; font-weight: bold; color: var(--slate-800);">Berkas Direview</p>
                            <p style="font-size: 10px; color: var(--slate-500);">10 April, 14:00 WIB</p>
                        </div>
                    </div>

                    <!-- jadwal wawancara -->
                    <div id="status-step-wawancara" class="timeline-item">
                        <div class="timeline-dot active-dot"></div>
                        <div style="width: 100%;">
                            <p id="status-title-text" style="font-size: 12px; font-weight: bold; color: var(--brand-600);">Wawancara</p>
                            <p id="status-desc-text" style="font-size: 10px; color: var(--slate-600); margin-top: 2px;">Menunggu konfirmasi jadwal dari recruiter</p>
                            
                            <button id="btn-detail-wawancara" onclick="openModal()" class="btn-brand" style="margin-top: 10px; padding: 6px 12px; font-size: 11px; display: none;">
                                <i class="fa-regular fa-calendar-days"></i> Lihat Detail Jadwal
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Bantuan & Kontak Cepat -->
                <div style="margin-top: 24px; padding-top: 20px; border-top: 1px solid var(--slate-100);">
                    <span style="font-size: 11px; font-weight: bold; color: var(--slate-500); text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 8px;">Bantuan & Kontak</span>
                    <a href="https://wa.me/6282246009097" target="_blank" style="display: flex; align-items: center; justify-content: space-between; padding: 10px 12px; border-radius: 12px; background: var(--emerald-50); border: 1px solid #A7F3D0; color: var(--emerald-600); font-size: 12px; font-weight: 600; text-decoration: none;">
                        <span><i class="fa-brands fa-whatsapp" style="font-size: 14px; margin-right: 8px;"></i> Chat Penyedia Kerja</span>
                        <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 10px;"></i>
                    </a>
                </div>
            </div>
        </section>
    </main>

    <!-- Detail Jadwal Wawancara -->
    <div id="schedule-modal" class="modal">
        <div class="modal-content">
            <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--slate-100); padding-bottom: 12px;">
                <div class="flex items-center gap-2">
                    <i class="fa-regular fa-calendar-check" style="color: var(--brand-600); font-size: 18px;"></i>
                    <h3 style="font-size: 14px; font-weight: bold; color: var(--slate-900);">Detail Jadwal Wawancara</h3>
                </div>
                <button onclick="closeModal()" style="background: none; border: none; color: var(--slate-400); cursor: pointer;"><i class="fa-solid fa-xmark"></i></button>
            </div>
            
            <div style="display: flex; flex-direction: column; gap: 12px; font-size: 12px;">
                <div style="background: var(--brand-50); padding: 12px; border-radius: 12px; border: 1px solid var(--brand-100);">
                    <span style="font-size: 10px; color: var(--slate-500); display: block; margin-bottom: 2px;">Tanggal & Waktu</span>
                    <span id="res-datetime" style="font-weight: bold; color: var(--slate-800); font-size: 13px;">-</span>
                </div>
                <div style="background: var(--brand-50); padding: 12px; border-radius: 12px; border: 1px solid var(--brand-100);">
                    <span style="font-size: 10px; color: var(--slate-500); display: block; margin-bottom: 2px;">Tempat / Link Pertemuan</span>
                    <span id="res-location" style="font-weight: bold; color: var(--slate-800);">-</span>
                </div>
                <div style="background: var(--brand-50); padding: 12px; border-radius: 12px; border: 1px solid var(--brand-100);">
                    <span style="font-size: 10px; color: var(--slate-500); display: block; margin-bottom: 2px;">Catatan Tambahan dari Recruiter</span>
                    <span id="res-notes" style="color: var(--slate-700); font-style: italic;">-</span>
                </div>
            </div>

            <button onclick="closeModal()" class="btn-brand" style="width: 100%; padding: 10px; margin-top: 4px;">Tutup</button>
        </div>
    </div>

    <!-- Video Player -->
    <div id="video-modal" class="modal" style="background-color: rgba(2, 6, 23, 0.85);">
        <div class="modal-content" style="max-width: 600px; background: #ffffff;">
            <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 8px; border-bottom: 1px solid var(--slate-100);">
                <span style="font-size: 12px; font-weight: bold; color: var(--slate-800);"><i class="fa-solid fa-circle-play" style="color: var(--brand-600); margin-right: 4px;"></i> Video Perkenalan Diri - Budi Santoso</span>
                <button onclick="closeVideoModal()" style="background: none; border: none; color: var(--slate-400); cursor: pointer;"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div style="aspect-ratio: 16/9; background: var(--slate-900); border-radius: 12px; overflow: hidden; position: relative; display: flex; align-items: center; justify-content: center;">
                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=800&q=80" style="width: 100%; height: 100%; object-fit: cover; opacity: 0.6;">
                <div style="position: absolute; inset: 0; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; padding: 16px; background: rgba(0,0,0,0.3); color: white;">
                    <div style="width: 56px; height: 56px; border-radius: 50%; background: var(--brand-600); display: flex; align-items: center; justify-content: center; font-size: 20px; margin-bottom: 8px;"><i class="fa-solid fa-play" style="margin-left: 4px;"></i></div>
                    <p style="font-size: 12px; font-weight: bold;">Memutar Video (00:58)</p>
                    <p style="font-size: 11px; color: var(--slate-200); margin-top: 4px;">"Halo Bapak/Ibu, nama saya Budi Santoso, domisili Bandung..."</p>
                </div>
            </div>
        </div>
    </div>

    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const savedData = localStorage.getItem('jobskuy_status');
            if (savedData) {
                const data = JSON.parse(savedData);
                const titleText = document.getElementById('status-title-text');
                const descText = document.getElementById('status-desc-text');
                const btnDetail = document.getElementById('btn-detail-wawancara');

                if (data.status === 'interview') {
                    titleText.textContent = 'Jadwal Wawancara Telah Dikonfirmasi';
                    descText.textContent = `Tanggal: ${data.date} pukul ${data.time}`;
                    btnDetail.style.display = 'inline-flex';

                    document.getElementById('res-datetime').textContent = `${data.date} (${data.time})`;
                    document.getElementById('res-location').textContent = data.location;
                    document.getElementById('res-notes').textContent = data.notes;
                } else if (data.status === 'rejected') {
                    titleText.style.color = 'var(--red-600)';
                    titleText.textContent = 'Lamaran Ditolak';
                    descText.textContent = 'Terima kasih atas antusiasme dan partisipasi Anda.';
                    btnDetail.style.display = 'none';
                }
            }
        });

        function openModal() { document.getElementById('schedule-modal').classList.add('active'); }
        function closeModal() { document.getElementById('schedule-modal').classList.remove('active'); }
        function playVideoModal() { document.getElementById('video-modal').classList.add('active'); }
        function closeVideoModal() { document.getElementById('video-modal').classList.remove('active'); }
    </script>
</body>
</html>