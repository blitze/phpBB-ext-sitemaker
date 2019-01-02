/* global $ */
// @flow
import 'jquery-ui/ui/widgets/dialog';
import 'jquery-ui/themes/base/core.css';
import 'jquery-ui/themes/base/theme.css';
import 'jquery-ui/themes/base/dialog.css';

const defOptions = {
	autoOpen: false,
	modal: true,
	width: 'auto',
	show: 'slide',
	hide: 'slide',
};

/**
 * @export
 * @param {string} selector
 * @param {Object} [options={}]
 * @returns {jQuery}
 */
export default function Dialog(selector: string, options: Object = {}): jQuery {
	return $(selector).dialog({ ...defOptions, ...options });
}
