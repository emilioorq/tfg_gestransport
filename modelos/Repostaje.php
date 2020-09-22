<?php 

require_once "../config/conexion.php";

Class Repostaje
{
	public function __construct()
	{

	}

	public function insertar($fecha, $litros, $kms, $total_repostaje, $conductor, $idvehiculo)
	{
		$sql = "INSERT INTO repostajes (fecha, litros, kms, total_repostaje, conductor, fkvehiculo, estado) 
				VALUES ('$fecha','$litros','$kms', '$total_repostaje','$conductor','$idvehiculo','1')";
		return consulta($sql);
	}

	public function editar($idrepostaje, $fecha, $litros, $kms, $total_repostaje, $conductor, $idvehiculo)
	{
		$sql = "UPDATE repostajes 
				SET fecha= '$fecha', litros = '$litros', kms = '$kms', total_repostaje = '$total_repostaje', conductor = '$conductor', fkvehiculo = '$idvehiculo' 
				WHERE idrepostaje = '$idrepostaje' ";
		return consulta($sql);
	}

	public function eliminar($idrepostaje)
	{
		$sql = "DELETE FROM repostajes 
				WHERE idrepostaje = '$idrepostaje' ";
		return consulta($sql);
	}

	public function mostrar($idrepostaje)
	{
		$sql = "SELECT * FROM repostajes WHERE idrepostaje = '$idrepostaje'";
		return consultaSimple($sql);
	}
	
	public function listar()
	{
		$sql = "SELECT r.*, v.matricula as vehiculo  
				FROM repostajes r 
				INNER JOIN vehiculos v ON r.fkvehiculo = v.idvehiculo ";
		return consulta($sql);
	}
	
}

 ?>