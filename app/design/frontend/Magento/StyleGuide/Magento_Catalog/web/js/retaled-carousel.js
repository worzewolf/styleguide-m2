define([
    'jquery',
    'owlCarouselSlider'
], function($) {
    'use strict';
    return function(config, element) {
        $('.related-carousel').owlCarousel({
            loop: true,
            margin: 20,
            nav: true,
            items: 5,
            responsive: {
                0: {
                    items: 1
                },
                480: {
                    items: 2
                },
                768: {
                    items: 3
                },
                1024: {
                    items: 4
                }
            }
        });
    }
});
