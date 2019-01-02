/* global $ */
import { twig } from 'twig';
import { fixPaths } from '../../utils';

function BlockRenderer() {
	const $document = $(document);
	const template = twig({
		data: $.trim($('#block-template-container').html()),
	});

	return {
		render($block, data) {
			/**
			 * Event to allow other extensions to manange how block is rendered
			 * setting $(this).data('renderBlock', false) in the listener will prevent a render here
			 *
			 * @event blitze_sitemaker_render_block_before
			 * @type {object}
			 * @property {object} data - Block data to display (id, name, icon, etc)
			 * @property {object} $block - Jquery object representing the block element being rendered
			 */
			if (
				$document
					.trigger('blitze_sitemaker_render_block_before', [
						{ data, $block },
					])
					.data('renderBlock') !== false
			) {
				data.block.content = fixPaths(data.block.content);

				$block.html(template.render(data));

				/**
				 * Event to allow other extensions to do something after block is rendered
				 *
				 * @event blitze_sitemaker_render_block_after
				 * @type {object}
				 * @property {object} data - Block data to display (id, name, icon, etc)
				 * @property {object} $block - Jquery object representing the block element being rendered
				 * @since 3.1.2
				 */
				$document.trigger('blitze_sitemaker_render_block_after', [
					{ data, $block },
				]);
			}
		},
	};
}

export default new BlockRenderer();
