/* global $ */
const { lang, tinymce } = window;

export default function ClassPicker($dialogEdit) {
	function getCleanInput(editor) {
		return editor
			.getContent()
			.replace(/(<br \/>|&nbsp;|\s+)/gm, ' ')
			.trim();
	}

	const selector = '#class_editor';
	let classEditor;

	$dialogEdit.dialog({
		open: () => {
			const currentSettings = tinymce.settings;
			tinymce.init({
				selector,
				menubar: false,
				statusbar: false,
				hidden_input: false,
				forced_root_block: false,
				toolbar: 'undo redo clear',
				invalid_elements: '*[*]',
				toolbar_items_size: 'small',
				width: '99%',
				setup: editor => {
					const $hiddenInput = $('#sm-classes');
					const updateHiddenInput = txt =>
						$hiddenInput.val(` ${txt}`).change();

					classEditor = editor;
					editor.addButton('clear', {
						text: lang.clear,
						icon: false,
						onclick: () => {
							editor.setContent('');
							updateHiddenInput('');
						},
					});

					editor.on('init', () => {
						$('#class_editor_ifr').css('height', 50);
						tinymce.settings = currentSettings;
					});

					editor.on('keyUp change undo redo paste', () => {
						updateHiddenInput(getCleanInput(editor));
					});

					editor.on('blur', () => {
						editor.setContent(getCleanInput(editor));
					});
				},
			});
		},
		close: () => {
			tinymce.remove(selector);
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
			classEditor.selection.select(classEditor.getBody(), true);
			classEditor.selection.collapse(false);
			classEditor.execCommand(
				'mceInsertContent',
				false,
				` ${$(this).text()} `,
			);
		});
}
