/* global $ */

export default function ClassPicker(
	$dialogEdit,
	{ initCodeMirror, insertText },
) {
	let cm;
	$dialogEdit.dialog({
		open: () => {
			cm = initCodeMirror('#class_editor', {
				theme: 'default',
				lineWrapping: true,
				indentWithTabs: false,
				lineNumbers: false,
				allowFullScreen: false,
				actionBtnsSelector: '.sm-class-editor-button',
			});
		},
	});

	$dialogEdit
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
			insertText(cm, $(this).text());
		});
}
