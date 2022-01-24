#!/bin/bash

if ! [[ -f Makefile && -f LICENSE.txt ]]
then
	echo "Please run this script from the root project directory."
	exit 1
fi

year=`date +"%Y"`
sed -r -i "s/^Copyright 2[0-9]{3}/Copyright $year/" LICENSE.txt

