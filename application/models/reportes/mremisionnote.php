<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MRemisionNote extends CI_Model {
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function getValues($id_remision){
		$query = $this->db->query('select clientes.nombre_cliente,direcciones.calle,direcciones.numero_ext,direcciones.numero_int,
									direcciones.municipio,estados.nombre_estado,sucursales.nombre_sucursal,usuarios.nombre_usuario,
									remisiones.fecha,remisiones.iva,remisiones.total,productoremision.descuento,productoremision.cantidad,
									productoremision.precio_actual,productos.nombre_producto,tipopagos.nombre_tipoPago,
									(productoremision.cantidad * productoremision.precio_actual) as importe, 
									sum(productoremision.cantidad*productoremision.precio_actual) as subtotal FROM remisiones
									JOIN productoremision ON remisiones.id_remision = productoremision.id_remision
									JOIN productos ON productoremision.id_producto = productos.id_producto
									JOIN tipopagos ON remisiones.id_tipoPago = tipopagos.id_tipoPago
									JOIN sucursales ON remisiones.id_sucursal = sucursales.id_sucursal
									JOIN usuarios ON sucursales.id_sucursal = usuarios.id_sucursal
									JOIN clientes ON remisiones.id_cliente = clientes.id_cliente
									JOIN direcciones ON clientes.id_cliente = direcciones.id_perfil
									JOIN estados ON direcciones.id_estado = estados.id_estado
									WHERE remisiones.id_remision ='.$id_remision.' AND direcciones.perfil_tipo = \'cli\';');

		if($query->num_rows()>0){
			return $query;
		}
		else{
			return false;
		}
	}
}

?>