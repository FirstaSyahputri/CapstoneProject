
document.addEventListener('DOMContentLoaded', function () {
    const status = document.getElementById('status');
    const interviewFields = document.getElementById('interview-fields');
    const rejectionFields = document.getElementById('rejection-fields');

    const interviewDate = document.getElementById('interview_date');
    const interviewTime = document.getElementById('interview_time');
    const interviewLocation = document.getElementById('interview_location');
    const rejectionNote = document.getElementById('rejection_note');

    if (status && interviewFields && rejectionFields) {
        function updateStatusFields() {
            const isInterview = status.value === 'interview';
            const isRejected = status.value === 'rejected';

            interviewFields.style.display = isInterview ? 'block' : 'none';
            rejectionFields.style.display = isRejected ? 'block' : 'none';

            if (interviewDate) {
                interviewDate.required = isInterview;
            }

            if (interviewTime) {
                interviewTime.required = isInterview;
            }

            if (interviewLocation) {
                interviewLocation.required = isInterview;
            }

            if (rejectionNote) {
                rejectionNote.required = isRejected;
            }
        }

        status.addEventListener('change', updateStatusFields);
        updateStatusFields();
    }

    const statusForm = document.querySelector('.status-edit-form');
    const statusSelect = document.getElementById('application-status-select');

    if (statusForm && statusSelect) {
        statusForm.addEventListener('submit', function (event) {
            if (!statusSelect.value) {
                event.preventDefault();
                alert('Silakan pilih status lamaran terlebih dahulu.');
                return;
            }
        });
    }
});
