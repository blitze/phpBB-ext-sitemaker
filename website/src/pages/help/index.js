import React from 'react';
import Layout from '@theme/Layout';
import Link from '@docusaurus/Link';
import Translate from '@docusaurus/Translate';
import Hero from '../../components/Hero';

function Help() {
	return (
		<Layout title="Help">
			<Hero>
				<h2>
					<Translate>Need help?</Translate>
				</h2>
				<p>
					<Translate desc="statement made to reader">
						This project is maintained by a dedicated group of
						people.
					</Translate>
				</p>
			</Hero>
			<div className="container margin-vert--xl">
				<div className="row margin-top--lg">
					<div className="col">
						<h3>
							<Translate>Browse Docs</Translate>
						</h3>
						<p>
							<Translate
								values={{
									documentation: (
										<Link to="/docs/intro/introduction">
											documentation
										</Link>
									),
								}}
							>
								{'Learn more using the {documentation}'}
							</Translate>
						</p>
					</div>
					<div className="col">
						<h3>
							<Translate>Join the community</Translate>
						</h3>
						<p>
							<Translate values={{support: <Link to="https://www.phpbb.com/customise/db/extension/phpbb_sitemaker_2/support">here</Link>}}>
								{'Ask questions about the documentation and project {support}'}
							</Translate>
						</p>
					</div>
					<div className="col">
						<h3>
							<Translate>Stay up to date</Translate>
						</h3>
						<p>
							<Translate values={{blog: <Link to="/blog">blog</Link>}}>
								{"Find out what's new with this project on our {blog}"}
							</Translate>
						</p>
					</div>
				</div>
			</div>
		</Layout>
	);
}

export default Help;
