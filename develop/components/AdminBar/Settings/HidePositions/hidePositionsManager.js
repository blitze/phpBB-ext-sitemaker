/* global $ */
import { getPOJO, inactiveBlockClass } from '../../../../utils';

import HighlightPositions from '../HighlightPositions';

const { actions, config, lang } = window;

export default function HidePositionsManager(positions, showMessage) {
	const hidePositions = (isHidingBlocks, exPositions) => {
		if (isHidingBlocks) {
			positions.items.addClass(inactiveBlockClass);
		} else {
			exPositions.map(name =>
				positions.items
					.filter(`#pos-${name}`)
					.addClass(inactiveBlockClass),
			);
		}
	};

	const showCurrentState = (hidingBlocks, exPositions) => {
		if (hidingBlocks) {
			showMessage(
				`<span>
					<i class="fa fa-info-circle fa-blue fa-lg"></i>
					${lang.hidingBlocks}
				</span>`,
			);
		} else if (exPositions.length) {
			showMessage(
				`<span>
					<i class="fa fa-info-circle fa-blue fa-lg"></i> 
					${lang.hidingPos}: <strong>${exPositions.join(', ')}</strong>
				</span>`,
			);
		}
	};

	const saveSettings = formData => {
		const data = {
			route: config.route,
			ext: config.ext,
			...formData,
		};

		$.post(actions.set_route_prefs, data, result => {
			const {
				ex_positions: exPositions,
				hide_blocks: isHidingBlocks,
			} = result;

			positions.items.removeClass(inactiveBlockClass);

			if (isHidingBlocks || exPositions) {
				hidePositions(isHidingBlocks, exPositions);
			}
		});
	};

	const $exPositionsForm = $('#ex-positions');
	const $exPositionsBox = $exPositionsForm.find('.ex-positions-box');
	const $hideAllCheckbox = $exPositionsForm.find('[name*="hide_blocks"]');

	const exPositions = $exPositionsBox
		.data('positions')
		.split(', ')
		.filter(Boolean);
	const isHidingBlocks = $hideAllCheckbox.is(':checked');

	hidePositions(isHidingBlocks, exPositions);
	showCurrentState(isHidingBlocks, exPositions);

	const posOptions = positions.ids.reduce((options, id) => {
		const isChecked =
			exPositions.indexOf(id) > -1 ? ' checked="checked"' : '';
		options.push(
			`<label><input type="checkbox" name="ex_positions[]" value="${id}"${isChecked}> ${id}</label>`,
		);
		return options;
	}, []);
	$exPositionsBox.append(posOptions.join(''));

	$exPositionsForm.submit(e => {
		e.preventDefault();

		const data = getPOJO($exPositionsForm.serializeArray());
		saveSettings(data);
	});

	HighlightPositions($exPositionsBox, positions);
}
