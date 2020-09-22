<?php 

require_once "../config/conexion.php";

Class Empresa
{
	public function __construct()
	{

	}

	public function insertar($documento, $num_documento, $nombre, $direccion, $cp, $localidad, $provincia, $telefono, $movil, $email, $web)
	{
		$sql = "INSERT INTO empresas (documento, num_documento, nombre,  direccion,  cp, localidad, provincia, telefono, movil, email, web, estado) 
				VALUES ('$documento', '$num_documento','$nombre', '$direccion',' $cp', '$localidad', '$provincia', '$telefono', '$movil', '$email', '$web', '1')";
		return consulta($sql);
	}

	public function editar($idempresa,$documento, $num_documento, $nombre, $direccion, $cp, $localidad, $provincia, $telefono, $movil, $email, $web)
	{
		$sql = "UPDATE empresas 
				SET	documento = '$documento',
					num_documento = '$num_documento' ,
					nombre = '$nombre' ,
					direccion = '$direccion' ,
					cp = '$cp' ,
					localidad = '$localidad' ,
					provincia = '$provincia' ,
					telefono = '$telefono' ,
					movil = '$movil', 
					email = '$email', 
					web = '$web' 
				WHERE idempresa = '$idempresa' ";

		return consulta($sql);
	}

	public function desactivar($idempresa)
	{
		$sql = "UPDATE empresas 
				SET estado = 0 
				WHERE idempresa = '$idempresa' ";
		return consulta($sql);
	}

	public function activar($idempresa)
	{
		$sql = "UPDATE empresas 
				SET estado = 1 
				WHERE idempresa = '$idempresa' ";
		return consulta($sql);
	}

	public function mostrar($idempresa)
	{
		$sql = "SELECT * FROM empresas WHERE idempresa = '$idempresa'";
		return consultaSimple($sql);
	}

	public function listar()
	{
		$sql = "SELECT * FROM empresas";;
		return consulta($sql);
	}
	
	public function select()
	{
		$sql = "SELECT * FROM empresas WHERE estado = 1";
		return consulta($sql);
	}
	
}

 ?>