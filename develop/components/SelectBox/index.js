import OutsideClick from '../OutsideClick';
import './style.scss';

export default function SelectBox({ selector, $appendTo = 'body' }) {
	const $original = $(selector);
	const selectedVal = $original.val();
	const selectedTxt = $original.find('option:selected').text();
	const items = $original
		.find('option')
		.map((i, el) => {
			const value = $(el).val();
			const text = $(el).text();
			const classAttr = selectedVal === value ? ' class="selected"' : '';
			return `<a href="#" data-value="${value}"${classAttr}>${text}</a>`;
		})
		.get()
		.join('');

	const $dropdown = $(`<div class="inputbox-dropdown">${items}</div>`);
	const $container = $('<div>').css('position', 'relative');
	const $trigger = $(`<div class="sm-inputbox">${selectedTxt}</div>`);

	$container.append($trigger).append($dropdown);
	$original.hide().after($container);

	$trigger.on('click', function clickHandler() {
		let { top, left } = $(this).offset();
		if ($appendTo !== 'body') {
			const offset = $appendTo.offset();
			top -= offset.top;
			left -= offset.left;
		}

		$dropdown
			.css({
				top: top + $(this).outerHeight() + 2,
				left,
			})
			.toggle();
	});

	$dropdown
		.on('click', 'a', function handleClick(e) {
			e.preventDefault();
			const { value } = $(this).data();
			const text = $(this).text();
			$original.val(value);
			$trigger.text(text);
			$dropdown.hide();
		})
		.appendTo($appendTo);

	OutsideClick($dropdown, () => $dropdown.hide());

	return { $container, $trigger, $dropdown };
}
