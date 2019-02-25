/**
 * Copyright (c) 2017-present, Facebook, Inc.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

const React = require('react');
const siteConfig = require(`${process.cwd()}/siteConfig.js`);

class PageNotFound extends React.Component {
	getCustomScripts() {
		const { projectName, gaTrackingId, fallbackLanguage } = siteConfig;

		if (!gaTrackingId && !fallbackLanguage) {
			return null;
		}

		let __html = '';
		if (gaTrackingId) {
			__html += `
				ga('create', "${siteConfig.gaTrackingId}");
				ga('send', {
					hitType: 'event',
					eventCategory: '404 Response',
					eventAction: window.location.href,
					eventLabel: document.referrer
				});
				`;
		}

		if (fallbackLanguage) {
			__html += `
				var match = window.location.pathname
					.replace('/${projectName}', '')
					.match(/\\/([^docs][a-z0-9_-]+)\\//i);
				if (match && match[1] !== '${fallbackLanguage}') {
					window.location.href = window.location.href.replace(match[1], '${fallbackLanguage}');
				}
				`;
		}

		return { __html };
	}

	render() {
		const customScripts = this.getCustomScripts();

		return (
			<div className="error-page">
				{customScripts && (
					<script dangerouslySetInnerHTML={customScripts} />
				)}
				<div className="error-message">
					<div className=" error-message-container container">
						<span>404 </span>
						<p>Page Not Found.</p>
						<a href={`/${siteConfig.projectName}/`}>
							Return to the front page
						</a>
					</div>
				</div>
			</div>
		);
	}
}

PageNotFound.title = 'Page Not Found';

module.exports = PageNotFound;
