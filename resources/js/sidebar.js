$(document).ready(function () {
    const sidebarButton = $('#sidebar-button');
    const sidebar = $('#sidebar');

    sidebarButton.on('click', function (e) {
        sidebar.toggleClass('hidden');
        $('#sidebar-closed-icon').toggleClass('hidden');
        $('#sidebar-open-icon').toggleClass('hidden');
    });
});
