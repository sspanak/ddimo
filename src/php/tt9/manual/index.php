<?php
require_once '../../__lib__/parsedown/helpers.php';
require_once '../../__lib__/standard-page.php';

preg_match('@^[a-z]{2}@', $_GET['l'], $matches, PREG_UNMATCHED_AS_NULL);
$language = @$matches[0];
$language = $language !== null && $language !== '' ? $language : 'en';


$html = get_markdown_page_as_html("https://raw.githubusercontent.com/sspanak/tt9/master/docs/help/help.$language.md");
$html = preg_replace('@href=".+?/docs/installation\.md"@', 'href="../installation/"', $html);

StandardPage::display('Traditional T9 Manual', [ 'content' =>  $html ]);
