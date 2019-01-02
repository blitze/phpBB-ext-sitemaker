/* global $ */
import Button from '../../Button/button';

const { ajaxUrl, lang } = window;

export default function AddMenuHandler($menus) {
	Button('#add-menu', {}, () => {
		$.post(`${ajaxUrl}add_menu`).done(menu => {
			const $item = $(
				`<li id="menu-${menu.id}" class="menu-item">
					<a href="#" class="menu-option">
					    <span class="menu-title">${menu.title}</span>
					</a>
					<div class="menu-actions">
						<a href="#" class="menu-edit left" title="${lang.edit}">
						    <i class="fa fa-cog"></i>
						</a>
						<a href="#" class="menu-delete left" title="${lang.remove}">
						    <i class="fa fa-close"></i>
						</a>
					</div>
				</li>`,
			);

			$menus.append($item);
			$item.trigger('click');
		});
	}).show();
}
