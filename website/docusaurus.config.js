/** @type {import('@docusaurus/types').DocusaurusConfig} */
const organizationName = 'blitze';
const projectName = 'phpBB-ext-sitemaker';
const baseUrl =
	process.env.NODE_ENV !== 'production' ? '/' : '/phpBB-ext-sitemaker/';
const repoUrl = 'https://www.github.com/blitze/phpBB-ext-sitemaker';
const editUrl =
	'https://github.com/blitze/phpBB-ext-sitemaker/edit/develop/website';
const crowdinProjectUrl = 'https://crowdin.com/project/phpbb-ext-sitemaker';
const defaultLocale = 'en';
const locales = [
	'ar',
	'cs',
	'da',
	'en',
	'nl',
	'fr',
	'de',
	'el',
	'it',
	'nb',
	'pl',
	'pt',
	'ro',
	'ru',
	'es',
	'sv',
];

module.exports = {
	title: 'phpBB SiteMaker',
	tagline: 'A portal/CMS for phpBB',
	url: 'https://blitze.github.io',
	baseUrl,
	onBrokenLinks: 'throw',
	onBrokenMarkdownLinks: 'warn',
	favicon: 'img/favicon.ico',
	organizationName,
	projectName,
	i18n: {
		defaultLocale,
		locales,
	},
	scripts: [
		{
			src: 'https://buttons.github.io/buttons.js',
			async: true,
		},
	],
	themeConfig: {
		navbar: {
			title: 'phpBB Sitemaker',
			items: [
				{
					type: 'doc',
					docId: 'intro/introduction',
					position: 'right',
					label: 'Docs',
				},
				{
					to: '/help',
					label: 'Help',
					position: 'right',
				},
				{ to: '/blog', label: 'Blog', position: 'right' },
				{ type: 'search', position: 'right' },
				{
					type: 'localeDropdown',
					position: 'right',
					dropdownItemsAfter: [
						{
							to: crowdinProjectUrl,
							label: 'Help us translate',
						},
					],
				},
				{
					href: repoUrl,
					position: 'right',
					className: 'header-github-link',
				},
			],
		},
		footer: {
			style: 'dark',
			links: [
				{
					title: 'Docs',
					items: [
						{
							label: 'User Guide',
							to: '/docs/user/blocks/overview',
						},
						{ label: 'Developer Guide', to: '/docs/dev/overview' },
						{ label: 'Contribute', to: '/docs/contrib/overview' },
					],
				},
				{
					title: 'Community',
					items: [
						{
							label: 'Support',
							to: 'https://www.phpbb.com/customise/db/extension/phpbb_sitemaker_2/support',
						},
						{
							html: `<a title="Crowdin" target="_blank" href="https://crowdin.com/project/phpbb-ext-sitemaker">
								<img src="https://d322cqt584bo4o.cloudfront.net/phpbb-ext-sitemaker/localized.svg" />
							</a>`,
						},
					],
				},
				{
					title: 'More',
					items: [
						{ label: 'Blog', to: '/blog' },
						{
							html: `<iframe title="github" src="https://ghbtns.com/github-btn.html?user=${organizationName}&repo=${projectName}&type=star&count=true&size=small" />`,
						},
					],
				},
			],
			copyright: `Copyright © ${new Date().getFullYear()} phpBB SiteMaker.`,
		},
		algolia: {
			apiKey: 'fecaa594ae467c72b7b00d16529b0028',
			indexName: 'phpbb',
		},
		gtag: {
			trackingID: 'UA-134749797-1',
		},
	},
	presets: [
		[
			'@docusaurus/preset-classic',
			{
				docs: {
					showLastUpdateAuthor: true,
					showLastUpdateTime: true,
					sidebarPath: require.resolve('./sidebars.js'),
					editUrl: ({ locale, docPath }) => {
						// link to crowdin for non-english languages
						if (locale !== defaultLocale) {
							return `${crowdinProjectUrl}/${locale}`;
						}
						// Link to Github for English docs
						return `${editUrl}/docs/${docPath}`;
					},
				},
				blog: {
					showReadingTime: true,
					editUrl,
				},
				theme: {
					customCss: require.resolve('./src/css/custom.css'),
				},
			},
		],
	],
};
