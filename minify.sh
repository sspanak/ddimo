#!/bin/bash

input_dir=`echo $1 | sed -e 's|/$||'`
output_dir=`echo $2 | sed -e 's|/$||'`

if ! [[ -d $input_dir && -d $output_dir ]]
then
	echo 'Minifies all HTML files in one directory and outputs them to another.'
	echo 'Usage:'
	echo "  $0 INPUT_DIR OTPUT_DIR"
	exit 42
fi

for f in $input_dir/*.html;
do
	filename=`basename $f`
	cat $f \
		| tr --delete '\n\t' \
		| sed -r -e 's|[[:space:]]+| |g' \
		| sed -e 's|> |>|g' \
		| sed -e 's| <|<|g'	> $output_dir/$filename
done
