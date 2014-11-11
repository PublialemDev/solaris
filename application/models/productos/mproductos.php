<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MProductos extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('logs/mLogs');
	}
	
	public function insertProducto($datos){
		session_start();
		$returned = $this->db->insert('productos',array('id_categoriaProducto'=> $datos['categoria'],
		'nombre_producto'=> $datos['nombre'],'descripcion_producto'=> $datos['descripcion'],
		'precio'=> $datos['precio'],'proveedor'=> $datos['proveedor'],
		'estatus_producto'=> $datos['estatus'],'creado_en'=> $datos['creado_en'],
		'creado_por'=>base64_decode($_SESSION['USUARIO_ID'])));
		
		if($returned==1){
			$returned=$this->db->insert_id();			
			$this->mLogs->insertLog(array('tipo_log'=>'INSERT_PRODUCTOS','descripcion_log'=>'SE INSERTO PRODUCTO'.$returned));
		}
	}
	
	public function selectCategorias(){
		$query = $this->db->get('categoriaproductos');
		
		if($query->num_rows >0) 
			return $query;
		else {
			return false;
		}
	}
	
	public function selectProductos(){			
		$consulta = $this->db->query("SELECT productos.id_producto, productos.nombre_producto, 
		categoriaproductos.nombre_categoriaProducto, productos.descripcion_producto, productos.precio,	
		productos.proveedor, productos.estatus_producto, productos.creado_en, productos.creado_por, 
		productos.modificado_en, productos.modificado_por FROM productos JOIN categoriaproductos
		ON productos.id_categoriaProducto = categoriaproductos.id_categoriaProducto");
		
			
		return $consulta;
	}
	
}