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
$install = str_replace('docs/installation.md', "installation", $install);
$install = is_text_browser() ? str_replace('></a>', '></a><br/>', $install) : $install;

// readme -> compatibility
preg_match('@##[^\n]+Compatibility\n([^#]+)@', $readme, $readme_matches);
$compatibility = count($readme_matches) > 1 ? trim($readme_matches[1]) : '';


// readme -> how to use
preg_match('@#[^\n]+How to Use[^\n]+\n([\s\S]+?)##@', $readme, $readme_matches);
$how_to_use = count($readme_matches) > 1 ? trim($readme_matches[1]) : '';
$how_to_use = str_replace('docs/user-manual.md', "manual", $how_to_use);


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
			'compatibility' => $Parsedown->text($compatibility),
			'full_description' => $Parsedown->text(file_get_contents("$github_base_url/fastlane/metadata/android/en-US/full_description.txt")),
			'how_to_use' => $Parsedown->text($how_to_use),
			'install' => $install,
			'support' => $Parsedown->text($support),
			'system_requirements' => $Parsedown->text($system_requirements),
		],
		'scripts_inline' => [
				[ 'module' => true, 'script' => 'tt9.js' ],
				[ 'module' => false, 'script' => 'tt9.legacy.js' ]
		],
	]
);
