var tabla;

//funcion que se ejecuta al incicio.
function init()
{

	mostrarForm(false);
	listar();

	$("#formulario").on("submit",function(e){
		guardaryeditar(e);
	});

}

function limpiar()
{
	$("#idvehiculo").val("");
	$("#marca").val("");
	$("#modelo").val("");
	$("#matricula").val("");
	$("#fecha_matricula").val("");
	$("#fecha_compra").val("");
	$("#extras").val("");
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
					url: '../ajax/vehiculos.php?op=listar',
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
		url: "../ajax/vehiculos.php?op=guardaryeditar",
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

function mostrar(idvehiculo)
{
	$.post("../ajax/vehiculos.php?op=mostrar",
			{idvehiculo : idvehiculo},
				function(data,status)
				{
					data = JSON.parse(data);
					mostrarForm(true);

					$("#marca").val(data.marca);
					$("#modelo").val(data.modelo);
					$("#matricula").val(data.matricula);
					$("#fecha_matricula").val(data.fecha_matricula);
					$("#fecha_compra").val(data.fecha_compra);
					$("#extras").val(data.extras);
					$("#idvehiculo").val(data.idvehiculo);
				}
			);
}

function desactivar(idvehiculo)
{
	bootbox.confirm("¿Estas seguro de desactivar el Vehículo", function(result)
	{
		if(result)
		{
			$.post("../ajax/vehiculos.php?op=desactivar",
					{idvehiculo : idvehiculo},
						function(e)
						{
							bootbox.alert(e);
							tabla.ajax.reload();
						}
					);			
		}
	})
}

function activar(idvehiculo)
{
	bootbox.confirm("¿Estas seguro de activar el Vehículo", function(result)
	{
		if(result)
		{
			$.post("../ajax/vehiculos.php?op=activar",
					{idvehiculo : idvehiculo},
						function(e)
						{
							bootbox.alert(e);
							tabla.ajax.reload();
						}
					);			
		}
	})
}



init();