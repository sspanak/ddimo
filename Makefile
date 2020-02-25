MAKEFLAGS += --no-print-directory
SHELL := /bin/bash

default:
	make tar

tar:
	make clean
	tar cv \
		--exclude='.gitkeep' --exclude='.git' --exclude='Makefile' --exclude='README.md' \
		--exclude='sftp-config.json' \
		-f ddimo.tar \
		--transform s/src/ddimo.eu/ \
		src/
	tar rv -f ddimo.tar apache-vhost.conf.sample
	bzip2 -9 ddimo.tar

clean:
	rm -f ddimo.tar; rm -f ddimo.tar.bz2
