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
	$("#idservicio").val("");
	$("#nombre").val("");
	$("#descripcion").val("");
	$("#codigo").val("");
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
					url: '../ajax/servicios.php?op=listar',
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
		url: "../ajax/servicios.php?op=guardaryeditar",
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

function mostrar(idservicio)
{
	$.post("../ajax/servicios.php?op=mostrar",
			{idservicio : idservicio},
				function(data,status)
				{
					data = JSON.parse(data);
					mostrarForm(true);

					$("#nombre").val(data.nombre);
					$("#descripcion").val(data.descripcion);
					$("#codigo").val(data.codigo);
					$("#idservicio").val(data.idservicio);
				}
			);
}

function desactivar(idservicio)
{
	bootbox.confirm("¿Estas seguro de desactivar el Servicio", function(result)
	{
		if(result)
		{
			$.post("../ajax/servicios.php?op=desactivar",
					{idservicio : idservicio},
						function(e)
						{
							bootbox.alert(e);
							tabla.ajax.reload();
						}
					);			
		}
	})
}

function activar(idservicio)
{
	bootbox.confirm("¿Estas seguro de activar el Servicio", function(result)
	{
		if(result)
		{
			$.post("../ajax/servicios.php?op=activar",
					{idservicio : idservicio},
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