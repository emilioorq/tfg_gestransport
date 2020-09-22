var tabla;

//funcion que se ejecuta al incicio.
function init()
{

	mostrarForm(false);
	listar();

	$("#formulario").on("submit",function(e){
		guardaryeditar(e);
	});

	$.post("../ajax/mantenimientos.php?op=selectCategoria",
				function(r)
				{
					$("#idcategoria").html(r);
					$("#idcategoria").selectpicker('refresh');
				}
			);

	$.post("../ajax/mantenimientos.php?op=selectProveedor",
				function(r)
				{
					$("#idproveedor").html(r);
					$("#idproveedor").selectpicker('refresh');
				}
			);

	$.post("../ajax/mantenimientos.php?op=selectVehiculo",
				function(r)
				{
					$("#idvehiculo").html(r);
					$("#idvehiculo").selectpicker('refresh');
				}
			);


}

function limpiar()
{
	$("#idmantenimiento").val("");
	$("#fecha").val("");
	$("#idvehiculo").val("");
	$("#nombre").val("");
	$("#idcategoria").val("");
	$("#descripcion").val("");
	$("#idproveedor").val("");
	$("#kms").val("");
	$("#precio").val("");
	$("#impuesto").val("");
	$("#total").val("");
	$("#total_mantenimiento").val("");
}

function mostrarForm(flag)
{
	limpiar();
	if(flag)
	{
		$("#impuesto").val(21);
		$("#total").prop('disabled',true);

		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnAgregar").hide();
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
					url: '../ajax/mantenimientos.php?op=listar',
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
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);
//console.log(formData);
	$.ajax({
		url: "../ajax/mantenimientos.php?op=guardaryeditar",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,

		success: function(datos)
		{
			bootbox.alert(datos);
			tabla.ajax.reload();
			mostrarForm(false);
		}

	});
	limpiar();
}

function mostrar(idmantenimiento)
{
	$.post("../ajax/mantenimientos.php?op=mostrar",
			{idmantenimiento : idmantenimiento},
				function(data,status)
				{
					data = JSON.parse(data);
					mostrarForm(true);

					$("#fecha").val(data.fecha);
					$("#idvehiculo").val(data.fkvehiculo);
					$("#idvehiculo").selectpicker('refresh');
					$("#nombre").val(data.nombre);
					$("#idcategoria").val(data.fkcategoria);
					$("#idcategoria").selectpicker('refresh');
					$("#descripcion").val(data.descripcion);
					$("#idproveedor").val(data.fkproveedor);
					$("#idproveedor").selectpicker('refresh');
					$("#kms").val(data.kms);
					$("#precio").val(data.precio);
					$("#impuesto").val(data.impuesto);
					$("#total").val(data.total);
					$("#total_mantenimiento").val(data.total);
					$("#total").prop('disabled',true);
					$("#idmantenimiento").val(data.idmantenimiento);
				}
			);
}

function eliminar(idmantenimiento)
{
	bootbox.confirm("¿Estas seguro de eliminar el Mantenimiento", function(result)
	{
		if(result)
		{
			$.post("../ajax/mantenimientos.php?op=eliminar",
					{idmantenimiento : idmantenimiento},
						function(e)
						{
							bootbox.alert(e);
							tabla.ajax.reload();
						}
					);			
		}
	})
}


function calcularTotal()
{
	var pvp = $("#precio").val();
	var imp = $("#impuesto").val();
	//var total = document.getElementById("total");
	var total = 0.00;
	var impuesto = 0.00;

	console.log(pvp);
	console.log(imp);
	
	//impuesto = pvp.valvue * (imp.value / 100);
	impuesto = (parseFloat(pvp) * parseFloat(imp)) / 100;

	console.log(impuesto);
	
	total = parseFloat(pvp) + parseFloat(impuesto);

	console.log(total);

	document.getElementById("total").value = parseFloat(total);
	
	//$("#total").html("<h4><strong>"+total+" €</strong></h4>");
	$("#total_mantenimiento").val(parseFloat(total));
}


init();