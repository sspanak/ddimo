#!/bin/bash

if ! [[ -f Makefile && -d src/js ]]
then
	echo "Please run this script from the root project directory."
	exit 1
fi



for d in src/js/*;
do
	PAGE_NAME=`basename $d`

	ls $d/*.js > /dev/null \
	&& mkdir -p dist/$PAGE_NAME \
	&& cat $d/*.js > dist/$PAGE_NAME/$PAGE_NAME.js
done

