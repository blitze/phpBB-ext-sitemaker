/* global $ */

const { config } = window;

export const inactiveBlockClass = 'sm-inactive';

export function getPOJO(arrayOfObjects) {
	const data = {};
	$.each(arrayOfObjects, function iterator() {
		if (data[this.name]) {
			if (!data[this.name].push) {
				data[this.name] = [data[this.name]];
			}
			data[this.name].push(this.value || '');
		} else {
			data[this.name] = this.value || '';
		}
	});

	return data;
}

export function fixPaths(subject) {
	return subject.replace(
		new RegExp(
			'(?:href|src|action)=(?:"|\')((?:./)?(?:../)+)(?:.*?)(?:"|\')',
			'gmi',
		),
		(match, g1) => match.replace(g1, config.webRootPath),
	);
}
