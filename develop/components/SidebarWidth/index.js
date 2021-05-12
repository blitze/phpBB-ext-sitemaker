// @flow
import './style.scss';

const { actions } = window;

export default function SidebarWidth(getPositionName: Function): string {
	const defaultColWidth = 200;
	let timeOut;

	/**
	 * @param {string} width
	 * @returns {string}
	 */
	function getWidthParts(width: string): [] {
		const matches = width.match(/(^\d+\.?\d?)([a-z%]+$)?/i);
		const [, size = defaultColWidth, unit = ''] = matches || [];
		return [+size, unit];
	}

	/**
	 * @param {jQuery} $sidebar
	 * @param {jQuery} $input
	 * @param {number} width
	 * @param {string} unit
	 */
	function save(
		$sidebar: jQuery,
		$input: jQuery,
		width: number,
		unit: string,
	): void {
		clearTimeout(timeOut);
		timeOut = setTimeout(() => {
			const data = {
				position: getPositionName($sidebar),
				width: `${width}${unit || 'px'}`,
			};

			$.post(actions.update_column_width, data);
			$input.val(`${width}${unit}`);
		}, 500);
	}

	$('.column-sizer').each((i, element) => {
		const $columnSizeInput = $(element).find('.column-size-input');
		const $sidebar = $columnSizeInput.closest('.sidebar');

		/**
		 * @param {jQuery} $input
		 */
		function render($input: jQuery): void {
			const inputSize = $input.val();
			const [width, unit] = getWidthParts(inputSize);
			const colWidth = width > 0 ? width : defaultColWidth;

			$sidebar.css('width', `${colWidth}${unit}`);
			save($sidebar, $input, colWidth, unit);
		}

		let stepInterval;
		let stepTimeOut;
		let colWidth = 0;

		$columnSizeInput.keyup((e) => render($(e.target)));

		$(element)
			.find('.stepper')
			.mouseup(() => {
				clearTimeout(stepTimeOut);
				clearInterval(stepInterval);
			})
			.mousedown((e) => {
				const $input = $columnSizeInput.find('input');
				const widthVal = $input.val();
				const [width, unit] = getWidthParts(widthVal);
				const step = $(e.target).hasClass('increment') ? 1 : -1;

				e.preventDefault();
				colWidth = width;

				const columnSizer = () => {
					colWidth += step;
					if (colWidth > 0) {
						const size = `${colWidth}${unit}`;
						render($input.val(size));
					}
				};

				stepTimeOut = setTimeout(() => {
					// eslint-disable-next-line smells/no-setinterval
					stepInterval = setInterval(columnSizer, 50);
				}, 300);
				columnSizer();
			});
	});
}
