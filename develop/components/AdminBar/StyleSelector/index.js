/* global $ */

export default function StyleSelector() {
	const $styleSelector = $('#style-options');

	if ($styleSelector.find('option').length > 1) {
		$styleSelector.show();
	}
}
