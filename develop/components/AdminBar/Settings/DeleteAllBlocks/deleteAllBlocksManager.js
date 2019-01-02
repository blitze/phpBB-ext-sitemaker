/* global $ */
import Dialog from '../../../Dialog';
import Button from '../../../Button/button';

const { lang } = window;

export default function DeleteAllBlocksManager(positions) {
	const confirm = new Dialog('#dialog-delete-all', {
		buttons: {
			[lang.deleteAll]: function confirmBtn() {
				$(this).dialog('close');
				positions.clearAll();
				positions.hideEmptyPositions();
			},

			[lang.cancel]: function cancelBtn() {
				$(this).dialog('close');
			},
		},
	});

	Button('#delete-blocks', {}, e => {
		e.preventDefault();
		confirm.dialog('open');
	});
}
