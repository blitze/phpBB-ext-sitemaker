/* global $ */
import LayoutPreviewer from '../../components/LayoutPreviewer';
import '../../components/Icons/picker';
import './settings.scss';

$(document).ready(() => {
	LayoutPreviewer();

	// Init icon picker
	$('#acp_settings').iconPicker({
		selector: '.icon-select',
		onSelect: ($item, iconClass) => $item.prev().val(iconClass),
	});
});
