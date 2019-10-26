/* global $ */
import LayoutPreviewer from '../../components/LayoutPreviewer';

import 'jquery-ui/ui/widgets/accordion';
import 'jquery-ui/themes/base/core.css';
import 'jquery-ui/themes/base/theme.css';
import 'jquery-ui/themes/base/accordion.css';
import '../../components/Icons/picker';
import './settings.scss';

$(document).ready(() => {
	LayoutPreviewer();

	$('#acp_settings')
		// Init icon picker
		.iconPicker({
			selector: '.icon-select',
			onSelect: ($item, iconClass) => $item.prev().val(iconClass),
		})
		// make settings sections in accordion
		.accordion({
			active: -1,
			collapsible: true,
			heightStyle: 'content',
		});
});
