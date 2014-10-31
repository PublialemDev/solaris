<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MCategoriaSeguimiento extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function insertCategoriaSeguimiento($datos){
			$this->db->insert('categoriaseguimientoclientes',array('nombre_categoriaSeguimiento'=> $datos['nombre'],
			'descripcion_categoriaSeguimiento'=> $datos['descripcion'],
			'creado_en'=> $datos['creado_en'], 
			'creado_por'=> $datos['creado_por'],));
		}
	
	public function selectCategoriaSeguimiento(){
		$query = $this->db->query("SELECT * FROM categoriaseguimientoclientes");
		
		return $query;
	}
}
?>