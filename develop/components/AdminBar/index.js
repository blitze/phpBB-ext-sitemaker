// @flow
/* global $ */
import AjaxSetup from '../Ajax/setup';
import OutsideClick from '../OutsideClick';
import BlocksGallery from './BlocksGallery';
import LayoutSettings from './Settings';
import StyleSelector from './StyleSelector';
import SaveLayout from './SaveLayout';
import ToggleEdit from './ToggleEdit';

import './adminBar.scss';

const { config } = window;

export default class AdminBar {
	$currentDropdown;

	constructor(positions) {
		this.$body = $('body');
		this.$root = $('#admin-bar');
		this.$msgBox = $('#ajax-message');
		this.$control = this.$root.find('#admin-control');
		this.$dropdownItems = this.$root
			.find('.has-dropdown')
			.each((i, element) => {
				OutsideClick($(element).next(), this.hideDropdown);
			});

		this.positions = positions;

		this.bindEvents();
		this.initAjax();
	}

	show() {
		this.$root
			.show()
			.children()
			.eq(0)
			.show(100, () => {
				// Thanks KungFuJosh, for this tip
				this.$body.addClass('push-down');
			});

		ToggleEdit();
		StyleSelector();
		LayoutSettings(this, this.hideDropdown);
		BlocksGallery(this.positions, this.hideDropdown);
		SaveLayout(this.positions);
	}

	bindEvents() {
		this.$control.click(this.toggleAdminBar);
		this.$body.on('click', '.has-dropdown', this.showDropdown);
	}

	toggleAdminBar = e => {
		e.preventDefault();
		this.$control
			.toggleClass('admin-bar-toggler')
			.prev()
			.toggle();
		this.$body.toggleClass('push-down');
	};

	showDropdown = e => {
		e.preventDefault();
		e.stopPropagation();
		this.$dropdownItems
			.removeClass('dropped')
			.next()
			.hide();
		this.$currentDropdown = $(e.target).addClass('dropped');
		this.$currentDropdown.next().show();
	};

	hideDropdown = () => {
		this.$currentDropdown
			.removeClass('dropped')
			.next()
			.hide();
	};

	showMessage = message => {
		if (message) {
			this.$msgBox
				.html(message)
				.fadeIn()
				.delay(5000)
				.fadeOut();
		}
	};

	initAjax() {
		const $loader = this.$control.find('i');
		AjaxSetup($loader, this.showMessage, `style=${config.style}`);
	}
}
