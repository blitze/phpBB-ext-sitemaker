import React from 'react';
import clsx from 'clsx';
import Translate from '@docusaurus/Translate';
import styles from './index.module.css';

const FeatureList = [
	{
		title: <Translate>Blocks</Translate>,
		Svg: require('../../../static/img/undraw_docusaurus_mountain.svg')
			.default,
		description: (
			<Translate>
				Drag and drop blocks of content to predefined areas to design
				your site.
			</Translate>
		),
	},
	{
		title: <Translate>Menus</Translate>,
		Svg: require('../../../static/img/undraw_docusaurus_tree.svg').default,
		description: (
			<Translate>
				Create hierarchical menus that can be displayed as lists or
				dropdown menus
			</Translate>
		),
	},
	{
		title: <Translate>Layouts</Translate>,
		Svg: require('../../../static/img/undraw_docusaurus_react.svg').default,
		description: (
			<Translate>
				Choose the website layout that works for you or use the custom
				layout to set your own sidebar widths
			</Translate>
		),
	},
];

function Feature({ Svg, title, description }) {
	return (
		<div className={clsx('col col--4')}>
			<div className="text--center">
				<Svg className={styles.featureSvg} alt={title} />
			</div>
			<div className="text--center padding-horiz--md">
				<h3>{title}</h3>
				<p>{description}</p>
			</div>
		</div>
	);
}

export default function HomepageFeatures() {
	return (
		<section className={styles.features}>
			<div className="container">
				<div className="row">
					{FeatureList.map((props, idx) => (
						<Feature key={idx} {...props} />
					))}
				</div>
			</div>
		</section>
	);
}
