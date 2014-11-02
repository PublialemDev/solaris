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
		'creado_por'=> $datos['creado_por'],));
		
		$this->mLogs->insertLog(array($_SESSION['USUARIO'],'INSERT_TIPOUSUARIO','SE INSERTO UN REGISTRO',$datos['creado_en']));
	}
	
	public function selectTipoUsuarios(){
		$query = $this->db->query("SELECT * FROM tipoUsuarios");
		
		return $query;
	}
}
?>