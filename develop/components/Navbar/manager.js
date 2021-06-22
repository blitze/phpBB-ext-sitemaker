import OutsideClick from '../OutsideClick';
import Accordion from '../Accordion';
import SelectBox from '../SelectBox';
import './manager.scss';

export default function NavbarManager() {
	let loaded = false;
	let $btn;
	const $container = $('#sm-navbar-manager').appendTo('body');

	function show() {
		if (loaded) {
			const { top, left } = $btn.offset();
			$container.show().offset({
				top: top + 40,
				left: left - $container.width() + $btn.outerWidth(),
			});
		}
	}

	function hide() {
		$container.hide(200);
	}

	$btn = $('#sm-navbar-edit-btn').on('click', function handleClick() {
		if (!$container.is(':visible')) {
			Promise.all([
				$.get(window.config.navbarCSS),
				import(
					/* webpackChunkName: "spectrum/colorpicker" */ 'spectrum-colorpicker2/src/spectrum'
				),
				import(
					/* webpackChunkName: "spectrum/colorpicker" */ 'spectrum-colorpicker2/src/spectrum.css'
				),
			]).then(([navbarCSS]) => {
				const properties = {};
				const defaults = {};

				function getParsedCSS() {
					const matches = navbarCSS
						.replace(/@import url\(.*\);/, '')
						.matchAll(/(.*?)\{(.*?)\}/g);

					return [...matches].reduce(
						(selectors, [, selector, propsStr]) => {
							const propMatches = propsStr.matchAll(
								/(.*?):(.*?);/g,
							);

							return {
								...selectors,
								[selector]: [...propMatches].reduce(
									(props, [, prop, value]) => ({
										...props,
										[prop]: value,
									}),
									{},
								),
							};
						},
						{},
					);
				}

				function getNumberWithoutUnit(str) {
					const [number] = `${str}`.match(/[+-]?\d+(?:\.\d+)?/g) || [
						0,
					];
					return number ? parseInt(number, 10) : str;
				}

				function getGradientColors(str) {
					// Get string between first and last paranthesis
					const inParans = str.substring(
						str.indexOf('(') + 1,
						str.lastIndexOf(')'),
					);

					// Finally with regex we can get each parts separatelly
					return inParans.split(
						/,(?![^(]*\))(?![^"']*["'](?:[^"']*["'][^"']*["'])*[^"']*$)/,
					);
				}

				function addPropToObject(object, element, prop, value) {
					if (!object[element]) {
						object[element] = {};
					}

					object[element][prop] = value;
				}

				function save(data) {
					$.post(window.config.navbarManager, data, (resp) => {
						if (!resp.message) {
							window.location.reload();
						}
					});
				}

				function initAccordion() {
					const $accordion = new Accordion('#sm-navbar-accordion', {
						heightStyle: 'content',
						collapsible: true,
					});

					$('body').on('resize', () => $accordion.refresh());
				}

				function initColorPicker() {
					$('.colorpicker').spectrum({
						type: 'color',
						showInput: true,
						showInitial: true,
						showButtons: false,
						hideAfterPaletteSelect: true,
					});
				}

				function initSelectBox() {
					const { $dropdown } = SelectBox({
						selector: '#navbar_location',
						appendTo: $container,
					});

					$dropdown
						.on('mouseenter', 'a', function handleEnter() {
							const { value } = $(this).data();
							if (value) {
								$(`#sm-navbar-${value}`).addClass('sm-navbar-preview');
							}
						})
						.on('mouseleave', 'a', function handleLeave() {
							const { value } = $(this).data();
							if (value) {
								$(`#sm-navbar-${value}`).removeClass('sm-navbar-preview');
							}
						});
				}

				function initHoverPreview() {
					$container
						.find('[data-element*=":hover"]')
						.each(function iterator() {
							const $input = $(this);
							const { element, prop } = $input.data();
							const el = element.replace(':hover', '');

							let oldValue;
							$(el)
								.on('mouseenter', function handleIn() {
									oldValue = $(this).css(prop);
									$(this).css(prop, $input.val());
								})
								.on('mouseleave', function handleOut() {
									$(this).css(prop, oldValue);
								});
						});
				}

				function setInitialValues() {
					const parsed = getParsedCSS();

					const sidesAreTheSame = (sides) =>
						sides.every((x) => x === sides[0]);

					let counter = 0;
					let primaryVal = 0;

					$container.find('.navbar-prop').each(function handler() {
						const { element, prop, unit, primary } = $(this).data();

						let dbValue = '';
						let isDefault = false;

						if (parsed[element] && parsed[element][prop]) {
							dbValue = parsed[element][prop];
						} else {
							dbValue = $(element).css(prop) || '';
							isDefault = true;
						}

						let value = dbValue;

						if ($(this).attr('type') === 'number') {
							const min = $(this).attr('min');
							const sides = dbValue.split(' ');

							let iUnit = unit;
							if (sidesAreTheSame(sides)) {
								[, value, iUnit = unit] = sides[0].match(
									/(-?\d+)(\D+)?/,
								) || ['', 0];
								value = parseInt(value, 10);

								$(this).data('unit', iUnit);
							} else {
								value = 0;
							}

							if (min && value < min) {
								value = min;
							}

							if (primary) {
								primaryVal = value;
								counter = 4;
							} else if (counter) {
								value = value !== primaryVal ? value : 0;
								counter -= 1;
							} else {
								primaryVal = 0;
								counter = 0;
							}

							dbValue = value;
							if (dbValue) {
								dbValue += iUnit;
							}
						} else if (prop === 'background-image') {
							if (value) {
								const [start, end] = getGradientColors(value);
								value = $(this).attr('name').includes('start')
									? start
									: end;
							} else {
								value = '';
							}
						} else if (prop === 'text-transform' && !value) {
							value = 'none';
						}

						$(this).val(value);
						addPropToObject(properties, element, prop, dbValue);

						if (isDefault) {
							addPropToObject(defaults, element, prop, dbValue);
						}
					});
				}

				function handleChange(e) {
					const $target = $(e.target);
					const {
						element,
						prop,
						unit = '',
						group = '',
					} = $target.data();

					let { value } = e.target;
					let preview = value;

					if (unit && !Number.isNaN(value) && parseInt(value, 10)) {
						preview += unit;

						// to minimize the properties we save, we only want to save this property if it deviates from min
						const min = $target.attr('min');
						if (!min || value > min) {
							value += unit;
						} else {
							value = 0;
						}
					}

					if (prop === 'background-image' && group) {
						const [start, end] = $container
							.find(`*[data-group="${group}"]`)
							.map((i, el) => $(el).val())
							.get();

						if (start && end) {
							value = `linear-gradient(${start}, ${end})`;
							preview = value;
						} else {
							value = '';
							preview = 'none';
						}
					} else if (
						prop.match(/border(-(top|left|right|bottom))?-width/)
					) {
						const borderStyle = value ? 'solid' : '';
						const baseProp = prop.replace('-width', '');
						const borderProp = `${baseProp}-style`;

						properties[element][borderProp] = borderStyle;
						$(element).css(borderProp, borderStyle);
					}

					properties[element][prop] = value;

					$(element).css(prop, preview);
				}

				function adjustNavbarPadding() {
					if (properties['.sm-menu']) {
						const hasPadding = getNumberWithoutUnit(
							properties['.sm-menu']['padding-left'],
						);

						const hasBorderRadius = Object.keys(
							properties['.sm-menu'],
						).some(
							(prop) =>
								prop.includes('radius') &&
								getNumberWithoutUnit(
									properties['.sm-menu'][prop],
								),
						);

						if (!hasPadding && hasBorderRadius) {
							const radius = $('.sm-menu').css('border-radius');
							const maxRadius = Math.max(...radius.split(/\D+/));

							properties['.sm-menu'][
								'padding-left'
							] = `${maxRadius}px`;
						}
					}
				}

				function handleSubmit() {
					const css = [];
					const location = $('#navbar_location').val();
					const menu = $('#navbar_menu').val();

					function isDefaultValue(element, prop, value) {
						return (
							defaults[element] &&
							defaults[element][prop] &&
							value === defaults[element][prop]
						);
					}

					adjustNavbarPadding();

					$.each(properties, (element, props) => {
						let propsStr = '';
						$.each(props, (prop, value) => {
							if (
								value &&
								!isDefaultValue(element, prop, value)
							) {
								if (prop === 'background-image') {
									const [start, end] = getGradientColors(
										value,
									);

									propsStr += `${prop}:-webkit-gradient(linear, left top, left bottom, from(${start}), to(${end}));`;
									propsStr += `${prop}:-o-${value};`;
								}
								propsStr += `${prop}:${value};`;
							}
						});

						if (propsStr) {
							css.push(`${element}{${propsStr}}`);
						}
					});

					save({
						css: css.join(''),
						location,
						menu,
					});
				}

				function handleReset() {
					save({});
				}

				if (!loaded) {
					$container.draggable();
					$container.on('click', 'input[type=submit]', handleSubmit);
					$container.on('click', 'input[type=reset]', handleReset);
					$container.on('click', 'input[name=close]', hide);

					$container.on('change', '.navbar-prop', handleChange);

					initAccordion();
					setInitialValues();
					initColorPicker();
					initSelectBox();
					initHoverPreview();

					loaded = true;
					show($btn);
				}
			});

			show($btn);
		} else {
			hide();
		}
		OutsideClick($container, () => $container.hide(200));
	});
}
