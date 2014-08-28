function ModalenProzorec(){

	var id = "#modalenDjam";



	this.naplni = function(sdrjanie, zaglavie){

		$(id).html(sdrjanie);

	};

	

	this.pokaji = function(){

		$(id).fadeIn();

	};

	

	this.skrii = function(){

		$(id).hide();

	};

	

	this.izprazni = function(){

		$(id).empty();

	};

}

ModalenProzorec = new ModalenProzorec();



function EdraKartina(){

	this.edraKartina = {

		selector: ".edraKartina",

		buton: "a[data-mini-kartina='1']",

		img: function(){return this.selector + " img";},

		html: ''

	};



	var self = this;



	this.init = function(){

		$(this.edraKartina.buton).unbind("click").click(function(event){

			event.preventDefault();

			

			var kartinaSrc = $(this).attr("href");

			var kartinaImg = $(EdraKartina.edraKartina.img());

			

			kartinaImg.attr("src", kartinaSrc);

			self.pokaji();

		});

	};



	this.pokaji = function(){

		ModalenProzorec.pokaji();

	};

	

	this.skrii = function(){

		ModalenProzorec.skrii();

	};

}

EdraKartina = new EdraKartina();