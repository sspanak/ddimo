<?php
require_once '../__lib__/parsedown/Parsedown.php';

class GithubPage {
	private const SCREENSHOT_MAX_AGE = 2592000; // 1 month
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
		return $this->Parsedown->text($this->get_section($section_regex));
	}

	public function get_compatibility_section() {
		return $this->get_section_as_html('@##[^\n]+Compatibility\n([^#]+)@');
	}

	public function get_full_description() {
		return $this->Parsedown->text(file_get_contents(self::GITHUB_BASE_URL.'/fastlane/metadata/android/en-US/full_description.txt'));
	}

	public function get_install_section() {
		$section = $this->get_section('@##[^\n]+Install\n([^#]+)@');

		$section = preg_replace('@\s*(?:</?tr>|</?td>| {2,})@', '', $section);
		$section = str_replace('<table>', '<div class="download-links">', $section);
		$section = str_replace('</table>', '</div>', $section);
		$section = preg_replace('@\[([^]]+)\]\(([^)]+)\)@', '<a href="$2">$1</a>', $section);
		$section = str_replace('src="!RAW', 'src="'.self::GITHUB_BASE_URL.'/!RAW', $section);
		$section = preg_replace('@\n\n([^\n]+?)\n@', '<p>$1</p>', $section);
		$section = preg_replace('@_([^_]+?)_@', '<i>$1</i>', $section);
		$section = str_replace('docs/installation.md', "installation", $section);
		$section = is_text_browser() ? str_replace('></a>', '></a><br/>', $section) : $section;

		return $section;
	}

	public function get_how_to_use_section() {
		$section = $this->get_section('@#[^\n]+How to Use[^\n]+\n([\s\S]+?)##@');
		$section = str_replace('docs/user-manual.md', "manual", $section);

		return $this->Parsedown->text($section);
	}

	public function get_screenshots() {
		$now = time();

		for ($i = 1; $i <= 6; $i++) {
			$file_name = "$i.png";
			$local_path = __DIR__ . DIRECTORY_SEPARATOR . $file_name;

			if (!file_exists($local_path) || !filesize($local_path) || filemtime($local_path) + self::SCREENSHOT_MAX_AGE < $now) {
				$remote_path = self::GITHUB_BASE_URL . "/screenshots/$file_name";
				file_put_contents($local_path, file_get_contents($remote_path));
			}
		}
	}

	public function get_support_section() {
		return $this->get_section_as_html('@##[^\n]+Support\n([^#]+)@');
	}


	public function get_system_requirements_section() {
		return $this->get_section_as_html('@##[^\n]+System Requirements\n([^#]+)@');
	}
}
