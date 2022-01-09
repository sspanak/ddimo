<?php
require_once '../__lib__/htmlcontrol.php';
HTMLControl::load_standard_page(
	'Crossfire Volunteer',
	[
		'content_classes' => 'crossfire-volunteer-background',
		'scripts_inline' => ['crossfire.js']
	]
);
