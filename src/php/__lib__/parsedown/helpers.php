<?php
require_once 'Parsedown.php';

function add_header_ids($html) {
	return preg_replace_callback(
		'@<h(\d)>([^<]+)@',
		function ($matches) {
			$id = preg_replace('@[^a-z\d]+@', '-', strtolower($matches[2]));
			return "<h$matches[1] id=\"$id\">$matches[2]";
		},
		$html
	);
}

function get_markdown_page_as_html(string $url) {
	$markdown = file_get_contents($url);
	$html = Parsedown::instance()->setBreaksEnabled(true)->text($markdown);

	return add_header_ids($html);
}
