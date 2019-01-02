/* global $ */
/* eslint-disable no-underscore-dangle */
import Button from '../../Button/button';
import Dialog from '../../Dialog';

const { lang } = window;

export default function SelectAll(tree) {
	const { selectItemClass } = tree.options;
	const $confirm = new Dialog(tree.options.dialogConfirm, {
		buttons: {
			[lang.deleteNode]: function confirmBtn() {
				tree.nestedList
					.find(`${selectItemClass}:checked`)
					.closest('li')
					.each(function iterator() {
						tree._removeNode($(this));
					});
				tree._saveTree();
				$(this).dialog('close');
			},

			[lang.cancel]: function cancelBtn() {
				$(this).dialog('close');
			},
		},
	});

	const $deleteSelBtn = Button(
		tree.options.deleteSelBtn,
		{
			disabled: true,
			icons: {
				primary: 'ui-icon-trash',
			},
		},
		e => {
			e.preventDefault();
			$confirm.dialog('open');
		},
	);

	tree.$selectAll = $(tree.options.selectAll).click(e => {
		tree.nestedList
			.find(selectItemClass)
			.prop('checked', e.currentTarget.checked);
		if (e.currentTarget.checked) {
			$deleteSelBtn.button('enable');
		} else {
			$deleteSelBtn.button('disable');
		}
	});

	tree.nestedList.on('click', tree.options.selectItemClass, () => {
		const $checkboxes = tree.nestedList.find(`${selectItemClass}`);
		const numSelected = $checkboxes.filter(':checked').length;

		if (numSelected > 0) {
			$deleteSelBtn.button('enable');
		} else {
			$deleteSelBtn.button('disable');
		}

		if (numSelected === $checkboxes.length) {
			tree.$selectAll.prop('checked', true);
		} else {
			tree.$selectAll.prop('checked', false);
		}
	});

	return $deleteSelBtn;
}
