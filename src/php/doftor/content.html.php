<div class="content content-doftor">
	<noscript>
		<h1> Въй! </h1>
		<p> Тази страница не може да работи без Javascript. Няма нищо друго за гледане тук. </p>
		<p> Край на полезния текст. </p>
	</noscript>

<?php if ($browser_is_text) {echo '</div>'; return;} ?>

	<div class="schedule-container">
		<h1> Кой работи? </h1>

		<form onsubmit="return false;">
			<div class="datepicker">
				<label for="data_za_grafik">Избор на дата:</label>
				<div class="date-component">
					<button type="button" class="button-left" onclick="Grafik.izberiVczera().poplni();">&larr;</button>
					<input id="data_za_grafik" type="date" onchange="Grafik.poplni();" />
					<button type="button" class="button-right" onclick="Grafik.izberiUtre().poplni();">&rarr;</button>
				</div>
			</div>

			<button type="button" class="button button-main" onclick="Grafik.izberiDnes().poplni();">днес</button>
		</form>

		<h2>
			График за
			<span id="dnes">днес, </span><span id="izbranaData">2.1.2022</span>:
		</h2>

		<ul>
			<li> I-ва смяна (8:00 - 13:00): <span id="smyana1"></span> </li>
			<li> Междинна смяна (11:00 - 14:00): <span id="smyana2"></span> </li>
			<li> II-ра смяна (13:00 - 18:00): <span id="smyana3"></span> </li>
		</ul>
	</div>
</div>
