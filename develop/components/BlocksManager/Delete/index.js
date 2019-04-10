/* global $ */
import Dialog from '../../Dialog';

const { lang } = window;

export default function deleteBlock(positions, $block) {
	const confirm = new Dialog('#dialog-confirm', {
		buttons: {
			[lang.remove]: function deleteBtn() {
				$(this).dialog('close');

				positions.removeBlock($block);
			},

			[lang.cancel]: function cancelBtn() {
				$(this).dialog('close');
			},
		},
	});

	confirm.dialog('open');
}
