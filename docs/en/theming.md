# Customizing phpBB SiteMaker

As much as possible, we tried to put template files and assets in styles/all/ folder so that you can overwrite them by creating a file with same name under your own template theme e.g. prosilver.
You can overwrite css, js, html files by creating the corresponding file in your style's folder.

# Creating js/css files for your style

Note:
* For the purpose of the below instructions we will assume that you have a style called my-style.
* The below commands are to be run from terminal in the phpBB/ext/blitze/sitemaker directory

Clone into phpBB/ext/blitze/sitemaker:

    git clone https://github.com/blitze/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker

From command line go to sitemaker directory:

    cd phpBB/ext/blitze/sitemaker

**Install vendors**

    php composer.phar install

**Install packages**

For the below commands you can use npm or [yarn](https://yarnpkg.com)

	yarn install

**Watch Changes**

	yarn start --theme my-style

**Make Changes**

* Make your changes to files in the phpBB/ext/blitze/sitemaker/develop folder.
* Look at phpBB/ext/blitze/sitemaker/develop/_partials/_globals.scss for sass variables

**Build Assets**

	yarn build --theme my-style

**Deploy**

You can now copy the generated files from phpBB/ext/blitze/sitemaker/styles/my-style and uploaded them to your production server.

**Note**

This extension uses jQuery UI for tabs, dialogs and buttons. 
The default jQuery theme is 'smoothness.' You can use a different jQuery UI theme that best fits your theme.
You can specify the jQuery UI theme using the flag --jq_ui_theme. For example:

	yarn build --theme my-style --jq_ui_theme ui-lightness
