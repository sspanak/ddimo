MAKEFLAGS += --no-print-directory
SHELL := /bin/bash

demo:
	make js-debug
	make css-debug
	cat src/css/debug.css >> dist/ddimo.css
	make images
	cat src/demo.html | build-tools/append-resources-version.sh > dist/index.html

website:
	make docs
	make js
	make css
	make images
	make downloads
	make php

css-debug:
	@printf 'Building CSS... ' && \
		node build-tools/css-convert-legacy.js src/css/11-colors.css > dist/ddimo.css && \
		cat src/css/[0-9]*.css >> dist/ddimo.css && \
	echo 'OK'

css:
	@make css-debug && \
	printf 'Minifying CSS... ' && \
		cat dist/ddimo.css | node build-tools/css-minify.js > dist/mini.css && \
		mv dist/mini.css dist/ddimo.css && \
	echo 'OK'

js:
	bash -c build-tools/build-js.sh

js-debug:
	bash -c "build-tools/build-js.sh --debug"

images:
	cp -r img/* dist/

php:
	cp -r src/php/* dist/
	cat src/php/__lib__/root.html.php | build-tools/append-resources-version.sh > dist/__lib__/root.html.php

downloads:
	mkdir -p dist/crossfire-volunteer/
	cp download/igra-alpha.zip dist/crossfire-volunteer/

tar:
	make clean && make website && \
	tar cv \
		--exclude='.gitkeep' \
		-f ddimo.tar \
		--transform s/dist/ddimo.eu/ \
		dist/
	tar rv -f ddimo.tar LICENSE.txt

	bzip2 -9 ddimo.tar

generic:
	make clean

	bash -c './build-tools/minify-html.sh src/generic-pages/ dist/'
	tar c \
		--exclude='.gitkeep' \
		-f generic.tar \
		--transform s/dist/default/ \
		dist
	bzip2 -9 generic.tar

docs:
	bash -c build-tools/update-docs.sh

clean:
	rm -rf dist/*;
	rm -f ddimo.tar ddimo.tar.bz2
	rm -f generic.tar;
	rm -f generic.tar.bz2

serve:
	cd dist/ && python3 -m http.server 3000


