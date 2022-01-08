<div class="content content-doftor">
	<div>
		<h1> Лекари </h1>

		<form onsubmit="return false;">
			<div class="datepicker">
				<label>Избор на дата:</label>
				<div class="date-component">
					<button type="button" class="button-left">&larr;</button>
					<input type="date" />
					<button type="button" class="button-right">&rarr;</button>
				</div>
			</div>

			<button type="button" class="button-main">покажи</button>
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
