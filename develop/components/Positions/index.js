// @flow
/* global $ */
import 'jquery-ui/ui/widgets/sortable';
import 'jquery-ui-touch-punch';

import 'jquery-ui/themes/base/core.css';
import 'jquery-ui/themes/base/theme.css';
import 'jquery-ui/themes/base/sortable.css';

import Positions from './Positions';

const { lang } = window;

/**
 * @export
 * @class SortableBlocks
 * @extends {Positions}
 */
export default class SortableBlocks extends Positions {
	$srcPosHorizontal: jQuery;

	$overPosHorizontal: jQuery;

	constructor() {
		super();

		this.$blockPositions.sortable({
			revert: true,
			placeholder:
				'ui-state-highlight sm-block-spacing block sortable placeholder',
			connectWith: '.block-position',
			cancel: '.editable-block, .inline-edit',
			items: '.block',
			tolerance: 'pointer',
			cursor: 'move',
			cursorAt: {
				top: -10,
				left: -10,
			},
			start: this.sortableStart,
			over: this.sortableOver,
			out: this.sortableOut,
			stop: this.sortableStop,
		});
	}

	/**
	 * @param {Event} e
	 * @param {Object} ui
	 * @memberof SortableBlocks
	 */
	sortableStart = (e: Event, ui: Object): void => {
		this.$srcPosHorizontal = $(ui.item)
			.addClass('dragging')
			.parent('.horizontal');
		this.showAllPositions();
		this.$blockPositions.sortable('refresh');
	};

	/**
	 * @param {Event} e
	 * @param {Object} ui
	 * @memberof SortableBlocks
	 */
	sortableOver = (e: Event, ui: Object): void => {
		this.$overPosHorizontal = $(ui.placeholder)
			.parent('.horizontal')
			.children('.block')
			.addClass('sortable');
	};

	/**
	 * @memberof SortableBlocks
	 */
	sortableOut = (): void => {
		if ($.isEmptyObject(this.$overPosHorizontal) === false) {
			this.$overPosHorizontal.removeClass('sortable');
		}
	};

	/**
	 * @param {Event} e
	 * @param {Object} ui
	 * @memberof SortableBlocks
	 */
	sortableStop = (e: Event, ui: Object): void => {
		const $block: jQuery = $(ui.item);
		const $position: jQuery = $block.parent('.block-position');

		if ($block.attr('id')) {
			$block
				.removeClass('dragging')
				.removeAttr('style')
				.parent()
				.removeClass('empty-position');

			this.triggerChange($block, $position);
		} else {
			const blockName = $block.attr('data-block');
			$block
				.removeAttr('role aria-disabled data-block class style')
				.addClass('block')
				.html(
					`<div class="ui-state-highlight sm-block-spacing sortable" style="padding: 5px">
						<i class="fa fa-spinner fa-2x fa-spin"></i> ${lang.ajaxLoading}
					</div>`,
				);

			this.addBlock($block, $position, blockName);
		}
	};
}
