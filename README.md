# What is this?
It is Dimo Karaivanov's website. Personal projects and tools showcase.

## Setup
Buliding is done via the `Makefile`. All production code is generated in the `dist/` folder. Have in mind some commands may fail on Mac.

#### On your computer:
- `$ npm install`
- `$ make tar`
- `$ scp ddimo.tar.bz2 the-server.com:/upload/dir/`.

##### On the server:
- `tar xf /upload/dir/ddimo.tar.bz2 -C /var/www/virtual-host-of-your-choice.com`
- Use the provided virtual host sample file to set up Apache.

### Requirements
- PHP 7.4
- Apache 2.4
- mod-php7.4

### Generic server error pages
Use `$ make generic` to create a tarball of the standard site agnostic server pages. Then add `ErrorDocument xxx /xxx.html` to the `000-default.conf` standard virtual host to enable them.

## Development
- `$ npm install`
- `$ make demo`: creates a HTML+CSS+JS demo in `dist/`. Useful when working only on the frontside.
- `$ make website`: generates the entire website, inculding the PHP part. Copy `dist/` to an Apache virtual host folder, setup the host using the `apache-vhost.conf.sample` file, then just open that host in your browser.
- `$ make clean`: cleans up all build files and tarballs.

### Code-style guidelines
- Use the `.editorconfig` file.
- Configure your editor to use ESLint and CSSLint (they will be installed with `npm install`).


## Philosophy
I have always been inspired by the simplicity of Wikipedia. And given my (and actually everyone's) everyday struggle against [website obesity](https://idlewords.com/talks/website_obesity.htm), I have created this small website, that does its job using a minimum amount of code. It is designed to load and work instantenously on any browser since IE11 (including Opera Mini on a Nokia barphone!).

It does not use Docker, Angular, React, Laravel or any frameworks, libraries or dependencies, because there is no need to. NPM is used only for generating and compressing the JS and the CSS.

By the power of the [LICENSE.md](LICENSE.md), use this website as a template to create your own small and efficient sites. However, [contributions to it](CONTRIBUTING.md) are unlikely to be accepted.
