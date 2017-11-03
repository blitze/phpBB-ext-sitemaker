# phpBB SiteMaker Extension

phpBB SiteMaker is an Extension for [phpBB 3.2](https://www.phpbb.com/)

## Description

phpBB SiteMaker allows you to transform your phpBB3 board into a full-blown site.

[![Travis branch](https://img.shields.io/travis/blitze/phpBB-ext-sitemaker/develop.svg?style=flat)](https://travis-ci.org/blitze/phpBB-ext-sitemaker) [![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/blitze/phpBB-ext-sitemaker/develop.svg?style=flat)](https://scrutinizer-ci.com/g/blitze/phpBB-ext-sitemaker/?branch=develop) [![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/blitze/phpBB-ext-sitemaker/develop.svg?style=flat)](https://scrutinizer-ci.com/g/blitze/phpBB-ext-sitemaker/?branch=develop)

## Features

* Customize your site using blocks of content
* Drag and drop interface for adding/removing blocks
* Customizable block display - background color, title, etc
* Set any front-facing controller as your site's landing page
* Create layouts for each page or set a default layout for your entire site
* Icon picker for choosing blocks/menu icons using font awesome
* Limit access to specific blocks based on group memberships
* Create Menus with nested lists
* Create blocks with your own content using html/bbcode

## Documentation

* [Changelog](docs/CHANGELOG.md)
* [Userguide](docs/en/userguide.md)
* Developing Guide
    * [Extending phpBB SiteMaker](docs/en/extending.md)
    * [Theming](docs/en/theming.md)
    * [Contributing](docs/en/contributing.md)

## Download && Installation

* Download the extension from [here](https://www.phpbb.com/customise/db/extension/phpbb_sitemaker_2/)
* Extract and upload it to your phpBB/ext/ folder so you have phpBB/ext/blitze/sitemaker
* Go to "ACP" > "Customise" > "Extensions" and enable the "phpBB Sitemaker" extension.

## Upgrade from phpBB Primetime

* Disable (do not Purge) phpBB Primetime
* Install phpBB Sitemaker as described above
* Purge phpBB Primetime

## Collaborate

* Create a issue in the [tracker](https://github.com/blitze/phpBB-ext-sitemaker/issues)
* Note the restrictions for [branch names](https://wiki.phpbb.com/Git#Branch_Names) and [commit messages](https://wiki.phpbb.com/Git#Commit_Messages) are similar to phpBB3
* Submit a [pull-request](https://github.com/blitze/phpBB-ext-sitemaker/pulls)

## Testing

We use Travis-CI as a continuous integration server and phpunit for our unit testing. See more information on the [phpBB development wiki](https://wiki.phpbb.com/Unit_Tests).

## License

[GPLv2](license.txt)
