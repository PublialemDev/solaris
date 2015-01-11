<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MTipoUsuarios extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('logs/mLogs');
		$this->load->model('mdeletedata');
	}

	public function insertTipoUsuarios($datos){
		$this->db->trans_begin();
		$returned = $this->db->insert('tipousuarios',array('nombre_tipoUsuario'=> $datos['nombre'],
		'descripcion_tipoUsuario'=> $datos['descripcion'],
		'creado_en'=> $datos['creado_en'], 
		'creado_por'=> base64_decode($_SESSION['USUARIO_ID'])));
		
		if($returned==1){
			$returned=$this->db->insert_id();
			$this->mLogs->insertLog(array('tipo_log'=>'INSERT_TIPOUSUARIO','descripcion_log'=>'SE INSERTO TIPO DE USUARIO'.$returned));			
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
	
	
	function updateTipoUsuarios($tipousuarios_data_form){
		$this->db->trans_begin();		
		$sysdate = new DateTime();
		$tipousuarios_data = array('nombre_tipoUsuario'=> $tipousuarios_data_form['nombre'],
			'descripcion_tipoUsuario'=> $tipousuarios_data_form['descripcion'],
			'modificado_en' => $sysdate->format('Y-m-d H:i:s'),
			'modificado_por' => base64_decode($_SESSION['USUARIO_ID'])
		);
		$returned = $this->db->update('tipousuarios',$tipousuarios_data,array('id_tipoUsuario'=>$tipousuarios_data_form['idTipoUsuario']));
		
		//insertar log para auditoria
		if($returned == 1){
			$this->mLogs->insertLog(array('tipo_log'=>'UPDATE_TIPOUSUARIOS','descripcion_log'=>'update del tipo de usuario: '.$tipousuarios_data_form['idTipoUsuario']));
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

	function deleteTipoUsuarios($tipousuarios_id){
		$this->db->trans_begin();
		$sysdate=new DateTime();				
		
		$tipousr_data = array(
			'estatus_tipoUsuario'=>'I',			
			'modificado_en' => $sysdate->format('Y-m-d H:i:s'),
			'modificado_por' => base64_decode($_SESSION['USUARIO_ID'])
		);
		$returned = $this->db->update('tipousuarios',$tipousr_data,array('id_tipoUsuario'=>$tipousuarios_id));

		if($returned > 0){
			$returned = $this->mdeletedata->deleteUser($tipousuarios_id);
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

function selectTipoUsuarios($where_clause){
		
		if(isset($where_clause['tipousuarios_id'])){
			$this->db->where('id_tipoUsuario',$where_clause['tipousuarios_id']);
		}
		if(isset($where_clause['tipousuarios_nombre'])){
			$this->db->like('nombre_tipoUsuario',$where_clause['tipousuarios_nombre']);
		}

		$this->db->where('estatus_tipoUsuario','A');
		$query = $this->db->get('tipousuarios');
		if($query->num_rows()>0){
			return $query;
		}
		else{
			return false;
		}
	}
	
	function selectTipoUsuariosById($id_tipousuario){
		$where_clause = array('id_tipoUsuario'=>$id_tipousuario);
		$query = $this->db->get_where('tipousuarios',$where_clause);
		
		if($query->num_rows()>0){
			return $query;
		}
		else{
			return false;
		}
	}

	
}
?>