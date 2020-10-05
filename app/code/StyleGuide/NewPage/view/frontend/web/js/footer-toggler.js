define([
    'jquery'
], function($) {
    return function(config, element) {
        function ExpandClassToggle() {
            $('.footer-heading').click(function() {
                $(this).toggleClass('a active');
            });
        }
        ExpandClassToggle();
    }
});
