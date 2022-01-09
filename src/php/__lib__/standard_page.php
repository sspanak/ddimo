<?php
class RemoteScript {
	public bool $async = false;
	public bool $defer = false;
	public string $url = '';

	public function __construct(array $array) {
		if (array_key_exists('url', $array) && is_string($array['url'])) {
			$this->url = $array['url'];
		}
		$this->defer = array_key_exists('defer', $array) ? !!$array['defer'] : $this->defer;
		$this->async = array_key_exists('async', $array) ? !!$array['async'] : $this->async;
	}
}

class StandardPage {
	public string $base_path = '';
	public string $base_url = '';
	public array $breadcrumbs = []; // string[]
	public string $content = '';
	public string $content_classes = '';
	public string $lang = 'en';
	public string $title = '';
	public array $scripts_inline = []; // string[]
	public array $scripts_remote = []; // RemoteScript[]
	public string $site_name = '';

	private function load_template(string $file): string {
		$base_path = $this->base_path;
		$base_url = $this->base_url;
		$breadcrumbs = $this->breadcrumbs;
		$content = $this->content;
		$content_classes = $this->content_classes;
		$lang = $this->lang;
		$title = $this->title;
		$scripts_inline = $this->scripts_inline;
		$scripts_remote = $this->scripts_remote;
		$site_name = $this->site_name;

		ob_start();
		include $file;
		return ob_get_clean();
	}

	private function set_scripts_inline(array $scripts): void {
		$this->scripts_inline = [];
		foreach ($scripts as $script) {
			$script_contents = file_get_contents($script);
			if ($script_contents === false) {
				error_log("'$script' не може да бъде прочетен като файл с javascript.");
			}
			array_push($this->scripts_inline, $script_contents);
		}
	}

	private function set_scripts_remote(array $scripts): void {
		$this->scripts_remote = [];
		foreach ($scripts as $script) {
			array_push($this->scripts_remote, new RemoteScript($script));
		}
	}

	public function from_array(array $array): StandardPage {
		foreach (get_object_vars($this) as $property => $val) {
			if (!array_key_exists($property, $array)) {
				continue;
			}

			if ($property === 'scripts_inline') {
				$this->set_scripts_inline($array[$property]);
			} else if ($property === 'scripts_remote') {
				$this->set_scripts_remote($array[$property]);
			} else {
				$this->$property = $array[$property];
			}
		}

		return $this;
	}

	public function set(string $var, $value): StandardPage {
		if (!property_exists($this, $var)) {
			error_log(__CLASS__ . " не поддържа променлива с име '$var'.");
		} else if ($var === 'scripts_inline')  {
			$this->$var = $this->set_scripts_inline($value);
		} else if ($var === 'scripts_remote') {
			$this->$var = $this->set_scripts_remote($value);
		}
		else {
			$this->$var = $value;
		}

		return $this;
	}

	public function set_from_file(string $var, string $file): StandardPage {
		if (!is_file($file) || !is_readable($file)) {
			error_log("'$file' не е файл или не може да се отвори за четене.");
			return $this;
		}

		if (!property_exists($this, $var)) {
			error_log(__CLASS__ . " не поддържа променлива с име '$var'.");
		} else if ($var === 'scripts_inline' || $var === 'scripts_remote') {
			error_log("'$var' не може да се задава със 'set_from_file()'.");
		} else {
			$this->$var = $this->load_template($file);
		}

		return $this;
	}

	public function generate(): string {
		return $this->load_template(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'standard_html.php');
	}
}
