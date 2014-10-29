<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MProductos extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function insertarProducto($datos){
		$this->db->insert('productos',array('id_categoriaProducto'=> $datos['categoria'],
		'nombre_producto'=> $datos['nombre'],'descripcion_producto'=> $datos['descripcion'],
		'precio'=> $datos['precio'],'proveedor'=> $datos['proveedor'],
		'estatus_producto'=> $datos['estatus'],'creado_en'=> $datos['creado_en'],
		'creado_por'=> $datos['creado_por'],));
	}
	
	public function consultarCategoria(){
		$query = $this->db->get('categoriaproductos');
		
		if($query->num_rows >0) 
			return $query;
		else {
			return false;
		}
	}
	
	public function consultarProductos(){			
		$consulta = $this->db->query("SELECT productos.id_producto, productos.nombre_producto, 
		categoriaproductos.nombre_categoriaProducto, productos.descripcion_producto, productos.precio,	
		productos.proveedor, productos.estatus_producto, productos.creado_en, productos.creado_por, 
		productos.modificado_en, productos.modificado_por FROM productos JOIN categoriaproductos
		ON productos.id_categoriaProducto = categoriaproductos.id_categoriaProducto");
		
			
		return $consulta;
	}
	
}