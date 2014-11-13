<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class MSucursales extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	function insertSucursales($datosSucursales){
		session_start();
		$sysdate=new DateTime();
		$returned=$this->db->insert('sucursales',
		array(
			'nombre_sucursal' => $datosSucursales['nombre'],
			'pagina_web' => $datosSucursales['paginaweb'],
			'estatus_sucursal' => $datosSucursales['estatus'],
			'creado_en' => $sysdate->format('Y-m-d H:i:s'),
			'creado_por' => base64_decode($_SESSION['USUARIO_ID']))
		);
		//insertar log para auditoria
		if($returned==1){
			$returned=$this->db->insert_id();
			$this->mlogs->insertLog(array('tipo_log'=>'insert_sucursal','descripcion_log'=>'alta de la sucursal: '.$returned));
		}
		return $returned;
	}
	
	function updateSucursales($sucu_data_form){
		session_start();
		$sysdate=new DateTime();
		$returned=0;
		$sucu_data=array(
			'nombre_sucursal' => $sucu_data_form['nombre'],
			'pagina_web' => $sucu_data_form['paginaweb'],
			'estatus_sucursal' => $sucu_data_form['estatus'],
			'modificado_en' => $sysdate->format('Y-m-d H:i:s'),
			'modificado_por' => base64_decode($_SESSION['USUARIO_ID'])
		);
		$returned=$this->db->update('sucursales',$sucu_data,array('id_sucursal'=>$sucu_data_form['sucu_id']));
		
		//insertar log para auditoria
		if($returned==1){
			$this->mlogs->insertLog(array('tipo_log'=>'update_sucursales','descripcion_log'=>'update de la sucursal: '.$sucu_data_form['sucu_id']));
		}
		return $returned;
	}

	function deleteSucursales($sucu_id){
		
		session_start();
		$sysdate=new DateTime();
		
		$returned=$this->db->delete('sucursales',array('id_sucursal'=>$sucu_id));
		if($returned>0){
			return true;;
		}
		return false;
	}
	

	function selectSucursales($where_clause){
		
		if(isset($where_clause['sucu_id'])){
			$this->db->where('id_sucursal',$where_clause['sucu_id']);
		}
		if(isset($where_clause['sucu_nombre'])){
			$this->db->like('nombre_sucursal',$where_clause['sucu_nombre']);
		}
		if(isset($where_clause['sucu_paginaweb'])){
			$this->db->where('pagina_web',$where_clause['sucu_paginaweb']);
		}
		
		$query = $this->db->get('sucursales');
		if($query->num_rows()>0){
			return $query;
		}
		else{
			return false;
		}
	}
	
	function selectSucursalesById($id_sucu){
		$where_clause=array('id_sucursal'=>$id_sucu);
		$query = $this->db->get_where('sucursales',$where_clause);
		if($query->num_rows()>0){
			return $query;
		}
		else{
			return false;
		}
	}
	
}
?>
