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
	echo '"use strict";' > dist/$PAGE_NAME/compiled.js
	cat $d/*.js >> dist/$PAGE_NAME/compiled.js

	if $DEBUG ; then
		mv dist/$PAGE_NAME/compiled.js dist/$PAGE_NAME/$PAGE_NAME.js
	else
		npx babel dist/$PAGE_NAME/compiled.js | npx terser -c passes=2 > dist/$PAGE_NAME/$PAGE_NAME.js
	fi

	rm -f dist/$PAGE_NAME/compiled.js
done

