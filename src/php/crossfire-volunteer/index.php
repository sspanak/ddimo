<?php
require_once '../__lib__/standard-page.php';
StandardPage::display(
	'Crossfire Volunteer',
	[
		'content_classes' => 'crossfire-volunteer-background',
		'scripts_inline' => ['crossfire-volunteer.js']
	]
);
