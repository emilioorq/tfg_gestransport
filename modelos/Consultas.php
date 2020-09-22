<?php 

require_once "../config/conexion.php";

Class Consultas
{
	public function __construct()
	{

	}
	
	public function comprasfecha($finicio,$ffin)
	{
		//echo "FINICIO: ".$finicio." - FIN: ".$ffin."<br>";

		$sql = "SELECT DATE(i.fecha_hora)  as fecha, u.nombre as usuario, p.nombre as proveedor, 
				i.tipo_comprobante, i.serie_comprobante, i.num_comprobante, i.total_compra, i.impuesto, 
				i.estado 
				FROM ingreso i 
				INNER JOIN usuario u ON i.idusuario = u.idusuario 
				INNER JOIN persona p ON i.idproveedor = p.idpersona 
				WHERE DATE (i.fecha_hora) >= '$finicio' AND DATE (i.fecha_hora) <= '$ffin'";
		//echo "<br>SQL:".$sql."<br>";
		return ejecutarConsulta($sql);
	}
	
	public function ventasfechacliente($finicio,$ffin,$idcliente)
	{
		//echo "FINICIO: ".$finicio." - FIN: ".$ffin."<br>";

		$sql = "SELECT DATE(v.fecha_hora)  as fecha, u.nombre as usuario, p.nombre as cliente, 
				v.tipo_comprobante, v.serie_comprobante, v.num_comprobante, v.total_venta, v.impuesto, 
				v.estado 
				FROM venta v
				INNER JOIN usuario u ON v.idusuario = u.idusuario 
				INNER JOIN persona p ON v.idcliente = p.idpersona 
				WHERE DATE (v.fecha_hora) >= '$finicio' AND DATE (v.fecha_hora) <= '$ffin' 
				AND v.idcliente = '$idcliente'";
		//echo "<br>SQL:".$sql."<br>";
		return ejecutarConsulta($sql);
	}

	public function totalcomprashoy()
	{
		$sql = "SELECT IFNULL(SUM(total_compra),0) as total_compra 
			FROM ingreso 
			WHERE DATE(fecha_hora) = curdate()";
		return ejecutarConsulta($sql);
	}
	
	public function totalventashoy()
	{
		$sql = "SELECT IFNULL(SUM(total_venta),0) as total_venta 
			FROM venta 
			WHERE DATE(fecha_hora) = curdate()";
		return ejecutarConsulta($sql);
	}

	public function compras_ultimos10dias()
	{
		$sql = "SELECT CONCAT(DAY(fecha_hora), '-', MONTH(fecha_hora)) as fecha,
				SUM(total_compra) as total 
				FROM ingreso 
				GROUP BY fecha_hora 
				ORDER BY fecha_hora DESC 
				LIMIT 0,10";

		return (ejecutarConsulta($sql));
	}
	
	public function ventas_ultimos12meses()
	{
		$sql = "SELECT DATE_FORMAT(fecha_hora, '%M') as fecha, SUM(total_venta) as total 
				FROM venta 
				GROUP BY MONTH(fecha_hora) 
				ORDER BY fecha_hora DESC 
				LIMIT 0,12";

		return (ejecutarConsulta($sql));
	}
	

	
}

 ?>