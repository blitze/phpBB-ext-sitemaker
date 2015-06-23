/**
 * Copyright 2006-2014 GrapeCity inc
 * Author: isaac.fang@grapecity.com
 */

(function (factory) {
    if (typeof define === 'function' && define.amd) {
        // AMD. Register as an anonymous module.
        define(['jquery'], factory);
    } else if (typeof exports === 'object') {
        // Node/CommonJS style for Browserify
        module.exports = factory;
    } else {
        // Browser globals
        factory(jQuery);
    }
}(function ($) {

    var supportType = ('onwheel' in document || document.documentMode >= 9) ?
        // Modern browsers support "wheel" and IE9+
        'wheel' :
            document.onmousewheel !== undefined ?
        // Webkit and IE support at least "mousewheel"
        'mousewheel' :
        // let's assume that remaining browsers are older Firefox
        'DOMMouseScroll';

    var props = 'deltaMode deltaX deltaY deltaZ';

    $.event.special.wheel = {

        setup: function () {
            if (this.addEventListener) {
                this.addEventListener(supportType, handle, false);
            }
        },

        teardown: function () {
            if (this.removeEventListener) {
                this.removeEventListener(supportType, handle, false);
            }
        }
    };

    var handle = function (originalEvent) {
        var event = $.event.fix(originalEvent),
            args = arguments,
            lineHeight = parseInt($(this).css('line-height'));

        $.each(props.split(' '), function (index, prop) {
            if (prop in originalEvent) {
                event[prop] = originalEvent[prop];

                if (originalEvent.deltaMode === 1) {
                    event[prop] = (index ? event[prop] * lineHeight : 0);
                }
            }
        });

        args[0] = event;

        return $.event.dispatch.apply(this, args);
    };

    jQuery.fn.wheel = function (fn) {
        return (typeof fn === 'function') ? this.on('wheel', fn) : this.trigger('wheel', fn);
    };
}));