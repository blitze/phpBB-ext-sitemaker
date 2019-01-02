/*!
 * Sitemaker iconPicker
 * Author: @blitze
 * Licensed under the GPL license
 */
import 'jquery-ui/ui/widgets/tabs';
import 'jquery-ui/themes/base/core.css';
import 'jquery-ui/themes/base/theme.css';
import 'jquery-ui/themes/base/tabs.css';

import OutsideClick from '../OutsideClick';

import './picker.scss';

/* global $ */

const pluginName = 'iconPicker';
const dataPlugin = `plugin_${pluginName}`;
const defaults = {
	selector: '',
	width: '350px',
	onSelect: () => {},
};
let currentItem = {};

// The actual plugin constructor
const Plugin = function constructor($element) {
	this.options = $.extend({}, defaults);
	this.$container = $element;
};

Plugin.prototype = {
	init: function init(options) {
		this.selectedIcon = '';
		this.$iconsDiv = $('#icon-picker');
		this.$iconsSearch = this.$iconsDiv.find('#icons-search');
		this.$fontList = this.$iconsDiv.find('#icons-font-list');
		this.$icons = this.$fontList.find('.filter-icon');
		this.$colorBoxes = this.$iconsDiv.find('.icons-color-container');
		this.$customization = this.$iconsDiv.find('#icon-customization');
		this.$preview = this.$iconsDiv.find('#icon-picker-preview');

		$.extend(this.options, options);

		this.$container.on('click', this.options.selector, e => {
			e.preventDefault();
			e.stopPropagation();

			const $element = $(e.currentTarget);

			if (!this.$element || this.$element.context !== $element.context) {
				this.showPicker($element);
			} else {
				this.hidePicker();
			}
		});

		this.$icons.find('i').click(e => {
			e.preventDefault();
			e.stopImmediatePropagation();
			this.selectIcon($(e.currentTarget));
		});

		this.$iconsSearch.keyup(e => {
			const keyword = $(e.currentTarget).val();
			if (keyword.length) {
				this.$icons
					.hide()
					.filter(`div[data-filter*="${keyword}"]`)
					.show();
			} else {
				this.$icons.show();
			}
		});

		this.$iconsDiv
			.width(this.options.width)
			.find('#icons-font-cat-list')
			.find('a')
			.click(e => {
				e.preventDefault();
				e.stopImmediatePropagation();
				this.$iconsSearch.val('');
				this.$icons.show();
				this.scrollToIcon($($(e.currentTarget).attr('href')));
			});

		this.$iconsDiv.find('#icon-picker-insert').click(e => {
			e.preventDefault();
			e.stopImmediatePropagation();
			this.insertIcon(this.selectedIcon);
		});

		this.$iconsDiv.find('#icon-picker-none').click(e => {
			e.preventDefault();
			e.stopImmediatePropagation();
			this.insertIcon('');
		});

		this.$customization.find('.icons-customize').change(e => {
			e.preventDefault();
			this.previewIcon();
		});

		this.$colorBoxes.click(e => {
			e.preventDefault();
			this.$colorBoxes.removeClass('selected');
			$(e.currentTarget)
				.addClass('selected')
				.next()
				.prop('checked', 'checked')
				.trigger('click');
			this.previewIcon();
		});

		const $tabs = $('#icons-tab')
			.tabs()
			.parent();

		// fix the classes
		const tabsBottomSelector =
			'.icons-bottom-tabs .ui-tabs-nav, .icons-bottom-tabs .ui-tabs-nav > *';
		$tabs
			.find(tabsBottomSelector)
			.removeClass('ui-corner-all ui-corner-top')
			.addClass('ui-corner-bottom');

		// move the nav to the bottom
		$tabs
			.find('.icons-bottom-tabs .ui-tabs-nav')
			.appendTo('.icons-bottom-tabs');

		this.hidePicker = this.hidePicker.bind(this);
		OutsideClick(this.$iconsDiv, this.hidePicker);
	},

	getIconProps(iconClass) {
		const classes = [];
		if (iconClass) {
			classes.push(iconClass);
			$.each(this.$customization.serializeArray(), (i, field) => {
				if (field.value) {
					classes.push(field.value);
				}
			});
		}

		return classes.join(' ');
	},

	insertIcon(icon) {
		if ($.isEmptyObject(currentItem) !== true) {
			const iconClass = this.getIconProps(icon);
			const iconHtml = iconClass ? `<i class="${iconClass}"></i>` : '';

			currentItem.html(iconHtml);
			this.options.onSelect.call(this, currentItem, iconClass, iconHtml);
		}

		this.hidePicker();
	},

	previewIcon() {
		this.$preview
			.children('i')
			.attr('class', this.getIconProps(this.selectedIcon));
	},

	selectIcon($element) {
		this.$fontList.find('a').removeClass('icon-selected');
		this.selectedIcon = $element.attr('class');
		this.previewIcon(this.selectedIcon);
		$element.parent().addClass('icon-selected');
	},

	setCurrentIcon($element) {
		const $currIcon = $element.find('i');
		const $inputs = this.$customization.find(':input');

		this.$colorBoxes.removeClass('selected');
		this.$fontList.find('a').removeClass('icon-selected');
		this.$customization.get(0).reset();
		this.$customization.find('select').val('');
		this.selectedIcon = '';

		if ($currIcon.length) {
			const iconInfo = $currIcon
				.attr('class')
				.trim()
				.split(' ');
			iconInfo.shift();

			const iconClass = iconInfo.shift();
			const $icon = this.$fontList.find(`.${iconClass}`);

			if ($icon.length > 0) {
				$icon.parent().addClass('icon-selected');

				this.selectedIcon = `fa ${iconClass}`;
				this.scrollToIcon($icon, true);

				const $selects = $inputs.filter('select').children();

				$.each(iconInfo, (i, val) => {
					$selects.filter(`[value=${val}]`).attr('selected', true);
					$inputs.filter(`[value=${val}]`).attr('checked', true);
				});

				const $color = this.$customization.find(
					'input[name=color]:checked',
				);
				if ($color.length > 0) {
					$color.prev().addClass('selected');
				}
			}
		}

		this.previewIcon();
	},

	showPicker($element) {
		const pos = $element.offset();
		const height = $element.height();

		$element.removeClass('icons-drop');
		this.$iconsDiv.slideDown().offset({
			top: pos.top + height,
			left: pos.left - 15,
		});
		this.setCurrentIcon($element);
		this.$element = $element;
		currentItem = $element.addClass('icons-drop');
	},

	hidePicker() {
		if (this.$element) {
			this.$iconsDiv.slideUp();
			this.$element.removeClass('icons-drop');
			this.$element = undefined;
		}
	},

	scrollToIcon: function scrollToIcon($element, center) {
		let adjustment = 20;
		if (center) {
			adjustment = -(this.$fontList.height() / 2);
		}
		this.$fontList.animate(
			{
				scrollTop:
					this.$fontList.scrollTop() +
					$element.position().top +
					adjustment,
			},
			1000,
		);
	},

	destroy: function destroy() {
		this.$element.data(dataPlugin, null);
	},
};

$.fn[pluginName] = function pluginInstance(arg, ...rest) {
	if (!(this.data(dataPlugin) instanceof Plugin)) {
		this.data(dataPlugin, new Plugin(this));
	}

	const instance = this.data(dataPlugin);
	if (instance !== undefined) {
		instance.element = this;

		if (typeof arg === 'undefined' || typeof arg === 'object') {
			if (typeof instance.init === 'function') {
				instance.init(arg);
			}
		} else if (
			typeof arg === 'string' &&
			typeof instance[arg] === 'function'
		) {
			return instance[arg](arg, ...rest);
		} else {
			$.error(`Method ${arg} does not exist on jQuery.${pluginName}`);
		}
	}
	return this;
};
