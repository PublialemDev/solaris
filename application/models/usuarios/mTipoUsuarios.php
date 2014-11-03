<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MTipoUsuarios extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('logs/mLogs');
	}

	public function insertTipoUsuario($datos){
		session_start();
		$this->db->insert('tipoUsuarios',array('nombre_tipoUsuario'=> $datos['nombre'],
		'descripcion_tipoUsuario'=> $datos['descripcion'],
		'creado_en'=> $datos['creado_en'], 
		'creado_por'=> base64_decode($_SESSION['USUARIO_ID'])));
		
		if($returned==1){
			$returned=$this->db->insert_id();
			$this->mLogs->insertLog(array('tipo_log'=>'INSERT_TIPOUSUARIOS','descripcion_log'=>'SE INSERTO TIPO DE USUARIO: '.$returned));
		}
	}
	
	public function selectTipoUsuarios(){
		$query = $this->db->query("SELECT * FROM tipoUsuarios");
		
		return $query;
	}
}
?>