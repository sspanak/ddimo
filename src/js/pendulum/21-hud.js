class HUD {
	constructor() {
		this.enabled = true;

		this.selfSelector = '.content-pendulum .statisics-hud';
		const selectors = {
			$angle: '#hud-fi',
			$fps: '#hud-fps',
			$frameTime: '#hud-frame-time',
			$g: '#hud-g',
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
		const radius = parseInt(stats.radius);
		if (!isNaN(radius)) {
			this.element.$radius.innerHTML = radius;
		}

		const sinPhi = Math.sin(stats.angle);
		if (!isNaN(sinPhi)) {
			this.element.$sinPhi.innerHTML = sinPhi.toFixed(3);
		}

		['angle', 'g', 'velocity'].forEach(statName => {
			const value = parseFloat(stats[statName]);
			if (!isNaN(value)) {
				this.element[`$${statName}`].innerHTML = value.toFixed(3);
			}
		});

		// top right
		const frameTime = parseFloat(stats.frameTime);
		if (!isNaN(frameTime)) {
			this.element.$frameTime.innerHTML = Math.round(stats.frameTime);

			const fps = frameTime > 0 ? Math.round(1000 / frameTime) : '--';
			this.element.$fps.innerHTML = fps;
		}

		// bottom right
		const playbackTime = parseFloat(stats.playbackTime);
		if (!isNaN(playbackTime)) {
			this.element.$playbackTime.innerHTML = (playbackTime / 1000).toFixed(1);
		}
	}
}
