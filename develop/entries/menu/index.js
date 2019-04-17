/* global $ */
const { config, TreeGroup } = window;

$(document).ready(() => {
	TreeGroup({
		idKey: 'menu_id',
		ajaxUrl: config.ajaxUrl,
		editForm: '#edit-menu-item-form',
		dialogEdit: '#dialog-edit-item',
		dialogConfirm: '#dialog-confirm-delete-item',
		groupActions: {
			add: 'add_menu',
			edit: 'edit_menu',
			remove: 'delete_menu',
		},
	});
});
