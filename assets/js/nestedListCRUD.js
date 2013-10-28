(function($) {

	$.fn.nestedListCRUD = function(options) {
		var addBtnOffset;
		var itemsChanged = false, editing = false, dialogID = '', editorVal = '', itemID = 0;
		var editForm = {}, eButtons = {}, dButtons = {}, editor = {}, nestedList = {}, noItems = {}, msgObj = {}, addBtn = {}, saveBtn = {};

		var settings = $.extend({
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
		}, options);

		var addItem = function() {
			saveItem('add', {'title': ''});
		};

		var addHtmlItem = function(id, title) {
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
		};

		var getItem = function(id) {
			$.get(settings.ajaxUrl + 'get/' + id, function(resp) {
					showMessage(resp.message);
					editForm.populate(resp);
					$(dialogID).dialog({buttons: eButtons}).dialog('option', 'title', LANG.editNode).dialog('open');
				},
				'json'
			);
		};

		var saveItem = function(mode, data) {
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
		};

		var updateItem = function() {
			var data = editForm.serializeArray();
			saveItem('update', data);
		};

		var saveTree = function() {
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
		};

		var makeEditable = function(element) {
			if (editing === true) {
				editor.trigger('blur');
				return;
			}
			editing = true;
			editorVal = element.text();
			element.replaceWith('<form id="inline-form"><input type="text" id="inline-edit" value="' + editorVal + '" /></form>');
			editor = $('#inline-edit').focus().select();
		};

		var undoEditable = function(v) {
			editorVal = '';
			editing = false;
			editor.parent().replaceWith('<span class="editable">' + v + '</span>');
		};

		var processInput = function(e) {
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
		};

		var scrollTo = function(element, fromHeight) {
			var offset = element.offset();
			var offsetTop = offset.top;
			var totalScroll = offsetTop-fromHeight;

			$('body,html').animate({
				scrollTop: totalScroll
			}, 1000);
		};

		var checkRequired = function() {
			$(dialogID + ' .error').remove();

			var response = true;
			$(dialogID + ' .required').each(function() {
				if (!$(this).val()) {
					$('<div class="error">' + LANG.required + '</div>').insertAfter(this);
					response = false;
				}
			});

			return response;
		};

		var showMessage = function(message) {
			if (message) {
				msgObj.text(message);
				msgObj.fadeIn().delay(3000).fadeOut();
			}
		};

		var iconsDiv = $('#icons');

		// Register events
		nestedList = this.find(settings.nestedList).on('click', '.editable', function() {
			makeEditable($(this));
		}).on('blur', '#inline-edit', function(e) {
			processInput($(this));
		}).on('submit', '#inline-form', function(e) {
			e.preventDefault();
			$(this).find('#inline-edit').trigger('blur');
		}).on('click', settings.editClass, function() {
			dialogID = settings.dialogEdit;
			itemID = $(this).attr('id').substring('5');
			getItem(itemID);
		}).on('click', settings.deleteClass, function() {
			var buttons = jQuery.extend({}, dButtons);

			dialogID = settings.dialogConfirm;
			itemID = $(this).attr('id').substring('7');

			if ($('#item_'+itemID).children(settings.listType).children('li').length < 1) {
				delete buttons[LANG.deleteChildNodes];
			}
			$(dialogID).dialog({buttons: buttons}).dialog('open');
		}).on('click', '.icon-select', function(e) {
			var pos = $(this).offset();
			var height = $(this).height();
			e.stopImmediatePropagation();

			itemID = $(this).parents().parents().attr('id').substring('5');
			iconsDiv.slideToggle().offset({
				top: pos.top + height - 1,
				left: pos.left
			});
			return false;
		}).on('click', ':not(".inline-icon")', function() {
			if (iconsDiv.is(':visible')) {
				iconsDiv.slideUp();
			}
		}).on('click', '#icons img', function() {
			var img = $(this).attr('src');
			iconsDiv.slideUp();
		}).nestedSortable({
			disableNesting: settings.noNesting,
			forcePlaceholderSize: true,
			listType: settings.listType,
			handle: 'div',
			helper:	'clone',
			items: 'li',
			opacity: 0.6,
			placeholder: 'placeholder',
			tabSize: 25,
			tolerance: 'pointer',
			toleranceElement: '> div',
			errorClass: settings.ajaxMessage,
			update: function() {
				itemsChanged = true;
				if (saveBtn.button('option', 'disabled')) {
					saveBtn.button('option', 'disabled', false);
				}
			}
		});

		// set button events
		addBtn = $(settings.addBtn).button({
			icons: {
				primary: "ui-icon-plus"
			}
		}).click(function() {
			addItem();
			return false;
		}).next().button({
			text: false,
			icons: {
				primary: "ui-icon-triangle-1-s"
			}
		}).click(function() {
			var pos = $(this).offset();
			var height = $(this).height();
			$(this).parent().next().slideToggle().offset({
				top: pos.top + height / 2,
				left: pos.left
			});
			return false;
		}).parent().buttonset().show().next().hide().find('#cancel').click(function() {
			$(this).parent().parent().parent().slideUp();
		});

		saveBtn = $(settings.saveBtn).button({
			disabled: true,
			icons: {
				primary: "ui-icon-check"
			}
		}).click(function() {
			if (itemsChanged === true) {
				saveTree();
			}
			return false;
		});

		msgObj = $(settings.ajaxMessage).ajaxError(function() {
			showMessage(LANG.errorMessage);
			return false;
		});

		$(settings.loading).ajaxStart(function(){
			$(this).fadeIn();
		}).ajaxStop(function(){
			$(this).fadeOut();
		});

		eButtons[LANG.editNode] = function() {
			if (checkRequired()) {
				if (itemID) {
					updateItem();
				}
				$(this).dialog('close');
			}
		};

		eButtons[LANG.cancel] = function() {
			$(this).dialog('close');
		};

		dButtons[LANG.deleteChildNodes] = function() {
			$('li#item_'+itemID).remove();
			$(this).dialog('close');
			saveTree();
		};

		dButtons[LANG.deleteNode] = function() {
			var o = $('#item_'+itemID);
			o.parent(settings.listType).parent('li').append('<' + settings.listType + '>' + o.children(settings.listType).html() + '</' + settings.listType + '>');
			o.remove();
			$(this).dialog('close');
			saveTree();
		};

		dButtons[LANG.cancel] = function() {
			$(this).dialog('close');
		};

		var defDialog = {
			autoOpen: false,
			modal: true,
			width: 'auto',
			show: 'slide',
			hide: 'slide'
		};

		var dialogAdd = $(settings.dialogEdit).dialog(defDialog);
		var dialogConfirm = $(settings.dialogConfirm).dialog(defDialog);

		noItems = $(settings.noItems);
		editForm = $(settings.editForm);
		addBtnOffset = addBtn.offset();

	};
})( jQuery );