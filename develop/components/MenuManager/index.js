/* global $ */
import AjaxSetup from '../Ajax/setup';

import AddMenuHandler from './AddMenu';
import EditMenuHandler from './EditMenu';
import DeleteMenuHandler from './DeleteMenu';

import './menu.scss';

const { lang } = window;

export default function MenuManager() {
	const $loader = $('#loader i');
	const $msgBox = $('#ajax-message');
	const $menus = $('#sm-menus').show();
	const $tree = $('#nested-tree').treeBuilder({
		ajaxUrl: window.ajaxUrl,
		editForm: '#edit-menu-item-form',
		dialogEdit: '#dialog-edit-menu-item',
		dialogConfirm: '#dialog-confirm-menu-item',
	});

	const showMessage = message => {
		if (message) {
			$msgBox
				.html(message)
				.fadeIn();
		}
	};

	const init = menuId => {
		AjaxSetup($loader, showMessage, `menu_id=${menuId}`);

		if (menuId > 0) {
			$tree.show().treeBuilder('getItems');
		} else {
			$tree.hide();
		}
	};

	let menuId = 0;
	const $firstMenuItem = $menus.children('.menu-item:first');
	if ($firstMenuItem.length) {
		menuId = $firstMenuItem.attr('id').substring(5);
	}

	init(menuId);
	AddMenuHandler($menus);
	EditMenuHandler();
	DeleteMenuHandler($menus, init);

	$('body').on('click', '.menu-item', e => {
		e.preventDefault();
		const isUnsaved = $tree.treeBuilder('isUnsaved');

		// eslint-disable-next-line no-alert
		if (!isUnsaved || window.confirm(lang.unsavedChanges)) {
			menuId = $(e.currentTarget)
				.addClass('row3 current-menu')
				.siblings()
				.removeClass('row3 current-menu')
				.end()
				.attr('id')
				.substring(5);
			init(menuId);
		}
	});
}
