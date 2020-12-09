import OutsideClick from "../OutsideClick";
import Accordion from "../Accordion";
import "./manager.scss";

export default function NavbarManager() {
	let loaded = false;

	$("#sm-navbar-edit-btn").click(() => {
		const $container = $("#sm-navbar-manager");

		if (!$container.is(":visible")) {
			Promise.all([
				import(
					/* webpackChunkName: "spectrum/colorpicker" */ "spectrum-colorpicker2/src/spectrum.js"
				),
				import(
					/* webpackChunkName: "spectrum/colorpicker" */ "spectrum-colorpicker2/src/spectrum.css"
				),
			]).then(() => {
				const properties = {};

				function setInitialValues() {
					$container
						.find(".navbar-prop")
						.each(function handler() {
							const { element, prop } = $(this).data();
							let rawVal = $(element).css(prop) || '';
							let value = rawVal;

							if (!properties[element]) {
								properties[element] = {};
							}

							// handle numbers
							if ($(this).attr("type") === "number") {
								const [, unit, ...rest] = value.split(/-?[0-9]+/);

								// property is set in the form 1px 2px 3px so we skip it
								if (rest.length) {
									value = 0;
									rawVal = 0;
								} else {
									$(this).data("unit", unit);

									// value without unit
									const match = value.match(/[+-]?\d+(?:\.\d+)?/g);

									if (match) {
										value = parseInt(match.pop(), 10);
									} else {
										rawVal = 0;
										value = 0;
									}
								}
							} else if (prop === "background-image") {
								if (value && value !== "none") {
									// Get string between first and last paranthesis
									const str = value.substring(
										value.indexOf("(") + 1,
										value.lastIndexOf(")")
									);

									// Finally with regex we can get each parts separatelly
									const [start, end] = str.split(
										/,(?![^(]*\))(?![^"']*["'](?:[^"']*["'][^"']*["'])*[^"']*$)/
									);
									value = $(this).attr("name").includes("start") ? start : end;
								} else {
									value = "";
									rawVal = "";
								}
							}

							properties[element][prop] = rawVal;

							$(this).val(value);
						});
				}

				function initAccordion() {
					const $accordion = new Accordion("#sm-navbar-accordion", {
						heightStyle: "fill",
					});

					$("body").resize(() => $accordion.refresh());
				}

				function initColorPicker() {
					$(".colorpicker").spectrum({
						type: "color",
						showPalette: "false",
						hideAfterPaletteSelect: "true",
						showInput: "true",
						showInitial: "true",
						showButtons: "false",
					});
				}

				function handleSubmit() {
					const css = [];
					const location = $('#navbar_location').val();

					$.each(properties, (element, props) => {
						let propsStr = '';
						$.each(props, (prop, value) => {
							if (value) {
								propsStr += `${prop}:${value};`;
							}
						});
						css.push(`${element}{${propsStr}}`);
					});

					$.post(window.config.navbarManager, {
						css: css.join(""),
						location
					}, data => {
						if (data.location !== location) {
							window.location.reload();
						}
					});
				}

				if (!loaded) {
					$container.find("#submit").click(handleSubmit);

					$container.find(".navbar-prop").change((e) => {
						const { element, prop, unit = "", group = "" } = $(e.target).data();
						let value = `${e.target.value}`;

						// this ensures that we can remove props when not set
						value = value ? `${value}${unit}` : "";

						if (prop === "background-image" && group) {
							const [start, end] = $container
								.find(`*[data-group="${group}"]`)
								.map((i, el) => $(el).val())
								.get();

							if (start && end) {
								value = `linear-gradient(${start}, ${end})`;
							}
						} else if (prop.match(/border(-(top|left|right|bottom))?-width/)) {
							const borderStyle = value ? "solid" : "";

							properties[element]["border-style"] = borderStyle;
							$(element).css("border-style", borderStyle);
						} else if (element.includes(":hover")) {
							const el = element.replace(":hover", "");
							$(el).hover(
								function handleIn() {
									$(this).css(prop, value);
								},
								function handleOut() {
									value = "";
									$(this).css(prop, value);
								}
							);
						}

						properties[element][prop] = value;

						$(element).css(prop, value);
					});

					setInitialValues();
					initAccordion();
					initColorPicker();

					loaded = true;
				}
			});
			$container.show();
		} else {
			$container.hide();
		}

		OutsideClick($container, () => $container.hide());
	});
}
