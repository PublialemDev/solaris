<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MCategoriaSeguimiento extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('logs/mLogs');
	}

	public function insertCategoriaSeguimiento($datos){

		$returned = $this->db->insert('categoriaseguimientoclientes',array('nombre_categoriaSeguimiento'=> $datos['nombre'],
		'descripcion_categoriaSeguimiento'=> $datos['descripcion'],
		'creado_en'=> $datos['creado_en'], 
		'creado_por'=> base64_decode($_SESSION['USUARIO_ID'])));
		
		if($returned==1){
			$returned=$this->db->insert_id();
			$this->mLogs->insertLog(array('tipo_log'=>'INSERT_CATEGORIASEGUIMIENTO','descripcion_log'=>'SE INSERTO CATEGORIA DE SEGUIMIENTO'.$returned));			
		}
		
		return $returned;
	}
	
	
	function updateCategoriaSeguimiento($segui_data_form){		

		$sysdate = new DateTime();
		$segui_data = array('nombre_categoriaSeguimiento'=> $segui_data_form['nombre'],
			'descripcion_categoriaSeguimiento'=> $segui_data_form['descripcion'],
			'modificado_en' => $sysdate->format('Y-m-d H:i:s'),
			'modificado_por' => base64_decode($_SESSION['USUARIO_ID'])
		);
		$returned = $this->db->update('categoriaseguimientoclientes',$segui_data,array('id_categoriaSeguimiento'=>$segui_data_form['idCatSeguimiento']));
		
		//insertar log para auditoria
		if($returned == 1){
			$this->mLogs->insertLog(array('tipo_log'=>'update_seguimiento','descripcion_log'=>'update de la categoria de seguimiento: '.$segui_data_form['idCatSeguimiento']));
		}
		
		return $returned;
	}

	function deleteCategoriaSeguimiento($catsegui_id){
		$sysdate=new DateTime();
		
		$returned=$this->db->delete('categoriaseguimientoclientes',array('id_categoriaSeguimiento'=>$catsegui_id));
		return $returned;
	}

	function selectCategoriaSeguimiento($where_clause){
		
		if(isset($where_clause['catseguimiento_id'])){
			$this->db->where('id_categoriaSeguimiento',$where_clause['catseguimiento_id']);
		}
		if(isset($where_clause['catseguimiento_nombre'])){
			$this->db->like('nombre_categoriaSeguimiento',$where_clause['catseguimiento_nombre']);
		}
		$query = $this->db->get('categoriaseguimientoclientes');
		if($query->num_rows()>0){
			return $query;
		}
		else{
			return false;
		}
	}
	
	function selectCategoriaSeguimientoById($id_segui){
		$where_clause = array('id_categoriaSeguimiento'=>$id_segui);
		$query = $this->db->get_where('categoriaseguimientoclientes',$where_clause);
		
		if($query->num_rows()>0){
			return $query;
		}
		else{
			return false;
		}
	}

	
}
?>