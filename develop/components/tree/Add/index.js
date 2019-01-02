/* global $ */
/* eslint-disable no-underscore-dangle */
import Button from '../../Button/button';

const { lang } = window;

export default function AddBtn(tree, $editDialog) {
	const $addBtn = Button(
		tree.options.addBtn,
		{
			icons: {
				primary: 'ui-icon-plus',
			},
		},
		() => {
			if (tree.options.dialogEdit.length) {
				tree._populateForm();
				$editDialog
					.dialog('option', 'title', lang.addNode)
					.dialog('open');
			} else {
				tree.addItem();
			}
		},
	);

	tree.addBtnOffset = $addBtn.offset();
}
