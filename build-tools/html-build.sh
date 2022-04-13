#!/bin/bash

if [ $# -lt 3 ]; then
	echo "Usage: $0 source/directory destination/directory *.html"
	echo 'Minifies all files matching a given pattern and writies the result to a given directory.'
	exit 1
fi

if ! [[ -d $1 ]]; then
	echo "Source directory: '$1' does not exist"
	exit 2
fi

if ! [[ -d $2 ]]; then
	echo "Destination directory: '$2' does not exist"
	exit 2
fi

ls $1/$3 > /dev/null 2>&1 || (echo "No such files: '$1/$3'"; exit 2)


for src_file in $1/$3;
do
	printf "Minifiying $src_file... " \
		&& dist_file="${src_file/$1/$2}" \
		&& mkdir -p `dirname $dist_file` \
		&& cat $src_file | build-tools/html-minify.sh > $dist_file \
		&& echo 'OK'
done
