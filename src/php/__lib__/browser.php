<?php
function is_text_browser(): bool {
	$agent = @$_SERVER['HTTP_USER_AGENT'];
	if (!$agent) {
		return false;
	}

	return strpos($agent, 'Lynx/') !== false || strpos($agent, 'w3m') !== false || strpos($agent, 'Links (') !== false;
}
