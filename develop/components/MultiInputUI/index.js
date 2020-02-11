import './style.scss';

class Plugin {
	constructor(element) {
		this.$element = $(element);

		if (this.$element.hasClass('sortable')) {
			this.$element.find('.sm-multi-input-list').sortable({
				axis: 'y',
				containment: 'parent',
			});
		}

		this.$element.find('.sm-multi-input-add').click(this.addRow);
		this.$element.on('click', '.sm-multi-input-delete', this.deleteRow);
	}

	addRow = e => {
		e.preventDefault();
		const $container = $(e.currentTarget)
			.blur()
			.prev();
		const $clone = $container
			.children()
			.eq(0)
			.clone()
			.find('input')
			.val('')
			.end();
		$container.append($clone);
		Plugin.scrollToElement($clone, $container);
	};

	deleteRow(e) {
		e.preventDefault();
		const $row = $(this)
			.blur()
			.closest('.sm-multi-input-item');
		const numSiblings = $row.siblings().length;
		if (numSiblings) {
			$row.remove();
		} else {
			$row.children('input').val('');
		}
	}

	static scrollToElement($element, $container) {
		const scrollTop = $element.offset().top;
		$container.stop().animate({ scrollTop }, 300);
	}
}

const pluginName = 'multiInputUI';

if (typeof $.fn[pluginName] === 'undefined') {
	// preventing against multiple instantiations
	$.fn[pluginName] = function pluginWrapper() {
		return this.each(function iterator() {
			if (!$.data(this, `plugin_${pluginName}`)) {
				$.data(this, `plugin_${pluginName}`, new Plugin(this));
			}
		});
	};
}
