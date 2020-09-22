
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
	$("#idusuario").val("");
	$("#nombre").val("");
	$("#email").val("");
	$("#rol").val("");
	$("#password").val("");
	$("#claveactual").val("");
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
					url: '../ajax/usuarios.php?op=listar',
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
		url: "../ajax/usuarios.php?op=guardaryeditar",
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

function mostrar(idusuario)
{
	//console.log("Persona:"+idusuario);

	$.post("../ajax/usuarios.php?op=mostrar",
			{idusuario : idusuario},
				function(data,status)
				{
					data = JSON.parse(data);
					mostrarForm(true);

					$("#idusuario").val(data.idusuario);
					$("#nombre").val(data.nombre);
					$("#email").val(data.email);
					$("#rol").val(data.rol);
					$("#rol").selectpicker('refresh')					
					$("#password").val(data.password);
					$("#claveactual").val(data.password);
				}
			);
	
}

function desactivar(idusuario)
{
	bootbox.confirm("¿Estas seguro de desactivar el usuario", function(result)
	{
		if(result)
		{
			$.post("../ajax/usuarios.php?op=desactivar",
					{idusuario : idusuario},
						function(e)
						{
							bootbox.alert(e);
							tabla.ajax.reload();
						}
					);			
		}
	})
}

function activar(idusuario)
{
	bootbox.confirm("¿Estas seguro de activar el usuario", function(result)
	{
		if(result)
		{
			$.post("../ajax/usuarios.php?op=activar",
					{idusuario : idusuario},
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