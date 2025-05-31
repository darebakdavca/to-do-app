$(document).ready(function () {
    $('.task-detail').each(function () {
        const taskId = $(this).data('task-id');
        const isOpen = localStorage.getItem(`task-detail-open-${taskId}`) === 'true';
        if (isOpen) {
            $(this).show();
            $(`.task-actions[data-task-id="${taskId}"]`).show();
        } else {
            $(this).hide();
            $(`.task-actions[data-task-id="${taskId}"]`).hide();
        }
    }
    );

    $('.task-detail-button').on('click', function (e) {
        if (
            $(e.target).closest('form[action*="tasks/"][action*="/complete"]').length ||
            $(e.target).closest('button[type="submit"]').length || $(e.target).closest('.edit-task-button').length
        ) {
            return;
        }
        const taskId = $(this).data('task-id');
        const detail = $(`.task-detail[data-task-id="${taskId}"]`);
        const taskActions = $(`.task-actions[data-task-id="${taskId}"]`);
        if (detail.is(':visible')) {
            detail.slideUp();
            taskActions.hide();
            localStorage.setItem(`task-detail-open-${taskId}`, 'false');
        } else {
            detail.slideDown();
            taskActions.show();
            localStorage.setItem(`task-detail-open-${taskId}`, 'true');
        }
    });



    $('.comment-detail').each(function () {
        const taskId = $(this).data('task-id');
        const isOpen = localStorage.getItem(`comment-detail-open-${taskId}`) === 'true';
        const span = $(`span[data-task-id="${taskId}"]`);
        if (isOpen) {
            $(this).show();
            span.text('Hide comments');
        } else {
            $(this).hide();
            span.text('Show comments');
        }
    });

    $('.comment-detail-button').on('click', function (e) {
        const taskId = $(this).data('task-id');
        const detail = $(`.comment-detail[data-task-id="${taskId}"]`);
        const span = $(`span[data-task-id="${taskId}"]`);
        if (detail.is(':visible')) {
            detail.slideUp();
            span.text('Show comments');
            localStorage.setItem(`comment-detail-open-${taskId}`, 'false');
        } else {
            detail.slideDown();
            span.text('Hide comments');
            localStorage.setItem(`comment-detail-open-${taskId}`, 'true');
        }
    });


});
