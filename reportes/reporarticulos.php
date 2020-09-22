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

    if($_SESSION['administrador']==1 || $_SESSION['ventas']==1)
    {
    	require '../reportes/PDF_MC_Table.php';
    	$pdf = new PDF_MC_Table();

    	$pdf->AddPage();

    	$y_axis_initial = 25;

    	$pdf->SetFont('Arial','B','12');
    	$pdf->Cell(40,6,'',0,0,'C');
    	$pdf->Cell(100,6,'LISTA DE ARTICULOS',1,0,'C');
    	$pdf->Ln(10);

    	$pdf->SetFillColor(232,232,232);
    	$pdf->SetFont('Arial','B','10');
    	$pdf->Cell(58,6,'Nombre',1,0,'C',1);
    	$pdf->Cell(50,6,utf8_decode('Categoría'),1,0,'C',1);
    	$pdf->Cell(30,6,utf8_decode('Código'),1,0,'C',1);
    	$pdf->Cell(12,6,'Stock',1,0,'C',1);
    	$pdf->Cell(35,6,utf8_decode('Descripción'),1,0,'C',1);
    	$pdf->Ln(10);

    	require '../modelos/Articulo.php';
    	$articulo = new Articulo();

    	$rsp = $articulo->listar();

    	$pdf->SetWidths([58,50,30,12,35]);

		while ($reg=$rsp->fetch_object())
		{
			$nombre = $reg->nombre;
			$categoria = $reg->categoria;
			$codigo = $reg->codigo;
			$stock = $reg->stock;
			$descripcion = $reg->descripcion;
    		
    		$pdf->SetFont('Arial','','10');
    		$pdf->Row([utf8_decode($nombre),utf8_decode($categoria),$codigo,$stock,utf8_decode($descripcion)]);


		}

		$pdf->Output();

	}
else 
{
  echo "No tiene permisos para visualizar el reporte";
}



}
//vaciar el buffer.
ob_end_flush();
?>