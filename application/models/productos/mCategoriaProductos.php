<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MCategoriaProductos extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('logs/mLogs');
	}

	public function insertCategoria($datos){
		session_start();
		$this->db->insert('categoriaproductos',array('nombre_categoriaProducto'=> $datos['nombre'],
		'descripcion_categoriaProducto'=> $datos['descripcion'],
		'creado_en'=> $datos['creado_en'], 
		'creado_por'=> $_SESSION['USUARIO']));
		
		$this->mLogs->insertLog(array($_SESSION['USUARIO'],'INSERT_CATEGORIAPRODUCTO','SE INSERTO UN REGISTRO',$datos['creado_en']));
	}
	
	public function selectCategorias(){
		$query = $this->db->query("SELECT * FROM categoriaproductos");
		
		return $query;
	}
}
?>