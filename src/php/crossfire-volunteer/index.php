<?php
require_once '../__lib__/standard-page.php';
StandardPage::display(
	'Crossfire Volunteer',
	[
		'content_classes' => 'crossfire-volunteer-background',
		'scripts_inline' => [
			[ 'module' => true, 'script' => 'crossfire-volunteer.js' ],
			[ 'module' => false, 'script' => 'crossfire-volunteer.legacy.js' ]
		]
	]
);
