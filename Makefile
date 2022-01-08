MAKEFLAGS += --no-print-directory
SHELL := /bin/bash

default:
	make tar

demo:
	make css-demo
	make images-demo
	cp src/demo.html dist/index.html

website:
	make css
	make js
	make images
	make downloads
	make php

css-demo:
	make css
	cat src/css/dev.css >> dist/dd.css

css:
	cat src/css/[0-8]*.css > dist/dd.css

js:
	bash -c build-tools/build-js.sh

images-demo:
	mkdir -p dist/img
	cp img/crossfire-volunteer/* dist/img/
	cp img/pendulum/help/* dist/img/

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
