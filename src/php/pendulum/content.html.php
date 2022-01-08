<div class="content content-pendulum">

	<div class="screen">
		<canvas id="ekran" width="215" height="215" onclick="alert('toggle pause');"> </canvas>

		<div class="statisics-hud">
			<small class="hud-angle">Angle (φ) = <span id="status_fi">2.513</span> rad </small>
			<small class="hud-velocity">Velocity (φ') = <span id="status_skorost">0.316</span> rad/s </small>
			<small class="hud-equation">
					φ'' =
						-<span id="status_g">9.8226</span>
						/ <span id="status_R">280</span>
						* <span id="status_sin">0.41</span>
			</small>

			<small class="hud-fps">125 FPS</small>
			<small class="hud-time">13.6s</small>
		</div>

		<form method="post" class="statisics-controls">
			<label class="equation-definition">
				<strong>Solving: φ'' = -g / R * sin(φ)</strong>
			</label>
			<label>
				<input onchange="Anime.statusZadai()" type="checkbox" name="status_control" value="1" checked />
				Enable Statistics
			</label>
		</form>

		<div class="click-to-play"><span>Click to Play!</span></div>
	</div>

	<div class="control-panel">
		<h4>
			<span>Initial Values</span>
			<small>[<a href="/pendulum/help/">Help?</a>]</small>
		</h4>

		<form method="post" onsubmit="return false">

			<div class="form-input-component">
				<label class="form-input-name">Angle (φ<sub>0</sub>):</label>
				<div class="form-input-with-unit">
					<input type="text" name="fi0" value="2.513274">
					<label class="form-input-unit">rad</label>
				</div>
			</div>

			<div class="form-input-component">
				<label class="form-input-name">Angular Velocity (θ<sub>0</sub>):</label>
				<div class="form-input-with-unit">
					<input type="text" name="tita0" value="0.6">
					<label class="form-input-unit">rad/s</label>
				</div>
			</div>

			<div class="form-input-component">
				<label class="form-input-name">Pendulum Length:</label>
				<div class="form-input-with-unit">
					<input type="text" name="mahalo" value="280">
					<label class="form-input-unit">cm</label>
				</div>
			</div>

			<div class="form-input-component">
				<label class="form-input-name">Gravity:</label>
				<div class="form-input-with-unit">
					<select name="gravitaciq">
						<option value="274.1">Sun (g = 274.1)</option>
						<option value="3.703">Mercury (g = 3.703)</option>
						<option value="8.872">Venus (g = 8.872)</option>
						<option value="9.8226" selected="selected">Earth (g = 9.8226)</option>
						<option value="1.625">Moon (g = 1.625)</option>
						<option value="3.728">Mars (g = 3.728)</option>
						<option value="25.93">Jupiter (g = 25.93)</option>
						<option value="11.19">Saturn (g = 11.19)</option>
						<option value="9.01">Uranus (g = 9.01)</option>
						<option value="11.28">Neptune (g = 11.28)</option>
						<option value="0.61">Pluto (g = 0.61)</option>
						<option value="0">Space (g = 0)</option>
					</select>
					<label class="form-input-unit">
						m/s<sup>2</sup>
					</label>
				</div>
			</div>

			<div class="form-input-component">
				<label class="form-input-name">FPS Limit:</label>
				<select name="select-fps">
					<option value="10"> 10 </option>
					<option value="25"> 25 </option>
					<option value="30"> 30 </option>
					<option value="60"> 60 (real-time) </option>
					<option value="100" selected> 100 </option>
					<option value="120"> 120 </option>
					<option value="180"> 180 </option>
				</select>
			</div>

			<button class="button-main" type="submit">apply</button>

		</form>

	</div>

</div>
