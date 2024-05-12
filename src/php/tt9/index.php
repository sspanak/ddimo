<?php
require_once '../__lib__/standard-page.php';
require_once '../__lib__/browser.php';
require_once '../__lib__/parsedown/Parsedown.php';

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


$github_base_url = 'https://raw.githubusercontent.com/sspanak/tt9/master';
$Parsedown = Parsedown::instance()->setBreaksEnabled(true);


// readme
$readme = file_get_contents("$github_base_url/README.md");
$readme_matches = [];


// readme -> install
preg_match('@##[^\n]+Install\n([^#]+)@', $readme, $readme_matches);
$install = count($readme_matches) > 1 ? trim($readme_matches[1]) : '';
$install = preg_replace('@\[([^]]+)\]\(([^)]+)\)@', '<a href="$2">$1</a>', $install);
$install = str_replace('src="!RAW', "src=\"$github_base_url/!RAW", $install);
$install = preg_replace('@\n\n@', '<br/>', $install);
$install = is_text_browser() ? str_replace('></a>', '></a><br/>', $install) : $install;


// readme -> support
preg_match('@##[^\n]+Support\n([^#]+)@', $readme, $readme_matches);
$support = count($readme_matches) > 1 ? trim($readme_matches[1]) : '';


// readme -> system requirements
preg_match('@##[^\n]+System Requirements\n([^#]+)@', $readme, $readme_matches);
$system_requirements = count($readme_matches) > 1 ? trim($readme_matches[1]) : '';


StandardPage::display(
	'Traditional T9',
	[
		'custom_vars' => [
			'full_description' => $Parsedown->text(file_get_contents("$github_base_url/fastlane/metadata/android/en-US/full_description.txt")),
			'support' => $Parsedown->text($support),
			'system_requirements' => $Parsedown->text($system_requirements),
			'install' => $install,
		]
	]
);
