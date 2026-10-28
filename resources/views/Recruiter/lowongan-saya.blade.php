
@extends('Recruiter.layout')

@section('title', 'Lowongan Kerja Saya')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/lowongan-saya.css') }}">
@endpush

@section('content')
<div class="lowongan-saya-page">

    <main class="dashboard-container">
        <header class="header-section">
            <h1 class="page-title">Lowongan Kerja Saya</h1>
        </header>

        <div class="divider"></div>

        <section class="content-section" aria-labelledby="activeJobsTitle">
            <h2 class="section-title" id="activeJobsTitle">
                Lowongan Kerja Aktif
            </h2>

            @if (session('success'))
                <div class="success-message" role="status">
                    <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="validation-summary" role="alert">
                    <strong>Terjadi kesalahan:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="search-box">
                <i
                    class="fa-solid fa-magnifying-glass search-icon"
                    aria-hidden="true"
                ></i>

                <input
                    type="search"
                    id="searchJob"
                    placeholder="Cari pekerjaan..."
                    class="search-input"
                    aria-label="Cari pekerjaan"
                    autocomplete="off"
                >
            </div>

            <div class="job-list" id="jobList">
                @forelse ($lowongans as $job)
                    <article class="job-card">
                        <div class="job-card-left">
                            <div class="job-icon-box" aria-hidden="true">
                                <i class="{{ $job->icon ?: 'fa-solid fa-briefcase' }}"></i>
                            </div>

                            <div class="job-details">
                                <h3 class="job-name">{{ $job->title }}</h3>

                                <p class="job-requirements">
                                    <i class="fa-regular fa-file-lines" aria-hidden="true"></i>
                                    Syarat dokumen:
                                    {{ $job->syaratDokumen->pluck('nama_dokumen')->implode(', ') ?: 'Belum ditentukan' }}
                                </p>
                            </div>
                        </div>

                        <div class="job-card-right">
                            <a
                                href="{{ route('recruiter.lowongan.show', ['jobListing' => $job->id]) }}"
                                class="btn-detail"
                                aria-label="Lihat detail lowongan {{ $job->title }}"
                            >
                                <i class="fa-solid fa-eye" aria-hidden="true"></i>
                                Detail
                            </a>

                            <button
                                type="button"
                                class="btn-delete"
                                data-job-id="{{ $job->id }}"
                                data-job-name="{{ $job->title }}"
                                aria-label="Hapus lowongan {{ $job->title }}"
                            >
                                <i class="fa-regular fa-trash-can" aria-hidden="true"></i>
                                Hapus
                            </button>

                            <form
                                id="delete-form-{{ $job->id }}"
                                action="{{ route('recruiter.job.delete', ['jobListing' => $job->id]) }}"
                                method="POST"
                                hidden
                            >
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </article>
                @empty
                    <p class="empty-state" id="noJobsState">
                        <i class="fa-regular fa-folder-open" aria-hidden="true"></i>
                        <span>Belum ada lowongan kerja.</span>
                    </p>
                @endforelse

                <p class="empty-state" id="searchEmptyState" hidden>
                    Lowongan yang dicari tidak ditemukan.
                </p>
            </div>
        </section>
    </main>

    <div
        id="deleteModal"
        class="modal-overlay"
        style="display: none;"
    >
        <div
            class="modal-box"
            role="dialog"
            aria-modal="true"
            aria-labelledby="deleteModalTitle"
            aria-describedby="deleteModalDescription"
            tabindex="-1"
        >
            <div class="modal-icon" aria-hidden="true">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>

            <h3 id="deleteModalTitle">Konfirmasi Penghapusan</h3>

            <p id="deleteModalDescription">
                Apakah Anda yakin ingin menghapus lowongan
                <strong id="jobNameText"></strong>?
                Tindakan ini tidak dapat dibatalkan.
            </p>

            <div class="modal-btn-container">
                <button
                    type="button"
                    class="btn-modal-cancel"
                    id="cancelDeleteBtn"
                >
                    Batal
                </button>

                <button
                    type="button"
                    class="btn-modal-confirm"
                    id="confirmDeleteBtn"
                >
                    <i class="fa-regular fa-trash-can" aria-hidden="true"></i>
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="{{ asset('js/lowongan-saya.js') }}" defer></script>
@endpush
