import Dialog from '../../Dialog';

const { config, lang } = window;

export default function DeleteGroup($groups, actions, initTree) {
	let $currentGroup;

	const deleteGroup = () => {
		$.post(`${config.ajaxUrl}${actions.remove}`).done(() => {
			if ($currentGroup.siblings('.group-item').length) {
				const $selected = $currentGroup.prev('.group-item').length
					? $currentGroup.prev()
					: $currentGroup.next();
				$selected.trigger('click');
			} else {
				initTree(0);
			}

			$currentGroup.remove();
		});
	};

	const confirm = new Dialog('#dialog-confirm-delete-group', {
		buttons: {
			[lang.remove]: function deleteBtn() {
				$(this).dialog('close');
				deleteGroup();
			},

			[lang.cancel]: function cancelBtn() {
				$(this).dialog('close');
			},
		},
	});

	$groups.on('click', '.group-delete', e => {
		e.preventDefault();
		confirm.dialog('open');

		$currentGroup = $(e.currentTarget).closest('.group-item');
	});
}
