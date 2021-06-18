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

NOTESTS=$1

if [ "$NOTESTS" == "1" ]
then
	composer require \
		--working-dir=phpBB \
		--dev \
		--no-interaction \
		--ignore-platform-reqs \
		phpbb/epv:dev-master
fi
