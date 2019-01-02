/* global $ */
import InlineEditor from '../../InlineEditor';

const { ajaxUrl, lang } = window;

export default function EditMenuHandler() {
	const handleTitleUpdate = e => {
		const idAttr = $(e.currentTarget)
			.closest('.menu-item')
			.attr('id');
		const id = idAttr.substring(5);
		const title = e.currentTarget.value;

		$.post(`${ajaxUrl}edit_menu`, { id, title }).done(result => {
			$(`#${idAttr}`)
				.find('.menu-title')
				.text(result.name);
		});

		return lang.processing;
	};

	InlineEditor('.menu-edit', handleTitleUpdate, e =>
		$(e.currentTarget)
			.closest('.menu-item')
			.find('.menu-title'),
	);
}
