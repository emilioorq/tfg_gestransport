	<?php

//Activamos el almacenamiento en el buffer
ob_start();
if(strlen(session_id()) < 1)
{
  session_start();
}

if(!isset($_SESSION['nombre']))
{
  echo "Debe acceder al sistema para visualizar el reporte";
}
else{
	
    if($_SESSION['administrador']==1 || $_SESSION['almacen']==1)
    {
    	require 'Factura.php';

    	$logo = "logo.jpg";
    	$ext_logo = "jpg";
    	$empresa = "GesTranport";
    	$documento = "A00000000";
    	$direccion = "Calle cliente, 9";
    	$telefono = "931742904";
    	$email = "mail@mail.com";

    	require_once '../modelos/Venta.php';

    	$venta = new Venta();
    	$rsp = $venta->ventascabecera($_GET['id']);
    	$reg = $rsp->fetch_object();


    	$pdf = new PDF_Invoice('P','mm','A4');
    	$pdf->AddPage();

// Datos de la empresa
    	$pdf->addSociete($empresa, $documento."\n".
    					utf8_decode("Dirección: ").$direccion."\n".
    					utf8_decode("Teléfono: ").$telefono."\n".
    					"Email: ".$email,$logo,$ext_logo);

// Datos de la factura
    	$pdf->fact_dev("$reg->tipo_comprobante"," $reg->serie_comprobante - $reg->num_comprobante");

//Marca de agua
    	$pdf->temporaire("");

//fecha de factura
		$pdf->addDate($reg->fecha);
    	
//Datos del cliente
		$pdf->addClientAdresse(utf8_decode($reg->cliente),"Domicilio: ".utf8_decode($reg->direccion), $reg->tipo_documento.": ". 
								$reg->num_documento,"Email: ".$reg->email, utf8_decode("Teléfono: ").$reg->telefono);


		$cols = array(	"CODIGO"=>23,
						"DESCRIPCION"=>78,
						"CANTIDAD"=>22,
						"P.V.P."=>25,
						"DCTO"=>20,
						"SUBTOTAL"=>22);

		$pdf->addCols($cols);

		$cols = array(	"CODIGO"=>"L",
						"DESCRIPCION"=>"L",
						"CANTIDAD"=>"C",
						"P.V.P."=>"R",
						"DCTO"=>"R",
						"SUBTOTAL"=>"C");

		$pdf->addLineFormat($cols);
		$pdf->addLineFormat($cols);

// Coordenada Y, desde donde empezará a mostrar los datos.
		$y = 89;

// Detalles de la venta
		$rspt = $venta->ventadetalle($_GET['id']);

		while ($regd = $rspt->fetch_object()) 
		{
			$line = [	"CODIGO" => "$regd->codigo",
						"DESCRIPCION"=> utf8_decode($regd->articulo),
						"CANTIDAD"=> "$regd->cantidad",
						"P.V.P."=> "$regd->precio_venta",
						"DCTO"=> "$regd->descuento",
						"SUBTOTAL"=>"$regd->subtotal"];
					$size = $pdf->addLine($y,$line);
					$y += $size + 2;
		}

// Convertir la cantidad en letras.
		require_once 'Letras.php';

		$valor = new EnLetras();
		$en_letras = strtoupper($valor->ValorEnLetras($reg->total_venta," EUROS "));
		$pdf->addCadreTVAs("---" . $en_letras);

// Impuestos
		$pdf->addTVAs($reg->impuesto, $reg->total_venta, " EUROS " );
		$pdf->addCadreEurosFrancs("IVA"." $reg->impuesto %");
		$pdf->Output($reg->tipo_comprobante.'_'.$reg->num_comprobante.'.pdf',"D");

	}
else 
	{
	  echo "No tiene permisos para visualizar el reporte";
	}

}
//vaciar el buffer.
ob_end_flush();
?>