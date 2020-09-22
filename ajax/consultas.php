<?php 

require_once "../modelos/Consultas.php";

$consulta = new Consultas();



switch ($_GET['op']) {
	case 'comprasfecha':
			$finicio = $_REQUEST["fecha_inicio"];
			$ffin = $_REQUEST["fecha_fin"];
			$rsp = $consulta->comprasfecha($finicio, $ffin);
			$data = Array();
			while ($reg=$rsp->fetch_object()) {
				//var_dump($reg);
				$data[] = array(
					"0"=>$reg->fecha,
					"1"=>$reg->usuario,
					"2"=>$reg->proveedor,
					"3"=>$reg->tipo_comprobante,
					"4"=>$reg->serie_comprobante." ".$reg->num_comprobante,
					"5"=>$reg->total_compra,
					"6"=>$reg->impuesto,
					"7"=>($reg->estado == "Aceptado") ? '<span class="label bg-green">Aceptado</span>' 
											: '<span class="label bg-red">Anulado</span>'
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
	
	case 'ventasfechacliente':
			$finicio = $_REQUEST["fecha_inicio"];
			$ffin = $_REQUEST["fecha_fin"];
			$idcliente = $_REQUEST["idcliente"];
			$rsp = $consulta->ventasfechacliente($finicio, $ffin,$idcliente);
			$data = Array();
			while ($reg=$rsp->fetch_object()) {
				//var_dump($reg);
				$data[] = array(
					"0"=>$reg->fecha,
					"1"=>$reg->usuario,
					"2"=>$reg->cliente,
					"3"=>$reg->tipo_comprobante,
					"4"=>$reg->serie_comprobante." ".$reg->num_comprobante,
					"5"=>$reg->total_venta,
					"6"=>$reg->impuesto,
					"7"=>($reg->estado == "Aceptado") ? '<span class="label bg-green">Aceptado</span>' 
											: '<span class="label bg-red">Anulado</span>'
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
	
	case 'totalcomprashoy':
			$rsp = $consulta->totalcomprashoy();
			$regc = $rsp->fetch_object();
			$totalcomprashoy = $regc->total_compra;

			echo '	<h4 style="font-size: 17px;"> 
						<strong>'.$totalcomprashoy.'€</strong>
					</h4><p>Compras</p>';
		break;

	case 'totalventashoy':
			$rsp = $consulta->totalventashoy();
			$regc = $rsp->fetch_object();
			$totalventashoy = $regc->total_venta;

			echo '	<h4 style="font-size: 17px;"> 
						<strong>'.$totalventashoy.'€</strong>
					</h4><p>ventas</p>';
		break;

	case 'compras10dias':
			$rsp = $consulta->compras_ultimos10dias();
			$fechasc = [];
			$totalesc = [];

			$data = ['fechas'=>[], 'totales'=>[]];
			$i = 0;
			while ($reg=$rsp->fetch_object()) {
								
//				$data .= "<input type='text' name='fechasc[]' id='fechasc[]' value='".$reg->fecha."'>
//						<input type='text' name='totalesc[]' id='totalesc[]' value='".$reg->total."'>";
				array_push($data['fechas'], $reg->fecha);
				array_push($data['totales'], $reg->total);
				$i++;
			}
			//print_r($data);
			echo json_encode($data);

		break;
	
	default:
		# code...
		break;

}

 ?>