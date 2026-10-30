
(function () {
    'use strict';

    function initializeProfilPelamar() {
        console.log('Profil Pelamar JS berhasil diinisialisasi.');

        const status =
            document.getElementById('application-status-select') ||
            document.getElementById('status');

        const statusForm = document.querySelector('.status-edit-form');
        const interviewForm = document.getElementById('interview-form');

        const interviewDate = document.getElementById('interview-date');
        const interviewStartTime = document.getElementById('interview-start-time');
        const interviewEndTime = document.getElementById('interview-end-time');
        const interviewLocation = document.getElementById('interview-location');
        const meetingType = document.getElementById('meeting-type');

        const rejectForm = document.getElementById('reject-form');
        const rejectionNote = document.getElementById('rejection-template-text');

        const interviewModal = document.getElementById('interview-modal');
        const rejectStep1Modal = document.getElementById('reject-step1-modal');
        const rejectStep2Modal = document.getElementById('reject-step2-modal');

        function openModal(modal) {
            if (!modal) {
                console.error('Elemen modal tidak ditemukan.');
                return;
            }

            modal.classList.add('show');
            modal.setAttribute('aria-hidden', 'false');

            document.body.classList.add('modal-open');
        }

        function closeModal(modal) {
            if (!modal) return;

            modal.classList.remove('show');
            modal.setAttribute('aria-hidden', 'true');

            const openModals = document.querySelectorAll('.custom-modal.show');

            if (openModals.length === 0) {
                document.body.classList.remove('modal-open');
            }
        }

        window.openInterviewModal = function () {
            console.log('Tombol Jadwalkan Interview diklik.');
            openModal(interviewModal);
        };

        window.closeInterviewModal = function () {
            closeModal(interviewModal);
        };

        window.openRejectStep1Modal = function () {
            openModal(rejectStep1Modal);
        };

        window.closeRejectStep1Modal = function () {
            closeModal(rejectStep1Modal);
        };

        window.proceedToRejectStep2 = function () {
            closeModal(rejectStep1Modal);
            openModal(rejectStep2Modal);
        };

        window.closeRejectStep2Modal = function () {
            closeModal(rejectStep2Modal);
        };

        window.setInterviewType = function (type) {
            const offlineBtn = document.getElementById('type-offline-btn');
            const onlineBtn = document.getElementById('type-online-btn');
            const locationLabel = document.getElementById('location-label');

            if (!meetingType || !offlineBtn || !onlineBtn) {
                console.error('Elemen tipe pertemuan tidak lengkap.');
                return;
            }

            if (!['offline', 'online'].includes(type)) return;

            meetingType.value = type;

            offlineBtn.classList.toggle('active', type === 'offline');
            onlineBtn.classList.toggle('active', type === 'online');

            offlineBtn.setAttribute('aria-pressed', String(type === 'offline'));
            onlineBtn.setAttribute('aria-pressed', String(type === 'online'));

            if (locationLabel) {
                locationLabel.textContent =
                    type === 'online'
                        ? 'Link pertemuan'
                        : 'Lokasi pertemuan';
            }

            if (interviewLocation) {
                interviewLocation.placeholder =
                    type === 'online'
                        ? 'Masukkan link Google Meet atau Zoom'
                        : 'Masukkan alamat lokasi wawancara';
            }
        };

        [
            interviewModal,
            rejectStep1Modal,
            rejectStep2Modal
        ].forEach(function (modal) {
            if (!modal) return;

            modal.addEventListener('click', function (event) {
                if (event.target === modal) {
                    closeModal(modal);
                }
            });
        });

        document.addEventListener('keydown', function (event) {
            if (event.key !== 'Escape') return;

            const activeModal = document.querySelector('.custom-modal.show');

            if (activeModal) {
                closeModal(activeModal);
            }
        });

        if (statusForm) {
            statusForm.addEventListener('submit', function (event) {
                if (!status || !status.value) {
                    event.preventDefault();

                    alert('Silakan pilih status lamaran terlebih dahulu.');
                    return;
                }

            });
        }

        if (interviewForm) {
            interviewForm.addEventListener('submit', function (event) {
                if (
                    !interviewDate ||
                    !interviewStartTime ||
                    !interviewEndTime ||
                    !interviewLocation ||
                    !meetingType
                ) {
                    event.preventDefault();

                    alert('Form interview tidak ditemukan dengan lengkap.');
                    return;
                }

                if (
                    !interviewDate.value ||
                    !interviewStartTime.value ||
                    !interviewEndTime.value ||
                    !interviewLocation.value.trim() ||
                    !meetingType.value
                ) {
                    event.preventDefault();

                    alert('Lengkapi seluruh informasi jadwal wawancara.');
                    return;
                }

                // Validasi tanggal tidak boleh di masa lalu.
                const selectedDate = new Date(
                    interviewDate.value + 'T00:00:00'
                );

                const today = new Date();
                today.setHours(0, 0, 0, 0);

                if (selectedDate < today) {
                    event.preventDefault();

                    alert('Tanggal wawancara tidak boleh berada di masa lalu.');
                    return;
                }

                // Validasi waktu selesai harus setelah waktu mulai.
                if (interviewEndTime.value <= interviewStartTime.value) {
                    event.preventDefault();

                    alert('Waktu selesai harus lebih lambat daripada waktu mulai.');
                    return;
                }

                // Validasi link jika memilih pertemuan online.
                if (meetingType.value === 'online') {
                    try {
                        const url = new URL(
                            interviewLocation.value.trim()
                        );

                        if (!['http:', 'https:'].includes(url.protocol)) {
                            throw new Error('URL tidak valid');
                        }
                    } catch (error) {
                        event.preventDefault();

                        alert(
                            'Masukkan link meeting yang valid, ' +
                            'misalnya https://meet.google.com/xxx-xxxx-xxx.'
                        );

                        return;
                    }
                }
            });
        }

        if (rejectForm) {
            rejectForm.addEventListener('submit', function (event) {
                if (!rejectionNote || !rejectionNote.value.trim()) {
                    event.preventDefault();

                    alert('Silakan isi pesan penolakan terlebih dahulu.');
                    return;
                }

                event.preventDefault();

                alert(
                    'Pesan penolakan berhasil disiapkan. ' +
                    'Pesan belum dikirim kepada pelamar.'
                );
            });
        }

        if (meetingType) {
            window.setInterviewType(meetingType.value || 'offline');
        }

        if (
            interviewModal &&
            interviewModal.dataset.openOnLoad === 'true'
        ) {
            openModal(interviewModal);
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener(
            'DOMContentLoaded',
            initializeProfilPelamar,
            { once: true }
        );
    } else {
        initializeProfilPelamar();
    }

})();
