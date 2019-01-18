/* global $ */
import { twig } from 'twig';
import { fixPaths } from '../../utils';

function BlockRenderer() {
	const $document = $(document);
	const template = twig({
		data: $.trim($('#block-template-container').html()),
	});

	return {
		render($block, tplData) {
			const { block } = tplData;

			/**
			 * Event to allow other extensions to do something before block is rendered or prevent it from being re-rendered
			 * Setting $(this).data('renderBlock', false) in the listener will prevent a render here
			 *
			 * @event blitze_sitemaker_render_block_before
			 * @type {object}
			 * @property {object} block - Block data to display (id, name, icon, etc)
			 * @property {object} $block - Jquery object representing the block element being rendered
			 * @since 3.1.2
			 */
			if (
				$document
					.trigger({
						type: 'blitze_sitemaker_render_block_before',
						block,
						$block,
					})
					.data('renderBlock') !== false
			) {
				tplData.block.content = fixPaths(block.content);

				$block.html(template.render(tplData));

				/**
				 * Event to allow other extensions to do something after block is rendered
				 *
				 * @event blitze_sitemaker_render_block_after
				 * @type {object}
				 * @property {object} block - Block data to display (id, name, icon, etc)
				 * @property {object} $block - Jquery object representing the block element being rendered
				 * @since 3.1.2
				 */
				$document.trigger({
					type: 'blitze_sitemaker_render_block_after',
					block,
					$block,
				});
			}
		},
	};
}

export default new BlockRenderer();
