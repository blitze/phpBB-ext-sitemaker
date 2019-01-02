/* global $ */
import 'jquery-ui/ui/widgets/draggable';
import 'jquery-ui/themes/base/core.css';
import 'jquery-ui/themes/base/theme.css';
import 'jquery-ui/themes/base/draggable.css';

import './gallery.scss';

export default function BlocksGallery(positions, hideDropdown) {
	$('#add-block-panel')
		.find('.sitemaker-block')
		.draggable({
			addClasses: false,
			iframeFix: true,
			opacity: 0.7,
			helper: 'clone',
			appendTo: 'body',
			revert: 'invalid',
			connectToSortable: '.block-position',
			start: (e, ui) => {
				$(ui.helper).addClass('dragging');
				positions.showAllPositions();
				hideDropdown();
			},
			stop: () => {
				window.setTimeout(() => positions.hideEmptyPositions(), 600);
			},
		});
}
