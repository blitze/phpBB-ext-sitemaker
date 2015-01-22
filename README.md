# phpBB Primetime Extension

phpBB Primetime is an Extension for [phpBB 3.1](https://www.phpbb.com/)

[![Build Status](https://travis-ci.org/blitze/primetime.svg?branch=develop)](https://travis-ci.org/blitze/primetime)

## Description

phpBB Primetime creates a CMS base around your phpBB 3.1 installation

## Features

* Customize your site using blocks of content
* Drag and drop interface for adding/removing blocks
* Customizable block display - background color, title, etc


## Installation

Requires npm

Clone into phpBB/ext/primetime/base:

    git clone https://github.com/blitze/primetime.git phpBB/ext/primetime/base

From command line go to primetime directory: 

    cd phpBB/ext/primetime/base

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
