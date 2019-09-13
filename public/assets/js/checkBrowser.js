$(function() {
    $('#wamoji_start').submit(function() {
        var userAgent = window.navigator.userAgent.toLowerCase();
        if (userAgent.indexOf('chrome') != -1 || userAgent.indexOf('safari') != -1) {
            return true;
        } else {
            alert($browser_error);
            return false;
        }
    })
});
