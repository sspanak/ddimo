window.PendulumEngine = new class {
	constructor() {
		this.pendulumInterval = null;
		this.hudInterval = null;

		this.playbackTime = 0;
		this.step = {
			deltaT: 0,
			lastTime: 0
		};

		this.property = {
			maxFPS: {
				hud: 10,
				pendulum: 100
			}
		};

		window.addEventListener('load', _ => {
			this.ControlPanel = new PendulumControlPanel();
			this.Pendulum = new Pendulum();
			this.HUD = new HUD();
		});
	}

	_getStatistics() {
		return {
			angle: this.Pendulum.angle,
			frameTime: this.step.deltaT,
			playbackTime: this.playbackTime
		};
	}


	_pendulumStepAhead() {
		this.Pendulum.setAngle(this.Pendulum.angle + 0.05).draw();

		const now = Date.now();
		this.step.deltaT = now - this.step.lastTime;
		this.playbackTime += this.step.deltaT;
		this.step.lastTime = now;
	}


	_hudStepAhead() {
		this.HUD.draw(this._getStatistics());
	}


	_play() {
		this.ControlPanel.disable();

		this.Pendulum.setPause(false);
		this.step.lastTime = Date.now();

		this.toggleHUD(this.HUD.enabled);
		this.pendulumInterval = setInterval(
			_ => this._pendulumStepAhead(), Math.ceil(1000 / this.property.maxFPS.pendulum)
		);
	}


	_pause() {
		clearInterval(this.pendulumInterval);
		clearInterval(this.hudInterval);

		this.Pendulum.setPause(true).draw();
		this.HUD.draw(this._getStatistics());
		this.ControlPanel.enable();
	}


	toggleHUD() {
		const yes = this.ControlPanel.isHudEnabled();
		if (yes === undefined) {
			return;
		}

		this.HUD.toggle(yes).draw();

		clearInterval(this.hudInterval);
		if (this.HUD.enabled) {
			this.hudInterval = setInterval(_ => this._hudStepAhead(), Math.ceil(1000 / this.property.maxFPS.hud));
		}
	}


	togglePlayback() {
		if (this.Pendulum.paused) {
			this._play();
		} else {
			this._pause();
		}
	}
};
