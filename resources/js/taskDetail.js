$(document).ready(function () {
    $('.task-detail-button').on('click', function () {
        const taskId = $(this).data('task-id');
        const $detail = $('.task-detail[data-task-id="' + taskId + '"]');
        if ($detail.is(':visible')) {
            $detail.slideUp();
        } else {
            $detail.slideDown();
        }
    });
});
