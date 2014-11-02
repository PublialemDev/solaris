<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MCategoriaSeguimiento extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('logs/mLogs');
	}

	public function insertCategoriaSeguimiento($datos){
		session_start();
		$this->db->insert('categoriaseguimientoclientes',array('nombre_categoriaSeguimiento'=> $datos['nombre'],
		'descripcion_categoriaSeguimiento'=> $datos['descripcion'],
		'creado_en'=> $datos['creado_en'], 
		'creado_por'=> $_SESSION['USUARIO']));
		
		$this->mLogs->insertLog(array('tipo_log'=>'INSERT_CATEGORIASEGUIMIENTO','descripcion_log'=>'SE INSERTO UN REGISTRO'));
	}
	
	public function selectCategoriaSeguimiento(){
		$query = $this->db->query("SELECT * FROM categoriaseguimientoclientes");
		
		return $query;
	}
	
}
?>