<?php
require_once '../__lib__/htmlcontrol.php';
HTMLControl::load_standard_page(
	'График на личните лекари',
	[
		'lang' => 'bg',
		'scripts_inline' => ['doftor.js']
	]
);
