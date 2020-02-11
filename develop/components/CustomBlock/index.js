// @flow
import { fixPaths, inactiveBlockClass } from '../../utils';

const { actions, config, lang, tinymce } = window;

export default function CustomBlock() {
	const placeholder = `<p>${lang.placeholder}</p>`;

	function customBlockAction(data) {
		if (data.id) {
			$.post(actions.handle_custom_action, data).done(resp => {
				if (resp.id) {
					const id = `block-editor-${resp.id}`;
					const rawHTML = fixPaths(resp.content);
					const $blockContainer = $(
						`#block-${resp.id} > .sm-block-container`,
					);
					const editor = $(`#${id}`).attr('data-raw', rawHTML);

					tinymce.get(id).setContent(rawHTML || placeholder);

					if (!resp.content || !editor.data('active')) {
						$blockContainer.addClass(inactiveBlockClass);
					} else {
						$blockContainer.removeClass(inactiveBlockClass);
					}
				}
			});
		}
	}

	function initTinyMCE() {
		const { scriptPath, webRootPath } = config;

		let options = {
			selector: 'div.editable-block',
			menubar: false,
			inline: true,
			hidden_input: false,
			plugins: [
				'paste searchreplace autolink directionality code visualblocks image link media codesample table charmap hr anchor advlist lists imagetools textpattern noneditable charmap quickbars emoticons',
			],
			// toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | responsivefilemanager image media link anchor codesample | ltr rtl | code',
			toolbar: false,
			image_advtab: true,
			image_caption: true,
			quickbars_insert_toolbar:
				'responsivefilemanager image media codesample hr quicktable code',
			quickbars_selection_toolbar:
				'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | responsivefilemanager image media link charmap emoticons codesample code',
			noneditable_noneditable_class: 'mceNonEditable',
			contextmenu: 'inserttable | cell row column deletetable | code',
			powerpaste_word_import: 'clean',
			powerpaste_html_import: 'clean',
			automatic_uploads: true,
			images_reuse_filename: true,
			images_upload_base_path: `${webRootPath}images/sitemaker_uploads/source/`,
			images_upload_url: config.uploadUrl,
			valid_elements: '*[*]',
			end_container_on_empty_block: true,
			relative_urls: true,
			document_base_url: `${config.boardUrl}/`,
			setup: editor => {
				let $blockContainer;
				let blockIsInactive = true;
				let blockRawHTML = '';

				editor.on('init', () => {
					if (editor.getContent().length === 0) {
						editor.setContent(placeholder);
					}
				});

				editor.on('focus', () => {
					const blockId = editor.id.substring(13);
					$blockContainer = $(
						`#block-${blockId} > .sm-block-container`,
					);
					blockIsInactive = $blockContainer.hasClass(
						inactiveBlockClass,
					);
					blockRawHTML = $(`#${editor.id}`).data('raw');
					editor.setContent(blockRawHTML);
				});

				editor.on('keyUp', () => {
					if (blockIsInactive && editor.getContent().length) {
						blockIsInactive = false;
						$blockContainer.removeClass(inactiveBlockClass);
					} else if (
						!blockIsInactive &&
						!editor.getContent().length
					) {
						blockIsInactive = true;
						$blockContainer.addClass(inactiveBlockClass);
					}
				});

				editor.on('blur', () => {
					tinymce.activeEditor.uploadImages(() => {
						let rawEditorContent = editor
							.getContent({ format: 'raw' })
							.replace('<p><br data-mce-bogus="1"></p>', '');
						const editorContent = editor.getContent();

						if (
							rawEditorContent !== blockRawHTML &&
							rawEditorContent !== placeholder
						) {
							if (!editorContent.length) {
								rawEditorContent = '';
								editor.setContent(placeholder);
							}

							const blockData = $(`#${editor.id}`)
								.data('raw', rawEditorContent)
								.data();
							blockData.id = editor.id.substring(13);
							blockData.content = rawEditorContent;

							customBlockAction(blockData);
						} else if (!editorContent) {
							editor.setContent(placeholder);
						}
					});
				});
			},
		};

		if (config.tinymceLang && config.tinymceLang !== 'en') {
			const { tinymceLang, directionality } = config;
			options.language = tinymceLang;
			options.directionality = directionality;
			options.language_url = `https://olli-suutari.github.io/tinyMCE-4-translations/${tinymceLang}.js`;
		}

		if (config.filemanager) {
			options.plugins.push('responsivefilemanager');

			const rfmPath = `${scriptPath}ResponsiveFilemanager/filemanager/`;
			const filemanagerOptions = {
				filemanager_access_key: config.RFAccessKey,
				filemanager_title: lang.fileManager,
				external_filemanager_path: rfmPath,
				external_plugins: {
					filemanager: `${rfmPath}plugin.min.js`,
				},
			};
			options = { ...options, ...filemanagerOptions };
		}
		tinymce.init(options);
	}

	initTinyMCE();

	$(document)
		.on('blitze_sitemaker_render_block_after', ({ block, $block }) => {
			// if custom block, add editor
			if (block.name === 'blitze.sitemaker.block.custom') {
				const editorId = `block-editor-${block.id}`;

				// if tinymce editor instance already exists, remove it
				if (tinymce.get(editorId)) {
					tinymce.EditorManager.execCommand(
						'mceFocus',
						false,
						editorId,
					);
					tinymce.EditorManager.execCommand(
						'mceRemoveEditor',
						true,
						editorId,
					);
				}

				if ($block.find(`#${editorId}`).length) {
					tinymce.EditorManager.execCommand(
						'mceAddEditor',
						false,
						editorId,
					);
				} else if (block.content.indexOf('script') > -1) {
					eval($block.find('.sm-block-content').html()); // eslint-disable-line no-eval
				}
			}
		})
		.on('click', '.editable-block', function handleClick() {
			const editorId = $(this).attr('id');
			if (!tinymce.get(editorId)) {
				tinymce.EditorManager.execCommand(
					'mceAddEditor',
					false,
					editorId,
				);
				$(this).blur();
				setTimeout(() => {
					tinymce.get(editorId).focus();
				}, 300);
			}
		});
}
