<?php
require_once '../__lib__/standard-page.php';
StandardPage::display(
	'Pendulum Simulator',
	[
		'content_classes' => 'no-script',
		'scripts_remote' => [
			[ 'async' => true, 'module' => true, 'url' => 'pendulum.js' ],
			[ 'async' => true, 'module' => false, 'url' => 'pendulum.legacy.js' ]
		]
	]
);
