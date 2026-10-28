
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchJob');
    const jobCards = document.querySelectorAll('.job-card');
    const searchEmptyState = document.getElementById('searchEmptyState');

    const deleteModal = document.getElementById('deleteModal');
    const jobNameText = document.getElementById('jobNameText');
    const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

    let selectedJobId = null;

    // Pencarian berdasarkan nama pekerjaan
    if (searchInput) {
        searchInput.addEventListener('input', function () {
            const keyword = this.value.trim().toLowerCase();
            let visibleCount = 0;

            jobCards.forEach(function (card) {
                const nameElement = card.querySelector('.job-name');
                const jobName = nameElement
                    ? nameElement.textContent.toLowerCase()
                    : '';

                const matches = jobName.includes(keyword);

                card.style.display = matches ? '' : 'none';

                if (matches) {
                    visibleCount++;
                }
            });

            if (searchEmptyState) {
                searchEmptyState.hidden =
                    jobCards.length === 0 || visibleCount > 0;
            }
        });
    }

    // Membuka modal hapus
    document.querySelectorAll('.btn-delete').forEach(function (button) {
        button.addEventListener('click', function () {
            selectedJobId = this.dataset.jobId;

            if (jobNameText) {
                jobNameText.textContent = '"' + this.dataset.jobName + '"';
            }

            if (deleteModal) {
                deleteModal.style.display = 'flex';
            }
        });
    });

    // Menutup modal
    function closeDeleteModal() {
        if (deleteModal) {
            deleteModal.style.display = 'none';
        }

        selectedJobId = null;
    }

    if (cancelDeleteBtn) {
        cancelDeleteBtn.addEventListener('click', closeDeleteModal);
    }

    // Mengirim form penghapusan ke Laravel
    if (confirmDeleteBtn) {
        confirmDeleteBtn.addEventListener('click', function () {
            if (!selectedJobId) {
                return;
            }

            const form = document.getElementById(
                'delete-form-' + selectedJobId
            );

            if (form) {
                confirmDeleteBtn.disabled = true;
                form.submit();
            }
        });
    }

    // Menutup modal jika pengguna menekan Escape
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && deleteModal) {
            closeDeleteModal();
        }
    });
});
