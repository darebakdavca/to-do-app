import $ from './jquery';

$(document).ready(function () {
    $('.password-toggle-button').on('click', function () {
        const target = $(this).data('target');
        const input = $(`#${target}`);
        const isPassword = input.attr('type') === 'password';

        input.attr('type', isPassword ? 'text' : 'password');
        $(this).attr('aria-pressed', isPassword ? 'true' : 'false');
        $(this).find('.password-toggle-show').toggleClass('hidden', isPassword);
        $(this).find('.password-toggle-hide').toggleClass('hidden', !isPassword);
    });
});
