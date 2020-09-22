<?php 

require_once "../config/conexion.php";

Class Mantenimiento
{
	public function __construct()
	{

	}

	public function insertar($fecha, $nombre, $descripcion, $kms, $precio, $impuesto, $total, $idvehiculo, $idcategoria, $idproveedor)
	{
		$sql = "INSERT INTO mantenimientos (fecha, nombre, descripcion, kms, precio, impuesto, total, fkvehiculo, fkcategoria, fkproveedor) 
				VALUES ('$fecha','$nombre','$descripcion','$kms','$precio','$impuesto','$total','$idvehiculo','$idcategoria','$idproveedor')";
		return consulta($sql);
	}

	public function editar($idmantenimiento, $fecha, $nombre, $descripcion, $kms, $precio, $impuesto, $total, $idvehiculo, $idcategoria, $idproveedor)
	{
		$sql = "UPDATE mantenimientos 
				SET fecha= '$fecha', nombre = '$nombre', descripcion = '$descripcion', kms = '$kms', precio = '$precio', impuesto = '$impuesto', 
				total = '$total', fkvehiculo = '$idvehiculo', fkcategoria = '$idcategoria', fkproveedor = '$idproveedor' 
				WHERE idmantenimiento = '$idmantenimiento' ";
		return consulta($sql);
	}

	public function eliminar($idmantenimiento)
	{
		$sql = "DELETE FROM mantenimientos 
				WHERE idmantenimiento = '$idmantenimiento' ";
		return consulta($sql);
	}

	public function mostrar($idmantenimiento)
	{
		$sql = "SELECT * FROM mantenimientos WHERE idmantenimiento = '$idmantenimiento'";
		return consultaSimple($sql);
	}
	
	public function listar()
	{
		$sql = "SELECT m.*, c.nombre as categoria, p.nombre as proveedor, v.matricula as vehiculo  
				FROM mantenimientos m 
				INNER JOIN categoria_mantenimientos c ON m.fkcategoria = c.idcategoria 
				INNER JOIN vehiculos v ON m.fkvehiculo = v.idvehiculo  
				INNER JOIN  personas p ON m.fkproveedor = p.idpersona ";
		return consulta($sql);
	}
	

	public function listarActivosVenta()
	{
		$sql = "SELECT a.idmantenimiento, a.idcategoria, c.nombre as categoria, a.codigo, a.nombre, a.stock, 
					(SELECT precio_venta FROM detalle_ingreso WHERE idmantenimiento = a.idmantenimiento ORDER BY iddetalle_ingreso DESC LIMIT 0,1) as precio_venta, 
				a.descripcion, a.imagen, a.condicion 
				FROM mantenimientos a INNER JOIN categoria c ON a.idcategoria = c.idcategoria 
				WHERE a.condicion = '1'";
		
		return consulta($sql);
	}
	
}

 ?>