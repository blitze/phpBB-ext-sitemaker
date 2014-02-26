(function($){

	$(document).ready(function() {
		var menuAdmin = {};
		var dButtons = {};
		var dialogConfirmDelete = {};
		var currentMenuTitle = '';

		var initIconPicker = function() {
			$('.icon-select').iconPicker({
				onSelect: function(item, iconHtml, iconClass) {
					var id = item.parentsUntil('li').parent().attr('id').substring('5');
					menuAdmin.treeBuilder('updateItem', {'item_icon': iconClass}, id);
				}
			});
		};

		// add menu id to ajax requests
		$(document).ajaxSend(function(event, xhr, settings) {
			settings.url = settings.url + '?menu_id=' + menu_id;
		});

		// menu list
		var menuDivObj = $('#menu-options').on('click', '.menu-option', function() {
			menu_id = $(this).parent().attr('id').substring(5);
			$(this).parent().parent().children().removeClass('row3 current-menu');
			$(this).parent().addClass('row3 current-menu');
			menuAdmin.treeBuilder('getItems');
			$('#menu_id').val(menu_id);

			return false;
		});

		var inlineMenuForm = $('<form id="inline-menu-form"><input type="text" id="inline-menu-edit" value="" /></form>').hide().appendTo($('body'));

		// manage menu items
		menuAdmin = $('#nested-tree').treeBuilder({
			ajaxUrl			: ajaxUrl,
			editForm		: '#edit-menu-item-form',
			dialogEdit		: '#dialog-edit-menu-item',
			dialogConfirm	: '#dialog-confirm-menu-item',
			loaded			: function() {
				initIconPicker();
			},
			updated			: function() {
				initIconPicker();
			}
		});

		// add new menu
		$('#add-menu').button().click(function() {
			$.getJSON(ajaxUrl + 'add_menu', function(data) {
				if (data.id === null) {
					return;
				}

				menu_id = data.id;

				var html = '<li id="menu-' + menu_id + '" class="row3 current-menu">';
				html += '<a href="#" class="menu-option"><span class="menu-editable">' + data.title + '</span></a>';
				html += '<div class="menu-actions">';
				html += '<a href="#" class="menu-edit left" title="' + LANG.edit + '"><span class="ui-icon ui-icon-gear"></span></a>';
				html += '<a href="#" class="menu-delete left" title="' + LANG.remove + '"><span class="ui-icon ui-icon-trash"></span></a>';
				html += '</span></li>';
				menuDivObj.children('li').removeClass('row3 current-menu');
				menuDivObj.append(html);

				menuAdmin.show().treeBuilder('getItems');
			});

			return false;
		});

		$('#menu-options').on('click', '.menu-edit', function() {
			var element = $(this).parent().prev().removeClass('menu-option').parent().removeClass('current-menu').find('.menu-editable');
			currentMenuTitle = element.text();
			inlineMenuForm.show().appendTo(element.text('')).children(':input').val(currentMenuTitle).focus().select().end();
			return false;
		}).on('click', '.menu-delete', function() {
			dialogConfirmDelete.dialog({buttons: dButtons}).dialog('open');
			return false;
		});
		
		$('#inline-menu-form').submit(function(e) {
			e.preventDefault();
			$(this).children('#inline-menu-edit').trigger('blur');
			return false;
		});

		$('#inline-menu-edit').focusout(function(e) {
			var menuTitle = $(this).val();
			var element = $(this).val('').parent().parent();

			if (menu_id && menuTitle && menuTitle !== currentMenuTitle) {
				$.post(ajaxUrl + 'update_menu', {'title': menuTitle}, function(resp) {
					if (resp.menu_name) {
						element.text(resp.menu_name);
					}
				});
			} else {
				menuTitle = currentMenuTitle;
			}

			inlineMenuForm.hide().appendTo($('body'));
			element.text(menuTitle).parent().addClass('menu-option').parent().addClass('current-menu');
			e.preventDefault();

			return false;
		});

		dButtons[LANG.remove] = function() {
			if (menu_id) {
				$.post(ajaxUrl + 'delete_menu', function(resp) {
					if (resp.id == menu_id) {
						var menu = $('#menu-' + menu_id);
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

		dButtons[LANG.cancel] = function() {
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
		var ace_editor = ace.edit("buld_editor");
		var textarea = document.getElementById('add_list');

		textarea.style.display = 'none';
		ace_editor.setTheme("ace/theme/monokai");
		ace_editor.getSession().setMode("ace/mode/yaml");
		ace_editor.getSession().setValue(textarea.value);
		ace_editor.getSession().on('change', function(){
			textarea.value = ace_editor.getSession().getValue();
		});

		if (menu_id) {
			menuAdmin.show();
		}
	});
})(jQuery);