#!/bin/bash
cat | sed -r -e "s@\?v=007\"@?v=$(git log -n 1 --pretty=format:'%h')\"@g"
