$(document).ready(function () {
    const shareLink = $('#share-link');
    const copyLink = $('#copy-link');
    const generateNewLink = $('#generate-new-link');

    copyLink.on('click', function (e) {
        navigator.clipboard.writeText(shareLink.val());
        showToast('Link copied to clipboard.')
    });

    generateNewLink.on('click', function (e) {
        window.location.reload();
    });

    const showToast = (text) => {
        Toastify({
            text: text,
            duration: 4000,
            gravity: "top",
            position: "center",
            offset: {
                y: 20,
            },
            style: {
                borderRadius: '0.7rem',
                fontWeight: 'bold',
                padding: '0.7rem 2rem',
                fontSize: '1.2rem'
            }
        }).showToast();
    }
});
