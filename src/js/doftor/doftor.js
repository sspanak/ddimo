function SmyanaAmbareva(den, czetna)
{
	if (den === 2 || den === 4 || (den === 5 && !czetna)) {
		return 1;
	}
	if (den === 1 || den === 3) {
		return 3;
	}
	return false;
}

function SmyanaMileva(den, czetna)
{
	// Милева ще отсъства за неопределено време.
	if (den === 1 || den === 3 || (den === 5 && czetna)) {
		return 1;
	}
	if (den === 2 || den === 4) {
		return 3;
	}

	return false;
}

function SmyanaTodorova(den, czetna)
{
	return (den === 2 || den === 3 || den === 4) ? 2 : false;
}


function KoyNaSmyana(smyana, data)
{
	var smyana = parseInt(smyana);

	if (typeof data !== "object" || !(data instanceof Date) || isNaN(smyana))
	{
		return "Грешка";
	}

	var den = data.getDay();
	var czetna = !(data.getDate() % 2);

	switch (smyana)
	{
		case SmyanaAmbareva(den, czetna):
			return "Амбарева";
		case SmyanaTodorova(den, czetna):
			return "Тодорова";
		case SmyanaMileva(den, czetna):
			return "Милева";
		default:
			return "Никой";
	}
}


function PoplniGrafik(input, smyana1, smyana2, smyana3)
{
	var $input = $(input).val();
	if (!$input.match(/^\d{4}-\d{2}-\d{2}$/))
	{
		return false;
	}

	var data = new Date($input);

	$(smyana1).html(KoyNaSmyana(1, data));
	$(smyana2).html(KoyNaSmyana(2, data));
	$(smyana3).html(KoyNaSmyana(3, data));
}


function PoplniData(input, izbranaDataNadpis, dnesNadpis)
{
	var prevedeniDni = {
		1: "понеделник",
		2: "вторник",
		3: "сряда",
		4: "четвъртък",
		5: "петък",
		6: "събота",
		0: "неделя",
	};

	var $input = $(input).val();
	if (!$input.match(/^\d{4}-\d{2}-\d{2}$/))
		return false;

	var izbranaData = new Date($input);
	var dnesznaData = new Date();
	var den = typeof prevedeniDni[izbranaData.getDay()] !== "undefined" ? " (" + prevedeniDni[izbranaData.getDay()] + ")" : '';

	izbranaData = izbranaData.getDate() + "." + (izbranaData.getMonth() + 1) + "." + izbranaData.getFullYear();
	dnesznaData = dnesznaData.getDate() + "." + (dnesznaData.getMonth() + 1) + "." + dnesznaData.getFullYear();

	$(izbranaDataNadpis).html(izbranaData + den);

	if (izbranaData === dnesznaData)
		$(dnesNadpis).show();
	else
		$(dnesNadpis).hide();
}


function submitHandler(event)
{
	if (event instanceof Event)
		event.preventDefault();

	if (!$("#kalendar").val().match(/^\d{4}-\d{2}-\d{2}$/))
	{
		alert("Датата трябва да бъде във формат: ГГГГ-ММ-ДД, например: 2016-03-31.");
		return false;
	}

	PoplniGrafik("#kalendar", '#smyana1', '#smyana2', '#smyana3');
	PoplniData("#kalendar", '#izbranaData', '#dnes');
	return false;
}


function izberiDnes()
{
	var dnes = new Date();
	dnes = dnes.toISOString().replace(/T.+/, "");

	$("#kalendar").datepicker("setDate", dnes);
	$("#kalendar").trigger("change");
}


function izberiUtre()
{
	var data = new Date($("#kalendar").val());
	data.setDate(data.getDate() + 1);

	$("#kalendar")
		.datepicker("setDate", data.toISOString().replace(/T.+/, ""))
		.trigger("change");
}


function izberiVczera()
{
	var data = new Date($("#kalendar").val());
	data.setDate(data.getDate() - 1);

	$("#kalendar")
		.datepicker("setDate", data.toISOString().replace(/T.+/, ""))
		.trigger("change");
}


$(document).ready(function(){
	// засичане на Opera Mini по пример от https://dev.opera.com/articles/opera-mini-and-javascript/
	// оставяме полето за дата отключено, защото иначе е неизползваемо.
	if (Object.prototype.toString.call(window.operamini) !== "[object OperaMini]") {
		$("#kalendar").prop("readonly", true);
	}

	$("#kalendar").datepicker({
		dateFormat: "yy-mm-dd",
		firstDay: 1
	});

	izberiDnes();
});