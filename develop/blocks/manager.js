;(function($, window, document, undefined) {
	'use strict';

	var editorVal = '';
	var editing = false;
	var updated = false;
	var dialogEditOpened = false;
	var blockPositions = {};
	var mainContentObj = {};
	var emptyPositionsObj = {};
	var subcontentObj = {};
	var template = {};
	var origin = {};
	var inlineForm = {};
	var dialogConfirm = {};
	var dialogEdit = {};
	var dialogCopy = {};
	var cButtons = {};
	var dButtons = {};
	var eButtons = {};
	var lButtons = {};
	var blockObj = {};
	var blockData = {};
	var msgObj = {};
	var saveBtn = {};

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
					if (numItems % (numCols - i) === 0) {
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
					.addClass('lastUnit');
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
		emptyPositionsObj = $('.block-position:not(:has(".block"))').addClass('empty-position');
		if (!subcontentObj.find('.block').size()) {
			mainContentObj.addClass('lastUnit');
		}
	};

	var addBlock = function(posID, blockName, droppedElement) {
		$(droppedElement).removeAttr('role aria-disabled data-block class style')
			.addClass('block')
			.html('<div class="ui-state-highlight cms-block-spacing sorting" style="padding: 5px"><i class="fa fa-spinner fa-2x fa-spin"></i> ' + lang.ajaxLoading + '</div>');

		$.getJSON(ajaxUrl + 'add', {block: $.trim(blockName), weight: droppedElement.parent().find('.block').index(droppedElement), route: route, ext: ext, position: posID}, function(data) {
			updated = false;
			if (data.id === '') {
				$(droppedElement).remove();
				return;
			}

			var html = template.render(data);
			$(droppedElement).attr('id', 'block-' + data.id).html(html).children().not('.block-controls').show('scale', {percent: 100}, 1000);
			initIconPicker();
			initTinyMce();
		});
	};

	var getEditForm = function(block) {
		$.getJSON(ajaxUrl + 'edit', {id: block.attr('id').substring(6)}, function(resp) {
			blockData = resp;
			if (resp.form) {
				dialogEdit.html(resp.form);
				dialogEdit.find('#block-settings').tabs();
				dialogEdit.find('select[data-togglable-settings]').each(function() {
					var $this = $(this);

					$this.change(function() {
						phpbb.toggleSelectSettings($this);
					});
					phpbb.toggleSelectSettings($this);
				});
				dialogEdit.dialog({buttons: eButtons}).dialog('option', 'title', lang.edit + ' - ' + resp.title).dialog('open');
			}
		});
	};

	var saveForm = function(block) {
		var form = $('#edit_form');
		var updateSimilar = dialogEdit.dialog('widget').find('#update-similar:checked').length;

		$.getJSON(ajaxUrl + 'save?route=' + route + '&id=' + block.attr('id').substring(6) + '&similar=' + updateSimilar + '&' + form.serialize(), function(resp) {
			if (resp.id === '') {
				return;
			}

			block.html(template.render(resp));
			dialogEdit.dialog('close');
		});
	};

	var updateBlock = function(data) {
		if (data.id === undefined) {
			return false;
		}
		$.post(ajaxUrl + 'update' + '?route=' + route, data,
			function(resp) {
				if (editing === true) {
					undoEditable(resp.title);
				}
			},
			'json'
		);
	};

	var customBlockAction = function(data) {
		if (data.id === undefined) {
			return;
		}

		$.getJSON(ajaxUrl + 'custom', data, function(resp) {
			if (typeof phpbb.ajaxCallbacks[resp.callback] === 'function') {
				phpbb.ajaxCallbacks[resp.callback].call(undefined, resp);
			}
		});
	};

	var setDefaultLayout = function(set) {
		$.post(ajaxUrl + 'set_default' + '?route=' + ((set === true) ? route : ''));
	};

	var setStartPage = function(info) {
		$.post(ajaxUrl + 'set_startpage', $.param(info));
	};

	var setRoutePrefs = function(form) {
		$.post(ajaxUrl + 'layout_settings' + '?route=' + route + '&ext=' + ext, form.serialize());
	};

	var copyBlocks = function(copyFrom) {
		var position = $('.block-position');
		$.getJSON(ajaxUrl + 'copy_layout?route=' + route + '&ext=' + ext + '&' + $.param(copyFrom), function(resp) {
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

		$.post(ajaxUrl + 'save_layout', {route: route, blocks: blocks}, function(resp) {
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
		editorVal = '';
		element.addClass('block-title').text(v);
		inlineForm.hide().appendTo($('body'));
	};

	var processInput = function(e) {
		if (editing === false) {
			return;
		}

		var id = $(e).parentsUntil('.block').parent().attr('id').substring('6');
		var title = $(e).val();

		if (id && title !== editorVal) {
			updateBlock({'id': id, 'field': 'title', 'title': title});
		} else {
			undoEditable(editorVal);
		}
		return false;
	};

	var previewBlock = function() {
		// make a copy of block data
		var data = jQuery.extend(true, {}, blockData);
		var formData = dialogEdit.find('#edit_form').serializeArray();

		$.each(formData, function() {
			data[this.name] = this.value;
		});

		blockObj.html(template.render(data));
	};

	var undoPreviewBlock = function() {
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

	var initTinyMce = function() {
		tinymce.init({
			'selector': 'div.editable-block',
			'inline': true,
			'plugins': [
				'advlist autolink lists link image charmap print preview anchor',
				'searchreplace visualblocks code fullscreen',
				'insertdatetime media table contextmenu paste'
			],
			'valid_elements' : '*[*]',
			'toolbar': 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
			'setup': function(editor) {
				var editorPreview = '';
				var editorContent = '';
				editor.on('blur', function(e) {
					var content = editor.getContent({format: 'raw'});
					var data = $('#' + editor.id).data('raw', content).data();

					if (content.length > 0) {
						if (content !== editorContent && content !== lang.placeholder) {
							data.id = editor.id.substring(13);
							data.content = content;

							customBlockAction(data);
						} else {
							editor.setContent(editorPreview);
						}
					} else {
						editor.setContent(lang.placeholder);
					}
				});

				editor.on('init', function() {
					if (editor.getContent().length === 0) {
						editor.setContent(lang.placeholder);
					}
				});

				editor.on('focus', function() {
					editorContent = $('#' + editor.id).data('raw');
					editorPreview = editor.getContent({format: 'raw'});
					editor.setContent(editorContent);
				});
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

		$('#admin-bar').delay(300).slideDown().find('#admin-control').click(function() {
			if (typeof editMode !== undefined && editMode) {
				$(this).prev().toggle();
				return false;
			}
		});

		if (typeof editMode !== undefined && editMode) {
			inlineForm = $('<form class="inline-form"><input type="text" class="inline-edit" value="" /></form>').hide().appendTo($('body'));

			$('#add-block-panel').find('.primetime-block').draggable({
				scroll: true,
				revert: true,
				addClasses: false,
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

			var exPositions = $('#ex_positions');
			blockPositions = $('.block-position').addClass('block-receiver').sortable({
				revert: true,
				placeholder: 'ui-state-highlight cms-block-spacing sorting',
				forcePlaceholderSize: true,
				items: '.block',
				cancel: '.editable-block',
				delay: 150,
				dropOnEmpty: true,
				tolerance: 'pointer',
				connectWith: '.block-position',
				cursorAt: {left: 5},
				start: function(event, ui) {
					origin = $(ui.item).addClass('dragging').parent('.horizontal');
					showAllPositions();
					blockPositions.sortable('refresh');
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
					$('body').trigger('layoutChanged');
				}
			}).on('click', '.block-title', function() {
				makeEditable($(this));
			}).on('submit', '.inline-form', function(e) {
				e.preventDefault();
				$(this).find('.inline-edit').trigger('blur');
			}).on('focusout', '.inline-edit', function(e) {
				processInput($(this));
			}).on('click', '.edit-block', function(e) {
				e.preventDefault();
				blockObj = $(this).parentsUntil('.block').parent();
				getEditForm(blockObj);
			}).on('click', '.delete-block', function(e) {
				e.preventDefault();
				blockObj = $(this).parentsUntil('.block').parent();
				dialogConfirm.dialog({buttons: dButtons}).dialog('open');
			}).each(function(i, pos) {
				var p = $(pos).attr('id').substring('4');
				if (exPositions.find('option[value=' + p + ']').length === 0) {
					exPositions.append('<option value="' + p + '">' + p + '</option>');
				}
			});

			phpbb.addAjaxCallback('previewCustomBlock', function(data) {
				$('#block-editor-' + data.id).html(data.content.replace('./../../', ''));
			});

			saveBtn = $('#toggle-edit').button().click(function() {
				// exit edit mode
			}).parent().next().children('a').button({disabled: true}).click(function(e) {
				// save changes
				e.preventDefault();
				saveLayout();
			});

			$('.has_dropdown').click(function(e) {
				e.preventDefault();
				$(this).parentsUntil('ul').parent().find('.dropped').not($(this)).removeClass('dropped').next().hide();
				blocksPanel = $(this).toggleClass('dropped');
				blocksPanel.next().toggle();
			}).next().mouseleave(function() {
				//$(this).prev().trigger('click');
			});

			$('#admin-options').show();
			mainContentObj = $('#main-content');
			subcontentObj = $('#pos-subcontent');
			emptyPositionsObj = $('.block-position:not(:has(".block"))').addClass('empty-position');
			template = twig({
				data: $.trim($('#block-template-container').html())
			});

			msgObj = $('#ajax-message').ajaxError(function(e) {
				e.preventDefault();
				showMessage(lang.ajaxError);
			});

			$(document).ajaxStart(function() {
				$('#loading').fadeIn();
			}).ajaxStop(function() {
				$('#loading').fadeOut('slow');
			});

			// add style id to ajax requests
			$(document).ajaxSend(function(event, xhr, settings) {
				settings.url += ((settings.url.indexOf('?') < 0) ? '?' : '&') + 'style=' + style;
			});

			// Display any returned message
			$(document).ajaxSuccess(function(event, xhr, settings, data) {
				var message = (data.message) ? data.message : data.errors;
				if (message) {
					$('#loading').hide();
					showMessage(message);
				}
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
				blockObj.hide('scale', {percent: 5}, 3000).parent().remove();

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

			var defDialog = {
				autoOpen: false,
				modal: true,
				width: 'auto',
				show: 'slide',
				hide: 'slide'
			};

			dialogConfirm = $('#dialog-confirm').dialog(defDialog);

			// Delete all blocks
			lButtons[lang.deleteAll] = function() {
				$(this).dialog('close');
				$('.block-position').empty();
				hideEmptyPositions();
				saveBtn.button('enable');
				updated = true;
			};

			lButtons[lang.cancel] = function() {
				$(this).dialog('close');
			};

			var dialogDeleteAll = $('#dialog-delete-all').dialog(defDialog);
			var deleteAll = $('#delete-blocks').button().click(function(e) {
				e.preventDefault();
				dialogDeleteAll.dialog({buttons: lButtons}).dialog('open');
			});

			// Initiate dialog for block copy
			cButtons[lang.copy] = function() {
				$(this).dialog('close');
				copyBlocks(copyFrom);
				deleteAll.parent().show();
			};

			cButtons[lang.cancel] = function() {
				$(this).dialog('close');
			};

			// Events for add block dropdown
			dialogCopy = $('#dialog-copy').dialog(defDialog);
			$('#copy-form').find('.layout-action').button().click(function(e) {
				e.preventDefault();
				copyFrom = $(this).parent().parent().serializeArray();

				var fromRoute = copyFrom[0].value;
				var fromStyle = copyFrom[1].value;
				var layoutAction = $(this).data('action');

				if (fromRoute === '' || (fromRoute ==  route && fromStyle == style)) {
					return false;
				}

				if (layoutAction == 'copy') {
					blocksPanel.trigger('click');
					dialogCopy.dialog({buttons: cButtons}).dialog('open');
				} else {
					var url = '';

					url += ((fromRoute.substring(0, 1) == '/') ? appUrl : boardUrl + '/') + fromRoute;
					url += ((url.indexOf('?') >= 0) ? '&' : '?') + 'style=' + fromStyle + '&edit_mode=1';

					location.href = url;
				}
			});

			// Events for edit block dialog
			defDialog.open = function(e, ui) {
				if (dialogEditOpened === false) {
					var pane = $(this).dialog('widget').find('.ui-dialog-buttonpane');
					dialogEditOpened = true;
					$('<label class="dialog-check-button"><input id="update-similar" type="checkbox" checked="checked" />' + lang.updateSimilar + '</label>').prependTo(pane);
				}
			};
			dialogEdit = $('#dialog-edit').dialog(defDialog).on('click', '.block-class-actions', function(e) {
				e.preventDefault();
				switch ($(this).data('action')) {
					case 'clear':
						dialogEdit.find('#block_class').val('').change();
						e.preventDefault();
					break;
					case 'toggle':
						dialogEdit.find('#css-class-options').slideToggle();
						e.preventDefault();
					break;
				}
			}).on('click', '.class-cat', function(e) {
				var id = $(this).attr('href');
				var obj = $('#classes-scroller');
				obj.animate({
					scrollTop: obj.scrollTop() + $(id).position().top - 200
				}, 1000);
				e.preventDefault();
			}).on('click', '.transform', function(e) {
				var classObj = dialogEdit.find('#block_class');
				var classes = classObj.val();
				classes = ((classes) ? classes + ' ' : '') + $(this).text();
				classObj.val(classes).change();
				e.preventDefault();
			}).on('change', '.block-preview', function(e) {
				previewBlock();
			});

			$('.default-layout').button().click(function(e) {
				var setDefault = $(this).data('set');
				setDefaultLayout(setDefault);
				e.preventDefault();
				if (setDefault === true) {
					// set as default
					$(this).parent().hide().next().hide().next().show();
					deleteAll.parent().hide();
				} else {
					// remove as default
					$(this).parent().hide().prev().hide().prev().show();
					deleteAll.parent().show();
				}
			});

			$('.pt-startpage').button().click(function(e) {
				e.preventDefault();
				var info = {};
				if ($(this).attr('id') == 'set-startpage') {
					// set as startpage
					$(this).parent().hide().next().show();
					info = {
						controller: $(this).data('controller'),
						method: $(this).data('method'),
						params: $(this).data('params'),
					};
					setStartPage(info);
				} else {
					// remove as startpage
					$(this).parent().hide().prev().show();
					setStartPage(info);
				}
			});

			$('#route-settings').submit(function(e) {
				setRoutePrefs($(this));
				e.preventDefault();
			});

			window.onbeforeunload = function(e) {
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

			initIconPicker();
			initTinyMce();
		}
	});
})(jQuery, window, document);