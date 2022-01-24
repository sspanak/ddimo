<?php
class Server {
	private string $base_path;
	private string $base_url;
	private string $site_name;

	public function __construct(){
		$this->site_name = $_SERVER['SERVER_NAME'];
		$this->base_url = "//$this->site_name" ;

		$this->base_path = preg_replace('@\?.+@', '', $_SERVER['SCRIPT_NAME']);
		$this->base_path = preg_replace('@/$@', '', dirname($this->base_path));
	}

	public function to_array(): array {
		return get_object_vars($this);
	}
}
