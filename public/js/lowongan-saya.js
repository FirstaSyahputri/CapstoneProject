
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchJob');
    const jobCards = document.querySelectorAll('.job-card');
    const searchEmptyState = document.getElementById('searchEmptyState');

    const deleteModal = document.getElementById('deleteModal');
    const jobNameText = document.getElementById('jobNameText');
    const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

    let selectedJobId = null;

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

    document.querySelectorAll('.btn-delete').forEach(function (button) {
        button.addEventListener('click', function () {
            selectedJobId = this.dataset.jobId;

            if (!selectedJobId || !deleteModal) {
                return;
            }

            if (jobNameText) {
                jobNameText.textContent =
                    '"' + this.dataset.jobName + '"';
            }

            deleteModal.style.display = 'flex';
        });
    });

    function closeDeleteModal() {
        if (deleteModal) {
            deleteModal.style.display = 'none';
        }

        selectedJobId = null;

        if (confirmDeleteBtn) {
            confirmDeleteBtn.disabled = false;
        }
    }

    if (cancelDeleteBtn) {
        cancelDeleteBtn.addEventListener('click', function () {
            closeDeleteModal();
        });
    }

    if (deleteModal) {
        deleteModal.addEventListener('click', function (event) {
            if (event.target === deleteModal) {
                closeDeleteModal();
            }
        });
    }

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
            } else {
                console.error(
                    'Form penghapusan tidak ditemukan:',
                    selectedJobId
                );

                confirmDeleteBtn.disabled = false;
            }
        });
    }

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && deleteModal) {
            closeDeleteModal();
        }
    });
});
