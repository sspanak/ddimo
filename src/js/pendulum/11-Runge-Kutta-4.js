/* eslint-disable */
// This is the original code from 2011. It's no use linting it.

function array_copy(arr1) {
	var arr2 = [];
	
	for (var i = 0; typeof(arr1) === "object" && i < arr1.length; i++)
		arr2[i] = (typeof(arr1[i]) === "object") ? array_copy(arr1[i]) : arr1[i];
	
	return arr2;
}


function RungeKutta4() {
	// Променливи
	var self = this;
	var __FUNCTION__ = "RungeKutta4";
	var __izraz = "";
	
	this.y = 0;
	this.t = 0;
	
	this.y0 = 0;
	this.t0 = 0;
	this.stpka = 0;
	
	this.greszka = "";
	
	this.izraz = function() {
		var regex1 = new RegExp(__FUNCTION__ + ".", "g"),
			regex2 = new RegExp("Math.", "g");
		var nov_izraz;
		
		// Система уравнение - масив
		if (typeof(__izraz) === "object" && __izraz.length > 0) {
			for (var i=0, nov_izraz = []; i<__izraz.length; i++) {
				nov_izraz[i] = __izraz[i].replace(regex1, "").replace(regex2, "");
			}		
		}
		// Едно уравнение
		else {
			nov_izraz = __izraz.replace(regex1, "").replace(regex2, "");
		}

		return nov_izraz
	}
	
	// Функции
	this.init = function(fx, stpka, t0, y0) {
		this.greszka = "";
		this.vvediIzraz(fx);
		this.stpka	= parseFloat(stpka);
		this.t0	= parseFloat(t0);
		
		if (typeof(y0) === "object")
			this.y0	= array_copy(y0);
		else
			this.y0	= parseFloat(y0);

		// Винаги имаме нужда от стойности от предишната стъпка, но на нулевата няма такива,
		// затова просто преизползваме началните стойности.
		this.y = y0;
		this.t = t0;
	};
	
	
	this.vvediIzraz = function(f) {
		// Система уравнение - масив
		if (typeof(f) === "object" && f.length > 0) {
			__izraz = [];
			for (var i=0; i<f.length; i++) {
				__izraz[i] = f[i].replace(/([^\w])([ty])([^\w])/g, "$1" + __FUNCTION__ + ".$2$3")
				.replace(/(^[ty]|[ty]$)/g, __FUNCTION__ + ".$1")
				.replace(/(sin|cos|tan|asin|acos|atan|abs|sqrt|pow|exp|floor|ceil|round)\(/g, "Math.$1(");
			}		
		}
		// Едно уравнение
		else {
			__izraz = f.replace(/([^\w])([ty])([^\w])/g, "$1" + __FUNCTION__ + ".$2$3")
					.replace(/(^[ty]|[ty]$)/g, __FUNCTION__ + ".$1")
					.replace(/(sin|cos|tan|asin|acos|atan|abs|sqrt|pow|exp|floor|ceil|round)\(/g, "Math.$1(");
		}
	};
	
	
	this.polagane = function(izraz, x, y) {
		return izraz.replace(__FUNCTION__ + "." + x, __FUNCTION__ + "." + y);
	};
	
	
	this.priloji = function() {
		// Проверка дали не работим с масиви
		if (typeof(this.y0) === "object" && typeof(__izraz) === "object") return prilojiZaMasiv();

		// Проверки за началните условия
		this.stpka	= parseFloat(this.stpka);
		this.y0		= parseFloat(this.y0);
		this.t0		= parseFloat(this.t0);
		
		if (isNaN(this.y0) || isNaN(this.t0)) {
			this.greszka = "Непозволени стойности за y0 и t0: " + this.t0 + " и " + this.y0;
			return false;
		}
		
		if (isNaN(this.stpka) || this.stpka == 0) {
			this.greszka = "Нулева стъпка, не може да се продължи по-нататък.";
			return false;
		}
		
		// Стойности за стъпка 0
		this.y = this.y0;
		this.t = this.t0;
		
		// метода - правим една стъпка напред
		var k1, k2, k3, k4;

		// k1
		eval("k1=" + __izraz);
		k1 *= this.stpka;
		
		// k2
		k2 = this.polagane(__izraz,	"t", "t+" + (this.stpka / 2));
		k2 = this.polagane(k2,		"y", "y+" + (k1 / 2));
		eval("k2=" + k2);
		k2 *= this.stpka;
		
		// k3
		k3 = this.polagane(__izraz,	"t", "t+" + (this.stpka / 2));
		k3 = this.polagane(k3,		"y", "y+" + (k2 / 2));
		eval("k3=" + k3);
		k3 *= this.stpka;
		
		// k4
		k4 = this.polagane(__izraz,	"t", "t+" + this.stpka);
		k4 = this.polagane(k4,		"y", "y+" + k3);
		eval("k4=" + k4);
		k4 *= this.stpka;
	
		this.y += (k1 + 2*k2 + 2*k3 + k4) / 6;
		this.t += this.stpka;

		return !isNaN(this.y);
	};	
	
	
	var prilojiZaMasiv = function() {
		// Проверки за началните условия
		self.stpka	= parseFloat(self.stpka);
		self.t0		= parseFloat(self.t0);

		if (typeof(self.y0) !== "object") {
			self.greszka = "y0 не е масив.";
			return false;
		}
		
		if (typeof(__izraz) !== "object") {
			self.greszka = "Дясната страна не е масив.";
			return false;
		}
		
		if (__izraz.length != self.y0.length || __izraz.length == 0) {
			self.greszka = "Лявата и дясната страна са с различни размери: " + self.y0.length + " и " + __izraz.length;
			return false;
		}

		if (isNaN(self.stpka) || self.stpka == 0) {
			self.greszka = "Нулева стъпка, не може да се продължи по-нататък.";
			return false;
		}
		
		for (var i = 0; i < self.y0.length; i++) {
			self.y0[i] = parseFloat(self.y0[i]);
			
			if (isNaN(self.y0[i])) {
				self.greszka = "Непозволена стойност за y0[" + i + "] : " + self.y0[i];
				return false;
			}
		}

		// Стойности за стъпка 0
		self.y = array_copy(self.y0);
		self.t = self.t0;


		// метода - правим една стъпка напред
		var k1 = [], k2 = [], k3 = [], k4 = [];

		for (var i=0; i<self.y0.length; i++) {
			// k1
			eval("k1[" + i + "]=" + __izraz[i]);
			
			// k2
			k2[i] = self.polagane(__izraz[i],	"t[" + i + "]", "t[" + i + "]+" + (self.stpka / 2));
			k2[i] = self.polagane(k2[i],		"y[" + i + "]", "y[" + i + "]+" + (k1[i] / 2));
			
			eval("k2[" + i + "]=" + k2[i]);
			
			// k3
			k3[i] = self.polagane(__izraz[i],	"t[" + i + "]", "t[" + i + "]+" + (self.stpka / 2));
			k3[i] = self.polagane(k3[i],		"y[" + i + "]", "y[" + i + "]+" + (k2[i] / 2));
			
			eval("k3[" + i + "]=" + k3[i]);
			
			// k4
			k4[i] = self.polagane(__izraz[i],	"t[" + i + "]", "t[" + i + "]+" + self.stpka);
			k4[i] = self.polagane(k4[i],		"y[" + i + "]", "y[" + i + "]+" + k3[i]);
			
			eval("k4[" + i + "]=" + k4[i]);
			
			self.y[i] += self.stpka * 0.166666667 * (k1[i] + k4[i] + 2*(k2[i] + k3[i]));
		}

		self.t += self.stpka;
		
		return !isNaN(self.y);
	};
}

RungeKutta4 = new RungeKutta4();
