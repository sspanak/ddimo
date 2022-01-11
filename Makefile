MAKEFLAGS += --no-print-directory
SHELL := /bin/bash

demo:
	make css
	make js-debug
	cat src/css/debug.css >> dist/ddimo.css
	make images
	cp src/demo.html dist/index.html

website:
	make css
	make js
	make images
	make downloads
	make php

css:
	cat src/css/[0-9]*.css > dist/ddimo.css

js:
	bash -c build-tools/build-js.sh

js-debug:
	bash -c "build-tools/build-js.sh --debug"

images:
	cp -r img/* dist/

php:
	cp -r src/php/* dist/

downloads:
	mkdir -p dist/crossfire-volunteer/
	cp download/igra-alpha.zip dist/crossfire-volunteer/

# all:
# 	make tar
# 	tar rv -f ddimo.tar apache-vhost.conf.sample
# 	bzip2 -9 ddimo.tar

tar:
	make clean && make website && \
	tar cv \
		--exclude='.gitkeep' --exclude='.git' --exclude='Makefile' --exclude='README.md' \
		--exclude='sftp-config.json' \
		-f ddimo.tar \
		--transform s/dist/ddimo.eu/ \
		dist/

	bzip2 -9 ddimo.tar

clean:
	rm -rf dist/*
	rm -f ddimo.tar ddimo.tar.bz2

# generic:
# 	make clean-generic

# 	mkdir -p __tmp_build
# 	bash -c './minify.sh standard-pages/ __tmp_build/'
# 	tar c \
# 		-f generic.tar \
# 		--transform s/__tmp_build/default/ \
# 		__tmp_build
# 	bzip2 -9 generic.tar
# 	rm -rf __tmp_build

# clean-generic:
# 	rm -f generic.tar; rm -f generic.tar.bz2
