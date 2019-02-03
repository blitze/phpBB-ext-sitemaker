// @flow
/* global $ */
import 'jquery-ui/ui/widgets/sortable';
import 'jquery-ui-touch-punch';

import 'jquery-ui/themes/base/core.css';
import 'jquery-ui/themes/base/theme.css';
import 'jquery-ui/themes/base/sortable.css';

import Positions from './Positions';
import SidebarWidth from '../SidebarWidth';

const { lang } = window;

/**
 * @export
 * @class SortableBlocks
 * @extends {Positions}
 */
export default class SortableBlocks extends Positions {
	$srcPosHorizontal: jQuery;

	$overPosHorizontal: jQuery;

	cachedBlocks: string;

	/**
	 *Creates an instance of SortableBlocks.
	 * @memberof SortableBlocks
	 */
	constructor() {
		super();
		this.$document = $(document)
			.on('blitze_sitemaker_layout_saved', ({ blocks }) => {
				this.cachedBlocks = JSON.stringify(blocks);
			})
			.on('blitze_sitemaker_force_position_update', () =>
				this.initPositions(),
			);

		this.initPositions();
		SidebarWidth(Positions.getPositionName);
	}

	/**
	 * @memberof SortableBlocks
	 */
	initPositions(): void {
		this.cachedBlocks = JSON.stringify(this.blocks);

		this.initSortable();
		this.hideEmptyPositions();
	}

	/**
	 * @memberof SortableBlocks
	 */
	initSortable(): void {
		this.$blockPositions.sortable({
			dropOnEmpty: true,
			placeholder:
				'ui-state-highlight sm-block-spacing block sortable placeholder',
			connectWith: '.block-position',
			cancel: '.editable-block, .inline-edit, .not-sortable',
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
			$block.removeClass('dragging').removeAttr('style');

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

	/**
	 * @memberof SortableBlocks
	 */
	refresh(): void {
		this.$blockPositions.sortable('refresh');
	}
}
