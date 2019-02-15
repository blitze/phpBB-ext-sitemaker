---
id: developer-theming
title: Theming
---

phpBB SiteMaker comes with styles and colors made for prosilver.
You can overwrite CSS, JS, and HTML files by creating the corresponding file in your style's folder.

# Creating JS/CSS files for your style
 
Note:
* For the purpose of the below instructions we will assume that you have a style called my-style.

Clone into phpBB/ext/blitze/sitemaker:

    git clone https://github.com/blitze/phpBB-ext-sitemaker.git phpBB/ext/blitze/sitemaker

From command line go to sitemaker directory:

    cd phpBB/ext/blitze/sitemaker

**Install vendors**

    composer install

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

> This extension uses jQuery UI for tabs, dialogs and buttons. 
The default jQuery theme is 'smoothness.' You can use a different jQuery UI theme that best fits your theme.
You can specify the jQuery UI theme using the flag --jq_ui_theme. For example:

	yarn build --theme my-style --jq_ui_theme ui-lightness
