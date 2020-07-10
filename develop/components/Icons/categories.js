const fs = require('fs');
const request = require('request');
const axios = require('axios');
const YAML = require('yamljs');

const categoriesSrc = 'https://raw.githubusercontent.com/FortAwesome/Font-Awesome/5.13.0/metadata/categories.yml';
const iconsSrc = 'https://raw.githubusercontent.com/FortAwesome/Font-Awesome/5.13.0/metadata/icons.yml'
const outputYML = 'services/icons/categories.yml';

async function getJson() {
	try {
		const [res1, res2] = await Promise.all([
			axios.get(categoriesSrc),
			axios.get(iconsSrc)
		]);
		return [res1.data, res2.data];
	} catch (error) {
		console.log(error);
	}
}

async function getCategories() {
	const [categoriesYML, iconsYML] = await getJson();
	const categoriesJson = YAML.parse(categoriesYML);
	const iconsJson = YAML.parse(iconsYML);

	const newCategories = Object.keys(categoriesJson).reduce((cats, name) => {
		let { icons } = categoriesJson[name];
		icons = icons.map(icon => {
			return {
				name: icon,
				terms: [...iconsJson[icon].search.terms, icon].join('|'),
				prefixes: iconsJson[icon].styles.map(style => `fa${style[0]}`)
			}
		});

		return {
			...cats,
			[name]: { icons }
		};
	}, {});

	// Generate YAML
	fs.writeFileSync(outputYML, YAML.stringify(newCategories, 4));
}

getCategories();