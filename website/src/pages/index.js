import React from 'react';
import clsx from 'clsx';
import Layout from '@theme/Layout';
import Link from '@docusaurus/Link';
import Translate from '@docusaurus/Translate';
import useDocusaurusContext from '@docusaurus/useDocusaurusContext';
import Features from '../components/Features';
import Hero from '../components/Hero';

function HomepageHeader() {
	const { siteConfig } = useDocusaurusContext();
	return (
		<Hero>
			<div className="row">
				<div className="col">
					<h1 className="hero__title">{siteConfig.title}</h1>
					<p className="hero__subtitle">{siteConfig.tagline}</p>

					<div className="margin-top--xl">
						<Link
							className="button button--outline button--primary margin-right--md"
							to="http://www.phpbb-sitemaker.website/demo-3.2.x"
						>
							<Translate>Try It Out</Translate>
						</Link>
						<Link
							className="button button--outline button--info margin-right--md"
							to="/docs/intro/introduction"
						>
							<Translate>Read About It</Translate>
						</Link>
						<Link
							className="button button--outline button--success margin-right--sm"
							to="https://www.phpbb.com/customise/db/extension/phpbb_sitemaker_2/"
						>
							<Translate>Download It</Translate>
						</Link>
					</div>
				</div>
				<div className="col"></div>
			</div>
		</Hero>
	);
}

export default function Home() {
	const { siteConfig } = useDocusaurusContext();
	return (
		<Layout
			title={''}
			description="Documentation site for phpBB Sitemaker"
		>
			<HomepageHeader />
			<main>
				<Features />
			</main>
		</Layout>
	);
}
