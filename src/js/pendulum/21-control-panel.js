class PendulumControlPanel {
	constructor() {
		this.selector = {
			angle: '.content-pendulum input[name=angle]',
			g: '.content-pendulum select[name=g]',
			isHudEnabled: '.content-pendulum input[name=hud-enabled]',
			maxFPS: '.content-pendulum select[name=maxFPS]',
			radius: '.content-pendulum input[name=radius]',
			velocity: '.content-pendulum input[name=velocity]'
		};
	}


	_getControls() {
		return Object.values(this.selector).map(selector => (
			selector !== this.selector.isHudEnabled ? document.querySelector(selector) : null
		)).filter(e => !!e);
	}


	_getMinInitialValues() {
		const values = {
			g: 0,
			maxFPS: 1,
			radius: 0.0001
		};
		return { ...values };
	}


	_getMaxInitialValues() {
		const values = {
			maxFPS: 1000,
			radius: 290
		};
		return { ...values };
	}


	_getDefaultInitialValues() {
		const values = {
			angle: 0.5,
			g: 9.8226,
			maxFPS: 60,
			radius: 280,
			velocity: 0.6
		};
		return { ...values };
	}


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


	/**
	 * getInitialValues
	 * Returns validated initial values, filling in defaults in case some input is missing.
	 *
	 * @param {void}
	 * @return {JSON<input-name: input-value>}
	 */
	getInitialValues() {
		const defaults = this._getDefaultInitialValues();
		const minimums = this._getMinInitialValues();
		const maximums = this._getMaxInitialValues();

		const validValues = { ...defaults };

		this._getControls().forEach($input => {
			let value = Number.parseFloat($input.value);

			if (Number.isNaN(value)) {
				value = 0;
			}
			if (minimums[$input.name]) {
				value = Math.max(minimums[$input.name], value);
			}
			if (maximums[$input.name]) {
				value = Math.min(maximums[$input.name], value);
			}

			$input.value = value;
			validValues[$input.name] = value;
		});

		return validValues;
	}
}
