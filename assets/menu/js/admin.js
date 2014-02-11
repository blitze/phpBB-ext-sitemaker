(function($){

	$(document).ready(function() {
		var menuAdmin = {};

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
			menu_id = $(this).attr('id').substring(5);
			$(this).parent().parent().children().removeClass('row3 current-menu');
			$(this).parent().addClass('row3 current-menu');
			menuAdmin.treeBuilder('getItems');
			$('#menu_id').val(menu_id);

			return false;
		});

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

				var html = '<li class="row3 current-menu">';
				html += '<a href="#" id="menu-' + menu_id + '" class="menu-option"><span class="menu-editable">' + data.title + '</span></a>';
				html += '<div class="menu-actions">';
				html += '<a href="#" class="menu-edit left" title="' + LANG.edit + '"><span class="ui-icon ui-icon-gear"></span></a>';
				html += '<a href="#" class="menu-delete left" title="' + LANG.delete + '"><span class="ui-icon ui-icon-trash"></span></a>';
				html += '</span></li>';
				menuDivObj.children('li').removeClass('row3 current-menu').parent().append(html);

				menuAdmin.show().treeBuilder('getItems');
			});

			return false;
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