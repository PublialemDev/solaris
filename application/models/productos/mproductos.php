<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MProductos extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('logs/mlogs');
	}
	
	public function insertProducto($datos){
		$this->db->trans_begin();
		session_start();
		$sysdate=new DateTime();
		$returned = $this->db->insert('productos',
		array(
			'id_categoriaProducto'=> $datos['prod_cat'],
			'nombre_producto'=> $datos['prod_nombre'],
			'descripcion_producto'=> $datos['prod_desc'],
			'precio1'=> $datos['prod_precio_nor'],
			'precio2'=> $datos['prod_precio_adv'],
			'precio3'=> $datos['prod_precio_pre'],
			'estatus_producto'=> 'A',
			'creado_en'=>$sysdate->format('Y-m-d H:i:s'),
			'creado_por'=>base64_decode($_SESSION['USUARIO_ID'])
		));
		
		if($returned==1){
			$returned=$this->db->insert_id();			
			$this->mlogs->insertLog(array('tipo_log'=>'INSERT_PRODUCTOS','descripcion_log'=>'SE INSERTO PRODUCTO'.$returned));
		}
		
		if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback();
		}
		else
		{
		    $this->db->trans_commit();
		}
		return $returned;
	}
	/*
	 * Actualiza los productos
	 * */
	function updateProducto($prod_data_form){
		$this->db->trans_begin();
		session_start();
		$sysdate=new DateTime();
		$returned=0;
		$prod_data=array(
			'id_categoriaProducto'=> $prod_data_form['prod_cat'],
			'nombre_producto'=> $prod_data_form['prod_nombre'],
			'descripcion_producto'=> $prod_data_form['prod_desc'],
			'precio1'=> $prod_data_form['prod_precio_nor'],
			'precio2'=> $prod_data_form['prod_precio_adv'],
			'precio3'=> $prod_data_form['prod_precio_pre'],
			'estatus_producto'=> $prod_data_form['prod_estatus']==''?'A':$prod_data_form['prod_estatus'],
			'modificado_en' => $sysdate->format('Y-m-d H:i:s'),
			'modificado_por' => base64_decode($_SESSION['USUARIO_ID'])
		);
		$returned=$this->db->update('productos',$prod_data,array('id_producto'=>$prod_data_form['prod_id']));
		
		//insertar log para auditoria
		if($returned==1){
			$this->mlogs->insertLog(array('tipo_log'=>'update_productos','descripcion_log'=>'update del producto: '.$prod_data_form['prod_id']));
		}
		
		if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback();
		}
		else
		{
		    $this->db->trans_commit();
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
		
		if(isset($where_clause['prod_id'])){
			$this->db->where('id_producto',$where_clause['prod_id']);
		}
		if(isset($where_clause['prod_nombre'])){
			$this->db->like('nombre_producto',$where_clause['prod_nombre']);
		}
		if(isset($where_clause['prod_desc'])){
			$this->db->like('descripcion_producto',$where_clause['prod_desc']);
		}
		
		$this->db->select('productos.*,categoriaproductos.nombre_categoriaProducto as id_categoriaProducto');
		$this->db->from('productos');
		$this->db->join('categoriaproductos', 'productos.id_categoriaProducto = categoriaproductos.id_categoriaProducto');
		
		$query = $this->db->get();
		if($query->num_rows()>0){
			return $query;
		}
		else{
			return false;
		}
		
	}
	
	function selectProductoById($id_prod){
		$where_clause=array('id_producto'=>$id_prod);
		$query = $this->db->get_where('productos',$where_clause);
		if($query->num_rows()>0){
			return $query;
		}
		else{
			return false;
		}
	}
	
	function deleteProducto($prod_id){
		$this->db->trans_begin();
		session_start();
		$sysdate=new DateTime();
		
		$produ_data = array(
			'estatus_productos'=>'I',			
			'modificado_en' => $sysdate->format('Y-m-d H:i:s'),
			'modificado_por' => base64_decode($_SESSION['USUARIO_ID'])
		);
		$returned = $this->db->update('productos',$produ_data,array('id_producto'=>$prod_id));
			
		if($returned == 1){
			$proremi_estatus = array('estatus_productoRemision'=>'I',			
			'modificado_en' => $sysdate->format('Y-m-d H:i:s'),
			'modificado_por' => base64_decode($_SESSION['USUARIO_ID']));
			$returned = $this->db->update('productoremision',$proremi_estatus,array('id_producto'=>$prod_id));													
		}	
		if($returned>0){
			return true;
		}
		
		if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback();
		}
		else
		{
		    $this->db->trans_commit();
		}
		return false;
	}
	
}