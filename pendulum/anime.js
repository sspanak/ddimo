var Mahalo = {
	prt: 290,
	centr: {
		x: 300,
		y: 300
	},
	piron: 5,
	topcze: 15
};

var Priroda = {
	g: 9.8226,
	santimetri_km_pikseli: Math.sqrt(1680*1680 + 1050*1050) / 55.88
};

function Anime(){
	var __FUNCTION__ = "Anime",
		self = this,
		predi = 0,
		__pauza = false,
		stari_koordinati = [];
	
	this.maksimalno_vreme = 0;
	this.FPS = 100;
	this.delta_t = 0;
	this.delta_t_limit = 2 / this.FPS;
	this.skorost = 1;
	this.timeout = null;
	this.status_timeout = null;
	this.pokazvai_status = false;
	this.ekran = {
		masztab: 1,
		context: false,
		canvas: {},
		iztriy: function() {
			this.context.clearRect(0, 0, this.canvas.width, this.canvas.height);
		}
	};
	
	
	
	this.otnaczalo = function() {
		predi = 0;
		scena();
	};
	
	
	this.init = function() {
		this.ekran.canvas = document.getElementById("ekran");
		this.ekran.context = this.ekran.canvas.getContext("2d");
		
		this.status();
	};


	/**
	 * toggleCheckbox
	 * За да не изглежда анимацията "разтегната" или "свита", е необходимо да се зададат размери съответстващи
	 * на CSS-a. Тази функция напасва мащаба (включително и вътрешната променлива), към физическия рамер на
	 * елемента.
	 *
	 * @param void
	 * @return void
	 */
	this.napasniMasztab = function() {
		var $ekran = $(this.ekran.canvas);
		if (!$ekran.length)
			return;

		var razmer = $ekran.width();

		$ekran.attr("width", razmer).attr("height", razmer);

		this.ekran.masztab = Math.min(this.ekran.canvas.width, this.ekran.canvas.height) / 600;

		if (__pauza) scena();
	};
	
	
	this.napred = function() {	
		if (__pauza) return;
	
		var sega = new Date;
		// Началния момент
		if (predi === 0) predi = sega;
		
		// смятаме стъпката на времето
		this.delta_t = (sega.getTime() - predi.getTime()) / 1000 * this.skorost;
		var delta_t = (this.delta_t <= this.delta_t_limit * this.skorost) ? this.delta_t : this.delta_t_limit * this.skorost;
		predi = sega;
		
		if (delta_t > 0) {
			// смятаме стъпката на координатите
			RungeKutta4.init(RungeKutta4.izraz(), delta_t, RungeKutta4.t, RungeKutta4.y);
		
			RungeKutta4.priloji(function(Y){
				RungeKutta4.y = Y;
				RungeKutta4.t += delta_t;
			});

			// ... и рисуваме
			scena();
		}
		
		if (this.timeout !== null) clearTimeout(this.timeout);		
		this.timeout = setTimeout(__FUNCTION__ + ".napred()", Math.round(1000 / this.FPS));
	};
	
	
	this.stop = function() {
		__pauza = true;
		kvadrat_pauza();
	};
	
	
	this.prodlji = function() {
		predi = 0;
		__pauza = false;
		this.napred();
	};
	
	this.pauza = function() {
		if (__pauza)
			this.prodlji();
		else
			this.stop();
	};
	
	this.statusToggle = function() {
		this.pokazvai_status = !this.pokazvai_status;
		this.status();
	};

	this.statusZadai = function(){
		this.pokazvai_status = !!$("#status_control").is(":checked");
		this.status();
	};
	
	this.status = function() {
		if (!this.pokazvai_status) return;
		
		$("span#status_fi").html(RungeKutta4.y[0].toFixed(3));
		$("span#status_skorost").html(RungeKutta4.y[1].toFixed(3));
		$("span#status_g").html(Priroda.g);
		$("span#status_R").html(Mahalo.prt);
		$("span#status_sin").html(Math.sin(RungeKutta4.y[0]).toFixed(3));
		$("span#status_vreme").html(RungeKutta4.t.toFixed(3));
		$("span#status_fps").html(this.delta_t > 0 ? Math.floor(1 / this.delta_t) : 0);
		
		if (this.status_timeout !== null) clearTimeout(this.status_timeout);	
		this.status_timeout = setTimeout("Anime.status()", 100);
	};
	
	
	var scena = function() {
		self.ekran.iztriy();
		Oxy();
		mahalo(RungeKutta4.y[0]);
		if (__pauza) kvadrat_pauza();
	};
	
	
	var mahalo = function(fi) {
		var x_topcze = (Mahalo.centr.x + Mahalo.prt * Math.sin(fi)) * self.ekran.masztab,
			y_topcze = (Mahalo.centr.y + Mahalo.prt * Math.cos(fi)) * self.ekran.masztab,
			x_centr = Mahalo.centr.x * self.ekran.masztab,
			y_centr = Mahalo.centr.y * self.ekran.masztab
		
		
		// прът
		self.ekran.context.beginPath();
		self.ekran.context.moveTo(x_centr, y_centr);
		self.ekran.context.lineTo(x_topcze, y_topcze);
		self.ekran.context.lineWidth = 1;
		self.ekran.context.strokeStyle = "#88a";
		self.ekran.context.closePath();
		self.ekran.context.stroke();
		
		
		self.ekran.context.beginPath();
		self.ekran.context.fillStyle="#88a";

		// център
		self.ekran.context.arc(
			x_centr,
			y_centr,
			Mahalo.piron * self.ekran.masztab,
			0,
			Math.PI*2,
			true
		);
		
		// топче
		self.ekran.context.arc(
			x_topcze,
			y_topcze,
			Mahalo.topcze * self.ekran.masztab,
			0,
			Math.PI*2,
			true
		);
		
		self.ekran.context.closePath();
		self.ekran.context.fill();
	
		
		stari_koordinati[0] = [];
		stari_koordinati[0][0] = x_topcze;
		stari_koordinati[0][1] = y_topcze;
		
		//$("div#topcze").css({top: y, left: x}); // HTML4
	};
	
	var Oxy = function() {
		var x = Mahalo.centr.x * self.ekran.masztab,
			y = Mahalo.centr.y * self.ekran.masztab, 
			os = self.ekran.canvas.height * 0.48,
			szrift = self.ekran.canvas.height * 0.04;
		
		self.ekran.context.beginPath();
		self.ekran.context.strokeStyle = "#000";		
		
		// Оу
		self.ekran.context.moveTo(x, y);
		self.ekran.context.lineTo(x, y + os * 0.96);
		
		// Oy - стрекичка
		self.ekran.context.moveTo(x , y + os);
		self.ekran.context.lineTo(x * 1.02, y + os * 0.96);
		self.ekran.context.lineTo(x * 0.98, y + os * 0.96);
		self.ekran.context.lineTo(x, y + os);
		
		// Ox
		self.ekran.context.moveTo(x, y);
		self.ekran.context.lineTo(x + os * 0.96, y);
		
		// Ox - стрекичка
		self.ekran.context.moveTo(x + os, y);
		self.ekran.context.lineTo(x + os * 0.96, y * 1.02);
		self.ekran.context.lineTo(x + os * 0.96, y * 0.98);
		self.ekran.context.lineTo(x + os, y);
		
		self.ekran.context.closePath();
		self.ekran.context.stroke();
		
		// букви
		self.ekran.context.beginPath();
		self.ekran.context.fillStyle="#557";
		self.ekran.context.font = "bold " + szrift + "px sans-serif";
		self.ekran.context.fillText("x", x + os * 0.95, y * 0.96);
		self.ekran.context.fillText("y", x * 1.04, y + os * 0.98);
		self.ekran.context.closePath();		
	};
	
	var kvadrat_pauza = function() {
		var strana_kvadrat = 0.2 * self.ekran.canvas.width,
			x_kvadrat = Mahalo.centr.x * self.ekran.masztab - strana_kvadrat * 0.5,
			y_kvadrat = Mahalo.centr.y * self.ekran.masztab - strana_kvadrat * 0.5,
			x_a = x_kvadrat + strana_kvadrat * 0.15,
			y_a = y_kvadrat + strana_kvadrat * 0.85,
			x_b = x_kvadrat + strana_kvadrat * 0.85,
			y_b = y_kvadrat + strana_kvadrat * 0.5,
			x_c = x_a,
			y_c = y_kvadrat + strana_kvadrat * 0.15;
	
		self.ekran.context.fillStyle="rgba(0,0,0,0.34)";
		self.ekran.context.lineWidth = 1;
		
		// правоъгълник
		self.ekran.context.beginPath();
		self.ekran.context.rect(x_kvadrat, y_kvadrat, strana_kvadrat, strana_kvadrat);
		self.ekran.context.fill();
		self.ekran.context.closePath();
		
		// триъгълник
		self.ekran.context.beginPath();
		self.ekran.context.fillStyle="rgba(255,255,255,0.7)";
		self.ekran.context.moveTo(x_a, y_a);
		self.ekran.context.lineTo(x_b, y_b);
		self.ekran.context.lineTo(x_c, y_c);
		self.ekran.context.closePath();
		self.ekran.context.fill();
	};

};


Anime = new Anime();

