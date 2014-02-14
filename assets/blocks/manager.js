(function($){
	var editing = false, updated = false;
	var blockPositions = {}, mainContentObj = {}, emptyPositionsObj = {}, subcontentObj = {}, template = {};
	var origin = {}, inlineForm = {}, dialogConfirm = {}, dialogEdit = {}, dialogCopy = {}, cButtons = {}, dButtons = {}, eButtons = {}, blockObj = {}, blockData = {}, msgObj = {}, saveBtn = {};

	var sortHorizontal = function(items) {
		var numItems = items.length;
		var numCols = (items.parent().data('columns') !== undefined) ? ((items.parent().data('columns') <= 5) ? items.parent().data('columns') : 5) : 3;
		var itemsLeft = numItems % numCols;
		var divisibleItems = numItems - itemsLeft;

		if (numItems <= numCols) {
			numCols = numItems;
		} else if (items.parent().hasClass('equal')) {
			if (itemsLeft > 0 && numCols > 3) {
				for (var i = 1; i < itemsLeft; i++) {
					if (numItems % (numCols-i) === 0) {
						numCols = numCols - i;
						break;
					}
				}
			}
			divisibleItems = numItems;
			itemsLeft = 0;
		}

		items.removeClass('unit size1of1 size1of2 size1of3 size1of4 size1of5 lastUnit').parent().children('.clear').remove();

		if (divisibleItems > 0) {
			items.slice(0, divisibleItems).addClass('unit size1of' + numCols)
				.filter(':nth-child(' + numCols + ')')
					.addClass('lastUnit')
					.after('<div class="clear"></div>');
		}

		if (itemsLeft) {
			items.slice(divisibleItems, numItems)
				.addClass('unit size1of' + itemsLeft)
				.last()
					.addClass('lastUnit');
		}
	};

	var showAllPositions = function() {
		blockPositions.addClass('show-positions');
		mainContentObj.removeClass('lastUnit');
		emptyPositionsObj.removeClass('empty-position');
	};

	var hideEmptyPositions = function() {
		blockPositions.removeClass('show-positions');
		emptyPositionsObj = $(".block-position:not(:has('.block'))").addClass('empty-position');
		if (!subcontentObj.find('.block').size()) {
			mainContentObj.addClass('lastUnit');
		}
	};

	/*var template = function(tokens, tpl) {
		return tpl.replace(/<%=(.+?)%>/g, function(token, match) {
			return (tokens[match] !== undefined) ? tokens[match] : '';
		});
	};*/

	var addBlock = function(posID, blockName, droppedElement) {
		$(droppedElement).removeAttr('role aria-disabled data-block class style')
			.addClass('block')
			.html('<div class="ui-state-highlight cms-block-spacing sorting" style="padding: 5px"><i class="fa fa-spinner fa-lg fa-spin"></i> ' + lang.ajaxLoading + '</div>');

		$.getJSON(ajaxUrl + '/blocks/add', {block: $.trim(blockName), weight: droppedElement.index(), route: route, ext: ext, position: posID}, function(data) {
			updated = false;
			if (data.id === null) {
				$(droppedElement).remove();
				return;
			}

			var html = template.render(data);
			$(droppedElement).attr('id', 'block-' + data.id).html(html).children().not('.block-controls').show("scale", {percent: 100}, 1000);
			initIconPicker();
		});
	};

	var getEditForm = function(block) {
		$.getJSON(ajaxUrl + '/blocks/edit', {id: block.attr('id').substring(6)}, function(resp) {
			blockData = resp;
			if (resp.form) {
				dialogEdit.html(resp.form);
				dialogEdit.find('#block-settings').tabs();
				dialogEdit.dialog({buttons: eButtons}).dialog('option', 'title', lang.edit + ' - ' + resp.title).dialog('open');
			}
		});
	};

	var saveForm = function(block) {
		var form = $('#edit_form');
		$.getJSON(ajaxUrl + '/blocks/save?route=' + route + '&id=' + block.attr('id').substring(6) + '&' + form.serialize(), function(resp) {
			if (resp.errors) {
				showMessage(resp.errors);
				return;
			}

			block.html(template.render(resp));
			dialogEdit.dialog('close');
		});
	};

	var updateBlock = function(data) {
		if (data.id === undefined) {
			showMessage('Missing block id');
			return false;
		}
		$.post(ajaxUrl + '/blocks/update' + '?route=' + route, data,
			function(resp){
				if (!resp.error) {
					if (resp.title) {
						undoEditable(resp.title);
					}
				} else {
					showMessage(resp.error);
					undoEditable(editorVal);
				}
			},
			"json"
		);
	};

	var setDefaultLayout = function(set) {
		$.post(ajaxUrl + '/blocks/set_default' + '?route=' + ((set === true) ? route : ''));
	};

	var setRoutePrefs = function(form) {
		$.post(ajaxUrl + '/blocks/settings' + '?route=' + route + '&ext=' + ext, form.serialize(),
			function(resp){
				console.log(resp);
			},
			"json"
		);
	};

	var copyBlocks = function(copyFrom) {
		var position = $('.block-position');
		$.getJSON(ajaxUrl + '/blocks/copy', {copy: copyFrom, route: route, ext: ext}, function(resp) {
			if (resp.data.length === 0) {
				return;
			}

			showAllPositions();
			position.empty();

			$.each(resp.data, function(position, data) {
				var pos = $('#pos-' + position);
				$.each(data, function(idx, row) {
					var html = template.render(row);

					pos.append('<div id="block-' + row.id + '" class="unit size1of1 block"></div>');
					pos.find('#block-' + row.id).html(html);
				});

				if (pos.hasClass('horizontal')) {
					sortHorizontal(pos.find('.block'));
				}
			});
			hideEmptyPositions();
		});
	};

	var saveLayout = function() {
		var blocks = [];
		$('.block-position').each(function() {
			var weight = 0;
			var pos = $(this).attr('id');
			$(this).find('.block').each(function(i, e) {
				var id = $(e).attr('id');
				if (pos !== undefined && id !== undefined) {
					blocks.push({
						'bid': id.substring(6),
						'position': pos.substring(4),
						'weight': weight
					});
					weight++;
				}
			});
		});

		$.post(ajaxUrl + '/blocks/save_layout', {route: route, blocks: blocks}, function(resp) {
			saveBtn.button('disable');
			updated = false;
		});
	};

	var makeEditable = function(element) {
		if (editing === true) {
			inlineForm.children(':input').trigger('blur');
			return;
		}
		editing = true;
		editorVal = element.removeClass('block-title').text();
		inlineForm.show().appendTo(element.text('')).children(':input').val(editorVal).focus().select().end();
	};

	var undoEditable = function(v) {
		var element = inlineForm.parent();
		
		editing = false;
		element.addClass('block-title').text(v);
		inlineForm.hide().appendTo($('body'));
	};

	var processInput = function(e) {
		if (editing === false) {
			return;
		}

		var id = $(e).parentsUntil('.block').parent().attr('id').substring('6');
		var title = $(e).val();

		if (id && title && title !== editorVal) {
			updateBlock({'id': id, 'title': title});
		} else {
			undoEditable(editorVal);
		}
		return false;
	};

	var previewBlock = function() {
		// make a copy of block data
		var data = jQuery.extend(true, {}, blockData);
		var form_data = dialogEdit.find('#edit_form').serializeArray();

		$.each(form_data, function() {
			data[this.name] = this.value;
		});

		data.no_wrap = (data.no_wrap > 0) ? true : false;
		data.hide_title = (data.hide_title > 0) ? true : false;

		blockObj.html(template.render(data));
	};

	var undoPreviewBlock = function() {
		blockData.hide_title = (blockData.hide_title > 0) ? true : false;
		blockData.no_wrap = (blockData.no_wrap > 0) ? true : false;
		blockObj.html(template.render(blockData));
	};
	
	var initIconPicker = function() {
		$('.block-icon').iconPicker({
			onSelect: function(item, iconHtml, iconClass) {
				var id = item.parentsUntil('.block').parent().attr('id').substring('6');
				updateBlock({'id': id, 'icon': iconClass});
			}
		});
	};

	var showMessage = function(message) {
		if (message) {
			msgObj.text(message);
			msgObj.fadeIn().delay(3000).fadeOut();
		}
	};

	$(document).ready(function() {
		var copyFrom = '';
		var blocksPanel = {};

		$('#admin-bar').delay(500).slideDown().find('#admin-control').click(function() {
			if (typeof editMode !== "undefined" && editMode) {
				$(this).prev().toggle();
				return false;
			}
		});

		if (typeof editMode !== "undefined" && editMode) {
			initIconPicker();

			inlineForm = $('<form id="inline-form"><input type="text" id="inline-edit" value="" /></form>').hide().appendTo($('body'));

			$('#add-block-panel').find('.primetime-block').button().draggable({
				scroll: true,
				opacity: 0.7,
				helper: 'clone',
				connectToSortable: '.block-position',
				start: function(event, ui) {
					showAllPositions();
				},
				stop: function(event, ui) {
					window.setTimeout(function() {
						if (updated === false) {
							hideEmptyPositions();
						}
					}, 1000);
				}
			});

			blockPositions = $(".block-position").addClass('block-receiver').sortable({
				revert: true,
				placeholder: 'ui-state-highlight cms-block-spacing sorting',
				forcePlaceholderSize: true,
				items: '.block',
				//handle: '.block-title',
				delay: 150,
				dropOnEmpty: true,
				tolerance: 'pointer',
				connectWith: '.block-position',
				cursorAt: {left: 5},
				start: function(event, ui) {
					origin = $(ui.item).addClass('dragging').parent('.horizontal');
					showAllPositions();
				},
				update: function(event, ui) {
					updated = true;
					if ($(ui.item).attr('id') === undefined) {
						var posID = $(this).attr('id').substring('4');
						var blockName = $(ui.item).attr('data-block');
						var replace = $(this).find('div[data-block="' + blockName + '"]');
						blocksPanel.trigger('click');
						addBlock(posID, blockName, replace);
					} else {
						saveBtn.button('enable');
					}
	
					var items = $(ui.item).removeAttr('style').parent('.horizontal').find('.block');
					$(ui.item).removeClass('unit size1of1 size1of2 size1of3 size1of4 size1of5 lastUnit').parent().removeClass('empty-position');

					if (items.length > 0) {
						sortHorizontal(items);
					}
	
					if (origin.attr('id') != $(ui.item).parent('.horizontal').attr('id')) {
						sortHorizontal(origin.find('.block'));
					}
				},
				stop: function(event, ui) {
					$(ui.item).removeClass('dragging');
					hideEmptyPositions();
				}
			}).on('click', '.block-title', function() {
				makeEditable($(this));
			}).on('submit', '#inline-form', function(e) {
				e.preventDefault();
				$(this).find('#inline-edit').trigger('blur');
			}).on('focusout', '#inline-edit', function(e) {
				processInput($(this));
			}).on('click', '.edit-block', function() {
				blockObj = $(this).parentsUntil('.block').parent();
				getEditForm(blockObj);
				return false;
			}).on('click', '.delete-block', function() {
				blockObj = $(this).parentsUntil('.block').parent();
				dialogConfirm.dialog({buttons: dButtons}).dialog('open');
				return false;
			});

			saveBtn = $('#toggle-edit').button({icons: {primary: "ui-icon-wrench"}}).click(function() {
				// exit edit mode
			}).parent().next().children('a').button({icons: {primary: "ui-icon-disk"}, disabled: true}).click(function() {
				// save changes
				saveLayout();
				return false;
			});
			
			$('.has_dropdown').click(function() {
				$(this).parent().find('.has_dropdown').not($(this)).removeClass('dropped');
				blocksPanel = $(this).toggleClass('dropped');
				blocksPanel.next().toggle();
				return false;
			}).next().mouseleave(function() {
				$(this).prev().trigger('click');
			});

			$('#admin-options').show();
			mainContentObj = $('#main-content');
			subcontentObj = $('#pos-subcontent');
			emptyPositionsObj = $(".block-position:not(:has('.block'))").addClass('empty-position');
			template = new t($.trim($('#block-template-container').html()));

			msgObj = $('#ajax-message').ajaxError(function() {
				showMessage(lang.ajaxError);
				return false;
			});

			$(document).ajaxStart(function(){
				$('#loading').fadeIn();
			}).ajaxStop(function(){
				$('#loading').fadeOut('slow');
			});

			eButtons[lang.edit] = function() {
				saveForm(blockObj);
			};

			eButtons[lang.cancel] = function() {
				undoPreviewBlock();
				$(this).dialog('close');
			};

			dButtons[lang.remove] = function() {
				var p = blockObj.parent('.horizontal');
				blockObj.hide("scale", {percent: 5}, 3000).parent().remove();

				var items = p.find('.block');
				if (items.length > 0) {
					sortHorizontal(items);
				}
				hideEmptyPositions();
				saveBtn.button('enable');
				$(this).dialog('close');
			};

			dButtons[lang.cancel] = function() {
				$(this).dialog('close');
			};

			var def_dialog = {
				autoOpen: false,
				modal: true,
				width: 'auto',
				show: 'slide',
				hide: 'slide'
			};

			dialogConfirm = $('#dialog-confirm').dialog(def_dialog);

			// Events for edit block dialog
			dialogEdit = $('#dialog-edit').dialog(def_dialog).on('click', '#class-clear', function(e) {
				dialogEdit.find('#block_class').val('').change();
				return false;
			}).on('click', '#class-select', function(e) {
				dialogEdit.find('#css-class-options').slideToggle();
				return false;
			}).on('click', '.class-cat', function(e) {
				var id = $(this).attr('href');
				var obj = $('#classes-scroller');
				obj.animate({
					scrollTop: obj.scrollTop() + $(id).position().top - 200
				},1000);
				return false;
			}).on('click', '.transform', function(e) {
				var classObj = dialogEdit.find('#block_class');
				var classes = classObj.val();
				classes = ((classes) ? classes + ' ' : '') + $(this).text();
				classObj.val(classes).change();
				return false;
			}).on('change', '.block-preview', function(e) {
				previewBlock();
			});

			// Initiate dialog for block copy
			cButtons[lang.copy] = function() {
				$(this).dialog('close');
				copyBlocks(copyFrom);
			};

			cButtons[lang.cancel] = function() {
				$(this).dialog('close');
			};
			dialogCopy = $('#dialog-copy').dialog(def_dialog);

			// Events for add block dropdown
			$('#copy-form').submit(function(e) {
				e.preventDefault();
				copyFrom = $(this).find('select').val();
				if (copyFrom !== '') {
					blocksPanel.trigger('click');
					dialogCopy.dialog({buttons: cButtons}).dialog('open');
				}
			});

			$('.default-layout').button().click(function() {
				var setDefault = $(this).data('set');
				setDefaultLayout(setDefault);
				if (setDefault === true) {
					$(this).parent().hide().next().hide().next().show();
				} else {
					$(this).parent().hide().prev().hide().prev().show();
				}
				return false;
			});

			$('#route-settings').submit(function(e) {
				setRoutePrefs($(this));
				e.preventDefault();
			});

			$('.editable-block').focusout(function() {
				//alert($(this).html());
			});

			window.onbeforeunload = function (e) {
				if (updated === true) {
					e = e || window.event;
					// For IE and Firefox
					if (e) {
						e.returnValue = lang.leaveConfirm;
					}
					// For Safari
					return lang.leaveConfirm;
				}
			};
			
			var blockTabs = $('#add-block-panel').tabs().parent();

			// fix the classes
			blockTabs.find('.block-bottom-tabs .ui-tabs-nav, .block-bottom-tabs .ui-tabs-nav > *').removeClass('ui-corner-all ui-corner-top').addClass('ui-corner-bottom');

			// move the nav to the bottom
			blockTabs.find('.block-bottom-tabs .ui-tabs-nav').appendTo('.block-bottom-tabs');
		}
	});
})(jQuery);

if (typeof(CKEDITOR) !== 'undefined') {
	CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
	// The "instanceCreated" event is fired for every editor instance created.
	CKEDITOR.on( 'instanceCreated', function( event ) {
		var editor = event.editor,
			element = editor.element;

		// Customize editors for headers and tag list.
		// These editors don't need features like smileys, templates, iframes etc.
		if ( element.is( 'h1', 'h2', 'h3' ) || element.getAttribute( 'id' ) == 'taglist' ) {
			// Customize the editor configurations on "configLoaded" event,
			// which is fired after the configuration file loading and
			// execution. This makes it possible to change the
			// configurations before the editor initialization takes place.
			editor.on( 'configLoaded', function() {

				// Remove unnecessary plugins to make the editor simpler.
				editor.config.removePlugins = 'colorbutton,find,flash,font,' +
					'forms,iframe,image,newpage,removeformat,' +
					'smiley,specialchar,stylescombo,templates';

				// Rearrange the layout of the toolbar.
				editor.config.toolbarGroups = [
					{ name: 'editing',		groups: [ 'basicstyles', 'links' ] },
					{ name: 'undo' },
					{ name: 'clipboard',	groups: [ 'selection', 'clipboard' ] },
					{ name: 'about' }
				];
			});
		}
	});
}