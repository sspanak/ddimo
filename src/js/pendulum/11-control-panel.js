class PendulumControlPanel {
	constructor() {
		this.selector = {
			isHudEnabled: '.content-pendulum input[name=hud-enabled]',
			angle: '.content-pendulum input[name=angle]',
			velocity: '.content-pendulum input[name=velocity]',
			radius: '.content-pendulum input[name=radius]',
			g: '.content-pendulum select[name=g]',
			maxFPS: '.content-pendulum select[name=max-fps]'
		};

		// this.element = {};
	}

	_getControls() {
		return Object.values(this.selector).map(selector => (
			selector !== this.selector.isHudEnabled ? document.querySelector(selector) : null
		)).filter(e => !!e);
	}


	// init() {
	// 	this.selector.map((selector, elementName) => {
	// 		$element = document.querySelector('')
	// 	});
	// }


	// setInitialValues(elements) {
	// 	console.log(elements);
	// 	// this.isHudEnabled = false;
	// 	// this.angle = 0.5;
	// 	// this.velocity = 0;
	// 	// this.radius = 280;
	// 	// this.g = 9.81;
	// 	// this.maxFPS = 60;
	// 	//
	// 	return false;
	// }


	/**
	 * enable
	 * Enables all control panel inputs in the DOM.
	 *
	 * @return {this}
	 */
	enable() {
		this._getControls().forEach(e => e.removeAttribute('disabled'));
		return this;
	}

	/**
	 * disable
	 * Disables all control panel inputs in the DOM.
	 *
	 * @return {this}
	 */
	disable() {
		this._getControls().forEach(e => e.setAttribute('disabled', true));
		return this;
	}

	/**
	 * isHudEnabled
	 * Returns the state of the checkbox that determines whether the HUD should be enabled.
	 * When searching the DOM fails. it returns "undefined".
	 *
	 * @return {bool | undefined}
	 */
	isHudEnabled() {
		const $checkbox = document.querySelector(this.selector.isHudEnabled);
		if (!$checkbox || !($checkbox instanceof HTMLInputElement)) {
			console.error(
				`Unable to read HUD display state. "${this.selector.isHudEnabled}" element not found.`
			);
			return undefined;
		}

		return $checkbox.checked;
	}
};
