<div class="content content-pendulum-help">
	<article>
		<h1> Pendulum Simulator </h1>
		<p>
			This is a pendulum simulator which I made when I graduated university. It is in fact the thesis for my master's degree. Since it is a simple gravitational pendulum, no friction or air resistance is taken into account, which means it never loses energy and it will therefore never stop.
		</p>

		<p>
			Have fun playing with it or if it seems too complicated, read <a href="#manual">how to use it</a> first.
		</p>

		<p>
			I used the standard gravity pendulum equation and the Runge-Kutta method for solving it continuously in small time steps, which allowed me to render it as animation. All the model code is written in Javascript and the animation is visualized in an HTML &lt;canvas&gt;. If you are interested in more geek stuff, take a look <a href="#equations">behind the scenes</a>.
		</p>

		<h2 id="manual"> How to use it?</h2>
			<p>
				Before starting the simulation, we need to set the initial values of the differential equation, or in other words – the state of the pendulum. Imagine this like filming the pendulum's motion with a camera. The initial values represent the angle, the velocity and so on, right before hitting the "record" button.
			</p>
			<p>
				 The initial angle is denoted with the Greek letter <em>φ</em> (phi). The velocity used here is called <em>angular velocity</em> and it is used for measuring rotational speed. It is denoted with <em>φ'</em> or <em>θ</em> (phi prime or theta).
			</p>
			<p>
				There are also a few more important things, described below.
			</p>
		<h2> Controls </h2>

		<p> <strong><i>"Initial values"</i></strong> is the section where you can control the starting parameters of the simulation. They directly correlate to the initial values of the differential equation. The units are indicated next to each input field and can be any real number (positive or negative). As you can see, they are almost self-explanatory:</p>
		<aside class="screenshot">
			<img src="pendulum-help-inital-values.png" alt="Initial Values Screenshot">
		</aside>

		<p>
			<i>"Angle"</i> is the initial angle at which the pendulum will start swinging (or falling down, depending on how you set it). It is measured from the "Y" axis of the coordinate system (0 radians is at 6 o'clock). Increasing the angle will turn the rod counter-clockwise, and decreasing it will turn it clockwise.
		</p>

		<p>
			Just type a number, then press <i>ENTER</i> or the <i>RESTART</i> button and it will automatically rotate, so you can adjust it visually.
		</p>

		<p>
			<i>"Velocity"</i> determines how fast the pendulum is spinning (or swinging) right before the start. In other words, this is how hard you want "push" it and at what direction. A positive value "pushes" the pendulum counter-clockwise, and of course a negative one is for clockwise. As you have probably guessed, a greater absolute value means higher velocity.
		</p>

		<p>
			<i>"Pendulum Length"</i> is the length of the rod in centimeters. It is automatically constrained within sane limits, to prevent algorithm errors making the simulation too unrealistic.
		</p>

		<p>
			<i>"Gravity"</i> allows you to choose how strong the gravity is, hence simulating a pendulum on different planets.
		</p>

		<p>
			<i>"FPS Limit"</i> controls time step for solving the equations. This is the same as setting the maximum animation frames per second. 60 FPS or more should result in real-time motion. Use it to benchmark your browser or experiment with algorithm accuracy.
		</p>

		<p>
			Note that this is the <i>maximum</i> allowed animation rate, but depending on your browser and operating system, it may actually run slower or fluctuate a bit. Also, each browser has a Javascript loop limit that prevents excessive CPU usage. For this reason anything higher than 250 FPS (4 ms step time) is hardly achievable.
		</p>

		<p> Finally, <i>"PLAY" / "PAUSE"</i> work like in any audio or video player and <i>"RESTART"</i> stops and rewinds the simulation to 0 seconds. </p>

		<h2> Statistics </h2>
		<p> Right below the pendulum is the statistics panel. First, you can see the differential equation that "powers" the pendulum. And below it you can turn on/off the displaying of the variable values as the pendulum swings.
		</p>

		<aside class="screenshot">
			<img src="pendulum-help-statistics.png" alt="Statistics Screenshot">
		</aside>


		<h2 id="equations"> Behind the Scenes </h2>
		<p>
			This paragraph is still to be written...
		</p>

		<?php /*
		<h3> The Mathematics </h3>
			<p>
				Before creating fancy animation with realistic physics, I needed to do some maths first. Actually, my thesis was not about pendulums, but about Lagrange mechanics, and the simulator is just a simple example that it is still useful, even in today's world. Of course, this is a very, very simple example compared to what is achieved in the modern 3d and physics engines, but it illustrates that mathematics are not that scary and can be used for very cool things.
			</p>

			<p>
				The idea in my case was that using the Lagrangian function I get one equation to solve
			</p>
			<p>
				As a starting point I took the standard
			</p>

<pre>d<sup>2</sup>φ     g * sin(φ)
----- = ---
dt<sup>2</sup>     R</pre>

		<h3> Solving the Equations </h3>
			<p>
				After that I needed to solve the equation at very small time steps, which would give the coordinates of the bob in every frame. The obvious choice was the Runge-Kutta 4 method. It was intended to be used at a constant time steps, but it is great even if they vary a little.
			</p>

		<h3> The Code </h3>*/ ?>
	</article>
</div>
