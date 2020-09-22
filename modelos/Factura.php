<?php 

require_once "../config/conexion.php";

Class Factura
{
	public function __construct()
	{

	}

	public function insertar($fecha, $tipo_factura, $serie, $numero_factura, $impuesto, $retencion, $total_factura, $idcliente, $idusuario, $idservicio, $cantidad, $precio,$descuento)
	{
		$sql = "INSERT INTO facturas (fecha, tipo_factura, serie, numero_factura, impuesto, retencion, total_factura, fkcliente, fkempresa, fkusuario, estado) 
				VALUES ('$fecha', '$tipo_factura', '$serie', '$numero_factura', '$impuesto', '$retencion', '$total_factura', '$idcliente', '1', '$idusuario', 'Aceptado')";
		echo $sql;

		$idfactura_new = consulta_retornarID($sql);

		$num_servicios = 0;
		$status = true;

		while ($num_servicios < count($idservicio)) 
		{
			$sql_detalle = "INSERT INTO detalle_servicios (cantidad,precio,descuento,fkfactura,fkservicio) 
							VALUES ('$cantidad[$num_servicios]','$precio[$num_servicios]','$descuento[$num_servicios]','$idfactura_new','$idservicio[$num_servicios]')";

			consulta($sql_detalle) ? $status : $status = false;
			$num_servicios ++;

		}
		return $status;

	}

	public function numeracion_factura()
	{
		$sql = "SELECT *
				FROM facturas 
				ORDER BY fecha DESC LIMIT 1";
		return consultaSimple($sql);
	}

	public function anular($idfactura)
	{
		$sql = "UPDATE factura 
				SET estado = 'Anulado'
				WHERE idfactura = '$idfactura' ";
		return consulta($sql);
	}
	public function abonar($idfactura)
	{
		$sql = "UPDATE factura 
				SET estado = 'Abonado'
				WHERE idfactura = '$idfactura' ";
		return consulta($sql);
	}

	public function mostrar($idfactura)
	{
		$sql = "SELECT f.idfactura, DATE(f.fecha) AS fecha, f.fkcliente, p.nombre as cliente, f.fkusuario, u.nombre usuario, f.tipo_factura, f.serie, f.numero_factura, f.total_factura, f.impuesto, f.retencion, f.estado 
		FROM facturas f INNER JOIN personas p ON f.fkcliente = p.idpersona 
		INNER JOIN usuarios u ON f.fkusuario =  u.idusuario 
		WHERE f.idfactura = '$idfactura'";
		return consultaSimple($sql);
	}

	public function listarDetalle($idfactura)
	{
		$sql = "SELECT ds.fkfactura, ds.fkservicio, s.nombre as nombre, ds.cantidad, ds.precio, ds.descuento, FORMAT((ds.cantidad * (ds.precio - (ds.precio * ds.descuento) / 100)),2) as subtotal
				FROM detalle_servicios ds INNER JOIN servicios s ON ds.fkservicio = s.idservicio 
				WHERE ds.fkfactura = '$idfactura'";
				//echo $sql;
				return consulta($sql);
	}
	
	public function listar()
	{
		$sql = "SELECT f.idfactura, DATE(f.fecha) as fecha, f.fkcliente, p.nombre as cliente, f.fkusuario, u.nombre as usuario, f.tipo_factura, f.serie, f.numero_factura, f.total_factura, f.impuesto, f.retencion, f.estado 
		FROM facturas f INNER JOIN personas p ON f.fkcliente = p.idpersona 
		INNER JOIN usuarios u ON f.fkusuario =  u.idusuario 
		ORDER BY f.idfactura desc";
		return consulta($sql);
	}
	public function facturasscabecera($idfactura)
	{
		$sql = "SELECT f.idfactura, f.idcliente, p.nombre as cliente, p.direccion, p.tipo_documento, p.num_documento, p.email, p.telefono, f.idusuario, u.nombre as usuario, 
			f.tipo_comprobante, f.serie_comprobante, f.num_comprobante, DATE(f.fecha) as fecha, f.impuesto, f.total_facturas 
			FROM facturas v INNER JOIN persona p ON f.idcliente = p.idpersona 
			INNER JOIN usuario u ON f.idusuario =  u.idusuario 
			WHERE f.idfactura = '$idfactura'";
		return consulta($sql);
	}

	public function facturasdetalle($idfactura)
	{
		$sql = "SELECT ds.idfactura, a.nombre as articulo, a.codigo, ds.cantidad, ds.precio_facturas, ds.descuento, 
				(ds.cantidad*(ds.precio_facturas-(ds.precio_facturas*ds.descuento)/100)) as subtotal
			FROM detalle_servicios ds INNER JOIN servicios s ON ds.idarticulo = s.idservicio 
			WHERE ds.idfactura ='$idfactura'";
		return consulta($sql);
	}
	
}

 ?>