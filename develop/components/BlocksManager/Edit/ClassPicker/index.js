/* global $ */
import { initCodeMirror, insertText } from '../../../CodeMirror';

export default function ClassPicker($dialogEdit) {
	$dialogEdit.dialog({
		open: () => {
			initCodeMirror('#class_editor', {
				theme: 'default',
				lineWrapping: true,
				indentWithTabs: false,
				lineNumbers: false,
				allowFullScreen: false,
			});
		},
	});

	$dialogEdit
		.on('click', '.classes-toggler', e => {
			e.preventDefault();
			$('#css-class-options').slideToggle();
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
			insertText(`${$(this).text()} `);
		});
}
