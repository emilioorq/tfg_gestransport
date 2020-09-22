var tabla;

//funcion que se ejecuta al incicio.
function init()
{

	mostrarForm(false);
	listar();

	$("#formulario").on("submit",function(e){
		guardaryeditar(e);
	});

	$.post("../ajax/facturas.php?op=selectCliente",
				function(r)
				{
					//console.log("C: "+r);
					$("#idcliente").html(r);
					$("#idcliente").selectpicker('refresh');
				}
			);


}

function limpiar()
{
	$("#idfactura").val("");
	$("#idcliente").val("");
	$("#serie").val("");
	$("#numero").val("");
	$("#fecha").val("");
	$("#impuesto").val("");
	$("#retencion").val("");

	$("#total_factura").val("");
	$(".filas").remove();
	$("#total").html("0.00");

	var fecha = new Date();
	var dia = ("0" + fecha.getDate()).slice(-2);
	var mes = ("0" + (fecha.getMonth() + 1)).slice(-2);
	var hoy = fecha.getFullYear()+"-"+(mes)+"-"+(dia);
	var anio = fecha.getFullYear();
	$("#fecha").val(hoy);
	$("#serie").val(anio);

}

function mostrarForm(flag)
{
	limpiar();
	if(flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnAgregar").hide();
		marcarImpuesto();
		listarServicios();

		$("#guardar").show();
		$("#btnGuardar").hide();
		$("#btnCancelar").show();
		detalles = 0;
		$("#btnAgregarArt").show();

	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnAgregar").show();
	}
}

function cancelarForm()
{
	limpiar();
	mostrarForm(false);
}

function listar()
{
	tabla = $("#tbllistado").DataTable(
	{
		"aProcessing": true, //Activar procesamiento del datable
		"aServerSide": true, //Paginacion y filtrado realizado por el servidor
		dom: 'Bfrtip', //definimos los elementos decontrol de tabla
		buttons: [
			'copyHtml5',
			'excelHtml5',
			'csvHtml5',
			'pdf'
		],
		"ajax":
				{
					url: '../ajax/facturas.php?op=listar',
					type: 'get',
					dataType: 'json',
					error: function(e)
					{
						console.log(e.responseText);
					}
				},
		"bDestroy": true,
		"iDisplayLength": 10, //paginacion
		"order": [[0, "desc"]] //ordenar los datos (columna,descendente)
	});
}

function listarServicios()
{
	tabla = $("#tblServicios").DataTable(
	{
		"aProcessing": true, //Activar procesamiento del datable
		"aServerSide": true, //Paginacion y filtrado realizado por el servidor
		dom: 'Bfrtip', //definimos los elementos decontrol de tabla
		buttons: [],
		"ajax":
				{
					url: '../ajax/facturas.php?op=listarServicios',
					type: 'get',
					dataType: 'json',
					error: function(e)
					{
						console.log(e.responseText);
					}
				},
		"bDestroy": true,
		"iDisplayLength": 10, //paginacion
		"order": [[0, "desc"]] //ordenar los datos (columna,descendente)
	});
}

function guardaryeditar(e)
{
	e.preventDefault();
	//$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);
//console.log(formData);
	$.ajax({
		url: "../ajax/facturas.php?op=guardaryeditar",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,

		success: function(datos)
		{
			bootbox.alert(datos);
			tabla.ajax.reload();
			mostrarForm(false);
			listar();
		}

	});
	limpiar();
}

function mostrar(idfactura)
{
	//console.log("IDV: "+idfactura);
	$.post("../ajax/facturas.php?op=mostrar",
			{idfactura : idfactura},
				function(data,status)
				{
					data = JSON.parse(data);
					mostrarForm(true);

					$("#idcliente").val(data.fkcliente);
					$("#idcliente").prop("disabled", true);
					$("#idcliente").selectpicker('refresh');
					$("#fecha").val(data.fecha);
					$("#fecha").prop("disabled", true);
					$("#tipo_factura").val(data.tipo_factura);
					$("#tipo_factura").prop("disabled", true);
					$("#tipo_factura").selectpicker('refresh');
					$("#serie").val(data.serie);
					$("#serie").prop("disabled", true);
					$("#numero_factura").val(data.numero_factura);
					$("#numero_factura").prop("disabled", true);
					$("#impuesto").val(data.impuesto);
					$("#impuesto").prop("disabled", true);
					$("#retencion").val(data.retencion);
					$("#retencion").prop("disabled", true);
					$("#idfactura").val(data.idfactura);
					$("#idfactura").prop("disabled", true);

					//ocultar y mostrar botones
					$("#guardar").show();
					$("#btnGuardar").hide();
					$("#btnCancelar").show();
					$("#btnAgregarArt").hide();

				}
			);

		$.post("../ajax/facturas.php?op=listarDetalle&id="+idfactura,
				function(r)
				{
					$("#detalles").html(r);
				}
			);	
}

