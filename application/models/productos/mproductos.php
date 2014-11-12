<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MProductos extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('logs/mlogs');
	}
	
	public function insertProducto($datos){
		session_start();
		$sysdate=new DateTime();
		$returned = $this->db->insert('productos',
		array(
			'id_categoriaProducto'=> $datos['prod_cat'],
			'nombre_producto'=> $datos['prod_nombre'],
			'descripcion_producto'=> $datos['prod_desc'],
			'precio'=> $datos['prod_precio'],
			'proveedor'=> $datos['prod_proveedor'],
			'estatus_producto'=> $datos['prod_estatus'],
			'creado_en'=>$sysdate->format('Y-m-d H:i:s'),
			'creado_por'=>base64_decode($_SESSION['USUARIO_ID'])
		));
		
		if($returned==1){
			$returned=$this->db->insert_id();			
			$this->mlogs->insertLog(array('tipo_log'=>'INSERT_PRODUCTOS','descripcion_log'=>'SE INSERTO PRODUCTO'.$returned));
		}
		return $returned;
	}
	/*
	 * Actualiza los productos
	 * */
	function updateProducto($prod_data_form){
		session_start();
		$sysdate=new DateTime();
		$returned=0;
		$prod_data=array(
			'id_categoriaProducto'=> $prod_data_form['prod_cat'],
			'nombre_producto'=> $prod_data_form['prod_nombre'],
			'descripcion_producto'=> $prod_data_form['prod_desc'],
			'precio'=> $prod_data_form['prod_precio'],
			'proveedor'=> $prod_data_form['prod_proveedor'],
			'estatus_producto'=> $prod_data_form['prod_estatus'],
			'modificado_en' => $sysdate->format('Y-m-d H:i:s'),
			'modificado_por' => base64_decode($_SESSION['USUARIO_ID'])
		);
		$returned=$this->db->update('productos',$prod_data,array('id_producto'=>$prod_data_form['prod_id']));
		
		//insertar log para auditoria
		if($returned==1){
			$this->mlogs->insertLog(array('tipo_log'=>'update_productos','descripcion_log'=>'update del producto: '.$prod_data_form['prod_id']));
		}
		return $returned;
	}
	
	public function selectCategorias(){
		$query = $this->db->get('categoriaproductos');
		
		if($query->num_rows >0) 
			return $query;
		else {
			return false;
		}
	}
	
	public function selectProductos($where_clause){
		
		/*if(isset($where_clause['cli_id'])){
			$this->db->where('id_cliente',$where_clause['cli_id']);
		}
		if(isset($where_clause['cli_nombre'])){
			$this->db->like('nombre_cliente',$where_clause['cli_nombre']);
		}
		if(isset($where_clause['cli_rfc'])){
			$this->db->where('rfc',$where_clause['cli_rfc']);
		}*/
		
		$query = $this->db->get('productos');
		if($query->num_rows()>0){
			return $query;
		}
		else{
			return false;
		}
					
		/*$consulta = $this->db->query("SELECT productos.id_producto, productos.nombre_producto, 
		categoriaproductos.nombre_categoriaProducto, productos.descripcion_producto, productos.precio,	
		productos.proveedor, productos.estatus_producto, productos.creado_en, productos.creado_por, 
		productos.modificado_en, productos.modificado_por FROM productos JOIN categoriaproductos
		ON productos.id_categoriaProducto = categoriaproductos.id_categoriaProducto");
		
			
		return $consulta;*/
	}
	
}