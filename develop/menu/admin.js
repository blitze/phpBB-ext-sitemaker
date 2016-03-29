;(function($, window, document, undefined) {
	'use strict';

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
			onSelect: function(item, iconHtml, iconClass) {
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

		// cloud9 editor for yaml
		var aceEditor = window.ace.edit('build_editor');
		var textarea = document.getElementById('add_list');

		textarea.style.display = 'none';
		aceEditor.setTheme('ace/theme/monokai');
		aceEditor.getSession().setMode('ace/mode/html');
		aceEditor.setDisplayIndentGuides(true);
		aceEditor.getSession().setValue(textarea.value);
		aceEditor.getSession().on('change', function() {
			textarea.value = aceEditor.getSession().getValue();
		});

		if (menuId) {
			menuAdmin.show();
		}
	});
})(jQuery, window, document);