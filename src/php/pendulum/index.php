<?php
require_once '../__lib__/htmlcontrol.php';
HTMLControl::load_standard_page(
	'Pendulum Simulator',
	[
		'scripts_remote' => [['url' => 'pendulum.js', 'async' => true]]
	]
);
