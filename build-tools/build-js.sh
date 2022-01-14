#!/bin/bash

if ! [[ -f Makefile && -d src/js ]]
then
	echo "Please run this script from the root project directory."
	exit 1
fi

if [[ $1 == '--debug' ]]; then
	DEBUG=true
else
	DEBUG=false
fi


for d in src/js/*;
do
	ls $d/*.js 2> /dev/null 1> /dev/null || continue

	PAGE_NAME=`basename $d`
	mkdir -p dist/$PAGE_NAME

	printf "Compiling JS for '$PAGE_NAME'... " \
		&& echo '"use strict";' > dist/$PAGE_NAME/compiled.js \
		&& cat $d/*.js >> dist/$PAGE_NAME/compiled.js \
		&& npx babel dist/$PAGE_NAME/compiled.js > dist/$PAGE_NAME/legacy.js \
		&& echo 'OK'

	if $DEBUG ; then
		mv dist/$PAGE_NAME/compiled.js dist/$PAGE_NAME/$PAGE_NAME.js
		mv dist/$PAGE_NAME/legacy.js dist/$PAGE_NAME/$PAGE_NAME.legacy.js
	else
		printf "Minifying JS in 'dist/$PAGE_NAME'... " \
			&& cat dist/$PAGE_NAME/compiled.js | npx terser -c passes=2,ecma=2018 > dist/$PAGE_NAME/$PAGE_NAME.js \
			&& cat dist/$PAGE_NAME/legacy.js | npx terser -c passes=2 > dist/$PAGE_NAME/$PAGE_NAME.legacy.js \
			&& echo 'OK'

		rm -f dist/$PAGE_NAME/compiled.js dist/$PAGE_NAME/legacy.js
	fi
done
