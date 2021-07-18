---
title: Theming
sidebar_position: 3
---

We understand that the template files and the JS/CSS files will not work for every style, so below are some ways you can use your own templates and create JS/CSS files for your particular style.

## Using your own template

If the default templates that come with phpBB Sitemaker don't work well for your particular style, you can easily overwrite it to use your own template file by creating the corresponding file in your styles's folder.

For example, say your style is called `Backlash` and it has a particular way in which the HTML for the block header section needs to be structured for the [boxed view](/docs/user/blocks/block-views). You can overwrite that particular template by creating a file by the same name like so: `phpBB/ext/blitze/sitemaker/styles/Backlash/template/views/boxed_view.twig`.

In other words, to use your own template file, you need to:
* Identify which phpBB Sitemaker file needs to be overwritten
* Create a file by the same name in the Sitemaker `styles` folder under your style name

> Note: If you create your own template files, be sure to not delete the `phpbb/ext/blitze/sitemaker` folder when updating the extension as your custom files will be deleted. Rather, just overwrite the existing files with the new ones.

## Creating JS/CSS files for your style

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

> This extension uses jQuery UI for tabs, dialogs and buttons. The default jQuery theme is 'smoothness.' You can use a different jQuery UI theme that best fits your theme. You can specify the jQuery UI theme using the flag --jq_ui_theme. For example:

    yarn build --theme my-style --jq_ui_theme ui-lightness
