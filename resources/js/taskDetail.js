$(document).ready(function () {
    $('.task-detail-button').on('click', function (e) {
        if (
            $(e.target).closest('form[action*="tasks/"][action*="/complete"]').length ||
            $(e.target).closest('button[type="submit"]').length
        ) {
            return;
        }
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
