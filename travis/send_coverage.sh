#!/bin/bash

set -e
set -x

DB=$1
TRAVIS_PHP_VERSION=$2

if [ "$TRAVIS_PHP_VERSION" == "5.4" -a "$DB" == "mysqli" ]
then
    phpBB/ext/$EXTNAME/vendor/bin/test-reporter
    phpBB/ext/$EXTNAME/vendor/bin/coveralls -v
fi