;(function($, window, document, undefined) {
	'use strict';

	var codeMirror = {};

	function insertText(data) {
		var doc = codeMirror.getDoc();
		var cursor = doc.getCursor();
		var line = doc.getLine(cursor.line);
		var pos = {
			line: cursor.line
		};

		if (!line.match(/\S/i)) {
			doc.replaceRange(data, pos);
		} else {
			doc.replaceRange("\n" + data, pos);
		}
	}

	$(document).ready(function() {
		var ajaxUrl = window.ajaxUrl || '';
		var menuId = window.menuId || 0;
		var lang = window.lang || {};
		var Twig = window.Twig || {};

		var dButtons = {};
		var menuAdmin = {};
		var dialogConfirmDelete = {};
		var currentMenuTitle = '';

		Twig.extendFunction('lang', function(value) {
			return (typeof lang[value] !== 'undefined') ? lang[value] : value;
		});

		// add menu id to ajax requests
		$(document).ajaxSend(function(event, xhr, settings) {
			settings.url += (settings.url.indexOf('?') >= 0) ? '&' : '?';
			settings.url += 'menu_id=' + menuId;
		});

		// Init icon picker
		$('.items-list').iconPicker({
			selector: '.icon-select',
			onSelect: function(item, iconClass) {
				var id = item.parentsUntil('li').parent().attr('id').substring(5);
				menuAdmin.treeBuilder('updateItem', {'item_icon': iconClass}, id);
			}
		});

		// menu list
		var menuDivObj = $('#sm-menus')
			.on('click', '.menu-option', function(e) {
				menuId = +$(this).parent().attr('id').substring(5);
				$(this).parent().parent().children().removeClass('row3 current-menu');
				$(this).parent().addClass('row3 current-menu');
				menuAdmin.treeBuilder('getItems');
				e.preventDefault();
			})
			.on('click', '.menu-edit', function(e) {
				var element = $(this).parent().prev().removeClass('menu-option').parent().removeClass('current-menu').find('.menu-editable');
				currentMenuTitle = element.text();
				inlineMenuForm.show().appendTo(element.text('')).children(':input').val(currentMenuTitle).focus().select().end();
				e.preventDefault();
			})
			.on('click', '.menu-delete', function(e) {
				dialogConfirmDelete.dialog({buttons: dButtons}).dialog('open');
				e.preventDefault();
			});

		var inlineMenuForm = $('<form id="inline-menu-form"><input type="text" id="inline-menu-edit" value="" /></form>').hide().appendTo($('body'));

		// manage menu items
		menuAdmin = $('#nested-tree').treeBuilder({
			ajaxUrl: ajaxUrl,
			editForm: '#edit-menu-item-form',
			dialogEdit: '#dialog-edit-menu-item',
			dialogConfirm: '#dialog-confirm-menu-item'
		});

		$('.toggle-view').click(function(e) {
			$($(this).attr('href')).slideToggle();
			e.preventDefault();
		});

		// add new menu
		$('#add-menu').button().click(function(e) {
			menuId = 0;
			$.getJSON(ajaxUrl + 'add_menu', function(data) {
				if (data.id === null) {
					return;
				}

				menuId = data.id;

				var html = '<li id="menu-' + menuId + '" class="row3 current-menu">';
				html += '<a href="#" class="menu-option"><span class="menu-editable">' + data.title + '</span></a>';
				html += '<div class="menu-actions">';
				html += '<a href="#" class="menu-edit left" title="' + lang.edit + '"><span class="ui-icon ui-icon-gear"></span></a>';
				html += '<a href="#" class="menu-delete left" title="' + lang.remove + '"><span class="ui-icon ui-icon-trash"></span></a>';
				html += '</span></li>';
				menuDivObj.children('li').removeClass('row3 current-menu');
				menuDivObj.append(html);

				menuAdmin.show().treeBuilder('getItems');
			});

			e.preventDefault();
		});

		$('#inline-menu-form').submit(function(e) {
			e.preventDefault();
			$(this).children('#inline-menu-edit').trigger('blur');
		});

		$('#inline-menu-edit').focusout(function(e) {
			var menuTitle = $(this).val();
			var element = $(this).val('').parent().parent();

			if (menuId && menuTitle && menuTitle !== currentMenuTitle) {
				$.post(ajaxUrl + 'edit_menu', {'title': menuTitle}, function(menu) {
					if (menu.name) {
						element.text(menu.name);
					}
				});
			} else {
				menuTitle = currentMenuTitle;
			}

			inlineMenuForm.hide().appendTo($('body'));
			element.text(menuTitle).parent().addClass('menu-option').parent().addClass('current-menu');
			e.preventDefault();
		});

		dButtons[lang.remove] = function() {
			if (menuId) {
				$.getJSON(ajaxUrl + 'delete_menu', function(resp) {
					if (resp.id === menuId) {
						var menu = $('#menu-' + menuId);
						var up = menu.prev();
						var down = menu.next();

						if (up.length) {
							up.find('.menu-option').trigger('click');
						} else if (down.length) {
							down.find('.menu-option').trigger('click');
						} else {
							window.location.reload(false);
						}
						menu.remove();
					}
				});
			}
			$(this).dialog('close');
		};

		dButtons[lang.cancel] = function() {
			$(this).dialog('close');
		};

		dialogConfirmDelete = $('#dialog-confirm-menu').dialog({
			autoOpen: false,
			modal: true,
			width: 'auto',
			show: 'slide',
			hide: 'slide'
		});

		if (menuId) {
			menuAdmin.show();
		}

		codeMirror = $('#nested-tree').treeBuilder('getCodeMirrorInstance');

		// set button events
		$('.bulk-type').button().click(function(e) {
			e.preventDefault();
			var itemsStr = $(this).data('items').trim();
			insertText(itemsStr);
		}).each(function(i, element) {
			var list = [];
			var items = $(this).data('items').trim().split("\n");
			$.each(items, function(j, item) {
				var parts = item.split('|');
				list.push('<a href="#" data-item="' + item + '">' + parts[0].replace(/\t/g, '&nbsp; &nbsp;') + '</a>');
			});
			$(element).siblings('.bulk-dropdown').children('.inner').html(list.join('<br />'));
		});

		var bulkTypeItems = $('.bulk-type-items').on('click', 'a', function(e) {
			e.preventDefault();
			insertText($(this).data('item').trim());
			$(this).parents('.bulk-type-items').toggle();
		});

		$('.bulk-type-list').button({
			text: false,
			icons: {
				primary: 'ui-icon-triangle-1-n'
			}
		}).click(function(e) {
			e.preventDefault();
			bulkTypeItems.hide();

			var $button = $(e.currentTarget);
			var $dropdown = $button.next();
			var pos = $button.offset();
			var height = $dropdown.height();
			var width = $dropdown.width();

			$dropdown.toggle().offset({
				top: pos.top - height,
				left: pos.left - (width / 2) - $button.width()
			});
		}).parent().buttonset();

		var cmTabs = 0;
		codeMirror.on("keyup", function(cm) {
			var doc = cm.getDoc();
			var line = doc.getLine(cm.getCursor().line);
			var matches = line.match(/\s/gim);
			cmTabs = matches ? matches.length : 0;
		});

		codeMirror.on("change", function(cm, change) {
		    var spaces = cmTabs * cm.options.tabSize;
		    cm.operation(function() {
		    	/* global CodeMirror */
		        for (var line = change.from.line + 1, end = CodeMirror.changeEnd(change).line; line <= end; ++line) {
		            cm.indentLine(line, spaces);
		        }
		    });
		});
	});
})(jQuery, window, document);