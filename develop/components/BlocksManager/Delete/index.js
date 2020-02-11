import Dialog from '../../Dialog';

const { lang } = window;

export default function deleteBlock(positions, $block) {
	Dialog('#dialog-confirm', {
		autoOpen: true,
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
}
