define([
    'jquery'
], function($) {
    $('.footer-action-toggle').click(function() {
        $(this).toggleClass("active");
            $(this).parent().next($('.footer-nav-list')).toggleClass("active");
    });
});
