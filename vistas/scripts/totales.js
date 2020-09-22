var tabla;


//funcion que se ejecuta al incicio.
function init()
{
	mostrarventashoy();
	mostrarcomprashoy();
	comprasultimos10dias();

}


function mostrarcomprashoy()
{
	$.post("../ajax/consultas.php?op=totalcomprashoy",
		function(r)
		{
			$("#totalcompras").html(r);
		}
	);
}

function mostrarventashoy()
{
	$.post("../ajax/consultas.php?op=totalventashoy",
		function(r)
		{
			$("#totalventas").html(r);
		}
	);
}

var fechascomp = new Array();
var totalescomp = new Array();

function comprasultimos10dias()
{
	var datas = '';
    var fechasc = new Array();
    var totalesc = new Array();
	$.post("../ajax/consultas.php?op=compras10dias",
		function(data)
		{
			datas = JSON.parse(data);
			fechasc.push(datas['fechas']);
			totalesc.push(datas['totales']);
			

			fechascomp = fechasc[0].valueOf();

			totalescomp = totalesc[0].valueOf();
		}
	);
			console.log(fechascomp);
			console.log(totalescomp);

}







init();