# phpBB Primetime Extension

phpBB Primetime is an Extension for [phpBB 3.1](https://www.phpbb.com/)

[![Build Status](https://scrutinizer-ci.com/g/blitze/primetime/badges/build.png?b=develop)](https://scrutinizer-ci.com/g/blitze/primetime/build-status/develop) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/blitze/primetime/badges/quality-score.png?b=develop)](https://scrutinizer-ci.com/g/blitze/primetime/?branch=develop)

## Description

phpBB Primetime creates a CMS base around your phpBB 3.1 installation

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


## Installation

Requires npm

Clone into phpBB/ext/primetime/core:

    git clone https://github.com/blitze/primetime.git phpBB/ext/primetime/core

From command line go to primetime directory: 

    cd phpBB/ext/primetime/core

Install nodejs modules

    npm install

Install bower components

    bower install

Install vendors

    php composer.phar install --dev

Build scripts

    gulp build

Go to "ACP" > "Customise" > "Extensions" and enable the "phpBB Primetime" extension.

## Collaborate

* Create a issue in the [tracker](https://github.com/blitze/primetime/issues)
* Note the restrictions for [branch names](https://wiki.phpbb.com/Git#Branch_Names) and [commit messages](https://wiki.phpbb.com/Git#Commit_Messages) are similar to phpBB3
* Submit a [pull-request](https://github.com/blitze/primetime/pulls)

## Testing

We use Travis-CI as a continuous integration server and phpunit for our unit testing. See more information on the [phpBB development wiki](https://wiki.phpbb.com/Unit_Tests).

## License

[GPLv2](license.txt)
