<?php 

require_once "../modelos/Persona.php";

$persona = new Persona();

$idpersona = isset($_POST['idpersona']) ? limpiarCadena($_POST['idpersona']) : "";
$tipo_persona = isset($_POST['tipo_persona']) ? limpiarCadena($_POST['tipo_persona']) : "";
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
		if(empty($idpersona)){
			$rsp = $persona->insertar($documento, $num_documento, $tipo_persona, $nombre, $direccion, $cp, $localidad, $provincia, $telefono, $movil, $email, $web);
			if($rsp){

				echo $tipo_persona == "Cliente" ? "Se ha registrado el Cliente": "Se ha registrado el Proveedor";
			}
			else
			{

				echo $tipo_persona == "Cliente" ? "No se podido registrar el Cliente, inténtelo de nuevo": "No se podido registrar el Proveedor, inténtelo de nuevo";
			}
		}
		else
		{
			$rsp = $persona->editar($idpersona,$documento, $num_documento, $tipo_persona, $nombre, $direccion, $cp, $localidad, $provincia, $telefono, $movil, $email, $web);
			
			if($rsp){

				echo $tipo_persona == "Cliente" ? "Se ha actualizado el Cliente": "Se ha actualizado el Proveedor";
			}
			else
			{

				echo $tipo_persona == "Cliente" ? "No se podido actualizar el Cliente, inténtelo de nuevo": "No se podido actualizar el Proveedor, inténtelo de nuevo";
			}
		}
		break;
	
	case 'eliminar':
			$rsp = $persona->eliminar($idpersona);
			echo $rsp ? "Se ha eliminado Correctamente": "No se ha podido eliminar";
		break;
	
	case 'mostrar':
			$rsp = $persona->mostrar($idpersona);
			echo json_encode($rsp);
		break;
	
	case 'listarproveedores':
			$rsp = $persona->listarproveedores();
			$data = Array();
			while ($reg=$rsp->fetch_object()) {
				$data[] = array(
					//"0"=>$reg->idpersona,
					"0"=>"<button class='btn btn-warning' onclick='mostrar(".$reg->idpersona.")'><i class='fa fa-pencil'></i></button>".
						"  <button class='btn btn-danger' onclick='eliminar(".$reg->idpersona.")'><i class='fa fa-trash'></i></button>",
					"1"=>$reg->nombre,
					"2"=>$reg->documento,
					"3"=>$reg->num_documento,
					"4"=>$reg->telefono,
					"5"=>$reg->localidad,
					"6"=>$reg->email
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
	
	case 'listarclientes':
			$rsp = $persona->listarclientes();
			$data = Array();
			while ($reg=$rsp->fetch_object()) {
				$data[] = array(
					//"0"=>$reg->idpersona,
					"0"=>"<button class='btn btn-warning' onclick='mostrar(".$reg->idpersona.")'><i class='fa fa-pencil'></i></button>".
						"  <button class='btn btn-danger' onclick='eliminar(".$reg->idpersona.")'><i class='fa fa-trash'></i></button>",
					"1"=>$reg->nombre,
					"2"=>$reg->documento,
					"3"=>$reg->num_documento,
					"4"=>$reg->telefono,
					"5"=>$reg->localidad,
					"6"=>$reg->email
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

	case 'listarempresas':
			$rsp = $persona->listarempresas();
			$data = Array();
			while ($reg=$rsp->fetch_object()) {
				$data[] = array(
					//"0"=>$reg->idpersona,
					"0"=>"<button class='btn btn-warning' onclick='mostrar(".$reg->idpersona.")'><i class='fa fa-pencil'></i></button>".
						"  <button class='btn btn-danger' onclick='eliminar(".$reg->idpersona.")'><i class='fa fa-trash'></i></button>",
					"1"=>$reg->nombre,
					"2"=>$reg->documento,
					"3"=>$reg->num_documento,
					"4"=>$reg->telefono,
					"5"=>$reg->localidad,
					"6"=>$reg->email
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