$(document).ready(function () {
    let popupTimeout;

    $('.info-btn').on('mouseenter', function (e) {
        const $btn = $(this);

        popupTimeout = setTimeout(function () {
            $('.info-popup').remove();

            const infoMessage = $btn.data('info');
            const position = $btn.data('position');
            const popUpContainer = `
                <div class="info-popup absolute font-semibold left-1/2 ${position === 'top' ? 'bottom-full mb-2' : 'top-full mt-2'}  -translate-x-1/2 z-50 bg-slate-800 text-white text-sm rounded-lg shadow-lg px-4 py-2 border border-blue-500 whitespace-nowrap">
                    ${infoMessage}
                </div>
            `;
            $btn.after(popUpContainer);
        }, 200);
    });

    $('.info-btn').on('mouseleave', function (e) {
        clearTimeout(popupTimeout);
        $(this).siblings('.info-popup').remove();
    });
});
