/**
 * Copyright (c) 2017-present, Facebook, Inc.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

// See https://docusaurus.io/docs/site-config for all the possible
// site configuration options.

const baseUrl = '/phpBB-ext-sitemaker/';

const siteConfig = {
	title: 'phpBB SiteMaker',
	tagline: 'A portal/CMS for phpBB 3.2x',
	url: 'https://blitze.github.io',
	baseUrl,
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
		`${baseUrl}js/copy-code-button.js`,
		'https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.0/clipboard.min.js',
		'https://buttons.github.io/buttons.js',
	],
	stylesheets: [`${baseUrl}css/copy-code-button.css`],

	onPageNav: 'separate',
	cleanUrl: true,
	enableUpdateBy: true,
	enableUpdateTime: true,
	docsSideNavCollapsible: true,
	scrollToTop: true,
	scrollToTopOptions: {
		zIndex: 100,
		backgroundColor: '#777',
	},
	repoUrl: 'https://github.com/blitze/phpBB-ext-sitemaker',
	editUrl:
		'https://github.com/blitze/phpBB-ext-sitemaker/edit/develop/docs/docs',
	translationRecruitingLink:
		'https://crowdin.com/project/phpbb-ext-sitemaker',
	gaTrackingId: 'UA-134749797-1',
	algolia: {
		apiKey: 'fecaa594ae467c72b7b00d16529b0028',
		indexName: 'phpbb',
	},
};

module.exports = siteConfig;
