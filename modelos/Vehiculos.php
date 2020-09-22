<?php 

require_once "../config/conexion.php";

Class Vehiculo
{
	public function __construct()
	{

	}

	public function insertar($matricula, $fecha_matricula, $fecha_compra, $marca, $modelo, $extras)
	{
		$sql = "INSERT INTO vehiculos (matricula, fecha_matricula, fecha_compra, marca, modelo, extras, fkEmpresa, estado) 
				VALUES ('$matricula', '$fecha_matricula', '$fecha_compra', '$marca', '$modelo', '$extras', '1', '1')";
		return consulta($sql);
	}

	public function editar($idvehiculo,$matricula, $fecha_matricula, $fecha_compra, $marca, $modelo, $extras)
	{
		$sql = "UPDATE vehiculos 
				SET matricula= '$matricula', fecha_matricula = '$fecha_matricula', 
					fecha_compra = '$fecha_compra', marca = '$marca', modelo = '$modelo', extras = '$extras' 
				WHERE idvehiculo = '$idvehiculo' ";
		return consulta($sql);
	}

	public function desactivar($idvehiculo)
	{
		$sql = "UPDATE vehiculos 
				SET estado = '0'
				WHERE idvehiculo = '$idvehiculo' ";
		return consulta($sql);
	}

	public function activar($idvehiculo)
	{
		$sql = "UPDATE vehiculos 
				SET estado = '1'
				WHERE idvehiculo = '$idvehiculo' ";
		return consulta($sql);
	}

	public function mostrar($idvehiculo)
	{
		$sql = "SELECT * FROM vehiculos WHERE idvehiculo = '$idvehiculo'";
		return consultaSimple($sql);
	}
	
	public function listar()
	{
		$sql = "SELECT *  FROM vehiculos";
		return consulta($sql);
	}

	public function select()
	{
		$sql = "SELECT *  FROM vehiculos WHERE estado = 1 ";
		return consulta($sql);
	}
	
}

 ?>