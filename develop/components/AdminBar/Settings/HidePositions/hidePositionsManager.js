/* global $ */
import { getPOJO, inactiveBlockClass } from '../../../../utils';

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
	const $hideAllCheckbox = $exPositionsForm.find('[name*="hide_blocks"]');
	const $positionSelector = $exPositionsForm.find('[name*="ex_positions"]');

	const exPositions = $positionSelector.val() || [];
	const isHidingBlocks = $hideAllCheckbox.is(':checked');

	hidePositions(isHidingBlocks, exPositions);
	showCurrentState(isHidingBlocks, exPositions);

	const posOptions = positions.ids.reduce((options, id) => {
		if (exPositions.indexOf(id) < 0) {
			options.push(`<option value="${id}">${id}</option>`);
		}
		return options;
	}, []);
	$positionSelector.append(posOptions);

	$exPositionsForm.submit(e => {
		e.preventDefault();

		const data = getPOJO($exPositionsForm.serializeArray());
		saveSettings(data);
	});
}
