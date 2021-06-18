#!/bin/bash
#
# This file is part of the phpBB Forum Software package.
#
# @copyright (c) phpBB Limited <https://www.phpbb.com>
# @license GNU General Public License, version 2 (GPL-2.0)
#
# For full copyright and license information, please see
# the docs/CREDITS.txt file.
#
set -e
set -x

DB=$1
TRAVIS_PHP_VERSION=$2
EXTNAME=$3

if [ "$TRAVIS_PHP_VERSION" == "5.5" -a "$DB" == "mysqli" ]
then
	sed -n '1h;1!H;${;g;s/<\/php>/<\/php>\n\t<filter>\n\t\t<whitelist>\n\t\t\t<directory>..\/<\/directory>\n\t\t\t<exclude>\n\t\t\t\t<directory>..\/tests\/<\/directory>\n\t\t\t\t<directory>..\/language\/<\/directory>\n\t\t\t\t<directory>..\/migrations\/<\/directory>\n\t\t\t<\/exclude>\n\t\t<\/whitelist>\n\t<\/filter>/g;p;}' phpBB/ext/$EXTNAME/travis/phpunit-mysqli-travis.xml &> phpBB/ext/$EXTNAME/travis/phpunit-mysqli-travis.xml.bak
	cp phpBB/ext/$EXTNAME/travis/phpunit-mysqli-travis.xml.bak phpBB/ext/$EXTNAME/travis/phpunit-mysqli-travis.xml
fi
