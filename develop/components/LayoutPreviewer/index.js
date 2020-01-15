/* global $ */
import './style.scss';

let $smallPreview;
let $largePreview;
let currPreview = '';
const defaultPreview = './images/spacer.gif';

function showSmallPreview(layout) {
	if (layout !== currPreview) {
		const src = `${layout}preview.png`;
		$smallPreview.attr('src', src);
		$largePreview.attr('src', src);
		currPreview = layout;
	}
}

export default function LayoutPreviewer() {
	$largePreview = $('.layout-large-preview').find('img');
	$smallPreview = $('.layout-small-preview')
		.find('img')
		.hover(() => {
			$largePreview.parent().toggleClass('show');
		})
		.on('error', () => {
			$smallPreview.attr('src', defaultPreview);
		});

	$('.style-layouts > dl')
		.hover(e => {
			const layout = $(e.currentTarget).data('layout');
			showSmallPreview(layout);
		})
		.find('.layout-option')
		.change(e => {
			const layout = e.currentTarget.value;
			$(e.currentTarget)
				.closest('dl')
				.data('layout', layout);
		});
}
