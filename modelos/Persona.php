<?php 

require_once "../config/conexion.php";

Class Persona
{
	public function __construct()
	{

	}

	public function insertar($documento, $num_documento, $tipo_persona, $nombre, $direccion, $cp, $localidad, $provincia, $telefono, $movil, $email, $web)
	{
		$sql = "INSERT INTO personas (documento, num_documento, tipo_persona, nombre,  direccion,  cp, localidad, provincia, telefono, movil, email, web, fkEmpresa, estado) 
				VALUES ('$documento', '$num_documento','$tipo_persona', '$nombre', '$direccion',' $cp', '$localidad', '$provincia', '$telefono', '$movil', '$email', '$web', '1', '1')";
		return consulta($sql);
	}

	public function editar($idpersona,$documento, $num_documento, $tipo_persona, $nombre, $direccion, $cp, $localidad, $provincia, $telefono, $movil, $email, $web)
	{
		$sql = "UPDATE personas 
				SET	documento = '$documento',
					num_documento = '$num_documento' ,
					tipo_persona = '$tipo_persona' ,
					nombre = '$nombre' ,
					direccion = '$direccion' ,
					cp = '$cp' ,
					localidad = '$localidad' ,
					provincia = '$provincia' ,
					telefono = '$telefono' ,
					movil = '$movil', 
					email = '$email', 
					web = '$web' 
				WHERE idpersona = '$idpersona' ";

		return consulta($sql);
	}

	public function eliminar($idpersona)
	{
		$sql = "DELETE personas 
				WHERE idpersona = '$idpersona' ";
		return consulta($sql);
	}

	public function mostrar($idpersona)
	{
		$sql = "SELECT * FROM personas WHERE idpersona = '$idpersona'";
		return consultaSimple($sql);
	}
	
	public function listarproveedores()
	{
		$sql = "SELECT * FROM personas WHERE tipo_persona = 'Proveedor'";
		return consulta($sql);
	}
	
	public function listarclientes()
	{
		$sql = "SELECT * FROM personas WHERE tipo_persona = 'Cliente'";;
		return (consulta($sql));
	}
	
	public function select()
	{
		$sql = "SELECT * FROM personas WHERE estado = 1";
		return consulta($sql);
	}
	
}

 ?>