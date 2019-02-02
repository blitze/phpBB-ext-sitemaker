/* global $ */

import './style.scss';

export default function HighlightPositions($exPositionsBox, positions) {
	function toggleHighlight(e) {
		const posName = e.currentTarget.innerText.trim();
		const $element = positions.items
			.filter(`#pos-${posName}`)
			.toggleClass('sm-highlight-position');
		const scrollTop = $element.offset().top / 2;

		$('html, body')
			.stop()
			.animate({ scrollTop }, 300);
	}

	$exPositionsBox.hover(
		() => positions.showAllPositions(),
		() => positions.hideEmptyPositions(),
	);

	$exPositionsBox.find('label').hover(toggleHighlight);
}
