<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class MUsuarios extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	function insertUsuarios($datosUsuarios){
		session_start();
		$sysdate=new DateTime();
		$returned=$this->db->insert('usuarios',
		array(			
			'id_tipousuario' => $datosUsuarios['id_tipousuario'],
			'id_sucursal' => $datosUsuarios['id_sucursal'],
			'nombre_usuario' => $datosUsuarios['nombre'],
			'contraseña' => $datosUsuarios['password'],
			'estatus_usuario' => $datosUsuarios['estatus'],						
			'creado_en' => $sysdate->format('Y-m-d H:i:s'),
			'creado_por' => base64_decode($_SESSION['USUARIO_ID']))
		);
		//insertar log para auditoria
		if($returned==1){
			$returned=$this->db->insert_id();
			$this->mlogs->insertLog(array('tipo_log'=>'insert_usuario','descripcion_log'=>'alta del Usuario: '.$returned));
		}
		return $returned;
	}
	
	function updateUsuarios($usr_data_form){
		session_start();
		$sysdate=new DateTime();
		$returned=0;
		$usr_data=array(			
			'id_tipousuario' => $usr_data_form['id_tipousuario'],
			'id_sucursal' => $usr_data_form['id_sucursal'],
			'nombre_usuario' => $usr_data_form['nombre'],
			'contraseña' => $usr_data_form['password'],	
			'estatus_usuario' => $usr_data_form['estatus'],
			'modificado_en' => $sysdate->format('Y-m-d H:i:s'),
			'modificado_por' => base64_decode($_SESSION['USUARIO_ID'])
		);
		$returned=$this->db->update('usuarios',$usr_data,array('id_usuario'=>$usr_data_form['usr_id']));
		
		//insertar log para auditoria
		if($returned==1){
			$this->mlogs->insertLog(array('tipo_log'=>'update_usuarios','descripcion_log'=>'update del usuarios: '.$usr_data_form['usr_id']));
		}
		return $returned;
	}

	function deleteUsuarios($usr_id){
		
		session_start();
		$sysdate=new DateTime();
		
		$returned=$this->db->delete('usuarios',array('id_usuario'=>$usr_id));
		if($returned>0){
			return true;;
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
		$query = $this->db->get('sucursales');
		
		if($query->num_rows >0) 
			return $query;
		else {
			return false;
		}
	}
	
	public function selectTipoUsuarios(){
		$query = $this->db->get('tipousuarios');
		
		if($query->num_rows >0) 
			return $query;
		else {
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



	