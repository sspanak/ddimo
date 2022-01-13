#!/bin/bash

cat | sed -r -e "s@\s*([,;:>{}])\s*@\1@g" \
| tr --delete '\n\t' \
| sed -r -e "s@\/\*+[^\/]+\*\/@@g" \
| sed -r -e "s@\/\*[^!][^\*]+\*\/@@g"
