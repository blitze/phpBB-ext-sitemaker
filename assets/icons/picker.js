/*!
 * Primetime iconPicker
 * Author: @blitze
 * Licensed under the GPL license
 */
 
;(function ($, window, document, undefined) {
	"use strict";

    var pluginName = 'iconPicker',
        dataPlugin = "plugin_" + pluginName,
        defaults = {
            onSelect: function(){}
        };

    // The actual plugin constructor
    var Plugin = function (element) {
        this.options = $.extend({}, defaults);
        this.element = element;
    };

    Plugin.prototype = {

        init: function (options) {
			var self = this;
			this.item = {};
			this.iconsDiv = $('#icon-picker');
			this.fontList = this.iconsDiv.find('#icons-font-list');
			this.colorBoxes = this.iconsDiv.find('.icons-color-container');
			this.customization = this.iconsDiv.find('#icon-customization');

            $.extend(this.options, options);

			this.element.on('click', function(e) {
				e.stopImmediatePropagation();
				self.showPicker($(this));
				return false;
			});

			this.iconsDiv.mouseleave(function() {
				self.hidePicker();
			}).children().find('i').click(function(e){
				e.stopImmediatePropagation();
				var iconClass = $(this).attr('class');
				self.hidePicker();
				self.selectIcon(iconClass);
				return false;
			});

			this.iconsDiv.find('#icons-font-cat-list').find('a').click(function(e) {
				e.stopImmediatePropagation();
				self._scrollToIcon($($(this).attr('href')));
				return false;
			});

			this.colorBoxes.click(function(e) {
				e.stopImmediatePropagation();
				self.colorBoxes.removeClass('selected');
				$(this).addClass('selected').next().prop('checked', 'checked').trigger('click');
				return false;
			});

			var tabs = $("#icons-tab").tabs().parent();

			// fix the classes
			tabs.find('.icons-bottom-tabs .ui-tabs-nav, .icons-bottom-tabs .ui-tabs-nav > *').removeClass('ui-corner-all ui-corner-top').addClass('ui-corner-bottom');

			// move the nav to the bottom
			tabs.find('.icons-bottom-tabs .ui-tabs-nav').appendTo('.icons-bottom-tabs');
        },

		showPicker : function(element) {
			var pos = element.offset();
			var height = element.height();

			this.element.removeClass('icons-drop');
			this.item = element.addClass('icons-drop');
			this.iconsDiv.slideToggle().offset({
				top: pos.top + height - 1,
				left: pos.left - 5
			});
			this.setIcon(element);
		},

		hidePicker : function() {
			this.iconsDiv.slideUp();
			this.element.removeClass('icons-drop');
		},

		selectIcon : function(iconClass) {
			$.each(this.customization.serializeArray(), function(i, field) {
				iconClass += (field.value) ? ' ' + field.value : '';
			});
			var iconHtml = '<i class="' + iconClass + '"></i>';

			this.item.html(iconHtml);
			this.options.onSelect.call(this, this.item, iconHtml, iconClass);
		},

		setIcon : function(element) {
			var curr_icon = element.find('i');

			this.colorBoxes.removeClass('selected');
			this.customization[0].reset();
			this.fontList.find('a').removeClass('icon-selected');

			if (curr_icon.length > 0) {
				var icon_info = curr_icon.attr('class').split(' ');
				icon_info.shift();

				var self = this, icon = this.fontList.find('.' + icon_info.shift());

				if (icon.length > 0) {
					icon.parent().addClass('icon-selected');
					this._scrollToIcon(icon);
					this.customization.find(':input').val(icon_info);

					var color = this.customization.find('input[name=color]:checked');
					if (color.length > 0) {
						color.prev().addClass('selected');
					}
				}
			}
		},

		_scrollToIcon : function(element) {
			this.fontList.animate({
				scrollTop: this.fontList.scrollTop() + element.position().top - 12
			},1000);
		},

        destroy: function () {
            this.element.data(dataPlugin, null);
        }
    };

    $.fn[pluginName] = function (arg) {
        var args, instance;
        if (!(this.data( dataPlugin) instanceof Plugin)) {
            this.data(dataPlugin, new Plugin(this));
        }

        instance = this.data(dataPlugin);
        if (instance !== undefined) {
			instance.element = this;

			if (typeof arg === 'undefined' || typeof arg === 'object') {
				if (typeof instance['init'] === 'function') {
					instance.init( arg );
				}
			} else if (typeof arg === 'string' && typeof instance[arg] === 'function') {
				args = Array.prototype.slice.call( arguments, 1 );
				return instance[arg].apply( instance, args );
			} else {
				$.error('Method ' + arg + ' does not exist on jQuery.' + pluginName);
			}
        }
    };
})(jQuery, window, document);