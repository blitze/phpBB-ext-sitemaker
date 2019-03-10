/* global $ */
/* eslint-disable no-underscore-dangle */

import Button from '../../Button/button';
import BtnGrpDrop from '../../BtnGrpDrop';
import { initCodeMirror, insertText } from '../../CodeMirror';

const { lang } = window;

export default function AddBulkBtn(tree) {
	function getOptions($list, padding, options) {
		$list.children('li').each((i, element) => {
			const $item = $(element);
			const id = tree._getItemId($item);
			const title = `${padding}&#x251c;&#x2500; ${$item
				.find('.editable:first')
				.text()}`;
			const option = `<option value="${id}">${title}</option>`;

			options += getOptions(
				$item.children('ol'),
				`&nbsp;&nbsp;&nbsp;&nbsp;${padding}`,
				option,
			);
		});

		return options;
	}

	const codeMirror = initCodeMirror(tree.options.addBulkList);

	const $addBulkBtn = BtnGrpDrop(tree.options.addBulkBtn, 'down', () => {
		const options = `<option value="0">${lang.none}</option>`;
		$addBulkBtn
			.parent()
			.next()
			.find('select')
			.html(getOptions(tree.nestedList, '', options))
			.next()
			.val();

		if (codeMirror.getValue().length) {
			codeMirror.setValue('');
			codeMirror.clearHistory();
		}
	});

	Button('.bulk-type', {}, e => {
		e.preventDefault();
		const itemsStr = $(e.currentTarget)
			.data('items')
			.trim();
		insertText(itemsStr, true);
	}).each((i, element) => {
		const list = [];
		const $type = $(element);
		const items = $type
			.data('items')
			.trim()
			.split('\n');
		$.each(items, (j, item) => {
			const parts = item.split('|');
			const title = parts[0].replace(/\t/g, '&nbsp; &nbsp;');
			list.push(`<a href="#" data-item="${item}">${title}</a>`);
		});
		$type
			.parent()
			.next('.bulk-dropdown')
			.children('.inner')
			.html(list.join('\n'));
	});

	BtnGrpDrop('.bulk-type-list', 'up');

	$('.bulk-type-items').on('click', 'a', e => {
		e.preventDefault();

		const $item = $(e.currentTarget);

		insertText($item.data('item').trim(), true);
		$item.parents('.bulk-type-items').toggle();
	});

	$('.toggle-view').click(e => {
		e.preventDefault();
		$($(e.currentTarget).attr('href')).slideToggle();
	});

	$addBulkBtn
		.parent()
		.show()
		.next()
		.find('#cancel')
		.click(() => $addBulkBtn.trigger('click'))
		.next()
		.click(e => {
			e.preventDefault();
			const data = {
				add_list: codeMirror.getValue(),
			};

			const $form = $(e.target).closest('form');

			data[tree.options.fields.parentId] = $form.find('#parent_id').val();

			// reset codemirror
			codeMirror.setValue('');
			codeMirror.clearHistory();

			tree._addBulk($.param(data));
			$addBulkBtn.trigger('click');
		});
}
