<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class MUsuarios extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model("mdeletedata");
	}
	function insertUsuarios($datosUsuarios){
		$this->db->trans_begin();
		$sysdate=new DateTime();
		$returned=$this->db->insert('usuarios',
		array(			
			'id_tipousuario' => $datosUsuarios['id_tipousuario'],
			'id_sucursal' => $datosUsuarios['id_sucursal'],
			'nombre_usuario' => $datosUsuarios['nombre'],
			'contraseña' => $datosUsuarios['password'],						
			'creado_en' => $sysdate->format('Y-m-d H:i:s'),
			'creado_por' => base64_decode($_SESSION['USUARIO_ID']))
		);
		//insertar log para auditoria
		if($returned==1){
			$returned=$this->db->insert_id();
			$this->mlogs->insertLog(array('tipo_log'=>'insert_usuario','descripcion_log'=>'alta del Usuario: '.$returned));
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
	
	function updateUsuarios($usr_data_form){
		$this->db->trans_begin();
		$sysdate=new DateTime();
		$returned=0;
		$usr_data=array(			
			'id_tipousuario' => $usr_data_form['id_tipousuario'],
			'id_sucursal' => $usr_data_form['id_sucursal'],
			'nombre_usuario' => $usr_data_form['nombre'],
			//'estatus_usuario' => $usr_data_form['estatus'],
			'modificado_en' => $sysdate->format('Y-m-d H:i:s'),
			'modificado_por' => base64_decode($_SESSION['USUARIO_ID'])
		);
		if(isset($usr_data_form['password']) && $usr_data_form['password']!=''){
			$usr_data['contraseña'] = $usr_data_form['password'];	
		}
		
		$returned=$this->db->update('usuarios',$usr_data,array('id_usuario'=>$usr_data_form['usr_id']));
		
		//insertar log para auditoria
		if($returned==1){
			$this->mlogs->insertLog(array('tipo_log'=>'update_usuarios','descripcion_log'=>'update del usuarios: '.$usr_data_form['usr_id']));
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

	function deleteUsuarios($usr_id){
		$this->db->trans_begin();
		$sysdate=new DateTime();
		
		//$returned=$this->db->delete('usuarios',array('id_usuario'=>$usr_id));
		
		$usr_data = array(
			'estatus_usuario'=>'I',			
			'modificado_en' => $sysdate->format('Y-m-d H:i:s'),
			'modificado_por' => base64_decode($_SESSION['USUARIO_ID'])
		);
		$returned = $this->db->update('usuarios',$usr_data,array('id_usuario'=>$usr_id));		
		if($returned > 0){
			$returned = $this->mdeletedata->deletedata($usr_id, 'usr');
		}
		
		
		if($returned>0){
			return true;;
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
	

	function selectUsuarios($where_clause){
		
		if(isset($where_clause['usr_id'])){
			$this->db->where('usuarios.id_usuario',$where_clause['usr_id']);
		}
		if(isset($where_clause['usr_nombre'])){
			$this->db->like('usuarios.nombre_usuario',$where_clause['usr_nombre']);
		}
		if(isset($where_clause['usr_tipousuario'])){
			$this->db->like('tipousuarios.nombre_tipousuario',$where_clause['usr_tipousuario']);
		}
		
		$this->db->select('usuarios.id_usuario,usuarios.nombre_usuario,tipousuarios.nombre_tipousuario');
		$this->db->from('usuarios');
		$this->db->join('tipousuarios','usuarios.id_tipousuario = tipousuarios.id_tipousuario');
		$this->db->where('estatus_usuario','A');
		$query = $this->db->get();
		if($query->num_rows()>0){
			return $query;
		}
		else{
			return false;
		}
	}
	
	function selectUsuariosById($id_usr){
		$where_clause=array('id_usuario'=>$id_usr);
		$query = $this->db->get_where('usuarios',$where_clause);
		if($query->num_rows()>0){
			return $query;
		}
		else{
			return false;
		}
	}

	public function selectSucursales(){
		$this->db->where('estatus_sucursal','A');
		$query = $this->db->get('sucursales');
		if($query->num_rows()>0){
			return $query;
		}
		else{
			return false;
		}
		/*$query = $this->db->get('sucursales',array('estatus_sucursal'=>'A'));
		
		if($query->num_rows >0) 
			return $query;
		else {
			return false;
		}*/
	}
	
	public function selectTipoUsuarios(){
		
		$this->db->where('estatus_tipoUsuario','A');
		$query = $this->db->get('tipousuarios');
		if($query->num_rows()>0){
			return $query;
		}
		else{
			return false;
		}
	}

function selectClienteByName($cli_nombre){
		$where_clause=array('nombre_usuario'=>strtoupper($cli_nombre));
		$query = $this->db->get_where('usuarios',$where_clause);
		if($query->num_rows()>0){
			return $query;
		}
		else{
			return false;
		}
	}
	
}
?>



	