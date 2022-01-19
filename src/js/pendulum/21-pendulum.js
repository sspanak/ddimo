class Pendulum {
	constructor() {
		this._configure()._useCanvas();
	}

	_configure() {
		this.angle = 0.5;
		this.rodLength = 290;
		this.paused = true;

		this._definiion = {
			// all units are pixels
			ballRadius: 15,
			center: {
				x: 300,
				y: 300
			},
			height: 215, // canvas height
			nailRadius: 5,
			scale: 1,
			style: {
				Oxy: {
					fontFamily: '"Play", sans-serif',
					fontWeight: 'bold',
					lineColor: '#ccc',
					textColor: '#ccc'
				},
				pause: {
					squareColor: 'rgba(96, 96, 96, 0.34)',
					triangleColor: 'rgba(236, 236, 236, 0.7)'
				},
				pendulum: {	color: '#88a'	}
			},
			width: 215 // canvas width
		};

		return this;
	}


	_useCanvas() {
		const $canvas = document.querySelector('.content-pendulum canvas');
		if (!$canvas || !($canvas instanceof HTMLCanvasElement)) {
			throw new Error('Cannot initialize a new Pendulum without a <canvas>.');
		}

		this.$canvas = new UiElement().select($canvas);
		this._context = this.$canvas.$element.getContext('2d');

		window.addEventListener('resize', _ => this._adjustScale().draw());

		return this._adjustScale().draw();
	}


	/**
	 * _adjustScale
	 * In order for the canvas not to look "stretched" or "squashed", we must set not only its CSS, but also
	 * the "width" and "height" attributes. This function adjusts the attributes (and the internal scale var)
	 * to the actual physical dimensions of the <canvas>.
	 *
	 * @param void
	 * @return this
	 */
	_adjustScale() {
		const size = Number.parseInt(this.$canvas.getStyle().width);

		this.$canvas.$element.setAttribute('width', size);
		this.$canvas.$element.setAttribute('height', size);
		this._definiion.scale = size / 600;

		return this;
	}


	_drawCoordinateSystem() {
		const
			x = this._definiion.center.x * this._definiion.scale,
			y = this._definiion.center.y * this._definiion.scale,
			axisWidth = this.$canvas.$element.height * 0.48,
			style = {
				...this._definiion.style.Oxy,
				fontSize: this.$canvas.$element.height * 0.04
			};

		this._context.beginPath();
		this._context.strokeStyle = style.lineColor;

		// Оу
		this._context.moveTo(x, y);
		this._context.lineTo(x, y + axisWidth * 0.96);

		// Oy - arrow
		this._context.moveTo(x , y + axisWidth);
		this._context.lineTo(x * 1.02, y + axisWidth * 0.96);
		this._context.lineTo(x * 0.98, y + axisWidth * 0.96);
		this._context.lineTo(x, y + axisWidth);

		// Ox
		this._context.moveTo(x, y);
		this._context.lineTo(x + axisWidth * 0.96, y);

		// Ox - arrow
		this._context.moveTo(x + axisWidth, y);
		this._context.lineTo(x + axisWidth * 0.96, y * 1.02);
		this._context.lineTo(x + axisWidth * 0.96, y * 0.98);
		this._context.lineTo(x + axisWidth, y);

		this._context.closePath();
		this._context.stroke();

		// labels
		this._context.beginPath();
		this._context.fillStyle = this._definiion.style.Oxy.textColor;
		this._context.font = `${style.fontWeight} ${style.fontSize}px ${style.fontFamily}`;
		this._context.fillText('X', x + axisWidth * 0.95, y * 0.96);
		this._context.fillText('Y', x * 1.04, y + axisWidth * 0.98);
		this._context.closePath();

		return this;
	}


	_drawPauseButton() {
		const
			squareSide = 0.2 * this.$canvas.$element.width,
			squareX = this._definiion.center.x * this._definiion.scale - squareSide * 0.5,
			squareY = this._definiion.center.y * this._definiion.scale - squareSide * 0.5;
		const
			x_a = squareX + squareSide * 0.15,
			y_a = squareY + squareSide * 0.85,
			x_b = squareX + squareSide * 0.85,
			y_b = squareY + squareSide * 0.5,
			x_c = x_a,
			y_c = squareY + squareSide * 0.15;

		this._context.fillStyle = this._definiion.style.pause.squareColor;
		this._context.lineWidth = 1;

		// square
		this._context.beginPath();
		this._context.rect(squareX, squareY, squareSide, squareSide);
		this._context.fill();
		this._context.closePath();

		// triangle
		this._context.beginPath();
		this._context.fillStyle = this._definiion.style.pause.triangleColor;
		this._context.moveTo(x_a, y_a);
		this._context.lineTo(x_b, y_b);
		this._context.lineTo(x_c, y_c);
		this._context.closePath();
		this._context.fill();

		return this;
	}


	_drawPendulum(angle) {
		const
			ballX = (this._definiion.center.x + this.rodLength * Math.sin(angle)) * this._definiion.scale,
			ballY = (this._definiion.center.y + this.rodLength * Math.cos(angle)) * this._definiion.scale,
			centerX = this._definiion.center.x * this._definiion.scale,
			centerY = this._definiion.center.y * this._definiion.scale;


		// rod
		this._context.beginPath();
		this._context.moveTo(centerX, centerY);
		this._context.lineTo(ballX, ballY);
		this._context.lineWidth = 1;
		this._context.strokeStyle = this._definiion.style.pendulum.color;
		this._context.closePath();
		this._context.stroke();


		this._context.beginPath();
		this._context.fillStyle=this._definiion.style.pendulum.color;

		// For better visibility, decrease the nail and the ball size in relation to the rod length,
		// hence "scaling" the entire pendulum when the rod is very short.
		// Scale of 1 is when the rod is 280.
		const rodToBallRatio = Math.max(1, Math.log2(this.rodLength * 0.25)) / Math.log2(280) * 1.33;

		// central nail
		this._context.arc(
			centerX,
			centerY,
			this._definiion.nailRadius * this._definiion.scale * rodToBallRatio,
			0,
			Math.PI * 2,
			true
		);

		// ball
		this._context.arc(
			ballX,
			ballY,
			rodToBallRatio * this._definiion.ballRadius * this._definiion.scale,
			0,
			Math.PI * 2,
			true
		);

		this._context.closePath();
		this._context.fill();

		return this;
	}


	/**
	 * setAngle
	 * Adjusts the angle of the rod.
	 *
	 * @param {number} angle
	 * @return {this}
	 */
	setAngle(angle) {
		this.angle = Number.parseFloat(angle);
		if (Number.isNaN(this.angle)) {
			console.warn(`Rod angle must be a number, but received: ${typeof angle}.`);
		}

		return this;
	}


	/**
	 * setRodLength
	 * Adjusts the length of the rod.
	 *
	 * @param {number} length
	 * @return {this}
	 */
	setRodLength(length) {
		this.rodLength = Number.parseFloat(length);
		if (Number.isNaN(this.rodLength)) {
			console.warn(`Rod length must be a number, but received: ${typeof rodLength}.`);
		}

		return this;
	}


	/**
	 * setPause
	 * Enables or disables the "paused" overlay button
	 *
	 * @param {bool} yes
	 * @return {this}
	 */
	setPause(yes) {
		this.paused = !!yes;
		return this;
	}


	/**
	 * draw
	 * Draws the pendulum and the coordinate system and the pause button.
	 *
	 * this.setAngle() is used to adjust the angle of the rod before drawing.
	 * Use this.setPause() to draw the pause button or not.
	 *
	 * @param  {void}
	 * @return {this}
	 */
	draw() {
		this._context.clearRect(0, 0, this.$canvas.$element.width, this.$canvas.$element.height);
		this
			._drawCoordinateSystem()
			._drawPendulum(this.angle);

		if (this.paused) {
			this._drawPauseButton();
		}

		return this;
	}
}
