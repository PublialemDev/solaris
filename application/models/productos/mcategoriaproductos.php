<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MCategoriaProductos extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('logs/mLogs');
	}

	public function insertCategoriaProductos($datos){
		$this->db->trans_begin();
		$returned = $this->db->insert('categoriaproductos',array('nombre_categoriaProducto'=> $datos['nombre'],
		'descripcion_categoriaProducto'=> $datos['descripcion'],
		'creado_en'=> $datos['creado_en'], 
		'creado_por'=> base64_decode($_SESSION['USUARIO_ID'])));
		
		if($returned==1){
			$returned=$this->db->insert_id();
			$this->mLogs->insertLog(array('tipo_log'=>'INSERT_CATEGORIAPRODUCTO','descripcion_log'=>'SE INSERTO CATEGORIA DE PRODUCTOS'.$returned));			
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
	
	
	function updateCategoriaProductos($catprodu_data_form){
		$this->db->trans_begin();		
		$sysdate = new DateTime();
		$catprodu_data = array('nombre_categoriaProducto'=> $catprodu_data_form['nombre'],
			'descripcion_categoriaProducto'=> $catprodu_data_form['descripcion'],
			'modificado_en' => $sysdate->format('Y-m-d H:i:s'),
			'modificado_por' => base64_decode($_SESSION['USUARIO_ID'])
		);
		$returned = $this->db->update('categoriaproductos',$catprodu_data,array('id_categoriaProducto'=>$catprodu_data_form['idCatProducto']));
		
		//insertar log para auditoria
		if($returned == 1){
			$this->mLogs->insertLog(array('tipo_log'=>'update_categoriaproducto','descripcion_log'=>'update de la categoria de producto: '.$catprodu_data_form['idCatProducto']));
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

	function deleteCategoriaProductos($catprodu_id){
		$this->db->trans_begin();
		$sysdate=new DateTime();
		
		
		$produ_data = array(
			'estatus_categoriaProducto'=>'I',			
			'modificado_en' => $sysdate->format('Y-m-d H:i:s'),
			'modificado_por' => base64_decode($_SESSION['USUARIO_ID'])
		);
		$returned = $this->db->update('categoriaproductos',$produ_data,array('id_categoriaProducto'=>$catprodu_id));
		
		$produ_estatus = array('estatus_producto'=>'I',			
			'modificado_en' => $sysdate->format('Y-m-d H:i:s'),
			'modificado_por' => base64_decode($_SESSION['USUARIO_ID']));
		$proremi_estatus = array('estatus_productoRemision'=>'I',			
			'modificado_en' => $sysdate->format('Y-m-d H:i:s'),
			'modificado_por' => base64_decode($_SESSION['USUARIO_ID']));
		
		if($returned == 1){
			
			$returned = $this->db->update('productos',$produ_estatus,array('id_categoriaProducto'=>$catprodu_id));
			
			if($returned == 1){
				$query = $this->db->query("SELECT id_producto FROM productos WHERE estatus_producto = 'I' ");
				
				foreach ($query->result() as $value) {
					$returned = $this->db->update('productoremision',$proremi_estatus,array('id_producto'=>$value->id_producto));
				}
												
			}	
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

	function selectCategoriaProductos($where_clause=array()){
		
		if(isset($where_clause['catprodu_id'])){
			$this->db->where('id_categoriaProducto',$where_clause['catprodu_id']);
		
		}
		if(isset($where_clause['catprodu_nombre'])){
			$this->db->like('nombre_categoriaProducto',$where_clause['catprodu_nombre']);

		}
		
		$this->db->where('estatus_categoriaProducto','A');
		$query = $this->db->get('categoriaproductos');
		if($query->num_rows()>0){
			return $query;
		}
		else{
			return false;
		}
	}
	
	function selectCategoriaProductosById($id_catprodu){
		$where_clause = array('id_categoriaProducto'=>$id_catprodu);
		$query = $this->db->get_where('categoriaproductos',$where_clause);
		
		if($query->num_rows()>0){
			return $query;
		}
		else{
			return false;
		}
	}

	
}
?>