<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MMensual extends CI_Model {
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function getValues($mes_ini, $mes_fin){
		$query = $this->db->query('select clientes.nombre_cliente,sucursales.nombre_sucursal,usuarios.nombre_usuario,
									remisiones.fecha,remisiones.total, remisiones.id_remision
									FROM remisiones																											
									JOIN sucursales ON remisiones.id_sucursal = sucursales.id_sucursal
									JOIN usuarios ON remisiones.creado_por = usuarios.id_usuario
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