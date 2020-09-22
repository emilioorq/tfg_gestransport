<?php 
session_start();

require_once "../modelos/Usuarios.php";

$usuario = new Usuario();


$idusuario = isset($_POST['idusuario']) ? limpiarCadena($_POST['idusuario']) : "";
$nombre = isset($_POST['nombre']) ? limpiarCadena($_POST['nombre']) : "";
$email = isset($_POST['email']) ? limpiarCadena($_POST['email']) : "";
$rol = isset($_POST['rol']) ? limpiarCadena($_POST['rol']) : "";
$password = isset($_POST['password']) ? limpiarCadena($_POST['password']) : "";

switch ($_GET['op']) {
	case 'guardaryeditar':

		//Hash SHA256	

		if(empty($idusuario)){
			$clavehash = hash("SHA256", $password);

			$rsp = $usuario->insertar($nombre, $email, $rol, $password);
			echo $rsp ? "Usuario registrado": "El Usuario no se pudo registrar";
		}
		else
		{
			$pass = ($password == $_POST['claveactual']) ? $_POST['claveactual'] : hash("SHA256", $password) ;

			$rsp = $usuario->editar($idusuario,$nombre, $email, $rol,$pass);
			echo $rsp ? "Se actualizó el Usuario": "El usuario no se pudo actualizar";
		}
		break;

	case 'desactivar':
			$rsp = $usuario->desactivar($idusuario);
			//print_r($rsp);
			echo $rsp ? "Usuario Desactivado": "El Usuario no se pudo desactivar";
		break;
	
	case 'activar':
			$rsp = $usuario->activar($idusuario);
			echo $rsp ? "Usuario Activado": "El usuario no se pudo activar";
		break;

	case 'mostrar':
			$rsp = $usuario->mostrar($idusuario);
			echo json_encode($rsp);
		break;
	
	case 'listar':
			$rsp = $usuario->listar();
			$data = Array();
			while ($reg=$rsp->fetch_object()) {
				$data[] = array(
					"0"=>($reg->estado) ? "<button class='btn btn-warning' onclick='mostrar(".$reg->idusuario.")'><i class='fa fa-pencil'></i></button>".
						"  <button class='btn btn-danger' onclick='desactivar(".$reg->idusuario.")'><i class='fa fa-close'></i></button>" : 
						"<button class='btn btn-warning' onclick='mostrar(".$reg->idusuario.")'><i class='fa fa-pencil'></i></button>".
						"  <button class='btn btn-primary' onclick='activar(".$reg->idusuario.")'><i class='fa fa-check'></i></button>",
					"1"=>$reg->nombre,
					"2"=>$reg->email,
					"3"=>($reg->rol== 1) ? 'Administrador' : 'Contabilidad',
					"4"=>$reg->last_login,
					"5"=>($reg->estado) ? '<span class="label bg-green">Activado</span>' 
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

// Comprueba los datos de acceso del usuario.
		case 'checkUser':

			$loginuser = $_POST['loginuser'];
			$passuser = $_POST['passuser'];

//print_r($_POST);

			$clavehash = hash('SHA256', $passuser);

			$rsp = $usuario->checkUser($loginuser, $clavehash);


			$obj = $rsp->fetch_object();
			
			print_r($obj);

			if(isset($obj))
			{
				$_SESSION['idusuario'] = $obj->idusuario;
				$_SESSION['nombre'] = $obj->nombre;
				$_SESSION['email'] = $obj->email;
				$_SESSION['rol'] = $obj->rol;
				$_SESSION['last'] = date("Y-m-d H:i:s");
				$_SESSION['estado'] = $obj->estado;
				
				$usuario->update_login($obj->idusuario);
			}


			echo json_encode($obj);

		break;

		case 'salir':
			
			$rsp = $usuario->update_login($_SESSION['idusuario']);
			if($rsp){
				session_unset();
				session_destroy();
				echo true;
			}
			else
			{
				echo false;
			}
			//header("location: ../index.php");

			break;

	default:
		# code...
		break;
}

 ?>