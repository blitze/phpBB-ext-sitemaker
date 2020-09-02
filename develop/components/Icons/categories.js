const fs = require('fs');
const request = require('request');
const axios = require('axios');
const YAML = require('yamljs');

const iconsSrc =
	'https://raw.githubusercontent.com/FortAwesome/Font-Awesome/fa-4/src/icons.yml';
const outputJSON = 'services/icons/categories.json';

async function getYaml() {
	try {
		const icons = await axios.get(iconsSrc);
		return icons.data;
	} catch (error) {
		console.log(error);
	}
}

async function getCategories() {
	const iconsYML = await getYaml();
	const { icons } = YAML.parse(iconsYML);

	const categories = icons.reduce(
		(list, { name, id, filter = [], categories }) =>
			categories.reduce((list, cat) => {
				const category = cat
					.replace(' Icons', '')
					.replace('-', '_')
					.replace(' ', '_')
					.toLowerCase();
				return {
					...list,
					[category]: [
						...(list[category] || []),
						{ id, name, filter },
					],
				};
			}, list),
		{},
	);

	try {
		fs.writeFileSync(outputJSON, JSON.stringify(categories));
	} catch (err) {
		console.error(err);
	}
}

getCategories();
