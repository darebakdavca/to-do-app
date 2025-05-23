$(document).ready(function () {
    $('.task-detail-button').on('click', function () {
        const taskId = $(this).data('task-id');
        const detail = $('.task-detail[data-task-id="' + taskId + '"]');
        const taskActions = $('.task-actions[data-task-id="' + taskId + '"]');
        if (detail.is(':visible')) {
            detail.slideUp();
            taskActions.hide();
        } else {
            detail.slideDown();
            taskActions.show();
        }
    });
});
