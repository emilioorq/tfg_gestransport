<?php 
if(strlen(session_id()) < 1)
{
  session_start();
}
require_once "../modelos/Factura.php";

$factura = new Factura();

$idfactura = isset($_POST['idfactura']) ? limpiarCadena($_POST['idfactura']) : "";
$idcliente = isset($_POST['idcliente']) ? limpiarCadena($_POST['idcliente']) : "";
$idusuario = $_SESSION['idusuario'];
$tipo_factura = isset($_POST['tipo_factura']) ? limpiarCadena($_POST['tipo_factura']) : "";
$serie = isset($_POST['serie']) ? limpiarCadena($_POST['serie']) : date('Y');
$numero_factura = isset($_POST['numero_factura']) ? limpiarCadena($_POST['numero_factura']) : "";
$fecha = isset($_POST['fecha']) ? limpiarCadena($_POST['fecha']) : "";
$impuesto = isset($_POST['impuesto']) ? limpiarCadena($_POST['impuesto']) : "";
$retencion = isset($_POST['retencion']) ? limpiarCadena($_POST['retencion']) : "";
$total_factura = isset($_POST['total_factura']) ? limpiarCadena($_POST['total_factura']) : "";



switch ($_GET['op']) {
	case 'guardaryeditar':
		if(empty($idfactura)){
			$rsp = $factura->insertar($fecha, $tipo_factura, $serie, $numero_factura, $impuesto, $retencion, $total_factura, $idcliente, $idusuario, $_POST['idservicio'], $_POST['cantidad'], $_POST['descuento'], $_POST['precio']);
			echo $rsp ? "Factura registrada": "No se pudo registrar la Factura";
		}
		else
		{

		}
		break;
	
	case 'anular':
			$rsp = $factura->anular($idfactura);
			echo $rsp ? "Factura Anulada": "No se pudo anular la Factura";
		break;
	
	case 'abonar':
			$rsp = $factura->abonar($idfactura);
			echo $rsp ? "Factura Abonada": "No se pudo abonar la Factura";
		break;
	
	case 'mostrar':
			$rsp = $factura->mostrar($idfactura);
			echo json_encode($rsp);
		break;
	
	case 'listarDetalle':
			$id = $_GET['id'];
			$rsp = $factura->listarDetalle($id);

			$total = 0.0;

			echo '	<thead style="background-color: #a9d0f5">
	                    <th>Opciones</th>
	                    <th>Articulo</th>
	                    <th>Cantidad</th>
	                    <th>Precio Venta</th>
	                    <th>Descuento (%)</th>
	                    <th>Subtotal</th>
	                  </thead>';



			while ($reg=$rsp->fetch_object()) 
			{
				echo "<tr class='filas'>
					<td></td>
					<td>".$reg->nombre."</td>
					<td>".$reg->cantidad."</td>
					<td>".$reg->precio."</td>
					<td>".$reg->descuento."</td>
					<td>".$reg->subtotal."</td>
					</tr>";

				//$total += ($reg->cantidad * $reg->precio_compra);
				$total += ($reg->subtotal);
			}

			echo '<tfoot>
                    <th><h4><strong>Total: </strong></h4></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>
                      <h4 id="total">'.$total.' €</h4>
                      <input type="hidden" name="total_venta" id="total_venta">
                    </th>
                  </tfoot>';

			echo json_encode($rsp);
		break;
	
	case 'listar':
			$rsp = $factura->listar();
			$data = Array();
			while ($reg=$rsp->fetch_object()) {

				if($reg->tipo_factura == 'Proforma')
				{
					$rurl = '../reportes/exTicket.php?id=';
				}
				else
				{
					$rurl = '../reportes/exFactura.php?id=';

				}


				$data[] = array(
					"0"=>(($reg->estado == 'Aceptado') ? "<button class='btn btn-default' onclick='Ver(".$reg->idfactura.")' title='Mostrar'><i class='fa fa-eye'></i></button>".
											"  <button class='btn btn-danger' onclick='anular(".$reg->idfactura.")' title='Anular'><i class='fa fa-close'></i></button>".
											"  <button class='btn btn-success' onclick='abonar(".$reg->idfactura.")' title='Abonar'><i class='fa fa-bolt'></i></button>" : 
											"<button class='btn btn-warning' onclick='mostrar(".$reg->idfactura.")' title='Ver'><i class='fa fa-pencil'></i></button>").
											"<a target='_blank' title='Imprimir' href='".$rurl.$reg->idfactura."'> 
											<button class='btn btn-info'><i class='fa fa-file'></i></button>
											</a>",
							"1"=>$reg->fecha,
							"2"=>$reg->tipo_factura,
							"3"=>$reg->serie,
							"4"=>$reg->numero_factura,
							"5"=>$reg->cliente,
							"6"=>$reg->total_factura,
							"7"=>($reg->estado == 'Aceptado') ? '<span class="label bg-blue">Aceptada</span>' 
													: '<span class="label bg-green">Pagada</span>'
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

		case 'selectCliente':
			require_once "../modelos/Persona.php";
			$persona = new Persona();

			$rsp = $persona->listarclientes();

			while ($reg = $rsp->fetch_object())
			{
				echo "<option value='".$reg->idpersona."'>".$reg->nombre."</option>";
			}

			break;
	
		case 'listarServicios':
			require_once "../modelos/Servicio.php";
			
			$servicio = new Servicio();

			$rsp = $servicio->listarActivos();
			
			$data = Array();
			
			while ($reg=$rsp->fetch_object()) {
				$data[] = array(
					//"0"=>$reg->idarticulo,
					"0"=>'<button class="btn btn-warning" onclick="agregarDetalle( '.$reg->idservicio.',\''.$reg->nombre.'\')">
							<span class="fa fa-plus"></span></button>',
					"1"=>$reg->nombre,
					"2"=>$reg->codigo,
					"3"=>$reg->descripcion
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