<?php
require_once 'standard_page.php';

class HTMLControl {
	private StandardPage $page;

	public function __construct(){
		$this->page = new StandardPage;

		$this->site_name = $_SERVER['SERVER_NAME'];
		$this->base_url = '//' . $this->site_name;

		$this->base_path = preg_replace('@\?.+@', '', $_SERVER['SCRIPT_NAME']);
		$this->base_path = preg_replace('@/$@', '', dirname($this->base_path));
	}

	private function generate_breadcrumbs(): array {
		$breadcrumbs = [];
		foreach (explode('/', "$this->site_name$this->base_path") as $segment) {
			$breadcrumbs[$segment] = implode('/', array_keys($breadcrumbs)) . "/$segment/";
		}

		return $breadcrumbs;
	}

	public static function load_standard_page(string $title, array $page_vars=[]): void {
		$html = new HTMLControl;
		echo $html->page
			->set('title', $title)
			->from_array($page_vars)
			->from_array([
				'base_path' => $html->base_path,
				'base_url' => $html->base_url,
				'breadcrumbs' => $html->generate_breadcrumbs(),
				'site_name' => $html->site_name
			])
			->set_from_file('content', 'content.html.php')
			->generate();
	}
}
