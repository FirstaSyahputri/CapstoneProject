
const form = document.getElementById('formLowongan');
const namaInput = document.getElementById('namaPekerjaan');
const deskripsiInput = document.getElementById('deskripsi');
const alamatInput = document.getElementById('alamat');
const kuotaInput = document.getElementById('kuota');
const gajiInput = document.getElementById('gaji');
const statusInput = document.getElementById('status');
const inputDokumen = document.getElementById('inputDokumen');
const dokumenList = document.getElementById('dokumenList');
const modal = document.getElementById('modalSukses');
const btnTambah = document.getElementById('btnTambah');
const btnOk = document.getElementById('btnOk');

const MAKS_DOKUMEN = 10;

// Ambil dokumen dari Blade agar data tetap terisi setelah validasi gagal.
const dokumenAwal = document.querySelectorAll('#dokumenAwal span');

let dokumen = dokumenAwal.length
    ? Array.from(dokumenAwal, el => el.textContent.trim()).filter(Boolean)
    : ['Ijazah', 'SKCK'];

/* ---------- Fungsi bantu ---------- */
function setError(el, pesan) {
    const field = el.closest('.field');

    if (!field) return;

    const error = field.querySelector('.error');

    if (error) {
        error.textContent = pesan;
    }

    el.classList.toggle('invalid', pesan !== '');
}

/* ---------- Fitur dokumen dinamis ---------- */
function renderDokumen() {
    dokumenList.innerHTML = '';

    dokumen.forEach(function (nama, index) {
        const chip = document.createElement('span');
        chip.className = 'chip';

        const teks = document.createElement('span');
        teks.textContent = nama;

        const hapus = document.createElement('button');
        hapus.type = 'button';
        hapus.textContent = '×';
        hapus.setAttribute('aria-label', 'Hapus ' + nama);

        hapus.addEventListener('click', function () {
            dokumen.splice(index, 1);
            renderDokumen();
            setError(inputDokumen, '');
        });

        chip.append(teks, hapus);
        dokumenList.appendChild(chip);
    });
}

function tambahDokumen() {
    const nama = inputDokumen.value.trim();

    if (nama === '') {
        setError(inputDokumen, 'Nama dokumen tidak boleh kosong.');
        return;
    }

    if (nama.length > 30) {
        setError(inputDokumen, 'Nama dokumen maksimal 30 karakter.');
        return;
    }

    const sudahAda = dokumen.some(function (item) {
        return item.toLowerCase() === nama.toLowerCase();
    });

    if (sudahAda) {
        setError(inputDokumen, 'Dokumen "' + nama + '" sudah ditambahkan.');
        return;
    }

    if (dokumen.length >= MAKS_DOKUMEN) {
        setError(inputDokumen, 'Maksimal ' + MAKS_DOKUMEN + ' dokumen.');
        return;
    }

    dokumen.push(nama);
    inputDokumen.value = '';

    setError(inputDokumen, '');
    renderDokumen();
}

btnTambah.addEventListener('click', tambahDokumen);

inputDokumen.addEventListener('keydown', function (e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        tambahDokumen();
    }
});

/* ---------- Validasi ---------- */
function validasiNama() {
    const v = namaInput.value.trim();

    if (v === '') {
        setError(namaInput, 'Nama pekerjaan wajib diisi.');
        return false;
    }

    if (v.length < 3) {
        setError(namaInput, 'Minimal 3 karakter.');
        return false;
    }

    setError(namaInput, '');
    return true;
}

function validasiDeskripsi() {
    const v = deskripsiInput.value.trim();

    if (v === '') {
        setError(deskripsiInput, 'Deskripsi wajib diisi.');
        return false;
    }

    if (v.length < 10) {
        setError(deskripsiInput, 'Deskripsi minimal 10 karakter.');
        return false;
    }

    setError(deskripsiInput, '');
    return true;
}

function validasiAlamat() {
    if (alamatInput.value.trim() === '') {
        setError(alamatInput, 'Alamat wajib diisi.');
        return false;
    }

    setError(alamatInput, '');
    return true;
}

function validasiDokumen() {
    if (dokumen.length === 0) {
        setError(inputDokumen, 'Tambahkan minimal 1 syarat dokumen.');
        return false;
    }

    setError(inputDokumen, '');
    return true;
}

function validasiKuota() {
    const v = kuotaInput.value.trim();

    if (v === '') {
        setError(kuotaInput, 'Batas pelamar wajib diisi.');
        return false;
    }

    const angka = Number(v);

    if (!Number.isInteger(angka)) {
        setError(kuotaInput, 'Harus berupa bilangan bulat.');
        return false;
    }

    if (angka < 1) {
        setError(kuotaInput, 'Minimal 1 pelamar.');
        return false;
    }

    if (angka > 1000) {
        setError(kuotaInput, 'Maksimal 1000 pelamar.');
        return false;
    }

    setError(kuotaInput, '');
    return true;
}

function validasiGaji() {
    const v = gajiInput.value.trim();

    if (v === '') {
        setError(gajiInput, 'Rentang gaji wajib diisi.');
        return false;
    }

    if (!/\d/.test(v)) {
        setError(gajiInput, 'Gaji harus mengandung angka.');
        return false;
    }

    setError(gajiInput, '');
    return true;
}

/* ---------- Kirim form ke Laravel ---------- */
form.addEventListener('submit', function (e) {
    e.preventDefault();

    const hasil = [
        validasiNama(),
        validasiDeskripsi(),
        validasiAlamat(),
        validasiDokumen(),
        validasiKuota(),
        validasiGaji()
    ];

    if (hasil.includes(false)) {
        const pertama = form.querySelector('.invalid');

        if (pertama) {
            pertama.focus();
        }

        return;
    }

    // Hapus input dokumen tersembunyi dari submit sebelumnya.
    form.querySelectorAll('input[name="dokumen[]"]').forEach(function (el) {
        el.remove();
    });

    // Kirim setiap dokumen sebagai array ke Laravel.
    dokumen.forEach(function (nama) {
        const hiddenInput = document.createElement('input');

        hiddenInput.type = 'hidden';
        hiddenInput.name = 'dokumen[]';
        hiddenInput.value = nama;

        form.appendChild(hiddenInput);
    });

    // Checkbox tidak dicentang akan dikirim sebagai status yang tidak ada.
    // Controller menangani kondisi tersebut dengan request->boolean('status').
    form.submit();
});

/* ---------- Modal sukses ---------- */
if (btnOk && modal) {
    btnOk.addEventListener('click', function () {
        window.location.href = '/recruiter/lowongan';
    });
}

/* ---------- Hilangkan pesan error saat mengetik ---------- */
[namaInput, deskripsiInput, alamatInput, kuotaInput, gajiInput].forEach(function (el) {
    el.addEventListener('input', function () {
        setError(el, '');
    });
});

inputDokumen.addEventListener('input', function () {
    setError(inputDokumen, '');
});

/* ---------- Inisialisasi ---------- */
renderDokumen();
