
document.addEventListener('DOMContentLoaded', function () {
    const cards = document.querySelectorAll('.applicant-card');
    const searchInput = document.getElementById('search-input');
    const filterButtons = document.querySelectorAll('.applicant-filter');
    const emptyState = document.getElementById('filter-empty-state');
    const visibleCount = document.getElementById('visible-count');
    const grid = document.getElementById('applicant-grid');

    if (!searchInput || !emptyState || !visibleCount) {
        return;
    }

    let activeStatus = 'all';

    function applyFilter() {
        const query = searchInput.value.trim().toLowerCase();
        let visible = 0;

        cards.forEach(function (card) {
            const cardStatus = card.dataset.status;
            const cardSearch = card.dataset.search || '';

            const matchesStatus =
                activeStatus === 'all' ||
                cardStatus === activeStatus;

            const matchesSearch = cardSearch.includes(query);
            const show = matchesStatus && matchesSearch;

            card.classList.toggle('d-none', !show);

            if (show) {
                visible++;
            }
        });

        visibleCount.textContent = visible;

        emptyState.classList.toggle('d-none', visible > 0);

        if (grid) {
            grid.classList.toggle('d-none', visible === 0);
        }
    }

    filterButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            activeStatus = button.dataset.status;

            filterButtons.forEach(function (item) {
                const isActive = item === button;

                item.classList.toggle('active', isActive);
                item.setAttribute('aria-pressed', String(isActive));
            });

            applyFilter();
        });
    });

    searchInput.addEventListener('input', applyFilter);

    applyFilter();
});
