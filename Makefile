MAKEFLAGS += --no-print-directory
SHELL := /bin/bash

demo:
	@make js-debug
	@make css-debug
	cat src/css/debug.css >> dist/ddimo.css
	@make images
	cat src/demo.html | build-tools/append-resources-version.sh > dist/index.html

website:
	@make js
	@make php
	@make css
	@make images
	@make docs
	@make downloads

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
	@bash -c build-tools/build-js.sh

js-debug:
	@bash -c "build-tools/build-js.sh --debug"

images:
	cp -r img/* dist/

php:
	@printf 'Copying PHP... ' && \
		cp -r src/php/* dist/ && \
		echo 'OK' && \
	build-tools/html-build.sh src/php dist */*.html.php && \
	printf 'Writing version info... ' && \
		cat src/php/__lib__/root.html.php | build-tools/html-minify.sh | build-tools/append-resources-version.sh > dist/__lib__/root.html.php && \
		echo 'OK'

downloads:
	mkdir -p dist/crossfire-volunteer/
	cp download/igra-alpha.zip dist/crossfire-volunteer/

tar:
	@make clean && make website && \
	printf 'Creating a tarball... ' && \
		tar c \
			--exclude='.gitkeep' \
			-f ddimo.tar \
			--transform s/dist/ddimo.eu/ \
			dist/ && \
		tar r -f ddimo.tar LICENSE.txt && \
		bzip2 -9 ddimo.tar && \
		echo 'OK'

generic:
	@make clean && \
	build-tools/html-build.sh src/generic-pages dist *.html && \
	printf 'Creating a tarball... ' && \
		tar c \
			--exclude='.gitkeep' \
			-f generic.tar \
			--transform s/dist/default/ \
			dist && \
		bzip2 -9 generic.tar && \
		echo 'OK'


docs:
	bash -c build-tools/update-docs.sh

clean:
	rm -rf dist/*;
	rm -f ddimo.tar ddimo.tar.bz2
	rm -f generic.tar;
	rm -f generic.tar.bz2

serve:
	cd dist/ && python3 -m http.server 3000
