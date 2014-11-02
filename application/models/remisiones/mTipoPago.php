<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MTipoPago extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('logs/mLogs');
	}

	public function insertTipoPago($datos){
		session_start();
		$this->db->insert('tipoPagos',array('nombre_tipoPago'=> $datos['nombre'],
		'descripcion_tipoPago'=> $datos['descripcion'],
		'creado_en'=> $datos['creado_en'], 
		'creado_por'=> $datos['creado_por'],));
		
		$this->mLogs->insertLog(array($_SESSION['USUARIO'],'INSERT_TIPOPAGO','SE INSERTO UN REGISTRO',$datos['creado_en']));
	}
	
	public function selectTipoPago(){
		$query = $this->db->query("SELECT * FROM tipoPagos");
		
		return $query;
	}
}
?>