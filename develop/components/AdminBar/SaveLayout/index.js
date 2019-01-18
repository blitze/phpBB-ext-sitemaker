/* global $ */
import Button from '../../Button/button';

const {
	actions,
	config: { route },
	lang,
} = window;

export default function SaveLayout() {
	let blocks = {};
	let layoutChanged = false;

	const $document = $(document);

	const $saveBtn = Button('#save-changes', { disabled: true }, e => {
		e.preventDefault();

		$.post(actions.save_blocks, { route, blocks }, () => {
			$saveBtn.button('disable');
			layoutChanged = false;

			/**
			 * Event to allow other extensions to do something when layout changes are saved
			 *
			 * @event blitze_sitemaker_layout_saved
			 * @type {object}
			 * @property {object} blocks - Object of block ids (keys) and their positions and order
			 * @property {string} route - URL of the current page
			 * @since 3.1.2
			 */
			$document.trigger({
				type: 'blitze_sitemaker_layout_saved',
				blocks,
				route,
			});

			blocks = {};
		});
	});

	$document
		.on('blitze_sitemaker_layout_cleared', ({ unsaved }) => {
			blocks = {};
			layoutChanged = unsaved;

			if (layoutChanged) {
				$saveBtn.button('enable');
			}
		})
		.on(
			'blitze_sitemaker_layout_updated',
			({ isChanged, isNewBlock, blocks: blockPos }) => {
				layoutChanged = isChanged && !isNewBlock;
				blocks = blockPos;

				if (layoutChanged) {
					$saveBtn.button('enable');
				} else {
					$saveBtn.button('disable');
				}
			},
		);

	// eslint-disable-next-line
	window.onbeforeunload = e => {
		if (layoutChanged === true) {
			e = e || window.event;
			// For IE and Firefox
			if (e) {
				e.returnValue = lang.leaveConfirm;
			}
			// For Safari
			return lang.leaveConfirm;
		}
	};
}
