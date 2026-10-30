@extends('Recruiter.layout')

@section('title', 'JobsKuy - Profil Pelamar')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/profil-pelamar.css') }}">
@endpush

@section('content')

    @php
        $applicant = $application->applicant ?? null;
        $applicantName = $applicant->name ?? 'Nama Pelamar';
        $jobTitle = $application->jobListing->title ?? 'Posisi Dilamar';
        $status = $application->status ?? 'pending';

        $statusLabels = [
            'Diproses' => 'Sedang Diproses',
            'pending' => 'Perlu Dievaluasi',
            'viewed' => 'Dilihat oleh Pemilik',
            'review' => 'Sedang Ditinjau',
            'interview' => 'Wawancara',
            'accepted' => 'Diterima',
            'rejected' => 'Ditolak',
        ];

        $statusLabel = $statusLabels[$status] ?? ucfirst($status);

        $experiences = $applicant->experiences ?? collect();
        $documents = $application->documents ?? collect();

        $skills = $applicant->skills ?? [];

        if ($skills instanceof \Illuminate\Support\Collection) {
            $skills = $skills->all();
        }

        if (!is_array($skills)) {
            $skills = [];
        }

        $hasSkills = count($skills) > 0;

        $currentStatus = strtolower(trim($status));

        $savedInterviewStartTime = $application->interview_start_time
            ? substr((string) $application->interview_start_time, 0, 5)
            : '';

        $savedInterviewEndTime = $application->interview_end_time
            ? substr((string) $application->interview_end_time, 0, 5)
            : '';

        $savedMeetingType = old('meeting_type', $application->meeting_type ?? 'offline');

        $savedInterviewDate = $application->interview_date ? $application->interview_date->format('Y-m-d') : '';

        $statusSteps = [
            [
                'key' => 'pending',
                'label' => 'Lamaran Terkirim',
                'date' => $application->created_at,
            ],
            [
                'key' => 'viewed',
                'label' => 'Dilihat oleh Pemilik',
                'date' => $application->viewed_at ?? null,
            ],
            [
                'key' => 'review',
                'label' => 'Berkas Direview',
                'date' => $application->reviewed_at ?? null,
            ],
            [
                'key' => 'interview',
                'label' => 'Wawancara',
                'date' => $application->interview_date ?? null,
            ],
        ];

        $statusOrder = [
            'pending' => 0,
            'viewed' => 1,
            'review' => 2,
            'interview' => 3,
            'accepted' => 3,
            'rejected' => 3,
            'diproses' => 0,
        ];

        $currentStep = $statusOrder[$currentStatus] ?? 0;
    @endphp

    {{-- KONFIGURASI UNTUK JAVASCRIPT --}}
    <div id="profile-config" data-applicant-name="{{ $applicantName }}" data-job-title="{{ $jobTitle }}"
        data-current-status="{{ $status }}" hidden>
    </div>

    <div id="toast-container" class="toast-container-custom" aria-live="polite"></div>

    <div class="profile-page">

        <div class="profile-page-heading">
            <div>
                <h1>Profil Pelamar</h1>
                <p>Informasi lengkap kandidat untuk posisi {{ $jobTitle }}</p>
            </div>

            <a href="{{ route('recruiter.pelamar.index') }}" class="btn-back">
                Kembali
            </a>
        </div>

        <div class="row g-4">

            <section class="col-lg-8">

                {{-- PROFIL KANDIDAT --}}
                <article class="content-card candidate-card">
                    <div class="candidate-avatar">
                        @if ($applicant?->photo_path)
                            <img src="{{ asset('storage/' . $applicant->photo_path) }}" alt="Foto {{ $applicantName }}">
                        @else
                            <div class="avatar-placeholder">
                                {{ strtoupper(mb_substr($applicantName, 0, 1)) }}
                            </div>
                        @endif
                    </div>

                    <div class="candidate-details">
                        <div class="candidate-title-row">
                            <h2>{{ $applicantName }}</h2>

                            <span class="verified-badge">
                                <i class="fa-solid fa-circle-check"></i>
                                Profil Pelamar
                            </span>
                        </div>

                        <p class="applied-position">
                            <i class="fa-solid fa-user-tag"></i>
                            Posisi Dilamar:
                            <strong>{{ $jobTitle }}</strong>
                        </p>

                        <div class="candidate-facts">
                            <div class="fact-item">
                                <span>Domisili</span>
                                <strong>
                                    <i class="fa-solid fa-location-dot icon-danger"></i>
                                    {{ $applicant?->domisili ?: 'Belum diisi' }}
                                </strong>
                            </div>

                            <div class="fact-item">
                                <span>Pengalaman</span>
                                <strong>
                                    <i class="fa-solid fa-briefcase icon-primary"></i>
                                    {{ $applicant?->pengalaman ?: 'Belum diisi' }}
                                </strong>
                            </div>

                            <div class="fact-item">
                                <span>Pendidikan</span>
                                <strong>
                                    <i class="fa-solid fa-graduation-cap icon-secondary"></i>
                                    {{ $applicant?->pendidikan ?: 'Belum diisi' }}
                                </strong>
                            </div>

                            <div class="fact-item">
                                <span>Ketersediaan</span>
                                <strong>
                                    <i class="fa-solid fa-bolt icon-success"></i>
                                    {{ $applicant?->ketersediaan ?: 'Belum diisi' }}
                                </strong>
                            </div>
                        </div>
                    </div>
                </article>

                {{-- VIDEO PERKENALAN --}}
                <article class="content-card">
                    <div class="section-heading">
                        <h2>
                            <i class="fa-solid fa-video icon-primary"></i>
                            Video Perkenalan Diri
                        </h2>
                    </div>

                    @if ($applicant?->intro_video_path)
                        <video class="candidate-video" controls preload="metadata">
                            <source src="{{ asset('storage/' . $applicant->intro_video_path) }}" type="video/mp4">
                            Browser Anda tidak mendukung pemutaran video.
                        </video>
                    @else
                        <div class="empty-state video-empty">
                            <i class="fa-solid fa-circle-play"></i>
                            <p>Pelamar belum mengunggah video perkenalan.</p>
                        </div>
                    @endif
                </article>

                {{-- PENGALAMAN KERJA --}}
                <article class="content-card">
                    <div class="section-heading">
                        <h2>
                            <i class="fa-solid fa-briefcase icon-primary"></i>
                            Pengalaman Kerja
                        </h2>
                    </div>

                    @forelse($experiences as $experience)
                        <div class="experience-item">
                            <h3>
                                {{ $experience->position ?? ($experience->jabatan ?? 'Posisi pekerjaan') }}
                            </h3>

                            <p class="experience-company">
                                {{ $experience->company ?? ($experience->perusahaan ?? 'Nama perusahaan') }}
                            </p>

                            <p class="experience-period">
                                {{ $experience->period ?? ($experience->periode ?? '') }}
                            </p>

                            <p class="experience-description">
                                {{ $experience->description ?? ($experience->deskripsi ?? '') }}
                            </p>
                        </div>
                    @empty
                        <div class="empty-state">
                            <i class="fa-solid fa-briefcase"></i>
                            <p>Belum ada pengalaman kerja yang ditambahkan.</p>
                        </div>
                    @endforelse
                </article>

                {{-- BIO DAN KEAHLIAN --}}
                <article class="content-card">
                    <div class="section-heading">
                        <h2>
                            <i class="fa-solid fa-address-card icon-primary"></i>
                            Tentang Kandidat (BIO)
                        </h2>
                    </div>

                    <div class="bio-content">
                        {{ $applicant?->bio ?: 'Pelamar belum menambahkan deskripsi diri.' }}
                    </div>

                    @if ($hasSkills)
                        <div class="skill-list">
                            @foreach ($skills as $skill)
                                <span class="skill-badge">{{ $skill }}</span>
                            @endforeach
                        </div>
                    @endif
                </article>

                {{-- DOKUMEN LAMPIRAN --}}
                <article class="content-card">
                    <div class="section-heading">
                        <h2>
                            <i class="fa-solid fa-folder-closed icon-secondary"></i>
                            Dokumen Lampiran
                        </h2>
                    </div>

                    <div class="row g-3">
                        @forelse($documents as $document)
                            <div class="col-md-6">
                                <div class="document-card">
                                    <div class="document-info">
                                        <i class="fa-solid fa-file-pdf document-icon"></i>

                                        <div>
                                            <h3>
                                                {{ $document->name ?? ($document->document_type ?? 'Dokumen Pelamar') }}
                                            </h3>

                                            <span class="document-status">
                                                {{ $document->status ?? 'Belum diverifikasi' }}
                                            </span>
                                        </div>
                                    </div>

                                    @if ($document->file_path)
                                        <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank"
                                            rel="noopener noreferrer" class="btn btn-document">
                                            Lihat
                                        </a>
                                    @else
                                        <button type="button" class="btn btn-document" disabled>
                                            Tidak tersedia
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="empty-state">
                                    <i class="fa-solid fa-folder-open"></i>
                                    <p>Belum ada dokumen yang dilampirkan.</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </article>

            </section>

            <aside class="col-lg-4">
                <div class="content-card recruitment-card">

                    <div class="section-heading">
                        <h2>
                            <i class="fa-solid fa-gavel icon-primary"></i>
                            Keputusan Rekrutmen
                        </h2>
                    </div>

                    <p class="section-description">
                        Pilih tindakan untuk kandidat ini.
                    </p>

                    <div class="decision-actions">
                        <button type="button" class="btn btn-interview" onclick="openInterviewModal()">
                            <span>
                                <i class="fa-regular fa-calendar-check"></i>
                                Jadwalkan Interview
                            </span>
                            <small>Atur tanggal dan lokasi wawancara</small>
                        </button>

                        <button type="button" class="btn btn-reject" onclick="openRejectStep1Modal()">
                            <span>
                                <i class="fa-solid fa-user-xmark"></i>
                                Tolak Kandidat
                            </span>
                            <small>Kirim pesan penolakan yang ramah</small>
                        </button>
                    </div>

                    {{-- KONTAK --}}
                    <div class="quick-contact">
                        <h3>Kontak Cepat Pelamar</h3>

                        @if ($applicant?->phone)
                            <a class="contact-link contact-phone"
                                href="tel:{{ preg_replace('/[^0-9+]/', '', $applicant->phone) }}">
                                <span>
                                    <i class="fa-solid fa-phone"></i>
                                    Telepon Pelamar
                                </span>
                                <i class="fa-solid fa-chevron-right"></i>
                            </a>
                        @endif

                        @if ($applicant?->whatsapp)
                            @php
                                $whatsapp = preg_replace('/\D/', '', $applicant->whatsapp);

                                if (str_starts_with($whatsapp, '0')) {
                                    $whatsapp = '62' . substr($whatsapp, 1);
                                }
                            @endphp

                            <a class="contact-link contact-whatsapp" href="https://wa.me/{{ $whatsapp }}"
                                target="_blank" rel="noopener noreferrer">
                                <span>
                                    <i class="fa-brands fa-whatsapp"></i>
                                    WhatsApp Pelamar
                                </span>
                                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                            </a>
                        @endif

                        @unless ($applicant?->phone || $applicant?->whatsapp)
                            <p class="contact-empty">
                                Informasi kontak belum tersedia.
                            </p>
                        @endunless
                    </div>

                    {{-- STATUS LAMARAN --}}
                    <div class="status-progress-card">

                        {{-- JUDUL STATUS --}}
                        <div class="status-progress-heading">
                            <h3>Status Lamaran</h3>
                        </div>

                        {{-- TIMELINE STATUS --}}
                        <div class="status-progress-list">
                            @foreach ($statusSteps as $index => $step)
                                @php
                                    $isActive = $currentStep >= $index;
                                @endphp

                                <div class="status-progress-item {{ $isActive ? 'is-active' : 'is-pending' }}">
                                    <div class="status-progress-marker">
                                        @if ($isActive)
                                            <i class="fa-solid fa-check"></i>
                                        @else
                                            <span>{{ $index + 1 }}</span>
                                        @endif
                                    </div>

                                    <div class="status-progress-content">
                                        <div class="status-progress-label">
                                            {{ $step['label'] }}
                                        </div>

                                        <div class="status-progress-date">
                                            @if ($step['date'])
                                                @if ($step['key'] === 'interview')
                                                    {{ \Carbon\Carbon::parse($step['date'])->format('d M Y') }}
                                                @else
                                                    {{ \Carbon\Carbon::parse($step['date'])->format('d M Y, H:i') }}
                                                @endif
                                            @else
                                                Belum diperbarui
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- FORM UPDATE STATUS --}}
                        <div class="status-edit-card">
                            <div class="status-edit-heading">
                                <h4>
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    Ubah Status Lamaran
                                </h4>
                                <p>Pilih status baru untuk memperbarui progres kandidat.</p>
                            </div>

                            <form action="{{ route('recruiter.lamaran.status.update', $application) }}" method="POST"
                                class="status-edit-form">

                                @csrf
                                @method('PATCH')

                                <label for="application-status-select">
                                    Status baru
                                </label>

                                <select name="status" id="application-status-select" required>

                                    <option value="pending" @selected($currentStatus === 'pending')>
                                        Lamaran Terkirim
                                    </option>

                                    <option value="viewed" @selected($currentStatus === 'viewed')>
                                        Dilihat oleh Pemilik
                                    </option>

                                    <option value="review" @selected($currentStatus === 'review')>
                                        Berkas Direview
                                    </option>

                                    <option value="interview" @selected($currentStatus === 'interview')>
                                        Wawancara
                                    </option>

                                </select>

                                <button type="submit" class="btn-save-status">
                                    <i class="fa-solid fa-floppy-disk"></i>
                                    Simpan Status
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </aside>

        </div>
    </div>

    {{-- MODAL INTERVIEW --}}
    <div id="interview-modal" class="custom-modal"
        data-open-on-load="{{ ($errors->any() && old('status') === 'interview') || session('open_interview_modal') ? 'true' : 'false' }}"
        aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="interview-modal-title">

        <div class="modal-panel modal-panel-wide">
            <div class="modal-heading">
                <div>
                    <h3 id="interview-modal-title">
                        <i class="fa-regular fa-calendar-plus icon-primary"></i>
                        Jadwalkan Interview
                    </h3>
                    <p>Pelamar: <strong>{{ $applicantName }}</strong></p>
                </div>

                <button type="button" class="modal-close" onclick="closeInterviewModal()" aria-label="Tutup modal">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            {{-- FORM PENJADWALAN INTERVIEW --}}
            <form id="interview-form" action="{{ route('recruiter.lamaran.status.update', $application) }}"
                method="POST">

                @csrf
                @method('PATCH')

                {{-- Status wajib interview --}}
                <input type="hidden" name="status" value="interview">

                {{-- TANGGAL --}}
                <label for="interview-date" class="form-label">
                    Tanggal wawancara
                </label>

                <input type="date" id="interview-date" name="interview_date" class="form-control"
                    min="{{ now()->toDateString() }}" value="{{ old('interview_date', $savedInterviewDate) }}" required>

                {{-- WAKTU INTERVIEW --}}
                <div class="interview-time-row mt-3">

                    {{-- WAKTU MULAI --}}
                    <div class="form-group">
                        <label for="interview-start-time" class="form-label">
                            Waktu Mulai <span class="required">*</span>
                        </label>

                        <input type="time" id="interview-start-time" name="interview_start_time" class="form-control"
                            value="{{ old('interview_start_time', $savedInterviewStartTime) }}" required>

                        @error('interview_start_time')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- WAKTU SELESAI --}}
                    <div class="form-group">
                        <label for="interview-end-time" class="form-label">
                            Waktu Selesai <span class="required">*</span>
                        </label>

                        <input type="time" id="interview-end-time" name="interview_end_time" class="form-control"
                            value="{{ old('interview_end_time', $savedInterviewEndTime) }}" required>

                        @error('interview_end_time')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                {{-- TIPE PERTEMUAN --}}
                <label class="form-label mt-3">
                    Tipe pertemuan
                </label>

                <div class="meeting-type-options">
                    <button type="button" id="type-offline-btn"
                        class="meeting-type {{ $savedMeetingType === 'offline' ? 'active' : '' }}"
                        aria-pressed="{{ $savedMeetingType === 'offline' ? 'true' : 'false' }}"
                        onclick="setInterviewType('offline')">

                        <i class="fa-solid fa-building"></i>
                        Offline
                    </button>

                    <button type="button" id="type-online-btn"
                        class="meeting-type {{ $savedMeetingType === 'online' ? 'active' : '' }}"
                        aria-pressed="{{ $savedMeetingType === 'online' ? 'true' : 'false' }}"
                        onclick="setInterviewType('online')">

                        <i class="fa-solid fa-video"></i>
                        Online
                    </button>
                </div>

                <input type="hidden" name="meeting_type" id="meeting-type" value="{{ $savedMeetingType }}">

                {{-- LOKASI ATAU LINK MEETING --}}
                <label for="interview-location" class="form-label mt-3" id="location-label">

                    {{ $savedMeetingType === 'online' ? 'Link Meeting' : 'Lokasi Pertemuan' }}
                </label>

                <input type="text" id="interview-location" name="interview_location" class="form-control"
                    value="{{ old('interview_location', $application->interview_location) }}"
                    placeholder="{{ $savedMeetingType === 'online' ? 'Masukkan tautan meeting' : 'Masukkan alamat lokasi wawancara' }}"
                    required>

                {{-- CATATAN INTERVIEW --}}
                <label for="interview-notes" class="form-label mt-3">
                    Catatan tambahan (opsional)
                </label>

                <textarea id="interview-notes" name="interview_notes" class="form-control" rows="3"
                    placeholder="Harap membawa dokumen yang diperlukan.">{{ old('interview_notes', $application->interview_notes) }}</textarea>

                {{-- PESAN VALIDASI --}}
                @if ($errors->any() && old('status') === 'interview')
                    <div class="alert alert-danger mt-3" role="alert">
                        <strong>Data belum berhasil disimpan.</strong>

                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- TOMBOL --}}
                <div class="modal-actions">
                    <button type="button" class="btn btn-light" onclick="closeInterviewModal()">
                        Batal
                    </button>

                    <button type="submit" class="btn btn-interview-submit">
                        <i class="fa-solid fa-paper-plane"></i>
                        Simpan Jadwal Interview
                    </button>
                </div>

                <p class="form-note">
                    Jadwal wawancara akan disimpan ke database setelah berhasil diproses.
                </p>
            </form>
        </div>
    </div>

    {{-- MODAL KONFIRMASI PENOLAKAN --}}
    <div id="reject-step1-modal" class="custom-modal" aria-hidden="true" role="dialog" aria-modal="true"
        aria-labelledby="reject-step1-title">

        <div class="modal-panel modal-panel-small text-center">
            <div class="confirmation-icon">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>

            <h3 id="reject-step1-title">Konfirmasi Penolakan</h3>

            <p>
                Apakah Anda yakin ingin menolak kandidat
                <strong>{{ $applicantName }}</strong>?
            </p>

            <div class="modal-actions">
                <button type="button" class="btn btn-light" onclick="closeRejectStep1Modal()">
                    Batal
                </button>

                <button type="button" class="btn btn-danger" onclick="proceedToRejectStep2()">
                    Ya, Lanjutkan
                </button>
            </div>
        </div>
    </div>

    {{-- MODAL PESAN PENOLAKAN --}}
    <div id="reject-step2-modal" class="custom-modal" aria-hidden="true" role="dialog" aria-modal="true"
        aria-labelledby="reject-step2-title">

        <div class="modal-panel modal-panel-wide">
            <div class="modal-heading">
                <h3 id="reject-step2-title">
                    <i class="fa-regular fa-envelope icon-danger"></i>
                    Pesan Penolakan Ramah
                </h3>

                <button type="button" class="modal-close" onclick="closeRejectStep2Modal()" aria-label="Tutup modal">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form id="reject-form">
                <label for="rejection-template-text" class="form-label">
                    Isi pesan penolakan
                </label>

                <textarea id="rejection-template-text" class="form-control" rows="7" required>Halo {{ $applicantName }},

Terima kasih telah melamar untuk posisi {{ $jobTitle }}.

Setelah meninjau profil Anda, saat ini kami memutuskan untuk melanjutkan kandidat lain yang lebih sesuai dengan kebutuhan tim.

Kami mengapresiasi waktu dan antusiasme Anda. Semoga sukses untuk perjalanan karier Anda ke depan.

Salam hangat,
Tim JobsKuy</textarea>

                <p class="form-note">
                    Pesan ini belum dikirim kepada pelamar dan status lamaran
                    belum berubah.
                </p>

                <div class="modal-actions">
                    <button type="button" class="btn btn-light" onclick="closeRejectStep2Modal()">
                        Batal
                    </button>

                    <button type="submit" class="btn btn-danger">
                        <i class="fa-solid fa-paper-plane"></i>
                        Siapkan Penolakan
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
    @parent
    <script
        src="{{ asset('js/profil-pelamar.js') }}?v={{ file_exists(public_path('js/profil-pelamar.js')) ? filemtime(public_path('js/profil-pelamar.js')) : time() }}"
        defer></script>
@endsection
