<?php
require_once '../__lib__/standard-page.php';
require_once '../__lib__/parsedown/Parsedown.php';

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

$github_base_url = 'https://raw.githubusercontent.com/sspanak/tt9/master';

$markdown = file_get_contents("$github_base_url/README.md");
$markdown = str_replace('src="screenshots/', "src=\"$github_base_url/screenshots/", $markdown);

StandardPage::display(
	'Traditional T9',
	['content' => Parsedown::instance()->setBreaksEnabled(true)->text($markdown)]
);
