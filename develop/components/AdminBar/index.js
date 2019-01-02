// @flow
/* global $ */
import AjaxSetup from '../Ajax/setup';
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
		this.$control = this.$root.find('#admin-control');
		this.$dropdownItems = this.$root.find('.has-dropdown');
		this.$msgBox = $('#ajax-message');

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
		this.$dropdownItems.click(this.toggleDropdown);
	}

	toggleAdminBar = e => {
		e.preventDefault();
		this.$control
			.toggleClass('admin-bar-toggler')
			.prev()
			.toggle();
		this.$body.toggleClass('push-down');
	};

	toggleDropdown = e => {
		e.preventDefault();
		const $dropdown = $(e.currentTarget);
		$dropdown
			.closest('ul')
			.find('.dropped')
			.not($dropdown)
			.removeClass('dropped')
			.next()
			.hide();
		this.$currentDropdown = $dropdown.toggleClass('dropped');
		this.$currentDropdown.next().toggle();
	};

	hideDropdown = () => {
		this.$currentDropdown.trigger('click');
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
