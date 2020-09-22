<?php 

require_once "../config/conexion.php";

Class Categoria
{
	public function __construct()
	{

	}

	public function insertar($nombre, $descripcion)
	{
		$sql = "INSERT INTO categoria_mantenimientos (nombre, descripcion) 
				VALUES ('$nombre','$descripcion')";
		return consulta($sql);
	}

	public function editar($idcategoria,$nombre,$descripcion)
	{
		$sql = "UPDATE categoria_mantenimientos 
				SET nombre = '$nombre', descripcion = '$descripcion' 
				WHERE idcategoria = '$idcategoria' ";
		return consulta($sql);
	}

	public function eliminar($idcategoria)
	{
		$sql = "DELETE categoria_mantenimientos 
				WHERE idcategoria = '$idcategoria' ";
		return consulta($sql);
	}

	public function mostrar($idcategoria)
	{
		$sql = "SELECT * FROM categoria_mantenimientos WHERE idcategoria = '$idcategoria'";
		return consultaSimple($sql);
	}
	
	public function listar()
	{
		$sql = "SELECT * FROM categoria_mantenimientos";
		return consulta($sql);
	}
	
	public function select()
	{
		$sql = "SELECT * FROM categoria_mantenimientos";
		return consulta($sql);
	}
	
}

 ?>