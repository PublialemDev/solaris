<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MRemisionNote extends CI_Model {
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function getValues($id_remision,$idUsuario){
		$query = $this->db->query('SELECT clientes.nombre_cliente,direcciones.calle,direcciones.numero_ext,direcciones.numero_int,
									direcciones.municipio,estados.nombre_estado,sucursales.nombre_sucursal,usuarios.nombre_usuario,
									remisiones.fecha,remisiones.iva,remisiones.total,productoremision.descuento,productoremision.cantidad,
									productoremision.precio_actual,productos.nombre_producto,tipopagos.nombre_tipoPago,
									(productoremision.cantidad * productoremision.precio_actual) as importe, 
									SUM(productoremision.cantidad*productoremision.precio_actual) as subtotal,
									ROUND(SUM(productoremision.cantidad*productoremision.precio_actual)*(remisiones.iva/100)+sum(productoremision.cantidad*productoremision.precio_actual),2) as totalf 
									FROM remisiones
									JOIN productoremision ON remisiones.id_remision = productoremision.id_remision
									JOIN productos ON productoremision.id_producto = productos.id_producto
									JOIN tipopagos ON remisiones.id_tipoPago = tipopagos.id_tipoPago
									JOIN sucursales ON remisiones.id_sucursal = sucursales.id_sucursal
									JOIN usuarios ON remisiones.creado_por = usuarios.id_usuario
									JOIN clientes ON remisiones.id_cliente = clientes.id_cliente
									JOIN direcciones ON clientes.id_cliente = direcciones.id_perfil
									JOIN estados ON direcciones.id_estado = estados.id_estado
									WHERE remisiones.id_remision ='.$id_remision.' AND direcciones.perfil_tipo = \'cli\' '
									//AND usuarios.id_usuario = '.$idUsuario
									);

		if($query->num_rows()>0){
			return $query;
		}
		else{
			return false;
		}
	}
}

?>