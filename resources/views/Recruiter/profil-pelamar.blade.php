<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobsKuy - Profil Pelamar Budi Santoso</title>
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

    <!-- Toast Notifications -->
    <div id="toast-container" class="fixed top-5 right-5 z-50 flex flex-col gap-2 pointer-events-none"></div>

    <!-- 1. Header Web Full Width -->
    <header class="bg-white border-b border-blue-100 sticky top-0 z-40 px-4 lg:px-8 py-3 shadow-sm">
        <div class="max-w-[1700px] mx-auto flex items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <a href="#" class="p-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 transition"><i class="fa-solid fa-arrow-left"></i></a>
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-brand-600 text-white flex items-center justify-center font-bold"><i class="fa-solid fa-briefcase text-sm"></i></div>
                    <span class="text-base font-bold text-slate-900 tracking-tight">JobsKuy</span>
                </div>
            </div>

            <div class="hidden md:flex items-center bg-slate-100 rounded-xl px-3 py-1.5 w-80 border border-slate-200 focus-within:border-brand-600">
                <i class="fa-solid fa-magnifying-glass text-slate-400 mr-2 text-xs"></i>
                <input type="text" placeholder="Cari kandidat atau posisi..." class="bg-transparent text-xs w-full focus:outline-none">
            </div>

            <div class="flex items-center gap-4">
                <span id="current-status-badge" class="bg-blue-50 text-brand-600 border border-blue-200 text-xs px-3 py-1 rounded-full font-semibold flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-brand-600 animate-pulse"></span> Perlu Dievaluasi
                </span>
                <div class="h-6 w-px bg-slate-200 hidden sm:block"></div>
                <div class="flex items-center gap-2.5">
                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=120&q=80" alt="Siti Aminah" class="w-8 h-8 rounded-full object-cover border border-brand-500">
                    <div class="hidden sm:block text-left">
                        <p class="text-xs font-bold text-slate-800 leading-none">Universitas Anak Kost</p>
                        <p class="text-[10px] text-slate-500 mt-0.5">JobsKuy Recruiter</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- 2. Main Content 2-Column Full Layout -->
    <main class="max-w-[1700px] w-full mx-auto px-4 lg:px-8 py-6 flex-1 grid grid-cols-1 lg:grid-cols-12 gap-6">

        <!-- LEFT COLUMN: Profile Info, Video, Bio, Attachments (8 Cols) -->
        <section class="lg:col-span-8 space-y-6">
            
            <!-- Candidate Header Info -->
            <div class="bg-white rounded-2xl p-6 border border-blue-100 shadow-sm flex flex-col sm:flex-row items-center sm:items-start gap-5">
                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=250&q=80" alt="Budi Santoso" class="w-24 h-24 rounded-2xl object-cover border-2 border-brand-500 shadow-md">
                <div class="flex-1 text-center sm:text-left">
                    <div class="flex flex-wrap items-center justify-center sm:justify-start gap-2">
                        <h1 class="text-xl font-bold text-slate-900">Budi Santoso</h1>
                        <span class="bg-emerald-50 text-emerald-600 border border-emerald-200 text-[11px] font-semibold px-2.5 py-0.5 rounded-full flex items-center gap-1">
                            <i class="fa-solid fa-circle-check"></i> Verified Profile & Document
                        </span>
                    </div>
                    <p class="text-xs font-medium text-brand-600 mt-1"><i class="fa-solid fa-user-tag mr-1"></i> Posisi Dilamar: <span class="font-bold text-slate-800">Office Boy</span></p>

                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 mt-4 pt-4 border-t border-slate-100 text-xs">
                        <div class="bg-brand-50 p-2.5 rounded-xl border border-blue-100"><span class="text-[10px] text-slate-500 block">Domisili</span><span class="font-bold text-slate-800"><i class="fa-solid fa-location-dot text-red-500 mr-1"></i> Bandung</span></div>
                        <div class="bg-brand-50 p-2.5 rounded-xl border border-blue-100"><span class="text-[10px] text-slate-500 block">Pengalaman</span><span class="font-bold text-slate-800"><i class="fa-solid fa-briefcase text-brand-600 mr-1"></i>2 Tahun</span></div>
                        <div class="bg-brand-50 p-2.5 rounded-xl border border-blue-100"><span class="text-[10px] text-slate-500 block">Pendidikan</span><span class="font-bold text-slate-800"><i class="fa-solid fa-graduation-cap text-amber-500 mr-1"></i>SMK</span></div>
                        <div class="bg-brand-50 p-2.5 rounded-xl border border-blue-100"><span class="text-[10px] text-slate-500 block">Ketersediaan</span><span class="font-bold text-emerald-600"><i class="fa-solid fa-bolt mr-1"></i>Segera</span></div>
                    </div>
                </div>
            </div>

            <!-- Video Perkenalan Diri -->
            <div class="bg-white rounded-2xl p-6 border border-blue-100 shadow-sm">
                <div class="flex items-center justify-between mb-3">
                    <h2 class="text-xs font-bold text-slate-700 uppercase tracking-wider flex items-center gap-2">
                        <i class="fa-solid fa-video text-brand-600"></i> Video Perkenalan Diri (1 Menit)
                    </h2>
                    <span class="text-[10px] bg-brand-50 text-brand-600 font-semibold px-2.5 py-1 rounded-full border border-blue-200">00:58</span>
                </div>
                <div class="relative w-full aspect-video bg-slate-900 rounded-2xl overflow-hidden border border-slate-200 group cursor-pointer" onclick="playVideo()">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=800&q=80" alt="Video Thumb" class="w-full h-full object-cover opacity-80 group-hover:scale-105 transition duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-transparent to-black/20"></div>
                    <button class="absolute inset-0 m-auto w-14 h-14 bg-brand-600 hover:bg-brand-700 text-white rounded-full flex items-center justify-center shadow-xl transform group-hover:scale-110 transition duration-200">
                        <i class="fa-solid fa-play text-xl ml-1"></i>
                    </button>
                    <div class="absolute bottom-3 left-3 right-3 flex justify-between items-center text-xs text-white bg-slate-900/80 backdrop-blur-sm px-3 py-1.5 rounded-xl">
                        <span><i class="fa-solid fa-user-check text-emerald-400 mr-1"></i> Budi Santoso - Perkenalan</span>
                        <span class="text-[10px] text-slate-300">HD 720p</span>
                    </div>
                </div>
            </div>

            <!-- Tentang Kandidat BIO -->
            <div class="bg-white rounded-2xl p-6 border border-blue-100 shadow-sm">
                <h2 class="text-sm font-bold text-slate-900 mb-3 flex items-center gap-2">
                    <i class="fa-solid fa-address-card text-brand-600"></i> Tentang Kandidat (BIO)
                </h2>
                <p class="text-xs text-slate-600 leading-relaxed bg-brand-50 p-4 rounded-xl border border-blue-100">
                    "Saya adalah lulusan SMK yang memiliki pengalaman kerja selama lebih dari 2 tahun di bidang pengelolaan gudang dan kurir pengiriman logistik. Terbiasa bekerja fisik dengan ketelitian tinggi, paham mengenai penataan barang, stock opname bulanan, serta pengoperasian perangkat handheld scanner. Pekerja keras, disiplin waktu, tidak perokok, dan memiliki SIM A & SIM C aktif yang siap digunakan."
                </p>
                <div class="flex flex-wrap gap-1.5 mt-3">
                    <span class="bg-slate-100 text-slate-700 text-[11px] px-2.5 py-1 rounded-lg border border-slate-200">Stock Opname</span>
                    <span class="bg-slate-100 text-slate-700 text-[11px] px-2.5 py-1 rounded-lg border border-slate-200">SIM C & SIM A</span>
                    <span class="bg-slate-100 text-slate-700 text-[11px] px-2.5 py-1 rounded-lg border border-slate-200">Siap Shift Malam</span>
                </div>
            </div>

            <!-- Dokumen Lampiran -->
            <div class="bg-white rounded-2xl p-6 border border-blue-100 shadow-sm">
                <h2 class="text-sm font-bold text-slate-900 mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-folder-closed text-amber-500"></i> Dokumen Lampiran
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div class="bg-brand-50 p-3.5 rounded-xl border border-blue-100 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-graduation-cap text-lg text-brand-600"></i>
                            <div><h3 class="text-xs font-semibold text-slate-800">Ijazah Terakhir (SMK)</h3><span class="text-[10px] text-emerald-600">Verified</span></div>
                        </div>
                        <button onclick="previewDocument('Ijazah Terakhir', 'ijazah')" class="px-3 py-1 bg-white hover:bg-slate-50 text-slate-700 text-xs rounded-lg border border-slate-200 font-medium">Lihat</button>
                    </div>

                    <div class="bg-brand-50 p-3.5 rounded-xl border border-blue-100 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-shield-halved text-lg text-emerald-600"></i>
                            <div><h3 class="text-xs font-semibold text-slate-800">SKCK Kepolisian</h3><span class="text-[10px] text-emerald-600">Aktif s/d 2026</span></div>
                        </div>
                        <button onclick="previewDocument('SKCK Kepolisian', 'skck')" class="px-3 py-1 bg-white hover:bg-slate-50 text-slate-700 text-xs rounded-lg border border-slate-200 font-medium">Lihat</button>
                    </div>

                    <div class="bg-brand-50 p-3.5 rounded-xl border border-blue-100 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-id-card text-lg text-purple-600"></i>
                            <div><h3 class="text-xs font-semibold text-slate-800">KTP & SIM C / A</h3><span class="text-[10px] text-emerald-600">Cocok</span></div>
                        </div>
                        <button onclick="previewDocument('KTP & SIM', 'ktp')" class="px-3 py-1 bg-white hover:bg-slate-50 text-slate-700 text-xs rounded-lg border border-slate-200 font-medium">Lihat</button>
                    </div>

                    <div class="bg-brand-50 p-3.5 rounded-xl border border-blue-100 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-certificate text-lg text-amber-500"></i>
                            <div><h3 class="text-xs font-semibold text-slate-800">Sertifikat Pekerjaan</h3><span class="text-[10px] text-slate-500">Thn 2024</span></div>
                        </div>
                        <button onclick="previewDocument('Sertifikat Warehousing', 'sertifikat')" class="px-3 py-1 bg-white hover:bg-slate-50 text-slate-700 text-xs rounded-lg border border-slate-200 font-medium">Lihat</button>
                    </div>
                </div>
            </div>

        </section>

        <!-- RIGHT COLUMN: Sticky Recruitment Decisions (4 Cols) -->
        <section class="lg:col-span-4 space-y-5">
            
            <!-- Sticky Action Card -->
            <div class="bg-white rounded-2xl p-6 border-2 border-blue-200 shadow-md sticky top-20">
                <h2 class="text-sm font-bold text-slate-900 mb-1 flex items-center gap-2">
                    <i class="fa-solid fa-gavel text-brand-600"></i> Keputusan Rekrutmen
                </h2>
                <p class="text-xs text-slate-500 mb-4">Pilih tindakan untuk kandidat ini:</p>

                <div class="space-y-3">
                    <button onclick="openInterviewModal()" class="w-full flex flex-col items-center justify-center bg-brand-600 hover:bg-brand-700 text-white p-3.5 rounded-xl font-bold transition shadow-md">
                        <span class="flex items-center gap-2 text-xs"><i class="fa-regular fa-calendar-check text-base"></i> Jadwalkan Interview</span>
                        <span class="text-[10px] font-normal text-blue-100">Atur tanggal & lokasi wawancara</span>
                    </button>

                    <button onclick="openRejectStep1Modal()" class="w-full flex flex-col items-center justify-center bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 p-3.5 rounded-xl font-bold transition">
                        <span class="flex items-center gap-2 text-xs"><i class="fa-solid fa-user-xmark text-base"></i> Tolak Kandidat</span>
                        <span class="text-[10px] font-normal text-red-500">Kirim pesan penolakan ramah</span>
                    </button>
                </div>

                <!-- Fast Contact Actions -->
                <div class="mt-6 pt-5 border-t border-slate-100 space-y-2">
                    <span class="text-[11px] font-bold text-slate-500 uppercase tracking-wider block mb-2">Kontak Cepat Pelamar</span>
                    <a href="https://wa.me/62 822-4600-9097" target="_blank" class="flex items-center justify-between p-2.5 rounded-xl bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 text-emerald-700 text-xs font-semibold transition">
                        <span><i class="fa-brands fa-whatsapp text-sm mr-2"></i> WhatsApp:  0822-4600-9097</span>
                        <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                    </a>
                    <a href="tel:081234567890" class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 hover:bg-slate-100 border border-slate-200 text-slate-700 text-xs font-semibold transition">
                        <span><i class="fa-solid fa-phone text-sm text-brand-600 mr-2"></i> Telepon Direct</span>
                        <i class="fa-solid fa-chevron-right text-[10px] text-slate-400"></i>
                    </a>
                </div>
            </div>

        </section>

    </main>

    <!-- 3. MODALS -->

    <!-- Modal 1: Schedule Interview with Interactive Calendar & Time Slots -->
    <div id="interview-modal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-lg w-full p-6 relative flex flex-col gap-4 shadow-2xl border border-blue-100">
            <div class="flex justify-between items-center border-b border-slate-100 pb-3">
                <div class="flex items-center gap-2">
                    <i class="fa-regular fa-calendar-plus text-brand-600 text-lg"></i>
                    <div>
                        <h3 class="text-sm font-bold text-slate-900">Jadwalkan Interview</h3>
                        <p class="text-[11px] text-slate-500">Pelamar: <span class="font-bold text-slate-700">Budi Santoso</span></p>
                    </div>
                </div>
                <button onclick="closeInterviewModal()" class="text-slate-400 hover:text-slate-600"><i class="fa-solid fa-xmark"></i></button>
            </div>

            <form onsubmit="handleSendInterview(event)" class="space-y-4">
                
                <!-- Interactive Calendar Grid -->
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Pilih Tanggal Wawancara (Oktober 2026)</label>
                    <div class="bg-brand-50 p-3 rounded-xl border border-blue-100">
                        <div class="flex justify-between items-center text-xs font-bold text-slate-800 mb-2">
                            <span><i class="fa-solid fa-chevron-left text-[10px] mr-2"></i>Oktober 2026</span>
                            <span class="text-brand-600 text-[10px]">Hari Ini: 25 Okt</span>
                        </div>
                        <div class="grid grid-cols-7 gap-1 text-center text-[10px] font-semibold text-slate-500 mb-1">
                            <span>Sen</span><span>Sel</span><span>Rab</span><span>Kam</span><span>Jum</span><span>Sab</span><span>Min</span>
                        </div>
                        <div class="grid grid-cols-7 gap-1 text-center text-xs" id="calendar-days">
                            <span class="py-1 text-slate-300">26</span><span class="py-1 text-slate-300">27</span><span class="py-1 text-slate-300">28</span><span class="py-1 text-slate-300">29</span><span class="py-1 text-slate-300">30</span>
                            <button type="button" onclick="selectCalDate(this, '2026-10-24')" class="py-1 rounded-lg hover:bg-blue-100 font-medium">24</button>
                            <button type="button" onclick="selectCalDate(this, '2026-10-25')" class="py-1 rounded-lg bg-brand-600 text-white font-bold">25</button>
                            <button type="button" onclick="selectCalDate(this, '2026-10-26')" class="py-1 rounded-lg hover:bg-blue-100 font-medium">26</button>
                            <button type="button" onclick="selectCalDate(this, '2026-10-27')" class="py-1 rounded-lg hover:bg-blue-100 font-medium">27</button>
                            <button type="button" onclick="selectCalDate(this, '2026-10-28')" class="py-1 rounded-lg hover:bg-blue-100 font-medium">28</button>
                            <button type="button" onclick="selectCalDate(this, '2026-10-29')" class="py-1 rounded-lg hover:bg-blue-100 font-medium">29</button>
                            <button type="button" onclick="selectCalDate(this, '2026-10-30')" class="py-1 rounded-lg hover:bg-blue-100 font-medium">30</button>
                            <button type="button" onclick="selectCalDate(this, '2026-10-31')" class="py-1 rounded-lg hover:bg-blue-100 font-medium">31</button>
                        </div>
                    </div>
                    <input type="hidden" id="selected-date" value="2026-10-25">
                </div>

                <!-- Time Slot Selectors -->
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Pilih Waktu / Jam</label>
                    <div class="grid grid-cols-4 gap-2" id="time-slots">
                        <button type="button" onclick="selectTimeSlot(this, '09:00 WIB')" class="time-slot-btn py-1.5 rounded-lg border border-brand-600 bg-brand-600 text-white text-xs font-bold">09:00 WIB</button>
                        <button type="button" onclick="selectTimeSlot(this, '10:30 WIB')" class="time-slot-btn py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-medium">10:30 WIB</button>
                        <button type="button" onclick="selectTimeSlot(this, '13:00 WIB')" class="time-slot-btn py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-medium">13:00 WIB</button>
                        <button type="button" onclick="selectTimeSlot(this, '14:30 WIB')" class="time-slot-btn py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-medium">14:30 WIB</button>
                    </div>
                    <input type="hidden" id="selected-time" value="09:00 WIB">
                </div>

                <!-- Tipe Pertemuan -->
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Tipe Pertemuan</label>
                    <div class="grid grid-cols-2 gap-2">
                        <button type="button" id="type-offline-btn" onclick="setInterviewType('offline')" class="py-2 rounded-xl border border-brand-600 bg-brand-50 text-brand-600 text-xs font-semibold flex items-center justify-center gap-2">
                            <i class="fa-solid fa-building"></i> Offline (Tatap Muka)
                        </button>
                        <button type="button" id="type-online-btn" onclick="setInterviewType('online')" class="py-2 rounded-xl border border-slate-200 bg-white text-slate-500 text-xs font-semibold flex items-center justify-center gap-2">
                            <i class="fa-solid fa-video"></i> Online (Meet / Zoom)
                        </button>
                    </div>
                </div>

                <div>
                    <label id="location-label" class="block text-xs font-semibold text-slate-700 mb-1">Lokasi Pertemuan</label>
                    <input type="text" id="interview-location" value="Gedung Utama PT JobsKuy, Jl. Raya Cikarang No. 45, Bekasi" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-600" required>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Catatan Tambahan (Opsional)</label>
                    <textarea id="interview-notes" rows="2" placeholder="Harap membawa KTP asli & hadir 10 menit lebih awal." class="w-full bg-slate-50 border border-slate-200 rounded-xl p-2.5 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-600 resize-none"></textarea>
                </div>

                <div class="flex justify-end gap-2 pt-2 border-t border-slate-100">
                    <button type="button" onclick="closeInterviewModal()" class="px-4 py-2 bg-slate-100 text-slate-600 text-xs rounded-xl font-medium">Batal</button>
                    <button type="submit" class="px-5 py-2 bg-brand-600 hover:bg-brand-700 text-white text-xs rounded-xl font-bold shadow-md"><i class="fa-solid fa-paper-plane mr-1"></i> Kirim Undangan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal 2: Reject Step 1 Confirmation -->
    <div id="reject-step1-modal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-sm w-full p-6 text-center space-y-4 shadow-2xl border border-red-100">
            <div class="w-12 h-12 bg-red-100 text-red-500 rounded-2xl flex items-center justify-center mx-auto text-xl">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <div>
                <h3 class="text-base font-bold text-slate-900">Konfirmasi Penolakan</h3>
                <p class="text-xs text-slate-600 mt-1">Apakah Anda yakin ingin menolak kandidat <span class="font-bold text-slate-800">Budi Santoso</span>?</p>
            </div>
            <div class="flex gap-2 pt-2 border-t border-slate-100">
                <button onclick="closeRejectStep1Modal()" class="flex-1 py-2 bg-slate-100 text-slate-600 text-xs font-semibold rounded-xl">Batal</button>
                <button onclick="proceedToRejectStep2()" class="flex-1 py-2 bg-red-600 hover:bg-red-700 text-white text-xs font-bold rounded-xl shadow-md">Ya, Lanjutkan</button>
            </div>
        </div>
    </div>

    <!-- Modal 3: Reject Step 2 Encouraging Message Editor -->
    <div id="reject-step2-modal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-lg w-full p-6 relative space-y-3 shadow-2xl border border-red-100">
            <div class="flex justify-between items-center border-b border-slate-100 pb-3">
                <h3 class="text-sm font-bold text-slate-900 flex items-center gap-2"><i class="fa-regular fa-envelope text-red-500"></i> Pesan Penolakan Ramah</h3>
                <button onclick="closeRejectStep2Modal()" class="text-slate-400"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form onsubmit="handleFinalRejectSubmit(event)" class="space-y-3">
                <textarea id="rejection-template-text" rows="6" class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-red-500 leading-relaxed resize-none"></textarea>
                <p class="text-[11px] text-slate-400 italic">💡 Pesan ini berisi kata-kata penyemangat untuk menjaga pengalaman positif pelamar.</p>
                <div class="flex justify-end gap-2 pt-2 border-t border-slate-100">
                    <button type="button" onclick="closeRejectStep2Modal()" class="px-4 py-2 bg-slate-100 text-slate-600 text-xs rounded-xl font-medium">Batal</button>
                    <button type="submit" class="px-5 py-2 bg-red-600 hover:bg-red-700 text-white text-xs rounded-xl font-bold shadow-md"><i class="fa-solid fa-paper-plane mr-1"></i> Kirim Penolakan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal 4: Document Preview -->
    <div id="doc-modal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-md w-full p-5 space-y-3 shadow-2xl border border-blue-100">
            <div class="flex justify-between items-center border-b border-slate-100 pb-2">
                <h3 id="modal-doc-title" class="text-xs font-bold text-slate-800">Pratinjau Dokumen</h3>
                <button onclick="closeDocModal()" class="text-slate-400"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div id="doc-preview-body" class="bg-brand-50 rounded-xl h-52 border border-blue-100 flex flex-col items-center justify-center p-4 text-center"></div>
            <button onclick="closeDocModal()" class="w-full py-2 bg-slate-100 text-slate-700 text-xs font-semibold rounded-xl">Tutup</button>
        </div>
    </div>

    <!-- Modal 5: Video Player Modal -->
    <div id="video-modal" class="fixed inset-0 bg-slate-950/80 backdrop-blur-md z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-2xl w-full p-4 relative space-y-2">
            <div class="flex justify-between items-center pb-2 border-b border-slate-100">
                <span class="text-xs font-bold text-slate-800"><i class="fa-solid fa-circle-play text-brand-600 mr-1"></i> Video Perkenalan Diri - Budi Santoso</span>
                <button onclick="closeVideoModal()" class="text-slate-400 hover:text-slate-700"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="aspect-video bg-slate-900 rounded-xl overflow-hidden relative flex items-center justify-center">
                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover opacity-60">
                <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-4 bg-black/30 text-white">
                    <div class="w-14 h-14 rounded-full bg-brand-600 flex items-center justify-center text-xl mb-2 animate-pulse"><i class="fa-solid fa-play ml-1"></i></div>
                    <p class="text-xs font-bold">Memutar Video (00:58)</p>
                    <p class="text-[11px] text-slate-200 mt-1">"Halo Bapak/Ibu, nama saya Budi Santoso, domisili Bandung..."</p>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Logic -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('rejection-template-text').value = 
