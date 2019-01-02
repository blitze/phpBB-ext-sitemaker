/* global $ */

import Button from '../../../Button/button';

const {
	actions,
	lang,
	config: { route },
} = window;

export default function DefaultLayoutManager() {
	const $layoutToggler = $('#default-layout-toggler');
	let isDefaultLayout = $layoutToggler.data('is-default-layout');

	const getLabel = () =>
		!isDefaultLayout ? lang.makeDefaultLayout : lang.removeDefaultLayout;

	Button($layoutToggler, {}, e => {
		e.preventDefault();

		const data = {
			route: !isDefaultLayout ? route : '',
		};

		$.post(actions.set_default_route, data, ({ message }) => {
			if (message) {
				return;
			}

			isDefaultLayout = !isDefaultLayout;

			$layoutToggler
				.html(getLabel())
				// hide the view default page link
				.parent()
				.next()
				.hide();
		});
	});
}
