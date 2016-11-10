$(function() {
    $('#menu-list a').each(function() {
        var location = window.location.href;

        if (location.slice(-1) != '/') {
            location = location + '/';
        }
        if ($(this).prop('href') + "/" == location) {
            $(this).parent('li').addClass('active');
        }
    });
});
