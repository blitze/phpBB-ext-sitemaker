// @flow
/* global $ */

import './style.scss';

const { actions } = window;

export default function SidebarWidth(getPositionName: Function): string {
	const defaultColWidth = '200px';
	let timeOut;

	/**
	 * @param {string} width
	 * @returns {string}
	 */
	function getWidthParts(width: string): [] {
		const [, size, unit = 'px'] = width.match(/(^\d+\.?\d?)([a-z%]+$)?/i);
		return [+size, unit];
	}

	/**
	 * @param {string} width
	 * @returns {string}
	 */
	function getWidthUnits(width: string): string {
		const [size, unit] = getWidthParts(width);
		return `${size}${unit}`;
	}

	/**
	 * @param {jQuery} $sidebar
	 * @param {string} width
	 */
	function render($sidebar: jQuery, width: string): void {
		$sidebar.css('width', width);
	}

	/**
	 * @param {jQuery} $sidebar
	 * @param {string} width
	 */
	function save($sidebar: jQuery, width: string): void {
		clearTimeout(timeOut);
		timeOut = setTimeout(() => {
			const data = {
				position: getPositionName($sidebar),
				width: defaultColWidth !== width ? width : '',
			};

			$.post(actions.update_column_width, data);
		}, 1000);
	}

	$('.column-sizer').each((i, el) => {
		let $sidebar;
		let stepTimer;
		let colUnit;
		let colWidth = 0;

		const $columnSizeInput = $(el).find('.column-size-input')
			.focusin(e => {
				$sidebar = $(e.target).closest('.sidebar');
			})
			.focusout(e => {
				const width = getWidthUnits(e.target.value);
				save($sidebar, width);
			})
			.keyup(e => {
				render($sidebar, e.target.value);
			})
			.submit(e => {
				e.preventDefault();
				const width = getWidthUnits(e.target[0].value);
				save($sidebar, width);
			});

		$(el)
			.find('.stepper')
			.mouseup(() => {
				clearInterval(stepTimer);
				const $input = $columnSizeInput.find('input');
				const width = getWidthUnits($input.val());
				save($sidebar, width);
			})
			.mousedown(e => {
				e.preventDefault();
				const $input = $columnSizeInput.find('input');
				const widthVal = $input.val();
				const [width, unit] = getWidthParts(widthVal);
				const step = $(e.target).hasClass('increment') ? 1 : -1;
				const columnSizer = () => {
					colWidth += step;
					if (colWidth >= 0) {
						const size = `${colWidth}${colWidth > 0 ? colUnit : ''}`;
						$input.val(size);
						render($sidebar, size);
					}
				};

				colWidth = width;
				colUnit = colUnit || unit;
				$sidebar = $(e.target).closest('.sidebar');

				// eslint-disable-next-line smells/no-setinterval
				stepTimer = setInterval(columnSizer, 200);
				columnSizer();
			});
	});
}
