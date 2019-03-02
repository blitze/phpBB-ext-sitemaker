/* global $ */

import './style.scss';

export default function ScriptsUI() {
	function scrollTo($element, $container) {
		const scrollTop = $element.offset().top;
		$container.stop().animate({ scrollTop }, 300);
	}

	function addRow(e) {
		e.preventDefault();
		const $container = $(this)
			.blur()
			.prev();
		const $clone = $container
			.children()
			.eq(0)
			.clone()
			.find('input')
			.val('')
			.end();
		$container.append($clone);
		scrollTo($clone, $container);
	}

	function deleteRow(e) {
		e.preventDefault();
		const $row = $(this)
			.blur()
			.closest('.sm-cb-script');
		const numSiblings = $row.siblings().length;
		if (numSiblings) {
			$row.remove();
		} else {
			$row.children('input').val('');
		}
	}

	function open() {
		$('.sm-cb-scripts-container').sortable({
			axis: 'y',
			containment: 'parent',
		});
	}

	$('#dialog-edit')
		.on('click', '.sm-cb-add-script', addRow)
		.on('click', '.sm-cb-delete', deleteRow)
		.dialog({ open });
}
