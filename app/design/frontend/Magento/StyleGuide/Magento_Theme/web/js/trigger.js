define([
    "jquery"
], function($) {
    "use strict";
    $.widget('classTrigger', {
        options: {
            url: 'magently_ajax/getInfo',
            method: 'post',
            triggerEvent: 'click'
        },

        _create: function() {
            this._bind();
        },

        _bind: function() {
            var self = this;
            self.element.on(self.options.triggerEvent, function() {
                self._trigEvent();
            });
        },

        _trigEvent: function() {
            var self = this;
            $.elem({
                url: self.options.url,
                type: self.options.method,
                dataType: 'json',
                beforeClick: function() {
                    console.log('beforeClick');
                    $('body').trigger('active');
                },
                success: function(res) {
                    console.log('success');
                    console.log(res);
                    $('body').trigger('active');
                }
            });
        },

    });

    return $.classTrigger;
});
