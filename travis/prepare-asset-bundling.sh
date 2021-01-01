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

EXTNAME=$1

# Move eslint config back in place
cp ../tmp/.eslintrc phpBB/ext/$EXTNAME

# Move babel config back in place
cp ../tmp/.babelrc phpBB/ext/$EXTNAME

# Move yarn lock file back in place
cp ../tmp/yarn.lock phpBB/ext/$EXTNAME

# Install npm dependencies
yarn --cwd phpBB/ext/$EXTNAME install
