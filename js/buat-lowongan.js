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

const MAKS_DOKUMEN = 10;
let dokumen = ['Ijazah', 'SKCK'];   // isi awal sesuai desain

/* ---------- Fungsi bantu ---------- */
function setError(el, pesan) {
  const field = el.closest('.field');
  field.querySelector('.error').textContent = pesan;
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
  const sudahAda = dokumen.some(function (d) {
    return d.toLowerCase() === nama.toLowerCase();
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

document.getElementById('btnTambah').addEventListener('click', tambahDokumen);
inputDokumen.addEventListener('keydown', function (e) {
  if (e.key === 'Enter') {      // Enter = tambah, bukan kirim form
    e.preventDefault();
    tambahDokumen();
  }
});

/* ---------- Validasi ---------- */
function validasiNama() {
  const v = namaInput.value.trim();
  if (v === '') return setError(namaInput, 'Nama pekerjaan wajib diisi.'), false;
  if (v.length < 3) return setError(namaInput, 'Minimal 3 karakter.'), false;
  setError(namaInput, ''); return true;
}

function validasiDeskripsi() {
  const v = deskripsiInput.value.trim();
  if (v === '') return setError(deskripsiInput, 'Deskripsi wajib diisi.'), false;
  if (v.length < 10) return setError(deskripsiInput, 'Deskripsi minimal 10 karakter.'), false;
  setError(deskripsiInput, ''); return true;
}

function validasiAlamat() {
  if (alamatInput.value.trim() === '')
    return setError(alamatInput, 'Alamat wajib diisi.'), false;
  setError(alamatInput, ''); return true;
}

function validasiDokumen() {
  if (dokumen.length === 0)
    return setError(inputDokumen, 'Tambahkan minimal 1 syarat dokumen.'), false;
  setError(inputDokumen, ''); return true;
}

function validasiKuota() {
  const v = kuotaInput.value.trim();
  if (v === '') return setError(kuotaInput, 'Batas pelamar wajib diisi.'), false;
  const angka = Number(v);
  if (!Number.isInteger(angka)) return setError(kuotaInput, 'Harus berupa bilangan bulat.'), false;
  if (angka < 1) return setError(kuotaInput, 'Minimal 1 pelamar.'), false;
  if (angka > 1000) return setError(kuotaInput, 'Maksimal 1000 pelamar.'), false;
  setError(kuotaInput, ''); return true;
}

function validasiGaji() {
  const v = gajiInput.value.trim();
  if (v === '') return setError(gajiInput, 'Rentang gaji wajib diisi.'), false;
  if (!/\d/.test(v)) return setError(gajiInput, 'Gaji harus mengandung angka.'), false;
  setError(gajiInput, ''); return true;
}

/* ---------- Kirim form ---------- */
form.addEventListener('submit', function (e) {
  e.preventDefault();

  // semua dicek (bukan berhenti di error pertama) agar semua pesan tampil
  const hasil = [
    validasiNama(),
    validasiDeskripsi(),
    validasiAlamat(),
    validasiDokumen(),
    validasiKuota(),
    validasiGaji()
  ];

  if (hasil.includes(false)) {
    const pertama = document.querySelector('.invalid');
    if (pertama) pertama.focus();
    return;
  }

  const dataLowongan = {
    nama: namaInput.value.trim(),
    deskripsi: deskripsiInput.value.trim(),
    alamat: alamatInput.value.trim(),
    dokumen: dokumen,
    kuota: Number(kuotaInput.value),
    gaji: gajiInput.value.trim(),
    aktif: statusInput.checked
  };
  console.log('Data siap dikirim ke backend:', dataLowongan);

  modal.hidden = false;
});

document.getElementById('btnOk').addEventListener('click', function () {
  modal.hidden = true;
  form.reset();
  dokumen = ['Ijazah', 'SKCK'];
  renderDokumen();
});

/* Hilangkan pesan error saat pengguna mulai mengetik */
[namaInput, deskripsiInput, alamatInput, kuotaInput, gajiInput].forEach(function (el) {
  el.addEventListener('input', function () { setError(el, ''); });
});

renderDokumen();