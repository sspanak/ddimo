# README
Dimo Karaivanov's website. Personal projects and tools showcase.

### How do I get set up?

Requirements are as follows:

- PHP 5.4 or 7.0 _(7.0 recommended)_
- Apache 2.4
- mod-php7.0 _(or mod-php5, if you prefer the older PHP version)_

To get it running, simply upload to a directory of you choice and use the provided virtual host sample file. For easier upload, run `make`, to create a tarball containing only the necessary files.

### Generic server error pages
Use `make generic` to create a tarball of the standard site agnostic server pages. Then add `ErrorDocument xxx /xxx.html` to the `000-default.conf` standard virtual host to enable them.

### Code-style guidelines

Use the `.editorconfig` file.
