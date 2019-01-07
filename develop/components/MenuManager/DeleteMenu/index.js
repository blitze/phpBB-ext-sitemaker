/* global $ */
import Dialog from '../../Dialog';

const { ajaxUrl, lang } = window;

export default function DeleteMenuHandler($menus, initTree) {
	let $currentMenu;

	const removeMenu = () => {
		$.post(`${ajaxUrl}delete_menu`).done(() => {
			if ($currentMenu.siblings('.menu-item').length) {
				const $selected = $currentMenu.prev('.menu-item')
					? $currentMenu.prev()
					: $currentMenu.next();
				$selected.trigger('click');
			} else {
				initTree(0);
			}

			$currentMenu.remove();
		});
	};

	const confirm = new Dialog('#dialog-confirm-menu', {
		buttons: {
			[lang.remove]: function deleteBtn() {
				$(this).dialog('close');
				removeMenu();
			},

			[lang.cancel]: function cancelBtn() {
				$(this).dialog('close');
			},
		},
	});

	$menus.on('click', '.menu-delete', e => {
		e.preventDefault();
		confirm.dialog('open');

		$currentMenu = $(e.currentTarget).closest('.menu-item');
	});
}
