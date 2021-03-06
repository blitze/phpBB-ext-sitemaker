import 'jquery-ui/ui/widgets/tabs';
import 'jquery-ui/themes/base/core.css';
import 'jquery-ui/themes/base/theme.css';
import 'jquery-ui/themes/base/tabs.css';

import Dialog from '../../Dialog';
import ClassPicker from './ClassPicker';
import { getPOJO } from '../../../utils';
import BlockRenderer from '../../BlockRenderer';

import './style.scss';

const { actions, config, lang } = window;

export default function EditBlock($block, codemirror) {
	let $dialogEdit;
	let $document;
	const blockData = {
		block: {},
	};

	function getFormData() {
		return getPOJO($dialogEdit.find('#edit_form').serializeArray());
	}

	function previewBlock() {
		const formData = getFormData();

		const data = {
			...blockData,
			block: {
				...blockData.block,
				...formData,
			},
		};

		BlockRenderer.render($block, data);
	}

	function undoPreviewBlock() {
		BlockRenderer.render($block, blockData);
	}

	function saveForm() {
		const updateSimilar = $dialogEdit
			.dialog('widget')
			.find('#update-similar:checked').length;
		const data = {
			...getFormData(),
			route: config.route,
			similar: updateSimilar,
		};

		/**
		 * Event to allow other extensions to modify block data before it is saved
		 *
		 * @event blitze_sitemaker_save_block_before
		 * @type {object}
		 * @property {object} data Block data to be saved to db
		 * @since 3.1.2
		 */
		$document.trigger({ type: 'blitze_sitemaker_save_block_before', data });

		$.post(actions.save_block, data).done((resp) => {
			if (resp.list) {
				$dialogEdit.dialog('close');
				$.each(resp.list, (i, block) =>
					BlockRenderer.render($(`#block-${block.id}`), { block }),
				);
			}
		});
	}

	function getEditForm(id) {
		$.getJSON(actions.edit_block, { id }).done((row) => {
			blockData.block = row;
			if (row.form) {
				const title = row.title.replace(/(<([^>]+)>)/gi, '');

				$dialogEdit.dialog(
					'option',
					'title',
					`${lang.edit} - ${title}`,
				);

				$dialogEdit.html(row.form);
				$dialogEdit.find('#block-settings').tabs();
				$dialogEdit
					.find('.sm-toggler')
					.click((e) => {
						e.preventDefault();
						const target = $(e.currentTarget).data('target');
						$(target).slideToggle();
					})
					.each(function iterator() {
						$($(this).data('target')).hide();
					});
				$dialogEdit
					.find('select[data-togglable-settings]')
					.each(function iterator() {
						const $this = $(this);

						$this.change(() =>
							window.phpbb.toggleSelectSettings($this),
						);
						window.phpbb.toggleSelectSettings($this);
					});
				$dialogEdit.dialog('open');
			}
		});
	}

	function createContextualSelect() {
		$dialogEdit
			.find('select[data-togglable-settings]')
			.each(function iterator() {
				const $el = $(this);

				$el.change(() => window.phpbb.toggleSelectSettings($el));
				window.phpbb.toggleSelectSettings($el);
			});
	}

	function addBottomPane() {
		$(this).dialog('widget').find('.ui-dialog-buttonpane').prepend(
			`<label class="sm-reset dialog-check-button">
					<input id="update-similar" type="checkbox" /> ${lang.updateSimilar}
				</label>`,
		);
	}

	function getEditDialog() {
		return new Dialog('#dialog-edit', {
			create: addBottomPane,
			beforeClose: () => undoPreviewBlock(),
			buttons: {
				[lang.edit]: function editBtn() {
					saveForm();
				},

				[lang.cancel]: function cancelBtn() {
					$(this).dialog('close');
				},
			},
		});
	}

	$document = $(document);
	$dialogEdit = getEditDialog();

	$dialogEdit.on('dialogopen', function isFeedBlock() {
		if ($(this).find('.sm-multi-input-ui').length) {
			import(
				/* webpackChunkName: "blocks/multiInput/input" */ '../../MultiInputUI'
			).then(() => $('.sm-multi-input-ui').multiInputUI());
		}

		if ($(this).find('#sm-feed-template').length) {
			Promise.all([
				import(/* webpackChunkName: "twig/twig" */ 'twig'),
				import(
					/* webpackChunkName: "blocks/feeds/feeds" */ '../../Feeds'
				),
			]).then(([{ default: Twig }, { default: Feeds }]) =>
				Feeds($(this), Twig, codemirror),
			);
		}

		$(this)
			.find('.code-editor')
			.each((i, element) => {
				const $textarea = $(element);
				const id = $textarea.attr('id');
				if (!$textarea.next().hasClass('CodeMirror')) {
					const {
						width,
						height = 100,
						...options
					} = $textarea.data();
					const cm = codemirror.initCodeMirror(`#${id}`, {
						actionBtnsSelector: `.${id}-button`,
						...options,
					});
					cm.setSize(width, height);
				}
			});

		$dialogEdit
			.find('.sortable')
			.sortable({
				axis: 'y',
				containment: 'parent',
				classes: {
					'ui-sortable-handle': 'panel',
				},
			})
			.disableSelection();

		$dialogEdit
			.find('.block-preview')
			.off()
			.change(() => previewBlock());
	});

	const id = $block.attr('id').substring(6);

	getEditForm(id);
	createContextualSelect();
	ClassPicker($dialogEdit, codemirror);
}
