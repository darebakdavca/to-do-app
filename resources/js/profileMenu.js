$(document).ready(function () {
    const profileMenuButton = $('#profile-menu-button');
    const profileMenu = $('#profile-menu');

    profileMenuButton.on('click', function (e) {
        profileMenu.toggleClass('hidden');
    })
});
