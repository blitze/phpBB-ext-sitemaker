/**
 * Copyright (c) 2017-present, Facebook, Inc.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

const React = require('react');

class Footer extends React.Component {
	docUrl(doc, language) {
		const baseUrl = this.props.config.baseUrl;
		const docsUrl = this.props.config.docsUrl;
		const docsPart = `${docsUrl ? `${docsUrl}/` : ''}`;
		const langPart = `${language ? `${language}/` : ''}`;
		return `${baseUrl}${docsPart}${langPart}${doc}`;
	}

	pageUrl(doc, language) {
		const baseUrl = this.props.config.baseUrl;
		return baseUrl + (language ? `${language}/` : '') + doc;
	}

	render() {
		return (
			<footer className="nav-footer" id="footer">
				<section className="sitemap">
					<a href={this.props.config.baseUrl} className="nav-home">
						{this.props.config.footerIcon && (
							<img
								src={
									this.props.config.baseUrl +
									this.props.config.footerIcon
								}
								alt={this.props.config.title}
								width="66"
								height="58"
							/>
						)}
					</a>
					<div>
						<h5>Docs</h5>
						<a
							href={this.docUrl(
								'introduction',
								this.props.language,
							)}
						>
							Userguide
						</a>
						<a
							href={this.docUrl(
								'developer-extensions',
								this.props.language,
							)}
						>
							Developer Guide
						</a>
						<a
							href={this.docUrl(
								'contrib-overview',
								this.props.language,
							)}
						>
							Contribute
						</a>
					</div>
					<div>
						<h5>Community</h5>
						<a href="https://www.phpbb.com/customise/db/extension/phpbb_sitemaker_2/support">
							Project support page
						</a>
					</div>
					<div>
						<h5>More</h5>
						<a href={`${this.props.config.baseUrl}blog`}>Blog</a>
						<a href="https://github.com/blitze" target="_blank">
							GitHub
						</a>
						<a
							className="github-button"
							href={this.props.config.repoUrl}
							data-icon="octicon-star"
							data-count-href="/blitze/phpBB-ext-sitemaker/stargazers"
							data-show-count="true"
							data-count-aria-label="# stargazers on GitHub"
							aria-label="Star this project on GitHub"
						>
							Star
						</a>
					</div>
				</section>
				<section className="copyright">
					{this.props.config.copyright}
				</section>
			</footer>
		);
	}
}

module.exports = Footer;
