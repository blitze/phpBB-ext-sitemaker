/* global $ */
/* eslint-disable no-underscore-dangle */
import Button from '../../Button/button';

const { lang } = window;

export default function SaveBtn(tree) {
	/* eslint-disable consistent-return */
	window.onbeforeunload = e => {
		if (tree.itemsChanged) {
			e = e || window.event;
			// For IE and Firefox
			if (e) {
				e.returnValue = lang.unsavedChanges;
			}
			// For Safari
			return lang.unsavedChanges;
		}
	};

	return Button(
		tree.options.saveBtn,
		{
			disabled: true,
			icons: {
				primary: 'ui-icon-check',
			},
		},
		e => {
			e.preventDefault();
			if (tree.itemsChanged) {
				tree._saveTree();
			}
		},
	);
}
