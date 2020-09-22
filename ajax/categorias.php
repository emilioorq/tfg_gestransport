<?php 

require_once "../modelos/Categorias.php";

$categoria = new Categoria();

$idcategoria = isset($_POST['idcategoria']) ? limpiarCadena($_POST['idcategoria']) : "";
$nombre = isset($_POST['nombre']) ? limpiarCadena($_POST['nombre']) : "";
$descripcion = isset($_POST['descripcion']) ? limpiarCadena($_POST['descripcion']) : "";

//print_r($_POST);

switch ($_GET['op']) {
	case 'guardaryeditar':
		if(empty($idcategoria)){
			//echo "N: ".$nombre." - ".$descripcion."<br/>";
			$rsp = $categoria->insertar($nombre,$descripcion);
			echo $rsp ? "Categoría registrada": "Categoría no se pudo registrar";
		}
		else
		{
			$rsp = $categoria->editar($idcategoria,$nombre,$descripcion);
			echo $rsp ? "Se actualizó la categoría": "Categoría no se pudo actualizar";
		}
		break;
	
	case 'eliminar':
			$rsp = $categoria->eliminar($idcategoria);
			echo $rsp ? "Categoría Eliminada": "Categoría no se pudo eliminar";
		break;

	case 'mostrar':
			$rsp = $categoria->mostrar($idcategoria);
			echo json_encode($rsp);
		break;
	
	case 'listar':
			$rsp = $categoria->listar();
			$data = Array();
			while ($reg=$rsp->fetch_object()) {
				$data[] = array(
					"0"=>"<button class='btn btn-warning' onclick='mostrar(".$reg->idcategoria.")'><i class='fa fa-pencil'></i></button>".
						"  <button class='btn btn-danger' onclick='eliminar(".$reg->idcategoria.")'><i class='fa fa-trash'></i></button>",
					"1"=>$reg->nombre,
					"2"=>$reg->descripcion
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