function anular(idfactura)
{
	bootbox.confirm("¿Estas seguro de anular la Factura", function(result)
	{
		if(result)
		{
			$.post("../ajax/facturas.php?op=anular",
					{idventa : idventa},
						function(e)
						{
							bootbox.alert(e);
							tabla.ajax.reload();
						}
					);			
		}
	})
}

// Declaración de algunas variables para trabajar con las compras y detalles.
var impuesto = 21;
var cont = 0;
var detalles = 0;
$("#guardar").hide();
$("#tipo_factura").change(marcarImpuesto);

function marcarImpuesto()
{

	var tipo_factura = $("#tipo_factura option:selected").text();
	$("#retencion").val('0');
	$("#serie").val();

	if(tipo_factura == "Factura")
	{
		$("#impuesto").val(impuesto);
	}
	else 
	{
		$("#impuesto").val("0");
	}
}

function agregarDetalle(idservicio, servicio)
{
	var cantidad = 1;
	var precio = 1;
	var descuento = 0.0;
	var subtotal = 0.00;

	if(idservicio != "")
	{

		//var subtotal = cantidad * (precio_venta - ((precio_venta*descuento)/100));
		var subtotal = cantidad * precio;

		var fila = "<tr class='filas' id='fila"+cont+"'>"+
						"<td class='col-md-1'><button type='button' class='btn btn-danger' onclick='eliminarDetalle("+cont+")'>X</button></td>"+
						"<td class='col-md-5'><input type='hidden' name='idservicio[]' id='idservicio[]' value='"+idservicio+"'>"+servicio+"</td>"+
						"<td class='col-md-1'><input type='number' name='cantidad[]' id='cantidad[]' value='"+cantidad+"' onchange='modificarSubtotales()'></td>"+
						"<td class='col-md-2'><input type='number' step='0.01' name='precio[]' id='precio[]' value='"+precio+"' onchange='modificarSubtotales()'></td>"+
						"<td class='col-md-2'><input type='number' name='descuento[]' id='descuento[]' value='"+descuento+"' onchange='modificarSubtotales()'></td>"+
						"<td class='col-md-1'><span name='subtotal' id='subtotal"+cont+"'>"+subtotal+"</span></td>"+
					"</tr>";

		cont++;
		detalles++;
		$("#detalles").append(fila);
		modificarSubtotales();
	}
	else
	{
		bootbox.aler("Error al ingresar el detalle.");
	}
}

function modificarSubtotales()
{
	var cant = document.getElementsByName("cantidad[]");
	var prec = document.getElementsByName("precio[]");
	var desc = document.getElementsByName("descuento[]");
	var sub = document.getElementsByName("subtotal");

	for(var i=0; i<cant.length; i++)
	{

		var inpC = cant[i];
		var inpP = prec[i];
		var inpD = desc[i];
		var inpS = sub[i];

		inpS.value = inpC.value * (inpP.value - ((inpP.value * inpD.value) / 100));

		document.getElementsByName("subtotal")[i].innerHTML = inpS.value;
	}
	calcularTotales();
}

function calcularTotales()
{
	var sub = document.getElementsByName("subtotal");
	var total = 0.0;

	for (var i = 0 ; i < sub.length;i++) 
	{
		total += document.getElementsByName("subtotal")	[i].value;
	}

	$("#total").html("<h4><strong>"+total+" €</strong></h4>");
	$("#total_factura").val(total);

	evaluar();

}

function evaluar()
{
	if(detalles > 0)
	{
		$("#btnGuardar").show();
		//cont = 0;
	}
	else
	{
		$("#btnGuardar").hide();
		cont = 0;
	}
}

function eliminarDetalle(indice)
{
	$("#fila"+indice).remove();
	calcularTotales();
	detalles -=1;
}


init();