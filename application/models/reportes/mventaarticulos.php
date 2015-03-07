<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MVentaArticulos extends CI_Model {
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function getValues($mes,$anio,$categoria){
		$query = $this->db->query('SELECT remisiones.id_remision, productos.id_producto, nombre_sucursal, instalacion, cantidad, nivel_cliente FROM remisiones 
									JOIN sucursales ON sucursales.id_sucursal = remisiones.id_sucursal
									JOIN productoremision ON productoremision.id_remision =  remisiones.id_remision
									JOIN productos ON productos.id_producto =  productoremision.id_producto
									WHERE  date_format(fecha,\'%M\') = "'.$mes.'" AND date_format(fecha,\'%Y\') = '.$anio.'
									AND productos.id_categoriaProducto = '.$categoria.' order by sucursales.nombre_sucursal, instalacion, nivel_cliente');

		if($query->num_rows()>0){
			return $query;
		}
		else{
			return false;
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
	
	public function selectNombreCategoria($idCategoria){
		$query = $this->db->query('SELECT nombre_categoriaProducto FROM categoriaproductos WHERE id_categoriaProducto ='.$idCategoria);
		
		if($query->num_rows >0) 
			return $query;
		else {
			return false;
		}
	}
}

?>