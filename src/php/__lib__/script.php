<?php
class RemoteScript {
	public bool $async = false;
	public bool $defer = false;
	public ?bool $module = null;
	public string $url = '';

	public function __construct(array $array) {
		$this->async = array_key_exists('async', $array) ? !!$array['async'] : $this->async;
		$this->defer = array_key_exists('defer', $array) ? !!$array['defer'] : $this->defer;
		$this->module = array_key_exists('module', $array) ? !!$array['module'] : $this->module;
		if (array_key_exists('url', $array) && is_string($array['url'])) {
			$this->url = $array['url'];
		}
	}
}

class InlineScript {
	public ?bool $module = null;
	public string $script = '';

	public function __construct(array $array) {
		$this->module = array_key_exists('module', $array) ? !!$array['module'] : $this->module;

		$script_path = @$array['script'];
		if (!is_string($script_path) || !is_file($script_path) || !is_readable($script_path)) {
			trigger_error("'$script_path' can not be opened and attached as inline javascript.", E_USER_WARNING);
			$this->script = '';
		} else {
			$this->script = file_get_contents($script_path);
		}
	}
}
