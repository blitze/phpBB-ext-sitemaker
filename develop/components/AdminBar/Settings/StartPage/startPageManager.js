/* global $ */
import Button from '../../../Button/button';

const { actions, lang } = window;

export default function StartPageManager() {
	const $startPageToggler = $('#startpage-toggler');
	const data = $startPageToggler.data();
	const { controller, method, params } = data;
	let { startPageExists, isStartPage } = data;

	const getLabel = () =>
		(!isStartPage && controller) || !(controller || startPageExists)
			? lang.setStartPage
			: lang.removeStartPage;

	const label = getLabel();
	const options = { disabled: !(controller || startPageExists) };

	$startPageToggler.html(label);

	const $btn = Button($startPageToggler, options, e => {
		e.preventDefault();

		let info = {};
		if (!isStartPage && controller) {
			info = { controller, method, params };
		}

		$.post(actions.set_startpage, $.param(info), ({ message }) => {
			if (message) {
				return;
			}

			if (!info.controller) {
				isStartPage = false;
				startPageExists = false;
			} else {
				isStartPage = true;
				startPageExists = true;
			}

			if (!controller) {
				$btn.button('disable');
			}

			$startPageToggler.html(getLabel());
		});
	});
}