`Halo Budi Santoso,\n\nTerima kasih telah melamar untuk posisi Office Boy di perusahaan kami.\n\nSetelah meninjau profil Anda, saat ini kami memutuskan untuk melanjutkan kandidat lain yang kriterianya sesuai dengan kebutuhan mendesak tim kami.\n\nProfil Anda sangat baik dan kami sangat mengapresiasi antusiasme Anda. Tetap semangat dan semoga sukses untuk perjalanan karir Anda ke depan!\n\nSalam hangat,\nTim JobsKuy`;
        });

        function showToast(msg, type = 'success') {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            const color = type === 'success' ? 'bg-emerald-600' : 'bg-red-600';
            toast.className = `pointer-events-auto ${color} text-white px-4 py-2.5 rounded-xl shadow-xl text-xs font-semibold flex items-center gap-2 transition duration-300`;
            toast.innerHTML = `<i class="fa-solid ${type === 'success' ? 'fa-circle-check' : 'fa-circle-xmark'}"></i> <span>${msg}</span>`;
            container.appendChild(toast);
            setTimeout(() => toast.remove(), 3000);
        }

        // Calendar & Time Selectors
        function selectCalDate(btn, date) {
            document.querySelectorAll('#calendar-days button').forEach(b => b.className = 'py-1 rounded-lg hover:bg-blue-100 font-medium');
            btn.className = 'py-1 rounded-lg bg-brand-600 text-white font-bold';
            document.getElementById('selected-date').value = date;
        }

        function selectTimeSlot(btn, time) {
            document.querySelectorAll('.time-slot-btn').forEach(b => b.className = 'time-slot-btn py-1.5 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 text-xs font-medium');
            btn.className = 'time-slot-btn py-1.5 rounded-lg border border-brand-600 bg-brand-600 text-white text-xs font-bold';
            document.getElementById('selected-time').value = time;
        }

        function setInterviewType(type) {
            const offBtn = document.getElementById('type-offline-btn');
            const onBtn = document.getElementById('type-online-btn');
            const locInput = document.getElementById('interview-location');
            if (type === 'offline') {
                offBtn.className = 'py-2 rounded-xl border border-brand-600 bg-brand-50 text-brand-600 text-xs font-semibold flex items-center justify-center gap-2';
                onBtn.className = 'py-2 rounded-xl border border-slate-200 bg-white text-slate-500 text-xs font-semibold flex items-center justify-center gap-2';
                locInput.value = 'Gedung Utama PT JobsKuy, Jl. Raya Cikarang No. 45, Bekasi';
            } else {
                onBtn.className = 'py-2 rounded-xl border border-brand-600 bg-brand-50 text-brand-600 text-xs font-semibold flex items-center justify-center gap-2';
                offBtn.className = 'py-2 rounded-xl border border-slate-200 bg-white text-slate-500 text-xs font-semibold flex items-center justify-center gap-2';
                locInput.value = 'https://meet.google.com/abc-defg-hij';
            }
        }

        // Modal triggers
        function openInterviewModal() { document.getElementById('interview-modal').classList.remove('hidden'); }
        function closeInterviewModal() { document.getElementById('interview-modal').classList.add('hidden'); }
        function handleSendInterview(e) {
            e.preventDefault();
            const date = document.getElementById('selected-date').value;
            const time = document.getElementById('selected-time').value;
            closeInterviewModal();
            document.getElementById('current-status-badge').className = 'bg-emerald-50 text-emerald-600 border border-emerald-200 text-xs px-3 py-1 rounded-full font-semibold flex items-center gap-1.5';
            document.getElementById('current-status-badge').innerHTML = `<span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> Wawancara: ${date} (${time})`;
            showToast(`Undangan wawancara berhasil dikirim ke Budi Santoso!`, 'success');
        }

        function openRejectStep1Modal() { document.getElementById('reject-step1-modal').classList.remove('hidden'); }
        function closeRejectStep1Modal() { document.getElementById('reject-step1-modal').classList.add('hidden'); }
        function proceedToRejectStep2() { closeRejectStep1Modal(); document.getElementById('reject-step2-modal').classList.remove('hidden'); }
        function closeRejectStep2Modal() { document.getElementById('reject-step2-modal').classList.add('hidden'); }
        function handleFinalRejectSubmit(e) {
            e.preventDefault();
            closeRejectStep2Modal();
            document.getElementById('current-status-badge').className = 'bg-red-50 text-red-600 border border-red-200 text-xs px-3 py-1 rounded-full font-semibold flex items-center gap-1.5';
            document.getElementById('current-status-badge').innerHTML = `<span class="w-2 h-2 rounded-full bg-red-500"></span> Ditolak`;
            showToast('Pesan penolakan telah dikirimkan.', 'danger');
        }

        function previewDocument(title, type) {
            document.getElementById('modal-doc-title').innerText = `Pratinjau: ${title}`;
            document.getElementById('doc-preview-body').innerHTML = `
                <i class="fa-solid fa-file-pdf text-4xl text-brand-600 mb-2"></i>
                <p class="text-xs font-bold text-slate-800">${title}</p>
                <p class="text-[10px] text-slate-500 mt-0.5">Dokumen terverifikasi oleh tim JobsKuy.</p>`;
            document.getElementById('doc-modal').classList.remove('hidden');
        }
        function closeDocModal() { document.getElementById('doc-modal').classList.add('hidden'); }
        function playVideo() { document.getElementById('video-modal').classList.remove('hidden'); }
        function closeVideoModal() { document.getElementById('video-modal').classList.add('hidden'); }

        function openInterviewModal() { document.getElementById('interview-modal').classList.remove('hidden'); }
        function closeInterviewModal() { document.getElementById('interview-modal').classList.add('hidden'); }
        
        function handleSendInterview(e) {
            e.preventDefault();
            
            // Simpan data jadwal ke localStorage agar Seeker bisa baca
            const interviewData = {
                status: 'interview',
                date: document.getElementById('selected-date').value,
                time: document.getElementById('selected-time').value,
                location: document.getElementById('interview-location').value,
                notes: document.getElementById('interview-notes').value || '-'
            };
            localStorage.setItem('jobskuy_status', JSON.stringify(interviewData));

            closeInterviewModal();
            showToast('Undangan interview berhasil dikirim ke Budi Santoso!', 'success');
            document.getElementById('current-status-badge').innerHTML = '<span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> Interview Dijadwalkan';
        }

        // Modal Interaksi: Penolakan
        function openRejectStep1Modal() { document.getElementById('reject-step1-modal').classList.remove('hidden'); }
        function closeRejectStep1Modal() { document.getElementById('reject-step1-modal').classList.add('hidden'); }
        function proceedToRejectStep2() { closeRejectStep1Modal(); document.getElementById('reject-step2-modal').classList.remove('hidden'); }
        function closeRejectStep2Modal() { document.getElementById('reject-step2-modal').classList.add('hidden'); }
        
        function handleFinalRejectSubmit(e) {
            e.preventDefault();
            
            // Simpan status ditolak ke localStorage
            const rejectData = { status: 'rejected' };
            localStorage.setItem('jobskuy_status', JSON.stringify(rejectData));

            closeRejectStep2Modal();
            showToast('Pesan penolakan ramah telah dikirim.', 'error');
            document.getElementById('current-status-badge').innerHTML = '<span class="w-2 h-2 rounded-full bg-slate-400"></span> Kandidat Ditolak';
        }

        function previewDocument(title) { alert('Pratinjau Dokumen: ' + title); }
        function playVideo() { alert('Memutar video perkenalan kandidat.'); }
    </script>
</body>
</html>