<div class="content content-pendulum">
	<noscript>
		<h1> Argh! </h1>
		<p>
			This page cannot work when Javascript is disabled. There is nothing else to see here, however, it is still possible to read <a href="/pendulum/help/">the manual</a>.
		</p>
		<p> End of meaningful content. </p>
	</noscript>

<?php if ($browser_is_text) {echo '</div>'; return;} ?>

	<div class="screen">
		<canvas width="215" height="215" onclick="PendulumEngine.togglePlayback();"></canvas>

		<div class="statisics-hud">
			<small class="hud-equation">
					φ'' =
						-<span id="hud-g">0</span>
						/ <span id="hud-R">0</span>
						* <span id="hud-sin">0</span>
			</small>
			<small class="hud-velocity">Velocity (φ'): <span id="hud-velocity">--</span> rad/s</small>
			<small class="hud-max-velocity">Max |φ'|: <span id="max-velocity">--</span> rad/s</small>
			<small class="hud-angle">Angle (φ): <span id="hud-fi">--</span> rad </small>
			<small class="hud-max-angle">Max |φ|: <span id="max-angle">--</span> rad</small>

			<small class="hud-fps"><span id="hud-fps">--</span> FPS</small>
			<small class="hud-frame-time"><span id="hud-frame-time">--</span> ms (Δt)</small>
			<small class="hud-time"><span id="hud-time">0.0</span> s</small>
		</div>

		<form method="post" class="statisics-controls">
			<label class="equation-definition">
				<strong>Solving: φ'' = -g / R * sin(φ)</strong>
			</label>
			<label>
				<input type="checkbox" name="hud-enabled" value="1" checked onchange="PendulumEngine.toggleHUD()" />
				Enable Statistics
			</label>
		</form>
	</div>

	<div class="control-panel">
		<h4>
			<span>Initial Values</span>
			<small>[ <a href="help/">Help?</a> ]</small>
		</h4>

		<form method="post" onsubmit="return false;">

			<div class="form-input-component">
				<label class="form-input-name">Angle (φ<sub>0</sub>):</label>
				<div class="form-input-with-unit">
					<input type="text" name="angle" value="0.141592" placeholder="Any number" onchange="PendulumEngine.reset();">
					<label class="form-input-unit">rad</label>
				</div>
			</div>

			<div class="form-input-component">
				<label class="form-input-name">Angular Velocity (θ<sub>0</sub>):</label>
				<div class="form-input-with-unit">
					<input type="text" name="velocity" value="0.6" placeholder="Any number" onchange="PendulumEngine.reset();">
					<label class="form-input-unit">rad/s</label>
				</div>
			</div>

			<div class="form-input-component">
				<label class="form-input-name">Pendulum Length:</label>
				<div class="form-input-with-unit">
					<input type="text" name="radius" value="280" placeholder="A positive number" onchange="PendulumEngine.reset();">
					<label class="form-input-unit">cm</label>
				</div>
			</div>

			<div class="form-input-component">
				<label class="form-input-name">Gravity:</label>
				<div class="form-input-with-unit">
					<select name="g" onchange="PendulumEngine.reset();">
						<option value="0">Space (g = 0)</option>
						<option value="274.782333">Sun (g = 274, surface)</option>
						<option value="3.69710705">Mercury (g = 3.7)</option>
						<option value="8.87501825">Venus (g = 8.88)</option>
						<option value="9.80665" selected>Earth (g = 9.81)</option>
						<option value="1.61809725">Moon (g = 1.65)</option>
						<option value="3.72076">Mars (g = 3.72)</option>
						<option value="24.7912112">Jupiter (g = 24.79)</option>
						<option value="10.44408225">Saturn (g = 10.44)</option>
						<option value="8.6886919">Uranus (g = 8.69)</option>
						<option value="11.15016105">Neptune (g = 11.15)</option>
						<option value="0.61781895">Pluto (g = 0.62)</option>
					</select>
					<label class="form-input-unit">
						m/s<sup>2</sup>
					</label>
				</div>
			</div>

			<div class="form-input-component">
				<label class="form-input-name">FPS Limit:</label>
				<select name="maxFPS" onchange="PendulumEngine.reset();">
					<option value="5"> 5 </option>
					<option value="8"> 8 </option>
					<option value="10"> 10 </option>
					<option value="12"> 12 </option>
					<option value="15"> 15 </option>
					<option value="18"> 18 </option>
					<option value="25"> 25 </option>
					<option value="30"> 30</option>
					<option value="60" selected> 60 </option>
					<option value="100"> 100 </option>
					<option value="125"> 125 </option>
					<option value="150"> 150 </option>
					<option value="200"> 200 </option>
					<option value="250"> 250 </option>
					<option value="333"> 333 </option>
					<option value="500"> 500 </option>
					<option value="1000"> 1000 </option>
				</select>
			</div>

			<div class="button-container">
				<button id="pendulum-play" class="button button-pendulum-play" type="button" onclick="PendulumEngine.play();">&#9658; play</button>
				<button id="pendulum-pause" class="button button-pendulum-pause hidden" type="button" onclick="PendulumEngine.pause()"><b>||</b> pause</button>
				<button id="pendulum-stop" class="button button-pendulum-stop" type="button" onclick="PendulumEngine.pause().reset()">|&lt;&lt; restart</button>
			</div>
		</form>

	</div>

</div>
