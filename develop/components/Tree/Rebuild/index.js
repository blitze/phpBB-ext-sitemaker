/* eslint-disable no-underscore-dangle */
import Button from '../../Button/button';

export default function RebuildBtn(tree) {
	return Button(
		tree.options.rebuildBtn,
		{
			disabled: true,
			icons: {
				primary: 'ui-icon-refresh',
			},
		},
		e => {
			e.preventDefault();
			tree._saveTree();
		},
	);
}
