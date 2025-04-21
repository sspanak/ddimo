<?php
require_once dirname(__FILE__).'/../../__lib__/parsedown/helpers.php';
require_once dirname(__FILE__).'/../../__lib__/standard-page.php';

preg_match('@/([a-z]{2})/?$@', $_SERVER['REQUEST_URI'], $matches, PREG_UNMATCHED_AS_NULL);
$url_language = @$matches[1];
$language = $url_language !== null && $url_language !== '' ? $url_language : 'en';


$html = get_markdown_page_as_html("https://raw.githubusercontent.com/sspanak/tt9/master/docs/help/help.$language.md");

$installation_path = $url_language !== null ? '../../installation/' : '../installation/';
$html = preg_replace('@href=".+?/docs/installation\.md"@', "href=\"$installation_path\"", $html);

StandardPage::display('Traditional T9 Manual', [ 'content' =>  $html ]);
