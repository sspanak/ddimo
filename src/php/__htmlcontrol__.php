<?php
class HTMLControl {
	private $ROOT, $base_url, $site_name, $base_path, $last_error;
	protected $lang, $title, $head, $content;

	public function __construct(){
		$this->lang = '';
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

	public static function load_standard_page($title='', $include_files=[], $lang='en') {
		$html = new HTMLControl;
		$html->set('lang', $lang);
		$html->set('title', $title);
		$html->set('include_files', $include_files);
		$html->set_from_file('content', 'content.html.php');
		echo $html->build_page();
	}

	public function build_breadcrumbs() {
		$breadcrumbs = [];
		foreach (explode('/', "$this->site_name$this->base_path") as $segment) {
			$breadcrumbs[$segment] = implode('/', array_keys($breadcrumbs)) . "/$segment/";
		}

		return $breadcrumbs;
	}

	public function set($var, $value){
		if (!property_exists($this, $var)){
			$this->last_error = __CLASS__ . " не поддържа променлива с име '$var'.";
			return false;
		}

		$this->$var = $value;
		return true;
	}

	public function set_from_file($var, $file){
		if (!property_exists($this, $var)){
			$this->last_error = __CLASS__ . " не поддържа променлива с име '$var'.";
			return false;
		}

		if (!is_file($file) || !is_readable($file)){
			$this->last_error = "'$file' не е файл или не може да се отвори за четене.";
			return false;
		}

		$this->$var = $this->load_file($file);
		return true;
	}

	public function build_page(){
		return $this->load_file($this->ROOT . DIRECTORY_SEPARATOR . '__standard__.html.php');
	}

	public function error(){
		return $this->last_error;
	}

	private function load_file($file){
		$title = $this->title;
		$lang = $this->lang;
		$include_files = $this->include_files;
		$breadcrumbs = $this->build_breadcrumbs();
		$content = $this->content;
		$site_name = $this->site_name;
		$base_url = $this->base_url;
		$base_path = $this->base_path;

		ob_start();

		include $file;

		$html = ob_get_clean();

		unset($title, $lang, $content, $head, $base_url, $site_name, $base_path);

		return $html;
	}
}
