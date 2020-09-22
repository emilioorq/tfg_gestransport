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
	$("#idpersona").val("");
	$("#nombre").val("");
	$("#documento").val("");
	$("#num_documento").val("");
	$("#direccion").val("");
	$("#cp").val("");
	$("#localidad").val("");
	$("#provincia").val("");
	$("#telefono").val("");
	$("#movil").val("");
	$("#email").val("");
	$("#web").val("");
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
					url: '../ajax/personas.php?op=listarproveedores',
					type: 'get',
					dataType: 'json',
					error: function(e){
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
		url: "../ajax/personas.php?op=guardaryeditar",
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

function mostrar(idpersona)
{
	//console.log("Persona:"+idpersona);

	$.post("../ajax/personas.php?op=mostrar",
			{idpersona : idpersona},
				function(data,status)
				{
					data = JSON.parse(data);
					mostrarForm(true);

					$("#nombre").val(data.nombre);
					$("#documento").val(data.documento);
					$("#documento").selectpicker('refresh')
					$("#num_documento").val(data.num_documento);
					$("#direccion").val(data.direccion);
					$("#cp").val(data.cp);
					$("#localidad").val(data.localidad);
					$("#provincia").val(data.provincia);
					$("#telefono").val(data.telefono);
					$("#movil").val(data.movil);
					$("#email").val(data.email);
					$("#web").val(data.web);
					$("#idpersona").val(data.idpersona);
				}
			);
}

function eliminar(idpersona)
{
	bootbox.confirm("¿Estas seguro de eliminar el registro?", function(result)
	{
		if(result)
		{
			$.post("../ajax/personas.php?op=eliminar",
					{idpersona : idpersona},
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