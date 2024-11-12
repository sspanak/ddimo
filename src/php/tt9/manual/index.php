<?php
require_once '../../__lib__/parsedown/helpers.php';
require_once '../../__lib__/standard-page.php';

$html = get_markdown_page_as_html('https://raw.githubusercontent.com/sspanak/tt9/master/docs/help/help.en.md');
$html = preg_replace('@href=".+?/docs/installation\.md"@', 'href="../installation/"', $html);

StandardPage::display(
	'Traditional T9',
	[ 'content' =>  $html ]
);
