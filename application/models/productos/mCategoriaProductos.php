<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MCategoriaProductos extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function insertCategoria($datos){
			$this->db->insert('categoriaproductos',array('nombre_categoriaProducto'=> $datos['nombre'],
			'descripcion_categoriaProducto'=> $datos['descripcion'],
			'creado_en'=> $datos['creado_en'], 
			'creado_por'=> $datos['creado_por'],));
		}
	
	public function selectCategorias(){
		$query = $this->db->query("SELECT * FROM categoriaproductos");
		
		return $query;
	}
}
?>