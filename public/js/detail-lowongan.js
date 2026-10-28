
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('jobDetailForm');
    const toggleButton = document.getElementById('btnToggleEdit');
    const modal = document.getElementById('successModal');
    const confirmButton = document.getElementById('btnKonfirmasiSimpan');
    const cancelButton = document.getElementById('btnBatalSimpan');

    const documentInput = document.getElementById('inputNamaDokumen');
    const addDocumentButton = document.getElementById('btnTambahDokumen');
    const editContainer = document.getElementById('editBadgeContainer');
    const viewContainer = document.getElementById('viewDocContainer');
    const errorMessage = document.getElementById('errorMsgDokumen');

    if (
        !form || !toggleButton || !modal ||
        !confirmButton || !cancelButton
    ) {
        console.error('Elemen form detail lowongan tidak ditemukan.');
        return;
    }

    let isEditMode = false;
    let isSubmitting = false;

    
    function showResponseCard(message, type = 'error') {
        let card = document.getElementById('responseMessageCard');

        if (!card) {
            card = document.createElement('div');
            card.id = 'responseMessageCard';
            card.className = 'response-message-card';
            card.setAttribute('role', 'alert');
            card.setAttribute('aria-live', 'assertive');

            // Letakkan alert di bawah garis pembatas, sebelum form.
            const page = document.querySelector('.detail-lowongan-page');
            const formElement = document.getElementById('jobDetailForm');

            if (page && formElement) {
                page.insertBefore(card, formElement);
            } else if (page) {
                page.prepend(card);
            } else {
                document.body.prepend(card);
            }
        }

        // Bersihkan konten lama.
        card.replaceChildren();
        card.className = `response-message-card ${type}`;

        const iconWrapper = document.createElement('div');
        iconWrapper.className = 'response-message-icon';

        const icon = document.createElement('i');
        icon.className = type === 'success'
            ? 'fa-solid fa-circle-check'
            : 'fa-solid fa-circle-exclamation';

        icon.setAttribute('aria-hidden', 'true');
        iconWrapper.appendChild(icon);

        const content = document.createElement('div');
        content.className = 'response-message-content';

        const heading = document.createElement('strong');
        heading.textContent = type === 'success'
            ? 'Berhasil!'
            : 'Periksa kembali data Anda';

        content.appendChild(heading);

        // Tampilkan pesan utama.
        const messageList = Array.isArray(message) ? message : [message];

        if (messageList.length > 1) {
            const list = document.createElement('ul');

            messageList.forEach(function (item) {
                const li = document.createElement('li');
                li.textContent = item;
                list.appendChild(li);
            });

            content.appendChild(list);
        } else {
            const paragraph = document.createElement('p');
            paragraph.textContent = messageList[0] || '';
            content.appendChild(paragraph);
        }

        const closeButton = document.createElement('button');
        closeButton.type = 'button';
        closeButton.className = 'response-message-close';
        closeButton.innerHTML = '&times;';
        closeButton.setAttribute('aria-label', 'Tutup pesan');

        closeButton.addEventListener('click', function () {
            card.hidden = true;
        });

        card.append(iconWrapper, content, closeButton);
        card.hidden = false;

        // Pindahkan fokus ke alert agar mudah ditemukan.
        card.setAttribute('tabindex', '-1');
        card.focus({ preventScroll: true });
    }

    function hideResponseCard() {
        const card = document.getElementById('responseMessageCard');

        if (card) {
            card.hidden = true;
        }
    }

    function getDocumentInputs() {
        return Array.from(
            editContainer.querySelectorAll('input[name="dokumen[]"]')
        );
    }

    function refreshViewDocuments() {
        if (!viewContainer || !editContainer) return;

        viewContainer.replaceChildren();

        const inputs = getDocumentInputs();

        if (inputs.length === 0) {
            const empty = document.createElement('span');
            empty.textContent = 'Belum ada syarat dokumen.';
            viewContainer.appendChild(empty);
            return;
        }

        inputs.forEach(function (input) {
            const badge = document.createElement('span');
            badge.className = 'doc-badge';

            const icon = document.createElement('i');
            icon.className = 'fa-solid fa-file-lines';
            icon.setAttribute('aria-hidden', 'true');

            badge.append(
                icon,
                document.createTextNode(' ' + input.value)
            );

            viewContainer.appendChild(badge);
        });
    }

    function showDocumentError(message) {
        if (!errorMessage) return;

        errorMessage.textContent = message;
        errorMessage.hidden = false;
    }

    function hideDocumentError() {
        if (errorMessage) {
            errorMessage.hidden = true;
        }
    }

    toggleButton.addEventListener('click', function () {
        hideResponseCard();

        if (!isEditMode) {
            document.querySelectorAll(
                '.detail-lowongan-page .view-mode'
            ).forEach(function (element) {
                element.hidden = true;
            });

            document.querySelectorAll(
                '.detail-lowongan-page .edit-mode'
            ).forEach(function (element) {
                element.hidden = false;
            });

            toggleButton.textContent = 'Simpan';
            toggleButton.classList.remove('btn-ubah');
            toggleButton.classList.add('btn-simpan');

            isEditMode = true;
            return;
        }

        if (!form.reportValidity()) return;

        modal.hidden = false;
        confirmButton.disabled = false;
    });

    cancelButton.addEventListener('click', function () {
        modal.hidden = true;
    });

    modal.addEventListener('click', function (event) {
        if (event.target === modal) {
            modal.hidden = true;
        }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            modal.hidden = true;
        }
    });

    confirmButton.addEventListener('click', async function () {
        if (isSubmitting) return;
        if (!form.reportValidity()) return;

        isSubmitting = true;
        confirmButton.disabled = true;

        const originalButtonText = confirmButton.textContent;
        confirmButton.textContent = 'Menyimpan...';

        try {
            const formData = new FormData(form);

            const response = await fetch(form.action, {
                method: 'POST',
                body: formData,
                credentials: 'same-origin',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            if (response.redirected) {
                showResponseCard(
                    'Permintaan dialihkan oleh server. Sesi mungkin berakhir atau Anda perlu login kembali.',
                    'error'
                );

                modal.hidden = true;
                return;
            }

            const contentType = response.headers.get('content-type') || '';

            let data = {};

            if (contentType.includes('application/json')) {
                data = await response.json();
            } else {
                const responseText = await response.text();

                if (!response.ok) {
                    showResponseCard(
                        response.status === 401
                            ? 'Sesi tidak valid atau Anda belum login.'
                            : response.status === 403
                                ? 'Anda tidak memiliki izin untuk mengubah lowongan ini.'
                                : 'Perubahan gagal disimpan. Silakan periksa route dan controller.',
                        'error'
                    );

                    modal.hidden = true;
                    return;
                }

                showResponseCard(
                    'Server mengembalikan respons yang tidak sesuai. Periksa controller update lowongan.',
                    'error'
                );

                modal.hidden = true;
                return;
            }

            
            if (!response.ok) {
                let message = data.message || 'Perubahan gagal disimpan.';

                if (response.status === 401) {
                    message = 'Sesi tidak valid atau Anda belum login.';
                } else if (response.status === 403) {
                    message = 'Anda tidak memiliki izin untuk mengubah lowongan ini.';
                } else if (response.status === 419) {
                    message = 'Sesi atau token keamanan kedaluwarsa. Muat ulang halaman lalu coba lagi.';
                } else if (response.status === 422) {
                    const errors = Object.values(data.errors || {}).flat();

                    message = errors.length
                        ? errors
                        : ['Periksa kembali data yang dimasukkan.'];
                }

                showResponseCard(message, 'error');
                modal.hidden = true;
                return;
            }


            /*
             * Berhasil: perbarui tampilan tanpa reload halaman.
             */
            const updated = data.job || data.lowongan || {};

            const title = document.getElementById('view-nama');
            const description = document.getElementById('view-deskripsi');
            const quota = document.getElementById('view-batas');
            const salary = document.getElementById('view-gaji');
            const address = document.getElementById('view-alamat');

            if (title && updated.title !== undefined) {
                title.textContent = updated.title;
            }

            if (description && updated.description !== undefined) {
                description.textContent =
                    updated.description || 'Belum ada deskripsi.';
            }

            if (quota && updated.quota !== undefined) {
                quota.textContent = updated.quota;
            }

            if (salary && updated.salary !== undefined) {
                salary.textContent = updated.salary || 'Belum ditentukan';
            }

            if (address && updated.address !== undefined) {
                address.textContent = updated.address || 'Belum ditentukan';
            }

            refreshViewDocuments();

            document.querySelectorAll(
                '.detail-lowongan-page .edit-mode'
            ).forEach(function (element) {
                element.hidden = true;
            });

            document.querySelectorAll(
                '.detail-lowongan-page .view-mode'
            ).forEach(function (element) {
                element.hidden = false;
            });

            toggleButton.textContent = 'Ubah';
            toggleButton.classList.remove('btn-simpan');
            toggleButton.classList.add('btn-ubah');

            isEditMode = false;
            modal.hidden = true;

            showResponseCard(
                data.message || 'Lowongan berhasil diperbarui.',
                'success'
            );
        } catch (error) {
            console.error('Gagal menyimpan lowongan:', error);

            showResponseCard(
                'Terjadi gangguan koneksi atau server tidak dapat dihubungi. Perubahan belum dapat dipastikan tersimpan.',
                'error'
            );

            modal.hidden = true;
        } finally {
            isSubmitting = false;
            confirmButton.disabled = false;
            confirmButton.textContent = originalButtonText;
        }
    });

    /*
     * HAPUS DOKUMEN
     */
    if (editContainer) {
        editContainer.addEventListener('click', function (event) {
            const button = event.target.closest('.remove-document');

            if (!button) return;

            const badge = button.closest('.doc-badge');

            if (badge) badge.remove();

            refreshViewDocuments();
            hideDocumentError();
        });
    }

    /*
     * TAMBAH DOKUMEN
     */
    if (addDocumentButton && documentInput && editContainer) {
        addDocumentButton.addEventListener('click', function () {
            const name = documentInput.value.trim();

            if (!name) {
                showDocumentError('Nama dokumen wajib diisi.');
                return;
            }

            if (name.length > 30) {
                showDocumentError('Nama dokumen maksimal 30 karakter.');
                return;
            }

            const duplicate = getDocumentInputs().some(function (input) {
                return input.value.trim().toLowerCase() === name.toLowerCase();
            });

            if (duplicate) {
                showDocumentError('Dokumen tersebut sudah ditambahkan.');
                return;
            }

            const badge = document.createElement('span');
            badge.className = 'doc-badge';

            const label = document.createElement('span');
            const icon = document.createElement('i');

            icon.className = 'fa-solid fa-file-lines';
            icon.setAttribute('aria-hidden', 'true');

            label.append(icon, document.createTextNode(' ' + name));

            const removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.className = 'remove-document';
            removeButton.textContent = '×';
            removeButton.setAttribute('aria-label', 'Hapus ' + name);

            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'dokumen[]';
            hiddenInput.value = name;

            badge.append(label, removeButton, hiddenInput);
            editContainer.appendChild(badge);

            documentInput.value = '';
            hideDocumentError();
            refreshViewDocuments();
        });

        documentInput.addEventListener('keydown', function (event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                addDocumentButton.click();
            }
        });
    }
});
