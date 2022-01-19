class HUD {
	constructor() {
		this.enabled = true;

		this.selfSelector = '.content-pendulum .statisics-hud';
		const selectors = {
			$angle: '#hud-fi',
			$fps: '#hud-fps',
			$frameTime: '#hud-frame-time',
			$g: '#hud-g',
			$maxAngle: '#max-angle',
			$maxVelocity: '#max-velocity',
			$playbackTime: '#hud-time',
			$radius: '#hud-R',
			$sinPhi: '#hud-sin',
			$velocity: '#hud-velocity'
		};

		this.element = {};
		for (let elementName in selectors) {
			const $element = document.querySelector(selectors[elementName]);
			if (!$element) {
				throw new Error(`Cannot initialize the HUD. "${selectors[elementName]}" element is missing.`);
			}

			this.element[elementName] = $element;
		}

		this.resetMaximums();
	}


	/**
	 * toggle
	 * Toggles whether to display the HUD or not.
	 *
	 * @param  {bool} yes
	 * @return {this}
	 */
	toggle(yes) {
		this.enabled = !!yes;

		const $selfElement = new UiElement().select(this.selfSelector);
		if (!this.enabled) {
			$selfElement.addClass('hidden');
		} else {
			$selfElement.removeClass('hidden');
		}

		return this;
	}


	/**
	 * resetMaximums
	 * Resets the maximum indicators, so they can be measured again.
	 *
	 * @param  {void}
	 * @return {this}
	 */
	resetMaximums() {
		this.element.$maxAngle.innerHTML = 0;
		this.element.$maxVelocity.innerHTML = 0;
		return this;
	}


	/**
	 * draw
	 * Updates the HUD UI with the given stats data. Missing elements will not cause errors.
	 *
	 * @param  {JSON} stats
	 * @return {void}
	 */
	draw(stats) {
		if (!this.enabled || !stats) {
			return;
		}

		// top left
		const radius = Number.parseFloat(stats.radius);
		if (!Number.isNaN(radius)) {
			this.element.$radius.innerHTML = radius.toFixed(radius >= 1 ? 0 : 1);
		}

		const sinPhi = Math.sin(stats.angle);
		if (!Number.isNaN(sinPhi)) {
			this.element.$sinPhi.innerHTML = sinPhi.toFixed(3);
		}

		['angle', 'g', 'velocity'].forEach(statName => {
			const value = Number.parseFloat(stats[statName]);
			if (Number.isNaN(value)) {
				return;
			}

			this.element[`$${statName}`].innerHTML = value.toFixed(statName === 'g' ? 2 : 3);

			if (statName === 'angle') {
				const max = Math.max(this.element.$maxAngle.innerHTML, Math.abs(value)).toFixed(3);
				this.element.$maxAngle.innerHTML = max;
			}
			if (statName === 'velocity') {
				const max = Math.max(this.element.$maxVelocity.innerHTML, Math.abs(value)).toFixed(3);
				this.element.$maxVelocity.innerHTML = max;
			}
		});

		// top right
		const frameTime = Number.parseInt(stats.frameTime);
		if (!Number.isNaN(frameTime)) {
			this.element.$frameTime.innerHTML = frameTime;

			const fps = frameTime > 0 ? Math.floor(1000 / frameTime) : '--';
			this.element.$fps.innerHTML = fps;
		}

		// bottom right
		const playbackTime = Number.parseFloat(stats.playbackTime);
		if (!Number.isNaN(playbackTime)) {
			this.element.$playbackTime.innerHTML = (playbackTime / 1000).toFixed(1);
		}
	}
}
