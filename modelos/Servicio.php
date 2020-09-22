<?php 

require_once "../config/conexion.php";

Class Servicio
{
	public function __construct()
	{

	}

	public function insertar($nombre, $descripcion, $codigo)
	{
		$sql = "INSERT INTO servicios (nombre, descripcion, codigo, estado) 
				VALUES ('$nombre', '$descripcion', '$codigo', '1')";
		return consulta($sql);
	}

	public function editar($idservicio,$nombre, $descripcion, $codigo)
	{
		$sql = "UPDATE servicios 
				SET nombre= '$nombre', descripcion = '$descripcion', 
					codigo = '$codigo'  
				WHERE idservicio = '$idservicio' ";
		return consulta($sql);
	}

	public function desactivar($idservicio)
	{
		$sql = "UPDATE servicios 
				SET estado = '0'
				WHERE idservicio = '$idservicio' ";
		return consulta($sql);
	}

	public function activar($idservicio)
	{
		$sql = "UPDATE servicios 
				SET estado = '1'
				WHERE idservicio = '$idservicio' ";
		return consulta($sql);
	}

	public function mostrar($idservicio)
	{
		$sql = "SELECT * FROM servicios WHERE idservicio = '$idservicio'";
		return consultaSimple($sql);
	}
	
	public function listar()
	{
		$sql = "SELECT *  FROM servicios";
		return consulta($sql);
	}

	public function listarActivos()
	{
		$sql = "SELECT *  FROM servicios WHERE estado = 1 ";
		return consulta($sql);
	}
	
}

 ?>