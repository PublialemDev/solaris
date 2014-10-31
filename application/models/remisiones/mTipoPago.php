<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MTipoPago extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function insertTipoPago($datos){
			$this->db->insert('tipoPagos',array('nombre_tipoPago'=> $datos['nombre'],
			'descripcion_tipoPago'=> $datos['descripcion'],
			'creado_en'=> $datos['creado_en'], 
			'creado_por'=> $datos['creado_por'],));
		}
	
	public function selectTipoPago(){
		$query = $this->db->query("SELECT * FROM tipoPagos");
		
		return $query;
	}
}
?>