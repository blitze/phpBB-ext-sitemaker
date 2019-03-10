/* global $ */

import './style.scss';

export default function MultiInputUI(sortable = true) {
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
			.closest('.sm-multi-input-item');
		const numSiblings = $row.siblings().length;
		if (numSiblings) {
			$row.remove();
		} else {
			$row.children('input').val('');
		}
	}

	function init() {
		if (sortable) {
			$('.sm-multi-input').sortable({
				axis: 'y',
				containment: 'parent',
			});
		}
	}

	$('#dialog-edit')
		.on('click', '.sm-multi-input-add', addRow)
		.on('click', '.sm-multi-input-delete', deleteRow)
		.on('dialogopen', init);
}
