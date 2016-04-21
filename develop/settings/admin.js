/* global jQuery */
;(function($, window, document, undefined) {
	'use strict';

	var preview;
	var currPreview = '';

	var showPreview = function(layout) {
		if (layout !== currPreview) {
			preview.attr('src', layout + 'preview.png');
			currPreview = layout;
		}
	};

	$(document).ready(function() {
		preview = $('.layout-preview').find('img');

		$('.style-layouts > dl').hover(function(e) {
			var layout = $(e.currentTarget).data('layout');
			showPreview(layout);
		}).find('.layout-option').change(function() {
			var layout = $(this).val();
			$(this).parentsUntil('dl').parent().data('layout', layout);
		});

		// Init icon picker
		$('#acp_settings').iconPicker({
			selector: '.icon-select',
			onSelect: function(item, iconHtml, iconClass) {
				item.prev().val(iconClass);
			}
		});
	});
})(jQuery, window, document);