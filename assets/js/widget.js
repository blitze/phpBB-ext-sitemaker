(function($) {

	$.widget("primetime.nestedSortableCRUD", $.extend({}, $.mjs.nestedSortable.prototype, {

		options: {
			ajaxUrl			: '',
			icon			: '',

			listType		: 'ol',
			noNesting:		'.no-nest',

			addBtn			: '#add-new',
			addBulkBtn		: '#add-bulk',
			saveBtn			: '#save',
			loading			: '#loading',
			ajaxMessage		: '#ajax-message',
			nestedList		: '#sortable',
			editForm		: '#edit-form',
			noItems			: '#no-items',
			editClass		: '.edit-item',
			deleteClass		: '.delete-item',

			dialogEdit		: '#dialog-edit',
			dialogConfirm	: '#dialog-confirm'
		},

		_create: function() {},

		_addItem: function() {
			saveItem('add', {'title': ''});
		},

		_addHtmlItem: function(id, title) {
			if (id) {
				var del = '<a href="#" id="delete_' + id + '" class="right item-action delete-item ui-dialog-titlebar-close ui-corner-all" title="' + LANG.deleteNode + '"><span class="ui-icon ui-icon-closethick">' + LANG.deleteNode + '</span></a>';
				var edit = '<a href="#" id="edit_' + id + '" class="right item-action edit-item ui-dialog-titlebar-close ui-corner-all" title="' + LANG.editNode + '"><span class="ui-icon ui-icon-gear">' + LANG.editNode + '</span></a>';
				var icon = '<a href="#" id="icon_' + id + '" class="left item-action icon-item ui-dialog-titlebar-close ui-corner-all"><span class="ui-icon inline-icon"></span></a>';

				noItems.hide();
				nestedList.append('<li id="item_' + id + '"><div class="ui-state-default ui-corner-all"><span class="left ui-icon ui-icon-arrowthick-2-n-s"></span>' + icon + '<span class="editable">' + title + '</span>' + del + edit + '</div></li>');

				var element = $('#item_' + id);
				makeEditable(element.find('.editable'));
				scrollTo(element, addBtnOffset.top);
			}
		},

		_getItem: function(id) {
			$.get(settings.ajaxUrl + 'get/' + id, function(resp) {
					showMessage(resp.message);
					editForm.populate(resp);
					$(dialogID).dialog({buttons: eButtons}).dialog('option', 'title', LANG.editNode).dialog('open');
				},
				'json'
			);
		},

		_saveItem: function(mode, data) {
			$.post(settings.ajaxUrl + mode, data,
				function(resp){
					if (!resp.error) {
						if (mode === 'add') {
							addHtmlItem(resp.id, resp.title);
						} else if (mode === 'edit') {
							undoEditable(resp.title);
						}
					} else {
						showMessage(resp.error);

						if (mode === 'edit') {
							undoEditable(editorVal);
						}
					}
				},
				"json"
			);
		},

		_updateItem: function() {
			var data = editForm.serializeArray();
			saveItem('update', data);
		},

		saveTree: function() {
			var data = nestedList.nestedSortable('toArray');
			var itemsCount = data.length;

			saveItem('save_tree', {'tree': data});

			itemsChanged = false;
			saveBtn.button('option', 'disabled', true);
			if (itemsCount > 0) {
				noItems.hide();
			} else {
				noItems.show();
			}
		},

		_makeEditable: function(element) {
			if (editing === true) {
				editor.trigger('blur');
				return;
			}
			editing = true;
			editorVal = element.text();
			element.replaceWith('<form id="inline-form"><input type="text" id="inline-edit" value="' + editorVal + '" /></form>');
			editor = $('#inline-edit').focus().select();
		},

		_undoEditable: function(v) {
			editorVal = '';
			editing = false;
			editor.parent().replaceWith('<span class="editable">' + v + '</span>');
		},

		processInput: function(e) {
			if (editing === false) {
				return;
			}

			var id = $(e).parents().parents().parents().attr('id').substring('5');
			var title = $(e).val();

			if (id && title && title !== editorVal) {
				saveItem('edit', {'id': id, 'title': title});
			} else {
				undoEditable(editorVal);
			}
			return false;
		},

		scrollTo: function(element, fromHeight) {
			var offset = element.offset();
			var offsetTop = offset.top;
			var totalScroll = offsetTop-fromHeight;

			$('body,html').animate({
				scrollTop: totalScroll
			}, 1000);
		},

		checkRequired: function() {
			$(dialogID + ' .error').remove();

			var response = true;
			$(dialogID + ' .required').each(function() {
				if (!$(this).val()) {
					$('<div class="error">' + LANG.required + '</div>').insertAfter(this);
					response = false;
				}
			});

			return response;
		},

		_showMessage: function(message) {
			if (message) {
				msgObj.text(message);
				msgObj.fadeIn().delay(3000).fadeOut();
			}
		}
	}));

	$.mjs.nestedSortable.prototype.options = $.extend({}, $.ui.sortable.prototype.options, $.mjs.nestedSortable.prototype.options);
})(jQuery);