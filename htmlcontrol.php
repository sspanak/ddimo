<?php
class HTMLControl {
	private $ROOT, $base_url, $site_name, $base_path;
	protected $lang, $title, $head, $body;

	public function __construct(){
		$this->lang = 'en';
		$this->title = 'Dimo Karaivanov\'s website';
		$this->head = '';
		$this->body = '';

		$this->ROOT = dirname(__FILE__);
		$this->site_name = $_SERVER['SERVER_NAME'];
		$this->base_url = 'http://localhost/ddimo';

		$this->base_path = $_SERVER['SCRIPT_NAME'];
		$this->base_path = preg_replace('@\?.+@', '', $this->base_path);
		$this->base_path = preg_replace('@/$@', '', dirname($this->base_path));
	}

	public function задай($променлива, $стойност){
		if (!property_exists($this, $променлива))
			return false;

		$this->$променлива = $стойност;
		return true;
	}

	public function задайОтФайл($променлива, $файл){
		if (!property_exists($this, $променлива))
			return false;

		if (!is_file($файл) || !is_readable($файл))
			return false;

		$this->$променлива = $this->заредиФайл($файл);
		return true;
	}

	public function постройСтраница(){
		return $this->заредиФайл($this->ROOT . DIRECTORY_SEPARATOR . 'skelet.html');
	}

	private function заредиФайл($файл){
		$title = $this->title;
		$lang = $this->lang;
		$body = $this->body;
		$head = $this->head;
		$site_name = $this->site_name;
		$base_url = $this->base_url;
		$base_path = $this->base_path;

		ob_start();

		include $файл;

		$html = ob_get_clean();

		unset($title, $lang, $body, $head, $base_url, $site_name, $base_path);

		return $html;
	}
}
