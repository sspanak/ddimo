<div class="content content-tt9">
	<article>
		<h1><?=$title?></h1> <?=$custom_vars['full_description']?>

		<?php if (!$browser_is_text): ?>
			<h2>Screenshots</h2>
			<div class="screenshots">
				<div>
					<img src="https://github.com/sspanak/tt9/raw/master/screenshots/3.png">
				</div>
				<div>
					<img src="https://github.com/sspanak/tt9/raw/master/screenshots/1.png">
					<img src="https://github.com/sspanak/tt9/raw/master/screenshots/2.png">
				</div>
				<div>
					<img src="https://github.com/sspanak/tt9/raw/master/screenshots/5.png">
				</div>
				<div>
					<img src="https://github.com/sspanak/tt9/raw/master/screenshots/4.png">
				</div>
			</div>
		<?php endif; ?>

		<h2>Install</h2> <?=$custom_vars['install']?>
		<h2>System Requirements</h2> <?=$custom_vars['system_requirements']?>
		<h2>Support</h2> <?=$custom_vars['support']?>

		<h2>Source Code</h2>
		<p> All source code and documentation are mirrored on the project's <a href="https://github.com/sspanak/tt9">GitHub page</a>. </p>
	</article>
</div>
