<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MTipoUsuarios extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function insertTipoUsuario($datos){
			$this->db->insert('tipoUsuarios',array('nombre_tipoUsuario'=> $datos['nombre'],
			'descripcion_tipoUsuario'=> $datos['descripcion'],
			'creado_en'=> $datos['creado_en'], 
			'creado_por'=> $datos['creado_por'],));
		}
	
	public function selectTipoUsuarios(){
		$query = $this->db->query("SELECT * FROM tipoUsuarios");
		
		return $query;
	}
}
?>