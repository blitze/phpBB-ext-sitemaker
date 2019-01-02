/* global $ */
// @flow
import 'jquery-ui/ui/widgets/button';
import 'jquery-ui/themes/base/core.css';
import 'jquery-ui/themes/base/theme.css';
import 'jquery-ui/themes/base/button.css';

/**
 * @export
 * @param {string} selector
 * @param {Object} [options={}]
 * @param {Function} [onClick=() => null]
 * @returns {Object}
 */
export default function Button(
	selector: string,
	options: Object = {},
	onClick: Function = () => null,
): Object {
	let $root;
	if (selector instanceof $) {
		$root = selector;
	} else {
		$root = $(selector);
	}

	$root.button(options).click(onClick);

	return $root;
}
