/* global $ */
export default function OutsideClick($element, handleOutsideClick) {
	$(document.body).click(e => {
		if (
			$element.is(':visible') &&
			$element.html().indexOf(e.target.innerHTML) < 0
		) {
			handleOutsideClick();
		}
	});
}
