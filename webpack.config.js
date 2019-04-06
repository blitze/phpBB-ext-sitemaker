const path = require('path');
const Encore = require('@symfony/webpack-encore');
const webpack = require('webpack');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const DuplicatePackageCheckerPlugin = require('duplicate-package-checker-webpack-plugin');

const style = process.env.style || 'all';
const jqueryUITheme = process.env.jq_ui_theme || 'smoothness';

const paths = {
	entry: path.resolve(__dirname, 'develop'),
	output: path.resolve(__dirname, `styles/${style}/theme/assets`),
};

Encore.setOutputPath(paths.output)
	.setPublicPath('../')
	.setManifestKeyPrefix('../')

	.addStyleEntry('sitemaker', paths.entry + '/sitemaker.scss')

	.addEntry('blocks/manager', paths.entry + '/entries/blocks/manager.js')
	.addEntry('menu/admin', paths.entry + '/entries/menu/')
	.addEntry('tree/builder', paths.entry + '/components/Tree/builder.js')
	.addEntry('settings/admin', paths.entry + '/entries/settings/')

	.cleanupOutputBeforeBuild()

	.enableSourceMaps(!Encore.isProduction())

	.enableSingleRuntimeChunk()

	.splitEntryChunks()
	.configureSplitChunks(function(splitChunks) {
		splitChunks.chunks = 'all';
		splitChunks.cacheGroups = {
			defaults: false,
			vendors: false,
			codemirror: {
				name: 'codemirror/codemirror',
				test: /[\\/]codemirror[\\/]/,
				enforce: true,
			},
			'jquery-ui': {
				name: 'jquery-ui/custom',
				test: /jquery-ui/,
				enforce: true,
			},
			twig: {
				name: 'twig/twig',
				test: /[\\/]twig[\\/]/,
				enforce: true,
			},
		};
	})

	.enablePostCssLoader()
	.enableSassLoader()
	.enableEslintLoader()

	.autoProvidejQuery()

	.addExternals({
		jquery: 'jQuery',
	})

	.addAliases({
		'jquery-ui/sortable': 'jquery-ui/ui/widgets/sortable',
	})

	.addPlugin(
		new CopyWebpackPlugin([
			{
				from: './node_modules/tinymce/',
				to: 'tinymce/',
			},
			{
				from: 'vendor/ResponsiveFilemanager/tinymce/plugins/',
				to: 'tinymce/plugins/[path][name].[ext]',
			},
		]),
	)

	.addPlugin(
		new webpack.NormalModuleReplacementPlugin(
			/jquery-ui\/themes\/base\/(core|theme).css/,
			function(resource) {
				const filename = path.basename(resource.request, '.css');
				const type = filename === 'core' ? 'jquery-ui' : 'theme';
				resource.request = `jquery-ui-themes/themes/${jqueryUITheme}/${type}.css`;
			},
		),
	)

	.addPlugin(new DuplicatePackageCheckerPlugin())

	.configureFilenames({
		js: '[name].min.js',
		css: '[name].min.css',
	})

	.configureBabel(function(babelConfig) {
		// add additional presets
		babelConfig.presets.push('@babel/preset-flow');

		// no plugins are added by default, but you can add some
		babelConfig.plugins.push('@babel/plugin-proposal-class-properties');
	});

module.exports = Encore.getWebpackConfig();
