/* global $ */
import 'nestedSortable/jquery.ui.nestedSortable';

export default function TreeItems(tree) {
	const { nestedList, noNesting, listType, ajaxMessage } = tree.options;

	return tree.element
		.addClass('tree-builder')
		.find(nestedList)
		.nestedSortable({
			disableNesting: noNesting,
			forcePlaceholderSize: true,
			listType,
			handle: 'div',
			helper: 'clone',
			items: 'li',
			opacity: 0.6,
			placeholder: 'placeholder',
			tabSize: 25,
			tolerance: 'pointer',
			toleranceElement: '> div',
			errorClass: ajaxMessage,
			update: () => {
				tree.itemsChanged = true;
				if (tree.$saveBtn.button('option', 'disabled')) {
					tree.$saveBtn.button('option', 'disabled', false);
				}
			},
		});
}
