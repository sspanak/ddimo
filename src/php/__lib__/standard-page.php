<?php
require_once 'server.php';
require_once 'browser.php';
require_once 'script.php';


class StandardPage {
	public string $base_path = '';
	public string $base_url = '';
	public array $breadcrumbs = []; // string[]
	public bool $browser_is_text = false;
	public string $content = '';
	public string $content_classes = '';
	public string $lang = 'en';
	public string $title = '';
	public array $scripts_inline = []; // InlineScript[]
	public array $scripts_remote = []; // RemoteScript[]
	public string $site_name = '';

	public function __construct() {
		$this->browser_is_text = is_text_browser();
		$this->from_array((new Server)->to_array());
	}

	private function load_template(string $file): string {
		$base_path = $this->base_path;
		$base_url = $this->base_url;
		$browser_is_text = $this->browser_is_text;
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
			array_push($this->scripts_inline, new InlineScript($script));
		}
	}

	private function set_scripts_remote(array $scripts): void {
		$this->scripts_remote = [];
		foreach ($scripts as $script) {
			array_push($this->scripts_remote, new RemoteScript($script));
		}
	}

	private function generate_breadcrumbs(): array {
		$breadcrumbs = [];
		foreach (explode('/', "$this->site_name$this->base_path") as $segment) {
			$breadcrumbs[$segment] = implode('/', array_keys($breadcrumbs)) . "/$segment/";
		}

		return $breadcrumbs;
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
			trigger_error(__CLASS__ . " does not support '$var' variable.", E_USER_WARNING);
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
			trigger_error("'$file' is not a file or it cannot be opened for reading.", E_USER_WARNING);
			return $this;
		}

		if (!property_exists($this, $var)) {
			trigger_error(__CLASS__ . " does not support '$var' variable.", E_USER_WARNING);
		} else if ($var === 'scripts_inline' || $var === 'scripts_remote') {
			trigger_error("'$var' cannot be set using 'set_from_file()'.", E_USER_WARNING);
		} else {
			$this->$var = $this->load_template($file);
		}

		return $this;
	}

	public function to_string(): string {
		return $this->load_template(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'root.html.php');
	}

	public static function display(string $title, array $page_vars=[]) {
		$page = new StandardPage;

		echo $page
			->set('title', $title)
			->set('breadcrumbs', $page->generate_breadcrumbs())
			->from_array($page_vars)
			->set_from_file('content', 'content.html.php')
			->to_string();
	}
}
