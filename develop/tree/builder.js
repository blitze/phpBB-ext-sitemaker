/*!
 * Sitemaker treeBuilder
 * Author: @blitze
 * Licensed under the GPL license
 */

;(function($, window, document, undefined) {
	'use strict';

	var lang = window.lang || {};
	var Twig = window.Twig || {};
	var codeMirror = {};

	$.widget('sitemaker.treeBuilder', {
		options: {
			ajaxUrl: '',
			loadSpeed: 10,

			fields: {
				itemId: 'item_id',
				itemTitle: 'item_title',
				parentId: 'parent_id'
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
			actionClass: '.item-action',
			selectItemClass: '.select-item',
			iconSelectClass: '.icon-select',

			dialogEdit: '',
			dialogConfirm: '#dialog-confirm',

			loaded: function() {},
			updated: function() {}
		},

		_create: function() {
			var self = this;
			var eButtons = {};
			var dButtons = {};
			var sButtons = {};

			// call nested sortable
			this.nestedList = this.element.addClass('tree-builder').find(this.options.nestedList).nestedSortable({
				disableNesting: this.options.noNesting,
				forcePlaceholderSize: true,
				listType: this.options.listType,
				handle: 'div',
				helper:	'clone',
				items: 'li',
				opacity: 0.6,
				placeholder: 'placeholder',
				tabSize: 25,
				tolerance: 'pointer',
				toleranceElement: '> div',
				errorClass: this.options.ajaxMessage,
				update: function() {
					self.itemsChanged = true;
					if (self.saveBtn.button('option', 'disabled')) {
						self.saveBtn.button('option', 'disabled', false);
					}
				}
			});

			this.selectAllObj = this.element.find(this.options.selectAll).click(function() {
				self.nestedList.find(self.options.selectItemClass).prop('checked', this.checked);
				if (this.checked) {
					self.deleteSelBtn.button('enable');
				} else {
					self.deleteSelBtn.button('disable');
				}
			});

			// register dialogs
			dButtons[lang.deleteChildNodes] = function() {
				var node = $('li#item-' + self.itemID);
				self._removeNode(node);
				$(this).dialog('close');
				self._saveTree();
			};

			dButtons[lang.deleteNode] = function() {
				var node = $('li#item-' + self.itemID);
				if (node.children(self.options.listType).length) {
					node.children(self.options.listType).children('li').appendTo(node.parent(self.options.listType));
				}
				self._removeNode(node);
				$(this).dialog('close');
				self._saveTree();
			};

			dButtons[lang.cancel] = function() {
				$(this).dialog('close');
			};

			eButtons[lang.saveNode] = function() {
				if (self._checkRequired()) {
					self._submitForm(self.itemID);
					$(this).dialog('close');
				}
			};

			eButtons[lang.cancel] = function() {
				$(self.dialogID).dialog('close');
			};

			sButtons[lang.deleteNode] = function() {
				self.element.find(self.options.selectItemClass + ':checked').parentsUntil('li').parent().each(function() {
					self._removeNode($(this));
				});
				self._saveTree();
				$(this).dialog('close');
			};

			sButtons[lang.cancel] = function() {
				$(this).dialog('close');
			};

			var defDialog = {
				autoOpen: false,
				modal: true,
				width: 'auto',
				show: 'slide',
				hide: 'slide'
			};

			$(this.options.dialogEdit).dialog(defDialog);
			$(this.options.dialogConfirm).dialog(defDialog);

			// register events
			this.msgObj = this.element.find(this.options.ajaxMessage);

			var loader = this.element.find(this.options.loading);
			$(document).ajaxStart(function() {
				loader.fadeIn();
			}).ajaxStop(function() {
				loader.fadeOut();
			}).ajaxComplete(function(event, xhr) {
				if (xhr.responseJSON) {
					// Display any returned message
					if (xhr.responseJSON.message) {
						self.showMessage(xhr.responseJSON.message);
					}
				}
			}).ajaxError(function() {
				self.showMessage(lang.errorMessage);
			});

			window.onbeforeunload = function(e) {
				if (self.itemsChanged === true) {
					e = e || window.event;
					// For IE and Firefox
					if (e) {
						e.returnValue = lang.unsavedChanges;
					}
					// For Safari
					return lang.unsavedChanges;
				}
			};

			var events = {};
			events['click' + this.options.selectItemClass] = function() {
				var numSelected = this.element.find(this.options.selectItemClass + ':checked').length;
				if (numSelected > 0) {
					this.deleteSelBtn.button('enable');
				} else {
					this.deleteSelBtn.button('disable');
				}
				if (numSelected === this.element.find(this.options.selectItemClass).length) {
					this.selectAllObj.prop('checked', true);
				} else {
					this.selectAllObj.prop('checked', false);
				}
			};
			events['click.editable'] = function(event) {
				this._makeEditable($(event.target));
			};
			events['blur#inline-edit'] = function(event) {
				this._processEditable($(event.target));
			};
			events['submit#inline-form'] = function(event) {
				event.preventDefault();
				$(event.target).find('#inline-edit').trigger('blur');
			};
			events['click' + this.options.actionClass] = function(event) {
				var action = $(event.currentTarget).data('action');

				this.itemID = self._getItemId($(event.currentTarget));

				switch (action) {
					case 'edit':
						this.dialogID = this.options.dialogEdit;
						this._populateForm(this.itemID, function(dialogID) {
							$(dialogID).dialog({buttons: eButtons}).dialog('option', 'title', lang.editNode).dialog('open');
						});
					break;
					case 'delete':
						var buttons = $.extend({}, dButtons);

						this.dialogID = this.options.dialogConfirm;

						if ($('#item-' + this.itemID).children(this.options.listType).children('li').length < 1) {
							delete buttons[lang.deleteChildNodes];
						}
						$(this.dialogID).dialog({buttons: buttons}).dialog('open');
					break;
				}
			};

			this._on(this.document, events);

			// set button events
			this.addBtn = this.element.find(this.options.addBtn).button({
				icons: {
					primary: 'ui-icon-plus'
				}
			}).click(function(event) {
				event.preventDefault();
				if (self.options.dialogEdit.length) {
					self.itemID = undefined;
					self.dialogID = self.options.dialogEdit;
					self.editForm.populate({});
					$(self.dialogID).dialog({buttons: eButtons}).dialog('option', 'title', lang.addNode).dialog('open');
				} else {
					self.addItem();
				}
			});

			this.addBulkBtn = this.element.find(this.options.addBulkBtn).button({
				text: false,
				icons: {
					primary: 'ui-icon-triangle-1-s'
				}
			}).click(function(e) {
				e.preventDefault();

				var $button = $(e.currentTarget).toggleClass('dropped').blur();
				var $dropdown = $button.parent().next();
				var width = $dropdown.width();
				var pos = $button.offset();

				var form = $dropdown.slideToggle().offset({
					top: pos.top + $button.height() + 10,
					left: pos.left - (width / 2) + $button.width()
				});

				if ($button.hasClass('dropped') === true) {
					var options = '<option value="0">' + lang.none + '</option>';
					form.find('select').html(self._getOptions(self.nestedList, '', options)).next().val();
				}
			});

			this.addBulkBtn.parent().buttonset().show().next().hide().find('#cancel').click(function() {
				self.addBulkBtn.trigger('click');
			}).next().click(function(event) {
				var form = $(event.target).parentsUntil('form').parent();
				var data = {
					'add_list': codeMirror.getValue()
				};

				data[self.options.fields.parentId] = form.find('#parent_id').val();

				// reset codemirror
				codeMirror.setValue("");
				codeMirror.clearHistory();

				self._addBulk($.param(data));
				self.addBulkBtn.trigger('click');
				event.preventDefault();
			});

			this.rebuildBtn = this.element.find(this.options.rebuildBtn).button({
				disabled: true,
				icons: {
					primary: 'ui-icon-refresh'
				}
			}).click(function(event) {
				self._saveTree();
				event.preventDefault();
			});

			this.deleteSelBtn = this.element.find(this.options.deleteSelBtn).button({
				disabled: true,
				icons: {
					primary: 'ui-icon-trash'
				}
			}).click(function(event) {
				self.dialogID = self.options.dialogConfirm;
				$(self.dialogID).dialog({buttons: sButtons}).dialog('open');
				event.preventDefault();
			});

			this.saveBtn = this.element.find(this.options.saveBtn).button({
				disabled: true,
				icons: {
					primary: 'ui-icon-check'
				}
			}).click(function(event) {
				if (self.itemsChanged === true) {
					self._saveTree();
				}
				event.preventDefault();
			});

			this.addBtnOffset = this.addBtn.offset();
			this.noItems = this.element.find(this.options.noItems);
			this.editForm = $(this.options.editForm);

			Twig.twig({
				id: 'item_template',
				data: this.element.find(this.options.itemTemplate).html()
			});

			/* global CodeMirror */
			codeMirror = CodeMirror.fromTextArea($(this.options.addBulkList).get(0), {
				theme: "monokai",
				lineNumbers: true,
				lineWrapping : false,
				autoRefresh: true,
				styleActiveLine: true,
				fixedGutter: true,
				coverGutterNextToScrollbar: false,
				indentWithTabs: true,
				indentUnit: 4
			});

			this.getItems();
		},

		addItem: function() {
			this._saveItem('add_item', {});
		},

		updateItem: function(data, id) {
			this._saveItem('update_item', data, id);
		},

		getItems: function() {
			var self = this;

			$.getJSON(this.options.ajaxUrl + 'load_items', function(data) {
				self.nestedList.empty();
				self._resetActions();

				if (data.items !== undefined && data.items.length > 0) {
					self._showActions();
					self._addToTree(data.items);
				}
			});
		},

		getCodeMirrorInstance: function() {
			return codeMirror;
		},

		showMessage: function(message) {
			if (message) {
				this.msgObj.text(message);
				this.msgObj.fadeIn().delay(3000).fadeOut();
			}
		},

		_addBulk: function(data) {
			var self = this;
			$.post(this.options.ajaxUrl + 'add_bulk', data,
				function(resp) {
					if (!resp.error) {
						self._showActions();
						self._addToTree(resp.items);
					} else {
						self.showMessage(resp.error);
					}
				},
				'json'
			);
		},

		_addToTree: function(items, callback) {
			/* jshint sub: true */
			if (items.length > 0) {
				var html = {};
				var item = items.shift();

				item[this.options.fields.itemTitle] = item[this.options.fields.itemTitle] || lang.changeMe;

				if (item[this.options.fields.parentId] > 0) {
					var parentObj = $('#item-' + item[this.options.fields.parentId]);
					var children = parentObj.children(this.options.listType);

					if (children.length === 0) {
						html = $('<' + this.options.listType + '>' + this._renderItem(item) + '</' + this.options.listType + '>').hide();
						html.appendTo(parentObj);
					} else {
						html = $(this._renderItem(item)).hide();
						html.appendTo(parentObj.children(this.options.listType));
					}
				} else {
					html = $(this._renderItem(item)).hide();
					html.appendTo(this.nestedList);
				}

				var self = this;
				html.effect('slide', {'direction': 'right', 'mode': 'show'}, this.options.loadSpeed, function() {
					self._addToTree(items, callback);
				});
			}

			if (callback !== undefined) {
				callback.apply(this, [items]);
			}
			this._trigger('loaded', null, {items: items});
		},

		_checkRequired: function() {
			$(this.dialogID + ' .error').remove();

			var response = true;

			$(this.dialogID + ' .required').each(function() {
				if (!$(this).val()) {
					$('<div class="error">' + lang.required + '</div>').insertAfter(this);
					response = false;
				}
			});

			return response;
		},

		_getItemId: function(element) {
			return element.attr('id').substring(5);
		},

		_getOptions: function(list, padding, options) {
			var self = this;

			list.children('li').each(function(i, element) {
				var item = $(element);
				var id = self._getItemId(item);
				var title = padding + '&#x251c;&#x2500; ' + item.find('.editable:first').text();
				var option = '<option value="' + id + '">' + title + '</option>';

				options += self._getOptions(item.children('ol'), '&nbsp;&nbsp;&nbsp;&nbsp;' + padding, option);
			});

			return options;
		},

		_makeEditable: function(element) {
			if (this.editing === true) {
				this.editor.trigger('blur');
				return;
			}

			this.editing = true;
			this.editorVal = (element.text() !== lang.changeMe) ? element.text() : '';

			element.replaceWith('<form id="inline-form"><input type="text" id="inline-edit" value="' + this.editorVal + '" /></form>');
			this.editor = $('#inline-edit').data('field', element.data('field')).focus().select();
		},

		_populateForm: function(id, callBack) {
			var self = this;
			$.get(this.options.ajaxUrl + 'load_item?' + this.options.fields.itemId + '=' + id, function(data) {
				self.showMessage(data.message);
				self.editForm.populate(data);
				callBack(self.dialogID);
			}, 'json');

			return {};
		},

		_processEditable: function(e) {
			if (this.editing === false) {
				return;
			}

			var id = this._getItemId($(e).parentsUntil('li').parent());
			var field = $(e).data('field');
			var val = $(e).val();
			var data = {};

			if (id && field && val && val !== this.editorVal) {
				data[field] = val;
				data.field = field;
				this._saveItem('update_item', data, id, field);
			} else {
				this._undoEditable(this.editorVal ? this.editorVal : lang.changeMe);
			}

			return false;
		},

		_resetActions: function(itemsCount) {
			var display = 'initial';

			if (!itemsCount) {
				this.noItems.show();
				display = 'none';
			}

			this.itemsChanged = false;
			this.addBulkBtn.parent().next().slideUp();
			this.selectAllObj.prop('checked', false).parent().css('display', display);
			this.deleteSelBtn.button('disable').css('display', display);
			this.saveBtn.button('disable').css('display', display);
			this.rebuildBtn.css('display', display);
		},

		_saveItem: function(mode, data, id, field) {
			var self = this;
			$.post(this.options.ajaxUrl + mode + ((id) ? '?' + this.options.fields.itemId + '=' + id : ''), data, function(resp) {
				if (!resp.error) {
					switch (mode) {
						case 'add_item':
							self._addToTree([resp], function() {
								var element = $('#item-' + resp[self.options.fields.itemId]);

								self._showActions();
								self._scrollTo(element, self.addBtnOffset.top, function() {
									if (!self.options.dialogEdit.length) {
										element.find('.editable').trigger('click');
									}
								});
							});
						break;
						case 'update_item':
							if (self.editing) {
								self._undoEditable(resp[field]);
							} else {
								self._refreshItem(resp);
							}
						break;
						case 'save_item':
							var element = self._refreshItem(resp);
							self._trigger('updated', null, element);
						break;
					}
				} else {
					self.showMessage(resp.error);

					if (self.editing) {
						self._undoEditable(self.editorVal);
					}
				}
			}, 'json');
		},

		_saveTree: function() {
			var data = $(this.options.nestedList).find('li').length ? this.nestedList.nestedSortable('toArray') : [];

			this._saveItem('save_tree', {
				'tree': data
			});
			this._resetActions(data.length);
		},

		_scrollTo: function(element, fromHeight, callback) {
			var offset = element.offset();
			var offsetTop = offset.top;
			var totalScroll = offsetTop - fromHeight;

			this.nestedList.animate({
				scrollTop: totalScroll
			}, 1000, callback);
		},

		_showActions: function() {
			this.noItems.hide();
			this.nestedList.show();
			this.selectAllObj.parent().show();
			this.deleteSelBtn.show();
			this.saveBtn.show();
			this.rebuildBtn.button('enable').show();
		},

		_removeNode: function(node) {
			var parentNode = node.parent(this.options.listType).not(this.options.nestedList);

			// if node has sibblings, or it's parent is the root ol/ul, remove node and leave parent
			if (node.siblings().length || !parentNode.length) {
				node.remove();
			// if node does not have sibblings, remove parent ol/ul
			} else {
				parentNode.remove();
			}
		},

		_renderItem: function(data) {
			return Twig.twig({ref: 'item_template'}).render(data);
		},

		_refreshItem: function(data) {
			var replacement = $(this._renderItem(data)).children();
			return $('#item-' + data[this.options.fields.itemId]).children(':first').replaceWith(replacement);
		},

		_undoEditable: function(v) {
			this.editorVal = '';
			this.editing = false;
			this.editor.parent().replaceWith('<span class="editable" data-field="' + this.editor.data('field') + '">' + v + '</span>');
		},

		_submitForm: function(itemID) {
			var action = itemID ? 'save_item' : 'add_item';
			this._saveItem(action, this.editForm.serializeArray(), itemID);
		}
	});
})(jQuery, window, document);