document.addEventListener('DOMContentLoaded', function () {
    const statusToast = document.querySelector('[data-status-toast]');

    if (!statusToast || typeof Toastify === 'undefined') {
        return;
    }

    const text = statusToast.dataset.status?.trim();

    if (!text) {
        return;
    }

    const dedupeKey = `status-toast:${window.location.pathname}:${text}`;

    if (sessionStorage.getItem(dedupeKey) === 'shown') {
        return;
    }

    Toastify({
        text,
        duration: 3000,
        gravity: 'top',
        position: 'center',
        offset: {
            y: 20,
        },
        style: {
            borderRadius: '0.7rem',
            fontWeight: 'bold',
            padding: '0.7rem 2rem',
            fontSize: '1.2rem',
        },
    }).showToast();

    sessionStorage.setItem(dedupeKey, 'shown');
});
