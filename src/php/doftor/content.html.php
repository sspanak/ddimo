<div class="content content-doftor">
	<div>
		<h1> Кой работи? </h1>

		<form onsubmit="return false;">
			<div class="datepicker">
				<label>Избор на дата:</label>
				<div class="date-component">
						<button type="button" class="button-left" onclick="Grafik.izberiVczera().poplni();">&larr;</button>
						<input id="data_za_grafik" type="date" onchange="Grafik.poplni();" />
						<button type="button" class="button-right" onclick="Grafik.izberiUtre().poplni();">&rarr;</button>
				</div>
			</div>

			<button type="button" class="button-main" onclick="Grafik.izberiDnes().poplni();">днес</button>
		</form>

		<h2>
			График за
			<span id="dnes">днес, </span><span id="izbranaData"></span>:
		</h2>

		<ul>
			<li> I-ва смяна (8:00 - 13:00): <span id="smyana1"></span> </li>
			<li> Междинна смяна (11:00 - 14:00): <span id="smyana2"></span> </li>
			<li> II-ра смяна (13:00 - 18:00): <span id="smyana3"></span> </li>
		</ul>
	</div>
</div>
