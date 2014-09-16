<?php
class HTMLControl {
	private $ROOT, $base_url;
	protected  $lang, $title, $head, $body;

	public function __construct(){
		$this->lang = 'en';
		$this->title = 'Dimo Karaivanov\'s website';
		$this->head = '';
		$this->body = '';

		$this->ROOT = dirname(__FILE__);
		$this->base_url = $_SERVER['SERVER_NAME'];
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
		$base_url = $this->base_url;

		ob_start();

		include $файл;

		$html = ob_get_clean();

		unset($title, $lang, $body, $head, $base_url);

		return $html;
	}
}
