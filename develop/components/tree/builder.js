/*!
 * Sitemaker treeBuilder
 * Author: @blitze
 * Licensed under the GPL license
 */

/* global $ */
/* eslint-disable no-underscore-dangle */

import 'jquery-ui/ui/widget';
import 'jquery-ui/ui/widgets/sortable';
import 'jquery-ui/ui/effects/effect-slide';
import 'jquery.populate/jquery.populate';

import Twig, { twig } from 'twig';

import AddBtn from './Add';
import AddBulkBtn from './Bulk';
import EditItem from './Edit';
import DeleteItem from './Delete';
import TreeItems from './Items';
import RebuildBtn from './Rebuild';
import SaveBtn from './Save';
import DeleteSelected from './DeleteSelected';
import '../Icons/picker';

import './builder.scss';

const { lang } = window;

Twig.extendFunction(
	'lang',
	value => (typeof lang[value] !== 'undefined' ? lang[value] : value),
);

$.widget('sitemaker.treeBuilder', {
	options: {
		ajaxUrl: '',
		loadSpeed: 10,

		fields: {
			itemId: 'item_id',
			itemTitle: 'item_title',
			parentId: 'parent_id',
		},

		listType: 'ol',
		noNesting: '.no-nest',
		nestedList: '#sortable',
		editForm: '#edit-form',
		noItems: '#no-items',

		addBtn: '#add-new',
		addBulkBtn: '#add-bulk',
		addBulkList: '#add_list',
		saveBtn: '#save',
		deleteSelBtn: '#delete-selected',
		rebuildBtn: '#rebuild-tree',

		selectAll: '#select-all',
		loading: '#loading',
		ajaxMessage: '#ajax-message',
		itemTemplate: '#item-template',
		editItemClass: '.item-edit',
		deleteItemClass: '.item-delete',
		selectItemClass: '.select-item',
		iconSelectClass: '.icon-select',

		dialogEdit: '',
		dialogConfirm: '#dialog-confirm',

		loaded: () => {},
		updated: () => {},
	},

	_create() {
		this.nestedList = TreeItems(this);
		this.noItems = this.element.find(this.options.noItems);
		this.msgObj = this.element.find(this.options.ajaxMessage);
		this.editForm = $(this.options.editForm);

		twig({
			id: 'item_template',
			data: this.element.find(this.options.itemTemplate).html(),
		});

		const $editDialog = EditItem(this);

		AddBtn(this, $editDialog);
		AddBulkBtn(this);
		DeleteItem(this);

		this.$deleteSelBtn = DeleteSelected(this);
		this.$rebuildBtn = RebuildBtn(this);
		this.$saveBtn = SaveBtn(this);

		this.nestedList.iconPicker({
			selector: this.options.iconSelectClass,
			onSelect: ($item, iconClass) => {
				const itemID = this._getItemId($item.closest('li'));
				this.updateItem({ item_icon: iconClass }, itemID);
			},
		});
	},

	addItem() {
		this._saveItem('add_item', {});
	},

	updateItem(data, id) {
		this._saveItem('update_item', data, id);
	},

	getItems() {
		$.get(`${this.options.ajaxUrl}load_items`).done(data => {
			this.nestedList.empty();
			this._resetActions();
			if (data.items && data.items.length > 0) {
				this._showActions();
				this._addToTree(data.items);
			}
		});
	},

	getCodeMirrorInstance() {
		return this.codeMirror;
	},

	isUnsaved() {
		return !!this.itemsChanged;
	},

	showMessage(message) {
		if (message) {
			this.msgObj.text(message);
			this.msgObj
				.fadeIn()
				.delay(3000)
				.fadeOut();
		}
	},

	_addBulk(data) {
		$.post(`${this.options.ajaxUrl}add_bulk`, data).done(resp => {
			if (!resp.error) {
				this._showActions();
				this._addToTree(resp.items);
			}
		});
	},

	_addToTree(items, callback) {
		if (items.length > 0) {
			let $html = {};
			const item = items.shift();
			const { listType } = this.options;
			const { itemTitle, parentId } = this.options.fields;

			item[itemTitle] = item[itemTitle] || lang.changeMe;

			if (item[parentId] > 0) {
				const $parentItem = $(`#item-${item[parentId]}`);
				const $childItems = $parentItem.children(listType);

				if (!$childItems.length) {
					$html = $(
						`<${listType}>
							${this._renderItem(item)}
						</${listType}>`,
					).hide();
					$html.appendTo($parentItem);
				} else {
					$html = $(this._renderItem(item)).hide();
					$html.appendTo($parentItem.children(listType));
				}
			} else {
				$html = $(this._renderItem(item)).hide();
				$html.appendTo(this.nestedList);
			}

			$html.effect(
				'slide',
				{ direction: 'right', mode: 'show' },
				this.options.loadSpeed,
				() => this._addToTree(items, callback),
			);
		}

		if (callback !== undefined) {
			callback.apply(this, [items]);
		}
		this._trigger('loaded', null, { items });
	},

	_getItemId($element) {
		return $element.attr('id').substring(5);
	},

	_populateForm(id, callBack) {
		if (id) {
			const { ajaxUrl } = this.options;
			const { itemId } = this.options.fields;

			$.get(`${ajaxUrl}load_item?${itemId}=${id}`).done(data => {
				this.showMessage(data.message);
				this.editForm.populate(data);
				callBack();
			});
		} else {
			this.editForm.populate({});
		}
	},

	_resetActions(itemsCount) {
		let display = 'initial';

		if (!itemsCount) {
			this.noItems.show();
			display = 'none';
		}

		this.itemsChanged = false;
		this.$selectAll
			.prop('checked', false)
			.parent()
			.css('display', display);
		this.$deleteSelBtn.button('disable').css('display', display);
		this.$saveBtn.button('disable').css('display', display);
		this.$rebuildBtn.css('display', display);
	},

	_saveItem(mode, data, id) {
		const { ajaxUrl } = this.options;
		const { itemId } = this.options.fields;

		$.post(`${ajaxUrl}${mode}${id ? `?${itemId}=${id}` : ''}`, data).done(
			resp => {
				if (!resp.error) {
					if (mode === 'add_item') {
						this._addToTree([resp], () => {
							const $element = $(
								`#item-${resp[this.options.fields.itemId]}`,
							);

							this._showActions();
							this._scrollTo(
								$element,
								this.addBtnOffset.top,
								() => {
									if (!this.options.dialogEdit) {
										$element
											.find('.editable')
											.trigger('click');
									}
								},
							);
						});
					} else if (mode === 'update_item') {
						this._refreshItem(resp);
					} else if (mode === 'save_item') {
						const $element = this._refreshItem(resp);
						this._trigger('updated', null, $element);
					}
				}
			},
		);
	},

	_saveTree() {
		const tree = $(this.options.nestedList).find('li').length
			? this.nestedList.nestedSortable('toArray')
			: [];

		this._saveItem('save_tree', { tree });
		this._resetActions(tree.length);
	},

	_scrollTo($element, fromHeight, callback) {
		const offset = $element.offset();
		const offsetTop = offset.top;
		const scrollTop = offsetTop - fromHeight;

		this.nestedList.animate({ scrollTop }, 1000, callback);
	},

	_showActions() {
		this.noItems.hide();
		this.nestedList.show();
		this.$selectAll.parent().show();
		this.$deleteSelBtn.show();
		this.$saveBtn.show();
		this.$rebuildBtn.button('enable').show();
	},

	_removeNode($node) {
		const $parentNode = $node
			.parent(this.options.listType)
			.not(this.options.nestedList);

		// if node has sibblings, or it's parent is the root ol/ul, remove node and leave parent
		if ($node.siblings().length || !$parentNode.length) {
			$node.remove();
			// if node does not have sibblings, remove parent ol/ul
		} else {
			$parentNode.remove();
		}
	},

	_renderItem(data) {
		return twig({ ref: 'item_template' }).render(data);
	},

	_refreshItem(data) {
		const replacement = $(this._renderItem(data)).children();
		return $(`#item-${data[this.options.fields.itemId]}`)
			.children(':first')
			.replaceWith(replacement);
	},
});
