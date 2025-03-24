<?php
require_once '../../__lib__/standard-page.php';
require_once '../github-page.php';

const TITLE = 'Traditional T9 Privacy Policy';

$html = (new GithubPage())->get_full_description();
$html = preg_replace('@[\s\S]+?(Privacy [pP]olicy)[^>]+>@', '<h2>'.TITLE.'</h2>', $html);
$html = preg_replace('@<li>.+?<\/li>\s*<li>.+?<\/li>\s*<\/ul>@', '</ul>', $html);
$html === null ? 'Failed loading the document' : '';

StandardPage::display(TITLE, [ 'content' =>  $html ]);
