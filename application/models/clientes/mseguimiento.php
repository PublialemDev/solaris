<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MSeguimiento extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('logs/mLogs');
	}

	public function insertSeguimiento($datos){
		session_start();
		$returned = $this->db->insert('seguimientoclientes',array(
		'id_cliente'=> $datos['id_cliente'],
		'id_categoriaSeguimiento'=> $datos['id_catseguimiento'],
		'comentario'=> $datos['comentario'],
		'fecha'=> $datos['fecha'],
		'creado_en'=> $datos['creado_en'], 
		'creado_por'=> base64_decode($_SESSION['USUARIO_ID'])));
		
		if($returned==1){
			$returned=$this->db->insert_id();
			$this->mLogs->insertLog(array('tipo_log'=>'INSERT_SEGUIMIENTO','descripcion_log'=>'SE INSERTO UN SEGUIMIENTO'.$returned));			
		}
		
		return $returned;
	}
	
	
	function updateSeguimiento($segui_data_form){		
		session_start();
		$sysdate = new DateTime();
		$segui_data = array(
		'id_cliente'=> $segui_data_form['id_cliente'],
		'id_categoriaSeguimiento'=> $segui_data_form['id_catseguimiento'],
		'comentario'=> $segui_data_form['comentario'],
		'fecha'=> $segui_data_form['fecha'],
		'modificado_en' => $sysdate->format('Y-m-d H:i:s'),
		'modificado_por' => base64_decode($_SESSION['USUARIO_ID'])
		);
		$returned = $this->db->update('seguimientoclientes',$segui_data,array('id_seguimientoCliente'=>$segui_data_form['idSeguimiento']));
		
		//insertar log para auditoria
		if($returned == 1){
			$this->mLogs->insertLog(array('tipo_log'=>'update_seguimiento','descripcion_log'=>'update del seguimiento: '.$segui_data_form['idSeguimiento']));
		}
		
		return $returned;
	}

	function deleteSeguimiento($segui_id){
		$sysdate=new DateTime();
		
		$returned=$this->db->delete('seguimientoclientes',array('id_seguimientoCliente'=>$segui_id));
		return $returned;
	}

	function selectSeguimiento($where_clause){
		if(isset($where_clause['segui_id'])){
			$this->db->where('seguimientoclientes.id_seguimientoCliente',$where_clause['segui_id']);
		}
		if(isset($where_clause['segui_nombre'])){
			$this->db->like('seguimientoclientes.nombre_seguimientoCliente',$where_clause['segui_nombre']);
		}
		if(isset($where_clause['segui_cliente'])){
			$this->db->like('clientes.nombre_cliente',$where_clause['segui_cliente']);
		}
		if(isset($where_clause['segui_categoria'])){
			$this->db->like('categoriaseguimientoclientes.nombre_categoriaSeguimiento',$where_clause['segui_categoria']);
		}
		
		$this->db->select('seguimientoclientes.id_seguimientoCliente, seguimientoclientes.nombre_seguimientoCliente,
		clientes.nombre_cliente, categoriaseguimientoclientes.nombre_categoriaSeguimiento');
		$this->db->from('seguimientoclientes');
		$this->db->join('clientes','seguimientoclientes.id_cliente= clientes.id_cliente');
		$this->db->join('categoriaseguimientoclientes','seguimientoclientes.id_categoriaSeguimiento = categoriaseguimientoclientes.id_categoriaSeguimiento');
		$query = $this->db->get();
		if($query->num_rows()>0){
			return $query;
		}
		else{
			return false;
		}
	}
	
	function selectSeguimientoById($id_segui){
		$where_clause = array('id_seguimientoCliente'=>$id_segui);
		$query = $this->db->get_where('seguimientoclientes',$where_clause);
		
		if($query->num_rows()>0){
			return $query;
		}
		else{
			return false;
		}
	}
	
	public function selectCatSeguimiento(){
		$query = $this->db->get('categoriaseguimientoclientes');
		
		if($query->num_rows >0) 
			return $query;
		else {
			return false;
		}
	}

	
}
?>