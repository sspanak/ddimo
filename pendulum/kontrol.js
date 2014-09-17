function cfg() {
	this.t0 = 0;
	this.y0 = new Array(
		Math.PI - Math.PI * 0.2, // начален ъгъл
		Math.PI / 3 * 1.08 // начална ъглова скорост
	);
	this.uravneniq = new Array(
		"y[1]",
		(-Priroda.g * Priroda.santimetri_km_pikseli / Mahalo.prt) + " * sin(y[0])"	
	);
	
	this.izczisliUravneniq = function() {
		this.uravneniq = new Array(
			"y[1]",
			(-Priroda.g * Priroda.santimetri_km_pikseli / Mahalo.prt) + " * sin(y[0])"	
		);
	};
};

cfg = new cfg();

function butoniSubmit() {
	var fps = $("select[name='fps']").val(),
		skorost, prt, fi0, tita0, grav;
	
	// Кадри в секунда
	fps = parseInt(fps);
	if (isNaN(fps)) fps = 60;
	fps = Math.min(180, fps);
	fps = Math.max(10, fps);
	$("input[name='fps']").val(fps);
	
	// Скорост на анимацията
	skorost = parseFloat($("input[name='skorost']").val());
	if (isNaN(skorost)) skorost = 1;
	skorost = Math.min(8, skorost);
	skorost = Math.max(0.3, skorost);
	$("input[name='skorost']").val(skorost);
	
	// Дължина на махалото
	prt = parseFloat($("input[name='mahalo']").val());
	if (isNaN(prt)) prt = 300;
	prt = Math.min(290, prt);
	prt = Math.max(1, prt);
	$("input[name='mahalo']").val(prt);
	
	// Начален ъгъл
	fi0 = parseFloat($("input[name='fi0']").val());
	if (isNaN(fi0)) fi0 = 1;
	$("input[name='fi0']").val(fi0);
	
	// Начална скорост
	tita0 = parseFloat($("input[name='tita0']").val());
	if (isNaN(tita0)) tita0 = 0;
	$("input[name='tita0']").val(tita0);

	// Гравитация
	grav = parseFloat($("select[name='gravitaciq']").val());
	if (isNaN(grav)) grav = 9.8226;
	grav = Math.min(300, grav);
	grav = Math.max(0, grav);
	$("input[name='gravitaciq']").val(grav);

	
	cfg.y0[0] = fi0;
	cfg.y0[1] = tita0;
	Mahalo.prt = prt;
	Priroda.g = grav;
	cfg.izczisliUravneniq();
	
	RungeKutta4.init(cfg.uravneniq, 0, cfg.t0, cfg.y0);
	RungeKutta4.y = cfg.y0; // Хакерщина
	RungeKutta4.t = cfg.t0;
	
	Anime.FPS = fps;
	Anime.skorost = skorost;
	Anime.otnaczalo();

	return false;
}

/**
 * toggleCheckbox
 * За включване и изключване на отметката на "Статистика"
 *
 * @param jQuery-selector checkbox
 * @return void
 */
function toggleCheckbox(checkbox)
{
	var $input = $(checkbox);
	if ($input.length == 0)
		return;

	$input.prop("checked", !$input.is(":checked")).trigger("change");
}

$(document).ready(function(){
	Anime.init();
	Anime.napasniMasztab();
	Anime.stop();
	butoniSubmit();
	Anime.statusZadai();

	$(window).on('resize', function(){
		Anime.napasniMasztab();
	});
});