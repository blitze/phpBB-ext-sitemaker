/* global $ */
import Dialog from '../../../Dialog';
import Button from '../../../Button/button';
import BlockRenderer from '../../../BlockRenderer';
import { getPOJO } from '../../../../utils';

const { actions, config, lang } = window;

function optionallyShowStyleSelector($form) {
	const $styleSelector = $form.find('[name*="from_style"]');

	let useStyle = false;
	if ($styleSelector.children().length > 1) {
		$styleSelector.show();
		useStyle = true;
	} else {
		$styleSelector.hide();
	}

	return useStyle;
}

function gotoPage(route, styleId, useStyle) {
	let url = route;
	let delim = '';
	let style = '';

	if (config.modReWrite) {
		url = route.replace('app.php/', '');
	}

	if (useStyle) {
		delim = url.indexOf('?') >= 0 ? '&' : '?';
		style = `style=${styleId}`;
	}

	window.location.href = `${config.boardUrl}/${url}${delim}${style}`;
}

function copyBlocks(copyFrom, positions) {
	const ajaxData = $.extend(copyFrom, {
		route: config.route,
		ext: config.ext,
	});

	$.getJSON(actions.copy_route, ajaxData, resp => {
		if (!resp.list || resp.list.length === 0) {
			return;
		}

		positions.showAllPositions();
		positions.clearAll(false);

		const data = {};
		$.each(resp.list, (position, blocks) => {
			const $position = $(`#pos-${position}`);
			$.each(blocks, (i, row) => {
				data.block = row;
				$position.append(
					`<div id="block-${row.id}" class="block"></div>`,
				);
				BlockRenderer.render($position.find(`#block-${row.id}`), data);
			});

			positions.sortHorizontal($position);
		});
		positions.hideEmptyPositions();
	});
}

export default function LayoutDuplicator(positions, hideDropdown) {
	let data = {};

	const $copyForm = $('#copy-form');
	const useStyle = optionallyShowStyleSelector($copyForm);
	const confirm = new Dialog('#dialog-copy', {
		buttons: {
			[lang.copy]: function copyBtn() {
				$(this).dialog('close');
				hideDropdown();
				copyBlocks(data, positions);
			},

			[lang.cancel]: function cancelBtn() {
				$(this).dialog('close');
			},
		},
	});

	Button('.layout-copy', {}, e => {
		e.preventDefault();

		data = getPOJO($copyForm.serializeArray());

		const { from_route: fromRoute, from_style: fromStyle } = data;

		if (
			fromRoute &&
			(fromRoute !== config.route || fromStyle !== config.style)
		) {
			if ($(e.target).data('action') === 'copy') {
				confirm.dialog('open');
			} else {
				gotoPage(fromRoute, fromStyle, useStyle);
			}
		}
	});
}
