<?php 

require_once "../modelos/Repostaje.php";

$repostaje = new Repostaje();

$idrepostaje = isset($_POST['idrepostaje']) ? limpiarCadena($_POST['idrepostaje']) : "";
$fecha = isset($_POST['fecha']) ? limpiarCadena($_POST['fecha']) : "";
$litros = isset($_POST['litros']) ? limpiarCadena($_POST['litros']) : "";
$kms = isset($_POST['kms']) ? limpiarCadena($_POST['kms']) : "";
$total_repostaje = isset($_POST['total_repostaje']) ? limpiarCadena($_POST['total_repostaje']) : "";
$conductor = isset($_POST['conductor']) ? limpiarCadena($_POST['conductor']) : "";
$idvehiculo = isset($_POST['idvehiculo']) ? limpiarCadena($_POST['idvehiculo']) : "";



switch ($_GET['op']) {
	case 'guardaryeditar':

		if(empty($idrepostaje)){
			$rsp = $repostaje->insertar($fecha, $litros, $kms, $total_repostaje, $conductor, $idvehiculo);
			echo $rsp ? "Repostaje registrado": "Repostaje no se pudo registrar";
		}
		else
		{
			$rsp = $repostaje->editar($idrepostaje, $fecha, $litros, $kms, $total_repostaje, $conductor, $idvehiculo);
			echo $rsp ? "Se actualizó el Repostaje": "Repostaje no se pudo actualizar";
		}
		break;
	
	case 'eliminar':
			$rsp = $repostaje->eliminar($idrepostaje);
			echo $rsp ? "Repostaje eliminado": "Repostaje no se pudo eliminar";
		break;
	
	case 'mostrar':
			$rsp = $repostaje->mostrar($idrepostaje);
			echo json_encode($rsp);
		break;
	
	case 'listar':
			$rsp = $repostaje->listar();
			$data = Array();
			while ($reg=$rsp->fetch_object()) {
				$data[] = array(
					"0"=>"<button class='btn btn-warning' onclick='mostrar(".$reg->idrepostaje.")'><i class='fa fa-pencil'></i></button>".
						"  <button class='btn btn-danger' onclick='eliminar(".$reg->idrepostaje.")'><i class='fa fa-trash'></i></button>",
					"1"=>$reg->fecha,
					"2"=>$reg->vehiculo,
					"3"=>$reg->conductor,
					"4"=>$reg->litros,
					"5"=>$reg->total_repostaje
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
	
		case 'selectVehiculo':
			require_once "../modelos/Vehiculos.php";
			$vehiculo = new Vehiculo();

			$rsp = $vehiculo->select();

			while ($reg = $rsp->fetch_object())
			 {
				echo "<option value=".$reg->idvehiculo.">".$reg->matricula."</option>";
			}

			break;
	
	default:
		# code...
		break;
}

 ?>