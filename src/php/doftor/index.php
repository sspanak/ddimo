<?php
require_once '../__lib__/standard-page.php';
StandardPage::display(
	'График на личните лекари',
	[
		'content_classes' => 'no-script',
		'lang' => 'bg',
		'scripts_inline' => [
			[ 'module' => true, 'script' => 'doftor.js' ],
			[ 'module' => false, 'script' => 'doftor.legacy.js' ]
		]
	]
);
