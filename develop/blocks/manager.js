;(function($, window, document, undefined) {
	'use strict';

	var editorVal = '';
	var editing = false;
	var updated = false;
	var dialogEditOpened = false;
	var blockPositions = {};
	var emptyPositionsObj = {};
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

	// These variables are defined in template file
	var lang = {};
	var config = {};
	var editMode = false;

	// These objects are provided by third-party scripts
	var phpbb = {};
	var tinymce = {};
	var twig = {};

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

		removeGrid(items);

		if (divisibleItems > 0) {
			items.slice(0, divisibleItems).addClass('grid__col grid__col--1-of-' + numCols);
		}

		if (itemsLeft) {
			var n = 1;
			if (itemsLeft < 2) {
				n = 5;
				itemsLeft = 5;
			}
			items.slice(divisibleItems, numItems)
				.addClass('grid__col grid__col--' + n + '-of-' + itemsLeft);
		}
	};

	var removeGrid = function(items) {
		items.removeClass(function() {
			var matches = this.className.match(/grid__col+(\S+)?/gi);
			return (matches) ? matches.join(' ') : '';
		});
	};

	var showAllPositions = function() {
		blockPositions.addClass('show-position');
		emptyPositionsObj.removeClass('empty-position').siblings('.grid__col').removeClass('lastUnit');
	};

	var hideEmptyPositions = function() {
		blockPositions.removeClass('show-position');
		emptyPositionsObj = $('.block-position:not(:has(".block"))').addClass('empty-position').each(function(i, pos) {
			$(pos).siblings('.grid__col').last().addClass('lastUnit');
		});
	};

	var addBlock = function(posID, blockName, droppedElement) {
		$(droppedElement).removeAttr('role aria-disabled data-block class style')
			.addClass('block')
			.html('<div class="ui-state-highlight sm-block-spacing sortable" style="padding: 5px"><i class="fa fa-spinner fa-2x fa-spin"></i> ' + lang.ajaxLoading + '</div>');

		var data = {
			block: $.trim(blockName),
			weight: droppedElement.parent().find('.block').index(droppedElement),
			route: config.route,
			ext: config.ext,
			position: posID
		};

		$.getJSON(config.ajaxUrl + '/blocks/add_block', data, function(result) {
			updated = false;
			if (result.id === '') {
				$(droppedElement).remove();
				return;
			}

			var html = template.render(result);
			$(droppedElement).attr('id', 'block-' + result.id).html(html).children().not('.block-controls').show('scale', {percent: 100}, 1000);
			initIconPicker();
			initTinyMce();
		});
	};

	var getEditForm = function(block) {
		$.getJSON(config.ajaxUrl + '/blocks/edit_block', {id: block.attr('id').substring(6)}, function(resp) {
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

		$.getJSON(config.ajaxUrl + '/blocks/save_block?route=' + config.route + '&id=' + block.attr('id').substring(6) + '&similar=' + updateSimilar + '&' + form.serialize(), function(resp) {
			dialogEdit.dialog('close');

			$.each(resp, function(i, data) {
				$('#block-' + data.id).html(template.render(data));
			});
		});
	};

	var updateBlock = function(data) {
		if (data.id === undefined) {
			return false;
		}
		$.post(config.ajaxUrl + '/blocks/update_block' + '?route=' + config.route, data,
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

		$.getJSON(config.ajaxUrl + '/blocks/handle_custom_action', data, function(resp) {
			if (typeof phpbb.ajaxCallbacks[resp.callback] === 'function') {
				phpbb.ajaxCallbacks[resp.callback].call(undefined, resp);
			}
		});
	};

	var setDefaultLayout = function(set) {
		$.post(config.ajaxUrl + '/blocks/set_default_route' + '?route=' + ((set === true) ? config.route : ''));
	};

	var setStartPage = function(info) {
		$.post(config.ajaxUrl + '/blocks/set_startpage', $.param(info));
	};

	var setRoutePrefs = function(form) {
		$.post(config.ajaxUrl + '/blocks/set_route_prefs' + '?route=' + config.route + '&ext=' + config.ext, form.serialize());
	};

	var copyBlocks = function(copyFrom) {
		var position = $('.block-position');
		$.getJSON(config.ajaxUrl + '/blocks/copy_route?route=' + config.route + '&ext=' + config.ext + '&' + $.param(copyFrom), function(resp) {
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
		var blocks = {};
		$('.block-position').each(function() {
			var weight = 0;
			var pos = $(this).attr('id');
			$(this).find('.block').each(function(i, e) {
				var id = $(e).attr('id');
				if (pos !== undefined && id !== undefined) {
					var bid = id.substring(6);
					blocks[bid] = {
						'position': pos.substring(4),
						'weight': weight
					};
					weight++;
				}
			});
		});

		$.post(config.ajaxUrl + '/blocks/save_blocks', {route: config.route, blocks: blocks}, function() {
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
		editorVal = element.removeClass('editable').text();
		inlineForm.show().appendTo(element.text('')).children(':input').val(editorVal).focus().select().end();
	};

	var undoEditable = function(v) {
		var element = inlineForm.parent();

		editing = false;
		editorVal = '';
		element.addClass('editable').text(v);
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
			'image_advtab': true,
			'plugins': [
				'advlist autolink lists link image imagetools charmap anchor',
				'visualblocks code hr',
				'media table contextmenu paste'
			],
			'valid_elements': '*[*]',
			'toolbar': 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | hr link image | code',
			'setup': function(editor) {
				var editorPreview = '';
				var editorContent = '';
				editor.on('blur', function() {
					var content = editor.getContent({format: 'raw'});

					if (editor.getContent().length > 0) {
						var data = $('#' + editor.id).data('raw', content).data();

						if (content !== editorContent && content !== lang.placeholder) {
							data.id = editor.id.substring(13);
							data.content = content;

							customBlockAction(data);
						} else {
							editor.setContent(editorPreview);
						}
					} else if (editorPreview) {
						editor.setContent(editorPreview);
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
			msgObj.html(message);
			msgObj.fadeIn().delay(3000).fadeOut();
		}
	};

	var showCurrentState = function(hidingBlocks, positions) {
		if (hidingBlocks) {
			showMessage('<span><i class="fa fa-info-circle fa-blue fa-lg"></i> ' + lang.hidingBlocks + '</span>');
		} else if (positions.length) {
			showMessage('<span><i class="fa fa-info-circle fa-blue fa-lg"></i> ' + lang.hidingPos + ': <strong>' + positions.join(', ') + '</strong></span>');
		}
	};

	$(document).ready(function() {
		editMode = window.editMode || false;
		lang = window.lang || {};
		phpbb = window.phpbb || {};
		tinymce = window.tinymce || {};
		twig = window.twig || {};
		config = window.config || {
			ajaxUrl: '',
			boardUrl: '',
			route: '',
			ext: '',
			style: ''
		};

		var copyFrom = '';
		var blocksPanel = {};
		var exPositions = {};
		var overPosition = {};
		var isHidingBlocks = false;

		var loader = $('#admin-bar').delay(300).slideDown().find('#admin-control').click(function() {
			if (editMode) {
				$(this).prev().toggle();
				return false;
			}
		}).find('i');

		if (editMode) {
			inlineForm = $('<form class="inline-form"><input type="text" class="inline-edit" value="" /></form>').hide().appendTo($('body'));

			msgObj = $('#ajax-message');
			emptyPositionsObj = $('.block-position:not(:has(".block"))').addClass('empty-position');

			template = twig({
				data: $.trim($('#block-template-container').html())
			});

			$('#add-block-panel').find('.sitemaker-block').draggable({
				addClasses: false,
				iframeFix: true,
				opacity: 0.7,
				helper: 'clone',
				appendTo: 'body',
				revert: 'invalid',
				connectToSortable: '.block-position',
				start: function(event, ui) {
					$(ui.helper).addClass('dragging');
					showAllPositions();
					blockPositions.sortable('refresh');
					blocksPanel.trigger('click');
				},
				stop: function() {
					window.setTimeout(function() {
						if (updated === false) {
							hideEmptyPositions();
						}
					}, 600);
				}
			});

			exPositions = $('#ex_positions');
			blockPositions = $('.block-position').addClass('block-receiver').sortable({
				revert: true,
				placeholder: 'ui-state-highlight grid__col sm-block-spacing block sortable placeholder',
				connectWith: '.block-position',
				cancel: '.editable-block, .inline-edit',
				items: '.block',
				tolerance: 'pointer',
				cursor: 'move',
				cursorAt: {
					top: -10,
					left: -10
				},
				start: function(event, ui) {
					origin = $(ui.item).addClass('dragging').parent('.horizontal');
					showAllPositions();
					blockPositions.sortable('refresh');
				},
				over: function(event, ui) {
					overPosition = ui.placeholder.parent('.horizontal').children('.block').addClass('sortable');
				},
				out: function() {
					if ($.isEmptyObject(overPosition) === false) {
						overPosition.removeClass('sortable');
					}
				},
				update: function(event, ui) {
					updated = true;
					if ($(ui.item).attr('id') === undefined) {
						var posID = $(this).attr('id').substring('4');
						var blockName = $(ui.item).attr('data-block');
						var replace = $(this).find('div[data-block="' + blockName + '"]');
						addBlock(posID, blockName, replace);
					} else {
						saveBtn.button('enable');
					}

					var items = $(ui.item).removeAttr('style').parent('.horizontal').children('.block');
					var item = $(ui.item);

					item.parent().removeClass('empty-position');
					removeGrid(item);

					if (items.length > 0) {
						sortHorizontal(items);
					}

					if (origin.attr('id') !== $(ui.item).parent('.horizontal').attr('id')) {
						sortHorizontal(origin.find('.block').removeClass('sortable'));
					}
				},
				stop: function(event, ui) {
					$(ui.item).removeClass('dragging sortable').removeAttr('style');
					hideEmptyPositions();
					$('body').trigger('layoutChanged');
				}
			}).on('click', '.block-title', function() {
				makeEditable($(this));
			}).on('submit', '.inline-form', function(e) {
				e.preventDefault();
				$(this).find('.inline-edit').trigger('blur');
			}).on('focusout', '.inline-edit', function() {
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

			$('.has-dropdown').click(function(e) {
				e.preventDefault();
				$(this).parentsUntil('ul').parent().find('.dropped').not($(this)).removeClass('dropped').next().hide();
				blocksPanel = $(this).toggleClass('dropped');
				blocksPanel.next().toggle();
			}).next().mouseleave(function() {
				//$(this).prev().trigger('click');
			});

			$('#admin-options').show(100, function() {
				var exPos = $.grep(exPositions.val(), function(str) {
					return str.length;
				});
				showCurrentState(isHidingBlocks, exPos);
			});

			$.ajaxSetup({
				// add style id to ajax requests
				'beforeSend': function(xhr, settings) {
					loader.addClass('fa-spinner fa-green fa-spin fa-lg fa-pulse');
					settings.url += ((settings.url.indexOf('?') < 0) ? '?' : '&') + 'style=' + config.style;
				},
				'complete': function() {
					loader.delay(1000).removeClass('fa-spinner fa-green fa-spin fa-lg fa-pulse');
				},
				// Display any returned message
				'success': function(data) {
					var message = (data.message) ? data.message : data.errors;
					if (message) {
						$('#loading').hide();
						showMessage(message);
					}
				},
				'error': function() {
					showMessage(lang.ajaxError);
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

				if (fromRoute === '' || (fromRoute ===  config.route && fromStyle === config.style)) {
					return false;
				}

				if (layoutAction === 'copy') {
					blocksPanel.trigger('click');
					dialogCopy.dialog({buttons: cButtons}).dialog('open');
				} else {
					var url = '';

					url += ((fromRoute.substring(0, 1) === '/') ? config.ajaxUrl : config.boardUrl + '/') + fromRoute;
					url += ((url.indexOf('?') >= 0) ? '&' : '?') + 'style=' + fromStyle + '&edit_mode=1';

					location.href = url;
				}
			});

			// Events for edit block dialog
			defDialog.open = function() {
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
					break;
					case 'toggle':
						dialogEdit.find('#css-class-options').slideToggle();
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
			}).on('change', '.block-preview', function() {
				previewBlock();
			});

			// Set default layout
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

			// Set start page
			$('.sm-startpage').button().click(function(e) {
				e.preventDefault();
				var info = {};
				if ($(this).attr('id') === 'set-startpage') {
					// set as startpage
					$(this).parent().hide().next().show();
					info = {
						controller: $(this).data('controller'),
						method: $(this).data('method'),
						params: $(this).data('params')
					};
					setStartPage(info);
				} else {
					// remove as startpage
					$(this).parent().hide().prev().show();
					setStartPage(info);
				}
			});

			isHidingBlocks = $('#route-settings').submit(function(e) {
				setRoutePrefs($(this));
				e.preventDefault();
			}).find('#hide_blocks').is(':checked');

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