/* global $ */
import InlineEditor from '../../InlineEditor';

const { config, lang } = window;

export default function EditGroup(actions) {
	const handleTitleUpdate = e => {
		const idAttr = $(e.currentTarget)
			.closest('.group-item')
			.attr('id');
		const id = idAttr.substring(6);
		const title = e.currentTarget.value;

		$.post(`${config.ajaxUrl}${actions.edit}`, { id, title }).done(result => {
			$(`#${idAttr}`)
				.find('.group-title')
				.text(result.name);
		});

		return lang.processing;
	};

	InlineEditor('.group-edit', handleTitleUpdate, e =>
		$(e.currentTarget)
			.closest('.group-item')
			.find('.group-title'),
	);
}
