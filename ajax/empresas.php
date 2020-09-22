<?php 

require_once "../modelos/Empresas.php";

$empresa = new Empresa();

$idempresa = isset($_POST['idempresa']) ? limpiarCadena($_POST['idempresa']) : "";
$nombre = isset($_POST['nombre']) ? limpiarCadena($_POST['nombre']) : "";
$documento = isset($_POST['documento']) ? limpiarCadena($_POST['documento']) : "";
$num_documento = isset($_POST['num_documento']) ? limpiarCadena($_POST['num_documento']) : "";
$direccion = isset($_POST['direccion']) ? limpiarCadena($_POST['direccion']) : "";
$cp = isset($_POST['cp']) ? limpiarCadena($_POST['cp']) : "";
$localidad = isset($_POST['localidad']) ? limpiarCadena($_POST['localidad']) : "";
$provincia = isset($_POST['provincia']) ? limpiarCadena($_POST['provincia']) : "";
$telefono = isset($_POST['telefono']) ? limpiarCadena($_POST['telefono']) : "";
$movil = isset($_POST['movil']) ? limpiarCadena($_POST['movil']) : "";
$email = isset($_POST['email']) ? limpiarCadena($_POST['email']) : "";
$web = isset($_POST['web']) ? limpiarCadena($_POST['web']) : "";

switch ($_GET['op']) {
	case 'guardaryeditar':
		if(empty($idempresa)){
			$rsp = $empresa->insertar($documento, $num_documento, $nombre, $direccion, $cp, $localidad, $provincia, $telefono, $movil, $email, $web);
				
				echo $rsp == 1 ? "Se ha registrado la Empresa": "No se ha podido registrar la Empresa";
		}
		else
		{
			$rsp = $empresa->editar($idempresa,$documento, $num_documento,  $nombre, $direccion, $cp, $localidad, $provincia, $telefono, $movil, $email, $web);
				
				echo $rsp == 1 ? "Se ha actualizado la Empresa": "No se ha podido actualizar la Empresa";
		}
		break;
	
	case 'desactivar':
			$rsp = $empresa->desactivar($idempresa);
			echo $rsp ? "Se ha desactivado Correctamente": "No se ha podido desactivar";
		break;
	
	case 'activar':
			$rsp = $empresa->activar($idempresa);
			echo $rsp ? "Se ha activado Correctamente": "No se ha podido activar";
		break;
	
	case 'mostrar':
			$rsp = $empresa->mostrar($idempresa);
			echo json_encode($rsp);
		break;
	
	case 'listar':
			$rsp = $empresa->listar();
			$data = Array();
			while ($reg=$rsp->fetch_object()) {
				$data[] = array(
					"0"=>($reg->estado) ? "<button class='btn btn-warning' onclick='mostrar(".$reg->idempresa.")'><i class='fa fa-pencil'></i></button>".
						"  <button class='btn btn-danger' onclick='desactivar(".$reg->idempresa.")'><i class='fa fa-power-off'></i></button>" : 
						"<button class='btn btn-warning' onclick='mostrar(".$reg->idempresa.")'><i class='fa fa-pencil'></i></button>".
						"  <button class='btn btn-primary' onclick='activar(".$reg->idempresa.")'><i class='fa fa-check'></i></button>",
					"1"=>$reg->nombre,
					"2"=>$reg->documento,
					"3"=>$reg->num_documento,
					"4"=>$reg->telefono,
					"5"=>$reg->localidad,
					"6"=>$reg->email,
					"7"=>($reg->estado) ? '<span class="label bg-green">Activado</span>' 
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