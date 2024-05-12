<?php
require_once '../../__lib__/standard-page.php';
require_once '../../__lib__/parsedown/Parsedown.php';

$markdown = file_get_contents('https://raw.githubusercontent.com/sspanak/tt9/master/docs/user-manual.md');

// @todo: вътрешните връзки не работят
// @todo: оправи малко стиловете

StandardPage::display(
	'Traditional T9',
	[ 'content' => Parsedown::instance()->setBreaksEnabled(true)->text($markdown) ]
);
