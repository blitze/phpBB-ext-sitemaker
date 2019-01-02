/* global $ */
import Button from '../Button/button';
import OutsideClick from '../OutsideClick';

export default function BtnGrpDrop(selector, dir = 'down', onShow = undefined) {
	const $dropBtn = Button(
		selector,
		{
			text: false,
			icons: {
				primary: 'ui-icon-triangle-1-s',
			},
		},
		e => {
			e.preventDefault();

			const $button = $(e.currentTarget);

			$button
				.closest('.bulk-dropdown')
				.find(selector)
				.not($button)
				.filter('.dropped')
				.each((i, el) => {
					$(el)
						.removeClass('dropped')
						.parent()
						.next()
						.hide();
				});

			$button.toggleClass('dropped').blur();
			const $dropdown = $button.parent().next();

			const width = $dropdown.width();
			const height = $dropdown.height();
			const pos = $button.offset();

			let offset;
			if (dir === 'down') {
				offset = {
					top: pos.top + $button.height() + 10,
					left: pos.left - width / 2 + $button.width(),
				};
			} else {
				offset = {
					top: pos.top - height,
					left: pos.left - width / 2 - $button.width(),
				};
			}

			$dropdown.slideToggle().offset(offset);

			if (typeof onShow === 'function' && $button.hasClass('dropped')) {
				onShow();
			}
		},
	);

	const $dropdownDiv = $dropBtn
		.parent()
		.buttonset()
		.next();

	OutsideClick($dropdownDiv, () => {
		$dropBtn.removeClass('dropped');
		$dropdownDiv.slideUp();
	});

	return $dropBtn;
}
