/* global $ */
// @flow
import './style.scss';
/**
 * @export
 * @param {string} selector	trigger selector
 * @param {Function} onChange
 * @param {Function} onClick
 */
export default function InlineEditor(
	selector: string,
	changeHandler: Function,
	getEditableElement: Function = undefined,
): void {
	let $body;
	let $inlineForm;
	let editing = false;
	let editorVal = '';

	/**
	 * @function
	 * @param {jQuery} $element
	 */
	function makeEditable($element: jQuery): void {
		if (editing === true) {
			$inlineForm.children(':input').trigger('blur');
		} else {
			editing = true;
			editorVal = $element.removeClass('editable').text();
			$inlineForm
				.css('display', 'inline-block')
				.appendTo($element.text(''))
				.children(':input')
				.val(editorVal)
				.focus()
				.select();
		}
	}

	/**
	 * @function
	 * @param {string} value
	 */
	function undoEditable(value: string): void {
		const $element = $inlineForm.parent();

		editing = false;
		editorVal = '';
		$element.addClass('editable').text(value);
		$inlineForm.hide().appendTo($body);
	}

	const id = selector.replace(/^[.#]/, '');
	const formSelector = `${id}-inline-form`;
	const inputSelector = `${id}-inline-edit`;

	$inlineForm = $(
		`<form id="${formSelector}">
			<input type="text" id="${inputSelector}" class="inline-editable" value="" />
		</form>`,
	);

	$inlineForm.hide().appendTo($body);

	if (!getEditableElement) {
		$(selector).addClass('editable');
	}

	$body = $('body')
		.on('click', selector, e => {
			e.stopPropagation();
			makeEditable(
				getEditableElement ? getEditableElement(e) : $(e.currentTarget),
			);
		})
		.on('submit', `#${formSelector}`, e => {
			e.preventDefault();
			$(e.currentTarget)
				.find(`#${inputSelector}`)
				.trigger('blur');
		})
		.on('focusout', `#${inputSelector}`, e => {
			if (e.currentTarget.value !== editorVal) {
				editorVal = changeHandler(e);
			}

			undoEditable(editorVal);
		});
}
