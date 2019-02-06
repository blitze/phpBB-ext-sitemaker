/* global $ */
export default function ClassPicker($dialogEdit) {
	let $editor;
	const run = {
		toggle: function toggle(e) {
			const target = $(e.currentTarget).attr('href');
			$dialogEdit.find(target).slideToggle();
		},
		redo: function redo(e, action) {
			$editor.focus();
			document.execCommand(action, false, null);
			$editor.change();
		},
		undo: function unto(e, action) {
			run.redo(e, action);
		},
		clear: function clear() {
			$editor.text('').change();
		},
	};

	$dialogEdit
		.on('click', '.block-class-actions', function classActions(e) {
			e.preventDefault();

			$editor = $dialogEdit.find('#block_class');
			const action = $(this).data('action');
			run[action](e, action);
		})
		.on('click', '.class-cat', function category(e) {
			e.preventDefault();

			const id = $(this).attr('href');
			const $scroller = $('#classes-scroller');
			$scroller.animate(
				{
					scrollTop: $scroller.scrollTop() + $(id).position().top,
				},
				1000,
			);
		})
		.on('click', '.transform', function insertClass(e) {
			e.preventDefault();

			$editor = $dialogEdit.find('#block_class');

			$editor.focus();
			document.execCommand('insertText', false, $(this).text() + ' '); // eslint-disable-line prefer-template
			$editor.change();
		});
}
