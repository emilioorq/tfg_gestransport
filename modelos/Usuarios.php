<?php 

require_once "../config/conexion.php";

Class Usuario
{
	public function __construct()
	{

	}

	public function insertar($nombre, $email, $rol, $password)
	{
		$sql = "INSERT INTO usuarios (nombre, email, rol, password, fkempresa, estado) 
				VALUES ('$nombre', '$email', '$rol', '$password','1','1')";
		return consulta($sql);

	}

	public function editar($idusuario, $nombre, $email, $rol,$password)
	{
		$sql = "UPDATE usuarios 
				SET nombre = '$nombre',
					email = '$email',  
					password = '$password',  
					rol = '$rol'
				WHERE idusuario = '$idusuario' ";
		return consulta($sql);


	}

	public function desactivar($idusuario)
	{
		$sql = "UPDATE usuarios 
				SET estado = '0'
				WHERE idusuario = '$idusuario' ";
		return consulta($sql);
	}

	public function activar($idusuario)
	{
		$sql = "UPDATE usuarios 
				SET estado = '1'
				WHERE idusuario = '$idusuario' ";
		return consulta($sql);
	}

	public function mostrar($idusuario)
	{
		$sql = "SELECT * FROM usuarios WHERE idusuario = '$idusuario'";
		return consultaSimple($sql);
	}
	
	public function listar()
	{
		$sql = "SELECT * FROM usuarios";
		return consulta($sql);
	}


//Función que comprueba los datos de usuario al hacer login.

	public function checkUser($user, $password)
	{

		$sql = "SELECT idusuario, nombre, email, rol, last_login as last, estado, fkempresa 
				FROM usuarios 
				WHERE nombre = '$user' AND password = '$password' AND estado = '1'";
		//echo "SQL".$sql;
		return consulta($sql);

	}

	public function update_login($idusuario)
	{
		$last = $_SESSION['last'];
		$sql = "UPDATE usuarios 
				SET last_login = '$last'
				WHERE idusuario = '$idusuario' ";
		return consulta($sql);
	}
}

 ?>