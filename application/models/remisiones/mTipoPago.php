<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MTipoPago extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('logs/mLogs');
	}

	public function insertTipoPago($datos){
		session_start();
		$returned = $this->db->insert('tipoPagos',array('nombre_tipoPago'=> $datos['nombre'],
		'descripcion_tipoPago'=> $datos['descripcion'],
		'creado_en'=> $datos['creado_en'], 
		'creado_por'=> base64_decode($_SESSION['USUARIO_ID'])));
		
		if($returned==1){
			$returned=$this->db->insert_id();
			$this->mLogs->insertLog(array('tipo_log'=>'INSERT_TIPOPAGO','descripcion_log'=>'SE INSERTO TIPO DE PAGO: '.$returned));
		}
	}
	
	public function selectTipoPago(){
		$query = $this->db->query("SELECT * FROM tipoPagos");
		
		return $query;
	}
}
?>