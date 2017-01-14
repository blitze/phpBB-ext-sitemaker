/*!
 * Sitemaker iconPicker
 * Author: @blitze
 * Licensed under the GPL license
 */

;(function($, window, document, undefined) {
	'use strict';

	var pluginName = 'iconPicker';
	var dataPlugin = 'plugin_' + pluginName;
	var currentItem = {};
	var defaults = {
		selector: '',
		onSelect: function() {}
	};

	// The actual plugin constructor
	var Plugin = function(element) {
		this.options = $.extend({}, defaults);
		this.container = element;
	};

	Plugin.prototype = {

		init: function(options) {
			var self = this;
			this.selectedIcon = '';
			this.iconsDiv = $('#icon-picker');
			this.iconsSearch = this.iconsDiv.find('#icons-search');
			this.fontList = this.iconsDiv.find('#icons-font-list');
			this.icons = this.fontList.find('.filter-icon');
			this.colorBoxes = this.iconsDiv.find('.icons-color-container');
			this.customization = this.iconsDiv.find('#icon-customization');
			this.preview = this.iconsDiv.find('#icon-picker-preview');

			$.extend(this.options, options);

			this.container.on('click', this.options.selector, function(e) {
				e.preventDefault();
				e.stopImmediatePropagation();
				self.element = $(this);
				self.showPicker(self.element);
			});

			this.iconsDiv.mouseleave(function(e) {
				if (!e.fromElement.length) {
					self.hidePicker();
				}
			});

			this.icons.find('i').click(function(e) {
				e.preventDefault();
				e.stopImmediatePropagation();
				self.selectIcon($(this));
			});

			this.iconsSearch.keyup(function() {
				var keyword = $(this).val();
				if (keyword.length) {
					self.icons.hide().filter('div[data-filter*="' + keyword + '"]').show();
				} else {
					self.icons.show();
				}
			});

			this.iconsDiv.find('#icons-font-cat-list').find('a').click(function(e) {
				e.preventDefault();
				e.stopImmediatePropagation();
				self.iconsSearch.val('');
				self.icons.show();
				self._scrollToIcon($($(this).attr('href')));
			});

			this.iconsDiv.find('#icon-picker-insert').click(function(e) {
				e.preventDefault();
				e.stopImmediatePropagation();
				self.insertIcon(self.selectedIcon);
			});

			this.iconsDiv.find('#icon-picker-none').click(function(e) {
				e.preventDefault();
				e.stopImmediatePropagation();
				self.insertIcon('');
			});

			this.customization.find('.icons-customize').change(function(e) {
				e.preventDefault();
				self.previewIcon();
			});

			this.colorBoxes.click(function(e) {
				e.preventDefault();
				self.colorBoxes.removeClass('selected');
				$(this).addClass('selected').next().prop('checked', 'checked').trigger('click');
				self.previewIcon();
			});

			var tabs = $('#icons-tab').tabs().parent();

			// fix the classes
			tabs.find('.icons-bottom-tabs .ui-tabs-nav, .icons-bottom-tabs .ui-tabs-nav > *').removeClass('ui-corner-all ui-corner-top').addClass('ui-corner-bottom');

			// move the nav to the bottom
			tabs.find('.icons-bottom-tabs .ui-tabs-nav').appendTo('.icons-bottom-tabs');
		},

		getIconProps: function(iconClass) {
			if (iconClass) {
				$.each(this.customization.serializeArray(), function(i, field) {
					iconClass += (field.value) ? ' ' + field.value : '';
				});
			}

			return iconClass;
		},

		hidePicker: function() {
			this.iconsDiv.slideUp();
			this.element.removeClass('icons-drop');
		},

		insertIcon: function(icon) {
			if ($.isEmptyObject(currentItem) !== true) {
				var iconClass = this.getIconProps(icon);
				var iconHtml = (iconClass) ? '<i class="' + iconClass + '"></i>' : '';

				currentItem.html(iconHtml);
				this.options.onSelect.call(this, currentItem, iconClass, iconHtml);
			}

			this.hidePicker();
		},

		previewIcon: function() {
			this.preview.children('i').attr('class', this.getIconProps(this.selectedIcon));
		},

		selectIcon: function(element) {
			this.fontList.find('a').removeClass('icon-selected');
			this.selectedIcon = element.attr('class');
			this.previewIcon(this.selectedIcon);
			element.parent().addClass('icon-selected');
		},

		setCurrentIcon: function(element) {
			var currIcon = element.find('i');
			var $inputs = this.customization.find(':input');

			this.colorBoxes.removeClass('selected');
			this.fontList.find('a').removeClass('icon-selected');
			this.customization.get(0).reset();
			this.customization.find('select').val('');
			this.selectedIcon = '';

			if (currIcon.length > 0) {
				var iconInfo = currIcon.attr('class').split(' ');
				iconInfo.shift();

				var iconClass = iconInfo.shift();
				var icon = this.fontList.find('.' + iconClass);

				if (icon.length > 0) {
					icon.parent().addClass('icon-selected');

					this.selectedIcon = 'fa ' + iconClass;
					this._scrollToIcon(icon, true);

					var $selects = $inputs.filter('select').children();

					$.each(iconInfo, function(i, val) {
						$selects.filter('[value=' + val + ']').attr('selected', true);
						$inputs.filter('[value=' + val + ']').attr('checked', true);
					});

					var color = this.customization.find('input[name=color]:checked');
					if (color.length > 0) {
						color.prev().addClass('selected');
					}
				}
			}

			this.previewIcon();
		},

		showPicker: function(element) {
			var pos = element.offset();
			var height = element.height();

			this.element.removeClass('icons-drop');
			this.iconsDiv.slideToggle().offset({
				top: pos.top + height,
				left: pos.left - 15
			});
			this.setCurrentIcon(element);
			currentItem = element.addClass('icons-drop');
		},

		_scrollToIcon: function(element, center) {
			var adjustment = 20;
			if (center) {
				adjustment = -(this.fontList.height() / 2);
			}
			this.fontList.animate({
				scrollTop: this.fontList.scrollTop() + element.position().top + adjustment
			}, 1000);
		},

		destroy: function() {
			this.element.data(dataPlugin, null);
		}
	};

	$.fn[pluginName] = function(arg) {
		var args;
		var instance;

		if (!(this.data(dataPlugin) instanceof Plugin)) {
			this.data(dataPlugin, new Plugin(this));
		}

		instance = this.data(dataPlugin);
		if (instance !== undefined) {
			instance.element = this;

			if (typeof arg === 'undefined' || typeof arg === 'object') {
				if (typeof instance.init === 'function') {
					instance.init(arg);
				}
			} else if (typeof arg === 'string' && typeof instance[arg] === 'function') {
				args = Array.prototype.slice.call(arguments, 1);
				return instance[arg].apply(instance, args);
			} else {
				$.error('Method ' + arg + ' does not exist on jQuery.' + pluginName);
			}
		}
	};
})(jQuery, window, document);