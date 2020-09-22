var tabla;

//funcion que se ejecuta al incicio.
function init()
{
	listar();

	$.post("../ajax/venta.php?op=selectCliente",
				function(r)
				{
					//console.log("C: "+r);
					$("#idcliente").html(r);
					$("#idcliente").selectpicker('refresh');
				}
			);

}


function listar()
{
	var fecha_inicio = $("#fecha_inicio").val();
	var fecha_fin = $("#fecha_fin").val();
	var idcliente = $("#idcliente").val();

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
					url: '../ajax/consultas.php?op=ventasfechacliente',
					data: {fecha_inicio, fecha_fin, idcliente}, 
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





init();