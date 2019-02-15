/**
 * Copyright (c) 2017-present, Facebook, Inc.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

// See https://docusaurus.io/docs/site-config for all the possible
// site configuration options.

const siteConfig = {
	title: 'phpBB SiteMaker Docs', // Title for your website.
	tagline: 'A portal/CMS for phpBB 3.2x',
	url: 'https://blitze.github.io', // Your website URL
	baseUrl: '/phpBB-ext-sitemaker/', // Base URL for your project */
	// For github.io type URLs, you would set the url and baseUrl like:
	//   url: 'https://facebook.github.io',
	//   baseUrl: '/test-site/',

	projectName: 'phpBB-ext-sitemaker',
	organizationName: 'blitze',
	headerLinks: [
		{ doc: 'introduction', label: 'Docs' },
		{ page: 'help', label: 'Help' },
		{ blog: true, label: 'Blog' },
		{ search: true },
		{ languages: true },
		{
			href: 'https://www.github.com/blitze/phpBB-ext-sitemaker',
			label: 'Github',
		},
	],

	headerIcon: false,
	footerIcon: false,
	favicon: false,

	colors: {
		primaryColor: '#c0baf1',
		secondaryColor: '#b4a9d3',
	},

	copyright: `Copyright © ${new Date().getFullYear()} phpBB SiteMaker`,

	highlight: {
		theme: 'atom-one-dark',
	},

	scripts: [
		'https://buttons.github.io/buttons.js',
		'https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.0/clipboard.min.js',
		'/js/copy-code-button.js',
	],
	stylesheets: ['/css/copy-code-button.css'],

	onPageNav: 'separate',
	cleanUrl: true,
	enableUpdateBy: true,
	enableUpdateTime: true,
	translationRecruitingLink:
		'https://crowdin.com/project/phpBB-ext-sitemaker',
	docsSideNavCollapsible: true,
	scrollToTop: true,
	scrollToTopOptions: {
		zIndex: 100,
		backgroundColor: '#777',
	},
	repoUrl: 'https://github.com/blitze/phpBB-ext-sitemaker',
};

module.exports = siteConfig;
