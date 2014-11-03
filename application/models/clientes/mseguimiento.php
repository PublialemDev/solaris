<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MSeguimiento extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('logs/mLogs');
	}

	public function insertSeguimiento($datos){
		session_start();
		$returned = $this->db->insert('categoriaseguimientoclientes',array('nombre_categoriaSeguimiento'=> $datos['nombre'],
		'descripcion_categoriaSeguimiento'=> $datos['descripcion'],
		'creado_en'=> $datos['creado_en'], 
		'creado_por'=> base64_decode($_SESSION['USUARIO_ID'])));
		
		if($returned==1){
			$returned=$this->db->insert_id();
			$this->mLogs->insertLog(array('tipo_log'=>'INSERT_CATEGORIASEGUIMIENTO','descripcion_log'=>'SE INSERTO CATEGORIA'.$returned));			
		}
		
	}
	
	public function selectSeguimiento(){
		$query = $this->db->query("SELECT * FROM categoriaseguimientoclientes");
		
		return $query;
	}
	
}
?>