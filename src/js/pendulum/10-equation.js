class Equation {
	// initial values
	constructor(angle, velocity, radius, g) {
		const cmToPxRatio = Math.sqrt(1680*1680 + 1050*1050) / 55.88;

		this.g = g;
		this.y0 = [angle, velocity];
		this.expression = ['y[1]', `${-g * cmToPxRatio / radius} * sin(y[0])`];
	}
}
