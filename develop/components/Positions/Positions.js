// flow
import BlockRenderer from '../BlockRenderer';

const { actions, config } = window;

/**
 * @export
 * @class Positions
 */
export default class Positions {
	$blockPositions: jQuery;

	/**
	 *Creates an instance of Positions
	 * @memberof Positions
	 */
	constructor() {
		this.$blockPositions = $('.block-position').addClass('block-receiver');
	}

	/**
	 * @readonly
	 * @type {jQuery}
	 * @returns {jQuery}
	 * @memberof Positions
	 */
	get items(): jQuery {
		return this.$blockPositions;
	}

	/**
	 * @readonly
	 * @type {Array}
	 * @memberof Positions
	 */
	get ids(): Array {
		const positions = [];
		this.$blockPositions.each(function iterator() {
			positions.push(
				$(this)
					.attr('id')
					.substring(4),
			);
		});
		return positions;
	}

	/**
	 * @readonly
	 * @type {Object}
	 * @memberof Positions
	 */
	get blocks(): Object {
		let prevPosId;
		let weight = 0;

		const blocks = {};
		this.$blockPositions.find('.block').each(function iterator() {
			const blockId = $(this).attr('id');
			const positionId = $(this)
				.parent()
				.attr('id');

			if (positionId && blockId) {
				if (positionId !== prevPosId) {
					weight = 0;
				}

				const bid = blockId.substring(6);
				const position = positionId.substring(4);

				blocks[bid] = { position, weight };
				weight += 1;
			}
			prevPosId = positionId;
		});

		return blocks;
	}

	/**
	 * @readonly
	 * @type {Object}
	 * @memberof Positions
	 */
	get emptyPositions(): Object {
		return this.$blockPositions.filter(':not(:has(".block"))');
	}

	/**
	 * @param {jQuery} $block
	 * @param {jQuery} $position
	 * @param {string} blockName
	 * @memberof Positions
	 */
	addBlock($block: jQuery, $position: jQuery, blockName: string): void {
		const weight = $position.children('.block').index($block);

		const data = {
			block: $.trim(blockName),
			position: Positions.getPositionName($position),
			weight,
			route: config.route,
			ext: config.ext,
		};

		$.getJSON(actions.add_block, data, block => {
			if (block.id) {
				BlockRenderer.render($block, { block });

				$block
					.attr('id', `block-${block.id}`)
					.children()
					.not('.block-controls')
					.show('scale', { percent: 100 }, 1000);

				this.triggerChange($block, $position, true);
			} else {
				$block.remove();
			}
		});
	}

	/**
	 * @param {jQuery} $block
	 * @memberof Positions
	 */
	removeBlock($block: jQuery): void {
		const $position = $block.parent('.block-position');
		$block.remove();

		this.triggerChange($block, $position);
	}

	/**
	 * @static
	 * @param {jQuery} $column
	 * @returns {number}
	 * @memberof Positions
	 */
	static getColumnSize($column: jQuery): number {
		const [, size = 0] = $column.attr('class').match(/col-([0-9]+)/i) || [];
		return size;
	}

	/**
	 * @memberof Positions
	 */
	// eslint-disable-next-line class-methods-use-this
	adjustMiddleColumns(hiding: boolean): void {
		this.emptyPositions.filter('.sidebar').each((i, element) => {
			const $sidebar = $(element);

			// We begin by assuming the middle column has a max size of 12
			const $sibling = $sidebar.siblings();
			const siblingSize = Positions.getColumnSize($sibling) || 12;
			const sidebarSize = Positions.getColumnSize($sidebar);

			if (siblingSize && sidebarSize) {
				const newSize = hiding ? 12 : 12 - sidebarSize;
				const newClass = $sibling
					.attr('class')
					.replace(siblingSize, newSize);
				$sibling.attr('class', newClass);
			}
		});
	}

