/* global $ */
import CustomBlock from '../CustomBlock';
import InlineEditor from '../InlineEditor';

const { actions, config, lang } = window;

function updateBlockField(data) {
	data.route = config.route;
	return $.post(actions.update_block, data);
}

export default function BlocksManager(positions) {
	const handleTitleUpdate = e => {
		const idAttr = $(e.currentTarget)
			.closest('.block')
			.attr('id');
		const id = idAttr.substring(6);
		const title = e.currentTarget.value;

		updateBlockField({ id, field: 'title', title }).done(result => {
			$(`#${idAttr}`)
				.find('.block-title')
				.text(result.title);
		});

		return lang.processing;
	};

	CustomBlock();
	InlineEditor('.block-title', handleTitleUpdate);

	// Init Icon Picker
	import(/* webpackChunkName: "icon/picker" */ '../Icons/picker').then(() =>
		$('.sitemaker').iconPicker({
			selector: '.block-icon',
			width: '230px',
			onSelect: (item, icon) => {
				const id = item
					.closest('.block')
					.attr('id')
					.substring(6);
				updateBlockField({ id, icon });
			},
		}),
	);

	$(document)
		.on('click', '.edit-block', e => {
			e.preventDefault();
			const $block = $(e.currentTarget).closest('.block');

			Promise.all([
				import(
					/* webpackChunkName: "codemirror/codemirror" */ '../CodeMirror'
				),
				import(/* webpackChunkName: "blocks/edit" */ './Edit'),
			]).then(([codemirror, { default: EditHandler }]) =>
				EditHandler($block, codemirror),
			);
		})
		.on('click', '.delete-block', e => {
			e.preventDefault();
			const $block = $(e.currentTarget).closest('.block');

			import(/* webpackChunkName: "blocks/edit" */ './Delete').then(
				({ default: DeleteHandler }) =>
					DeleteHandler(positions, $block),
			);
		});
}
