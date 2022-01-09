<?php
require_once '../__lib__/standard-page.php';
StandardPage::display(
	'Pendulum Simulator',
	[
		'scripts_remote' => [['url' => 'pendulum.js', 'async' => true]]
	]
);
