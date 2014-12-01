<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MMensual extends CI_Model {
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function getValues($mes_ini, $mes_fin){
		$query = $this->db->query('select clientes.nombre_cliente,sucursales.nombre_sucursal,usuarios.nombre_usuario,
									remisiones.fecha,productoremision.cantidad,
									productoremision.precio_actual,productos.nombre_producto,
									(productoremision.cantidad*productoremision.precio_actual) as importe FROM remisiones
									JOIN productoremision ON remisiones.id_remision = productoremision.id_remision
									JOIN productos ON productoremision.id_producto = productos.id_producto
									JOIN tipopagos ON remisiones.id_tipoPago = tipopagos.id_tipoPago
									JOIN sucursales ON remisiones.id_sucursal = sucursales.id_sucursal
									JOIN usuarios ON sucursales.id_sucursal = usuarios.id_sucursal
									JOIN clientes ON remisiones.id_cliente = clientes.id_cliente
									WHERE remisiones.fecha BETWEEN "'.$mes_ini.'" AND "'.$mes_fin.'" ;');

		if($query->num_rows()>0){
			return $query;
		}
		else{
			return false;
		}
	}
}

?>