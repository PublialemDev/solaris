<?php 
//
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Mclientes extends CI_Model{

	function __construct(){	
		parent::__construct();
		$this->load->database();
		$this->load->model("mdeletedata");
	}
	function insertCliente($datosCliente){
		$this->db->trans_begin();
		//session_start();
		$sysdate=new DateTime();
		$returned=$this->db->insert('clientes',
		array(
			'nombre_cliente' => $datosCliente['nombre'],
			'rfc' => $datosCliente['rfc'],
			'nivel' => $datosCliente['cli_nivel'],
			'creado_en' => $sysdate->format('Y-m-d H:i:s'),
			'creado_por' => base64_decode($_SESSION['USUARIO_ID']))
		);
		//insertar log para auditoria
		if($returned==1){
			$returned=$this->db->insert_id();
			$this->mlogs->insertLog(array('tipo_log'=>'insert_clientes','descripcion_log'=>'alta del cliente: '.$returned));
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
	
	function updateCliente($cli_data_form){

		$this->db->trans_begin();

		$sysdate=new DateTime();
		$returned=0;
		$cli_data=array(
			'nombre_cliente' => $cli_data_form['nombre'],
			'rfc' => $cli_data_form['rfc'],
			'nivel' => $cli_data_form['cli_nivel'],
			'modificado_en' => $sysdate->format('Y-m-d H:i:s'),
			'modificado_por' => base64_decode($_SESSION['USUARIO_ID'])
		);
		$returned=$this->db->update('clientes',$cli_data,array('id_cliente'=>$cli_data_form['cli_id']));
		
		//insertar log para auditoria
		if($returned==1){
			$this->mlogs->insertLog(array('tipo_log'=>'update_clientes','descripcion_log'=>'update del cliente: '.$cli_data_form['cli_id']));
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
	
	function deleteCliente($cli_id){
		
		$this->db->trans_begin();
		$sysdate=new DateTime();
		
		//$returned=$this->db->delete('clientes',array('id_cliente'=>$cli_id));
		
		$cli_data = array(
			'estatus_cliente'=>'I',			
			'modificado_en' => $sysdate->format('Y-m-d H:i:s'),
			'modificado_por' => base64_decode($_SESSION['USUARIO_ID'])
		);
		$returned = $this->db->update('clientes',$cli_data,array('id_cliente'=>$cli_id));			
		
		if($returned == 1){
			$returned = $this->mdeletedata->deleteData($cli_id,"cli");//actualiza el estatus a inactivo de direccion,telefono y correo 									
			if($returned == 1){
				$returned = $this->mdeletedata->deleteProduRemi();	
				if($returned == 1){
					$segui_estatus = array('estatus_seguimiento'=>'I',			
						'modificado_en' => $sysdate->format('Y-m-d H:i:s'),
						'modificado_por' => base64_decode($_SESSION['USUARIO_ID']));			
					$returned = $this->db->update('seguimientoclientes',$segui_estatus,array('id_cliente'=>$cli_id));																			
				}																				
			}			
				
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
	
	
	function selectClientes($where_clause){
		
		if(isset($where_clause['cli_id'])){
			$this->db->where('id_cliente',$where_clause['cli_id']);
		}
		if(isset($where_clause['cli_nombre'])){
			$this->db->like('nombre_cliente',$where_clause['cli_nombre']);
		}
		if(isset($where_clause['cli_rfc'])){
			$this->db->where('rfc',$where_clause['cli_rfc']);
		}
		
		$this->db->where('estatus_cliente','A');
		$query = $this->db->get('clientes');
		if($query->num_rows()>0){
			return $query;
		}
		else{
			return false;
		}
	}
	
	function selectClienteById($id_cliente){
		$where_clause=array('id_cliente'=>$id_cliente);
		$query = $this->db->get_where('clientes',$where_clause);
		if($query->num_rows()>0){
			return $query;
		}
		else{
			return false;
		}
	}
	//regresa el nivel del cliente
	function getClienteNivel($id_cliente){
		$nivel='';
		$where_clause=array('id_cliente'=>$id_cliente);
		$this->db->select('nivel');
		$this->db->from('clientes');
		$this->db->where($where_clause);
		$query = $this->db->get();
		if($query->num_rows()>0){
			foreach ($query->result() as $cliente) {
			$nivel=$cliente->nivel;
			}
			return $nivel;
		}
		else{
			return false;
		}
	}
	
}
?>