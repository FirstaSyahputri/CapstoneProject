
@extends('Recruiter.layout')

@section('title', 'Buat Lowongan Baru')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/color-palette.css') }}">
<link rel="stylesheet" href="{{ asset('css/buat-lowongan.css') }}">
@endpush

@section('content')
<div class="buat-lowongan-page">

    <form
        id="formLowongan"
        action="{{ route('recruiter.lowongan.store') }}"
        method="POST"
        novalidate
    >
        @csrf

        <header class="topbar">
            <h1>Buat Lowongan Baru</h1>
        </header>

        @if ($errors->any())
            <div class="validation-summary" role="alert">
                <strong>Periksa kembali data yang diisi.</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="field">
            <label for="namaPekerjaan">Nama Pekerjaan</label>
            <input
                type="text"
                id="namaPekerjaan"
                name="namaPekerjaan"
                value="{{ old('namaPekerjaan') }}"
                placeholder="Contoh: security"
                required
            >
            <small class="error"></small>
        </div>

        <div class="baris">
            <div class="field">
                <label for="deskripsi">Deskripsi Pekerjaan</label>
                <textarea
                    id="deskripsi"
                    name="deskripsi"
                    rows="6"
                    required
                >{{ old('deskripsi') }}</textarea>
                <small class="error"></small>
            </div>

            <div class="field">
                <label for="alamat">Alamat detail pekerjaan</label>

                <div class="alamat-wrap">
                    <img
                        src="{{ asset('images/gmaps.png') }}"
                        alt="Peta lokasi"
                        class="peta"
                    >

                    <textarea
                        id="alamat"
                        name="alamat"
                        rows="6"
                        placeholder="Isi alamat pekerjaan"
                        required
                    >{{ old('alamat') }}</textarea>
                </div>

                <small class="error"></small>
            </div>
        </div>

        <div class="field" id="fieldDokumen">
            <label for="inputDokumen">Syarat Dokumen Tambahan</label>

            <div class="dokumen-list" id="dokumenList"></div>

            <div class="dokumen-tambah">
                <input
                    type="text"
                    id="inputDokumen"
                    placeholder="Nama dokumen, contoh: SIM A"
                    maxlength="30"
                >
                <button type="button" id="btnTambah">+ Tambah</button>
            </div>

            <small class="error"></small>

            {{-- Pertahankan dokumen jika validasi server gagal --}}
            <div id="dokumenAwal" hidden>
                @foreach (old('dokumen', ['Ijazah', 'SKCK']) as $namaDokumen)
                    <span>{{ $namaDokumen }}</span>
                @endforeach
            </div>
        </div>

        <div class="field">
            <label for="kuota">Batas Maksimal Pelamar Kerja</label>
            <input
                type="number"
                id="kuota"
                name="kuota"
                min="1"
                max="1000"
                step="1"
                value="{{ old('kuota') }}"
                placeholder="Contoh: 10"
                required
            >
            <small class="error"></small>
        </div>

        <div class="field">
            <label for="gaji">Rentang Gaji</label>
            <input
                type="text"
                id="gaji"
                name="gaji"
                value="{{ old('gaji') }}"
                placeholder="Contoh: Rp 5.000.000 - Rp 7.000.000"
                required
            >
            <small class="error"></small>
        </div>

        <div class="field">
            <label for="status">Status Lowongan</label>

            <label class="switch">
                <input
                    type="checkbox"
                    id="status"
                    name="status"
                    value="1"
                    checked
                >
                <span class="slider"></span>
            </label>
        </div>

        <button type="submit" class="btn-pasang">
            Pasang Lowongan
        </button>

    </form>

    {{-- Modal sukses hanya muncul setelah penyimpanan berhasil --}}
    <div
        class="modal-overlay"
        id="modalSukses"
        @if (!session('success')) hidden @endif
    >
        <div class="modal">
            <div class="ikon-centang">✓</div>

            <h2>Berhasil!</h2>

            <p>{{ session('success') }}</p>

            <button type="button" id="btnOk">OK</button>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="{{ asset('js/buat-lowongan.js') }}" defer></script>
@endpush
