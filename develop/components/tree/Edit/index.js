/* global $ */
/* eslint-disable no-underscore-dangle */
import Dialog from '../../Dialog';
import InlineEditor from '../../InlineEditor';

const { lang } = window;

export default function EditItem(tree) {
	let itemID;
	let $editDialog;
	const { dialogEdit } = tree.options;

	function checkRequired() {
		$(`${dialogEdit} .error`).remove();

		let valid = true;

		$(`${dialogEdit} .required`).each(function iter() {
			if (!$(this).val()) {
				const html = `<div class="error">${lang.required}</div>`;
				$(html).insertAfter(this);
				valid = false;
			}
		});

		return valid;
	}

	function submitForm() {
		const action = itemID ? 'save_item' : 'add_item';
		tree._saveItem(action, tree.editForm.serializeArray(), itemID);
	}

	function handleTitleUpdate(e) {
		const id = tree._getItemId($(this).closest('li'));
		const title = e.currentTarget.value;
		const field = $(this)
			.closest('span')
			.data('field');

		if (id && field && title) {
			const data = {
				[field]: title,
				field,
			};

			tree._saveItem('update_item', data, id);
		}

		return lang.processing;
	}

	InlineEditor('.editable', handleTitleUpdate);

	tree.nestedList.on('click', tree.options.editItemClass, e => {
		e.preventDefault();

		itemID = tree._getItemId($(e.currentTarget));
		tree._populateForm(itemID, () => {
			const title = itemID ? lang.editNode : lang.addNode;
			$editDialog.dialog('option', 'title', title).dialog('open');
		});
	});

	$editDialog = new Dialog(dialogEdit, {
		buttons: {
			[lang.saveNode]: function editBtn() {
				if (checkRequired()) {
					submitForm();
					$(this).dialog('close');
				}
			},

			[lang.cancel]: function cancelBtn() {
				$(this).dialog('close');
			},
		},
	});

	return $editDialog;
}
