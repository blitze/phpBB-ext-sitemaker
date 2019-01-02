/* global $ */
import '../../components/Icons/picker';
import './settings.scss';

let $preview;
let currPreview = '';
const defaultPreview = './images/spacer.gif';

function showPreview(layout) {
	if (layout !== currPreview) {
		$preview.error(() => {
			$preview.attr('src', defaultPreview);
		});
		$preview.attr('src', `${layout}preview.png`);
		currPreview = layout;
	}
}

$(document).ready(() => {
	$preview = $('.layout-preview').find('img');

	$('.style-layouts > dl')
		.hover(e => {
			const layout = $(e.currentTarget).data('layout');
			showPreview(layout);
		})
		.find('.layout-option')
		.change(e => {
			const layout = e.currentTarget.value;
			$(e.currentTarget)
				.closest('dl')
				.data('layout', layout);
		});

	// Init icon picker
	$('#acp_settings').iconPicker({
		selector: '.icon-select',
		onSelect: ($item, iconClass) => $item.prev().val(iconClass),
	});
});
