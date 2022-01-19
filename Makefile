MAKEFLAGS += --no-print-directory
SHELL := /bin/bash

demo:
	make js-debug
	make css-debug
	cat src/css/debug.css >> dist/ddimo.css
	make images
	cp src/demo.html dist/index.html

website:
	make js
	make css
	make images
	make downloads
	make php

css-debug:
	cp src/css/legacy.css dist/ddimo.css
	node build-tools/css-convert-legacy.js src/css/11-colors.css >> dist/ddimo.css
	cat src/css/[0-9]*.css >> dist/ddimo.css

css:
	make css-debug
	npx csso dist/ddimo.css > dist/mini.css && mv dist/mini.css dist/ddimo.css

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

serve:
	cd dist/ && python3 -m http.server 3000

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
