/*!
 * Primetime treeBuilder
 * Author: @blitze
 * Licensed under the GPL license
 */

;(function($, window, document, undefined) {
	'use strict';

	$.widget('primetime.treeBuilder', {
		options : {
			ajaxUrl			: '',
			loadSpeed		: 10,
			primaryKey		: 'item_id',

			listType		: 'ol',
			noNesting		: '.no-nest',
			nestedList		: '#sortable',
			editForm		: '#edit-form',
			noItems			: '#no-items',

			addBtn			: '#add-new',
			addBulkBtn		: '#add-bulk',
			saveBtn			: '#save',
			deleteSelBtn	: '#delete-selected',
			rebuildBtn		: '#rebuild-tree',

			selectAll		: '#select-all',
			loading			: '#loading',
			ajaxMessage		: '#ajax-message',
			itemTemplate	: '#item-template',
			editClass		: '.edit-item',
			deleteClass		: '.delete-item',
			selectItemClass	: '.select-item',
			iconSelectClass	: '.icon-select',

			dialogEdit		: '#dialog-edit',
			dialogConfirm	: '#dialog-confirm',

			loaded			: function() {},
			updated			: function() {}
		},

		_create : function() {
			var self = this;
			var eventType = '';
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

			// register dialogs
			dButtons[LANG.deleteChildNodes] = function() {
				$('li#item-' + self.itemID).remove();
				$(this).dialog('close');
				self._saveTree();
			};

			dButtons[LANG.deleteNode] = function() {
				var o = $('#item-' + self.itemID);
				o.parent(self.options.listType).parent('li').append('<' + self.options.listType + '>' + o.children(self.options.listType).html() + '</' + self.options.listType + '>');
				o.remove();
				$(this).dialog('close');
				self._saveTree();
			};

			dButtons[LANG.cancel] = function() {
				$(this).dialog('close');
			};

			eButtons[LANG.editNode] = function(event) {
				if (self._checkRequired()) {
					if (self.itemID) {
						self._updateItem(self.itemID);
					}
					$(this).dialog('close');
				}
			};

			eButtons[LANG.cancel] = function() {
				$(self.dialogID).dialog('close');
			};

			sButtons[LANG.deleteNode] = function() {
				self.element.find(self.options.selectItemClass + ':checked').parentsUntil('li').parent().remove();
				self._saveTree();
				$(this).dialog('close');

				if (self.nestedList.find('li').length === 0) {
					self._resetActions();
				}
			};

			sButtons[LANG.cancel] = function() {
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
			this.msgObj = this.element.find(this.options.ajaxMessage).ajaxError(function() {
				self.showMessage(LANG.errorMessage);
				return false;
			});

			var loader = this.element.find(this.options.loading);
			$(document).ajaxStart(function() {
				loader.fadeIn();
			}).ajaxStop(function() {
				loader.fadeOut();
			});

			this.selectAllObj = this.element.find(this.options.selectAll).click(function() {
				self.nestedList.find(self.options.selectItemClass).prop('checked', this.checked);
				if (this.checked) {
					self.deleteSelBtn.button('enable');
				} else {
					self.deleteSelBtn.button('disable');
				}
			});

			var events = {};
			events['click' + this.options.selectItemClass] = function(event) {
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
			events['click' + this.options.editClass] = function(event) {
				this.dialogID = this.options.dialogEdit;
				this.itemID = $(event.currentTarget).attr('id').substring('5');
				this._populateForm(this.itemID);
				$(this.dialogID).dialog({buttons : eButtons}).dialog('option', 'title', LANG.editNode).dialog('open');
			};
			events['click' + this.options.deleteClass] = function(event) {
				var buttons = $.extend({}, dButtons);

				this.dialogID = this.options.dialogConfirm;
				this.itemID = $(event.currentTarget).attr('id').substring('7');

				if ($('#item-' + this.itemID).children(this.options.listType).children('li').length < 1) {
					delete buttons[LANG.deleteChildNodes];
				}
				$(this.dialogID).dialog({buttons: buttons}).dialog('open');
			};
			this._on(this.document, events);

			// set button events
			this.addBtn = this.element.find(this.options.addBtn).button({
				icons: {
					primary: 'ui-icon-plus'
				}
			}).click(function(event) {
				self.addItem();
				return false;
			});

			this.addBulkBtn = this.element.find(this.options.addBulkBtn).button({
				text: false,
				icons: {
					primary: 'ui-icon-triangle-1-s'
				}
			}).click(function(event) {
				var pos = $(event.target).offset();
				var height = $(event.target).height();
				var form = $(event.currentTarget).toggleClass('dropped').blur().parent().next().slideToggle().offset({
					top: pos.top + height / 2,
					left: pos.left - 165
				});

				if ($(event.currentTarget).hasClass('dropped') === true) {
					var options = '<option value="0">' + LANG.none + '</option>';
					form.find('select').html(self._getOptions(self.nestedList, '', options)).next().val();
				}

				return false;
			});

			this.addBulkBtn.parent().buttonset().show().next().hide().find('#cancel').click(function(event) {
				self.addBulkBtn.trigger('click');
			}).next().click(function(event) {
				var form = $(event.target).parentsUntil('form').parent();
				var data = {
					'add_list': form.find('#add_list').val(),
					'parent_id': form.find('#parent_id').val()
				};
				self._addBulk($.param(data));
				self.addBulkBtn.trigger('click');
				form.find('textarea').val('');
				event.preventDefault();
			});

			this.rebuildBtn = this.element.find(this.options.rebuildBtn).button({
				disabled: true,
				icons: {
					primary: 'ui-icon-refresh'
				}
			}).click(function(event) {
				self.rebuildTree();
				return false;
			});

			this.deleteSelBtn = this.element.find(this.options.deleteSelBtn).button({
				disabled: true,
				icons: {
					primary: 'ui-icon-trash'
				}
			}).click(function(event) {
				self.dialogID = self.options.dialogConfirm;
				$(self.dialogID).dialog({buttons: sButtons}).dialog('open');
				return false;
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
				return false;
			});

			this.addBtnOffset = this.addBtn.offset();
			this.noItems = this.element.find(this.options.noItems);
			this.itemTemplate = this.element.find(this.options.itemTemplate).html();
			this.editForm = $(this.options.editForm);

			this.getItems();
		},

		addItem : function() {
			this._saveItem('add', {});
		},

		updateItem : function(data, id) {
			this._saveItem('update', data, id);
		},

		getItems : function() {
			var self = this;

			$.getJSON(this.options.ajaxUrl + 'get_all_items', function(data) {
				self.nestedList.empty();
				self._resetActions();

				if (data.items.length > 0) {
					self._showActions();
					self._addToTree(data.items);
				}
			});
		},

		rebuildTree : function() {
			var self = this;
			this.nestedList.empty();
			this._resetActions();

			$.getJSON(ajaxUrl + 'rebuild_tree', function(data) {
				self._showActions();
				self._addToTree(data.items);
			});
		},

		showMessage : function(message) {
			if (message) {
				this.msgObj.text(message);
				this.msgObj.fadeIn().delay(3000).fadeOut();
			}
		},

		_addBulk : function(data) {
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

		_addToTree : function(items, callback) {
			/* jshint sub: true */
			if (items.length > 0) {
				var html = {};
				var item = items.shift();

				item['item_title'] = (item['item_title']) ? item['item_title'] : LANG.changeMe;

				if (item['parent_id'] > 0) {
					var parentObj = $('#item-' + item['parent_id']);
					var children = parentObj.children(this.options.listType);

					if (children.length === 0) {
						html = $('<' + this.options.listType + '>' + this._template(item, this.itemTemplate) + '</' + this.options.listType + '>').hide();
						html.appendTo(parentObj);
					} else {
						html = $(this._template(item, this.itemTemplate)).hide();
						html.appendTo(parentObj.children(this.options.listType));
					}
				} else {
					html = $(this._template(item, this.itemTemplate)).hide();
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

		_checkRequired : function() {
			$(this.dialogID + ' .error').remove();

			var response = true;

			$(this.dialogID + ' .required').each(function() {
				if (!$(this).val()) {
					$('<div class="error">' + LANG.required + '</div>').insertAfter(this);
					response = false;
				}
			});

			return response;
		},

		_getOptions : function(list, padding, options) {
			var self = this;

			list.children('li').each(function(i, element) {
				var item = $(element);
				var id = item.attr('id').substr('5');
				var title = padding + '&#x251c;&#x2500; ' + item.find('.editable:first').text();
				var option = '<option value="' + id + '">' + title + '</option>';

				options += self._getOptions(item.children('ol'), '&nbsp;&nbsp;&nbsp;&nbsp;' + padding, option);
			});

			return options;
		},

		_makeEditable : function(element) {
			if (this.editing === true) {
				this.editor.trigger('blur');
				return;
			}

			this.editing = true;
			this.editorVal = (element.text() !== LANG.changeMe) ? element.text() : '';

			element.replaceWith('<form id="inline-form"><input type="text" id="inline-edit" value="' + this.editorVal + '" /></form>');
			this.editor = $('#inline-edit').data('field', element.data('field')).focus().select();
		},

		_populateForm : function(id) {
			var self = this;
			$.get(this.options.ajaxUrl + 'get_item/' + id, function(data) {
				self.showMessage(data.message);
				self.editForm.populate(data);
			}, 'json');

			return {};
		},

		_processEditable : function(e) {
			if (this.editing === false) {
				return;
			}

			var id = $(e).parentsUntil('li').parent().attr('id').substring('5');
			var field = $(e).data('field');
			var val = $(e).val();
			var data = {};

			if (id && field && val && val !== this.editorVal) {
				data[field] = val;
				this._saveItem('edit', data, id, field);
			} else {
				this._undoEditable(this.editorVal ? this.editorVal : LANG.changeMe);
			}

			return false;
		},

		_resetActions : function() {
			this.noItems.show();
			this.nestedList.hide();
			this.addBulkBtn.parent().next().slideUp();
			this.selectAllObj.prop('checked', false).parent().hide();
			this.deleteSelBtn.button('disable').hide();
			this.rebuildBtn.button('disable').hide();
			this.saveBtn.button('disable').hide();
		},

		_saveItem : function(mode, data, id, field) {
			var self = this;
			$.post(this.options.ajaxUrl + mode + '/' + ((id !== undefined) ? id : 0), data,
				function(resp) {
					if (!resp.error) {
						switch (mode) {
							case 'add':
								self._addToTree([resp], function() {
									var element = $('#item-' + resp[self.options.primaryKey]);

									self._showActions();
									self._scrollTo(element, self.addBtnOffset.top, function() {
										element.find('.editable').trigger('click');
									});
								});
							break;
							case 'edit':
								self._undoEditable(resp[field]);
							break;
							case 'update':
								var element = $('#item-' + resp[self.options.primaryKey]);
								var replacement = $(self._template(resp, self.itemTemplate)).children();
								element.children(':first').replaceWith(replacement);
								self._trigger('updated', null, element);
							break;
						}
					} else {
						self.showMessage(resp.error);

						if (mode === 'edit') {
							self._undoEditable(self.editorVal);
						}
					}
				},
				'json'
			);
		},

		_saveTree : function() {
			var data = this.nestedList.nestedSortable('toArray');
			var itemsCount = data.length;

			this._saveItem('save_tree', {
				'tree' : data
			});

			this.itemsChanged = false;
			this.saveBtn.button('option', 'disabled', true);

			if (itemsCount > 0) {
				this.noItems.hide();
			} else {
				this.noItems.show();
			}
		},

		_scrollTo : function(element, fromHeight, callback) {
			var offset = element.offset();
			var offsetTop = offset.top;
			var totalScroll = offsetTop - fromHeight;

			this.nestedList.animate({
				scrollTop : totalScroll
			}, 1000, callback);
		},

		_showActions : function() {
			this.noItems.hide();
			this.nestedList.show();
			this.selectAllObj.parent().show();
			this.deleteSelBtn.show();
			this.saveBtn.show();
			this.rebuildBtn.button('enable').show();
		},

		_template : function(tokens, tpl) {
			return tpl.replace(/<%=(.+?)%>/g, function(token, match) {
				return (tokens[match] !== undefined) ? tokens[match] : '';
			});
		},

		_undoEditable : function(v) {
			this.editorVal = '';
			this.editing = false;
			this.editor.parent().replaceWith('<span class="editable" data-field="' + this.editor.data('field') + '">' + v + '</span>');
		},

		_updateItem : function(itemID) {
			this._saveItem('update', this.editForm.serializeArray(), itemID);
		}
	});
})(jQuery, window, document);