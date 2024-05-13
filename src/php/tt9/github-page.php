<?php
require_once '../__lib__/parsedown/Parsedown.php';

class GithubPage {
	private const GITHUB_BASE_URL = 'https://raw.githubusercontent.com/sspanak/tt9/master';

	private Parsedown $Parsedown;
	private string $readme;

	public function __construct() {
		$this->Parsedown = Parsedown::instance()->setBreaksEnabled(true);
		$this->readme = '';
	}

	private function get_readme() {
		if (!$this->readme) {
			$this->readme = file_get_contents(self::GITHUB_BASE_URL.'/README.md');
		}

		return $this->readme;
	}

	private function get_section(string $section_regex) {
		$readme_matches = [];
		preg_match($section_regex, $this->get_readme(), $readme_matches);
		return count($readme_matches) > 1 ? trim($readme_matches[1]) : '';
	}

	private function get_section_as_html(string $section_regex) {
		return $this->get_section($section_regex);
	}

	public function get_compatibility_section() {
		return $this->get_section_as_html('@##[^\n]+Compatibility\n([^#]+)@');
	}

	public function get_full_description() {
		return $this->Parsedown->text(file_get_contents(self::GITHUB_BASE_URL.'/fastlane/metadata/android/en-US/full_description.txt'));
	}

	public function get_install_section() {
		$section = $this->get_section('@##[^\n]+Install\n([^#]+)@');

		$section = preg_replace('@\[([^]]+)\]\(([^)]+)\)@', '<a href="$2">$1</a>', $section);
		$section = str_replace('src="!RAW', 'src="'.self::GITHUB_BASE_URL.'/!RAW', $section);
		$section = preg_replace('@\n\n@', '<br/>', $section);
		$section = str_replace('docs/installation.md', "installation", $section);
		$section = is_text_browser() ? str_replace('></a>', '></a><br/>', $section) : $section;

		return $section;
	}

	public function get_how_to_use_section() {
		$section = $this->get_section('@#[^\n]+How to Use[^\n]+\n([\s\S]+?)##@');
		$section = str_replace('docs/user-manual.md', "manual", $section);

		return $this->Parsedown->text($section);
	}


	public function get_support_section() {
		return $this->get_section_as_html('@##[^\n]+Support\n([^#]+)@');
	}


	public function get_system_requirements_section() {
		return $this->get_section_as_html('@##[^\n]+System Requirements\n([^#]+)@');
	}
}
