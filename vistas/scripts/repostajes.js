var tabla;

//funcion que se ejecuta al incicio.
function init()
{

	mostrarForm(false);
	listar();

	$("#formulario").on("submit",function(e){
		guardaryeditar(e);
	});

	$.post("../ajax/repostajes.php?op=selectVehiculo",
				function(r)
				{
					$("#idvehiculo").html(r);
					$("#idvehiculo").selectpicker('refresh');
				}
			);


}

function limpiar()
{
	$("#idrepostaje").val("");
	$("#fecha").val("");
	$("#idvehiculo").val("");
	$("#litros").val("");
	$("#kms").val("");
	$("#total_repostaje").val("");
	$("#conductor").val("");
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
					url: '../ajax/repostajes.php?op=listar',
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
		url: "../ajax/repostajes.php?op=guardaryeditar",
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

function mostrar(idrepostaje)
{
	$.post("../ajax/repostajes.php?op=mostrar",
			{idrepostaje : idrepostaje},
				function(data,status)
				{
					data = JSON.parse(data);
					mostrarForm(true);

					$("#fecha").val(data.fecha);
					$("#idvehiculo").val(data.fkvehiculo);
					$("#idvehiculo").selectpicker('refresh');
					$("#litros").val(data.litros);
					$("#kms").val(data.kms);
					$("#total_repostaje").val(data.total_repostaje);
					$("#conductor").val(data.conductor);
					$("#idrepostaje").val(data.idrepostaje);
				}
			);
}

function eliminar(idrepostaje)
{
	bootbox.confirm("¿Estas seguro de eliminar el repostaje", function(result)
	{
		if(result)
		{
			$.post("../ajax/repostajes.php?op=eliminar",
					{idrepostaje : idrepostaje},
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