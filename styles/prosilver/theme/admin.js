(function($){
	var editing = false, updated = false;
	var mainContentObj = {}, emptyPositionsObj = {}, subcontentObj = {};
	var containerTemplate = '', chromelessTemplate = '', containerDefClass = '', chromelessDefClass = '';
	var origin = {}, dialogConfirm = {}, dialogEdit = {}, dialogCopy = {}, cButtons = {}, dButtons = {}, eButtons = {}, blockObj = {}, blockData = {}, msgObj = {}, saveBtn = {};

	var sortHorizontal = function(items) {
		var numItems = items.length;
		var numCols = (items.parent().attr('data-columns') !== undefined) ? ((items.parent().attr('data-columns') <= 5) ? items.parent().attr('data-columns') : 5) : 3;
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

		var divClass = 'size1of' + numCols;
		items.removeClass('size1of1 size1of2 size1of3 size1of4 size1of5');

		if (divisibleItems > 0) {
			items.slice(0, divisibleItems).addClass(divClass);
		}

		if (itemsLeft) {
			items.slice(divisibleItems, numItems).addClass('size1of' + itemsLeft);
		}
	};

	var showAllPositions = function() {
		mainContentObj.removeClass('lastUnit');
		emptyPositionsObj.removeClass('empty-position');
	};

	var hideEmptyPositions = function() {
		emptyPositionsObj = $(".block-position:not(:has('.sortable'))").addClass('empty-position');
		if (!subcontentObj.find('.sortable').size()) {
			mainContentObj.addClass('lastUnit');
		}
	};

	var template = function(tokens, tpl) {
		return tpl.replace(/<%=(.+?)%>/g, function(token, match) {
			return (tokens[match] !== undefined) ? tokens[match] : '';
		});
	};

	var addBlock = function(posID, blockName, droppedElement) {
		$(droppedElement).removeAttr('role aria-disabled data-block class style')
			.addClass('sortable unit size1of1')
			.html('<div class="ui-state-highlight cms-block-spacing sorting" style="padding: 5px"><i class="-icon-spinner -icon-spin"></i> ' + lang.ajaxLoading + '</div>');

		$.getJSON(ajaxUrl + '/blocks/add', {block: $.trim(blockName), weight: droppedElement.index(), route: route, position: posID}, function(data) {
			updated = false;
			if (data.id === null) {
				$(droppedElement).remove();
				return;
			}

			var html = template(data, containerTemplate);
			$(droppedElement).attr('id', 'block-' + data.id).html(html).children().show("scale", {percent: 100}, 1000);
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

			block.find('.cms-block-content').html(resp.content);
			dialogEdit.dialog('close');
		});
	};

	var updateBlock = function(mode, data) {
		$.post(ajaxUrl + '/blocks/' + mode + '?route=' + route, data,
			function(resp){
				if (!resp.error) {
					if (mode === 'update' && resp.title) {
						undoEditable(resp.title);
					}
				} else {
					showMessage(resp.error);
					if (mode === 'update') {
						undoEditable(editorVal);
					}
				}
			},
			"json"
		);
	};

	var copyBlocks = function(copyFrom) {
		var position = $('.block-position');
		$.getJSON(ajaxUrl + '/blocks/copy', {copy: copyFrom, route: route}, function(resp) {
			if (resp.data.length === 0) {
				return;
			}

			showAllPositions();
			position.empty();

			$.each(resp.data, function(position, data) {
				var pos = $('#pos-' + position);
				$.each(data, function(idx, row) {
					var tpl = (row.no_wrap > 0) ? chromelessTemplate : containerTemplate;
					var html = template(row, tpl);

					pos.append('<div id="block-' + row.id + '" class="sortable unit size1of1"></div>');
					pos.find('#block-' + row.id).html(html);
				});

				if (pos.hasClass('horizontal')) {
					sortHorizontal(pos.find('.sortable'));
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
			$(this).find('.sortable').each(function(i, e) {
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
		editor.parent().replaceWith('<span class="editable_block_title">' + v + '</span>');
	};

	var processInput = function(e) {
		if (editing === false) {
			return;
		}

		var id = $(e).parentsUntil('.sortable').parent().attr('id').substring('6');
		var title = $(e).val();

		if (id && title && title !== editorVal) {
			updateBlock('update', {'id': id, 'title': title});
		} else {
			undoEditable(editorVal);
		}
		return false;
	};

	var previewBlock = function(tpl) {
		var data = jQuery.extend(true, {}, blockData);
		data['class'] = dialogEdit.find('#block_class').val();
		blockObj.html(template(data, tpl));
	};

	var undoPreviewBlock = function() {
		var tpl = (blockData.no_wrap > 0) ? chromelessTemplate : containerTemplate;
		blockObj.html(template(blockData, tpl));
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
		var iconsDiv = $('#icons');

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

		$('.block-position').sortable({
			revert: true,
			cursor: 'move',
			placeholder: 'ui-state-highlight cms-block-spacing sorting',
			forcePlaceholderSize: true,
			items: '.sortable',
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

				var items = $(ui.item).removeAttr('style').parent('.horizontal').find('.sortable');
				$(ui.item).parent().removeClass('empty-position');

				if (items.length > 0) {
					sortHorizontal(items);
				} else {
					$(ui.item).removeClass('size1of2 size1of3').addClass('size1of1');
				}

				if (origin.attr('id') != $(ui.item).parent('.horizontal').attr('id')) {
					sortHorizontal(origin.find('.sortable'));
				}
			},
			stop: function(event, ui) {
				$(ui.item).removeClass('dragging');
				hideEmptyPositions();
			}
		}).on('click', '.editable_block_title', function() {
			iconsDiv.slideUp();
			makeEditable($(this));
		}).on('submit', '#inline-form', function(e) {
			e.preventDefault();
			$(this).find('#inline-edit').trigger('blur');
		}).on('focusout', '#inline-edit', function(e) {
			processInput($(this));
		}).on('click', '.edit-block', function() {
			blockObj = $(this).parentsUntil('.sortable').parent();
			getEditForm(blockObj);
			return false;
		}).on('click', '.delete-block', function() {
			blockObj = $(this).parentsUntil('.sortable').parent();
			dialogConfirm.dialog({buttons: dButtons}).dialog('open');
			return false;
		}).on('click', '.icon-select', function(e) {
			var pos = $(this).offset();
			var height = $(this).height();
			e.stopImmediatePropagation();

			if (editing) {
				processInput($('#inline-edit'));
			}

			blockObj = $(this).parentsUntil('.sortable').parent();
			iconsDiv.slideToggle().offset({
				top: pos.top + height - 1,
				left: pos.left
			});
			return false;
		});

		saveBtn = $('#toggle-edit').button({icons: {primary: "ui-icon-wrench"}}).click(function() {
			// exit edit mode
		}).parent().next().children('a').button({icons: {primary: "ui-icon-disk"}, disabled: true}).click(function() {
			// save changes
			saveLayout();
			return false;
		});

		$('#admin-bar').delay(500).slideDown().find('#admin-control').click(function() {
			if (typeof editMode !== "undefined" && editMode) {
				$(this).next().toggle();
				return false;
			}
		});
		
		$('.has_dropdown').click(function() {
			$(this).parent().find('.has_dropdown').not($(this)).removeClass('dropped');
			blocksPanel = $(this).toggleClass('dropped');
			blocksPanel.next().toggle();
			return false;
		}).next().mouseleave(function() {
			$(this).prev().trigger('click');
		});

		if (typeof editMode !== "undefined" && editMode) {
			$('#admin-options').show();
			mainContentObj = $('#main-content');
			subcontentObj = $('#pos-subcontent');
			emptyPositionsObj = $(".block-position:not('.sortable')");
			containerTemplate = $("#block-template-container").html();
			chromelessTemplate = $("#block-template-chromeless").html();

			iconsDiv.mouseleave(function() {
				iconsDiv.slideUp();
			}).children().find('i').click(function(){
				var icon = $(this).attr('class');
				blockObj.find('.icon-select').children('i').attr('class', icon);
				updateBlock('update', {'id': blockObj.attr('id').substring(6), 'icon': icon});
				iconsDiv.slideUp();
				return false;
			});

			iconsDiv.children('.icon-cat-ops').find('a').click(function(){
				var id = $(this).attr('href');
				var obj = $('#icons-list');
				obj.animate({
					scrollTop: obj.scrollTop() + $(id).position().top
				},1000);
				return false;
			});

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

				var items = p.find('.sortable');
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
			}).on('click', '.classes-control', function(e) {
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
			}).on('change', '#block_class', function(e) {
				var tpl = (dialogEdit.find('input[name=no_wrap]:checked').val() > 0) ? chromelessTemplate : containerTemplate;
				previewBlock(tpl);
			}).on('change', '.show-container', function(e) {
				var tpl = ($(this).val() > 0) ? chromelessTemplate : containerTemplate;
				previewBlock(tpl);
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
			
			$('#add-block-panel').tabs();
			$(".tabs-bottom .ui-tabs-nav, .tabs-bottom .ui-tabs-nav > *").removeClass("ui-corner-all ui-corner-top").addClass( "ui-corner-bottom" );
			$(".tabs-bottom .ui-tabs-nav").appendTo(".tabs-bottom");
		}
	});
})(jQuery);