<?php 

require_once "../modelos/Mantenimientos.php";

$mantenimiento = new Mantenimiento();

$idmantenimiento = isset($_POST['idmantenimiento']) ? limpiarCadena($_POST['idmantenimiento']) : "";
$fecha = isset($_POST['fecha']) ? limpiarCadena($_POST['fecha']) : "";
$nombre = isset($_POST['nombre']) ? limpiarCadena($_POST['nombre']) : "";
$descripcion = isset($_POST['descripcion']) ? limpiarCadena($_POST['descripcion']) : "";
$kms = isset($_POST['kms']) ? limpiarCadena($_POST['kms']) : "";

$precio_mant = isset($_POST['precio']) ? limpiarCadena($_POST['precio']) : "";
$precio = number_format(floatval($precio_mant),2,'.',',');

$impuesto = isset($_POST['impuesto']) ? limpiarCadena($_POST['impuesto']) : "";

$total_mant = isset($_POST['total_mantenimiento']) ? limpiarCadena($_POST['total_mantenimiento']) : "";
$total = number_format(floatval($total_mant),2,'.',',');

$idvehiculo = isset($_POST['idvehiculo']) ? limpiarCadena($_POST['idvehiculo']) : "";
$idcategoria = isset($_POST['idcategoria']) ? limpiarCadena($_POST['idcategoria']) : "";
$idproveedor = isset($_POST['idproveedor']) ? limpiarCadena($_POST['idproveedor']) : "";

switch ($_GET['op']) {
	case 'guardaryeditar':

		if(empty($idmantenimiento)){
			$rsp = $mantenimiento->insertar($fecha, $nombre, $descripcion, $kms, $precio, $impuesto, $total, $idvehiculo, $idcategoria, $idproveedor);
			echo $rsp ? "Mantenimiento registrado": "Mantenimiento no se pudo registrar";
		}
		else
		{
			$rsp = $mantenimiento->editar($idmantenimiento,$fecha, $nombre, $descripcion, $kms, $precio, $impuesto, $total, $idvehiculo, $idcategoria, $idproveedor);
			echo $rsp ? "Se actualizó el Mantenimiento": "Mantenimiento no se pudo actualizar";
		}
		break;
	
	case 'eliminar':
			$rsp = $mantenimiento->eliminar($idmantenimiento);
			echo $rsp ? "Mantenimiento eliminado": "Mantenimiento no se pudo eliminar";
		break;
	
	case 'mostrar':
			$rsp = $mantenimiento->mostrar($idmantenimiento);
			echo json_encode($rsp);
		break;
	
	case 'listar':
			$rsp = $mantenimiento->listar();
			$data = Array();
			while ($reg=$rsp->fetch_object()) {
				$data[] = array(
					"0"=>"<button class='btn btn-warning' onclick='mostrar(".$reg->idmantenimiento.")'><i class='fa fa-pencil'></i></button>".
						"  <button class='btn btn-danger' onclick='eliminar(".$reg->idmantenimiento.")'><i class='fa fa-trash'></i></button>",
					"1"=>$reg->fecha,
					"2"=>$reg->nombre,
					"3"=>$reg->vehiculo,
					"4"=>$reg->categoria,
					"5"=>$reg->proveedor,
					"6"=>$reg->total
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

		case 'selectCategoria':
			require_once "../modelos/Categorias.php";
			$categoria = new Categoria();

			$rsp = $categoria->select();

			while ($reg = $rsp->fetch_object())
			 {
				echo "<option value=".$reg->idcategoria.">".$reg->nombre."</option>";
			}

			break;
	
		case 'selectProveedor':
			require_once "../modelos/Persona.php";
			$persona = new Persona();

			$rsp = $persona->listarproveedores();

			while ($reg = $rsp->fetch_object())
			 {
				echo "<option value=".$reg->idpersona.">".$reg->nombre."</option>";
			}

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