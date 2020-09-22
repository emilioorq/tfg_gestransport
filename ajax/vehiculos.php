<?php 

require_once "../modelos/Vehiculos.php";

$vehiculo = new Vehiculo();

$idvehiculo = isset($_POST['idvehiculo']) ? limpiarCadena($_POST['idvehiculo']) : "";
$marca = isset($_POST['marca']) ? limpiarCadena($_POST['marca']) : "";
$modelo = isset($_POST['modelo']) ? limpiarCadena($_POST['modelo']) : "";
$matricula = isset($_POST['matricula']) ? limpiarCadena($_POST['matricula']) : "";
$fecha_matricula = isset($_POST['fecha_matricula']) ? limpiarCadena($_POST['fecha_matricula']) : "";
$fecha_compra = isset($_POST['fecha_compra']) ? limpiarCadena($_POST['fecha_compra']) : "";
$extras = isset($_POST['extras']) ? limpiarCadena($_POST['extras']) : "";

switch ($_GET['op']) {
	case 'guardaryeditar':

		if(empty($idvehiculo)){
			$rsp = $vehiculo->insertar($matricula, $fecha_matricula, $fecha_compra, $marca, $modelo, $extras);
			echo $rsp ? "Vehículo registrada": "Vehículo no se pudo registrar";
		}
		else
		{
			$rsp = $vehiculo->editar($idvehiculo,$matricula, $fecha_matricula, $fecha_compra, $marca, $modelo, $extras);
			echo $rsp ? "Se actualizó el Vehículo": "Vehículo no se pudo actualizar";
		}
		break;
	
	case 'desactivar':
			$rsp = $vehiculo->desactivar($idvehiculo);
			echo $rsp ? "Vehículo Desactivada": "Vehículo no se pudo desactivar";
		break;
	
	case 'activar':
			$rsp = $vehiculo->activar($idvehiculo);
			echo $rsp ? "Vehículo Activada": "Vehículo no se pudo activar";
		break;
	
	case 'mostrar':
			$rsp = $vehiculo->mostrar($idvehiculo);
			echo json_encode($rsp);
		break;
	
	case 'listar':
			$rsp = $vehiculo->listar();
			$data = Array();
			while ($reg=$rsp->fetch_object()) {
				$data[] = array(
					//"0"=>$reg->idvehiculo,
					"0"=>($reg->estado) ? "<button class='btn btn-warning' onclick='mostrar(".$reg->idvehiculo.")'><i class='fa fa-pencil'></i></button>".
						"  <button class='btn btn-danger' onclick='desactivar(".$reg->idvehiculo.")'><i class='fa fa-close'></i></button>" : 
						"<button class='btn btn-warning' onclick='mostrar(".$reg->idvehiculo.")'><i class='fa fa-pencil'></i></button>".
						"  <button class='btn btn-primary' onclick='activar(".$reg->idvehiculo.")'><i class='fa fa-check'></i></button>",
					"1"=>$reg->matricula,
					"2"=>$reg->marca,
					"3"=>$reg->modelo,
					"4"=>($reg->estado) ? '<span class="label bg-green">Activado</span>' 
											: '<span class="label bg-red">Desactivado</span>'
				);

			}
			$results = array(
				"sEcho"=>1, 
				"iTotalRecords"=>count($data), 
				"iTotalDisplayRecords"=>count($data), 
				"aaData"=>$data
			);

			echo json_encode($results);
		break;
	
	default:
		# code...
		break;
}

 ?>