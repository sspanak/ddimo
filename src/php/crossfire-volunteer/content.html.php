<div class="content content-crossfire-volunteer">
	<article>
		<h1> Crossfire Volunteer </h1>
		<p>
			Crossfire Volunteer is a simple game in 64 kb (I managed to squeeze it down to 27 kb, actualy). It is inspired by 1980s Nintendo classics such as Battle City and Galaxian. You can download it an play it for free. It will run on pretty much any machine that can run at least Windows XP.
		</p>
		<p>
			During my first year in the university, we were supposed to learn OOP and C++, but homework and lectures seemed too ordinary and boring. So, I tried to find a way to make learning more fun... and this is how the game came to be.
		</p>
		<h2> The Story </h2>
		<p>
			A hostile extra-terestrial race is trying to conquer the known universe using their colorful ships. Your are the chosen one to stop them. Good luck, pilot!
		</p>

		<?php if (!$browser_is_text): ?>
			<h2> Screenshots </h2>
			<aside class="screenshots">
				<img src="crossfire-volunteer-1.png" alt="Crossfire Volunteer Screenshot 1" onclick="previewCrossfireScreenshot(this)">
				<img src="crossfire-volunteer-2.png" alt="Crossfire Volunteer Screenshot 2" onclick="previewCrossfireScreenshot(this)">
				<img src="crossfire-volunteer-3.png" alt="Crossfire Volunteer Screenshot 3" onclick="previewCrossfireScreenshot(this)">
			</aside>
		<?php endif; ?>

		<h2> Download and Play </h2>
		<p class="requirements">
			<a href="igra-alpha.zip"><b>igra 713a</b></a>
			<i class="italic">(.zip, 123 kb; windows version)</i>
		</p>

		<aside class="requirements">
			<strong>Minimum system requirements:</strong>
			<ul>
				<li>Celeron 500Mhz</li>
				<li>32 MB RAM</li>
				<li>An OpenGL capable video card</li>
				<li>300 kb free hard disk space</li>
				<li>Windows XP (2000 might work, but it has never been tested)</li>
			</ul>

			<strong>Recommended system requirements:</strong>
			<ul>
				<li>Pentium or Athlon 1GHz</li>
				<li>64 MB RAM</li>
				<li>32 MB Video Card with OpenGL support (GeForce 2 or similar)</li>
				<li>A sound card with MIDI playback support</li>
				<li>300 kb free hard disk space</li>
				<li>Windows XP or newer</li>
			</ul>
		</aside>

	</article>

	<?php if (!$browser_is_text): ?>
		<div class="screenshot picture-preview-container hidden" onclick="closeCrossfireScreenshot()">
			<img src="" alt="Crossfire Volunteer large screenshot preview" />
		</div>
	<?php endif; ?>
</div>
