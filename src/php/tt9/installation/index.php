<?php
require_once '../../__lib__/parsedown/helpers.php';
require_once '../../__lib__/standard-page.php';

StandardPage::display(
	'Traditional T9 Installation Guide',
	[ 'content' => get_markdown_page_as_html('https://raw.githubusercontent.com/sspanak/tt9/master/docs/installation.md') ]
);
