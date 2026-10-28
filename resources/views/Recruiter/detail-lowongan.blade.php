@extends('Recruiter.layout')

@section('title', 'Detail Lowongan Kerja')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/color-palette.css') }}">
<link rel="stylesheet" href="{{ asset('css/detail-lowongan.css') }}">
@endpush

@section('content')
<div class="detail-lowongan-page">

    <main class="dashboard-container">
        <header class="header-section">
            <h1 class="page-title">Detail Lowongan Kerja</h1>
        </header>

        <div class="divider"></div>

        @if (session('success'))
            <div class="success-message" role="status">
                <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        
        @if ($errors->any())
            <div class="alert-validation" role="alert">
                <div class="alert-validation-icon">
                    <i class="fa-solid fa-circle-exclamation" aria-hidden="true"></i>
                </div>

                <div class="alert-validation-content">
                    <strong>Periksa kembali data Anda</strong>
                    <p>Beberapa informasi belum sesuai.</p>

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif


        <form
            action="{{ route('recruiter.job.update', ['jobListing' => $job->id]) }}"
            method="POST"
            id="jobDetailForm"
        >
            @csrf
            @method('PUT')

            {{-- Nama pekerjaan --}}
            <div class="form-group">
                <label class="form-label" for="title">
                    Nama Pekerjaan
                </label>

                <div class="view-mode" id="view-nama">
                    {{ $job->title }}
                </div>

                <div class="edit-mode" hidden>
                    <input
                        type="text"
                        id="title"
                        name="namaPekerjaan"
                        class="form-input"
                        value="{{ old('namaPekerjaan', $job->title) }}"
                        minlength="3"
                        maxlength="150"
                        required
                    >
                </div>
            </div>

            {{-- Deskripsi pekerjaan --}}
            <div class="form-group">
                <label class="form-label" for="description">
                    Deskripsi Pekerjaan
                </label>

                <div class="view-mode" id="view-deskripsi">
                    {{ $job->description ?: 'Belum ada deskripsi.' }}
                </div>

                <div class="edit-mode" hidden>
                    <textarea
                        id="description"
                        name="deskripsi"
                        class="form-textarea"
                        minlength="10"
                        required
                    >{{ old('deskripsi', $job->description) }}</textarea>
                </div>
            </div>

            {{-- Syarat dokumen tambahan --}}
            <div class="form-group">
                <label class="form-label">
                    Syarat Dokumen Tambahan
                </label>

                <div class="view-mode">
                    <div class="badge-container" id="viewDocContainer">
                        @forelse ($job->syaratDokumen as $dokumen)
                            <span class="doc-badge">
                                <i
                                    class="fa-solid fa-file-lines"
                                    aria-hidden="true"
                                ></i>
                                {{ $dokumen->nama_dokumen }}
                            </span>
                        @empty
                            <span>Belum ada syarat dokumen.</span>
                        @endforelse
                    </div>
                </div>

                <div class="edit-mode" hidden>
                    <div
                        class="badge-container"
                        id="editBadgeContainer"
                    >
                        @foreach ($job->syaratDokumen as $dokumen)
                            <span class="doc-badge">
                                <span>
                                    <i
                                        class="fa-solid fa-file-lines"
                                        aria-hidden="true"
                                    ></i>
                                    {{ $dokumen->nama_dokumen }}
                                </span>

                                <button
                                    type="button"
                                    class="remove-document"
                                    aria-label="Hapus dokumen {{ $dokumen->nama_dokumen }}"
                                >
                                    &times;
                                </button>

                                <input
                                    type="hidden"
                                    name="dokumen[]"
                                    value="{{ $dokumen->nama_dokumen }}"
                                >
                            </span>
                        @endforeach
                    </div>

                    <div class="doc-input-wrapper">
                        <input
                            type="text"
                            id="inputNamaDokumen"
                            class="form-input"
                            placeholder="Contoh: SIM A"
                            maxlength="30"
                        >

                        <button
                            type="button"
                            class="btn-action btn-ubah"
                            id="btnTambahDokumen"
                        >
                            + Tambah
                        </button>
                    </div>

                    <small id="errorMsgDokumen" hidden>
                        Nama dokumen wajib diisi, maksimal 30 karakter,
                        tidak boleh duplikat, dan minimal satu dokumen
                        harus tersedia.
                    </small>
                </div>
            </div>

            {{-- Batas maksimal pelamar --}}
            <div class="form-group">
                <label class="form-label" for="quota">
                    Batas Maksimal Pelamar Kerja
                </label>

                <div class="view-mode" id="view-batas">
                    {{ $job->quota }}
                </div>

                <div class="edit-mode" hidden>
                    <input
                        type="number"
                        id="quota"
                        name="kuota"
                        class="form-input"
                        value="{{ old('kuota', $job->quota) }}"
                        min="1"
                        max="1000"
                        step="1"
                        required
                    >
                </div>
            </div>

            {{-- Rentang gaji --}}
            <div class="form-group">
                <label class="form-label" for="salary">
                    Rentang Gaji
                </label>

                <div class="view-mode" id="view-gaji">
                    {{ $job->salary ?: 'Belum ditentukan' }}
                </div>

                <div class="edit-mode" hidden>
                    <input
                        type="text"
                        id="salary"
                        name="gaji"
                        class="form-input"
                        value="{{ old('gaji', $job->salary) }}"
                        maxlength="100"
                        required
                    >
                </div>
            </div>

            {{-- Alamat pekerjaan --}}
            <div class="form-group">
                <label class="form-label" for="address">
                    Alamat Detail Pekerjaan
                </label>

                {{-- Mode tampilan --}}
                <div class="view-mode">
                    <div class="alamat-wrap">
                        <img
                            src="{{ asset('images/gmaps.png') }}"
                            alt="Peta lokasi pekerjaan"
                            class="peta"
                        >

                        <div class="alamat-value" id="view-alamat">
                            {{ $job->address ?: 'Belum ditentukan' }}
                        </div>
                    </div>
                </div>

                {{-- Mode ubah --}}
                <div class="edit-mode" hidden>
                    <div class="alamat-wrap">
                        <img
                            src="{{ asset('images/gmaps.png') }}"
                            alt="Peta lokasi pekerjaan"
                            class="peta"
                        >

                        <textarea
                            id="address"
                            name="alamat"
                            class="form-textarea"
                            maxlength="2000"
                            required
                        >{{ old('alamat', $job->address) }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Status lowongan --}}
            <div class="form-group">
                <label class="form-label" for="status">
                    Status Lowongan
                </label>

                <div class="view-mode" id="view-status">
                    {{ $job->status ? 'Aktif' : 'Nonaktif' }}
                </div>

                <div class="edit-mode" hidden>
                    <label class="switch" for="status">
                        <input
                            type="checkbox"
                            id="status"
                            name="status"
                            value="1"
                            @checked((bool) old('status', $job->status))
                        >
                        <span class="slider"></span>
                    </label>

                    <span>Aktifkan lowongan</span>
                </div>
            </div>

            {{-- Tombol aksi --}}
            <div class="form-action-container">
                <button
                    type="button"
                    id="btnToggleEdit"
                    class="btn-action btn-ubah"
                >
                    Ubah
                </button>

                <a
                    href="{{ route('recruiter.lowongan.index') }}"
                    class="btn-action btn-kembali"
                >
                    Kembali
                </a>
            </div>
        </form>
    </main>

    {{-- Modal konfirmasi simpan --}}
    <div id="successModal" class="modal-overlay" hidden>
        <div
            class="modal-card"
            role="dialog"
            aria-modal="true"
            aria-labelledby="modalTitle"
            aria-describedby="modalSubtitle"
            tabindex="-1"
        >
            <div class="modal-icon-container" aria-hidden="true">
                <i class="fa-solid fa-circle-question modal-check-icon"></i>
            </div>

            <h2 class="modal-title" id="modalTitle">
                Simpan Perubahan?
            </h2>

            <p class="modal-subtitle" id="modalSubtitle">
                Pastikan informasi lowongan sudah benar.
            </p>

            <div class="modal-btn-container">
                <button
                    type="button"
                    class="btn-modal-cancel"
                    id="btnBatalSimpan"
                >
                    Batal
                </button>

                <button
                    type="button"
                    class="modal-btn-ok"
                    id="btnKonfirmasiSimpan"
                >
                    Ya, Simpan
                </button>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="{{ asset('js/detail-lowongan.js') }}" defer></script>
@endpush