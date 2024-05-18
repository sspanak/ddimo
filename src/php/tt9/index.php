<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../__lib__/standard-page.php';
require_once 'github-page.php';

$github_page = new GithubPage();
$github_page->get_screenshots();

StandardPage::display(
	'Traditional T9',
	[
		'custom_vars' => [
			'compatibility' => $github_page->get_compatibility_section(),
			'full_description' => $github_page->get_full_description(),
			'how_to_use' => $github_page->get_how_to_use_section(),
			'install' => $github_page->get_install_section(),
			'support' => $github_page->get_support_section(),
			'system_requirements' => $github_page->get_system_requirements_section(),
		],
		'scripts_inline' => [
				[ 'module' => true, 'script' => 'tt9.js' ],
				[ 'module' => false, 'script' => 'tt9.legacy.js' ]
		],
	]
);
