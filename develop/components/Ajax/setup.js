/* global $ */
const { lang } = window;

export default function Ajaxer($loader, showMessage, append = '') {
	$.ajaxSetup({
		// add style and session ids to ajax requests
		beforeSend: (xhr, settings) => {
			$loader.addClass('fa-spinner fa-green fa-spin fa-lg fa-pulse');

			if (append) {
				const delim = settings.url.indexOf('?') < 0 ? '?' : '&';
				settings.url += `${delim}${append}`;
			}
		},
		complete: ({ responseJSON }) => {
			$loader
				.delay(2000)
				.removeClass('fa-spinner fa-green fa-spin fa-lg fa-pulse');

			// Display any returned message
			if (responseJSON.message || responseJSON.MESSAGE_TEXT) {
				showMessage(responseJSON.message || responseJSON.MESSAGE_TEXT);
			}
		},
		error: event => {
			showMessage(
				event.responseJSON && event.responseJSON.message
					? event.responseJSON.message
					: lang.ajaxError,
			);
		},
		dataType: 'json',
	});
}
