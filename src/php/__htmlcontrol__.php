<?php
class HTMLControl {
	private $ROOT, $base_url, $site_name, $base_path, $last_error;
	protected $lang, $title, $head, $content;

	public function __construct(){
		$this->lang = 'en';
		$this->title = '';
		$this->include_files = [];
		$this->content = '';
		$this->last_error = '';

		$this->ROOT = dirname(__FILE__);
		$this->site_name = $_SERVER['SERVER_NAME'];
		$this->base_url = '//' . $this->site_name;

		$this->base_path = $_SERVER['SCRIPT_NAME'];
		$this->base_path = preg_replace('@\?.+@', '', $this->base_path);
		$this->base_path = preg_replace('@/$@', '', dirname($this->base_path));
	}

	public static function load_standard_page($title='', $include_files=[]) {
		$html = new HTMLControl;
		$html->задай('title', $title);
		$html->задай('include_files', $include_files);
		$html->задайОтФайл('content', 'content.html.php');
		echo $html->постройСтраница();
	}

	public function build_breadcrumbs() {
		$breadcrumbs = [];
		foreach (explode('/', "$this->site_name$this->base_path") as $segment) {
			$breadcrumbs[$segment] = implode('/', array_keys($breadcrumbs)) . "/$segment/";
		}

		return $breadcrumbs;
	}

	public function задай($променлива, $стойност){
		if (!property_exists($this, $променлива)){
			$this->last_error = __CLASS__ . " не поддържа променлива с име '$променлива'.";
			return false;
		}

		$this->$променлива = $стойност;
		return true;
	}

	public function задайОтФайл($променлива, $файл){
		if (!property_exists($this, $променлива)){
			$this->last_error = __CLASS__ . " не поддържа променлива с име '$променлива'.";
			return false;
		}

		if (!is_file($файл) || !is_readable($файл)){
			$this->last_error = "'$файл' не е файл или не може да се отвори за четене.";
			return false;
		}

		$this->$променлива = $this->заредиФайл($файл);
		return true;
	}

	public function постройСтраница(){
		return $this->заредиФайл($this->ROOT . DIRECTORY_SEPARATOR . '__skelet__.html.php');
	}

	public function грешка(){
		return $this->last_error;
	}

	private function заредиФайл($файл){
		$title = $this->title;
		$lang = $this->lang;
		$include_files = $this->include_files;
		$breadcrumbs = $this->build_breadcrumbs();
		$content = $this->content;
		$site_name = $this->site_name;
		$base_url = $this->base_url;
		$base_path = $this->base_path;

		ob_start();

		include $файл;

		$html = ob_get_clean();

		unset($title, $lang, $content, $head, $base_url, $site_name, $base_path);

		return $html;
	}
}