	/**
	 * @memberof Positions
	 */
	showAllPositions(): void {
		const $emptyPositions = this.emptyPositions
			.addClass('show-position')
			.removeClass('empty-position');
		$emptyPositions
			.filter('#pos-footer')
			.parent()
			.show();
		this.adjustMiddleColumns(false);

		/**
		 * Event to allow other extensions to do something when all block positions are shown
		 *
		 * @event blitze_sitemaker_show_all_block_positions
		 * @type {Object}
		 * @property {Object} $blockPositions - jQuery object representing all block positions
		 * @property {Object} $emptyPositions - jQuery object representing all block positions with no blocks
		 * @since 3.1.2
		 */
		this.$document.trigger({
			type: 'blitze_sitemaker_show_all_block_positions',
			$blockPositions: this.$blockPositions,
			$emptyPositions,
		});
	}

	/**
	 * @memberof Positions
	 */
	hideEmptyPositions(): void {
		const $emptyPositions = this.emptyPositions
			.addClass('empty-position')
			.removeClass('show-position');
		$emptyPositions
			.filter('#pos-footer')
			.parent()
			.hide();
		this.adjustMiddleColumns(true);

		/**
		 * Event to allow other extensions to do something when empty positions are hidden
		 *
		 * @event blitze_sitemaker_hide_empty_block_positions
		 * @type {Object}
		 * @property {Object} $blockPositions - jQuery object representing all block positions
		 * @property {Object} $emptyPositions - jQuery object representing all block positions with no blocks
		 * @since 3.1.2
		 */
		this.$document.trigger({
			type: 'blitze_sitemaker_hide_empty_block_positions',
			$blockPositions: this.$blockPositions,
			$emptyPositions,
		});
	}

	/**
	 * @param {boolean} [unsaved=true]
	 * @memberof Positions
	 */
	clearAll(unsaved: boolean = true): void {
		this.$blockPositions.empty();

		/**
		 * Event to allow other extensions to do something when layout is cleared
		 *
		 * @event blitze_sitemaker_layout_cleared
		 * @type {Object}
		 * @properties {boolean} unsaved - Indicates whether or not this results in unsaved changes
		 * @since 3.1.2
		 */
		this.$document.trigger({
			type: 'blitze_sitemaker_layout_cleared',
			unsaved,
		});
	}

	/**
	 * @static
	 * @param {jQuery} $position
	 * @returns {string}
	 * @memberof Positions
	 */
	static getPositionName($position: jQuery): string {
		return $position.attr('id').substring(4);
	}

	/**
	 * @param {jQuery} $position
	 * @memberof Positions
	 */
	// eslint-disable-next-line
	sortHorizontal($position: jQuery): void {
		if ($position.hasClass('horizontal')) {
			$position.find('.block').addClass('col');
		} else {
			$position.find('.block').removeClass('col');
		}
	}

	/**
	 * @param {jQuery} $block
	 * @param {jQuery} $position
	 * @param {boolean} [isNewBlock=false]
	 * @memberof Positions
	 */
	triggerChange(
		$block: jQuery,
		$position: jQuery,
		isNewBlock: boolean = false,
	) {
		this.hideEmptyPositions();

		const isChanged =
			isNewBlock || this.cachedBlocks !== JSON.stringify(this.blocks);

		const blocks = isChanged ? this.blocks : JSON.parse(this.cachedBlocks);

		if (isNewBlock) {
			this.cachedBlocks = JSON.stringify(blocks);
		}

		/**
		 * Event to allow other extensions to do something when layout is updated
		 *
		 * @event blitze_sitemaker_layout_updated
		 * @type {Object}
		 * @property {boolean} isChanged - Indicates whether or not the block positions/order have changed
		 * @property {boolean} isNewBlock - Indicates whether or not the block was newly added
		 * @property {Object} blocks - Object of block ids (keys) and their positions and order
		 * @property {Object} $block - jQuery object representing the block that was dropped
		 * @property {string} position - Name of block position that received the dropped block
		 * @since 3.1.2
		 */
		this.$document.trigger({
			type: 'blitze_sitemaker_layout_updated',
			isChanged,
			isNewBlock,
			blocks,
			$block,
			position: Positions.getPositionName($position),
		});

		this.sortHorizontal($position);
	}
}
