// @flow
/* global $ */

import './style.scss';

const { actions } = window;

export default function SidebarWidth(getPositionName: Function): string {
	const defaultColSize = '200px';
	let timeOut;

	/**
	 * @param {string} width
	 * @returns {string}
	 */
	function getWidthParts(width: string): [] {
		const matches = width.match(/(^\d+\.?\d?)([a-z%]+$)?/i);
		const [, size = 200, unit = 'px'] = matches || [];
		return [+size, unit];
	}

	/**
	 * @param {jQuery} $sidebar
	 * @param {jQuery} $input
	 * @param {string} width
	 */
	function save($sidebar: jQuery, $input: jQuery, width: string): void {
		clearTimeout(timeOut);
		timeOut = setTimeout(() => {
			const data = {
				position: getPositionName($sidebar),
				width,
			};

			$.post(actions.update_column_width, data);
			$input.val(width);
		}, 1000);
	}

	$('.column-sizer').each((i, el) => {
		let stepTimer;
		let colUnit;
		let colWidth = 0;

		const $columnSizeInput = $(el).find('.column-size-input');
		const $sidebar = $columnSizeInput.closest('.sidebar');

		/**
		 * @param {jQuery} $input
		 */
		function render($input: jQuery): void {
			const inputSize = $input.val();
			const [width, unit] = getWidthParts(inputSize);
			const size = width > 0 ? `${width}${unit}` : defaultColSize;
			$sidebar.css('width', size);
			save($sidebar, $input, size);
		}

		$columnSizeInput.keyup(e => render($(e.target)));

		$(el)
			.find('.stepper')
			.mouseup(() => clearInterval(stepTimer))
			.mousedown(e => {
				e.preventDefault();
				const $input = $columnSizeInput.find('input');
				const widthVal = $input.val();
				const [width, unit] = getWidthParts(widthVal);
				const step = $(e.target).hasClass('increment') ? 1 : -1;

				colWidth = width;
				colUnit = colUnit || unit;

				const columnSizer = () => {
					colWidth += step;
					if (colWidth > 0) {
						const size = `${colWidth}${colUnit}`;
						render($input.val(size));
					}
				};

				// eslint-disable-next-line smells/no-setinterval
				stepTimer = setInterval(columnSizer, 200);
				columnSizer();
			});
	});
}
