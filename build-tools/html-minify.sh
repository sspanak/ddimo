#!/bin/bash

cat \
	| tr --delete '\n\r' \
	| sed -r "s@[\t ]+@ @g" \
	| sed -r "s@(>|%\}|\}\}) (<|\{%|\{\{)@\1\2@g"
