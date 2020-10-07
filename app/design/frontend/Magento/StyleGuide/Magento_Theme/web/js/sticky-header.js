define(
    ['jquery'],
    function($) {
    'use strict';
        return function(config, element) {
            var elem = $('.page-header');

            $(window).on('scroll', function () {
                if ($(window).scrollTop() > elem.offset().top && !(elem.hasClass('sticky'))) {
                    elem.addClass('sticky');
                } else if ($(window).scrollTop() == 0) {
                    elem.removeClass('sticky');
                }
            });
        }
});
