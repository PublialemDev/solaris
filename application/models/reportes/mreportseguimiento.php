<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MReportSeguimiento extends CI_Model {
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function getValues($id_cliente){
		$query = $this->db->query('SELECT clientes.nombre_cliente, seguimientoclientes.comentario,seguimientoclientes.fecha,
									categoriaseguimientoclientes.nombre_categoriaSeguimiento FROM clientes 
									JOIN seguimientoclientes ON clientes.id_cliente = seguimientoclientes.id_cliente
									JOIN categoriaseguimientoclientes ON seguimientoclientes.id_categoriaSeguimiento = categoriaseguimientoclientes.id_categoriaSeguimiento
									WHERE clientes.id_cliente ='.$id_cliente.';');

		if($query->num_rows()>0){
			return $query;
			
		}
		else{
			return false;
		}
	}
}

?>