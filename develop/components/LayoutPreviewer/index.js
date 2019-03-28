/* global $ */
import './style.scss';

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

export default function LayoutPreviewer() {
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
}
