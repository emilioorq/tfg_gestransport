<?php 

require_once "../modelos/Servicio.php";

$servicio = new Servicio();

$idservicio = isset($_POST['idservicio']) ? limpiarCadena($_POST['idservicio']) : "";
$nombre = isset($_POST['nombre']) ? limpiarCadena($_POST['nombre']) : "";
$descripcion = isset($_POST['descripcion']) ? limpiarCadena($_POST['descripcion']) : "";
$codigo = isset($_POST['codigo']) ? strtoupper(limpiarCadena($_POST['codigo'])) : "";

switch ($_GET['op']) {
	case 'guardaryeditar':

		if(empty($idservicio)){
			$rsp = $servicio->insertar($nombre, $descripcion, $codigo);
			echo $rsp ? "Servicio registrada": "Servicio no se pudo registrar";
		}
		else
		{
			$rsp = $servicio->editar($idservicio,$nombre, $descripcion, $codigo);
			echo $rsp ? "Se actualizó el Servicio": "Servicio no se pudo actualizar";
		}
		break;
	
	case 'desactivar':
			$rsp = $servicio->desactivar($idservicio);
			echo $rsp ? "Servicio Desactivada": "Servicio no se pudo desactivar";
		break;
	
	case 'activar':
			$rsp = $servicio->activar($idservicio);
			echo $rsp ? "Servicio Activada": "Servicio no se pudo activar";
		break;
	
	case 'mostrar':
			$rsp = $servicio->mostrar($idservicio);
			echo json_encode($rsp);
		break;
	
	case 'listar':
			$rsp = $servicio->listar();
			$data = Array();
			while ($reg=$rsp->fetch_object()) {
				$data[] = array(
					//"0"=>$reg->idservicio,
					"0"=>($reg->estado) ? "<button class='btn btn-warning' onclick='mostrar(".$reg->idservicio.")'><i class='fa fa-pencil'></i></button>".
						"  <button class='btn btn-danger' onclick='desactivar(".$reg->idservicio.")'><i class='fa fa-close'></i></button>" : 
						"<button class='btn btn-warning' onclick='mostrar(".$reg->idservicio.")'><i class='fa fa-pencil'></i></button>".
						"  <button class='btn btn-primary' onclick='activar(".$reg->idservicio.")'><i class='fa fa-check'></i></button>",
					"1"=>$reg->nombre,
					"2"=>$reg->descripcion,
					"3"=>$reg->codigo,
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