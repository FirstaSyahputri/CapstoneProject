
document.addEventListener('DOMContentLoaded', function () {
    const toggleButton = document.getElementById('sidebarToggle');
    const layout = document.querySelector('.recruiter-layout');

    if (!toggleButton || !layout) return;

    toggleButton.addEventListener('click', function () {
        const isHidden = layout.classList.toggle('sidebar-hidden');

        toggleButton.setAttribute('aria-expanded', String(!isHidden));

        toggleButton.setAttribute(
            'aria-label',
            isHidden ? 'Tampilkan sidebar' : 'Sembunyikan sidebar'
        );
    });
});
