define(
    ['jquery'],
    function($) {
    'use strict';
        return function(config, element) {
            $(window).scroll(function () {
                if ($(window).scrollTop() > $('.page-header').offset().top && !($('.page-header').hasClass('sticky'))) {
                    $('.page-header').addClass('sticky');
                } else if ($(window).scrollTop() == 0) {
                    $('.page-header').removeClass('sticky');
                }
            });
        }
});
