window.Pendulum = new class {
	constructor() {
		this.angle = 0.5;
		this.paused = true;

		this._selector = {	canvas: '.content-pendulum canvas' };
		this._property = {
			// all units are pixels
			ballRadius: 15,
			center: {
				x: 300,
				y: 300
			},
			height: 215, // canvas height
			nailRadius: 5,
			rodLength: 290,
			scale: 1,
			style: {
				Oxy: {
					fontFamily: 'sans-serif',
					fontWeight: 'bold',
					lineColor: '#888',
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

		window.addEventListener('load', _ => this._init());
	}


	_init() {
		this.$canvas = new UiElement().select(this._selector.canvas);
		if (!this.$canvas.$element) {
			this.$canvas = null;
			console.error('The pendulum will not work without a <canvas>.');
			return;
		}

		this._context = this.$canvas.$element.getContext('2d');

		this._adjustScale().draw();
		window.addEventListener('resize', _ => this._adjustScale().draw());
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
		if (!this.$canvas) {
			console.warn('No <canvas> element to scale.');
			return this;
		}

		const size = Number.parseInt(this.$canvas.getStyle().width);

		this.$canvas.$element.setAttribute('width', size);
		this.$canvas.$element.setAttribute('height', size);
		this._property.scale = size / 600;

		return this;
	}


	_drawCoordinateSystem() {
		const
			x = this._property.center.x * this._property.scale,
			y = this._property.center.y * this._property.scale,
			axisWidth = this.$canvas.$element.height * 0.48,
			style = {
				...this._property.style.Oxy,
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
		this._context.fillStyle = this._property.style.Oxy.textColor;
		this._context.font = `${style.fontWeight} ${style.fontSize}px ${style.fontFamily}`;
		this._context.fillText('x', x + axisWidth * 0.95, y * 0.96);
		this._context.fillText('y', x * 1.04, y + axisWidth * 0.98);
		this._context.closePath();

		return this;
	}


	_drawPauseButton() {
		const
			squareSide = 0.2 * this.$canvas.$element.width,
			squareX = this._property.center.x * this._property.scale - squareSide * 0.5,
			squareY = this._property.center.y * this._property.scale - squareSide * 0.5;
		const
			x_a = squareX + squareSide * 0.15,
			y_a = squareY + squareSide * 0.85,
			x_b = squareX + squareSide * 0.85,
			y_b = squareY + squareSide * 0.5,
			x_c = x_a,
			y_c = squareY + squareSide * 0.15;

		this._context.fillStyle = this._property.style.pause.squareColor;
		this._context.lineWidth = 1;

		// square
		this._context.beginPath();
		this._context.rect(squareX, squareY, squareSide, squareSide);
		this._context.fill();
		this._context.closePath();

		// triangle
		this._context.beginPath();
		this._context.fillStyle = this._property.style.pause.triangleColor;
		this._context.moveTo(x_a, y_a);
		this._context.lineTo(x_b, y_b);
		this._context.lineTo(x_c, y_c);
		this._context.closePath();
		this._context.fill();

		return this;
	}


	_drawPendulum(angle) {
		const
			ballX = (this._property.center.x + this._property.rodLength * Math.sin(angle)) * this._property.scale,
			ballY = (this._property.center.y + this._property.rodLength * Math.cos(angle)) * this._property.scale,
			centerX = this._property.center.x * this._property.scale,
			centerY = this._property.center.y * this._property.scale;


		// rod
		this._context.beginPath();
		this._context.moveTo(centerX, centerY);
		this._context.lineTo(ballX, ballY);
		this._context.lineWidth = 1;
		this._context.strokeStyle = this._property.style.pendulum.color;
		this._context.closePath();
		this._context.stroke();


		this._context.beginPath();
		this._context.fillStyle=this._property.style.pendulum.color;

		// central nail
		this._context.arc(
			centerX,
			centerY,
			this._property.nailRadius * this._property.scale,
			0,
			Math.PI * 2,
			true
		);

		// ball
		this._context.arc(
			ballX,
			ballY,
			this._property.ballRadius * this._property.scale,
			0,
			Math.PI * 2,
			true
		);

		this._context.closePath();
		this._context.fill();

		return this;
	}


	/**
	 * draw
	 * Draws the pendulum and the coordinate system and the pause button.
	 *
	 * this.angle is used to determine the angle of the rod.
	 * this.pause determines whether to draw the pause button or not.
	 *
	 * @param  {void}
	 * @return {void}
	 */
	draw() {
		if (!this.$canvas) {
			console.warn('Cannot draw a pendulum without <canvas> element.');
			return this;
		}

		this._context.clearRect(0, 0, this.$canvas.$element.width, this.$canvas.$element.height);
		this
			._drawCoordinateSystem()
			._drawPendulum(this.angle);

		if (this.paused) {
			this._drawPauseButton();
		}

		return this;
	}
};
