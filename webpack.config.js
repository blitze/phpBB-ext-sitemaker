const path = require('path');
const webpack = require('webpack');
const Encore = require('@symfony/webpack-encore');
const CopyWebpackPlugin = require('copy-webpack-plugin');

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
	.addEntry('tree/group', paths.entry + '/components/TreeGroup/')
	.addEntry('settings/admin', paths.entry + '/entries/settings/')

	.cleanupOutputBeforeBuild()

	.enableSourceMaps(!Encore.isProduction())

	.enableSingleRuntimeChunk()

	.configureSplitChunks(splitChunks => {
		splitChunks.chunks = 'all';
		splitChunks.cacheGroups = {
			default: false,
			vendors: false,
			codemirror: {
				name: 'codemirror/codemirror',
				test: /[\\/]codemirror[\\/]/,
				chunks: 'all',
				enforce: true,
			},
			twig: {
				name: 'twig/twig',
				test: /[\\/]twig[\\/]/,
				chunks: 'all',
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
				ignore: ['composer.json'],
			},
			{
				from: 'vendor/trippo/responsivefilemanager/responsive_filemanager/tinymce/plugins/',
				to: 'tinymce/plugins/[path][name].[ext]',
			},
		]),
	)

	.addPlugin(
		new webpack.NormalModuleReplacementPlugin(
			/jquery-ui\/themes\/base\/(core|theme).css/,
			resource => {
				const filename = path.basename(resource.request, '.css');
				const type = filename === 'core' ? 'jquery-ui' : 'theme';
				resource.request = `jquery-ui-themes/themes/${jqueryUITheme}/${type}.css`;
			},
		),
	)

	.configureFilenames({
		js: '[name].min.js',
		css: '[name].min.css',
	})

	.configureBabel(
		babelConfig => {
			// add additional presets
			babelConfig.presets.push('@babel/preset-flow');

			// no plugins are added by default, but you can add some
			babelConfig.plugins.push('@babel/plugin-proposal-class-properties');
		},
		{
			useBuiltIns: 'entry',
			corejs: 3,
		},
	);

module.exports = Encore.getWebpackConfig();
