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

	npm install -g gulp bower
	npm install

Alternatively you may use [yarn](https://yarnpkg.com):

	yarn global add gulp bower
	yarn install

**Watch Changes**

	gulp watch --theme my-style

**Make Changes**

* Make your changes to files in the phpBB/ext/blitze/sitemaker/develop folder.
* Look at phpBB/ext/blitze/sitemaker/develop/_partials/_globals.scss for sass variables

**Build Assets**

	gulp build --theme my-style

**Deploy**

You can now copy the generated files from phpBB/ext/blitze/sitemaker/styles/my-style and uploaded them to your production server.
