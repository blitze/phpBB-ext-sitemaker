import Button from '../../Button/button';

const { config, lang } = window;

export default function AddGroup($groups, actions) {
	Button('#add-group', {}, e => {
		e.stopImmediatePropagation();
		$.post(`${config.ajaxUrl}${actions.add}`).done(({ id, title }) => {
			if (id > 0) {
				const $item = $(
					`<li id="group-${id}" class="group-item">
						<a href="#" class="group-option">
							<span class="group-title">${title}</span>
						</a>
						<div class="group-actions">
							<a href="#" class="group-edit left" title="${lang.edit}">
								<i class="fas fa-pencil-alt" aria-hidden="true"></i>
							</a>
							<a href="#" class="group-delete left" title="${lang.remove}">
								<i class="fas fa-times" aria-hidden="true"></i>
							</a>
						</div>
					</li>`,
				);

				$groups.append($item);
				$item.trigger('click');
			}
		});
	}).show();
}
