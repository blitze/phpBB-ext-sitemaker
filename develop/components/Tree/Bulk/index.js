/* global $ */
/* eslint-disable no-underscore-dangle */

import Button from '../../Button/button';
import BtnGrpDrop from '../../BtnGrpDrop';

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

	let codeMirror;
	const $textarea = $(tree.options.addBulkList);

	const $addBulkBtn = BtnGrpDrop(tree.options.addBulkBtn, 'down', () => {
		import(
			/* webpackChunkName: "codemirror/codemirror" */ '../../CodeMirror'
		).then(({ default: CodeMirror, initCodeMirror, insertText }) => {
			if (!$textarea.next().hasClass('CodeMirror')) {
				codeMirror = initCodeMirror(tree.options.addBulkList);

				let cmTabs = 0;
				codeMirror.on('keyup', cm => {
					const doc = cm.getDoc();
					const line = doc.getLine(cm.getCursor().line);
					const matches = line.match(/\s/gim);
					cmTabs = matches ? matches.length : 0;
				});

				codeMirror.on('change', (cm, change) => {
					const spaces = cmTabs * cm.options.tabSize;
					cm.operation(() => {
						for (
							let line = change.from.line + 1,
								end = CodeMirror.changeEnd(change).line;
							line <= end;
							line += 1
						) {
							cm.indentLine(line, spaces);
						}
					});
				});

				Button('.bulk-type', {}, e => {
					e.preventDefault();
					const itemsStr = $(e.currentTarget)
						.data('items')
						.trim();
					insertText(codeMirror, itemsStr, true);
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
						list.push(
							`<a href="#" data-item="${item}">${title}</a>`,
						);
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

					insertText(codeMirror, $item.data('item').trim(), true);
					$item.parents('.bulk-type-items').toggle();
				});
			} else {
				// reset codemirror
				codeMirror.setValue('');
				codeMirror.clearHistory();
			}
		});

		const options = `<option value="0">${lang.none}</option>`;
		$addBulkBtn
			.parent()
			.next()
			.find('select')
			.html(getOptions(tree.nestedList, '', options))
			.next()
			.val();
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

			tree._addBulk($.param(data));
			$addBulkBtn.trigger('click');
		});
}
