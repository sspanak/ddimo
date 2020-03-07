MAKEFLAGS += --no-print-directory
SHELL := /bin/bash

default:
	make tar
	bzip2 -9 ddimo.tar

all:
	make tar
	tar rv -f ddimo.tar apache-vhost.conf.sample
	bzip2 -9 ddimo.tar

tar:
	make clean
	tar cv \
		--exclude='.gitkeep' --exclude='.git' --exclude='Makefile' --exclude='README.md' \
		--exclude='sftp-config.json' \
		-f ddimo.tar \
		--transform s/src/ddimo.eu/ \
		src/

clean:
	rm -f ddimo.tar; rm -f ddimo.tar.bz2

generic:
	make clean-generic

	mkdir -p __tmp_build
	bash -c './minify.sh standard-pages/ __tmp_build/'
	tar c \
		-f generic.tar \
		--transform s/__tmp_build/default/ \
		__tmp_build
	bzip2 -9 generic.tar
	rm -rf __tmp_build

clean-generic:
	rm -f generic.tar; rm -f generic.tar.bz2
