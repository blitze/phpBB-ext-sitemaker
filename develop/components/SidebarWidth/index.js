// @flow
/* global $ */

import './style.scss';

const { actions } = window;

export default function SidebarWidth(getPositionName: Function): string {
	const defaultColWidth = '200px';

	/**
	 * @param {string} width
	 * @returns {string}
	 */
	function getWidthUnits(width: string) {
		const [, size, unit = 'px'] = width.match(/(^[0-9]+)([a-z%]+$)?/i);
		return `${size}${unit}`;
	}

	let $sidebar;
	let timeOut;
	let currentWidth;

	$('.column-size-input')
		.focusin(e => {
			$sidebar = $(e.target).closest('.sidebar');
			currentWidth = $sidebar.css('width');
		})
		.keyup(e => {
			clearTimeout(timeOut);
			timeOut = setTimeout(() => {
				const width = getWidthUnits(e.target.value);
				$sidebar.css('width', width || currentWidth);
			}, 200);
		})
		.focusout(e => {
			e.target.value =
				defaultColWidth !== currentWidth ? currentWidth : '';
			$sidebar.css('width', currentWidth);
			currentWidth = '';
		})
		.submit(e => {
			e.preventDefault();
			const width = getWidthUnits(e.target[0].value);
			const data = {
				position: getPositionName($sidebar),
				width: defaultColWidth !== width ? width : '',
			};

			$.post(actions.update_column_width, data, result => {
				if (!result.error) {
					currentWidth = data.width || defaultColWidth;

					$(e.target[0]).blur();
				}
			});
		});
}
