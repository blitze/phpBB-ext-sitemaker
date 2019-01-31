/* global $ */
/* eslint-disable no-underscore-dangle */
import Dialog from '../../Dialog';

const { lang } = window;

export default function DeleteItem(tree) {
	let itemID;
	let $deleteDialog;

	const defaultButtons = {
		[lang.deleteChildNodes]: function delChildNode() {
			const $node = $(`li#item-${itemID}`);
			tree._removeNode($node);
			$(this).dialog('close');
			tree._saveTree();
		},

		[lang.deleteNode]: function delNode() {
			const $node = $(`li#item-${itemID}`);
			if ($node.children(tree.options.listType).length) {
				$node
					.children(tree.options.listType)
					.children('li')
					.appendTo($node.parent(tree.options.listType));
			}
			tree._removeNode($node);
			$(this).dialog('close');
			tree._saveTree();
		},

		[lang.cancel]: function cancelBtn() {
			$(this).dialog('close');
		},
	};

	tree.nestedList.on('click', tree.options.deleteItemClass, e => {
		e.preventDefault();

		itemID = tree._getItemId($(e.currentTarget));
		const buttons = { ...defaultButtons };

		if (
			$(`#item-${itemID}`)
				.children(tree.options.listType)
				.children('li').length < 1
		) {
			delete buttons[lang.deleteChildNodes];
		}

		$deleteDialog.dialog({ buttons }).dialog('open');
	});

	$deleteDialog = new Dialog(tree.options.dialogConfirm);
}
