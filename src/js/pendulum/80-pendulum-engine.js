window.PendulumEngine = new class {
	constructor() {
		this.pendulumInterval = null;
		this.hudInterval = null;

		this._resetTime();
		this.maxFPS = {
			hud: 10,
			pendulum: 100
		};


		window.addEventListener('load', () => {
			this.ControlPanel = new PendulumControlPanel();
			this.Pendulum = new Pendulum();
			this.HUD = new HUD();

			this.reset();
			this.ControlPanel.enable();
		});
	}


	_resetTime() {
		this.playbackTime = 0;
		this.step = {
			deltaT: 0,
			lastTime: 0
		};
	}

	_getStatistics() {
		return {
			angle: this.Pendulum.angle,
			frameTime: this.step.deltaT,
			playbackTime: this.playbackTime,
			velocity: RungeKutta4.y[1]
		};
	}


	_pendulumStepAhead() {
		// calculate the coordinates for this time step

		// on a less powerfull machine, the frame time could fluctuate a lot,
		// so we constrain it within sane limits, to prevent algorithm errors
		const algorithmDeltaT = Math.min(0.2, Math.max(0.0001, this.step.deltaT / 1000));

		RungeKutta4.init(RungeKutta4.izraz(), algorithmDeltaT, RungeKutta4.t, RungeKutta4.y);
		RungeKutta4.priloji();

		// use the calculated angle to draw the pendulum
		this.Pendulum.setAngle(RungeKutta4.y[0]).draw();

		// measure the frame time
		const now = Date.now();
		this.step.deltaT = now - this.step.lastTime;
		this.playbackTime += this.step.deltaT;
		this.step.lastTime = now;
	}


	play() {
		this.ControlPanel.showStopButton().disable();

		this.toggleHUD();

		this.Pendulum.setPause(false);
		this.step.lastTime = Date.now();

		clearInterval(this.pendulumInterval);
		this.pendulumInterval = setInterval(
			() => this._pendulumStepAhead(), Math.ceil(1000 / this.maxFPS.pendulum)
		);

		return this;
	}


	pause() {
		clearInterval(this.pendulumInterval);
		clearInterval(this.hudInterval);

		this.Pendulum.setPause(true).draw();
		this.HUD.draw(this._getStatistics());
		this.ControlPanel.enable().showPlayButton();

		return this;
	}


	togglePlayback() {
		if (this.Pendulum.paused) {
			this.play();
		} else {
			this.pause();
		}
	}


	toggleHUD() {
		const yes = this.ControlPanel.isHudEnabled();
		if (yes === undefined) {
			return;
		}

		this.HUD.toggle(yes).draw();

		clearInterval(this.hudInterval);
		if (this.HUD.enabled) {
			this.hudInterval = setInterval(
				() => this.HUD.draw(this._getStatistics()), Math.ceil(1000 / this.maxFPS.hud)
			);
		}
	}


	reset() {
		const {
			angle,
			g,
			maxFPS,
			radius,
			velocity
		} = this.ControlPanel.getInitialValues();

		this.maxFPS.pendulum = maxFPS;
		this._resetTime();

		const equation = new Equation(angle, velocity, radius, g);
		RungeKutta4.init(equation.expression, this.step.deltaT, this.playbackTime, equation.y0);

		this.Pendulum
			.setRodLength(radius)
			.setAngle(angle)
			.draw();

		this.HUD.draw({ ...this._getStatistics(), g, radius });

		return this;
	}
};
