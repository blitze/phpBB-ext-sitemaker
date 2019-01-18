/* global $ */
export default function ClassPicker($dialogEdit) {
	$dialogEdit
		.on('click', '.block-class-actions', function classActions(e) {
			e.preventDefault();
			e.stopImmediatePropagation();

			const editor = $dialogEdit.find('#block_class');
			const action = $(this).data('action');

			const run = {
				toggle: function toggle() {
					const target = $(e.currentTarget).attr('href');
					$dialogEdit.find(target).slideToggle();
				},
				redo: function redo() {
					editor.focus();
					document.execCommand(action, false, null);
					editor.change();
				},
				undo: function unto() {
					run.redo();
				},
				clear: function clear() {
					editor.text('').change();
				},
			};
			run[action]();
		})
		.on('click', '.class-cat', function category(e) {
			const id = $(this).attr('href');
			const $scroller = $('#classes-scroller');
			$scroller.animate(
				{
					scrollTop: $scroller.scrollTop() + $(id).position().top,
				},
				1000,
			);
			e.preventDefault();
		})
		.on('click', '.transform', function insertClass(e) {
			e.preventDefault();

			const editor = $dialogEdit.find('#block_class');

			editor.focus();
			document.execCommand('insertText', false, $(this).text() + ' '); // eslint-disable-line prefer-template
			editor.change();
		});
}
