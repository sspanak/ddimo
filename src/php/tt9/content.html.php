<div class="content content-tt9">
	<article>
		<h1><?=$title?></h1> <?=$custom_vars['full_description']?>

		<?php if (!$browser_is_text): ?>
			<h2>Screenshots</h2>
			<aside class="screenshots">
				<img src="3.png" alt="Traditional T9 screenshot 3" onclick="previewImage(this)">
				<div class="small-screenshots">
					<img src="1.png" alt="Traditional T9 screenshot 1" onclick="previewImage(this)">
					<img src="2.png" alt="Traditional T9 screenshot 2" onclick="previewImage(this)">
				</div>
				<img src="5.png" alt="Traditional T9 screenshot 5" onclick="previewImage(this)">
				<img src="4.png" alt="Traditional T9 screenshot 4" onclick="previewImage(this)">
			</aside>
		<?php endif; ?>

		<h2>Install</h2> <?=$custom_vars['install']?>
		<h2>System Requirements</h2> <?=$custom_vars['system_requirements']?>
		<h3>Compatibility</h3> <?=$custom_vars['compatibility']?>
		<h2>How to Use Traditional T9?</h2> <?=$custom_vars['how_to_use']?>
		<h2>Support</h2> <?=$custom_vars['support']?>

		<h2>Source Code</h2>
		<p> All source code and documentation are mirrored on the project's <a href="https://github.com/sspanak/tt9">GitHub page</a>. </p>
	</article>

	<?php if (!$browser_is_text): ?>
		<div class="screenshot picture-preview-container hidden" onclick="closeImagePreview()">
			<img src="" alt="Traditional T9 large screenshot preview" />
		</div>
	<?php endif; ?>
</div>
